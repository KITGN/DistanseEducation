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
      if (@$_GET['page'] == 'tests' && @$_GET['step'] == 1) {
        $idexam = @$_GET['idexam'];
        $lecture = $row['lecture'];
        $video = $row['video'];
        $rightanswer = @$_GET['n'];
        $total = @$_GET['t'];

        // Лекция
        $page = mysqli_query($con, "SELECT * FROM tests WHERE idexam='$idexam'") or die('Error157');
        echo  '<div class="homepage">';

        while ($row = mysqli_fetch_array($page)) {
          $lecture = $row['lecture'];
          $video = $row['video'];
          echo '
          <h4 style="font-size: 25px; margin: 25px auto">Лекция по теме</h4><br>
          <div style="margin: auto 100px">' . $lecture . '</div><br><br>
          <h4 style="font-size: 25px; margin: 25px auto">Вебинар по теме</h4><br>
          
          <div><iframe width="600" height="340" src="'  . $video .  '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
        }
        echo '</div>
        <form action="testUser.php?page=tests&step=2&idexam=' . $idexam . '&n=' . $rightanswer . '&t=' . $total . '" method="POST">
        <button id="myBtn" style="margin: 30px 0 30px 570px " type="submit">Далее</button></form></div><br>';
      }
      ?>
    </div>
  </main>
</body>

<?php
require_once("footer.php");
?>

</html>