<!-- Main jumbotron for a primary marketing message or call to action -->

<style>
    .form-row {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -5px;
        /*margin-left: -5px;*/
    }
</style>
<h2 class="display-6 text-center mb-4">Basket items</h2>

<table class="table table-bordered" id="basket">
  <tbody></tbody>
</table>

<div class="bd-example">
    <form>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email">
            </div>
        </div>
        <div class="form-row" id="shipping_details">
            <div class="form-group col-md-4">
                <label for="location">Νομός-Δήμος</label>
                <select id="location" class="form-control"></select>
            </div>
            <div class="form-group col-md-4">
                <label for="zipcode">Zip</label>
                <input id="zipcode" type="text" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="address">Οδός</label>
                <input id="address" type="text" class="form-control" >
            </div>
        </div>

    </form>
</div>
<script>
  let paymentMethods = JSON.parse('<?php echo json_encode($paymentMethods); ?>');
  let shippingMethods = JSON.parse('<?php echo json_encode($shippingMethods); ?>');
  let locations = JSON.parse('<?php echo json_encode($locations); ?>');
  let vatcodes = JSON.parse('<?php echo json_encode($vatcodes); ?>');
  let shippingMethodsRatings = JSON.parse('<?php echo json_encode($shippingMethodsRatings); ?>');

  //let basket = null;
  document.addEventListener('readystatechange', function(evt) {

    if (evt.target.readyState == "complete") {

        basket = new Basket('basket');
        populateDropDown("location", locations);

        basket.paymentMethods = paymentMethods;
        basket.shippingMethods = shippingMethods;
        basket.locations = locations;
        basket.vatcodes = vatcodes;
        basket.reloadItems();
        // basket.loadPaymentMethods();
        // basket.loadShippingMethods();
        // basket.calculateTotalSum();



      document.getElementById("email").value = localStorage.getItem("email");

    }
  });

  function populateDropDown(id, obj){
      let select = document.getElementById(id);
      select.onchange = function (){
          basket.reloadItems();
      }

      for(let i=0; i<obj.length;i++){
          let option = document.createElement("option");
          option.innerHTML = obj[i].dimos + " - " + obj[i].nomos;
          //option.id =obj[i].id;
          option.setAttribute("data-vatid", obj[i].vatid);
          option.value =obj[i].id;
          select.appendChild(option);
      }


  }




</script>