$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//搜尋年/月表單
$("#search-date-form").submit(function (e) {
    e.preventDefault();
    var form_action = $("#search-date-form").attr("action");
    var form_date = $("#search-date-form").find('input[name="select-date"]').val();

    $.ajax({
        type: 'post',
        url: form_action,
        data: {date: form_date},
        dataType: 'json'
    }).done(function (data) {
        //console.log(data);
        manageRollCall(data);
    });
});

//搜尋班級的表單
$("#search-lesson-form").submit(function (e) {
    e.preventDefault();
    var form_action = $("#search-lesson-form").attr("action");
    var form_lesson = $("#search-lesson-form").find('select[name="select-lesson"]').val();

    $.ajax({
        type: 'post',
        url: form_action,
        data: {lesson: form_lesson},
        dataType: 'json'
    }).done(function (data) {
        //console.log(data);
        manageRollCall(data);
    });
});

//顯示點名表資料
function manageRollCall(data) {
    var rows = '';

    rows = rows + '<div class="table-responsive">';
    rows = rows + '<table class="table table-hover">';
    rows = rows + '<thead><tr>';
    rows = rows + '<th width="12%">日期</th><th width="22%">班級</th><th width="10%">老師</th><th width="20%">上課時間</th>';
    rows = rows + '<th width="7%">應到</th><th width="7%">實到</th><th width="7%">未到</th><th width="15%"></th>';
    rows = rows + '</tr></thea>';
    rows = rows + '<tbody style="font-size: 12pt">';
    $.each(data, function (key, value) {
        rows = rows + '<tr>';
        rows = rows + '<td>' + value.date + '</td>';
        rows = rows + '<td>' + value.name + '</td>';
        rows = rows + '<td>' + value.teacher + '</td>';
        rows = rows + '<td>' + value.class_time + '</td>';
        rows = rows + '<td>' + value.should_go + '</td>';
        rows = rows + '<td>' + value.real_go + '</td>';
        rows = rows + '<td>' + value.yet_go + '</td>';
        rows = rows + '<td class="text-center"><a href="/backend/rollCall/show/'+ value.id + '" class="btn btn-primary">看更多</a></td>';
        rows = rows + '</tr>';
    });
    rows = rows + '</tbody>';
    rows = rows + '</table></div>';

    return $(".rollcall-table").html(rows);
}