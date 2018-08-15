<?php
require "options.php";
$db = mysqli_connect($SERVER,$USER,$PASSWD);
mysqli_select_db($db,$UDB) or die('Ошибка подключения к базе данных');

?>