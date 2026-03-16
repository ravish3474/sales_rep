<style type="text/css">
.tbl_content th{
	background-color: <?php echo $head_color; ?>;
	color: #FFF;
	padding: 5px;
	text-align: center;
}
.tbl_content tr:hover td{
	background-color: #EEE;
}
.tbl_content td{
	padding: 5px;
	text-align: center;
}
#quote_doc_head{
    border-bottom: 2px solid #EEE;
    padding-bottom: 0px;
}
#quote_doc_head img{
    max-height: 180px;
    max-width: 180px;
}
#quote_doc_head h2{
    font-size: 28px;
    font-weight: bold;
    color: #000;
}
.show_date_reject{
	border: solid 1px #FBB;
	background-color: #F55;
	border-radius: 5px;
	padding: 2px 2px;
	margin: 0px 3px; 
	font-size: 11px;
	font-weight: bold;
	color: #FFF;
	height: 18px;
	line-height: 1;
	vertical-align: middle;
}
.show_date_approve{
	border: solid 1px #BFB;
	background-color: #595;
	border-radius: 5px;
	padding: 2px 2px;
	margin: 0px 3px; 
	font-size: 11px;
	font-weight: bold;
	color: #FFF;
	height: 18px;
	line-height: 1;
	vertical-align: middle;
}
.btn{
	font-size: 12px;
	font-weight: bold;
	padding: 3px;
	margin: 1px;
}
.cnt_inv{
	float: left;
	font-style: italic;
	font-weight: bold;
}
.btn_edit_inv{
	float: right;
	font-size: 18px;
	cursor: pointer;
}
/*#quote_doc_head pre, #quote_doc_body pre{

    border:0px;
    background-color: #FFF;
    font-size: 14px;
    color: #000;
    line-height: 1;
    margin: 0px;
}*/


