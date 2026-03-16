<style type="text/css">
	.new_input {
		width: 100%;
		min-height: auto !important;
		max-height: 110px !important;
		padding: 3px;
	}

	#new_prod_item_form>.row div {
		padding: 5px;
	}
</style>
<div class="container">
	<form id="new_prod_item_form">
		<div class="row">
			<!-- <div class="col-md-1" style="padding-top: 0px; ">
				<div class="row" style="padding-top: 0px; ">
					<div class="col-md-12 text-right">
						Name: 
					</div>
					<div class="col-md-12 text-right" style="padding-top: 15px;">
						Group: 
					</div>
				</div>
			</div> -->
			<h4 class="form-title">New item</h4>

			<div class=" col-md-12 text-left" style="padding-top: 0px; ">
				<div class="row" style="padding-top: 0px;    display: flex; align-items: center; ">
					<div class="col-md-12 text-left">
						<label for="">Name:</label>
						<input class="new_input" type="text" id="new_item_name" name="new_item_name" value="">
						<input type="hidden" id="new_prod_id" name="new_prod_id" value="<?php echo $prod_id; ?>">
					</div>
					<div class="col-md-12 text-left">
						<label for="">Group:</label>

						<?php
						if (sizeof($a_group) > 0) {
						?>
							<select id="new_item_group" name="new_item_group" class="new_input">
								<option value="==no_group==">== No Group ==</option>
								<?php
								for ($i = 0; $i < sizeof($a_group); $i++) {
								?>
									<option value="<?php echo $a_group[$i]["item_group_id"] . "#&#" . $a_group[$i]["group_name"]; ?>"><?php echo $a_group[$i]["group_name"]; ?></option>
								<?php
								}
								?>
							</select>
						<?php
						} else {
							echo '<font color=black>&lt;No group&gt;</font><input type="hidden" name="new_item_group" value="==no_group==">';
						}
						?>
					</div>
				</div>

		</div>

		<div class="col-md-12 text-left">
			<label for="">Details:</label>
			<textarea class="new_input" id="new_item_detail" name="new_item_detail" rows="5"></textarea>
		</div>
</div>
<div class="row">
	<div class="col-md-6 text-left">
		<label for="">Style:</label>

		<textarea class="new_input" id="new_item_style" name="new_item_style" rows="5"></textarea>
	</div>

	<div class="col-md-6 text-left">
		<label for="">Fabric option:</label>

		<textarea class="new_input" id="new_item_fabric_opt" name="new_item_fabric_opt" rows="5"></textarea>
	</div>
</div>
</form>
</div>