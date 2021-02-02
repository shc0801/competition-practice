class App {
    constructor() {
        this.fund = document.querySelector("#best-fund .row");

        fetch("./js/fund.json")
        .then(res => res.json())
        .then(data => this.init(data));
    }

    init(data) {
        this.data = data;
        this.data.forEach((item, i) => {
            item.idx = i;
            item.sub_total = this.string(item.total);
            item.sub_current = this.string(item.current);
            item.successRate = (item.current / item.total) * 100;
            console.log(item.successRate)
        });
        this.data.forEach(item => this.addItem(item));

        this.loading();
    }

    addItem(item) {
        let div = document.createElement("div");
        div.classList.add("col-lg-3");
        div.classList.add("col-md-6");
        div.classList.add("my-3");
        div.innerHTML =    `<div class="card">
                                            <div class="card-header flex-col">
                                                <span class="flex-end">${item.number}</span>
                                            </div>
                                            <div class="card-body">
                                                <div>
                                                    <small class="text-gray">펀드이름</small>
                                                    <p class="ml-2 mb-0">${item.name}</p>
                                                    <small class="text-gray">~ ${item.endDate}</small>
                                                </div>
                                                <div class="mt-2">
                                                    <small class="text-gray">현재금액</small>
                                                    <span class="mb-0">${item.sub_current}원</span>
                                                </div>
                                                <div class="mt-2">
                                                    <div class="progress" style="height: 15px;">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%;" aria-valuenow="${item.successRate}">loading...</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button class="blue-btn w-100" data-toggle="modal" data-target="#investor-view-modal" data-id = ${item.idx}>상세보기</button>
                                            </div>
                                        </div>`;
            div.querySelector("button").addEventListener("click", (e) => { this.modal(e) })
            this.fund.appendChild(div)
    }

    modal(e) {
        let id = e.target.dataset.id;
        let modal = document.querySelector("#investor-view-modal .modal-body");
        console.log(modal)
        modal.innerHTML =   `<div class="title">상세보기</div>
                                                <div class="mt-2">
                                                    <small class="text-gray">펀드번호</small>
                                                    <p class="ml-2 mb-0">${this.data[id].number}</p>
                                                </div>
                                                <div class="mt-2">
                                                    <small class="text-gray">펀드이름</small>
                                                    <p class="ml-2 mb-0">${this.data[id].name}</p>
                                                </div>
                                                <div class="mt-2">
                                                    <small class="text-gray">모집금액</small>
                                                    <p class="ml-2 mb-0">${this.data[id].endDate}</p>
                                                </div>
                                                <div class="mt-2">
                                                    <small class="text-gray">투자자목록</small>
                                                    <div class="pl-4 pt-1 investor" style="max-height: 450px; height: auto; overflow-y: scroll;">
                                                        
                                                    </div>
                                                </div>`;
        this.data[id].investorList.forEach(list => {
            let div = document.createElement("div");
            div.classList.add("mt-3");
            div.classList.add("pb-2");
            div.classList.add("border-bottom");
            div.innerHTML=` <div>
                                            <small class="text-gray">이메일</small>
                                            <span class="ml-2 mb-0">${list.email}</span>
                                        </div>
                                        <div>
                                            <small class="text-gray">투자금액</small>
                                            <span class="ml-2 mb-0">${list.pay}</span>
                                        </div>
                                        <div>
                                            <small class="text-gray">투자일시</small>
                                            <span class="ml-2 mb-0">${list.datetime}</span>
                                        </div>`
            modal.querySelector(".investor").appendChild(div);
        })
    }

    string(item) {
        return item.toLocaleString("ko-KR");
    }

    getXY({pageX, pageY}) {
        let { left, top } = this.canvas.offset();
        let { width, height } = this.canvas[0];

        let x = pageX - left;
        x = x > width ? width : x < 0 ? 0 : x;
        
        let y = pageY - top;
        y = y > height ? height : y < 0 ? 0 : y;
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
        }, 3000)
    }
}

window.onload = function() {
    let app = new App();
}