/*.est_zone th{
    text-align: right;
    color: #000;
}
.est_zone td{
    text-align: left;
    color: #000;
    padding-left: 10px;
}
.item_zone{
    color: #000;
}
.item_zone th{
    font-size: 15px;
}
.item_zone td{
    font-size: 13px;
}
.total_zone td{
    padding: 10px 0px; 
}*/
.edit_ap{
	font-size: 18px;
	color: #F00;
	cursor: pointer;
}
.edit_req_by{
	font-size: 16px;
	color: #F00;
	cursor: pointer;
}
</style>
<?php
$user_group = Yii::app()->user->getState('userGroup');
$user_id = Yii::app()->user->getState('userKey');
$full_name =Yii::app()->user->getState('fullName');
if ($user_group=="99" || $user_group=="1") {
	$chat_type = "A";
}
else{
	$chat_type = "E";
}
?>
<div class="row">



	<div class="col-md-12 col-sm-12 col-xs-12">

		<div class="x_panel">

			<div class="x_title">

				<h2>Quotation > <?php echo $page_title; ?></h2>
				<input type="hidden" id="edit_reject_quote" value="no">
				<div style="float:right; width: 25%; text-align: right;">
					Found <font color=blue><?php echo number_format($num_data); ?></font> rows<br>
					<b>Page:</b> 
					<select id="page_select" onchange="changePage('<?php echo $act_page; ?>');">
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
					<form id="form_search" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/quotation/searchList">
						Search: 
						<input type="text" name="search" id="search_word" value="<?php echo $search; ?>">
						<button type="submit" class="btn btn-light" style="padding: 3px 6px; margin: 0px 0px 2px 0px;"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<div class="clearfix"></div>

			</div>

			<div class="x_content">

				<table class="tbl_content" style="width: 100%;">
					<tr>
						<th>#</th><th>Request by</th><th>Estimate Number</th><th style="text-align: left;">Customer</th>
						<th>Estimate Date</th><th>EXP. Date</th><th>Items</th><th>QTY</th><th>Grand Total</th><th>Currency</th><th>Status</th>
						<?php
						if($act_page=="approveList" || $act_page=="archived" || $act_page=="searchList"){
							?>
							<th>Invoice No.</th>
							<?php
						}
						?>
						<th>Action</th>
					</tr>
					<?php
					$n_count_req_edit = 0;
					$n_count = (($page-1)*$data_per_page)+1;
					foreach ( $quote_doc as $key1 => $row_quote_doc ) {

						$show_status = strtoupper($row_quote_doc["approve_status"]);
						if($row_quote_doc["approve_status"]=="approve"){
							$show_status = "APPROVED".'<div class="show_date_approve">'.date("Y-m-d H:i",strtotime($row_quote_doc["approve_date"])).'</div>';
						}else if($row_quote_doc["approve_status"]=="reject"){
							$show_status = "REJECTED".'<div class="show_date_reject">'.date("Y-m-d H:i",strtotime($row_quote_doc["reject_time"])).'</div>';
						}
					?>
						<tr <?php if( $row_quote_doc["is_editing"]=="1" && ($user_group=="1" || $user_group=="99") ){ echo 'style="background-color:#FFA;"'; }else if($row_quote_doc["is_duplicate"]=="1"){ echo 'style="background-color:#FAA;"'; }  ?> >
							<td><?php echo $n_count; ?></td>
							<td>
								<?php 
								echo $row_quote_doc["fullname"]; 
								if($user_group=="1" || $user_group=="99"){
									echo ' <i class="edit_req_by fa fa-pencil" data-toggle="modal" data-target="#requestByEditModal" onclick="return showReqByEdit(\''.$row_quote_doc["qdoc_id"].'\',\''.$row_quote_doc["user_id"].'\');"></i>';
								}
								?>
								
							</td>
							<td id="td_est_number<?php echo $row_quote_doc["qdoc_id"]; ?>"><?php echo $row_quote_doc["est_number"]; ?></td>
							<td style="text-align: left;"><?php echo $row_quote_doc["cust_name"]; ?></td>
							<td><?php echo date("M. d, Y",strtotime($row_quote_doc["est_date"])); ?></td>
							<td><?php echo date("M. d, Y",strtotime($row_quote_doc["exp_date"])); ?></td>
							<td id="td_num_item<?php echo $row_quote_doc["qdoc_id"]; ?>"><?php echo $row_quote_doc["num_item"]; ?></td>
							<td><?php echo $row_quote_doc["sum_qty"]; ?></td>
							<td><?php echo number_format($row_quote_doc["grand_total"],2); ?></td>
							<td><?php echo $row_quote_doc["quote_curr"]; ?></td>
							<td style="width: 110px;"><?php echo $show_status; ?></td>
							<?php
							if( $act_page=="approveList" || $act_page=="archived" || $act_page=="searchList" ){

								$s_inv = "";
								if($row_quote_doc["inv_no"]!=""){
									$s_inv = str_replace(",", "<br>", $row_quote_doc["inv_no"]);
								}
								?>
								<td>
									<?php

									if( ($user_group=="1" || $user_group=="99") && ($row_quote_doc["approve_status"]!="reject") && ($row_quote_doc["approve_status"]!="new") && ($row_quote_doc["is_duplicate"]=="0") ){

									?>
									<div class="cnt_inv" id="d_inv<?php echo $row_quote_doc["qdoc_id"]; ?>"><?php echo $s_inv; ?></div>
									<i class="fa fa-pencil btn_edit_inv" data-toggle="modal" data-target="#editINVModal" onclick="return editInvoice(<?php echo $row_quote_doc["qdoc_id"]; ?>);"></i>
									<?php
									}else{
										echo $s_inv;
									}
									?>
								</td>
								<?php
							}
							?>
							<td style="text-align: right; padding: 0px 3px;">
								
							<?php
							$user_group = Yii::app()->user->getState('userGroup');

							if($row_quote_doc["is_duplicate"]=="0"){
								if( $row_quote_doc["approve_status"]=="approve" ){
									
									?>
									<button type="button" class="btn btn-info" data-toggle="modal" data-target="#cartV2Modal" onclick="sendToCart(<?php echo $row_quote_doc["qdoc_id"]; ?>,'equote_aa');">Edit</button>
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>,'vp');">View</button>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>,'vc');" title="View Commission">Comm.</button>
									<button type="button" class="btn btn-danger" onclick="return deleteQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>);">Delete</button>
								<?php
									/*if( $row_quote_doc["is_editing"]=="0" ){

										 ?>
										<button type="button" data-toggle="modal" data-target="#quoteDocRequestEditModal" class="btn btn-info" onclick="return requestEditQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>);" title="Request Edit">Req. Edit</button>
										<?php 
										
									}else if( $row_quote_doc["is_editing"]=="1" && ($user_group=="1" || $user_group=="99") ){
										$n_count_req_edit++;

									?>
									<button type="button" data-toggle="modal" data-target="#cartV2Modal" class="btn btn-warning" onclick="sendToCart(<?php echo $row_quote_doc["qdoc_id"]; ?>,'quote_rej');">Edit by Req.</button>
									<?php
									}else if( $row_quote_doc["is_editing"]=="1" && ($user_group!="1" && $user_group!="99") ){
									?>
									<button type="button" class="btn btn-warning" disabled>Waiting for Edit</button>
									<?php
									}else if( $row_quote_doc["is_editing"]=="2" ){
									?>
									<button type="button" class="btn btn-warning" onclick="setAcknowledge(<?php echo $row_quote_doc["qdoc_id"]; ?>);">Acknowledge</button>
									<?php
									}*/

								}else if($row_quote_doc["approve_status"]=="new"){
		
									if( $user_group=="1" || $user_group=="99" ){
									?>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>,'va');">View & Approve</button>
									<?php
									}else{
									?>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>,'vb');">View</button>
									<?php
									}
								}else if( $row_quote_doc["approve_status"]=="reject" ){
									?>
									<button type="button" class="btn btn-info" data-toggle="modal" data-target="#cartV2Modal" onclick="sendToCart(<?php echo $row_quote_doc["qdoc_id"]; ?>,'quote_rej');">Edit</button>
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>,'v');">View</button>
									<button type="button" class="btn btn-danger" onclick="return deleteQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>);">Delete</button>
									
									<?php
								}else{
								?>
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#cartV2Modal" onclick="sendToCart(<?php echo $row_quote_doc["qdoc_id"]; ?>,'equote_aa');">Edit</button>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>,'v');">View</button>
								<?php
								}
							}

							if( $row_quote_doc["archive"]=="0" && $row_quote_doc["approve_status"]!="new"  ){
								?>
								<button type="button" class="btn btn-dark" onclick="saveToArchive(<?php echo $row_quote_doc["qdoc_id"]; ?>);">Archive</button>
								<?php
							}else if( $row_quote_doc["approve_status"]!="new" ){

								
								if($row_quote_doc["is_duplicate"]=="0"){
								?>
								<button type="button" class="btn btn-success" onclick="return duplicateQuote(<?php echo $row_quote_doc["qdoc_id"]; ?>);" title="Duplicate">Dup.</button>
								<?php
										
								}else{
								?>
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#cartV2Modal" onclick="sendToCart(<?php echo $row_quote_doc["qdoc_id"]; ?>,'quote_rej');">Edit</button>
								<button type="button" class="btn btn-danger" onclick="return deleteQuotation(<?php echo $row_quote_doc["qdoc_id"]; ?>);">Delete</button>
								<!-- <button type="button" class="btn btn-warning" onclick="addDuplicateToCart(<?php echo $row_quote_doc["qdoc_id"]; ?>);">Add To Cart</button> -->
								<?php
								}
								
							}
							?>
							</td>
						</tr>
					<?php
						$n_count++;
					}
					?>

				</table>

				<?php

					/*foreach ($files as $key => $value) {

				?>

					<li>

						<a href="<?php echo Yii::app()->request->baseUrl; ?>/docs/downloadFile/id/<?php echo $value['id']; ?>">

							<?php echo Helper::getIconFile($value['file_type']) . $value['file_name']; ?>

						</a>

					</li>

				<?php

					}*/

				?>

				

			</div>

		</div>



	</div>	

