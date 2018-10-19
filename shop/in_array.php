<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>配列の要素に特定の値が入っているかどうか調べる</title>
	</head>
	<body>
		<h2>配列の要素に特定の値が入っているかどうか調べるin_array();</h2>
		<?php
			$yasai = array('ピーマン', 'オクラ', 'ニンジン', 'しいたけ', 'かぼちゃ', 'トマト');

			if(in_array('ごぼう' , $yasai) == true){
				echo '安心して下さい。入ってますよ。';
			}else{
				echo '入ってません。';
			}

		?>
	</body>
</html>
