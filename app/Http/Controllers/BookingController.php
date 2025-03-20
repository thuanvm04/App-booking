<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Promotion;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Validator;
class BookingController extends Controller
{
    public function index(Request $request)
    {
        $validate = $request->validate([
            'check_in_date' => ['required', 'date', 'after_or_equal:today'],
            'check_out_date' => ['required', 'date', 'after_or_equal:check_in_date'],
            'room_id' => ['required', 'exists:rooms,id'],
        ]);
        $data = $validate;
        $room_id = $data['room_id'];

        // Truy vấn để lấy thông tin phòng
        $room = Room::find($room_id);
        $user = Auth::user();
        $check_out_date = Carbon::parse($data['check_out_date']);
        $check_in_date = Carbon::parse($data['check_in_date']);
        $duration = $check_out_date->diffInDays($check_in_date);
        $totalPrice = $room->price * $duration;
        return view('client.booking', compact('data', 'room', 'user', 'duration', 'totalPrice'));
    }
    public function applyDiscount(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'total_price' => 'required|numeric',
        ]);

        try {
            $title = $request->input('title');
            $totalPrice = $request->input('total_price');

            // Lấy mã giảm giá dựa trên tiêu đề
            $discount = Promotion::where('title', $title)->first();

            if (!$discount) {
                return response()->json(['success' => false, 'message' => 'Discount code is not valid.']);
            }

            // Kiểm tra ngày hết hạn của mã giảm giá
            if ($discount->end_date < Carbon::now()) {
                return response()->json(['success' => false, 'message' => 'Discount code is expired.']);
            }

            $discountAmount = ($totalPrice * $discount->discount_percentage) / 100;
            $newTotalPrice = $totalPrice - $discountAmount;

            return response()->json([
                'success' => true,
                'discount_amount' => $discountAmount,
                'new_total_price' => $newTotalPrice,
            ]);
        } catch (\Exception $e) {
            Log::error('Error applying discount: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An unexpected error occurred.']);
        }
    }

    public function createOrder(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $data['room_id'] = $request->input('room_id');
            $data['code_order'] = uniqid();
            $data['booking_date'] = Carbon::now();
            $data['user_id'] = Auth::user()->id;
            $data['note'] = $request->input('note', null);
            $data['total_amount'] = $request->input('total_amount');

            $room = Room::find($data['room_id']);
            if (!$room) {
                return response()->json(['error' => 'Room not found'], 404);
            }

            $bookedRooms = Booking::whereBetween('check_in_date', [$request->check_in_date, $request->check_out_date])
                ->orWhereBetween('check_out_date', [$request->check_in_date, $request->check_out_date])
                ->pluck('room_id');

            if ($bookedRooms->contains($room->id)) {
                return response()->json(['error' => 'Room is already booked']);
            }

            $booking = Booking::create($data);

            $room->availability_status = 0;
            $room->save();

            DB::commit();

            // Bắt đầu xử lý thanh toán
            return $this->processPayment($booking);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error creating order: ' . $e->getMessage()], 500);
        }
    }

    public function processPayment($booking)
    {
        $total_amount = $booking->total_amount * 25000;
        $partnerCode = 'MOMO';
        $accessKey = 'F8BBA842ECF85';
        $secretKey = 'K951B6PE1waDMi640xX08PD3vg6EkVlz';
        $requestId = $partnerCode . time();
        $orderId = $booking->code_order;
        $orderInfo = 'pay with MoMo';
        $redirectUrl = route('payment.callback');
        $ipnUrl = route('momo.ipn');
        $amount = $total_amount;
        $requestType = 'captureWallet';
        $extraData = '';
    
        $rawSignature = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
        $signature = hash_hmac('sha256', $rawSignature, $secretKey);
    
        $requestBody = [
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature,
            'lang' => 'en',
        ];
    
        $response = Http::withOptions([
            'verify' => false,
        ])->post('https://test-payment.momo.vn/v2/gateway/api/create', $requestBody);
    
        if ($response->successful()) {
            $result = $response->json();
            if ($result['resultCode'] == 0) {
                // Cập nhật trạng thái đơn hàng
                $booking->status = 'pending_payment';
                $booking->save();
    
                // Lưu thông tin thanh toán vào session để sử dụng sau này
                session([
                    'momo_payment_info' => [
                        'order_id' => $orderId,
                        'amount' => $amount,
                        'pay_url' => $result['payUrl']
                    ]
                ]);
    
                // Chuyển hướng người dùng đến trang thanh toán MoMo
                return redirect($result['payUrl']);
            } else {
                // Xử lý khi có lỗi từ MoMo
                $booking->status = 'payment_failed';
                $booking->save();
                return redirect()
                    ->route('booking.failed')
                    ->with('error', 'Unable to create payment: ' . $result['message']);
            }
        } else {
            // Xử lý khi không thể kết nối với MoMo
            $booking->status = 'payment_failed';
            $booking->save();
            return redirect()->route('booking.failed')->with('error', 'Unable to connect to payment gateway');
        }
    }

    public function bookingFailed()
    {
        return view('client.booking.failed')->with('error', session('error'));
    }

    public function bookingSuccess()
    {
        $data = session('momo_payment_info');   
        $booking =Booking::where('user_id',Auth::user()->id )->first();
       
        
        // dd($data);
        return view('client.booking.success',compact('data','booking'))->with('success', session('success'));
    }


    public function paymentCallback(Request $request)
    {
        $orderId = $request->orderId;
        $resultCode = $request->resultCode;
    
        $booking = Booking::where('code_order', $orderId)->first();
        if (!$booking) {
            return redirect()->route('booking.failed')->with('error', 'Order not found');
        }
    
        if ($resultCode == 0) {
            // Thanh toán thành công
            $booking->status = 'paid';
            $booking->save();
            // Thực hiện các hành động khác khi thanh toán thành công (gửi email, cập nhật inventory, etc.)
            return redirect()->route('booking.success')->with('success', 'Payment successful');
        } else {
            // Thanh toán thất bại
            $booking->status = 'payment_failed';
            $booking->save();
            return redirect()->route('booking.failed')->with('error', 'Payment failed');
        }
    }
    public function handleIpn(Request $request)
    {
        // Xác thực yêu cầu từ MoMo
        $secretKey = 'K951B6PE1waDMi640xX08PD3vg6EkVlz'; // Đảm bảo sử dụng secret key thực tế của bạn
        $rawHash = 'partnerCode=' . $request->partnerCode . '&accessKey=' . $request->accessKey . '&requestId=' . $request->requestId . '&amount=' . $request->amount . '&orderId=' . $request->orderId . '&orderInfo=' . $request->orderInfo . '&orderType=' . $request->orderType . '&transId=' . $request->transId . '&message=' . $request->message . '&localMessage=' . $request->localMessage . '&responseTime=' . $request->responseTime . '&errorCode=' . $request->errorCode . '&payType=' . $request->payType . '&extraData=' . $request->extraData;

        $signature = hash_hmac('sha256', $rawHash, $secretKey);

        if ($signature != $request->signature) {
            return response('Invalid signature', 400);
        }

        // Xử lý kết quả thanh toán
        $orderId = $request->orderId;
        $booking = Booking::where('code_order', $orderId)->first();

        if (!$booking) {
            return response('Order not found', 404);
        }

        if ($request->errorCode == 0) {
            $booking->status = 'paid';
            $booking->save();
            // Gửi email xác nhận thanh toán cho khách hàng
        } else {
            $booking->status = 'payment_failed';
            $booking->save();
            // Xử lý khi thanh toán thất bại
        }

        return response('IPN processed', 200);
    }
}
