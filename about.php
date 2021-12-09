<?php
    include_once("lib/php/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>About Us</title>
</head>
<body>
    <?php include "parts/navbar.php" ?>
    <section>
      <div class="view-window" style="background-image: url(img/about.jpg)">
        <h2>About Us</h2>
      </div>
    </section>
    <section>
      <div class="container">
        <div class="row whatsnewrow">
          <div class="col-6 col-sm-12 col-md-12">
              <img src="img/tech.jpg" class="image" alt="tech">
          </div>
          <div class="col-6 col-sm-12 col-md-12">
            <h1 class="whatsnew">What's New?</h1>
            <p class="whatsnewtext">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis neque aperiam unde nemo earum animi minima fugiat officiis distinctio iure! Veniam voluptates dicta tempora laboriosam dignissimos vel reiciendis, sint possimus.</p>
          </div>
        </div>
      </div>
    </section>
    <section>
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-12 col-sm-12 text-center">
              <h1 class="whyhystore">Why HY Store?</h1>
            </div>
            <div class="col-4 col-sm-12 col-md-6 mt-50 text-center">
                <img src="img/support.svg" width="100" height="100" alt="support">
                <h1 class="servicename">7/24 Service</h1>
                <p class="servicetext">Lorem ipsum dolor sit amet consectetur adipisicing elit. In, reiciendis ut, iste minima assumenda unde corrupti cumque perferendis.</p>
            </div>
            <div class="col-4 col-sm-12 col-md-6 mt-50 text-center">
              <img src="img/shipping.svg" width="100" height="100" alt="shipping">
              <h1 class="servicename">Free Shipping</h1>
              <p class="servicetext">Lorem ipsum dolor sit amet consectetur adipisicing elit. In, reiciendis ut, iste minima assumenda unde corrupti cumque perferendis.</p>
          </div>
          <div class="col-4 col-sm-12 col-md-6 mt-50 text-center">
            <img src="img/warranty.svg" width="100" height="100" alt="warranty">
            <h1 class="servicename">Unlimited Warranty</h1>
            <p class="servicetext">Lorem ipsum dolor sit amet consectetur adipisicing elit. In, reiciendis ut, iste minima assumenda unde corrupti cumque perferendis.</p>
        </div>
          </div>
        </div>
      </section>
    <?php include "parts/footer.php" ?>
</body>
</html>