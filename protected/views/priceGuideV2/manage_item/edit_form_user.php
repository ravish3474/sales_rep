<style type="text/css">
	.edit_input{
		width: 100%;
		min-height: auto !important;
		max-height: 110px !important;
		padding:3px;
	}
	#edit_prod_item_form>.row div{
		padding: 5px;
	}
</style>
<h4 style="text-decoration: underline;">Edit item</h4>
<div class="container">
	<form id="edit_prod_item_form">
		<div class="row">
			<div class="col-md-1" style="padding-top: 0px; ">
				<div class="row" style="padding-top: 0px; ">
					<div class="col-md-12 text-right">
						Name: 
					</div>
					<div class="col-md-12 text-right" style="padding-top: 15px;">
						Group: 
					</div>
				</div>
			</div>
			<div class="col-md-5 text-left" style="padding-top: 0px; ">
				<div class="row" style="padding-top: 0px; ">
					<div class="col-md-12 text-left">
						<input type="hidden" id="edit_item_id" name="edit_item_id" value="<?php echo $a_item["main_id"]; ?>">
						<input class="edit_input" type="text" id="edit_item_name" readonly disabled value="<?php echo htmlspecialchars($a_item["item_name"]); ?>">
					</div>
					<div class="col-md-12 text-left">
						<?php
						if(sizeof($a_group)>0){
							?>
							<select id="edit_item_group" disabled name="edit_item_group" class="edit_input">
                                <option value="==no_group==">== No Group ==</option>
                                <?php
                                for($i=0;$i<sizeof($a_group);$i++){
                                ?>
                                    <option <?php echo ($a_group[$i]["item_group_id"]==$a_item["group_id"])?'selected':''; ?> value="<?php echo $a_group[$i]["item_group_id"]."#&#".$a_group[$i]["group_name"]; ?>"><?php echo $a_group[$i]["group_name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
							<?php
						}else{
							echo '<font color=black>&lt;No group&gt;</font><input type="hidden" name="edit_item_group" value="==no_group==">';
						}
						?>
						<input type="hidden" name="old_group_id" value="<?php echo ($a_item["group_id"]=="")?"==no_group==":$a_item["group_id"]; ?>">
						<input type="hidden" name="edit_prod_id" value="<?php echo $a_item["prod_id"]; ?>">
						<input type="hidden" name="old_sort" value="<?php echo $a_item["sort"]; ?>">
					</div>
				</div>
				
			</div>
			
			<div class="col-md-1 text-right">
				Detail: 
			</div>
			<div class="col-md-5 text-left">
				<textarea class="edit_input" id="edit_item_detail" disabled rows="5"><?php echo htmlspecialchars($a_item["item_detail"]); ?></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-md-1 text-right">
				Style: 
			</div>
			<div class="col-md-5 text-left">
				<textarea class="edit_input" id="edit_item_style" disabled rows="5"><?php echo htmlspecialchars($a_item["item_style"]); ?></textarea>
			</div>
			<div class="col-md-1 text-right">
				Fabric option: 
			</div>
			<div class="col-md-5 text-left">
				<textarea class="edit_input" id="edit_item_fabric_opt" disabled rows="5"><?php echo htmlspecialchars($a_item["item_fabric_opt"]); ?></textarea>
			</div>
		</div>
		<div class="row">
		    <div class="col-md-1 text-right">
				User Description: 
			</div>
			<div class="col-md-11 text-left">
				<textarea class="edit_input" name="main_desc" rows="5"><?php echo htmlspecialchars($a_item["description"]); ?></textarea>
			</div>
		</div>
	</form>
</div>