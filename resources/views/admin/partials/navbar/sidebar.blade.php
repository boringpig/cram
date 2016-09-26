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
            @permission('系統管理')
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
                        <a href="{{ route('backend.users.log') }}">使用記錄</a>
                    </li>
                </ul>
            </li>
            @endpermission
            @permission('系統管理')
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
                </ul>
            </li>
            @endpermission
            @ability('系統管理員,系統開發員', '系統管理,人事管理')
            <li>
                <a><i class="fa fa-users"></i> 打卡管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('backend.servitors.index') }}">打卡總覽</a>
                    </li>
                    <li>
                        <a href="{{ route('backend.work') }}">工作總覽</a>
                    </li>
                    <li>
                        <a href="{{ route('servitor-clock.view') }}">月時數報表</a>
                    </li>
                </ul>
            </li>
            @endability
            @ability('系統管理員,系統開發員', '系統管理,班級事務')
            <li>
                <a><i class="fa fa-university"></i> 班級管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('backend.lessons.index') }}">班級總覽</a>
                    </li>
                    <li>
                        <a href="{{ route('backend.lessons.create') }}">新增班級</a>
                    </li>
                    <li>
                        <a href="{{ route('backend.grade') }}">年級總覽</a>
                    </li>
                    <li>
                        <a href="{{ route('backend.time') }}">上課時間總覽</a>
                    </li>
                    <li>
                        <a href="#">點名管理 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="{{ route('rollCall-date.view') }}">年/月查詢</a>
                            </li>
                            <li>
                                <a href="{{ route('rollCall-lesson.view') }}">班級查詢</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            @endability
            <li>
                <a><i class="fa fa-users"></i> 學生管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('backend.students.index') }}">學生總覽</a>
                    </li>
                    <li>
                        <a href="{{ route('backend.students.create') }}">新增學生</a>
                    </li>
                </ul>
            </li>
            @ability('系統管理員,系統開發員', '系統管理,班級公告')
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
            @endability
            @ability('系統管理員,系統開發員', '系統管理,班級公告')
            <li>
                <a><i class="fa fa-calendar"></i> 行事曆管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('backend.calendar_events.index') }}">事件總覽</a>
                    </li>
                    <li>
                        <a href="{{ route('backend.calendar_events.create') }}">新增事件</a>
                    </li>
                </ul>
            </li>
            @endability
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>

