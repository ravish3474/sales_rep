<style type="text/css">
.tbl_company th{
	text-align: center;
	background-color: #559;
	color: #FFF;
}
.tbl_company td{

	background-color: #EEE;
	color: #000;
	padding: 5px;
}
.tbl_company button{
	height: 30px;
	padding: 5px;
	line-height: 15px;
	vertical-align: middle;
}
.ncv_content{
	border-bottom: 1px dashed #995;
	padding:5px 0px 2px 0px;
	margin: 0px;
}
</style>
<div class="row" >
	<div class="col-md-12 col-sm-12 col-xs-12">

		<div class="x_panel container">

			<div class="x_title">

				<h2>Quotation > Manage Company Info</h2>

				<div class="clearfix"></div>

			</div>

			<div class="row">
				<?php
				
				$user_group = Yii::app()->user->getState('userGroup');

				$can_add = "disabled";
				if($user_group=="1" || $user_group=="99"){
					$can_add = "";
				}
				?>
				<div class="col-md-9" id="comp_list">
					
				</div>
				
				<div id="d_add_zone" class="col-md-3" style="border-left: solid 1px #AAF; padding: 10px;">
					<h5><i class="fa fa-plus"></i> New Company</h5>
					<hr style="margin-bottom: 5px;">
					<form id="comp_add_form" method="post" enctype="multipart/form-data" >
						Company Logo : <progress id="progress_bar" style="display: none;"></progress>
						<div style="text-align: center;">
							<center><input type="file" id="logo_file" name="logo_file" style="width: 80%; border:1px solid #AAA; padding:1px;" <?php echo $can_add; ?>></center>
						</div>
						Company Name : 
						<div style="text-align: center; ">
							<input type="text" id="add_comp_name" name="add_comp_name" style="width: 80%; padding-left: 4px;" <?php echo $can_add; ?>>
						</div>
						Company Code : 
						<div style="text-align: center; ">
							<input type="text" id="add_comp_code" name="add_comp_code" style="width: 80%; padding-left: 4px;" <?php echo $can_add; ?> maxlength="4">
						</div>
						<span style="font-size: 16px; line-height: 1.4;">Include VAT : <input type="checkbox" id="add_have_vat" name="add_have_vat" style="width: 16px; height:16px; vertical-align: top;" <?php echo $can_add; ?> value="yes"></span>
						<br>
						Company Info : 
						<div style="text-align: center;">
							<textarea id="add_comp_info" name="add_comp_info" style="width: 80%; resize: none; white-space: nowrap; padding: 4px;" <?php echo $can_add; ?>></textarea>
						</div>
						Default Note : 
						<div style="text-align: center;">
							<textarea id="add_note" name="add_note" style="width: 80%; resize: none; white-space: nowrap; padding: 4px;" <?php echo $can_add; ?>></textarea>
						</div>
						<center><br>
							<input id="btn_upload" type="button" class="btn btn-success" value="Submit" style="width: 80%;" <?php echo $can_add; ?> onclick="return saveCompanyData();">
						</center>
					</form>

				</div>

				<div id="d_edit_zone" class="col-md-3" style="border-left: solid 1px #AAF; padding: 10px; display:none;">
					<div>
						<h5 style="float:left;"><i class="fa fa-pencil"></i> Edit Company</h5>
						<button style="float:right;" type="button" class="btn btn-secondary" onclick="return backToNewCompany();"><i class="fa fa-plus"></i> New Company</button>
						<span>&nbsp;</span>
					</div>
					<hr style="margin-bottom: 5px;">
					<form id="comp_edit_form" method="post" enctype="multipart/form-data" >
						Company Logo : <progress id="progress_bar_edit" style="display: none;"></progress>
						<div style="text-align: center;">
							<center>
								<div id="show_edit_img" style="width: 80%; border:1px solid #AAA;"></div>
								<input type="file" id="edit_logo_file" name="edit_logo_file" style="width: 80%; border:1px solid #AAA; padding:1px;" <?php echo $can_add; ?>>
							</center>
						</div>
						Company Name : 
						<div style="text-align: center; ">
							<input type="text" id="edit_comp_name" name="edit_comp_name" style="width: 80%; padding-left: 4px;" <?php echo $can_add; ?>>
						</div>
						Company Code : 
						<div style="text-align: center; ">
							<input type="text" id="edit_comp_code" name="edit_comp_code" style="width: 80%; padding-left: 4px;" <?php echo $can_add; ?> maxlength="4">
						</div>
						<span style="font-size: 16px; line-height: 1.4;">Include VAT : <input type="checkbox" id="edit_have_vat" name="edit_have_vat" style="width: 16px; height:16px; vertical-align: top;" <?php echo $can_add; ?> value="yes"></span>
						<br>
						Company Info : 
						<div style="text-align: center;">
							<textarea id="edit_comp_info" name="edit_comp_info" style="width: 80%; resize: none; white-space: nowrap; padding: 4px;" <?php echo $can_add; ?>></textarea>
						</div>
						Default Note : 
						<div style="text-align: center;">
							<textarea id="edit_note" name="edit_note" style="width: 80%; resize: none; white-space: nowrap; padding: 4px;" <?php echo $can_add; ?>></textarea>
						</div>
						<center><br>
							<input type="hidden" name="edit_comp_id" id="edit_comp_id">
							<input type="hidden" name="edit_qnote_id" id="edit_qnote_id">
							<input id="btn_edit_upload" type="button" class="btn btn-success" value="Submit" style="width: 80%;" <?php echo $can_add; ?> onclick="return saveEditCompanyData();">
						</center>
					</form>

				</div>

			</div>

		</div>



	</div>	

</div>

<script type="text/javascript">
showCompanyList();

