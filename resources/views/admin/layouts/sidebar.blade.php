<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Manage</li>

                <li>
                    <a href="{{ route('customers.index') }}" class=" waves-effect">
                        <i class="bx bx-user"></i>
                        <span>Người dùng</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('games.index') }}" class=" waves-effect">
                        <i class="mdi mdi-gamepad-variant"></i>
                        <span>Trò chơi</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('news.index') }}" class=" waves-effect">
                        <i class="bx bx-news"></i>
                        <span>News</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->
