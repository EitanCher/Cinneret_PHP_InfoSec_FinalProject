<?php
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
    $myObj->DeleteOwner($_GET);
    header("Location: ".$_SERVER['PHP_SELF']);
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
        <h2>LIST OF USERS</h2>
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
                    <td>&nbsp;<?= $row['BoxNumber'] ?>&nbsp;</td>
                    <td>&nbsp;<?= $row['FirstName']." ".$row['LastName'] ?>&nbsp;</td>
                    <td>&nbsp;<?= $row['Phone'] ?>&nbsp;</td>
                    <td><a href="CRUD_Update.php?rbox=<?= $row['BoxNumber'] ?>"> &nbsp; EDIT &nbsp;</a> </td>
                    <td><form method="get">
                            <button name="btnDelete" value="<?= $row['BoxNumber'] ?>">&nbsp;&nbsp; DELETE &nbsp;&nbsp;</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    
</body>
</html>