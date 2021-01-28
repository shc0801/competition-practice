
<div id="sub-visual">
    <div class="sub-visual-image">
        <img class="background-image" src="./images/sample10.jpg" alt="image">
        <div class="pos-center text-center text-white lighter">
            <div class="fs-9">프로필페이지</div>
            <div class="fs-1 my-2">
                킥스타터
                <i class="fa fa-angle-right mx-1"></i>
                메인페이지
                <i class="fa fa-angle-right mx-1"></i>
                프로필페이지
            </div>
        </div>
    </div>
</div>

<div id="view-fund" class="py-5">
    <div class="container">
        <div class="mt-4">
            <div class="title text-left">펀드정보</div>
            <div class="t-head">
                <div class="cell-20"><span>펀드번호</span></div>
                <div class="cell-20"><span>펀드이름</span></div>
                <div class="cell-20"><span>모집마감일</span></div>
                <div class="cell-20"><span>모집금액</span></div>
                <div class="cell-20"><span>현재금액</span></div>
            </div>
            <div class="t-row">
                <div class="cell-20"><span><?=$fund->fund_num?></span></div>
                <div class="cell-20"><span><?=$fund->fund_name?></span></div>
                <div class="cell-20"><span><?=$fund->fund_endDate?></span></div>
                <div class="cell-20"><span><?=$fund->fund_total?>원</span></div>
                <div class="cell-20"><span><?=$fund->fund_current?>원</span></div>
            </div>
        </div>
        <div class="mt-4">
            <div class="title text-left">투자자 목록</div>
            <div class="t-head">
                <div class="cell-20"><span>투자자 이름</span></div>
                <div class="cell-20"><span>투자자 이메일</span></div>
                <div class="cell-30"><span>투자금액</span></div>
                <div class="cell-30"><span>투자일시</span></div>
            </div>
            <?php foreach($investors as $investor): ?>
            <form action="/investor/profile">
                <input type="hidden" name="investor_email" value="<?=$investor->email?>">
                <div class="t-row">
                    <div class="cell-20"><span><?=$investor->name?></span></div>
                    <div class="cell-20"><span><?=$investor->email?></span></div>
                    <div class="cell-30"><span><?=$investor->pay?></span></div>
                    <div class="cell-30"><span><?=$investor->datetime?></span></div>
                </div>
            </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>