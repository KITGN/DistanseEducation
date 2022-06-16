<?php
session_start();
include_once 'dbConnection.php';
?>
<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Система дистанционного обучения ООО “ЛокоТех-Сервис”</title>
  <link rel="shortcut icon" href="assets/img/lt.png">
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="style/styleAdm.css">
</head>

<body>
  <?php
  require_once("headerMain.php");
  require_once("mainUser.php");
  require_once("footer.php");
  ?>
</body>

</html>