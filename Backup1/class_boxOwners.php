<?php

class BoxOwner {
    private $mysql;
 
    function __construct($conn) {
        $this->mysql = $conn;   // Connect to the DB
    }

    public function IsInUse($box) {
        $q  = "SELECT * FROM `postboxes` WHERE BoxNumber ='$box'";
        $result = mysqli_query($this->mysql, $q);

        return mysqli_num_rows($result) > 0; 
    }

    public function IsPresent($fname, $lname) {
        $q  = "SELECT * FROM `postboxes` ";
        $q .= " WHERE FirstName ='$fname' AND LastName = '$lname'";
        $result = mysqli_query($this->mysql, $q);

        return mysqli_num_rows($result) > 0; 
    }

    public function IsOwner($fname, $lname, $phone) {
        $q  = "SELECT * FROM `postboxes` WHERE FirstName = '$fname' ";
        $q .= " AND Lastname ='$lname' ";
        $q .= " AND Phone ='$phone' ";
        $result = mysqli_query($this->mysql, $q);

        return mysqli_num_rows($result) > 0; 
    }

    public function SanityCheck($box, $fname, $lname, $phone) {
        // "nl2br()" function used to support new lines in echoed string:
        if($this->IsOwner($fname, $lname, $phone)) { echo "The lecturer ".$fname." ".$lname." already owns a box"; }
        elseif(empty($box)) { echo "Box number should be provided"; }
        elseif(empty($fname)) { echo "First name should be provided"; }
        elseif(empty($lname)) { echo "Last name should be provided"; }
        elseif(empty($phone)) { echo "Phone number should be provided"; }
        else {return true;}
        return false;
    }

    public function CreateBoxOwner($params) {
        $fname =    isset($params['boxOwnerFName']) ? $params['boxOwnerFName']  : "";
        $lname =    isset($params['boxOwnerLName']) ? $params['boxOwnerLName']  : "";
        $box =      isset($params['boxNumber'])     ? $params['boxNumber']      : "";
        $phone =    isset($params['phone'])         ? $params['phone']          : "";
        
        if($this->IsInUse($box)) { 
            echo nl2br("The box ".$box." is already in use\r\nTry another one"); 
            return false;
        }
        else {
            // Check that inputs are acceptable:
            if($this->SanityCheck($box, $fname, $lname, $phone)) {
                $q = "INSERT INTO `postboxes` (`FirstName`, `LastName`, `BoxNumber`, `Phone`) ";
                $q .= " VALUES ('$fname', '$lname', '$box', '$phone')";

                $result = mysqli_query($this->mysql, $q);
                return true;
            } 
            else { return false; }
        }
    }

    public function GetOwner($box) {
        $q  = "SELECT * FROM `postboxes` ";
        $q .= "WHERE `postboxes`.`BoxNumber` = $box";
        $result = mysqli_query($this->mysql, $q);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function GetOwnersList() {
        $myQuery = "SELECT * FROM `postboxes` ";

        // Get a table of all the users:
        $result = mysqli_query($this->mysql, $myQuery);
        $data = array();

        // Read each line from the "result" table:
        while($row = mysqli_fetch_assoc($result)){ // "While "mysqli_fetch_assoc($result)" doesn't return null"
            $data[] = $row;
        }
        return $data;
    }

    public function UpdateOwner($params) {
        $fname = isset($params['fname']) ? $params['fname'] : "";
        $lname = isset($params['lname']) ? $params['lname'] : "";
        $box =   isset($params['box']) ? $params['box'] : -1;
        $phone = isset($params['phone']) ? $params['phone'] : "";

        if($box > 0) {
            $q = "UPDATE `postboxes` SET ";
            $q .= " `FirstName` = '$fname', ";
            $q .= " `LastName` = '$lname', ";
            $q .= " `Phone` = '$phone', ";
            $q .= " `BoxNumber` = '$box' ";
            $q .= " WHERE `postboxes`.`BoxNumber` = $box ";

            $result = mysqli_query($this->mysql, $q);
            return true;
        }
        return false;
    }

    public function DeleteOwner($params) {
        $box = isset($params['btnDelete']) ? $params['btnDelete'] : "";

        $q = "DELETE FROM `postboxes` ";
        $q .= "WHERE `postboxes`.`BoxNumber` = '$box'";

        $result = mysqli_query($this->mysql, $q);
    }

}