$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var lesson_array = []; //班級資訊
var roll_call_id; //如有今天出現兩次點名單，暫存ＩＤ
var status_array = []; //存每個使用者的status

//搜尋當天點名的班級
$("#search-lesson-form").submit(function (e) {
    e.preventDefault();
    var form_action = $("#search-lesson-form").attr("action");
    var form_lesson = $("#search-lesson-form").find(".select-lesson").val();

    $.ajax({
        type: 'post',
        url: form_action,
        data: {lesson: form_lesson},
        dataType: 'json'
    }).done(function (data) {
        //console.log(data);
        manageRollCallForm(data);
        ajax_select();
        makeLessonArray(data);
        $('.select-status').select2({
            placeholder : '請選擇出缺席'
        });
    });
});

//顯示點名表的班級資訊和學生資料
function manageRollCallForm(data) {
    var rows = '';
    var num = 0;

    $.each(data, function (key, value) {
        $.each(value.班級, function (key, value) {
            rows = rows + '<h4>班級：' + value.name + '</h4>';
            rows = rows + '<h4>授課老師：' + value.teacher + '</h4>';
            rows = rows + '<h4>日期：' + value.date + '</h4>';
            rows = rows + '<h4>班級人數：' + value.people + '人</h4><hr>';
        });
        $.each(value.學生, function (key, value) {
            num = num + 1;
            status_array.push((value.status).toString());
            rows = rows + '<div class="student-row row" data-index = "' + num + '" data-id="'+ value.id +'">';
            rows = rows + '<div class="col-sm-4" style="padding-right: 0">';
            rows = rows + '<label for="status" class="col-sm-4" style="font-size: 13pt;margin-top: 5px;">' + value.name +'</label>';
            rows = rows + '<div class="col-sm-7" style="padding-left: 0">';
            rows = rows + '<select name="status" class="select-status form-control">';
            rows = rows + '<option></option><option value="0">曠課</option><option value="1">到班</option><option value="2">事假</option><option value="3">病假</option>';
            rows = rows + '</select></div></div>';
            rows = rows + '<div class="col-sm-7" style="padding-left: 0">';
            rows = rows + '<input type="text" name="description" class="form-control" placeholder="備註說明" value="'+ value.description +'">';
            rows = rows + '</div></div><br>';
        });
        rows = rows + '<div class="text-center">';
        rows = rows + '<button class="submit-rollCall btn btn-primary btn-lg">送出</button>';
        rows = rows + '</div>';
    });

    return $(".rollColl").html(rows);
}

//ajax選擇點名表上的學生點名狀況
function ajax_select() {
    var student_location = $(".submit-rollCall").parent("div").parent("div").find(".student-row");
    $(student_location).each(function (index,item) {
        $(item).find('select[name="status"]').val(status_array[index]);
    });

}

//用陣列儲存班級資訊
function makeLessonArray(data) {
    var lesson_obj = {};
    $.each(data, function (key, value) {
        $.each(value.班級, function (key, value) {
            roll_call_id = value.id;
            lesson_obj['id'] = value.lesson_id;
            lesson_obj['name'] = value.name;
            lesson_obj['teacher'] =  value.teacher;
            lesson_obj['class_time'] = (value.date).substr(13, 14);
            lesson_obj['date'] = (value.date).substr(0, 9);
            lesson_array.push(lesson_obj);
        });
    });

    return lesson_array;
}

//送出點名表單
$("body").on("click", ".submit-rollCall", function () {
    var student_location = $(".submit-rollCall").parent("div").parent("div").find(".student-row");
    var student_array = []; //學生資訊
    var student_obj = {};
    $(student_location).each(function (index,item) {
        student_obj['id'] = $(item).data('id');
        student_obj['status'] = $(item).find('select[name="status"]').val();
        student_obj['description'] = $(item).find('input[name="description"]').val();
        student_array.push(student_obj);
        student_obj={};
    });
    $.ajax({
        type: 'post',
        url: url + '/lesson',
        data: {roll_call_id: roll_call_id, lesson: lesson_array, student: student_array},
        dataType: 'json'
    }).done(function (data) {
        //console.log(data);
        swal({
            title: "點名成功!",
            type: "success"
        }, function () {
            window.location.reload();
            lesson_array = []; //清空班級資訊
            status_array = []; //清空班級學生的點名狀況
        });
    });
});














