<?php

include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql = $mysql_obj->GetConn();

include "class_boxOwners.php";
$myObj = new BoxOwner($mysql);

if(isset($_GET['btnLogin'])) {
    $fname = (isset($_GET['fname'])) ? $_GET['fname'] : "";
    $lname = (isset($_GET['lname'])) ? $_GET['lname'] : "";
    $pwd =  (isset($_GET['pwd'])) ? $_GET['pwd'] : "";
    if ($pwd == "AAA" && $myObj->IsPresent($fname, $lname)) {
        header("location: DisplayOwners.php");
    }
    else {
        echo "TRY AGAIN";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="Lab1.css" rel="stylesheet">  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <div id="container">    
        <h2>IDENTIFY YOURSELF</h2>
        <form action="" method="get">
            <input type="text" name="fname" placeholder="FIRST NAME..." /><br>
            <input type="text" name="lname" placeholder="LAST NAME..." /><br>
            <input type="text" name="pwd" placeholder="PASSWORD..." /><br>
            <button name="btnLogin" value="1">LOG IN</button>
        </form>
    </div>
</body>
</html>


