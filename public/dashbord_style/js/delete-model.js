$('body').on('click', '#deleteCoateory', function() {
    $('#deleteCoateoryModel').modal('show');
    var id = $(this).data('id')
    var name = $(this).data('name')
    $('#cat_id_delete').val(id);
    $('#delete_title').val(name);
})