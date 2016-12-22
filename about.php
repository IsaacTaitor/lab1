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
    $query = mysqli_query($con, "SELECT * FROM login WHERE email='".$_SESSION['id']."'");
    $numrows = mysqli_num_rows($query);
    if ($numrows != 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $dbuseremail = $row['email'];
            $dbpassword = $row['password'];
            $username = $row['name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['id'] = $row['id'];	
        }
    }
   ?>
	<div class="container mregister">
		<div id="login">
 			<h1>Информация о себе</h1>
            
 			<p class="submit"><input style="margin-right: 130px;" class="button" id="register" size="7" name= "register" onClick='location.href="intropage.php"' value="Назад"></p>
		</div>
	</div>
</body>
</html>

<?php endif; ?>