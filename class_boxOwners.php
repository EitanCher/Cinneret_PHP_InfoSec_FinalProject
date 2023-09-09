<?php

class BoxOwner {
    private $mysql;
 
    function __construct($conn) {
        $this->mysql = $conn;   // Connect to the DB
    }
   
    public function IsPresent($fname, $lname) {
        $q  = "SELECT * FROM `postboxes` ";
        $q .= " WHERE FirstName ='$fname' AND LastName = '$lname' ";
        $result = mysqli_query($this->mysql, $q);

        return mysqli_num_rows($result) > 0;
    }

    public function CreateBoxOwner($params) {
        $fname =    isset($params['boxOwnerFName']) ? $params['boxOwnerFName']  : "";
        $lname =    isset($params['boxOwnerLName']) ? $params['boxOwnerLName']  : "";
        $box =      isset($params['boxNumber'])     ? $params['boxNumber']      : "";
        $phone =    isset($params['phone'])         ? $params['phone']          : "";

        if(!empty($box)) {
            $q = "INSERT INTO `postboxes` (`FirstName`, `LastName`, `BoxNumber`, `Phone`) ";
            $q .= " VALUES ('$fname', '$lname', '$box', '$phone')";

            $result = mysqli_query($this->mysql, $q);
        }
    }
}