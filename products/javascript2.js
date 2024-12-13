$(function () {
    $('[data-toggle="popover"]').popover();
});

$(function(){
    $('button.delete').click(function(e){
        e.preventDefault();
        var link = this;
        var deleteModal = $("#deleteModal");
        deleteModal.find('input[name=id]').val(link.dataset.id);
        deleteModal.modal();
    });
});

$(document).ready(function(){
    /* function for activating modal to show data when clicked using AJAX */
    $(document).on('click', '.view_data', function(){  
        var id = $(this).attr("id");  
        if(id != ''){  
            $.ajax({  
                url:"view_ingredient.php",  
                method:"POST",  
                data:{id:id},  
                success:function(data){  
                    $('#Contact_Details').html(data);  
                    $('#dataModal').modal('show');  
                }  
            });  
        }            
    });   
});

$(document).ready(function(){
    $('#ingredient_table').dataTable();
});
