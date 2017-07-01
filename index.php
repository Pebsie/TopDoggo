<html>
<head>
  <title>Top Doggo</title>
  <style>
    table, th, td {
      border: 1px solid black;
    }
    td {
      text-align: center;
    }
  </style>
</head>
<body>
  <center>
  <h1>Top Doggo</h1>
  <h2>Two enter: one leaves</h2>
  <p>Top Doggo is a multiplayer clicker game where players swear allegiance to one of two doggos and then fight for their victory over the other.</p>
  <p>To play choose one of the two doggos below to be your favorite and then click the option to lead your doggo to victory!!</p>
  <small><p>This game is a bit of fun. We love doggos of all varities and <em>do not</em> support actual violence against animals.</p></small>
  <h2>Today's doggos</h2>
  <table>
<?php

  include "connect.php";

  //grab fight info
  $statement = $pdo->prepare("SELECT * FROM fight");
  $statement->execute();
  $row = $statement->fetch(PDO::FETCH_ASSOC);

  //grab doggo1 info
  $statement = $pdo->prepare("SELECT * FROM dogdir WHERE id=".$row['f1id']);
  $statement->execute();
  $d1 = $statement->fetch(PDO::FETCH_ASSOC);

  //grab doggo2 info
  $statement = $pdo->prepare("SELECT * FROM dogdir WHERE id=".$row['f2id']);
  $statement->execute();
  $d2 = $statement->fetch(PDO::FETCH_ASSOC);

  echo "<tr><th>".$d1['name']." (Level ".$row['f1lvl'].")</th><th>".$d2['name']." (Level ".$row['f2lvl'].")</th></tr>";
  echo "<tr><td><img width='256' height='256' src='".$d1['img']."'></td><td><img width='256' height='256' src='".$d2['img']."'></td></tr>";
  echo "<tr><td>HP: ".$row['f1hp']."<br />ATK: ".$row['f1atk']."<br />DEF: ".$row['f1def']."</td>";
  echo "<td>HP: ".$row['f2hp']."<br />ATK: ".$row['f2atk']."<br />DEF: ".$row['f2def']."</td></tr>";
  echo "<tr><td><a href='index.php?a=f&d=1'><button>ATTACK</button></a></td>";
  echo "<td><a href='index.php?a=f&d=2'><button>ATTACK</button></a></td></tr>";

  //options for upgrading
  echo "<tr><td>This doggo has ".$row['f1xp']." XP!";
  if ($row['f1xp'] > 0) {
    echo "<br /><a href='index.php?a=hp&d=1'><button>+".$row['f1lvl']." HP</button></a><br /><a href='index.php?a=atk&d=1'><button>+".($row['f1lvl']/2)." ATK</button></a><br /><a href='index.php?a=def&d=1'><button>+".($row['f1lvl']/2)." DEF</button></a>";
  }
  echo "</td><td>This doggo has ".$row['f2xp']." XP!";
  if ($row['f2xp'] > 0) {
    echo "<br /><a href='index.php?a=hp&d=2'><button>+".$row['f2lvl']." HP</button></a><br /><a href='index.php?a=atk&d=2'><button>+".($row['f2lvl']/2)." ATK</button></a><br /><a href='index.php?a=def&d=2'><button>+".($row['f2lvl']/2)." DEF</button></a>";
  }
  echo "</td></tr></table><br />";

  $a = $_GET['a'];
  $d = $_GET['d'];
  if ($d == "1") { $od = "2"; $odname = $d2['name']; } elseif ($d == "2") { $od = "1"; $odname = $d1['name']; } //this saves us having to write out everything twice like we had to do above
  if ($a == "f") {
      $dmg = rand(1, $row['f'.$d.'atk']) - rand(1, $row['f'.$od.'def']);
      if ($dmg > 0) {
        $statement = $pdo->prepare("UPDATE fight SET f".$od."hp = f".$od."hp - ".$dmg);
        $statement->execute();

        echo "<strong>Dealt ".$dmg." damage to ".$odname."</strong>";

        $statement = $pdo->prepare("UPDATE fight SET f".$d."xp = f".$d."xp + 1");
        $statement->execute();

      } else {
        echo "<strong>Your attack missed!</strong>";
      }
  } elseif ($a == "hp") {
    
  }


 ?>
