
<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice'); ?>  <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->hiddenField($model, 'id'); ?>
		<?php echo $form->hiddenField($model, 'date_quarter'); ?>
		<?php echo $form->hiddenField($model, 'currency'); ?>
		<?php echo $form->textField($model, 'invoice', array('class' => 'form-control', 'required' => true)); ?>
	</div>
	
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('order_name'); ?>  <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textField($model, 'order_name', array('class' => 'form-control', 'required' => true)); ?>
	</div>
</div>


<div class="form-group">	
	<label class=" col-md-3 col-sm-3 col-xs-12">Processor <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		
		<?php echo $form->textField($model, 'sales_manager', array('class' => 'form-control', 'required' => true)); ?>
	</div>
</div>


<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-primary" >Save</button>
</div>