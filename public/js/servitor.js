$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#search-month-form").submit(function (e) {
    e.preventDefault();
    var form_action = $("#search-month-form").attr("action");
    var form_month = $("#search-month-form").find(".select-month").val();

    $.ajax({
        type: 'post',
        url: form_action,
        data: {month: form_month},
        dataType: 'json'
    }).done(function (data) {
        console.log(data);
        manageTotalHour(data);
    });
});

function manageTotalHour(data) {
    var rows = '';
    rows = rows + '<div class="table-responsive">';
    rows = rows + '<table class="table table-hover table-bordered text-center" style="font-size: 13pt">';
    rows = rows + '<thead><tr>';
    rows = rows + '<th class="text-center">姓名</th><th class="text-center">總時數</th><th class="text-center">一般工讀</th><th class="text-center">數學家教</th><th class="text-center">英文家教</th>';
    rows = rows + '</tr></thead>';
    rows = rows + '<tbody>';
    $.each( data, function( key, value ) {
        rows = rows + '<tr>';
        rows = rows + '<td>' + value.姓名 + '</td>';
        rows = rows + '<td>' + value.總時數 + '</td>';
        rows = rows + '<td>' + value.一般工讀 + '</td>';
        rows = rows + '<td>' + value.數學家教 + '</td>';
        rows = rows + '<td>' + value.英文家教 + '</td>';
        rows = rows + '</tr>';
    });
    rows = rows + '</tbody>';
    rows = rows + '</table></div>';

    return $(".month-table").html(rows);
}

