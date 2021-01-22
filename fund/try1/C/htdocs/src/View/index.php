<div id="visual" class="background">
    <div class="visual-text">
        <h3 class="text-dblue">킥스타터 펀드</h3>
        <p class="lighter pt-2 pb-3">바쁜 일상에도 내 자산을 불려주는 가장 쉬운 재테크, 자본이 필요하다면<br>
        <span class="text-blue fs-1">킥스타터 펀드</span>에서 미래의 발판을 만들어보세요</p>
        <button class="blue-btn fs-1">시작하기</button>
    </div>
</div>

<div id="best-fund" class="py-5">
    <div class="container">
        <div class="header flex-col-center">
            <i class="fa fa-bar-chart"></i>
            <h2 class="bold">best <span>Fund</span></h2>
            <p>어떤 펀드가 가장 좋을까요?</p>
        </div>
        <div class="row">
            <?php foreach($funds as $fund): ?>
            <form action="/detail" method="post" class="col-lg-3 col-md-6 my-3">
                <div class="card">
                    <div class="card-header">
                        <span class="flex-end text-gray"><?=$fund->fund_num?></span>
                    </div>
                    <div class="card-body">
                        <div>
                            <small class="text-gray">펀드이름</small>
                            <p class="ml-2 mb-0"><?=$fund->fund_name?></p>
                            <small class="text-gray"> ~ <?=$fund->fund_endDate?></small> <br>
                        </div>
                        <div class="mt-2">
                            <small class="text-gray">현재금액</small>
                            <span class="ml-2"><?=$fund->fund_current?>원</span>
                            <small class="text-gray">( <?=$fund->fund_success?>% )</small>
                        </div>
                        <div class="progress w-100 mt-2" style="height: 15px;">
                            <div class="progress-bar fs-n1" style="width: <?=$fund->fund_success?>%;" aria-valuenow="<?=$fund->fund_success?>" aria-valuemin="0" aria-valuemax="100"><?=$fund->fund_success?>%</div>
                        </div>
                    </div>
                    <div class="card-footer flex-center">
                        <button class="w-100 blue-btn">상세보기</button>
                        <input type="hidden" name="fund_num" value="<?=$fund->fund_num?>">
                    </div>
                </div>
            </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>