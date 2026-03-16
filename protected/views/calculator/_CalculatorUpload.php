<div style="background-color: #D5DBDB;border-bottom: 3px solid #002752;padding: 10px 0;">
	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice'); ?> <span style="color:red">*</span></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php //echo $form->hiddenField($model, 'id'); ?>
			<?php //echo $form->hiddenField($model, 'sales_manager'); ?>
			<?php echo $form->textField($model, 'invoice', array('class' => 'form-control', 'required' => true)); ?>
		</div>
		
	</div>

	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('order_no'); ?> <span style="color:red">*</span></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php echo $form->textField($model, 'order_no', array('class' => 'form-control', 'required' => true)); ?>
		</div>
	</div>
	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('order_name'); ?> <span style="color:red">*</span></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php echo $form->textField($model, 'order_name', array('class' => 'form-control', 'required' => true)); ?>
		</div>
	</div>
	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('date_quarter'); ?> <span style="color:red">*</span></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php echo $form->textField($model, 'date_quarter', array('class' => 'form-control', 'required' => true)); ?>
		</div>
	</div>

	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('file_path'); ?> </label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php //echo $form->fileField($model, 'file_path[]', array('class'=>'file', 'data-show-upload'=>'false',  'data-min-file-count'=>'1')); ?>
			<?php echo $form->fileField($model, 'file_path[]', array('class'=>'file', 'data-show-upload'=>'false')); ?>
		</div>
	</div>

	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('inv_link'); ?></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php echo $form->textField($model, 'inv_link', array('class' => 'form-control', 'required' => false)); ?>
		</div>
	</div>

	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('currency'); ?> <span style="color:red">*</span></label>
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
			<?php echo $form->textField($model, 'invoice_date', array('class' => 'form-control numeric')); ?>
		</div>
	</div>

	<div class="form-group">	
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice_amount_received'); ?></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php echo $form->numberField($model, 'invoice_amount_received', array('class' => 'form-control numeric','step' => '0.01')); ?>
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
</div>
<div style="background-color: #F2F3F4;border-bottom: 3px solid #002752;padding: 10px 0;">
	<div class="form-group group-header">
		<div class="col-md-12">
			<h2>Sales Manager</h2>
		</div>
	</div>
	<div class="form-group">	
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('sales_manager'); ?> <span style="color:red">*</span></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			
			<select class="form-control" name="Calculator[sales_manager]" id="Calculator_sales_manager" >
				<option value="" >Please Select Sales manager</option>
			<?php 
				foreach ($user as $key=> $value){	
			?>
				<option value="<?php echo $value['fullname']; ?>"><?php echo $value['fullname']; ?></option>
			<?php } ?>
				
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('total_sales'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<?php echo $form->numberField($model, 'total_sales', array('class' => 'form-control numeric','step' => '0.01','value' => '0')); ?>
		</div>
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('shipping_cost'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<?php echo $form->numberField($model, 'shipping_cost', array('class' => 'form-control numeric','step' => '0.01','value' => '0')); ?>
		</div>
	</div>

	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('creditcard_feecost'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<?php echo $form->numberField($model, 'creditcard_feecost', array('class' => 'form-control numeric','step' => '0.01','value' => '0')); ?>
		</div>
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('commission'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<?php echo $form->numberField($model, 'commission_percent', array('class' => 'form-control numeric','step' => '0.01','value' => '0')); ?>
			
		</div>
	</div>

	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('comp_itemcost'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<?php echo $form->numberField($model, 'comp_itemcost', array('class' => 'form-control numeric','step' => '0.01','value' => '0')); ?>
		</div>
		
	</div>

	<div class="form-group group-header">
		<div class="col-md-12">
			<h2>Commissions Payment  </h2>
		</div>
	</div>

	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('commisson_payment_status'); ?></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<select class="form-control" name="Calculator[commisson_payment_status]" id="Calculator_commisson_payment_status" >
				<option value="" hidden>Please Select Status</option>
				<option value="Paid">Paid</option>
				<option value="Outstanding">Outstanding</option>
			</select>
		</div>
	</div>

	<div class="form-group">	
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('date_for_sales'); ?></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php echo $form->textField($model, 'date_for_sales', array('class' => 'form-control numeric')); ?>
		</div>
	</div>

	<div class="form-group">	
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('pay_for_sales'); ?></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php echo $form->numberField($model, 'pay_for_sales', array('class' => 'form-control numeric','step' => '0.01','value' => '0')); ?>
		</div>
	</div>

	<div class="form-group">	
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('payment_method'); ?></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<select class="form-control" name="Calculator[payment_method]" id="Calculator_payment_method" >
				<option value="" hidden>Please Select Payment Method</option>
				<option value="Cheque">Cheque</option>
				<option value="Wire Transfer">Wire Transfer</option>
				<option value="Cash on Hand">Cash on Hand</option>
				 <option value="Credit Card">Credit Card</option>
			</select>
		</div>
	</div>
</div>
<div style="background-color: #D5DBDB;border-bottom: 3px solid #002752;padding: 10px 0;">
	<div class="form-group group-header">
		<div class="col-md-12">
			<h2>Sales Rep</h2>
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
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('total_sales'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<input type="number" name="Calculator[total_salesrep]" id="Calculator_total_salesrep" class="form-control numeric" step="0.01" value="0">
			<?php //echo $form->numberField($model, 'total_sales', array('class' => 'form-control numeric','step' => '0.01')); ?>
		</div>
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('shipping_cost'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<input type="number" name="Calculator[shipping_cost_salesrep]" id="Calculator_shipping_cost_salesrep" class="form-control numeric" step="0.01" value="0">
			<?php //echo $form->numberField($model, 'shipping_cost', array('class' => 'form-control numeric','step' => '0.01')); ?>
		</div>
	</div>

	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('creditcard_feecost'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<input type="number" name="Calculator[creditcard_feecost_salesrep]" id="Calculator_creditcard_feecost_salesrep" class="form-control numeric" step="0.01" value="0">
			<?php //echo $form->numberField($model, 'creditcard_feecost', array('class' => 'form-control numeric','step' => '0.01')); ?>
		</div>
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('commission'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<input type="number" name="Calculator[commission_percent_salesrep]" id="Calculator_commission_percent_salesrep" class="form-control numeric" step="0.01" value="0">
			<?php //echo $form->numberField($model, 'commission_percent', array('class' => 'form-control numeric','step' => '0.01')); ?>
			
		</div>
	</div>

	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('comp_itemcost'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<input type="number" name="Calculator[comp_itemcost_salesrep]" id="Calculator_comp_itemcost_salesrep" class="form-control numeric" step="0.01" value="0">
		</div>
	</div>

	<div class="form-group group-header">
		<div class="col-md-12">
			<h2>Commissions Payment  </h2>
		</div>
	</div>

	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('commisson_payment_status'); ?></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<select class="form-control" name="Calculator[commisson_payment_status_salesrep]" id="Calculator_commisson_payment_status_salesrep" >
				<option value="" hidden>Please Select Status</option>
				<option value="Paid">Paid</option>
				<option value="Outstanding">Outstanding</option>
			</select>
		</div>
	</div>

	<div class="form-group">	
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('date_for_sales'); ?></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<input type="text" name="Calculator[date_for_sales_salesrep]" id="Calculator_date_for_sales_salesrep" class="form-control numeric" >
			<?php //echo $form->textField($model, 'date_for_sales', array('class' => 'form-control numeric')); ?>
		</div>
	</div>

	<div class="form-group">	
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('pay_for_sales'); ?></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<input type="number" name="Calculator[pay_for_sales_salesrep]" id="Calculator_pay_for_sales_salesrep" class="form-control numeric" step="0.01" value="0">
			<?php //echo $form->numberField($model, 'pay_for_sales', array('class' => 'form-control numeric','step' => '0.01')); ?>
		</div>
	</div>

	<div class="form-group">	
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('payment_method'); ?></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<select class="form-control" name="Calculator[payment_method_salesrep]" id="Calculator_payment_method_salesrep" >
				<option value="" hidden>Please Select Payment Method</option>
				<option value="Cheque">Cheque</option>
				<option value="Wire Transfer">Wire Transfer</option>
				<option value="Cash on Hand">Cash on Hand</option>
				 <option value="Credit Card">Credit Card</option>
			</select>
		</div>
	</div>
</div>
<div style="background-color: #F2F3F4;border-bottom: 3px solid #002752;padding: 10px 0;">
	<div class="form-group group-header">
		<div class="col-md-12">
			<h2>Sales Processor</h2>
		</div>
	</div>
	<div class="form-group">	
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('sales_processor'); ?> </label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<input class="form-control" name="Calculator[sales_processor]" id="Calculator_sales_processor" >
		</div>
	</div>
</div>



			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" >Save</button>
			</div>