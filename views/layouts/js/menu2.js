class Menu2{
    list
    liid
    clickedli
    constructor() {

    }

    create(root, aftercreate = null){
        let self = this;
        this.liid = 0;
        this.clickedli = [];
        // document.addEventListener('readystatechange', function(evt) {
        //     if (evt.target.readyState == "complete") {
                self.list = document.createElement('ul');
                //self.list.classList.add("navbar-item");
                self.list.classList.add("space");
                self.list.classList.add("first-space");
                self.list.id = "space0";

                let h3 = document.createElement("h3");
                h3.innerHTML = "Προϊόντα";
                h3.classList.add("title");
                h3.id = "title0";



                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let response = JSON.parse(this.responseText);
                        let tree = self.buildList(response);

                        self.buildUlLi(tree, self.list);
                        document.getElementById(root).append(h3);
                        document.getElementById(root).append(self.list);
                        if(aftercreate !=null){
                            aftercreate();
                        }
                        //self.loadMenuState();
                        //self.colorLink();
                    }
                };
                //console.log(window.location.origin);
                xhttp.open("GET", window.location.origin+"?method=getmenu", false);
                xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhttp.send();
        //     }
        // });
    }

    buildList(data) {

        let counter = 0;
        var table = data;
        var root = {
            id: 0,
            parent_id: null,
            name: "",
            children: [],
            lvl: 0
        };
        var node_list = {
            0: root
        };
    
        for (var i = 0; i < table.length; i++) {
            node_list[table[i].id] = table[i];
            node_list[table[i].parent_id].children.push(node_list[table[i].id]);
        }
    
        return root;
    }


    buildUlLi(tree, ul) {

        let self = this;
        let display = "";
        this.liid ++;
        tree.children.forEach(function callbackFn(element, index, array) {

            let li = document.createElement('li');
            //li.id = 'li'+self.liid;
            li.id = element.id
            li.classList.add("route");

            let h3 = document.createElement('h3');
            h3.innerText = element.id + ' ' +element.name + '('+element.num_of_products+')';
            h3.classList.add("title");
            h3.id="title"+self.liid;

            let span = document.createElement('span');
            span.classList.add("ui-icon");
            span.classList.add("ui-icon-arrow-4-diag");

            let ulchild = document.createElement('ul');
            ulchild.classList.add("space");
            ulchild.id="space"+self.liid;

            self.buildUlLi(element, ulchild);

            li.append(h3);
            li.append(span);
            li.append(ulchild);
            ul.append(li);

        });
    }

    clickMenuItem(obj, lvl){

        this.colorSelected(obj);
        let clickedItem = obj.parentElement;
        let ul = clickedItem.querySelector('ul');
        let li = ul.querySelectorAll('li[level="'+(parseInt(lvl)+1)+'"]');
        //this.openMenuItem(li);
        this.saveMenuState(clickedItem.id);
    }

    openMenuItem(items){

        for (let item of items) {
            if(item.style.display == ""){
                item.style.display="none";
            }else{
                item.style.display="";
            }
        }
    }

    saveMenuState(menuItem){

        let items = [];
        if (localStorage.getItem("menustate") === null || localStorage.getItem("menustate")==="") {
            items[0] = menuItem;
        }else{
            items = localStorage.getItem("menustate").split(",");
            if(!items.includes(menuItem)) {
                items.push(menuItem);
            }else{
                let index = items.indexOf(menuItem);
                items.splice(index,1);
            }
        }
        localStorage.setItem('menustate', items);
    }
    //
    // loadMenuState(){
    //
    //     if (localStorage.getItem("menustate") !== null && localStorage.getItem("menustate")!=="") {
    //         let menuItems = localStorage.getItem("menustate").split(",");
    //         for(let item of menuItems){
    //             //this.colorSelected(document.querySelector('#'+item).querySelector('div'));
    //             let level = document.querySelector('#'+item).getAttribute('level');
    //             let items = document.querySelector('#'+item).querySelector('ul').querySelectorAll('li[level="'+(parseInt(level)+1)+'"]');
    //             this.openMenuItem(items);
    //         }
    //     }
    // }

    colorSelected(obj){

        if(obj.classList.contains("selected")){
            obj.classList.remove("selected");
        }else{
            obj.classList.add("selected");
        }
    }

    colorLink(){
        let path = window.location.pathname.substr(1, window.location.pathname.length);
        let search = window.location.search;
        let element = document.querySelector('#menu').querySelector('a[href="'+path+search+'"]');
        if(element !==null){
            this.colorSelected(element.parentElement);
        }
    }

}


