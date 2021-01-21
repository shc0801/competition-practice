<div id="sub-visual" class="position-relative">
    <div class="w-100 h-100 navigation-image">
        <img class="background-image" src="/images/sample10.jpg" alt="">
    </div>
    <div class="pos-center text-center">
        <div class="fs-9 text-white lighter">관리자 페이지</div>
        <div class="fs-n1 text-white lighter mt-4">
            킥스타터 펀드
            <i class="fa fa-angle-right mx-1"></i>
            메인페이지
            <i class="fa fa-angle-right mx-1"></i>
            관리자 페이지
        </div>
    </div>
</div>

<div id="register-fund" class="py-5">
    <div class="container">
        <div class="mt-4">
            <div class="title text-left">모집된 펀드</div>
            <div class="t-head mt-3 pb-2">
                <div class="cell-15 flex-center"><span>펀드번호</span></div>
                <div class="cell-20 flex-center"><span>펀드이름</span></div>
                <div class="cell-20 flex-center"><span>모집종료일</span></div>
                <div class="cell-15 flex-center"><span>모집금액</span></div>
                <div class="cell-15 flex-center"><span>현재금액</span></div>
                <div class="cell-15 flex-center"><span></span></div>
            </div>
            <?php foreach($funds as $fund): ?>
            <form action="/delete/fund" method="post">
                <div class="t-row">
                    <div class="cell-15 flex-center"><span><?=$fund->fund_num?></span></div>
                    <div class="cell-20 flex-center"><span><?=$fund->fund_name?></span></div>
                    <div class="cell-20 flex-center"><span><?=$fund->fund_endDate?></span></div>
                    <div class="cell-15 flex-center"><span><?=$fund->fund_total?></span></div>
                    <div class="cell-15 flex-center"><span><?=$fund->fund_current?> <small class="text-gray">(<?=$fund->fund_success?>%)</small></span></div>
                    <div class="cell-15 flex-center"><button class="blue-btn">강제 해제</button></div>
                    <input type="hidden" name="fund_num" value="<?=$fund->fund_num?>">
                </div>
            </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="toast">
    <div class="toast-header">
        <strong class="fs-1 text-blue">form 오류</strong>
        </div>
    <div class="toast-body px-3 py-5 text-blue">입력하신 정보가 양식과 일치하지 않습니다.</div>
</div>

<script src="./js/Register.js"></script>