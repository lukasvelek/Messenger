<?php

require_once('../../Database.php');

$db = new Database();

$id = $_COOKIE['user_id'];

$sql_friends = "SELECT * FROM `friends`
                WHERE
                  `user1_id` LIKE '$id'
                OR
                  `user2_id` LIKE '$id'";

$friends = $db->query($sql_friends);

foreach($friends as $f) {
  $id1 = $f['user1_id'];
  $id2 = $f['user2_id'];

  //echo($id1 . ',' . $id2);

  $sql_status = "";

  if($id1 == $id) {
    // id2
    $sql_name = "SELECT * FROM `users` WHERE `id` LIKE '$id2'";
    $sql_status = "SELECT * FROM `status` WHERE `author_id` LIKE '$id2'";
  } else {
    // id1
    $sql_name = "SELECT * FROM `users` WHERE `id` LIKE '$id1'";
    $sql_status = "SELECT * FROM `status` WHERE `author_id` LIKE '$id1'";
  }

  $names = $db->query($sql_name);

  $username = "";
  $fullname = "";

  foreach($names as $n) {
    $username = $n['username'];
    $fullname = $n['fullname'];
  }

  $status = $db->query($sql_status);

  foreach($status as $s) {
    $text = $s['text'];
    $date = $s['date'];

    $date_today = date('d.m.Y');

    $date_before = date('d.m.Y', strtotime($date));
    $time_before = date('H:i:s', strtotime($date));

    $date_formatted = "";

    if($date_before == $date_today) {
      $date_formated = $time_before;
    } else {
      $date_formated = $date_before . " " . $time_before;
    }

    echo('
      <h2>' . $fullname . ' (' . $username . ')</h2><br>
      <p>' . $text . '</p><br>
      <p><i>' . $date_formatted . '</i></p>
      <hr>
    ');
  }
}

?>
