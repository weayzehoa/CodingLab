<?php
/*
    參考 https://laravel.com/docs/6.x/pagination
    Laravel Database Pagination 使用方式

    Note: 6.x 與 8.x 有一些差異, 6 使用 bootstrap 為基底, 8.x 使用 TailWind CSS 為基底.
    8.x doc 中有教如何變更回 bootstrap.

    use App\User as UserEloquemt;
    使用 App 目錄下 User.php 內所有的 Class, 並將其定義為 UserEloquent 也可以叫做 UserDB.
*/
    //基本用法
    $users = DB::table('users')->paginate(15);

    //只顯示 Next, Previous
    $users = DB::table('users')->simplePaginate(15);
?>

    <!-- 前端使用方法 -->
    <div class="container">
        @foreach ($users as $user)
            {{ $user->name }}
        @endforeach
    </div>
    {{ $users->links() }}

<?php
/*
    官方提示
    若使用 groupBy 方式，將無法使用分頁. 需要使用時必須手動建立分頁.
    Currently, pagination operations that use a groupBy statement
    cannot be executed efficiently by Laravel.
    If you need to use a groupBy with a paginated result set,
    it is recommended that you query the database and create a paginator manually.
*/
    //直接將資料表作分頁
    $users = App\Models\User::paginate(15);
    //條件搜尋後加上分頁
    $users = User::where('votes', '>', 100)->paginate(15);
    $users = User::where('votes', '>', 100)->simplePaginate(15);

    //自訂分頁URL
    Route::get('users', function () {
        $users = App\Models\User::paginate(15);
        $users->withPath('custom/url');
    });

    //附加參數
    //當有參數需求查詢資料時需要將參數一同放入分頁連結時使用
    //例如: http://example.com/custom/url?page=N&sort=
?>
    <!-- 前端分頁附加參數 -->
    {{ $users->appends(['sort' => 'votes'])->links() }}
    <!-- 前端分頁附加查詢字串 -->
    {{ $users->withQueryString()->links() }}
    <!-- 前端分頁附加參數並編碼 hash fragment -->
    {{ $users->fragment('foo')->links() }}
    <!-- 前端分頁控制格數 (每邊5個) -->
    {{ $users->onEachSide(5)->links() }}
<?php
/*
    直接輸出分頁為Json格式
*/
    Route::get('users', function () {
        return App\Models\User::paginate();
    });
?>
    //資料格式如下
    {
    "total": 50,
    "per_page": 15,
    "current_page": 1,
    "last_page": 4,
    "first_page_url": "http://laravel.app?page=1",
    "last_page_url": "http://laravel.app?page=4",
    "next_page_url": "http://laravel.app?page=2",
    "prev_page_url": null,
    "path": "http://laravel.app",
    "from": 1,
    "to": 15,
    "data":[
            {
                // Result Object
            },
            {
                // Result Object
            }
        ]
    }
<?php

/*
    手動建立分頁
    原始位置 Illuminate\Pagination\Paginator or Illuminate\Pagination\LengthAwarePaginator
    Paginator 對應 simplePaginate method
    LengthAwarePaginator 對應 paginate method.
*/
    //分頁器實例方法
    //Method                                Description
    $paginator->count();                    //Get the number of items for the current page.
    $paginator->currentPage();              //Get the current page number.
    $paginator->firstItem();                //Get the result number of the first item in the results.
    $paginator->getOptions();               //Get the paginator options.
    $paginator->getUrlRange($start, $end);  //Create a range of pagination URLs.
    $paginator->hasPages();                 //Determine if there are enough items to split into multiple pages.
    $paginator->hasMorePages();             //Determine if there is more items in the data store.
    $paginator->items();                    //Get the items for the current page.
    $paginator->lastItem();                 //Get the result number of the last item in the results.
    $paginator->lastPage();                 //Get the page number of the last available page. (Not available when using simplePaginate).
    $paginator->nextPageUrl();              //Get the URL for the next page.
    $paginator->onFirstPage();              //Determine if the paginator is on the first page.
    $paginator->perPage();                  //The number of items to be shown per page.
    $paginator->previousPageUrl();          //Get the URL for the previous page.
    $paginator->total();                    //Determine the total number of matching items in the data store. (Not available when using simplePaginate).
    $paginator->url($page);                 //Get the URL for a given page number.
    $paginator->getPageName();              //Get the query string variable used to store the page.
    $paginator->setPageName($name);         //Set the query string variable used to store the page.
