class App {
    constructor() {

        this.init()
    }

    init() {
        let email = document.querySelector("#join_email");
        let name = document.querySelector("#join_name");
        let password = document.querySelector("#join_pw");
        let password2 = document.querySelector("#join_pw2");

        email.addEventListener("input", () => {
            let regExp = /^[a-zA-Z0-9\_]+@[a-zA-Z0-9\_]+\.[a-z]{2,3}$/
            console.log(regExp.test(email.value))
            if(regExp.test(email.value)) {
                email.setCustomValidity("");
                email.reportValidity();
            }
        })

        password.addEventListener("input", () => {
            let regExp = /^[a-zA-Z\!\@\#\$\%|^\&\*\(\)]+$/
            if(!regExp.test(password.value)) {
                password.setCustomValidity("영문, 특문(!@#$%^&*())만 입력하실 수 있습니다.");
                password.reportValidity();
            } else {
                password.setCustomValidity("");
                password.reportValidity();
            }
        })
        
        document.querySelector("#join_submit").addEventListener("click", (e) => {
            let regExp = /^[a-zA-Z0-9\_]+@[a-zA-Z0-9\_]+\.[a-z]{2,3}$/
            if(!regExp.test(email.value)) {
                email.setCustomValidity("문자@문자.az 형식이 아닙니다.");
                email.reportValidity();
            }
            if(email.value  == "" || name.value  == "" || password.value  == "" || password2.value  == "" ||  
            !email.checkValidity() ||  !name.checkValidity() ||  !password.checkValidity() ||  !password2.checkValidity()) {
                this.showToast();
            }
        })
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
        })
        $(`#${id}`).toast("show");
    }
}


window.onload = function() {
    let app = new App();
}