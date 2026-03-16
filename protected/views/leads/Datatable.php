<?
// use yii\helpers\Html;
// use yii\widgets\LinkPager;
?>

<style>
    .greenBTn {
        background: #5CB85C;
        color: #FFF;
    }

    #myTabs .nav-link {
        padding: 12px 5px 7px;
    }



    .addAssignArea {
        position: fixed;
        width: 320px;
        background: #3131313D;
        z-index: 10001;
        border-radius: 8px;
        left: 0;
        top: 0;
        border: 1px solid #DDD;
        padding: 18px;
        box-shadow: 0px 5px 6px 2px #0000001A;
        overflow: hidden;
        border: #EBEBEC;
        width: 100%;
        height: 100%;
    }

    .totalAssign {
        white-space: nowrap;
    }

    .addAssignArea .innerBox {
        width: 350px;
        background: #FFF;
        padding: 14px;
        border-radius: 8px;
        margin: auto;
    }

    .totalAssignedAdmin {
        border-top: 1px solid #DDD;
        padding: 10px;
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .addAdmin {
        padding: 15px;
    }

    .addAssignArea .middle {
        border: 1px solid #DDDDDD;
        border-radius: 8px;
        margin: 15px 0;
    }

    .adminItems {
        display: flex;
        justify-content: space-between;
        padding: 5px 2px;
    }

    .totalAssignedAdmin .actionBtns {
        border-radius: 4px;
        border: 1px solid #D9E4EE;
    }

    .adminItems .adminName {
        border: 1px solid #D9E4EE;
        background: #337AB71A;
        padding: 5px 10px;
        border-radius: 8px;
        margin: 0;
    }

    .allMultiList {
        max-height: 170px;
        overflow-y: auto;
        overflow-x: hidden;
        scrollbar-width: none;
    }

    .collapse.in {
        display: flex;
        justify-content: center;
        /* flex-direction: column; */
    }

    .addAssignArea .title {
        font-size: 15px;
        color: #2A3F54;
        font-weight: 500;
    }



    /* pagination  */

    .table-responsive {
        overflow-x: unset;
    }

    /* multiselectMain multiSelect DropdownArea */
    .multiselectMain .checkbox-label {
        display: flex;
        justify-content: space-between;
        font-weight: 500;
        color: #000;
        white-space: nowrap;
        cursor: pointer;
        padding: 4px 12px;
        margin: 5px 0;
        transition: .4s ease;
        transform: scale(1.01);
    }

    .multiselectMain .checkbox-label:hover {
        background: #eee;


    }

    .multiselectMain input {
        width: auto;
    }

    .multiselectMain .searchBox {
        position: relative;
    }

    .multiselectMain {
        border: 1px solid #DDDDDD;
        border-radius: 4px;

    }

    .multiselectMain .searchBox input {
        width: 100%;
        border-top: 1px solid #D9E4EE !important;
        border-bottom: 1px solid #D9E4EE !important;
        background: #EBF2F8 !important;
        position: relative;
        padding-left: 40px;

    }

    .multiselectMain .actionBtns {
        position: absolute;
        top: 8px;
        left: 10px;
        z-index: 1;
    }

    .multiselectMain .multiDropdownBtn {
        border: none !important;
        padding: 8px 12px;
        display: flex;
        justify-content: space-between;
    }

    /* multiselectMain multiSelect DropdownArea */

    .salesRepModal .modal-dialog {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .salesRepModal .modal-content {
        border-radius: 8px;
        overflow: hidden;
        width: 400px;
    }

    .salesRepModal .modal-body {
        width: 400px;
        padding: 0;
    }

    .statusSelectCustom select {
        min-width: 10vw !important;
    }

    .salesRepModal .modal-dialog {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .salesRepModal .modal-content {
        border-radius: 8px;
        overflow: hidden;
        width: 400px;
    }

    .salesRepModal .modal-body {
        width: 400px;
        padding: 0;
    }

    .statusSelectCustom select {
        min-width: 10vw !important;
    }

     .dashboardPage .table-responsive,
    .all_leads_tbody .table-responsive {
        overflow-x: auto !important;
        scrollbar-width: thin;
    }

    .totalAssign {
        padding: 3px 7px;
        margin: 0;
    }

    .tableHeader input,
    .tableHeader select,
    .tableHeader textarea {
        width: auto;
    }

    .tableHeader span {
        font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
    }


    

    @media screen and (max-width:1300px) {

        .tableHeader input,
        .tableHeader select,
        .tableHeader textarea {
            width: 100px;
        }

        input#search_box {
            background: #F4FAFF !important;
            width: 140px;

        }
    }
</style>
<div class="table-responsive ">

    <table class="table table-bordered  all_leads_table">
        <thead>
            <tr>
                <th class="text-center"><input type="checkbox" class="select-item"></th>
                <th class="text-center"> </th>
                <th class="text-center">Product </th>
                <th>Status</th>
                <th>Created Date</th>
                <th>Assigned to</th>
                <th style="white-space: nowrap;">Team / Association / Company</th>
                <th>QTY</th>
                <th>Due Date</th>
                <th>Name & Email</th>
                <th class="text-center">State</th>
                <th class="text-center">Country</th>
                <th class="text-center">City</th>

                <th class="text-center">Project Overview</th>
            </tr>
        </thead>
        <tbody class="">
            <?php



            if (count($adminLeads)):


                $multiple_sales = [];
                foreach ($adminLeads as $key_main => $leads) {
                    $multiple_sales = TblLeads::GetMultipleSalesRepArr($leads['lead_id']);
                    $product = TblLeads::GetPriceDetails($leads['pro_name']);
                    $totalAssigned = TblLeads::GetAllAssignedSalesRepCount($leads['lead_id']);
                    $assigned_sales_person = TblLeads::GetAssignedSalesPerson($leads['lead_id']);
                    $userDetails =  empty(!$assigned_sales_person) ? TblLeads::getSalesPersonDetails($assigned_sales_person) : Null;
            ?>
                    <tr>
                        <td class="text-center"><input type="checkbox" class="select-item"></td>
                        <td>
                            <div class=" m-auto spanStatus  <? echo $leads['lead_type'] == 1  ? 'statusReject' : 'statusSuccess' ?> "></div>
                        </td>
                        <td><?php echo empty($product) ? $leads['pro_name'] : $product;  ?></td>

                        <td class="statusSelectCustom">
                            <select class="form-select w-100 statusSelect  update_status" aria-label="Default select example" id="statusSelect" data-lead_id="<?php echo $leads['lead_id'] ?>">
                                <?

                                foreach ($lead_status as $lead_key => $lead_value) {
                                ?>
                                    <option value="<? echo $lead_key ?>"
                                        <?php if ($leads['status'] == $lead_key) echo 'selected'  ?>
                                        class="<? echo $lead_classes[$lead_key] ?> customOption" data-class="<? echo $lead_classes[$lead_key] ?>"><? echo $lead_value ?></option>
                                <?
                                }
                                ?>




                            </select>
                        </td>


                        <td class="text-center">
                            <?php
                            echo  date('d/m/Y', strtotime($leads['created_at']))
                            ?>

                        </td>
                        <td>
                            <div class="d-flex gap1 position-relative">

                                <button class="d-btn bg-none text-nowrap get_sales_rep_data m-0 W-00  assigned_to_btn  " style="width: 100%;" data-lead_id="<?php echo $leads['lead_id']; ?>" data-toggle="modal" data-assigned_to="<? echo $leads['assigned_to'] ?>">

                                    <?php echo empty($userDetails['fullname']) ? 'Select sales rep' : $userDetails['fullname'] ?>
                                    <figure><img src="../../images/icons/blackDropdown.png" alt=""></figure>
                                </button>



                                <?php if ($totalAssigned > 1) { ?>
                                    <button type="button" class="totalAssign" data-lead_id="<?php echo $leads['lead_id']; ?>" data-toggle="modal" data-assigned_to="<? echo $leads['assigned_to'] ?>">+ <?php echo (int)$totalAssigned - 1; ?></button>
                                <?php } ?>

                            </div>
                        </td>
                        <td>
                            <?php echo $leads['TAC_name'];  ?>
                        </td>
                        <td class="text-center"><?php echo $leads['qty'];  ?></td>
                        <td><?php echo $leads['due_date'];  ?></td>
                        <td>
                            <div class="leadsInfo">
                                <span class="name">
                                    <?php echo $leads['name'];
                                    echo $leads['last_name'];  ?>
                                </span>
                                <span class="email grey"><?php echo $leads['email'];  ?></span>
                            </div>
                        </td>
                        <td><?php echo $leads['state_name'];  ?></td>
                        <td><?php echo $leads['country_name'];  ?></td>
                        <td><?php echo $leads['city'];  ?></td>

                        <td>
                            <div class="actionBtns">


                                <a href="<?php echo Yii::app()->createUrl('leads/viewSalesDetails', array('id' => $leads['lead_id'])); ?>">
                                    <img src="../images/icons/viewBlack.png" alt="">
                                </a>
                                <button data-toggle="modal" data-target="#EditLeadModal" class="edit_lead" data-lead_id="<?php echo $leads['lead_id'] ?>"
                                    data-state="<? echo $leads['state_name'] ?>" data-country="<? echo $leads['country_name'] ?>">
                                    <img src="../images/icons/editBlack.png" alt=""></button>

                                <button class="delete_lead" data-lead_id="<?php echo $leads['lead_id'] ?>"><img src="../images/icons/deleteBlack.png" alt=""></button>
                            </div>
                        </td>
                    </tr>

                <?php
                }
            else:
                ?>
                <tr>
                    <td style="display:none;"></td>
                    <td style="display:none;"></td>
                    <td style="display:none;"></td>
                    <td style="display:none;"></td>
                    <td style="display:none;"></td>

                    <td colspan="13" class="text-center">No record found </td>

                    <td style="display:none;"></td>
                    <td style="display:none;"></td>
                    <td style="display:none;"></td>
                    <td style="display:none;"></td>
                    <td style="display:none;"></td>
                    <td style="display:none;"></td>
                    <td style="display:none;"></td>

                </tr>

            <?php
            endif;

            ?>
        </tbody>


    </table>

</div>

<div class="main_pagination_container d-flex align-items-center" style="justify-content: space-between;">
    <div>
        <p>Showing <? echo $start_number ?> to <? echo $end_number ?> of <? echo $totalDataCounnt ?> entries</p>
    </div>


    <?php
    $buttonsPerPage = 5;
    $currentBlock = ceil($currentPage / $buttonsPerPage);
    $startPage = ($currentBlock - 1) * $buttonsPerPage + 1;
    $endPage = min($startPage + $buttonsPerPage - 1, $totalPages);
    ?>
    <div class="pagination-container">
        <?php if ($currentPage > 1): ?>
            <!-- <button type="button" href="1" class="paginationBtns">First</button> -->
            <button type="button" href="<?= $currentPage - 1 ?>" class="paginationBtns">Previous</button>
        <?php else: ?>
            <span>First</span>
            <span>Previous</span>
        <?php endif; ?>

        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
            <button type="button" href="<?= $i ?>" class="paginationBtns <?= $i == $currentPage ? 'active' : '' ?>">
                <?= $i ?>
            </button>
        <?php endfor; ?>

        <?php if ($endPage < $totalPages): ?>
            <p disable class=" dot_text">....</p>
            <button type="button" href="<?= $endPage + 1 ?>" class="paginationBtns nextBlock">
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            </button>
        <?php endif; ?>

        <?php if ($currentPage < $totalPages): ?>
            <button type="button" href="<?= $currentPage + 1 ?>" class="paginationBtns">Next</button>
            <!-- <button type="button" href="<?= $totalPages ?>" class="paginationBtns">Last</button> -->
        <?php else: ?>
            <span>Next</span>
            <span>Last</span>
        <?php endif; ?>
    </div>
</div>

<!--  -->








<script>
    $('.edit_lead').click(function() {
        let id = $(this).data('lead_id');
        let country = $(this).data('country');
        let state = $(this).data('state');
        $.ajax({
            url: 'editLeadData',
            method: "POST",
            data: {
                id: id,
            },
            success: function(response) {
                $('.edit_output_div').html(response);
                GetCity(country, state);

                $(".js-select2").select2({
                    placeholder: "Select Sales Representatives", // Placeholder text
                    allowClear: true, // Option to clear selections
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Can not update data',
                    icon: 'warning',
                    confirmButtonText: 'Got it!'
                });
            }
        })
    });



    $('.update_status').change(function() {
        let id = $(this).data('lead_id');
        let status = $(this).val();
        let notes = '';
        let originalDate = new Date();
        var date = new Date(originalDate);

        // Format the date in YYYY-MM-DD format
        var formattedDate = date.getFullYear() + '-' +
            ('0' + (date.getMonth() + 1)).slice(-2) + '-' +
            ('0' + date.getDate()).slice(-2);

        if (status == 1) {
            $('#followUpDateModal').modal('show');
            $('#follow_up_lead_id').val(id);
            formattedDate = $('#follow_up_date').val();
        } else {
            SetStatusAjax(id, status, formattedDate, notes);
        }
    });

    $('#follow_up_date_form').submit(function(event) {
        event.preventDefault();
        let date = $('#follow_up_date').val();
        let note = '';
        let id = $('#follow_up_lead_id').val();

        SetStatusAjax(id, 1, date, note);
        swal.fire({
            title: 'Lead follow up is complete',
            icon: 'success',
            confirmButtonText: 'Got it!'
        })

    });


    function SetStatusAjax(id, status, formattedDate, notes) {
        $.ajax({
            url: 'setOtherLeadStatus',
            method: "POST",
            data: {
                lead_id: id,
                other_lead_status: status,
                date: formattedDate,
                notes: notes,
                is_ajax: true,
            },
            success: function(response) {
                $('#followUpDateModal').modal('hide');
                $('#follow_up_date_form')[0].reset();

                let month = $('#month_filter').val();
                let sales_rep = $('.select_sales_rep').val();
                let year = $('#date_picker').val();
                callDatatable(global_status, month, sales_rep, year, CurrentPage);



            },
            error: function(xhr, status, error) {

                Swal.fire({
                    title: 'Can  not change the status',
                    icon: 'warning',
                    confirmButtonText: 'Got it!'
                });
            }

        })

    }

    $('.delete_lead').click(function() {
        let id = $(this).data('lead_id');
        let ele = $(this).closest('tr');
        Swal.fire({
            title: 'Are you sure?',
            text: 'To Delete The Lead!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'SoftdeleteLeads',
                    method: "POST",
                    data: {
                        id: id
                    },
                    success: function(reponse) {
                        // Swal.fire({
                        //     title: 'Admin Leads Deleted Successfully',
                        //     icon: 'Success',
                        //     confirmButtonText: 'Got it!'
                        // });

                        ele.remove();



                    },
                    error: function(xhr, status, error) {
                        console.log('Error in code ');

                    }

                })

            }
        });

    });


    $('.select_sales_rep').change(function() {
        var id = $(this).data('leads_id');
        var sales_rep = $(this).val();
        let ele = $(this).closest('tr');
        $.ajax({
            method: "POST",
            url: 'updateLeadSalesRep',
            data: {
                id: id,
                sales_rep: sales_rep
            },
            success: function(response) {
                console.log(response);
                callDatatable();

                // ele.remove();

            }
        });

    });

    $(document).ready(function() {
        SelectLeadClasses();
    });

    $('.paginationBtns').click(function(event) {
        event.preventDefault();
        let page = $(this).attr('href');
        let month = $('#month_filter').val();
        let sales_person = $('.sales_person_selection').val();
        let year = $('#date_picker').val();
        CurrentPage = page;
        callDatatable(global_status, month, sales_person, year, page);
    });
