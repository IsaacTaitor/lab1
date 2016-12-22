<?php
	session_start();
	if(!isset($_SESSION["session_username"])):;
	else:
?>
<?php require_once('includes/connection.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Лаб 1</title>
	<link href="css/style.css" media="screen" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
	<?php
	
	if (isset($_POST["edit"])) {
	
	if (!empty($_POST['username'])) {
			$username = htmlspecialchars($_POST['username']);
			$block = ($_POST['block']);
			$query = mysqli_query($con, "SELECT * FROM usertbl WHERE username='".$username."'");
			$numrows = mysqli_num_rows($query);
			if ($numrows == 1) {
				$sql =  "UPDATE usertbl SET block = '".$block."' WHERE username = '".$username."';";
  				$result = mysqli_query($con, $sql);
 				if ($result) {
					$message = "Информация успешно изменена";
				} else {
 					$message = "Произошла ошибка при изменении данных";
  				}
			} else {
			$message = "Данного пользователя не существует";
			} 
   		}
	}
	?>
	
	<?php if (!empty($message)) { echo "<p class=\"error\">" . $message . "</p>";} ?>
	<div class="container mregister">
		<div id="login">
 			<h1>Управление блокировкой пользователя</h1>
			<form action="controluser.php" id="edit" method="post" name="edit">
				<p><label for="user_pass">Имя пользователя<br>
					<input class="input" id="username" name="username" size="20" type="text" value="" required></label></p>
                <p><label form for="user_block">Блокировка<br>
   					<input type="radio" name="block" value="1" >Да<br>
   					<input type="radio" name="block" value="0" checked>Нет<br>
   					</label></p>
				<p class="submit"><input class="button" id="edit" name= "edit" type="submit" value="Изменить"></p>
 			</form>
 			<p class="submit"><input style="margin-right: 130px;" class="button" id="edit" size="7" name= "edit" onClick='location.href="intropageadmin.php"' value="Назад"></p>
		</div>
	</div>
</body>
</html>

<?php endif; ?>