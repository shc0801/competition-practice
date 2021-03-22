class App {
    constructor(){
        this.init();
    }

    async init(){
        this.phones = await this.getExchangeData();
        this.phones = this.phones.items;
        
        let { type } = location.getQueryString();
        type = !["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "n"].includes(type) ? "a" : type;
        $(`.${type}`).addClass("btn-filled");
        this.render();
    }

    getExchangeData(){
        return fetch("/restAPI/currentExchangeRate.php")
            .then(res => res.json());
    }

    render() {
        console.log(this.phones)
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