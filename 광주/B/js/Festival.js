class App {
    constructor(){
        this.init();
    }

    async init(){
        this.festivals = await this.getFestivals();

        console.log(this.festivals);

        this.render();
    }

    render(){
        console.log(location)
        let { page, type } = location.getQueryString();
        page = !isNaN(parseInt(page)) && page >= 1 ? parseInt(page) : 1;
        type = !["normal", "list"].includes(type) ? "normal" : type;

        const LIST_LENGTH = type == 'normal' ? 6 : 10;
        const BLOCK_LENGTH = 5;
        const SPACING = 4;

        let totalPage = Math.ceil(this.festivals.length / LIST_LENGTH);
        let startPage = Math.ceil(page / BLOCK_LENGTH) * BLOCK_LENGTH - SPACING;
        let endPage = startPage + SPACING > totalPage ? totalPage : startPage + SPACING;
        
        let prev = true;
        let next = true;

        if(startPage == 1) prev = false;
        if(endPage == totalPage) next = false;

        let sp = (page-1) * LIST_LENGTH;
        let ep = sp + LIST_LENGTH;
        let data = this.festivals.slice(sp, ep);

        $(".link__" + type).addClass("text-gray");

        $(".paging").html(`<a href="?page=${startPage - 1}&type=${type}" class="icon mx-1 bg-gray text-white" ${!prev ? "disabled" : ""}>
                                <i class="fa fa-angle-left"></i>
                            </a>`);
        for(let i = startPage; i <= endPage; i++){
            $(".paging").append(`<a href="?page=${i}&type=${type}" class="icon mx-1 ${page == i ? 'bg-gray text-white' : 'border border-gray text-gray'}">${i}</a>`);
        }
        $(".paging").append(`<a href="?page=${endPage + 1}&type=${type}" class="icon mx-1 bg-gray text-white" ${!next ? "disabled" : ""}>
                                <i class="fa fa-angle-right"></i>
                            </a>`);

        if(type == "normal") this.renderNormal(data);
        else this.renderList(data);
    }

    renderNormal(data){
        data.forEach(item => {
            console.log(item);
            $(".row").append(`<div class="col-lg-4 col-md-6 px-3 my-3">
                                <div class="card">
                                    <div class="card-header p-0">
                                        <img class="image" src="${item.imagePath}/${item.images.length > 0 && item.images[0]}" alt="">
                                    </div>
                                    <div class="card-body pb-2">
                                        <div class="px-3">
                                            <strong class="text-gray fs-n2">BEST FESTUVAL</strong>
                                            <div>
                                                <span class="text-ddgray bold fs-1">${item.name}</span>
                                            </div>
                                            <div class="mt-2">
                                                <small class="text-bold">축제 기간</small>
                                                <span class="ml-2 mb-0">${item.period}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer px-0">
                                    </div>
                                </div>
                            </div>`);
        });

        $(".row img").on("error", e => {
            e.target.src = "/images/no-image.jpg";
            $(e.target).closest(".festival").find(".image-cnt").remove();
        });
    }
    renderList(data){
        $(".list").html(`<div class="t-head">
                                <div class="cell-10">번호</div>
                                <div class="cell-50">축제명</div>
                                <div class="cell-30">기간</div>
                                <div class="cell-10">장소</div>
                            </div>`);

        data.forEach(item => {
            $(".list").append(`<div class="t-row" data-toggle="modal" data-target="#view-modal" data-id="${item.id}">
                                        <div class="cell-10">${item.id}</div>
                                        <div class="cell-50">${item.name}</div>
                                        <div class="cell-30">${item.period}</div>
                                        <div class="cell-10">${item.area}</div>
                                    </div>`);
        });
    }

    // 데이터 불러오기
    getFestivals(){
        return fetch("/xml/festivalList.xml")
            .then(res => res.text())
            .then(xmlText => {
                let parser = new DOMParser();
                let xml = parser.parseFromString(xmlText, "text/xml");
                
                let festivals = Array.from( xml.querySelectorAll("item") ).map(festival => ({
                    id: parseInt(festival.querySelector("sn").innerHTML),
                    no: parseInt(festival.querySelector("no").innerHTML),
                    name: festival.querySelector("nm").innerHTML,
                    area: festival.querySelector("area").innerHTML,
                    location: festival.querySelector("location").innerHTML,
                    period: festival.querySelector("dt").innerHTML,
                    content: festival.querySelector("cn").innerHTML,
                    images: Array.from(festival.querySelectorAll("image")).map(xmlImg => xmlImg.innerHTML),
                }));

                return festivals.map(item => ({...item, imagePath: "/xml/festivalImages/" + `${item.id}`.padStart(3, '0') + "_" + item.no,}))
            });
    }
}

window.onload = () => {
    let app = new App();
}

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