
<?php

$sql = new mysqli(
  $_ENV["HOST"],
  $_ENV["USERNAME"],
  $_ENV["PASSWORD"],
  $_ENV["DATABASE_NAME"],
  $_ENV["PORT"]
);

if ($sql->connect_error) {
  die("Connection failed: " . $sql->connect_error);
}


?>