<?php

$password = $_POST['password'];
$password_hash = hash('sha512', $password);

$uid = $_COOKIE['user_id'];
$fid = $_POST['fid'];

if($password_hash == $_COOKIE['user_password']) {
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

  $sql = "DROP TABLE `$id-messages`";

  $result = $db->query($sql);

  header('Location: ?p=home');
}

?>
