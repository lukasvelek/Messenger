<?php

require_once("../../Database.php");

$db = new Database();

$user_id = $_POST['user_id'];
$friend_id = $_POST['friend_id'];
$message = $_POST['message'];

$sql = "SELECT `id` FROM `friends`
        WHERE
          (`user1_id` LIKE '$user_id' AND `user2_id` LIKE '$friend_id')
        OR
          (`user2_id` LIKE '$user_id' AND `user1_id` LIKE '$friend_id')";

$result = $db->query($sql);

$id = "";

foreach($result as $r) {
  $id = $r['id'];
}

$sql = "INSERT INTO `$id-messages` (`author_id`, `message`)
        VALUES ('$user_id', '$message')";

$result = $db->query($sql);

?>
