<?php
include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql = $mysql_obj->GetConn();

include "class_boxOwners.php";
$myObj = new BoxOwner($mysql);

// Brute-Force: limiting log-in attempts using HTML-Input:
$gss = isset($_GET['gss']) ? $_GET['gss'] : 0;

if(isset($_GET['btnLogin'])) {
    $pwd =  (isset($_GET['pwd'])) ? $_GET['pwd'] : "";
    
    // Brute-Force: limiting log-in attempts using HTML-Input:
    if(($gss < 5) && ($myObj->IsValid($pwd))) 
        header("location: CRUD_Read_Delete.php");
    else 
        echo "TRY AGAIN";
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
            <!--Brute-Force: limiting log-in attempts using HTML-Input:-->
			<input type="hidden" name="gss" value="<?= $gss ?>">
            <input type="text" name="pwd" placeholder="PASSWORD..." /><br>
            <button name="btnLogin" value="1">LOG IN</button>
        </form>
    </div>
</body>
</html>