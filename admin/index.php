<?php

include "../lib/php/functions.php";
include "../parts/templates.php";
include "../data/api.php";

setDefault('orderby_direction','DESC');
setDefault('orderby','date_create');
setDefault('limit','12');

$products = makeStatement("products_admin_all",[]);

$empty_product = (object)[
	"title" => "",
	"price" => "",
	"category" => "",
	"description" => "",
	"quantity" => "",
	"image_other" => "",
	"image_thumb" => ""
];

switch($_GET['crud']){

	case 'update':
	makeStatement("product_update",[
		$_POST['product_title'],
		$_POST['product_price'],
		$_POST['product_category'],
		$_POST['product_description'],
		$_POST['product_quantity'],
		$_POST['product_image_other'],
		$_POST['product_image_thumb'],
		$_GET['id']
	]);

	header("location:{$_SERVER['PHP_SELF']}?id={$_GET['id']}");
	break;

	case 'create':

	$id = makeStatement("product_insert",[
		$_POST['product_title'],
		$_POST['product_price'],
		$_POST['product_category'],
		$_POST['product_description'],
		$_POST['product_quantity'],
		$_POST['product_image_other'],
		$_POST['product_image_thumb']
	]);

	header("location:{$_SERVER['PHP_SELF']}?id=$id");
	break;

	case 'delete':

	makeStatement("product_delete",[
		$_GET['id']
	]);

	header("location:{$_SERVER['PHP_SELF']}");
	break;
}

function showProductPage($product){
	$id = $_GET['id'];

	// $thumbs = explode(",",$product->image_other);

	// $thumbs_elements = array_reduce($thumbs,function($r,$o){
	// 	return $r."<img src='/img/store/$o'>";
	// });

	$addoredit = $id == 'new' ? 'Add' : 'Edit';
	$createorupdate = $id == 'new' ? 'create' : 'update';

	$productdata = $id == 'new' ? '' : <<<HTML
    <div class="col-12 col-sm-12 col-md-12">
        <h1 class="float-left mt-100">Delete Product</h1>
            </div>
        <div class="col-12 col-sm-12 col-md-12">
        	<div class="cardsoftnew">
            	<div class="container">
                	<div class="row">
                        <div class="col-2 col-sm-2 col-md-2 text-center">
                            <img src="/img/store/$product->image_thumb" width="100%" height="100%" class="cartimage" alt="" />
                        </div>
                        <div class="col-1"></div>
                        <div class="col-2 col-sm-3 col-md-3 flex-align-center">
                            <h2 class="pronamecart">$product->title</h2>
                            <p class="probrandcart">Apple</p>
                            <h3 class="propricecart">&dollar;$product->price</h3>
                        </div>
                        <div class="col-5"></div>
                        <div class="col-2 justify-center">
                        	<button class="btndelete" type="submit">
							<a href="{$_SERVER['PHP_SELF']}?id=$id&crud=delete">Delete</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
HTML;
	echo <<<HTML
    <div class="col-12 col-sm-12 col-md-12">
        <button class="btnaddnew"><a href="{$_SERVER['PHP_SELF']}">Back</a></button>
    </div>
	<div class="row">
		$productdata
                <div class="col-12 col-sm-12 col-md-12">
                    <h1 class="float-left mt-70">$addoredit Product</h1>
                </div>
                <div class="col-12 col-sm-12 col-md-12">
                    <div class="cardsoftnew">
                        <form action="{$_SERVER['PHP_SELF']}?id=$id&crud=$createorupdate" method="post">
                            <div class="container">
                                <div class="row">
                                    <div class="col-6 col-sm-12 col-md-12">
									<label for="product_title" class="labels">Title</label>
					<input id="product_title" name="product_title" type="text" placeholder="Type product title" 		class="productinput" value="$product->title">
                                    </div>
									<div class="col-6 col-sm-12 col-md-12">
									<label for="product_category" class="labels">Category</label>
					<input id="product_category" name="product_category" type="text" placeholder="Type product category" 		class="productinput" value="$product->category">
                                    </div>
									<div class="col-6 col-sm-12 col-md-12">
									<label for="product_price" class="labels">Price</label>
					<input id="product_price" name="product_price" type="text" placeholder="Type product price" 		class="productinput" value="$product->price">
                                    </div>
									<div class="col-6 col-sm-12 col-md-12">
									<label for="product_quantity" class="labels">Quantity</label>
					<input id="product_quantity" name="product_quantity" type="text" placeholder="Type product quantity" 		class="productinput" value="$product->quantity">
                                    </div>
									<div class="col-12 col-sm-12 col-md-12">
									<label for="product_description" class="labels">Description</label>
									<textarea id="product_description" class="textarea" placeholder="Type product description" cols="30" rows="10" name="product_description">
									$product->description
									</textarea>
                                    </div>
									<div class="col-6 col-sm-12 col-md-12">
									<label for="product_image_thumb" class="labels">Image Thumb</label>
					<input id="product_image_thumb" name="product_image_thumb" type="text" placeholder="Type image thumb" 		class="productinput" value="$product->image_thumb">
                                    </div>
									<div class="col-6 col-sm-12 col-md-12">
									<label for="product_image_other" class="labels">Image Other</label>
					<input id="product_image_other" name="product_image_other" type="text" placeholder="Type image other" 		class="productinput" value="$product->image_other">
                                    </div>
                                  <div class="col-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btnsave">Save</button>
                                  </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
			</div>	
HTML;	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css" />
    <title>Product Administration</title>
</head>
<body>
<header>
        <div class="container">
            <div class="row rowadmin">
                <div class="col-6 col-sm-12 col-md-6">
                    <a href="/admin/index.php" class="welcomeadmin">Welcome to Admin Panel!</a>
                </div>
                <div class="col-6 col-sm-12 col-md-6">
                    <button class="btnback"><a href="/index.php">Go to Home Page</a></button>
                </div>
            </div>
        </div>
    </header>
	<section>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                        <button class="btnaddnew"><a href="<?= $_SERVER['PHP_SELF'] ?>?id=new">Add New Product</a></button>
                </div>
            </div>
        </div>
    </section>
	<section>
		<div class="container">
			<?php
			if (isset($_GET['id'])) {
				showProductPage(
					$_GET['id'] == 'new' ?
					$empty_product :
					array_find($products,function($o){
						return $o->id==$_GET['id'];
					})
				);
			}
			else {
				?>
				<div class="row">
						<?= array_reduce($products,'makeAdminList'); ?>
				</div>

		<?php }	?>
		</div>
	</section>

</body>
</html>




