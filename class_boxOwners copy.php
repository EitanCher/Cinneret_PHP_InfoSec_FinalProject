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

        // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        //$enc_pass = $this->EncPass($passw);
        if(!empty($uname)) {
            $q = "INSERT INTO `postboxes` ( `UserName`, `Password`, `ValidUntil`) ";
            $q .= " VALUES ('$uname', '$enc_pass', '$valid_until')";

            $result = mysqli_query($this->mysql, $q);
        }
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

    public function UpdateUser($params) {
        $uname =        isset($params['uname']) ? $params['uname'] : "";
        $id =           isset($params['id']) ? $params['id'] : -1;
        $valid_until =  isset($params['valid']) ? $params['valid'] : "";

        if($id > 0 ) {
            $q = "UPDATE `postboxes` SET  ";
            $q .= "`UserName` = '$uname', ";
            $q .= "`ValidUntil` = '$valid_until'  ";
            $q .= " WHERE `users`.`userID` = $id ";

            $result = mysqli_query($this->mysql, $q);
        }

    }

    public function GetUser($id) {
        $q  = "SELECT * FROM `postboxes` ";
        $q .= "WHERE `users`.`userID` = $id";
        $result = mysqli_query($this->mysql, $q);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    
    public function DeleteUser($params) {
        $id = isset($params['btnDelete']) ? $params['btnDelete'] : "";

        $q = "DELETE FROM `postboxes` ";
        $q .= "WHERE `users`.`userID` = '$id'";

        $result = mysqli_query($this->mysql, $q);
    }

    private function EncPass($p) {
        $prefix = ((strlen($p) * 44) % 33);
        $siffix = ((strlen($p) * 55) % 33);
        return md5($prefix.$p.$siffix);
    }

    public function IsValid($u, $p) {
        $enc_pass = $this->EncPass($p);
        $q  = "SELECT * FROM `postboxes` ";
        $q .= " WHERE UserName ='$u' AND Password = '$enc_pass' ";
        $result = mysqli_query($this->mysql, $q);

        if(mysqli_num_rows($result) > 0)
            return true;
        return false;
    }
}