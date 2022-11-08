<?php

require_once('../../Database.php');

$db = new Database();

$username = $_GET['u'];
$result = "false";

$sql = "SELECT `id` FROM `users` WHERE `username` LIKE '$username'";

if($db->numRows($sql) > 0) {
  $result = "true";
}

echo $result;

?>
