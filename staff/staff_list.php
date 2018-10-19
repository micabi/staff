<?php
session_start();
session_regenerate_id(true); // 暗号を毎度変更する

if(isset($_SESSION['login']) == false){ // 認証がなかったら

  echo 'ログインしていません。<br /><br />';
  echo '<a href="staff_login.php">ログイン画面に戻る</a>';
  exit();

}else{

  echo $_SESSION['staff_name'].'さんでログイン中です。<br />';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>スタッフ管理画面</title>
</head>
<body>
<?php
    try{
        // 接続
        $dsn = 'mysql:dbname=shop;host=localhost';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->query('SET NAMES utf8');

        // 命令
        $sql = 'SELECT code, name FROM master_staff WHERE 1'; // master_staffからcodeとnameを取り出す
        $stmt = $dbh->prepare($sql); // 準備
        $stmt->execute(); // $stmtに全てのデータ（全ID）を格納

        // 切断
        $dbh = null;

        echo '<h2>スタッフ管理画面</h2>';

        echo '<form method="post" action="staff_branch.php">';

        while($stmt == true){
            $rec = $stmt->fetch(PDO::FETCH_ASSOC); // $stmtから1レコードずつ取り出して$recに代入
                if($rec == false){ // $recが空になったら
                    break;
                }
            // スタッフ名を表示
            echo '<input type="radio" name="staffcode" value="'.$rec['code'].'">';
            echo $rec['name']; // $recの中からname属性を出力
            echo '<br />';
            $staff_name = $rec['name'];

        }
        // ボタンを表示
        echo '<br />';
        echo '<input type="submit" name="disp" value="スタッフ情報をみる" />'.'&nbsp;&nbsp;';
        echo '<input type="submit" name="add" value="スタッフを追加する"  />'.'&nbsp;&nbsp;';
        echo '<input type="submit" name="edit" value="スタッフ情報を修正する" />'.'&nbsp;&nbsp;';
        echo '<input type="submit" name="delete" value="スタッフ情報を削除する" />';
        echo '</form>';
        echo '<p><a href="staff_logout.php">ログアウトする</a>&nbsp;&nbsp;<a href="../branch.php">商品管理画面へ</a></p>';

    }catch(Exception $e){
        echo '障害発生';
        exit();
    }
    ?>
</body>
</html>
