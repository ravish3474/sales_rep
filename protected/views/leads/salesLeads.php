<?php

$all_count_value = TblLeads::GetCountValuesAdmin();
$all_leads_count = $all_count_value[0];


$new_leads_count = $all_count_value[1];

$follow_up_count = $all_count_value[2];

$closed_count = $all_count_value[3];

$hold_count = $all_count_value[4];
$rejected_count = $all_count_value[5];

$state_name  = isset($_GET['state_name']) ? $_GET['state_name'] : 0;
?>

<style>
    .dataTables_filter label {
        position: absolute;
        right: 8px;
        top: -39px;
        display: flex;
        gap: 10px;
    }

    .dataTables_filter label input {
        border-radius: 2px;
    }

    .nav-tabs {
        border-bottom: 0;
    }

    .dataTables_info {
        margin: 20px 0;
    }
    .hideNumberBadeg{
         display: none !important; 
    }

    .all_leads_tbody .table-responsive {
    overflow-x: auto !important;
    scrollbar-width: thin;
}
</style>


<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12  ">
            <div class="x_panel">


                <div class="firstScreen">
                    <div class="pageHeader">

                        <h5 class="xlSize  pageTitle  ">My Leads (<?php echo $all_leads_count; ?>)</h5>
                    </div>
                    <div class="recentLeads">
                        <div class="d-flex between">
                            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                <li class="nav-item active" role="presentation">
                                    <a class="nav-link active tab_links_click" data-status="All" id="home-tab" data-toggle="tab" href="#all_leads_section" role="tab" aria-controls="home" aria-selected="true" aria-expanded="true">All
                                        <span class="numberBadge <? echo $all_leads_count ? '' :'hideNumberBadeg' ?>"><?php echo $all_leads_count ?></span>

                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link tab_links_click" data-status="0" data-count="<?php echo $new_leads_count ?>" id="new-leads-tab" data-toggle="tab" href="#new-leads" role="tab" aria-controls="new-leads" aria-selected="false" aria-expanded="false">New Leads
                                           <span class="numberBadge <? echo $new_leads_count ? '' :'hideNumberBadeg' ?>"><?php echo $new_leads_count ?></span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link tab_links_click" data-status="1" id="follow-up-tab" data-toggle="tab" href="#follow-up" role="tab" aria-controls="follow-up" aria-selected="false" aria-expanded="false">Follow-up
                                         <span class="numberBadge <? echo $follow_up_count ? '' :'hideNumberBadeg' ?>"><?php echo $follow_up_count ?></span>

                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link tab_links_click" data-status="2" id="closed-tab" data-toggle="tab" href="#closed" role="tab" aria-controls="closed" aria-selected="false" aria-expanded="false">Closed
                                      <span class="numberBadge <? echo $closed_count ? '' :'hideNumberBadeg' ?>"><?= $closed_count ?></span>
                                       
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link tab_links_click" data-status="3" id="on-hold-tab" data-toggle="tab" data-count="<?php echo $hold_count ?>" href="#on-hold" role="tab" aria-controls="on-hold" aria-selected="false" aria-expanded="false">On-Hold 
                                         <span class="numberBadge <? echo $hold_count ? '' :'hideNumberBadeg' ?>"><?= $hold_count ?></span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link tab_links_click" data-status="4" id="rejected-tab" data-toggle="tab" href="#rejected" role="tab" aria-controls="rejected" aria-selected="false" aria-expanded="false">Rejected
                                        <span class="numberBadge <? echo $rejected_count ? '' :'hideNumberBadeg' ?>"><?php echo $rejected_count ?></span>
                                    </a>
                                </li>
                            </ul>

                            <div class="d-flex">
                                    <button class="d-btn greenBtn" type="button" data-toggle="modal" data-target="#newLeadModal">
                                        <figure><img src="../images/icons/pulsWhite.png" alt=""></figure> New Lead
                                    </button>

                                
                                    <button class="greenBtn export_excel d-btn"  type="button">  
                                         <figure><img src="../images/icons/uiw_file-excel.png" alt=""></figure>
                                         Excel
                                    </button>
                             </div>
                        </div>


                        <div class="tableHeader d-flex between">
                            <div class="d-flex gap2">
                                <figure><img src="../images/icons/filterIcon.png " alt="" class="iconImg"></figure>
                                <h6>
                                    Filter by :
                                </h6>
                                <select class="form-select text-left " id="month_filter" aria-label="Default select example">
                                    <option value="">Select Month</option>
                                    <?
                                    foreach (MONTH_FILTER as $month_key => $month_value) {
                                    ?>
                                        <option value="<? echo $month_key ?>"
                                            <?
                                         
                                            ?>> <? echo $month_value ?></option>
                                    <?
                                    }

                                    ?>
                                </select>

                                <input type="text" name="date_picker" id="date_picker" value="<? echo date('Y') ?>">
                                <select class="form-select text-left sales_person_selection" aria-label="Default select example">
                                    <option value="">Select Sales Rep</option>
                                    <?php
                                    foreach ($salesPerson as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value['username'] ?>"><?php echo $value['fullname'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>

                            </div>
                            <div>
                                <input type="text" name="search" id="search_box" value="" placeholder="Search Here">
                            </div>

                            <div>

                            </div>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content mt-3" id="recentLeadsTabContent">

                            <!-- All Leads -->
                            <div class="tab-pane active" id="all_leads_section" role="tabpanel" aria-labelledby="home-tab">
                                <div class="all_leads_tbody"></div>
                            </div>
                            <!----  -->

                            <!-- New leads tab pane -->
                            <div class="tab-pane fade" id="new-leads" role="tabpanel" aria-labelledby="new-leads-tab">
                                <div class="all_leads_tbody"></div>

                            </div>
                            <!--  -->


                            <!--Follow up tab pane   -->
                            <div class="tab-pane fade" id="follow-up" role="tabpanel" aria-labelledby="follow-up-tab">
                                <div class="all_leads_tbody"></div>

                            </div>
                            <!--  -->


                            <!--Closed Leads   -->
                            <div class="tab-pane fade" id="closed" role="tabpanel" aria-labelledby="closed-tab">
                                <div class="all_leads_tbody"></div>

                            </div>
                            <!--  -->

                            <!-- Hold Leads -->
                            <div class="tab-pane fade" id="on-hold" role="tabpanel" aria-labelledby="on-hold-tab">
                                <div class="all_leads_tbody"></div>

                            </div>
                            <!--  -->

                            <!-- Rejected Leads -->
                            <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                                <div class="all_leads_tbody"></div>

                            </div>
                            <!-- --- -->
                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- newLeadModal  -->
<div class="modal fade smallModal" id="newLeadModal" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- modal header  -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title  ">Add New Lead </h4>
            </div>
            <form action="<?php echo Yii::app()->createUrl('leads/createLead'); ?>" method="post"   id="add_new_lead">

                <div class="modal-body">
                    <div class="grid2">
                        <div class="form-group">
                            <label for="Team-Association-Company" class="blackLabel">Team / Association / Company</label>
                            <input type="text" class="form-control" name="TblLeads[TAC_name]" id="Team-Association-Company" placeholder="Enter company name">
                        </div>
                        <div class="form-group ">
                            <label for="email" class="blackLabel">Product</label>
                            <select class=" form-select assignedTo text-left" name="TblLeads[pro_name]" aria-label="Default select example">
                                <option selected="">Select Product</option>
                                <?php
                                foreach ($product as $key => $value) {
                                ?>
                                    <option value="<?php echo $value['prod_id'] ?>"> <?php echo $value['prod_name'] ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Name" class="blackLabel">Name</label>
                            <input type="text" name="TblLeads[name]" class="form-control" id="Name" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="Name" class="blackLabel">Last Name</label>
                            <input type="text" name="TblLeads[last_name]" class="form-control" id="Name" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="PNumber" class="blackLabel">Phone Number</label>
                            <input type="number" name="TblLeads[phone_no]" class="form-control" id="PNumber" placeholder="Enter Number">
                        </div>
                        <div class="form-group">
                            <label for="email" class="blackLabel">Email</label>
                            <input type="email" name="TblLeads[email]" class="form-control" id="Name" placeholder="Enter Email">
                        </div>

                        <div class="form-group">
                            <label for="country_name" class="blackLabel">Country</label>
                            <select class="form-select assignedTo text-left country_dropdown" name="TblLeads[country_name]" aria-label="Default select example">
                                <option value="">Select Country</option>
                                <?php
                                foreach ($countryName as $country) {

                                ?>
                                    <option value="<?php echo  $country['country_name'] ?>" style="text-transform:capitalize;"><?php echo $country['country_name'] ?></option>
                                <?

                                }
                                ?>

                            </select>
                        </div>

                        <div class="form-group get_city_state">
                            <label for="state_name" class="blackLabel">State</label>
                            <select class="form-select assignedTo text-left state_dropdown" name="TblLeads[state_name]" aria-label="Default select example">
                                <option value="">Select State</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="QTY" class="blackLabel">QTY</label>
                            <input type="number" class="form-control" id="QTY" name="TblLeads[qty]" placeholder="Enter QTY">
                        </div>
                        <div class="form-group">
                            <label for="DueDate" class="blackLabel">Due Date</label>
                            <input type="date" class="form-control" min="<?php echo date('Y-m-d') ?>" id="DueDate" name="TblLeads[due_date]" placeholder="Enter Due Date">
                        </div>
                        <div class="form-group column2">
                            <label for="Project Overview" class="blackLabel">Project Overview</label>
                            <textarea id="" name="TblLeads[description]" placeholder="Tell us about your project..."></textarea>
                        </div>
                        <div class="form-group column2">
                            <label for="Assign to" class="blackLabel">Assign to : </label>
                            <div class="grid3">
                                <div class="items">
                                    <input type="radio" id="none" name="assign" value="none" checked>
                                    <label for="none">Me</label>
                                </div>
                                <div class="items">
                                    <input type="radio" id="salesRep" name="assign" value="salesRep">
                                    <label for="salesRep">Assign to Sales Rep</label>
                                </div>
                                <div class="items">
                                    <input type="radio" id="shareLead" name="assign" value="shareLead">
                                    <label for="shareLead">Share Lead</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group column2" id="salesRepSelect" style="display: none;">
                            <div>
                                <label for="Assign to" class="blackLabel">Assign to : </label>
                                <select class=" form-select assignedTo text-left" name="TblLeads[assigned_to]" aria-label="Default select example">
                                    <option value>Select Sales Rep</option>
                                    <?php
                                    foreach ($salesPerson as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value['username'] ?>"> <?php echo $value['fullname'] ?> </option>
                                    <?php

                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="items text-left" id="shareLeadSelect" style="display: none;">
                            <h6>Assigned to</h6>
                            <select class="js-select2" multiple="multiple" name="multipleAssignedTo[]">
                                <?php
                                foreach ($salesPerson as $key => $value) {
                                ?>
                                    <option value="<?php echo $value['username'] ?>" data-badge=""> <?php echo $value['fullname'] ?> </option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default  btn-success">Add</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>
<!--  -->

<!-- Edit lead modal  -->
<div class="modal fade smallModal" id="EditLeadModal" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- modal header  -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title  "> Edit Lead </h4>
            </div>

            <div class="edit_output_div">


            </div>

        </div>

    </div>
</div>


<!-- Modal for follow up date  -->
<div class="modal fade smallModal" id="followUpDateModal" role="dialog">
    <div class="modal-dialog  d-flex " style="height:100%; max-width:30%  !important ; ">
        <!-- Modal content-->
        <form id="follow_up_date_form" method="post" style="width: 100%;">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- modal header  -->
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Follow Up</h4>
                </div>

                <div class="edit_output_div">
                    <input type="date" name="follow_up_date" id="follow_up_date">
                </div>

                <input type="hidden" name="lead_id" id="follow_up_lead_id">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Add</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>


  <!-- Modal for assigned sales rep  -->
  <div class="modal fade salesRepModal" id="salesRepModal" tabindex="-1" role="dialog" aria-labelledby="salesRepModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="salesRepModalLabel">Assigned Sales Reps</h5>
                                                <button type="button" class="close  hideSaleRepModal" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="innerBox">
                                                    <div class="middle">
                                                        <div class="addAdmin">
                                                            <div class="selectOption multiselectMain selection_dropdown">
                                                                <form action="">
                                                                    <button type="button" class="d-btn w-100 bg-none multiDropdownBtn">
                                                                    <?php echo empty($value['assigned_to']) ? 'Select sales rep' : $value['assigned_to'] ?>
                                                                        <figure><img src="../../images/icons/blackDropdown.png" alt=""></figure>
                                                                    </button>
                                                                    <div class="multiselectDropdown" style="display: none;">
                                                                        <div class="searchBox">
                                                                            <figure class="actionBtns"><img src="../images/icons/searchIconGrey.png" alt=""></figure>
                                                                            <input type="text" name="search_name" id="search_name" placeholder="Search" 
                                                                             data-lead_id ="" data-saleperson =""
                                                                            >
                                                                        </div>
                                                                        <div class="allMultiList">
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <input type="hidden" name="lead_id_assign" id="lead_id_assign" value="">

                                                            </div>
                                                        </div>
                                                        <div class="totalAssignedAdmin">
                                                            <!-- Additional content if needed -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex">

                                                <button type="button" class="d-btn  hideSaleRepModal" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="d-btn greenBtn savebtn" data-lead_id="" data-dismiss="modal">Save</button>
                                            </div>
                                        </div>
                                    </div>
  </div>
  <!--  -->


<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$current_url = $protocol . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/Leads_events.js?var=90" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/editLeads.js?var=31" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>



<script>
    function callDatatable(status = 'All', month = '<? echo date('m') ?>', sales_person = 0, year = <? echo date('Y') ?> ,CurrentPage ,search=0 ,state_name = "<? echo $state_name ?>") {
        showLoader();
        $.ajax({
            url: 'getAjaxTable',
            method: 'POST',
            data: {
                id: '1',
                status: status,
                month: month,
                sales_person: sales_person,
                year: year,
                page : CurrentPage,
                search:search,
                state_name:state_name
            },
            success: function(response) {
                let resp = JSON.parse(response);
            

                var activeTabId = '';
                $('.tab-pane').each(function() {
                    if ($(this).hasClass('active')) {
                        activeTabId = $(this).attr('id');
                    }
                });
                $('#' + activeTabId + ' .all_leads_tbody').html(resp.html);


                var table = $('#' + activeTabId + ' table');

                  window.lastTableHtml = resp.html;

                // table.DataTable({
                //     "paging": false,
                //     "searching": true,
                //     "destroy": true , 
          
                // });

                let count = resp.data_count; 
                $('.numberBadge').each(function(key){
                    if(count[key]>0){
                          $(this).removeClass('hideNumberBadeg');
                    }else{
                        $(this).addClass('hideNumberBadeg');                         
                    }
                     $(this).html(count[key])
                });
                hideLoader();

            },
            error: function(xhr, status, error) {
                hideLoader();
                Swal.fire({
                    title: 'Can not get any data',
                    icon: 'warning',
                    confirmButtonText: 'Got it!'
                });
            }
        })
    }



// $(document).on('click', '.export_excel', function () {

//     let activeTabId = $('.tab-pane.active').attr('id');
//     let table = $('#' + activeTabId + ' table')[0];

//     if (!table) {
//         alert('No table found');
//         return;
//     }

//     let clonedTable = $(table).clone();

//     // ✅ Replace dropdowns
//     clonedTable.find('select').each(function () {
//         let text = $(this).find('option:selected').text();
//         $(this).replaceWith(text);
//     });

//     // 🔥 Fix Assigned To column (IMPORTANT FIX)
                
//         clonedTable.find('td').each(function () {
//             let btn = $(this).find('button');

//                     if (btn.length) {
//                         let text = btn.clone()
//                             .children()
//                             .remove()
//                             .end()
//                             .text()
//                             .trim();

//                         // 🔥 Remove "+ number"
//                         text = text.replace(/\+\s*\d+/g, '').trim();

//                         $(this).html(text);
//                     }
//         });

//     // ✅ Remove unwanted elements AFTER extracting text
//     clonedTable.find('input, button, a, img, figure').remove();

//      //Remove first 2 columns
//     clonedTable.find('tr').each(function () {
//         $(this).find('th, td').slice(0, 2).remove();
//     });

//     // Remove last column
//     clonedTable.find('tr').each(function () {
//         $(this).find('th, td').last().remove();
//     });

//     // ✅ Improve header readability
//     clonedTable.find('th').each(function () {
//         $(this).text($(this).text().toUpperCase());
//     });


//     let wb = XLSX.utils.table_to_book(clonedTable[0], { sheet: "Report" });
//     let ws = wb.Sheets["Report"];

//     // 🔥 Ensure cols array exists
//     if (!ws['!cols']) ws['!cols'] = [];

//     //Set width for column G (index 6)
   
//     ws['!cols'][6] = { wch: 10 }; // adjust width as needed
//     ws['!cols'][4] = { wch: 30 };
//     ws['!cols'][3] = { wch: 15 };
//     ws['!cols'][2] = { wch: 10 };


//     XLSX.writeFile(wb, "LeadReport.xlsx");
// });


    $(document).on('click', '.hideSaleRepModal , .savebtn', function(event) {
      // For other checkbox 
      let checkbox =  $('#other_checkbox');
      let isSaveBtn = $(this).hasClass('savebtn');
       if(checkbox.is(':checked')  && isSaveBtn) {
           let name = $('#other_sales_person_div').find('#other_sales_person_name').val(); 
           let email = $('#other_sales_person_div').find('#other_sales_person_email').val(); 
           let is_send_mail = $('#other_sales_person_div') .find('#is_send_email')
            .is(':checked') ? 1 : 0;
           let lead_id = $('#lead_id_assign').val();
           let other_id = $('#other_sales_person_div').find('#other_sales_id').val(); 

           if(name == '' || email ==''){
               alert("Please  enter name and email"); 
              event.preventDefault();
            //   event.stopPropagation(); 
               return false ; 
           }

              $.ajax({
                url: 'SavemultipleSalesRep',
                method: 'POST',
                data: {
                    lead_id: lead_id,
                    name : name , 
                    email : email , 
                    is_send_mail : is_send_mail, 
                    other_id : other_id , 
                    type : 'Other' , 
                },
                success: function(response) {
                    getAllAssignedSaleRep(lead_id);
                    getsalesRepList(lead_id);
                    hideLoader();
                },
                error: function(xhr, status, error) {
                    console.warn("Something went wrong");
                    hideLoader();
                }
            });


       }  
       
    


        let month = $('#month_filter').val();
        let sales_rep = $('.sales_person_selection').val();
        let year = $('#date_picker').val();
        let page = $('.tab-pane.active  .paginationBtns.active').attr('href');

        callDatatable(global_status, month, sales_rep, year, page);
    });


$(document).on('click', '.export_excel', function () {

    let status = global_status ; 
    let month = $('#month_filter').val() || 0;
    let sales_person = $('#sales_person').val() || 0;
    let year = $('#date_picker').val() || <?php echo date('Y'); ?>;
    let search = $('#search').val() || '';

    let date_range = $('#date_range_filter').val() || '';
    let state_name = $('.tab-pane.active').data('state') || '';

        // 🔥 First create form
    let form = $('<form>', {
        action: 'ExportExcel',
        method: 'POST'
    });



    form.append($('<input>', { type: 'hidden', name: 'date_range', value: date_range }));
    form.append($('<input>', { type: 'hidden', name: 'state_name', value: state_name }));

    form.append($('<input>', { name: 'status', value: status }));
    form.append($('<input>', { name: 'month', value: month }));
    form.append($('<input>', { name: 'sales_person', value: sales_person }));
    form.append($('<input>', { name: 'year', value: year }));
    form.append($('<input>', { name: 'search', value: search }));
    

    $('body').append(form);
    form.submit();
    form.remove();
});
    
</script>