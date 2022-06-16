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
  <link rel="stylesheet" href="style/styleAdm.css">
  <link rel="stylesheet" href="style/style.css">
</head>
<?php
require_once("headerMain.php");
?>

<body>
  <main class="main">
    <div class="shadow">
      <?php
      $page = mysqli_query($con, "SELECT * FROM history WHERE email='$email' ORDER BY date DESC ") or die('Error197');
      echo  '
      <div class="start wrapper">
        <div class="start__content">
          <div class="content-section">
            <p class="content-section__subtitle"> 
            На этой странице вы можете посмотреть свои пройденные темы<br>
            В таблице указаны: тема, общее количество вопросов в <br>пройденном тесте, количество правильных ответов и ошибок, а также сколько баллов вы набрали
            </p>
          </div>
          <img src="assets/img/woman3.png" alt="woman" class="profile__image">
        </div>
      </div>
      <div class="homepage">Пройденные темы</div>
      <table class="table">
      <thead>
        <tr>
            <th>№</th>
            <th>Тема</th>
            <th>Всего вопросов</th>
            <th>Правильно</th>
            <th>Ошибок</th>
            <th>Баллов</th>
        </tr>
      </thead><tbody>';
      $c = 0;
      while ($row = mysqli_fetch_array($page)) {
        $idexam = $row['idexam'];
        $s = $row['score'];
        $w = $row['wrong'];
        $r = $row['rightanswers'];
        $qa = $row['numque'];
        $q23 = mysqli_query($con, "SELECT title FROM tests WHERE  idexam='$idexam' ") or die('Error208');
        while ($row = mysqli_fetch_array($q23)) {
          $title = $row['title'];
        }
        $c++;
        echo '<tr><td>' . $c . '</td><td>' . $title . '</td><td>' . $qa . '</td><td>' . $r . '</td><td>' . $w . '</td><td>' . $s . '</td></tr>';
      }
      echo '</tbody></table>';
      ?>

    </div>
  </main>
</body>

<?php
require_once("footer.php");
?>

</html>