</div>	



<!-- Quotation DOC Request Edit-->
<div class="modal fade" id="quoteDocRequestEditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title">Request for quotation editing: <span id="sp_show_est_number"></span></h4>
         	</div>
            <div id="qdoc_edit_content" class="modal-body" style="max-height: 500px;" >
            	<form id="qdoc_edit_form">
            		<input type="hidden" id="edit_qdoc_id" name="edit_qdoc_id">
            		Notes:
            		<textarea name="edit_note" id="edit_note" style="width: 100%; height: 136px; min-height: 135px; margin: 3px; resize: none;"></textarea>
				</form>
            </div>
            <div id="qdoc_edit_btn_bar" class="modal-footer">
                <button style="float:right;" id="btn_submit_edit" type="button" class="btn btn-success" onclick="return submitRequestEdit();">Submit request</button>
            </div>
        </div>
    </div>
</div>

<!-- Invoice Edit-->
<div class="modal fade" id="editINVModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title">Enter Invoice No.</h4>
         	</div>
            <div class="modal-body" >
            	<input type="text" id="inv_value" name="inv_value" style="width: 100%; text-align: center;">
            	<input type="hidden" id="edit_inv_qdoc_id">
            	<div style="color: #F00; font-size: 14px; text-align: center; width: 100%; padding: 0px; margin:0px;">* Use "," for separate the Invoice numbers. <br><u>Ex</u>: 00000000,11111111,222222222</div>
            </div>
            <div  class="modal-footer">
                <center><button style="" id="btn_submit_edit" type="button" class="btn btn-success" onclick="return submitInvoice();"> Submit </button></center>
            </div>
        </div>
    </div>
