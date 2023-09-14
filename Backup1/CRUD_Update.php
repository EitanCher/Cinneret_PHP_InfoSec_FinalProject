<?php
include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql = $mysql_obj->GetConn();

include "class_boxOwners.php";
$myObj = new BoxOwner($mysql);

if(isset($_GET['btnEdit'])) {
    if($myObj->SanityCheck($_GET['box'], $_GET['fname'], $_GET['lname'], $_GET['phone'])) {
        $myObj->UpdateOwner($_GET);
        header("location:./CRUD_Read_Delete.php");
    }
}

$box = isset($_GET['rbox']) ? $_GET['rbox'] : -1;  //"rbox" is passed by URL from "EDIT" link in "Read" page
$row = $myObj->GetOwner($box);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="Style.css" rel="stylesheet">  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Owner</title>
</head>
<body>
    <div id="container">    
        <h2>UPDATE OWNER OF BOX #<?= $box ?></h2>
        <form action="" method="get">
            <input type="hidden" name="box" value="<?= $box ?>" readonly/>
            <input type="text" name="fname" value="<?= $row['FirstName'] ?>"/><br>
            <input type="text" name="lname" value="<?= $row['LastName'] ?>"/><br>
            <input type="text" name="phone" value="0<?= $row['Phone'] ?>"/><br>
            <button name="btnEdit" value="1">UPDATE OWNER</button>
        </form>
    </div>
</body>
</html>