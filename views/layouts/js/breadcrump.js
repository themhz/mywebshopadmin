class Breadcrump{
    breadcrump

    constructor(element) {
        this.breadcrump = document.querySelector('#'+element);
    }

    create(){
        let items = this.getMenuPath();
        let path = this.buildHtmlPath(items);
        this.breadcrump.innerHTML = path;
        //console.log(path);

    }

    buildHtmlPath(items){
        let htmltext = "";
        for(let i=0; i< items.length; i++){
                htmltext += `<li><a href="${items[i][1]}"> ${items[i][0]}</a></li>`;
        }

        return htmltext;
    }

    getMenuPath(){
        let path = window.location.pathname.substr(1, window.location.pathname.length);
        let search = window.location.search;
        let element = document.querySelector('#menu').querySelector('a[href="/'+path+search+'"]');
        let breadcrump = [];

        if(element != null){
            let curelement = element.parentElement;
            for(let i=element.getAttribute("level");i>=0;i--){
                breadcrump.push([curelement.querySelector("a").innerText, curelement.querySelector("a").href]);
                curelement = curelement.parentElement.parentElement;
            }
        }

        return breadcrump.reverse();

    }
}