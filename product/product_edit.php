<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>商品情報修正画面</title>
	</head>
	<body>
		<h2>商品情報修正画面</h2>
		<?php
			try{
			// product_branch.phpから値を受け取り
			$product_code = $_GET['code'];
			var_dump($product_code);

			// SQL接続の変数準備
			$db_host = 'localhost';
			$db_name = 'shop';
			$db_user = 'root';
			$db_pw = '';

			// データベース接続のための変数をセッティング
			$dsn = 'mysql: host=$db_host; dbname=shop; charset=utf8';
			$pdo = new PDO($dsn, $db_user, $db_pw);

			// エラー時の設定
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

			// SQL文の記述（codeを元にname・price・costを取り出す）
			$sql ='SELECT name, price, cost, images FROM master_product WHERE code=?';

			// SQLを準備
			$stmt = $pdo->prepare($sql);

			// 送信するcodeを配列に入れる
			$data[] = $product_code;

			// SQLで問い合わせ
			$stmt->execute($data);

			// 切断
			$pdo = null;
			echo 'データベース接続に成功';

			// データをひとつずつ取り出す
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);

			// データを変数に格納
			$product_name = $rec['name'];
			$product_price = $rec['price'];
			$product_cost = $rec['cost'];
			$old_product_image = $rec['images'];

		}catch(PDOExeption $Exception){

			echo 'データベース接続に失敗しました。理由：'.$Exception->getMessage();
			exit();

		}
		?>
		<p>選択された商品</p>
		<p>商品名</p>
		<p><?php echo $product_name; ?></p>
		<p>価格</p>
		<p><?php echo $product_price; ?></p>
		<p>原価</p>
		<p><?php echo $product_cost; ?></p>
		<?php
			if($old_product_image == ''){
				echo '<p><img src="images/no_image.jpg" alt="画像がありません" /></p>';
			}else{
				echo '<p><img src="images/'.$old_product_image.'" alt="'.$product_name.'" /></p>';
			}
		?>


		<p>修正後の情報を入力して下さい</p>
		<form action="product_edit_check.php" method="post" enctype="multipart/form-data">
			<p><input type="hidden" name="code" value="<?php echo $product_code; ?>"></p>
			<p><input type="hidden" name="old_product_image" value="<?php echo $old_product_image; ?>" /></p>
			<p>商品名：<input type="text" name="name" value="<?php echo $product_name; ?>"></p>
			<p>価格：<input type="text" name="price" value=""></p>
			<p>原価：<input type="text" name="cost" value=""></p>
			<p>画像：<input type="file" name="new_product_image" value="" /></p>
			<p><input type="submit" value="入力内容を確認する">&nbsp;<input type="button" value="商品一覧画面にもどる" onclick="history.back()"></p>
		</form>



	</body>
</html>
