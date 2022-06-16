<?php
include_once 'dbConnection.php';
ob_start();
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$name = stripslashes($name);
$name = addslashes($name);
$email = stripslashes($email);
$email = addslashes($email);
$password = stripslashes($password);
$password = addslashes($password);
$password = md5($password);
$q3 = mysqli_query($con, "INSERT INTO user VALUES  ('$name' , '$email' , '$password')");
if ($q3) {
  header("location:adminPanel.php?page=3");
} else {
  header("location:adminPanel.php?q7=Такой email уже существует");
}
ob_end_flush();

// Сессии в начало