<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>商品詳細画面</title>
	</head>
	<body>
		<h2>商品詳細画面</h2>
		<?php
		try{
		// product_branch.phpから値を受け取る
		$product_code = $_GET['code'];
		var_dump($product_code);

		// SQL接続の変数準備
		$db_host = 'localhost';
		$db_name = 'shop';
		$db_user = 'root';
		$db_pw = '';

		// SQL接続前の準備
		$dsn = 'mysql: host=$db_host; dbname=shop; charset=utf8';
		$pdo = new PDO($dsn, $db_user, $db_pw);

		// エラー時の設定
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		// SQL文の記述（codeを元にname・price・costを取り出す）
		$sql = 'SELECT name, price, cost, images FROM master_product WHERE code=?';

		// SQL発行の準備
		$stmt = $pdo->prepare($sql);

		// codeを配列に格納
		$data[] = $product_code;

		// SQLを発呼
		$stmt->execute($data);

		// 切断
		$pdo = null;

		// 取り出し
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$product_name = $rec['name'];
		$product_price = $rec['price'];
		$product_cost = $rec['cost'];
		$product_image = $rec['images'];

		// 表示
		echo 'データベース接続に成功しました。';

	}catch(PDOException $Exception){

		echo 'データベース接続に失敗しました。理由：'.$Exception->getMessage();
		exit();

	}
		?>

		<p>商品情報</p>
		<p>商品コード：<?php echo $product_code; ?></p>
		<p>商品名：<?php echo $product_name; ?></p>
		<p>価格：<?php echo $product_price; ?>円</p>
		<p>原価：<?php echo $product_cost; ?>円</p>
		<?php
			if($product_image == ''){
				echo '<p><img src="images/no_image.jpg" alt="画像がありません"  /></p>';
			}else{
				echo '<p><img src="images/'.$product_image.'" alt="'.$product_name.'"  /></p>';
			}
		?>
		<p><a href="product_list.php">商品一覧にもどる</a></p>
	</body>
</html>
