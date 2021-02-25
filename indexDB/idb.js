window.onload = () => {
    const studentData = [
        {id:1, name:"최선한", phone: "010-1111-1111"},
        {id:2, name:"최선한", phone: "010-1111-1234"},
        {id:3, name:"최질럿", phone: "010-2222-3333"},
        {id:4, name:"오버로드", phone: "010-4444-5555"}
    ];

    let idb;
    let db = indexedDB.open("myDatabase", 1);
    db.addEventListener("error", e => {
        console.log("DB생성중 오류 발생");
    });
    db.addEventListener("success", e => {
        idb = db.result;
        
        let transaction = idb.transaction(["users"], "readwrite").objectStore("users");
        let req = transaction.get(1);
        req.addEventListener("success", e => {
            userList.innerHTML = "";
            userList.appendChild(makeUser(req.result));
        })
    })

    db.addEventListener("upgradeneeded", e => {
        idb = e.target.result; // db 가져오기
        
        let objStore = idb.createObjectStore("users", { keyPath: "id" });
        // 인덱스 만들기
        objStore.createIndex("nameIndex", "name", { unique: false });
        objStore.createIndex("phoneIndex", "phone", { unique: true });
        // 만들어진 후 넣기 
        objStore.transaction.addEventListener("complete", e => {
            let userStore = idb.transaction("users", "readwrite").objectStore("users");

            studentData.forEach(item => {
                userStore.add(item);
            })
        })
    })

    let id = document.querySelector("#number");
    let name = document.querySelector("#name");
    let phone = document.querySelector("#phone");
    let btnInsert = document.querySelector("#btnInsert");

    btnInsert.addEventListener("click", e => {
        let transaction = idb.transaction(["users"], "readwrite").objectStore("users");
        transaction.add({id:id.value * 1, name:name.value, phone:phone.value});
    });

    let btnLoad = document.querySelector("#loadUser");
    const userList = document.querySelector("#userList");
    btnLoad.addEventListener("click", e => {
        let transaction = idb.transaction(["users"], "readwrite").objectStore("users");
        let req = transaction.getAll();
        req.addEventListener("success", e => {
            userList.innerHTML = "";
            req.result.forEach(user => userList.appendChild(makeUser(user)));
        })
    })

    function makeUser(user) {
        let div = document.createElement("div");
        div.innerHTML = `<li>${user.id} : ${user.name} : ${user.phone}<button class="del" data-idx="${user.id}">삭제</button></li>`;
        return div.firstChild;
    }

    btnLoad.addEventListener("click", e => {
        let transaction = idb.transaction(["users"], "readwrite");
        let objStore = transaction.objectStore("users");
        objStore.openCursor().addEventListener("success", e => {
            let cursor = e.target.result;
            if(cursor) {
                console.log(`key is ${cursor.key} , name is ${cursor.value.name}` )
                cursor.continue();
            }
        })
    })

    userList.addEventListener("click", e => {
        if(e.target.classList.contains("del")) {
            let id = e.target.dataset.idx;
            let transaction = idb.transaction(["users"], "readwrite").objectStore("users");
            let req = transaction.objStore.delete(id * 1);
            req.addEventListener("success", e => {
                btnLoad.click();
            })
        }
    })

    userList.addEventListener("click", e => {
        if(e.target.classList.contains("del")) {
            let id = e.target.dataset.idx;
            let transaction = idb.transaction(["users"], "readwrite").objectStore("users");
            let req = objStore.delete(id * 1);
            req.addEventListener("success", e => {
                e.target.parentNode().remove();
            })
        }
    })
}