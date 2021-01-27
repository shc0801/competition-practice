class Investor {
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
                        inv.pay += list.pay;
                        if(new Date(inv.datetime) < new Date(inv.datetime))
                            list.datetime = inv.datetime;
                        flag = false; 
                    }
                })
                if(flag)
                    this.investorList.push(list);
            })
        })
        this.investorList.forEach(item => this.addItem(item));
        this.loading();
    }

    string(item) {
        return item.toLocaleString("ko-KR");
    }

    addItem(item) {
        let div = document.createElement("div");
        div.classList.add("col-lg-4");
        div.classList.add("col-md-6");
        div.classList.add("my-3");
        div.classList.add("px-4");
        div.innerHTML = `   <div class="card">
                                <div class="card-header flex-col">
                                    <span class="flex-end text-gray">A0001</span>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <small class="text-gray">이메일</small>
                                        <span class="ml-2">${item.email}</span>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-gray">최근 투자일</small>
                                        <span class="ml-2">${item.datetime}</span>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-gray">투자금</small>
                                        <span class="ml-2">${this.string(item.pay)}원</span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="sign-btn sign-btn-<?=$i?> blue-btn w-100">투자펀드계약서</button>
                                </div>
                            </div>`;
 
        this.fund.appendChild(div);
    }

    loading() {
        setTimeout(() => {
            let progress = document.querySelectorAll(".progress-bar");
            progress.forEach((bar, i) => {
                bar.classList.remove("progress-bar-striped");
                bar.classList.remove("progress-bar-animated");
                bar.style.transition = `${this.data[i].successRate / 50}s`;
                bar.style.width = `${this.data[i].successRate}%`;
                bar.innerHTML = `${this.data[i].successRate}%`;
            })
        }, 3000);
    }
}

window.onload = function() {
    let investor = new Investor();
}