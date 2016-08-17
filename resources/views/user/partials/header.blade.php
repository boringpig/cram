<div class="row" style="margin-top: 15px">
    <div class="col-md-12">
        <ul class="nav nav-tabs nav-justified">
            <li role="presentation" class="{{ Request::is('user/edit')? 'active': '' }}"><a href="{{ route('user.profile') }}">個人資料</a></li>
            <li role="presentation" class="{{ Request::is('user/account/change_password')? 'active': '' }}"><a href="{{ route('user.password') }}">修改密碼</a></li>
            <li role="presentation" class="{{ Request::is('user/account/activity-log')? 'active': '' }}"><a href="{{ route('user.activity-log') }}">登入紀錄</a></li>
        </ul>
    </div>
</div>