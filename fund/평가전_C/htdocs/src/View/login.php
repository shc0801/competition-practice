<div id="sub-visual">
            <div class="sub-visual-image">
                <img class="background-image" src="./images/sample10.jpg" alt="visual">
                <div class="pos-center text-center text-white lighter">
                    <div class="fs-9">
                        로그인
                    </div>
                    <div class="fs-1 mt-2">
                        킥스타터 펀드
                        <i class="fa fa-angle-right mx-1"></i>
                        메인페이지
                        <i class="fa fa-angle-right mx-1"></i>
                        로그인
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