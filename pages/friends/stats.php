<?php

$user_id = $_COOKIE['user_id'];
$friend_id = $_GET['fid'];

$sql_users = "SELECT `username`, `fullname` FROM `users` WHERE `id` LIKE '$friend_id'";

$users = $db->query($sql_users);

$username = "";
$fullname = "";

foreach($users as $u) {
  $username = $u['username'];
  $fullname = $u['fullname'];
}

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

$sql = "SELECT `id` FROM `$id-messages`";

$messages_count = $db->numRows($sql);

?>
<div class="row">
  <div class="col-md">
    <a href="?p=messages&fid=<?php echo($friend_id); ?>">&lt;- Zpět</a>
    <h2><?php echo($fullname . " ($username)"); ?></h2>
    <p><b>Počet zpráv:</b> <?php echo($messages_count); ?></p>
  </div>
</div>
