class App {
    constructor() {
        this.fund = document.querySelector("#view-fund .row");

        this.init();
    }

    init() {
        document.querySelectorAll("#give").forEach(btn => {
            btn.addEventListener("click", (e) => { this.modal(e); })
        })
    }

    modal(e) {

        document.querySelector("#user_email").value = e.target.dataset.email;

        let money = document.querySelector("#money");

        money.addEventListener("input", () => {
            if(money.value < 0) {
                money.setCustomValidity("자연수만 입력하실 수 있습니다.");
                money.reportValidity();
            } else {
                money.setCustomValidity("");
                money.reportValidity();
            }
        })

        document.querySelector("#give-btn").addEventListener("click", (e) => {
            if(money.value  == "" ||  !money.checkValidity()) {
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