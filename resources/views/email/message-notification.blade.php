<h1>有新的訊息被收到！</h1>
<p>姓名：{{ $user->name }}</p>
<p>信箱：{{ $contact_message->email }}</p>
<p>主旨：{{ $contact_message->title }}</p>
<p>內容：{!! $contact_message->content !!}</p>