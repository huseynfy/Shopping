<?php
	include_once "lib/php/functions.php";
	include_once "parts/templates.php";
  include_once "data/api.php";

  setDefault('s','');
  setDefault('t','products_all');
  setDefault('orderby_direction','DESC');
  setDefault('orderby','date_create');
  setDefault('limit','12');

  function makeSortOptions(){
    $options = [
      ["date_create","DESC","Latest Products"],
      ["date_create","ASC","Oldest Products"],
      ["price","DESC","Most Expensive"],
      ["price","ASC","Least Expensive"]
    ];
    foreach ($options as [$orderby,$direction,$title]) {
        echo "
          <option data-orderby='$orderby' data-direction='$direction'
        ".($_GET['orderby']==$orderby && $_GET['orderby_direction']==$direction ? "selected" : "").">
        $title
        </option>";
    }
  }

  function makeHiddenValues($arr1,$arr2){
    foreach (array_merge($arr1,$arr2) as $k=>$v) {
      echo "<input type='hidden' name='$k' value='$v'>\n";
    }
  }

  $result = makeStatement($_GET['t']);
  $products = isset($result['error']) ? [] : $result;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Product List</title>
</head>
<body>
      <?php include "parts/navbar.php" ?>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 mt-100">
        <a class="featuredpros">Featured Products</a>
          </div>
          <div class="col-8 col-sm-12 col-md-8 mt-70">
          <form action="product_list.php" method="get">  
            <input class="searchinput" type="search" name="s" placeholder="Search for a product"
            value="<?= @$_GET['s'] ?>">
            <?php
              makeHiddenValues([
                "orderby"=>$_GET['orderby'],
                "orderby_direction"=>$_GET['orderby_direction'],
                "limit"=>$_GET['limit'],
                "t"=>"search"
              ],[]);
            ?>
            <button type="submit" class="btnsearch">Search</button>
      </form>
    </div>
          <div class="col-4 col-sm-12 col-md-4 mt-70">
             <form action="product_list.php" method="get">
              <?php makeHiddenValues($_GET,[]); ?>
              <div class="forms">
                <select onchange="checkSort(this)" class="sortingSelection float-right">
                  <?php makeSortOptions() ?>
                </select>
              </div>
            </form>
          </div>
          <?= array_reduce($products,'makeProductList'); ?>
      </div>
    </div>
  </section>
      <?php include "parts/footer.php" ?>
    <script src="js/products.js"></script>
</body>
</html>

