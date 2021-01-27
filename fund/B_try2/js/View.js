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
            div.querySelector(".card-footer").innerHTML = `<button class="blue-btn w-100" data-toggle="modal" data-target="#invest-modal" data-id=${item.idx} value="<?=$fund->$fund_num?>">투자하기</button>`
        }

        this.fund.appendChild(div)
        
        div.querySelector("button").addEventListener("click", (e) => this.modal(e));
    }

    modal(e) {
        let id = e.target.dataset.id;
        
        let num = document.querySelector('#invest_num');
        let name = document.querySelector('#invest_name');
        let price = document.querySelector('#invest_price');
        
        num.value = this.data[id].number;
        name.value = this.data[id].name;

        document.querySelector("#invest_price").addEventListener("input", e => {
            if(e.target.value < 0) {
                e.target.setCustomValidity("자연수만 입력할 수 있습니다");
                e.target.reportValidity();
                e.target.value = 0;
            } else {
                e.target.setCustomValidity("");
                e.target.reportValidity();
            }
        });

        let closeBtn = document.querySelector("#invest-modal button");
        closeBtn.addEventListener("click", () => { $("#invest-modal").modal("hide") });

        document.querySelector("#invest_submit").addEventListener("click", () => {
            if(price.value == "") 
                this.showToast();
        })

        this.signature();
    }

    showToast() {
        let id = new Date().getTime();
        let toast = `<div class="toast"id=${id}>
                        <div class="toast-header flex-between">
                            <strong>form 오류</strong>
                            <button type="button" class="close">x</button>
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
        $(`#${id} button`).on('click', function () {
            $(`#${id}`).remove();
        });
        $(`#${id}`).toast('show');
    }


    signature() {
        this.canvas = $("canvas");
        this.ctx = this.canvas[0].getContext("2d");
        this.flag = false;
        this.ctx.clearRect(0, 0, 450, 150);

        this.canvas[0].addEventListener("mousedown", e => {
            this.thick = document.querySelector("#thick").value;
            this.ctx.lineWidth = this.thick;

            const { x, y } = this.getXY(e);
            this.ctx.beginPath();
            this.ctx.moveTo(x, y);
            this.flag = true;
        })
        
        this.canvas[0].addEventListener("mousemove", e => {
            if(this.flag) {
                const { x, y } = this.getXY(e);
                this.ctx.lineTo(x, y);
                this.ctx.stroke();
            }
        })
        
        this.canvas[0].addEventListener("mouseup", e => {
            if(this.flag) {
                const { x, y } = this.getXY(e);
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