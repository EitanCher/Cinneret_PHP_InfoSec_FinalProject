<?php
// Connect to the DB:
include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql = $mysql_obj->GetConn();

// Create an object connected to the DB, having all the relevant functions:
include "class_boxOwners.php";
$myObj = new BoxOwner($mysql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="Lab1.css" rel="stylesheet">  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Display Users</title>
</head>
<body>
    <div id="container">    
        <h2>LIST OF USERS</h2>
        
    </div>
</body>
</html>