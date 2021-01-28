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
        document.querySelectorAll(".invest-btn").forEach(btn => {
            btn.addEventListener("click", e => { this.investModal(e) });
        })
    }
    strting(item) {
        return item.toLocaleString("ko-KR")
    }

    investModal(e) {
        let id = e.target.dataset.id;

        let price = document.querySelector("#invest_price");
        

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

        document.querySelector("#insert-submit").addEventListener("click", () => {
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