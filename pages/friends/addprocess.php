<?php

$friend_id = $_GET['id']; // friend_id

$user_id = $_COOKIE['user_id'];

$sql = "SELECT * FROM `friends`
        WHERE
          (`user1_id` LIKE '$user_id' AND `user2_id` LIKE '$friend_id')
        OR
          (`user2_id` LIKE '$user_id' AND `user1_id` LIKE '$friend_id')";

$result = $db->query($sql);

$id = "";

foreach($result as $r) {
  $id = $r['id'];
}

if($id == "" || is_null($id)) {
  $sql = "INSERT INTO `friends` (`user1_id`, `user2_id`)
          VALUES ('$user_id', '$friend_id')";

  $result = $db->query($sql);

  $sql = "SELECT `id` FROM `friends`
          WHERE
            (`user1_id` LIKE '$user_id' AND `user2_id` LIKE '$friend_id')
          OR
            (`user2_id` LIKE '$user_id' AND `user1_id` LIKE '$friend_id')";

  $result = $db->query($sql);

  $entry_id = "";

  foreach($result as $r) {
    $entry_id = $r['id'];
  }

  $sql = "CREATE TABLE IF NOT EXISTS `$entry_id-messages` (
            `id` INT(16) PRIMARY KEY AUTO_INCREMENT NOT NULL,
            `author_id` INT(16) NOT NULL,
            `message` VARCHAR(255) NOT NULL,
            `date` TIMESTAMP NOT NULL DEFAULT current_timestamp()
          )";

  $result = $db->query($sql);
}

 header('Location: ?p=home');

?>
