<?php
	session_start();
	if(!isset($_SESSION["session_username"])):;
	else:
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Лаб 1</title>
	<link href="css/style.css" media="screen" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="welcome">
	<h2>Добро пожаловать, <span><?php echo $_SESSION['session_username'];?>! </span></h2>
  	<p class="submit"><input class="button" value="Информация о себе" onClick='location.href="about.php"'></p><br>
    <p class="submit"><input class="button" value="Покупка товара" onClick='location.href="buy.php"'></p><br>
    <p class="submit"><input class="button" value="Удалить свою страницу" onClick='location.href="deleteuser.php"'></p>
  	<p><a href="logout.php">Выйти</a> из системы</p>
	</div>
</body>
</html>
	
<?php endif; ?>