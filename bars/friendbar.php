<script type="text/javascript">
  $(document).ready(function() {
    $.ajax({
      type: "GET",
      url: "api/get/get-friends-friendbar.php",
      dataType: "html",
      success: function(data) {
        $('#friends').append(data);
      }
    });
  });
</script>

<div class="col-md-3" id="friends">
  <br>
  <a href="?p=user&s=profile">Můj profil</a>
  <a href="?p=home">Příspěvky</a>
  <a href="?p=logout">Odhlásit se</a>
  <hr>
  <a href="?p=friends&s=addform">Přidat uživatele</a>
  <hr>
</div>
