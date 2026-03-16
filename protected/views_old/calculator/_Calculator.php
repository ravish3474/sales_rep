
<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice'); ?>  <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
	<?php 
	$salesRepTmp = "";
	if(!empty($_GET['sales'])){
		$salesRepTmp = $_GET['sales'];
	}
	?>
		<input type="hidden" name="salesRep" value="<?php echo $salesRepTmp; ?>">
		
		<?php echo $form->hiddenField($model, 'id'); ?>
		<?php echo $form->hiddenField($model, 'sales_manager'); ?>
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
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('order_no'); ?>  <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textField($model, 'order_no', array('class' => 'form-control', 'required' => true)); ?>
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

<div class="form-group">	
	<label class=" col-md-3 col-sm-3 col-xs-12">Sales <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		
		<select class="form-control" name="Calculator[sales_manager]" id="Calculator_sales_manager" >
			<option value="" >Please Select Sales manager</option>
		<?php 
			foreach ($user as $key=> $value){	
		?>
            <option value="<?php echo $value['fullname']; ?>" ><?php echo $value['fullname']; ?></option>
		<?php } ?>
			
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




<div class="form-group group-header">
	<div class="col-md-12">
		<h2>Sales</h2>
	</div>
</div>
<div class="form-group">	
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('status_commission'); ?></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<select class="form-control" name="Calculator[status_commission]" id="Calculator_status_commission" >
			<option value="Pending" hidden>Please Select Status</option>
			<option value="Approved">Approved</option>
            <option value="Not Approved">Not Approved</option>
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
	
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('online_order_commission'); ?></label>
	<div class="col-md-3 col-sm-3 col-xs-12">
		<?php echo $form->numberField($model, 'online_order_commission', array('class' => 'form-control numeric','step' => '0.01','value' => '0')); ?>
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
		<?php echo $form->textField($model, 'date_for_sales', array('class' => 'form-control numeric', 'id'=>'date_for_sales_edit')); ?>
	</div>
</div>

<div class="form-group">	
	<label class=" col-md-3 col-sm-3 col-xs-12">Comm PO by JOG</label>
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

<div class="form-group">	
	<label class=" col-md-3 col-sm-3 col-xs-12">Payment received from customer</label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->numberField($model, 'pay_by_customer', array('class' => 'form-control numeric','step' => '0.01','value' => '0')); ?>
	</div>
</div>

<div class="form-group">	
	<label class=" col-md-3 col-sm-3 col-xs-12">Comm PO by Credit</label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->numberField($model, 'pay_by_credit', array('class' => 'form-control numeric','step' => '0.01','value' => '0')); ?>
	</div>
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<button type="button" class="btn btn-primary" onclick="return checkDuplicateINV();">Save</button>
</div>

<script type="text/javascript">
function checkDuplicateINV(){

	var cal_id = $('#edit-calculator-form').find('#Calculator_id').val();
	var cal_inv = $('#edit-calculator-form').find('#Calculator_invoice').val();
	var sales_manager = $('#edit-calculator-form').find('#Calculator_sales_manager').val();

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/calculator/checkDuplicateINV" ,
        data:{
            "id":cal_id,
            "inv_number":cal_inv,
            "sales_manager":window.btoa(sales_manager)
        },
        success: function(resp){ 

            if(resp.result=="duplicated"){
            	alert("Duplicated invoice #");
            	return false;
            }else{
            	$('#edit-calculator-form').submit();
            }

        }  
    });
}
</script>