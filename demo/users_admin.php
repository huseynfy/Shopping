<?php

include "../lib/php/function.php";

$filename = "users.json";
$users = file_get_json($filename);


$empty_user = (object)[
	"name"=>"",
	"type"=>"",
	"email"=>"",
	"classes"=>[]
];

switch(@$_GET['crud']){
	case "update":
		$users[$_GET['id']]->name = $_POST['user-name'];
		$users[$_GET['id']]->type = $_POST['user-type'];
		$users[$_GET['id']]->email = $_POST['user-email'];
		$users[$_GET['id']]->classes = explode(', ', $_POST['user-classes']);

		file_put_contents($filename,json_encode($users));

		header("location:{$_SERVER['PHP_SELF']}?id={$_GET['id']}");
		break;

	case "create":
			$empty_user->name = $_POST['user-name'];
			$empty_user->type = $_POST['user-type'];
			$empty_user->email = $_POST['user-email'];
			$empty_user->classes = explode(', ', $_POST['user-classes']);

			$id = count($users);

			$users[] = $empty_user;
			
			file_put_contents($filename, json_encode($users));

			header("location:{$_SERVER['PHP_SELF']}?id=$id");

			break;
 
	case "delete":
		array_splice($users, $_GET['id'],1);

		file_put_contents($filename,json_encode($users));

		header("location:{$_SERVER['PHP_SELF']}");
		break;
}


function showUserPage($user) {
$id = $_GET['id'];
$classes = implode(", ",$user->classes);
$addoredit = $id=='new' ? 'Add' : 'Edit';
$createorupdate = $id=='new' ? 'create' : 'update';

$userdata = $id=='new' ? '' : <<<HTML
<div class="cardsoft">
	<div class="display-flex">
		<h2 class="flex-stretch">$user->name</h2>
		<div>
			<a href="{$_SERVER['PHP_SELF']}?id=$id&crud=delete">
		<img src="../img/delete.svg" alt="delete-icon">
		</a>
	</div> 
	</div>
		<div>
		<strong>Type</strong>
		<span>$user->type</span>
		</div>
		<div>
		<strong>Email</strong>
		<span>$user->email</span>
		</div>
		<div>
		<strong>Classes</strong>
		<span>$classes</span>
		</div>
        </div>
HTML;

echo <<<HTML
<div class="cardsoft">
		<ul class="ul-users">
			<li><a href="{$_SERVER['PHP_SELF']}">Back</a></li>
</ul>
</div>
<div class="grid gap">
	<div class="col-sm-12 col-md-4 col-4">$userdata</div>
	<div class="col-sm-12 col-md-8 col-8">
		<div class="cardsoft">
			<form method="post" action="{$_SERVER['PHP_SELF']}?id=$id&crud=$createorupdate">
				<h2>$addoredit User</h2>
				<div class="form-control">
					<label for="user-name" class="form-label">Name</label>
					<input type="text" name="user-name" class="userinput" placeholder="Type User Name" id="user-name" 
					value="$user->name" />
				</div>
				<div class="form-control">
					<label for="user-type" class="form-label">Type</label>
					<input type="text" name="user-type" class="userinput" placeholder="Type User Type" id="user-type" 
					value="$user->type" />
				</div>
				<div class="form-control">
					<label for="user-email" class="form-label">Email</label>
					<input type="email" name="user-email" class="userinput" placeholder="Type User Email" id="user-email" 
					value="$user->email" />
				</div>
				<div class="form-control">
					<label for="user-classes" class="form-label">Classes</label>
					<input type="text" name="user-classes" class="userinput" placeholder="Type User Classes" id="user-classes" 
					value="$classes" />
				</div>
				<div class="form-control">
					<input class="btnsubmituser" type="submit" value="Save">
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
	<title>User Administration</title>
	<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css" />
</head>
<body>
	<header>
		<div class="container display-flex">
			<div class="flex-none">
				<h1>Users Admin</h1>
			</div>
			<div class="flex-stretch"></div>
			<nav class="nav flex-none">
				<ul class="ul-users">
					<li><a href="<?= $_SERVER['PHP_SELF'] ?>">List</a></li>
					<li><a href="<?= $_SERVER['PHP_SELF'] ?>?id=new">Add new user</a></li>
</ul>
</nav>
		</div>
	</header>

	<div class="container">
			<?php
			if(isset($_GET['id'])){
				showUserPage(
				$_GET['id']=='new' ? 
				$empty_user : 
				$users[$_GET['id']]);
			} 
			else {

			?>     
			<div class="cardsoft">
				<h2>User List</h2>
				<ul class="ul-users">
				<?php
				for($i=0; $i<count($users);$i++) {
					echo "
					<li> <a href='{$_SERVER['PHP_SELF']}?id=$i'>{$users[$i]->name}</a> </li>
					";
				}
				?>
				</ul>
				</div>
			<?php
				}
			?>
		</div>
</body>
</html>