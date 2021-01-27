<div id="sub-visual" class="position-relative">
    <div class="w-100 h-100 navigation-image">
        <img class="background-image" src="/images/sample10.jpg" alt="">
    </div>
    <div class="pos-center text-center">
        <div class="fs-9 text-white lighter">로그인</div>
        <div class="fs-n1 text-white lighter mt-2">
            킥스타터 펀드
            <i class="fa fa-angle-right mx-1"></i>
            메인페이지
            <i class="fa fa-angle-right mx-1"></i>
            로그인
        </div>
    </div>
</div>

<div id="view-fund" class="py-5">
    <div class="container">
        <form action="/login" method="post">
            <div class="form-group">
                <label for="login_email" class="py-1 pl-2 mb-1 fs-2 text-blue">이메일</label>
                <input type="text" name="user_email" id="login_email" class="form-control" placeholder="이메일을 입력하세요" required>
            </div>
            <div class="form-group">
                <label for="login_pw" class="py-1 pl-2 mb-1 fs-2 text-blue">비밀번호</label>
                <input type="password" name="password" id="login_pw" class="form-control" placeholder="비밀번호를 입력하세요" required>
            </div>
            <div class="form-group flex-col pt-2">
                <button id="login_submit" class="blue-btn flex-end">로그인</button>
            </div>
        </form>
    </div>
</div>

<div class="toast">
    <div class="toast-header">
        <strong class="fs-1 text-blue">form 오류</strong>
        </div>
    <div class="toast-body px-3 py-5 text-blue">입력하신 정보가 양식과 일치하지 않습니다.</div>
</div>
