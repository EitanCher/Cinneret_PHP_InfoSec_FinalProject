<?php

include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql = $mysql_obj->GetConn();

if(isset($_GET['btnCreate'])) {
    include "class_boxOwners.php";
    $myObj = new BoxOwner($mysql);
    $myResult = $myObj->CreateBoxOwner($_GET);
    
    if ($myResult) 
        header("location: CRUD_Read_Delete.php");
    else 
        echo $myResult;
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="Style.css" rel="stylesheet">  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Owner</title>
</head>
<body>
    <div id="container">    
        <h2>SET POSTBOX OWNER</h2>	
        <!--SQL Injection on Client: prevent using apostrophe	-->
		<form action="" method="get" onsubmit="return checkFormInjection()">
			<input type="text" name="boxOwnerFName" class="input_to_check" placeholder="FIRST NAME ..." /><br>
            <input type="text" name="boxOwnerLName" class="input_to_check" placeholder="LAST NAME..." /><br>
            <input type="text" name="phone" class="input_to_check" placeholder="PHONE..." /><br>
            <input type="text" name="boxNumber" class="input_to_check" placeholder="POSTBOX..." /><br>
            <button name="btnCreate" value="1">CREATE OWNER</button>
        </form>
    </div>
	<script src="Script.js"></script>
</body>
</html>