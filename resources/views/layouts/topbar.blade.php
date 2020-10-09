<nav id="topbar" class="main-header navbar navbar-expand navbar-dark bg-navy">
    <div class="container">
        <a href="{{ route('index') }}" class="navbar-brand">
            {{-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
            <span class="brand-text font-weight-light">CodingLab</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" title="縮小側邊選單" class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
                </li>
                {{-- <li class="nav-item dropdown">
                <a id="homeSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    class="nav-link dropdown-toggle">首頁管理</a>
                <ul aria-labelledby="homeSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="{{ url('admin/news') }}" class="dropdown-item">最新消息管理</a></li>
                <li><a href="{{ url('admin/marquees') }}" class="dropdown-item">跑馬燈管理</a></li>
                <li><a href="{{ url('admin/carousels') }}" class="dropdown-item">輪播管理</a></li>
            </ul>
            </li> --}}
            {{-- 選單及內容管理 --}}
            {{-- <li class="nav-item dropdown">
                <a id="menuSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    class="nav-link dropdown-toggle">選單及內容管理</a>
                <ul aria-labelledby="menuSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="#" class="dropdown-item">Level 1-1</a></li>
                    <li><a href="#" class="dropdown-item">Level 1-2</a></li>
                    <li class="dropdown-divider"></li>
                    <!-- Level two dropdown-->
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="menuSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="dropdown-item dropdown-toggle">Level 2</a>
                        <ul aria-labelledby="menuSubMenu2" class="dropdown-menu border-0 shadow">
                            <li>
                                <a href="#" class="dropdown-item" target="_blank">Level 2-1</a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item" target="_blank">Level 2-2</a>
                            </li>
                            <!-- Level three dropdown-->
                            <li class="dropdown-submenu">
                                <a id="menuSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" class="dropdown-item dropdown-toggle">Level 3</a>
                                <ul aria-labelledby="menuSubMenu3" class="dropdown-menu border-0 shadow">
                                    <li><a href="#" class="dropdown-item">Level 3-1</a></li>
                                    <li><a href="#" class="dropdown-item">Level 3-2</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- End Level two -->
                </ul>
            </li> --}}
            {{-- 會員管理 --}}
            {{-- <li class="nav-item dropdown">
                <a id="memberSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    class="nav-link dropdown-toggle">會員專區</a>
                <ul aria-labelledby="memberSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="{{ url('admin/members') }}" class="dropdown-item">會員管理</a></li>
            <li><a href="{{ url('admin/mbposts') }}" class="dropdown-item">會員文章</a></li>
            </ul>
            </li> --}}
            {{-- 系統管理 --}}
            {{-- <li class="nav-item dropdown">
                <a id="systemSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    class="nav-link dropdown-toggle">系統管理</a>
                <ul aria-labelledby="systemSubMenu1" class="dropdown-menu border-0 shadow ">
                    <li><a href="{{ url('admin/admins') }}" class="dropdown-item">管理員管理</a></li>
            <li><a href="{{ url('admin/mails') }}" class="dropdown-item">發信管理</a></li>
            <li><a href="{{ url('admin/logs') }}" class="dropdown-item">維護紀錄</a></li>
            </ul>
            </li> --}}
            {{-- 統計圖表 --}}
            {{-- <li class="nav-item dropdown">
                <a id="accSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    class="nav-link dropdown-toggle">統計圖表</a>
                <ul aria-labelledby="accSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="#" class="dropdown-item">統計表</a></li>
                    <li><a href="#" class="dropdown-item">統計圖</a></li>
                    <li class="dropdown-divider"></li>
                    <!-- Level two dropdown-->
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="accSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="dropdown-item dropdown-toggle">網站瀏覽統計</a>
                        <ul aria-labelledby="accSubMenu2" class="dropdown-menu border-0 shadow">
                            <li>
                                <a href="" class="dropdown-item" target="_blank">網站瀏覽統計表</a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item" target="_blank">網站瀏覽統計圖</a>
                            </li>
                        </ul>
                    </li>
                    <!-- End Level two -->
                </ul>
            </li> --}}
            {{-- 開發者專區 --}}
            <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">後台管理系統</a></li>
            <li class="nav-item"><a href="{{ url('aboutme') }}" class="nav-link">關於我</a></li>
            <li class="nav-item"><a href="https://roger.rvt.idv.tw" class="nav-link" target="_blank">我的筆記</a></li>
            <li class="nav-item dropdown">
                <a id="devSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">參考資料</a>
                <ul aria-labelledby="devSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="https://template.rvt.idv.tw/AdminLTE-3.0.5/" class="dropdown-item" target="_blank">AdminLTE參考樣板</a></li>
                    <li class="dropdown-divider"></li>
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="devSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="dropdown-item dropdown-toggle">線上參考文件</a>
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
                    <!-- End Level two -->
                </ul>
            </li>
            <li class="nav-item"><a href="{{ route('parktaipei') }}" class="nav-link">台北公園</a></li>
            </ul>
            {{-- <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form> --}}
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- Messages Dropdown Menu -->
            {{-- <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li> --}}
            <!-- Notifications Dropdown Menu -->
            {{-- <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>
            </li>
            <li class="nav-item">
                <a href="javascript:" id="fullscreen-button" title="擴展成全螢幕" class="nav-link" data-widget="fullscreen" data-slide="true" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
