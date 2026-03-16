<?


foreach ($country as $country_key => $country_value) {



?>


    <div class="leadsItems">
        <div class="tableHeader d-flex between">
            <h6><? echo $country_value['country_name'] ?></h6>
            <button class="d-flex gap2" onclick="addSalesRepcounty('<? echo $country_value['country_name'] ?>' ,<?= $country_value['is_same'] ?>)">
                <figure><img src="../images/icons/addGreen.png" alt="" class="iconImg"></figure> Add Sales Rep
            </button>
        </div>
        <?


        ?>

        <div class="leadsTableMain">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> </th>
                            <th>Sales Rep</th>
                            <th>State</th>
                            <th>Priority</th>
                            <th>Lead Capacity</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody id="sortable-tbody_<? echo $country_key ?>" class="sortable-tbody">
                        <?php
                        $getStateName = [];
                        foreach ($adminSales as $sales) {

                        ?>
                            <?php if ($sales['country_name'] == $country_value['country_name']) {
                                $getStateName = TblLeads::GetStateName($sales['state_name']);
                                $state_name =  isset($getStateName['state_name']) ? $getStateName['state_name'] : '';
                            ?>
                                <tr data-status="false" class="move_state_td" data-state="<?= $sales['state_name'] ?>">
                                    <td colspan="6" class="stateName  ">
                                        <div class="d-flex justify-content-between" style="justify-content: space-between;">
                                            <div><?php echo $state_name; ?></div>

                                            <div class="d-flex gap2 rowSort">
                                                <button class="Up_arrow" data-state="<?= $sales['state_name'] ?>" data-country="<?= $sales['country_name'] ?>" data-priority="<?= $sales['priority'] ?>">
                                                    <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                                </button>

                                                <button class="down_arrow" data-state="<?= $sales['state_name'] ?>" data-country="<?= $sales['country_name'] ?>" data-priority="<?= $sales['priority'] ?>">
                                                    <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                                </button>
                                            </div>

                                        </div>
                                    </td>
                                </tr>

                                <?php foreach ($sales['data'] as $data) {
                                    $user_details = TblLeads::getSalesPersonDetails($data['sales_name']);
                                    $table_row_id =  "sales_" . $data['lead_sales_id'];

                                ?>
                                    <tr id="<?= $table_row_id ?>" class="sort_tr find_tr_row" data-lead_id="<? echo $data['lead_sales_id'] ?>" data-country="<? echo $sales['country_name'] ?>" data-state="<? echo $sales['state_name'] ?>">
                                        <td>
                                            <figure><img src="../images/icons/dragTable.png" alt="" class="iconImg"></figure>
                                        </td>
                                        <td class="fullname"><?php echo $user_details['fullname'] ?  $user_details['fullname'] : ''; ?></td>

                                        <td>
                                            <select data-tr_id="<?= $table_row_id ?>" class="form-select assignedTo text-left state_select_ele" aria-label="Default select example"
                                                onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'state_name' ,this,<?= $sales['state_name'] ?>)">
                                                <?php
                                                if ($country_value['is_same'] == 1) {
                                                    $country_name = 'USA';
                                                    $sql_cust = "SELECT * FROM tbl_country WHERE country_name LIKE '$country_name'  ORDER BY state_name ASC; ";
                                                } else {

                                                    $country_name = $sales['country_name'];
                                                    $sql_cust = "SELECT * FROM tbl_country WHERE country_name LIKE '%$country_name%'  ORDER BY state_name ASC; ";
                                                }

                                                $states = Yii::app()->db->createCommand($sql_cust)->queryAll();
                                                foreach ($states as $stateName) {
                                                    $state = $stateName['id'];
                                                    $selected = ($state == $sales['state_name']) ? 'selected' : '';
                                                    echo "<option value=\"$state\" $selected> " . $stateName['state_name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select assignedTo text-left sales_priority_select"
                                                data-tr_id="<?= $table_row_id ?>" aria-label="Default select example" id="lead_canada" data-sales-id="<?php echo $data['lead_sales_id']; ?>" onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'sales_priority' ,this)">
                                                <?php
                                                $sales_priority = [
                                                    1,
                                                    2,
                                                    3,
                                                    4,
                                                    5,
                                                    6,
                                                    7,
                                                    8,
                                                    9,
                                                    10
                                                ];
                                                foreach ($sales_priority as $priority) {
                                                    $selected = ($priority == $data['sales_priority']) ? 'selected' : '';
                                                    echo "<option value=\"$priority\" $selected>$priority</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select assignedTo text-left lead_capcity_select" aria-label="Default select example"
                                                data-tr_id="<?= $table_row_id ?>"
                                                onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'lead_capacity' ,this)">
                                                <?php
                                                $lead_capacity = [
                                                    1,
                                                    2,
                                                    3,
                                                    4,
                                                    5,
                                                    6,
                                                    7,
                                                    8,
                                                    9,
                                                    10
                                                ];
                                                foreach ($lead_capacity as $capacity) {
                                                    $selected = ($capacity == $data['lead_capacity']) ? 'selected' : '';
                                                    echo "<option value=\"$capacity\" $selected>$capacity</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="actionBtns">
                                                <button><img src="../images/icons/editBlue.png" alt="" data-toggle="modal" data-target="#editDetailsModal"
                                                        data-tr_id="<?= $table_row_id ?>"
                                                        onclick="editSalesRepcounty(<?php echo $data['lead_sales_id']; ?>,'<?php echo $data['country_name']; ?>','<?php echo $data['lead_capacity']; ?>','<?php echo $sales['state_name']; ?>',<?php echo $data['sales_priority'] ?>,' <?php echo $country_value['is_same']; ?> ' ,this)"></button>

                                                <button class="delete_sale_leads" type="button" data-id_lead="<?php echo $data['lead_sales_id']; ?>"><img src="../images/icons/deleteBlue.png" alt=""></button>
                                            </div>
                                        </td>
                                    </tr>
                        <?php }
                            }
                        } ?>

                    </tbody>

                </table>
            </div>
        </div>

    </div>

<?
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // $(document).ready(function() {
    //   // Enable sortable for both tables
    //    $('table tbody').sortable({
    //     connectWith: 'table tbody', // Allow dragging between both tables
    //     update: function(event, ui) {


    //          const draggedRow = ui.item; 
    //          let droppedRow ;
    //          let dragPre = draggedRow.prev(); 

    //          if(dragPre.attr('data-status') =='false') { 
    //              droppedRow=  draggedRow.next();     
    //          }else{
    //              droppedRow = draggedRow.prev();
    //          }

    //         // Get data from the dragged row
    //         const draggedLeadId = draggedRow.data('lead_id');
    //         const draggedCountry = draggedRow.data('country');
    //         const draggedState = draggedRow.data('state');


    //         // Get data from the dropped row
    //         const droppedLeadId = droppedRow.data('lead_id');
    //         const droppedCountry = droppedRow.data('country');
    //         const droppedState = droppedRow.data('state');
    //         let tr_id = draggedRow.attr('id');
    //         let dropped_tr_id = droppedRow.attr('id');

    //         $('#'+tr_id).attr('data-state' ,droppedState);
    //         let dragged_state_arr = GetAllStatePriority(draggedState);
    //         let dropped_state_arr  = GetAllStatePriority(droppedState);

    //         if(!dropped_tr_id){
    //              console.log("error");
    //              return false;
    //         }

    //     //    console.log("State" + droppedState +"country " +droppedCountry);

    //      console.log("dragged state" ,draggedState , "Dropped state" ,droppedState);


    // let matchingStateRow = $('.move_state_td').filter(function() {
    //     return $(this).data('state') == draggedState;
    // });

    //   let matchingStateRow1 = $('.move_state_td').filter(function() {
    //     return $(this).data('state') == droppedState;
    // });

    //  $('.find_tr_row').each(function(index){
    //      if($(this).data('state')==draggedState){
    //           $(this).remove();
    //      }
    //  });

    //     $('.find_tr_row').each(function(index){
    //      if($(this).data('state')==droppedState){
    //           $(this).remove();
    //      }
    //  });


    //       $.ajax({
    //         url: 'UpdateQueryRaw', 
    //         type: 'POST',
    //         data: {
    //              id : draggedLeadId , 
    //              country : droppedCountry,

    //              dragged_state_arr:dragged_state_arr,
    //              dropped_state_arr:dropped_state_arr,
    //              draggedState:draggedState,
    //              droppedState:droppedState,

    //         },
    //         success: function(response) {
    //              let resp = JSON.parse(response);
    //              let data = resp.data ;
    //              if(resp.exsists==true){
    //                Swal.fire('Error' ,'This salesperson has already been assigned to this state' ,'error'); 
    //                return ; 
    //             }
    //              matchingStateRow.after('');
    //              matchingStateRow1.after('');


    //              console.log('#'+tr_id  ," draged row id" + '#' +dropped_tr_id);
    //              matchingStateRow.after(resp.html);
    //              matchingStateRow.addClass('test_cls');
    //              matchingStateRow1.after(resp.html2); 
    //              matchingStateRow1.addClass('test_cls2');
    //             //  $('#'+tr_id).after(resp.html);
    //             //  $('#'+dropped_tr_id).after(resp.html2)
    //             //  UpdateOnlyRow(data ,tr_id);

    //         //   GetAllCountrySalesRep();
    //         },
    //         error: function(xhr, status, error) {
    //           console.error('Error moving row: ' + error);
    //         }
    //       });
    //     }
    //   }).disableSelection();

    // });



    $(document).ready(function() {
        $('table tbody').sortable({
            connectWith: 'table tbody',

            start: function(event, ui) {
                originalParent = ui.item.parent();
                originalIndex = ui.item.index(); // Save index inside original tbody
            },

            update: function(event, ui) {
                const draggedRow = ui.item;
                let draggedLeadId = draggedRow.data('lead_id');
                let draggedState = draggedRow.data('state');
                let draggedCountry = draggedRow.data('country');

                // Save clone for backup if needed
                const rowClone = draggedRow.clone(true);

                // Determine dropped position
                let droppedRow = draggedRow.prev();
                if (droppedRow.attr('data-status') === 'false') {
                    droppedRow = draggedRow.prev();
                }

                let droppedState = droppedRow.data('state');
                let droppedCountry = droppedRow.data('country');

                let matchingStateRow1 = $('.move_state_td').filter(function() {
                    return $(this).data('state') == droppedState;
                });

                // Fall back if no data-country
                if (!droppedCountry) {
                    droppedCountry = matchingStateRow1.data('country');
                }

                // Final state fallback
                if (!droppedState) {
                    droppedState = matchingStateRow1.data('state');
                }

                let tr_id = draggedRow.attr('id');
                let dropped_tr_id = droppedRow.attr('id');
                $('#' + tr_id).attr('data-state', droppedState)

                let dragged_state_arr = GetAllStatePriority(draggedState);
                let dropped_state_arr = GetAllStatePriority(droppedState);

                let matchingStateRow = $('.move_state_td').filter(function() {
                    return $(this).data('state') == draggedState;
                });
                showLoader();
                $.ajax({
                    url: 'UpdateQueryRaw',
                    type: 'POST',
                    data: {
                        id: draggedLeadId,
                        country: droppedCountry,
                        dragged_state_arr: dragged_state_arr,
                        dropped_state_arr: dropped_state_arr,
                        draggedState: draggedState,
                        droppedState: droppedState,
                    },
                    success: function(response) {
                        let resp = JSON.parse(response);

                        if (resp.exsists === true) {
                            Swal.fire('Error', 'This salesperson has already been assigned to this state', 'error');

                            // 🔁 Restore manually to original table and index
                            if (originalParent.children().length === 0 || originalIndex >= originalParent.children().length) {
                                originalParent.append(draggedRow);
                            } else {
                                originalParent.children().eq(originalIndex).before(draggedRow);
                            }
                            hideLoader();
                            return;
                        }


                        $('.find_tr_row').each(function(index) {
                            if ($(this).data('state') == draggedState) {
                                $(this).remove();
                            }
                        });

                        $('.find_tr_row').each(function(index) {
                            if ($(this).data('state') == droppedState) {
                                $(this).remove();
                            }
                        });
                        matchingStateRow.after('');



                        console.log('#' + tr_id, " draged row id" + '#' + dropped_tr_id);
                        matchingStateRow.after(resp.html);
                        matchingStateRow.addClass('test_cls');
                        if (resp.html2) {
                            matchingStateRow1.after('');
                            matchingStateRow1.after(resp.html2);
                            matchingStateRow1.addClass('test_cls2');
                        }


                        hideLoader();

                        // Continue your DOM update logic (removing/adding rows)...
                    },
                    error: function() {
                        Swal.fire('Error', 'AJAX failed', 'error');

                        // 🔁 Also revert on error
                        if (originalParent.children().length === 0 || originalIndex >= originalParent.children().length) {
                            originalParent.append(draggedRow);
                        } else {
                            originalParent.children().eq(originalIndex).before(draggedRow);
                        }
                        hideLoader();
                    },


                });
            },
        }).disableSelection();
    });


    $(document).on('click', '.delete_sale_leads', function() {

        console.log("clicked");
        let id = $(this).data('id_lead');
        let ele = $(this).closest('tr');

        Swal.fire({
            title: 'Are you sure?',
            text: 'To Delete The Sales Rep!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: 'deleteSales',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Sales person deleted successfully',
                            icon: 'success',
                            confirmButtonText: 'Got it!'
                        });
                        ele.remove();
                        // GetAllCountrySalesRep();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating:', error);
                    }
                })
            }
        })

    });


    function getAllState(country) {
        var result = {};
        $('.Up_arrow').each(function(key) {
            var state = $(this).data('state');

            // var priority = $(this).data('priority');
            var priority = ++key;
            if ($(this).data('country') == country) {
                result[state] = priority;
            }
        });
        return (result);
    }



    $(document).on('click', '.Up_arrow', function() {
        var $clickedRow = $(this).closest('tr');
        var state = $clickedRow.attr('data-state');
        var $tbody = $clickedRow.closest('tbody');
        let country = $(this).data('country');


        var $matchingRows = $tbody.find('tr[data-state="' + state + '"]');

        var $firstMatch = $matchingRows.first();

        // Find the previous .move_state_td row group (not having same state)
        var $prevMoveState = $firstMatch.prevAll('.move_state_td').not('[data-state="' + state + '"]').first();

        if ($prevMoveState.length > 0) {
            // Insert matching rows before that previous .move_state_td
            $matchingRows.insertBefore($prevMoveState);
        } else {
            // No previous group — do nothing or handle differently
            console.log('No upper group to move to.');
            return false;
        }

        UpdatePriority(country);
    });

    $(document).on('click', '.down_arrow', function() {

        var $clickedRow = $(this).closest('tr');
        var state = $clickedRow.attr('data-state');
        var $tbody = $clickedRow.closest('tbody');
        let country = $(this).data('country');

        // Get all rows with the same data-state
        var $matchingRows = $tbody.find('tr[data-state="' + state + '"]');

        // Get the last row in the current group
        var $lastMatch = $matchingRows.last();

        // Find the next .move_state_td group with a different data-state
        var $nextMoveState = $lastMatch.nextAll('.move_state_td').not('[data-state="' + state + '"]').first();

        if ($nextMoveState.length > 0) {
            // Get all rows with the same state as the next group
            var nextState = $nextMoveState.attr('data-state');
            var $nextGroup = $tbody.find('tr[data-state="' + nextState + '"]');

            // Insert current group *after* the next group
            $matchingRows.insertAfter($nextGroup.last());
        } else {
            console.log('No lower group to move below.');
            return false;
        }

        UpdatePriority(country);
    });


    function UpdatePriority(country) {
        let all_state = getAllState(country);
        console.log(all_state);

        $.ajax({
            url: 'UpdateStatePriorrity',
            method: 'POST',
            dataType: 'json',
            data: {
                country: country,
                all_state: all_state,
            },
            success: function(response) {
                console.log(response);

            },
            error: function(status, xhr, error) {
                console.log(error);
                Swal.fire('Error', 'Something went wrong', 'error');
            }
        })
    }


    function GetAllStatePriority(state) {
        let arr = {};
        let i = 0;
        $('.find_tr_row').each(function(index) {
            let state_val = $(this).data('state');
            let lead_id = $(this).data('lead_id');


            if (state == state_val) {
                ++i;
                if (!arr[lead_id]) {
                    arr[lead_id] = i;
                }

            }
        });

        return arr;
    }
</script>