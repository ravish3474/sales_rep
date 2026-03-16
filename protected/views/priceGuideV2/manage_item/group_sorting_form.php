<?php
if (sizeof($a_group) == 0) {
?>
	<h4 style="width:100%; text-align:center; color:#F55;">Not found.</h4>
<?php
	exit();
}
?>
<style type="text/css">
	#tbl_group_sorting th,
	td {

		padding: 5px;
	}

	#tbl_group_sorting td {
		border: 1px solid #999;
		background-color: #EEE;
		color: #000;
	}

	#inner_group_sorting tr {
		cursor: grab;
	}

	#inner_group_sorting tr:active {
		cursor: grabbing;
	}

	.top-title {
		margin: 10px 0;
		background: #EEE;
		padding: 10px;
		color: #F55;
		font-size: 14px;
		line-height: 4;
		text-transform: capitalize;
		border-radius: 20px;
	}

	@media screen and (max-width:520px) {
		.top-title {
			font-size: 12px;
			line-height: 4;
		}

	}
</style>
<center><b>
		<font class="top-title">***Grab the rows and drag for sorting groups***</font>
	</b></center>
<h4><span style="text-decoration: underline;">Sort group</span></h4>
<form id="form_group_sorting">
	<table style="width: 100%;" id="tbl_group_sorting">
		<tbody>
			<tr>
				<th>#</th>
				<th>Group name</th>
			</tr>
		</tbody>
		<tbody id="inner_group_sorting">
			<?php
			for ($i = 0; $i < sizeof($a_group); $i++) {
			?>
				<tr>
					<td style="text-align: center;"><?php echo ($i + 1); ?>
						<input type="hidden" name="sort_item_group_id[]" value="<?php echo $a_group[$i]["item_group_id"]; ?>">
					</td>
					<td><?php echo $a_group[$i]["group_name"]; ?></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</form>