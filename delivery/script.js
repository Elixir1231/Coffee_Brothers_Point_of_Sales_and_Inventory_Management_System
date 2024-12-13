$(document).ready(function() {
    // Initialize DataTable
    $('#ingredients_table').DataTable();

    // Date range filter
    $('#input-daterange').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    // Filter button click event
    $('#filter').on('click', function() {
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();

        // Perform filtering based on date range
        // Example AJAX request to fetch filtered data from server
        $.ajax({
            url: 'fetch_filtered_data.php',
            type: 'POST',
            data: {
                startDate: startDate,
                endDate: endDate
            },
            success: function(response) {
                // Update table with filtered data
                $('#ingredients_table tbody').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
