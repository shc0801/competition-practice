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

    <div id="join" class="py-5">
        <div class="container">
            <form action="/join" method="post">
                <div class="form-group">
                    <label for="join_email">이메일</label>
                    <input type="text" name="user_email" id="join_email" class="form-control" placeholder="이메일을 입력해주세요" required>
                </div>
                <div class="form-group">
                    <label for="join_name">이름</label>
                    <input type="text" name="user_name" id="join_name" class="form-control" placeholder="이름을 입력해주세요" required>
                </div>
                <div class="form-group">
                    <label for="join_pw">비밀번호</label>
                    <input type="password" name="password" id="join_pw" class="form-control" placeholder="비밀번호를 입력해주세요" required>
                </div>
                <div class="form-group">
                    <label for="join_pw2">비밀번호 확인</label>
                    <input type="password" name="password2" id="join_pw2" class="form-control" placeholder="다시 한 번 비밀번호를 입력해주세요" required>
                </div>
                <div class="form-group flex-col mt-2">
                    <button id="join_submit" class="blue-btn flex-end">회원가입</button>
                </div>
            </form>
        </div>
    </div>
    <script src="./js/Join.js"></script>
    <div id="toast-container"></div>