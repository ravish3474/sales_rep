<style type="text/css">
	.tbl_item_list{
		width: 100%;
	}
	.tbl_item_list th{
		padding: 5px;
	}
	.tbl_item_list td{
		border: 1px solid #848484;
		padding: 5px;
	}
	.list_item td{
		color: #000;
		text-align: left;

	}
	.list_item_group td{
		text-align: left; 
		background-color: #848484; 
		color: #FFF; 
		font-weight: bold;
	}
	.list_item button{
		padding: 5px 8px !important;
	}
</style>
<table class="tbl_item_list">
	<tr>
		<th style="text-align: center;">#</th>
		<th style="width: 200px;">Name</th>
		<th>Description</th>
		<th>User Description</th>
		<th style="width: 100px; text-align: center;">Action</th>
	</tr>
	<?php
	if($have_group=="1" && $item_group_id!="==no_group=="){

		for($j=0; $j<sizeof($a_group); $j++){
			?>
			<tr class="list_item_group">
				<td colspan="5"><?php echo $a_group[$j]["group_name"]; ?></td>
			</tr>
			<?php
			$count_in_group = 1;
			for($i=0; $i<sizeof($a_item); $i++){

				if( $a_item[$i]["group_id"]==$a_group[$j]["item_group_id"] ){
				?>
				<tr class="list_item" id="list_item<?php echo $a_item[$i]["main_id"]; ?>">
					<td style="text-align: center;"><?php echo $count_in_group; ?></td>
					<td><?php echo $a_item[$i]["item_name"]; ?></td>
					<td style="white-space: pre-line;"><?php echo $a_item[$i]["item_style"]." ".$a_item[$i]["item_detail"]." ".$a_item[$i]["item_fabric_opt"]; ?>		
					</td>
					<td><textarea disabled=""><?php echo $a_item[$i]["description"]; ?></textarea></td>
					<td style="text-align: center;">
						<button type="button" class="btn btn-warning" title="Edit info" onclick="return editProductItem(<?php echo $a_item[$i]["main_id"]; ?>);">
							<i class="fa fa-pencil"></i>
						</button>
					</td>
				</tr>
				<?php
					$count_in_group++;
				}
			}
		}

		$have_no_group = false;
		$a_item_no_group = array();
		for($i=0; $i<sizeof($a_item); $i++){
			if($a_item[$i]["group_id"]==""){
				$have_no_group = true;
				$a_item_no_group[] = $a_item[$i];
			}
		}

		if($have_no_group){
			?>
			<tr class="list_item_group">
				<td colspan="5"><b><font style="color:#F88;">&lt; NO GROUP &gt;</font></b></td>
			</tr>
			<?php
			$count_in_group = 1;
			foreach($a_item_no_group as $tmp_key => $a_item2){
				?>
				<tr class="list_item" id="list_item<?php echo $a_item2["main_id"]; ?>">
					<td style="text-align: center;"><?php echo $count_in_group; ?></td>
					<td><?php echo $a_item2["item_name"]; ?></td>
					<td style="white-space: pre-line;"><?php echo $a_item2["item_style"]." ".$a_item2["item_detail"]." ".$a_item2["item_fabric_opt"]; ?>		
					</td>
					<td><textarea disabled=""><?php echo $a_item2["description"]; ?></textarea></td>
					<td style="text-align: center;">
						<button type="button" class="btn btn-warning" title="Edit info" onclick="return editProductItem(<?php echo $a_item2["main_id"]; ?>);">
							<i class="fa fa-pencil"></i>
						</button>
					</td>
				</tr>
				<?php
				$count_in_group++;
			}
		}

	}else{

			?>
			<tr class="list_item_group">
				<td colspan="5"><b><font style="color:#F88;">&lt; NO GROUP &gt;</font></b></td>
			</tr>
			<?php

		for($i=0; $i<sizeof($a_item); $i++){
			?>
			<tr class="list_item" id="list_item<?php echo $a_item[$i]["main_id"]; ?>">
				<td style="text-align: center;"><?php echo ($i+1); ?></td>
				<td><?php echo $a_item[$i]["item_name"]; ?></td>
				<td><?php echo $a_item[$i]["item_style"]." ".$a_item[$i]["item_detail"]." ".$a_item[$i]["item_fabric_opt"]; ?></td>
				<td><textarea disabled=""><?php echo $a_item[$i]["description"]; ?></textarea></td>
				<td style="text-align: center;">
					<button type="button" class="btn btn-warning" title="Edit info" onclick="return editProductItem(<?php echo $a_item[$i]["main_id"]; ?>);">
						<i class="fa fa-pencil"></i>
					</button>
				</td>
			</tr>
			<?php
		}
	}
	
	?>
</table>