<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>ループで削除</title>
	</head>
	<body>
		<h2>配列の要素を1ずつ削除</h2>
		<?php
			$yasai = array(0 => 'にんじん', 1 => 'ナス', 2 => 'アスパラ', 3 => 'キャベツ');

			//array_splice($yasai,2,1);

			$sum = count($yasai);
			//var_dump($sum); // 4つ

			for($i = $sum; $i >= 0 ;$i--){
				array_splice($yasai, $i, 1);
				var_dump($yasai);
			}
		?>
	</body>
</html>
