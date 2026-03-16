<Style>
	footer {
		margin: 0;
	}

	.copyright-info {
		padding: 0;
		display: flex;
		align-items: center;
		justify-content: end;
		height: 100%;
	}

	.x_content li {
		font-size: 18px;
		line-height: 40px;
	}

	.x_content li i {
		margin-right: 15px;
		background: #2a3f5421;
		color: #21374d;
		padding: 5px;
		border-radius: 2px;
		font-size: 14px;
		font-weight: 500;
	}




	@media screen and (max-width:520px) {
		.copyright-info {
			padding: 10px;
			display: flex;
			align-items: center;
			justify-content: end;
			height: 100%;
		}

		.x_content li {
			font-size: 14px;
			line-height: 40px;
		}

		.x_content li i {
			margin-right: 8px;
			padding: 5px;
		}
	}
</Style>

<div class="row" id="baseball">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Documents</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<ul class="no-list noListItems">
					<?php
					foreach ($files as $key => $value) {
					?>
						<li>
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/docs/downloadFile/id/<?php echo $value['id']; ?>">
								<?php echo Helper::getIconFile($value['file_type']) . $value['file_name']; ?>
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