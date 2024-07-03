@extends('layouts.default')
@section('content')
    <div class="header5">
        <div class="tenmon">
            <h2>Thông tin tài khoản</h2>
        </div>
        <div class="gamezone">
            <div class="container">
                <form method="POST" action="{{ route('web.save-profile') }}" class="form-container">
                    @csrf
                    <h2>Thông tin tài khoản</h2>
                    <div class="login__content">

                        <div class="login__box">
                            <label for="login-name" class="login__label">Họ và tên</label>
                            <input value="{{ old('name', auth('web')->user()->name) }}" type="text" name="name" class="login__input" id="login-name" placeholder=" " >
                            {!! $errors->first('name', '<span class="text-danger d-block">:message</span>') !!}
                        </div>

                        <div class="login__box">
                            <label for="login-email" class="login__label">Email</label>
                            <input value="{{ old('email', auth('web')->user()->email) }}" type="text" name="email" class="login__input" id="login-email" placeholder=" " >
                            {!! $errors->first('email', '<span class="text-danger d-block">:message</span>') !!}
                        </div>

                        <div class="login__box">
                            <label for="login-username" class="login__label">Tên đăng nhập</label>
                            <input value="{{ old('username', auth('web')->user()->username) }}" type="text" name="username" class="login__input" id="login-username" placeholder=" " >
                            {!! $errors->first('username', '<span class="text-danger d-block">:message</span>') !!}
                        </div>

                        <div class="login__box">
                            <label for="login-password" class="login__label">Mật khẩu</label>
                            <input value="{{ old('password') }}" type="password" name="password" class="login__input" id="login-password" placeholder=" " >
                            {!! $errors->first('password', '<span class="text-danger d-block">:message</span>') !!}
                        </div>

                        <div class="login__box">
                            <label for="login-confirm-pass" class="login__label">Nhập lại mật khẩu</label>
                            <input value="{{ old('password_confirmation') }}" type="password" name="password_confirmation" class="login__input" id="login-confirm-pass" placeholder=" " >
                            {!! $errors->first('password_confirmation', '<span class="text-danger d-block">:message</span>') !!}
                        </div>
                    </div>
                    <button type="submit" class="btn">Lưu</button>
                </form>
            </div>
        </div>
    </div>
@endsection
