$(document).ready(function() {
    // On click of Mass Delete button
    $('#delete-product-btn').click(function() {
        var selectedIds = [];
        // Loop through each checked checkbox
        $('.delete-checkbox:checked').each(function() {
            selectedIds.push($(this).data('id'));
        });

        // console.log(selectedIds);
        // Send AJAX request to delete the selected items
        $.ajax({
            type: 'POST',
            url: '/',
            data: {
                delete: selectedIds
            },
            success: function(response) {
                //refresh results
                //not acceptable by QA test:

                $('.box-field').load(location.href + ' .box');

                // selectedIds.forEach(function(id) {
                //     $('.delete-checkbox[data-id="' + id + '"]').closest('.box').remove();
                // });
            },
            error: function(response) {

            console.log('Error deleting product(s): ' + response.responseJSON.message);
        }
        });
    });
});