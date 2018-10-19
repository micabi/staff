<?php
	if(isset($_POST['add']) == true){ // addが入っていたら
			header('Location: staff_add.php');
	}

	if(isset($_POST['disp']) == true){ // dispが入っていたら
		if(isset($_POST['staffcode']) == false){ // staffcodeが入ってなかったら
			header('Location: staff_ng.php');
		}
		$staff_code = $_POST['staffcode'];
		header('Location: staff_disp.php?staffcode='.$staff_code);
	}

	if(isset($_POST['edit']) == true){ // editが入っていたら
		if(isset($_POST['staffcode']) == false){ // staffcodeが入ってなかったら
			header('Location: staff_ng.php');
		}
		$staff_code = $_POST['staffcode']; // staddcodeを受け取る
		header('Location:staff_edit.php?staffcode='.$staff_code);
		echo 'editの値は：'.isset($_POST['edit']);
					}

	if(isset($_POST['delete']) == true){ // deleteが入っていたら
		if(isset($_POST['staffcode']) == false){ // staffcodeが入ってなかったら
			header('Location: staff_ng.php');
		}
		$staff_code = $_POST['staffcode'];
		header('Location:staff_delete.php?staffcode='.$staff_code);
		echo 'deleteの値は：'.isset($_POST['delete']);
					}
?>
