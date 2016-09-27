var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;

manageData();

function manageData() {
    $.ajax({
        type : 'GET',
        url : url,
        data : {page:current_page},
        dataType : 'json'
    }).done(function (data) {
        // console.log(data);
        total_page = data.last_page;

        $('#pagination').twbsPagination({
            totalPages: total_page,
            visiblePages: 5,
            first: '',
            last: '',
            prev: '&laquo;',
            next: '&raquo;',
            onPageClick: function (event, page) {
                current_page = page;
                if(is_ajax_fire != 0){
                    getPageData();
                }
            }
        });

        manageRow(data.data);
        is_ajax_fire = 1;
    });
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/* Get Page Data*/
function getPageData() {
    $.ajax({
        type: 'GET',
        url: url,
        data: {page:current_page},
        dataType: 'json'
    }).done(function(data){
        manageRow(data.data);
    });
}

function manageRow(data) {
    var rows = '';
    $.each(data, function (key, value) {
        rows = rows + '<tr>';
        rows = rows + '<td>'+ value.day +'</td>>';
        rows = rows + '<td>'+ value.start_time +'</td>>';
        rows = rows + '<td>'+ value.end_time +'</td>>';
        rows = rows + '<td data-id="'+value.id+'">';
        rows = rows + '<button data-toggle="modal" data-target="#edit-time-modal" class="btn btn-info edit-time">修改 </button> ';
        rows = rows + '<button class="btn btn-danger remove-time"> 刪除</button>';
        rows = rows + '</td>';
        rows = rows + '</tr>';
    });
    $("tbody").html(rows);
}

$("#create-time").submit(function(e){
    e.preventDefault();
    var form_action = $("#create-time").attr("action");
    var day = $("#create-time").find("select[name='day']").val();
    var start_time =  $("#create-time").find("input[name='start_time']").val();
    var end_time =  $("#create-time").find("input[name='end_time']").val();

    $.ajax({
        type:'POST',
        url: form_action,
        data:{day: day, start_time: start_time, end_time: end_time},
        dataType: 'json'
    }).done(function (data) {
        $("#create-time").find("select[name='day']").val('null');
        $("#create-time").find("input[name='start_time']").val('');
        $("#create-time").find("input[name='end_time']").val('');
        getPageData();
    });
});

/* Edit Category */
$("body").on("click",".edit-time",function () {
    var id = $(this).parent("td").data('id');
    var day = $(this).parent("td").prev("td").prev("td").prev("td").text();
    var start_time =  $(this).parent("td").prev("td").prev("td").text();
    var end_time =  $(this).parent("td").prev("td").text();
    $("#edit-time").find("select[name='day']").val(day).change();
    $("#edit-time").find("input[name='start_time']").val(start_time);
    $("#edit-time").find("input[name='end_time']").val(end_time);
    $("#edit-time").attr("action",url + '/' + id);
});

$("#edit-time").submit(function(e){
    e.preventDefault();
    var form_action = $("#edit-time").attr("action");
    var day = $("#edit-time").find("select[name='day']").val();
    var start_time =  $("#edit-time").find("input[name='start_time']").val();
    var end_time =  $("#edit-time").find("input[name='end_time']").val();
    $.ajax({
        type:'PUT',
        url: form_action,
        data:{day: day, start_time: start_time, end_time: end_time},
        dataType: 'json'
    }).done(function (data) {
        console.log(data);
        getPageData();
        $('.modal').modal('hide');
    });
});

/* Remove Category */
$("body").on("click",".remove-time",function(){
    var id = $(this).parent("td").data('id');
    var rows = $(this).parent("tr");
    swal({
        title: "你確定要刪除嗎？",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "取消",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "確定",
        closeOnConfirm: true
    }, function () {
        $.ajax({
            url: url + '/' + id,
            type: 'delete',
            dataType: 'json'
        }).done(function (data) {
            rows.remove();
            getPageData();
        });
    });
});



