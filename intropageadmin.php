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
	<?php require_once('includes/connection.php'); 

    $qr_result = mysqli_query($con, "SELECT * FROM money") or die(mysql_error());
    // выводим на страницу сайта заголовки HTML-таблицы
    echo '<table>';
  	echo '<thead>';
  	while($data = mysqli_fetch_array($qr_result)){ 
    	echo '<tr>';
    	echo '<td>' номер карты'</td>';
    	echo '<td>' . $data['card number'] . '</td>';
    	echo '</tr>';
  	}	
    echo '</thead>';
  
  	 // выводим в HTML-таблицу все данные клиентов из таблицы MySQL 
  	
    echo '</table>'; ?>
        <p class="submit" ><input class="button" value="Изменить пароль" onClick='location.href="passadmin.php"'></p><br>
        <p class="submit"><input class="button" value="Управление пользователями" onClick='location.href="controluser.php"'></p><br>
        <p class="submit"><input class="button" value="Создание пользователя" onClick='location.href="createclient.php"'></p>
        <p class="submit" style="padding-top: 37px"><input class="button" value="Удаление пользователя" onClick='location.href="deleteclient.php"'> </p>
        <p><a href="logout.php">Выйти</a> из системы</p>
	</div>
</body>
</html>
	
<?php endif; ?>