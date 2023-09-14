<?php
session_start();

// Brute-Force: limiting log-in attempts using Session
if(!isset($_SESSION['ValidPwd'])){
    header("location: Login.php");
}

// Connect to the DB:
include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql = $mysql_obj->GetConn();

// Create an object connected to the DB, having all the relevant functions:
include "class_boxOwners.php";
$myObj = new BoxOwner($mysql);
// Get an array of Owners (each element is a line from the "postboxes" table):
$ownersList = $myObj->GetOwnersList();

if(isset($_GET['btnDelete'])) {
	if(isset($_GET['token']) && ($_GET['token'] == $_SESSION['TOKEN']) ){
        $myObj->DeleteOwner($_GET);
        header("Location: ".$_SERVER['PHP_SELF']);
    }
}

if(isset($_GET['btnCreate'])) {
	if(isset($_GET['token']) && ($_GET['token'] == $_SESSION['TOKEN']) ){
        header("Location: CRUD_Create.php");
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
    <title>Display Owners</title>
</head>
<body>
    <div id="container">    
        <h2>LIST OF POSTBOX OWNERS</h2>
		<form method="get" style="display: inline; background-color: black; border: none;">
            <input type="hidden" name="token" value="<?= $_SESSION['TOKEN'] ?>"/>
            <button name="btnCreate" value="1" style="width: 400px;">&nbsp;&nbsp; CREATE NEW OWNER &nbsp;&nbsp;</button>
		</form>
        <br><br>
        <table>
            <tr>
                <th>&nbsp;&nbsp; BOX &nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp; OWNER &nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp; PHONE &nbsp;&nbsp;</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            foreach ($ownersList as $row) { ?>
                <tr>
					<!--XSS: prevent special characters in inputs-->
					<td>&nbsp;<?= htmlspecialchars($row['BoxNumber']) ?>&nbsp;</td>
                    <td>&nbsp;<?= htmlspecialchars($row['FirstName']." ".$row['LastName']) ?>&nbsp;</td>
                    <td>&nbsp;<?= htmlspecialchars($row['Phone']) ?>&nbsp;</td>
                    <td><a href="CRUD_Update.php?rid=<?= $row['id'] ?>"> &nbsp; EDIT &nbsp;</a> </td>
                    <td>
						<form method="get">
                            <input type="hidden" name="token" value="<?= $_SESSION['TOKEN'] ?>"/>
        					<button name="btnDelete" value="<?= $row['id'] ?>">&nbsp;&nbsp; DELETE &nbsp;&nbsp;</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    
</body>
</html>