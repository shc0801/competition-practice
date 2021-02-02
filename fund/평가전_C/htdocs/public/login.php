<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/syle.css">
    <script src="./js/jquery-3.4.1.js"></script>
    <script src="./bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./bootstrap-4.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="./fontawesome/css/font-awesome.min.css">
</head>
<body>
    <input type="checkbox" id="open-aside" hidden>
        <header class="container">
            <div class="header-top d-lg-flex d-none flex-col">
                <div class="auth mr-3 flex-end">
                    <a class="header-btn" href="/login">로그인</a>
                    <a class="header-btn" href="./join.html">회원가입</a>
                    <a class="header-btn" href="/admin">관리자</a>
                </div>
            </div>
            <div class="header-bottom flex-between">
                <div class="logo"><a href="./index.html"><img src="./images/logo.png" alt="logo" height="35"></a></div>
                <nav class="d-lg-flex d-none">
                    <div class="nav-item">
                        <a href="./index.html" class="lighter">메인페이지</a>
                    </div>
                    <div class="nav-item">
                        <a href="./register.html" class="lighter">펀드등록</a>
                    </div>
                    <div class="nav-item">
                        <a href="./view.html" class="lighter">펀드보기</a>
                    </div>
                    <div class="nav-item">
                        <a href="./investor.html" class="lighter">투자자목록</a>
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
                <div class="auth">
                    <a class="header-btn" href="/login">로그인</a>
                    <a class="header-btn" href="./join.html">회원가입</a>
                    <a class="header-btn" href="/admin">관리자</a>
                </div>
                <nav class="mt-2">
                    <div class="nav-item py-2">
                        <a href="./index.html" class="lighter">메인페이지</a>
                    </div>
                    <div class="nav-item py-2">
                        <a href="./register.html" class="lighter">펀드등록</a>
                    </div>
                    <div class="nav-item py-2">
                        <a href="./view.html" class="lighter">펀드보기</a>
                    </div>
                    <div class="nav-item py-2">
                        <a href="./investor.html" class="lighter">투자자목록</a>
                    </div>
                </nav>
            </div>
        </aside>
        
        <div id="sub-visual">
            <div class="sub-visual-image">
                <img class="background-image" src="./images/sample10.jpg" alt="visual">
                <div class="pos-center text-center text-white lighter">
                    <div class="fs-9">
                        펀드등록
                    </div>
                    <div class="fs-1 mt-2">
                        킥스타터 펀드
                        <i class="fa fa-angle-right mx-1"></i>
                        메인페이지
                        <i class="fa fa-angle-right mx-1"></i>
                        펀드등록
                    </div>
                </div>
            </div>
        </div>
        
        <div id="login" class="py-5">
            <div class="container">
                <form action="/login" method="post" class="py-3">
                    <div class="form-group">
                        <label for="login_email">이메일</label>
                        <input type="text" name="user_email" id="login_email" class="form-control" placeholder="이메일을 입력해주세요" required>
                    </div>
                    <div class="form-group">
                        <label for="login_pw">비밀번호</label>
                        <input type="password" name="password" id="login_pw" class="form-control" placeholder="비밀번호를 입력해주세요" required>
                    </div>
                    <div class="form-group flex-col">
                        <button class="blue-btn flex-end">로그인</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="toast-container"></div>

        <footer>
            <div class="container h-100 flex-center">
                <span>Copyright Gondr Allright reserved. Since 2017-03-01</span>
            </div>
        </footer>
</body>
</html>