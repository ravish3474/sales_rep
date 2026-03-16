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

    /* .collapse.in {
        display: flex;
        justify-content: center;
        /* flex-direction: column; * /
    } */

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
    .commentsArea .singleComments .commenter{
        padding: 0px 10px;
    }
    .addCommentArea textarea{
        width: 100%;
    }
    #cmt_form{
       padding: 10px;
    }
    .addCommentArea .greenBTn { 
        right: 15px;
        bottom: 10px;
    }
</style>

 
 
 <div class="">
     <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
             <div class="x_panel">
                 <div class="salesLeads leadsDefaultPage">
                     <div class="LeadPreview">
                         <div class="pageHeader">

                             <h5 class="xlSize backBtn pageTitle d-flex gap2 go_to_previous_page">
                                 <figure><img src="../../images/icons/goBack.png
                                  " alt="" class="iconImg"></figure> Lead Preview

                           


                             </h5>
                         </div>
                         <?php if (!empty($sales)) {
                              $disabled =  $sales['status']==5 ? 'disabled' :'';
                            ?>
                             <div class="grid2">
                                 <div class="leftSide">
                                     <div class="upper personDetails">
                                         <div class="gridCustom">

                                             <figure class="text-center">
                                                 <img src="../../images/icons/person.png" alt="">
                                             </figure>
                                             <div>
                                                 <ul class="text-left">
                                                     <li class="black"><?php echo $sales['name'] ?></li>
                                                     <li><span>Phone </span><?php echo $sales['phone_no'] ?></li>
                                                     <li><span>Email</span> <?php echo $sales['email'] ?> </li>
                                                 </ul>
                                             </div>
                                             <div class="contact">
                                                 <a href="tel:<?echo $sales['phone_no'] ?>">
                                                     <figure><img src="../../images/icons/call.png" alt="" class="iconImg"></figure>
                                                 </a>
                                                 <a href="mailto:<?echo $sales['email']?>" target="_blank">
                                                     <figure><img src="../../images/icons/mail.png" alt="" class="iconImg"></figure>
                                                 </a>
                                             </div>

                                         </div>
                                         <div class="grid4">
                                             <div class="items">
                                                 <h6>Created on :</h6>
                                                 <p> - <?php echo $sales['created_at'] ?> 
                                                (UTC Time Zone)
                                                </p>
                                             </div>
                                             <div class="items">
                                                 <h6>City/State</h6>
                                                 <p><?php echo $sales['state_name'] ?></p>
                                             </div>
                                             <div class="items">
                                                 <h6>Country</h6>
                                                 <p><?php echo $sales['country_name'] ?></p>
                                             </div>
                                             <div class="items text-left">
                                                 <h6>Assigned to</h6>
                                            <div class="d-flex gap1 position-relative">

                                                <button class="d-btn bg-none text-nowrap get_sales_rep_data m-0 W-00  assigned_to_btn  " style="width: 100%;" data-lead_id="<?php echo $sales['lead_id']; ?>" data-toggle="modal" data-assigned_to= "<? echo $sales['assigned_to'] ?>" >

                                                <? 
                                                           $userDetails =  empty(!$sales['assigned_to']) ? TblLeads::getSalesPersonDetails($sales['assigned_to']) :Null; 
                                                    
                                                ?>
                                                    <?php echo empty($userDetails['fullname']) ? 'Select sales rep' : $userDetails['fullname'] ?>

                                                    <figure><img src="../../images/icons/blackDropdown.png" alt=""></figure>
                                                </button>

                                            

                                                <?php if ($totalAssigned > 0) { ?>
                                                    <span class="totalAssign">+ <?php echo $totalAssigned; ?></span>
                                                <?php } ?>

                                            </div>

                                             </div>
                                         </div>
                                     </div>
                                     <div class="projectOverview">
                                         <h6 class="divTitle d-flex  gap2">
                                             <figure><img src="../../images/icons/Project-Overview.png" alt="" class="iconImg"></figure> Project Overview
                                         </h6>
                                         <table class="table">
                                             <thead>
                                                 <tr>
                                                     <th class="text-center">Product</th>
                                                     <th>Team / Association / Company</th>
                                                     <th class="text-center">QTY</th>
                                                     <th class="text-center">Due Date</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <tr> 
                                                    <? 
                                                      $pro_name = TblLeads::GetPriceDetails($sales['pro_name']);
                                                      $product_name = empty($pro_name) ? $sales['pro_name'] : $pro_name; 

                                                    ?>
                                                     <td class="text-center"><?php echo $product_name ?></td>
                                                     <td><?php echo $sales['TAC_name'] ?></td>
                                                     <td class="text-center"><?php echo $sales['qty'] ?></td>
                                                     <td class="text-center"><?php echo date('d/m/Y', strtotime($sales['due_date'])) ?></td>
                                                 </tr>

                                             </tbody>
                                         </table>
                                         <div class="desc">
                                             <h6>Hi</h6>
                                             <p>
                                                 <?php
                                                    echo $sales['description']
                                                    ?>


                                             </p>
                                             <h6> Regards
                                                 <?php echo $sales['name'] ?> </h6>
                                         </div>
                                     </div>

                                 </div>
                                 <div class="rightSide">
                                     <div class="innerBox">
                                         <div class=" Set-Status">

                                             <h6 class="divTitle d-flex  gap2">
                                                 <figure><img src="../../images/icons/Set_Status.png" alt="" class="iconImg"></figure> Set Status
                                             </h6>
                                             <button class="status_btn <?php echo $sales['status'] == 0 ? 'activeStatus' : '' ?> ">New Lead</button>
                                             <button class="status_btn <?php echo $sales['status'] == 1 ? 'activeStatus' : '' ?>" data-toggle="modal" data-target="#followUpModal"
                                              data-status="1"  <?=  $disabled ?> >Follow up</button>

                                             <button class="status_btn <?php echo $sales['status'] == 2 ? 'activeStatus' : '' ?> other_status" data-toggle="modal" data-target="#OtherStatusModel" data-status="2"  <?=  $disabled ?> >Closed</button>

                                             <button class="status_btn <?php echo $sales['status'] == 3 ? 'activeStatus' : '' ?> other_status" data-target="#OtherStatusModel" data-toggle="modal" data-status="3"  <?=  $disabled ?> >On Hold</button>
                                             <button class="<?php echo $sales['status'] == 4  ? 'activeStatus' : '' ?> other_status"
                                                 data-target="#OtherStatusModel" data-toggle="modal" data-status="4"  <?=  $disabled ?> >Rejected</button>


                                                 <button class="<?php echo $sales['status'] == 5  ? 'activeStatus' : '' ?> other_status btn-danger">Deleted</button>

                                                  <? 
                                                     $latest_lead = empty($latest_followUp[0]) ? Null : $latest_followUp[0] ; 
                                                  ?>

                                                             
                                             <div class="notes">
                                                 <? if($latest_lead['action_type'] =='Schedule_Call'): ?>
                                                    <div class="chip greenBtn">
                                                        <figure><img src="../../images/icons/callWhite.png" alt="" class="iconImg"></figure> <? echo(date('M d' ,strtotime($latest_lead['created_at']))) ?>
                                                    </div>
                                                <? elseif($latest_lead['action_type'] =='Schedule_Video_Call'): ?>
                                                    <div class="chip purpleBtn">
                                                        <figure><img src="../../images/icons/vedio.png" alt="" class="iconImg"></figure> <? echo(date('M d' ,strtotime($latest_lead['created_at']))) ?>
                                                    </div>
                                                 <? elseif($latest_lead['action_type'] =='Schedule_Message'): ?>
                                                    <div class="chip lightPurpleBtn">
                                                        <figure><img src="../../images/icons/mailWhite.png" alt="" class="iconImg"></figure> <? echo(date('M d' ,strtotime($latest_lead['created_at']))) ?>
                                                    </div>
                                                 <? endif ; ?>
                                                 <div class="followUpDetails">
                                                  <? 
                                                    if(!empty($latest_lead['note'])){
                                                          ?>
                                                             <div class="messNotes">
    
                                                                     <p><? echo $latest_lead['note'] ?></p>
                                                                     <a href="#" class="view_all_status_change" data-lead_id ="<? echo $sales['lead_id'] ?>" data-toggle="modal" data-target="#messNotesModal"> View...</a>
                                                                </div>
                                                             
                                                          <?
                                                    }
                                                  ?>    
                                                 </div>
                                                
                                             </div>
                                           <?
                                          
                                         ?>

                                         </div>

                                         <div class="commentsArea">
                                             <div class="header d-flex between   ">
                                                 <h6 class="divTitle">Comments</h6>
                                                 <? 
                                                   if($show_btn && $sales['status']!=5){
                                                      ?>
                                                                <button class="d-btn btn-primary " data-toggle="collapse"
                                                                    data-target="#collapseOne">
                                                                    <figure><img src="../../images/icons/pulsWhite.png" alt=""></figure> Add Comment
                                                                </button>
                                                      <?
                                                   }
                                                 ?>

                                             </div>
                                             <div class="allComments">


                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>

                         <?php
                            }
                            ?>


                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- View All comments modal   -->
 <div class="modal fade smallModal" id="messNotesModal" role="dialog">
     <div class="modal-dialog  ">
        
         <div class="modal-content">
             <div class="modal-header">
               
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title  ">Follow-Up & Meeting Schedule</h4>
             </div>

             <div class="modal-body">

                 
             



             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             </div>
         </div>
         </form>

     </div>
 </div>
 <!-- followUpModal  -->

 <!-- followUpModal  -->
 <div class="modal fade smallModal" id="followUpModal" role="dialog">
     <div class="modal-dialog  ">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <!-- modal header  -->
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title  ">Set Status Details</h4>
             </div>
             <form method="post" action="<?php echo Yii::app()->createUrl('leads/setLeadStatus'); ?>"  id="follow_up_form">
                 <div class="modal-body">
                     <div class="grid2">
                         <div class="form-group">
                             <label for="Follow_up_date" class="blackLabel">Follow up date </label>
                             <input type="date" class="form-control" id="Follow_up_date" name="follow_up_date" placeholder="Select Date" required>
                         </div>
                         <div class="form-group">
                             <label for="action_ype" class="blackLabel"> Action Type</label>
                             <select class=" form-select  Select Action Type text-left" name="action_type" aria-label="Default select example" required>
                                 <option value="">Select Action Type</option>
                                 <option value="Schedule_Call">Schedule Call</option>
                                 <option value="Schedule_Video_Call">Schedule Video call</option>
                                 <option value="Schedule_Message">Schedule Message</option>
                             </select>
                         </div>
                         <div class="form-group column2">
                             <label for="Notes" class="blackLabel">Notes  </label>
                             <textarea id="" placeholder="Type details...." name="notes" required> </textarea>
                         </div>
                     </div>

                     <input type="hidden" name="lead_id" value="<?php echo $sales['lead_id'] ?>">
                     <input type="hidden" name="lead_status" value="1">

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn greenBtn">Save</button>
                 </div>
         </div>
         </form>

     </div>
 </div>
 <!-- followUpModal  -->

 <!-- other status modal  -->
 <div class="modal fade smallModal" id="OtherStatusModel" role="dialog">
     <div class="modal-dialog  ">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <!-- modal header  -->
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title  ">Set Status Details</h4>
             </div>

             <form method="post" action="<?php echo Yii::app()->createUrl('leads/setOtherLeadStatus'); ?>"  id="other_status_modal">
                 <div class="modal-body">
                     <div class="grid2">
                         <div class="form-group">
                             <label for="Follow_up_date" class="blackLabel">Date </label>
                             <input type="date" class="form-control" id="date" name="date" placeholder="Select Date" required>
                         </div>

                         <div class="form-group column2">
                             <label for="Notes" class="blackLabel">Remark (Optional) </label>
                             <textarea id="" placeholder="Type details...." name="notes" rows="1" cols="2" required> </textarea>
                         </div>
                     </div>

                  
                   

                     <input type="hidden" name="lead_id" value="<?php echo $sales['lead_id'] ?>">

                     <input type="hidden" name="other_lead_status" value="" class="other_leads_status">
                     <input type="hidden" name="is_ajax" value="true">

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn greenBtn">Save</button>
                 </div>
         </div>
         </form>

     </div>
 </div>



 <!-- Modal -->
 <div class="modal fade salesRepModal" id="salesRepModal" tabindex="-1" role="dialog" aria-labelledby="salesRepModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="salesRepModalLabel">Assigned Sales Reps</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                               <span class=""> <?php echo $leads['assigned_to'] ?> </span>
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
                                    </div>
                                </div>
                                <div class="totalAssignedAdmin">
                                    <!-- Additional content if needed -->
                                </div>

                            </div>
                        </div>

                        <input type="hidden" name="lead_id_assign" id="lead_id_assign" value="">

                    </div>
                    <div class="modal-footer d-flex">
                        <button type="button" class="d-btn  hideSaleRepModal" data-dismiss="modal">Cancel</button>
                        <button type="button" class="d-btn greenBtn savebtn" data-lead_id="">Save</button>
                    </div>
                </div>
            </div>
