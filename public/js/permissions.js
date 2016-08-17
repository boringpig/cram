$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("body").on("click", ".show-permission", function () {
    var id = $(this).data('id');

    $.ajax({
        url: url + '/' + id,
        type: 'get',
        dataType: 'json'
    }).done(function (data) {
        $('.modal-title').text(data.name);
        $('.modal-body').append(
            "<h4>權限名稱描述：" + data.description + "</h4><br>" +
            "<button class='close-modal btn btn-default'>關閉</button>");

        $('.close-modal').click(function () {
            $('.modal-body').html('');
            $('.modal').modal('hide');
        });
    });
});



$("body").on("click", ".remove-permission", function () {
    var id = $(this).data('id');

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
            window.location = url;
        });
    });
});