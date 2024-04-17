<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page Not Found | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/partials/css/404.css">
</head>

<body>

<main>
  <div id="page-not-found">
    <h1 id="msg">Sorry, Page Not Found!</h1>
    <button id="go-back" onclick="window.history.back()">Go Back</button>
  </div>
</main>

<?php include "./views/partials/scripts.php" ?>

</body>
</html>