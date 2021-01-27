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
        div.classList.add("col-lg-4");
        div.classList.add("col-md-6");
        div.classList.add("my-3");
        div.classList.add("px-4");
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
                                    <small class="text-bold">모집금액</small>
                                    <p class="ml-2 mb-0">${item.str_total}원</p>
                                </div>
                                <div class="mt-2">
                                    <div class="progress" style="height: 15px;">
                                        <div class="progress-bar fs-n1" style="width: 100%;" aria-valuenow="${item.successRate}">loading...</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer flex-center">
                                <button class="blue-btn invest-btn w-50 mx-1" data-id=${item.idx} data-toggle="modal" data-target="#invest-modal">투자하기</button>
                                <button class="blue-btn view-btn w-50 mx-1" data-id=${item.idx} data-toggle="modal" data-target="#investor-view-modal">상세보기</button>
                        </div>`;
        this.fund.appendChild(div);
        console.log(new Date(item.endDate))
        if(new Date(item.endDate) <= new Date()) {
            div.querySelector(".card-footer").innerHTML = `
            <button class="blue-btn invest-btn w-50 mx-1" data-id=${item.idx} data-toggle="modal" data-target="#invest-modal">투자하기</button>
            <button class="blue-btn view-btn w-50 mx-1" data-id=${item.idx} data-toggle="modal" data-target="#investor-view-modal">상세보기</button>`;
        } else {
            div.querySelector(".card-footer").innerHTML = `
            <button class="blue-btn invest-btn w-50 mx-1" >모집완료</button>
            <button class="blue-btn view-btn w-50 mx-1" data-id=${item.idx} data-toggle="modal" data-target="#investor-view-modal">상세보기</button>`;
        }
        div.querySelector(".view-btn").addEventListener("click", e => { this.viewModal(e) });
        div.querySelector(".invest-btn").addEventListener("click", e => { this.investModal(e) });
    }

    viewModal(e) {
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

    investModal(e) {
        let id = e.target.dataset.id;

        let num = document.querySelector("#invest_num");
        let name = document.querySelector("#invest_name");
        let price = document.querySelector("#invest_price");

        num.value = this.data[id].number
        name.value = this.data[id].name

        price.addEventListener("input", e => {
            if(price.value < 0) {
                price.setCustomValidity("자연수만 입력할 수 있습니다.");
                price.reportValidity();
            } else {
                price.setCustomValidity("");
                price.reportValidity();
            }
        })

        document.querySelector(".close-btn").addEventListener("click", () => {
            $("#invest-modal").modal("hide");
        })

        document.querySelector(".insert-btn").addEventListener("click", () => {
            if(price.value == "" || !price.checkValidity()) {
                this.showToast();
            }
        })

        this.signature();
    }

    signature() {
        this.canvas = $("canvas");
        this.ctx = this.canvas[0].getContext("2d");
        this.flag = false;
        this.ctx.clearRect(0, 0, 450, 150);

        this.canvas[0].addEventListener("mousedown", e => {
            this.thick = document.querySelector("#thick").value;
            this.ctx.lineWidth = this.thick;

            const {x, y} = this.getXY(e);
            this.ctx.beginPath();
            this.ctx.moveTo(x, y);
            this.flag = true;
        })
        
        this.canvas[0].addEventListener("mousemove", e => {
            if(this.flag) {
                const {x, y} = this.getXY(e);
                this.ctx.lineTo(x, y);
                this.ctx.stroke();
            }
        })
        
        this.canvas[0].addEventListener("mouseup", e => {
            if(this.flag) {
                const {x, y} = this.getXY(e);
                this.ctx.lineTo(x, y);
                this.ctx.stroke();
                this.flag = false;
            }
        })
    }

    getXY({pageX, pageY}) {
        let { left, top } = this.canvas.offset();
        let { width, height } = this.canvas[0];

        let x = pageX - left;
        x = x > width ? width : x < 0 ? 0 : x;

        let y = pageY - top;
        y = y > height ? height : y < 0 ? 0 : y;

        return { x: x, y: y }
    }

    loading() {
        setTimeout(() => {
            let progress = document.querySelectorAll(".progress-bar");
            progress.forEach((bar, i) => {
                console.log(i, this.data)
                bar.classList.remove("progress-bar-striped");
                bar.classList.remove("progress-bar-animated");
                bar.style.transition = `${this.data[i].successRate / 50}s`;
                bar.style.width = `${this.data[i].successRate}%`;
                bar.innerHTML = `${this.data[i].successRate}%`;
            })
        }, 3000);
    }

    showToast() {
        let id = new Date().getTime();
        let toast = `<div class="toast" id=${id}>
                        <div class="toast-header flex-between">
                            <strong>form 오류</strong>
                            <button class="close">x</button>
                        </div>
                        <div class="toast-body">
                            입력하신 정보가 양식과 일치하지 않습니다.
                        </div>
                    </div>`;
        $("#toast-container").append(toast);
        $(`#${id}`).toast({
            autohide: true,
            delay: 3000
        });
        $(`#${id} button`).on("click", function() {
            $(`#${id}`).remove();
        });
        $(`#${id}`).toast("show");
    }
}

window.addEventListener("load", () =>{
    let app = new App;
})