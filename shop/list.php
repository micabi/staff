<?php
// カートの中身をどのページでも渡して表示できるように
session_start();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>商品一覧ページ</title>
	</head>
	<body>
		<h2>商品一覧ページ</h2>
		<?php
		try{
			// SQL接続のための変数準備
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

			// SQL文を記述（コード・商品名・価格・画像を全部取り出す）
			$sql = 'SELECT code, name, price, images FROM master_product WHERE 1';

			// SQL準備
			$stmt = $pdo->prepare($sql);

			// SQL発行
			$stmt->execute();

			// 切断
			$pdo = null;

			// 取り出し
			while($stmt == true){
				$rec = $stmt->fetch(PDO::FETCH_ASSOC);
				if($rec == false){
					break;
				}

					//var_dump($rec);
					$product_code = $rec['code'];
					$product_name = $rec['name'];
					$product_price = $rec['price'];
					$product_image = $rec['images'];



					echo '<p><a href="product_detail.php?code='.$product_code.'">'.$product_name.'</a>&nbsp;'.$product_price.'円</p>';

			} // end while
					echo '<br /><br /><p><a href="cart_look.php">カートの中をみる</a></p>';
					echo '<br /><br /><p><a href="cart_clear.php">カートを空にする</a></p>';
			// 表示
			//echo 'データベース接続に成功しました。';

		}catch(PDOException $Exception){

			echo 'データベース接続に失敗しました。理由：'.$Exception->getMessage;
			exit();

		}



		?>
	</body>
</html>
