<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Мой блог</title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
<?php

require "options.php";


echo "<h1> Прогррамма установки </h1>";
$db = mysqli_connect($SERVER,$USER,$PASSWD);
if(!$db)
{
	echo "<h1> Ошибка сервера MySQL. MySQL server error</h1>";
	echo "</body></html>";
	exit;
}


$sql = "DROP DATABASE IF EXISTS `blog_2`;";
mysqli_query($db,$sql);
echo "<p>База данных blog успешно грохнута</p>";

$sql = "CREATE DATABASE IF NOT EXISTS `blog_2` CHARACTER SET='UTF8';";
mysqli_query($db,$sql);
echo "<p>База данных blog_2 создана заново</p>";



	mysqli_select_db($db,$UDB);


$sql = "CREATE TABLE  `blog_2` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`title` CHAR( 200 ) NOT NULL ,
`date` DATE NOT NULL ,
`content` TEXT  NULL,
`content_2` TEXT  NULL
) ENGINE = MYISAM ;";
//echo "<p>".$sql."</p>";
mysqli_query($db,$sql);

if (mysqli_error($db)==0)
{

echo "<p>Таблица создана добавляем данные</p>";
$sql = "INSERT INTO `blog_2` (`id`, `title`, `date`, `content`, `content_2`) VALUES
(1, 'салат из курицы', '2018-04-17', '<p>Вкусные салаты с курицей. Рецепты салатов с курицей, которые легко приготовить на любой праздничный стол. Пошаговые рецепты с фото. Готовьте вкусные и проверенные салаты с курицей.</p>','Рецепты салатов с курицей, которые легко приготовить'),
(2, 'салат с грибами', '2018-04-17', '<p>Вот и вторая статья</p>',''),
(3, 'салаты из мяса',  '2018-04-17', '<p>Третья статья</p>',''),
(4, 'фруктовые салаты','2018-04-17', '<p>Да, это четвертая статья.</p><img src=\'img/ping.jpg\' width=300 />',''),
(5, 'корейские салаты', '2018-04-17', '<p>Первая статья.</p>','');";
mysqli_query($db,$sql);



echo "<p>инсталляция завершена</p>";

}

else { echo "<p>ошибка при создании таблицы</p>";}

	?>




