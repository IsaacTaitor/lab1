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
	
        if ((!empty($_POST['username'])) && ($_POST['username'] != "admin"))  {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $role = ($_POST['role']);
            $block = ($_POST['block']);
            $restrictions = ($_POST['restrictions']);
            if ($restrictions == 1) {
                if ((preg_match('/[a-zа-я]/',$password)) && (preg_match('/[A-ZА-Я]/',$password)) && (preg_match('/[^a-zA-Z0-9]/',$password))) {
                    $query = mysqli_query($con, "SELECT * FROM usertbl WHERE username='".$username."'");
                    $numrows = mysqli_num_rows($query);
                    $row = mysqli_fetch_assoc($query);
                    $dbid = $row['id'];
                    if ($dbid != 1) { 
                        if ($numrows == 1) {
                            $sql =  "UPDATE usertbl SET block = '".$block."', restrictions = '".$restrictions."', role = '".$role."', password = '".$password."' WHERE username = '".$username."';";
                            $result = mysqli_query($con, $sql);
                            if ($result) {
                                $message = "Информация успешно изменена";
                            } else {
                                $message = "Произошла ошибка при изменении данных";
                            }
                        }   else {
                            $message = "Данного пользователя не существует";
                        }
                    } else {
                        $message = "Нельзя поменять данные admin'а";
                    }
                } else {
                    $message = "Пароль не может быть изменен при заданных условиях";
                }
			} else {
                $query = mysqli_query($con, "SELECT * FROM usertbl WHERE username='".$username."'");
                $numrows = mysqli_num_rows($query);
                $row = mysqli_fetch_assoc($query);
                $dbid = $row['id'];
                if ($dbid != 1) { 
                    if ($numrows == 1) {
                        $sql =  "UPDATE usertbl SET block = '".$block."', restrictions = '".$restrictions."', role = '".$role."', password = '".$password."' WHERE username = '".$username."';";
                        $result = mysqli_query($con, $sql);
                        if ($result) {
                            $message = "Информация успешно изменена";
                        } else {
                            $message = "Произошла ошибка при изменении данных";
                        }
                    } else {
                        $message = "Данного пользователя не существует";
                    } 
                } else {
                    $message = "Нельзя поменять данные admin'а";
                }
            }
        } else {
            $message = "Нельзя поменять данные admin'а";
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
				<p class="submit"><input class="button" id="edit" name= "edit" type="submit" value="Изменить"></p>
 			</form>
 			<p class="submit"><input style="margin-right: 130px;" class="button" id="edit" size="7" name= "edit" onClick='location.href="intropageadmin.php"' value="Назад"></p>
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