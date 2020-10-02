<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary bg-navy elevation-4">
    <!-- Brand Logo -->
    <a href=" {{ route('admin.dashboard') }} " class="brand-link bg-navy text-center">
        {{-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light  text-yellow">CodingLab 後台管理系統</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="javascript:" class="d-block">{{ $adminuser->name ?? '' }}</a>
                <a href="javascript:" class="d-block">{{ Auth::user()->email ?? '' }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav id="sidebar" class="mt-2 nav-compact">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat" data-widget="treeview"
                role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="javascript:" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            首頁管理
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/news') }}" class="nav-link">
                                <i class="nav-icon far fa-newspaper"></i>
                                <p>
                                    最新消息
                                    <span class="right badge badge-danger">10</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/marquees') }}" class="nav-link">
                                <i class="nav-icon fas fa-equals"></i>
                                <p>
                                    跑馬燈
                                    <span class="right badge badge-primary">7</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/carousels') }}" class="nav-link">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    輪播管理
                                    <span class="right badge badge-info">5</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-header">選單及內容管理</li> --}}
                {{-- <li class="nav-item has-treeview menu-open">
                    <a href="javascript:" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            選單及內容管理
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="javascript:" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Level 1</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="javascript:" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Level 1
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="javascript:" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Level 2</p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="javascript:" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Level 2
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="javascript:" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Level 3</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Level 3</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Level 3</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Level 2</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Level 1</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-header">會員管理專區</li>
                <li class="nav-item has-treeview menu-open">
                    <a href="javascript:" class="nav-link active">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            會員專區
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/members') }}" class="nav-link active">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p>會員管理</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/mbposts') }}" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>會員文章</p>
                                <span class="right badge badge-info">{{ $posts_total ?? '' }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">系統管理專區</li>
                <li class="nav-item has-treeview menu-open">
                    <a href="javascript:" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            系統管理
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/admins') }}" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <p>管理員管理</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/mails') }}" class="nav-link ">
                                <i class="nav-icon far fa-envelope"></i>
                                <p>信件管理</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/logs') }}" class="nav-link ">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>維護紀錄</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">統計圖表專區</li>
                <li class="nav-item has-treeview">
                    <a href="javascript:" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            統計圖表
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="javascript:" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>統計表</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>統計圖</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="javascript:" class="nav-link">
                                <i class="fas fa-chart-line nav-icon"></i>
                                <p>
                                    瀏覽統計
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="javascript:" class="nav-link">
                                        <i class="nav-icon fas fa-table"></i>
                                        <p>統計表</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:" class="nav-link">
                                        <i class="nav-icon fas fa-chart-bar"></i>
                                        <p>統計圖</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">開發者專區</li>
                <li class="nav-item">
                    <a href="{{ url('admin/aboutme') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            關於我
                            <span class="right badge badge-danger"><i class="fas fa-thumbs-up"></i></span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://codinglab.rvt.idv.tw" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            我的筆記
                            <span class="right badge badge-danger"><i class="fas fa-thumbs-up"></i></span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    {{-- <a href="{{ url('AdminLTE/index1') }}" class="nav-link" target="_blank"> --}}
                    <a href="https://temp.rvt.idv.tw/AdminLTE-3.0.5/" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            AdminLTE 樣板
                            <span class="right badge badge-info">Info</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="javascript:" class="nav-link ">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            線上參考文件
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">3</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="https://laravel.com/docs" class="nav-link" target="_blank">
                                <i class="nav-icon fab fa-laravel text-info"></i>
                                <p>Laravel</p>
                            </a>
                        </li>
                        <li class="nav-item treeview">
                            <a href="https://fontawesome.com/icons?d=gallery&m=free" class="nav-link" target="_blank">
                                <i class="nav-icon fas fa-icons text-info"></i>
                                <p>Font Awesome 5</p>
                            </a>
                        </li>
                        <li class="nav-item treeview">
                            <a href="https://adminlte.io/docs/3.0" class="nav-link" target="_blank">
                                <i class="nav-icon fas fa-book text-info"></i>
                                <p>AdminLTE 3</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-door-open text-danger"></i>
                        <p>登出 (Logout)</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
