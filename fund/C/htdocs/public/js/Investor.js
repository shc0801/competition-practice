class Investor {
    constructor() {
        this.investorFind = document.querySelector("#investor-fund .row");

        this.investorList = [];

        fetch("./js/fund.json")
        .then(res => res.json())
        .then(data => this.init(data));
    }

    init(data) {
        data.forEach((item, i) => {
            item.investorList.forEach(inv => {
                let flag = true;
                this.investorList.forEach(list => {
                    if(list.email == inv.email) {
                        list.pay += inv.pay;
                        if(new Date(list.datetime) < new Date(inv.datetime)) 
                            list.datetime = inv.datetime;
                        flag = false;
                    }
                })
                if(flag)
                    this.investorList.push(inv);
            })
        }); 
        this.investorList.forEach(item => this.addItem(item));

        this.addEvent();
    }

    addEvent() {

    }

    addItem(item) {
        let div = document.createElement("div");
        div.classList.add("col-lg-4");
        div.classList.add("col-md-6");
        div.classList.add("my-3");
        div.classList.add("px-4");
        
        div.innerHTML =    `<div class="card">
                                <div class="card-header flex-col">
                                </div>
                                <div class="card-body">
                                    <div class="mt-2">
                                        <small class="text-gray">이메일</small>
                                        <span class="ml-2">${item.email}원</span>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-gray">최근 투자일</small>
                                        <span class="ml-2">${item.datetime}</span>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-gray">투자금</small>
                                        <span class="ml-2">${item.pay}원</span>
                                    </div>
                                </div>
                                <div class="card-footer flex-center">
                                    
                                </div>
                            </div>`;

        this.investorFind.appendChild(div);
    }

    loading() {
        setTimeout(() => {
            let progress = document.querySelectorAll(".progress-bar");
            progress.forEach((bar, i) => {
                bar.classList.remove("progress-bar-striped");
                bar.classList.remove("progress-bar-animated");
                bar.style.transition = `${this.data[i].successRate / 50}s`;
                bar.style.width = `${this.data[i].successRate}px`;
                bar.innerHTML = `${this.data[i].successRate}%`;
            })
        }, 3000);
    }
}

window.addEventListener("load", () => {
    let investor = new Investor();
})