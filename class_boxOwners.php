<?php

class BoxOwner {
    private $mysql;
 
    function __construct($conn) {
        $this->mysql = $conn;   // Connect to the DB
    }
   
    public function CreateBoxOwner($params) {
        $fname =    isset($params['boxOwnerFName']) ? $params['boxOwnerFName']  : "";
        $lname =    isset($params['boxOwnerLName']) ? $params['boxOwnerLName']  : "";
        $phone =    isset($params['boxNumber'])     ? $params['boxNumber']      : "";
        $box =      isset($params['phone'])         ? $params['phone']          : "";

        if(!empty($uname)) {
            $q = "INSERT INTO `postboxes` ( `FirstName`, `LastName`, `BoxNumber`, `Phone`) ";
            $q .= " VALUES ('$fname', '$lname', '$phone', '$box')";

            $result = mysqli_query($this->mysql, $q);
        }
    }
}