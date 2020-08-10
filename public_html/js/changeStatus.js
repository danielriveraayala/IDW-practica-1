function changeStatus(select, urlService, table = null) {
    let id = select.data('id');
    let estatus = select.val();
    $table.bootstrapTable('updateCellByUniqueId', {
        id: id,
        field: 'estatus',
        value: '<i class="fas fa-spin fa-spinner"></i>'
    });
    $.post(urlService, {
        id: id,
        estatus: estatus
    }, function (request) {
        console.log(request);
        $table.bootstrapTable('refresh', {silent: true});
        toastr[request.icon](request.text, request.title)
    });
}