<?php
session_start();
if (isset($_SESSION['email'])) {
  session_destroy();
}
$homepage = @$_GET['page'];
header("location:$homepage");
