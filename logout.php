<?php
	session_start();
	unset($_SESSION['session_username']);
    unset($_SESSION['id']);
	session_destroy();
	header("location:index.php");
	?>