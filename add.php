<?php
//データベースへの接続
require_once('db_connect.php');
$mysqli = db_connect('', '', 'schedule_manager');

//POSTで来なかった場合にリダイレクトさせる。
if(empty($_POST)){
  header('Location:'.'http://localhost:8080/table.php', true, 308);
  exit();
}

//データの取得
$date = $_POST['date'];
$value = $_POST['value'];

//フォーマットの変更
$datekai = str_replace('T', ' ', $date);

$sql = "insert into schedule values (0,'$datekai:00', '$value')";
$res = mysqli_query($mysqli, $sql);
mysqli_close($mysqli);
 ?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>追加しました</title>
  </head>
  <body>
    追加しました。<br>
    <a href="http://localhost:8080/table.php">一覧に戻る</a>
  </body>
</html>
