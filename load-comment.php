<?php
include 'dbh.php';
$commentNewCount = $_POST['commentNewCount'];
		$sql = "SELECT hargabeli FROM hrgbeli where nama_customer= $commentNewCount";
		$result = mysqli_query($conn, $sql);
		if($result){
		$a = mysqli_fetch_assoc($result);
		$teh = $a[0];
	}
		}else{
			echo "There are no comments!";
		}

		?>