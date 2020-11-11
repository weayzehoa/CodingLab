<nav id="topbar" class="main-header navbar navbar-expand navbar-dark bg-navy">
    <div class="container">
        <a href="{{ route('index') }}" class="navbar-brand">
            <span class="brand-text font-weight-light">CodingLab</span>
        </a>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" title="側邊選單" class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item"><a href="{{ url('aboutme') }}" class="nav-link">關於我</a></li>
                <li class="nav-item"><a href="https://roger.rvt.idv.tw" class="nav-link" target="_blank">我的筆記</a></li>
                <li class="nav-item dropdown">
                    <a id="devSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">參考資料</a>
                    <ul aria-labelledby="devSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="https://developer.mozilla.org/zh-TW/docs/Web/HTTP/Status" class="dropdown-item" target="_blank">HTTP 狀態碼</a></li>
                        <li><a href="https://template.rvt.idv.tw/AdminLTE-3.0.5/" class="dropdown-item" target="_blank">AdminLTE參考樣板</a></li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="devSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">線上參考文件</a>
                            <ul aria-labelledby="devSubMenu2" class="dropdown-menu border-0 shadow">
                                <li>
                                    <a tabindex="-3" href="https://laravel.com/docs" class="dropdown-item" target="_blank">Laravel Document</a>
                                </li>
                                <li>
                                    <a tabindex="-2" href="https://fontawesome.com/icons?d=gallery&m=free" class="dropdown-item" target="_blank">Font Awesome 5</a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="https://adminlte.io/docs/3.0" class="dropdown-item" target="_blank">AdminLTE 3 Document</a>
                                </li>
                                {{-- <li class="dropdown-submenu">
                                <a id="devSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" class="dropdown-item dropdown-toggle">第三層保留</a>
                                <ul aria-labelledby="devSubMenu3" class="dropdown-menu border-0 shadow">
                                    <li><a href="#" class="dropdown-item">3rd level</a></li>
                                    <li><a href="#" class="dropdown-item">3rd level</a></li>
                                </ul>
                            </li> --}}
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a id="frontLabMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">前端實驗</a>
                    <ul aria-labelledby="frontLabMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="{{ url('wowbgtest') }}" class="dropdown-item">WoW 背景動畫測試</a></li>
                        <li><a href="{{ url('clocktest') }}" class="dropdown-item">JS Clock 測試</a></li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="frontLabMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">地圖</a>
                            <ul aria-labelledby="frontLabMenu2" class="dropdown-menu border-0 shadow">
                                <li>
                                    <a tabindex="-3" href="{{ url('openstreetmap') }}" class="dropdown-item">Open Street Map</a>
                                </li>
                                <li>
                                    <a tabindex="-2" href="{{ url('googlemap') }}" class="dropdown-item">Google Map</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a id="backLabMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">後端實驗</a>
                    <ul aria-labelledby="backLabMenu1" class="dropdown-menu border-0 shadow">
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="backLabMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">台北市公園資料</a>
                            <ul aria-labelledby="backLabMenu2" class="dropdown-menu border-0 shadow">
                                <li>
                                    <a tabindex="-3" href="{{ url('parks') }}" class="dropdown-item">站內資料處理</a>
                                </li>
                                <li>
                                    <a tabindex="-3" href="{{ url('parks/cdb') }}" class="dropdown-item">跨資料庫讀取</a>
                                </li>
                                <li>
                                    <a tabindex="-3" href="{{ url('parks/curl') }}" class="dropdown-item">Curl抓取</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a id="allLabMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">整合測試</a>
                    <ul aria-labelledby="allLabMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="{{ url('posts') }}" class="dropdown-item">會員文章</a></li>
                        <li><a href="{{ url('shopping') }}" class="dropdown-item">shopping購物</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">後台管理</a></li>
            </ul>
        </div>
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            {{-- 驗證使用是否登入 在使用者未登入前 只會看到登入兩個字 登入後就會切換到 另一個下拉表單 --}}
            @auth
            <li class="nav-item dropdown">
                <a id="userSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                    @if(Auth::user()->avatar)
                    <img src="{{ Auth::user()->getAvatarUrl() }}" style="width: 30px; height: 30px;" class="rounded-circle">
                    @else
                    <i class="fas fa-user"></i>
                    @endif
                    {{ Auth::user()->name }}
                </a>
                <ul aria-labelledby="userSubMenu1" class="dropdown-menu border-0 shadow">
                    <li>
                        <a href="{{ route('users.profile') }}" class="dropdown-item">個人資料</a>
                    </li>
                    <li>
                        <a href="{{ route('users.showAvatar') }}" class="dropdown-item">修改頭像</a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a href="{{ route('cart.index') }}" class="dropdown-item">購物車</a>
                    </li>
                    <li>
                        <a href="{{ route('order.index') }}" class="dropdown-item">我的訂單</a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        {{-- 登出按鈕 下方表單被CSS隱藏, 當按下按鈕後 利用onclick將表單送出到 路由 logout 執行 --}}
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); $('#logout-form').submit();"><i class="nav-icon fas fa-door-open text-danger"></i> 登出</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            @else
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link">登入</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link">註冊</a>
            </li>
            @endauth
            <li class="nav-item">
                <a class="nav-link" href="{{ url('cart') }}">
                    <i class="fas fa-shopping-cart mr-1"></i>
                    <span class="badge badge-danger navbar-badge">{{ $carts_total ?? '' }}</span>
                  </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>
            </li> --}}
            <li class="nav-item">
                <a href="javascript:" id="fullscreen-button" title="擴展成全螢幕" class="nav-link" data-widget="fullscreen" data-slide="true" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>

{{-- Control Sidebar  --}}
{{-- <aside class="control-sidebar control-sidebar-dark"></aside> --}}
