<h3>行事曆</h3>
<br>
<div class="row">
    <div class="col-sm-12">
        <div id="calendar" style="width:100%;height:620px;"></div>
    </div>
</div>
<hr>

@section('scripts')
    <script src="{{ asset('src/js/moment.min.js') }}"></script>
    <script src="{{ asset('src/fullcalendar/js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('src/fullcalendar/lang/zh-tw.js') }}"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>
@endsection