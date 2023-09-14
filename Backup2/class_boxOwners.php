<?php

class BoxOwner {
    private $mysql;
	private $password;

    function __construct($conn) {
        $this->mysql = $conn;   // Connect to the DB
		$this->password = "AAA";
    }
<<<<<<< HEAD
	
    public function IsPresent($fname, $lname) {		
		$q  = "SELECT * FROM `postboxes` ";
=======

    public function IsPresent($fname, $lname) {
        $q  = "SELECT * FROM `postboxes` ";
>>>>>>> c8960fc46266f73f5cc1401a950a22efb4e04ea0
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

    public function SanityCheck($box, $fname, $lname, $phone, $changed) {
<<<<<<< HEAD
        if($changed && $this->IsOwner($fname, $lname, $phone)) 
            echo "The lecturer ".$fname." ".$lname." already owns a box"; 
        elseif(empty($box))   echo "Box number should be provided"; 
        elseif(empty($fname)) echo "First name should be provided"; 
        elseif(empty($lname)) echo "Last name should be provided"; 
        elseif(empty($phone)) echo "Phone number should be provided"; 
=======
        if($changed && $this->IsOwner($fname, $lname, $phone)) { 
            echo "The lecturer ".$fname." ".$lname." already owns a box"; 
        }
        elseif(empty($box))   { echo "Box number should be provided"; }
        elseif(empty($fname)) { echo "First name should be provided"; }
        elseif(empty($lname)) { echo "Last name should be provided"; }
        elseif(empty($phone)) { echo "Phone number should be provided"; }
>>>>>>> c8960fc46266f73f5cc1401a950a22efb4e04ea0
        else {return true;}
        return false;
    }

    public function CreateBoxOwner($params) {
        $fname =    isset($params['boxOwnerFName']) ? $params['boxOwnerFName']  : "";
        $lname =    isset($params['boxOwnerLName']) ? $params['boxOwnerLName']  : "";
        $box =      isset($params['boxNumber'])     ? $params['boxNumber']      : "";
        $phone =    isset($params['phone'])         ? $params['phone']          : "";
<<<<<<< HEAD
        		        
		// Check that inputs are acceptable:
		if($this->SanityCheck($box, $fname, $lname, $phone, true)) {	    
=======
        
		// Check that inputs are acceptable:
		if($this->SanityCheck($box, $fname, $lname, $phone, true)) {
>>>>>>> c8960fc46266f73f5cc1401a950a22efb4e04ea0
			$q = "INSERT INTO `postboxes` (`FirstName`, `LastName`, `BoxNumber`, `Phone`) ";
			$q .= " VALUES ('$fname', '$lname', '$box', '$phone')";

			$result = mysqli_query($this->mysql, $q);
			return true;
		} 
		else { return false; }
    }

    public function GetOwner($id) {
        $q  = "SELECT * FROM `postboxes` ";
        $q .= "WHERE `postboxes`.`id` = $id";
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

    public function UpdateOwner($params, $isChanged) {
        $fname = isset($params['fname']) ? $params['fname'] : "";
        $lname = isset($params['lname']) ? $params['lname'] : "";
        $phone = isset($params['phone']) ? $params['phone'] : "";
        $box =   isset($params['box'])   ? $params['box'] : "";
        $id =    isset($params['id'])    ? $params['id'] : -1;

<<<<<<< HEAD
		if(($id > 0) && ($this->SanityCheck($box, $fname, $lname, $phone, $isChanged))) {
=======
        if($id > 0) {
>>>>>>> c8960fc46266f73f5cc1401a950a22efb4e04ea0
            $q = "UPDATE `postboxes` SET ";
            $q .= " `FirstName` = '$fname', ";
            $q .= " `LastName` = '$lname', ";
            $q .= " `Phone` = '$phone', ";
            $q .= " `BoxNumber` = '$box' ";
            $q .= " WHERE `postboxes`.`id` = $id ";

            $result = mysqli_query($this->mysql, $q);
            return true;
        }
        return false;
    }

    public function DeleteOwner($params) {
        $id = isset($params['btnDelete']) ? $params['btnDelete'] : "";

        $q = "DELETE FROM `postboxes` ";
        $q .= "WHERE `postboxes`.`id` = '$id'";

        $result = mysqli_query($this->mysql, $q);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> c8960fc46266f73f5cc1401a950a22efb4e04ea0
