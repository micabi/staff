<?php
session_start();
session_regenerate_id(true);

if(isset($_SESSION['login']) == false){

	echo 'ログインしていません。<br /><br />';
	echo '<a href="staff_login.php">ログイン画面に戻る</a>';
	exit();
}else{
	echo $_SESSION['staff_name'].'さんでログイン中です。<br />';
}
?>
<!DOCTYPE html>
<html>
	<head lang="ja">
		<meta charset="utf-8">
		<title>スタッフ情報</title>
	</head>
	<body>
		<?php
		try{
			// staff_branch.phpから値を受け取る
			$staff_code = $_GET['staffcode'];
			//var_dump($staff_code);

			// 準備（変数を設定）
			$db_host = 'localhost';
			$db_name = 'shop';
			$db_user = 'root';
			$db_pw = '';

			// データベース情報設定
			$dsn = 'mysql: host=$db_host; dbname=shop; charset=utf8';
			$pdo = new PDO($dsn, $db_user, $db_pw)	;

			// エラー時の設定
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

			// SQL文作成（staff_codeからnameを取得する）
			$sql = 'SELECT name FROM master_staff WHERE code=?';

			// SQL発行を準備
			$stmt = $pdo->prepare($sql);

			// 配列を準備（staff_codeを配列に格納）
			$data[] = $staff_code;

			// データベースにSQL発行
			$stmt->execute($data);

			// データベースから受け取ったnameを1つずつ取得
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
			$staff_name = $rec['name'];

			// 切断
			$pdo = null;
			//echo 'データベース接続に成功しました。'.$staff_name.'さんでログイン中です。';

	}catch(PDOException $Exception){

		echo 'データベース接続に失敗しました。理由：'.$Exception->getMessage();

	}
	?>

		<h2>スタッフ情報画面</h2>
		<?php echo $staff_code; ?>
		<?php echo $staff_name.'<br />'; ?>
		<p><a href="staff_list.php">スタッフ一覧にもどる</a></p>
	</body>
</html>
