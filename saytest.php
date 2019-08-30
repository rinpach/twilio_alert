<?php
require_once(dirname(__FILE__)."/db_connect.php");
require_once(dirname(__FILE__)."./vendor/autoload.php");
use Twilio\rest\Client;

$mysqli = db_connect('', '', 'schedule_manager');
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

foreach($rows as $row){
	$row['date'] = substr($row['date'],0,16);
	date_default_timezone_set('Asia/Tokyo');
	$nowtime = date("Y-m-d H:i");
	echo $nowtime;
	if($row['date']===$nowtime){
		echo "かかりました";
		$script = urlencode($row['value']);
		$account_sid = '/*禁則事項です*/';
		$auth_token = '/*禁則事項です*/';

		$twilio_number = "/*禁則事項です*/";

		$to_number = "/*禁則事項です*/";

		$client = new Client($account_sid, $auth_token);
		$client->account->calls->create(
			$to_number,
			$twilio_number,
			array("url" => "https://94395a95.ngrok.io/say.php?value={$script}")
		);
	}
}
