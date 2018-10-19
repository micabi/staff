<?php
	try{
	// staff_login.phpから値を受け取る
	$staff_code = $_POST['code'];
	$staff_pass = $_POST['pass'];

	// 値をサニタイジング
	$staff_code = htmlspecialchars($staff_code);
	$staff_pass = htmlspecialchars($staff_pass);
	$staff_pass = md5($staff_pass);

	// データベース接続のための変数の設定
	$db_host = 'localhost';
	$db_name = 'shop';
	$db_user = 'root';
	$db_pw = '';

	// データベース接続の準備
	$dsn = 'mysql: host=$db_host; dbname=shop; charset=utf8';
	$pdo = new PDO($dsn, $db_user, $db_pw);

	// エラー時の設定
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ERRMODE_EXCEPTION, false);

	// SQL文の記述（staff_login.phpから受け取ったcodeとpasswordを元にnameを取り出す）
	$sql = 'SELECT name FROM master_staff WHERE code=? AND password=?';

	// SQLをセッティング
	$stmt = $pdo->prepare($sql);

	// codeとpasswordを配列に入れる
	$data[] = $staff_code;
	$data[] = $staff_pass;

	// SQL文にdataを入れて発行
	$stmt->execute($data);

	// 切断
	$pdo = null;

	// 内容を取り出し
	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	$staff_name = $rec['name'];
	//echo 'データベース接続に成功しました。<br />';

	// 判定
	if($rec == false){ // 1件も返ってこなければ
		echo 'スタッフコードか、パスワードが間違っています。<br /><br />';
		echo '<a href="staff_login.php">ログイン画面に戻る</a>';
	}else{
		session_start();
		$_SESSION['login'] = 1;
		$_SESSION['staff_code'] = $staff_code;
		$_SESSION['staff_name'] = $staff_name;
		header('Location: ../branch.php');
	}

}catch(PDOException $Exception){

	echo 'データベース接続に失敗しました。：理由'.$Exception->getMessage();
	exit();

}
?>
