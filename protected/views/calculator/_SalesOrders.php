<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('date_saleorder'); ?> <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textField($model, 'date_saleorder', array('class' => 'form-control numeric')); ?>
		
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('order_no'); ?> <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textField($model, 'order_no', array('class' => 'form-control', 'placeholder' => 'EX18-000', 'required' => true)); ?>
		<input type="hidden" name="SalesOrders[date_update]" value="<?php echo date('Y-m-d'); ?>">
		
	</div>
</div>
<?php if(Yii::app()->user->getState('userGroup') == 99 || Yii::app()->user->getState('userGroup') == 1){ ?>
<div class="form-group">	
	<label class=" col-md-3 col-sm-3 col-xs-12"> Sales Rep <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		
		<select class="form-control" name="SalesOrders[sales_rep]" id="SalesOrders_sales_rep" >
			<option value="" >Please Select Sales Rep</option>
		<?php 
			foreach ($user as $key=> $value){	
		?>
            <option value="<?php echo $value['fullname']; ?>"><?php echo $value['fullname']; ?></option>
		<?php } ?>
			
		</select>
	</div>
</div>
<?php }elseif(Yii::app()->user->getState('userGroup') == 2){ ?>
	<input type="hidden" name="SalesOrders[sales_rep]" value="<?php  echo Yii::app()->user->getState('fullName');?>">
<?php } ?>
<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('order_name'); ?> </label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textField($model, 'order_name', array('class' => 'form-control')); ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('commission_percent'); ?> (1) </label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->numberField($model, 'commission_percent', array('class' => 'form-control')); ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('commission_percent'); ?> (2)</label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->numberField($model, 'commission_percent2', array('class' => 'form-control')); ?>
	</div>
</div>

<div class="form-group">
	<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $model->getAttributeLabel('remark'); ?> <span style="color:red">*</span></label>
	<div class="col-md-9 col-sm-6 col-xs-12">
		<?php echo $form->textArea($model, 'remark', array('class' => 'form-control')); ?>
	</div>
</div>



			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" >Save</button>
			</div>