<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>ログイン画面</title>
	</head>
	<body>
		<h2>ログイン画面</h2>
		<form action="staff_login_check.php" method="post">
			<p>スタッフコード</p>
			<input type="text" name="code" value=""><br>
			<p>パスワード</p>
			<input type="password" name="pass" value=""><br><br>
			<input type="submit" value="ログイン">
		</form>
	</body>
</html>
