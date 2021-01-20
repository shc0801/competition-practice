class Join {
    constructor() {
        this.init();
    }

    init() {
        let email = document.querySelector("#join_email");
        let name = document.querySelector("#join_name");
        let password = document.querySelector("#join_pw");
        let password2 = document.querySelector("#join_pw2");
        
        password.addEventListener("input", e => { this.passwordCheck(e); });
        
        document.querySelector("#join_submit").addEventListener("click", () => {
            if(email.value == "" || name.value == "" || password.value == "" || password2.value == "") {
                var regExp = /^[a-zA-Z0-9\!\@\#\$\%\^\&\*\(\)]+$/;
                if(!regExp.test(input.value))
                    $(".toast").toast("show");
            }
        })
    }

    passwordCheck(e) {
        let input = e.target;

        var regExp = /^[a-zA-Z0-9\!\@\#\$\%\^\&\*\(\)]+$/; 
        
        console.log(regExp.test(input.value))
        if(!regExp.test(input.value)) {
            e.target.setCustomValidity("영문+숫자+특수문자만 입력해주세요");
            input.reportValidity();
        } else {
            e.target.setCustomValidity("");
            input.reportValidity();
        }
    }
}

window.addEventListener("load", () => {
    let join = new Join();
})