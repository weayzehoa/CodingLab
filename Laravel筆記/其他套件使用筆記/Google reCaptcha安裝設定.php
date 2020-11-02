<?php
/*
    Google reCaptcha 表單驗證功能


    使用 https://github.com/ARCANEDEV/noCAPTCHA 套件
    1. 安裝
        參考版本對照表安裝正確版本，目前我採用 Laravel 6.x LTS 所以是 10.x 版
        composer require arcanedev/no-captcha "10.x"

    2. 至 Google reCaptcha 取得 site key 及 secret key
        https://www.google.com/recaptcha/admin/

    3. 設定 .env，加入下方兩行
        NOCAPTCHA_SITEKEY = your site key
        NOCAPTCHA_SECRET = your secret key

    4. 修改 config/app.php，在 providers 段落加入，Lavravel 版本大於等於 5.5 可以跳過。

        'providers' => [
            //Google reCaptcha 套件(Arcanedev\No-Captcha)
            Arcanedev\NoCaptcha\NoCaptchaServiceProvider::class,
        ],

    5. 執行 vendor:publish 產生 no-captcha.php 設定檔，並編輯該檔案設定 site key 與 site secret 及 版本
        php artisan vendor:publish --provider="Arcanedev\NoCaptcha\NoCaptchaServiceProvider"

        //採用 .env 設定，不需要修改
        'secret'  => env('NOCAPTCHA_SECRET', 'no-captcha-secret'),
        'sitekey' => env('NOCAPTCHA_SITEKEY', 'no-captcha-sitekey'),

        //預設 V3 (無勾選框) 改為 V2 (有勾選框)
        'version' => 'v2',

    6. 使用
        a. 前端 blade 檔案
            1. 載入套件的 Script
                {!! no_captcha()->script() !!}
            2. 載入套件的 表單
                {!! no_captcha()->display() !!}
        b. 後端 controller 應用
*/
        use Arcanedev\NoCaptcha\Rules\CaptchaRule;

        $inputs   = Input::all();
        $rules    = [
            // Other validation rules...
            'g-recaptcha-response' => ['required', new CaptchaRule],
        ];
        $messages = [
            'g-recaptcha-response.required' => 'Your custom validation message.',
            'g-recaptcha-response.captcha'  => 'Your custom validation message.',
        ];

        $validator = Validator::make($inputs, $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->messages();

            var_dump($errors->first('g-recaptcha-response'));

            // Redirect back or throw an error
        }
/*
    7. 修改 語言對應
        // resources/lang/en/validation.php
        return [
            // 驗證失敗時的訊息
            'captcha'   => "If you read this message, then you're a robot.",
        ];
        //放在 custom 若使用者未勾選顯示的訊息
        'custom' => [
            'g-recaptcha-response' => [
                'required' => 'Your custom validation message for captchas.',
            ],
        ],

    8. 登入表單應用範例
*/
    //登入
    public function login(Request $request)
    {
        // 驗證表單資料
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:4',
            'g-recaptcha-response' => ['required', new CaptchaRule],
        ]);

        // 將表單資料送去Auth::gurard('admin')驗證
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            //驗證無誤轉入 admin.dashboard
            return redirect()->intended(route('admin.dashboard'));
        }

        // 驗證失敗 返回並拋出表單內容 只拋出 email 與 remember 欄位資料,
        // withErrors(['email' => trans('auth.failed')])用來覆蓋掉email欄位的錯誤訊息
        // trans('auth.failed) 系統預設語言拋出
        // 訊息 [使用者名稱或密碼錯誤] 為了不讓別人知道到底帳號是否存在
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['email' => trans('auth.failed')]);
    }
