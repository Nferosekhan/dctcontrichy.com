<?php
session_start();
include '../connection.php';
if (isset($_GET['rmk'])&&($_GET['rmk']=="success")) {
	if (isset($_SESSION['idofreg'])) {
		$idofreg = htmlspecialchars($_SESSION['idofreg'], ENT_QUOTES, 'UTF-8');
		$query = $db->prepare("UPDATE registrations SET paid_status = 1 WHERE id = ? AND paid_status=0");
		if ($query === false) {
			header("Location: index.php?error=Database Error in Preparation Kindly Contact Developer");
		}
		$query->bind_param("i", $idofreg);
		if ($query->execute()) {
			unset($_SESSION['idofreg']);
			header("location:index.php?success=Registration Successfully Completed");
		}
		else{
			header("location:index.php?error=Something Went Wrong Please Contact Dctcon");
		}
	}
	else{
		header("location:index.php?error=Something Went Wrong Please Contact Dctcon");
	}
}
else{
	header("location:index.php?error=Payment Failure Please Try Again");
}
?>