<style>
        /* Custom CSS for scrollbar */
        .scrollable-panel {
            max-height: 500px;
            overflow-y: auto;
            padding: 0;
            margin: 0;
            scrollbar-width: thin;
        }
        .panel-body {
            padding: 0;
        }
        .modal.in table th{
            padding: 2px 5px !important;
                font-weight: 600;
        }
    </style>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="d-flex align-items-center justify-content-between" style="margin-bottom: 10px;">
                <h2 style="font-size: 15px; font-weight: 500;  color: #444;">Shipping Options</h2>
                <button class="btn btn-primary btn-sm" onclick="manageExtraItems(<?=$prod_id?>)"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</button>
            </div>
            <!-- Scrollable panel for shipping options -->
            <div class="panel panel-default scrollable-panel" style="border-left: 0;border-right: 0">
                <div class="panel-body  ">
                    <form id="updateExtraItemsCat">
                        <input type="hidden" value="<?=$cat_ex_id?>" name="cat_ex_id">
                        <input type="hidden" value="<?=$prod_id?>" name="prod_id">
                        <input type="hidden" value="<?=$curr_id?>" name="curr_id">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Extra Item Name</th>
                                    <th>Description</th>
                                    <th style="text-align: center !important;">Flat Rate Price</th>
                                    <th style="text-align: center !important;">QTY 15-99</th>
                                    <th style="text-align: center !important;">Price QTY 100-299</th>
                                    <th style="text-align: center !important;">Price QTY 300+</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $main) : ?>
                                <tr>
                                    <td><input type="checkbox" name="list_ids[]" value="<?=$main['extra_id']?>" <?php if ($main['selected'] !== null) echo 'checked'; ?>></td>
                                    <td><?=$main['extra_name']?></td>
                                    <td><?=$main['extra_desc']?></td>
                                    <td class="text-center"><?=$main['extra_value']?></td>
                                    <td class="text-center"><?=$main['extra_value_1']?></td>
                                    <td class="text-center"><?=$main['extra_value_2']?></td>
                                    <td class="text-center"><?=$main['extra_value_3']?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>

            <div class="modelFooter text-right " style="margin-top: 10px;"> 
                <input type="submit" class="btn btn-success" id="submitButton" value="Submit" style=" background: #5cb85c !important; min-width: 200px;">
            </div>


        </div>
    </div>
</div>
<script>
$(document).ready(function() {
        $('td[style="cursor: pointer;"]').addClass('clickable');

    // Add a click event handler to the submit button
    $("#submitButton").click(function() {
        // Create a FormData object from the form
        var formData = new FormData(document.getElementById("updateExtraItemsCat"));

        // Send the form data via AJAX
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/UpdateCatExtraItems", // Replace with your server-side script URL
            data: formData,
            processData: false,  // Prevent jQuery from processing the data
            contentType: false,  // Set content type to false to let the server handle it
            success: function(response) {
                // Handle the response from the server
                if(response==1){
                    alert('List updation successfull');
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the AJAX request
                console.error(xhr.responseText);
            }
        });
    });
});
</script>