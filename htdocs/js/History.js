class App {
    constructor(){
        this.init();
    }

    async init(){
        let { type } = location.getQueryString();
        type = !["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "n"].includes(type) ? "전체" : type;
        $(`.${type}`).addClass("btn-filled");
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