<?php 
	 include_once 'lib/php/functions.php';

	 $product = MYSQLIQuery("SELECT * FROM products WHERE id = ".$_GET['id'])[0];

	 $cart_product = cartItemById($_GET['id']);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Added Product to Cart</title>
</head>
<body>
	 <?php include "parts/navbar.php" ?>
	 <section>
      <div class="container">
        <div class="cardsoft">
          <div class="row">
            <div class="col-12 text-center">
          <h2>Added <?= $product->title ?> To Cart</h2>
          <p>There are now <?= $cart_product->amount ?> of <?= $product->title ?> in your cart.</p>
        </div>
        <div class="col-1"></div>
          <div class="col-5 mt-30 mb-20">
              <button class="btnback">
                <a href="product_list.php">Back to Shopping</a>
              </button>
          </div>
            <div class="col-3 mt-30 mb-20">
              <button class="btncheckcart">
                <a href="product_cart.php">Check Cart</a>
              </button>
          </div>
          <div class="col-1"></div>
        </div>
        </div>
      </div>
    </section>
</body>
</html>