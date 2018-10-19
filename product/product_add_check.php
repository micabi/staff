<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>商品追加確認画面</title>
	</head>
	<body>
		<h2>商品追加確認画面</h2>
		<?php
			// product_sdd.phpから値を受け取る
			$product_name = $_POST['product_name'];
			$product_price = $_POST['product_price'];
			$product_cost = $_POST['product_cost'];
			$product_image = $_FILES['image'];
			//var_dump($product_image);

			//入力情報をサニタイジング
			$product_name = htmlspecialchars($product_name);
			$product_price = htmlspecialchars($product_price);
			$product_cost = htmlspecialchars($product_cost);
			//var_dump($product_name);
			//var_dump($product_price);
			//var_dump($product_cost);

			//$product_cost = mb_convert_kana($product_cost, 'n', 'utf8');
			//$product_cost = intval($product_cost);
			//var_dump($product_cost);


			if($product_image['name'] == ''){ // 画像を選択していなかったら
				echo '<img src="images/no_image.jpg"  /><br />';
			}

			if($product_image['size'] > 0){ // 画像容量が0KBを超えていたら
			 	if($product_image['size'] > 1000000){ // 画像容量が1MBを超えていたら
					echo '画像サイズは1MB未満にして下さい。<br />';
				}else{
					move_uploaded_file($product_image['tmp_name'], 'images/'.$product_image['name']);
					echo '<img src="images/'.$product_image['name'].'"  /><br />';
				}
			}

			if($product_name == ''){
				echo '商品名を入力して下さい。<br />';
			}else{
				echo '商品名：';
				echo $product_name;
				echo '<br />';
			}

			if($product_price == ''){
				echo '価格を入力して下さい。<br />';
			}else if(ctype_digit($product_price) == false){
				echo '価格は半角数字で入力して下さい。<br />';
			}else{
				echo '価格：';
				echo $product_price.'円';
				echo '<br />';
			}

			if($product_cost == ''){
				echo '原価を入力して下さい。<br />';
			}else if(ctype_digit($product_cost) == false){ // 文字列が半角数値でなかったら
				echo '原価は半角数字で入力して下さい。<br />';
			}else if($product_price < $product_cost){
				echo '原価が価格を上回っています。<br />';
			}else{
				echo '原価：';
				echo $product_cost.'円';
				echo '<br />';
			}

			if($product_name == '' || $product_price == '' || ctype_digit($product_price) == false
			|| $product_cost == '' || ctype_digit($product_cost) == false
			|| $product_price < $product_cost || $product_image['size'] > 1000000){
				echo '<br />';
				echo '<form>';
				echo '<input type="button" value="商品追加画面にもどる" onclick="history.back()" />';
				echo '</form>';
			}else{
				echo '<br />';
				echo '以上の内容で商品情報を追加します。よろしいですね？<br />';
				echo '<br />';
				echo '<form action="product_add_done.php" method="post">';
				echo '<input type="hidden" name="product_name" value="'.$product_name.'" />';
				echo '<input type="hidden" name="product_price" value="'.$product_price.'" />';
				echo '<input type="hidden" name="product_cost" value="'.$product_cost.'" />';
				echo '<input type="hidden" name="image" value="'.$product_image['name'].'"  />';
				echo '<input type="button" value="戻ってやり直す" onclick="history.back()" />&nbsp;';
				echo '<input type="submit" value="追加する" />';
				echo '</form>';
			}

		?>
	</body>
</html>
