<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LINE\LINEBot;
use LINE\LINEBot\Constant\HTTPHeader;
use LINE\LINEBot\SignatureValidator;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Exception;

class LineBotController extends Controller
{
    public function hooks(Request $request)
    {
        $lineAccessToken = env('LINE_CHANNEL_ACCESS_TOKEN'); //前面申請到的Channel acess token(long-lived)
        $lineChannelSecret = env('LINE_CHANNEL_SECRET');//前面申請到的Channel secret
        $httpClient = new CurlHTTPClient ($lineAccessToken);
        $lineBot = new LINEBot($httpClient, ['channelSecret' => $lineChannelSecret]);

        $signature = $request->headers->get(HTTPHeader::LINE_SIGNATURE);
        if (!SignatureValidator::validateSignature($request->getContent(), $lineChannelSecret, $signature)) {
            return;
        }
        try {
            $events = $lineBot->parseEventRequest($request->getContent(), $signature);
            foreach ($events as $event) {
                $replyToken = $event->getReplyToken();
                $text = $event->getText();// 得到使用者輸入
                $lineBot->replyText($replyToken, $text);// 回復使用者輸入
                //$textMessage = new TextMessageBuilder("你好");
                //$lineBot->replyMessage($replyToken, $textMessage);
            }
        } catch (Exception $e) {
            return;
        }
        return;
    }
}
