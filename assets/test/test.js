$(function () {
    $(document).on('blur', '#document_input', function () {
        let name = $(this).val();
        if (!name) {
            return false;
        }
        let listInput = $('#document_list_input');
        let listBlock = $('#document-list-block');
        let obj = {
            name: name,
            id: $(this).data('id')
        };
        $.post($(this).data('url'), obj, function (data) {
            if (data.error !== undefined) {
                listInput.val(null);
                listBlock.hide();
                alert(data.error);
            }
            if (data.success !== undefined) {
                listBlock.show();
            }
        });
    });
});