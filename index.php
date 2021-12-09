<?php
	include_once "lib/php/functions.php";
	include_once "parts/templates.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>HY Store</title>
    <?php include "parts/meta.php" ?>
  </head>
  <body>
      <?php include "parts/navbar.php"?>
      <section>
      <div class="view-window" style="background-image: url(img/apple.png)">
        <h2>Welcome to HY Store!</h2>
      </div>
    </section>
    <section>
    <div class="container">
      <div class="row">
        <div class="col-6 col-sm-12 col-md-12 mt-100">
            <a href="product_list.php" class="featuredpros">Featured Products
              <img src="img/right.svg" width="20" height="20" alt="right-arrow"></a>
          </div>
          <div class="col-6 col-sm-12 col-md-12 sort">
            Sort <a href=""><img src="img/down.svg" width="13" height="13" alt="drop-down"></a>
          </div>
          <?= array_reduce(MYSQLIQuery("SELECT * FROM products ORDER BY title DESC LIMIT 6"),'makeProductList'); ?>
      </div>
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
