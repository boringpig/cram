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
    rows = rows + '<table class="table table-hover table-bordered text-center">';
    rows = rows + '<thead><tr>';
    $.each( data, function( key, value ) {
        rows = rows + '<th class="text-center" width="25%">' + key + '</th>';
    });
    rows = rows + '</tr></thead>';
    rows = rows + '<tbody><tr>';
    $.each( data, function( key, value ) {
        rows = rows + '<td>' + value + '</td>';
    });
    rows = rows + '</tr></tbody>';
    rows = rows + '</table></div>';

    return $(".card-table").html(rows);
}
