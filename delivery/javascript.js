$(document).ready(function() {
    // Initialize DataTable
    $('#sales_table').dataTable();

    // Initialize datepicker
    $('#order_date').datepicker({
        todayBtn: 'linked',
        format: "yyyy-mm-dd",
        autoclose: true
    });

    // Initialize popover
    $('[data-toggle="popover"]').popover();

    // Add new row to the table
    var count = 1;
    $(document).on('click', '#add_row', function() {
        count++;
        var html_code = '';
        html_code += '<tr id="row_id_' + count + '">';
        html_code += '<td><span id="sr-no">' + count + '</span></td>';
        html_code += '<td><input type="text" name="barcode[]" id="barcode' + count + '" class="form-control form-control-sm input-sm barcode" placeholder="Barcode"/></td>';
        html_code += '<td><input type="text" pattern="[A-Za-z]+" title="No number on product name" name="ingredient_name[]" id="ingredient_name' + count + '" placeholder="Title" class="product_name form-control form-control-sm input-sm"/></td>';
        html_code += '<td><input type="number" name="quantity[]" min="1" id="quantity' + count + '" data-srno="' + count + '" placeholder="Qty"  class="form-control form-control-sm input-sm quantity" /></td>';
        html_code += '<td><input type="number" name="buy_price[]" min="0.00" step="0.01" placeholder="Price" id="buy_price' + count + '" data-srno="' + count + '" class="form-control form-control-sm input-sm buy_price"></td>';
        html_code += '<td><input type="text" name="unit[]" pattern="[A-Za-z]+" title="No number on unit" id="unit' + count + '" placeholder="Unit" data-srno="' + count + '" class="form-control form-control-sm input-sm unit"></td>';
        html_code += '<td><input type="number" name="tax_rate[]" min="1" id="tax_rate' + count + '" placeholder="%" data-srno="' + count + '" class="form-control form-control-sm input-sm tax_rate"></td>';
        html_code += '<td><input type="number" name="min_qty[]" min="1" id="min_qty' + count + '" data-srno="' + count + '" class="form-control form-control-sm input-sm min_qty" placeholder="Qty" /></td>';
        html_code += '<td><input type="text" name="remarks[]" id="remarks' + count + '" placeholder="Remarks" data-srno="' + count + '" class="form-control form-control-sm input-sm remarks"></td>';
        html_code += '<td><input type="text" name="location[]" id="location' + count + '" placeholder="Location" data-srno="' + count + '" class="form-control form-control-sm input-sm location"></td>';
        html_code += '<td><button type="button" name="remove_row" id="' + count + '" class="btn btn-sm btn-danger btn-xs remove_row"><i class="fas fa-minus-circle"></i></button></td></tr>';
        $("#invoice-item-table").append(html_code);
    });

    // Remove row from table
    $(document).on('click', '.remove_row', function() {
        var row_id = $(this).attr("id");
        $('#row_id_' + row_id).remove();
        count--;
    });

    // Submit delivery form
    $(document).on('click', '#create_delivery', function(event) {
        event.preventDefault();
        
        var ingredient_data = [];
        
        $('.barcode').each(function(index) {
            var barcode = $(this).val();
            var ingredient_name = $('.product_name').eq(index).val();
            var quantity = $('.quantity').eq(index).val();
            var buy_price = $('.buy_price').eq(index).val();
            var unit = $('.unit').eq(index).val();
            var tax_rate = $('.tax_rate').eq(index).val();
            var min_qty = $('.min_qty').eq(index).val();
            var remarks = $('.remarks').eq(index).val();
            var location = $('.location').eq(index).val();
            
            ingredient_data.push({
                barcode: barcode,
                ingredient_name: ingredient_name,
                quantity: quantity,
                buy_price: buy_price,
                unit: unit,
                tax_rate: tax_rate,
                min_qty: min_qty,
                remarks: remarks,
                location: location
            });
        });

        var supplier = $('#supplier_search').val();
        var transaction_no = $('#order_no').val();
        var order_date = $('#order_date').val();

        if ($.trim(supplier).length == 0 || $.trim(transaction_no).length == 0) {
            swal("Warning", "Please fill out all required fields!", "warning");
            return false;
        }

        $.ajax({
            url: "add_delivery.php",
            method: "POST",
            data: {
                ingredient_data: JSON.stringify(ingredient_data),
                supplier: supplier,
                order_no: transaction_no,
                order_date: order_date
            },
            success: function(data) {
                if (data === "success") {
                    window.location.href = 'delivery.php?success=1';
                } else {
                    window.location.href = 'add_delivery.php?failure=1';
                }
            }
        });
    });

    // Load supplier typeahead
    $('#supplier_search').typeahead({
        source: function(query, result) {
            $.ajax({
                url: 'loadsupplier.php',
                method: "POST",
                data: { query: query },
                dataType: "json",
                success: function(data) {
                    result($.map(data, function(item) {
                        return item;
                    }));
                }
            });
        }
    });
});
