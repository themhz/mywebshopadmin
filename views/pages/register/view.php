
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron" style="background:transparent !important">
    <div class="container-fluid">
        <div class="register-form">
            <div class="row">
                <div class="col-md-6">
                    <label>First Name</label>
                    <input class="form-control" id="firstname" type="text" placeholder="First Name">
                </div>
                <div class="col-md-6">
                    <label>Last Name</label>
                    <input class="form-control" id="lastname" type="text" placeholder="Last Name">
                </div>
                <div class="col-md-6">
                    <label>E-mail</label>
                    <input class="form-control" id="email" type="text" placeholder="E-mail">
                </div>
                <div class="col-md-6">
                    <label>Phone</label>
                    <input class="form-control" id="phone" type="text" placeholder="phone">
                </div>
                <div class="col-md-6">
                    <label>Password</label><br>
                    <input class="form-control" id="password" type="password" placeholder="Password">
                    <span id="toggle_pwd" class="fa fa-fw fa-eye field_icon"></span>
                </div>
                <div class="col-md-12">
                    <button class="btn" onclick="register()">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    #password, #toggle_pwd {
        display:inline-block;
    }
    #password{
        width:80%;
    }
    #toggle_pwd{
        width:4%;
        cursor: pointer;
    }
</style>
<script>

    window.addEventListener('load', function () {
        $("#toggle_pwd").click(function() {         
            $(this).toggleClass("fa-eye fa-eye-slash");
            var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
            $("#password").attr("type", type);
        });
    });

    function register() {

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                try{
                    clearErrors();
                    let response = JSON.parse(this.responseText);

                    if(response.result == 0){
                        let message = `Error in registration `;
                        for(let i=0;i<response.errors.length;i++) {
                            for (let j = 0; j < response.errors[i].length; j++) {

                                console.log(response.errors[i][0]);
                                $("#"+response.errors[i][0]).addClass("errorfield");
                            }
                        }
                        showError("Registration Error", message);
                    }else{
                        let message = `You have successfully registered into our system. Please view your e-mail for the confirmation e-mail `;
                        clearErrors();
                        showMessage("Success in registration", message);
                    }


                }catch(error){
                    showMessage("Registration error", this.responseText);

                }



            }
        };

        let firstname = document.querySelector("#firstname").value;
        let lastname = document.querySelector("#lastname").value;
        let email = document.querySelector("#email").value;
        let phone = document.querySelector("#phone").value;
        let password = document.querySelector("#password").value;

        let userDetails = JSON.stringify({
            "firstname": firstname,
            "lastname": lastname,
            "email": email,
            "phone": phone,
            "password": password
        });

        xhttp.open("POST", "register", true);
        xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhttp.send(userDetails);
    }

    function correct(){
        $(".register-form :input").each(function(){
            $(this).removeClass("alert-danger");
        });
    }

    function clearErrors(){
        $(".register-form :input").each(function(){

            $(this).removeClass("errorfield");
        });
    }

</script>