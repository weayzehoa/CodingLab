<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LineBotController extends Controller
{
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
    public function hooks(Request $request)
    {

        return response('hello world', 200);

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
