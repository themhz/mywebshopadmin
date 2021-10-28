
<div class="main-content-inner">
            <div class="row">
                <!-- Textual inputs start -->
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title"><?php echo $name ?></h4>
                            <div class="form-group">
                                <label for="example-text-input" class="col-form-label">Όνομα προϊόντος</label>
                                <input class="form-control" type="text" value="<?php echo $name ?>" id="name">
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-form-label">Περιγραφή</label>
                                <div id="description"><?php echo $description ?></div>
                            </div>
                            <div class="form-group">
                                <label for="sku" class="col-form-label">Sku</label>
                                <input class="form-control" type="text" value="<?php echo $sku ?>" id="sku">
                            </div>
                            <div class="form-group">
                                <label for="price" class="col-form-label">Price</label>
                                <input class="form-control" type="text" value="<?php echo $price ?>" id="price">
                            </div>
                            <div class="form-group">
                                <label for="stock" class="col-form-label">Stock</label>
                                <input class="form-control" type="text" value="<?php echo $stock ?>" id="stock">
                            </div>
                            <div class="form-group">
                                <label for="width" class="col-form-label">Width</label>
                                <input class="form-control" type="text" value="<?php echo $width ?>" id="width">
                            </div>
                            <div class="form-group">
                                <label for="height" class="col-form-label">Height</label>
                                <input class="form-control" type="text" value="<?php echo $height ?>" id="height">
                            </div>
                            <div class="form-group">
                                <label for="length" class="col-form-label">Length</label>
                                <input class="form-control" type="text" value="<?php echo $length ?>" id="length">
                            </div>
                            <div class="form-group">
                                <label for="weight" class="col-form-label">Weight</label>
                                <input class="form-control" type="text" value="<?php echo $weight ?>" id="weight">
                            </div>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" <?php echo $published == 1 ? "checked" : "" ?> class="custom-control-input" id="published">
                                <label class="custom-control-label" for="published">Published</label>
                            </div>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" <?php echo $deleted == 1 ? "checked" : "" ?> class="custom-control-input" id="deleted">
                                <label class="custom-control-label" for="published">Deleted</label>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-success mb-3" onclick="save()">Αποθήκευση</button>
                                <button type="button" class="btn btn-warning mb-3">Άκυρο</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


<!-- include libraries(jQuery, bootstrap) -->
<!--<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">-->
<!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->

<!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js) -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css">
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>

<!-- include summernote css/js-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>
<script defer>
    $("#description").summernote({
        height: 150,   //set editable area's height
        codemirror: { // codemirror options
            theme: 'monokai'
        }
    });

    let data = {};
    function save(){
        tempSave();
        submitToServer();
    }

    function tempSave(){

        data = {
            id : <?php echo $id ?>,
            description : $('#description').summernote('code'),
                name : $("#name").val(),
                sku : $("#sku").val(),
                price : $("#price").val(),
                stock : $("#stock").val(),
                width : $("#width").val(),
                height : $("#height").val(),
                length : $("#length").val(),
                weight : $("#weight").val(),
                published : $("#published").is(":checked"),
                deleted : $("#deleted").is(":checked"),
        };

    }

    function submitToServer(){
        $.ajax({
            url: '/product',
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            async: true,
            success: function(response) {
                console.log(response);
                //alert(msg);
                //console.log(msg);
                Swal.fire(
                    `${"updated " + response.result}`,
                    `${response.message}`,
                    `${response.result == true ? "success" : "error"}`
                );
            }
        });
    }
</script>