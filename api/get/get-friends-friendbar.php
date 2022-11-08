<?php

require_once('../../Database.php');

$db = new Database();

$user_id = $_COOKIE['user_id'];

$sql = "SELECT * FROM `friends` WHERE `user1_id` LIKE '$user_id' OR `user2_id` LIKE '$user_id'";

$users = $db->query($sql);

if($db->numRows($sql) == 0) {
  echo('Žádní přátelé');
} else {
  foreach($users as $u) {
    $friend_id = "";

    if($u['user1_id'] == $user_id) {
      $friend_id = $u['user2_id'];
    } else {
      $friend_id = $u['user1_id'];
    }

    $sql2 = "SELECT * FROM `users` WHERE `id` LIKE '$friend_id'";

    $userdata = $db->query($sql2);

    foreach($userdata as $ud) {
      $friend_name = $ud['username'];
      $friend_fullname = $ud['fullname'];
      $friend_picture = $ud['profile_picture'];

      $picture_location = "";

      if($friend_picture == "" || is_null($friend_picture)) {
        $picture_location = "user-content/default/default.png";
      } else {
        $picture_location = "user-content/" . $friend_id . '/' . $friend_picture;
      }

      echo('<a href="?p=messages&fid=' . $friend_id . '">
              <img src="' . $picture_location . '">
              ' . $friend_fullname . ' (' . $friend_name . ')
            </a>
            <hr>');
    }
  }
}

?>
