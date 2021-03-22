class App {
    constructor(){
        this.init();
    }

    async init(){
        let { type } = location.getQueryString();
        this.type = !["2021", "2020", "2019", "2018", "2017"].includes(type) ? "2021" : type;
        $(`.${this.type}`).addClass("btn-filled");
        
        this.render(this.type);
        this.addEvent();
    }

    render() {
        let history = JSON.parse(localStorage.getItem(`${this.type}`)) == null ? [] : JSON.parse(localStorage.getItem(`${this.type}`));

        $(".history-title").html(`${this.type}`);
        history.forEach((item, i) => {
            item = item.split("!@#");
            $(".history-title + div").append(`<div class="t-row text-left">
                                                  <div class="cell-10"><strong class="fs-5">${item[1]}</strong></div>
                                                  <div class="cell-65">${item[0]}</div>
                                                  <div class="cell-25"><button data-id="${i}" data-toggle="modal" data-target="#mod" class="brown-btn mod-btn mx-1">수정</button><button data-id="${i}" class="brown-btn delete-btn mx-1">삭제</button></div>
                                              </div>`);
        })
    }

    addEvent() {
        $("#write-history").on("submit", e => {
            e.preventDefault();
            $("#write").modal("hide");

            let content = $("#write-content").val();
            let date = $("#write-date").val();
            let year = new Date(date).getFullYear();
            let month = new Date(date).getMonth() + 1;
            content += `!@#${month}`;
            let history = JSON.parse(localStorage.getItem(`${year}`)) == null ? [] : JSON.parse(localStorage.getItem(`${year}`));

            history.push(content)

            history.sort(function(a, b)  {
                if(a.split("!@#")[1] > b.split("!@#")[1]) return -1;
                if(a.split("!@#")[1] === b.split("!@#")[1]) return 0;
                if(a.split("!@#")[1] < b.split("!@#")[1]) return 1;
              });

            localStorage.setItem(`${year}`, JSON.stringify(history));

            alert("작성되었습니다.");

            location.reload();
        });

        $(".delete-btn").on("click", e => {
            let id = e.target.dataset.id;
            
            let history = JSON.parse(localStorage.getItem(`${this.type}`)) == null ? [] : JSON.parse(localStorage.getItem(`${this.type}`));
            history.splice(id, 1);
            
            localStorage.setItem(`${this.type}`, JSON.stringify(history));

            alert("삭제되었습니다.");

            location.reload();
        });

        $(".mod-btn").on("click", e => {
            let id = e.target.dataset.id; 
            let history = JSON.parse(localStorage.getItem(`${this.type}`)) == null ? [] : JSON.parse(localStorage.getItem(`${this.type}`));

            $("#id").val(id);

            history = history[id].split("!@#");
            $("#mod-content").val(history[0]);
            $("#mod-date").val(history[1]);

        })
        
        $("#mod-history").on("submit", e => {
            e.preventDefault();
            let id = $("#id").val();
            let content = $("#mod-content").val();
            let date = $("#mod-date").val();
            let month = new Date(date).getMonth() + 1;
            content += `!@#${month}`;

            let history = JSON.parse(localStorage.getItem(`${this.type}`)) == null ? [] : JSON.parse(localStorage.getItem(`${this.type}`));
            history[id] = content;
            localStorage.setItem(`${this.type}`, JSON.stringify(history));
            
            alert("수정되었습니다.");

            location.reload();
        });
    }
}

window.onload = () => {
    let app = new App();
};

location.getQueryString = function(){
    let search = this.search.substr(1);
    if(search === "") return {};
    else {
        return search.split("&").reduce((p, c) => {
            let [key, value] = c.split("=");
            p[key] = value;
            return p;
        }, {});
    }
};