<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>スタッフ一覧の修正</title>
</head>
<body>
    <?php
    try{
        // 接続前の準備
        $db_name = 'shop'; // データベース名
        $db_host = 'localhost'; // ホスト名
        $db_user = 'root'; // ユーザー名
        $db_pw = ''; // パスワード

        // 接続先の設定
        $dsn = 'mysql: host=$db_host; dbname=shop; charset=utf8'; // 接続先
        $pdo = new PDO($dsn, $db_user, $db_pw); // ユーザー名・パスワード

        // エラー時の設定
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        // SQL文の作成と格納
        $sql = 'SELECT name FROM master_staff WHERE code=?'; // SQL文（問い合わせ内容=IDx番目のnameを取り出す）
                                                                                            // 1 テーブルmaster_staffの中からnameを取り出す
                                                                                            // 2 但しIDx番目のだけで良い
        $stmt = $pdo->prepare($sql);

        // staff_list.phpから値を受け取る
        $staff_code = $_GET['staffcode']; // 文字列
        $data[] = $staff_code; // 配列要素の0番めの要素としてキーを与える

        // データベースに問い合わせを発行（executeの引数には配列を渡す）
        $stmt->execute($data);

        // 受け取ったIDを1つずつ取り出し（といっても1つしかないが）
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $staff_name = $rec['name'];  // そのstaff_codeのnameを格納

        // 切断
        $pdo = null;
        echo "接続成功。";


    }catch(PDOException $Exception){
        exit();
        echo "接続に失敗しました。理由は：".$Exception->getMessage()."です。";
    }

    ?>

<h2>スタッフ修正画面</h2>
<p>修正するスタッフID</p>
<?php echo $staff_code; ?><br><br>
<p>修正するスタッフ名</p>
<?php echo $staff_name; ?><br><br>
<p>修正内容</p>
<form action="staff_edit_done.php" method="post">
    <input type="hidden" name="code" value="<?php echo $staff_code; ?>">
    スタッフ名 <br>
    <input type="text" name="name" value=""><br><br>
    パスワード <br>
    <input type="password" name="pass" value=""><br><br>
    パスワード（確認用） <br>
    <input type="password" name="pass2" value=""><br><br>
    <input type="button"  value="戻る" onclick="history.back()">
    <input type="submit" value="修正を確定する">
</form>



</body>
</html>
