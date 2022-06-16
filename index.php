<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Система дистанционного обучения ООО “ЛокоТех-Сервис”</title>
  <link rel="stylesheet" href="style/styleAuth.css">
  <link rel="shortcut icon" href="assets/img/lt.png">

  <!-- Проверка введенных данных при регистраци -->
  <script>
    function validateForm() {
      var y = document.forms["form"]["name"].value;
      var letters = /^[A-Za-z]+$/;
      if (y == null || y == "") {
        alert("Введите имя");
        return false;
      }
      var x = document.forms["form"]["email"].value;
      var atpos = x.indexOf("@");
      var dotpos = x.lastIndexOf(".");
      if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
        alert("Неверный адрес электронной почты");
        return false;
      }
      var a = document.forms["form"]["password"].value;
      if (a == null || a == "") {
        alert("Введите пароль");
        return false;
      }
      if (a.length < 5 || a.length > 25) {
        alert("Длина пароля должна быть от 5 до 25 символов");
        return false;
      }
      var b = document.forms["form"]["cpassword"].value;
      if (a != b) {
        alert("Пароль не совпадают");
        return false;
      }
    }
  </script>

  <!-- Выводит сообщения с ошибкой ввода -->
  <?php
  if (@$_GET['w']) {
    echo '<script>alert("' . @$_GET['w'] . '");</script>';
  }
  ?>
</head>

<body>
  <header class="header">
    <div class="header_wrapper">
      <div class="logo">
        <span><img src="assets/img/Logo.png" width="220"></span>
      </div>
    </div>
  </header>
  <div class="modal" id="myModal">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Авторизация пользователя</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="login.php?page=index.php" method="POST">
          <div class="fieldset">
            <div class="form-group">
              <input class="log" id="email" name="email" placeholder="Введите Email" class="form-control" type="email">
            </div>
            <div class="form-group">
              <input class="log" id="password" name="password" placeholder="Введите Пароль" class="form-control1" type="password">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" id="myBtn">Войти</button>
          </div>
        </form>
        <button id="myBtn3" class="log1">Войти как админ</button>
      </div>
    </div>
  </div>
  <div class="modal1" id="myModal1">
    <div class="modal1-content">
      <div class="modal1-header">
        <div class="close">&times;</div>
        <h4>Авторизация администатора</h4>
      </div>
      <div class="modal1-body">
        <form class="form-horizontal" action="admin.php?page=index.php" method="POST">
          <div class="fieldset">
            <div class="form-group">
              <input class="log" id="email" name="uname" placeholder="Введите Email" class="form-control" type="email">
            </div>
            <div class="form-group">
              <input class="log" id="password" name="password" placeholder="Введите Пароль" class="form-control1" type="password">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" id="myBtn2">Войти</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php
  require_once("footer.php");
  ?>
  <script src="script/script.js"></script>
  <script src="script/script2.js"></script>
</body>

</html>