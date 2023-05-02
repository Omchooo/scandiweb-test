<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
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
          <a href="/"><button class="btn">Cancel</button></a>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="error-messages">
        <span id="error"></span>
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
            <option value="none" selected hidden>Type Switcher</option>
            <option value="DVD" id="DVD">DVD</option>
            <option value="Furniture" id="Furniture">Furniture</option>
            <option value="Book" id="Book">Book</option>
          </select>
        </div>
        <div class="type-box"></div>
      </form>
    </div>
    <div class="container">
      <span>Scandiweb Test assignment</span>
    </div>
  </div>



  <script src="./public/js/app.js"></script>
  <script src="./public/js/add.js"></script>
</body>

</html>