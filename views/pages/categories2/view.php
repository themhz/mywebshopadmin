
<button onclick="save()">Save Menu</button>
<button onclick="showTree()">Show Tree</button>
<div class="container">
    <h3 class="title" id="title0">jQuery Nested Sortable Plugin Demo</h3>
    <ul class="space first-space" id="space0">
        <li class="route">
            <h3 class="title" id="title1">A</h3>
            <span class="ui-icon ui-icon-arrow-4-diag"></span>
            <ul class="space" id="space1">
            </ul>
        </li>
        <li class="route">
            <h3 class="title" id="title2">B</h3>
            <span class="ui-icon ui-icon-arrow-4-diag"></span>
            <ul class="space" id="space2">
                <li class="route">
                    <h3 class="title" id="title3">C</h3>
                    <span class="ui-icon ui-icon-arrow-4-diag"></span>
                    <ul class="space" id="space3">
                    </ul>
                </li>
            </ul>
        </li>
        <li class="route">
            <h3 class="title" id="title4">D</h3>
            <span class="ui-icon ui-icon-arrow-4-diag"></span>
            <ul class="space" id="space4">
            </ul>
        </li>
        <li class="route">
            <h3 class="title">E</h3>
            <span class="ui-icon ui-icon-arrow-4-diag"></span>
            <ul class="space">
            </ul>
        </li>
        <li class="route">
            <h3 class="title">F</h3>
            <span class="ui-icon ui-icon-arrow-4-diag"></span>
            <ul class="space">
            </ul>
        </li>
        <li class="route">
            <h3 class="title">G</h3>
            <span class="ui-icon ui-icon-arrow-4-diag"></span>
            <ul class="space">
            </ul>
        </li>
        <li class="route">
            <h3 class="title">H</h3>
            <span class="ui-icon ui-icon-arrow-4-diag"></span>
            <ul class="space">
            </ul>
        </li>
    </ul>
</div>

<style>
    .container {
        position: relative;
        margin-top: 60px;
        margin-left: 60px;
        margin-right: 60px;
        padding-bottom: 10px;
        min-height: 500px;
        background: #eee;
        box-shadow: 0px 0px 10px 2px #bbb;
    }

    .container h3 {
        position: absolute;
        border: 0;
        margin: 0;
        padding: 0;
        padding-top: 14px;
        height: 44px;
        width: 400px;
        text-indent: 80px;
        background: #4af;
        border-radius: 2px;
        box-shadow: 0px 0px 0px 2px #29f;
        pointer-events: none;
        margin-left: 0px;
        width: 100%;
        background: white;
        box-shadow: 0px 2px 0px 1px #9bf;
    }

    .route {
        position: relative;
        list-style-type: none;
        border: 0;
        margin: 0;
        padding: 0;
        top: 0px;
        margin-top: 0px;
        max-height: 100% !important;
        width: 100%;
        background: #bcf;
        border-radius: 2px;
        z-index: -1;
    }

    .route span {
        position: absolute;
        top: 20px;
        left: 20px;
        -ms-transform: scale(2);
        /* IE 9 */

        -webkit-transform: scale(2);
        /* Chrome, Safari, Opera */

        transform: scale(2);
        z-index: 10px;
    }

    .route .title {
        position: absolute;
        border: 0;
        margin: 0;
        padding: 0;
        padding-top: 14px;
        height: 44px;
        width: 400px;
        text-indent: 80px;
        background: #4af;
        border-radius: 2px;
        box-shadow: 0px 0px 0px 2px #29f;
        pointer-events: none;
    }

    .first-title { margin-left: 10px; }

    .space {
        position: relative;
        list-style-type: none;
        border: 0;
        margin: 0;
        padding: 0;
        margin-left: 70px;
        width: 60px;
        top: 68px;
        padding-bottom: 68px;
        height: 100%;
        z-index: 1;
    }

    .first-space { margin-left: 10px; }
</style>

<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mobile/1.4.1/jquery.mobile.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script defer>
    $(document).ready(function(){
        window.onresize = function(event) {
            calcWidth($('#title0'));
        };
    });

    function showTree(){
        calcWidth($('#title0'));
        addSortable();
    }
    function calcWidth(obj){
        // console.log('---- calcWidth -----');

        var titles = $(obj).siblings('.space').children('.route').children('.title');

        $(titles).each(function(index, element){

            var pTitleWidth = parseInt($(obj).css('width'));
            var leftOffset = parseInt($(obj).siblings('.space').css('margin-left'));
            var newWidth = pTitleWidth - leftOffset;

            if ($(obj).attr('id') == 'title0'){
                // console.log("called");
                newWidth = newWidth - 10;
            }
            $(element).css({
                'width': newWidth,
            })
            calcWidth(element);
        });
    }
    function addSortable(){
        $('.space').sortable({
            connectWith:'.space',
            tolerance:'intersect',
            over:function(event,ui){},
            receive:function(event, ui){
                calcWidth($(this).siblings('.title'));
            }
        });

        $('.space').disableSelection();
    }

    //Saves the menu state in the database
    let tree = [];
    function save(){
        tree = [];
        ulLiToJson($("#space0").children("li"));
        const obj = Object.assign({}, tree);

        saveToDb(obj)

    }

    //Saves the menu state in the database
    function saveToDb(obj){
        console.log(obj);

        $.ajax({
            url: 'http://192.168.1.2:8002/test',
            type: 'POST',
            data: JSON.stringify(obj),
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            async: false,
            success: function(msg) {
                //alert(msg);
            }
        });

    }



    //Pass a list of li
    function ulLiToJson(elem){
        //for each li
        elem.each(function(a, item){

            let name = $(item).children("h3").html();
            let elements = [];

            $(item).children("ul").children("li").each(function(b, subitem){
                elements.push($(subitem).children("h3").html());
            })

            const ele = Object.assign({}, elements);
            let obj = {'name': name, 'elements' : ele}
            tree.push(obj);

            //print the h3 html text which is only inside the li and the number of nested lis in the nested ul
            //if it has more nested ul-li then find them and parse them recursively
            if($(item).children("ul").children("li").length>0){
                ulLiToJson($(item).children("ul").children("li"));
            }
        });

    }
</script>