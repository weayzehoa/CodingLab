<!-- 選單樣板 -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top navbar-shadow">
	<div class="container">
        <!-- 路由 index 到首頁 -->
	    <a href="{{ route('index') }}" class="navbar-brand">CodingLab</a>
        <!-- 路由 search 搜尋表單 -->
	    <form action="{{ route('search') }}" method="GET" class="form-inline" role="search">
	        <input type="search" class="form-control form-control-sm mr-sm-2" name="keyword" placeholder="搜尋文章" aria-label="Search">
	        <button type="submit" class="btn btn-sm btn-outline-info my-2 my-sm-0">
	            <i class="fas fa-search"></i>
	            搜尋
	        </button>
        </form>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <!-- 驗證使用是否登入 在使用者未登入前 只會看到登入兩個字 登入後就會切換到 另一個下拉表單 -->
                @auth
                    {{-- <li class="nav-item">
                        <a href="{{ route('users.showAvatar') }}" class="px-1">
                            <img src="{{ Auth::user()->getAvatarUrl() }}" style="width: 30px; height: 30px;" class="rounded-circle mt-1">
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- 登出按鈕 下方表單被CSS隱藏, 當按下按鈕後 利用onclick將表單送出到 路由 logout 執行 -->
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); $('#logout-form').submit();">登出</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">登入</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
