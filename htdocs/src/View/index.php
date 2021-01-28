<div id="visual" class="background">
    <div class="visual-text">
        <h3>킥스타터 펀드</h3>
        <p>바쁜 일상에도 내 자산을 불려주는 가장 쉬운 재테크, 자본이 부족하다면<br>
            킥스타터 펀드에서 미래를 위한 발판을 마련하세요
        </p>
        <button class="blue-btn fs-1">시작하기</button>
    </div>
</div>

<div id="best-fund" class="py-5">
    <div class="container">
        <div class="header flex-col-center">
            <i class="fa fa-bar-chart"></i>
            <h2>best <span>Fund</span></h2>
            <p>어떤 펀드가 가장 좋을까요?</p>
        </div>
        <div class="row">
            <?php foreach($funds as $fund): ?>
            <div class="col-lg-3 col-md-6 my-3">
                <div class="card">
                    <div class="card-header flex-col">
                        <div class="flex-end"><span><?=$fund->fund_num?></span></div>
                    </div>
                    <div class="card-body">
                        <div>
                            <small class="text-bold">펀드이름</small>
                            <p class="ml-2 mb-0"><?=$fund->fund_name?></p>
                            <small class="text-bold">~ <?=$fund->fund_endDate?></small>
                        </div>
                        <div class="mt-2">
                            <small class="text-bold">현재금액</small>
                            <p class="ml-2 mb-0"><?=$fund->fund_current?>원</p>
                        </div>
                        <div class="mt-2">
                            <div class="progress" style="height: 15px;">
                                <div class="progress-bar fs-n1" style="width: <?=$fund->fund_success?>%;" aria-valuenow="<?=$fund->fund_success?>"><?=$fund->fund_success?>%</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="/detail" method="post">
                            <button class="blue-btn w-100" data-toggle="modal" data-target="#investor-view-modal">상세보기</button>
                            <input type="hidden" name="fund_num" value=<?=$fund->fund_num?>>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div id="investor-view-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body px-4 py-5">
                <div class="title">상세보기</div>
                <div class="mt-2">
                    <small class="text-gray">번호</small>
                    <p class="ml-2 mb-0"></p>
                </div>
                <div class="mt-2">
                    <small class="text-gray">펀드명</small>
                    <p class="ml-2 mb-0"></p>
                </div>
                <div class="mt-2">
                    <small class="text-gray">창업자명</small>
                    <p class="ml-2 mb-0"></p>
                </div>
                <div class="mt-2">
                    <small class="text-gray">모집마감일</small>
                    <p class="ml-2 mb-0"></p>
                </div>
                <div class="mt-2">
                    <small class="text-gray">투자자 리스트</small>
                    <div class="investor pt-1 pl-4" style="max-height: 450px; height: auto; overflow-y: scroll;">
                        <div>
                            <small class="text-gray">이메일</small>
                            <p class="ml-2 mb-0"></p>
                        </div>
                        <div class="mt-2">
                            <small class="text-gray">투자금액</small>
                            <p class="ml-2 mb-0"></p>
                        </div>
                        <div class="mt-2">
                            <small class="text-gray">투자시간</small>
                            <p class="ml-2 mb-0"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>