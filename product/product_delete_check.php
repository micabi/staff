<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>削除商品確認画面</title>
	</head>
	<body>
		<h2>削除商品確認画面</h2>
		<?php
		try{
		// product_branch.phpから値を受け取る
		$product_code = $_GET['code'];
		var_dump($product_code);

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

		// SQL文の記述（product_codeを元にname・price・costを取り出し）
		$sql = 'SELECT name, price, cost, images FROM master_product WHERE code=?';

		// SQL発行の準備
		$stmt = $pdo->prepare($sql);

		// product_codeを配列に格納
		$data[] = $product_code;

		// SQLを発行
		$stmt->execute($data);

		// 切断
		$pdo = null;

		// データを取り出し
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$product_name = $rec['name'];
		$product_price = $rec['price'];
		$product_cost = $rec['cost'];
		$product_image = $rec['images'];
		var_dump($product_image);

		// 表示
		echo 'データベース接続に成功しました。<br />';
		echo '<p>以下の商品を削除します。よろしいですか？</p>';
		echo '<p>商品名：'.$product_name.'</p>';
		echo '<p>価格：'.$product_price.'円</p>';
		echo '<p>原価：'.$product_cost.'円</p>';
		if($product_image == ''){
			echo '<p><img src="images/no_image.jpg" alt="画像がありません" /></p>';
		}else{
			echo '<p>画像<br /><img src="images/'.$product_image.'"</p>';
		}
		echo '<form action="product_delete_done.php" method="post" >';
		echo '<input type="hidden" name="product_code" value="'.$product_code.'">'; // コードを渡す
		echo '<input type="hidden" name="product_image" value="'.$product_image.'">'; // 画像を渡す
		echo '<input type="submit" value="削除する" />&nbsp;<input type="button" value="やり直す" onclick="history.back()" />';
		echo '</form>';

	}catch(PDOException $Exception){

		echo 'データベース接続に失敗しました。理由：'.$Exception->getMessage();
		echo '<p><a href="product_list.php">商品一覧にもどる</a></p>';
		exit();

	}
		?>
	</body>


</html>
