<?php

class BoxOwner {
    private $mysql;
	private $password;

    function __construct($conn) {
        $this->mysql = $conn;   // Connect to the DB
		$this->password = "AAA"; // Store here instead of Front-End
    }
	
    // Vulnerable information (password) is stored on Server-side only
	public function IsValid($pwd) {
		return $pwd == $this->password;
    }

    public function IsPresent($fname, $lname) {		
	    // SQL Injection on Server: prevent escape script characters
		$fname = addslashes($fname);
		$lname = addslashes($lname);

		$q  = "SELECT * FROM `postboxes` ";
        $q .= " WHERE FirstName ='$fname' AND LastName = '$lname'";
        $result = mysqli_query($this->mysql, $q);

        return mysqli_num_rows($result) > 0; 
    }

    public function IsOwner($fname, $lname, $phone) {
	    // SQL Injection on Server: prevent escape script characters
		$fname = addslashes($fname);
		$lname = addslashes($lname);
		$phone = addslashes($phone);

        $q  = "SELECT * FROM `postboxes` WHERE FirstName = '$fname' ";
        $q .= " AND Lastname ='$lname' ";
        $q .= " AND Phone ='$phone' ";
        $result = mysqli_query($this->mysql, $q);

        return mysqli_num_rows($result) > 0; 
    }

    public function SanityCheck($box, $fname, $lname, $phone, $changed) {
        if($changed && $this->IsOwner($fname, $lname, $phone)) 
            echo "The lecturer ".$fname." ".$lname." already owns a box"; 
        elseif(empty($box))   echo "Box number should be provided"; 
        elseif(empty($fname)) echo "First name should be provided"; 
        elseif(empty($lname)) echo "Last name should be provided"; 
        elseif(empty($phone)) echo "Phone number should be provided"; 
        else {return true;}
        return false;
    }

    public function CreateBoxOwner($params) {
		// SQL Injection on Server: prevent escape script characters
		$fname =    isset($params['boxOwnerFName']) ? addslashes($params['boxOwnerFName'])  : "";
        $lname =    isset($params['boxOwnerLName']) ? addslashes($params['boxOwnerLName'])  : "";
        $box =      isset($params['boxNumber'])     ? addslashes($params['boxNumber'])      : "";
        $phone =    isset($params['phone'])         ? addslashes($params['phone'])          : "";
        
		// Check that inputs are acceptable:
		if($this->SanityCheck($box, $fname, $lname, $phone, true)) {	    
			$q = "INSERT INTO `postboxes` (`FirstName`, `LastName`, `BoxNumber`, `Phone`) ";
			$q .= " VALUES ('$fname', '$lname', '$box', '$phone')";

			$result = mysqli_query($this->mysql, $q);
			return true;
		} 
		else  
            return false; 
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
		// SQL Injection on Server: prevent escape script characters
        $fname = isset($params['fname']) ? addslashes($params['fname']) : "";
        $lname = isset($params['lname']) ? addslashes($params['lname']) : "";
        $phone = isset($params['phone']) ? addslashes($params['phone']) : "";
        $box =   isset($params['box'])   ? addslashes($params['box']) : "";
        $id =    isset($params['id'])    ? $params['id'] : -1;

		if(($id > 0) && ($this->SanityCheck($box, $fname, $lname, $phone, $isChanged))) {
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
}