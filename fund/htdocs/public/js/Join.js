class App {
    constructor() {
        this.init();
    }

    init() {

        let email = document.querySelector("#join_email");
        let name = document.querySelector("#join_name");
        let password = document.querySelector("#join_pw");
        let password2 = document.querySelector("#join_pw2");

        let regExp = /^[0-9a-zA-Z\_]+@[0-9a-zA-Z\_]+\.[a-z]{2,3}$/;

        email.addEventListener("input", () => {
            if(regExp.test(email.value)) {
                email.setCustomValidity("");
                email.reportValidity();
            }
        })

        document.querySelector("#join_submit").addEventListener("click", e => {
            console.log(regExp.test(email.value))
            if(!regExp.test(email.value)) {
                email.setCustomValidity("문자@문자.문자 형태로 입력해주세요");
                email.reportValidity("");
            }

            if(email.value == "" || name.value == "" || password.value == "" || password2.value == "" || 
               !name.checkValidity() || !endDate.checkValidity() ) {
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
        });
        $(`#${id}`).toast("show");
    }
}

window.addEventListener("load", () =>{
    let app = new App;
})