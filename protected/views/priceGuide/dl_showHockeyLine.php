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
	
	$( "#sortable1" ).sortable();
	$( "#sortable1" ).disableSelection();
	$( "#sortable2" ).sortable();
	$( "#sortable2" ).disableSelection();
	$( "#sortable3" ).sortable();
	$( "#sortable3" ).disableSelection();
	$( "#sortable4" ).sortable();
	$( "#sortable4" ).disableSelection();
	$( "#sortable5" ).sortable();
	$( "#sortable5" ).disableSelection();
	$( "#sortable6" ).sortable();
	$( "#sortable6" ).disableSelection();
	$( "#sortable7" ).sortable();
	$( "#sortable7" ).disableSelection();
	$( "#sortable8" ).sortable();
	$( "#sortable8" ).disableSelection();
	$( "#sortable9" ).sortable();
	$( "#sortable9" ).disableSelection();
	$( "#sortable10" ).sortable();
	$( "#sortable10" ).disableSelection();
	$( "#sortable11" ).sortable();
	$( "#sortable11" ).disableSelection();
	$( "#sortable12" ).sortable();
	$( "#sortable12" ).disableSelection();
	$( "#sortable13" ).sortable();
	$( "#sortable13" ).disableSelection();
	$( "#sortable14" ).sortable();
	$( "#sortable15" ).sortable();
	$( "#sortable15" ).disableSelection();
	$( "#sortable16" ).sortable();
	$( "#sortable16" ).disableSelection();
	
	$( "#sortclass1" ).sortable();
	$( "#sortclass1" ).disableSelection();

$('#edit-submit-sortdata').click(function(){
		var indexs = '';
		var data = '';
		
		$('.sortdata').each(function(){
			if(indexs==''){
				indexs = $(this).attr('id');
			}else{
				indexs = indexs +','+$(this).attr('id');
			}		
		});
		
		$('.sortda').each(function(){
			if(data==''){
				data = $(this).attr('id');
			}else{
				data = data +','+$(this).attr('id');
			}		
		});

		document.getElementById("data").value = data;
		
		document.getElementById("indexs").value = indexs;
		document.getElementById("edit-sortdata-form").submit();
	});
	
});


