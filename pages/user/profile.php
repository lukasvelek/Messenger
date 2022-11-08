<?php

$user_id = "";
$username = "";
$fullname = "";

if(isset($_GET['id'])) {
  $user_id = $_GET['id'];

  $sql = "SELECT * FROM `users` WHERE `id` LIKE '$user_id'";

  $users = $db->query($sql);

  foreach($users as $u) {
    $username = $u['username'];
    $fullname = $u['fullname'];
  }
} else {
  $user_id = $_COOKIE['user_id'];
  $username = $_COOKIE['user_username'];
  $fullname = $_COOKIE['user_fullname'];
}

$sql_friends =
       "SELECT `id` FROM `friends`
        WHERE
          `user1_id` LIKE '$user_id'
        OR
          `user2_id` LIKE '$user_id'";

$result_friends = $db->query($sql_friends);

$friends_count = $db->numRows($sql_friends);
$messages_count = 0;

$fid = "";

foreach($result_friends as $r) {
  $fid = $r['id'];

  $sql_messages = "SELECT `id` FROM `$fid-messages`";

  $count = $db->numRows($sql_messages);

  $messages_count = $messages_count + $count;
}

?>
<div class="row">
  <div class="col-md">
    <br>
    <h2><?php echo($fullname); ?></h2>
    <hr>
    <p><b>Celé jméno:</b> <?php echo($fullname); ?></p>
    <p><b>Uživatelské jméno:</b> <?php echo($username); ?></p>
    <p><b>Počet přátelství:</b> <?php echo($friends_count); ?></p>
    <p><b>Celkem odesláno zpráv:</b> <?php echo($messages_count); ?></p>
  </div>
</div>