</div>

<!-- Edit Request by-->
<div class="modal fade" id="requestByEditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title">Select new Request by</h4>
         	</div>
            <div class="modal-body" style="max-height: 500px;" >
            	
            	<input type="hidden" id="edit_reqby_qdoc_id" value="">
            	User : <select id="edit_reqby_user_id">
            	<?php
            	$sql_user = " SELECT id,fullname,username FROM user WHERE enable=1 AND user_group_id IN (1,99,2) ORDER BY fullname ASC;";
				$a_user_data = Yii::app()->db->createCommand($sql_user)->queryAll();
				for($i=0;$i<sizeof($a_user_data);$i++){
					echo '<option value="'.$a_user_data[$i]["id"].'">'.$a_user_data[$i]["fullname"].' ('.$a_user_data[$i]["username"].')</option>';
				}
            	?>
				</select>
            </div>
            <div class="modal-footer">
                <button style="float:right;" type="button" class="btn btn-success" onclick="return submitReqByEdit();">Submit</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$( document ).ready(function() {

    setTimeout(function() {

    }, 2000);

});
/*function checkUseNotePattern(){
	if($('#use_note_patt').prop("checked")){
		if(!confirm("Use Note pattern will clearing the text box below. Confirm?")){
			$('#use_note_patt').prop("checked",false);
			return false;
		}
		$('#note_text').val("");
		$('#select_qnote_id').val("");
		$('#select_qnote_id').attr("disabled",false);

	}else{
		$('#select_qnote_id').attr("disabled",true);
	}
}

function saveNewNote(){

	if($('#note_text').val()==""){
		alert("Please input note");
		return false;
	}

	var note_name = prompt("Note name :");

	if( note_name=="" || note_name==null ){
		alert("Please input note name");
		return false;
	}

	$.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/saveNewNote" ,
        data:{
            "note_name":window.btoa(note_name),
            "note_text":window.btoa($('#note_text').val())
        },
        success: function(resp){ 
            if(resp.result=="success"){

            	var inner_select = '<option value="'+resp.qnote_id+'">'+window.atob(resp.qnote_name)+'</option>';
            	$('#select_qnote_id').append(inner_select);
            	var inner_hidden = '<div id="qnote'+resp.qnote_id+'">'+resp.qnote_text+'</div>';
            	$('#hidden_note').append(inner_hidden);

            	alert("Note has been saved.");

            }else{
            	alert(resp.msg);
            }
        }  
    });

}

function changeNotePattern(){

	var qnote_id = $('#select_qnote_id').val();
	if(qnote_id==""){
		$('#note_text').val("");
	}else{
		$('#note_text').val( window.atob( $('#qnote'+qnote_id).html() ) );
	}

}*/

function quotationApprove(){

	if(confirm("Confirm to approve this Quotation?")){

		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/approveQuote" ,
	        data:$('#app_quote').serialize(),
	        success: function(resp){ 
	            if(resp.result=="success"){

	            	location.reload();

	            }else{
	            	alert(resp.msg);
	            }
	        }  
	    });
		
	}

}

function quotationReject(){

	if(confirm("Confirm to reject this Quotation?")){
		//var qdoc_id = $('#qdoc_id').val();
		//var note_text = window.btoa($('#note_text').val());

		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/rejectQuote" ,
	        data:$('#app_quote').serialize(),
	        success: function(resp){ 
	            if(resp.result=="success"){

	            	location.reload();

	            }else{
	            	alert(resp.msg);
	            }
	        }  
	    });
	}

}

