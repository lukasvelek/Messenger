<?php

class Database {
  private $conn;

  function __construct() {
    $this->conn = new mysqli("localhost", "root", "", "messenger");
  }

  function query($sql) {
    return $this->conn->query($sql);
  }
}

?>
