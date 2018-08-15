
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Мой блог</title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body class="body">
    	<img src="">
		
		
     <div id="header">
      <h1>Шапка сайта<h1>
      <h3>Как сделать шапку для сайта с заголовком и описанием</h3>
     </div>
		
		
		
<?php
require_once 'conf.php';
$act = "none";
if( isset($_REQUEST['act'])) {
  $act = $_REQUEST['act'];
}

if ( $act === "insert-new"){
   $sql = 'SELECT `id` FROM `blog_2` ORDER BY `id` DESC';
   $otvet = mysqli_query($db, $sql);
   if ($row = mysqli_fetch_assoc($otvet)){
   	  $new_id = $row['id'] + 1;
   } 
   $sql = 'INSERT INTO `blog_2` (`id`,`title`,`content_2`,`content`, `date`) VALUES ( '.$new_id.',"'.$_REQUEST["title"].'","'.$_REQUEST["content_2"].'","'.$_REQUEST["content"].'","'.date("Y-m-d").'" );';
   mysqli_query($db, $sql);

  // echo "<h2>".$sql."</h2>";
  $act = "none";
   
}

if ($act === "update_form"){
	appDate($_REQUEST["id"]);
}

if ( $act === "update"){
   $sql = 'UPDATE `blog_2` SET `title`= "'.$_REQUEST["title"].'", `content_2`="'.$_REQUEST["content_2"].'", `content`="'.$_REQUEST["content"].'" WHERE `id`='.$_REQUEST["id"].';';
   mysqli_query($db, $sql);

   //echo "<h2>".$sql."</h2>";
  $act = "none";
}
//домаха тут надо удалить статью подправить код
  if ( $act === "delete"){
   $sql = 'DELETE FROM `blog_2` WHERE `id`='.$_REQUEST["id"].';';
   mysqli_query($db, $sql);
//echo "<h2>".$sql."</h2>";
  $act = "none";
   
   
}

if ( $act === "Denis_privet"){
	 $sql = 'SELECT `id` FROM `blog_2` ORDER BY `id` DESC';
	  $otvet = mysqli_query($db, $sql);
   if ($row = mysqli_fetch_assoc($otvet)){
   	  $new_id = $row['id'] + 1;
   } 
   $sql = 'INSERT INTO `blog_2` (`id`,`title`,`content_2`,`content`, `date`) VALUES ( '.$new_id.',"privet","privet","kkkk","'.date("Y-m-d").'");';
   mysqli_query($db, $sql);

   echo "<h2>".$sql."</h2>";
  $act = "none";
}



if ( $act === "none"){

$sql = 'SELECT * FROM `blog_2` ORDER BY `date` DESC';
echo "<p>".$sql."</p>";
$otvet = mysqli_query($db, $sql);
 		while($row = mysqli_fetch_assoc($otvet)){
 			echo "<div class='message'><a href='index.php?act=show_all&id=".$row['id']."' target='_blank'>".$row['title']."</a> <img src='img/ping.jpg' height='20' float='right'>&nbsp;&nbsp;&nbsp;<a href='index.php?act=update_form&id=".$row['id']."' target='_self'>изменить</a>&nbsp;&nbsp;&nbsp;<a href='index.php?act=delete&id=".$row['id']."' target='_self'>удалить </a></div>";
 			echo "<div class='content_2'>".$row['content_2']."</div>";
 			echo "<p class='date'>".$row['date']."</p>";
 		
 		}
       show_form();
} 
// станица с развернутой информацией о статье
if ( $act === "show_all"){
$sql = 'SELECT * FROM `blog_2` where `id`='.$_REQUEST["id"];
$otvet = mysqli_query($db, $sql);
 		if($row = mysqli_fetch_assoc($otvet)){
			echo "<a href='index.php?act=none' target='_self'>на главную</a> ";
 			echo "<div class='message'>".$row['title']."></div>";
 			echo "<div class='content'>".$row['content']."</div>";
 			echo "<p class='date'>".$row['date']."</p>";
 		
 		}
 	}
 		?>
    </body>
</html>

<?php
function show_form()
{
	?>
		<p><a href="index.php?act=Denis_privet" target="_self">Denis Privet</a></p>>
    	<form action='index.php' method="post" target="_self">
    		<fieldset>
    			<legend>новая статья</legend>
    			<p><label for="name">назавние  <em>*</em></label><input type="text" name='title' value=""></p>
    			<p><label for="email">краткое описание </label><textarea name='content_2' cols='60' rows='4'></textarea></p>
    			<p><label for="email">полное описание </label><textarea name='content' cols='60' rows='8'></textarea></p>
    			<p><input type="submit" value="отправить"></p>
    		</fieldset>
    	
    		<input type="hidden" name='act' value='insert-new'>
    	</form>
    	<br />

	<?php
}

function appDate($id)
{
	global $db;
	$sql = 'SELECT * FROM `blog_2` where `id`='.$id;
$otvet = mysqli_query($db, $sql);
 		if($row = mysqli_fetch_assoc($otvet)){
	?>
    	<form action='index.php' method="post" target="_self">
    		<fieldset>
    			<legend>новая статья</legend>
    			<p><label for="name">назавние  <em>*</em></label><input type="text" name='title' value="<?php echo $row['title']; ?>"></p>
    			<p><label for="email">краткое описание </label><textarea name='content_2' cols='60' rows='4'> <?php echo $row['content_2']; ?></textarea></p>
    			<p><label for="email">полное описание </label><textarea name='content' cols='60' rows='8'> <?php echo $row['content']; ?></textarea></p>
    			<p><input type="submit" value="отправить"></p>
    		</fieldset>
    	
    		<input type="hidden" name='id' value='<?php echo $id;?>'>
    		<input type="hidden" name='act' value='update'>
    	</form>
    	<br />

	<?php
}
}



 ?>