function quotationRejectxx(){

	if(confirm("Confirm to reject this Quotation?")){
		var qdoc_id = $('#qdoc_id').val();
		var note_text = window.btoa($('#note_text').val());

		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/updateQuoteNote" ,
	        data:{
	            "qdoc_id":qdoc_id,
	            "note_text":note_text,
	            "approve_status":"reject"
	        },
	        success: function(resp){ 
	            if(resp.result=="success"){

	            	location.reload();

	            }else{
	            	alert(resp.msg);
	            }
	        }  
	    });
	}

}

function showQuoteHistory(){

	var qdoc_id = $('#select_history').val();
	
	if($('#main_qdoc_id').val()==qdoc_id){
		viewQuotation(qdoc_id,'va');
	}else{

		$('#d_quote_body').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/showQuoteView" ,
	        data:{
	            "qdoc_id":qdoc_id,
	            "action_from":'v'
	        },
	        success: function(resp){ 
	            $('#d_quote_body').html(resp.inner_content); 

	            $('#d_approval_comment').html(window.atob(resp.approval_comment));

	            $('#head_selector_app').hide();
	            $('#quote_approve_bar').hide();
	            $('#d_quote_below').hide();
	           
	        }  
	    });
	}
}



function printQuotation(){

	var qdoc_number = $("#qdoc_number").html();

	var divContents = $("#d_quote_body").html();
    var printWindow = window.open('', '', 'height=2000,width=1200');
    printWindow.document.write('<html><head><title>'+qdoc_number+'</title>');
    printWindow.document.write('</head><body >');
    printWindow.document.write(divContents);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();

}

function changeIncludeVATApprove(){

    var total_value = 0.0;

    if($('#inc_vat_app').prop("checked")){

    	var vat_value = parseFloat($('#vat_value_app').val());
        $('#sp_show_vat_value_app').html($('#pre_cost_app').val()+vat_value.toFixed(2));

        //var sub_total = parseFloat($('#sub_total').val());

        total_value = parseFloat($('#sub_total_app').val())+parseFloat($('#vat_value_app').val());
        $('#sp_show_total_value_app').html($('#pre_cost_app').val()+total_value.toFixed(2));
        $('#total_value_app').val(total_value);

        $('#sp_show_gtotal_value_app').html($('#pre_cost_app').val()+total_value.toFixed(2));
        //$('#gtotal_value').val(total_value);

        $('#td_grand_total_app').html($('#pre_cost_app').val()+total_value.toFixed(2));
    }else{
        $('#sp_show_vat_value_app').html('');

        total_value = parseFloat($('#sub_total_app').val());
        $('#sp_show_total_value_app').html($('#pre_cost_app').val()+total_value.toFixed(2));
        $('#total_value_app').val(total_value);

        $('#sp_show_gtotal_value_app').html($('#pre_cost_app').val()+total_value.toFixed(2));
        //$('#gtotal_value').val(total_value);

        $('#td_grand_total_app').html($('#pre_cost_app').val()+total_value.toFixed(2));
    }

}

function calComm(){

	var comm_total = 0.0;
	$('.qdoci_id_app').each(function(){
		var row_id = $(this).val();

		tmp_amount = $('#tmp_amount'+row_id).val();
		comm_percent = $('#comm_percent_app'+row_id).val();

		comm_val = (comm_percent/100)*tmp_amount;

		$('#comm_val_app'+row_id).html(comm_val.toFixed(2));

		comm_total += comm_val;
	});

	$('#td_comm_total').html(comm_total.toFixed(2));

}

function saveToArchive(qdoc_id){
	if(confirm("Save this Quotation to Archive?")){
		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/saveToArchive" ,
	        data:{
	            "qdoc_id":qdoc_id
	        },
	        success: function(resp){ 
	            if(resp.result=="success"){

	            	location.reload();

	            }else{
	            	alert(resp.msg);
	            }
	        }  
	    });
	}
}

function changeQuoteHeadApp(){

	var head_select = $('#head_selector_app').val();

    var obj_comp = $.parseJSON( window.atob($('#hide_comp_info_app'+head_select).val()) );

    //alert( window.atob($('#hide_comp_info'+head_select).val()) );

    var head_img_logo = "";
    if( obj_comp.comp_logo!="" && obj_comp.comp_logo != null){
        head_img_logo = '<img style="max-height: 180px; max-width: 180px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/'+obj_comp.comp_logo+'" >';
        $('#head_img_logo_app').html(head_img_logo);
    }else{
    	$('#head_img_logo_app').html('');
    }

    //alert(obj_comp.have_vat);

    if(obj_comp.have_vat=="1"){
        $('.subnvat').show();
    }else{
        $('.subnvat').hide();
    }

    var pre_comp_info = '<b>'+obj_comp.comp_name+'</b><br>'+obj_comp.comp_info;
    $('#pre_comp_info_app').html(pre_comp_info);

    $('#note_text').val(obj_comp.qnote_text);

}



