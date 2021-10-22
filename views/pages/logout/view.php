
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="register-form">
                    <div class="row">
                        <div class="col-md-6">
                            <label>First Name</label>
                            <input class="form-control" type="text" placeholder="First Name">
                        </div>
                        <div class="col-md-6">
                            <label>Last Name"</label>
                            <input class="form-control" type="text" placeholder="Last Name">
                        </div>
                        <div class="col-md-6">
                            <label>E-mail</label>
                            <input class="form-control" type="text" placeholder="E-mail">
                        </div>
                        <div class="col-md-6">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="Mobile No">
                        </div>
                        <div class="col-md-6">
                            <label>Password</label>
                            <input class="form-control" type="text" placeholder="Password">
                        </div>
                        <div class="col-md-6">
                            <label>Retype Password</label>
                            <input class="form-control" type="text" placeholder="Password">
                        </div>
                        <div class="col-md-12">
                            <button class="btn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login-form">
                    <form class="form-signin" action="login" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <label>E-mail</label>
<!--                            <input class="form-control" type="text" placeholder="E-mail / Username">-->
                            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                        </div>
                        <div class="col-md-6">
                            <label>Password</label>
<!--                            <input class="form-control" type="text" placeholder="Password">-->
                            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="newaccount">
                                <label class="custom-control-label" for="newaccount">Keep me signed in</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn" type="submit">Sign in</button>
                            <?php
                            print_r($_SESSION);
                            ?>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>