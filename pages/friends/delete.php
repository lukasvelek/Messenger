<?php

$user_id = $_COOKIE['user_id'];
$friend_id = $_GET['fid'];

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

$sql = "DELETE FROM `friends` WHERE `id` LIKE '$id'";

$result = $db->query($sql);

header('Location: ?p=home');

?>
