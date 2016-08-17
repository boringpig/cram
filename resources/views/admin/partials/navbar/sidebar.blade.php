<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>

            <li>
                <a href="{{ route('backend.home') }}"><i class="fa fa-dashboard"></i> 首頁</a>
            </li>

            <li>
                <a><i class="fa fa-users"></i> 會員管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('backend.users.index') }}">會員總覽</a>
                    </li>
                    <li>
                        <a href="{{ route('backend.users.create') }}">新增會員</a>
                    </li>
                    <li>
                        <a href="#">登入記錄</a>
                    </li>
                </ul>
            </li>
            <li>
                <a><i class="fa fa-briefcase"></i> 職務管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">角色管理 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="{{ route('backend.roles.index') }}">角色總覽</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.roles.create') }}">新增角色</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">權限內容管理 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="{{ route('backend.permissions.index') }}">權限內容總覽</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.permissions.create') }}">新增權限內容</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">使用記錄</a>
                    </li>
                </ul>
            </li>
            <li>
                <a><i class="fa fa-users"></i> 工讀生管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('backend.servitors.index') }}">工讀生總覽</a>
                    </li>
                    <li>
                        <a href="{{ route('backend.work') }}">工作總覽</a>
                    </li>
                    <li>
                        <a href="{{ route('servitor-clock.view') }}">月時數報表</a>
                    </li>
                </ul>
            </li>
            <li>
                <a><i class="fa fa-list-alt"></i> 公告管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('backend.articles.index') }}">公告總覽</a>
                    </li>
                    <li>
                        <a href="{{ route('backend.articles.create') }}">新增公告</a>
                    </li>
                    <li>
                        <a href="{{ route('backend.category') }}">類別總覽</a>
                    </li>
                    <li>
                        <a href="{{ route('backend.tag') }}">標籤總覽</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>

