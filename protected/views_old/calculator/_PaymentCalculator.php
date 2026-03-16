
<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		
		<?php echo $form->hiddenField($model, 'id'); ?>
		<?php echo $form->hiddenField($model, 'sales_manager'); ?>
		<?php echo $form->hiddenField($model, 'date_quarter'); ?>
		<?php echo $form->textField($model, 'invoice', array('class' => 'form-control', 'required' => true, 'disabled' => true)); ?>
	</div>
</div>
<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('order_name'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textField($model, 'order_name', array('class' => 'form-control', 'required' => true, 'disabled' => true)); ?>
	</div>
</div>

<div class="form-group group-header">
	<div class="col-md-12">
		<h2>Sales <?php if($status == "Approved"){ echo "<span style=\"font-size:12px;\">(Commission Status : "."<span style=\"color:green;\">".$status.")</span></span>"; }?></h2>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('total_sales'); ?> <span style="color:red">*</span></label>
	<div class="col-md-3 col-sm-3 col-xs-12">
		<?php 
			if($status == "Approved"){ 
				echo $form->hiddenField($model, 'total_sales');
				echo $form->numberField($model, 'total_sales', array('class' => 'form-control numeric','step' => '0.01', 'required' => true, 'disabled' => true)); 
			}else{
				echo $form->numberField($model, 'total_sales', array('class' => 'form-control numeric','step' => '0.01', 'required' => true)); 
			} 
		?>
	</div>
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('shipping_cost'); ?> <span style="color:red">*</span></label>
	<div class="col-md-3 col-sm-3 col-xs-12">
		<?php 
			if($status == "Approved"){ 
				echo $form->hiddenField($model, 'shipping_cost');
				echo $form->numberField($model, 'shipping_cost', array('class' => 'form-control numeric','step' => '0.01', 'required' => true, 'disabled' => true));
			}else{
				echo $form->numberField($model, 'shipping_cost', array('class' => 'form-control numeric','step' => '0.01', 'required' => true));
			} 
		 ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('creditcard_feecost'); ?> <span style="color:red">*</span></label>
	<div class="col-md-3 col-sm-3 col-xs-12">
		<?php 
			if($status == "Approved"){ 
				echo $form->hiddenField($model, 'creditcard_feecost');
				echo $form->numberField($model, 'creditcard_feecost', array('class' => 'form-control numeric','step' => '0.01', 'required' => true, 'disabled' => true));
			}else{
				echo $form->numberField($model, 'creditcard_feecost', array('class' => 'form-control numeric','step' => '0.01', 'required' => true));
			} 
		 ?>
	</div>
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('commission'); ?> <span style="color:red">*</span></label>
	<div class="col-md-3 col-sm-3 col-xs-12">
		<?php 
			if($status == "Approved"){ 
				echo $form->hiddenField($model, 'commission_percent');
				echo $form->numberField($model, 'commission_percent', array('class' => 'form-control numeric','step' => '0.01', 'required' => true, 'disabled' => true));
			}else{
				echo $form->numberField($model, 'commission_percent', array('class' => 'form-control numeric','step' => '0.01', 'required' => true));
			} 
		 ?>
	</div>
</div>



<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-primary" >Save</button>
</div>