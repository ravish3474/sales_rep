<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('category'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->hiddenField($model, 'id'); ?>
		<?php echo $form->textArea($model, 'category', array('class' => 'form-control', 'required' => true)); ?>
	</div>
</div>
<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('notes'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textArea($model, 'notes', array('class' => 'form-control', 'required' => true)); ?>
	</div>
</div>
<?php $header = HeaderSalesrep::model()->findAll("type = 'Basketball'"); ?>
<?php foreach ($header as $key => $value) { ?>
<div class="form-group group-header">
	<div class="col-md-12">
		<h2>Sales Direct</h2>
	</div>
</div>
<table class="table table-bordered">
	<tr>
		<th width="150">QTY</th>
		<th>USD North America</th>
		<th>CAD North America</th>
		<th>USD Europe and South America</th>
		<th>USD ASIA and Australia</th>
		<th>THB Thai</th>
		<th>SGD singapore</th>
	</tr>
	<tr>
		<td><?php echo $value['r1c6']." (".$value['r3c6'].")"; ?></td>
		<td><?php echo $form->textField($model, 'qty2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty2_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty2_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty2_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty2_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty2_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value['r1c7']." (".$value['r3c7'].")"; ?></td>
		<td><?php echo $form->textField($model, 'qty3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty3_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty3_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty3_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty3_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty3_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value['r1c8']." (".$value['r3c8'].")"; ?></td>
		<td><?php echo $form->textField($model, 'qty4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty4_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty4_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty4_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty4_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty4_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value['r1c9']." (".$value['r3c9'].")"; ?></td>
		<td><?php echo $form->textField($model, 'qty5', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty5_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty5_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty5_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty5_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty5_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value['r1c11']." (".$value['r3c11'].")"; ?></td>
		<td><?php echo $form->textField($model, 'qty7', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty7_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty7_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty7_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty7_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty7_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value['r1c12']." (".$value['r3c12'].")"; ?></td>
		<td><?php echo $form->textField($model, 'qty8', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty8_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty8_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty8_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty8_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty8_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value['r1c13']." (".$value['r3c13'].")"; ?></td>
		<td><?php echo $form->textField($model, 'qty9', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty9_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty9_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty9_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty9_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty9_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value['r1c14']." (".$value['r3c14'].")"; ?></td>
		<td><?php echo $form->textField($model, 'qty10', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty10_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty10_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty10_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty10_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty10_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value['r1c16']." (".$value['r3c16'].")"; ?></td>
		<td><?php echo $form->textField($model, 'qty12', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty12_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty12_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty12_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty12_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty12_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value['r1c17']." (".$value['r3c17'].")"; ?></td>
		<td><?php echo $form->textField($model, 'qty13', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty13_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty13_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty13_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty13_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty13_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value['r1c18']." (".$value['r3c18'].")"; ?></td>
		<td><?php echo $form->textField($model, 'qty14', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty14_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty14_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty14_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty14_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty14_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value['r1c19']." (".$value['r3c19'].")"; ?></td>
		<td><?php echo $form->textField($model, 'qty15', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty15_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty15_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty15_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty15_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'qty15_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value['r1c20']; ?></td>
		<td><?php echo $form->textField($model, 'msrp', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'msrp_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'msrp_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'msrp_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'msrp_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'msrp_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
</table>
<?php } ?>

<?php $dheader = DheaderSalesrep::model()->findAll("type = 'Basketball'"); ?>
<?php foreach ($dheader as $key_d => $value_d) { ?>
<div class="form-group group-header">
	<div class="col-md-12">
		<h2>Sales Dealers</h2>
	</div>
</div>
<table class="table table-bordered">
	<tr>
		<th width="150">QTY</th>
		<th>USD North America</th>
		<th>CAD North America</th>
		<th>USD Europe and South America</th>
		<th>USD ASIA and Australia</th>
		<th>THB Thai</th>
		<th>SGD singapore</th>
	</tr>
	<tr>
		<td><?php echo $value_d['r1c5']." (".$value_d['r3c5'].")"; ?></td>
		<td><?php echo $form->textField($model, 'd_qty1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty1_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty1_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty1_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty1_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty1_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value_d['r1c6']." (".$value_d['r3c6'].")"; ?></td>
		<td><?php echo $form->textField($model, 'd_qty2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty2_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty2_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty2_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty2_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty2_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value_d['r1c7']." (".$value_d['r3c7'].")"; ?></td>
		<td><?php echo $form->textField($model, 'd_qty3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty3_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty3_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty3_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty3_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty3_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value_d['r1c8']." (".$value_d['r3c8'].")"; ?></td>
		<td><?php echo $form->textField($model, 'd_qty4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty4_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty4_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty4_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty4_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty4_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value_d['r1c9']." (".$value_d['r3c9'].")"; ?></td>
		<td><?php echo $form->textField($model, 'd_qty5', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty5_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty5_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty5_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty5_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty5_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value_d['r1c10']." (".$value_d['r3c10'].")"; ?></td>
		<td><?php echo $form->textField($model, 'd_qty6', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty6_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty6_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty6_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty6_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty6_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value_d['r1c11']." (".$value_d['r3c11'].")"; ?></td>
		<td><?php echo $form->textField($model, 'd_qty7', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty7_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty7_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty7_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty7_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty7_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value_d['r1c12']." (".$value_d['r3c12'].")"; ?></td>
		<td><?php echo $form->textField($model, 'd_qty8', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty8_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty8_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty8_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty8_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty8_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value_d['r1c13']." (".$value_d['r3c13'].")"; ?></td>
		<td><?php echo $form->textField($model, 'd_qty9', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty9_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty9_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty9_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty9_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_qty9_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value_d['r1c14']; ?></td>
		<td><?php echo $form->textField($model, 'd_msrp', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_msrp_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_msrp_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_msrp_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_msrp_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'd_msrp_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
</table>
<?php } ?>
<?php $dealersheaderheader = DealersheaderSalesrep::model()->findAll("type = 'Baseball'"); ?>
<?php foreach ($dealersheaderheader as $key_dealers => $value_dealers) { ?>
<div class="form-group group-header">
	<div class="col-md-12">
		<h2>Dealers</h2>
	</div>
</div>
<table class="table table-bordered">
	<tr>
		<th width="150">QTY</th>
		<th>USD North America</th>
		<th>CAD North America</th>
		<th>USD Europe and South America</th>
		<th>USD ASIA and Australia</th>
		<th>THB Thai</th>
		<th>SGD singapore</th>
	</tr>
	<tr>
		<td><?php echo $value_dealers['r1c5']; ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty1_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty1_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty1_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty1_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty1_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value_dealers['r1c6']; ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty2_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty2_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty2_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty2_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty2_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value_dealers['r1c7']; ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty3_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty3_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty3_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty3_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_qty3_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
	<tr>
		<td><?php echo $value_dealers['r1c8']; ?></td>
		<td><?php echo $form->textField($model, 'dealers_msrp', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_msrp_1', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_msrp_2', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_msrp_3', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_msrp_4', array('class' => 'form-control numeric')); ?></td>
		<td><?php echo $form->textField($model, 'dealers_msrp_5', array('class' => 'form-control numeric')); ?></td>
	</tr>
</table>
<?php } ?>