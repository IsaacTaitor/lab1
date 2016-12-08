<?php
	session_start();
	?>
<?php require_once('includes/connection.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Лаб 1</title>
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
		if (!empty($_POST['username']) && !empty($_POST['password'])) {
			$username = trim(htmlspecialchars($_POST['username']));
            $password = htmlspecialchars($_POST['password']);
            $query = mysqli_query($con, "SELECT * FROM usertbl WHERE username='".$username."' AND password='".$password."'");
            $numrows = mysqli_num_rows($query);
            if ($numrows != 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $dbusername = $row['username'];
                    $dbpassword = $row['password'];
                    $dbblock = $row['block'];
                    $dbused = $row['used'];
                    $restrictions = $row['restrictions'];
                }
                if ($restrictions == 1) {
                    if ((preg_match('/[a-zа-я]/',$password)) && (preg_match('/[A-ZА-Я]/',$password)) && (preg_match('/[^a-zA-Z0-9]/',$password))) {
                        if ($username == $dbusername && $password == $dbpassword && $dbblock == 0) {
                            $_SESSION['session_username'] = $username;	 
                            if ($username == 'admin') {
                                header("Location: intropageadmin.php");
                            } else if ($dbused == 0) {
                                header("Location: firstintropage.php");
                            } else {
                                header("Location: intropage.php");
                            }   
                        }
                        if ($username == $dbusername && $password == $dbpassword && $dbblock == 1) {
                            $message = "Ваш аккаунт заблокирован";
                        }
                    } else {
                      $message = "Ваш пароль не походит требованиям. Свяжитесь с админом";
                    }
                }
            } else { 
                $message = "Пароль и/или логин не верен";
                $_SESSION['i'] += 1;
                
            }
        } else {
            $message = "Не все поля заполнены!";
        }
    }
    ?>
    <?php if (!empty($message)) {   
        echo "<p class=\"error\">" . $message . "</p>";
        } else { $_SESSION['i'] = 0;
        } 
        if ($_SESSION['i'] > 3) {
            $_SESSION['i'] = 0;
            header("Location: http://google.com");
        }
    ?>
	<div class="container mlogin">
		<div id="login">
			<h1>Вход</h1>
			<form action="" id="loginform" method="post" name="loginform">
				<p><label for="user_login">Имя пользователя<br>
					<input class="input" id="username" name="username" size="20" type="text" value="" required></label></p>
				<p><label for="user_pass">Пароль<br>
 					<input class="input" id="password" name="password" size="20" type="password" value="" required></label></p>
				<p class="submit"><input class="button" name="login" type= "submit" value="Войти"></p>
			</form>
 		</div>
  	</div>
    <footer>
    <input class="button" id="about" type= "submit" value="О программе">
     <script>
        document.getElementById('about').onclick = function() {
        alert("Программа сделана Андреем Малининым, 13 вариант, 1 лаба по токб")
        }
    </script>
        </footer>
</body>
</html>