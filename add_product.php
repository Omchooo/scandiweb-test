<?php
require_once('./includes/AddProduct.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  AddProduct::create($_POST);

  die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./public/css/app.css" />
  <title>Product Add</title>
</head>

<body>
  <div class="main">
    <div class="container">
      <div class="nav">
        <div class="nav-items">
          <h2>Product Add</h2>
        </div>
        <div class="nav-items">
          <button type="submit" class="btn" form="product_form">Save</button>
          <a href="index.php"><button class="btn">Cancel</button></a>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="error-messages">
        <span id="error" ></span>
      </div>
      <form method="POST" id="product_form" class="product-form">
        <div class="form-input-group">
          <div class="form-input">
            <label for="sku">SKU</label>
            <input type="text" name="sku" id="sku" />
          </div>
          <div class="form-input">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" />
          </div>
          <div class="form-input">
            <label for="price">Price ($)</label>
            <input type="number" name="price" id="price" />
          </div>
        </div>

        <!-- type switcher -->
        <div class="form-input">
          <label for="type">Type Switcher</label>
          <select name="type" id="productType">
            <option selected disabled hidden>Type Switcher</option>
            <option value="DVD" id="DVD">DVD</option>
            <option value="Furniture" id="Furniture">Furniture</option>
            <option value="Book" id="Book">Book</option>
          </select>
        </div>
        <div class="type-box">
          <!-- <div class="form-input">
                        <label for="size">Size (MB)</label>
                        <input type="text" name="size" id="size">
                    </div> -->
        </div>
      </form>
    </div>
    <div class="container">
      <span>Scandiweb Test assignment</span>
    </div>
  </div>
</body>

</html>

<script src="./public/js/app.js"></script>

<script>
  $(document).ready(function() {

    $('#product_form').submit(function(event) {
      event.preventDefault();

      var product = $('#product_form').serializeArray();
      var type;
      var measurement;
      var attribute;

      product.some(function(field) {
        if (field.name === 'type') {
          type = field.value;
          return true;
        }
      });

      measurement = arr[type].measurement;
      attribute = arr[type].attribute;

      // Add measurement to the product associative array
      product.push({
        name: "measurement",
        value: measurement
      }, {
        name: "attribute",
        value: attribute
      });
      console.log(product);

      $.ajax({
        url: "add_product.php",
        type: "POST",
        data: product,
        dataType: "json",
        success: function(response) {
          if (response.success) {
            // success
            // console.log(response.message);

            // Redirect to the index.php page
            var baseUrl = window.location.protocol + "//" + window.location.host;
            var indexUrl = baseUrl + "/index.php";
            window.location.href = indexUrl;

          } else {
            // error
            // console.log(response.message);
            $("#error").text(response.message);
          }
        },
      });
    });
  });
</script>

<script>
  $(function() {
    const productType = $("#productType");
    const typeBox = $(".type-box");

    productType.on("change", function() {
      const selectedType = productType.val();
      const typeObj = arr[selectedType];

      const inputTypes = [].concat(typeObj.type);
      const descriptionHtml = `<span>${typeObj.description}</span>`;
      const typeInputHtml = inputTypes.map(type => `
            <div class="form-input">
              <label for="${type}">${type} (${typeObj.measurement})</label>
              <input type="text" name="${type.toLowerCase()}" id="${type.toLowerCase()}">
            </div>
          `).join('');

      const fullInputHtml = typeInputHtml + descriptionHtml;
      typeBox.html(fullInputHtml);
    });
  });
</script>