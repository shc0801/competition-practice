class Register {
    constructor() {
        this.init();
    }

    init() {
        this.numberCreate();

        let name = document.querySelector("#register_name");
        let endDate = document.querySelector("#register_endDate");
        let endDateTime = document.querySelector("#register_endDate_time");
        let total = document.querySelector("#register_total");
        let text = document.querySelector("#register_text");
        let file = document.querySelector("#register_file");
        
        name.addEventListener("input", e => { this.nameCheck(e); });
        total.addEventListener("input", e => {
            e.target.value = e.target.value < 0 ? 0 : e.target.value;
        })
        text.addEventListener("input", e => { this.textCheck(e); });
        file.addEventListener("input", e => { this.fileCheck(e) })
        
        document.querySelector("#register_submit").addEventListener("click", () => {
            if(name.value == "" || endDate.value == "" || endDateTime.value == "" || total.value == "" || text.value == "" || file.value == "") {
                $(".toast").toast("show");
            }
        })
        
        this.addEvent();
    }

    numberCreate() {
        document.querySelector("#register_num").value = Math.random().toString(36).substr(2,5);
    }

    nameCheck(e) {
        let input = e.target;

        var regExp = /^[가-힣a-zA-Z\s]+$/; //한글+영문
        
        if(!regExp.test(input.value)) {
            e.target.setCustomValidity("한글+영문+공백문자만 입력해주세요");
            input.reportValidity();
        } else {
            e.target.setCustomValidity("");
            input.reportValidity();
        }
    }

    textCheck(e) {
        let text = e.target;

        if(text.value.length <= 500) {
            e.target.setCustomValidity("");
            text.reportValidity();
        } else {
            e.target.setCustomValidity("상세설명은 500자까지만 입력 할 수 있습니다");
            text.reportValidity();
            e.target.value = text.value.substring(0, 500);
        }
    }

    fileCheck(e) {
        let file = e.target;
        let fileType = file.value.slice(-4, file.value.length);
        
        if((fileType == ".jpg" || fileType == ".png") && file.files[0].size < 5 * 1024 * 1024 ) {
            e.target.setCustomValidity("");
            file.reportValidity();
        } else {
            e.target.setCustomValidity("이미지 형식이 맞지 않거나 파일의 크기가 5mb 이상입니다");
            file.reportValidity();
            file.value = "";
        }
    }

    addEvent() {

    }
}

window.addEventListener("load", () => {
    let register = new Register();
})