</script>
<div class="row" id="hockeyLine">

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
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showHockeyLine/v/Dealers/?curr=0">USD North America</option>';
                				$curr_name='USD North America';
                				break;
                			case 1:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showHockeyLine/v/Dealers/?curr=1">CAD North America</option>';
                				$curr_name='CAD North America';
                				break;
                			case 2:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showHockeyLine/v/Dealers/?curr=2">USD Europe and South America</option>';
                				$curr_name='USD Europe and South America';
                				break;
                			case 3:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showHockeyLine/v/Dealers/?curr=3">USD ASIA and Australia</option>';
                				$curr_name='USD ASIA and Australia';
                				break;
                			case 4:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showHockeyLine/v/Dealers/?curr=4">THB Thai Baht</option>';
                				$curr_name='THB Thai Baht';
                				break;
                			case 5:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/showHockeyLine/v/Dealers/?curr=5">SGD Singapore</option>';
                				$curr_name='SGD Singapore';
                				break;
                		}
                		echo $btn;
                	?>
                	<option value=""><b>Select Currency</b></option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showHockeyLine/v/Dealers/?curr=0">USD North America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showHockeyLine/v/Dealers/?curr=1">CAD North America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showHockeyLine/v/Dealers/?curr=2">USD Europe and South America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showHockeyLine/v/Dealers/?curr=3">USD ASIA and Australia</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showHockeyLine/v/Dealers/?curr=4">THB Thai Baht</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/showHockeyLine/v/Dealers/?curr=5">SGD Singapore</option>
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
					<table id="hockeyLineTable" class="table table-striped table-condensed table-freeze-multi table-bordered" data-scroll-height="600"data-cols-number="2" style="border-collapse: initial;">
						<colgroup>
							<col >
							<col style="width: 350px;">
							<col style="width: 370px;">
							<col style="width: 170px;">
							<col style="width: 170px;">
							<col style="width: 170px;">
							<col style="width: 270px;">
							
						</colgroup>
						<thead>
							<?php foreach ($getDealersheader as $key_header => $value_header) { ?>
								<tr>
									<th class="bg-blue-light text-center" rowspan="2">
										<button class="btn btn-success" data-toggle="modal" data-target="#editHeader" data-id="<?php echo $value_header['id'];?>" >
											Edit
										</button>
									</th>
									<th class="bg-blue-light text-center"><?php echo $value_header['r1c1']; ?></th>
									<th class="bg-blue-light text-center pre" style="text-align: left;word-wrap:break-word;padding:5px;"><?php echo $value_header['r1c2']; ?></th>
									
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c5']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c6']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c7']; ?></th>
									<th class="bg-price text-center pre" ><?php echo $value_header['r1c8']; ?></th>
								</tr>
								<tr>
									<th class="bg-blue-light text-center nowrap"><?php echo $value_header['r2c1']; ?></th>
									<th class="bg-blue-light text-center pre" style="text-align: left;padding:5px;"><?php echo $value_header['r2c2']; ?></th>
									
									<th class="bg-usd text-center" colspan="4"><?php echo $curr_name; ?></th>
									<!--<th class="bg-usd text-center" ><?php echo $value_header['r2c5']; ?></th>
									<th class="bg-cad text-center" ><?php echo $value_header['r2c6']; ?></th>
									<th class="bg-usd text-center" ><?php echo $value_header['r2c7']; ?></th>
									<th class="bg-price text-center" ><?php echo $value_header['r2c8']; ?></th>-->
								</tr>
								
							<?php } ?>	
						</thead>
						<tbody >
						<?php
							foreach ($hockeyl as $category => $hockeylinevalue) {
								?>
								<tr style="background-color: rgb(132, 132, 132);border: 1px solid #848484;outline: 0px solid #848484;">
									<td class="category_hocky  nowrap" colspan="" style="border: 1px solid #848484;outline: 0px solid #848484;"></td>
									<td class="category_hocky  nowrap" colspan="" style="vertical-align: middle;border: 1px solid #848484;    outline: 0px solid #848484;"><?php echo $category; ?></td>
									<td class="category_hocky  nowrap" colspan="" style="border: 1px solid #848484;outline: 0px solid #848484;"></td>
									<td class="category_hocky  nowrap" colspan="" style="border: 1px solid #848484;outline: 0px solid #848484;"></td>
									<td class="category_hocky  nowrap" colspan="" style="border: 1px solid #848484;outline: 0px solid #848484;"></td>
									<td class="category_hocky  nowrap" colspan="" style="border: 1px solid #848484;outline: 0px solid #848484;"></td>
									<td class="category_hocky  nowrap" colspan="" style="border: 1px solid #848484;outline: 0px solid #848484;"></td>
									
									
								</tr>
								<?php
									foreach ($hockeylinevalue as $key => $value) {
								?>
								<tr id="tr_<?php echo $value['id']; ?>">
									<td class="nowrap tbl-btn-box" style="vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;">
										<button class="btn btn-success" data-toggle="modal" data-target="#editData" data-id="<?php echo $value['id'];?>" >
											<i class="fa fa-pencil"></i>
										</button>
										<button class="btn btn-danger confirm" del-id="<?php echo $value['id'];?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/deleteHockeyLine" >
											<i class="fa fa-close"></i>
										</button>
									</td>
									<td style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;"><?php echo $value['style']; ?></td>
									<td class="" style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;"><?php echo nl2br($value['discription']); ?></td>
									<td class=" nowrap bg-usd text-center" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$dealers_qty1= $value['dealers_qty1'];
					                				break;
					                			case 1:
					                				$dealers_qty1= $value['dealers_qty1_1'];
					                				break;
					                			case 2:
					                				$dealers_qty1= $value['dealers_qty1_2'];
					                				break;
					                			case 3:
					                				$dealers_qty1= $value['dealers_qty1_3'];
					                				break;
					                			case 4:
					                				$dealers_qty1= $value['dealers_qty1_4'];
					                				break;
					                			case 5:
					                				$dealers_qty1= $value['dealers_qty1_5'];
					                				break;
					                		}
					                		if($dealers_qty1!=0){echo $dealers_qty1.' +';}
										?>
									</td>
									<td class=" nowrap bg-cad text-center" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$dealers_qty2= $value['dealers_qty2'];
					                				break;
					                			case 1:
					                				$dealers_qty2= $value['dealers_qty2_1'];
					                				break;
					                			case 2:
					                				$dealers_qty2= $value['dealers_qty2_2'];
					                				break;
					                			case 3:
					                				$dealers_qty2= $value['dealers_qty2_3'];
					                				break;
					                			case 4:
					                				$dealers_qty2= $value['dealers_qty2_4'];
					                				break;
					                			case 5:
					                				$dealers_qty2= $value['dealers_qty2_5'];
					                				break;
					                		}
					                		if($dealers_qty2!=0){echo $dealers_qty2.' +';}
										?>
									</td>
									<td class=" nowrap bg-usd text-center" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$dealers_qty3= $value['dealers_qty3'];
					                				break;
					                			case 1:
					                				$dealers_qty3= $value['dealers_qty3_1'];
					                				break;
					                			case 2:
					                				$dealers_qty3= $value['dealers_qty3_2'];
					                				break;
					                			case 3:
					                				$dealers_qty3= $value['dealers_qty3_3'];
					                				break;
					                			case 4:
					                				$dealers_qty3= $value['dealers_qty3_4'];
					                				break;
					                			case 5:
					                				$dealers_qty3= $value['dealers_qty3_5'];
					                				break;
					                		}
					                		if($dealers_qty3!=0){echo $dealers_qty3.' +';}
										?>
									</td>
									
									<td class=" nowrap bg-price text-center" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$dealers_msrp= $value['dealers_msrp'];
					                				break;
					                			case 1:
					                				$dealers_msrp= $value['dealers_msrp_1'];
					                				break;
					                			case 2:
					                				$dealers_msrp= $value['dealers_msrp_2'];
					                				break;
					                			case 3:
					                				$dealers_msrp= $value['dealers_msrp_3'];
					                				break;
					                			case 4:
					                				$dealers_msrp= $value['dealers_msrp_4'];
					                				break;
					                			case 5:
					                				$dealers_msrp= $value['dealers_msrp_5'];
					                				break;
					                		}
					                		if($dealers_msrp!=0){echo $dealers_msrp.' +';}
										?>
									</td>
								</tr>
								<?php
									}}
								?>
							</tbody>
						
					</table>
				</div>
				<br>
				<br>
				<br>
				<div class="btn-add">
					<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addDataExtras"><i class="fa fa-plus"></i> Add</a>
				</div>
				<table id="extrasTable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="bg-blue-light" colspan="2">Extras</th>
							<th class="bg-blue-light">Description</th>
							<th class="bg-blue-light text-center">MSRP</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($extras as $key => $value) {
						?>
						<tr>
							<td class="tbl-btn-box">
								<button class="btn btn-success" data-toggle="modal" data-target="#editDataExtras" data-id="<?php echo $value['id'];?>">
									<i class="fa fa-pencil"></i>
								</button>
								<button class="btn btn-danger confirm" del-id="<?php echo $value['id'];?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/deleteExtras">
									<i class="fa fa-close"></i>
								</button>
							</td>
							<td><?php echo $value['extras']; ?></td>
							<td><?php echo nl2br($value['discription']); ?></td>
							<td class="text-right nowrap"><?php echo Helper::usFormat($value['msrp']); ?></td>

						</tr>
						<?php
							}
						?>
					</tbody>
				</table>

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
				<h4 class="modal-title">2018 Hockey Apparel & Lacrosse Line & Bags Price List / Hockey Line - Add</h4>
			</div>
			<div class="modal-body">
                <?php echo $this->renderPartial('/priceGuide/addHockeyLine');  ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="submit-hockeyLine">Save</button>
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
				<h4 class="modal-title">2018 Hockey Apparel & Lacrosse Line & Bags Price List / Hockey Line - Edit</h4>
			</div>
			<div class="modal-body">
                <?php echo $this->renderPartial('/priceGuide/editHockeyLine');  ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-hockeyLine">Save</button>
			</div>
		</div>
	</div>
