<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>修正チェック</title>
	</head>
	<body>
		<?php
			$staff_code = $_POST['code'];
			$staff_name = $_POST['name'];
			$staff_pass = $_POST['pass'];
			$staff_pass2 = $_POST['pass2'];

			var_dump($staff_name);

			echo '<form method="post" action="staff_edit_done.php">';
			echo '<input type="hidden" name="code" value="'.$staff_code.'" />';
			echo '<input type="submit" value="送信する" />';
			echo '<input type="button" value="やり直す" onclick="history.back()" />';
			echo '</form>';
		?>
	</body>
</html>