</div>





 <script>
    // go tp previous page 
$('.go_to_previous_page').click(function() {
         window.history.back();
});

$('.other_status').click(function() {
    let status = $(this).data('status');
    $('.other_leads_status').val(status);

});

$(document).ready(function() {
         $(".js-select2").select2({
             closeOnSelect: false,
             placeholder: "Assigned to..",
             allowHtml: true,
             allowClear: true,
             tags: true
         });
         getAllComments();
});

function getAllComments() {
    let id = "<? echo empty($sales['lead_id']) ? 0 : $sales['lead_id']  ?>";
    showLoader();
    $.ajax({
        url: '<? echo Yii::app()->request->baseUrl?>/leads/getCommentAjax',
        method: 'POST',
        data: {
            id: id,
        },
        success: function(response) {
            // console.log("response" +response);
            $('.allComments').html(response);
            hideLoader();
        },
        error: function(xht, status, error) {
            swal.fire({
                title: 'Something went wrong',
                icon: 'warning',
                confirmButtonText: 'Got it!'
            })
        }

    })
}

$('#follow_up_form').submit(function(event){
    event.preventDefault(); 
    let form = $(this) ; 
    let data =  form.serialize(); 
    let url = $(this).attr('action'); 
    let method = $(this).attr('method'); 
    
    $.ajax({
        url : url ,
        method : method , 
        data : data , 
        success :function(response){
            $('#followUpModal').modal('hide');
            let resp = JSON.parse(response); 

            $('.notes').html(resp.html); 
            console.warn("stats " , resp.lead_status); 
            form[0].reset();
            SetStatus(resp.lead_status);
            getCommentNotification();

            swal.fire({
                title: 'Status Updated ',
                icon: 'success',
                confirmButtonText: 'Got it!'
            }); 

        }, 
        error : function(xhr , status , error){
            console.warn("something went wrong");
        }
    });
});

