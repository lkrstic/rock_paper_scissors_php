<?php

if ( ! isset($_GET['user']) ) {
  die('User parameter missing');
}

if( isset($_POST['logout'])) {
  header('location: index.php');
  return;
}

$names = array('Rock', 'Paper', 'Scissors');
$human = isset($_POST['human']) ? $_POST['human']+0 : -1;
$computer = rand(0,2);

function check($computer, $human) {
  if ($human == $computer) {
    return "Tie";
  } elseif (($human == 0 && $computer == 1) ||
            ($human == 1 && $computer == 2) ||
            ($human == 2 && $computer == 0) ) {
    return "You lose!";
  } elseif (($human == 0 && $computer == 2) ||
            ($human == 1 && $computer == 0) ||
            ($human == 2 && $computer == 1)) {
    return "You win!";
  }
}

$result = check($computer, $human);

?>
<!DOCTYPE html>
<html>
<head>
  <title>Rock, Paper, Scissors Game</title>
  <?php require_once "bootstrap.php"; ?>
</head>
<body>
  <div class="container">
    <h1>Let's Play Rock, Paper, Scissors</h1>
    <form method="POST">
      <select name="human">
        <option value="-1">--Select--</option>
        <option value="0">Rock</option>
        <option value="1">Paper</option>
        <option value="2">Scissors</option>
        <option value="3">Test</option>
      </select>
      <input type="submit" value="Play">
      <input type="submit" value="Logout" name="logout">
    </form>
<pre>
<?php
if ($human == -1) {
  echo "Please select a strategy and press Play.\n";
} elseif ($human == 3) {
  for ($c = 0; $c < 3; $c++) {
    for ($h = 0; $h < 3; $h++) {
      $r = check($c, $h);
      echo "Human=$names[$h] Computer=$names[$c] Result=$r \n";
    }
  }
} else {
  echo "Your play=$names[$human] Computer play=$names[$computer] Result=$result\n";
}
?>
</pre>
  </div>
</body>
</html>
