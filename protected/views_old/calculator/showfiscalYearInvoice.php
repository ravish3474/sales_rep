<div class="row" id="calculator">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Fiscal Year Invoice</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<ul class="no-list">
				<?php
					$getYear = array_unique($yearall);
					 arsort($getYear);
					foreach ($getYear as $key => $value) {
				?>
					<li>
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/ShowInvoice/year/<?php echo $value;?>">
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