$('#other_status_modal').submit(function(event){

          event.preventDefault(); 
          let form = $(this) ; 
         let data =  form.serialize(); 
         let url = $(this).attr('action'); 
         let method = $(this).attr('method'); 

         $.ajax({
             url : url ,
             method : method , 
             data : data , 
             success :function(response){
                 $('#OtherStatusModel').modal('hide');
                 let resp = JSON.parse(response); 
                
                 console.warn("stats " , resp); 
                 form[0].reset();
                 SetStatus(resp.lead_status);
                 getCommentNotification();

                 swal.fire({
                     title: 'Status Updated ',
                     icon: 'success',
                     confirmButtonText: 'Got it!'
                 }); 
                //  console.log("Reponse " +response); 
             }, 
             error : function(xhr , status , error){
                 console.warn("something went wrong");
             }
         })
});

function SetStatus(lead_status){
          $('.status_btn').each(function(){
               let status = $(this).data('status'); 
               if(lead_status == status){
                    $(this).addClass('activeStatus');
               }else{
                  $(this).removeClass('activeStatus');
               }
          })
}


     $(document).on('click' ,'.view_all_status_change' ,function(){
    
        
         let lead_id = $(this).data('lead_id');
         $.ajax({
             url : '<? echo Yii::app()->request->baseUrl?>/leads/GetallStatusData',
             method : 'POST',
             data : {
                    id : lead_id ,
              }
            }).done(function(response){
             
                $('#messNotesModal .modal-body').html(response);
                
            }).fail(function(xhr , status , error){
                console.warn("something went wrong");
         })
     });
 </script>

 <!-- script for assign sales person -->
 <script>

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

}) ;
 


