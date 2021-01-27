class Register {
    constructor() {
        this.init();
    }

    init() {
        let email = document.querySelector("#join_email");
        let name = document.querySelector("#join_name");
        let password = document.querySelector("#join_pw");
        let password2 = document.querySelector("#join_pw2");
        
        password.addEventListener("input", e => { this.passwordCheck(e) })

        
        document.querySelector("#join_submit").addEventListener("click", () => {
            let regExp = /^[a-zA-z0-9\!\@\#\$\%\^\&\*\(\)]+$/;
            console.log()
            if(email.value == "" || name.value == "" || password.value == "" || password2.value == "") {
                this.showToast();
            } else if(!regExp.test(password.value)) {
                this.showToast();
            }
        })
    }

    passwordCheck(e) {
        let input = e.target;

        let regExp = /^[a-zA-z0-9\!\@\#\$\%\^\&\*\(\)]+$/;

        if(!regExp.test(input.value)) {
            input.setCustomValidity("영문, 숫자, 특수문자만 입력해주세요");
            input.reportValidity();
        } else {
            input.setCustomValidity("");
            input.reportValidity();
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