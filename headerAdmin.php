<header class="header">
  <div class="header_wrapper">
    <div class="logo">
      <a href="adminPanel.php?page=0"><img src="assets/img/Logo.png" width="220"></a>
    </div>
    <nav class="menu">
      <ul class="list">
        <li class="list__item"><a class="list__link" href="adminPanel.php?page=0">Главная страница</a></li>
        <li class="list__item"><a class="list__link" href="adminPanel.php?page=1">Пользователи</a></li>
        <li class="list__item"><a class="list__link" href="adminPanel.php?page=2">Добавить курс</a></li>
        <li class="list__item"><a class="list__link" href="adminPanel.php?page=3">Добавить пользователя</a></li>
        <?php
        $email = $_SESSION['email'];
        if (!(isset($_SESSION['email']))) {
          header("location:index.php");
        } else {
          $name = $_SESSION['name'];

          echo '
            <li class="list__item" <span><span style="padding-right: 5px;">Добрый день,</span>' . $name . '<span style="padding: 0 5px;">|</span><a class="list__link" href="logout.php?page=index.php">Выйти</button></a></span>';
        } ?>
      </ul>
    </nav>
  </div>
</header>