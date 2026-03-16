<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .x_panel {
        font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif !important;
    }

    input,
    select,
    textarea {
        border: 1px solid #D9E4EE !important;
        padding: 6px 20px;
        background: #FFFFFF !important;
        color: #444;
        font-weight: 400;
        width: 100%;
    }

    .select2.select2-container.select2-container--default {
        min-height: 30px;
        width: 100% !important;
        max-width: 100% !important;
    }

    .select2.select2-container.select2-container--default span {
        width: 100% !important;

    }

    .select2-container .select2-selection--multiple .select2-selection__rendered {
        position: absolute;
        left: 10px;
        top: 15px;
    }

    #select2-0lex-container {
        border: 1px solid #DDDDDD !important;
        background: #F9F9F9 !important;
        padding: 1vw;
        border-radius: 4px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__clear span {
        padding: 2px 5px;
        top: -4px;
        margin: 7px 0 0;
        border-radius: 0 4px 4px 0;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        border: 1px solid #D9E4EE;
        background: #ECF3F9;
        font-size: 14px;
    }

    .select2-container--default .select2-selection--multiple.select2-selection--clearable {
        padding-right: 5px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;

    }

    /* Replace */
    .adminLeadsPage .pageHeader .alert {
        background: #F4F8FB;
        color: #444444;
        font-size: 14px;
        border-radius: 4px;
        display: inline-flex;
        gap: 10px;
        align-content: center;
        padding: 0px 20px;
        margin: 10px 0;
    }

    .adminLeadsPage .pageHeader {
        line-height: 30px;
    }

    .adminLeadsPage .tableHeader button {
        border: 1px solid #5CB85C;
        background: #5CB85C0D;
        color: #5CB85C;
        padding: 4px 10px;
        border-radius: 2px;
        margin: 0;
        font-weight: 500;
        gap: 5px;
    }

    .rowSort button {
        margin: 0;
        border: 1px solid #d6d7d7;
        color: #4e4e4f;
        font-weight: 300;
        border-radius: 2px;

    }

    /* Replace */

    /* .adminLeadsPage input[type=checkbox] {
        height: 0;
        width: 0;
        visibility: hidden;
    } */

    /* 
    .adminLeadsPage label {
        cursor: pointer;
        text-indent: -9999px;
        width: 34px;
        height: 20px;
        background: grey;
        display: block;
        border-radius: 100px;
        position: relative;
    } */

    /* .adminLeadsPage label:after {
        content: '';
        position: absolute;
        top: 3px;
        left: 5px;
        width: 13px;
        height: 13px;
        background: #fff;
        border-radius: 90px;
        transition: 0.3s;
    } */

    /* .adminLeadsPage input:checked+label {
        background: #337AB7;
    }

    .adminLeadsPage input:checked+label:after {
        left: calc(100% - 18px);
        transform: translateX(-1%);
    }

    .adminLeadsPage label:active:after {
        width: 130px;
    } */


    /*  */
    .adminLeadsPage .grid2 {
        gap: 1vw;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 25px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 4px;
        bottom: 3px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>


<style>
    /* Background overlay */
    #popupOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        /* Hidden by default */
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    /* Popup content box */
    #popupBox {
        background: white;
        width: 30%;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    /* Close button */
    #popupBox .close-btn {
        float: right;
        font-size: 20px;
        cursor: pointer;
    }

    #popupBox .modal-footer {
        margin-top: 20px;
        text-align: right;
    }

    #popupBox .btn {
        padding: 8px 12px;
        margin-left: 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    #popupBox .btn-success {
        background-color: #28a745;
        color: white;
        border: none;
    }

    #popupBox .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }
</style>


<?
$is_enable = Yii::app()->db->createCommand("SELECT status from lead_distribution")->queryScalar();
?>

<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12  ">
            <div class="x_panel">
                <div class="adminLeadsPage">
                    <div class="pageHeader">
                        <h5 class="lSize primary">Assign Sales Reps to Regions</h5>
                        <div class="d-flex gap2">
                            <p class="sSize my-auto ">Enable/Disable Automatic Lead Distribution</p>

                            <label class="switch">

                                <input type="checkbox" id="toggle_checkbox" <? echo $is_enable == 1  ? 'checked' : '' ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="alert">
                            <figure><img src="../images/icons/info.png" alt="" class="iconImg"></figure> Automation is enabled. Leads will be assigned automatically based on the regions mapped to each sales rep.
                        </div>
                        <div class="text-right">
                            <button class="btn btn-sm btn-success "
                                onclick="openPopup()">Assigned Leads </button>
                        </div>
                    </div>

                    <div class="countryLeads">
                        <div class="grid2" id="output_div">

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>






