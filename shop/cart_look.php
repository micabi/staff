<?php
session_start();
session_regenerate_id(true);

if(isset($_SESSION['cart']) == true){

	$cart = $_SESSION['cart']; // $cart = array(0=>$product_codeA, 1=>$product_codeB, 2=>$product_codeC,...);
	$kazu = $_SESSION['kazu']; // cart_in.phpのループ中で$kazu[] = 1; と定義

/*
	$kazu = array(0=> 1, 1=> 1, 2=>1,....); ひたすら1が格納された商品数量の配列
*/
	$max = count($cart); // $cart配列に入っている$product_codeの個数
	//var_dump($max);
	echo 'count($cart)の結果、$cartの配列中の要素数は'.$max.'個';

}else{
	$max = 0;
}

if($max == 0){
	echo '<p>カートには何も入っていません。</p>';
	echo '<p><a href="list.php">商品一覧にもどる</a></p>';
	exit();
}


?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>カートの中</title>
		<link rel="stylesheet" href="../css/common.css" media="screen" />
	</head>
	<body>
		<h2>カートの中を見る</h2>
		<?php
			try{
				// データベース接続のための変数を準備
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



			// ここからループしている。配列の要素を1つずつ処理する
			foreach($cart as $key => $value){ // $cart配列の中身（コード）だけを取り出す。添字は捨てる

				// SQL文の記述（コードを元に商品名・価格・画像を取り出す）
				$sql = 'SELECT name, price, images FROM master_product WHERE code=?';

				// SQL準備
				$stmt = $pdo->prepare($sql);

				// データを変数に格納
				$data[0] = $value; // カートに入れた商品コード

				/*

				$data[0]とするのは、
				code = nに対応するname、price、imagesをそれぞれに取り出す目的

				$data = array(0 => 15);
				$data = array(0 => 24);
				$data = array(0 => 67);
				$data = array(0 => 11);
				...

				もし$data = $value;とすると、
				$data = array(0 => 15, 1 => 24, 2 => 67, 3 => 11, 4 => .....);
				と格納されてしまう。

				配列に入れるときは、$変数[] =
				配列から取り出すときは、foreach($変数 as $key => $value){}
				配列とは何を共通項にしてくくるのかという管理の方法


				*/

				// SQL発行
				$stmt->execute($data);

				// 取り出し
				$rec = $stmt->fetch(PDO::FETCH_ASSOC); // DBからcode = nに対応したname・price・imagesを1つずつ取り出す

				/* この時点でSQL命令にしたがって$recにはcodeに対応したname、price、imagesが多次元配列になって入っている
					$rec = array(
							0=> array(code=> '15', name=> '愛犬元気', price=> '1500', images=> 'abc.jpg'),
							1=> array(code=> '24', name=> 'ビスカル', price=> '2000', images=> 'def.jpg'),
							2=> array(code=> '67', name=> 'アイムス', price=> '4500', images=> 'ghi.jpg'),
							3=> array(code=> '11', name=> 'ビタミン', price=> '1000', images=> 'osj.jpg'),
							4=> array(code=> 'n', name=> 'ビスカル', price=> '2000', images=> 'def.jpg'),
						....
									);
				*/

				/*
				var_dump($rec); // 最後にカートに入れた値が表示される
				var_dump($rec['name']); // 最後にカートに入れた要素のプロパティ：nameの値が表示される
				var_dump($rec['price']); // 最後にカートに入れた要素のプロパティ：priceの値が表示される
				var_dump($rec['images']); // 最後にカートに入れた要素のプロパティ：imagesの値が表示される
				*/

				// 値を変数に格納
				$product_name[] = $rec['name'];
				$product_price[] = $rec['price'];
				//$product_image[] = $rec['images'];

				if($rec['images'] == ''){ // $rec['images']が空だったら
					$product_image[] = 'no_image.jpg';
				}else{
					$product_image[] = $rec['images'];
				}

				/*

				codeくくりでまとめていたものをname毎、price毎、images毎にくくり直す

				$product_name =  array(0 => 'アイムス', 1 => '愛犬元気', ....);  $product_name[0], $product_name[1]...
				$product_price =   array(0 => '2500', 1 => '1300', ....);           $product_price[0], $product_price[1]...
				$product_image = array(0 => 'imus.jpg', 1 => 'aiken.jpg', ....); $product_image[0], $product_image[1]...

				*/


			} // ループはここまで

				// 切断
				$pdo = null;
				echo 'データベース接続に成功しました。';
/*
				var_dump($product_name);
				var_dump($product_price);
				var_dump($product_image);
*/
			}catch(PDOException $Exception){

				echo 'データベース接続に失敗しました。理由：'.$Exception->getMessage();
				exit();

			}
		?>
		<form action="sum_change.php" method="post">

		<table id="cart_look">
			<tr>
				<td>商品名</td>
				<td>価格</td>
				<td>商品画像</td>
				<td>購入数</td>
				<td>小計</td>
				<td>削除</td>
			</tr>
			<?php for($i = 0; $i < $max; $i++): ?>
			<tr>
				<td><?php echo $product_name[$i]; ?></td>
				<td><?php echo $product_price[$i].'円'; ?></td>
				<td><?php echo '<img src="../product/images/'.$product_image[$i].'" />'; ?></td>
				<td><input type="text" name="kazu<?php echo $i; ?>" value="<?php echo $kazu[$i]; ?>" style="width: 30px;">個<!-- 購入数をpost --></td>
				<td><?php echo $product_price[$i]*$kazu[$i].'円'; ?></td>
				<td><input type="checkbox" name="delete<?php echo $i; ?>"></td>
			</tr>

			<?php
				$syoukei[] = $product_price[$i]*$kazu[$i];
				//var_dump($syoukei);
			?>

			<?php endfor; ?>
			<tr>
				<td colspan="4">合計</td>
				<td>
			<?php
				//var_dump($syoukei);
				$item_sum = 0;

				foreach($syoukei as $key => $val){
					$item_sum += $val;
				}


				echo $item_sum.'円';

			?></td>
				<td>&nbsp;</td>
			</tr>
		</table>

			<br><br>

			<input type="hidden" name="max" value="<?php echo $max; ?>"><!-- 配列の要素数をpost -->
			<input type="submit" value="数量を変更する">
			<p><a href="list.php">商品一覧にもどる</a></p>
			<!--<input type="button" value="商品一覧にもどる" onclick="history.back()">-->
		</form>
	</body>
</html>
<?php

	/*
		submitによりpostされるのは
		アイテム毎の購入数…$kazu（最初の時点では常に1）
		カートに入ったアイテムの自体の数…$max（$cart・$kazuの配列要素数）
	*/

?>
