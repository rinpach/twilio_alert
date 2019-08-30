<?php
//データベースへの接続
require_once('db_connect.php');
$mysqli = db_connect('', '', 'schedule_manager');

//POSTで来なかった場合の
if(empty($_POST)){
  header('Location:'.'http://localhost:8080/table.php', true, 308);
  exit();
}
if(!isset($_POST['id']) || !is_numeric($_POST['id']) ){
  echo "IDエラー";
  exit();
}else{
  $stmt = $mysqli->prepare("delete from schedule where id=?");

  if($stmt){
    $stmt->bind_param('i', $id);
    $id = $_POST['id'];

    $stmt->execute();
    $stmt->close();
  }else {
    echo $mysqli->errno . $mysqli->error;
  }
}
$mysqli->close();
 ?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>削除しました</title>
  </head>
  <body>
    データを削除しました。<br>
    <a href='http://localhost:8080/table.php'>スケジュール一覧に戻る</a>
  </body>
</html>
