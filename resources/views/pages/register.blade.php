@extends('layouts.default')
@section('content')
<form method="POST" action="{{ route('web.post-register') }}" class="form-container">
    @csrf
    <h2>Đăng ký tài khoản</h2>
    <div class="login__content">

        <div class="login__box">
            <label for="login-name" class="login__label">Họ và tên</label>
            <input value="{{ old('name') }}" type="text" name="name" class="login__input" id="login-name" placeholder=" " required>
            {!! $errors->first('name', '<span class="text-danger mt-3 d-block">:message</span>') !!}
        </div>

        <div class="login__box">
            <label for="login-email" class="login__label">Email</label>
            <input value="{{ old('email') }}" type="text" name="email" class="login__input" id="login-email" placeholder=" " required>
            {!! $errors->first('email', '<span class="text-danger mt-3 d-block">:message</span>') !!}
        </div>

        <div class="login__box">
            <label for="login-username" class="login__label">Tên đăng nhập</label>
            <input value="{{ old('username') }}" type="text" name="username" class="login__input" id="login-username" placeholder=" " required>
            {!! $errors->first('username', '<span class="text-danger mt-3 d-block">:message</span>') !!}
        </div>

        <div class="login__box">
            <label for="login-password" class="login__label">Mật khẩu</label>
            <input value="{{ old('password') }}" type="password" name="password" class="login__input" id="login-password" placeholder=" " required>
            {!! $errors->first('password', '<span class="text-danger mt-3 d-block">:message</span>') !!}
        </div>

        <div class="login__box">
            <label for="login-confirm-pass" class="login__label">Nhập lại mật khẩu</label>
            <input value="{{ old('password_confirmation') }}" type="password" name="password_confirmation" class="login__input" id="login-confirm-pass" placeholder=" " required>
            {!! $errors->first('password_confirmation', '<span class="text-danger mt-3 d-block">:message</span>') !!}
        </div>
    </div>
    <button type="submit" class="btn">Đăng ký</button>
</form>
@endsection
