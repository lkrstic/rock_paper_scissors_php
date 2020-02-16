<?php
  if (isset($_POST['cancel']) ) {
    header("Location: index.php");
    return;
  }

  $salt = 'XyZzy12*_';
  $stored_hash = 'a8609e8d62c043243c4e201cbb342862';  // Pw is meow123

  $failure = false;
  $username = "user";
  //$password = "pass";

  if (isset($_POST['user']) && isset($_POST['pass'])) {
    if (strlen($_POST['user']) < 1 || strlen($_POST['pass']) < 1) {
      $failure = "Username and password are required";
    }
    else {
      $check = hash('md5', $salt.$_POST['pass']);
      if ($_POST['user'] == $username && $check == $stored_hash) {
        header("Location: game.php?user=".urlencode($_POST['user']));
        return;
      }
      else {
        $failure = "Username or password is incorrect";
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <?php require_once "bootstrap.php"; ?>
  <title>Login</title>
</head>
<body>
  <div class="container">
    <h1>Please log in</h1>
    <?php
      if ($failure !== false) {
        echo('<p style = "color:red;">'.htmlentities($failure)."</p>\n");
      }
    ?>
    <form method="POST">
      <label for="user">Username</label>
      <input type="text" name="user" id="user"><br/>
      <label for="pass">Password</label>
      <input type="password" name="pass" id="pass"><br/>
      <input type="submit" value="Log in">
      <input type="submit" name="cancel" value="Cancel">
    </form>
  </div>
</body>
</html>
