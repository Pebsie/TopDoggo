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
  <?php
    $key = $_GET['key'];

    if ($key == "password") { //CHANGE THIS BEFORE UPLOADING TO YOUR WEB SERVER

      include 'connect.php';

      $a = $_GET['a'];
      $d = $_GET['d'];

      if ($a == "y") {

        $statement = $pdo->prepare('SELECT * FROM pdogdir');
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $statement = $pdo->prepare("INSERT INTO dogdir (name, img) VALUES ('".$row['name']."', '".$row['img']."'); DELETE FROM pdogdir WHERE id=".$d.";");
        $statement->execute();
        echo $row['name']." has joined the ranks!";

      } elseif ($a == "n") {

        $statement = $pdo->prepare("DELETE FROM pdogdir WHERE id=".$d);
        $statement->execute();
        echo "Removed submission #".$row['id'];

      }

      $sql = $pdo->prepare('SELECT * FROM pdogdir');
      $sql->execute();

      echo "<h2>Doggos awaiting response</h2>";

      foreach($sql->fetchAll(PDO::FETCH_ASSOC) as $dog) {
        echo "<h3>".$dog['name']."</h3><img width='256' height='256' src='".$dog['img']."'><br /><a href='mod.php?key=".$key."&a=y&d=".$dog['id']."'><button>Yes!</button></a> - <a href='mod.php?key=".$key."&a=n&d=".$dog['id']."'><button>No!</button></a>";
      }
    } else {
      echo "<h2>You need the secret passkey to get into this section of the site!</h2>";
    }
?>
