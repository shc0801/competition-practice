class App {
    constructor() {
        fetch("./json/map.json")
            .then((res) => res.json())
            .then((data) => this.init(data));
    }

    init(data) {
        this.map = data;

        this.mapBox = $(".map-box");
        this.canvas = $("canvas");
        this.canvas[0].width = 1250;
        this.canvas[0].height = 1000;
        this.ctx = this.canvas[0].getContext("2d");

        this.mapLoad();

        this.flag = false;

        this.mapBox[0].addEventListener("mousedown", (e) => {
            this.flag = true;
            const { x, y } = this.getXY(e);
            this.startX = x;
            this.startY = y;
        });
        this.mapBox[0].addEventListener("mousemove", (e) => {
            if (this.flag) {
                const { x, y } = this.getXY(e);
                const { left, top } = this.canvas[0].style;
                let moveX = x - this.startX;
                let moveY = y - this.startY;

                console.log(moveX);
                
                this.ctx.clearRect(0, 0, 1250, 1000);
                this.ctx.setTransform(1, 0, 0, 1, moveX, moveY);
                this.mapLoad();
            }
        });
        window.addEventListener("mouseup", (e) => {
            this.flag = false;
        });

        this.canvas[0].addEventListener("mousewheel", (e) => {
        });
    }

    mapLoad() {
        // if(x == undefined || y == undefined) x = 0, y = 0;
        console.log()
        this.map.forEach((item, line) => {
            item.forEach((type, i) => {
                this.draw(type, i * 10, line * 10, );
            });
        });
    }

    draw(type, i, line, ) {
        console.log();
        if (type == 0) this.ctx.fillStyle = "rgb(255,255,255)";
        else if (type == 1) this.ctx.fillStyle = "rgb(0,200,0)";
        else if (type == 2) this.ctx.fillStyle = "rgb(0,0,200)";
        else this.ctx.fillStyle = "rgb(0,0,0)";

        this.ctx.fillRect(i, line, 10, 10);
    }

    getXY({ pageX, pageY }) {
        let { left, top } = this.mapBox.offset();
        let { width, height } = this.canvas[0];

        let x = pageX - left;
        x = x > width ? width : x < 0 ? 0 : x;

        let y = pageY - top;
        y = y > height ? height : y < 0 ? 0 : y;

        return { x: x, y: y };
    }
}

window.onload = function () {
    let app = new App();
};
