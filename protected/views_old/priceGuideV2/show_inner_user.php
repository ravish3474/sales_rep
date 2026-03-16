<?php
$table_width = 180+280+(sizeof($a_comm)*60);

//echo $admin_edit;
/*echo "<pre>";
print_r($a_item);
echo "</pre>";*/

?>
<style type="text/css">
	.fix_head1{
		position: sticky;
		top:0px;
		border: 1px solid #848d94 !important;
	}
	.fix_head2{
		position: sticky;
		top:50px;
		border: 1px solid #848d94 !important;
		
	}

	table{
		border-collapse: unset !important;
	}
</style>

<div id="lower_table" style="max-height:700px; max-width:1260px; overflow: scroll;">
<table class="tbl_show_pguide" style="width:100%;">
	
	<tr class="tr_head">
		<th class="fix_head1" style="width: 180px;" rowspan="1">
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
		<th class="fix_head1">Description</th>
		<th class="fix_head1">Edited Description</th>
		<?php
		$a_use_bg = array();
		for($i=0;$i<sizeof($a_comm);$i++){

			switch($a_comm[$i]["qty_name"]){
				case 'QTY 15-99' : $a_use_bg[$i]="col_backg1"; break;
				case 'QTY 100-299' : $a_use_bg[$i]="col_backg2"; break;
				case 'QTY 300+' : $a_use_bg[$i]="col_backg1"; break;
				case 'MSRP' : $a_use_bg[$i]="col_backg3"; break;
				default : $a_use_bg[$i]="col_backg1"; break;
			}
			?>
			<td style="width:60px;" class="fix_head1 <?php echo $a_use_bg[$i]; ?>"><b id="col_title<?php echo $a_comm[$i]["comm_per_id"]; ?>"><?php echo str_replace(" ", "<br>", $a_comm[$i]["qty_name"]); ?></b></td>
			<?php
		}
		?>
	</tr>
	<tr class="tr_head">
	    <th class="fix_head2" style="text-align: center;width:50%">
    	    <div class="form-group">
              <label for="sel1">Product Category</label>
              <select class="form-control" id="sel1">
                  <option value="" selected disabled>--Select Product Category--</option>
                <?php
                $group_name = "";
            	for($i=0;$i<sizeof($a_item);$i++){
            		if($group_name!=$a_item[$i]["group_name"]){
            			$group_name = $a_item[$i]["group_name"];
            			echo '<option value="group_'.$i.'">'.$group_name.'</option>';
            		}
            	}
                ?>
              </select>
            </div>
    	</th>
		<th class="fix_head2" style="text-align: center;width:100%">(Original)</th>
		<th class="fix_head2" style="text-align: center;width:100%">Sales Commission</th>
		<?php
		$comm_loop = sizeof($a_comm);
		$n_col_span = 2+$comm_loop;
		$comm_type = Yii::app()->user->getState('commissionType');
		for($i=0;$i<$comm_loop;$i++){
			?>
			<td class="fix_head2 <?php echo $a_use_bg[$i]; ?>"><b id="col_comm_percent<?php echo $a_comm[$i]["comm_per_id"]; ?>"><?php 
			if($sat_id==2 && $comm_type==7){
			    echo "0%";
			}else{ 
			    echo $a_comm[$i]["comm_value"]."%";
			    
			} 
			?></b></td>
			<?php
		}
		?>
	</tr>
	
	<?php
	$group_name = "";
	for($i=0;$i<sizeof($a_item);$i++){
		if($group_name!=$a_item[$i]["group_name"]){
			$group_name = $a_item[$i]["group_name"];
			echo '<tr id="group_'.$i.'"><td colspan="'.$n_col_span.'" style="text-align:left; background-color:#848484; color:#FFF;" class="row_group_name">'.$group_name.'</td></tr>';
		}

		$item_id = $a_item[$i]["main_id"];
	?>
	<tr>
		<td style="width: 180px; text-align: left;" id="row_item_name<?php echo $item_id; ?>">
			<?php 
			echo '<span id="sp_item_name'.$item_id.'">'.$a_item[$i]["item_name"].'</span>'; 

			$user_group = Yii::app()->user->getState('userGroup');
			if( (!isset($admin_edit) || $admin_edit=="no") && $user_group!="4" ){
				?>
				<div style="text-align: center;"><button class="btn btn-primary" style="padding:2px 6px; border-radius: 15px;" data-toggle="modal" data-target="#manageAdditionalModal" onclick="return manageAddiV2(<?php echo $item_id; ?>);"><i class="fa fa-plus-square"></i></button></div>
				<?php
			}
			?>
			
		</td>
		<td style="text-align: left; white-space: pre-line;" id="td_item_desc<?php echo $item_id; ?>"><?php echo $a_item[$i]["item_style"]." ".$a_item[$i]["item_detail"]." ".$a_item[$i]["item_fabric_opt"]; ?>
		</td>
		<td style="text-align: left; white-space: pre-line;"><textarea disabled><?php echo $a_item[$i]["description"]?></textarea></td>

		<?php
		for($j=0;$j<$comm_loop;$j++){

			$comm_per_id = $a_comm[$j]["comm_per_id"];

			?>
			<td style="width:60px;" class="<?php echo $a_use_bg[$j]; ?>">

			<?php 
				if( isset($a_pguide[$item_id][$comm_per_id]["price"]) ){ 
				?>
					<div <?php
                            if(Yii::app()->user->getState('quotePermission')==1){ ?> class="add-to-cart" onclick="return addToCartV2(<?php echo $a_pguide[$item_id][$comm_per_id]["prg_id"]; ?>);" <?php } ?> >
						<?php echo $a_pguide[$item_id][$comm_per_id]["price"]; ?>	
					</div>	
				<?php 
				}else{ 
					echo "-"; 
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
</table>
</div>
<script type="text/javascript">
$( document ).ready(function() {
    
    var card_width = $('#price_guide_content').width();
    $('#lower_table').css("max-width",card_width+"px");
    
});
</script>