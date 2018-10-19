<?php
	$_SESSION = array(); // サーバー上のセッション変数を空にする
	if(isset($_COOKIE[session_name()]) == true){ // ブラウザ上にクッキー情報があったら
		setcookie(session_name(), '', time()-42000, '/'); // セッションIDをクッキーから削除する
	}
	@session_destroy(); // サーバー上からセッションIDを破棄する
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>ログアウト</title>
	</head>
	<body>
		<p>ログアウトしました。</p>
		<p><a href="staff_login.php">ログイン画面へ</a></p>
	</body>
</html>