</script>

<script>
    $(document).on('click', '.assigned_to_btn , .totalAssign', function() {
        let lead_id = $(this).data('lead_id');
        let salesPerson = $(this).data('assigned_to');
        var modal = $('#salesRepModal');
        modal.modal('show');
        getsalesRepList(lead_id, salesPerson)
        $('.savebtn').attr('data-lead_id', lead_id);
        $('#search_name').attr('data-lead_id', lead_id);
        $('#search_name').attr('data-saleperson', salesPerson);

        let id = $(this).data('lead_id');
        getAllAssignedSaleRep(id);
        $('#lead_id_assign').val(id);


    });

    function getsalesRepList(lead_id, salesPerson, search = 0) {
        showLoader();
        $.ajax({
            url: 'getallAssignedSalesRep',
            method: 'POST',
            data: {
                lead_id: lead_id,
                salesPerson: salesPerson,
                search: search
            },
            success: function(response) {
                $('.allMultiList').html(response);
                hideLoader();
            },
            error: function() {
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
                    icon: 'warning',
                });
                hideLoader();

            }
        })
    }

    // search 
    $(document).on('input', '#search_name', function() {
        let lead_id = $(this).data('lead_id');
        let salesPerson = $(this).data('saleperson')
        let search = $(this).val();

        getsalesRepList(lead_id, salesPerson, search);
    });




    // $('.savebtn').click(function() {
    //     let lead_id = $(this).data('lead_id');
    //     let checked_values = GetCheckedValues();

    //     $.ajax({
    //         url: 'SavemultipleSalesRep',
    //         method: 'POST',
    //         data: {
    //             lead_id: lead_id,
    //             all_values: checked_values,
    //         },
    //         success: function(response){
    //             getAllAssignedSaleRep(lead_id);
    //         },
    //         error: function(xhr, status, error) {
    //             console.warn("Something went wrong");
    //         }
    //     });

    // });

    // before ---- March 22 2025

    // $(document).on('change', '.sales_rep_checkbox', function() {
    //     var isChecked = $(this).prop('checked');

    //     if (!isChecked) {
    //     //  on checked remove delete the 

    //         $(this).removeAttr('checked'); // This removes the checked state

    //     } else {
    //         $(this).prop('checked', true); // Ensure it is checked
    //     }
    // });




    function GetCheckedValues() {
        let checkedValues = [];
        $('.sales_rep_checkbox').each(function() {
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
                        salesPerson:salesPerson, 
                        lead_id : lead_id ,
                    },
                    success: function(reponse) {
                        // Swal.fire({
                        //     title: 'Sales person deleted successfully',
                        //     icon: 'success',
                        //     confirmButtonText: 'Got it!'
                        // });

                        getAllAssignedSaleRep(lead_id);
                        getsalesRepList(lead_id, salesPerson)

                    },
                    error: function(xhr, status, error) {
                        console.log('Error in code ');

                    }

                })

            }
        });



    });

    $(document).on('click', '.hideSaleRepModal , .savebtn', function() {
        let month = $('#month_filter').val();
        let sales_rep = $('.sales_person_selection').val();
        let year = $('#date_picker').val();
        let page = $('.tab-pane.active  .paginationBtns.active').attr('href');

        callDatatable(global_status, month, sales_rep, year, page);
    });


    $(document).on('change', '.sales_rep_checkbox', function() {
        var isChecked = $(this).prop('checked');
        var multiple_id = $(this).data('multiple_id');
        var main_id = $(this).data('main_id');


        if (isChecked) {
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
        } else {
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
                success: function(response) {
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
</script>