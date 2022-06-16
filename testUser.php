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
      if (@$_GET['page'] == 'tests' && @$_GET['step'] == 2) {
        $idexam = @$_GET['idexam'];
        $rightanswer = @$_GET['n'];
        $total = @$_GET['t'];

        // Вопрос
        $page = mysqli_query($con, "SELECT * FROM questions WHERE idexam='$idexam' AND rightanswer='$rightanswer' ");
        echo '<div class="homepage"';
        while ($row = mysqli_fetch_array($page)) {
          $question = $row['question'];
          $idquestion = $row['idquestion'];
          echo '<span><h4 style="font-size: 25px; margin: 15px auto">Вопрос ' . $rightanswer . '<br><br>' . $question . ' </h4><br>';
        }
        // Варианты ответов
        $page = mysqli_query($con, "SELECT * FROM options WHERE idquestion='$idquestion' ");
        echo '<form action="update.php?page=tests&step=2&idexam=' . $idexam . '&n=' . $rightanswer . '&t=' . $total . '&idquestion=' . $idquestion . '" method="POST">';
        while ($row = mysqli_fetch_array($page)) {
          $option = $row['option'];
          $optionid = $row['optionid'];
          echo '<input style="transition: 5.3s background-color;" type="radio" name="ans" value="' . $optionid . '"> ' . $option . ' </span><br><br>';
        }
        echo '<button class="btn" type="submit">Далее</button></form></div><br>';
      }

      // Дисплей результата
      if (@$_GET['page'] == 'result' && @$_GET['idexam']) {
        $idexam = @$_GET['idexam'];
        $page = mysqli_query($con, "SELECT * FROM history WHERE idexam='$idexam' AND email='$email' ") or die('Error157');
        echo  '<div class="homepage">';
        while ($row = mysqli_fetch_array($page)) {
          $s = $row['score'];
          $w = $row['wrong'];
          $r = $row['rightanswers'];
          $qa = $row['numque'];
          echo '<h4 style="font-size: 25px; margin: 25px auto">Результат</h4><br>
                <div>Всего вопросов: ' . $qa . '</div><br>
                <div style="margin-top: 5px; color: #10d110">Правильных ответов: ' . $r . '</div><br>
                <div style="margin-top: 5px; color: #ff0000">Неправильных ответов: ' . $w . '</div><br>
                <div style="margin-top: 5px">Баллов: ' . $s . '</div><br><br>
                <a class="list__link1" id="btn" href="indexUser.php?page=1">Вернуться на главную страницу</a>';
        }
        echo '</div>';
      }
      ?>
    </div>
  </main>
</body>

<?php
require_once("footer.php");
?>

</html>