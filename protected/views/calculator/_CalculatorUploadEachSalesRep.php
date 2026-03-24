<?php 
	$invno = isset($_GET['invno']) ? htmlspecialchars($_GET['invno']) : ''; 
	$invlnk = isset($_GET['invlnk']) ? htmlspecialchars($_GET['invlnk']) : ''; 
	$per = isset($_GET['per']) ? htmlspecialchars($_GET['per']) : 0; 
	$Order_Name = isset($_GET['ordnm']) ? htmlspecialchars_decode($_GET['ordnm']) : '';
	$jogcode = isset($_GET['jogcode']) ? htmlspecialchars($_GET['jogcode']) : '';
	
	$month = isset($_GET['month']) ? htmlspecialchars($_GET['month']) : 'm';

	$shipping = 0;
	$grand_total = 0;
	$total = 0;
	$feeprice= 0;
	$date = date('Y-m-d');
	$year = $_GET['year'];

	$nmonth = date('m',strtotime($month));
	
	$date = date(''.$year.'-'.$nmonth.'-01');

	


	if (isset($_GET['jogcode'])) {
		
		$jogcode = $_GET['jogcode'];
        $prefix = preg_replace('/[A-Za-z]+$/', '', $jogcode);

		$sql = "SELECT * FROM quotation_data WHERE jog_code LIKE '%$prefix%'";
		$a_count = Yii::app()->db->createCommand($sql)->queryAll();

		foreach ($a_count as $key => $value) {
			$qdoci_id = $value['qdoci_id'];

			$sql = "SELECT * FROM `tbl_quote_doc` WHERE `qdoc_id` = '$qdoci_id'";
			$tot = Yii::app()->db->createCommand($sql)->queryAll();
			$grand_total = $tot[0]['grand_total'];

			$sql = "SELECT * FROM `tbl_quote_item` WHERE `qdoc_id` = '$qdoci_id' AND `pro_name` LIKE '%Shipping%'";
			$shipp = Yii::app()->db->createCommand($sql)->queryAll();
			$shipping = $shipp[0]['uprice'];	


			$sql = "SELECT *  FROM `tbl_quote_item` WHERE `qdoc_id` = '$qdoci_id' AND (`pro_name` LIKE '%Royalty%' OR `pro_name` LIKE '%Credit Card%')";
			$free = Yii::app()->db->createCommand($sql)->queryAll();

			if (isset($free[0])) {				
				$feeprice = $free[0]['uprice'];
			}
			
			$total = $grand_total; 
			$curr = $tot[0]['quote_curr'];	
			
			
		}
	}

	// If opened from JOG Code modal with specific checked items, use that sum
	if (isset($_GET['comm_total']) && $_GET['comm_total'] !== '') {
		$total = floatval($_GET['comm_total']);
	}

