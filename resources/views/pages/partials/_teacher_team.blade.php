<h3>師資陣容</h3>
<br>
<div class="row">
    @foreach($teachers as $user)
        <div class="col-sm-2">
            <img src="{{ $user->present()->Avatar_url }}" class="img-circle img-thumbnail" style="width: 130px; height: 100px" alt="Image">
            <p>{{ $user->name }}</p>
        </div>
    @endforeach
</div>
<hr>