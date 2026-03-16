<?php
$table_width = 180+280+(sizeof($a_comm)*60);

//echo $admin_edit;
/*echo "<pre>";
print_r($a_item);
echo "</pre>";*/

?>
<style type="text/css">
	.tbl_show_pguide{
		border-collapse: 0px;
	}
	.tbl_show_pguide th{
		background-color: #5c656d;
		color: #FFF;
		border: 1px solid #848d94;
		text-align: center;
		padding: 5px;
	}
	.tbl_show_pguide td{
		background-color: #FFF;
		color: #73879C;
		border: 1px solid #848d94;
		text-align: center;
		padding: 5px;
	}
	.tbl_show_pguide .dl_col_backg1{
		background-color: #E7F1F5 !important;
		color: #000 !important;
	}
	.tbl_show_pguide .dl_col_backg2{
		background-color: #CCD3D7 !important;
		color: #000 !important;
	}
	.tbl_show_pguide .dl_col_backg3{
		background-color: #D0D0D0 !important;
		color: #000 !important;
	}
	.tbl_notes{
		border-collapse: 0px;
	}
	.tbl_notes th{
		border:1px solid #AAA;
		padding: 5px;
		background-color: #5c656d;
		color: #FFF;
	}
	.tbl_notes td{
		border:1px solid #AAA;
		padding: 5px;
	}
</style>
<!--<h2><?php echo $a_product['prod_detail']; ?></h2>-->
<!--<h3><?php echo $a_sale_type['sat_name']; ?> Pricing</h3>-->
<table >
    <tr>
        <td style="width:80%">
            <h2>All Products</h2>
            <h3><?php echo $a_sale_type['sat_name']; ?> Pricing</h3>
        </td>
               <td></td>
               <td></td>
               <td></td>
               <td></td> 
               <td></td> 
               <td></td>    
               <td></td> 
        <td colspan="9" style="text-align:right">
            <img src="https://sales.jog-joinourgame.com/images/jog-2.png" width="250" />
        </td>
    </tr>

