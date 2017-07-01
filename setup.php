<?php
  include "connect.php";

  echo "<h2>Setting up database</h2>";
  echo "<h3>Doggo Directory</h3>";

  $statement = $pdo->prepare("CREATE TABLE dogdir (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name TEXT NOT NULL,
  wins INT(6) DEFAULT 0,
  img TEXT
  );");

  $statement->execute();

  echo "<h3>Pendong Doggo Directory</h3>";

  $statement = $pdo->prepare("CREATE TABLE pdogdir (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name TEXT NOT NULL,
  wins INT(6) DEFAULT 0,
  img TEXT,
  verfemail TEXT
  );");

  $statement->execute();

  echo "<h3>Current Fluffers</h3>";

  $statement = $pdo->prepare("CREATE TABLE fight (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    f1id INT(6) NOT NULL,
    f2id INT(6) NOT NULL,
    f1hp INT(6) DEFAULT 25,
    f2hp INT(6) DEFAULT 25,
    f1xp INT(6) DEFAULT 0,
    f2xp INT(6) DEFAULT 0,
    f1lvl INT(6) DEFAULT 1,
    f2lvl INT(6) DEFAULT 1,
    f1atk INT(6) DEFAULT 1,
    f2atk INT(6) DEFAULT 1,
    f1def INT(6) DEFAULT 0,
    f2def INT(6) DEFAULT 0
  );");

  $statement->execute();
?>
