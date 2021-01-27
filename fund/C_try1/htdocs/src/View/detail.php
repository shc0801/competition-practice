<div id="sub-visual" class="position-relative">
    <div class="w-100 h-100 navigation-image">
        <img class="background-image" src="/images/sample10.jpg" alt="">
    </div>
    <div class="pos-center text-center">
        <div class="fs-9 text-white lighter">상세보기 페이지</div>
        <div class="fs-n1 text-white lighter mt-4">
            킥스타터 펀드
            <i class="fa fa-angle-right mx-1"></i>
            메인페이지
            <i class="fa fa-angle-right mx-1"></i>
            상세보기 페이지
        </div>
    </div>
</div>

<div id="register-fund" class="py-5">
    <div class="container">
        <div class="mt-4">
            <div class="title text-left">상세 정보</div>
            <div class="t-head mt-3 pb-2">
                <div class="cell-20 flex-center"><span>펀드번호</span></div>
                <div class="cell-20 flex-center"><span>펀드이름</span></div>
                <div class="cell-20 flex-center"><span>모집종료일</span></div>
                <div class="cell-20 flex-center"><span>모집금액</span></div>
                <div class="cell-20 flex-center"><span>현재금액</span></div>
            </div>
            <form action="/delete/fund" method="post">
                <div class="t-row">
                    <div class="cell-20 flex-center"><span><?=$fund->fund_num?></span></div>
                    <div class="cell-20 flex-center"><span><?=$fund->fund_name?></span></div>
                    <div class="cell-20 flex-center"><span><?=$fund->fund_endDate?></span></div>
                    <div class="cell-20 flex-center"><span><?=$fund->fund_total?></span></div>
                    <div class="cell-20 flex-center"><span><?=$fund->fund_current?> <small class="text-gray">(<?=$fund->fund_success?>%)</small></span></div>
                </div>
            </form>
        </div>
        <div class="mt-4">
            <div class="title text-left">투자자 정보</div>
            <div class="t-head mt-3 pb-2">
                <div class="cell-20 flex-center"><span>투자자 이름</span></div>
                <div class="cell-20 flex-center"><span>투자자 이메일</span></div>
                <div class="cell-30 flex-center"><span>투자금액</span></div>
                <div class="cell-30 flex-center"><span>투자시간</span></div>
            </div>
            <?php foreach($investors as $investor): ?>
            <form action="/investor/profile">
                <input type="hidden" name="investor_email" value="<?=$investor->email?>">
                <div class="t-row">
                    <div class="cell-20 flex-center"><button style="border: none; background: none;"><?=$investor->name?></button></div>
                    <div class="cell-20 flex-center"><span><?=$investor->email?></span></div>
                    <div class="cell-30 flex-center"><span><?=$investor->pay?>원</span></div>
                    <div class="cell-30 flex-center"><span><?=$investor->datetime?></span></div>
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