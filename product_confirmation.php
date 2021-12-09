<?php

  include_once 'lib/php/functions.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
  <title>Thank You</title>
</head>
<body>
<?php include "parts/navbar.php" ?>
<section>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="thankyoutext">Thank you for your order!</h1>
                    <p class="confirmationtext">We'll you send the receipt and the order details in a minute!</p>
                    <p class="ordernumbertext">Order: #9999999</p>
                    <button class="btncontinue mt-50">
                      <a href="product_list.php">Continue Shopping</a>
                    </button>
                </div>
            </div>
        </div>
</section>
<?php include "parts/footer.php" ?>
</body>
</html>