<?php
include_once "lib/php/functions.php";
include_once "parts/templates.php";

$product = MYSQLIQuery("SELECT * FROM products WHERE id = {$_GET['id']}")[0];

$thumbs = explode(",",$product->image_other);

$thumbs_elements = array_reduce($thumbs, function($r,$o){
   return $r."<img src='img/store/$o' class='singleproductimageother'>";
})

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>HYStore - <?= $product->title ?></title>
</head>
<body>
<?php include "parts/navbar.php"?>
<section>
        <div class="container">
            <div class="row singleproductrow">
                    <div class="col-3 col-sm-12 col-md-6">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12">
                                 <?= $thumbs_elements ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 col-sm-12 col-md-6">
                        <img src="img/store/<?= $product->image_thumb ?>" class="singleproductimagethumb" alt="">
                    </div>
                    <div class="col-4 col-sm-12 col-md-6">
                    <form action="product_actions.php?action=add-to-cart" method="post"> 
                        <input type="hidden" name="product-id" value="<?= $product->id ?>">
                        <h1 class="singleproductname"><?= $product->title ?></h1>
                        <h2 class="singleproductname">&dollar;<?= $product->price ?></h2>
                        <p class="singleproductdetail"><?= $product->description ?></p>
                        <label for="product-amount" class="quantitylabel">Quantity</label>
                        <input type="number" name="product-amount" class="quantityinput" value="1" min="1" max="10">
                        <button class="btncart" type="submit">Add to Cart</button>
                    </form>
                    </div>
                </div>
        </div>
    </section>
    <section>
        <div class="container">
          <div class="row whatsnewrow">
            <div class="col-6 col-sm-12 col-md-12">
                <h1 class="whatsnew mt-50">About <?= $product->title ?></h1>
                <p class="whatsnewtext"><?= $product->description ?></p>
              </div>
            <div class="col-6 col-sm-12 col-md-12">
                <img src="img/store/<?= $product->image_thumb ?>" class="imageabout" alt="">
            </div>
           
          </div>
        </div>
      </section>
      <section>
        <div class="container">
          <div class="row whatsnewrow">
            <div class="col-12">
              <h1>Related Products</h1>
            </div>
                <?= recommendSimilar($product->category,$product->id) ?>
          </div>
        </div>
      </section>
<?php include "parts/footer.php" ?>
</body>
</html>






