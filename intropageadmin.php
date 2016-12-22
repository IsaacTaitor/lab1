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

    $qr_result = mysqli_query($con, "SELECT * FROM usertbl") or die(mysql_error());
    // выводим на страницу сайта заголовки HTML-таблицы
    echo '<table>';
  	echo '<thead>';
  	echo '<tr>';
  	echo '<th>id</th>';
  	echo '<th>username</th>';
  	echo '<th>password</th>';
  	echo '<th>role</th>';
  	echo '<th>block</th>';
    echo '<th>restrictions</th>';
  	echo '</tr>';
  	echo '</thead>';
  	echo '<tbody>';
  
  	 // выводим в HTML-таблицу все данные клиентов из таблицы MySQL 
  	while($data = mysqli_fetch_array($qr_result)){ 
    	echo '<tr>';
    	echo '<td>' . $data['id'] . '</td>';
    	echo '<td>' . $data['username'] . '</td>';
    	echo '<td>' . $data['password'] . '</td>';
    	echo '<td>' . $data['role'] . '</td>';
    	echo '<td>' . $data['block'] . '</td>';
        echo '<td>' . $data['restrictions'] . '</td>';
    	echo '</tr>';
  	}	
    echo '</tbody>';
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