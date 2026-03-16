// all check box clicked 

$(document).on('change' ,'.main_checkbox_item' ,function(){
    var isChecked = $(this).is(':checked');
    const table = $(this).closest('table');
    table.find('.select_checkbox').prop('checked', isChecked);
});


$(document).on('click' ,'.deleteAll_leads' ,function(){
    let all_ids = getAllCheckedValue(); 
      Swal.fire({
            title: 'Are you sure?',
            text: 'Want to delete leads',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, continue!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if(result.isConfirmed){
                      showLoader();

                    $.ajax({
                        url : 'deleteAllLeads',
                        method : "POST", 
                        data : {
                            all_ids : all_ids 
                        } ,
                        success : function(reponse){

                            removeElements();
                            getDeletedData();
                            hideLoader();

                        },
                        error : function(xhr , status , error){
                            console.log('Error in code ') ;
                            Swal.fire("Error" ,'Something went wrong' ,'error');
                            hideLoader();
                        }})  
                        }
        });

  
});


$(document).on('click' ,'.delete_leads_permanet' ,function(){
    let all_ids = getAllCheckedValue(); 
    
    Swal.fire({
            title: 'Are you sure?',
            text: 'Want to delete leads',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, continue!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if(result.isConfirmed){}
              showLoader();
               $.ajax({
              url : 'deleteAllLeadsParmanet',
              method : "POST", 
              data : {
                 all_ids : all_ids 
              } ,
              success : function(reponse){
                removeElements();
                getDeletedData();
                hideLoader();
              },
              error : function(xhr , status , error){
                  console.log('Error in code ') ;
                  Swal.fire("Error" ,'Something went wrong' ,'error');
                 hideLoader();
              }})

        });

  

    
});

function getAllCheckedValue(){
    let arr = [];
    $('table').find('.select_checkbox:checked').each(function() {
        let data_id = $(this).data('lead_id');
        arr.push(data_id);
    });
    return arr;
}


function removeElements(){
      $('table').find('.select_checkbox:checked').each(function() {
         let ele = $(this); 
         ele.closest('tr').remove();

      }) ;
}