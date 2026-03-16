<?
$month = date('m');

$select_ele = '  <select class="form-select  month_count_filter" aria-label="Default select example"> 
                           <option value=""> --SELECT MONTH --</option>
                  ';
foreach (MONTH_FILTER as $key => $value) {
    if ($key == $month):
        $select_ele .=  '<option value="' . $key . '" selected>  
            ' . $value . '</option>';
    else:
        $select_ele .=  '<option value="' . $key . '"> 
            ' . $value . '</option>';
    endif;
}

$select_ele .= ' </select>';

$week_filter = [
    '0' => 'This week',
    '1' => 'First week',
    '2' => 'Second week',
    '3' => 'Third week'
];
$status_class = [
    '0' => 'greenOption',
    '1' => 'blueOption ',
    '3' => 'yellowOption ',
    '4' => 'purpleOption',

]

?>
<style>
     .readNotification {
        background-color: #fff !important;
    }

    .unreadNotification {
        background-color: #F9F9F9 !important;
        width: 100%;
    }
    #chartdiv{
         background-color: #F9F9F9;
        }

      .salesDash .grid2{
        grid-template-columns: 40% auto !important;
      }  

</style>

<div class="">
     <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12  ">
             <div class="x_panel">
                 <div class="dashboardPage salesDash">
                     <div class="upper">
                         <div class="pageHeader">
                             <h5 class="xlSize black  ">Welcome to your dashboard !</h5>
                         </div>

                         
                        <div class="dashboardHistory">
                            <div class=" grid grid4">
                                <div class="items cBorder">
                                    <div class="innerBox d-flex between select_parent" data-status="toal_leads">
                                        <figure><img src="../images/icons/total.png" alt="" class="iconImg1"></figure>
                                        <? echo $select_ele  ?>



                                    </div>
                                    <h4 class="number  toal_leads">
                                        <? echo isset($count_arr['total_leads']) ? $count_arr['total_leads']  : 0; ?>
                                    </h4>
                                    <div class="d-flex between">
                                        <h6 class="sSize grey fw4 m-0"> Total Leads </h6>
                                        <?
                                        $all_leads_percent = isset($count_arr['total_leads_percent']) ? $count_arr['total_leads_percent']  : 0;
                                        if ($all_leads_percent > 0):
                                        ?>
                                            <div class="toal_leads_div">
                                                <h6 class="chartAngle chartAngleUP ">
                                                    +<? echo $all_leads_percent  ?>%
                                                    <img src="../images/icons/Growth Icon.png" alt="" class="iconImg">
                                                </h6>
                                            </div>
                                        <?
                                        else :
                                        ?>
                                            <div class="toal_leads_div">
                                                <h6 class="chartAngle chartAngleDown ">
                                                    <? echo $all_leads_percent  ?>%
                                                    <img src="../images/icons/Loss Icon.png" alt="" class="iconImg">
                                                </h6>
                                            </div>
                                        <?
                                        endif;
                                        ?>


                                    </div>
                                </div>
                                <div class="items cBorder     ">
                                    <div class="innerBox d-flex between  select_parent" data-status="new_leads">
                                        <figure><img src="../images/icons/new.png" alt="" class="iconImg1"></figure>
                                        <? echo $select_ele  ?>

                                    </div>

                                    <h4 class="number new_leads">
                                        <? echo isset($count_arr['new_leads']) ? $count_arr['new_leads']  : 0; ?>
                                    </h4>


                                    <div class="d-flex between">
                                        <h6 class="sSize grey fw4 m-0"> New Leads</h6>

                                        <?
                                        $all_leads_percent = isset($count_arr['new_leads_percent']) ? $count_arr['new_leads_percent']  : 0;
                                        if ($all_leads_percent > 0):
                                        ?>
                                            <div class="new_leads_div">
                                                <h6 class="chartAngle chartAngleUP ">
                                                    +<? echo $all_leads_percent  ?>%
                                                    <img src="../images/icons/Growth Icon.png" alt="" class="iconImg">
                                                </h6>
                                            </div>
                                        <?
                                        else :
                                        ?>
                                            <div class="new_leads_div">
                                                <h6 class="chartAngle chartAngleDown ">
                                                    <? echo $all_leads_percent  ?>%
                                                    <img src="../images/icons/Loss Icon.png" alt="" class="iconImg">
                                                </h6>
                                            </div>
                                        <?
                                        endif;
                                        ?>


                                    </div>
                                </div>
                                <div class="items cBorder     ">
                                    <div class="innerBox d-flex between select_parent" data-status="converted_leads">
                                        <figure><img src="../images/icons/assign.png" alt="" class="iconImg1"></figure>
                                        <? echo $select_ele  ?>

                                    </div>
                                    <h4 class="number converted_leads">

                                        <? echo isset($count_arr['converted_leads']) ? $count_arr['converted_leads']  : 0; ?>

                                    </h4>
                                    <div class="d-flex between">
                                        <h6 class="sSize grey fw4 m-0"> Converted Leads</h6>

                                        <?
                                        $all_leads_percent = isset($count_arr['coverted_leads_percent']) ? $count_arr['coverted_leads_percent']  : 0;
                                        if ($all_leads_percent > 0):
                                        ?>
                                            <div class="converted_leads_div">
                                                <h6 class="chartAngle chartAngleUP ">
                                                    +<? echo $all_leads_percent  ?>%
                                                    <img src="../images/icons/Growth Icon.png" alt="" class="iconImg">
                                                </h6>
                                            </div>
                                        <?
                                        else :
                                        ?>
                                            <div class="converted_leads_div">
                                                <h6 class="chartAngle chartAngleDown ">
                                                    <? echo $all_leads_percent  ?>%
                                                    <img src="../images/icons/Loss Icon.png" alt="" class="iconImg">
                                                </h6>
                                            </div>
                                        <?
                                        endif;
                                        ?>



                                    </div>
                                </div>
                                <div class="items cBorder  ">
                                    <div class="innerBox d-flex between select_parent" data-status="lost_leads">
                                        <figure><img src="../images/icons/loss.png" alt="" class="iconImg1"></figure>
                                        <? echo $select_ele  ?>

                                    </div>
                                    <h4 class="number lost_leads">
                                        <? echo isset($count_arr['lost_leads']) ? $count_arr['lost_leads']  : 0; ?>

                                    </h4>
                                    <div class="d-flex between">
                                        <h6 class="sSize grey fw4 m-0"> Lost Leads</h6>

                                        <?
                                        $all_leads_percent = isset($count_arr['lost_leads_percent']) ? $count_arr['lost_leads_percent']  : 0;
                                        if ($all_leads_percent > 0):
                                        ?>
                                            <div class="lost_leads_div">
                                                <h6 class="chartAngle chartAngleUP ">
                                                    +<? echo $all_leads_percent  ?>%
                                                    <img src="../images/icons/Growth Icon.png" alt="" class="iconImg">
                                                </h6>
                                            </div>
                                        <?
                                        else :
                                        ?>
                                            <div class="lost_leads_div">
                                                <h6 class="chartAngle chartAngleDown ">
                                                    <? echo $all_leads_percent  ?>%
                                                    <img src="../images/icons/Loss Icon.png" alt="" class="iconImg">
                                                </h6>
                                            </div>
                                        <?
                                        endif;
                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>


                     </div>

                     <div class="middle">
                         <div class="grid2">
                                <div id="chartdiv"></div>

                                    <div class="recentLeads">
                                        <div class="tableHeader d-flex between">
                                        <h6>Recent Leads</h6>
                                        <select class="form-select select_recent_leads_week" aria-label="Default select example">


                                            <?
                                            foreach ($week_filter as $week_key => $week_value) {
                                            ?>
                                                <option value="<? echo $week_key ?>"><? echo $week_value ?></option>
                                            <?
                                            }
                                            ?>

                                        </select>
                                    </div>

                                    <ul class="nav nav-tabs" id="recentLeadsTabs" role="tablist">
                                        <li class="nav-item tab_btn active" data-value="online" role="presentation">
                                            <a class="nav-link active" id="online-tab" data-toggle="tab" href="#online-data" role="tab" aria-controls="online-tab" aria-selected="true">Online</a>
                                        </li>

                                        <li class="nav-item tab_btn " data-value="offline" role="presentation">
                                            <a class="nav-link" id="offline-tab" data-toggle="tab" href="#offine-data" role="tab" aria-controls="offine-tab" aria-selected="false">Offline</a>
                                        </li>

                                    </ul>

                                        <!-- Tab Content -->
                                    <div class="tab-content mt-3" id="recentLeadsTabContent">
                                        <div class="tab-pane  active" id="online-data" role="tabpanel" aria-labelledby="online-tab">
                                            <div class="output_div"></div>
                                        </div>

                                    <div class="tab-pane fade " id="offine-data" role="tabpanel" aria-labelledby="offline-tab">
                                        <div class="output_div"></div>

                                    </div>
                                    </div>



                            </div>

                               <div class="countryStatistic">
                                <div class="table-responsive">
                                    <div class="grid2">
                                    <table style="border-right: 1px solid #DDDDDD;padding-right: 10px; ">
                                                    <thead>
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>No. of leads</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                        <? 
                                           $country_name = TblLeads::getCountryData(true); 
                                            $arr1 = array_slice($country_name ,0,4);
                                            $arr2 = array_slice($country_name ,4,7);
                                            

                                           foreach($arr1 as $key=>$value){
                                                $count = TblLeads::getCountryCountValue($value['country_name']);
                                              ?>
                          
                                               
                                                        <tr>
                                                            <td>
                                                                <div class="countryColor color<?=$value['id']?>"></div>
                                                                <span class="africa"><?=$value['country_name'] ?></span>
                                                            </td>
                                                            <td class="text-center"><?=$count?></td>
                                                        </tr>

                                                
                                              <?
                                           }
                                        ?>
                                        
                                        </tbody>
                                          
                                        </table>


                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Country</th>
                                                    <th>No. of leads</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?
                                                    foreach($arr2 as $key=>$value){
                                                       $count = TblLeads::getCountryCountValue($value['country_name']);

                                                           ?>
                                
                                                    
                                                                <tr>
                                                                    <td>
                                                                        <div class="countryColor color<?=$value['id']?>"></div>
                                                                        <span class="africa"><?=$value['country_name'] ?></span>
                                                                    </td>
                                                                    <td class="text-center"><?=$count?></td>
                                                                    
                                                                </tr>

                                                        
                                                            <?
                                                   }
                                              ?>
                                            </tbody>

                                        </table> 

                                    </div>
                                </div>
                             </div>
                            

                         </div>


                              
                        
                     </div>


                     <div class="bottom ">
                        <div class="grid2">


                            <div>
                               <div class="notification">
                                 <div class="tableHeader d-flex between">
                                     <h6>Notifications</h6>
                                     <div class="d-flex">
                                        <div class=" panel-collapse collapse " id="collapseOne">
                                            <button class="d-btn markAsRead">Mark All as read..</button>
                                            <button class="d-btn deleteAll">Delete All..</button>
                                        </div>
                                        <button class="d-btn bg-none border-none " data-toggle="collapse"
                                            data-target="#collapseOne">
                                            <figure><img src="../images/icons/bi_three-dots.png" alt="" class="iconImg"></figure>
                                        </button>

                                    </div>

                                 </div>
                                 <div class="allNotification">
                                    <?
                                    

                                    foreach ($notification as $key => $value) {
                                        $lead_details = Yii::app()->db->createCommand("SELECT * FROM tbl_leads Where lead_id = '" . $value['lead_id'] . "'")->queryRow();


                                    ?> <div class="d-flex ">
                                            <div class="notificationItems <? echo $value['status'] == 1 ?  'readNotification' : 'unreadNotification' ?> ">

                                                <label class="leftDay cursor">
                                                    <input type="checkbox" class="select-item select_notification" value="<?php echo $value['id']; ?>" />
                                                    <span></span> <!-- Span here if you want some extra styling or space for the checkbox -->
                                                    <h6><?php echo date('d', strtotime($value['created_at'])); ?></h6>
                                                    <h5><?php echo date('M', strtotime($value['created_at'])); ?></h5>
                                                </label>


                                                <a href="<?php echo Yii::app()->createUrl('leads/viewSalesDetails', array('id' => $value['lead_id'])); ?>" class="rightNote">
                                                    <p>New Comment on [<? echo $lead_details['name'] ?>]: "<? echo $value['sales_rep'] ?> commented: '<? echo $value['comment'] ?>'"</p>
                                                </a>
                                            </div>
                                        </div>
                                    <?
                                    }
                                    ?>



                                </div>
                                </div>
                            </div>

                            <div>
                                    <div class="tableHeader d-flex between">
                                        <h6>Need Attention</h6>
                                        <select class="form-select  select_attention_week" aria-label="Default select example">
                                            <? 
                                            foreach($week_filter as $week_key =>$week_val){
                                                ?>
                                                    <option value ="<? echo $week_key ?>" > <? echo $week_val ?></option>
                                                <?
                                            }
                                            ?>
                                        </select>
                                   </div>
                                 <div class="needAttentionsArea"></div>
                            </div>

                        </div>
                      
                     </div>


                 </div>
             </div>
         </div>
     </div>
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
                                                <input type="hidden" name="lead_id_assign" id="lead_id_assign" value="">

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
                    </div>
                    <div class="modal-footer d-flex">
                        <button type="button" class="d-btn  hideSaleRepModal" data-dismiss="modal">Cancel</button>
                        <button type="button" class="d-btn greenBtn savebtn" data-lead_id="">Save</button>
                    </div>
                </div>
            </div>
