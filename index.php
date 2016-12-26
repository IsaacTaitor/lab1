<?php
	session_start();
	?>
<?php require_once('includes/connection.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Курсовая работа</title>
	<link href="css/style.css" media="screen" rel="stylesheet">
	<link href= 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head> 
<body>
	<?php require_once('includes/connection.php'); ?> 
	<?php
    
	if (isset($_SESSION["session_username"])) {
		header("Location: intropage.php");
	}

	if (isset($_POST["login"])) {
		if (!empty($_POST['email']) && !empty($_POST['password'])) {
			$useremail = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $password = crypt($password, "kyrsach");
            $query = mysqli_query($con, "SELECT * FROM login WHERE email='".$useremail."' AND password='".$password."'"); //
            $numrows = mysqli_num_rows($query);
            if ($numrows != 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $dbuseremail = $row['email'];
                    $dbpassword = $row['password'];
                    $username = $row['name'];
                    $_SESSION['id'] = $row['id'];
                }
                if ($useremail == $dbuseremail && $password == $dbpassword) {
                    $_SESSION['session_username'] = $username;
                    $sql = "INSERT INTO session (id, name, timelogin) VALUES ('".$_SESSION['id']."', '".$username."', '".date('d M Y H:i:s', strtotime("+2 hours"))."')";
                    $result = mysqli_query($con, $sql);
 				if ($result) {
					$message = "Информация добавлена";
				} else {
 					$message = "Информация не добавлена";
  				}						
                }
            } else { 
                $message = "Пароль и/или email не верен";
            }
        } else {
            $message = "Не все поля заполнены!";
        }
    }
    ?>
	<?php if (!empty($message)) { echo "<p class=\"error\">" . $message . "</p>";} ?>
	<div class="container mlogin">
		<div id="login">
			<h1>Вход</h1>
			<form action="" id="loginform" method="post" name="loginform">
				<p><label for="user_email">Email<br>
					<input class="input" id="email" name="email" size="20" type="text" value="" required></label></p>
				<p><label for="user_pass">Пароль<br>
 					<input class="input" id="password" name="password" size="20" type="password" value="" required></label></p>
				<p class="submit"><input class="button" name="login" type= "submit" value="Войти"></p><br>
                <p class="regtext">Еще не зарегистрированы?<br><a href="register.php">Регистрация</a>!</p>
			</form>
 		</div>
  	</div>
</body>
</html>