<?php

$status_class = [
    '0' => 'greenOption',
    '1' => 'blueOption ',
    '3' => 'yellowOption ',
    '2' => 'purpleOption',
    '4' => 'redOption ',

]

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
        min-width: 100px !important;
    }

    .assignedBtnTd .d-btn {
        width: 100% !important;
    }

    .totalAssign {
        min-height: 30px;
        margin: 0;
    }
</style>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center"><input type="checkbox" class="select-item  main_checkbox_item"></th>
                <th> </th>
                <th>Status</th>
                <th>Created Date</th>
                <th class="assignToTh">Assigned to</th>
                <th>Name & Email</th>
                <th>Country</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?
            if (count($data)):
                foreach ($data as $key => $value) {
                    $multiple_sales = TblLeads::GetMultipleSalesRepArr($value['lead_id']);
                    $product = Yii::app()->db->createCommand("SELECT prod_name FROM tbl_product WHERE prod_id ='" . $value['pro_name'] . "'")->queryScalar();
                    $totalAssigned = TblLeads::GetAllAssignedSalesRepCount($value['lead_id']);


                    $assigned_sales_person = TblLeads::GetAssignedSalesPerson($value['lead_id']);

                    $userDetails =  empty(!$assigned_sales_person) ? TblLeads::getSalesPersonDetails($assigned_sales_person) : Null;

                //  echo $totalAssigned ;
                    
                 

            ?>
                    <tr>
                        <td class="text-center"><input type="checkbox"  data-lead_id="<?=$value['lead_id']?>" class="select-item select_checkbox"></td>
                        <td>
                            <div class=" m-auto spanStatus  <? echo $value['lead_type'] == 1  ? 'statusReject' : 'statusSuccess' ?> "></div>
                        </td>
                        <td class="statusSelectCustom">
                            <select class="form-select w-100 statusSelect  update_status" aria-label="Default select example" id="statusSelect" data-lead_id="<?php echo $value['lead_id'] ?>">
                                <?
                                foreach ($lead_status as $lead_key => $lead_value) {
                                ?>
                                    <option class=" <? echo $status_class[$lead_key] ?>  customOption"
                                        data-class="<? echo $status_class[$lead_key] ?>" value="<? echo $lead_key ?>"
                                        <?
                                        if ($lead_key == $value['status']) {
                                            echo 'selected';
                                        }
                                        ?>> <? echo $lead_value ?></option>
                                <?
                                }
                                ?>
                            </select>
                        </td>
                        <td><? echo date('d/m/Y', strtotime($value['created_at']))  ?></td>
                        <td>
                            <div class="d-flex gap1 position-relative assignedBtnTd">

                                <button class="d-btn bg-none text-nowrap  m-0 W-100  assigned_to_btn" data-lead_id="<?php echo $value['lead_id']; ?>" data-toggle="modal" data-assigned_to="<? echo $value['assigned_to'] ?>">

                                    <?php echo empty($userDetails['fullname']) ? 'Select sales rep' : $userDetails['fullname'] ?>


                                    <figure><img src="../../images/icons/blackDropdown.png" alt=""></figure>
                                </button>



                                  <?php if ($totalAssigned > 1) { ?>
                                      <button type="button" class="totalAssign  assigned_to_btn"   data-lead_id="<?php echo $value['lead_id']; ?>" data-toggle="modal" data-assigned_to= "<? echo $value['assigned_to'] ?>">+
                                     <?php echo (int)$totalAssigned-1; ?></button>
                                            <?php } ?>

                            </div>
                        </td>
                        <td>
                            <div class="leadsInfo">
                                <span class="name">
                                    <? echo $value['name'] ?>
                                </span>
                                <span class="email"><? echo $value['email']  ?>


                                </span>
                            </div>
                        </td>
                        <td> <? echo $value['country_name'] ?></td>
                        <td>
                            <div class="actionBtns">

                                <a href="<?php echo Yii::app()->createUrl('leads/viewSalesDetails', array('id' => $value['lead_id'])); ?>">
                                    <img src="../images/icons/viewBlack.png" alt="">
                                </a>
                                <button data-toggle="modal" data-target="#EditLeadModal" class="edit_lead" data-lead_id="<?php echo $value['lead_id'] ?>"
                                    data-state="<? echo $value['state_name'] ?>" data-country="<? echo $value['country_name'] ?>">
                                    <img src="../images/icons/editBlack.png" alt=""></button>

                                <button class="delete_lead" data-lead_id="<?php echo $value['lead_id'] ?>"><img src="../images/icons/deleteBlack.png" alt=""></button>
                            </div>
                        </td>
                    </tr>
                <?

                }
            else:
                ?>
                <tr>
                    <td colspan="8" class="text-center">No record found</td>
                </tr>
            <?
            endif;

            ?>


        </tbody>
    </table>


</div>

<div class="pagination-container">
    <?php if ($currentPage > 1): ?>
        <button type="button" href="1" class="paginationBtns">First</button>
        <button type="button" href="<?= $currentPage - 1 ?>" class="paginationBtns">Previous</button>
    <?php else: ?>
        <span>First</span>
        <span>Previous</span>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <button type="button" href="<?= $i ?>" class="paginationBtns <?= $i == $currentPage ? 'active' : '' ?>">
            <?= $i ?>
        </button>
    <?php endfor; ?>

    <?php if ($currentPage < $totalPages): ?>
        <button type="button" href="<?= $currentPage + 1 ?>" class="paginationBtns">Next</button>
        <button type="button" href="<?= $totalPages ?>" class="paginationBtns">Last</button>
    <?php else: ?>
        <span>Next</span>
        <span>Last</span>
    <?php endif; ?>
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



<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/editLeads.js?var=99" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        SelectLeadClasses();
    });

    $('.edit_lead').click(function() {
        let id = $(this).data('lead_id');
        let country = $(this).data('country');
        let state = $(this).data('state');

        $.ajax({
            url: 'editLeadData',
            method: "POST",
            data: {
                id: id,
                is_dashboard: true,
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



    // confirm delete button 
    $('.delete_lead_confirm').click(function() {
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
                    url: 'deleteLeads',
                    method: "POST",
                    data: {
                        id: id
                    },
                    success: function(reponse) {
                        // Swal.fire({
                        //     title: 'Admin Leads Deleted Successfully',
                        //     icon: 'success',
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
    // 

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
                        //     icon: 'success',
                        //     confirmButtonText: 'Got it!'
                        // });

                        ele.remove();
                        getDeletedData();

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
                ele.remove();

            }
        });

    });






    // status update 
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
                let page = $('.paginationBtns.active').attr('href');
                let tab = $('.tab_btn.active').attr('data-value');
                let week = $('.recentLeads .select_recent_leads_week').val();

                getReacentLeads(tab, week, page);
                getUnassignedLeads();



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
</script>