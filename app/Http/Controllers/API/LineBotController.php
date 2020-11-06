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

        //驗證 signature
        $signature = $request->headers->get(HTTPHeader::LINE_SIGNATURE);
        if (!SignatureValidator::validateSignature($request->getContent(), $lineChannelSecret, $signature)) {
            return;
        }

        try {
            //將request內容取出
            $events = $lineBot->parseEventRequest($request->getContent(), $signature);
            foreach ($events as $event) {
                $replyToken = $event->getReplyToken(); //返回的Token
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

// //接收到的 header
// {
//     "user-agent":["LineBotWebhook\/1.0"],
//     "accept":["*\/*"],
//     "content-type":["application\/json; charset=utf-8"],
//     "x-line-signature":["Q\/MAgholdGBSSDdMycs4eWCjcsRQ1RipY4k2C1AC\/\/E="],
//     "content-length":["305"],
//     "connection":["close"],
//     "host":["codinglab.rvt.idv.tw"],
//     "x-forwarded-port":["443"],
//     "x-forwarded-proto":["https"],
//     "x-real-ip":["124.155.171.242"],
//     "x-forwarded-by":["192.168.0.10"],
//     "x-correlation-id":["2baa6d40-24f2-467c-97fb-7b228ff1ad7f"]
// }


// //接收到的 request
// {
//     "events":[{
//         "type":"message",
//         "replyToken":"949d624908f840ba880716bc567edca9",
//         "source":{
//             "userId":"U11c6e8b9d679ff492c27d67357901b89",
//             "type":"user"
//         },
//         "timestamp":1604667396352,
//         "mode":"active",
//         "message":{
//             "type":"text",
//             "id":"12984614151808",
//             "text":"\u6e2c\u8a66"
//         }
//     }],
//     "destination":"Uc815befefc4f61b0a16451f087a019bf"
// }
