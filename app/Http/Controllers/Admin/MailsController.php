<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Redirect;
use File;
use Carbon\Carbon;
use Mail;
use Session;
use Notification;

use App\Http\Requests\Admin\AdminSendMailRequest;
use App\Http\Requests\Admin\AdminSendNoteRequest;
use App\Http\Requests\Admin\AdminSendQueuesRequest;
use App\Notifications\Admin\AdminSendNoteNotification as AdminSendNoteNotification;

use App\Mail\AdminSendMail;
use App\Jobs\AdminSendEmail;

class MailsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    /**
     * Display the Mail Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminSendMailForm()
    {
        return view('admin.mails.adminsendmailform');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendmail(AdminSendMailRequest $request)
    {
        // dd($request);
        try{
            Mail::to($request->email)
            // ->cc($moreUsers)
            // ->bcc($evenMoreUsers)
            ->send(new AdminSendMail($request));
        }
        catch(Exception $e){
            $message = "信件寄出失敗";
            Session::put('error',$message);
        }

        $message = "信件已寄出給 $request->email";
        Session::put('success',$message);

        return view('admin.mails.adminsendmailform');
    }

    /**
     * Notifications 測試
     */
    public function sendnote(AdminSendNoteRequest $request)
    {
        // dd($request);
        try{
            /**
             * 發送 notification 到一個沒有存在 database 中, 特定的接收方時,
             * 可以使用 Notification facade 的 method 來指定 channel
             * 這邊的route('mail')指的是通道
             */
            Notification::route('mail', $request->email)
                        ->notify(new AdminSendNoteNotification($request));
        }
        catch(Exception $e){
            $message = "信件寄出失敗";
            Session::put('error',$message);
        }

        $message = "通知已寄出給 $request->email";
        Session::put('success',$message);

        return view('admin.mails.adminsendmailform');
    }

    /**
     * Queues 測試
     */
    public function sendqueues(AdminSendQueuesRequest $request)
    {
        // dd($request);
        try{
            /**
             * 不能直接將 Closure 的 $request 塞進去
             */
            AdminSendEmail::dispatch($request->all()); //放入隊列
            // AdminSendEmail::dispatchNow($request->all()); //馬上執行
        }
        catch(Exception $e){
            $message = "信件寄出失敗";
            Session::put('error',$message);
        }

        $message = "信件已寄出給 $request->email";
        Session::put('success',$message);

        return view('admin.mails.adminsendmailform');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