?>
<style>
.datepicker-days,
.datepicker-months,
.datepicker-years,
.datepicker-decades,
.datepicker-centuries{
  position: relative; z-index: 10001;
  background:rgb(255, 255, 255);
  border:1px solid rgb(157, 157, 157);
  border-radius:4px;
} 
</style>
<div style="background-color: #D5DBDB;border-bottom: 3px solid #002752;padding: 10px 0;">
	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('invoice'); ?> <span style="color:red">*</span></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php //echo $form->hiddenField($model, 'id'); ?>
			<?php 	if(!empty($_GET['sales'])){ 	
						$_GET['sales'] = $_GET['sales'];
					}else{
						$_GET['sales'] = "";
					} 
			 ?>	
				<input type="hidden" name="salesRep" value="<?php echo $_GET['sales']; ?>">
		
			<?php echo $form->textField($model, 'invoice', array('class' => 'form-control', 'required' => true, 'value' => $invno)); ?>
		</div>
		
	</div>

	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('order_no'); ?> <span style="color:red">*</span></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php echo $form->textField($model, 'order_no', array('class' => 'form-control', 'required' => true,'value' => $jogcode)); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('order_name'); ?> <span style="color:red">*</span></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php echo $form->textField($model, 'order_name', array('class' => 'form-control', 'required' => true, 'value' => $Order_Name )); ?> 
		</div>
	</div>
	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('date_quarter'); ?> <span style="color:red">*</span></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php echo $form->textField($model, 'date_quarter', array('class' => 'form-control', 'required' => true,'value' =>  $date)); ?>
		</div>
	</div>

	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('file_path'); ?></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php echo $form->fileField($model, 'file_path[]', array('class'=>'file', 'data-show-upload'=>'false', 'required' => false, 'data-min-file-count'=>'0')); ?>
		</div>
	</div>

	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('inv_link'); ?><span style="color:red">*</span></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<?php echo $form->textField($model, 'inv_link', array('class' => 'form-control', 'required' => true,'value' => $invlnk  )); ?>
		</div>
	</div>

	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('currency'); ?> <span style="color:red">*</span></label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<select class="form-control" name="Calculator[currency]" id="Calculator_currency" required>
				<option value="" hidden>Please Select Currency</option>
				<option value="USD" <?php echo (isset($curr) && $curr == 'USD') ? 'selected' : ''; ?>>USD</option>
				<option value="CAD" <?php echo (isset($curr) && $curr == 'CAD') ? 'selected' : ''; ?>>CAD</option>
				<option value="SGD" <?php echo (isset($curr) && $curr == 'SGD') ? 'selected' : ''; ?>>SGD</option>
				<option value="THB" <?php echo (isset($curr) && $curr == 'THB') ? 'selected' : ''; ?>>THB</option>
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
			<?php echo $form->numberField($model, 'invoice_amount_received', array('class' => 'form-control numeric','step' => '0.01','value' => $total)); ?>
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
				<option value="<?php echo $value['fullname']; ?>" <?php if($_GET['sales'] == $value['fullname']){ echo "selected";}?>><?php echo $value['fullname']; ?></option>
			<?php } ?>
				
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('total_sales'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<?php echo $form->numberField($model, 'total_sales', array('class' => 'form-control numeric','step' => '0.01','value' => $total)); ?>
		</div>
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('shipping_cost'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<?php echo $form->numberField($model, 'shipping_cost', array('class' => 'form-control numeric','step' => '0.01','value' => $shipping)); ?>
		</div>
	</div>

	<div class="form-group">		
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('commission'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<?php echo $form->numberField($model, 'commission_percent', array('class' => 'form-control numeric','step' => '0.01','value' => $per)); ?>			
		</div>
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('comp_itemcost'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<?php echo $form->numberField($model, 'comp_itemcost', array('class' => 'form-control numeric','step' => '0.01','value' => '0')); ?>
		</div>
	</div>

	<div class="form-group">		
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('online_order_commission'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<?php echo $form->numberField($model, 'online_order_commission', array('class' => 'form-control numeric','step' => '0.01','value' => '0')); ?>
		</div>
		<label class=" col-md-3 col-sm-3 col-xs-12">Namebar / Patches</label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<?php echo $form->numberField($model, 'namebar_patches', array('class' => 'form-control numeric','step' => '0.01','value' => '0')); ?>
		</div>
		
	</div>	
	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('creditcard_feecost'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<?php echo $form->numberField($model, 'creditcard_feecost', array('class' => 'form-control numeric','step' => '0.01','value' => $feeprice)); ?>
		</div>
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('royalty_feecost'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<?php echo $form->numberField($model, 'royalty_feecost', array('class' => 'form-control numeric', 'step' => '0.01', 'value' => '0')); ?>
		</div>		
	</div>
	<?php if (isset($_GET['from_jog']) && $_GET['from_jog'] == '1'): ?>
	<div class="form-group">
		<label class=" col-md-3 col-sm-3 col-xs-12">Sales Tax</label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<?php echo $form->numberField($model, 'sales_tax', array('class' => 'form-control numeric','step' => '0.01','value' => '0')); ?>
		</div>
	</div>
	<?php endif; ?>
	<!-- <div class="form-group group-header">
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
	</div> -->
</div>
<div style="background-color: #D5DBDB;border-bottom: 3px solid #002752;padding: 10px 0;">
	<div class="form-group group-header " style="display:none;">
		<div class="col-md-12">
			<h2>Sales Rep</h2>
		</div>
	</div>
	<div class="form-group " style="display:none;">	
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('sales_rep'); ?> </label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			
			<select class="form-control" name="Calculator[sales_rep]" id="Calculator_sales_rep"  >
				<option value="" hidden>Please Select Sales Rep</option>
			<?php 
				foreach ($user as $key=> $value){	
			?>
				<option value="<?php echo $value['fullname']; ?>" ><?php echo $value['fullname']; ?></option>
			<?php } ?>
				
			</select>
		</div>
	</div>
	<div class="form-group " style="display:none;">
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

	<div class="form-group " style="display:none;">
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
	<div class="form-group " style="display:none;">
		<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('comp_itemcost'); ?></label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<input type="number" name="Calculator[comp_itemcost_salesrep]" id="Calculator_comp_itemcost_salesrep" class="form-control numeric" step="0.01" value="0">
			<?php //echo $form->numberField($model, 'comp_itemcost', array('class' => 'form-control numeric','step' => '0.01')); ?>
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
		<label class=" col-md-3 col-sm-3 col-xs-12">Comm PO by JOG</label>
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
	
	<div class="form-group">	
		<label class=" col-md-3 col-sm-3 col-xs-12">Subtract from Sales Commission</label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<input type="number" name="Calculator[pay_by_customer]" id="Calculator_pay_by_customer" class="form-control numeric" step="0.01" value="0">
		</div>
	</div>
	<div class="form-group">	
		<label class=" col-md-3 col-sm-3 col-xs-12">Comm PO by Credit</label>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<input type="number" name="Calculator[pay_by_credit]" id="Calculator_pay_by_credit" class="form-control numeric" step="0.01" value="0">
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