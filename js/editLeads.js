
$(document).on('change' ,'.country_dropdown' ,function(){
    var country = $(this).val();
    GetCity(country);
});

$(document).on('change' ,"input[name='assign_edit']" ,function() {
       if ($("#salesRep_onchange").is(":checked")) {
           console.log("sales rep is checked"); 
           $("#EditLeadModal #salesRepSelect").show();

       } else {
           $("#EditLeadModal #salesRepSelect").hide();
       }
       if ($("#EditLeadModal #shareLead").is(":checked")) {
           $("#EditLeadModal #shareLeadSelect").show();
       } else {
           $("#EditLeadModal #shareLeadSelect").hide();
       }
});
 
// submit edit form 

$(document).on('submit' ,'#EditForm' ,function(event){
       event.preventDefault(); 
        let data = $(this).serialize(); 
        let url = $(this).attr('action'); 
        let method = $(this).attr('method'); 
        let form = $(this);
        console.warn("URL methid" , data  , url);
        $.ajax({
        url : url , 
        method : method , 
        data : data ,
        success : function(response){
     let resp = JSON.parse(response);  
  
     
     $('#EditLeadModal').modal('hide'); 
     Swal.fire({
            title: 'Lead updated successfully',
            icon: 'success',
            confirmButtonText: 'Got it!'
        });
     if(resp.is_dashboard!=0){
      
        let tab =   $('#recentLeadsTabs .tab_btn.active').attr('data-value');
        let week =  $('.recentLeads .select_recent_leads_week').val(); 
        let page  = $('#recentLeadsTabContent .paginationBtns.active').attr('href');
     
         getReacentLeads(tab ,week ,page); 
         getUnassignedLeads();

     }else{
          let month = $('#month_filter').val(); 
          let sales_person = $('.sales_person_selection').val(); 
          let year = $('#date_picker').val(); 

         callDatatable(global_status ,month ,sales_person ,year ,CurrentPage); 
     }
     form[0].reset(); 
},
error : function(xhr , status , error){
     console.log("Error " +error);
} 

});
});
