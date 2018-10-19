<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>修正確認画面</title>
	</head>
	<body>
	<?php
		try{
			// staff_edit.phpから値を受け取る
			$staff_code = $_POST['code'];
			$staff_name = $_POST['name'];
			$staff_pass = $_POST['pass'];

			$staff_code = htmlspecialchars($staff_code);
			$staff_name = htmlspecialchars($staff_name);
			$staff_pass = htmlspecialchars($staff_pass);
			$staff_pass = md5($staff_pass);
			var_dump($staff_name);


			// 接続前の準備
			$db_name = 'shop';
			$db_host = 'localhost';
			$db_user = 'root';
			$db_pw = '';

			// 接続先の設定
			$dsn = 'mysql: host=$db_host; dbname=shop; charset=utf8';
			$pdo = new PDO($dsn, $db_user, $db_pw);

			// エラー時の設定
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

			// SQL文の作成と格納
			$sql = 'UPDATE master_staff SET name=?, password=? WHERE code=?';
			$stmt = $pdo->prepare($sql);

			// execute引数の準備（順番はSQL文の順番と合わせる）
			$data[] = $staff_name;
			$data[] = $staff_pass;
			$data[] = $staff_code;
			var_dump($data);

			// データベースに問い合わせを発行（）
			$stmt->execute($data); // $stmtはSQL文

			// 切断
			$pdo = null;
			echo '接続成功';
			var_dump($stmt);


		}catch(PDOException $Exception){

			echo '接続失敗'.$Exception->getMessage();
			exit();
		}
	 ?>

<h2>修正確認</h2>
<p>以下の内容に修正しました。</p>
<p>スタッフコード</p>
<p><?php echo $staff_code; ?></p>
<p>スタッフ名</p>
<p><?php echo $staff_name; ?></p>
<p>パスワード</p>
<p><?php echo $staff_pass; ?></p>
<p><a href="staff_list.php">スタッフ一覧にもどる</a></p>
	</body>
</html>
