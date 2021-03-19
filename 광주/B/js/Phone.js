class App {
    constructor(){
        this.init();
    }

    async init(){
        let {statusCd, statusMsg, dt, items} = await this.getExchangeData();
    }

    getExchangeData(){
        return fetch("/restAPI/currentExchangeRate.php")
            .then(res => res.json())
            .then(data => console.log(data));
    }

    
}

window.onload = () => {
    let app = new App();
};