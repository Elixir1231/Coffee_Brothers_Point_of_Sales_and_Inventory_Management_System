<!DOCTYPE html>
<html>
<head>
    <?php include('../templates/head1.php'); ?>
    <style type="text/css">
        #invoice-item-table tr th{
            font-size: 12px;
        }
        ul.typeahead.dropdown-menu{
            margin-top: 0px;
        }
    </style>
</head>
<body>
    <div class="contain h-100">
        <?php include('../delivery/base.php');
        if(isset($_GET['failure'])){
            echo '<script>swal("Unsuccessful","Operation failed!","error");</script>';
        }
        if(isset($_GET['success'])){
            echo '<script>swal("Successful","Operation succeeded!","success");</script>';
        }
        ?>
        <div>
            <div class="mt-1 ml-5">
                <label><b>New Supplier:</b></label>
                <button class="btn-sm btn-info border" data-toggle="modal" data-target=".modal"  style="padding:5px;">
                    <span class="badge badge-info"><i class="fas fa-user-plus"></i> New</span>
                </button>
            </div>
            <form method="post" action="save_ingredients.php" id="invoice_id">
                <div class="table-responsive mt-1 pl-5 pr-5">
                    <table class="table table-striped table-bordered table-sm">
                        <tr>
                            <td>
                                <div class="row mb-1">

                                    <div class="col-md-4">
                                        Transaction No.
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-hands-helping"></i></span>
                                            </div>
                                            <input type="text" name="order_no" id="order_no" class="form-control input-sm" required readonly value="<?php echo strtoupper(uniqid()) ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <table id="invoice-item-table" class="table table-bordered table-sm">
                                    <tr>
                                        <th>No</th>
                                        <th>Item No.</th>
                                        <th>Ingredient Name</th>
                                        <th>Quantity</th>
                                        <th>Buy Price</th>
                                        <th>Unit</th>    
                                        <th>Tax Rate (%)</th>
                                        <th>Minimum Qty</th>
                                        <th>Remarks</th>
                                        <th>Location</th>
                                        <th>
                                            <button type="button" name="add_row" id="add_row" class="btn btn-success btn-sm btn-xs">
                                                <i class="fas fa-plus-circle"></i>
                                            </button>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td><span id="sr_no">1</span></td>
                                        <td><input type="text" name="barcode[]" id="barcode1" class="form-control form-control-sm input-sm barcode required" placeholder="Item No."/></td>
                                        <td><input type="text" name="ingredient_name[]" id="ingredient_name1" class="form-control form-control-sm input-sm ingredient_name required" placeholder="Ingredient Name"/></td>
                                        <td><input type="number" min="1" name="quantity[]" id="quantity1" data-srno="1" class="form-control form-control-sm input-sm quantity required" placeholder="Qty" /></td>
                                        <td><input type="number" step="0.01" min="0.00" name="buy_price[]" id="buy_price1" data-srno="1" class="form-control form-control-sm input-sm buy_price required" placeholder="Price" /></td>
                                        <td><input type="text" name="unit[]" id="unit1" data-srno="1" class="form-control form-control-sm input-sm unit required" pattern="[A-Za-z0-9]+" placeholder="Unit"></td>
                                        <td><input type="number" min="1" name="tax_rate[]" id="tax_rate1" data-srno="1" class="form-control form-control-sm input-sm tax_rate required" placeholder="%"/></td>
                                        <td><input type="number" min="1" name="min_qty[]" id="min_qty1" data-srno="1" class="form-control form-control-sm input-sm min_qty required" placeholder="Qty" /></td>
                                        <td><input type="text" name="remarks[]" id="remarks1" data-srno="1" class="form-control input-sm form-control-sm remarks required" placeholder="Remarks"></td>
                                        <td><input type="text" name="location[]" id="location1" data-srno="1" class="form-control input-sm form-control-sm location required" placeholder="Location"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <input type="submit" name="create_delivery" value="Okay" id="create_delivery" class="btn btn-sm btn-info mr-5"/>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <script src="../bootstrap4/jquery/jquery.min.js"></script>
    <script src="../bootstrap4/jquery/datepicker.js"></script>
    <script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
    <script src="../bootstrap4/js/typeahead1.js"></script>
    <script src="../delivery/ingredients.js"></script>
    <script>
    $(document).ready(function() {
        $('#create_delivery').click(function() {
            // Check if any required fields are empty
            var empty = false;
            $('.required').each(function() {
                if ($(this).val() == '') {
                    empty = true;
                    return false; // Exit the loop if any empty field found
                }
            });

            // If any required field is empty, prevent form submission
            if (empty) {
                alert
                ('Please fill out all required fields!');
                return false;
            }
        });
    });
    </script>
</body>
</html>
<?php include('../delivery/add_supplier.php');?>