</table>
<table class="tbl_show_pguide" style="width:<?php echo $table_width; ?>px;">
	<thead>
	<tr class="tr_head">
		<th class="fix_head1" style="width: 180px;" rowspan="2">
			Product
			<?php
			if(isset($admin_edit) && $admin_edit=="yes"){
				$have_group = 0;
				if(sizeof($a_item_group)>0){
					$have_group = 1;
				}
			
			}
			?>
		</th>
		<th class="fix_head1" style="width: 280px;">Description</th>
		<?php
		$a_use_bg = array();
		for($i=0;$i<sizeof($a_comm);$i++){

			switch($a_comm[$i]["qty_name"]){
				case 'QTY 15-99' : $a_use_bg[$i]="dl_col_backg1"; break;
				case 'QTY 100-299' : $a_use_bg[$i]="dl_col_backg2"; break;
				case 'QTY 300+' : $a_use_bg[$i]="dl_col_backg1"; break;
				case 'MSRP' : $a_use_bg[$i]="dl_col_backg3"; break;
				default : $a_use_bg[$i]="dl_col_backg1"; break;
			}
			?>
			<td style="width:60px;" class="fix_head1 <?php echo $a_use_bg[$i]; ?>"><b id="col_title<?php echo $a_comm[$i]["comm_per_id"]; ?>"><?php echo str_replace(" ", "<br>", $a_comm[$i]["qty_name"]); ?></b></td>
			<?php
		}
		?>
	</tr>
	<tr class="tr_head">
		<th class="fix_head2">Sales Commission</th>
		<?php
		$comm_loop = sizeof($a_comm);
		$n_col_span = 2+$comm_loop;
		for($i=0;$i<$comm_loop;$i++){
			?>
			<td class="fix_head2 <?php echo $a_use_bg[$i]; ?>"><b id="col_comm_percent<?php echo $a_comm[$i]["comm_per_id"]; ?>"><?php echo $a_comm[$i]["comm_value"]."%"; ?></b></td>
			<?php
		}
		?>
	</tr>
	</thead>
	<tbody>
	<?php
	$group_name = "";
	for($i=0;$i<sizeof($a_item);$i++){

		if($group_name!=$a_item[$i]["group_name"]){
			$group_name = $a_item[$i]["group_name"];
			echo '<tr><td colspan="'.$n_col_span.'" style="text-align:left; background-color:#848484; color:#FFF;" class="row_group_name">'.$group_name.'</td></tr>';
		}

		$item_id = $a_item[$i]["item_id"];
	?>
	<tr>
		<td style="width: 180px; text-align: left; color: #000;" id="row_item_name<?php echo $item_id; ?>"><?php echo $a_item[$i]["item_name"]; ?></td>
		<td style="width: 280px; text-align: left; color: #000;"><?php echo $a_item[$i]["item_style"]." ".$a_item[$i]["item_detail"]." ".$a_item[$i]["item_fabric_opt"]; ?></td>

		<?php
		for($j=0;$j<$comm_loop;$j++){

			$comm_per_id = $a_comm[$j]["comm_per_id"];

			?>
			<td style="width:60px;" class="<?php echo $a_use_bg[$j]; ?>">

			<?php 
			if(isset($admin_edit) && $admin_edit=="yes"){

				

				if( isset($a_pguide[$item_id][$comm_per_id]["price"]) ){

					$prg_id = $a_pguide[$item_id][$comm_per_id]["prg_id"];
					$price = $a_pguide[$item_id][$comm_per_id]["price"];

					/*$curr_id = $a_pguide[$item_id][$comm_per_id]["curr_id"];
					$sat_id = $a_pguide[$item_id][$comm_per_id]["sat_id"];*/
				?>
					<div id="prg_price<?php echo $prg_id; ?>" class="add-to-cart" onclick="return adminEditPrice(<?php echo $prg_id.",".$item_id.",".$curr_id.",".$sat_id.",".$comm_per_id; ?>);" data-toggle="modal" data-target="#adminEditPriceModal"><?php echo $price; ?></div>	
				<?php 
				}else{ 
					$cell_id = $item_id."00".$comm_per_id;
					?>
					<div id="prg_price<?php echo $cell_id; ?>" class="add_price" onclick="return adminAddPrice(<?php echo $cell_id.",".$item_id.",".$curr_id.",".$sat_id.",".$comm_per_id; ?>);" data-toggle="modal" data-target="#adminEditPriceModal">
						<i class="fa fa-plus-circle"></i>
					</div>
					<?php
				}
			}else{
				if( isset($a_pguide[$item_id][$comm_per_id]["price"]) ){ 
				?>
					<div class="add-to-cart" onclick="return addToCartV2(<?php echo $a_pguide[$item_id][$comm_per_id]["prg_id"]; ?>);">
						<?php echo $a_pguide[$item_id][$comm_per_id]["price"]; ?>	
					</div>	
				<?php 
				}else{ 
					echo "-"; 
				} 
			}
			?>
			</td>
			<?php
		}
		?>
	</tr>
	<?php
	}
	?>
	</tbody>
</table>

<?php if( sizeof($a_extra)>0 ){ ?>
<br><br>
<table class="tbl_notes" style="width: 100%;">
	<thead>
		<tr>
			<th>Extras</th>
			<th>Description</th>
			<th colspan="2" style="text-align: right;">MSRP</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($a_extra as $tmp_key => $row_extra){
	?>
	<tr>
		<td><?php echo $row_extra["extra_name"]; ?></td>
		<td><?php echo $row_extra["extra_desc"]; ?></td>
		<td colspan="2" style="text-align: right;"><?php echo $row_extra["extra_value"]; ?></td>
	</tr>
	<?php
	}
	?>
	</tbody>
</table>
<?php } ?>

<?php if( isset($row_notes["notes"]) ){ ?>
<br><br>
<table class="tbl_notes" style="width: 100%;">
	<thead>
		<tr><th colspan="5">Notes</th></tr>
	</thead>
	<tbody>
		<tr id="tr_show_notes">
			<td colspan="5" id="td_show_notes"><?php
			echo nl2br($row_notes["notes"]);
			?></td>
		</tr>
	</tbody>
</table>
<?php } ?>
