<?php
include "../lib/php/function.php";

$notes_object = file_get_json("json_notes.json");
$users_array = file_get_json("users.json");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css" />
    <title>Notes</title>
</head>
<body>
    <div class="container">
        <div class="cardsoft">
            <h2>JSON Notes</h2>
            <ul>
                <?php
                        for($i=0;$i<count($notes_object->notes);$i++){
                            echo "<li>".$notes_object->notes[$i]."</li>\n";

                        }
                ?>
            </ul>
        </div>
        <div class="cardsoft">
            <h2>Users</h2>
            <ul>
                <?php
                        for($i=0;$i<count($users_array);$i++){
                            echo "<li> 
                            <strong> {$users_array[$i]->name} </strong> 
                            <span> {$users_array[$i]->email} </span> 
                            </li>\n";

                        }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>
