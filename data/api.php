<?php

@include_once "../lib/php/functions.php";

function getRequires($props){
	foreach($props as $prop) {
		if(!isset($_GET[$prop])) return false;
	}
		return true;
}

function makeStatement($type,$params=[]){
	switch ($type) {
		case 'products_all':
			return MYSQLIQuery("SELECT * FROM `products` ORDER BY {$_GET['orderby']} {$_GET['orderby_direction']}
				LIMIT {$_GET['limit']}");
			break;

		case 'products_admin_all':
			return MYSQLIQuery("SELECT * FROM `products` ORDER BY date_create DESC");
			break;

		case 'product_by_id':
		if (!getRequires(['id'])) return 
			["error"=>"Missing Properties"];

		return MYSQLIQuery("SELECT * FROM `products` WHERE `id` =  ".$_GET['id']);
		break;

		case 'product_by_category':
		if (!getRequires(['category'])) return 
			["error"=>"Missing Properties"];

		return MYSQLIQuery("SELECT * FROM `products` WHERE `category` = '{$_GET['category']}' 
		ORDER BY {$_GET['orderby']} {$_GET['orderby_direction']} LIMIT {$_GET['limit']}");
		break;
		
		case 'price_above':
		if (!getRequires('price')) return 
			["error"=>"Missing Properties"];

		return MYSQLIQuery("SELECT * FROM `products` WHERE `price` > '{$_GET['price']}'
				ORDER BY `price` DESC 
				LIMIT {$_GET['limit']}");
			break;
		case 'price_below':
		if (!getRequires('price')) return 
			["error"=>"Missing Properties"];

		return MYSQLIQuery("SELECT * FROM `products` WHERE `price` < '{$_GET['price']}'
				ORDER BY `price` ASC 
				LIMIT {$_GET['limit']}");
			break;

			case "search":
				if(!getRequires('s')) return 
					["error"=>"Missing Properties"];
	
				return MYSQLIQuery("SELECT *
					FROM `products`
					WHERE `title` LIKE '%{$_GET['s']}%'
					ORDER BY {$_GET['orderby']} {$_GET['orderby_direction']}
					LIMIT {$_GET['limit']}
					");
				break;

		case 'product_insert':
			return MYSQLIQuery("INSERT INTO `products`
				(
					`title`,
					`price`,
					`category`,
					`description`,
					`quantity`,
					`image_other`,
					`image_thumb`,
					`date_create`,
					`date_modify`
				)
				VALUES 
				(
					'{$params[0]}',
					'{$params[1]}',
					'{$params[2]}',
					'{$params[3]}',
					'{$params[4]}',
					'{$params[5]}',
					'{$params[6]}',
					NOW(),
					NOW()
				)
				");
			break;

			case 'product_update':
				return MYSQLIQuery("UPDATE `products`
					SET
					`title` = '{$params[0]}',
					`price` = '{$params[1]}',
					`category` = '{$params[2]}',
					`description` = '{$params[3]}',
					`quantity` = '{$params[4]}',
					`image_thumb` = '{$params[5]}',
					`image_other` = '{$params[6]}'
					WHERE `id` = {$params[7]}
					");
				break;
		case 'product_delete':
			return MYSQLIQuery("DELETE FROM `products` WHERE `id` = {$params[0]}");
			break;

		default:
		return ["error"=>"No matched type"];
		
	}
}






