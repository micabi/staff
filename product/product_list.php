<?php
	session_start();
	session_regenerate_id(true);

	if(isset($_SESSION['login']) == false){

		echo '<p>ログインしていません。</p>';
		echo '<p><a href="../staff/staff_login.php">ログイン画面へ</a></p>';
		exit();

	}else{

		echo '<p>'.$_SESSION['staff_name'].'さんでログイン中.....</p>';

	}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>商品一覧画面</title>
		<link rel="stylesheet" href="http://yui.yahooapis.com/3.5.0/build/cssreset/cssreset-min.css" media="screen" />
		<link rel="stylesheet" href="../css/common.css" media="screen" />
	</head>
	<body>
		<h2>商品一覧画面</h2>
		<p>商品を選択して操作して下さい。</p><br />
		<?php
			try{
			// SQLの接続準備
			$db_host = 'localhost';
			$db_name = 'shop';
			$db_user = 'root';
			$db_pw = '';

			// SQLのセッティング
			$dsn = 'mysql: host=$db_host; dbname=shop; charset=utf8';
			$pdo = new PDO($dsn, $db_user, $db_pw);

			// エラー時の設定
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

			// SQL文の記述（master_productからcode・name・price・costを全部取り出す）
			$sql = 'SELECT code, name, price, cost FROM master_product WHERE 1';

			// SQL文を発行準備
			$stmt = $pdo->prepare($sql);

			// SQLの発行
			$stmt->execute();

			// 切断
			$pdo = null;

			echo '<form action="product_branch.php" method="post">';

			while($stmt == true){ // $stmtに中身が入っていたら
				$rec = $stmt->fetch(PDO::FETCH_ASSOC); // 1個ずつ取り出して$recに入れる

				if($rec == false){ // $recが空ならループを止める
					break;
				}

				echo '<p><input type="radio" name="product_code" value="'.$rec['code'].'" />';
				echo '商品名：'.$rec['name'].'&nbsp;-----';
				echo '価格：'.$rec['price'].'円&nbsp;';
				echo '原価：'.$rec['cost'].'円&nbsp;</p>';
				echo '<br />';

			} // End of while

		}catch(PDOException $Exception){

			echo 'データベース接続に失敗しました。理由：'.$Exception->getMessage();
			exit();

		}
		?>

			<br />
			<p>
			<input type="submit" name="disp" value="商品詳細画面へ" />
			<input type="submit" name="add" value="商品を追加する" />
			<input type="submit" name="edit" value="商品情報を修正する" />
			<input type="submit" name="delete" value="商品情報を削除する" /></p>
		</form>

		<p><a href="../staff/staff_logout.php">ログアウトする</a>&nbsp;&nbsp;<a href="../branch.php">スタッフ管理画面へ</a></p>
	</body>
</html>
