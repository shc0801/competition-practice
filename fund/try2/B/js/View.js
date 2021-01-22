class App {
    constructor() {
        this.fund = document.querySelector("#view-fund .row");

        fetch("./js/fund.json")
        .then(res => res.json())
        .then(data => this.init(data));
    }

    init(data) {
        this.data = data;
        this.data.forEach((item, i) => {
            item.idx = i;
            item.successRate = (item.current / item.total) * 100;
            item.str_total = this.string(item.total);
            item.str_current = this.string(item.current);
        })
        this.data.forEach(item => this.addItem(item));
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
                                    <span class="flex-end text-gray">${item.number}</span>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <small class="text-gray">창업펀드명</small>
                                        <p class="ml-2 mb-0">${item.name}</p>
                                        <small>~ ${item.endDate}</small>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-gray">현재금액</small>
                                        <span class="ml-2">${item.str_current}원</span>
                                    </div>
                                    <div class="mt-2">
                                        <div class="progress w-100" style="height: 15px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated fs-n1" style="width: 100%;" aria-valuenow="${item.successRate}">loading...</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    
                                </div>
                            </div>`;
        if(new Date(item.endDate) < new Date()) {
            div.querySelector(".card-footer").innerHTML = `<button class="blue-btn w-100" data-toggle="modal" data-target="#investor-view-modal" data-id=${item.idx} value="<?=$fund->$fund_num?>">투자하기</button>`
        }

        this.fund.appendChild(div)

        div.querySelector("button").addEventListener("click", e =>{ this.modal(e) });
    }

    modal(e) {
        let id = e.target.dataset.id;
        
        let num = document.querySelector('#invest_num');
        let name = document.querySelector('#invest_name');
        let price = document.querySelector('#invest_price');
        
        num.value = this.data[id].number;
        name.value = this.data[id].name;

        console.log(num, name)

        document.querySelector("#invest_price").addEventListener("input", e => {
            e.target.value = e.target.value < 0 ? 0 : e.target.value;
        });

        let closeBtn = document.querySelector("#invest-modal button");
        closeBtn.addEventListener("click", () => { $("#invest-modal").modal("hide") });

        document.querySelector("#invest_submit").addEventListener("click", () => {
            // if(price.value == "") 
            //     $(".toast").toast
        })

        this.signature();
    }

    signature() {
        
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
    let app = new App();
}