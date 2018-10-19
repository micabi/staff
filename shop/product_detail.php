<?php
// カートの中身をどのページでも渡して表示できるように
session_start();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>商品詳細</title>
		<link rel="stylesheet" href="../css/common.css" media="screen"/>
	</head>
	<body>
		<h2>商品詳細</h2>
		<?php
		try{
			// list.phpからコードを受け取る
			$product_code = $_GET['code'];
			var_dump($product_code);

			// SQL接続のための変数を準備
			$db_host = 'host';
			$db_name = 'shop';
			$db_user = 'root';
			$db_pw = '';

			// 変数をセット
			$dsn = 'mysql: host=$db_host; dbname=shop; charset=utf8';
			$pdo = new PDO($dsn, $db_user, $db_pw);

			// エラー時の設定
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

			// SQL文の記述（コードから商品名・価格・画像を取り出す）
			$sql = 'SELECT name, price, images FROM master_product WHERE code=?';

			// 発行の準備
			$stmt = $pdo->prepare($sql);

			// コードを配列に格納
			$data[] = $product_code;

			// SQLを発行
			$stmt->execute($data);

			// 切断
			$pdo = null;
			echo 'データベース接続に成功しました。';

			// データの取り出し
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
			var_dump($rec);

			/*
				$recには連想配列が入っている
				$rec = array(name => '', price => '', images => '');

			*/

			// 変数に格納
			$product_name = $rec['name'];
			$product_price = $rec['price'];
			$product_image = $rec['images'];
			//var_dump($product_image);
			if($product_image == ''){
				$product_image = 'no_image.jpg';
			}

		}catch(PDOException $Exception){

			echo 'データベース接続に失敗しました。理由：'.$Exception->getMessage;
			exit();

		}
		?>

		<p>商品名：<br /><?php echo $product_name; ?></p>
		<p>価格：<br /><?php echo $product_price; ?>円</p>
		<p>商品画像：<br /><img src="../product/images/<?php echo $product_image; ?>" /></p>

		<div id="curt">
			<a href="cart_in.php?code=<?php echo $product_code; ?>">カートに入れる</a>
		</div><!-- /#curt -->
		<!--<p><a href="list.php">もどる</a></p>-->
		<p><input type="button" value="商品一覧にもどる" onclick="history.back()" /></p>
	</body>
</html>
