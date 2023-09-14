<?php
include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql = $mysql_obj->GetConn();

include "class_boxOwners.php";
$myObj = new BoxOwner($mysql);

<<<<<<< HEAD
// In case the page is reopen due to incorrect inputs (false on SanityCheck function):
if (isset($_GET['err'])) {
    echo "Invalid values provided:<br>";
    echo "Either the lecturer already owns another postbox,<br>";
    echo "or some of the values are empty.";
}

$id = isset($_GET['rid']) ? $_GET['rid'] : -1;  //"rid" is passed by URL from "EDIT" link in "Read" page
$row = $myObj->GetOwner($id);

if(isset($_GET['btnEdit'])) {
    // Check if either of owner's details changed:
    $tmp_row = $myObj->GetOwner($_GET['id']);
    $isChanged = 
        ($_GET['fname'] != $tmp_row['FirstName']) || 
        ($_GET['lname'] != $tmp_row['LastName']) || 
        ($_GET['phone'] != $tmp_row['Phone']);

    if($myObj->UpdateOwner($_GET, $isChanged)) 
        header("location: ./CRUD_Read_Delete.php");
    else 	 
        // Reopen this page with error-message and keep the relevant input-values (prevent displaying errors in the inputs)
        header("location: ./CRUD_Update.php?rid=".$_GET['id']."&err=1");
}

=======
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

>>>>>>> c8960fc46266f73f5cc1401a950a22efb4e04ea0
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
<<<<<<< HEAD
        <form action="" method="get">	
			<input type="hidden" name="id" 	value="<?= $id ?>"/><br>
=======
        <form action="" method="get">
            <input type="hidden" name="id" 	value="<?= $id ?>"/><br>
>>>>>>> c8960fc46266f73f5cc1401a950a22efb4e04ea0
            <input type="text" name="box" 	value="<?= $row['BoxNumber'] ?>"/><br>
            <input type="text" name="fname" value="<?= $row['FirstName'] ?>"/><br>
            <input type="text" name="lname" value="<?= $row['LastName'] ?>"/><br>
            <input type="text" name="phone" value="<?= $row['Phone'] ?>"/><br>
            <button name="btnEdit" value="1">UPDATE OWNER</button>
        </form>
    </div>
</body>
</html>
