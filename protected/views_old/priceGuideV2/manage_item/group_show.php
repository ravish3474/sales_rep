<h4 style="text-decoration: underline;">Item group</h4>
<?php
if(sizeof($a_group)==0){
?>
<h4 style="width:100%; text-align:center; color:#F55;">Not found.</h4>
<?php
exit();
}
?>

<style type="text/css">
	.tbl_group_list{
		width: 100%;
	}
	.tbl_group_list th{
		padding: 5px;
	}
	.tbl_group_list td{
		border: 1px solid #848484;
		padding: 5px;
		background-color: #EFE;
	}
</style>

<table class="tbl_group_list">
	<tr>
		<th style="text-align: center;">#</th>
		<th >Group Name</th>
		<th style="text-align: center;">Items</th>
		<th style="width: 120px; text-align: center;">Action</th>
	</tr>
	<?php

	for($i=0; $i<sizeof($a_group); $i++){
		?>
		<tr id="list_group<?php echo $a_group[$i]["item_group_id"]; ?>">
			<td style="text-align: center;"><?php echo ($i+1); ?></td>
			<td id="td_group_name<?php echo $a_group[$i]["item_group_id"]; ?>"><?php echo $a_group[$i]["group_name"]; ?></td>
			<td style="text-align: center;"><?php echo ($a_group[$i]["num_item"]=="")?"0":$a_group[$i]["num_item"]; ?></td>
			<td style="text-align: center;">
				<button type="button" class="btn btn-warning" title="Edit group name" onclick="return editItemGroup(<?php echo $a_group[$i]["item_group_id"]; ?>);">
					<i class="fa fa-pencil"></i>
				</button>
				<button <?php if(intval($a_group[$i]["num_item"])>0){ echo "disabled"; } ?> type="button" class="btn btn-danger" title="Delete group" onclick="return deleteItemGroup(<?php echo $a_group[$i]["item_group_id"]; ?>);">
					<i class="fa fa-trash"></i>
				</button>
			</td>
		</tr>
		<?php
	}
	
	?>
</table>