<!DOCTYPE html>
<html>
	<head lang = "ja">
		<meta charset="utf-8">
		<title>スタッフ削除</title>
	</head>
	<body>
		<?php
		try{
		/*************
		 準備（変数セット）
		 ************/
		$staff_code = $_GET['staffcode'];
		//var_dump($staff_code);
		$db_host = 'localhost';
		$db_name = 'shop';
		$db_user = 'root';
		$db_pw = '';

		/***************
		 staffcodeからnameを取り出し
		 ***************/
		// データベース接続準備
		$dsn = 'mysql: host=db_host; dbname=shop; charset=utf8';
		$pdo = new PDO($dsn, $db_user, $db_pw);

		// エラー設定
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		// SQL文記述（コードから名前を取り出す）
		$sql = 'SELECT name FROM master_staff WHERE code=?';

		// SQL文をセット
		$stmt = $pdo->prepare($sql);

		// staffcodeを配列に格納
		$code[] = $staff_code;
		//var_dump($code);

		// SQL文発行
		$stmt->execute($code);

		// staff_nameを取り出し
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$staff_name = $rec['name'];

		// 切断
		$pdo = null;
		echo 'データベース接続に成功しました。';
		//echo 'スタッフ名は'.$staff_name.'です。';

	}catch(PDOException $Exception){

		echo 'データベース接続に失敗しました。理由：'.$Exception->getMessage();
	}
		 ?>
		<h2>スタッフ削除画面</h2>
		<p>以下のスタッフを削除してもよろしいですか？</p>
		<p>スタッフコード</p>
		<p><?php echo $staff_code; ?></p>
		<p>スタッフ名</p>
		<p><?php echo $staff_name; ?></p>

		<form action="staff_delete_done.php" method="post">
			<input type="hidden" name="staff_code" value="<?php echo $staff_code; ?>">
			<input type="hidden" name="staff_name" value="<?php echo $staff_name; ?>">
			<input type="submit" value="はい、削除します">
			<input type="button" value="いいえ、やり直します" onclick="history.back()">
		</form>

	</body>
</html>
