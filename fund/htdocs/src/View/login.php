
    <div id="sub-visual">
        <div class="sub-visual-image">
            <img class="background-image" src="./images/sample10.jpg" alt="image">
            <div class="pos-center text-center text-white lighter">
                <div class="fs-9">회원가입</div>
                <div class="fs-1 my-2">
                    킥스타터
                    <i class="fa fa-angle-right mx-1"></i>
                    메인페이지
                    <i class="fa fa-angle-right mx-1"></i>
                    회원가입
                </div>
            </div>
        </div>
    </div>

    <div id="login" class="py-5">
        <div class="container">
            <form action="/login" method="post">
                <div class="form-group">
                    <label for="login_email">이메일</label>
                    <input type="email" name="user_email" id="login_email" class="form-control" placeholder="이메일을 입력해주세요" required>
                </div>
                <div class="form-group">
                    <label for="login_pw">비밀번호</label>
                    <input type="password" name="password" id="login_pw" class="form-control" placeholder="비밀번호를 입력해주세요" required>
                </div>
                <div class="form-group flex-col mt-2">
                    <button id="login_submit" class="blue-btn flex-end">로그인</button>
                </div>
            </form>
        </div>
    </div>