</div>


 
 
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/assign_sales_rep.js?var=901" type="text/javascript"></script>


 <script>


     $(document).ready(function() {
        getReacentLeads();
        GetAttentionLeads(); 
    });


    function getReacentLeads(tab_value = 0, week = 0 , currentPage = 1) {
        showLoader();
         let tab =tab_value ? tab_value  : $('.tab_btn.active').data('value');
        $.ajax({
            url: 'getRecentLeads',
            method: "POST",
            data: {
                tab_value: tab,
                week: week,
                page : currentPage

            },
            success: function(response) {

                let activeTab = '';


                $('.tab-pane').each(function() {
                    if ($(this).hasClass('active')) {
                        activeTab = $(this).attr('id');
                    }
                });

                //    console.log($('#'+activeTab+' .output_div')); 


                $('#' + activeTab + ' .output_div').html(response);

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

    function getNotificationData(selected_val) {
        $.ajax({
            url: 'getNotificationAjax',
            method: 'POST',
            data: {
                id: '',
                selected_val: selected_val
            },
            success: function(response) {
                $('.allNotification').html(response);
            },
            error: function(xhr, status, error) {

            }
        })
    }





$('.markAsRead').click(function() {
        let checked_values = getCheckedValues();
        getNotificationData(checked_values);

});

    $('.deleteAll').click(function() {
        let selected = getCheckedValues();
        
        $.ajax({
            url: 'deleteNotificationAjax',
            method: 'POST',
            data: {
                selected_val: selected
            },
            success: function(response) {
                $('.allNotification').html(response);
            },
            error: function(xhr, status, error) {

            }
        })

});
    

function getCheckedValues() {

            let checkedValue = $('.select_notification:checked').map(function() {
                return $(this).val();
            }).get();
            return checkedValue;
}
// -------------------

    $('.month_count_filter').change(function() {
        let parent = $(this).closest('.select_parent');
        let status = parent.data('status');
        let month = $(this).val();


        $.ajax({
            url: 'dashboardCountFilter',
            method: 'POST',
            data: {
                status: status,
                month: month
            },
            success: function(response) {
                let resp = JSON.parse(response);
                let percent = resp.percent;
                var ele = '';
                if (percent > 0) {
                    ele = `   <h6 class="chartAngle chartAngleUP "> 
                                                    +${percent} % <img src="../images/icons/Growth Icon.png" alt="" class="iconImg"></figure>
                            </h6> `;
                } else {
                    ele = `   <h6 class="chartAngle chartAngleDown"> 
                                                    ${percent} % <img src="../images/icons/Loss Icon.png" alt="" class="iconImg"></figure>
                            </h6> `;
                }


                $('.' + status).html(resp.count);
                $('.' + status + '_div').html(ele);

            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Something went wrong',
                    icon: 'warning',
                    confirmButtonText: 'Got it!'
                });
            }
        })


    });

// ---------- Get attention leads 

function GetAttentionLeads(week=0){
    showLoader();
    $.ajax({
       url : 'getAttentionLeads' , 
       method : 'POST',
     data : {
          id :'' , 
          week:week 
     },
       success : function(response){
          $('.needAttentionsArea').html(response); 
          hideLoader();
       } , 
       error : function(xhr , status ,error){
        hideLoader();
          swal.fire({
                    title: 'Something went wrong',
                    icon: 'warning',
                    confirmButtonText: 'Got it!'
          })
       }
    });
} ; 

$(document).on('change' ,'.select_attention_week' ,function(){
     let week = $(this).val(); 
     GetAttentionLeads(week);
}); 

$(document).on('click' ,'.hideSaleRepModal' ,function(){
    getReacentLeads();
    GetAttentionLeads(); 
});







$(document).on('click' ,'.paginationBtns' ,function(event) {

event.preventDefault();
let page = $(this).attr('href');

getReacentLeads(0 ,0 ,page); 

});


$(document).on('click' , '.hideSaleRepModal , .savebtn' ,function(){
    let page = $('.paginationBtns.active').attr('href');
    let tab = $('.tab_btn.active').data('value'); 
   let week  = $('.select_recent_leads_week').val();
   $('#salesRepModal').modal('hide');

    getReacentLeads(tab ,week ,page);
    GetAttentionLeads(); 
});

$(document).on('click', '.paginationBtns', function(event) {
        event.preventDefault();
        let page = $(this).attr('href');
        let tab = $('.tab_btn.active').data('value');
        let week = $('.select_recent_leads_week').val();
        getReacentLeads(tab, week, page);
    });


    $(document).on('change', '.select_recent_leads_week', function() {
        let page = $('.paginationBtns.active').attr('href');
        let tab = $('.tab_btn.active').data('value');
        let week = $(this).val();
        getReacentLeads(tab, week, page);
    });
  
    $(document).on('click', '.tab_btn', function() {
        let tab = $(this).data('value');
        let week = $('.select_recent_leads_week').val();
        getReacentLeads(tab, week, 1);
    });

 </script>

 </script>

 <!-- Map for sales person -->

<script src="//cdn.amcharts.com/lib/5/index.js"></script>
<script src="//cdn.amcharts.com/lib/5/map.js"></script>
<script src="//cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="//cdn.amcharts.com/lib/5/geodata/data/countries2.js"></script>
<script src="//cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>

<? 
    $admin =  Yii::app()->user->getId(); 
    $map_data = Yii ::app()->db->createCommand("SELECT * FROM tbl_leads AS tbl LEFT JOIN tbl_leads_multiple AS tlm ON tlm.lead_id = tbl.lead_id Where (tbl.assigned_to='$admin' OR tlm.sale_rep='$admin') AND tbl.status!=5  GROUP BY tbl.lead_id ")->queryAll(); 
    $result = [];
    $stateCountryCount = [];

    foreach ($map_data as $lead) {
        $state = $lead['state_name'];
        $country = $lead['country_name'];
        $key = $country;
        if (isset($stateCountryCount[$key])) {
            $stateCountryCount[$key]++;
        } else {
            $stateCountryCount[$key] = 1;
        }
    }


    $countryCode = '';
    foreach ($stateCountryCount as $key=>$value) {
        $countryCode = isset(CountryCodeMap[$key]) ? CountryCodeMap[$key] : 'Unknown';
    

        $result[] = [
            'id' => $countryCode, 
            'value' => $value,
            'name' =>$key 
        ];
    }

    // echo '<pre>'; 
    // print_r($result); 
      $user =Yii::app()->user->getState('userGroup') ;
      echo '<script> var loggedInUser = '.$user.'</script>';

      echo '<script>  const countryData = '.json_encode($result).' </script>';
    

?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/salesMap.js?var=30" type="text/javascript"></script>
