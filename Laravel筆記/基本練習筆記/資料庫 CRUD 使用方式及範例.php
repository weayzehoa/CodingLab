<?php
/*
    參考 https://laravel.com/docs/8.x/database
    Laravel Database CRUD 使用方式

    use App\User as UserEloquemt;
    使用 App 目錄下 User.php 內所有的 Class, 並將其定義為 UserEloquent 也可以叫做 UserDB.
*/
    $users = UserDB::where('name', '=', 'John')
            ->where(function ($query) {
                $query->where('votes', '>', 100)
                    ->orWhere('title', '=', 'Admin');
            })
            ->get();
/*
    未使用Eloquent直接指定資料表，使用DB原型方式操作範例，跨資料表或跨伺服器時使用.
    不需要宣告 use App\User as UserEloquemt;
*/
    $users = DB::connection('otherDB')->table('users')
           ->where('name', '=', 'John')
           ->where(function ($query) {
               $query->where('votes', '>', 100)
                     ->orWhere('title', '=', 'Admin');
           })
           ->get();
/*
    獲得資料後使用 foreach 取出
*/
    foreach ($users as $user) {
        echo $user->name;
    }


/*
    Retrieving Results
*/
    //Retrieving All Rows From A Table
    //取出資料表全部資料
    $users = DB::table('users')->get();
    $users = DB::all();

    //找出指定id的那一筆, findOrFail會回應404
    $user = UserDB::find($id);
    $user = UserDB::findOrFail($id);

    //Retrieving A Single Row / Column From A Table
    //取出第一筆資料
    $user = DB::table('users')->where('name', 'John')->first();

    //取出該筆特定欄位資料
    $email = DB::table('users')->where('name', 'John')->value('email');

    //找出特定id資料
    $user = DB::table('users')->find(3);

    //Retrieving A List Of Column Values
    //找出一整個欄位資料
    $titles = DB::table('roles')->pluck('title');
    foreach ($titles as $title) {
        echo $title;
    }

    //Retrieving A List Of Column Values
    //檢索列值列表
    $roles = DB::table('roles')->pluck('title', 'name');
    foreach ($roles as $name => $title) {
        echo $title;
    }


/*
    //Chunking Results
    //分塊結果，大量資料時使用
*/
    //基本用法
    DB::table('users')->orderBy('id')->chunk(100, function ($users) {
        foreach ($users as $user) {
            //
        }
    });
    //傳回fasle停止其他分塊處理
    DB::table('users')->orderBy('id')->chunk(100, function ($users) {
        // Process the records...
        return false;
    });
    //官方提示
    //如果在對結果進行分塊時更新數據庫記錄，則分塊結果可能會以意想不到的方式更改。
    //因此，在分塊時更新記錄時，最好總是使用chunkById方法。此方法將基於記錄的主鍵自動對結果進行分頁：
    //在更新或刪除分塊回調中的記錄時，對主鍵或外鍵的任何更改都可能影響分塊查詢。這可能導致記錄未包含在分塊結果中。
    DB::table('users')->where('active', false)
    ->chunkById(100, function ($users) {
        foreach ($users as $user) {
            DB::table('users')
                ->where('id', $user->id)
                ->update(['active' => true]);
        }
    });

/*
    Aggregates
*/
    //統計數量
    $users = DB::table('users')->count();
    //找出最大值
    $price = DB::table('orders')->max('price');

    //返回是否存在
    return DB::table('orders')->where('finalized', 1)->exists();
    return DB::table('orders')->where('finalized', 1)->doesntExist();

    //分頁
    $users = DB::table('users')->paginate(15);

/*
    Select
*/
    //Selects
    $users = DB::table('users')->select('name', 'email as user_email')->get();

    //Distinct
    $users = DB::table('users')->distinct()->get();

    //addSelect，額外增加欄位到 $users
    $query = DB::table('users')->select('name');
    $users = $query->addSelect('age')->get();

/*
    Raw Expressions
    使用原始表達方式，此方法必須非常小心使用，否則有可能造成SQL injection問題。
    沒必要時盡可能不要使用此方法。
*/
    $users = DB::table('users')
            ->select(DB::raw('count(*) as user_count, status'))
            ->where('status', '<>', 1)
            ->groupBy('status')
            ->get();

    //selectRaw
    $orders = DB::table('orders')
            ->selectRaw('price * ? as price_with_tax', [1.0825])
            ->get();

    //whereRaw / orWhereRaw
    $orders = DB::table('orders')
            ->whereRaw('price > IF(state = "TX", ?, 100)', [200])
            ->get();

    //havingRaw / orHavingRaw
    $orders = DB::table('orders')
            ->select('department', DB::raw('SUM(price) as total_sales'))
            ->groupBy('department')
            ->havingRaw('SUM(price) > ?', [2500])
            ->get();

    //orderByRaw
    $orders = DB::table('orders')
            ->orderByRaw('updated_at - created_at DESC')
            ->get();

    //groupByRaw
    $orders = DB::table('orders')
            ->select('city', 'state')
            ->groupByRaw('city, state')
            ->get();

