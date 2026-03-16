
<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice'); ?> <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php //echo $form->hiddenField($model, 'id'); ?>
		<?php echo $form->hiddenField($model, 'date_quarter'); ?>
		<?php echo $form->hiddenField($model, 'currency'); ?>
		<?php echo $form->hiddenField($model, 'invoice_status'); ?>
		<?php echo $form->hiddenField($model, 'file_path'); ?>
		<?php echo $form->textField($model, 'invoice', array('class' => 'form-control', 'required' => true)); ?>
	</div>
	
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('order_name'); ?> <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textField($model, 'order_name', array('class' => 'form-control', 'required' => true)); ?>
	</div>
</div>


<div class="form-group">	
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('sales_rep'); ?> </label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		
		<select class="form-control" name="Calculator[sales_rep]" id="Calculator_sales_rep"  >
			<option value="" >Please Select Sales Rep</option>
		<?php 
			foreach ($user as $key=> $value){	
		?>
            <option value="<?php echo $value['fullname']; ?>" ><?php echo $value['fullname']; ?></option>
		<?php } ?>
			
		</select>
	</div>
</div>

<div class="form-group">	
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('sales_processor'); ?> </label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<input class="form-control" name="Calculator[sales_processor]" id="Calculator_sales_processor" >
	</div>
</div>




			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" >Save</button>
			</div>