<?php
	session_start();?>
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
	<?php

	if (isset($_POST["del"])) {
		$sql = "DELETE FROM login WHERE id='".$_SESSION['id']."'"; 
        $result = mysqli_query($con, $sql); 
        $dbid = $_SESSION['id'];
        $sql2 = "INSERT INTO `deleted_user` (id, date_deleted) VALUES ('".$dbid."','".date('D M d H:i:s Y \G\M\T\ O (\U\T\C\)', strtotime("+2 hours"))."')"; 
        $result = mysqli_query($con, $sql2); 
        header("Location: logout.php");
        
    }
    ?>
	<div class="container mlogin">
		<div id="login">
			<h1>Вы уверены, что хотите удалить профиль?</h1>
			<form action="deleteuser.php" id="delform" name="delform" method="post" name="loginform">
				<p class="submit"><input class="button" id="del" name="del" type= "submit" value="Да"></p>
			</form>
            <p class="submit"><input style="float: left;" class="button" id="register" size="7" name= "register" onClick='location.href="intropage.php"' value="Назад"></p>
            <script>
                document.getElementById('del').onclick = function() {
                alert("Ваша страница была удалена")
                }
            </script>
 		</div>
  	</div>
</body>
</html>