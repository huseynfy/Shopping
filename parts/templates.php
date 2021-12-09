<?php

function makeProductList($r,$o){
	return $r.<<<HTML
	<div class="col-4 col-sm-12 col-md-6 productbox cardsoft"> 
	<a href="product_item.php?id=$o->id">
		<figure>
		<img src="img/store/$o->image_thumb" class="image" alt="">
	<div class="row">
	<div class="col-12 prodetails">
	<a href="product_item.php?id=$o->id" class="proname">$o->title</a>
	<a href="product_item.php?id=$o->id" class="probrand">Apple</a>
	<div>
	<img src="img/star.svg" width="20" height="20" class="star" alt="star">
	<img src="img/star.svg" width="20" height="20" class="star" alt="star">
	<img src="img/star.svg" width="20" height="20" class="star" alt="star">
	<img src="img/star.svg" width="20" height="20" class="star" alt="star">
	<img src="img/star.svg" width="20" height="20" class="star" alt="star">
	</div>
	<p class="proprice float-left">&dollar;$o->price</p>
	</div>
	</div>
	</figure>
	</a>
	</div>
	HTML;
}

function makeCartList($r,$o){
	$totalfixed = number_format($o->total,2,'.','');
	$selectamount = selectAmount($o->amount,10);
	
	return $r.<<<HTML
	<div class="col-2 col-sm-2 col-md-2 text-center">
			<img src="img/store/$o->image_thumb" width="100%" height="100%" class="cartimage">
		</div>
	<div class="col-1"></div>	
	<div class="col-2 col-sm-3 col-md-3 flex-align-center">
			<h2 class="pronamecart mt-30">$o->title</h2>
			<p class="probrandcart">Apple</p>
			<h3 class="propricecart">&dollar;$totalfixed</h3>
			</div>
			<div class="col-5"></div>
			<div class="col-2 justify-center">
			<form action="product_actions.php?action=update-cart-item" method="post" onchange="this.submit()">
		<input type="hidden" name="product-id" value="$o->id">
		<div class="form-select">
			$selectamount
			</div>
			</form>
		<form action="product_actions.php?action=delete-cart-item" method="post">
			<input type="hidden" name="product-id" value="$o->id">
			<input type="submit" value="Delete" class="btndeletecart">
		</form>
		</div>
	HTML;
}

function cartTotals(){
	$cart = getCartItems();

	$cartprice = array_reduce($cart,function($r,$o){return $r+$o->total;},0);

	$pricefixed = number_format($cartprice,2,'.','');

	$tax = number_format($cartprice*0.0725,2,'.','');
	$taxed = number_format($cartprice*1.0725,2,'.','');

	return <<<HTML
	<div class="card-section display-flex">
		<div class="flex-stretch"><strong>Sub Total</strong></div>
		<div class="flex-none">&dollar;$pricefixed</div>
	</div>
		<div class="card-section display-flex">
		<div class="flex-stretch"><strong>Taxes</strong></div>
		<div class="flex-none">&dollar;$tax</div>
	</div>
		<div class="card-section display-flex">
		<div class="flex-stretch"><strong>Total</strong></div>
		<div class="flex-none">&dollar;$taxed</div>
	</div>
		<div class="card-section">
		<button class="btncontinue mt-50 mb-30 float-right">
		<a href="product_checkout.php">Checkout</a>
		</button>
	</div>
	HTML;
}

function selectAmount($amount = 1,$total=10){
	$output = "<select name='product-amount' class='quantityinputcart mt-20'>";
	for ($i=1; $i <=$total; $i++) { 
		$output .= "<option ".($i==$amount? 'selected':'').">$i</option>";
	}
	$output .= "</select>";

	return $output;
}

function makeAdminList($r,$o){
	return $r.<<<HTML
	 <div class="col-12 col-sm-12 col-md-12">
                    <div class="cardsoftnew">
                        <div class="container">
                            <div class="row">
                              <div class="col-2 col-sm-2 col-md-2 text-center">
                                <img src="/img/store/$o->image_thumb" width="100%" height="100%" class="cartimage" alt="" />
                              </div>
                              <div class="col-1"></div>
                              <div class="col-2 col-sm-3 col-md-3 flex-align-center">
                                <h2 class="pronamecart">$o->title</h2>
                                <p class="probrandcart">Apple</p>
                                <h3 class="propricecart">&dollar;$o->price</h3>
                              </div>
                              <div class="col-5"></div>
                              <div class="col-2 justify-center">
                                <button class="btnedit" type="submit"><a href="?id=$o->id">Edit</a></button>
                                <button class="btnview" type="submit"><a href="/product_item.php?id=$o->id">View</a></button>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
HTML;
}
function makeRecommend($a){
	$products = array_reduce($a,'makeProductList');
	echo <<<HTML
	$products
	HTML;
}
 function recommendSimilar($cat,$id=0,$limit=3){
 	$result = MYSQLIQuery("
 		SELECT * 
 		FROM products 
 		WHERE `category` = '$cat' AND 
 		`id` <>$id 
 		ORDER BY rand() 
 		LIMIT $limit
 		");
 		makeRecommend($result);
	}
//  function recommendCategory($cat, $limit=3){
//  	$result = MYSQLIQuery("
//  		SELECT * 
//  		FROM products 
//  		WHERE `category` = '$cat'
//  		ORDER BY `date_create` DESC 
//  		LIMIT $limit
//  		");
//  		makeRecommend($result);
// 	}



?>