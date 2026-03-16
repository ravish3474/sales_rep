<style>
    .read_only_select{


    }

    
</style>
<div class="table-responsive">

    <table class="table table-bordered  all_leads_table">
        <thead>
            <tr>
                <th class="text-center"><input type="checkbox" class="select-item main_checkbox_item"></th>
                <th class="text-center"> </th>
              
                <th>Status</th>
                <th>Created Date</th>
                <th>Assigned to</th>
                <th>Team / Association / Company</th>
                <th>QTY</th>
                <th>Due Date</th>
                <th>Name & Email</th>
                <th class="text-center">State</th>
                <th class="text-center">Country</th>
                <th>Deleted By</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody class="">
            <?php



            if (count($data)):
                $multiple_sales = [];
                foreach ($data as $key_main => $leads) {
                    $multiple_sales = TblLeads::GetMultipleSalesRepArr($leads['lead_id']);
                    $product = Yii::app()->db->createCommand("SELECT prod_name FROM tbl_product WHERE prod_id ='" . $leads['pro_name'] . "'")->queryScalar();
                    $totalAssigned = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_leads_multiple WHERE lead_id ='" . $leads['lead_id'] . "'")->queryScalar();
                    $user_details = TblLeads::getSalesPersonDetails($leads['deleted_by']);
                    $user =  empty(!$leads['assigned_to']) ? TblLeads::getSalesPersonDetails($leads['assigned_to']) :Null; 

            ?>
                    <tr>
                        <td class="text-center"><input type="checkbox"   class="select-item select_checkbox" data-lead_id = "<?=$leads['lead_id']?>"></td>
                        <td>
                        <div class=" m-auto spanStatus  <? echo $leads['lead_type'] ==1  ? 'statusReject' :'statusSuccess' ?> "></div>

                        </td>
              

                        <td class="statusSelectCustom">
                            <div class="read_only_select">
                            <select class="form-select w-100 statusSelect  update_status" aria-label="Default select example" id="statusSelect" data-lead_id="<?php echo $leads['lead_id'] ?>" disabled>
                                <?

                                foreach (LEAD_STATUS as $lead_key => $lead_value) {
                                ?>
                                    <option value="<? echo $lead_key ?>"
                                        <?php if ($leads['status'] == $lead_key) echo 'selected'  ?>
                                        class="<? echo LEAD_CLASSES[$lead_key] ?> customOption" data-class="<? echo LEAD_CLASSES[$lead_key] ?>"><? echo $lead_value ?></option>
                                <?
                                }
                                ?>



                                </select>
                                </div>
                        </td>


                        <td class="text-center">
                            <?php
                            echo  date('d/m/Y', strtotime($leads['created_at']))
                            ?>

                        </td>
                        <td>
                            <div class="d-flex gap1 position-relative" style="pointer-events: none;">

                                <button class="d-btn bg-none text-nowrap get_sales_rep_data m-0 W-00  assigned_to_btn  " style="width: 100%;" data-lead_id="<?php echo $leads['lead_id']; ?>" data-toggle="modal" data-assigned_to= "<? echo $leads['assigned_to'] ?>" >

                                <?php echo empty($user['fullname']) ? 'Select sales rep' : $user['fullname'] ?>
                                    <figure><img src="../../images/icons/blackDropdown.png" alt=""></figure>
                                </button>

                              

                                <?php if ($totalAssigned > 0) { ?>
                                    <span class="totalAssign">+ <?php echo $totalAssigned; ?></span>
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
                        <td><? echo empty($user_details['fullname']) ? '' : $user_details['fullname']  ?> <br>
                             <span class="badge badge-danger"> <? echo $leads['deleted_date'] ?></span>
                       </td>
                        <td>
                            <div class="actionBtns">
                                <!-- <button class="nextBtn"><img src="../images/icons/viewBlack.png" alt=""></button> -->

                                <a href="<?php echo Yii::app()->createUrl('leads/viewSalesDetails', array('id' => $leads['lead_id'])); ?>">
                                    <img src="../images/icons/viewBlack.png" alt="">
                                </a>
                                <button  class="recover_leads w-auto btn-success"  data-lead_id="<?php echo $leads['lead_id'] ?>">
                                   Recover
                                 </button>

                                <button class="confirm_delete" data-lead_id="<?php echo $leads['lead_id'] ?>"><img src="../images/icons/deleteBlack.png" alt=""></button>
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

<div class="pagination-container">
    <?php if ($currentPage > 1): ?>
        <button type="button" href="1" class="delete_paginationBtns">First</button>
        <button type="button" href="<?= $currentPage - 1 ?>" class="delete_paginationBtns">Previous</button>
    <?php else: ?>
        <span>First</span>
        <span>Previous</span>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <button type="button" href="<?= $i ?>" class="delete_paginationBtns <?= $i == $currentPage ? 'active' : '' ?>">
            <?= $i ?>
        </button>
    <?php endfor; ?>

    <?php if ($currentPage < $totalPages): ?>
        <button type="button" href="<?= $currentPage + 1 ?>" class="delete_paginationBtns">Next</button>
        <button type="button" href="<?= $totalPages ?>" class="delete_paginationBtns">Last</button>
    <?php else: ?>
        <span>Next</span>
        <span>Last</span>
    <?php endif; ?>
</div>


<script>
    $(document).on('click' ,'.recover_leads' ,function(){
        let id = $(this).data('lead_id'); 
     
        $.ajax({
                        url: 'recoverLeads',
                        method: 'POST',
                        data: {
                        id: id
                },
                success: function(response) {
                    getDeletedData();
                },
                   error: function(xhr, status, error) {

                }
                })
    }); 

    $(document).on('click' ,'.confirm_delete' ,function(){
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
                                url : 'deleteLeads',
                                method : "POST", 
                                data : {
                                    id : id 
                       } ,
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
        })
    }) ;

    $(document).on('click' ,'.delete_paginationBtns' ,function(){
          let page = $(this).attr('href'); 
          getDeletedData(page);

    })
</script>