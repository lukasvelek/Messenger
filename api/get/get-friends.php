<?php

require_once('../../Database.php');

$db = new Database();

$id = $_COOKIE['user_id'];

$sql = "SELECT * FROM `friends` WHERE `user1_id` LIKE '$id' OR `user2_id` LIKE '$id'";

$friends = $db->query($sql);

foreach($friends as $f) {
  $fid = "";

  if($id != $f['user1_id']) {
    $fid = $f['user1_id'];
  } else {
    $fid = $f['user2_id'];
  }

  $sql2 = "SELECT * FROM `users` WHERE `id` LIKE '$fid'";

  $frienddata = $db->query($sql2);

  foreach($frienddata as $fd) {
    $fusername = $fd['username'];
    $ffullname = $fd['fullname'];

    echo('<a href="?p=messages&fid=' . $fid . '">' . $ffullname . '</a>');
  }
}

?>
