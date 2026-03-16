<div class="row" id="calculator">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Fiscal Year Invoice</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="btn-add">
					<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addData"><i class="fa fa-plus"></i> Add</a>
				</div>
				<ul class="no-list">
				<?php
					$getYear = array_unique($yearall);
					 arsort($getYear);
					foreach ($getYear as $key => $value) {
				?>
					<li>
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/Invoice/year/<?php echo $value;?>">
							<i class="fa fa-file-text-o" aria-hidden="true"></i><?php echo $value; ?>
						</a>
					</li>
				<?php
					}
				?>
				</ul>
			</div>
		</div>

	</div>	
</div>	
<div class="modal fade" id="addData" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Sales Commission Calculator - Add</h4>
			</div>
			<div class="modal-body">
                <?php echo $this->renderPartial('/calculator/addCalculator');  ?>
			</div>
			
		</div>
	</div>
</div>