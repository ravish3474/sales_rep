<table class="cls_tbl_comm_info">
	<tr>
		<th >
			Title
			<i style="font-size: 20px; color: #5D3; cursor: pointer;" class="fa fa-plus" data-toggle="modal" data-target="#adminAddCommissionModal" ></i>
		</th>
		<?php 
		for($i=0;$i<sizeof($a_comm_info);$i++){
			$qty_name = $a_comm_info[$i]["qty_name"];
		?>
		<td style="text-align: center; <?php if($a_comm_info[$i]["enable"]=="0"){ echo ' background-color: #DDD; '; } ?>"><?php echo $qty_name; ?></td>
		<?php
		}
		?>
	</tr>
	<tr>
		<th >
			Comm.%
		</th>
		<?php 
		for($i=0;$i<sizeof($a_comm_info);$i++){
			$comm_value = $a_comm_info[$i]["comm_value"];
		?>
		<td style="text-align: center; <?php if($a_comm_info[$i]["enable"]=="0"){ echo ' background-color: #DDD; '; } ?>"><?php echo $comm_value; ?></td>
		<?php
		}
		?>
	</tr>
	<tr>
		<th >
			Sort
		</th>
		<?php 
		$num_loop = sizeof($a_comm_info);
		for($i=0;$i<$num_loop;$i++){

			$comm_per_id = $a_comm_info[$i]["comm_per_id"];
			$sort = $a_comm_info[$i]["sort"];
		?>
		<td style="text-align: center; <?php if($a_comm_info[$i]["enable"]=="0"){ echo ' background-color: #DDD; '; } ?>">
			<div id="comm_sorting<?php echo $comm_per_id; ?>" class="sorting_zone">
			<?php 
			if($i>0){ 
			//	$sat_next_id = $a_sat[($i+1)]["sat_id"];
			?>
			<i class="fa fa-arrow-circle-left" onclick="return adminSwapCommission(<?php echo $comm_per_id; ?>,'left');"></i>
			
			<?php 
			}
			if( ($i!=0) && (($i+1)!=$num_loop) ){
				echo '&nbsp;&nbsp;<br>&nbsp;&nbsp;';
			}

			if( ($i+1) < $num_loop ){ 
			//	$sat_previous_id = $a_sat[($i-1)]["sat_id"];
			?>
			<i class="fa fa-arrow-circle-right" onclick="return adminSwapCommission(<?php echo $comm_per_id; ?>,'right');"></i>
			<?php 
			}
			?>
			</div>
		</td>

		<?php
		}
		?>
	</tr>
	<tr>
		<th >
			Edit
		</th>
		<?php 
		for($i=0;$i<sizeof($a_comm_info);$i++){
			$comm_per_id = $a_comm_info[$i]["comm_per_id"];

		?>
		<td style="text-align: center; <?php if($a_comm_info[$i]["enable"]=="0"){ echo ' background-color: #DDD; '; } ?>">
			<i style="font-size: 20px; color: #D53; cursor: pointer;" class="fa fa-pencil" data-toggle="modal" data-target="#adminEditCommissionModal" onclick="return adminEditCommission(<?php echo $comm_per_id; ?>);"></i>
		</td>
		<?php
		}
		?>
	</tr>
</table>