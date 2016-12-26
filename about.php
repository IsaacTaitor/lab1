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
	<div class="container mregister">
		<div id="login">
 			<h1>Информация о себе</h1>
            
            <?php 

            $qr_result = mysqli_query($con, "SELECT * FROM money WHERE id ='".$_SESSION['id']."'") or die(mysql_error());
            // выводим на страницу сайта заголовки HTML-таблицы
            echo '<table>';
            echo '<tbody>';
            while($data = mysqli_fetch_array($qr_result)){ 
                echo '<tr><td>Номер карты</td><td>' .$data["card number"]. '</td></tr>';
                echo '<tr><td>Баланс счета</td><td>' .$data["amount"]. '</td></tr>';
            }
            $qr_result = mysqli_query($con, "SELECT * FROM `personal information` WHERE id ='".$_SESSION['id']."'") or die(mysql_error());
            
            while($data = mysqli_fetch_array($qr_result)){ 
                echo '<tr><td>Номер телефона</td><td>' .$data["phoneNumber"]. '</td></tr>';
            }
            $qr_result = mysqli_query($con, "SELECT * FROM `place of work` WHERE id ='".$_SESSION['id']."'") or die(mysql_error());
            
            while($data = mysqli_fetch_array($qr_result)){ 
                echo '<tr><td>Должность</td><td>' .$data["about"]. '</td></tr>';
                echo '<tr><td>Название компании</td><td>' .$data["company"]. '</td></tr>';
            }
            echo '</tbody>';
            echo '</table>'; ?>
            
 			<p class="submit"><input style="float: left;" class="button" id="register" size="7" name= "register" onClick='location.href="intropage.php"' value="Назад"></p>
            <p class="submit"><input style="float: right;" class="button" id="register" size="7" name= "register" onClick='location.href="editabout.php"' value="Изменить"></p>
		</div>
	</div>
</body>
</html>

<?php endif; ?>