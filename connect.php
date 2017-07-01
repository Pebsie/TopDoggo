<?php
$mysql_server = "localhost";
$mysql_dbname = "dog";
$mysql_username = "dog";
$mysql_password = "dog";

try {
  $pdo = new PDO('mysql:host='.$mysql_server.';dbname='.$mysql_dbname, $mysql_username, $mysql_password);
} catch (PDOException $e) {
  die('Unable to connect to MySQL server. Ensure you\'ve filled in the settings.php file correctly.');
}
?>
