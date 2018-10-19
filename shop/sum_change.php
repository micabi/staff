<?php
	session_start();
	session_regenerate_id(true);

	$max = $_POST['max']; // 配列の要素数（カートに入れた順の）

	/*
	cart_look.phpからカートに入っているアイテム数を受け取り
	2種類入っていたら2、3種類入っていたら3
	アイテム毎の数量ではない
	*/

	$max = htmlspecialchars($max);

	for($i = 0; $i < $max; $i++){

		if(ctype_digit($_POST['kazu'.$i]) == false || $_POST['kazu'.$i] < 1){
				echo '<p>数量は半角数字で入力して下さい。
				また数量を0にする場合は「商品を削除する」にチェックを入れて下さい。</p>';
				echo '<p><a href="cart_look.php">カートにもどる</a></p>';
				exit();
		}

		if(5 < $_POST['kazu'.$i]){
			echo '<p>一度にお求めいただける数量は5個までとさせていただきます。<br />
			それ以上お求めの場合はメールにてお問い合わせ下さい。</p>';
			echo '<p><a href="cart_look.php">カートにもどる</a></p>';
			exit();
		}

		$kazu[] = $_POST['kazu'.$i]; // cart_look.phpからアイテム毎の数量を受け取り

	}

//var_dump($kazu);
/*
	$kazu = array(0 => '1', 1 => '1', 2 => '1', 3 => '1',...n => '1');
	$kazuの要素の数n = アイテムの購入数がカートに入れた順になって格納されている

	cart_in.phpにおいて
	if(isset() == true){
		$kazu = $_SESSION['kazu'];
	}
	$kazu[] = 1;により
	カートに入れるたび配列の要素数が1ずつ増えていく
	その要素の数と、カートに入っているそのアイテムの数は同じである

*/

$cart = $_SESSION['cart']; // 商品コードがカートに入れた順に入った配列

for($i = $max; 0 <= $i; $i--){

	if(isset($_POST['delete'.$i]) == true){
		array_splice($cart, $i, 1);
		array_splice($kazu, $i, 1);
	}

}

$_SESSION['cart'] = $cart;
$_SESSION['kazu'] = $kazu;
header('Location:cart_look.php');
exit();

?>