function deleteQuotation(qdoc_id){

	if(confirm("Confirm to delete this Quotation?")){
		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/deleteQuote" ,
	        data:{
	            "qdoc_id":qdoc_id
	        },
	        success: function(resp){ 
	            if(resp.result=="success"){

	            	location.reload();

	            }else{
	            	alert(resp.msg);
	            }
	        }  
	    });
	}else{
		return false;
	}
	
}

function calPriceVA(){

	var amount_total = 0.0;
	$('.qdoci_id_app').each(function(){
		var qdoci_id = $(this).val();

		row_qty = $('#app_qty'+qdoci_id).val();
		row_uprice = $('#app_uprice'+qdoci_id).val();

		amount_val = row_qty*row_uprice;

		$('#sp_app_amount'+qdoci_id).html(amount_val.toFixed(2));

		amount_total += amount_val;
	});

	$('#sp_app_sub_total').html(amount_total.toFixed(2));

	$('#sub_total_app').val(amount_total);
	tmp_vat = amount_total*0.07;
	$('#vat_value_app').val(tmp_vat);

	changeIncludeVATApprove();

}

function changePage(act_page){

	var page_select = $('#page_select').val();
	window.location.href = "<?php echo Yii::app()->request->baseUrl; ?>/quotation/"+act_page+"?page="+page_select+"&search="+window.btoa($('#search_word').val());

}

function requestEditQuotation(qdoc_id){

	$('#edit_qdoc_id').val(qdoc_id);

	$('#sp_show_est_number').html($('#td_est_number'+qdoc_id).html());

}

function submitRequestEdit(){

	if($('#edit_note').val()==""){
		alert("Please input Notes");
		return false;
	}

	$.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/saveRequestEditNotes" ,
        data:$('#qdoc_edit_form').serialize(),
        success: function(resp){ 
            if(resp.result=="success"){

            	location.reload();

            }else{
            	alert(resp.msg);
            }
        }  
    });
}

function setAcknowledge(qdoc_id){
	$.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/setAcknowledge" ,
        data:{
	        "qdoc_id":qdoc_id
	    },
        success: function(resp){ 
            if(resp.result=="success"){

            	location.reload();

            }else{
            	alert(resp.msg);
            }
        }  
    });
}

function duplicateQuote(qdoc_id){

	if(!confirm("Do you want to duplicate "+$('#td_est_number'+qdoc_id).html()+" ?")){
		return false;
	}

	$.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/duplicateQuote" ,
        data:{
	        "qdoc_id":qdoc_id
	    },
        success: function(resp){ 
            if(resp.result=="success"){

            	location.reload();

            }else{
            	alert(resp.msg);
            }
        }  
    });
}

function editSaleNote(qdoc_id){

	var sale_note = $('#pre_sale_note'+qdoc_id).html();

	var inner_note = '<textarea style="width:100%; height:100px; color:#000;" id="edit_sale_note">'+sale_note+'</textarea>';

	$('#pre_sale_note'+qdoc_id).html(inner_note);

	$('#btn_edit_sale_note').attr("disabled",true).css("background-color","#FFF");
	$('#btn_save_sale_note').attr("disabled",false).css("background-color","#DDD");

}

function saveSaleNote(qdoc_id){

	var edit_sale_note = window.btoa($('#edit_sale_note').val());

	$.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/updateSaleNote" ,
        data:{
	        "qdoc_id":qdoc_id,
	        "edit_sale_note":edit_sale_note
	    },
        success: function(resp){ 
            if(resp.result=="success"){

            	$('#pre_sale_note'+qdoc_id).html($('#edit_sale_note').val());

				$('#btn_edit_sale_note').attr("disabled",false).css("background-color","#DDD");
				$('#btn_save_sale_note').attr("disabled",true).css("background-color","#FFF");

            }else{
            	alert(resp.msg);
            }


        }  
    });

}

