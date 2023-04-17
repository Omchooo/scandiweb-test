<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./public/css/app.css">

    <title>Product List</title>
</head>

<body>
    <div class="main">
        <div class="container">
            <div class="nav">
                <div class="nav-items">
                    <h2>Product List</h2>
                </div>
                <div class="nav-items">
                    <a href="add_product"><button class="btn">ADD</button></a>
                    <button class="btn" id="delete-product-btn">MASS DELETE</button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="box-field">
                <?php if (isset($result)) : ?>
                    <?php foreach ($result as $list) : ?>
                        <div class="box">
                            <input type="checkbox" name="checkbox" class="delete-checkbox" data-id="<?= $list->Id ?>">
                            <div class="box-content">
                                <span><?= $list->SKU ?></span>
                                <span><?= $list->Name ?></span>
                                <span><?= "$list->Price  $" ?></span>
                                <span><?= "$list->Type: $list->Size $list->Measurement" ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
        <div class="container">
            <span>Scandiweb Test assignment</span>
        </div>
    </div>


    <script src="./public/js/list.js"></script>
</body>

</html>