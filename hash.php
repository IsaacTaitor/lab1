<?php require_once('includes/connection.php'); ?>
	<?php 
            for ($i = 99302; $i <= 99997; $i++) {
               $query = mysqli_query($con, "SELECT * FROM login WHERE id='".$i."'");
                $numrows = mysqli_num_rows($query);
                if ($numrows != 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $dbpassword = $row['password'];
                }
                $a = crypt($dbpassword, "kyrsach");
                $sql = mysqli_query($con, "UPDATE login SET password = '".$a."' WHERE id = '".$i."';");
            }
        }
    ?>