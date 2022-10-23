<?php

class Database {
  private $conn;

  function __construct() {
    $this->conn = new mysqli("localhost", "root", "", "messenger");
  }

  function query($sql) {
    return $this->conn->query($sql);
  }

  function numRows($sql) {
    $q = $this->query($sql);

    return $q->num_rows;
  }
}

?>
