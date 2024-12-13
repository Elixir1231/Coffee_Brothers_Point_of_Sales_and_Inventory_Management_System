$(document).ready(function() {
    let rowNumber = 1;
    
    $('#add_row').click(function() {
        rowNumber++;
        
        const html = `
            <tr>
                <td><span id="sr_no">${rowNumber}</span></td>
                <td><input type="text" name="ingredient_name[]" id="ingredient_name${rowNumber}" class="form-control form-control-sm input-sm ingredient_name" placeholder="Ingredient Name"/></td>
                <td><input type="number" min="1" name="quantity[]" id="quantity${rowNumber}" data-srno="${rowNumber}" class="form-control form-control-sm input-sm quantity"placeholder="Qty" /></td>
                <td><input type="number" step="0.01" min="0.00" name="buy_price[]" id="buy_price${rowNumber}" data-srno="${rowNumber}" class="form-control form-control-sm input-sm buy_price" placeholder="Price" /></td>
                <td><input type="text" name="unit[]" id="unit${rowNumber}" data-srno="${rowNumber}" class="form-control form-control-sm input-sm unit" pattern="[A-Za-z0-9]+" placeholder="Unit"></td>
                <td><input type="number" min="1" name="tax_rate[]" id="tax_rate${rowNumber}" data-srno="${rowNumber}" class="form-control form-control-sm input-sm tax_rate" placeholder="%"/></td>
                <td><input type="number" min="1" name="min_qty[]" id="min_qty${rowNumber}" data-srno="${rowNumber}" class="form-control form-control-sm input-sm min_qty" placeholder="Qty" /></td>
                <td><input type="text" name="remarks[]" id="remarks${rowNumber}" data-srno="${rowNumber}" class="form-control form-control-sm input-sm remarks" placeholder="Remarks"></td>
                <td><input type="text" name="location[]" id="location${rowNumber}" data-srno="${rowNumber}" class="form-control form-control-sm input-sm location" placeholder="Location"></td>
            </tr>
        `;
        
        $('#invoice-item-table').append(html);
    });
});
