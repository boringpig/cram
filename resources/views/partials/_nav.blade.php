<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">敦品補習班</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('/')? 'active' : '' }}"><a href="{{ route('home') }}">首頁</a></li>
                <li class="{{ Request::is('article')? 'active' : '' }}"><a href="{{ route('article.index') }}">公告消息</a></li>
                <li><a href="#">聯絡我們</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li class="dropdown">
                        <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('user.profile') }}">個人帳戶</a></li>
                            @role('工讀生')
                                <li><a href="{{ route('clock-in.index') }}">上班打卡</a></li>
                                <li><a href="{{ route('rollCall.index') }}">班級點名</a></li>
                            @endrole
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('logout') }}">登出</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span>登入</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>