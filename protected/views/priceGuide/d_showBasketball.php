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
<div class="row" id="basketball">

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
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showBasketball/v/Sales_Dealers/?curr=0">USD North America</option>';
                				$curr_name='USD North America';
                				break;
                			case 1:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showBasketball/v/Sales_Dealers/?curr=1">CAD North America</option>';
                				$curr_name='CAD North America';
                				break;
                			case 2:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showBasketball/v/Sales_Dealers/?curr=2">USD Europe and South America</option>';
                				$curr_name='USD Europe and South America';
                				break;
                			case 3:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showBasketball/v/Sales_Dealers/?curr=3">USD ASIA and Australia</option>';
                				$curr_name='USD ASIA and Australia';
                				break;
                			case 4:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showBasketball/v/Sales_Dealers/?curr=4">THB Thai Baht</option>';
                				$curr_name='THB Thai Baht';
                				break;
                			case 5:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showBasketball/v/Sales_Dealers/?curr=5">SGD Singapore</option>';
                				$curr_name='SGD Singapore';
                				break;
                		}
                		echo $btn;
                	?>
                	<option value=""><b>Select Currency</b></option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showBasketball/v/Sales_Dealers/?curr=0">USD North America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showBasketball/v/Sales_Dealers/?curr=1">CAD North America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showBasketball/v/Sales_Dealers/?curr=2">USD Europe and South America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showBasketball/v/Sales_Dealers/?curr=3">USD ASIA and Australia</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showBasketball/v/Sales_Dealers/?curr=4">THB Thai Baht</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showBasketball/v/Sales_Dealers/?curr=5">SGD Singapore</option>
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
					<table id="basketballTable" class="table table-striped table-condensed table-freeze-multi table-bordered" data-scroll-height="600" data-cols-number="2" style="border-collapse: initial;">
						<colgroup>
							<col>
							<col style="width: 230px;">
							<col style="width: 300px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							
						</colgroup>
						<thead>
						<?php foreach ($getDheader as $key_header => $value_header) { ?>
							<tr>
								<th class="bg-blue-light text-center" rowspan="2"> 
									<button class="btn btn-success" data-toggle="modal" data-target="#editHeader" data-id="<?php echo $value_header['id'];?>">
										Edit
									</button> </th>
								<th class="bg-blue-light text-center" rowspan="2"> <?php echo $value_header['r1c1']; ?> </th>
								<th class="bg-blue-light pre " rowspan="2"> <?php echo $value_header['r1c2']; ?> </th>
								<th class="bg-usd text-center pre" ><?php echo $value_header['r1c5']; ?></th>
								<th class="bg-cad text-center pre" ><?php echo $value_header['r1c6']; ?></th>
								<th class="bg-usd text-center pre" ><?php echo $value_header['r1c7']; ?></th>
								<th class="bg-cad text-center pre" ><?php echo $value_header['r1c8']; ?></th>
								<th class="bg-usd text-center pre" ><?php echo $value_header['r1c9']; ?></th>
								<th class="bg-cad text-center pre" ><?php echo $value_header['r1c10']; ?></th>
								<th class="bg-usd text-center pre" ><?php echo $value_header['r1c11']; ?></th>
								<th class="bg-cad text-center pre" ><?php echo $value_header['r1c12']; ?></th>
								<th class="bg-usd text-center pre" ><?php echo $value_header['r1c13']; ?></th>
								<th class="bg-price text-center pre" ><?php echo $value_header['r1c14']; ?></th>
							</tr>
							<tr>
								<th class="bg-usd text-center pre" colspan="10"><?php echo $curr_name; ?></th>
							</tr>
							<tr>
								<th class="bg-blue text-center pre" colspan="" style="outline: 0px solid #252c2f;border: 1px solid #252c2f !important;"></th>
								<th class="bg-blue text-center pre" colspan="" style="outline: 0px solid #252c2f;border: 1px solid #252c2f !important;"><?php echo $value_header['r3c1_2']; ?></th>
								<th class="bg-blue text-center pre" colspan="" style="outline: 0px solid #252c2f;border: 1px solid #252c2f !important;"></th>
								<th class="bg-usd text-center pre" ><?php echo $value_header['r3c5']; ?></th>
								<th class="bg-cad text-center pre" ><?php echo $value_header['r3c6']; ?></th>
								<th class="bg-usd text-center pre" ><?php echo $value_header['r3c7']; ?></th>
								<th class="bg-cad text-center pre" ><?php echo $value_header['r3c8']; ?></th>
								<th class="bg-usd text-center pre" ><?php echo $value_header['r3c9']; ?></th>
										
								<th class="bg-cad text-center pre" ><?php echo $value_header['r3c10']; ?></th>
								<th class="bg-usd text-center pre" ><?php echo $value_header['r3c11']; ?></th>
								<th class="bg-cad text-center pre" ><?php echo $value_header['r3c12']; ?></th>
								<th class="bg-usd text-center pre" ><?php echo $value_header['r3c13']; ?></th>
								<th class="bg-price text-center pre" ><?php echo $value_header['r3c14']; ?></th>
							</tr>
						<?php } ?>	
						</thead>
						<tbody>
							<?php
								foreach ($basketball as $key => $value) {
							?>
							<tr id="tr_<?php echo $value['id']; ?>">
								<td class="tbl-btn-box nowrap" style="vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;">
									<button class="btn btn-success" data-toggle="modal" data-target="#editData" data-id="<?php echo $value['id'];?>">
										<i class="fa fa-pencil"></i>
									</button>
									<button class="btn btn-danger confirm" del-id="<?php echo $value['id'];?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/deleteBasketball">
										<i class="fa fa-close"></i>
									</button>
								</td>
								<td style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;"><?php echo $value['category']; ?></td>
								<td style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;"><?php echo $value['notes']; ?></td>
								<td class=" nowrap bg-usd text-center" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$d_qty1= $value['d_qty1'];
					                				break;
					                			case 1:
					                				$d_qty1= $value['d_qty1_1'];
					                				break;
					                			case 2:
					                				$d_qty1= $value['d_qty1_2'];
					                				break;
					                			case 3:
					                				$d_qty1= $value['d_qty1_3'];
					                				break;
					                			case 4:
					                				$d_qty1= $value['d_qty1_4'];
					                				break;
					                			case 5:
					                				$d_qty1= $value['d_qty1_5'];
					                				break;
					                		}
					                		if($d_qty1!=0){echo $d_qty1.' +';}
										?>
									</td>
									<td class=" nowrap bg-cad text-center" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$d_qty2= $value['d_qty2'];
					                				break;
					                			case 1:
					                				$d_qty2= $value['d_qty2_1'];
					                				break;
					                			case 2:
					                				$d_qty2= $value['d_qty2_2'];
					                				break;
					                			case 3:
					                				$d_qty2= $value['d_qty2_3'];
					                				break;
					                			case 4:
					                				$d_qty2= $value['d_qty2_4'];
					                				break;
					                			case 5:
					                				$d_qty2= $value['d_qty2_5'];
					                				break;
					                		}
					                		if($d_qty2!=0){echo $d_qty2.' +';}
										?>
									</td>
									<td class=" nowrap bg-usd text-center" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$d_qty3= $value['d_qty3'];
					                				break;
					                			case 1:
					                				$d_qty3= $value['d_qty3_1'];
					                				break;
					                			case 2:
					                				$d_qty3= $value['d_qty3_2'];
					                				break;
					                			case 3:
					                				$d_qty3= $value['d_qty3_3'];
					                				break;
					                			case 4:
					                				$d_qty3= $value['d_qty3_4'];
					                				break;
					                			case 5:
					                				$d_qty3= $value['d_qty3_5'];
					                				break;
					                		}
					                		if($d_qty3!=0){echo $d_qty3.' +';}
										?>
									</td>
									<td class=" nowrap bg-cad text-center" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$d_qty4= $value['d_qty4'];
					                				break;
					                			case 1:
					                				$d_qty4= $value['d_qty4_1'];
					                				break;
					                			case 2:
					                				$d_qty4= $value['d_qty4_2'];
					                				break;
					                			case 3:
					                				$d_qty4= $value['d_qty4_3'];
					                				break;
					                			case 4:
					                				$d_qty4= $value['d_qty4_4'];
					                				break;
					                			case 5:
					                				$d_qty4= $value['d_qty4_5'];
					                				break;
					                		}
					                		if($d_qty4!=0){echo $d_qty4.' +';}
										?>
									</td>
									<td class=" nowrap bg-usd text-center" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$d_qty5= $value['d_qty5'];
					                				break;
					                			case 1:
					                				$d_qty5= $value['d_qty5_1'];
					                				break;
					                			case 2:
					                				$d_qty5= $value['d_qty5_2'];
					                				break;
					                			case 3:
					                				$d_qty5= $value['d_qty5_3'];
					                				break;
					                			case 4:
					                				$d_qty5= $value['d_qty5_4'];
					                				break;
					                			case 5:
					                				$d_qty5= $value['d_qty5_5'];
					                				break;
					                		}
					                		if($d_qty5!=0){echo $d_qty5.' +';}
										?>
									</td>
									<td class=" nowrap bg-cad text-center" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$d_qty6= $value['d_qty6'];
					                				break;
					                			case 1:
					                				$d_qty6= $value['d_qty6_1'];
					                				break;
					                			case 2:
					                				$d_qty6= $value['d_qty6_2'];
					                				break;
					                			case 3:
					                				$d_qty6= $value['d_qty6_3'];
					                				break;
					                			case 4:
					                				$d_qty6= $value['d_qty6_4'];
					                				break;
					                			case 5:
					                				$d_qty6= $value['d_qty6_5'];
					                				break;
					                		}
					                		if($d_qty6!=0){echo $d_qty6.' +';}
										?>
									</td>
									<td class=" nowrap bg-usd text-center" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$d_qty7= $value['d_qty7'];
					                				break;
					                			case 1:
					                				$d_qty7= $value['d_qty7_1'];
					                				break;
					                			case 2:
					                				$d_qty7= $value['d_qty7_2'];
					                				break;
					                			case 3:
					                				$d_qty7= $value['d_qty7_3'];
					                				break;
					                			case 4:
					                				$d_qty7= $value['d_qty7_4'];
					                				break;
					                			case 5:
					                				$d_qty7= $value['d_qty7_5'];
					                				break;
					                		}
					                		if($d_qty7!=0){echo $d_qty7.' +';}
										?>
									</td>
									<td class=" nowrap bg-cad text-center" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$d_qty8= $value['d_qty8'];
					                				break;
					                			case 1:
					                				$d_qty8= $value['d_qty8_1'];
					                				break;
					                			case 2:
					                				$d_qty8= $value['d_qty8_2'];
					                				break;
					                			case 3:
					                				$d_qty8= $value['d_qty8_3'];
					                				break;
					                			case 4:
					                				$d_qty8= $value['d_qty8_4'];
					                				break;
					                			case 5:
					                				$d_qty8= $value['d_qty8_5'];
					                				break;
					                		}
					                		if($d_qty8!=0){echo $d_qty8.' +';}
										?>
									</td>
									<td class=" nowrap bg-usd text-center" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$d_qty9= $value['d_qty9'];
					                				break;
					                			case 1:
					                				$d_qty9= $value['d_qty9_1'];
					                				break;
					                			case 2:
					                				$d_qty9= $value['d_qty9_2'];
					                				break;
					                			case 3:
					                				$d_qty9= $value['d_qty9_3'];
					                				break;
					                			case 4:
					                				$d_qty9= $value['d_qty9_4'];
					                				break;
					                			case 5:
					                				$d_qty9= $value['d_qty9_5'];
					                				break;
					                		}
					                		if($d_qty9!=0){echo $d_qty9.' +';}
										?>
									</td>
									<td class=" nowrap bg-price text-center" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$d_msrp= $value['d_msrp'];
					                				break;
					                			case 1:
					                				$d_msrp= $value['d_msrp_1'];
					                				break;
					                			case 2:
					                				$d_msrp= $value['d_msrp_2'];
					                				break;
					                			case 3:
					                				$d_msrp= $value['d_msrp_3'];
					                				break;
					                			case 4:
					                				$d_msrp= $value['d_msrp_4'];
					                				break;
					                			case 5:
					                				$d_msrp= $value['d_msrp_5'];
					                				break;
					                		}
					                		if($d_msrp!=0){echo $d_msrp.' +';}
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
                <?php echo $this->renderPartial('/priceGuide/addBasketball');  ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="submit-basketball">Save</button>
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
                <?php echo $this->renderPartial('/priceGuide/editBasketball');  ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-basketball">Save</button>
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
				<h4 class="modal-title">Basketball - Headers</h4>
			</div>
			<div class="modal-body">
			 
            <?php 
            	$form=$this->beginWidget('CActiveForm', array(
					'id'          => 'edit-dheader-form',
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
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r1c1'); ?></label>
					<div class="col-md-10 col-sm-6 col-xs-12">
						<?php echo $form->hiddenField($d_header, 'id'); ?>
						<?php //echo $form->hiddenField($d_header, 'type'); ?>
						<?php echo $form->textArea($d_header, 'r1c1', array('class' => 'form-control', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r1c2'); ?></label>
					<div class="col-md-10 col-sm-6 col-xs-12">
						<?php echo $form->textArea($d_header, 'r1c2', array('class' => 'form-control', 'required' => true)); ?>
					</div>
				</div>


				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r1c5'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r1c5', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r1c6'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r1c6', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r1c7'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r1c7', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r1c8'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r1c8', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r1c9'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r1c9', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r1c10'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r1c10', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r1c11'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r1c11', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r1c12'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r1c12', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r1c13'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r1c13', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r1c14'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r1c14', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>

				
				<div class="form-group group-header">
					<div class="col-md-12">
						<h2>ROW 2</h2>
					</div>
				</div>
			
				
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r2c5'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r2c5', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r2c6'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r2c6', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r2c7'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r2c7', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r2c8'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r2c8', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r2c9'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r2c9', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r2c10'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r2c10', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r2c11'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r2c11', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r2c12'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r2c12', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r2c13'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r2c13', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r2c14'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r2c14', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>

				
				<div class="form-group group-header">
					<div class="col-md-12">
						<h2>ROW 3</h2>
					</div>
				</div>
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r3c1_2'); ?></label>
					<div class="col-md-10 col-sm-6 col-xs-12">
						<?php echo $form->textArea($d_header, 'r3c1_2', array('class' => 'form-control', 'required' => true)); ?>
					</div>
				</div>

				
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r3c5'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r3c5', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r3c6'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r3c6', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r3c7'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r3c7', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r3c8'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r3c8', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r3c9'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r3c9', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r3c10'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r3c10', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r3c11'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r3c11', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r3c12'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r3c12', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r3c13'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r3c13', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $d_header->getAttributeLabel('r3c14'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($d_header, 'r3c14', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>



			<?php
				$this->endWidget();
            ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-dheader">Save</button>
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
				<h4 class="modal-title">Basketball - Sortdata</h4>
			</div>
			<div class="modal-body">
				<div >
					
					<?php
						$s = 1;
						
						
					?>
							
					<div id="sortable">		
					<?php
							foreach ($basketball as $key => $value) {
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
					<input type="hidden" name="type" value="Basketball">
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