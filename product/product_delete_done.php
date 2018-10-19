<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>商品情報削除</title>
	</head>
	<body>
		<h2>商品情報削除画面</h2>
		<?php
		try{
		// product_branch.phpから値を受け取る
		$product_code = $_POST['product_code'];
		$product_image = $_POST['product_image'];
		var_dump($product_code);
		var_dump($product_image);

		// SQL接続の変数準備
		$db_host = 'localhost';
		$db = 'shop';
		$db_user = 'root';
		$db_pw = '';

		// SQL接続の準備
		$dsn = 'mysql: host=$db_host; dbname=shop; charset=utf8';
		$pdo = new PDO($dsn, $db_user, $db_pw);

		// エラー時の設定
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		// SQL文の記述（product_codeを元にname・price・costを削除）
		$sql = 'DELETE FROM master_product WHERE code=?';

		// SQL発行の準備
		$stmt = $pdo->prepare($sql);

		// product_codeを配列に格納
		$data[] = $product_code;

		// SQLを発行
		$stmt->execute($data);

		// 切断
		$pdo = null;

		if($product_image != ''){
			unlink('images/'.$product_image); // imagesフォルダから画像を削除
		}

		// 表示
		echo 'データベース接続に成功しました。<br />';
		echo '<p>選択した商品を削除しました。</p>';
		//echo '<p>商品名：'.$product_name.'</p>';
		//echo '<p>価格：'.$product_price.'円</p>';
		//echo '<p>原価：'.$product_cost.'円</p>';
		echo '<p><a href="product_list.php">商品一覧にもどる</a></p>';

	}catch(PDOException $Exception){

		echo 'データベース接続に失敗しました。理由：'.$Exception->getMessage();
		echo '<p><a href="product_list.php">商品一覧にもどる</a></p>';
		exit();

	}
		?>
	</body>
</html>
