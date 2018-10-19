<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>スタッフ追加</title>
</head>
<body>
    <h2>スタッフ追加</h2>

    <form method="post" action="staff_add_check.php">
        スタッフ名を入力して下さい。<br />
        <input type="text" name="name" /><br />
        パスワードを入力して下さい。<br />
        <input type="password" name="pass" /><br />
        パスワードを入力して下さい（確認）<br />
        <input type="password" name="pass2" /><br />
        <input type="submit" value="入力内容を確認する" />
        <input type="button" value="戻る" onclick="history.back()" />
    </form>
</body>
</html>
