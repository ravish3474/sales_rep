<style>
.sorting_zone i {
    cursor: pointer;
    font-size: 20px;
    text-align: center;
    margin-left: 3px;
    margin-right: 3px;
    color: #00F;
}
</style>
<table class="tbl_notes cls_tbl_extra tbl_content_qty" style="width: 100%;">
    <thead>
	<tr>
		<th class="bg-blue-light">Extra items</th>
		<th class="bg-blue-light">Description</th>
		<th class="bg-blue-light">Edited Description</th>
		<th class="bg-blue-light" style="text-align: right;">Flat Rate Price (<?php echo $row_curr["curr_name"]; ?>)</th>
		<th class="bg-blue-light" style="text-align: right;">Price (QTY 15-99) (<?php echo $row_curr["curr_name"]; ?>)</th>
		<th class="bg-blue-light" style="text-align: right;">Price (QTY 100-299) (<?php echo $row_curr["curr_name"]; ?>)</th>
		<th class="bg-blue-light" style="text-align: right;">Price (QTY 300+) (<?php echo $row_curr["curr_name"]; ?>)</th>
		<?php
		if($admin_edit=="yes"){
			?>
			<th class="bg-blue-light" style="text-align: center;">Action</th>
			<?php
		}
		?>
	</tr>
	</thead>
	<tbody class="">
	<?php
	$id_product_first_item = $a_extra[0]["main_id"];
	$id_product_last_item = $a_extra[(sizeof($a_extra)-1)]["main_id"];
	$i=0;
	$sort_ids = array();
	foreach($a_extra as $tmp_key => $row_extra){
	    $sort_ids[] = $row_extra["sort_no"];
	?>
	<tr>
		<td extra_id="<?php echo $row_extra["main_id"]; ?>" sort_no="<?php echo $row_extra["sort_no"]; ?>"><?php echo $row_extra["extra_name"]; ?></td>
		<td><?php echo $row_extra["extra_desc"]; ?></td>
		<td><?php echo $row_extra["description"]; ?></td>
		<td style="text-align: center;">
			<div <?php if($row_extra["extra_value"]!="0.00"){?> class="add-to-cart" onclick="return addExtraToCartV2(<?php echo $row_extra["main_id"]; ?>,0);" <?php } ?>>
				<?php if($row_extra["extra_value"]=="0.00"){
			        echo "-";
			    }else{
				echo $row_extra["extra_value"];
			    } ?>
			</div>
		</td>
		<td style="text-align: center;">
			<div <?php if($row_extra["extra_value_1"]!="0.00"){?> class="add-to-cart" onclick="return addExtraToCartV2(<?php echo $row_extra["main_id"]; ?>,1);" <?php } ?>>
				<?php if($row_extra["extra_value_1"]=="0.00"){
			        echo "-";
			    }else{
				echo $row_extra["extra_value_1"];
			    } ?>
			</div>
		</td>
		<td style="text-align: center;">
			<div <?php if($row_extra["extra_value_2"]!="0.00"){?> class="add-to-cart" onclick="return addExtraToCartV2(<?php echo $row_extra["main_id"]; ?>,2);" <?php } ?>>
				<?php if($row_extra["extra_value_2"]=="0.00"){
			        echo "-";
			    }else{
				echo $row_extra["extra_value_2"];
			    } ?>
			</div>
		</td>
		<td style="text-align: center;">
			<div <?php if($row_extra["extra_value_3"]!="0.00"){?> class="add-to-cart" onclick="return addExtraToCartV2(<?php echo $row_extra["main_id"]; ?>,3);" <?php } ?>>
				<?php if($row_extra["extra_value_3"]=="0.00"){
			        echo "-";
			    }else{
				echo $row_extra["extra_value_3"];
			    } ?>
			</div>
		</td>
		<?php
		if($admin_edit=="yes"){
			?>
			<td style="text-align: center;">
				<button type="button" class="btn btn-warning" title="Edit extra item info" onclick="return editExtraItem(<?php echo $row_extra["main_id"]; ?>);" data-toggle="modal" data-target="#adminEditExtraItemModal">
					<i class="fa fa-pencil"></i>
				</button>
			</td>
			<?php
		}
		?>
	</tr>
	<?php
	$i++;
	}
	?>
	</tbody>
</table>
<script>
function adminSwapProductItem(own_id,swap_id){
	
	$.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/adminSwapProductItem" ,
        data: {
        	"own_id":own_id,
        	"swap_id":swap_id
        },
        success: function(resp){ 

            if(resp.result=="success"){

                showExtraV2();
                
            }
        }
    });

}

function adminSwapProductItemSortable(own_id,swap_id){
	
	$.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/adminSwapProductItemSortable" ,
        data: {
        	"own_id":own_id,
        	"swap_id":swap_id
        },
        success: function(resp){ 

            if(resp.result=="success"){

                showExtraV2();
                
            }
        }
    });

}
</script>
<input type="hidden" id="num_extra_item" value="<?php echo sizeof($a_extra); ?>">
<input type="hidden" id="sort_ids" value="<?php echo implode(',',$sort_ids) ?>">