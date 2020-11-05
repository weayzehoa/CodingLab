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

        $signature = $request->headers->get(HTTPHeader::LINE_SIGNATURE);
        if (!SignatureValidator::validateSignature($request->getContent(), $lineChannelSecret, $signature)) {
           
            return;
        }

        $httpClient = new CurlHTTPClient ($lineAccessToken);
        $lineBot = new LINEBot($httpClient, ['channelSecret' => $lineChannelSecret]);

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
        // return response('hello world', 200);

        // $params = $request->all();
        // logger(json_encode($params, JSON_UNESCAPED_UNICODE));

        //Line webhooks request header
        // {
        //     "host":["051cdc2a6952.ngrok.io"],
        //     "user-agent":["LineBotWebhook\/2.0"],
        //     "content-length":["63"],
        //     "content-type":["application\/json; charset=utf-8"],
        //     "x-forwarded-for":["147.92.150.196"],
        //     "x-forwarded-proto":["https"],
        //     "x-line-signature":["xW7YXtt\/7fETAg9V4AXW8ZhMQ98wv\/W5Dv9P3KVgvfM="],
        //     "accept-encoding":["gzip"],
        //     "x-correlation-id":["79dee741-7ae9-4419-943f-f517c19aa2cc"]
        // }

        //Line webhooks request request_params
        // {
        //     "events":[],
        //     "destination":"Uc815befefc4f61b0a16451f087a019bf"
        // }
    }
}
