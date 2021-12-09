<?php 
  include_once 'lib/php/functions.php';

  switch($_GET['action']){	

  	case "add-to-cart":
  		addToCart($_POST['product-id'],$_POST['product-amount']);
  		header("location:product_added_to_cart.php?id={$_POST['product-id']}");
  		break;

  	case "update-cart-item":
  		$p = cartItemById($_POST['product-id']);
  		$p->amount = $_POST['product-amount'];
  		header("location:product_cart.php");
  		break;

  	case "delete-cart-item":
  		$_SESSION['cart'] = array_filter($_SESSION['cart'],function($o){
  			return $o->id != $_POST['product-id'];
  		});
  		header("location:product_cart.php");
  		break;

  	case "reset-cart":
  		resetCart();
  		header("location:product_confirmation.php");
  		break;

  	default: die("Incorrect Action");

  }


 ?>