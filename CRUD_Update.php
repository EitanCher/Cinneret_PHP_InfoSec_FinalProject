<?php
include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql = $mysql_obj->GetConn();

include "class_boxOwners.php";
$myObj = new BoxOwner($mysql);

if(isset($_GET['btnEdit'])) {
    // Check if owner's details changed or not:
	$isChanged = $_GET['fname'] != row['FirstName'] || $_GET['lname'] != row['LastName'] || $_GET['phone'] != row['Phone'];

	if($myObj->SanityCheck($_GET['box'], $_GET['fname'], $_GET['lname'], $_GET['phone'], $isChanged)) {
        $myObj->UpdateOwner($_GET);
        header("location:./CRUD_Read_Delete.php");
    }
}

$id = isset($_GET['rid']) ? $_GET['rid'] : -1;  //"rid" is passed by URL from "EDIT" link in "Read" page
$row = $myObj->GetOwner($id);

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
        <h2>UPDATE DETAILS</h2>
        <form action="" method="get">
            <input type="hidden" name="id" 	value="<?= $id ?>"/><br>
            <input type="text" name="box" 	value="<?= $row['BoxNumber'] ?>"/><br>
            <input type="text" name="fname" value="<?= $row['FirstName'] ?>"/><br>
            <input type="text" name="lname" value="<?= $row['LastName'] ?>"/><br>
            <input type="text" name="phone" value="0<?= $row['Phone'] ?>"/><br>
            <button name="btnEdit" value="1">UPDATE OWNER</button>
        </form>
    </div>
</body>
</html>
