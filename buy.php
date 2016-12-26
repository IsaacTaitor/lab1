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
	
	if (isset($_POST["buy"])) {
	
		if (!empty($_POST['quantity'])) {
            $id = $_SESSION['id'];
            $price = htmlspecialchars($_POST['price']);
			$quantity = htmlspecialchars($_POST['quantity']);
            $sum = $price * $quantity;
			$query = mysqli_query($con, "INSERT INTO `purchase history` (id, price,quantity,sum) VALUES ('".$id."', '".$price."', '".$quantity."', '".$sum."')");
            $query1 = mysqli_query($con, "SELECT * FROM money WHERE id='".$id."'");
            $numrows = mysqli_num_rows($query1);
            if ($numrows != 0) {
                while ($row = mysqli_fetch_assoc($query1)) {
                    $amount = $row['amount'];
                    $amount = $amount - $sum;
                }
                $sql = "UPDATE money SET amount = '".$amount."' WHERE id = '".$id."';";
  				$result = mysqli_query($con, $sql);
 				if ($result) {
					$message = "Пользователь успешно создан";
				} else {
 					$message = "Нехваткаденежных средств";
  				}
            }
				$message = "Данные успешно изменены";
			} else {
				$message = "Не все поля заполнены!";
			}
		}
	?>
	<?php if (!empty($message)) { echo "<p class=\"error\">" . $message . "</p>";} ?>
	<div class="container mregister">
		<div id="login">
 			<h1>Покупка товара</h1>
			<form action="buy.php" id="buying" method="post" name="registerform">
				<p><label for="user_name">Количество товара<br>
					<input class="input" id="quantity" name="quantity" size="20" type="text" required></label></p>
				
                <p><label form for="user_tovar">Товар<br>
                    <select size="1" name="price">
                        <option value="20">шоколад Аленушка(20 р)</option>
                        <option value="50">Киндер Сюрприз(50 р)</option>
                        <option value="45">Альпен Голд(45 р)</option>
                        <option value="34">Сникерс(34 р</option>
                        <option value="9">Чупа-чупс(9 р)</option>
                        <option value="200">Рафаэло(200 р)</option>
                        <option selected value="58">Кит-кат(58 р)</option>
   					</select></label></p>
				<p class="submit"><input class="button" id="buy" name= "buy" type="submit" value="Купить"></p>
 			</form>
 			<p class="submit"><input style="margin-right: 130px;" class="button" id="intropage" size="7" name= "intropage" onClick='location.href="intropage.php"' value="Назад"></p>
		</div>
	</div>
</body>
</html>

<?php endif; ?>