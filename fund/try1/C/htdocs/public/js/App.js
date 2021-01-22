class App {
    constructor() {
        this.bestFind = document.querySelector("#best-fund .row");

        fetch("./js/fund.json")
        .then(res => res.json())
        .then(data => this.init(data));
    }

    init(data) {
        this.data = data;
        this.data.forEach((item, i) => {
            item.idx = i;
            item.successRate = (item.current / item.total) * 100;
        }); 
        this.data.forEach(item => this.addItem(item));
        this.loading();

        this.addEvent();
    }

    addEvent() {

    }

    addItem(item) {
        let div = document.createElement("div");
        div.classList.add("col-lg-3");
        div.classList.add("col-md-6");
        div.classList.add("my-3");
        console.log(item)
        
        div.innerHTML =   `<div class="card">
                                <div class="card-header"></div>
                                <div class="card-body">
                                    <div>
                                        <small class="text-gray">펀드이름</small>
                                        <p class="ml-2 mb-0">${item.name}</p>
                                        <small class="text-gray"> ~ ${item.endDate}</small> <br>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-gray">현재금액</small>
                                        <span class="ml-2">${item.current}원</span>
                                        <small class="text-gray">( ${item.successRate}% )</small>
                                    </div>
                                    <div class="progress w-100 mt-2" style="height: 15px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated fs-n1" style="width: 100%;" aria-valuenow="${item.successRate}" aria-valuemin="0" aria-valuemax="100">loding...</div>
                                    </div>
                                </div>
                                <div class="card-footer flex-center">
                                    <button class="w-100 blue-btn" data-toggle="modal" data-target="#view-fund-modal" data-id="${item.idx}">상세보기</button>
                                </div>
                            </div>`;
        div.querySelector("button").addEventListener("click", (e) => this.modal(e));
        this.bestFind.appendChild(div);
    }

    modal(e) {
        let id = e.target.dataset.id;
        let modal = document.querySelector("#view-fund-modal .modal-body");
    
        modal.innerHTML =   `<div class="title">상세보기</div>
                            <div>
                                <small class="text-gray">번호</small>
                                <p class="ml-2 mb-0">${this.data[id].number}</p>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">펀드명</small>
                                <p class="ml-2 mb-0">${this.data[id].name}</p>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">창업자명</small>
                                <span class="ml-2">${this.data[id].owner}</span>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">모집마감일</small>
                                <span class="ml-2">${this.data[id].endDate}</span>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">총 모집금액</small>
                                <span class="ml-2">${this.data[id].total}</span>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">현재 모집금액</small>
                                <span class="ml-2">${this.data[id].current}</span>
                                <small class="text-gray">( ${this.data[id].successRate}% )</small>
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
            div.innerHTML = `<div>
                                <small class="text-gray">이메일</small>
                                <span class="ml-2">${list.email}</span>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">투자금액</small>
                                <span class="ml-2">${list.pay}원</span>
                            </div>
                            <div class="mt-2">
                                <small class="text-gray">투자시간</small>
                                <span class="ml-2">${list.datetime}</span>
                            </div>`;

            modal.querySelector(".investor").appendChild(div)
        })
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
    let app = new App();
})