<div class="modal fade smallModal" id="addSalesRepModal" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- modal header  -->
                <button type="button" class="close close_add_sales_rep" data-dismiss="modal">&times;</button>
                <h4 class="modal-title  ">Add Sales Rep</h4>
            </div>
            <form action="<?php echo Yii::app()->createUrl('leads/createSales'); ?>" method="post" id="add_new_sales_person">
                <div class="modal-body">
                    <div class=" ">
                        <div class="form-group ">
                            <label for="TSales Rep" class="blackLabel">Sales Rep</label>
                            <select class="js-select2" multiple="multiple" name="sales_name[]" required>
                                <?php
                                $user = User::model()->findAll("user_group_id = 2");
                                foreach ($user as $key => $value) {
                                ?>
                                    <option value="<?php echo $value['username']; ?>"><?php echo $value['fullname']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="hidden" class="form-control" id="country_name" name="country_name" value="">
                        <input type="hidden" name="state_name_hidden" id="state_hidden_name" value="">
                        <!-- <div>
                            <span class="btn btn-success addNewState">+</span>
                            <input type="text" name="stateadd" style="display: none;" class="instate  instatecanada">
                            <span class="btn btn-success instatesave" style="display: none;" onclick="addState('canada')">save</span>
                        </div> -->
                        <div class="form-group stateoption">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default close_add_sales_rep" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>




<!-- editDetailsModal  -->
<div class="modal fade smallModal" id="editDetailsModal" role="dialog">
    <div class="modal-dialog  ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- modal header  -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Details</h4>
            </div>


            <div class="modal-body">

                <div class="grid2">
                    <div class="form-group">
                        <label for="action_ype" class="blackLabel">Country</label>
                        <select class="form-select text-left" id="countrySelect" name="country" onchange="updateStates()">
                            <?
                            foreach ($country as $country_key => $country_value) {
                            ?>
                                <option value="<? echo $country_value['country_name'] ?>"> <? echo $country_value['country_name'] ?> </option>
                            <?
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <!-- <label for="action_ype" class="blackLabel">State</label>     -->
                        <div id="stateSelect">

                        </div>
                        <!-- <select id="stateSelect" class="form-select text-left">
                            <option value="">Select State</option>
                        </select> -->
                    </div>
                    <div class="form-group">
                        <label for="action_ype" class="blackLabel">Capacity</label>
                        <select class="form-select text-left" aria-label="Default select example" name="capacity" id="capacitySelect">
                            <option value="">Select Priority</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="action_ype" class="blackLabel">Priority</label>
                        <select class="form-select text-left" aria-label="Default select example" name="salesPriority" id="salesPrioritySelect">
                            <option value="">Select Priority</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>

                    <input type="hidden" name="sales_id" id="sales_id" value="">
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="" value="" id="tr_id_value">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn greenBtn Editform" data-dismiss="modal">Save</button>
            </div>

        </div>

    </div>
</div>


<!-- filter for unassigned leads  -->
<div id="popupOverlay">
    <div id="popupBox">
        <span class="close-btn" onclick="closePopup()">×</span>
        <h4>Assigned Leads</h4>
        <form id="unassigned_leads" action="<?php echo Yii::app()->createUrl('leads/AssignedMultipleSalesPerson'); ?>" method="POST" style="width: 100%;">


            <div class="edit_output_div">
                <select name="date_range" id="">
                    <option value="">Select Date Range</option>
                    <option value="1">Current Date</option>
                    <option value="2">Current Week</option>
                    <option value="3">Current Month</option>
                    <option value="4">Current Year</option>
                    <option value="5">All Time</option>
                </select>
            </div>


            <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-success">Add</button>
                <button type="button" class="btn btn-default btn-danger" onclick="closePopup()">Close</button>
            </div>

        </form>
    </div>
</div>


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.js"></script>


<script>
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
</script>

<script>
    function updateSalesPriority(value, id, filedName, ele = false, old_state = 0) {
        let tr_id = ele.getAttribute('data-tr_id');
        $('#' + tr_id).attr('data-state', value);
        let main_id = FindMainParentClass(old_state);
        let main_id1 = FindMainParentClass(value);
        let main_state_arr = GetAllStatePriority(old_state);
        let updated_state = GetAllStatePriority(value);

        $.ajax({
            type: 'POST',
            url: 'updatePriorty',
            data: {
                lead_id: id,
                value: value,
                filedName: filedName,
                old_state: old_state,
                main_state_arr: main_state_arr,
                updated_state: updated_state
            },
            success: function(response) {
                let resp = JSON.parse(response);
                let data = resp.data;
                let html = resp.html;
                let isMatched = false;
                if (resp.exsists == true) {
                    Swal.fire('Error', 'This salesperson has already been assigned to this state', 'error');
                    return;
                }

                if (filedName == 'state_name') {
                    removePreviousData(old_state);
                    removePreviousData(value);
                    main_id1.after('');
                    main_id.after('');
                    main_id1.after(resp.html2);
                    main_id1.addClass('test_cls');
                    main_id.after(resp.html);
                    main_id.addClass('test_cls2');
                    // $(ele).closest('tr').remove();
                    // UpdateDataRow(value ,html);
                    return;
                }


                UpdateOnlyRow(data, tr_id);
                // GetAllCountrySalesRep();
            },
            error: function(xhr, status, error) {
                // Handle errors if any
                console.error(xhr.responseText);
            }
        });
    }
</script>

<script>
    $(".addNewState").click(function() {
        $('.instate').show();
        $('.instatesave').show();
    });

    function addState(countryName) {
        var stateName = $('.instate' + countryName + '').val();
        var countryName = $('#country' + countryName + '').val();
        alert(stateName);
        alert(countryName);
        $.ajax({
            type: 'POST',
            url: 'addStateValue', // specify the URL to handle the update
            data: {
                stateName: stateName,
                countryName: countryName,
            },
            success: function(response) {
                $('.stateoption').html(response);
                $('.instate').val('');
            },
            error: function(xhr, status, error) {
                // Handle errors if any
                console.error(xhr.responseText);
            }
        });
    }


    function addSalesRepcounty(countryName, is_same) {
        $('#country' + countryName + '').val(countryName);
        $('#addSalesRepModal').css('display', 'block');
        $('#addSalesRepModal').addClass('in');

        $.ajax({
            type: 'POST',
            url: 'GetCountryValueForSalesRep', // specify the URL to handle the update
            data: {
                countryName: countryName,
                is_same: is_same
            },
            success: function(response) {
                $('.stateoption').html(response);
                $('#country_name').val(countryName);


                if ($('#multiple_state_val').length) {
                    $("#multiple_state_val").select2({
                        closeOnSelect: false,
                        placeholder: "Assigned to..",
                        allowHtml: true,
                        allowClear: true,
                        tags: true
                    });
                } else {
                    console.error("#multiple_state_val not found after AJAX!");
                }
            },
            error: function(xhr, status, error) {
                // Handle errors if any
                console.error(xhr.responseText);
            }
        });
    }

    function editSalesRepcounty(id, country, lead_capacity, state, sales_priority, is_same = 0, ele) {
        let countrySelect = document.getElementById("countrySelect");
        let stateSelect = document.getElementById("stateSelect");
        let capacitySelect = document.getElementById("capacitySelect");
        let salesPrioritySelect = document.getElementById("salesPrioritySelect");
        let tr_id = ele.getAttribute('data-tr_id');
        if (countrySelect) {
            countrySelect.value = country; // Set country
            updateStates(state, is_same); // Update states dropdown based on country
        }

        if (capacitySelect) {
            capacitySelect.value = lead_capacity; // Set Capacity
        }

        if (salesPrioritySelect) {
            salesPrioritySelect.value = sales_priority; // Set Sales Priority
        }

        $('#sales_id').val(id);
        $('#tr_id_value').val(tr_id);


    }

    function updateStates(selectedState = "", is_same) {
        let country = document.getElementById("countrySelect").value; // Get selected country

        $.ajax({
            type: "POST",
            url: 'GetCountryValueForSalesRep',
            data: {
                countryName: country,
                state: selectedState,
                is_same: is_same
            },
            success: function(response) {
                $('#stateSelect').html(response);
            },
            error: function(xhr, status, error) {
                console.log('error');
            }
        });


    }

    $('.Editform').click(function() {
        var country = $('#countrySelect').val();
        var state = $('#editDetailsModal .assignedTo').val();
        var old_state = $('#editDetailsModal .assignedTo').data('old_state');
        var capacity = $('#capacitySelect').val();
        var salesPriority = $('#salesPrioritySelect').val();
        var sales_id = $('#sales_id').val();
        var ele = $(this).closest('tr');
        var tr_id = $('#tr_id_value').val();

        let main_id = FindMainParentClass(old_state);
        let main_id1 = FindMainParentClass(state);


        // console.warn("state..." +state);
        // return false ; 

        $.ajax({
            type: 'POST',
            url: 'updateSales', // specify the URL to handle the update
            data: {
                country: country,
                state: state,
                capacity: capacity,
                salesPriority: salesPriority,
                sales_id: sales_id,
                old_state: old_state,
            },
            success: function(response) {

                let resp = JSON.parse(response);
                console.log(resp);
                let data = resp.data;
                let html = resp.html;
                if (resp.exsists == true) {
                    Swal.fire('Error', 'This salesperson has already been assigned to this state', 'error');
                    return;
                }
                if (resp.html2) {
                    removePreviousData(old_state);
                    removePreviousData(state);
                    main_id.after('');
                    main_id1.after('');
                    main_id.after(resp.html2);
                    main_id1.after(html);
                } else {
                    $('#' + tr_id).closest('tr').remove();
                    UpdateDataRow(state, html);
                }

                //    UpdateOnlyRow(data ,tr_id);

                // $('#editDetailsModal').modal('hide');
                // GetAllCountrySalesRep(sales_id ,tr_id);

            },
            error: function(xhr, status, error) {
                console.error('Error updating:', error);
                Swal.fire({
                    title: 'Something went wrong',
                    icon: 'warning',
                    confirmButtonText: 'Got it!'
                });
            }
        });
    });



    function GetAllCountrySalesRep(id = 0) {
        // $('#sales_'+id).html('');
        showLoader();
        $.ajax({
            url: 'getCountrySalesRep',
            method: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                hideLoader();
                $('#output_div').html(response);


            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Can not get the data',
                    icon: 'warning',
                    confirmButtonText: 'Got it!'
                });
                hideLoader();

            }
        })

    }

    $(document).ready(function() {
        GetAllCountrySalesRep();
    })

    $(document).on('change', '#toggle_checkbox', function() {
        let selected_val = $('#toggle_checkbox').is(':checked');


        $.ajax({
            url: 'enableLeadAssignment',
            method: 'POST',
            data: {
                status: selected_val,
            },
            success: function(response) {
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


    });

    $(document).on('change', '.state_dropdown', function() {
        let val = $(this).find('option:selected').attr('data-state');
        console.log("selected state" + val);
        $('#state_hidden_name').val(val);
    });


    $(document).on('submit', '#add_new_sales_person', function(event) {
        event.preventDefault();
        let form = $(this);
        let url = form.attr('action');
        let method = form.attr('method');
        let data = form.serialize();
        $.ajax({
            type: method,
            url: url, // specify the URL to handle the update
            data: data,
            success: function(response) {
                GetAllCountrySalesRep();

                $('#addSalesRepModal').css('display', 'none');
                $('#addSalesRepModal').removeClass('in'); // remove the backdrop
                form[0].reset();
            },
            error: function(xhr, status, error) {
                // Handle errors if any
                console.error(xhr.responseText);
            }
        });
    });


    $(document).on('click', '.close_add_sales_rep', function() {
        $('#addSalesRepModal').css('display', 'none');
        $('#addSalesRepModal').removeClass('in'); // remove the backdrop
    });

    function UpdateOnlyRow(data, tr_id) {
        console.log(data);

        let priority = data['sales_priority'];
        let lead_capacity = data['lead_capacity'];
        let name = data['fullname'];
        let state = data['state_name'];

        console.log(priority, lead_capacity, name, state);

        $('#' + tr_id).find('.sales_priority_select').val(priority).prop('selected', true);
        $('#' + tr_id).find('.lead_capcity_select').val(lead_capacity).prop('selected', true);
        $('#' + tr_id).find('.fullname').text(name);
        $('#' + tr_id).find('.state_select_ele').val(state).prop('selected', true);
        $('#' + tr_id).attr('data-state', state);
    }

    function UpdateDataRow(state, html) {
        let isMatched = false;
        $('.find_tr_row').each(function(index) {
            let data_state = $(this).data('state');
            if (state == data_state) {
                console.log('matched');
                $(this).after(html);
                isMatched = true;
                return false;
            }

        });


        if (!isMatched) {
            console.log("not matched")
            GetAllCountrySalesRep();
            return false;
        }
    }


    function FindMainParentClass(state) {
        let matchingStateRow = $('.move_state_td').filter(function() {
            return $(this).data('state') == state;
        });
        return matchingStateRow;
    }

    function removePreviousData(state) {
        $('.find_tr_row').each(function(index) {
            if ($(this).data('state') == state) {
                $(this).remove();
            }
        });
    }
</script>


<script>
    // assign multiple leads 
    $(document).on('submit', '#unassigned_leads', function(event) {
        event.preventDefault();
        let form = $(this);
        let data = form.serialize();
        showLoader();
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: data,
            success: function(response) {
                hideLoader();
                closePopup();
                let resp = JSON.parse(response);
                form[0].reset();
                Swal.fire('success', 'Leads Assigned', 'success');
            },
            error: function(xhr, status, error) {
                console.warn("something went wrong");
                hideLoader();
            }
        })
    });

    function openPopup() {
        document.getElementById("popupOverlay").style.display = "flex";
    }

    function closePopup() {
        document.getElementById("popupOverlay").style.display = "none";
    }
</script>

<?
if (Yii::app()->user->hasFlash('error')) {
    echo '<script>Swal.fire("Cancelled", "' . Yii::app()->user->getFlash('error') . '", "error")</script>';
}
?>