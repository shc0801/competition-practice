class View {
    constructor() {
        this.viewFind = document.querySelector("#view-fund .row");

        fetch("/js/fund.json")
        .then(res => res.json())
        .then(data => this.init(data));
    }

    init(data) {
        this.data = data;
        this.data.forEach((item, i) => {
            item.idx = i;
            item.successRate = (item.current / item.total) * 100;
        }); 
        
        document.querySelectorAll("button").forEach(btn => {
            btn.addEventListener("click", () => { this.modal(); })
        })
    }

    modal() {
        document.querySelector("#invest_user").value = "";
        document.querySelector("#invest_price").value = "";

        document.querySelector("#invest_price").addEventListener("input", (e) => {
            e.target.value = e.target.value < 0 ? 0 : parseInt(e.target.value); 
        })

        let closeBtn = document.querySelector("#invest-modal button");
        closeBtn.addEventListener("click", () => { $("#invest-modal").modal('hide') });

        this.signature();
    }

    signature() {
        this.canvas = $("canvas");
        this.ctx = this.canvas[0].getContext("2d");
        this.flag = false;
        this.ctx.clearRect(0, 0, 450, 150);

        this.canvas[0].addEventListener('mousedown', (e) => { 
            this.thick = document.querySelector("#thick").value;
            this.ctx.lineWidth = this.thick;

            const { x, y } = this.getXY(e);
            this.ctx.beginPath();
            this.ctx.moveTo(x, y)
            this.flag = true;
        });
        this.canvas[0].addEventListener('mousemove', (e) => { 
            if(this.flag) {
                const { x, y } = this.getXY(e);
                this.ctx.lineTo(x, y);
                this.ctx.stroke();
            }
        });
        this.canvas[0].addEventListener('mouseup', (e) => { 
            if(this.flag) {
                const { x, y } = this.getXY(e);
                this.ctx.lineTo(x, y);
                this.ctx.stroke();
                this.flag = false;
            }   
        });
    }


    getXY({pageX, pageY}) {
        let { left, top } = this.canvas.offset();
        let { width, height } = this.canvas[0];
        
        let x = pageX - left;
        x = x > width ? width : x < 0 ? 0 : x;

        let y = pageY - top;
        y = y > height ? height : y < 0 ? 0 : y;
        return {x: x, y: y};
    }
}

window.addEventListener("load", () => {
    let view = new View();
})