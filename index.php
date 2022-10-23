<?php

require_once('Database.php');

$db = new Database();

?>
<!DOCTYPE html>
<html lang="cs">
  <head>
    <title>Messenger</title>

    <meta charset="utf-8" name="CHARSET" content="UTF-8">
    <meta name="AUTHOR" content="Lukas Velek">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/jquery-3.6.1.min.js"></script>
  </head>

  <body>
    <div class="row">
      <?php

      if(!isset($_COOKIE['user_id']) && !isset($_GET['p'])) {
        header("Location: ?p=login&s=form");
      }

      if(isset($_COOKIE['user_id']) && isset($_GET['p'])) {
        include('bars/friendbar.php');
      }

      echo('<div class="col-md">');

      if(isset($_GET['p'])) {
        $p = htmlspecialchars($_GET['p']);

        if(isset($_GET['s'])) {
          $s = htmlspecialchars($_GET['s']);

          if(file_exists('pages/' . $p . '/' . $s . '.php')) {
            include('pages/' . $p . '/' . $s . '.php');
          } else if(file_exists(('pages/' . $p . '/' . $s . '.html'))) {
            include('pages/' . $p . '/' . $s . '.html');
          }
        } else {
          if(file_exists('pages/' . $p . '/index.php')) {
            include('pages/' . $p . '/index.php');
          } else if(file_exists('pages/' . $p . '/index.html')) {
            include('pages/' . $p . '/index.html');
          }
        }
      } else {
        if(isset($_COOKIE['user_username']) && isset($_COOKIE['user_password'])) {
          header('Location: ?p=home');
        }
      }

      echo('</div>');

      ?>
    </div>
  </body>
</html>
