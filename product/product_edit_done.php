<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>修正完了</title>
	</head>
	<body>
		<h2>商品情報の修正が完了しました</h2>
		<?php
		try{
		// product_edit_check.phpから値を受け取る
		$product_code = $_POST['code'];
		$product_name = $_POST['name'];
		$product_price = $_POST['price'];
		$product_cost = $_POST['cost'];
		$old_image = $_POST['old_image'];
		$product_image = $_POST['image'];
		var_dump($old_image);
		var_dump($product_image);

		// SQL接続前の変数を準備
		$db_host = 'localhost';
		$db_name = 'shop';
		$db_user = 'root';
		$db_pw = '';

		// SQL接続の準備
		$dsn = 'mysql: host=$db_host; dbname=shop; charset=utf8';
		$pdo = new PDO($dsn, $db_user, $db_pw);

		// エラー時の設定
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		// SQL文の記述（product_codeを元にname・price・costを上書きする）
		$sql = 'UPDATE master_product SET name=?, price=?, cost=?, images=? WHERE code=?';

		// SQL接続準備
		$stmt = $pdo->prepare($sql);

		// name・price・costを配列に格納
		$data[] = $product_name;
		$data[] = $product_price;
		$data[] = $product_cost;
		$data[] = $product_image;
		$data[] = $product_code;

		// SQLを発行
		$stmt->execute($data);

		// 切断
		$pdo = null;

		// 表示
		echo 'データベース接続に成功しました。<br />';
		echo '商品情報を変更しました。';
		if($old_image != $product_image){
			if($old_image != ''){
				unlink('images/'.$old_image);
			}
		}

	}catch(PDOException $Exception){

		echo 'データベース接続に失敗しました。理由：'.$Exception->getMessage();
		exit();

	}
		?>

		<p><a href="product_list.php">商品一覧画面にもどる</a>&nbsp;&nbsp;
		<a href="product_add.php">商品を追加する</a></p>
	</body>
</html>