$(document).on('click' ,'.get_sales_rep_data' ,function() {
    let id = $(this).data('lead_id');
    getAllAssignedSaleRep(id);

}); 



$(document).on('click', '.deleteSalesRep', function() {
    let id = $(this).data('multiple-id');
    let lead_id = $(this).data('lead_id');

    let salesPerson = $(this).data('salesPerson'); 
   

       Swal.fire({
                title: 'Are you sure?',
                text: 'Want to delete the multiple sales person!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No'
            }).then((result) => {
                        if (result.isConfirmed) {
                            showLoader();
                            $.ajax({
                    url: '<? echo Yii::app()->request->baseUrl?>/leads/deleteSalesPerson',
                    method: "POST",
                    data: {
                        id: id
                    },
                    success: function(reponse) {
                        
                   
                        getAllAssignedSaleRep(lead_id);
                        getsalesRepList(lead_id ,salesPerson);

                       hideLoader();

                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Something went wrong',
                            icon: 'warning',
                            confirmButtonText: 'Got it!'
                        });
                        hideLoader();


                    }

                })

                }
            });

 

});



$(document).on('input' ,'#search_name' ,function(){
    let lead_id = $(this).data('lead_id'); 
    let salesPerson = $(this).data('saleperson')
    let search =  $(this).val(); 

    getsalesRepList(lead_id ,salesPerson ,search);
});


function GetCheckedValues() {
    let checkedValues = [];
    $('#salesRepModal .sales_rep_checkbox').each(function() {
        if ($(this).prop('checked')) {
            checkedValues.push($(this).val());
        }
    });

   
    return checkedValues;
}

function getsalesRepList(lead_id ,salesPerson ,search =0){
    showLoader();
    $.ajax({
          url: '<? echo Yii::app()->request->baseUrl?>/leads/getallAssignedSalesRep' , 
       

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
        $.ajax({
            url: '<? echo Yii::app()->request->baseUrl?>/leads/GetAssignedSalesRep',
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
                   Swal.fire({
                            title: 'Something went wrong',
                            icon: 'warning',
                            confirmButtonText: 'Got it!'
                        });

                 hideLoader();
  
             }
        })
}


$(document).on('change' ,'.sales_rep_checkbox' ,function(){
 var isChecked = $(this).prop('checked'); 


    if(isChecked){
            let lead_id = $('#lead_id_assign').val();
            let checked_values = $(this).val();

        showLoader();
        $.ajax({
            url: '<? echo Yii::app()->request->baseUrl?>/leads/SavemultipleSalesRep',
            method: 'POST',
            data: {
                lead_id: lead_id,
                all_values: checked_values,
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



 </script>