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
                $('.box-field').load(location.href + ' .box');
            },
            error: function(xhr, status, error) {

            console.log('Error deleting products: ' + error);
        }
        });
    });
});