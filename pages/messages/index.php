<?php

$user_id = $_COOKIE['user_id'];
$friend_id = $_GET['fid'];

?>

<script type="text/javascript">
  async function update() {
    const result = await $.ajax({
      type: "GET",
      url: "api/get/get-messages.php?fid=<?php echo($_GET['fid']); ?>",
      dataType: "html",
      success: function(data) {
        $('#messages').html(data);
      }
    });

    return result;
  }

  $(document).on('click', '#send', function(e) {
    var vmessage = $("#message").val();
    var vuser_id = "<?php echo($user_id); ?>";
    var vfriend_id = "<?php echo($friend_id); ?>";

    if(vmessage == "") {
      alert("Prosím napište zprávu před odesláním!");
    } else {
      $.post("api/post/post-message.php", {
        message: vmessage,
        user_id: vuser_id,
        friend_id: vfriend_id
      }, function() {
        update();

        document.getElementById("message").value = "";

        window.reload();
      });
    }
  });

  $(document).ready(function() {
    autoUpdate();

    $('#message').keypress(function(e){
      if(e.keyCode==13) {
        $('#send').click();
        window.reload();
      }
    });
  });

  async function autoUpdate() {
    setTimeout(1000, await update());

    await autoUpdate();
  }
</script>

<div class="row">
  <div class="col-md">
    <?php
      $sql = "SELECT * FROM `users` WHERE `id` LIKE '$friend_id'";

      $users = $db->query($sql);

      foreach($users as $u) {
        $username = $u['username'];
        $fullname = $u['fullname'];

        echo('<h2>' . $fullname . ' (' . $username . ')</h2>');
      }
    ?>
  </div>
</div>

<hr>

<div class="row">
  <div class="col-md">
    <div id="messages"></div>
    <hr>
    <div class="row">
      <div class="col-md">
        <form id="send_message" action="?p=messages&fid=<?php echo($friend_id); ?>" method="post">
          <textarea id="message" maxlength="255" placeholder="Zde napište zprávu dlouho maximálně 255 znaků..." autofocus required></textarea>
          <br>
          <input type="button" value="Odeslat" id="send">
        </form>
      </div>
      <div class="col-md">
        <a href="?p=friends&s=stats&fid=<?php echo($friend_id); ?>">Statistiky přátelství</a>
        <hr>
        <a href="?p=friends&s=delete&fid=<?php echo($friend_id); ?>">Odebrat přítele</a>
        <a href="?p=protected&s=delete-conversation-form&fid=<?php echo($friend_id); ?>">Odstranit konverzaci</a>
      </div>
    </div>
  </div>
</div>
