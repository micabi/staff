<?php
	//  代入してしまうと選ばれていないものがエラー扱いとなるから代入しない
	//$product_code = $_POST['product_code'];
	//$disp = $_POST['disp'];
	//$add = $_POST['add'];
	//$edit = $_POST['edit'];
	//$delete = $_POST['delete'];
	//var_dump($product_code);
	//var_dump($disp);
	//var_dump($add);
	//var_dump($edit);
	//var_dump($delete);

	// 商品詳細画面
	if(isset($_POST['disp']) == true){
		if(isset($_POST['product_code']) == false){
			echo '商品を選択して下さい。';
			echo '<p><a href="product_list.php">商品一覧にもどる</a></p>';
			exit();
		}else{
			$product_code = $_POST['product_code'];
			header('Location: product_disp.php?code='.$product_code);
			echo '詳細画面へ';
		}
	}

	// 商品追加画面
	if(isset($_POST['add']) == true){
			header('Location: product_add.php');
			echo '追加画面へ';
		}

	// 商品情報修正画面
	if(isset($_POST['edit']) == true){
		if(isset($_POST['product_code']) == false){
			echo '商品を選択して下さい。';
			echo '<p><a href="product_list.php">商品一覧にもどる</a></p>';
			exit();
		}else{
			$product_code = $_POST['product_code'];
			header('Location: product_edit.php?code='.$product_code);
			echo '修正画面へ';
		}
	}

	// 商品情報削除画面
	if(isset($_POST['delete']) == true){
		if(isset($_POST['product_code']) == false){
			echo '商品を選択して下さい。';
			echo '<p><a href="product_list.php">商品一覧にもどる</a></p>';
			exit();
		}else{
			$product_code = $_POST['product_code'];
			header('Location: product_delete_check.php?code='.$product_code);
			echo '削除画面へ';
		}
	}
?>
