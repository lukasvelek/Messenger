<?php

require_once('../../Database.php');

$db = new Database();

$uid = $_COOKIE['user_id'];

$q = $_GET['q'];

if(!is_null($q) || $q != "") {
  $sql = "SELECT * FROM `users`
          WHERE
            (`username` LIKE '%$q%' OR `fullname` LIKE '%$q%')
          AND
            (`id` NOT LIKE '$uid')";

  $users = $db->query($sql);

  foreach($users as $u) {
    $id = $u['id'];
    $username = $u['username'];
    $fullname = $u['fullname'];
    $picture = $u['profile_picture'];

    $picture_location = "";

    if($picture == "" || is_null($picture)) {
      $picture_location = "user-content/default/default.png";
    } else {
      $picture_location = "user-content/" . $id . '/' . $picture;
    }

    echo('<a href="?p=friends&s=addprocess&id=' . $id . '">
            <img src="' . $picture_location . '">
            ' . $fullname . ' (' . $username . ')
          </a>
          <hr>');
  }
}

?>
