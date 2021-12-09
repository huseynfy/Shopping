<?php

  include_once 'lib/php/functions.php';
  include_once 'parts/templates.php';

  $cart = getCartItems();

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Product Checkout</title>
</head>
<body>
    <?php 
        include "parts/navbar.php"
    ?>
    <section>
        <div class="container">
            <div class="cardsoft">
                <div class="row">
                    <div class="col-12 text-center">
                <h2>Product Checkout</h2>
            </div>

            <div class="mt-30 col-12 text-center">Fill in your info</div>
            <div class="col-2"></div>
            <div class="col-4 mb-20">
                <button class="btnedit"><a href="product_actions.php?action=reset-cart">Pay</a></button> 
                </div>
                <div class="col-2"></div>
                <div class="col-4 mb-20 float-right"> 
                    <button class="btndelete"><a href="./">Cancel</a></button>
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php include "parts/footer.php" ?>
</body>
</html>