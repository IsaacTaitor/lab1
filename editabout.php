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
	
        if (!empty($_POST['number_card'])) {
                $number_card = htmlspecialchars($_POST['number_card']);
                $sql = "UPDATE money SET `card number` = '".$number_card."' WHERE id = '".$_SESSION['id']."';";
                $result = mysqli_query($con, $sql);
            }
        if (!empty($_POST['phone'])) {
                $phone = htmlspecialchars($_POST['phone']);
                $sql2 = "UPDATE `personal information` SET phoneNumber = '".$phone."' WHERE id = '".$_SESSION['id']."';";
                $result = mysqli_query($con, $sql2);
            }
        if (!empty($_POST['position'])) {
                $user_position = htmlspecialchars($_POST['position']);
                $sql3 = "UPDATE `place of work` SET about = '".$user_position."' WHERE id = '".$_SESSION['id']."';";
                $result = mysqli_query($con, $sql3);
            }
        if (!empty($_POST['place_of_work'])) {
                $place_of_work = htmlspecialchars($_POST['place_of_work']);
                $sql4 = "UPDATE `place of work` SET company = '".$place_of_work."' WHERE id = '".$_SESSION['id']."';";
                $result = mysqli_query($con, $sql4);
            }
        $message = "Данные успешно изменены";
	}
	?>
	
	<?php if (!empty($message)) { echo "<p class=\"error\">" . $message . "</p>";} ?>
	<div class="container mregister">
		<div id="login">
 			<h1>Редактирование страницы</h1>
			<form action="editabout.php" id="editform" method="post" name="editform">
				<p><label for="user_number_card">Номер карты<br>
					<input class="input" id="number_card" name="number_card" size="20" type="text"></label></p>
				<p><label for="user_phone">Номер телефона<br>
					<input class="input" id="phone" name="phone" size="32" type="text"></label></p>
				<p><label form for="user_position">Должность<br>
					<input class="input" id="position" name="position" size="32" type="text"></label></p>
   				<p><label form for="user_place_of_work">Место работы<br>
   					<input class="input" id="place_of_work" name="place_of_work" size="32" type="text"></label></p><br>
				<p class="submit"><input class="button" id="edit" name= "edit" type="submit" value="Изменить"></p>
 			</form>
 			<p class="submit"><input style="float:left;" class="button" id="register" size="7" name= "register" onClick='location.href="about.php"' value="Назад"></p>
		</div>
	</div>
</body>
</html>

<?php endif; ?>