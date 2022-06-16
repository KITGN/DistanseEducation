<?php
include_once 'dbConnection.php';
session_start();
$email = $_SESSION['email'];

// удалить пользователя
if (isset($_SESSION['key'])) {
  if (@$_GET['delmail'] && $_SESSION['key'] == 'foradmin') {
    $delmail = @$_GET['delmail'];
    $r2 = mysqli_query($con, "DELETE FROM history WHERE email='$delmail' ") or die('Error');
    $result = mysqli_query($con, "DELETE FROM user WHERE email='$delmail' ") or die('Error');
    header("location:adminPanel.php?page=1");
  }
}

// удалить тест
if (isset($_SESSION['key'])) {
  if (@$_GET['page'] == 'deltest' && $_SESSION['key'] == 'foradmin') {
    $idexam = @$_GET['idexam'];
    $result = mysqli_query($con, "SELECT * FROM questions WHERE idexam='$idexam' ") or die('Error');
    while ($row = mysqli_fetch_array($result)) {
      $idquestion = $row['idquestion'];
      $r1 = mysqli_query($con, "DELETE FROM options WHERE idquestion='$idquestion'") or die('Error');
      $r2 = mysqli_query($con, "DELETE FROM answer WHERE idquestion='$idquestion' ") or die('Error');
    }
    $r3 = mysqli_query($con, "DELETE FROM questions WHERE idexam='$idexam' ") or die('Error');
    $r4 = mysqli_query($con, "DELETE FROM tests WHERE idexam='$idexam' ") or die('Error');
    $r4 = mysqli_query($con, "DELETE FROM history WHERE idexam='$idexam' ") or die('Error');
    header("location:adminPanel.php?page=0");
  }
}

// Добавить тест
if (isset($_SESSION['key'])) {
  if (@$_GET['page'] == 'addtests' && $_SESSION['key'] == 'foradmin') {
    $name = $_POST['name'];
    $total = $_POST['total'];
    $rightanswers = $_POST['right'];
    $lecture = $_POST['lecture'];
    $video = $_POST['video'];
    $wrong = $_POST['wrong'];
    $id = uniqid();
    $q3 = mysqli_query($con, "INSERT INTO tests VALUES  ('$id','$name' , '$rightanswers', '$lecture' , '$video' , '$wrong','$total', NOW())");
    header("location:adminPanel.php?page=2&step=2&idexam=$id&n=$total");
  }
  else {
    header("location:adminPanel.php?page=0");
  }
}

// Добавить вопросы
if (isset($_SESSION['key'])) {
  if (@$_GET['page'] == 'addquestion' && $_SESSION['key'] == 'foradmin') {
    $n = @$_GET['n'];
    $idexam = @$_GET['idexam'];
    $ch = @$_GET['ch'];
    for ($i = 1; $i <= $n; $i++) {
      $idquestion = uniqid();
      $question = $_POST['question' . $i];
      $q3 = mysqli_query($con, "INSERT INTO questions VALUES  ('$idexam','$idquestion','$question' , '$ch' , '$i')");
      $oaid = uniqid();
      $obid = uniqid();
      $ocid = uniqid();
      $odid = uniqid();
      $a = $_POST[$i . '1'];
      $b = $_POST[$i . '2'];
      $c = $_POST[$i . '3'];
      $d = $_POST[$i . '4'];
      $qa = mysqli_query($con, "INSERT INTO options VALUES  ('$idquestion','$a','$oaid')") or die('Error61');
      $qb = mysqli_query($con, "INSERT INTO options VALUES  ('$idquestion','$b','$obid')") or die('Error62');
      $qc = mysqli_query($con, "INSERT INTO options VALUES  ('$idquestion','$c','$ocid')") or die('Error63');
      $qd = mysqli_query($con, "INSERT INTO options VALUES  ('$idquestion','$d','$odid')") or die('Error64');
      $e = $_POST['ans' . $i];
      switch ($e) {
        case 'a':
          $idanswer = $oaid;
          break;
        case 'b':
          $idanswer = $obid;
          break;
        case 'c':
          $idanswer = $ocid;
          break;
        case 'd':
          $idanswer = $odid;
          break;
        default:
          $idanswer = $oaid;
      }
      $qans = mysqli_query($con, "INSERT INTO answer VALUES  ('$idquestion','$idanswer')");
    }
    header("location:adminPanel.php?page=0");
  }
}

// Начало теста
if (@$_GET['page'] == 'tests' && @$_GET['step'] == 2) {
  $idexam = @$_GET['idexam'];
  $rightanswer = @$_GET['n'];
  $total = @$_GET['t'];
  $ans = $_POST['ans'];
  $idquestion = @$_GET['idquestion'];
  $page = mysqli_query($con, "SELECT * FROM answer WHERE idquestion='$idquestion' ");
  while ($row = mysqli_fetch_array($page)) {
    $idanswer = $row['idanswer'];
  }
  if ($ans == $idanswer) {
    $page = mysqli_query($con, "SELECT * FROM tests WHERE idexam='$idexam' ");
    while ($row = mysqli_fetch_array($page)) {
      $rightanswers = $row['rightanswers'];
    }
    if ($rightanswer == 1) {
      $page = mysqli_query($con, "INSERT INTO history VALUES('$email','$idexam' ,'0','0','0','0',NOW())") or die('Error');
    }
    $page = mysqli_query($con, "SELECT * FROM history WHERE idexam='$idexam' AND email='$email' ") or die('Error115');

    while ($row = mysqli_fetch_array($page)) {
      $s = $row['score'];
      $r = $row['rightanswers'];
    }
    $r++;
    $s = $s + $rightanswers;
    $page = mysqli_query($con, "UPDATE `history` SET `score`=$s,`numque`=$rightanswer,`rightanswers`=$r, date= NOW()  WHERE  email = '$email' AND idexam = '$idexam'") or die('Error124');
  } else {
    $page = mysqli_query($con, "SELECT * FROM tests WHERE idexam='$idexam' ") or die('Error129');

    while ($row = mysqli_fetch_array($page)) {
      $wrong = $row['wrong'];
    }
    if ($rightanswer == 1) {
      $page = mysqli_query($con, "INSERT INTO history VALUES('$email','$idexam' ,'0','0','0','0',NOW() )") or die('Error137');
    }
    $page = mysqli_query($con, "SELECT * FROM history WHERE idexam='$idexam' AND email='$email' ") or die('Error139');

    while ($row = mysqli_fetch_array($page)) {
      $s = $row['score'];
      $w = $row['wrong'];
    }
    $w++;
    $page = mysqli_query($con, "UPDATE `history` SET `score`=$s,`numque`=$rightanswer,`wrong`=$w, date=NOW() WHERE  email = '$email' AND idexam = '$idexam'") or die('Error147');
  }
  if ($rightanswer != $total) {
    $rightanswer++;
    header("location:testUser.php?page=tests&step=2&idexam=$idexam&n=$rightanswer&t=$total") or die('Error152');
  } else {
    header("location:testUser.php?page=result&idexam=$idexam");
  }
}
