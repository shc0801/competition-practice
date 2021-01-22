<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/jquery-3.4.1.js"></script>
    <script src="/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/bootstrap-4.4.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="/fontawesome/css/font-awesome.min.css">
</head>
<body>
    <input id="open-aside" type="checkbox" hidden>
    <header class="container ">
        <div class="header-top d-lg-flex d-none flex-col">
            <div class="auth mr-3 flex-end">
                <?php if(!user()): ?>
                <a class="header-btn mx-1" href="/login">로그인</a>
                <a class="header-btn mx-1" href="/join">회원가입</a>
                <?php elseif(user()->user_email == "admin"):?>
                <a class="header-btn mx-1" href="/admin"><?=user()->user_name?> <small class="text-gray"></small></a>
                <a class="header-btn mx-1" href="/logout">로그아웃</a>
                <?php else: ?>
                <a class="header-btn mx-1" href="/profile"><?=user()->user_name?> <small class="text-gray">(<?=user()->money?>원)</small></a>
                <a class="header-btn mx-1" href="/logout">로그아웃</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="header-bottom flex-between">
            <a href="/" class="logo">
                <img src="/images/logo.png" alt="logo" height="35">
            </a>
            <nav class="d-lg-flex d-none">
                <div class="nav-item">
                    <a class="lighter" href="/">메인페이지</a>
                </div>
                <div class="nav-item">
                    <a class="lighter" href="/register">펀드등록</a>
                </div>
                <div class="nav-item">
                    <a class="lighter" href="/view">펀드보기</a>
                </div>
                <div class="nav-item">
                    <a class="lighter" href="/investor">투자자목록</a>
                </div>
            </nav>
            <label for="open-aside" class="icon-bar d-lg-none">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>
    </header>
    <aside>
        <label for="open-aside" class="aside-background"></label>
        <div class="aside-content px-4">
            <div class="auth flex-end">
                <a class="header-btn mx-1 fs-n4" href="/login">로그인</a>
                <a class="header-btn mx-1 fs-n4" href="/join">회원가입</a>
                <a class="header-btn mx-1 fs-n4" href="#">관리자</a>
            </div>
            <nav class="mt-4">
                <div class="nav-item my-3">
                    <a href="/index">메인페이지</a>
                </div>
                <div class="nav-item my-3">
                    <a href="/register">펀드등록</a>
                </div>
                <div class="nav-item my-3">
                    <a href="/view">펀드보기</a>
                </div>
                <div class="nav-item my-3">
                    <a href="/investor">투자자목록</a>
                </div>
            </nav>
        </div>
    </aside>