</div>

<!-- Add Extras -->
<div class="modal fade" id="addDataExtras" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Extras - Add</h4>
			</div>
			<div class="modal-body">
                <?php echo $this->renderPartial('/priceGuide/addExtras');  ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="submit-extras">Save</button>
			</div>
		</div>
	</div>
</div>


<!-- Edit Extras -->
<div class="modal fade" id="editDataExtras" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Extras - Edit</h4>
			</div>
			<div class="modal-body">
                <?php echo $this->renderPartial('/priceGuide/editExtras');  ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-extras">Save</button>
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
				<h4 class="modal-title">Hockey Line - Headers</h4>
			</div>
			<div class="modal-body">
			 
            <?php 
            	$form=$this->beginWidget('CActiveForm', array(
					'id'          => 'edit-dealersheader-form',
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
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $dealers_header->getAttributeLabel('r1c1'); ?></label>
					<div class="col-md-10 col-sm-6 col-xs-12">
						<?php echo $form->hiddenField($dealers_header, 'id'); ?>
						<?php //echo $form->hiddenField($header, 'type'); ?>
						<?php echo $form->textArea($dealers_header, 'r1c1', array('class' => 'form-control', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $dealers_header->getAttributeLabel('r1c2'); ?></label>
					<div class="col-md-10 col-sm-6 col-xs-12">
						<?php echo $form->textArea($dealers_header, 'r1c2', array('class' => 'form-control', 'required' => true)); ?>
					</div>
				</div>


				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $dealers_header->getAttributeLabel('r1c5'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($dealers_header, 'r1c5', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $dealers_header->getAttributeLabel('r1c6'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($dealers_header, 'r1c6', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $dealers_header->getAttributeLabel('r1c7'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($dealers_header, 'r1c7', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $dealers_header->getAttributeLabel('r1c8'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($dealers_header, 'r1c8', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>
				
				<div class="form-group group-header">
					<div class="col-md-12">
						<h2>ROW 2</h2>
					</div>
				</div>
				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $dealers_header->getAttributeLabel('r2c1'); ?></label>
					<div class="col-md-10 col-sm-6 col-xs-12">
						<?php echo $form->textArea($dealers_header, 'r2c1', array('class' => 'form-control', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $dealers_header->getAttributeLabel('r2c2'); ?></label>
					<div class="col-md-10 col-sm-6 col-xs-12">
						<?php echo $form->textArea($dealers_header, 'r2c2', array('class' => 'form-control', 'required' => true)); ?>
					</div>
				</div>


				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $dealers_header->getAttributeLabel('r2c5'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($dealers_header, 'r2c5', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $dealers_header->getAttributeLabel('r2c6'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($dealers_header, 'r2c6', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $dealers_header->getAttributeLabel('r2c7'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($dealers_header, 'r2c7', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
					<label class=" col-md-2 col-sm-3 col-xs-12"><?php echo $dealers_header->getAttributeLabel('r2c8'); ?></label>
					<div class="col-md-4 col-sm-3 col-xs-12">
						<?php echo $form->textArea($dealers_header, 'r2c8', array('class' => 'form-control numeric', 'required' => true)); ?>
					</div>
				</div>


			<?php
				$this->endWidget();
            ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-dealersheader">Save</button>
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
				<h4 class="modal-title">HockeyLine - Sortdata</h4>
			</div>
			<div class="modal-body">
				<div >
					<div id="sortclass1" >
					<?php
						$s = 1;
						$m = 1;
						foreach ($hockeyl as $category => $hockeylinevalue) {
					?>
					<div class="sortda" id="<?php echo $category; ?>"  style="border:2px solid #ccc;padding: 5px 10px;margin-top:10px;background-color:#fff;">
						<div style="padding: 20px 5px;font-weight: bold;color:#003563;font-size:14px;">
							<span ><?php echo $category; ?></span>
						</div>			
						<div id="sortable<?php echo $m; ?>">		
						<?php
										
								foreach ($hockeylinevalue as $key => $value) {
						?>
									<div class="ui-state-default " style="padding: 5px 5px;font-size:14px;">
										<span class="ui-icon ui-icon-arrowthick-2-n-s sortdata" id="<?php echo $value['id'];?>"></span><span style="font-weight:700;">
										<?php echo $s.".";?> <?php echo $value['style']; ?></span><br> <span style="font-size:12px;"><?php echo nl2br($value['discription']); ?></span>
									</div>
						<?php
								$s++;
								}
						?>
						</div>
					</div>
												
					<?php
					$m++;
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
					<input type="hidden" name="type" value="Hockey">
					<input type="hidden" name="sortdata" id="indexs">
					<input type="hidden" name="sortda" id="data">
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