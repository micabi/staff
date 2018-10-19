<?php
	session_start();
	session_regenerate_id(true);

	if(isset($_SESSION['login']) == false){
		echo '<p>ログインしていません。</p>';
		echo '<p><a href="../staff/staff_login.php">ログイン画面へ</a></p>';
		exit();

	}else{

		echo '<p>'.$_SESSION['staff_name'].'さんでログイン中....</p>';
	}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>管理画面</title>
		<link rel="stylesheet" href="css/common.css" media="screen" />
	</head>
	<body>
		<h2>管理画面</h2>
		<div id="branch">
			<ul>
				<li class="staff"><a href="staff/staff_list.php">スタッフ管理画面</a></li>
				<li class="product"><a href="product/product_list.php">商品管理画面</a></li>
			</ul>
		</div><!-- /#branch -->
		<p><a href="staff/staff_logout.php">ログアウトする</a></p>
	</body>
</html>
