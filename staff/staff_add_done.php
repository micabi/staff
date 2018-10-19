<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>情報の追加</title>
</head>
<body>
    <?php

    try{
        $staff_name = $_POST['name'];
        $staff_pass = $_POST['pass'];

        $staff_name = htmlspecialchars($staff_name);
        $staff_pass = htmlspecialchars($staff_pass);

        //var_dump($staff_name);
        //var_dump($staff_pass);

        // 接続
        $dsn = 'mysql:dbname=shop;host=localhost';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->query('SET NAMES utf8');

        // 命令
        $sql = 'INSERT INTO master_staff(name, password) VALUES(?,?)';
        $stmt = $dbh->prepare($sql);
        $data[] = $staff_name;
        $data[] = $staff_pass;
        $stmt->execute($data);

        // 切断
        $dbh = null;

        echo $staff_name;
        echo 'さんをデータベースに追加しました<br />';
    }catch(Exception $e){
        echo 'データベースサーバーがダウンしています';
        exit();
    }

    ?>
    <br><br>
    <a href="staff_list.php">戻る</a>&nbsp;
    <a href="staff_add.php">続けてスタッフを追加する</a>
</body>
</html>
