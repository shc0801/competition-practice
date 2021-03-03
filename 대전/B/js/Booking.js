class App {
    constructor() {
        this.booth = document.querySelector("#booth");
        this.round = document.querySelector("#round");
        this.bookingBtn = document.querySelector("#booking-btn");

        this.dataName = [];
        
        fetch("../json/booth.json")
        .then(res => res.json())
        .then(data => this.init(data));
    }

    init(data) {
        this.data = data;
        this.data.forEach((item) => {
            let option = document.createElement("option");
            option.value = item.name;
            option.innerHTML = item.name;
            this.booth.appendChild(option);
            this.dataName.push(item.name);
        })
        this.selectBooth(0);
        this.addEvent();
    }

    addEvent() {
        this.bookingBtn.addEventListener("click", e => {
            this.validityCheck();
        });

        this.booth.addEventListener("input", e => {
            e.target.dataset.id = this.dataName.indexOf(this.booth.value);
            
            this.selectBooth(e.target.dataset.id);
        })
    }

    selectBooth(id) {
        let data = this.data[id];
        let open_time = this.data[id].open_time.split(":");
        let end_time = this.data[id].end_time.split(":");

        let openDateTime = new Date();
        openDateTime.setHours(open_time[0]);
        openDateTime.setMinutes(open_time[1]);
        
        let endDateTime = new Date();
        endDateTime.setHours(end_time[0]);
        endDateTime.setMinutes(end_time[1]);
        
        this.round.innerHTML = "";
        for(let i = 1; openDateTime < endDateTime; i++) {
            let option = document.createElement("option");

            let text = "";
            text += `${openDateTime.getHours() < 10 ? "0" + openDateTime.getHours() : openDateTime.getHours()}:${openDateTime.getMinutes() < 10 ? "0" + openDateTime.getMinutes() : openDateTime.getMinutes()}`;
            openDateTime.setMinutes(openDateTime.getMinutes() + data.running_time);
            text += ` ~ ${openDateTime.getHours() < 10 ? "0" + openDateTime.getHours() : openDateTime.getHours()}:${openDateTime.getMinutes() < 10 ? "0" + openDateTime.getMinutes() : openDateTime.getMinutes()} ${i}회차`;
            openDateTime.setMinutes(openDateTime.getMinutes() + data.rest_time);
            
            option.innerHTML = text;
            if(openDateTime < endDateTime) 
                this.round.appendChild(option);
        }
    }

    validityCheck() {
        let phone = document.querySelector("#user_phone");
        let password = document.querySelector("#password");
        let password2 = document.querySelector("#password2");

        phone.addEventListener("input", e => {
            let phoneExp = /^\d{3}-\d{4}-\d{4}$/;
            if(!phoneExp.test(phone.value)) {
                phone.setCustomValidity("올바른 형태의 휴대폰 번호를 입력해주세요.");
                phone.reportValidity();
            } else {
                phone.setCustomValidity("");
                phone.reportValidity();
            }
        })
        password.addEventListener("input", e => {
            if(password.value == "") {
                password.setCustomValidity("비밀번호를 입력해주세요.");
                password.reportValidity();
            } else {
                password.setCustomValidity("");
                password.reportValidity();
            }
        })
        password2.addEventListener("input", e => {
            if(password.value != password2.value) {
                password2.setCustomValidity("비밀번호와 비밀번호 확인이 일치하지 않습니다.");
                password2.reportValidity();
            } else {
                password2.setCustomValidity("");
                password2.reportValidity();
            }
        })
    }
}

window.onload = () => {
    let app = new App();
}