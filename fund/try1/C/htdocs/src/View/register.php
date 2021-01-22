<div id="sub-visual" class="position-relative">
    <div class="w-100 h-100 navigation-image">
        <img class="background-image" src="/images/sample10.jpg" alt="">
    </div>
    <div class="pos-center text-center">
        <div class="fs-9 text-white lighter">펀드등록</div>
        <div class="fs-n1 text-white lighter mt-2">
            킥스타터 펀드
            <i class="fa fa-angle-right mx-1"></i>
            메인페이지
            <i class="fa fa-angle-right mx-1"></i>
            펀드등록
        </div>
    </div>
</div>

<div id="register-fund" class="py-5">
    <div class="container">
        <form action="/insert/fund" method="post">
            <div class="form-group">
                <label for="register_num" class="py-1 pl-2 mb-1 fs-2 text-blue">펀드번호</label>
                <input type="text" name="fund_num" id="register_num" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="register_name" class="py-1 pl-2 mb-1 fs-2 text-blue">창업펀드명</label>
                <input type="text" name="fund_name" id="register_name" class="form-control" placeholder="펀드명을 입력하세요" required>
            </div>
            <div class="form-group">
                <label for="register_endDate" class="py-1 pl-2 mb-1 fs-2 text-blue">모집마감일</label>
                <input type="date" name="fund_endDate" id="register_endDate" class="form-control my-1" required>
                <input type="time" name="fund_endDate_time" step="1" id="register_endDate_time" class="form-control my-1" required>
            </div>
            <div class="form-group">
                <label for="register_total" class="py-1 pl-2 mb-1 fs-2 text-blue">모집금액</label>
                <input type="number" name="fund_total" id="register_total" class="form-control" placeholder="모집금액을 입력하세요" required>
            </div>
            <div class="form-group">
                <label for="register_text" class="py-1 pl-2 mb-1 fs-2 text-blue">상세설명</label>
                <textarea id="register_text" name="fund_text" class="form-control" cols="30" rows="10" placeholder="상세설명..."></textarea required>
            </div>
            <div class="form-group">
                <label for="register_file" class="py-1 pl-2 mb-1 fs-2 text-blue">펀드이미지</label>
                <div class="custom-file">
                    <input type="file" name="fund_image" id="register_file" class="custom-file-input" required>
                    <label class="custom-file-label" for="">파일을 업로드 해주세요</label>
                </div>
            </div>
            <div class="form-group flex-col pt-2">
                <button id="register_submit" class="blue-btn flex-end">펀드등록</button>
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

<script src="./js/Register.js"></script>