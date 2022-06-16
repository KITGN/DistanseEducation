<?php
$con = new mysqli('localhost', 'root', '', 'oesm') or die("Не удалось подключиться к mysql" . mysqli_error($con));
mysqli_set_charset($con, "utf8");