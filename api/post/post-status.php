<?php

require_once('../../Database.php');

$db = new Database();

$user_id = $_COOKIE['user_id'];
$status = $_POST['status'];

$sql = "INSERT INTO `status`
          (`text`, `author_id`)
        VALUES
          ('$status', '$user_id')";

$result = $db->query($sql);

?>
