<style type="text/css">
.tbl_customer th{
	text-align: center;
	background-color: #955;
	color: #FFF;
}
.tbl_customer td{

	background-color: #EEE;
	color: #000;
	padding: 5px;
}
.tbl_customer button{
	height: 30px;
	padding: 5px;
	line-height: 15px;
	vertical-align: middle;
}
</style>
<div class="row" >
	<div class="col-md-12 col-sm-12 col-xs-12">

		<div class="x_panel container">

			<div class="x_title">

				<h2>Quotation > Manage Customer</h2>
				<div style="float:right; width: 25%; text-align: right;"> 
					Found <font color=blue><?php echo number_format($num_data); ?></font> rows<br>
					<b>Page:</b>
					<select id="page_select" onchange="showCustomer();">
						<?php
						for($i=1;$i<=$num_page;$i++){
							echo '<option value="'.$i.'" ';
							if($i==$page){
								echo 'selected';
							}
							echo '>'.$i.'</option>';
						}
						?>
					</select> / <?php echo $num_page; ?>
				</div>
				<div style="float:right; width: 30%; text-align: left;">
					<form id="form_search" method="post" onsubmit="$('#hidden_page_select').val($('#page_select').val());" action="<?php echo Yii::app()->request->baseUrl; ?>/quotation/customer">
						Search: 
						<input type="hidden" name="page" id="hidden_page_select">
						<input type="text" name="search" id="search_word" value="<?php echo $search; ?>">
						<button type="submit" class="btn btn-light" style="padding: 3px 6px; margin: 0px 0px 2px 0px;"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<div class="clearfix"></div>

			</div>

			<div class="row">
				
				<div class="col-md-9" id="d_show_customer">
					
				</div>
				<div id="d_add_edit_zone" class="col-md-3" style="border-left: solid 1px #AAF; padding: 10px;">
					<h5><i class="fa fa-plus"></i> New Customer</h5>
					<hr>
					<form name="form1" id="form1" action="<?php echo Yii::app()->request->baseUrl; ?>/quotation/addNewCustomer" target="hidden_frame" method="post">
						Customer Name : 
						<div style="text-align: center; ">
							<input type="text" name="add_cust_name" id="add_cust_name" style="width: 80%;" >
						</div>
						Customer Info : 
						<div style="text-align: center;">
							<textarea name="add_cust_info" id="add_cust_info" style="width: 80%;" ></textarea>
							<input type="hidden" name="user_id" value="<?php echo Yii::app()->user->getState('userKey'); ?>">
						</div>
					</form>
					<center><br>
						<input type="button" class="btn btn-success" value="Submit" style="width: 80%;" onclick="return addNewCustomer();">
					</center>
				</div>

			</div>

		</div>

	</div>	

</div>	

<!-- edit Customer Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
               <form name="form2" id="form2" action="<?php echo Yii::app()->request->baseUrl; ?>/quotation/editCustomerSubmit" target="hidden_frame" method="post">
					Customer Name : 
					<div style="text-align: center; ">
						<input type="hidden" name="edit_cust_id" id="edit_cust_id" >
						<input type="text" name="edit_cust_name" id="edit_cust_name" style="width: 80%;" >
					</div>
					Customer Info : 
					<div style="text-align: center;">
						<textarea name="edit_cust_info" id="edit_cust_info" style="width: 80%;" ></textarea>
					</div>
				</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="return editCustomerCheck();">Save</button>
            </div>
        </div>
    </div>
</div>

<iframe name="hidden_frame" style="display: none;"></iframe>

<script type="text/javascript">
showCustomer();

function addNewCustomer(){

	if( $('#add_cust_name').val()=="" ){
		alert("Please input Customer name.");
		return false;
	}

	if( $('#add_cust_info').val()=="" ){
		alert("Please input Customer info.");
		return false;
	}

	$('#form1').submit();

}

function showCustomer(){

	var page = $('#page_select').val();
	if(page==""){ page = 1; }

	$.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/showCustomer" ,
        data:{
	        "page":page,
	        "search":$('#search_word').val()
	    },
        success: function(resp){ 
            
			$('#d_show_customer').html(resp);
           
        }  
    });

}

function addCustomerSuccess(){
	showCustomer();

	$('#add_cust_name').val('');
	$('#add_cust_info').val('');

}

function editCustomer(cust_id){

	$('#edit_cust_id').val(cust_id);
	$('#edit_cust_name').val($('#td_cust_name'+cust_id).html());
	$('#edit_cust_info').val($('#pr_cust_info'+cust_id).html());

}

function editCustomerCheck(){

	if( $('#edit_cust_name').val()=="" ){
		alert("Please input Customer name.");
		return false;
	}

	if( $('#edit_cust_info').val()=="" ){
		alert("Please input Customer info.");
		return false;
	}

	$('#form2').submit();

}

function editCustomerSuccess(cust_id){

	$('#editCustomerModal').modal("toggle");
	
	$('#td_cust_name'+cust_id).html($('#edit_cust_name').val());
	$('#pr_cust_info'+cust_id).html($('#edit_cust_info').val());

	$('#edit_cust_id').val('');
	$('#edit_cust_name').val();
	$('#edit_cust_info').val();

}

function deleteCustomer(cust_id){

	if(confirm("Are you sure?")){
		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/deleteCustomer" ,
	        data:{
	            "cust_id":cust_id
	        },
	        success: function(resp){ 
	            
				if(resp.result=="success"){
					$('#tr_cust'+cust_id).fadeOut(500);
				}else{
					alert(resp.msg);
				}
	           
	        }  
	    });
	}

}
</script>