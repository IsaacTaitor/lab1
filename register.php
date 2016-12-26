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
	
	   if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['email'])) {
			$username = htmlspecialchars($_POST['name']);
			$password = htmlspecialchars($_POST['password']);
            $password = crypt($password, "kyrsach");
            $email = htmlspecialchars($_POST['email']);
			$query = mysqli_query($con, "SELECT * FROM login WHERE email='".$email."'");
			$numrows = mysqli_num_rows($query);
			if ($numrows == 0) {
				$sql = "INSERT INTO login (name,password,email) VALUES ('".$username."', '".$password."', '".$email."')";
                $result = mysqli_query($con, $sql);
                $query = mysqli_query($con, "SELECT * FROM login WHERE email='".$email."'");
                while ($row = mysqli_fetch_assoc($query)) {
                    $dbid = $row['id'];
                }
                $sql2 = "INSERT INTO money (id) VALUES ('".$dbid."')";
                $result3 = mysqli_query($con, $sql2);
                $sql3 = "INSERT INTO `personal information` (id,registration) VALUES ('".$dbid."', '".date('D M d H:i:s Y \G\M\T\ O (\U\T\C\)', strtotime("+2 hours"))."')";
                $result3 = mysqli_query($con, $sql3);
                $sql4 = "INSERT INTO `place of work` (id) VALUES ('".$dbid."')";
                $result4 = mysqli_query($con, $sql4);
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
 			<h1>Регистрация</h1>
			<form action="register.php" id="registerform" method="post" name="registerform">
				<p><label for="user_email">email<br>
					<input class="input" id="email" name="email" size="32"   type="email" value="" required></label></p>
                <p><label for="user_name">Ваше имя<br>
					<input class="input" id="name" name="name" size="32"   type="name" value="" required></label></p>
                <p><label for="user_pass">Пароль<br>
					<input class="input" id="password" name="password" size="32"   type="password" value="" required></label></p>
				<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Зарегистрироваться"></p>
 			</form>
 			<p class="submit"><input style="float:left;" class="button" style="" id="register" size="7" name= "register" onClick='location.href="index.php"' value="Назад"></p>
		</div>
	</div>
</body>
</html>