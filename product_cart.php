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
    <title>Product Cart</title>
</head>
<body>
<?php include "parts/navbar.php" ?>
<section>
      <div class="container">
        <div class="row">
          <div class="col-6 mt-100 col-sm-12 col-md-12">
            <h1>Review Your Cart</h1>
          </div>
          <div
            class="col-6 float-right justify-right mt-100 col-sm-12 col-md-12"
          >
            <button class="btncontinue">
              <a href="product_list.php">Continue Shopping</a>
            </button>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container mt-30">
        <div class="row">
	<div class="col-12 col-md-12 col-sm-12">
	<div class="cardsoft">
	<div class="container">
	<div class="row">
                        <?= array_reduce($cart,'makeCartList');
                        ?>                   
		</div>
		</div>
		</div>
		</div>   
                <div class="col-md-12 col-sm-12 col-12">
                    <div class="cardsoft">
                        <div class="card-section">
                            <h2>Totals</h2>
                        </div>
                        <?= cartTotals() ?>
                    </div>
            </div>
                  </div>
                </div>
              </section>
    <?php include "parts/footer.php" ?>
</body>
</html>