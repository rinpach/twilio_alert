<?php

require_once("db_connect.php");
$username = 'phpaccess';
$password = 'qwerty';
$dbName = 'schedule_manager';
$mysqli = db_connect($username, $password, $dbName);
$sql = "select * from schedule";

$result = $mysqli -> query($sql);

if(!$result) {
  echo $mysqli -> error;
  exit();
}

$row_count = $result -> num_rows;
while($row = $result->fetch_array(MYSQLI_ASSOC)){
  $rows[] = $row;
}

$result->free();

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>テーブル表示</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="table.css">
  </head>
  <body>
    <p id="CurrentTimeClockArea"></p>
    <script type="text/javascript">
    function set2fig(num) {
        var ret;
        if(num < 10){
          ret = "0" + num;
        }else{
          ret = num;
        }
        return ret;
      }
      function showDate() {
        var nowDate = new Date();
        var nowYear = nowdate.getFullYear();
        alert(nowYear);
      }

      function showClock() {
        var nowTime = new Date();
        var nowHour = set2fig(nowTime.getHours() );
        var nowMin = set2fig(nowTime.getMinutes() );
        var nowSec = set2fig(nowTime.getSeconds() );
        var msg = "現在時刻 ： "+nowHour+":"+nowMin+":"+nowSec;
        document.getElementById("CurrentTimeClockArea").textContent = msg;
      }
      setInterval('showClock()', 100);
    </script>
    <a id="show" class="btn-add-border">追加</a>
    <br>

    <dialog id="AddDialog">
      <form  action="add.php" method="post">
        <input type="datetime-local" name="date"><br>
        <textarea name="value" cols="30" rows="3" id="value"></textarea><br>
        <button type="submit" name="addbutton" value="add">追加</button>

      </form>
      <button id="close">閉じる</button>
    </dialog>

    <script type="text/javascript">
      var dialog = document.getElementById('AddDialog');
      var btn_show = document.getElementById('show');
      var btn_close = document.getElementById('close');
      btn_show.addEventListener('click', function(){
        dialog.showModal();
      }, false);
      btn_close.addEventListener('click', function(){
        dialog.close();
      }, false);
    </script>
    <div>
    <table border='1' class="task" align="center">
      <tr><th>日付</th><th>内容</th></tr>
      <?php
      foreach ($rows as $row) {
       ?>
      <tr>
        <td><?php echo substr($row['date'], 0, 16) ?></td>
        <td><?php echo $row['value'] ?></td>
        <td>
          <form action="delete.php" method="POST" name = "delform<?php echo $row['id']?>">
            <input type="hidden" id="id_del" name="id" value="<?php echo $row['id'] ?>">
            <input type="submit" value="削除" class="btn-del-border">
          </form>
        </td>
       </tr>
       <?php
     }
     ?>
    </table>
    <!--
    <dialog id="DelDialog">
      <p>本当に削除しますか？</p>
      <form action="delete.php" method="post" name ="askdel">
        <input type="hidden" id="id_del" value="">
        <input type="submit" value="はい" class="btn-del-border">
      </form>
      <a id="no" class="btn-add-border">いいえ</a>
    </dialog>
    <script type="text/javascript">
    var deldialog = document.getElementById('DelDialog');
    var btn_show = document.getElementById('del');
    var btn_close = document.getElementById('no');
    const btn = document.querySelector('btn-del-border');
    const event = function(delformId){

    }
    btn_show.addEventListener('click', function(){
      document.getElementById("id_del").value = document.getElementById("id_table").value;
      deldialog.showModal();
    }, false);
    btn_close.addEventListener('click', function(){
      deldialog.close();
    }, false);
    </script>
  -->
  </div>
  </body>
</html>
