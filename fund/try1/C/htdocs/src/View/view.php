<?php
// var_dump($funds);
?>
<div id="sub-visual" class="position-relative">
    <div class="w-100 h-100 navigation-image">
        <img class="background-image" src="./images/sample10.jpg" alt="">
    </div>
    <div class="pos-center text-center">
        <div class="fs-9 text-white lighter">펀드보기</div>
        <div class="fs-n1 text-white lighter mt-2">
            킥스타터 펀드
            <i class="fa fa-angle-right mx-1"></i>
            메인페이지
            <i class="fa fa-angle-right mx-1"></i>
            펀드보기
        </div>
    </div>
</div>

<div id="view-fund" class="py-5">
    <div class="container">
        <div class="header flex-col-center">
            <i class="fa fa-user"></i>
            <h2 class="bold">fund <span>View</span></h2>
            <p>다른 펀드들은 어떨까요?</p>
        </div>
        <div class="row">
            <?php foreach($funds->data as $i=>$fund): ?>
            <div class="col-lg-4 col-md-6 my-3 px-4">
                <div class="card">
                    <div class="card-header flex-col">
                        <span class="text-gray flex-end"><?=$fund->fund_num?></span>
                    </div>
                    <div class="card-body">
                        <div>
                            <small class="text-gray">창업펀드명</small>
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
                    <?php if(user()): ?>
                    <div class="card-footer flex-center">
                        <?php if($fund->fund_success >= 100) { ?>
                        <form class="w-100 py-0 px-0 blue-btn text-center" action="/insert/business" method="post">
                            <button class="w-100 blue-btn" href="#">완료</button>
                            <input type="hidden" name="fund_num" value="<?=$fund->fund_num?>">
                            <input type="hidden" name="fund_name" value="<?=$fund->fund_name?>">
                        </form>
                        <?php } else { ?>
                        <button class="w-100 blue-btn" data-toggle="modal" data-target="#invest-modal" data-num="<?=$fund->fund_num?>" data-name="<?=$fund->fund_name?>">투자하기</button>
                        <?php } ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-4 flex-center">
            <a href="/view?page=<?=$funds->startPage - 1?>" class="blue-btn py-2 px-3" <?=!$funds->prev ? "disabled" : ""?>>
                <i class="fa fa-angle-left"></i>
            </a>
            <?php for($i = $funds->startPage; $i <= $funds->endPage; $i++): ?>
                <a href="/view?page=<?=$i?>" class="btn-filled py-2 px-3">
                    <?=$i?>
                </a>
            <?php endfor; ?>
            <a href="/view?page=<?=$funds->endPage + 1?>" class="blue-btn py-2 px-3" <?=!$funds->next ? "disabled" : ""?>>
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
</div>

<div id="invest-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body px-4 py-5">
                <form action="/insert/invest" method="post">
                    <div class="title">투자펀딩계약서</div>
                    <input type="hidden" id="invest_num" name="invest_num">
                    <input type="hidden" id="invest_name" name="invest_name">
                    <div class="form-group">
                        <label for="invest_user">투자자명</label>
                        <input type="text" name="user_name" id="invest_user" class="form-control" value="<?=user()->user_name?>" placeholder="<?=user()->user_name?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="invest_price">투자금액</label>
                        <input type="number" name="fund_price" id="invest_price" class="form-control" placeholder="투자하실 금액을 입력하세요" required>
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="invest_price">서명란</label>
                            <select id="thick" class="form-control mb-2" aria-placeholder="두께를 선택하세요">
                                <option value="1">1pt</option>
                                <option value="2">2pt</option>
                                <option value="3">3pt</option>
                                <option value="4">4pt</option>
                            </select>
                        </div>
                        <canvas width="450" height="150"></canvas>
                        <input type="hidden" name="sign" id="invest_sign">
                    </div>
                    <div class="form-group">
                        <input type="submit" id="invest_submit" value="투자" class="form-control">
                    </div>
                </form>
                <div class="form-group">
                    <button class="blue-btn w-100" data-bs-dismiss="modal">취소</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toast">
    <div class="toast-header">
        <strong class="fs-1 text-blue">form 오류</strong>
        </div>
    <div class="toast-body px-3 py-5 text-blue">입력하신 정보가 양식과 일치하지 않습니다.</div>
</div>

<script src="/js/View.js"></script>

<script>
    $(function(){
        $("[data-target='#invest-modal']").on("click", function(){
            $("#invest_num").val(this.dataset.num);
            $("#invest_name").val(this.dataset.name);
        });

        $("#invest-modal form").on("submit", e => {
            e.preventDefault();
        }); 

        $("#invest_submit").on("click", function(){
            let canvas = document.querySelector("canvas");
            let imgDataUrl = canvas.toDataURL('image/png');
            
            $("#invest_sign").val(imgDataUrl);

            let price = document.querySelector("#invest_price");

            if(price.value == "") {
                alert("누락된 항목이 있습니다.");
                return;
            }

            let c_canvas = document.createElement("canvas");
            c_canvas.width = 450;
            c_canvas.height = 150;

            if(c_canvas.toDataURL('image/png') == imgDataUrl) {
                alert("서명란에 서명해주세요");
                return;
            }

            $("#invest-modal form")[0].submit();
        });
    });
</script>