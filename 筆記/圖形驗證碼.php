<?php
/*
    Laravel – 圖形驗證碼安裝設定及使用

    除了 Google reCaptcha 表單驗證功能外，最常見的就是圖形驗證碼，
    為了讓前台與後台都有各自的圖形驗證器，避免後台管理者在測試操作前台表單時，
    重置驗證碼圖形時互相干擾(通常前台使用者不會去操作後台不會有這個困擾)，
    使用了兩個圖形驗證碼套件，並使用不同的方式來做驗證動作。
    我使用的兩個 Laravel 圖形驗證碼套件用在前台與後台登入，
    mews/captcha 與 gregwar/captcha，當然也可以用在其他的表單中。

    使用 https://github.com/mewebstudio/captcha 套件
    1. 安裝
        composer require mews/captcha

    2. 安裝完成後，產生設定檔，會在 config 目錄下生成一個 captcha.php 檔案。
        php artisan vendor:publish

        return [
            //使用的字元
            'characters' => ['2', '3', '4', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'j', 'm', 'n', 'p', 'q', 'r', 't', 'u', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'M', 'N', 'P', 'Q', 'R', 'T', 'U', 'X', 'Y', 'Z'],
            'default' => [
                'length' => 9,
                'width' => 120,
                'height' => 36,
                'quality' => 90,
                'math' => false,
                'expire' => 60,
                'encrypt' => false,
            ],
            'math' => [
                'length' => 9,
                'width' => 120,
                'height' => 36,
                'quality' => 90,
                'math' => true,
            ],

            'flat' => [
                'length' => 6,
                'width' => 120,
                'height' => 36,
                'quality' => 90,
                'lines' => 6,
                'bgImage' => false,
                'bgColor' => '#ecf2f4',
                'fontColors' => ['#2c3e50', '#c0392b', '#16a085', '#c0392b', '#8e44ad', '#303f9f', '#f57c00', '#795548'],
                'contrast' => -5,
            ],
            'mini' => [
                'length' => 3,
                'width' => 60,
                'height' => 32,
            ],
            'inverse' => [
                'length' => 5,
                'width' => 120,
                'height' => 36,
                'quality' => 90,
                'sensitive' => true,
                'angle' => 12,
                'sharpen' => 10,
                'blur' => 2,
                'invert' => true,
                'contrast' => -5,
            ]
        ];

    3. 設定
        編輯 config\app.php 加入 Providers 與 Aliases

        'providers' => [
            //Mews\Captcha 圖形驗證
            Mews\Captcha\CaptchaServiceProvider::class,
        ]

        'aliases' => [
            //Mews\Captcha 圖形驗證
            'Captcha' => Mews\Captcha\Facades\Captcha::class,
        ]

    4. 使用
        前台 login.blade.php 驗證碼片段

        <div class="form-group row">
            <label for="captchacode" class="col-md-4 col-form-label text-md-right">驗證碼</label>
            <div class="col-md-6">
                <input id="captchacode" type="text" class="{{ $errors->has('captchacode') ? ' is-invalid' : '' }}" name="captchacode" required >
                <img src="{{ captcha_src() }}" alt="點擊刷新" onclick="this.src='{{ url('captcha/default') }}?s='+Math.random()"><br>
                @if ($errors->has('captchacode'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('captchacode') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        後台 Auth\LoginController.php，非常簡單，使用 Laravel 的驗證功能，只要在裡面加入
        要驗證的欄位名稱與規則 ‘captchacode’ => ‘required|captcha’, 即可。

        // 驗證表單資料
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:4',
            'captchacode' => 'required|captcha',
            'g-recaptcha-response' => ['required', new CaptchaRule],
        ]);

    5. 修改 resource\lang\en\validation.php 語言檔案，一樣也可以修改其他語言。

        //驗證錯誤時的訊息
        'captcha'   => "Captcha Incorrect.",

        //自定義訊息
        'custom' => [
            //Google reCaptcha 訊息
            'g-recaptcha-response' => [
                'required' => 'Checked it.',
            ],
            //captcha 欄位額外訊息
            'captcha' => [
                'required' => 'Input the Captcha.',
            ],
        ],

    使用 https://github.com/Gregwar/Captcha 套件
    1. 安裝
        composer require gregwar/captcha "1.*"

    2. 這個套件並沒有任何設定檔案須要做，只需要用它的function產生出驗證碼圖片並把驗證碼放入session的方式。
        後台管理 admin/login.blade.php 片段

        <div class="form-group mb-3 row">
            <input type="text" id="captchacode" name="captchacode" placeholder="Captcha" class="form-control col-6 {{ $errors->has('captchacode') ? ' is-invalid' : '' }}" required >　
            <img class="col-5" src="/admin/captcha" alt="點擊刷新" onclick="this.src='/admin/captcha?captchacode='+Math.random()">
            @if ($errors->has('captchacode'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('captchacode') }}</strong>
                </span>
            @endif
        </div>

    3. 編輯 routes\web.php 建立刷新圖片的路由，這邊我將它綁定在 admin 群組裡面，避免與另一個套件互相衝突刷錯驗證碼。

        //後台admin用的路由 網址看起來就像 https://localhost/{admin}/{名稱}
        Route::prefix('admin')->group(function() {
            Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
            Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
            Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
            Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin');
            Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
            //刷新驗證碼
            Route::get('/captcha', 'Auth\AdminLoginController@captcha')->name('admin.captcha');
        }) ;

    4. 控制器
        Auth\AdminLoginController.php 片段

        別忘記使用這些類
        use Response;
        use Session;
        use Gregwar\Captcha\CaptchaBuilder;
        use Gregwar\Captcha\PhraseBuilder; //自訂使用的英文字或數字
*/
    //重新產生驗證碼
    public function captcha(Request $request){
        // // 預設產生5個隨機英文與數字
        // $builder = new CaptchaBuilder;

        //只產生5個數字
        $phraseBuilder = new PhraseBuilder(5, '0123456789');
        $builder = new CaptchaBuilder(null, $phraseBuilder);

        //寬度及高度參數
        $builder->build(120,36);

        // //把驗證碼内容存入Session中
        $phrase = $builder->getPhrase();
        $request->session()->flash('captchaSession', $phrase);

        //清除缓存
        ob_clean();
        //產生出驗證碼圖片以jpeg格式輸出
        return response($builder->output())->header('Content-type','image/jpeg');
    }

    //登入
    public function login(Request $request)
    {
        //獲得驗證碼
        $captchaSession = $request->session()->get('captchaSession');
        $captchacode = $request->input("captchacode");

        //比對驗證碼與輸入的驗證碼不同就返回並將錯誤訊息拋出
        if($captchaSession != $captchacode){
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['captchacode' => '驗證碼錯誤']);
        }
        //比對通過則清除Session裡面的資料
        Session::forget('captchaSession');

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
