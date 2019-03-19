<?php
DEFINE("ACCESS_TOKEN","1rfZ2hLxAy1Pj0aS+SuznqGY9KtmsQYV6CmiOEypwZ4H5Uhw2SKCYzxj3bM51AJx0N6l9Id9qABRb+P/uH04ZwNQBEnUDAN0QV66LchjTKaCa+5xFFQLPzGfneBC00YHLZqw70OHri8+1Dj2HymCdQdB04t89/1O/w1cDnyilFU=");
DEFINE("SECRET_TOKEN","a419d853638ebb1b541d0647ed3658bc");

use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use \LINE\LINEBot\Constant\HTTPHeader;

//LINESDKの読み込み
require_once(__DIR__."/vendor/autoload.php");

//LINEから送られてきたらtrueになる
if(isset($_SERVER["HTTP_".HTTPHeader::LINE_SIGNATURE])){

//LINEBOTにPOSTで送られてきた生データの取得
  $inputData = file_get_contents("php://input");

//LINEBOTSDKの設定
  $httpClient = new CurlHTTPClient(ACCESS_TOKEN);
  $Bot = new LINEBot($HttpClient, ['channelSecret' => SECRET_TOKEN]);
  $signature = $_SERVER["HTTP_".HTTPHeader::LINE_SIGNATURE]; 
  $Events = $Bot->parseEventRequest($InputData, $Signature);

//大量にメッセージが送られると複数分のデータが同時に送られてくるため、foreachをしている。
　　　　foreach($Events as $event){
    $SendMessage = new MultiMessageBuilder();
    $TextMessageBuilder = new TextMessageBuilder("よろぽん！");
    $SendMessage->add($TextMessageBuilder);
    $Bot->replyMessage($event->getReplyToken(), $SendMessage);
  }
}
