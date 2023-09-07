<?php

    class mysql_conn {
    private $conn;

    function __construct() {
        include "db_params.php";    // This file is better to be external to make project structure more flexible
        $this->conn = new mysqli($db_host, $db_user, $db_pass, $db_schema);
    }

    function GetConn() {
        return $this->conn;
    }
}
