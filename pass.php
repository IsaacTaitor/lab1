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
        
        if (!empty($_POST['password'])) {
            $password = htmlspecialchars($_POST['password']);
            $username = $_SESSION["session_username"];
            $query = mysqli_query($con, "SELECT * FROM usertbl WHERE username='".$username."'");
            $row = mysqli_fetch_assoc($query);
            $dbrestrictions = $row['restrictions'];
            if ($dbrestrictions == 1) {
                if ((preg_match('/[a-zа-я]/',$password)) && (preg_match('/[A-ZА-Я]/',$password)) && (preg_match('/[^a-zA-Z0-9]/',$password))) {
                    $username = $_SESSION["session_username"];
                    $query = mysqli_query($con,  "UPDATE usertbl SET password = '".$password."' WHERE username = '".$username."';");
                    $message = "Данные успешно изменены";
                } else {
                    $message = "Данный пароль не подходит";
                }
            } else {
                $username = $_SESSION["session_username"];
                $query = mysqli_query($con,  "UPDATE usertbl SET password = '".$password."' WHERE username = '".$username."';");
                $message = "Данные успешно изменены";
            }  
        } else {
            $message = "Не все поля заполнены!";
        }
    }
	?>
	<?php if (!empty($message)) { echo "<p class=\"error\">" . $message . "</p>";} ?>
	<div class="container mregister">
		<div id="login">
 			<h1>Смена пароля</h1>
			<form action="pass.php" id="registerform" method="post" name="registerform">
				<p><label for="user_pass">Пароль<br>
					<input class="input" id="password" name="password" size="32"   type="password" value="" required></label></p>
				<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Изменить"></p>
 			</form>
 			<p class="submit"><input style="margin-right: 130px;" class="button" id="register" size="7" name= "register" onClick='location.href="intropage.php"' value="Назад"></p>
		</div>
	</div>
     <input class="button" id="about" type= "submit" value="О программе">
     <script>
        document.getElementById('about').onclick = function() {
        alert("Программа сделана Андреем Малининым, 13 вариант, 1 лаба по токб")
        }
    </script>
</body>
</html>

<?php endif; ?>