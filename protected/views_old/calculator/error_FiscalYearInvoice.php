<div class="row" id="calculator">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>ERROR Invoice</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content text-center" >
				<h3 style="color:red"><?php echo $error_message;?></h3>
				
				<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/Invoice/year/<?php echo $year; ?>" class="btn btn-danger" ><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Go Back</a>
				
				
			</div>
		</div>

	</div>	
</div>	
