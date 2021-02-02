class App {
    constructor() {
        this.fund = document.querySelector("#view-fund .row");

        this.init();
    }

    init() {
        document.querySelectorAll("#invest-btn").forEach(btn => {
            btn.addEventListener("click", (e) => { this.modal(e); })
        })
    }

    modal(e) {
        let id = e.target.dataset.id;
        
        let price = document.querySelector("#invest_price");

        price.addEventListener("input", () => {
            if(price.value < 0) {
                price.setCustomValidity("자연수만 입력하실 수 있습니다.");
                price.reportValidity();
            } else {
                price.setCustomValidity("");
                price.reportValidity();
            }
        })

        this.signation();
    }

    signation() {
        this.canvas = $("canvas");
        this.ctx = this.canvas[0].getContext("2d");
        this.ctx.clearRect(0, 0, 450, 150);
        let flag = false;

        this.canvas[0].addEventListener("mousedown", (e) => {
            this.ctx.lineWidth = document.querySelector("#thick").value;
            const {x, y} = this.getXY(e);
            this.ctx.beginPath();
            this.ctx.moveTo(x, y);
            flag = true;
        })
        this.canvas[0].addEventListener("mousemove", (e) => {
            if(flag) {
                const {x, y} = this.getXY(e);
                this.ctx.lineTo(x, y);
                this.ctx.stroke();
            }
        })
        this.canvas[0].addEventListener("mouseup", (e) => {
            if(flag) {
                const {x, y} = this.getXY(e);
                this.ctx.lineTo(x, y);
                this.ctx.stroke();
                flag = false;
            }
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

        return { x: x, y: y };
    }
}


window.onload = function() {
    let app = new App();
}