function refreshDate(){
	var qdoc_id = $('#main_qdoc_id').val();
	if(confirm("This action will update Estimate Date and Expire Date permanently. Confirm?")){

		$('#show_est_date').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>');
		$('#show_exp_date').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>');

		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/refreshDate" ,
	        data:{
		        "qdoc_id":qdoc_id
		    },
	        success: function(resp){ 
	            if(resp.result=="success"){
	            	
	            	$('#show_est_date').html(resp.est_date);
	            	$('#show_exp_date').html(resp.exp_date);

	            }else{
	            	alert(resp.msg);
	            }


	        }  
	    });
	}
	
}

function editInvoice(qdoc_id){

	var inv_show = $('#d_inv'+qdoc_id).html();

	$('#edit_inv_qdoc_id').val(qdoc_id);
	inv_value = inv_show.replace(/<br>/g ,",");

	$('#inv_value').val(inv_value);	

}

function submitInvoice(){

	var qdoc_id = $('#edit_inv_qdoc_id').val();
	var inv_value = $('#inv_value').val();

	$.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/submitInvoice" ,
        data:{
	        "qdoc_id":qdoc_id,
	        "inv_value":inv_value
	    },
        success: function(resp){ 
            if(resp.result=="success"){
            	
            	$('#d_inv'+qdoc_id).html(resp.inv_show);
            	$('#edit_inv_qdoc_id').val('');
            	$('#inv_value').val('');

            	$('#editINVModal').modal("toggle");

            }else{
            	alert(resp.msg);
            }


        }  
    });

}

function editPONumber(qdoc_id){
	
	var po_number = $('#sp_po_number'+qdoc_id).html();

	var new_po_number = prompt("PO Number:",po_number);

	if(new_po_number!=null ){

		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/editPONumber" ,
	        data:{
		        "qdoc_id":qdoc_id,
		        "po_number":window.btoa(new_po_number)
		    },
	        success: function(resp){ 
	            if(resp.result=="success"){
	            	
	            	$('#sp_po_number'+qdoc_id).html(new_po_number);

	            }else{
	            	alert(resp.msg);
	            }


	        }  
	    });
	}

}

function editCommAfterApprove(qdoc_id,qdoci_id,comm_percent){

	var new_comm = prompt("Edit Commission percent:",comm_percent);

	if(new_comm!=null){
		//alert('qdoc_id='+qdoc_id+',qdoci_id='+qdoci_id+',comm_percent='+comm_percent+',new_comm='+new_comm);

		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/editCommAfterApprove" ,
	        data:{
		        "qdoci_id":qdoci_id,
		        "new_comm":new_comm,
		        "qdoc_id":qdoc_id,
		        "comm_percent":comm_percent
		    },
	        success: function(resp){ 
	            if(resp.result=="success"){
	            	
	            	viewQuotation(qdoc_id,'vc');

	            }else{
	            	alert(resp.msg);
	            }


	        }  
	    });
	}

}

function editUPriceAfterApprove(qdoc_id,qdoci_id,uprice){

	var new_uprice = prompt("Edit Price:",uprice);

	if(new_uprice!=null){

		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/editUPriceAfterApprove" ,
	        data:{
	        	"qdoc_id":qdoc_id,
		        "qdoci_id":qdoci_id,
		        "new_uprice":new_uprice,
		        "uprice":uprice
		    },
	        success: function(resp){ 
	            if(resp.result=="success"){
	            	
	            	viewQuotation(qdoc_id,'vc');

	            }else{
	            	alert(resp.msg);
	            }


	        }  
	    });
	}

}

function showReqByEdit(qdoc_id,user_id){

	$('#edit_reqby_qdoc_id').val(qdoc_id);
	$('#edit_reqby_user_id').val(user_id);

}

function submitReqByEdit(){

	if($('#edit_reqby_qdoc_id').val()==""){

		alert("Can not update to new user.");
		return false;
	}

	var qdoc_id = $('#edit_reqby_qdoc_id').val();
	var user_id = $('#edit_reqby_user_id').val();

	$.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/updateUserByAdmin" ,
        data:{
        	"qdoc_id":qdoc_id,
	        "user_id":user_id
	    },
        success: function(resp){ 
            if(resp.result=="success"){
            	
            	location.reload();

            }else{
            	alert(resp.msg);
            }


        }  
    });

}
</script>