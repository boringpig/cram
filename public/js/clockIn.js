
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var num; //增加的work數量
var total_hour; //打卡完後的總時數
var card_id; //打卡完後的卡的ＩＤ

check_status();

function check_status() {
    $.ajax({
        type: 'get',
        url: url,
        dataType: 'json'
    }).done(function (data) {
        manageButton(data);
    });
}

function get_work() {
    $.ajax({
        type: 'get',
        url: work_url,
        dataType: 'json'
    }).done(function (data) {
        manageWork(data);
        $(".select-hr").select2({
            minimumResultsForSearch: Infinity,
            width: 38
        });
        $(".select-work").select2({
            minimumResultsForSearch: Infinity,
            width: 100
        });
    })
}

function isEmptyObject(obj)
{
    for (var key in obj)
    {
        return false;
    }
    return true;
}

function manageButton(data) {
    var rows = '';
    if (! isEmptyObject(data)){
        if(data.on_duty !== null && data.off_duty == null){
            rows = rows + '<div class="text-center">';
            rows = rows + '<button class="clock_out btn btn-success btn-lg" data-id="'+ data.id + '">下班</button>';
            rows = rows + '</div>';
            return $(".clock_card").html(rows);
        }
    }
    rows = rows + '<div class="text-center">';
    rows = rows + '<button class="clock_in btn btn-success btn-lg">上班</button>';
    rows = rows + '</div>';

    return $(".clock_card").html(rows);
}

function showClockOutCard(data) {
    var rows = '';
    total_hour = data.total_hour;
    rows = rows + '<div style="width: 33%;margin: auto">';
    rows = rows + '<div class="text-center">';
    rows = rows + '<h4>上班時間: '+ data.on_duty + '</h4>';
    rows = rows + '<h4>下班時間: '+ data.off_duty +'</h4>';
    rows = rows + '<h4>總時數：'+ data.total_hour + 'hr</h4>';
    rows = rows + '</div>';
    rows = rows + '<div class="row">';
    rows = rows + '<div class="col-sm-10"><div class="clock_card_work"></div></div>';
    rows = rows + '<div class="col-sm-2" style="margin-top: 13px;"><a class="add-work btn btn-default btn-sm">+</a></div>';
    rows = rows + '<div class="text-center"><button class="clock-work btn btn-success" style="margin-top: 15px;"> 送出</button></div>';
    rows = rows + '</div>';

    return $(".clock_card").html(rows);
}

function manageWork(data) {
    num = num + 1;
    var rows = '';
    // rows = rows + '<div id = "work_row' + num  + '" class="row" style="margin-top: 13px;">';
    rows = rows + '<div class="work_row row" data-index = "' + num + '" style="margin-top: 13px;">';
    rows = rows + '<div class="col-sm-1">';
    rows = rows + '<span class="remove-work"><i class="fa fa-times fa-lg"></i></span></div>';
    rows = rows + '<div class="col-sm-2">';
    rows = rows + '<select name="work-hr" id="work-hr" class="select-hr">';
    rows = rows + '<option value="1">1</option><option value="2">2</option><option value="3">3</option>';
    rows = rows + '</select></div>';
    rows = rows + '<div class="col-sm-2">';
    rows = rows + '<span style="font-size:14pt"> hr</span></div>';
    rows = rows + '<div class="col-sm-6">';
    rows = rows + '<select name="work" id="work" class="select-work">';
    $.each( data, function( key, value ) {
        rows = rows + '<option value="' + value.id + '">' + value.name + '</option>';
    });
    rows = rows + '</select></div>';
    rows = rows + '</div>';

    return $(".clock_card_work").append(rows);
}

$("body").on("click", ".add-work", function () {
    get_work();
    $(".select-hr").select2({
        minimumResultsForSearch: Infinity,
        width: 38
    });
    $(".select-work").select2({
        minimumResultsForSearch: Infinity,
        width: 100
    });
});

$("body").on("click", ".clock_in", function () {
    $.ajax({
        type: 'post',
        url: url + '/in',
        dataType: 'json'
    }).done(function (data) {
        swal({
            title: "打卡上班成功",
            type: "success"
        }, function () {
            check_status();
        });
    });
});

$("body").on("click", ".clock_out", function () {
    card_id = $(this).data('id');

    $.ajax({
        type: 'post',
        url: url + '/out',
        data: {user_id: id, card_id: card_id},
        dataType: 'json'
    }).done(function (data) {
        showClockOutCard(data);
        num = 0;
        get_work();
    });
});

$("body").on("click", ".clock-work", function () {
    var work = makeWorkArray();
    console.log(work);
    var check = checkWorkHr(work, total_hour);
    if(check){
        $.ajax({
            type: 'post',
            url: url + '/finish',
            data: {card_id: card_id, work: work},
            dataType: 'json'
        }).done(function (data) {
            console.log(data);
            swal({
                title: "打卡下班成功",
                type: "success"
            }, function(){
                check_status()
            });
        });
    }else{
        swal({
            title: "與下班的總時數不一致",
            type: "error"
        });
    }
});

$("body").on("click", ".remove-work", function () {
    var rows = $(this).parent("div").parent("div");
    rows.remove();
});

function makeWorkArray() {
    var work_location = $(".clock-work").parent("div").prev("div").prev("div").find(".clock_card_work").find(".work_row");
    var work_array = [];
    var work_obj = {};
    $(work_location).each(function(index,item){
        // $(item).css( "color", "red" );
        var work_hr = $(item).find("#work-hr").val();
        var work_type = $(item).find("#work").val();
        work_obj['hr'] = work_hr;
        work_obj['type'] = work_type;
        work_array.push(work_obj);
        work_obj = {};
    });

    return work_array;
}

function checkWorkHr(data, total_hour) {
    var hours = 0;

    $.each(data, function (key, value) {
        hours = hours + parseInt(value.hr);
    });
    return hours == total_hour;
}




