<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>入力内容確認｜商品情報修正画面</title>
	</head>
	<body>
		<h2>入力内容確認</h2>
		<?php
			// product_edit.phpから値を受け取る
			$product_code = $_POST['code'];
			$old_product_image = $_POST['old_product_image'];
			$product_name = $_POST['name'];
			$product_price = $_POST['price'];
			$product_cost = $_POST['cost'];
			$new_product_image = $_FILES['new_product_image'];
			var_dump($old_product_image);
			var_dump($new_product_image['name']);

			// サニタイジング
			$product_name = htmlspecialchars($product_name);
			$product_price = htmlspecialchars($product_price);
			$product_cost = htmlspecialchars($product_cost);
			//var_dump($product_code);
			//var_dump($product_name);
			//var_dump($product_price);
			//var_dump($product_cost);

			// エラー
			if($product_name == ''){
				echo '商品名を入力して下さい。';
			}else{
				echo '<p>商品名：'.$product_name.'</p>';
			}

			if($product_price == ''){
				echo '価格を入力して下さい。<br />';
			}else if(ctype_digit($product_price) == false){
				echo '価格は半角数字で入力して下さい。';
			}else{
				echo '<p>価格：'.$product_price.'円</p>';
			}

			if($product_cost == ''){
				echo '原価を入力して下さい。<br />';
			}else if(ctype_digit($product_cost) == false){
				echo '原価は半角数字で入力して下さい。';
			}else{
				echo '<p>原価：'.$product_cost.'円</p>';
			}

			if($product_price < $product_cost){
				echo '<p style="color: red;">原価が価格を上回っています。よろしいですか？</p>';
			}

			if($new_product_image['name'] == ''){
				echo '<p>画像<br /><img src="images/no_image.jpg" alt="画像がありません"  /></p>';
			}

			if($new_product_image['size'] > 0){
				if($new_product_image['size'] > 1000000){
					echo '<p>画像のサイズは1MB以下にして下さい。</p>';
				}else{
					move_uploaded_file($new_product_image['tmp_name'], 'images/'.$new_product_image['name']);
					echo '<p>画像<br /><img src="images/'.$new_product_image['name'].'" alt="'.$product_name.'" /></p>';
				}
			}

			if($product_name == '' || $product_price == '' || ctype_digit($product_price) == false
			|| $product_cost == '' || ctype_digit($product_cost) == false
			||$new_product_image['size'] > 1000000){
				echo '<form>';
				echo '<p><input type="button" value="入力し直す" onclick="history.back()"  /></p>';
				echo '</form>';
			}else{
				echo '<form action="product_edit_done.php" method="post">';
				echo '<input type="hidden" name="code" value="'.$product_code.'"  />';
				echo '<input type="hidden" name="name" value="'.$product_name.'"  />';
				echo '<input type="hidden" name="price" value="'.$product_price.'"  />';
				echo '<input type="hidden" name="cost" value="'.$product_cost.'"  />';
				echo '<input type="hidden" name="old_image" value="'.$old_product_image.'"  />';
				echo '<input type="hidden" name="image" value="'.$new_product_image['name'].'"  />';
				echo '<p><input type="submit" value="この内容で確定する"  />&nbsp;<input type="button" value="入力し直す" onclick="history.back()"  /></p>';
				echo '</form>';
			}
		?>
	</body>
</html>
