<div id="sub-visual">
    <div class="sub-visual-image">
        <img class="background-image" src="./images/sample10.jpg" alt="image">
        <div class="pos-center text-center text-white lighter">
            <div class="fs-9">투자자목록</div>
            <div class="fs-1 my-2">
                킥스타터
                <i class="fa fa-angle-right mx-1"></i>
                메인페이지
                <i class="fa fa-angle-right mx-1"></i>
                투자자목록
            </div>
        </div>
    </div>
</div>

<div id="investor-fund" class="py-5">
    <div class="container">
        <div class="header flex-col-center">
            <i class="fa fa-bar-chart"></i>
            <h2>investor <span>View</span></h2>
            <p>다른 투자자분들은 어떨까요?</p>
        </div>
        <div class="flex-col">
            <form action="/investor" id="order-form" class="flex-end">
                <select name="order" id="order">
                    <option value="datetime">최근등록</option>
                    <option value="fund_name">펀드별</option>
                    <option value="name">개인별</option>
                </select>
            </form>
        </div>
        <div class="row">
        </div>
        <div class="mt-4 flex-center">
            <a class="py-2 px-3 blue-btn" href="#">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="py-2 px-3 btn-filled" href="#">
                1
            </a>
            <a class="py-2 px-3 blue-btn" href="#">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
</div>