/*
    Joins
    併表
*/
    //Inner Join Clause
    $users = DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();

    //Left Join / Right Join Clause
    $users = DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->get();
    $users = DB::table('users')
            ->rightJoin('posts', 'users.id', '=', 'posts.user_id')
            ->get();

    //Cross Join Clause
    $sizes = DB::table('sizes')
            ->crossJoin('colors')
            ->get();

    //Advanced Join Clauses
    DB::table('users')
            ->join('contacts', function ($join) {
                $join->on('users.id', '=', 'contacts.user_id')
                    ->where('contacts.user_id', '>', 5);
            })
            ->get();

    //Subquery Joins
    $latestPosts = DB::table('posts')
            ->select('user_id', DB::raw('MAX(created_at) as last_post_created_at'))
            ->where('is_published', true)
            ->groupBy('user_id');
    $users = DB::table('users')
            ->joinSub($latestPosts, 'latest_posts', function ($join) {
                $join->on('users.id', '=', 'latest_posts.user_id');
            })->get();

    //Unions
    $first = DB::table('users')
                ->whereNull('first_name');
    $users = DB::table('users')
                ->whereNull('last_name')
                ->union($first)
                ->get();

/*
    常用函式
*/
    //where orWhere 條件 若為 = 時可以省略為 where('欄位名稱','資料')
    //多條件時使用陣列方式 AND AND ...
    $users = UserDB::where('name', '=', 'Roger');
    $users = UserDB::orWhere('name', '=', 'Roger');
    $users = DB::table('users')->where([
                ['status', '=', '1'],
                ['subscribed', '<>', '1'],
            ])->get();

    //AND OR 混合使用方式
    $users = DB::table('users')
            ->where('votes', '>', 100)
            ->orWhere(function($query) {
                $query->where('name', 'Abigail')
                      ->where('votes', '>', 50);
            })
            ->get();

    //whereBetween / orWhereBetween
    //兩者之間
    $users = DB::table('users')
            ->whereBetween('votes', [1, 100])
            ->get();
    $users = DB::table('users')
            ->whereNotBetween('votes', [1, 100])
            ->get();

    //whereIn / whereNotIn / orWhereIn / orWhereNotIn
    //存在或不存在
    $users = DB::table('users')
            ->whereIn('id', [1, 2, 3])
            ->get();
    $users = DB::table('users')
            ->whereNotIn('id', [1, 2, 3])
            ->get();
    /*
    官方提示
    如果是很龐大的資料是屬於 integer 時，使用 whereIntegerInRaw/whereIntegerNotInRaw 方法
    可以大大降低記憶體使用.
    */

    //whereNull / whereNotNull / orWhereNull / orWhereNotNull
    //尋找存在或不存在
    $users = DB::table('users')
            ->whereNull('updated_at')
            ->get();
    $users = DB::table('users')
            ->whereNotNull('updated_at')
            ->get();

    //whereDate / whereMonth / whereDay / whereYear / whereTime
    //尋找日期與時間
    $users = DB::table('users')
            ->whereDate('created_at', '2016-12-31')
            ->get();
    $users = DB::table('users')
            ->whereMonth('created_at', '12')
            ->get();
    $users = DB::table('users')
            ->whereDay('created_at', '31')
            ->get();
    $users = DB::table('users')
            ->whereYear('created_at', '2016')
            ->get();
    $users = DB::table('users')
            ->whereTime('created_at', '=', '11:20:45')
            ->get();

    //whereColumn / orWhereColumn
    //比對兩個欄位資料
    $users = DB::table('users')
            ->whereColumn([
                ['first_name', '=', 'last_name'],
                ['updated_at', '>', 'created_at'],
            ])->get();

/*
    Parameter Grouping 範例
    select * from users where name = 'John' and (votes > 100 or title = 'Admin')
*/
    $users = DB::table('users')
           ->where('name', '=', 'John')
           ->where(function ($query) {
               $query->where('votes', '>', 100)
                     ->orWhere('title', '=', 'Admin');
           })
           ->get();

/*
    Where Exists Clauses 範例
    select * from users where exists ( select 1 from orders where orders.user_id = users.id)
*/
    $users = DB::table('users')
           ->whereExists(function ($query) {
               $query->select(DB::raw(1))
                     ->from('orders')
                     ->whereRaw('orders.user_id = users.id');
           })
           ->get();

