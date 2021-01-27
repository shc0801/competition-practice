class App {
    constructor() {
        this.fund = document.querySelector("#investor-fund .row");

        this.investorList = [];

        fetch("./js/fund.json")
        .then(res => res.json())
        .then(data => this.init(data));
    }

    init(data) {
        data.forEach(item => {
            item.investorList.forEach(inv => {
                let flag = true;
                this.investorList.forEach(list => {
                    if(list.email == inv.email) {
                        list.pay += inv.pay;
                        if(new Date(list.datetime) < new Date(inv.datetime)) {
                            list.datetime = inv.datetime;
                        }
                        flag = false;
                    }
                })
                if(flag) {
                    this.investorList.push(inv);
                }
            })
        })
        this.investorList.sort(function(a, b) {
            if(new Date(a.datetime) < new Date(b.datetime))
                return 1;
            else if(new Date(a.datetime) > new Date(b.datetime)) 
                return -1;
            else 
                return 0
        })
        this.investorList.forEach(item => this.addItem(item));
    }

    addItem(item) {
        let div = document.createElement("div");
        div.classList.add("col-lg-4");
        div.classList.add("col-md-6");
        div.classList.add("my-3");
        div.classList.add("px-3");
        div.innerHTML = `<div class="card">
                            <div class="card-header flex-col">
                                <div class="flex-end"><span>A0001</span></div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <small class="text-bold">이메일</small>
                                    <p class="ml-2 mb-0">${item.email}</p>
                                </div>
                                <div class="mt-2">
                                    <small class="text-bold">최근 투자일</small>
                                    <p class="ml-2 mb-0">${item.datetime}</p>
                                </div>
                                <div class="mt-2">
                                    <small class="text-bold">투자금액</small>
                                    <p class="ml-2 mb-0">${item.pay}원</p>
                                </div>
                            </div>
                            <div class="card-footer flex-center">
                                <button class="sign-btn sign-btn-<?=$i?> blue-btn w-100">투자펀드계약서</button>
                                <input type="hidden" name="fund_num" id="fund_num" value="<?=$fund->fund_num?>">
                                <input type="hidden" name="fund_name" id="fund_name" value="<?=$fund->fund_name?>">
                                <input type="hidden" name="name" id="name" value="<?=$fund->name?>">
                                <input type="hidden" name="pay" id="pay" value="<?=$fund->pay?>">
                                <input type="hidden" name="money" id="money" value="<?=$fund->money?>">
                            </div>
                        </div>`;
        this.fund.appendChild(div);
    }
}

window.onload = function() {
    let app = new App();
}