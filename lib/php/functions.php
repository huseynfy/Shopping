<?php
session_start();

function print_p($d) {
	echo "<pre>",print_r($d),"</pre>";
}

function file_get_json($filename) {
	$file = file_get_contents($filename);
	return json_decode($file);
}




function MYSQLIConn() {
   include_once "auth.php";

   @$conn = new mysqli(...MYSQLIAuth());

   if($conn->connect_errno) die($conn->connect_error);

   $conn->set_charset('utf8');

   return $conn;
}


function MYSQLIQuery($sql) {
   $conn = MYSQLIConn();

   $a = [];

   $result = $conn->query($sql);
   if($conn->errno) die($conn->error);

   // while($row = $result->fetch_object())
   //    $a[] = $row;
   if (@$result->num_rows) {
      while ($row=$result->fetch_object()) {
         $a[] = $row;
      }
   }
   if (@$conn->insert_id) {
      return $conn->insert_id;
   }

   return $a;
} 


// cart functions


function array_find($array,$fn){
   foreach($array as $o) if($fn($o)) return ($o);
   return false;

}

function getCart(){
   return isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

}

function setCart($a){
   $_SESSION['cart'] = $a;
}

function resetCart(){
   $_SESSION['cart'] = [];

}

function cartItemById($id){
   return array_find(getCart(),function($o)use($id){ return $o->id==$id; });
}

function addToCart($id,$amount){
  $cart = getCart();
  $p = cartItemById($id);
  if($p) $p->amount = $amount;
  else {
      $cart[] = (object)[
         "id"=>$id,
          "amount"=>$amount
      ];
   }
   setCart($cart);
}

function getCartItems(){
   $cart = getCart();

   if(empty($cart)) return [];

   $ids = implode(",", array_map(function($o){return $o->id;},$cart));

   $products = MYSQLIQuery("SELECT * FROM products WHERE id in ($ids)");

   return array_map(function($o) use ($cart) {
      $p = cartItemById($o->id);
      $o->amount =$p->amount;
      $o->total = $p->amount * $o->price;;
      return $o;
   },$products);
}  

function makeCartBadge(){
   $cart = getCart();
   if(count($cart)==0){
      return "";
   }else{
      return array_reduce($cart,function($r,$o){return $r+$o->amount;});
   }
}

function setDefault($k,$v){
   if (!isset($_GET[$k])) $_GET[$k] = $v;
}




?>