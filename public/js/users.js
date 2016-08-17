$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("body").on('click', '.remove-user', function () {
    var id = $(this).data('id');
    swal({
        title: "你確定要刪除嗎？",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "取消",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "確定",
        closeOnConfirm: true
    },function() {
        $.ajax({
            url: url + '/' + id,
            type: 'delete',
            dataType: 'json'
        }).done(function (data) {
            window.location.reload();
        });
    });
});