/*
    Subquery Where Clauses
*/
    use App\Models\User;

    $users = User::where(function ($query) {
        $query->select('type')
            ->from('membership')
            ->whereColumn('user_id', 'users.id')
            ->orderByDesc('start_date')
            ->limit(1);
    }, 'Pro')->get();

/*
    JSON Where Clauses (JSON資料欄位查詢方法)
*/
    $users = DB::table('users')
            ->where('preferences->dining->meal', 'salad')
            ->get();
    //whereJsonContains to query JSON arrays (not supported on SQLite)
    $users = DB::table('users')
            ->whereJsonContains('options->languages', ['en', 'de'])
            ->get();
    //whereJsonLength
    //Json長度
    $users = DB::table('users')
            ->whereJsonLength('options->languages', '>', 1)
            ->get();

/*

*/
    //orderBy
    //排序
    $users = DB::table('users')
            ->orderBy('name', 'desc')
            ->orderBy('email', 'asc')
            ->get();

    //latest / oldest
    //找出 最新/最舊 以 created_at 欄位作為排序後取出第一筆
    $user = DB::table('users')
            ->latest()
            ->first();

    //inRandomOrder
    $randomUser = DB::table('users')
            ->inRandomOrder()
            ->first();

    //reorder
    //取出後重新排序
    $query = DB::table('users')->orderBy('name');
    $usersOrderedByEmail = $query->reorder('email', 'desc')->get();

    //groupBy / having
    //群組
    $users = DB::table('users')
            ->groupBy('account_id')
            ->having('account_id', '>', 100)
            ->get();

    //skip / take
    //忽略或取出筆數 如同 limit / offset
    $users = DB::table('users')->skip(10)->take(5)->get();
    $users = DB::table('users')->offset(10)->limit(5)->get();

/*
    Conditional Clauses when條件範例
*/
    $role = $request->input('role');
    $users = DB::table('users')
            ->when($role, function ($query, $role) {
                return $query->where('role_id', $role);
            })
            ->get();

    $sortBy = null;
    $users = DB::table('users')
            ->when($sortBy, function ($query, $sortBy) {
                return $query->orderBy($sortBy);
            }, function ($query) {
                return $query->orderBy('name');
            })
            ->get();

/*
    Inserts 新增
*/
    DB::table('users')->insert([
        ['email' => 'taylor@example.com', 'votes' => 0],
        ['email' => 'dayle@example.com', 'votes' => 0],
    ]);

    //insertOrIgnore
    //忽略重複資料
    DB::table('users')->insertOrIgnore([
        ['id' => 1, 'email' => 'taylor@example.com'],
        ['id' => 2, 'email' => 'dayle@example.com'],
    ]);
    //upsert
    DB::table('flights')->upsert([
        ['departure' => 'Oakland', 'destination' => 'San Diego', 'price' => 99],
        ['departure' => 'Chicago', 'destination' => 'New York', 'price' => 150]
    ], ['departure', 'destination'], ['price']);


    //Auto-Incrementing IDs
    //取得新增後的id
    $id = DB::table('users')->insertGetId(
        ['email' => 'john@example.com', 'votes' => 0]
    );

/*
    Updates 修改
*/
    //基本用法，資料須以陣列方式傳入 ['欄位名稱'=>'資料']，不可使用 ['click' => 'click' + 1]
    $affected = DB::table('users')
            ->where('id', 1)
            ->update(['votes' => 1]);

    //updateOrInsert
    //先以第一個為條件依據去找是否已有紀錄，進而改變第二個為Value的值，若無則建立一筆新的並將所有欄位值全部存入
    DB::table('users')
    ->updateOrInsert(
        ['email' => 'john@example.com', 'name' => 'John'],
        ['votes' => '2']
    );

    //Updating JSON Columns (MySQL 5.7+ , PostgreSQL 9.5+)
    $affected = DB::table('users')
            ->where('id', 1)
            ->update(['options->enabled' => true]);

    //Increment & Decrement
    //增加 / 減少
    // 官方提示 increment / decrement 方法 並不會在 Model 事件 events 出現
    DB::table('users')->increment('votes');
    DB::table('users')->increment('votes', 5);
    DB::table('users')->decrement('votes');
    DB::table('users')->decrement('votes', 5);
    DB::table('users')->increment('votes', 1, ['name' => 'John']);

/*
    Deletes
*/
    //條件刪除
    DB::table('users')->where('votes', '>', 100)->delete();
    //清除資料表
    DB::table('users')->truncate();


/*
    Pessimistic Locking 悲觀鎖定?
*/
    DB::table('users')->where('votes', '>', 100)->sharedLock()->get();
    DB::table('users')->where('votes', '>', 100)->lockForUpdate()->get();

/*
    Debugging 直接將資料倒出到畫面上
*/
    DB::table('users')->where('votes', '>', 100)->dd();
    DB::table('users')->where('votes', '>', 100)->dump();
