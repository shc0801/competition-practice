
    <div id="visual" class="background">
        <div class="visual-text">
            <h3>킥스타터 펀드</h3>
            <p>내 자산을 불리기 쉬운 가장 편한 재테크, 자본이 부족하다면<br>
                    킥스타터 펀드에서 미래를 위한 발판을 마련해보세요</p>
            <button class="blue-btn">시작하기</button>
        </div>
    </div>
    
    <div id="best-fund" class="py-5">
        <div class="container">
            <div class="header flex-col-center">
                <i class="fa fa-bar-chart"></i>
                <h2>view <span>Fund</span></h2>
                <p>어떤 펀드가 가장 좋을까요?</p>
            </div>
            <div class="row py-3">
                    <?php foreach($funds as $fund): ?>
                <div class="col-lg-3 col-md-6 my-3">
                    <div class="card">
                        <div class="card-header flex-col">
                            <span class="flex-end"><?=$fund->fund_num?></span>
                        </div>
                        <div class="card-body">
                            <div>
                                <small class="text-gray">펀드이름</small>
                                <p class="ml-2 mb-0"><?=$fund->fund_name?></p>
                                <small class="text-gray">~ <?=$fund->fund_endDate?></small>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">현재금액</small>
                                <span class="mb-0"><?=$fund->fund_current?>원</span>
                            </div>
                            <div class="mt-2">
                                <div class="progress" style="height: 15px;">
                                    <div class="progress-bar" style="width: <?=$fund->fund_success?>%;" aria-valuenow=<?=$fund->fund_success?>><?=$fund->fund_success?>%</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <form action="/detail" method="post">
                                <input type="hidden" name="fund_num" value="<?=$fund->fund_num?>">
                                <button class="blue-btn w-100">상세보기</button>
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
                    
                </div>
            </div>
        </div>
    </div>