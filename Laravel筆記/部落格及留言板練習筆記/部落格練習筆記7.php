<?php
/*
    9. 錯誤訊息製作與在地語言化
    當使用者按下儲存或送出資料從表單中傳入時，需要做檢驗，檢驗後必須告訴使用者哪邊錯誤，
    不然使用者不知道資料是否有正確傳入，當資料傳入控制之前，有一個FormRequest，它會驗證
    傳入的資料，當驗證失敗時，Laravel會創建一個$error的變數給視圖.

    例如 view\posts\create.blade.php 的 form 表單
*/
?>
<form action="{{ route('posts.store') }}" method="POST" class="mt-2">
    @csrf
    <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label-sm text-md-right">標題</label>
        <div class="col-sm-8">
            <!--
                class="form-control form-control-sm {{ $errors->has('title') ? ' is-invalid' : '' }}"
                這裡加上了 {{ $errors->has('title') ? ' is-invalid' : '' }} 程式碼片段
                意思是 title 欄位資料驗證失敗則拋出 is-invalid 這個 class 給視圖，透過 Bootstrap 4的樣式
                呈現出紅框來提醒使用者
            -->
            <input type="text" class="form-control form-control-sm {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="title">
            <!--
                在下面這段則使用文字來提醒使用者該筆資料驗證失敗，has()代表在 $error 中若有 title 欄位訊息
                則顯示該提醒文字，first()則代表，若有多個錯誤訊息時，例如:字數超過限制、不為整數...等等.
                不會將所有訊息都列出來，只會顯示第一個錯誤訊息.
             -->
            @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="type" class="col-sm-2 col-form-label-sm text-md-right">分類</label>
        <div class="col-sm-8">
            <select name="type" id="type" class="form-control form-control-sm {{ $errors->has('type') ? ' is-invalid' : '' }}">
                <option value="0">請選擇...</option>
                @foreach($post_types as $post_type)
                    <option value="{{ $post_type->id }}">
                        {{ $post_type->name }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('type'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('type') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="content" class="col-sm-2 col-form-label-sm text-md-right">內文</label>
        <div class="col-sm-8">
            <textarea name="content" id="content" rows="15" class="form-control form-control-sm {{ $errors->has('content') ? ' is-invalid' : '' }}" style="resize: vertical;"></textarea>
            @if ($errors->has('content'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10 offset-sm-2">
            <button class="btn btn-md btn-primary">儲存</button>
        </div>
    </div>
</form>
<?
/*
    由於 Laravel 內建錯誤訊息皆是顯示英文，若我們想要顯示中文則必須要先設定網頁要使用的語系 zh-tw
    先到 config\app.php 中 將 'locale' => 'en', 改成 'locale' => 'zh-tw',
    然後到 resource\lang 目錄下建立 zh-tw 資料夾, 將 en 目錄下的所有檔案複製到 zh-tw 目錄下
    然後開啟 validation.php 檔案，裡面就是所謂的錯誤訊息列表，將其相對應的錯誤訊息改成中文即可.
    例如:
        'exists' => ':attribute 欄位所選擇的值是無效的。',
        'required' => '必須填寫 :attribute 欄位哦!',
    這樣一來錯誤訊息就會變成中文。

    可是會發現欄位名稱依舊是英文，這些欄位名稱都是來自當初對這些input或select等上面的name屬性而來的
    標題 = title 分類 = type 內文 = content，而中文化這些欄位也很簡單，只要修改 validation.php
    客製化中相對應的欄位資料即可.
    例如:
        'attributes' => [
            'title' => '標題',
            'type' => '類型',
            'content' => '內文',
        ],
*/
