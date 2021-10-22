<!-- My Account Start -->
<div class="my-account">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="account-nav" data-toggle="pill" href="#account-tab" role="tab"><i class="fa fa-user"></i>Account Details</a>
                    <a class="nav-link" id="orders-nav" data-toggle="pill" href="#orders-tab" role="tab"><i class="fa fa-shopping-bag"></i>Orders</a>
                    <a class="nav-link" id="payment-nav" data-toggle="pill" href="#payment-tab" role="tab"><i class="fa fa-credit-card"></i>Payment Method</a>
                    <a class="nav-link" id="address-nav" data-toggle="pill" href="#address-tab" role="tab"><i class="fa fa-map-marker-alt"></i>address</a>
                    <a class="nav-link" href="login?logout=1"><i class="fa fa-sign-out-alt"></i>Logout</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
                        <h4>Account Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" id="firstname" type="text" placeholder="First Name" value="<?php echo $user->firstname?>">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" id="lastname" type="text" placeholder="Last Name" value="<?php echo $user->lastname?>">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" id="phone" type="text" placeholder="Mobile" value="<?php echo $user->phone?>">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" id="email" type="text" placeholder="Email" value="<?php echo $user->email?>">
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" id="address" type="text" placeholder="Address" value="<?php echo $user->address?>">
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" id="city" type="text" placeholder="city" value="<?php echo $user->city?>">
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" id="zipcode" type="text" placeholder="zip code" value="<?php echo $user->zipcode?>">
                            </div>
                            <div class="col-md-12">
                                <button class="btn" onclick="updateAccount()">Update Account</button>
                                <br><br>
                            </div>
                        </div>
                        <h4>Password change</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <input class="form-control" type="password" placeholder="Current Password">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="New Password">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="Confirm Password">
                            </div>
                            <div class="col-md-12">
                                <button class="btn">Save Changes</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="orders-nav">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Κωδ</th>
                                        <th>Διεύθυνση</th>
                                        <th>Τρόπος πληρωμής</th>
                                        <th>Τρόπος αποστολής</th>
                                        <th>Ποσό</th>
                                        <th>Ποσό με ΦΠΑ</th>
                                        <th>Ημερομηνία παραγγελίας</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($orders as $order){ ?>
                                    <tr>
                                        <td><?php echo $order->id ?></td>
                                        <td><?php echo $order->shipping_location_id ?> <?php echo $order->shipping_address ?> <?php echo $order->shipping_postcode ?></td>
                                        <td><?php echo $order->payment_method_id ?></td>
                                        <td><?php echo $order->shipping_method_id ?></td>
                                        <td><?php echo $order->amount ?></td>
                                        <td><?php echo $order->amount_with_tax ?></td>
                                        <td><?php echo $order->regdate ?></td>
                                        <td><button class="btn" id="order-items<?php echo $order->id ?>-nav" data-toggle="pill" onclick="showOrderItems(<?php echo $order->id ?>)">View</button></td>
                                    </tr>
                                    <?php } ?>

                                    </tbody>
                                </table>
                                <br>
                                <table id="order_items" class="table table-bordered" style="display: none">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Κωδ</th>
                                        <th>Κωδ Προϊόντος</th>
                                        <th>Ποσότητα</th>
                                        <th>Ποσό</th>
                                        <th>Ποσό με ΦΠΑ</th>
                                        <th>Ημερομηνία παραγγελίας</th>
                                    </tr>
                                    </thead>
                                    <tbody id="order_items_tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="payment-tab" role="tabpanel" aria-labelledby="payment-nav">
                        <h4>Payment Method</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum quam ac mi viverra dictum. In efficitur ipsum diam, at dignissim lorem tempor in. Vivamus tempor hendrerit finibus. Nulla tristique viverra nisl, sit amet bibendum ante suscipit non. Praesent in faucibus tellus, sed gravida lacus. Vivamus eu diam eros. Aliquam et sapien eget arcu rhoncus scelerisque.
                        </p>
                    </div>
                    <div class="tab-pane fade" id="address-tab" role="tabpanel" aria-labelledby="address-nav">
                        <h4>Address</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Payment Address</h5>
                                <p>123 Payment Street, Los Angeles, CA</p>
                                <p>Mobile: 012-345-6789</p>
                                <button class="btn">Edit Address</button>
                            </div>
                            <div class="col-md-6">
                                <h5>Shipping Address</h5>
                                <p>123 Shipping Street, Los Angeles, CA</p>
                                <p>Mobile: 012-345-6789</p>
                                <button class="btn">Edit Address</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- My Account End -->

<script>

    function showOrderItems(id){
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let response = JSON.parse(this.responseText);
                //console.log(response);
                $("#order_items").show();
                $("#order_items_tbody tr").remove();
                for(i=0;i<response.length;i++){
                    // console.log(response);
                    $("#order_items_tbody").append( '<tr>' +
                        `
                            <td>${response[i].id}</td>
                            <td>${response[i].product_id}</td>
                            <td>${response[i].qty}</td>
                            <td>${response[i].amount}</td>
                            <td>${response[i].amount_with_tax}</td>
                            <td>${response[i].regdate}</td>
                        `
                        +'</tr>' );
                }
            }
        };
        xhttp.open("GET", "order_items?order_id="+id, true);
        xhttp.send();
    }
    function updateAccount(){
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let response = JSON.parse(this.responseText);
                console.log(response);
            }
        };

        let firstname = document.querySelector("#firstname").value;
        let lastname = document.querySelector("#lastname").value;
        let phone = document.querySelector("#phone").value;
        let email = document.querySelector("#email").value;
        let address = document.querySelector("#address").value;
        let city = document.querySelector("#city").value;
        let zipcode = document.querySelector("#zipcode").value;

        let userDetails = JSON.stringify({
            "email" : email,
            "phone" : phone,
            "lastname" :lastname,
            "firstname" :firstname,
            "address":address,
            "city":city,
            "zipcode":zipcode,
            "method": "updateAccount",
        });

         xhttp.open("POST", "profile", true);
         xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
         xhttp.send(userDetails);
    }
</script>