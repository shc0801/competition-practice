<div id="sub-visual" class="position-relative">
    <div class="w-100 h-100 navigation-image">
        <img class="background-image" src="/images/sample10.jpg" alt="">
    </div>
    <div class="pos-center text-center">
        <div class="fs-9 text-white lighter">투자자보기</div>
        <div class="fs-n1 text-white lighter mt-2">
            킥스타터 펀드
            <i class="fa fa-angle-right mx-1"></i>
            메인페이지
            <i class="fa fa-angle-right mx-1"></i>
            투자자보기
        </div>
    </div>
</div>

<div id="investor-fund" class="py-5">
    <div class="container">
        <div class="header flex-col-center">
            <i class="fa fa-user"></i>
            <h2 class="bold">investor <span>View</span></h2>
            <p>다른 투자자 분들은 어떨까요?</p>
        </div>
        <div class="mt-2 flex-col">
            <form action="/investor" id="order-form" class="flex-end">
                <select name="order" id="order">
                    <?php if($order == "fund_name"){ ?>
                    <option value="fund_name">펀드별</option>
                    <option value="name">개인별</option>
                    <option value="datetime">최근등록</option>
                    <?php } else if($order == "name") { ?>
                    <option value="name">개인별</option>
                    <option value="fund_name">펀드별</option>
                    <option value="datetime">최근등록</option>
                    <?php } else { ?>
                    <option value="datetime">최근등록</option>
                    <option value="fund_name">펀드별</option>
                    <option value="name">개인별</option>
                    <?php } ?>
                </select>
            </form>
        </div>
        <div class="row">
            <?php foreach($investors->data as $i=>$investor): ?>
            <div class="col-lg-4 col-md-6 px-4 my-3">
                <div class="card">
                    <div class="card-header">
                        <?=$investor->fund_name?>
                    </div>
                    <div class="card-body">
                        <form action="/investor/profile">
                            <input type="hidden" name="investor_email" value="<?=$investor->email?>">
                            <div class="mt-2">
                                <small class="text-gray">이메일</small>
                                <span class="ml-2"><?=$investor->email?></span>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">이름</small>
                                <span class="ml-2"><button style="border: none; background: none;"><?=$investor->name?></button></span>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">최근 투자일</small>
                                <span class="ml-2"><?=$investor->datetime?></span>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">투자금</small>
                                <span class="ml-2"><?=$investor->pay?>원</span>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer flex-center">
                        <button class="sign-btn sign-btn-<?=$i?> w-100 blue-btn">투자펀드계약서</button>
                        <input type="hidden" name="fund_num" class="fund_num" value="<?=$investor->fund_num?>">
                        <input type="hidden" name="fund_name" class="fund_name" value="<?=$investor->fund_name?>">
                        <input type="hidden" name="name" class="name" value="<?=$investor->name?>">
                        <input type="hidden" name="pay" class="pay" value="<?=$investor->pay?>">
                        <input type="hidden" name="sign" class="sign" value="<?=$investor->sign?>">
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-4 flex-center">
            <a href="/view?page=<?=$investors->startPage - 1?>" class="blue-btn py-2 px-3" <?=!$investors->prev ? "disabled" : ""?>>
                <i class="fa fa-angle-left"></i>
            </a>
            <?php for($i = $investors->startPage; $i <= $investors->endPage; $i++): ?>
                <a href="/view?page=<?=$i?>" class="btn-filled py-2 px-3">
                    <?=$i?>
                </a>
            <?php endfor; ?>
            <a href="/view?page=<?=$investors->endPage + 1?>" class="blue-btn py-2 px-3" <?=!$investors->next ? "disabled" : ""?>>
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
</div>

<script>
    let order = $("#order").on("input", function() {
        $("#order-form")[0].submit();
    })

    let button = document.querySelectorAll(".sign-btn");
    button.forEach(btn => {
        btn.addEventListener("click", (e) => {
            let canvas = document.createElement("canvas");
            let ctx = canvas.getContext("2d");
            canvas.width = 793;
            canvas.height = 495;

            let fundNum = document.querySelector(`.${e.target.classList[1]} ~ .fund_num`).value;
            let fundName = document.querySelector(`.${e.target.classList[1]} ~ .fund_name`).value;
            let userName = document.querySelector(`.${e.target.classList[1]} ~ .name`).value;
            let pay = document.querySelector(`.${e.target.classList[1]} ~ .pay`).value;
            let dataUrl = document.querySelector(`.${e.target.classList[1]} ~ .sign`).value;
            
            let fundImage = new Image();
            fundImage.src = "/images/funding.png";

            fundImage.onload = function() {
                ctx.drawImage(fundImage, 0, 0);

                let signImage = new Image();
                signImage.src = dataUrl;
                
                signImage.onload = function() {
                    ctx.drawImage(signImage, 343, 345);
                    ctx.font = "30px '맑은 고딕'";
                    ctx.fillText(fundNum, 343, 180);
                    ctx.fillText(fundName, 343, 230);
                    ctx.fillText(userName, 343, 270);
                    ctx.fillText(pay + "원", 343, 320);

                    let a = document.createElement("a");
                    a.href = canvas.toDataURL('image/png');
                    a.download = "sign.png";
                    a.click();
                }

            } 

        })
    })
</script>