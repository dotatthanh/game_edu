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

    <!-- Bootstrap Css -->
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="header">
        <div class="left-section">
            <nav>

                </a>
                <a href="{{ route('web.news') }}">
                    <h4>Tin tức</h4>
                </a>
                <a href="mailto:mr.phamnhatthanh05112002@gmail.com" class="right-section3" target="_blank">
                    <h4>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Gmail: mr.phamnhatthanh05112002@gmail.com</h4>
                </a>
            </nav>

        </div>
    </div>
    <div class="header1">
        <div class="left-section">
            <a href="/" class="logo1">
                <img src="{{ asset('pages/Photo/logo12.png') }}" alt="Logo">
            </a>
        </div>
        <div class="right-section">
            <form class="search" action="{{ route('web.search') }}" method="get">
                <input type="text" name="search" placeholder="Tìm kiếm game...">
                <button type="submit" class="searchButton">
                     <i class="fa fa-search"></i>
                  </button>
            </form>

            @auth('web')
                <div class="user-container" id="user-container">
                    <div class="user-icon">
                        <img src="{{ asset(auth('web')->user()->avatar ?? 'pages/Photo/path_to_user_icon.png') }}" alt="User Icon">
                    </div>
                    <span class="user-container">
                    </span>
                </div>
            @else
                <a href="{{ route('web.register') }}" class="buttondk" type="button" id="">Đăng ký</a>
                <a href="{{ route('web.login') }}" class="buttondk" type="button" id="">Đăng nhập</a>
                <div class="user-greeting" id="userGreeting" style="display: none;"></div>
            @endauth
        </div>
    </div>
    <div class="header2">
        <a href="{{ route('web.category', ['class_id' => '1']) }}">
            <img src="{{ asset('pages/Photo/ngoisaolop1.png') }}" alt="Lớp 1" class="starimage">
        </a>
        <a href="{{ route('web.category', ['class_id' => '2']) }}">
            <img src="{{ asset('pages/Photo/ngoisaolop2.png') }}" alt="Lớp 2" class="starimage">
        </a>
        <a href="{{ route('web.category', ['class_id' => '3']) }}">
            <img src="{{ asset('pages/Photo/ngoisaolop3.png') }}" alt="Lớp 3" class="starimage">
        </a>
        <a href="{{ route('web.category', ['class_id' => '4']) }}">
            <img src="{{ asset('pages/Photo/ngoisaolop4.png') }}" alt="Lớp 4" class="starimage">
        </a>
        <a href="{{ route('web.category', ['class_id' => '5']) }}">
            <img src="{{ asset('pages/Photo/ngoisaolop5.png') }}" alt="Lớp 5" class="starimage">
        </a>
    </div>

    <div class="header3">
        @foreach ($types as $type)
        <div class="subject-container">
            <a href="{{ route('web.category', ['type_id' => $type->id]) }}">
                <img src="{{ asset($type->image) }}" alt="{{ $type->name }}">
                <h4>{{ $type->name }}</h4>
            </a>
        </div>
        @endforeach
    </div>

    <div class="user-menu">
        <div id="userDropdown" class="dropdown-content">
            <a href="{{ route('web.profile') }}">Thông tin tài khoản</a>
            <a href="{{ route('web.favorites') }}">Danh sách game yêu thích</a>
            <a href="#" href="{{ route('web.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng Xuất</a>
            <form id="logout-form" action="{{ route('web.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
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
    <div class="header4">
        <div class="image-container">
            <img src="{{ asset('pages/Photo/anhnen.jpg') }}" alt="Background Image" class="background-image">
            <img src="{{ asset('pages/Photo/tenweb.png') }}" alt="Foreground Image" class="foreground-image">
        </div>
    </div>

    @yield('content')

</body>

</html>
