<?php
	$active[0] = 'active';
	$active[1] = null;
	$active[2] = null;
	if (isset($_GET['v']) && $_GET['v'] == 'Sales_Dealers') {
		$active[0] = null;
		$active[1] = 'active';
		$active[2] = null;
		
	}elseif (isset($_GET['v']) && $_GET['v'] == 'Dealers') {
		$active[0] = null;
		$active[1] = null;
		$active[2] = 'active';
	}

	if (Yii::app()->user->getState('userGroup') == 1 || Yii::app()->user->getState('userGroup') == 2 || Yii::app()->user->getState('userGroup') == 99) {

		if(isset($_GET['curr'])){
			$curr=$_GET['curr'];
		}else{
			$curr=0;
		}
?>
<div class="btn-group" data-toggle="buttons">
	<label class="btn btn-primary <?php echo $active[0]; ?>" link="<?php echo Yii::app()->controller->action->id; ?>?curr=<?php echo $curr; ?>" tbl-type="Sales">
		<input type="radio" autocomplete="off" checked> Sales Direct
	</label>
	<label class="btn btn-primary <?php echo $active[1]; ?>" link="<?php echo Yii::app()->controller->action->id; ?>/v/Sales_Dealers?curr=<?php echo $curr; ?>" tbl-type="Sales_Dealers">
		<input type="radio" autocomplete="off"> Sales Dealers
	</label>
	<label class="btn btn-primary <?php echo $active[2]; ?>" link="<?php echo Yii::app()->controller->action->id; ?>/v/Dealers?curr=<?php echo $curr; ?>" tbl-type="Dealers">
		<input type="radio" autocomplete="off"> Dealers
	</label>
</div>
<?php
	}
?>