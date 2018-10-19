<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>商品追加</title>
	</head>
	<body>
		<h2>商品を追加しました</h2>
		<?php
		try{
		// product_add_check.phpから値を受け取る
		$product_name = $_POST['product_name'];
		$product_price = $_POST['product_price'];
		$product_cost = $_POST['product_cost'];
		$product_image = $_POST['image'];
		//var_dump($product_name);
		//var_dump($product_price);
		//var_dump($product_cost);
		var_dump($product_image);

		// SQLの接続準備
		$db_host = 'localhost';
		$db_name = 'shop';
		$db_user = 'root';
		$db_pw = '';

		$dsn = 'mysql: host=$db_host; dbname=shop; charset=utf8';
		$pdo = new PDO($dsn, $db_user, $db_pw);

		// エラー時の設定
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		// SQL文を記述（master_productにname・price・costを入れる）
		$sql = 'INSERT INTO master_product(name, price, cost, images) VALUES(?, ?, ?, ?) ';

		// SQL文をセッティング
		$stmt = $pdo->prepare($sql);

		// VALUESの順番に沿って値を配列に入れる
		$data[] = $product_name;
		$data[] = $product_price;
		$data[] = $product_cost;
		$data[] = $product_image;

		// SQLを発行（）
		$stmt->execute($data);

		// 切断
		$pdo = null;
		echo 'データベース接続に成功しました。<br />';
		echo '商品名：'.$product_name.'<br />';
		echo '価格：'.$product_price.'円<br />';
		echo '原価：'.$product_cost.'円<br />';
		echo '画像名：'.$product_image.'<br />';
		echo 'を追加しました。<br />';

	}catch(PDOException $Exception){

		echo 'データベース接続に失敗しました。理由：'.$Exception->getMessage();
		exit();

	}
		?>
		<p><a href="product_list.php">商品一覧へ</a>&nbsp;<a href="product_add.php">さらに追加する</a></p>
	</body>
</html>
