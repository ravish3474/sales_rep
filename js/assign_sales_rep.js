$(document).on('click' ,'.assigned_to_btn' ,function(){
    let lead_id = $(this).data('lead_id'); 
    let salesPerson = $(this).data('assigned_to'); 
    var modal = $('#salesRepModal'); 
    modal.modal('show'); 
    getsalesRepList(lead_id ,salesPerson)
    $('#salesRepModal .savebtn').attr('data-lead_id' ,lead_id);
    $('#search_name').attr('data-lead_id' ,lead_id) ;
    $('#search_name').attr('data-saleperson', salesPerson); 
    $('#lead_id_assign').val(lead_id);
    getAllAssignedSaleRep(lead_id);

}) ;

function getsalesRepList(lead_id ,salesPerson ,search =0){
     showLoader();
    $.ajax({
          url: 'getallAssignedSalesRep' , 
         method : 'POST' , 
          data : {
             lead_id : lead_id , 
             salesPerson : salesPerson, 
             search : search 
          }, 
          success : function(response){
              $('.allMultiList').html(response);
              hideLoader();
          } , 
          error : function(){
             hideLoader();
          }
    })     
}

function getAllAssignedSaleRep(lead_id) {
        showLoader();

    $.ajax({
        url: 'GetAssignedSalesRep',
        method: 'POST',
        data: {
            id: lead_id
        },
        success: function(response) {
            let resp = JSON.parse(response);

            $('.totalAssignedAdmin').html(resp.assigned_sales_rep);

            $(document).on('click', '.multiDropdownBtn', function() {
                $(this).closest('form').find('.multiselectDropdown').css('display', 'block');
            });
            hideLoader();

        },
        error: function(status, xhr, error) {
            swal.fire({
                title: " Can not get sales rep data",

            });
            hideLoader();
        }
    })
}

function GetCheckedValues() {
    let checkedValues = [];
    $('#salesRepModal .sales_rep_checkbox').each(function() {
        if ($(this).prop('checked')) {
            checkedValues.push($(this).val());
        }
    });

   
    return checkedValues;
}


$(document).on('click', '.deleteSalesRep', function() {
    let id = $(this).data('multiple-id');
    let lead_id = $(this).data('lead_id');

    let salesPerson = $(this).data('salesperson'); 
    console.log(salesPerson); 
     

       Swal.fire({
                title: 'Are you sure?',
                text: 'Want to delete the multiple sales person!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No'
            }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                    url: 'deleteSalesPerson',
                    method: "POST",
                    data: {
                        id: id,
                        salesPerson:salesPerson ,
                        lead_id:lead_id ,
                    },
                    success: function(reponse) {
                        // Swal.fire({
                        //     title: 'Sales person deleted successfully',
                        //     icon: 'success',
                        //     confirmButtonText: 'Got it!'
                        // });
                   
                        getAllAssignedSaleRep(lead_id);
                        getsalesRepList(lead_id ,salesPerson)

                    },
                    error: function(xhr, status, error) {
                        console.log('Error in code ');

                    }

                })

                }
            });

 

});

// search 
$(document).on('input' ,'#search_name' ,function(){
    let lead_id = $(this).data('lead_id'); 
    let salesPerson = $(this).data('saleperson')
    let search =  $(this).val(); 

    getsalesRepList(lead_id ,salesPerson ,search);
});


$(document).on('change' ,'.sales_rep_checkbox' ,function(){
var isChecked = $(this).prop('checked'); 
var multiple_id = $(this).data('multiple_id');
var main_id = $(this).data('main_id');


if(isChecked){
        let lead_id = $('#lead_id_assign').val();
        let checked_values = $(this).val();

    showLoader();
    $.ajax({
        url: 'SavemultipleSalesRep',
        method: 'POST',
        data: {
            lead_id: lead_id,
            all_values: checked_values,
        },
        success: function(response){
            getAllAssignedSaleRep(lead_id);
            getsalesRepList(lead_id);
            hideLoader();  
        },
        error: function(xhr, status, error) {
            console.warn("Something went wrong");
            hideLoader(); 
        }
    });
}else{
    let lead_id = $('#lead_id_assign').val();
    let checked_values = $(this).val();
 
    showLoader();
    $.ajax({
        url: 'deleteSalesPerson',
        method: 'POST',
        data: {
            lead_id: main_id,
            multiple_id: multiple_id,
        },
        success: function(response){
            getAllAssignedSaleRep(lead_id);
            hideLoader();
        },
        error: function(xhr, status, error) {
            console.warn("Something went wrong");
            hideLoader(); 
        }
    });
    
}

});


