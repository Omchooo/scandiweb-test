$(document).ready(function() {
    // On click of Mass Delete button
    $('#delete-product-btn').click(function() {
        var selectedIds = [];
        // Loop through each checked checkbox
        $('.delete-checkbox:checked').each(function() {
            selectedIds.push($(this).data('id'));
        });

        // Send AJAX request to delete the selected items
        $.ajax({
            type: 'POST',
            url: '/product',
            data: {
                _method: 'DELETE',
                id: selectedIds
            },
            success: function(response) {
                //refresh results

                $('.box-field').load(location.href + ' .box');

            },
            error: function(response) {

            console.log('Error deleting product(s): ' + response.responseJSON.message);
        }
        });
    });
});