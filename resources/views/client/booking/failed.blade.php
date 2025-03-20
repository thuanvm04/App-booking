
<div class="container">
    <h2>Thanh toán thất bại</h2>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <p>Rất tiếc, đã có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại sau.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Quay lại trang chủ</a>
</div>
