<aside class="main-sidebar sidebar-dark-primary bg-navy elevation-4">
    <div class="sidebar">
        {{-- 驗證使用者是否登入 --}}
        @auth
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <a href="{{ route('users.showAvatar') }}" class="px-1">
                    <img src="{{ Auth::user()->getAvatarUrl() }}" style="width: 30px; height: 30px;" class="rounded-circle mt-1">
                </a>
            </div>
            <div class="info">
                <a href="javascript:" class="d-block">{{ Auth::user()->name ?? '' }}</a>
                {{-- <a href="javascript:" class="d-block">{{ Auth::user()->email ?? '' }}</a> --}}
            </div>
        </div>
        @endif
        <nav id="sidebar" class="mt-2 nav-compact">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('parktaipei') }}" class="nav-link">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>台北市公園資訊</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('posts') }}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>會員文章</p>
                        <span class="right badge badge-info">{{ $posts_total ?? '' }}</span>
                    </a>
                </li>

                @auth
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); $('#logout-form').submit();"><i class="nav-icon fas fa-door-open text-danger"></i> 登出</a>
                    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth
            </ul>
        </nav>
    </div>
</aside>
