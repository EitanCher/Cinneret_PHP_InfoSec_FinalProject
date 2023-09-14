<?php

include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql = $mysql_obj->GetConn();

include "class_boxOwners.php";
$myObj = new BoxOwner($mysql);

if(isset($_GET['btnLogin'])) {
    $pwd =  (isset($_GET['pwd'])) ? $_GET['pwd'] : "";
    if ($pwd == "AAA") {
        header("location: CRUD_Read_Delete.php");
    }
    else {
        echo "TRY AGAIN";
    }
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="Style.css" rel="stylesheet">  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <div id="container">    
        <form action="" method="get">
            <input type="text" name="pwd" placeholder="PASSWORD..." /><br>
            <button name="btnLogin" value="1">LOG IN</button>
        </form>
    </div>
</body>
</html>


