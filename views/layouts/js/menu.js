class Menu{
    list
    liid
    clickedli
    constructor() {

    }

    create(){
        let self = this;
        this.liid = 0;
        this.clickedli = [];
        // document.addEventListener('readystatechange', function(evt) {
        //     if (evt.target.readyState == "complete") {

                document.querySelector('#categoryproducts').classList.add("active");

                self.list = document.createElement('ul');
                self.list.classList.add("collapse");
                self.list.classList.add("in");
                self.list.style = "";

                let a = document.createElement('a');
                a.href = "javascript:void(0)";
                a.setAttribute("aria-expanded", "true");
                a.classList.add("selected");

                let i = document.createElement('i');
                i.classList.add("fa");
                i.classList.add("fa-cubes");

                let span = document.createElement("span");
                span.innerHTML = "Προϊόντα";
                a.append(i);
                a.append(span);

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let response = JSON.parse(this.responseText);
                        let tree = self.buildList(response);

                        self.buildUlLi(tree, self.list);
                        document.getElementById('categoryproducts').append(a);
                        document.getElementById('categoryproducts').append(self.list);
                        self.loadMenuState();
                        self.colorLink();
                    }
                };
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
            li.id = 'li'+self.liid;
            li.classList.add("level"+element.lvl);
            li.setAttribute('level', element.lvl);

            li.style.display = display;


            if(parseInt(element.num_of_products)>0) {
                let a = document.createElement('a');
                a.href = "/products?category="+element.id;
                a.innerText = element.name + '('+element.num_of_products+')';
                li.append(a);
                ul.append(li);
            }
            else{
                let div = document.createElement('a');
                div.href = "javascript:void(0)";
                div.innerText = element.name;
                div.setAttribute("aria-expanded", false);
                div.onclick = function(){
                    self.clickMenuItem(div, element.lvl)
                };
                li.append(div);
                let ulchild = document.createElement('ul');
                ulchild.classList.add("collapse");
                self.buildUlLi(element, ulchild);
                li.append(ulchild);
                ul.append(li);
            }
        });
    }

    clickMenuItem(obj, lvl){

        this.colorSelected(obj);
        let clickedItem = obj.parentElement;
        let ul = clickedItem.querySelector('ul');
        let li = ul.querySelectorAll('li[level="'+(parseInt(lvl)+1)+'"]');
        this.saveMenuState(clickedItem.id);
    }

    colorSelected(items){

        alert(1);
    }

    saveMenuState(menuItem){

        let items = [];
        if (localStorage.getItem("menustate") === null || localStorage.getItem("menustate")==="") {
            items[0] = menuItem;
        }else{items = localStorage.getItem("menustate").split(",");
            if(!items.includes(menuItem)) {
                items.push(menuItem);
            }else{
                let index = items.indexOf(menuItem);
                items.splice(index,1);
            }
        }
        localStorage.setItem('menustate', items);
    }

    loadMenuState(){

        if (localStorage.getItem("menustate") !== null && localStorage.getItem("menustate")!=="") {

            let menuItems = localStorage.getItem("menustate").split(",");
            for(let item of menuItems){
                document.querySelector('#'+item).classList.add("active");
                document.querySelector('#'+item).querySelector('a').setAttribute("aria-expanded", "true");
                document.querySelector('#'+item).querySelector('a').classList.add("selected");
                document.querySelector('#'+item).querySelector('ul').classList.add("in");
                document.querySelector('#'+item).querySelector('ul').style = "";
                // console.log(document.querySelector('#'+item).id);
                //
                // let level = document.querySelector('#'+item).getAttribute('level');
                // let items = document.querySelector('#'+item).querySelector('ul').querySelectorAll('li[level="'+(parseInt(level)+1)+'"]');
                // this.openMenuItem(items);
            }
        }
    }

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
        let element = document.querySelector('#menu').querySelector('a[href="/'+path+search+'"]');
        if(element !==null){
            //this.colorSelected(element.parentElement);
            this.colorSelected(element);
        }
    }

}


