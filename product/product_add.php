<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>商品追加画面</title>
	</head>
	<body>
		<h2>商品追加画面</h2>
		<form action="product_add_check.php" method="post" enctype="multipart/form-data">
			<p>商品名：<input type="text" name="product_name" value="" /></p>
			<p>価格：<input type="text" name="product_price" value="" /></p>
			<p>原価：<input type="text" name="product_cost" value="" /></p>
			<p>商品画像：<input type="file" name="image"  /></p>
			<p><input type="submit" value="入力内容を確認する"></p>
		</form>
		<p><a href="product_list.php">商品一覧へ</a></p>
	</body>
</html>
