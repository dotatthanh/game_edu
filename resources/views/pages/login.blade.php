@extends('layouts.default')
@section('content')
    <form autocomplete="off" action="{{ route('web.post-login') }}" method="POST" class="form-container">
        @csrf
        <!-- Token CSRF để bảo mật -->
        <h2>Đăng nhập</h2>

        <div class="login__content">
            @if (Session::has('error'))
            <p class="text-danger">{{ Session::get('error') }}</p>
            @endif
            <!-- Box Nhập Số Điện Thoại -->

            <div class="login__box">
                <label for="login-phone" class="login__label">Tên tài khoản</label>
                <input type="text" name="login" class="login__input" id="login-phone" placeholder=" " required>
            </div>

            <!-- Box Nhập Mật Khẩu -->
            <div class="login__box">
                <label for="login-pass" class="login__label">Mật khẩu</label>
                <input type="password" name="password" class="login__input" id="login-pass" placeholder=" " required>
            </div>
        </div>

        <!-- Nút Đăng Nhập -->
        <button type="submit" class="btn">Đăng nhập</button>
    </form>
@endsection
