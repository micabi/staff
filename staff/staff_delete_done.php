<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>スタッフを削除しました</title>
	</head>
	<body>
		<?php
		try{
		// staff_delete.phpから値を受け取る
			$staff_code = $_POST['staff_code'];
			$staff_name = $_POST['staff_name'];
			var_dump($staff_name);

		// 準備
		$db_host = 'localhost';
		$db_name = 'shop';
		$db_user = 'root';
		$db_pw = '';

		// データベース接続の準備
		$dsn = 'mysql: host=$db_host; dbname=shop; charset=utf8';
		$pdo = new PDO($dsn, $db_user, $db_pw);

		// エラー時の設定
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		// SQL文を記述（データベースからコードxを削除）
		$sql = 'DELETE FROM master_staff WHERE code=?';

		// SQLをセット
		$stmt = $pdo->prepare($sql);

		// staff_codeを配列に格納
		$data[] = $staff_code;
		var_dump($data);
		// データベースにSQLを発行
		$stmt->execute($data);

		// 切断
		$pdo = null;

	}catch(PDOException $Exception){

		echo 'データベース接続に失敗しました。理由：'.$Exception->getMessage();

	}
		 ?>
		 <h2>スタッフ削除完了</h2>
		 <p>データベース接続に成功しました。</p>
		 <p><?php echo $staff_name; ?>さんのデータを削除しました。</p>
		 <p><a href="staff_list.php">スタッフ一覧にもどる</a></p>
	</body>
</html>
