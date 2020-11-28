<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Redirect;
use Carbon\Carbon;
use Session;
use AWS;

use App\Http\Requests\Admin\AdminSendSMSRequest;

class SMSController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display the SMS Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminSendSMSForm()
    {
        return view('admin.sms.adminsendSMSform');
    }
    /**
     * 透過 AWS SNS 傳送 SMS
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function awssms(AdminSendSMSRequest $request)
    {
        $phone = '886' . ltrim($request->phone, "0");       //去除掉左邊 0 並加上國碼
        $content = $request->content;                       //訊息內容
        try {
            $sms = AWS::createClient('sns');                //建立 AWS sns 類
            $sms->publish([
                'Message' => $content,                      //訊息內容
                'PhoneNumber' => $phone,                    //行動電話號碼 須符合 E.164 格式，ex: 886990123456
                'MessageAttributes' => [                    //訊息屬性
                    'AWS.SNS.SMS.SMSType'  => [             //訊息類型
                        'DataType'    => 'String',          //資料類型 字串
                        'StringValue' => 'Transactional',   //性質 Transactional (交易類) Promotional (行銷類)
                    ]
               ],
            ]);
        } catch (Exception $e) {
            $message = "簡訊傳送失敗";
            Session::put('error', $message);
        }

        $message = "簡訊已傳送給 $request->phone";
        Session::put('success', $message);

        return view('admin.sms.adminsendSMSform');
    }
}
