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
		<th class="bg-blue-light" style="text-align: right;">Flat Rate Price (<?php echo $row_curr["curr_name"]; ?>)</th>
		<th class="bg-blue-light" style="text-align: right;">Price (QTY 15-99) (<?php echo $row_curr["curr_name"]; ?>)</th>
		<th class="bg-blue-light" style="text-align: right;">Price (QTY 100-299) (<?php echo $row_curr["curr_name"]; ?>)</th>
		<th class="bg-blue-light" style="text-align: right;">Price (QTY 300+) (<?php echo $row_curr["curr_name"]; ?>)</th>
		<?php
		if($admin_edit=="yes"){
			?>
			<th class="bg-blue-light" style="text-align: center;">Sorting</th>
			<th class="bg-blue-light" style="text-align: center;">Action</th>
			<?php
		}
		?>
	</tr>
	</thead>
	<tbody class="<?php
	   if($admin_edit=="yes"){
	       echo "connectedSortable";
	   }
	?>">
	<?php
	$id_product_first_item = $a_extra[0]["extra_id"];
	$id_product_last_item = $a_extra[(sizeof($a_extra)-1)]["extra_id"];
	$i=0;
	$sort_ids = array();
	foreach($a_extra as $tmp_key => $row_extra){
	    $sort_ids[] = $row_extra["sort_no"];
	?>
	<tr>
		<td extra_id="<?php echo $row_extra["extra_id"]; ?>" sort_no="<?php echo $row_extra["sort_no"]; ?>"><?php echo $row_extra["extra_name"]; ?></td>
		<td><?php echo $row_extra["extra_desc"]; ?>
		<?php
		if($admin_edit=="yes"){
		if (strpos($row_extra["extra_desc"], 'Shipping') === false) {
		    if($row_extra['ctc']==null || $row_extra['ctc']==""){
		        $warner = "btn btn-warning";
		    }
		    else{
		        $warner = "btn btn-success";
		    }
		    ?>
        <br><button class="<?=$warner?> extra_cost_modal" extra_name="<?=base64_encode($row_extra["extra_name"])?>" ctc="<?=$row_extra['ctc']?>" extra_id="<?php echo $row_extra["extra_id"]; ?>">Cost</button>
        <?php
        }
		}
		?>
		    
		</td>
		<td style="text-align: center;">
			<?php
			if($admin_edit=="yes"){
			    if($row_extra["extra_value"]=="0.00"){
			        echo "-";
			    }else{
				echo $row_extra["extra_value"];
			    }
			}else{
			?>
			<div <?php if($row_extra["extra_value"]!="0.00"){?> class="add-to-cart" onclick="return addExtraToCartV2(<?php echo $row_extra["extra_id"]; ?>,0);" <?php } ?>>
				<?php if($row_extra["extra_value"]=="0.00"){
			        echo "-";
			    }else{
				echo $row_extra["extra_value"];
			    } ?>
			</div>
			<?php
			}
			?>
		</td>
		<td style="text-align: center;">
			<?php
			if($admin_edit=="yes"){
				if($row_extra["extra_value_1"]=="0.00"){
			        echo "-";
			    }else{
				echo $row_extra["extra_value_1"];
			    }
			}else{
			?>
			<div <?php if($row_extra["extra_value_1"]!="0.00"){?> class="add-to-cart" onclick="return addExtraToCartV2(<?php echo $row_extra["extra_id"]; ?>,1);" <?php } ?>>
				<?php if($row_extra["extra_value_1"]=="0.00"){
			        echo "-";
			    }else{
				echo $row_extra["extra_value_1"];
			    } ?>
			</div>
			<?php
			}
			?>
		</td>
		<td style="text-align: center;">
			<?php
			if($admin_edit=="yes"){
				if($row_extra["extra_value_2"]=="0.00"){
			        echo "-";
			    }else{
				echo $row_extra["extra_value_2"];
			    }
			}else{
			?>
			<div <?php if($row_extra["extra_value_2"]!="0.00"){?> class="add-to-cart" onclick="return addExtraToCartV2(<?php echo $row_extra["extra_id"]; ?>,2);" <?php } ?>>
				<?php if($row_extra["extra_value_2"]=="0.00"){
			        echo "-";
			    }else{
				echo $row_extra["extra_value_2"];
			    } ?>
			</div>
			<?php
			}
			?>
		</td>
		<td style="text-align: center;">
			<?php
			if($admin_edit=="yes"){
				if($row_extra["extra_value_3"]=="0.00"){
			        echo "-";
			    }else{
				echo $row_extra["extra_value_3"];
			    }
			}else{
			?>
			<div <?php if($row_extra["extra_value_3"]!="0.00"){?> class="add-to-cart" onclick="return addExtraToCartV2(<?php echo $row_extra["extra_id"]; ?>,3);" <?php } ?>>
				<?php if($row_extra["extra_value_3"]=="0.00"){
			        echo "-";
			    }else{
				echo $row_extra["extra_value_3"];
			    } ?>
			</div>
			<?php
			}
			?>
		</td>
		<?php
		if($admin_edit=="yes"){
			?>
			<td style="padding: 2px; text-align: center;">
				<div id="extra_prod_sorting<?php echo $row_extra["extra_id"]; ?>" class="sorting_zone">
				<?php 
				if($row_extra["extra_id"]!=$id_product_last_item){ 
					$prod_next_id_item = $a_extra[($i+1)]["extra_id"];
				?>
				<i class="fa fa-arrow-circle-down" onclick="return adminSwapProductItem(<?php echo $row_extra["extra_id"]; ?>,<?php echo $prod_next_id_item; ?>);"></i>
				<?php 
				}

				if($row_extra["extra_id"]!=$id_product_first_item){ 
					$prod_previous_id_item = $a_extra[($i-1)]["extra_id"];
				?>
				<i class="fa fa-arrow-circle-up" onclick="return adminSwapProductItem(<?php echo $row_extra["extra_id"]; ?>,<?php echo $prod_previous_id_item; ?>);"></i>
				<?php 
				}
				?>
				</div>
			</td>
			<td style="text-align: center;">
				<button type="button" class="btn btn-warning" title="Edit extra item info" onclick="return editExtraItem(<?php echo $row_extra["extra_id"]; ?>);" data-toggle="modal" data-target="#adminEditExtraItemModal">
					<i class="fa fa-pencil"></i>
				</button>
				<button type="button" class="btn btn-danger" title="Delete extra item" onclick="return deleteExtraItem(<?php echo $row_extra["extra_id"]; ?>);">
					<i class="fa fa-trash"></i>
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

$(document).ready(function () {
    $("tbody.connectedSortable")
        .sortable({
        connectWith: ".connectedSortable",
        // items: "> tr:not(:first)",
        appendTo: "parent",
        helper: "clone",
        cursor: "move",
        zIndex: 999990,
        update:function(event,ui){
            var $tables = $('table.tbl_content_qty'); 
            var table_order = 1;
            $.each($tables, function (index, table) {
                var post_order_ids = new Array();
                var prod_ids = new Array();
                var sort_list = new Array();
                //var production_list = new Array();
                var $rows = $('tbody tr', $(table)); //Get ALL Rows
                $rows.each(function(){
                    post_order_ids.push($(this).find("td").attr('sort_no'));
                    prod_ids.push($(this).find("td").attr('extra_id'));
                })
                var sort_list = post_order_ids.filter(function( element ) {
                   return element !== undefined;
                });
                var production_list = prod_ids.filter(function( element ) {
                  return element !== undefined;
                });
                //var sort_no_list =  sort_list.join(",");
                var production_id_list = production_list.join(",");
                var sort_no_list = $('#sort_ids').val();
                if(prod_ids.length>0){
                $.ajax({
                    type:'POST',
                    data:{
                        sort_no_list:sort_no_list,
                        production_id_list:production_id_list
                    },
                    url:'<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/adminSwapProductItemSortable',
                    success:function(response){
                        var response = JSON.parse(response);
                        if(response.result=="success"){
                            showExtraV2();
                        }
                    }
                })
                sort_no_list = "";
                production_id_list = "";
                }
                table_order++;
            });
        }
    });
});
</script>
<input type="hidden" id="num_extra_item" value="<?php echo sizeof($a_extra); ?>">
<input type="hidden" id="sort_ids" value="<?php echo implode(',',$sort_ids) ?>">