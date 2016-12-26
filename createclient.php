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
	
	if (isset($_POST["register"])) {
	
	if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['role'])) {
			$username = htmlspecialchars($_POST['username']);
			$password = htmlspecialchars($_POST['password']);
			$role = ($_POST['role']);
			$block = ($_POST['block']);
			$restrictions = ($_POST['restrictions']);
			$query = mysqli_query($con, "SELECT * FROM usertbl WHERE username='".$username."'");
			$numrows = mysqli_num_rows($query);
			if ($numrows == 0) {
				$sql = "UPDATE money SET password = '".$password."' WHERE id = '".$username."';";
  				$result = mysqli_query($con, $sql);
 				if ($result) {
					$message = "Пользователь успешно создан";
				} else {
 					$message = "Произошла ошибка при создании пользователя";
  				}
			} else {
			$message = "Пользователь с данным именем уже существует";
			} 
   		}
	}
	?>
	
	<?php if (!empty($message)) { echo "<p class=\"error\">" . $message . "</p>";} ?>
	<div class="container mregister">
		<div id="login">
 			<h1>Создание нового пользователя</h1>
			<form action="createclient.php" id="registerform" method="post" name="registerform">
				<p><label for="user_name">Имя пользователя<br>
					<input class="input" id="username" name="username" size="20" type="text" required></label></p>
				<p><label for="user_pass">Пароль<br>
					<input class="input" id="password" name="password" size="32" type="password" required></label></p>
				<p><label form for="user_role">Привелегии<br>
					<select size="1" name="role">
    				<option value="admin">admin</option>
   					<option selected value="user">user</option>
   					</select></label></p>
   				<p><label form for="user_block">Блокировка<br>
   					<input type="radio" name="block" value="1" >Да<br>
   					<input type="radio" name="block" value="0" checked>Нет<br>
   					</label></p>
   				<p><label form for="user_restrictions">Ограничение на пароль<br>
   					<input type="radio" name="restrictions" value="1" checked>Да<br>
   					<input type="radio" name="restrictions" value="0" >Нет<br>
   					</label></p>

				<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Создать"></p>
 			</form>
 			<p class="submit"><input style="margin-right: 130px;" class="button" id="register" size="7" name= "register" onClick='location.href="intropageadmin.php"' value="Назад"></p>
		</div>
	</div>
</body>
</html>

<?php endif; ?>