<?php

require_once('../../Database.php');

$db = new Database();

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

$sql = "SELECT * FROM `$id-messages` ORDER BY `id` DESC";

$messages = $db->query($sql);

foreach($messages as $m) {
  $text = $m['message'];
  $author_id = $m['author_id'];
  $author_name = "";

  $sql2 = "SELECT * FROM `users` WHERE `id` LIKE '$author_id'";

  $users = $db->query($sql2);

  foreach($users as $u) {
    $author_name = $u['username'];
  }

  $date = $m['date'];

  $date_today = date('d.m.Y');

  $date_before = date('d.m.Y', strtotime($date));
  $time_before = date('H:i:s', strtotime($date));

  if($date_before == $date_today) {
    $date_formated = $time_before;
  } else {
    $date_formated = $date_before . " " . $time_before;
  }

  echo('<p><b>' . $author_name . '</b> <i class="message-date">(' . $date_formated . ')</i>: ' . $text . '</p>');
}

?>
