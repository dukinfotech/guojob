<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./lib/bootstrap-5.2.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body class="body-wrapper">
    @yield('navbar')
    <div class="container">
        @yield('content')
    </div>

    <footer>
        <div class="text-center">
            <a class="menu-block2 {{ request()->route()->getName() === 'homepage' ? 'menu-active' : '' }}" href="/">
                <img src="/images/footera.png" alt="footera" class="menu-icon">
                <h5 class="fw-bold">Trang chủ</h5>
            </a>
            <a class="menu-block2 {{ request()->route()->getName() === 'myteam' ? 'menu-active' : '' }}" href="/myteam">
                <img src="/images/footerb.png" alt="footerb" class="menu-icon">
                <h5 class="fw-bold">Đội</h5>
            </a>
            <a class="menu-block2 {{ request()->route()->getName() === 'vip' ? 'menu-active' : '' }}" href="/vip">
                <img src="/images/footerc.png" alt="footerc" class="menu-icon">
                <h5 class="fw-bold">VIP</h5>
            </a>
            <a class="menu-block2 {{ request()->route()->getName() === 'introduce' ? 'menu-active' : '' }}" href="/introduce">
                <img src="/images/footerd.png" alt="footerd" class="menu-icon">
                <h5 class="fw-bold">Giới thiệu</h5>
            </a>
            <div class="menu-block2">
                <img src="/images/footere.png" alt="footere" class="menu-icon">
                <h5 class="fw-bold">Tài khoản</h5>
            </div>
        </div>
    </footer>
    <script src="./lib/bootstrap-5.2.0-dist/js/bootstrap.min.js"></script>
    <script src="./lib/jquery/jquery.min.js"></script>
    @stack('scripts')
</body>
</html>
