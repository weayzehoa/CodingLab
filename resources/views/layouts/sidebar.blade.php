<aside class="main-sidebar sidebar-dark-primary bg-navy elevation-4">
    <div class="sidebar">
        {{-- 驗證使用者是否登入 --}}
        @auth
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            嗨!!
            @if(Auth::user()->avatar)
            <div class="image">
                <a href="{{ route('users.showAvatar') }}" class="px-1">
                    <img src="{{ Auth::user()->getAvatarUrl() }}" style="width: 30px; height: 30px;" class="rounded-circle mt-1">
                </a>
            </div>
            <div class="info">
                <a href="{{ route('users.profile') }}" class="d-block">{{ Auth::user()->name ?? '' }}</a>
            </div>
            @else
            <div class="info">
                <i class="fas fa-user mr-2"></i>{{ Auth::user()->name ?? '' }}
            </div>
            @endif
        </div>
        @endauth
        <nav id="sidebar" class="mt-2 nav-compact">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">後端實驗室</li>
                <li class="nav-item has-treeview">
                    <a href="javascript:" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            台北市公園資訊
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('parks') }}" class="nav-link">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>站內資料處理</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('parks/cdb') }}" class="nav-link">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>跨資料庫讀取</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('parks/curl') }}" class="nav-link">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>Curl抓取</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">前端實驗室</li>
                <li class="nav-item">
                    <a href="{{ url('wowbgtest') }}" class="nav-link"><i class="nav-icon fas fa-tools"></i>WoW 背景動畫測試</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('clocktest') }}" class="nav-link"><i class="nav-icon fas fa-tools"></i>JS Clock 測試</a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="javascript:" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            地圖
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('openstreetmap') }}" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Open Street Map</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('googlemap') }}" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Google Map</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">整合測試</li>
                <li class="nav-item has-treeview">
                    <a href="javascript:" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            會員專區
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('posts') }}" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>會員文章</p>
                                <span class="right badge badge-info">{{ $posts_total ?? '' }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('shopping') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    shopping購物
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