function showCompanyList(){

	$('#comp_list').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

	$.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/showCompanyList" ,
        
        success: function(resp){ 
            $('#comp_list').html(resp);
        }  
    });

}

$('#logo_file').on('change', function () {
  var file = this.files[0];

  //console.log(file);

  if (file.size > 1048576) {
    alert('Max upload size is 1MB');
    $(this).val("");
    return false;
  }

  if ( file.type!="image/png" && file.type!="image/jpeg" ) {
    alert('Allow file types PNG or JPG only.');
    $(this).val("");
    return false;
  }

});

function saveCompanyData(){

	if( ($('#logo_file').val()=="") || ($('#add_comp_name').val()=="") || ($('#add_comp_code').val()=="") ){

		alert("Please input Company LOGO, Name and Code.");
		return false;
	}

	$('#progress_bar').show();

	$('#btn_upload').attr("disabled",true);

	$.ajax({
	    // Your server script to process the upload
	    url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/saveCompanyData',
	    type: 'POST',

	    // Form data
	    data: new FormData($('#comp_add_form')[0]),

	    // Tell jQuery not to process data or worry about content-type
	    // You *must* include these options!
	    cache: false,
	    contentType: false,
	    processData: false,

	    // Custom XMLHttpRequest
	    xhr: function () {
	      var myXhr = $.ajaxSettings.xhr();
	      if (myXhr.upload) {
	        // For handling the progress of the upload
	        myXhr.upload.addEventListener('progress', function (e) {
	          if (e.lengthComputable) {
	            $('#progress_bar').attr({
	              value: e.loaded,
	              max: e.total,
	            });
	          }
	        }, false);
	      }
	      return myXhr;
	    },
	    success: function (response) {
	        
	        //console.log(JSON.stringify(response));

	    	$('#progress_bar').fadeOut(2000);

	    	$('#logo_file').val("");
	    	$('#add_comp_name').val("");
	    	$('#add_comp_code').val("");
	    	$('#add_have_vat').prop("checked",false);
	    	$('#add_comp_info').val("");
	    	$('#add_note').val("");

	    	$('#btn_upload').removeAttr("disabled");

	    	showCompanyList();

	    },
	    error: function (response) {

	        $('#progress_bar').fadeOut(2000);
	        console.log(JSON.stringify(response));
	        alert("Error: In upload file process!");
	    }
	});
}

function editCompanyData(comp_id){
	
	$('#d_add_zone').hide();
	$('#d_edit_zone').show();

	var comp_obj = JSON.parse(window.atob($('#comp_obj'+comp_id).val()));

	if( comp_obj.comp_logo!="" && comp_obj.comp_logo!=null ){
		$('#show_edit_img').html('<img src="../images/'+comp_obj.comp_logo+'?'+Math.floor(Math.random()*1000)+'" style="max-width:150px;">'); 
	}else{
		$('#show_edit_img').html('');
	}

	$('#edit_comp_id').val(comp_id);

	$('#edit_qnote_id').val(comp_obj.qnote_id);
	$('#edit_comp_name').val(comp_obj.comp_name);
	$('#edit_comp_code').val(comp_obj.comp_code);
	$('#edit_comp_info').val(comp_obj.comp_info);
	$('#edit_note').val(comp_obj.qnote_text);

	if(comp_obj.have_vat==1){
		$('#edit_have_vat').prop("checked",true);
	}else{
		$('#edit_have_vat').prop("checked",false);
	}
	
	//alert(comp_obj.comp_info);
}

function saveEditCompanyData(){

	var is_edit_logo = true;
	if( ($('#edit_logo_file').val()=="") ){

		is_edit_logo = false;
	}

	if(is_edit_logo){
		$('#progress_bar_edit').show();
	}

	if( ($('#edit_comp_name').val()=="") || ($('#edit_comp_code').val()=="") ){
		alert("Please input Company Name and Code.");
		return false;
	}

	$('#btn_edit_upload').attr("disabled",true);

	$.ajax({
	    // Your server script to process the upload
	    url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/saveEditCompanyData',
	    type: 'POST',

	    // Form data
	    data: new FormData($('#comp_edit_form')[0]),

	    // Tell jQuery not to process data or worry about content-type
	    // You *must* include these options!
	    cache: false,
	    contentType: false,
	    processData: false,

	    // Custom XMLHttpRequest
	    xhr: function () {
	      var myXhr = $.ajaxSettings.xhr();
	      if (myXhr.upload) {
	        // For handling the progress of the upload
	        myXhr.upload.addEventListener('progress', function (e) {
	          if (e.lengthComputable) {
	            $('#progress_bar_edit').attr({
	              value: e.loaded,
	              max: e.total,
	            });
	          }
	        }, false);
	      }
	      return myXhr;
	    },
	    success: function (response) {
	        
	        //console.log(JSON.stringify(response));

	    	$('#progress_bar_edit').fadeOut(2000);

	    	$('#btn_edit_upload').removeAttr("disabled");

	    	showCompanyList();
	    	backToNewCompany();

	    },
	    error: function (response) {

	        $('#progress_bar_edit').fadeOut(2000);
	        console.log(JSON.stringify(response));
	        alert("Error: In upload file process!");
	    }
	});
}

function backToNewCompany(){

	$('#d_add_zone').show();
	$('#d_edit_zone').hide();

}

function deleteCompanyData(comp_id){

	if(confirm("Are you sure?")){
		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/deleteCompanyData" ,
	        data:{
	            "comp_id":comp_id
	        },
	        success: function(resp){ 
	            if(resp.result=="success"){
	            	showCompanyList();
	            	backToNewCompany();
	            }else{
	            	alert(resp.msg);
	            }
	        }  
	    });
	}

}
</script>