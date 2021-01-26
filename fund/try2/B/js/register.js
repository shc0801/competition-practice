class Register {
    constructor() {
        this.init();
    }

    init() {
        this.numberCreate();

        let name = document.querySelector("#register_name");
        let endDate = document.querySelector("#register_endDate");
        let endDateTime = document.querySelector("#register_endDateTime");
        let total = document.querySelector("#register_total");
        let text = document.querySelector("#register_text");
        let image = document.querySelector("#register_image");
        
        name.addEventListener("input", e => { this.nameCheck(e) })
        total.addEventListener("input", e => { this.totalCheck(e) })
        text.addEventListener("input", e => { this.textCheck(e) })
        image.addEventListener("input", e => { this.imageCheck(e) })

        
        document.querySelector("#register_submit").addEventListener("click", () => {
            if(name.value == "" || endDate.value == "" || endDateTime.value == "" || total.value == "" || text.value == "" || file.value == "") {
                this.showToast();
            }
        })
    }

    numberCreate() {
        document.querySelector("#register_num").value = Math.random().toString(35).substr(2, 5);
    }

    nameCheck(e) {
        let input = e.target;

        let regExp = /^[ㄱ-ㅎ가-힣a-zA-Z\s]+$/;

        if(!regExp.test(input.value)) {
            input.setCustomValidity("한글, 영문, 공백문자만 입력해주세요");
            input.reportValidity();
        } else {
            input.setCustomValidity("");
            input.reportValidity();
        }
    }
    totalCheck(e) {
        if(e.target.value < 0) {
            e.target.setCustomValidity("자연수만 입력할 수 있습니다");
            e.target.reportValidity();
            e.target.value = 0;
        } else {
            e.target.setCustomValidity("");
            e.target.reportValidity();
        }
    }
    textCheck(e) {
        let text = e.target;

        if(text.length > 500) {
            input.setCustomValidity("상세설명은 500자까지만 입력 할 수 있습니다");
            input.reportValidity();
            text.value = text.value.substring(0, 500);
        } else {
            input.setCustomValidity("");
            input.reportValidity();
        }
    }
    imageCheck(e) {
        let file = e.target;
        let fileType = file.value.slice(-4, file.value.length);
        if((fileType == ".jpg" || fileType == ".png") && file.files[0].size < 5 * 1024 * 1024) {
            file.setCustomValidity("");
            file.reportValidity();
            console.log(file.files[0].size < 5 * 1024 * 1024, file.files[0].size, 5 * 1024 * 1024)
        } else {
            file.setCustomValidity("이미지 형식이 맞지 않거나 파일의 크기가 5mb 이상입니다");
            file.reportValidity();
        }
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
}

window.onload = function() {
    let register = new Register();
}