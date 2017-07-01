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
  <a href='index.php'><h1>Top Doggo</h1></a>
  <h2>Two enter: one leaves</h2>
  <?php
    $name = $_POST['name'];
    $img = $_POST['img'];
    $email = $_POST['email'];

    if (!empty($name)) {
      include 'connect.php';

      $statement = $pdo->prepare("INSERT INTO pdogdir (name, img) VALUES ('".$name."', '".$img."')");
      $statement->execute();
      echo "<strong>Thank you for submitting ".$name." for consideration!</strong>";
    }

   ?>
  <h3>Submit your doggo</h3>
  <p>You can submit your own doggo here for consideration as a contestant  in a fight!</p>
  <p>There are no limits: submit as many as like as often as you like. Good submissions feature high quality images preferably cropped to a square and have fun names.</p>
  <form action="submit.php" method="post">
    <table>
      <tr><td>Name</td><td><input type="text" name="name"></td></tr>
      <tr><td>Image (URL)</td><td><input type="text" name="img"></td></tr>
      <tr><td>Your email <em>(optional)</em></td><td><input type="text" name="verifemail"></td></tr>
    </table>
    <input type="submit" value="Submit">
  </form>
