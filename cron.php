<?php
  include 'connect.php';

  //checks if the game is over and then sets up a new game if it is, to be run once every 2 minutes
  $statement = $pdo->prepare('SELECT * FROM fight');
  $statement->execute();
  $row = $statement->fetch(PDO::FETCH_ASSOC);

  if ($row['f1hp'] < 1 || $row['f2hp'] < 1) { //game is over, let's figure stuff out
    echo "NEW ROUND!<br />";
    if ($row['f1hp'] > 0) {
      echo "Doggo 1 won<br />";
      $statement = $pdo->prepare('UPDATE dogdir SET wins = wins + 1 WHERE id='.$row['f1id']);
      $statement->execute();
    } elseif ($row['f2hp'] > 0) {
      echo "Doggo 2 won<br />";
      $statement = $pdo->prepare('UPDATE dogdir SET wins = wins + 1 WHERE id='.$row['f2id']);
      $statement->execute();
    }

    $statement = $pdo->prepare("SELECT count(*) FROM dogdir");
    $statement->execute();
    $doggos = $statement->fetchColumn();
    echo "There are ".$doggos." doggos to choose from. Hmmm...<br />";

    $d1 = rand(1, $doggos);
    $d2 = rand(1, $doggos);

    while ($d2 == $d1){ //no clones plz
      $d2 = rand(1, $doggos);
    }

    $statement = $pdo->prepare("DELETE FROM fight");
    $statement->execute();

    $statement = $pdo->prepare("INSERT INTO fight (f1id, f2id) VALUES (".$d1.", ".$d2.");");
    $statement->execute();
  }

  $statement = $pdo->prepare('UPDATE fight SET f1en = f1en + '.$row['f2lvl'].', f2en = f2en + '.$row['f1lvl']);
  $statement->execute();
?>
