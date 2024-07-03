<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Primary Games</title>
    <link rel="stylesheet" href="{{ asset('pages/CSS/style-header.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/CSS/style-main.css') }}">
    <script src="{{ asset('pages/JS/script.js') }}"></script>
    <script src="{{ asset('pages/JS/forgot_password.js') }}"></script>
    <script src="https://kit.fontawesome.com/43dcc20e7a.js" crossorigin="anonymous"></script>
    <link rel="icon" href="{{ asset('pages/Photo/logo.png') }}" type="image/x-icon">
</head>

<body>
    <div class="header">
        <div class="left-section">
            <nav>
                <a href="introduce.html" target="_blank">
                    <h4>Giới Thiệu</h4>
                </a>
                <a href="#guides" target="_blank">
                    <h4>Hướng dẫn</h4>
                </a>
                <a href="index-news.html" target="_blank">
                    <h4>Tin tức</h4>
                </a>
                <a href="mailto:mr.phamnhatthanh05112002@gmail.com" class="right-section3" target="_blank">
                    <h4>Gmail: mr.phamnhatthanh05112002@gmail.com</h4>
                </a>
            </nav>

        </div>
    </div>
    <div class="header1">
        <div class="left-section">
            <a href="index.html" class="logo1">
                <img src="{{ asset('pages/Photo/logo12.png') }}" alt="Logo">
            </a>
        </div>
        <div class="right-section">
            <div class="search">
                <input type="text" placeholder="Tìm kiếm game...">
                <button type="submit" class="searchButton">
                     <i class="fa fa-search"></i>
                  </button>
            </div>
            <button class="buttondk" type="button" id="registerBtn">Đăng ký</button>
            <button class="buttondk" type="button" id="loginBtn">Đăng nhập</button>
            <div class="user-greeting" id="userGreeting" style="display: none;"></div>
        </div>
    </div>



    <!-- Popup form đăng ký -->
    <div id="registerForm" class="form-popup">
        <form method="post" class="form-container" onsubmit="return false;">
            <h2>Đăng ký tài khoản</h2>
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Nhập Email" name="email" required>
            <label for="username"><b>Tên đăng nhập</b></label>
            <input type="text" placeholder="Nhập tên đăng nhập (tối thiểu 8 ký tự)" name="username" required>
            <label for="phone"><b>Số điện thoại</b></label>
            <input type="text" placeholder="Nhập số điện thoại" name="phone" required>
            <label for="gender"><b>Giới tính</b></label>
            <select name="gender" required>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select><br><br>
            <label for="psw"><b>Mật khẩu</b></label>
            <input type="password" placeholder="Nhập mật khẩu (tối thiểu 8 ký tự)" name="psw" required>
            <button type="submit" class="btn">Đăng ký</button>
            <button type="button" class="btn cancel" onclick="closeForm('registerForm')">Đóng</button>
        </form>
    </div>

    <!-- Popup form đăng nhập -->
    <div id="loginForm" class="form-popup">
        <form method="post" class="form-container" onsubmit="return false;">
            <h2>Đăng nhập tài khoản</h2>
            <label for="username"><b>Tên đăng nhập</b></label>
            <input type="text" placeholder="Nhập tên đăng nhập" name="username" minlength="8" required>
            <label for="psw"><b>Mật khẩu</b></label>
            <input type="password" placeholder="Nhập mật khẩu" name="psw" minlength="8" required>
            <a href="#" class="forgot-password" onclick="openForm('forgotPasswordForm')">Quên mật khẩu?</a>
            <button type="submit" class="btn">Đăng nhập</button>
            <button type="button" class="btn cancel" onclick="closeForm('loginForm')">Thoát</button>
        </form>
    </div>

    <div class="user-menu">

        <div id="userDropdown" class="dropdown-content">

            <a href="#" id="accountInfo">Thông tin tài khoản</a>
            <a href="#" id="favoriteGames">Danh sách game yêu thích</a>
            <a href="#" id="changePassword">Đổi mật khẩu</a>
            <a href="#" id="logout">Đăng Xuất</a>
        </div>
    </div>



    <!-- Popup form quên mật khẩu -->
    <div id="forgotPasswordForm" class="form-popup">
        <form method="post" class="form-container" onsubmit="return false;">
            <h2>Quên mật khẩu</h2>
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Nhập Email" name="email" id="forgotEmail" required>
            <button type="button" class="btn" onclick="sendNewPassword()">Xác nhận</button>
            <button type="button" class="btn cancel" onclick="closeForm('forgotPasswordForm')">Đóng</button>
        </form>
    </div>
    <!-- Popup form thông tin người dùng -->
    <div id="userInfoModal" class="form-popup">
        <div class="form-container">
            <span class="close">&times;</span>
            <h2>Thông tin tài khoản</h2>
            <form id="userInfoForm" action="PHP/save_user_info.php" method="POST">
                <label for="username">Tên người dùng:</label>
                <input type="text" id="username" name="username" disabled><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" disabled><br>
                <label for="phone">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" disabled><br>
                <label for="gender">Giới tính:</label>
                <input type="text" id="gender" name="gender" disabled><br>
                <button type="button" class="btn" id="editBtn">Sửa</button>
                <button type="button" class="btn" id="saveBtn" disabled>Lưu</button>
            </form>
        </div>
    </div>
    <!-- Popup form đổi mật khẩu -->
    <div id="changePasswordModal" class="form-popup">
        <div class="form-container">
            <h2>Thay đổi mật khẩu</h2>
            <form id="changePasswordForm">
                <label for="currentPassword">Mật khẩu hiện tại:</label>
                <input type="password" id="currentPassword" name="currentPassword" required><br>
                <label for="newPassword">Mật khẩu mới:</label>
                <input type="password" id="newPassword" name="newPassword" required><br>
                <label for="confirmPassword">Xác nhận mật khẩu mới:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required><br>
                <button type="submit" class="btn">Đổi mật khẩu</button>
                <button type="button" class="btn cancel" onclick="closeForm('changePasswordModal')">Thoát</button>
            </form>
        </div>
    </div>

    {{-- <form method="POST" action="{{ route('web.post-register') }}" class="form-container">
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

    </form> --}}


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

</body>

</html>
