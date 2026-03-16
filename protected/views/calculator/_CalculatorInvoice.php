
<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice'); ?>  <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->hiddenField($model, 'id'); ?>
		<?php //echo $form->hiddenField($model, 'sales_manager'); ?>
		<?php echo $form->textField($model, 'invoice', array('class' => 'form-control', 'required' => true)); ?>
	</div>
	
	
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('order_no'); ?>  <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textField($model, 'order_no', array('class' => 'form-control', 'required' => true)); ?>
	</div>
</div>
<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('order_name'); ?>  <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textField($model, 'order_name', array('class' => 'form-control', 'required' => true)); ?>
	</div>
</div>
<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('date_quarter'); ?>  <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textField($model, 'date_quarter', array('class' => 'form-control', 'id'=>'date_quarter_edit', 'required' => true)); ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('file_path'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		
		<?php echo $form->fileField($model, 'file_path', array('class'=>'file', 'data-show-upload'=>true)); ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('inv_link'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textField($model, 'inv_link', array('class' => 'form-control', 'required' => false)); ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('currency'); ?>  <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<select class="form-control" name="Calculator[currency]" id="Calculator_currency" required>
			<option value="" hidden>Please Select Currency</option>
			<option value="USD">USD</option>
            <option value="CAD">CAD</option>
            <option value="SGD">SGD</option>
            <option value="THB">THB</option>
		</select>
	</div>
</div>

<div class="form-group group-header">
	<div class="col-md-12">
		<h2>Invoice Payment </h2>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice_status'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<select class="form-control" name="Calculator[invoice_status]" id="Calculator_invoice_status" >
			<option value="" hidden>Please Select Invoice Payment Status</option>
			<option value="Paid">Paid</option>
            <option value="Outstanding">Outstanding</option>
		</select>
	</div>
</div>

<div class="form-group">	
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice_date'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textField($model, 'invoice_date', array('class' => 'form-control numeric', 'id'=>'invoice_date_edit')); ?>
	</div>
</div>

<div class="form-group">	
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice_amount_received'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->numberField($model, 'invoice_amount_received', array('class' => 'form-control numeric','step' => '0.01','value' => '0')); ?>
	</div>
</div>

<div class="form-group">	
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice_payment_method'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<select class="form-control" name="Calculator[invoice_payment_method]" id="Calculator_invoice_payment_method" >
			<option value="" hidden>Please Select Payment Method</option>
			<option value="Cheque">Cheque</option>
            <option value="Wire Transfer">Wire Transfer</option>
            <option value="Cash on Hand">Cash on Hand</option>
            <option value="Credit Card">Credit Card</option>
		</select>
	</div>
</div>



<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-primary" >Save</button>
</div>

