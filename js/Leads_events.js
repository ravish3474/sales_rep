var global_status = 'All'; 
var CurrentPage = 1; 

const selects = document.querySelectorAll('.statusSelect');
selects.forEach(select => {
    select.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        this.classList.remove('greenOption', 'purpleOption', 'redOption', 'yellowOption', 'blueOption');
        if (selectedOption.classList.contains('greenOption')) {
            this.classList.add('greenOption');
        } else if (selectedOption.classList.contains('purpleOption')) {
            this.classList.add('purpleOption');
        } else if (selectedOption.classList.contains('redOption')) {
            this.classList.add('redOption');
        } else if (selectedOption.classList.contains('yellowOption')) {
            this.classList.add('yellowOption');
        } else if (selectedOption.classList.contains('blueOption')) {
            this.classList.add('blueOption');
        }
    });
});


$(".js-select2").select2({
    closeOnSelect: false,
    placeholder: "Assigned to..",
    allowHtml: true,
    allowClear: true,
    tags: true
});

function iformat(icon, badge, ) {
    var originalOption = icon.element;
    var originalOptionBadge = $(originalOption).data('badge');

    return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '<span class="badge">' + originalOptionBadge + '</span></span>');
}


$(document).ready(function() {
    $("input[name='assign']").change(function() {
        if ($("#salesRep").is(":checked")) {
            $("#salesRepSelect").show();
        } else {
            $("#salesRepSelect").hide();
        }
        if ($("#shareLead").is(":checked")) {
            $("#shareLeadSelect").show();
        } else {
            $("#shareLeadSelect").hide();
        }
    });
    let month = $('#month_filter').val();
    callDatatable('All' , month);

    $(document).ready(function(){
        $('#date_picker').datepicker({
            format: "yyyy",        // Show only the year format
                viewMode: "years",     // Show only the year view
                minViewMode: "years",  // Limit the view to only year
                autoclose: true   
            });
    });
    

});


$('.country_dropdown').change(function(){
     showLoader();
    var country = $(this).val();
    GetCity(country);
    hideLoader();
});





$('.tab_links_click').click(function(){
    let status = $(this).data('status'); 
  
    global_status=status;
    let month = $('#month_filter').val(); 
    let sales_person  = $('.sales_person_selection').val(); 
    let year = $('#date_picker').val(); 
    callDatatable(status ,month , sales_person , year); 
    
}); 


$('#month_filter').change(function(){
 
     let sales_person = $('.sales_person_selection').val(); 

     let month = $(this).val(); 
     callDatatable(global_status, month ,sales_person);

});

$('.sales_person_selection').change(function(){
   let sales_person = $(this).val(); 
   let month  = $('#month_filter').val(); 

   callDatatable(global_status, month ,sales_person);

});

$('#date_picker').change(function(){
    let month = $('#month_filter').val();
    let sales_person = $('.sales_person_selection').val(); 
    let year = $(this).val(); 
   
   callDatatable(global_status , month , sales_person ,year);
});



$(document).on('submit' ,'#add_new_lead' ,function(event){
    event.preventDefault();
    let form = $(this);  
    let action =  form.attr('action'); 
    let method = form.attr('method');
    let data = form.serialize(); 
    $.ajax({
        type: method ,
        url:  action ,  // specify the URL to handle the update
        data: data,
    success: function(response) {
        let month = $('#month_filter').val(); 
        let date_picker = $('#date_picker').val();
        let sales_person = $('.sales_person_selection').val(); 
        let search = $('#search_box').val();
        callDatatable(global_status , month ,sales_person ,date_picker  , CurrentPage ,search);

            $('#newLeadModal').modal('hide');
        form[0].reset();
    },
    error: function(xhr, status, error) {
        // Handle errors if any
        console.error(xhr.responseText);
    }                                                                        
    });


});



