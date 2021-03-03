class App {
    constructor() {
        this.company = document.querySelector("#company");
        this.bike = document.querySelector("#bike");
        this.rentalBtn = document.querySelector("#rental-btn");
        
        this.dataName = [];
        
        fetch("../json/bike.json")
        .then(res => res.json())
        .then(data => this.init(data));
    }

    init(data) {
        this.data = data;
        this.data.forEach(item => {
            let option = document.createElement("option");
            option.value = item.brand_name;
            option.innerHTML = item.brand_name;
            this.company.appendChild(option);
            this.dataName.push(item.brand_name);
        })
        this.selectBooth(0);
        this.addEvent();
    }

    addEvent() {
        this.rentalBtn.addEventListener("click", e => {
            this.validityCheck();
        });

        this.company.addEventListener("input", e => {
            e.target.dataset.id = this.dataName.indexOf(this.company.value);
            
            this.selectBooth(e.target.dataset.id);
        })
    }

    selectBooth(id) {
        let data = this.data[id];
        this.bike.innerHTML = "";
        data.model.forEach(item => {
            for(let i = 1; i <= item.total; i++) {
                let option = document.createElement("option");
                let text = "";
                text += `${item.name}-${i < 10 ? "00" + i : i < 100 ? "0" + i : i}`;
                option.value = text;
                option.innerHTML = text;
                this.bike.appendChild(option);
            }
        })
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