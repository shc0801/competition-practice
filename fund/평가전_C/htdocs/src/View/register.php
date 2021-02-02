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
        
        <div id="register-fund" class="py-5">
            <div class="container">
                <form action="/insert/fund" method="post" class="py-3">
                    <div class="form-group">
                        <label for="register_num">펀드번호</label>
                        <input type="text" name="fund_num" id="register_num" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="register_name">창업펀드명</label>
                        <input type="text" name="fund_name" id="register_name" class="form-control" placeholder="펀드의 이름을 입력해주세요" required>
                    </div>
                    <div class="form-group">
                        <label for="register_endDate">모집마감일</label>
                        <input type="datetime-local" step="1" name="fund_endDate" id="register_endDate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="register_price">모집금액</label>
                        <input type="number" name="fund_price" id="register_price" class="form-control" placeholder="모집받을 금액을 입력해주세요" required>
                    </div>
                    <div class="form-group">
                        <label for="register_text">상세설명</label>
                        <textarea name="fund_text" id="register_text" cols="30" rows="10" class="form-control" placeholder="상세설명..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="register_image">펀드이미지</label>
                        <div class="custom-file">
                            <input type="file" name="fund_image" id="register_image" class="custom-file-input" required>
                            <label for="register_image" class="custom-file-label">이미지를 업로드해주세요</label>
                        </div>
                    </div>
                    <div class="form-group flex-col">
                        <button id="register_submit" class="blue-btn flex-end">등록하기</button>
                    </div>
                </form>
            </div>
        </div>
        <script src="/js/Register.js"></script>

        <div id="toast-container"></div>