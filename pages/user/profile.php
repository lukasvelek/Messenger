<?php

$user_id = "";
$username = "";
$fullname = "";
$profile_picture = "";

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

$sql_current = "SELECT * FROM `users` WHERE `id` LIKE '$user_id'";

$current = $db->query($sql_current);

foreach($current as $c) {
  $picture = $c['profile_picture'];

  $profile_picture = "";

  if($picture == "" || is_null($picture)) {
    $profile_picture = "user-content/default/default.png";
  } else {
    $profile_picture = "user-content/" . $username . '/' . $picture;
  }
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

  $sql_messages = "SELECT `id` FROM `$fid-messages`
                   WHERE
                    `author_id` LIKE '$user_id'";

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
    <img src="<?php echo($profile_picture); ?>" width="64" height="64">
    <?php

    if(!isset($_GET['id'])) {
      echo('<hr>
            <a href="?p=user&s=profilepicture_changeform&un=' . $username . '">Změnit profilovou fotku</a>');
    }

    ?>
  </div>
</div>
