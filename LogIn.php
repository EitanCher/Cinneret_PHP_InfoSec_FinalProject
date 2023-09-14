<?php
session_start();

include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql = $mysql_obj->GetConn();

include "class_boxOwners.php";
$myObj = new BoxOwner($mysql);

// Brute-Force: limiting log-in attempts using Session
$gss = isset($_SESSION['gss']) ? $_SESSION['gss'] : 0;

if(isset($_GET['btnLogin'])) {
    $pwd =  (isset($_GET['pwd'])) ? $_GET['pwd'] : "";

    // Brute-Force: limiting log-in attempts using Session
	if (($gss < 5) && ($myObj->IsValid($pwd))) {
        $_SESSION['ValidPwd'] = 1;	
        $_SESSION['TOKEN'] = substr(md5(rand(100,999)),0,10);
        header("location: CRUD_Read_Delete.php");
    }
    else {
        echo "TRY AGAIN";
		$gss++;
    }
}

// Brute-Force: limiting log-in attempts using Session
$_SESSION['gss'] = $gss;

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
		<!-- SQL Injection on Client: prevent using apostrophe -->
		<form action="" method="get" onsubmit="return checkFormInjection()">
			<input type="text" name="pwd" class="input_to_check" placeholder="PASSWORD..." /><br>
            <button name="btnLogin" value="1">LOG IN</button>
        </form>
    </div>
	<script src="Script.js"></script>
</body>
</html>