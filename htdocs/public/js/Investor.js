class App {
    constructor() {
        this.fund = document.querySelector("#investor-fund .row");

        this.investorList = [];

        fetch("./js/fund.json")
        .then(res => res.json())
        .then(data => this.init(data));
    }

    init(data) {
        this.data = data;
        this.data.forEach((item, i) => {
            item.investorList.forEach(list => {
                let flag = true;
                this.investorList.forEach(inv => {
                    if(inv.email == list.email) {
                        inv.pay+=list.pay;
                        if(new Date(inv.datetime) < new Date(list.datetime)) {
                            inv.datetime = list.datetime;
                        }
                        flag = false;
                    }
                })
                if(flag)
                    this.investorList.push(list); 
            })
        })
        this.investorList.sort(function(a, b) {
            if(new Date(a.datetime) < new Date(b.datetime))
                return 1
            else if(new Date(a.datetime) > new Date(b.datetime))
                return -1 
            return 0;
        })
        this.investorList.forEach(item => this.addItem(item));
        this.loading();
    }
    strting(item) {
        return item.toLocaleString("ko-KR")
    }

    addItem(item) {
        let div = document.createElement("div");
        div.classList.add("col-lg-4");
        div.classList.add("col-md-6");
        div.classList.add("my-3");
        div.classList.add("px-4");
        div.innerHTML =`<div class="card">
                            <div class="card-body">
                                <div>
                                    <small class="text-bold">이메일</small>
                                    <span class="ml-2 mb-0">${item.email}</span>
                                </div>
                                <div class="mt-2">
                                    <small class="text-bold">최근 투자일</small>
                                    <span class="ml-2 mb-0">${item.datetime}</span>
                                </div>
                                <div class="mt-2">
                                    <small class="text-bold">투자금액</small>
                                    <span class="ml-2 mb-0">${item.pay}원</span>
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

window.addEventListener("load", () =>{
    let app = new App;
})