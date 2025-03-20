<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);
            if ($validateUser->fails()) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'validation error',
                        'errors' => $validateUser->errors(),
                    ],
                    401,
                );
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            return response()->json(
                [
                    'status' => true,
                    'message' => 'validation create success',
                    'token' => $user->createToken('API Token')->plainTextToken,
                ],
                200,
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage(),
                ],
                500,
            );
        }
    }
    public function login(Request $request)
{
    try {
        // Xác thực dữ liệu đầu vào
        $validateUser = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Nếu xác thực không thành công, quay lại trang trước với lỗi
        if ($validateUser->fails()) {
            return redirect()->back()->withErrors($validateUser)->withInput();
        }

        // Kiểm tra thông tin đăng nhập
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()
                ->back()
                ->withErrors(['email' => 'Email hoặc Password không đúng']);
        }

        // Lấy người dùng
        $user = User::where('email', $request->email)->first();

        // Tạo token cho API
        $tokenResult = $user->createToken('API Token');
        $token = $tokenResult->plainTextToken;

        // Mã hóa token bằng md5 (nếu cần thiết)
        $hashedToken = md5($token);

        // Lưu token vào session (nếu cần thiết)
        session(['api_token' => $hashedToken]);

        // Trả về thông báo thành công
        return redirect()->route('/')->with('status', 'Đăng nhập thành công! Token: ' . $hashedToken);
    } catch (\Throwable $th) {
        // Xử lý ngoại lệ và trả về lỗi
        return redirect()
            ->back()
            ->withErrors(['email' => $th->getMessage()]);
    }
}
    public function profile (){
        $userData = auth()->user();
        return response()->json(
            [
                'status' => true,
                'message' => 'Profile get successfully',
                'data' => $userData,
                'id' => $userData->id
            ],
            200,
        );
    }
    public function logout (Request $request){
        $user = $request->user();
        if ($user) {
            $user->tokens()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Logout successfully',
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'User not authenticated',
        ], 401);
    }
}
