<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/jquery-3.4.1.js"></script>
    <script src="./bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./bootstrap-4.4.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="./fontawesome/css/font-awesome.min.css">
</head>
<body>
    <input type="checkbox" id="open-aside" hidden>
    <header class="container">
        <div class="header-top d-lg-flex d-none flex-col">
            <div class="auth mr-3 flex-end">
                <a href="/login" class="header-btn">로그인</a>
                <a href="./join.html" class="header-btn">회원가입</a>
                <a href="/admin" class="header-btn">관리자</a>
            </div>
        </div>
        <div class="header-bottom flex-between">
            <div class="logo"><img src="./images/logo.png" alt="logo" height="35"></div>
            <nav class="d-lg-flex d-none">
                <div class="nav-item"><a href="./index.html" class="lighter">메인페이지</a></div>
                <div class="nav-item"><a href="./register.html" class="lighter">펀드등록</a></div>
                <div class="nav-item"><a href="./view.html" class="lighter">펀드보기</a></div>
                <div class="nav-item"><a href="./investor.html" class="lighter">투자자목록</a></div>
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
                <a href="/login" class="header-btn">로그인</a>
                <a href="./join.html" class="header-btn">회원가입</a>
                <a href="/admin" class="header-btn">관리자</a>
            </div>
            <nav class="mt-2">
                <div class="nav-item py-3"><a href="./index.html" class="lighter">메인페이지</a></div>
                <div class="nav-item py-3"><a href="./register.html" class="lighter">펀드등록</a></div>
                <div class="nav-item py-3"><a href="./view.html" class="lighter"></a>펀드보기</div>
                <div class="nav-item py-3"><a href="./investor.html" class="lighter">투자자목록</a></div>
            </nav>
        </div>
    </aside>

    <div id="sub-visual">
        <div class="sub-visual-image">
            <img class="background-image" src="./images/sample10.jpg" alt="image">
            <div class="pos-center text-center text-white lighter">
                <div class="fs-9">프로필페이지</div>
                <div class="fs-1 my-2">
                    킥스타터
                    <i class="fa fa-angle-right mx-1"></i>
                    메인페이지
                    <i class="fa fa-angle-right mx-1"></i>
                    프로필페이지
                </div>
            </div>
        </div>
    </div>

    <div id="view-fund" class="py-5">
        <div class="container">
            <div class="mt-4">
                <div class="title text-left">유저정보</div>
                <div class="t-head">
                    <div class="cell-30"><span>이메일</span></div>
                    <div class="cell-30"><span>이름</span></div>
                    <div class="cell-30"><span>보유금액</span></div>
                </div>
                <div class="t-row">
                    <div class="cell-30"><span><?=user()->user_email?></span></div>
                    <div class="cell-30"><span><?=user()->user_name?></span></div>
                    <div class="cell-30"><span><?=user()->user_money?></span></div>
                </div>
            </div>
            <div class="mt-4">
                <div class="title text-left">등록한 펀드</div>
                <div class="t-head">
                    <div class="cell-15"><span>펀드번호</span></div>
                    <div class="cell-20"><span>펀드이름</span></div>
                    <div class="cell-20"><span>모집종료일</span></div>
                    <div class="cell-15"><span>모집금액</span></div>
                    <div class="cell-15"><span>현재금액</span></div>
                    <div class="cell-15"><span>투자율</span></div>
                </div>
                <?php foreach($myfunds as $fund): ?>
                <div class="t-row">
                    <div class="cell-15"><span><?=$fund->fund_num?></span></div>
                    <div class="cell-20"><span><?=$fund->fund_name?></span></div>
                    <div class="cell-20"><span><?=$fund->fund_endDate?></span></div>
                    <div class="cell-15"><span><?=$fund->fund_total?></span></div>
                    <div class="cell-15"><span><?=$fund->fund_current?></span></div>
                    <div class="cell-15"><span><?=$fund->fund_success?></span></div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-4">
                <div class="title text-left">투자한 펀드</div>
                <div class="t-head">
                    <div class="cell-15"><span>펀드번호</span></div>
                    <div class="cell-20"><span>펀드이름</span></div>
                    <div class="cell-20"><span>모집종료일</span></div>
                    <div class="cell-15"><span>모집금액</span></div>
                    <div class="cell-15"><span>현재금액</span></div>
                    <div class="cell-15"><span>투자율</span></div>
                </div>
                <?php foreach($investors as $investor): ?>
                <div class="t-row">
                    <div class="cell-15"><span><?=$investor->fund_num?></span></div>
                    <div class="cell-20"><span><?=$investor->fund_name?></span></div>
                    <div class="cell-20"><span><?=$investor->fund_endDate?></span></div>
                    <div class="cell-15"><span><?=$investor->fund_total?></span></div>
                    <div class="cell-15"><span><?=$investor->fund_current?></span></div>
                    <div class="cell-15"><span><?=$investor->fund_success?></span></div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-4">
                <div class="title text-left">사업정보</div>
                <div class="t-head">
                    <div class="cell-25"><span>사업번호</span></div>
                    <div class="cell-25"><span>사업이름</span></div>
                </div>
                <?php foreach($business as $fund): ?>
                <div class="t-row">
                    <div class="cell-25"><span><?=$fund->id?></span></div>
                    <div class="cell-25"><span><?=$fund->besiness_name?></span></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <footer>
        <div class="h-100 flex-center">
            <span>Copyright Gondr Allright reserved. Since 2017-03-01</span>
        </div>
    </footer>
</body>
</html>