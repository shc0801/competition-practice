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
            item.successRate = (item.current / item.total) * 100;
            item.str_total = this.strting(item.total);
            item.str_current = this.strting(item.current);
        })
        this.data.forEach(item => this.addItem(item));
        this.loading();
    }
    strting(item) {
        return item.toLocaleString("ko-KR")
    }

    addItem(item) {
        let div = document.createElement("div");
        div.classList.add("col-lg-3");
        div.classList.add("col-md-6");
        div.classList.add("my-3");
        div.innerHTML =`<div class="card">
                            <div class="card-header flex-col">
                                <div class="flex-end"><span>${item.number}</span></div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <small class="text-bold">펀드이름</small>
                                    <p class="ml-2 mb-0">${item.name}</p>
                                    <small class="text-bold">~ ${item.endDate}</small>
                                </div>
                                <div class="mt-2">
                                    <small class="text-bold">현재금액</small>
                                    <p class="ml-2 mb-0">${item.str_current}원</p>
                                </div>
                                <div class="mt-2">
                                    <div class="progress" style="height: 15px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated fs-n1" style="width: 100%;" aria-valuenow="${item.successRate}">loading...</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="blue-btn w-100" data-toggle="modal" data-target="#investor-view-modal" data-id=${item.idx} >상세보기</button>
                            </div>
                        </div>`;
        this.fund.appendChild(div);
        div.querySelector("button").addEventListener("click", e => { this.modal(e) });
    }

    modal(e) {
        let id = e.target.dataset.id;
        let modal = document.querySelector("#investor-view-modal .modal-body");

        modal.innerHTML =  `<div class="title">상세보기</div>
                            <div class="mt-2">
                                <small class="text-gray">번호</small>
                                <p class="ml-2 mb-0">${this.data[id].number}</p>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">펀드명</small>
                                <p class="ml-2 mb-0">${this.data[id].name}</p>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">창업자명</small>
                                <p class="ml-2 mb-0">${this.data[id].owner}</p>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">모집마감일</small>
                                <p class="ml-2 mb-0">${this.data[id].endDate}</p>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">투자자 리스트</small>
                                <div class="investor pt-1 pl-4" style="max-height: 450px; height: auto; overflow-y: scroll;">
                                    
                                </div>
                            </div>`;
        this.data[id].investorList.forEach(list => {
            let div = document.createElement("div");
            div.classList.add("mt-2");
            div.classList.add("pr-2");
            div.classList.add("pb-2");
            div.classList.add("border-bottom");
            div.innerHTML =    `<div>
                                    <small class="text-gray">이메일</small>
                                    <span class="ml-2">${list.email}</span>
                                </div>
                                <div class="mt-2">
                                    <small class="text-gray">투자금액</small>
                                    <span class="ml-2">${list.pay}</span>
                                </div>
                                <div class="mt-2">
                                    <small class="text-gray">투자시간</small>
                                    <span class="ml-2">${list.datetime}</span>
                                </div>`;
            modal.querySelector(".investor").appendChild(div);
        })
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

window.addEventListener("load", () =>{
    let app = new App;
})