<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>入力チェック</title>
</head>
<body>
    <?php
    $staff_name = $_POST['name']; // $_POSTにはform ～ /formの中身が全部入っている
    $staff_pass = $_POST['pass']; // それを項目ごとに取り出すのが['name属性']
    $staff_pass2 = $_POST['pass2'];

    $staff_name = htmlspecialchars($staff_name);
    $staff_pass = htmlspecialchars($staff_pass);
    $staff_pass2 = htmlspecialchars($staff_pass2);

    if($staff_name == ''){
        echo "スタッフ名が入力されていません<br />";
    }else{
        echo "追加するスタッフ名：";
        echo $staff_name;
        echo "さん<br />";
    }

    if($staff_pass == ''){
        echo "パスワードが入力されていません<br />";
    }

    if($staff_pass != $staff_pass2){
        echo "パスワードが一致しません<br />";
    }

    if($staff_name == '' || $staff_pass == '' || $staff_pass != $staff_pass2){
        echo '<form>';
        echo '<input type="button" value="戻る" onclick="history.back()">';
        echo '</form>';
    }else{
        $staff_pass = md5($staff_pass); // 暗号化md5関数
        echo '<form method="post" action="staff_add_done.php">';
        echo '<input type="hidden" name="name" value="'.$staff_name.'" />';
        echo '<input type="hidden" name="pass" value="'.$staff_pass.'" />';
        echo '<input type="hidden" name="pass2" value="'.$staff_pass2.'" />';
        echo '<br />';
        echo '<input type="submit" value="送信する" />';
        echo '<input type="button" value="戻る" onclick="history.back()" />';
        echo '</form>';
    }
    ?>
</body>
</html>
