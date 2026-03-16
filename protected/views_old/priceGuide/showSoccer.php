<style>
	
	.bg-usd, .bg-cad, .bg-price{
		text-align: center;
		vertical-align: middle;
	}
	.pre {
		white-space: pre;
	}
</style>
<script>
$(function() {
	
	$( "#sortable" ).sortable();
	$( "#sortable" ).disableSelection();


$('#edit-submit-sortdata').click(function(){
		var indexs = '';
		$('.sortdata').each(function(){
			if(indexs==''){
				indexs = $(this).attr('id');
			}else{
				indexs = indexs +','+$(this).attr('id');
			}		
		});

		document.getElementById("indexs").value = indexs;
		 document.getElementById("edit-sortdata-form").submit();
	});
	
});


</script>
<div class="row" id="soccer">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2><?php echo $toppic['details']; ?></h2> &nbsp; &nbsp;  <a href="#" data-toggle="modal" data-target="#editTopic" data-id="<?php echo $toppic['id'];?>"><i class="fa fa-pencil" ></i></a>
				<div class="clearfix"></div>
			</div>
			<div class="x_title">	
				<?php if(!empty($toppic['Note'])){ ?>
					<h6 style="color:red;float: left;"> >> <?php echo $toppic['Note']; ?> << </h6> 
					&nbsp; &nbsp;  <a href="#" data-toggle="modal" data-target="#editHighlight" data-id="<?php echo $toppic['id'];?>"><i class="fa fa-pencil" ></i></a>
				<?php }else{  ?>
					 <a href="#" data-toggle="modal" data-target="#editHighlight" data-id="<?php echo $toppic['id'];?>" style="    background-color: red;color:#fff;padding:5px;border: 2px solid red;border-radius: 5px;"> Add Highlight </a>
					
				<?php
				} ?>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
                <?php echo $this->renderPartial('/priceGuide/selectors/userType');  ?>
                &nbsp;&nbsp;Currency :
                <select id="dynamic_select">
                	<?php
                		if(isset($_GET['curr'])){
                			$curr=$_GET['curr'];
                		}else{
                			$curr=0;
                		}

                		switch ($curr) {
                			case 0:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showSoccer/?curr=0">USD North America</option>';
                				$curr_name='USD North America';
                				break;
                			case 1:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showSoccer/?curr=1">CAD North America</option>';
                				$curr_name='CAD North America';
                				break;
                			case 2:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showSoccer/?curr=2">USD Europe and South America</option>';
                				$curr_name='USD Europe and South America';
                				break;
                			case 3:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showSoccer/?curr=3">USD ASIA and Australia</option>';
                				$curr_name='USD ASIA and Australia';
                				break;
                			case 4:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showSoccer/?curr=4">THB Thai Baht</option>';
                				$curr_name='THB Thai Baht';
                				break;
                			case 5:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showSoccer/?curr=5">SGD Singapore</option>';
                				$curr_name='SGD Singapore';
                				break;
                		}
                		echo $btn;
                	?>
                	<option value=""><b>Select Currency</b></option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showSoccer/?curr=0">USD North America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showSoccer/?curr=1">CAD North America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showSoccer/?curr=2">USD Europe and South America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showSoccer/?curr=3">USD ASIA and Australia</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showSoccer/?curr=4">THB Thai Baht</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showSoccer/?curr=5">SGD Singapore</option>
                </select>
                <script type="text/javascript">
                	$(function(){
                		$('#dynamic_select').on('change', function () {
                			var url = $(this).val(); // get selected value
                			if (url) { // require a URL
                				window.location = url; // redirect
                			}
                			return false;
                		});
                	});
                </script>
				<div class="btn-add">
					<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addData"><i class="fa fa-plus"></i> Add</a>
				</div>
				<div class="btn-add">
					<a href="#" class="btn btn-info" data-toggle="modal" data-target="#editsortdata"><i class="fa fa-arrows-v" aria-hidden="true" style="color:#fff;"></i> Sort Data</a>
				</div>
				<div id="freezer-Table" style="margin:0">
					<table id="soccerTable" class="table table-striped table-condensed table-freeze-multi table-bordered" data-scroll-height="600" data-cols-number="2" style="border-collapse: initial;">
						<colgroup>
							<col>
							<col style="width: 230px;">
							<col style="width: 300px;">
							<col>
							<col>
							<col>
							<col>
							<col>
							<col>
							<col>
							<col>
							<col>
							<col>
							<col>
							<col>
							<col>
							<!--<col>
							<col>
							<col>-->
						</colgroup>
						<thead>
							<?php foreach ($getHeader as $key_header => $value_header) { ?>
								<tr>
									<th class="bg-blue-light text-center" rowspan="2">
										<button class="btn btn-success" data-toggle="modal" data-target="#editHeader" data-id="<?php echo $value_header['id'];?>">Edit</button>  
									</th>
									<th class="bg-blue-light text-center" rowspan="2"> <?php echo $value_header['r1c1']; ?> </th>
									<th class="bg-blue-light pre " rowspan="2"> <?php echo $value_header['r1c2']; ?> </th>
									<!--<th class="bg-usd text-center pre" ><?php //echo $value_header['r1c5']; ?></th>-->
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c6']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c7']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c8']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c9']; ?></th>
									
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c11']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c12']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c13']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c14']; ?></th>
									
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c16']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c17']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c18']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c19']; ?></th>
									<th class="bg-price text-center pre" ><?php echo $value_header['r1c20']; ?></th>
								</tr>
								<tr>
									<th class="bg-usd text-center pre" colspan="13"><?php echo $curr_name; ?></th>
								</tr>
								<tr>
									<th class="bg-blue text-center pre" colspan="" style="outline: 0px solid #252c2f;border: 1px solid #252c2f !important;"></th>
									<th class="bg-blue text-center pre" colspan="" style="outline: 0px solid #252c2f;border: 1px solid #252c2f !important;"><?php echo $value_header['r3c1_2']; ?></th>
									<th class="bg-blue text-center pre" colspan="" style="outline: 0px solid #252c2f;border: 1px solid #252c2f !important;"></th>
									<!--<th class="bg-usd text-center pre" ><?php //echo $value_header['r3c5']; ?></th>-->
									<th class="bg-cad text-center pre" ><?php echo $value_header['r3c6']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c7']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r3c8']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c9']; ?></th>
											
									
									<th class="bg-cad text-center pre" ><?php echo $value_header['r3c11']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c12']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r3c13']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c14']; ?></th>
											
									
									<th class="bg-cad text-center pre" ><?php echo $value_header['r3c16']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c17']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r3c18']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c19']; ?></th>
									<th class="bg-price text-center pre" ><?php echo $value_header['r3c20']; ?></th>
								</tr>
							<?php } ?>	
					</thead>
					<tbody>
						<?php
							foreach ($soccer as $key => $value) {
								$suffix_field = "";
								if($curr!=0){ $suffix_field = $curr; }

								$sql_addi = "SELECT *,addi_value".$suffix_field." AS show_addi_val FROM tbl_additional WHERE product_type='soccer' AND pro_id='".$value['id']."' ORDER BY ordering ASC";
								$rs_addi = Yii::app()->db->createCommand($sql_addi)->queryAll();

								$show_addi_info = "";

								$use_pre_curr = "$";
								if($curr==4){ $use_pre_curr = "฿"; }

								foreach($rs_addi as $tmp_key => $row_addi){
									if($row_addi["show_addi_val"]!=0){
										$show_addi_info .= "<br>".$row_addi["addi_name"]." ".$use_pre_curr.$row_addi["show_addi_val"];
									}
									
								}
						?>
						<tr id="tr_<?php echo $value['id']; ?>">
							<td class="tbl-btn-box nowrap" style="vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;">
								<button class="btn btn-success" data-toggle="modal" data-target="#editData" data-id="<?php echo $value['id'];?>">
									<i class="fa fa-pencil"></i>
								</button>
								<button class="btn btn-danger confirm" del-id="<?php echo $value['id'];?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/deleteSoccer">
									<i class="fa fa-close"></i>
								</button>
								<hr style="padding: 5px; margin: 5px;">
								<button class="btn btn-primary" data-toggle="modal" data-target="#manageAdditional" onclick="return getAdditional(<?php echo $value['id'];?>,'soccer');">
									<i class="fa fa-plus-square"></i>
								</button>
							</td>
							<td id="prod_name<?php echo $value['id'];?>" style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;"><?php echo $value['category']; ?></td>
							<td id="prod_desc<?php echo $value['id'];?>" style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;"><?php echo $value['notes'].$show_addi_info; ?></td>
							<td class="text-center nowrap cad" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$qty2= $value['qty2'];
					                			break;
					                		case 1:
					                			$qty2= $value['qty2_1'];
					                			break;
					                		case 2:
					                			$qty2= $value['qty2_2'];
					                			break;
					                		case 3:
					                			$qty2= $value['qty2_3'];
					                			break;
					                		case 4:
					                			$qty2= $value['qty2_4'];
					                			break;
					                		case 5:
					                			$qty2= $value['qty2_5'];
					                			break;
					                	}
					                	if($qty2!=0){echo $qty2.' +';}
									?>
								</td>
								<td class="text-center nowrap usd" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$qty3= $value['qty3'];
					                			break;
					                		case 1:
					                			$qty3= $value['qty3_1'];
					                			break;
					                		case 2:
					                			$qty3= $value['qty3_2'];
					                			break;
					                		case 3:
					                			$qty3= $value['qty3_3'];
					                			break;
					                		case 4:
					                			$qty3= $value['qty3_4'];
					                			break;
					                		case 5:
					                			$qty3= $value['qty3_5'];
					                			break;
					                	}
					                	if($qty3!=0){echo $qty3.' +';}
									?>
								</td>
								<td class="text-center nowrap cad" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$qty4= $value['qty4'];
					                			break;
					                		case 1:
					                			$qty4= $value['qty4_1'];
					                			break;
					                		case 2:
					                			$qty4= $value['qty4_2'];
					                			break;
					                		case 3:
					                			$qty4= $value['qty4_3'];
					                			break;
					                		case 4:
					                			$qty4= $value['qty4_4'];
					                			break;
					                		case 5:
					                			$qty4= $value['qty4_5'];
					                			break;
					                	}
					                	if($qty4!=0){echo $qty4.' +';}
									?>
								</td>
								<td class="text-center nowrap usd" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$qty5= $value['qty5'];
					                			break;
					                		case 1:
					                			$qty5= $value['qty5_1'];
					                			break;
					                		case 2:
					                			$qty5= $value['qty5_2'];
					                			break;
					                		case 3:
					                			$qty5= $value['qty5_3'];
					                			break;
					                		case 4:
					                			$qty5= $value['qty5_4'];
					                			break;
					                		case 5:
					                			$qty5= $value['qty5_5'];
					                			break;
					                	}
					                	if($qty5!=0){echo $qty5.' +';}
									?>
								</td>
								
								<td class="text-center nowrap cad" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$qty7= $value['qty7'];
					                			break;
					                		case 1:
					                			$qty7= $value['qty7_1'];
					                			break;
					                		case 2:
					                			$qty7= $value['qty7_2'];
					                			break;
					                		case 3:
					                			$qty7= $value['qty7_3'];
					                			break;
					                		case 4:
					                			$qty7= $value['qty7_4'];
					                			break;
					                		case 5:
					                			$qty7= $value['qty7_5'];
					                			break;
					                	}
					                	if($qty7!=0){echo $qty7.' +';}
									?>
								</td>
								<td class="text-center nowrap usd" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$qty8= $value['qty8'];
					                			break;
					                		case 1:
					                			$qty8= $value['qty8_1'];
					                			break;
					                		case 2:
					                			$qty8= $value['qty8_2'];
					                			break;
					                		case 3:
					                			$qty8= $value['qty8_3'];
					                			break;
					                		case 4:
					                			$qty8= $value['qty8_4'];
					                			break;
					                		case 5:
					                			$qty8= $value['qty8_5'];
					                			break;
					                	}
					                	if($qty8!=0){echo $qty8.' +';}
									?>
								</td>
								<td class="text-center nowrap cad" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$qty9= $value['qty9'];
					                			break;
					                		case 1:
					                			$qty9= $value['qty9_1'];
					                			break;
					                		case 2:
					                			$qty9= $value['qty9_2'];
					                			break;
					                		case 3:
					                			$qty9= $value['qty9_3'];
					                			break;
					                		case 4:
					                			$qty9= $value['qty9_4'];
					                			break;
					                		case 5:
					                			$qty9= $value['qty9_5'];
					                			break;
					                	}
					                	if($qty9!=0){echo $qty9.' +';}
									?>
								</td>
								<td class="text-center nowrap usd" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$qty10= $value['qty10'];
					                			break;
					                		case 1:
					                			$qty10= $value['qty10_1'];
					                			break;
					                		case 2:
					                			$qty10= $value['qty10_2'];
					                			break;
					                		case 3:
					                			$qty10= $value['qty10_3'];
					                			break;
					                		case 4:
					                			$qty10= $value['qty10_4'];
					                			break;
					                		case 5:
					                			$qty10= $value['qty10_5'];
					                			break;
					                	}
					                	if($qty10!=0){echo $qty10.' +';}
									?>
								</td>
								
								<td class="text-center nowrap cad" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$qty12= $value['qty12'];
					                			break;
					                		case 1:
					                			$qty12= $value['qty12_1'];
					                			break;
					                		case 2:
					                			$qty12= $value['qty12_2'];
					                			break;
					                		case 3:
					                			$qty12= $value['qty12_3'];
					                			break;
					                		case 4:
					                			$qty12= $value['qty12_4'];
					                			break;
					                		case 5:
					                			$qty12= $value['qty12_5'];
					                			break;
					                	}
					                	if($qty12!=0){echo $qty12.' +';}
									?>
								</td>
								<td class="text-center nowrap usd" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$qty13= $value['qty13'];
					                			break;
					                		case 1:
					                			$qty13= $value['qty13_1'];
					                			break;
					                		case 2:
					                			$qty13= $value['qty13_2'];
					                			break;
					                		case 3:
					                			$qty13= $value['qty13_3'];
					                			break;
					                		case 4:
					                			$qty13= $value['qty13_4'];
					                			break;
					                		case 5:
					                			$qty13= $value['qty13_5'];
					                			break;
					                	}
					                	if($qty13!=0){echo $qty13.' +';}
									?>
								</td>
								<td class="text-center nowrap cad" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$qty14= $value['qty14'];
					                			break;
					                		case 1:
					                			$qty14= $value['qty14_1'];
					                			break;
					                		case 2:
					                			$qty14= $value['qty14_2'];
					                			break;
					                		case 3:
					                			$qty14= $value['qty14_3'];
					                			break;
					                		case 4:
					                			$qty14= $value['qty14_4'];
					                			break;
					                		case 5:
					                			$qty14= $value['qty14_5'];
					                			break;
					                	}
					                	if($qty14!=0){echo $qty14.' +';}
									?>
								</td>
								<td class="text-center nowrap usd" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$qty15= $value['qty15'];
					                			break;
					                		case 1:
					                			$qty15= $value['qty15_1'];
					                			break;
					                		case 2:
					                			$qty15= $value['qty15_2'];
					                			break;
					                		case 3:
					                			$qty15= $value['qty15_3'];
					                			break;
					                		case 4:
					                			$qty15= $value['qty15_4'];
					                			break;
					                		case 5:
					                			$qty15= $value['qty15_5'];
					                			break;
					                	}
					                	if($qty15!=0){echo $qty15.' +';}
									?>
								</td>
								<td class="text-center nowrap bg-price" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$msrp= $value['msrp'];
					                			break;
					                		case 1:
					                			$msrp= $value['msrp_1'];
					                			break;
					                		case 2:
					                			$msrp= $value['msrp_2'];
					                			break;
					                		case 3:
					                			$msrp= $value['msrp_3'];
					                			break;
					                		case 4:
					                			$msrp= $value['msrp_4'];
					                			break;
					                		case 5:
					                			$msrp= $value['msrp_5'];
					                			break;
					                	}
					                	if($msrp!=0){echo $msrp.' +';}
									?>
								</td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
				</div>
				<br>
				<br>
				<br>
				<div class="btn-add">
					<a href="#" class="btn btn-success" data-toggle="modal" data-target="#editNotes"><i class="fa fa-pencil"></i> Edit</a>
				</div>
				<table id="notesTable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="bg-blue-light" colspan="2">Notes</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo nl2br($notes['notes']); ?></td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
	</div>	
