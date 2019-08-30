<?php
require_once './vendor/autoload.php';
use Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();
$response->say($_GET['value'], ['voice' => 'alice', 'language' => 'ja-JP']);
echo $response;
