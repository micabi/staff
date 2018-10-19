<?php
session_start();
session_regenerate_id(true);

$product_code = $_GET['code']; // product_detail.phpからコードを受け取る


if(isset($_SESSION['cart']) == true){ // 既にカートに商品が入っている場合には
	$cart = $_SESSION['cart'];
	$kazu = $_SESSION['kazu'];

	if(in_array($product_code, $cart) == true){
		echo '<p>その商品は既にカートに入っています。<br />2つ以上お求めの場合は、「カートの中をみる」から数量を変更して下さい。</p>';
		echo '<p><a href="list.php">商品一覧にもどる</a></p>';
		exit();
	}
}



// 新しくproduct_detail.phpから受け取ったコードを配列に格納する
$cart[] = $product_code; // $cart = array($product_code, $product_code, $product_code, ....);
$kazu[] = 1; // 数量1を配列にいれる

/*

	×	$kazu = 1;
	○	$kazu = array(0 => 1); $kazu[n]の値は常に1となる

*/


// ページをまたいで値を渡せるように$_SESSIONに格納する
$_SESSION['cart'] = $cart; // カートに入れた順に商品コードが格納された配列
$_SESSION['kazu'] = $kazu; // $kazu = array(0=> 1, 1=> 1, 2=>1,....); ひたすら1




foreach($cart as $key => $value){ //  $cart = array(0=>$product_code, 1=>$product_code, 2=>$product_code,...);
	echo $key.'番目のインデックスには商品コード'.$value.'が入っています。<br />';
}

?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>カート</title>
	</head>
	<body>

		<p>商品をカートに追加しました。</p>
		<p><a href="list.php">商品一覧にもどる</a></p>
	</body>
</html>
