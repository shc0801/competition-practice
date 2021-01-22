<div id="sub-visual" class="position-relative">
    <div class="w-100 h-100 navigation-image">
        <img class="background-image" src="/images/sample10.jpg" alt="">
    </div>
    <div class="pos-center text-center">
        <div class="fs-9 text-white lighter">회원가입</div>
        <div class="fs-n1 text-white lighter mt-2">
            킥스타터 펀드
            <i class="fa fa-angle-right mx-1"></i>
            메인페이지
            <i class="fa fa-angle-right mx-1"></i>
            회원가입
        </div>
    </div>
</div>

<div id="view-fund" class="py-5">
    <div class="container">
        <div class="header mb-4 flex-col-center">
            <span class="bold text-blue">지금 킥스타터 펀드의 회원이 되어
                미래의 발판을 마련해보세요.</span>
        </div>
        <form action="/join" method="post">
            <div class="form-group">
                <label for="join_email" class="py-1 pl-2 mb-1 fs-2 text-blue">이메일</label>
                <input type="email" name="user_email" id="join_email" class="form-control" placeholder="이메일을 입력하세요" required>
            </div>
            <div class="form-group">
                <label for="join_name" class="py-1 pl-2 mb-1 fs-2 text-blue">이름</label>
                <input type="text" name="user_name" id="join_name" class="form-control" placeholder="이름을 입력하세요" required>
            </div>
            <div class="form-group">
                <label for="join_pw" class="py-1 pl-2 mb-1 fs-2 text-blue">비밀번호</label>
                <input type="password" name="password" id="join_pw" class="form-control" placeholder="비밀번호를 입력하세요" required>
            </div>
            <div class="form-group">
                <label for="join_pw2" class="py-1 pl-2 mb-1 fs-2 text-blue">비밀번호 확인</label>
                <input type="password" name="password2" id="join_pw2" class="form-control" placeholder="다시 한 번 비밀번호를 입력하세요" required>
            </div>
            <div class="form-group flex-col pt-2">
                <button id="join_submit" class="blue-btn flex-end">회원가입</button>
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

<script src="/js/Join.js"></script>