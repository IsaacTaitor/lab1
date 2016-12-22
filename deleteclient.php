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
	
		if (!empty($_POST['username'])) {
            $username = htmlspecialchars($_POST['username']);
            if ($username != "admin")  {
                $query = mysqli_query($con, "SELECT * FROM usertbl WHERE username='".$username."'");
                $numrows = mysqli_num_rows($query);
                if ($numrows != 0) {
                    $sql = "DELETE FROM usertbl WHERE username='".$username."'";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        $message = "Пользователь успешно удален";
                    } else {
                        $message = "Произошла ошибка при удалении пользователя";
                    }
                } else {
                    $message = "Данного пользователя не существует";
                }
            }
            else {
                $message = "Данного пользователя нельзя удалить";  
            }
        }   
    }
	?>
	
	<?php if (!empty($message)) { echo "<p class=\"error\">" . $message . "</p>";} ?>
	<div class="container mregister">
		<div id="login">
 			<h1>Удаление пользователя</h1>
			<form action="deleteclient.php" id="registerform" method="post" name="registerform">
				<p><label for="user_pass">Имя пользователя<br>
					<input class="input" id="username" name="username" size="20" type="text" value="" required></label></p>
				<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Удалить"></p>
 			</form>
 			<p class="submit"><input style="margin-right: 130px;" class="button" id="register" size="7" name= "register" onClick='location.href="intropageadmin.php"' value="Назад"></p>
		</div>
	</div>
</body>
</html>

<?php endif; ?>