</div>	

<!-- Add PriceGuide -->
<div class="modal fade" id="addData" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">JOG Price List - Add</h4>
			</div>
			<div class="modal-body">
                <?php echo $this->renderPartial('/priceGuide/addSoccer');  ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="submit-soccer">Save</button>
			</div>
		</div>
	</div>
</div>


<!-- Edit PriceGuide -->
<div class="modal fade" id="editData" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">JOG Price List - Edit</h4>
			</div>
			<div class="modal-body">
                <?php echo $this->renderPartial('/priceGuide/editSoccer');  ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-soccer">Save</button>
			</div>
		</div>
	</div>
</div>

<!-- Edit Notes -->
<div class="modal fade" id="editNotes" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Notes</h4>
			</div>
			<div class="modal-body">
            <?php 
            	$form=$this->beginWidget('CActiveForm', array(
					'id'          => 'edit-notes-form',
					'htmlOptions' => array(
						'class'  => 'form-horizontal form-label-left',
						),
					));

                echo $form->hiddenField($notes, 'type');
                echo $form->textArea($notes, 'notes', array('class'=>'form-control'));

				$this->endWidget();
            ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-note">Save</button>
			</div>
		</div>
	</div>
</div>

<!-- Edit Headers -->
<div class="modal fade" id="editHeader" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Soccer - Headers</h4>
			</div>
			<div class="modal-body">
			 
            <?php 
            	$form=$this->beginWidget('CActiveForm', array(
					'id'          => 'edit-header-form',
					//'action' => Yii::app()->request->baseUrl . '/priceGuide/editSubmitHeader',
					'htmlOptions' => array(
						'enctype' => 'multipart/form-data',
						'class'  => 'form-horizontal form-label-left',
						
  						),
					));
				?>
				<div class="form-group group-header">
					<div class="col-md-12">
						<h2>ROW 1</h2>
					</div>
				</div>
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c1'); ?></label>
					<div class="col-md-10 col-sm-6 col-xs-12">
						<?php echo $form->hiddenField($header, 'id'); ?>
						<?php //echo $form->hiddenField($header, 'type'); ?>
						<?php echo $form->textArea($header, 'r1c1', array('class' => 'form-control', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c2'); ?></label>
					<div class="col-md-10 col-sm-6 col-xs-12">
						<?php echo $form->textArea($header, 'r1c2', array('class' => 'form-control', 'required' => true)); ?>
					</div>
				</div>

				<?php /*
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c5'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c5', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c6'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c6', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>
				*/ ?>
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c6'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c6', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c7'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c7', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c8'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c8', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c9'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c9', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
				</div>
				<?php /*
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c10'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c10', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
					
				</div>
				*/ ?>
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c11'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c11', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c12'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c12', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
					
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c13'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c13', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c14'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c14', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<?php /*
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c15'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c15', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					*/ ?>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c16'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c16', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c17'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c17', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c18'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c18', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c19'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c19', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
				</div>
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r1c20'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r1c20', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
				</div>
				
				<div class="form-group group-header">
					<div class="col-md-12">
						<h2>ROW 2</h2>
					</div>
				</div>
			
				<?php /*
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c5'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c5', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c6'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c6', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>
				*/ ?>
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c6'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c6', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c7'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c7', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c8'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c8', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c9'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c9', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
				</div>
				<?php /*
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c10'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c10', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
					
				</div>
				*/ ?>
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c11'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c11', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c12'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c12', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
					
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c13'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c13', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c14'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c14', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<?php /*
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c15'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c15', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					*/ ?>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c16'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c16', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c17'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c17', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c18'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c18', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c19'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c19', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
				</div>
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r2c20'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r2c20', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
				</div>
				
				<div class="form-group group-header">
					<div class="col-md-12">
						<h2>ROW 3</h2>
					</div>
				</div>
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c1_2'); ?></label>
					<div class="col-md-10 col-sm-6 col-xs-12">
						<?php echo $form->textArea($header, 'r3c1_2', array('class' => 'form-control', 'required' => true)); ?>
					</div>
				</div>

				<?php /*
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c5'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c5', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c6'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c6', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>
				*/ ?>
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c6'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c6', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c7'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c7', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c8'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c8', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c9'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c9', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
				</div>
				<?php /*
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c10'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c10', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
					
				</div>
				*/ ?>
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c11'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c11', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c12'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c12', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
					
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c13'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c13', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c14'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c14', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<?php /*
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c15'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c15', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					*/ ?>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c16'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c16', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c17'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c17', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c18'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c18', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c19'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c19', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
				</div>
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $header->getAttributeLabel('r3c20'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($header, 'r3c20', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					
				</div>


			<?php
				$this->endWidget();
            ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-header">Save</button>
			</div>
		</div>
	</div>
</div>

<!-- Edit Topic -->
<div class="modal fade" id="editTopic" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Volleyball - Topic</h4>
			</div>
			<div class="modal-body">
            <?php 
            	$form=$this->beginWidget('CActiveForm', array(
					'id'          => 'edit-topic-form',
					'htmlOptions' => array(
						'class'  => 'form-horizontal form-label-left',
						),
					));

                echo $form->hiddenField($toppic, 'type');
                echo $form->hiddenField($toppic, 'id');
                echo $form->textArea($toppic, 'details', array('class'=>'form-control'));

				$this->endWidget();
            ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-topic">Save</button>
			</div>
		</div>
	</div>
</div>

<!-- Edit Highlight -->
<div class="modal fade" id="editHighlight" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">HockeyLine - Highlight</h4>
			</div>
			<div class="modal-body">
            <?php 
            	$form=$this->beginWidget('CActiveForm', array(
					'id'          => 'edit-highlight-form',
					'htmlOptions' => array(
						'class'  => 'form-horizontal form-label-left',
						),
					));

                echo $form->hiddenField($toppic, 'type');
                echo $form->hiddenField($toppic, 'id');
                echo $form->textArea($toppic, 'Note', array('class'=>'form-control'));

				$this->endWidget();
            ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-highlight">Save</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editsortdata" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Soccer - Sortdata</h4>
			</div>
			<div class="modal-body">
				<div >
					
					<?php
						$s = 1;
						
						
					?>
							
					<div id="sortable">		
					<?php
							foreach ($soccer as $key => $value) {
					?>
								<div class="ui-state-default " style="padding: 5px 5px;font-size:14px;">
									<span class="ui-icon ui-icon-arrowthick-2-n-s sortdata" id="<?php echo $value['id'];?>"></span><span style="font-weight:700;">
									<?php echo $s.".";?> <?php echo $value['category']; ?></span><br> <span style="font-size:12px;"><?php echo nl2br($value['notes']); ?></span>
								</div>
					<?php
							$s++;
							}
					?>
					</div>				
				</div>
				<?php 
					$form=$this->beginWidget('CActiveForm', array(
						'id'          	=> 'edit-sortdata-form',
						'action' 		=> Yii::app()->request->baseUrl . '/priceGuide/editSubmitSortdata',
						'htmlOptions' 	=> array(
							'class'  	=> 'form-horizontal form-label-left',
							),
						));
				?>
					<input type="hidden" name="type" value="Soccer">
					<input type="hidden" name="sortdata" id="indexs">
					<input type="hidden" name="permissions" value="<?php echo $permissions; ?>">
				<?php 
					$this->endWidget();
				?>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-sortdata" >Save</button>
			</div>
		</div>
	</div>
</div>