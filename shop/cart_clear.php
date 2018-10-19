<?php
	session_start();
	$_SESSION = array(); // サーバー上のセッション変数を空にする
	if(isset($_COOKIE[session_name()]) == true){ // ブラウザにクッキーが残っていたら
		setcookie(session_name(), '', time()-42000, '/'); // 遡って空にする
	}
	session_destroy(); // サーバー上からセッションIDを削除する
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>カートを空にする</title>
	</head>
	<body>
		<p>カートを空にしました。</p>
		<p><a href="list.php">商品一覧にもどる</a></p>
	</body>
</html>
