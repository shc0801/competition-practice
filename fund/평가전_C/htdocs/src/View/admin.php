<?php use App\DB; ?>

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
    <div class="container"><div class="mt-4">
            <div class="title text-left">유저</div>
            <div class="t-head mt-3 pb-2">
                <div class="cell-25 flex-center"><span>유저이메일</span></div>
                <div class="cell-25 flex-center"><span>유저이름</span></div>
                <div class="cell-20 flex-center"><span>보유금액</span></div>
                <div class="cell-30 flex-center"><span></span></div>
            </div>
            <?php foreach($users as $user): ?>
            <?php if($user->user_email !="admin"): ?>
            <div class="t-row">
                <div class="cell-25 flex-center"><span><?=$user->user_email?></span></div>
                <div class="cell-25 flex-center"><span><?=$user->user_name?></span></div>
                <div class="cell-20 flex-center"><span><?=$user->money?></span></div>
                <div class="cell-30 flex-center">
                    <form action="/delete/user" method="post">
                        <button class="blue-btn mx-2">회원탈퇴</button>
                        <input type="hidden" name="user_email" value="<?=$user->user_email?>">
                    </form>
                    <button id="give" class="blue-btn mx-2" data-toggle="modal" data-target="#give-modal" data-email="<?=$user->user_email?>">금액추가</button>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="mt-5">
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
        <div class="mt-5">
            <div class="title text-left">진행중인 사업</div>
            <div class="t-head mt-3 pb-2">
                <div class="cell-25 flex-center"><span>사업번호</span></div>
                <div class="cell-25 flex-center"><span>펀드이름</span></div>
            </div>
            <?php foreach($business as $fund): ?>
            <div class="t-row">
                <div class="cell-25 flex-center"><span><?=$fund->id?></span></div>
                <div class="cell-25 flex-center"><span><?=$fund->business_name?></span></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div id="give-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body px-4 py-5">
                <form action="/insert/user/money" method="post">
                    <div class="title">금액추가</div>
                    <input type="hidden" name="user_email" id="user_email">
                    <div class="form-group mt-4">
                        <label for="money">추가할 금액</label>
                        <input type="number" name="money" id="money" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button id="give-btn" class="blue-btn w-100">주기</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="toast-container">

</div>

<script src="/js/Admin.js"></script>
