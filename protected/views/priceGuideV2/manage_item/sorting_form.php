<?php
if(sizeof($a_item)==0){
	?>
	<h4 style="width:100%; text-align:center; color:#F55;">Not found.</h4>
	<?php
	exit();
}
?>
<style type="text/css">
	#tbl_item_sorting th,td{
		
		padding: 5px;
	}
	#tbl_item_sorting td{
		border:1px solid #999;
		background-color: #EEE;
		color: #000;
	}
	#inner_item_sorting tr{
		cursor: grab;
	}
	#inner_item_sorting tr:active:hover{
		cursor: grabbing;
	}
	
</style>
<center><b><font color=red>***Grab the rows and drag for sorting items***</font></b></center>
<h4><span style="text-decoration: underline;">Sort item</span> <?php echo (($a_item[0]["group_name"]!="")?" in ":"").$a_item[0]["group_name"]; ?></h4>
<form id="form_item_sorting">
	<table style="width: 100%;" id="tbl_item_sorting">
		<tbody>
			<tr>
				<th>#</th>
				<th style="width: 200px;">Name</th>
				<th>Description</th>
			</tr>
		</tbody>
		<tbody id="inner_item_sorting">
			<?php
			for($i=0;$i<sizeof($a_item);$i++){

				$tmp_desc = $a_item[$i]["item_style"]." ".$a_item[$i]["item_detail"]." ".$a_item[$i]["item_fabric_opt"];
				if(strlen($tmp_desc)>100){
					$show_desc = substr($tmp_desc, 0,100).'...';
				}else{
					$show_desc = $tmp_desc;
				}
				$show_desc = ((strlen($tmp_desc)>100)?substr($tmp_desc, 0,100)."...":$tmp_desc);
			?>
			<tr>
				<td style="text-align: center;"><?php echo ($i+1);?>
					<input type="hidden" name="sort_item_id[]" value="<?php echo $a_item[$i]["item_id"]; ?>">
				</td>
				<td><?php echo $a_item[$i]["item_name"];?></td>
				<td style="white-space: pre-line;"><?php echo $show_desc; ?></td>
			</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</form>
