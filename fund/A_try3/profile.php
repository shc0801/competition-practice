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
                <div class="nav-item"><a class="lighter" href="./index.html">메인페이지</a></div>
                <div class="nav-item"><a class="lighter" href="./register.html">펀드등록</a></div>
                <div class="nav-item"><a class="lighter" href="./view.html">펀드보기</a></div>
                <div class="nav-item"><a class="lighter" href="./investor.html">방문자목록</a></div>
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
                <div class="nav-item py-3"><a class="lighter" href="./index.html">메인페이지</a></div>
                <div class="nav-item py-3"><a class="lighter" href="./register.html">펀드등록</a></div>
                <div class="nav-item py-3"><a class="lighter" href="./view.html">펀드보기</a></div>
                <div class="nav-item py-3"><a class="lighter" href="./investor.html">방문자목록</a></div>
            </nav>
        </div>
    </aside>

    <div id="sub-visual">
        <div class="sub-visual-image">
            <img class="background-image" src="./images/sample10.jpg" alt="image">
            <div class="pos-center text-center text-white lighter">
                <div class="fs-9">회원정보</div>
                <div class="fs-n1 pt-2">
                    킥스타터 펀드 
                    <i class="fa fa-angle-right mx-1"></i>
                    메인페이지 
                    <i class="fa fa-angle-right mx-1"></i>
                    회원정보
                </div>
            </div>
        </div>
    </div>

    <div id="profile" class="py-5">
        <div class="container">
            <div class="mt-4">
                <div class="title text-left">회원정보</div>
                <div class="t-head mt-3 pb-2">
                    <div class="cell-30"><span>이메일</span></div>
                    <div class="cell-30"><span>이름</span></div>
                    <div class="cell-30"><span>투자금액</span></div>
                </div>
                <div class="t-row">
                    <div class="cell-30"><span><?=user()->user_email?></span></div>
                    <div class="cell-30"><span><?=user()->user_name?></span></div>
                    <div class="cell-30"><span><?=user()->money?></span></div>
                </div>
            </div>
            <div class="mt-4">
                <div class="title text-left">등록한 펀드</div>
                <div class="t-head mt-3 pb-2">
                    <div class="cell-15"><span>펀드번호</span></div>
                    <div class="cell-20"><span>펀드이름</span></div>
                    <div class="cell-20"><span>모집마감일</span></div>
                    <div class="cell-15"><span>모집금액</span></div>
                    <div class="cell-15"><span>현재금액</span></div>
                    <div class="cell-15"><span>모집율</span></div>
                </div>
                <?php foreach($myfunds as $fund): ?>
                <div class="t-row">
                    <div class="cell-15"><span><?=$fund->fund_num?></span></div>
                    <div class="cell-20"><span><?=$fund->fund_name?></span></div>
                    <div class="cell-20"><span><?=$fund->fund_endDate?></span></div>
                    <div class="cell-15"><span><?=$fund->fund_total?></span></div>
                    <div class="cell-15"><span><?=$fund->fund_current?></span></div>
                    <div class="cell-15"><span><?=$fund->fund_success?>%</span></div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-4">
                <div class="title text-left">투자한 펀드</div>
                <div class="t-head mt-3 pb-2">
                    <div class="cell-15"><span>펀드번호</span></div>
                    <div class="cell-20"><span>펀드이름</span></div>
                    <div class="cell-20"><span>모집마감일</span></div>
                    <div class="cell-15"><span>모집금액</span></div>
                    <div class="cell-15"><span>현재금액</span></div>
                    <div class="cell-15"><span>모집율</span></div>
                </div>
                <?php foreach($investors as $investor): ?>
                <div class="t-row">
                    <div class="cell-15"><span><?=$investor->fund_num?></span></div>
                    <div class="cell-20"><span><?=$investor->fund_name?></span></div>
                    <div class="cell-20"><span><?=$investor->fund_endDate?></span></div>
                    <div class="cell-15"><span><?=$investor->fund_total?></span></div>
                    <div class="cell-15"><span><?=$investor->fund_current?></span></div>
                    <div class="cell-15"><span><?=$investor->fund_success?>%</span></div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-4">
                <div class="title text-left">사업정보</div>
                <div class="t-head mt-3 pb-2">
                    <div class="cell-25"><span>사업번호</span></div>
                    <div class="cell-25"><span>사업이름</span></div>
                </div>
                <?php foreach($business as $fund): ?>
                <div class="t-row">
                    <div class="cell-25"><span><?=$fund->id?></span></div>
                    <div class="cell-25"><span><?=$fund->bisuness_name?></span></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <footer>
        <div class="container h-100 flex-center">
            <p class="m-0 py-2">Copyright Gondr Allright reserved. Since 2017-03-01</p>
        </div>
    </footer>
</body>
</html>