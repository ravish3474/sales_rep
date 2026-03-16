<style type="text/css">
.calc{
    width:50%;
}
.multiselect-container{
    overflow:scroll;
    height:200px;
}
.multiselect-container>li>a>label {
  padding: 4px 20px 3px 20px;
}

.first_type{
	border-bottom-left-radius: 5px;
	border-top-left-radius: 5px;
}
.last_type{
	border-bottom-right-radius: 5px;
	border-top-right-radius: 5px;
}
.sale_type_tab{
	cursor: pointer;
	background-color: #337ab7;
	border: 1px solid #0469A8;
	color: #FFF;
	padding: 5px 10px;
	margin: 5px 0px; 
	font-size: 16px;
}
.sale_type_tab:hover{
	background-color: #115895;
	border: 1px solid #005796;
	color: #FFF;
}
.sale_type_tab_active{
	background-color: #286090;
	border: 1px solid #204d74;
	color: #FFF;
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
.tbl_show_pguide tr:hover td{
	background-color: #FFA !important;
}
.tbl_show_pguide tr:hover td.row_group_name{
	color: #000 !important;
}
.col_backg1{
	background-color: #E7F1F5 !important;
	color: #000 !important;
}
.col_backg2{
	background-color: #CCD3D7 !important;
	color: #000 !important;
}
.col_backg3{
	background-color: #D0D0D0 !important;
	color: #000 !important;
}
.add-to-cart{
	cursor: pointer;
}
.add-to-cart:hover{
	text-decoration: underline;
	color: #00F;
}
.add_price{
    cursor: pointer;
    font-size: 18px;
    color: #484;
}
.add_price:hover{
    color: #6A6;
}
.tbl_notes th{
	border:1px solid #AAA;
	padding: 5px;
}
.tbl_notes td{
	border:1px solid #AAA;
	padding: 5px;
}
.cls_tbl_extra tr:hover td{
	background-color: #FFA;
}

.xls_btn{
    background-color: #5cb85c;
    padding: 5px 10px;
    border-radius: 4px;
    border: 1px solid #298529;
    float: right;
    margin-bottom: 10px;
    color: #fff;
    margin-left: 10px; 
}
.xls_btn:hover{
    color: #777;
    background-color: #6DC96D;
    text-decoration: unset;
}

</style>
<?php

$prod_id = $row_product[0]['prod_id'];
$prod_name = $row_product[0]['prod_name'];

?>
<!-- <div id="debug_panel"></div> -->
<div class="row">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2><?php echo $row_product[0]['prod_detail']; ?></h2>
				<button type="button" class="xls_btn" onclick="return downloadToAll('xls');"> XLS (All Products) </button>
                <button type="button" class="paf_dowload" onclick="return downloadToAll('pdf');"> PDF (All Products) </button>
                <button type="button" class="xls_btn" onclick="return downloadTo('xls');"> XLS </button>
                <button type="button" class="paf_dowload" onclick="return downloadTo('pdf');"> PDF </button>
                <form id="download_form" action="" target="_blank" method="post">
                    <input type="hidden" name="dl_prod_id" value="<?php echo $prod_id; ?>">
                    <input type="hidden" name="dl_sale_type" id="dl_sale_type" value="">
                    <input type="hidden" name="dl_curr_id" id="dl_curr_id" value="">
                    <input type="hidden" name="dl_type" id="dl_type" value="">
                </form>
				<div class="clearfix"></div>
			</div>
			
			<div>
				<?php
                $user_group = Yii::app()->user->getState('userGroup');
                if($user_group=="5"){
                    ?>
                    <span id="sp_sale_type6" class="sale_type_tab first_type sale_type_tab_active last_type" onclick="return selectSaleType(6);">Factory Direct</span>
                    <input type="hidden" id="select_sale_type_id" value="6">
                    <?php
                }
                elseif($user_group!="4"){

    				$n_loop = sizeof($row_sale_type);
                    $default_sat_id = "";

                    if($sat_id_list!=""){

                        $a_sale_type_selected = explode(",", $sat_id_list);
                        $count_tab = 0;

        				for($i=0; $i<$n_loop; $i++){

                            for($j=0; $j<sizeof($a_sale_type_selected); $j++){

                                if($a_sale_type_selected[$j]==$row_sale_type[$i]["sat_id"]){
                					$extra_class = "";
                					if($count_tab==0){ $extra_class .= "first_type sale_type_tab_active "; $default_sat_id=$row_sale_type[$i]["sat_id"]; }
                					if(($j+1)==sizeof($a_sale_type_selected)){ $extra_class .= "last_type"; }
                					
                					?><span id="sp_sale_type<?php echo $row_sale_type[$i]["sat_id"]; ?>" class="sale_type_tab <?php echo $extra_class; ?>" onclick="return selectSaleType(<?php echo $row_sale_type[$i]["sat_id"]; ?>);"><?php echo $row_sale_type[$i]["sat_name"]; ?> </span>
                                    <?php
                                    $count_tab++;
                                }
                            }
        				}
    				?>
    				    <input type="hidden" id="select_sale_type_id" value="<?php echo $default_sat_id; ?>">
                    <?php
                    }else{
                        echo '<h3 style="color:#F00; text-align:center;">Not Found Sale Type</h3></div></div></div></div>';
                        return;
                    }
                }else{
                    ?>
                    <span id="sp_sale_type3" class="sale_type_tab first_type sale_type_tab_active last_type" onclick="return selectSaleType(3);">Dealers</span>
                    <input type="hidden" id="select_sale_type_id" value="3">
                    <?php
                }
                ?>
				&nbsp;Currency: 
				 <?php
	            if(Yii::app()->user->getState('userGroup')=="5" || Yii::app()->user->getState('userGroup')=="4"){ ?>
	            <select id="select_curr_id" onchange="showPriceGuide(); showExtraV2(); showNoteV2();">
					<?php
					for($i=0;$i<2;$i++){
						echo '<option value="'.$row_currency[$i]["curr_id"].'">'.$row_currency[$i]["curr_name"].' '.$row_currency[$i]["curr_desc"].'</option>';
					}
					?>
				</select>
				<?php }else{ ?>
	            
				<select id="select_curr_id" onchange="showPriceGuide(); showExtraV2(); showNoteV2();">
					<?php
					for($i=0;$i<sizeof($row_currency);$i++){
						echo '<option value="'.$row_currency[$i]["curr_id"].'">'.$row_currency[$i]["curr_name"].' '.$row_currency[$i]["curr_desc"].'</option>';
					}
					?>
				</select>
                <?php
	            }
                if(isset($admin_edit) && $admin_edit=="yes"){
                    ?>
                    <span style="padding-left: 50px; color: #F00; font-weight: bold; font-size: 18px;">&lt;Click on number to edit and <i class="fa fa-plus-circle" style="color:#484;"></i> to add price&gt;</span>
                    <?php
                }
                ?>
			</div>
			<div class="clearfix"></div>
			
			<div class="x_content">
                <?php
                if($admin_edit=="yes"){
                ?>
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#adminManageItemPanelModal" onclick="return openManagePanel();">
                        <i class="fa fa-file-text-o"></i> Manage Item
                    </button>
                <?php
                }
                ?>
				<div id="price_guide_content">
					
				</div>

			</div>

			<div class="x_content">
                <?php
                if($admin_edit=="yes"){
                ?>
                    <button type="button" class="btn btn-success" title="New extra item" onclick="return newExtraItem();" data-toggle="modal" data-target="#adminNewExtraItemModal">
                        <i class="fa fa-plus"></i> New extra item
                    </button>

                    <button id="btn_copy_extra" type="button" class="btn btn-info" title="Copy all extra items" onclick="return copyExtraItem();" >
                        <i class="fa fa-copy"></i> Copy extra items to
                    </button>
                    
                    <button id="btn_copy_extra" type="button" class="btn btn-info" title="Copy & Replace extra items" onclick="return copyReplaceExtraItem();" >
                        <i class="fa fa-copy"></i> Copy & Replace Extra items to
                    </button>
                <?php
                }
                ?>
				<div id="extra_price_content">
					
				</div>
			</div>

			<div class="x_content">
                <?php
                if($admin_edit=="yes"){
                ?>
                    <button type="button" id="btn_edit_notes" class="btn btn-warning" title="Edit Notes" onclick="return editNotes();" >
                        <i class="fa fa-pencil"></i> Edit Notes
                    </button>
                    <button type="button" id="btn_save_notes" class="btn btn-primary" title="Save Notes" onclick="return saveEditNotes(<?php echo $prod_id; ?>);" style="display:none;">
                        <i class="fa fa-floppy-o"></i> Save Notes
                    </button>
                    <button type="button" id="btn_cancel_edit_notes" class="btn btn-secondary" title="Cancel edit Notes" onclick="return cancelEditNotes();" style="display:none;">
                        Cancel
                    </button>
                <?php
                }
                ?>
				<table class="tbl_notes" style="width: 100%;">
					<tr><th class="bg-blue-light">Notes</th></tr>
					<tr id="tr_show_notes">
						<td id="td_show_notes"></td>
					</tr>
                    <tr id="tr_edit_notes" style="display: none;">
                        <td>
                            <textarea id="txtarea_edit_notes" style="width: 100%; height: 300px;"></textarea>
                            <input type="hidden" id="old_notes" value="<?php echo isset($row_notes["notes"])?$row_notes["notes"]:""; ?>">
                        </td>
                    </tr>
				</table>
			</div>

		</div>
	</div>

</div>

<style type="text/css">
    #tbl_manage_addi td{
         padding: 5px;
         vertical-align: top;
    }
</style>
<!-- Manage Additional -->
<div class="modal fade" id="manageAdditionalModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title">Manage Additional Items</h4>
            </div>
            <div class="modal-body" style="max-height: 500px;" >
                <table id="tbl_manage_addi" style="width: 100%;">
                    <tr>
                        <td>Item:</td>
                        <td id="addi_show_item_name"></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td id="addi_show_item_desc"></td>
                    </tr>
                    <tr>
                        <td>Currency:</td>
                        <td id="addi_show_curr_name"></td>
                    </tr>
                </table>
                <hr>
                
                <form id="addi_sort_form">
                    
                </form>
            </div>
            <div class="modal-footer">
                <form id="addi_new_form" style="text-align: center;">
                    New item: 
                    <input type="hidden" name="new_addi_item_id" id="new_addi_item_id">
                    <input type="hidden" name="new_addi_curr_id" id="new_addi_curr_id">
                    <input type="text" name="new_addi_name" id="new_addi_name" maxlength="150" style="width: 210px;">
                     Value: <input type="number" name="new_addi_value" id="new_addi_value" min="0" step="0.1" style="width: 70px;">
                    <button type="button" class="btn btn-success" onclick="return submitNewAddiV2();" style="padding: 2px 15px; margin-left: 10px; margin-top: 3px;"> Add </button>
                </form>
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewColor" tabindex="-1" role="dialog">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title" id="colour_header_user"></h4>
            </div>
            <div class="modal-body" >
                <div class="container table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Description</th>
                        <th>Color Name</th>
                        <th>Color Code</th>
                      </tr>
                    </thead>
                    <tbody id="customFieldsUser">
                        
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
        </div>
    </div>
</div>


<script type="text/javascript">
showPriceGuide();
showExtraV2();
showNoteV2();

function manageAddiV2(item_id){


    var item_name = $('#sp_item_name'+item_id).html();
    var item_desc = $('#td_item_desc'+item_id).html();

    var curr_name = $('#select_curr_id option:selected').text();

    $('#addi_show_item_name').html(item_name);
    $('#addi_show_item_desc').html(item_desc);
    $('#addi_show_curr_name').html(curr_name);

    $('#new_addi_item_id').val(item_id);
    $('#new_addi_curr_id').val($('#select_curr_id').val());

    showAddiSortForm(item_id);

}

function showAddiSortForm(item_id){

    $.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showAddiSortForm" ,
        data:{
            "item_id":item_id
        },
        success: function(resp){ 
            
            $('#addi_sort_form').html(resp);
            
            $('#inner_addi_sorting').sortable(); 
            $('#inner_addi_sorting').disableSelection();

        }  
    });
}

function saveSortAddi(){

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/saveSortAddi" ,
        data: $('#addi_sort_form').serialize(),
        success: function(resp){ 
            
            if(resp.result=="success"){
                showAddiSortForm($('#new_addi_item_id').val());
            }else{
                alert(resp.msg);
            }
            
        }  
    });

}

$(document).on('change','#sel1',function(){
    var value = $(this).val();
    var x = document.getElementById(value);
    x.scrollIntoView({ behavior: 'smooth', block: 'center' });
})

function submitNewAddiV2(){
    
    if($('#new_addi_name').val()==""){
        alert("Please fill item name.");
        return false;
    }

    if($('#new_addi_value').val()==""){
        alert("Please fill value.");
        return false;
    }

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/submitNewAddiV2" ,
        data: $('#addi_new_form').serialize(),
        success: function(resp){ 
            
            if(resp.result=="success"){
                showAddiSortForm($('#new_addi_item_id').val());
                $('#new_addi_name').val('');
                $('#new_addi_value').val('');
            }else{
                alert(resp.msg);
            }
            
        }  
    });

}

function deleteAddiItemV2(addi_id){

    if(confirm("Deleting confirm?")){
        $.ajax({  
            type: "POST",  
            dataType: "json", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/deleteAddiV2" ,
            data: {
                "addi_id":addi_id
            },
            success: function(resp){ 
                
                if(resp.result=="success"){
                    $('#tr_addi_row'+addi_id).remove();
                }else{
                    alert(resp.msg);
                }
                
            }  
        });
    }

}

function downloadTo(dl_type){

    $('#dl_type').val(dl_type);
    $('#dl_sale_type').val($('#select_sale_type_id').val());
    $('#dl_curr_id').val($('#select_curr_id').val());

    $('#download_form').attr("action","<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/exportTo");
    $('#download_form').submit();

}

function downloadToAll(dl_type){

    $('#dl_type').val(dl_type);
    $('#dl_sale_type').val($('#select_sale_type_id').val());
    $('#dl_curr_id').val($('#select_curr_id').val());

    $('#download_form').attr("action","<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/exportToAll");
    $('#download_form').submit();

}

function selectSaleType(sat_id){
	$('#select_sale_type_id').val(sat_id);

	$('.sale_type_tab').removeClass("sale_type_tab_active");
	$('#sp_sale_type'+sat_id).addClass("sale_type_tab_active");

	showPriceGuide();
}

function adminEditUpdateImage(item_id,image=""){
    $('#img_item_id').val(item_id);
    if(image!=""){
        var img = "/upload/pattern/"+atob(image);
        $('#fabric_img_modal').attr('src',img);
        $('#fabric_img_modal').show();
    }else{
        $('#fabric_img_modal').attr('src',"");
        $('#fabric_img_modal').hide();
    }
}

function viewColour(item_id,item_name){
    $('#colour_header_user').html(atob(item_name)+" "+"Available Colors");
    $.ajax({
        type:'POST',
        data:{
            item_id:item_id
        },
        url:'<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/fetchColorsUser',
        success:function(response){
            var response = JSON.parse(response);
            if(response.status==1){
                $('#customFieldsUser').empty();
                $('#customFieldsUser').append(atob(response.data));
            }
            else{
                $('#customFieldsUser').empty();
            }
        }
    })
}

function adminEditUpdateColour(item_id,item_name){
    $('#colour_header').html(atob(item_name)+" "+"Available Colors");
    $('#col_item_id').val(item_id);
    $.ajax({
        type:'POST',
        data:{
            item_id:item_id
        },
        url:'<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/fetchColorsAdmin',
        success:function(response){
            var response = JSON.parse(response);
            if(response.status==1){
                $('#customFields').empty();
                $('#customFields').append(atob(response.data));
            }
            else{
                $('#customFields').empty();
            }
        }
    })
}

function showPriceGuide(){

	var sat_id = $('#select_sale_type_id').val();
	var curr_id = $('#select_curr_id').val();
	var prod_id = <?php echo $prod_id; ?>;

	$('#price_guide_content').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

	$.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showInner/product/"+prod_id+"/type/"+sat_id+"/curr/"+curr_id<?php if(isset($admin_edit) && $admin_edit=="yes"){ echo '+"?ade=yes"'; } ?> ,
        success: function(resp){ 
            
        	$('#price_guide_content').html(resp);

        }  
    });

}

function showExtraV2(){

	var curr_id = $('#select_curr_id').val();

	$('#extra_price_content').show();
	$('#extra_price_content').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

	$.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showExtra/prod/<?php echo $row_product[0]["prod_id"]; ?>/curr/"+curr_id<?php if(isset($admin_edit) && $admin_edit=="yes"){ echo '+"?ade=yes"'; } ?> ,
        success: function(resp){ 
            if(resp=="empty"){
            	$('#extra_price_content').hide();
            }else{
	        	$('#extra_price_content').html(resp);
	        }

        }  
    });

}

function showNoteV2(){

    var curr_id = $('#select_curr_id').val();

    $('#td_show_notes').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

    $.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showNote/prod/<?php echo $row_product[0]["prod_id"]; ?>/curr/"+curr_id<?php if(isset($admin_edit) && $admin_edit=="yes"){ echo '+"?ade=yes"'; } ?> ,
        success: function(resp){ 
            if(resp=="empty"){
                $('#td_show_notes').html('<center>Empty!!</center>');
                $('#txtarea_edit_notes').val('');
                $('#old_notes').val('');
            }else{
                $('#td_show_notes').html(resp);
                resp = resp.replace(/<br \/>/g, "");

                $('#txtarea_edit_notes').val(resp);
                $('#old_notes').val(resp);
            }

        }  
    });

}

function addExtraToCartV2(extra_id,value_id){

	if($('#qdoc_id_editing').val()==null){

        //alert("extra_id="+extra_id+"\ncurrency="+currency);
        $.ajax({  
            type: "POST",  
            dataType: "html", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/addExtraToCart" ,
            data:{
                "extra_id":extra_id,
                "value_id":value_id
            },
            success: function(resp){ 
                if(resp=="success"){
                    var tmp_sum = parseInt($('#sp_sum_total').html())+1;

                    $('#sp_sum_total').html(tmp_sum);
                }else{
                    alert(resp);
                }  

            }  
        });

    }else{

        var qdoc_id = $('#qdoc_id_editing').val();

        $.ajax({  
            type: "POST",  
            dataType: "html", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/addExtraToQuotation" ,
            data:{
                "qdoc_id":qdoc_id,
                "extra_id":extra_id
            },
            success: function(resp){ 
                if(resp=="success"){
                    var tmp_sum = parseInt($('#sp_sum_total_edit').html())+1;

                    $('#sp_sum_total_edit').html(tmp_sum);
                }else{
                    alert(resp);
                }  

            }  
        });

    }
}

function addToCartV2(prg_id){

    if($('#qdoc_id_editing').val()==null){
        
        $.ajax({  
            type: "POST",  
            dataType: "html", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/addToCart" ,
            data:{
                "prg_id":prg_id
            },
            success: function(resp){ 
                if(resp=="success"){
                    var tmp_sum = parseInt($('#sp_sum_total').html())+1;

                    $('#sp_sum_total').html(tmp_sum);
                }else{
                    alert(resp);
                }  

            }  
        });

    }else{


        var qdoc_id = $('#qdoc_id_editing').val();
        //alert("AAA="+qdoc_id);

        $.ajax({  
            type: "POST",  
            dataType: "html", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/addToQuotation" ,
            data:{
                "qdoc_id":qdoc_id,
                "prg_id":prg_id
            },
            success: function(resp){ 
                if(resp=="success"){
                    var tmp_sum = parseInt($('#sp_sum_total_edit').html())+1;

                    $('#sp_sum_total_edit').html(tmp_sum);
                }else{
                    alert(resp);
                }  

            }  
        });

    }
    
}

function showCartV2(is_front=0){

    $('#select_carts_id').val(0);

    $('#is_front').val(is_front);

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showCart" ,
        
        success: function(resp){ 
            
            $('#cart_title').html("Cart");
            $('#build_quote').html('Create New Estimate').attr("disabled",false);

            $('#btn_add_all_to_cart').hide();
            $('#btn_exit_edit_mode').hide();
            $('#btn_save_edit_quote').hide();

            $('#btn_save_cart').show();
            $('#d_select_carts_id').show();

            if(resp.found_data=="yes"){
                $('#add_item_row').show();
                $('#build_quote').show();
            }else{
                $('#add_item_row').hide();
                $('#build_quote').hide();
            }

            $('#clear_cart').show();
            $('#sp_currency').html(resp.currency);
            $('#cart_inner').html(resp.cart_inner);

        }  
    });

}

function selectAddiV2(row_id){
    
    var uprice = parseFloat($('#uprice_'+row_id).val());
    var a_select = $('#select_addi_'+row_id).val();

    var tmp_price = "";
    for(var i=0;i<a_select.length;i++){

        tmp_price = a_select[i].split("|");

        uprice += parseFloat(tmp_price[1]);
    }

    $('#show_uprice_'+row_id).html(uprice);

    calPriceV2(row_id);

}

function calPriceV2(row_id,is_other=0){

    var show_uprice = 0.00;
    if(is_other==1){
        show_uprice = $('#uprice_'+row_id).val();
    }else{
        show_uprice = $('#show_uprice_'+row_id).html();
    }
    
    var qty =  $('#qty_'+row_id).val();

    $('#amount_'+row_id).html(show_uprice*qty);

}

function deleteRowV2(row_id,is_other=0,extra_id=0){
    if(confirm("Confirm delete row?")){
        $('#tr_'+row_id).fadeOut(500).html('');
    }
}

function clearCartV2(){

    if(confirm("Do you want to clear the cart?")){
        $.ajax({  
            type: "POST",  
            dataType: "html", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/clearCart" ,
            
            success: function(resp){ 

                $('#cart_inner').html('');
                $('#sp_sum_total').html(0);
                $('#cartV2Modal').modal("toggle");

            }  
        });
    }

}



function saveCartDraftV2(){

    var draft_name = prompt("Please input draft name:");

    if(draft_name==null){
        return false;
    }

    if(draft_name==""){
        alert("Please input draft name.");
        return false;
    }

    var curr_inner = window.btoa($('#sp_currency').html());

    var num_item = $('#sp_sum_total').html();

    $('#curr_inner').val(curr_inner);
    $('#num_item').val(num_item);

    $('#draft_name').val(draft_name);
    $('#is_draft').val("yes");

    var curr_id = $('#curr_id').val();

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/saveCart" ,
        data: $('#formCart').serialize() ,
        success: function(resp){ 
            
            if(resp.result=="success"){

                $('<option value="'+resp.carts_id+'">'+resp.draft_name+'</option>').insertAfter('.default_option');

                $('#draft_name').val('');
                $('#is_draft').val("no");
                alert("Saved!!");

                setTimeout(function() { $('#select_carts_id').val(resp.carts_id); }, 1000);
            }

        }  
    });
}

function deleteSaveV2(){

    var carts_id = $('#select_carts_id').val();

    if(carts_id!="0"){

        if(confirm("Deleting draft. Confirm?")){

            $.ajax({  
                type: "POST",  
                dataType: "json", 
                url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/deleteCartSave" ,
                data: {
                    "carts_id":carts_id
                } ,
                success: function(resp){ 
                    
                    if(resp.result=="success"){

                        $("#select_carts_id option[value='"+carts_id+"']").remove();
                        showCartV2(1);
                        
                    }

                }  
            });
        }

    }

}

function loadCartV2(){

    if($('#select_carts_id').val()!="0"){

        $('#sp_show_loading').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>');

        var carts_id = $('#select_carts_id').val();

        $.ajax({  
            type: "POST",  
            dataType: "json", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/loadCart" ,
            data:{
                "carts_id":carts_id
            },
            success: function(resp){ 
                //$('#cart_inner').html(resp);
                if(resp.result=="success"){
                    //alert($('#select_carts_id').val());
                    $('#cart_title').html("Cart loaded");

                    $('#btn_add_all_to_cart').hide();
                    $('#btn_exit_edit_mode').hide();


                    $('#add_item_row').show();
                    $('#build_quote').show();
                    

                    $('#sp_show_loading').html('');
                    $('#sp_currency').html(resp.currency);
                    $('#cart_inner').html(window.atob(resp.form_inner));

                    var tmp_html_id = resp.tmp_html_id.split(",");
                    for(var i=0; i<tmp_html_id.length;i++){
                        if(tmp_html_id[i].indexOf("other")<0){
                            calPriceV2(tmp_html_id[i]);
                        }else{
                            calPriceV2(tmp_html_id[i],1);
                        }
                    }

                }

            }  
        });
    }
}
</script>
<?php
if(isset($admin_edit) && $admin_edit=="yes"){
?>
<style type="text/css">
.tbl_price_info th{
    text-align: right;
    padding: 5px;
}
.tbl_price_info td{
    text-align: left;
    padding: 5px;
}  
.tbl_item_sorting{
    width: 100%;
}
.tbl_item_sorting td{
    padding:5px;
    color: #000;
}
.d_item_sortable{
    border: 1px solid #558;
    background-color: #AAF;
    border-radius: 5px; 
    margin:2px; 
    cursor: grab;
}
.d_item_sortable:active{
    cursor: grabbing;
}

/*--CSS style for item management zone--*/
.manage_panel{ display:none; }
.footer_panel{ display:none; }
.footer_btn{ display:none; }

.header_panel button{
    margin:0px 6px 5px 6px;
}
.header_panel button,select{
    padding:3px 12px;
}
.header_panel label{
    font-size: 16px;
    font-weight: bold;
    color: #000;
}

.tbl_new_extra td{
    padding: 5px;
}
.tbl_new_extra td>input{
    width: 100%;
}
</style>
<script>
$(document).ready(function(){
	$(".addCF").click(function(){
		$("#customFields").append('<tr><td><textarea name="color_desc[]" style="width:100%;"></textarea></td><td><input type="text" name="color_name[]" style="width:75%;"> <span style="float: right;height: 20px;width: 20px;margin-bottom: 15px;clear: both;background-color:red;"></span></td><td><input type="text" name="color_code[]"></td><td><button class="btn btn-danger remCF">Delete</button></td></tr>');
	});
    $("#customFields").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });
});


$(document).on('click','.color_submit',function(){
    $('#color_form').submit();
})

$(document).ready(function(){
    $('#color_form').submit(function(e){
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(form[0]);
    $.ajax({
        type:'POST',
        data:formData,
        processData:false,
        contentType:false,
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/colorUpdate",
        success:function(response){
            var response = JSON.parse(response);
            if (response.status==1) {
                alert('Changes updated successfully!')
                $('#adminEditUpdateColour').modal('hide');
            }
            else{
                swal('Oops','Incorrect Dates ! Please check and try again','error');
            }
        }
    })
    
})
})

</script>



<div class="modal fade" id="adminEditUpdateColour" tabindex="-1" role="dialog">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title" id="colour_header"></h4>
            </div>
            <div class="modal-body" >
                <form id="color_form">
                    <input type="hidden" name="item_id" id="col_item_id">
                <div class="container table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Description</th>
                        <th>Color Name</th>
                        <th>Color Code</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="customFields">
                        
                    </tbody>
                  </table>
                  <div class="d-flex justify-content-between">
                  <span class="btn btn-success addCF">Add Row +</span>
                  </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary color_submit">Save changes</button>
              </div>
        </div>
    </div>
</div>

<div class="modal fade" id="adminEditUpdateImage" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title">Edit/Upload Image</h4>
            </div>
            <div class="modal-body" style="max-height: 500px;" >
                <form id="upload_fabric_img">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Upload Pattern/Fabric Image<span style="color:red;">(*Please upload image under 500kb Only)</span></label>
                    <input type="file" required name="fab_image" class="form-control" id="exampleInputEmail1" accept="image/png, image/gif, image/jpeg">
                    <input type="hidden" name="item_id" id="img_item_id">
                  </div>
                 <button type="submit" class="btn btn-primary">Submit</button>
                  <img src="" style="display:none;max-width:100%;max-height:100%;" id="fabric_img_modal">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Use for Edit & Add Price -->
<div class="modal fade" id="adminEditPriceModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title" id="edit_price_modal_title">Edit Price</h4>
            </div>
            <div class="modal-body" style="max-height: 500px;" >
                <form id="edit_price_form" onsubmit="">
                    <table class="tbl_price_info">
                        <tr>
                            <th style="width: 20%;">Sale Type:</th><td id="td_sale_type"></td>
                        </tr>
                        <tr>
                            <th>Currency:</th><td id="td_currency"></td>
                        </tr>
                        <tr>
                            <th>Product:</th><td id="td_item_name"></td>
                        </tr>
                        <tr>
                            <th>Title:</th><td id="td_col_title"></td>
                        </tr>
                        <tr>
                            <th>Commission:</th><td id="td_comm_value"></td>
                        </tr>
                        <tr>
                            <th>Price:</th>
                            <td>
                                <input type="number" id="prg_price" min="0" step=".01">
                                <input type="hidden" id="edit_prg_id">

                                <input type="hidden" id="add_cell_id">
                                <input type="hidden" id="add_item_id">
                                <input type="hidden" id="add_curr_id">
                                <input type="hidden" id="add_sat_id">
                                <input type="hidden" id="add_comm_per_id">
                            </td>
                        </tr>
                    </table>
                    
                </form>
            </div>
            <div class="modal-footer">

                <button style="float:right;" type="button" class="btn btn-success" id="btn_submit_edit_price" onclick="return adminSubmitEditPrice();">Submit</button>
                <button style="float:right;" type="button" class="btn btn-danger" id="btn_delete_price" onclick="return adminDeletePrice();">Delete this price</button>
            </div>
        </div>
    </div>
</div>

<!-- Use as Item Management panel -->
<div class="modal fade" id="adminManageItemPanelModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title" >Manage Items in: <b><?php echo $prod_name; ?></b></h4>
            </div>
            <div id="manage_item_modal_body" class="modal-body" style="max-height: 550px; overflow-y: scroll; min-height: 350px;" >

                <div class="header_panel container" id="header_panel">
                    <div class="row" style="height: 35px;">
                        <div class="col-md-7 text-center" style="vertical-align: baseline; line-height: 2; padding: 0px; margin-left: -8px;">
                            <label>Item: </label>
                            <button type="button" id="btn_new_item" class="btn_mitem btn btn-primary" onclick="return newProductItem();">New
                            </button>|<button type="button" id="btn_sorting_item" class="btn_mitem btn btn-info" onclick="return sortItemView();">Sorting
                            </button>or<button  id="btn_list_item" type="button" class="btn_mitem btn btn-dark" onclick="return showItemList(); ">List
                            </button>in<select id="select_item_group" style="height: 28px; padding: 6px 12px; " class="btn_mitem" onchange="return showItemList();">
                                <option value="==all==">== All ==</option>
                                
                                <?php
                                $have_group = "0";
                                if(sizeof($a_item_group)>0){
                                    $have_group = "1";
                                    ?>
                                    
                                    <?php
                                    for($i=0;$i<sizeof($a_item_group);$i++){
                                    ?>
                                        <option value="<?php echo $a_item_group[$i]["item_group_id"]; ?>"><?php echo $a_item_group[$i]["group_name"]; ?></option>
                                    <?php
                                    }
                                }
                                ?>
                                <option value="==no_group==" <?php if($have_group=="0"){ echo "selected"; } ?>>== No Group ==</option>
                            </select>

                            
                            <input type="hidden" name="manage_item_prod_id" id="manage_item_prod_id" value="<?php echo $prod_id; ?>">
                            <input type="hidden" name="have_group" id="have_group" value="<?php echo $have_group; ?>">
                        
                        </div>
                        <div class="col-md-5 text-center">
                            <label>Group: </label>
                            <button  id="btn_new_group" type="button" class="btn_mitem btn btn-primary" onclick="return newItemGroup();">New</button>
                            <button  id="btn_sorting_group" type="button" class="btn_mitem btn btn-info" onclick="return sortItemGroupView();">Sorting</button>
                            <button  id="btn_list_group" type="button" class="btn_mitem btn btn-dark" onclick="return showGroupList(); ">List</button>

                        </div>
                    </div>
                </div>

                <hr style="margin:10px 0px;">

                <div class="manage_panel" id="zone_item_add">
                    
                </div>
                <div class="manage_panel" id="zone_item_edit">
                    
                </div>
                <!-- <div class="manage_panel" id="zone_group_add">
                    
                </div>
                <div class="manage_panel" id="zone_group_edit">
                    
                </div> -->
                <div class="manage_panel" id="zone_item_show">
                    
                </div>
                <div class="manage_panel" id="zone_group_show">
                    
                </div>
                <div class="manage_panel" id="zone_item_sorting">
                    
                </div>
                <div class="manage_panel" id="zone_group_sorting">
                    
                </div>
                
            </div>
            <div class="modal-footer footer_panel">
                <div id="item_add_btn_zone" class="footer_btn">
                    <button type="button" id="btn_item_add_submit" class="btn btn-success" onclick="return submitNewItem();">Submit</button>
                    <button type="button" id="btn_item_add_cancel" class="btn btn-secondary" onclick="return showItemList();">Cancel</button>
                </div>
                <div id="item_edit_btn_zone" class="footer_btn">
                    <button type="button" id="btn_item_edit_submit" class="btn btn-success" onclick="return submitEditItem();">Submit</button>
                    <button type="button" id="btn_item_edit_cancel" class="btn btn-secondary" onclick="return cancelEditItem();">Cancel</button>
                </div>
                <div id="item_sorting_btn_zone" class="footer_btn">
                    <button type="button" id="btn_item_save_sort" class="btn btn-success" onclick="return saveItemSorting();">Save sorting</button>
                    <button type="button" id="btn_item_sort_cancel" class="btn btn-secondary" onclick="return showItemList();">Cancel</button>
                </div>
                
                <div id="group_sorting_btn_zone" class="footer_btn">
                    <button type="button" id="btn_group_save_sort" class="btn btn-success" onclick="return saveGroupSorting();">Save sorting</button>
                    <button type="button" id="btn_group_sort_cancel" class="btn btn-secondary" onclick="return showGroupList();">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New extra item -->
<div class="modal fade" id="adminNewExtraItemModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title" id="edit_price_modal_title">New extra item</h4>
            </div>
            <div class="modal-body" style="max-height: 500px;" >
                <form id="new_extra_form" onsubmit="">
                    <table class="tbl_new_extra" style="width: 100%;">
                        <tr>
                            <th style="width: 20%;">Product:</th><td id="td_show_prod"></td>
                        </tr>
                        <tr>
                            <th>Currency:</th><td id="td_show_curr"></td>
                        </tr>
                        <tr>
                            <th>Item name:</th><td><input type="text" id="new_extra_name" name="new_extra_name" ></td>
                        </tr>
                        <tr>
                            <th>Description:</th><td><input type="text" id="new_extra_desc" name="new_extra_desc" ></td>
                        </tr>
                        <tr>
                            <th>MSRP:</th><td><input type="number" id="new_extra_value" name="new_extra_value" min="0" step=".01"></td>
                        </tr>
                        <tr>
                            <th>QTY (15-99):</th><td><input type="number" id="new_extra_value_1" name="new_extra_value_1" min="0" step=".01"></td>
                        </tr>
                        <tr>
                            <th>QTY (100-299):</th><td><input type="number" id="new_extra_value_2" name="new_extra_value_2" min="0" step=".01"></td>
                        </tr>
                        <tr>
                            <th>QTY (300+):</th><td><input type="number" id="new_extra_value_3" name="new_extra_value_3" min="0" step=".01"></td>
                        </tr>
                        
                    </table>
                    <input type="hidden" name="new_extra_prod_id" id="new_extra_prod_id" value="<?php echo $row_product[0]["prod_id"]; ?>">
                    <input type="hidden" name="new_extra_curr_id" id="new_extra_curr_id" value="">
                </form>
            </div>
            <div class="modal-footer">

                <button style="float:right;" type="button" class="btn btn-success" id="btn_submit_new_extra" onclick="return adminSubmitNewExtra();">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit extra item -->
<div class="modal fade" id="adminEditExtraItemModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title" id="edit_price_modal_title">Edit extra item</h4>
            </div>
            <div class="modal-body" style="max-height: 500px;" >
                <form id="edit_extra_form" onsubmit="">
                    <span id="sp_edit_loading" style="display:none;"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...</span>
                    <table class="tbl_new_extra" style="width: 100%;">
                        <tr>
                            <th style="width: 20%;">Product:</th><td id="td_show_edit_prod"></td>
                        </tr>
                        <tr>
                            <th>Currency:</th><td id="td_show_edit_curr"></td>
                        </tr>
                        <tr>
                            <th>Item name:</th><td><input type="text" id="edit_extra_name" name="edit_extra_name" ></td>
                        </tr>
                        <tr>
                            <th>Description:</th><td><input type="text" id="edit_extra_desc" name="edit_extra_desc" ></td>
                        </tr>
                        <tr>
                            <th>MSRP:</th><td><input type="number" id="edit_extra_value" name="edit_extra_value" min="0" step=".01"></td>
                        </tr>
                        <tr>
                            <th>QTY (15-99):</th><td><input type="number" id="edit_extra_value_1" name="edit_extra_value_1" min="0" step=".01"></td>
                        </tr>
                        <tr>
                            <th>QTY (100-299):</th><td><input type="number" id="edit_extra_value_2" name="edit_extra_value_2" min="0" step=".01"></td>
                        </tr>
                        <tr>
                            <th>QTY (300+):</th><td><input type="number" id="edit_extra_value_3" name="edit_extra_value_3" min="0" step=".01"></td>
                        </tr>
                    </table>
                    <input type="hidden" name="edit_extra_id" id="edit_extra_id" value="">
                </form>
            </div>
            <div class="modal-footer">

                <button style="float:right;" type="button" class="btn btn-success" id="btn_submit_edit_extra" onclick="return adminSubmitEditExtra();">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Copy extra items -->
<div class="modal fade" id="adminCopyExtraItemModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title" id="edit_price_modal_title">Copy extra items</h4>
            </div>
            <div class="modal-body" style="max-height: 500px;" >
                <form id="new_extra_form" onsubmit="">
                    <table class="tbl_new_extra" style="width: 100%;">
                        <tr>
                            <th style="width: 20%;">Product:</th><td id="td_show_copy_prod"></td>
                        </tr>
                        <tr>
                            <th>Copy to:</th>
                            <td>
                                <select id="copy_to_prod_id">
                                    <?php 
                                    for($i=0;$i<sizeof($a_row_product);$i++){
                                        //if($a_row_product[$i]["prod_id"]!=$row_product[0]["prod_id"]){
                                    ?>
                                    <option value="<?php echo $a_row_product[$i]["prod_id"]; ?>"><?php echo $a_row_product[$i]["prod_name"]; ?></option>
                                    <?php
                                        //}
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Currency:</th>
                            <td id="td_show_copy_curr"></td>
                        </tr>
                        <tr id="sp_copy_change_curr" style="display: none;">
                            <td style="text-align: right;"><i class="fa fa-arrow-right"></i></td>
                            <td>
                                <select id="copy_to_curr_id">
                                    <?php 
                                    for($i=0;$i<sizeof($row_currency);$i++){
                                        
                                    ?>
                                    <option value="<?php echo $row_currency[$i]["curr_id"]; ?>"><?php echo $row_currency[$i]["curr_name"]." ".$row_currency[$i]["curr_desc"]." (Ex.Rate:".$row_currency[$i]["exchange_from_usd"].")"; ?></option>
                                    <?php
                                        
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="copy_extra_prod_id" id="copy_extra_prod_id" value="<?php echo $row_product[0]["prod_id"]; ?>">
                    <input type="hidden" name="copy_extra_curr_id" id="copy_extra_curr_id" value="">
                </form>
            </div>
            <div class="modal-footer">

                <button style="float:right;" type="button" class="btn btn-success" id="btn_submit_new_extra" onclick="return adminSubmitCopyExtra();">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Copy & Replace extra item -->
<div class="modal fade" id="adminCopyReplaceExtraItemModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title" id="edit_price_modal_title">Copy & Replace extra items</h4>
            </div>
            <div class="modal-body" style="max-height: 500px;" >
                <form id="new_copy_replace_extra_form_extra">
                    <table class="tbl_new_extra" style="width: 100%;">
                        <tr>
                            <th style="width: 20%;">Product:</th><td id="td_show_copy_replace_prod"></td>
                        </tr>
                        <tr>
                            <th>Extra Items (From Product):</th>
                            <td>
                                <select id="chkveg" multiple="multiple" name="from_product[]">
                                
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Currency:</th>
                            <td id="td_show_copy_replace_curr"></td>
                        </tr>
                        <tr id="sp_copy_replace_change_curr" style="display: none;">
                            <td style="text-align: right;"><i class="fa fa-arrow-right"></i></td>
                            <td>
                                <select id="copy_replace_to_curr_id" name="curr_id">
                                    <?php 
                                    for($i=0;$i<sizeof($row_currency);$i++){
                                        
                                    ?>
                                    <option value="<?php echo $row_currency[$i]["curr_id"]; ?>"><?php echo $row_currency[$i]["curr_name"]." ".$row_currency[$i]["curr_desc"]." (Ex.Rate:".$row_currency[$i]["exchange_from_usd"].")"; ?></option>
                                    <?php
                                        
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Copy to:</th>
                            <td>
                                <select id="copy_replace_to_prod_id" name="to_prod_id">
                                    <option value="" selected disabled>Select Product</option>
                                    <?php 
                                    for($i=0;$i<sizeof($a_row_product);$i++){
                                        //if($a_row_product[$i]["prod_id"]!=$row_product[0]["prod_id"]){
                                    ?>
                                    <option value="<?php echo $a_row_product[$i]["prod_id"]; ?>"><?php echo $a_row_product[$i]["prod_name"]; ?></option>
                                    <?php
                                        //}
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Extra Items(To Product):</th>
                            <td>
                                <select id="extra_item_to_product" name="to_product[]" multiple>
                                    
                                </select>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="copy_extra_prod_id" id="copy_replace_extra_prod_id" value="<?php echo $row_product[0]["prod_id"]; ?>">
                    <button style="float:right;" type="submit" class="btn btn-success" >Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

  <div class="modal fade" id="clone_modal">
    <div class="modal-dialog modal-xl modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="clone_heading"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
              <div class="table-responsive" id="cloner">          

              </div>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="clone_item_modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="clone_item_heading"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form id="clone_submit">
              <div class="form-group">
                <label for="selected_item_cloned">Selected Item to be Cloned</label>
                <input type="text" name="item_name" class="form-control" id="selected_item_cloned">
                <input type="hidden" name="main_item_id" id="clone_main_item_id" value="">
              </div>
              <div class="form-group">
                <label for="clone_to_product">Clone To Product</label>
                <select class="form-control" name="prod_id" id="clone_to_product">
                    <option value="" selected disabled>--Select Product--</option>
                    <?php
                    $clone_sql = "SELECT * FROM tbl_product";
                    $cloner = Yii::app()->db->createCommand($clone_sql)->queryAll();
                    foreach($cloner as $cls){
                        ?>
                        <option value="<?=$cls['prod_id']?>"><?=$cls['prod_name']?></option>
                        <?php
                    }
                    ?>
                </select>
              </div>
              <div class="form-group">
                <label for="clone_to_group">Select Group</label>
                <select class="form-control" name="group_id" id="clone_to_group">

                </select>
              </div>
              <?php
              $sql_sale_type = "SELECT * FROM tbl_sale_type";
              $slq = Yii::app()->db->createCommand($sql_sale_type)->queryAll();
              foreach($slq as $sal_datas){
              ?>
              <div class="form-check">
                  <input class="form-check-input" name="categories[]" type="checkbox" value="<?=$sal_datas['sat_id']?>" id="sat_id_<?=$sal_datas['sat_id']?>">
                  <label class="form-check-label" for="sat_id_<?=$sal_datas['sat_id']?>">
                    <?=$sal_datas['sat_name']?>
                  </label>
               </div>
               <?php
                }
               ?>
              <button type="submit" class="btn btn-success">Submit</button>
            </form>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

  <div class="modal fade" id="add_cost_calculator">
    <div class="modal-dialog modal-xl modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="cost_add_heading"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
              <div class="table-responsive" id="drafter">          

              </div>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
    <div class="modal fade" id="extra_cost_modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="extra_cost_heading"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
                <form id="update_ctc">
                  <div class="form-group">
                    <label for="emailss">Input Cost to Company</label>
                    <input type="text" placeholder="Input Cost Here..." class="form-control" name="ctc" id="emailss">
                    <input type="hidden" name="extra_id" id="extra_id_doc">
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button>
                </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script type="text/javascript">
$(document).on('change','#clone_to_product',function(){
    var prod_id = $(this).val();
    $.ajax({
        type:'POST',
        data:{
            prod_id:prod_id
        },
        url:'<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/FetchGroup',
        success:function(response){
            var response = JSON.parse(response);
            var html='';
            if(response.status==1){
                for(var i=0;i<response.data.length;i++){
                    html+='<option value="'+response.data[i].item_group_id+'#&#'+response.data[i].group_name+'">'+response.data[i].group_name+'</option>';
                }
            }
            else{
                html+='<option value="==no_group==">No Group Available</option>';
            }
            $('#clone_to_group').empty();
            $('#clone_to_group').append(html);
        }
    })
})

$(document).on('click','.clone_item',function(){
    var item_name = atob($(this).attr('item_name'));
    var item_id = $(this).attr('item_id');
    $('#clone_main_item_id').val(item_id);
    $('#clone_item_heading').html("<b>CLONE </b>"+item_name);
    $('#selected_item_cloned').val(item_name);
    $('#clone_item_modal').modal('show');
})

$(document).on('submit','#clone_submit',function(e){
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(form[0]);
    $.ajax({
        type:'POST',
        data:formData,
        contentType:false,
        processData:false,
        url:'<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/CloneSubmit',
        success:function(response){
            if(response=="success"){
                alert('Item Cloned ! Please Refresh');
                $('#clone_item_modal').modal('hide');
            }
        }
    })
})

$(document).on('submit','#update_ctc',function(e){
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(form[0]);
    $.ajax({
        type:'POST',
        data:formData,
        contentType:false,
        processData:false,
        url:'<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/UpdateCTC',
        success:function(response){
            var response = JSON.parse(response);
            if(response.status==1){
                $('#extra_cost_modal').modal('hide');
                showExtraV2();
            }
            else{
                alert('Something Went Wrong');
            }
        }
    })
})

$(document).on('click','.extra_cost_modal',function(){
    var extra_name = atob($(this).attr('extra_name'));
    var extra_id = $(this).attr('extra_id');
    var ctc = $(this).attr('ctc');
    $('#extra_cost_heading').html("COSTING FOR ("+extra_name+")");
    $('#emailss').val(ctc);
    $('#extra_id_doc').val(extra_id);
    $('#extra_cost_modal').modal('show');
})

$(document).on('click','.clone_it',function(){
    var calc_id = $(this).attr('calc_id');
    var item_id = $(this).attr('item_id');
    var draft_name = $('#draft_name_'+calc_id).val();
    if(draft_name.length==0){
        alert('Please Type Draft Name');
    }
    else{
        $.ajax({
            type:'POST',
            data:{
                calc_id:calc_id,
                item_id:item_id,
                draft_name:draft_name
            },
            url:'<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/CloneCalc',
            success:function(response){
                var response = JSON.parse(response);
                if(response.status==1){
                    alert('Cloned Successfully');
                    location.reload();
                }
                else{
                    alert('Something Went Wrong');
                }
            }
        })
    }
})

$(document).on('click','.clone_cost',function(){
    var item_id = $(this).attr('item_id');
    var item_name = atob($(this).attr('item_name'));
    $('#clone_heading').html("CLONE COSTING SHEET FOR ("+item_name+")");
    $('#cloner').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
    $.ajax({
        type:'POST',
        data:{
            item_id:item_id
        },
        url:'<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/FetchCalcData',
        success:function(response){
            $('#cloner').empty();
            $('#cloner').append(response);
            $('#clone_modal').modal('show');
        }
    })
})

$(document).on('click','.delete_calc',function(){
    var calc_id = $(this).attr('calc_id');
    if(confirm('Are You Sure?')){
        $.ajax({
            type:'POST',
            data:{
                calc_id:calc_id,
            },
            url:'<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/DeleteCalc',
            success:function(response){
                var response=JSON.parse(response);
                if(response.status==1){
                    alert('Deleted Successfully!');
                    $('#add_cost_calculator').modal('hide');
                    $('.open_calc_'+calc_id).hide();
                    // location.reload();
                }
                else{
                    alert('Something Went Wrong');
                }
            }
        })
    }
})

$(document).on('submit','#drafter3',function(e){
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(form[0]);
    $.ajax({
        type:'POST',
        data:formData,
        contentType:false,
        processData:false,
        url:'<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/EditCalc',
        success:function(response){
            var response = JSON.parse(response);
            if(response.status==1){
                $('#add_cost_calculator').modal('hide');
                alert('Calculations Added Successfully!');
            }
            else{
                alert('Something Went Wrong');
            }
        }
    })
})

$(document).on('submit','#drafter2',function(e){
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(form[0]);
    let item_id = formData.get('item_id');
    let item_name = formData.get('item_name');
    let draft_name = formData.get('draft_name');
    $.ajax({
        type:'POST',
        data:formData,
        contentType:false,
        processData:false,
        url:'<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/AddCalc',
        success:function(response){
            var response = JSON.parse(response);
            if(response.status==1){
                var html='';
                html+='<br><button class="btn btn-success open_calc open_calc_'+response.calc_id+'" item_id="'+item_id+'" item_name="'+item_name+'" calc_id="'+response.calc_id+'">'+draft_name+'</button>';
                $(html).insertAfter('.add_cost_'+item_id);
                $('#add_cost_calculator').modal('hide');
                alert('Calculations Added Successfully!');
                //location.reload();
            }
            else{
                alert('Something Went Wrong');
            }
        }
    })
})

$(document).on('submit','#upload_fabric_img',function(e){
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(form[0]);
    for (var p of formData) {
        let name = p[0];
        let value = p[1];
        if(name==="item_id"){
            var item_id = value;
        }
    }
    $.ajax({
        type:'POST',
        data:formData,
        contentType:false,
        processData:false,
        url:'<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/UploadFabricImage',
        success:function(response){
            var response = JSON.parse(response);
            if(response.status==1){
                alert('Uploaded Successfully');
                $('#fabric_img_'+item_id).empty();
                var html="";
                html+='<img style="height:100px;" src="/upload/pattern/'+response.file_name+'">';
                $('#fabric_img_'+item_id).append(html);
                $('#adminEditUpdateImage').modal('hide');
            }
            else{
                alert("Something Went Wrong");
            }
        }
    })
    
})

$(document).on('submit','#new_copy_replace_extra_form_extra',function(e){
    e.preventDefault();
    var prod_id = <?php echo $prod_id?>;
    var curr_id = $('#select_curr_id').val();
    var form = $(this);
    var formData = new FormData(form[0]);
    formData.append('prod_id', prod_id);
    formData.append('from_curr_id',curr_id);
    $.ajax({
        type:'POST',
        data:formData,
        contentType:false,
        processData:false,
        url:'<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/ReplaceCopyExtraSubmit',
        success:function(response){
            var response = JSON.parse(response);
            if(response.status==1){
                alert('Copied Successfully');
                location.reload();
            }
            else{
                alert("Cannot copy to the same product and currency.");
            }
        }
    })
})

$(function() {

//   $('#chkveg').multiselect({
//     includeSelectAllOption: true
//   });

  $('#btnget').click(function() {
    alert($('#chkveg').val());
  });
});


$(function() {

    $('#zone_group_sorting').sortable(); 
    $('#zone_group_sorting').disableSelection(); 
    
});

function openManagePanel(){

    $('.manage_panel').hide();
    $('.footer_panel').hide();
    $('.footer_btn').hide();

    showItemList();

}

function showItemList(item_id_focus=0){

    var prod_id = $('#manage_item_prod_id').val();
    var group_id = $('#select_item_group').val();
    var have_group = $('#have_group').val();


    $('.manage_panel').hide();
    $('.footer_panel').hide();

    $('#zone_item_show').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
    $('#zone_item_show').show();

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showItemList" ,
        data: {
            "prod_id":prod_id,
            "group_id":group_id,
            "have_group":have_group
        } ,
        success: function(resp){ 
            
            if(resp.num_show_item==0){
                $('#btn_sorting_item').attr("disabled",true);
            }else{
                $('#btn_sorting_item').attr("disabled",false);
            }

            $('#zone_item_show').html(resp.inner_content);
            if(item_id_focus!=0){
                $('#zone_item_show').hide();
                $('#zone_item_show').fadeIn(function(){
        
                    var scrollPos =  $('#list_item'+item_id_focus).offset().top;
                    $('#manage_item_modal_body').scrollTop((scrollPos-150));
                    
                });
            }

        }  
    });
}

function deleteProductItem(item_id){

    if(confirm("Deleting confirm?")){

        $.ajax({  
            type: "POST",  
            dataType: "json", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/deleteProductItem" ,
            data: {
                "item_id":item_id
            } ,
            success: function(resp){ 
                
                if(resp.result=="success"){

                    $('#list_item'+item_id).fadeOut(500);
                    
                }else{
                    alert(resp.msg);
                }

            }  
        });

    }

}

function editProductItem(item_id){

    $('.manage_panel').hide();

    $('#zone_item_edit').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
    $('#zone_item_edit').show();

    $('.footer_btn').hide();
    $('.footer_panel').show();
    $('#item_edit_btn_zone').show();

    $.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/editProductItemForm" ,
        data: {
            "item_id":item_id
        } ,
        success: function(resp){ 
            
            $('#zone_item_edit').html(resp);

        }  
    });
}

function cancelEditItem(){

    var item_id = $('#edit_item_id').val();

    showItemList(item_id);

}

function submitEditItem(){

    var item_id = $('#edit_item_id').val();

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/editProductItemSubmit" ,
        data: $('#edit_prod_item_form').serialize() ,
        success: function(resp){ 

            if(resp.result=="success"){

                showItemList(item_id);
                
            }else{
                alert(resp.msg);
            }
        }
    });

}

function sortItemView(){

    var group_id = $('#select_item_group').val();

    if(group_id=="==all=="){
        alert("Please select a group or ==No Group==");
        return false;
    }

    $('.manage_panel').hide();

    $('#zone_item_sorting').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
    $('#zone_item_sorting').show();

    $('.footer_btn').hide();
    $('.footer_panel').show();
    $('#item_sorting_btn_zone').show();

    var prod_id = $('#manage_item_prod_id').val();

    $.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/sortingItemView" ,
        data: {
            "prod_id":prod_id,
            "group_id":group_id
        } ,
        success: function(resp){ 
            
            $('#zone_item_sorting').html(resp);
            $('#inner_item_sorting').sortable(); 
            $('#inner_item_sorting').disableSelection(); 
        }  
    });

}

function saveItemSorting(){

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/sortingItemSubmit" ,
        data: $('#form_item_sorting').serialize() ,
        success: function(resp){ 

            if(resp.result=="success"){

                showItemList();
                
            }else{
                alert(resp.msg);
            }
        }
    });

}

function newProductItem(){

    $('.manage_panel').hide();

    $('#zone_item_add').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
    $('#zone_item_add').show();

    $('.footer_btn').hide();
    $('.footer_panel').show();
    $('#item_add_btn_zone').show();

    var prod_id = $('#manage_item_prod_id').val();

    $.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/newProductItemForm" ,
        data: {
            "prod_id":prod_id
        } ,
        success: function(resp){ 
            
            $('#zone_item_add').html(resp);

        }  
    });
}

function submitNewItem(){

    if($('#new_item_name').val()==""){
        alert("Please input item name.");
        return false;
    }
    
    /*new_item_detail
    new_item_style
    new_item_fabric_opt*/

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/newProductItemSubmit" ,
        data: $('#new_prod_item_form').serialize() ,
        success: function(resp){ 

            if(resp.result=="success"){

                var tmp_select_group = $('#new_item_group').val();
                var a_group_id = tmp_select_group.split("#&#");

                $('#select_item_group').val(a_group_id[0]);

                showItemList();
                
            }else{
                alert(resp.msg);
            }
        }
    });

}

function showGroupList(){

    var prod_id = $('#manage_item_prod_id').val();

    $('.manage_panel').hide();
    $('.footer_panel').hide();

    $('#zone_group_show').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
    $('#zone_group_show').show();

    $.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showGroupList" ,
        data: {
            "prod_id":prod_id
        } ,
        success: function(resp){ 

            $('#zone_group_show').html(resp);

        }  
    });

}

function editItemGroup(item_group_id){

    var group_name = prompt("Group name:",$('#td_group_name'+item_group_id).html());

    if(group_name==null){
        return false;
    }else if(group_name==""){
        alert("Please input Group name");
        return false;
    }else{
        $.ajax({  
            type: "POST",  
            dataType: "json", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/updateGroupName" ,
            data: {
                "item_group_id":item_group_id,
                "group_name":window.btoa(group_name)
            } ,
            success: function(resp){ 

                if(resp.result=="success"){
                    $('#td_group_name'+item_group_id).html(group_name);
                }else{
                    alert(resp.msg);
                }

            }
        });
    }

}

function newItemGroup(){

    var group_name = prompt("New Group name:","");

    if(group_name==null){
        return false;
    }else if(group_name==""){
        alert("Please input Group name");
        return false;
    }else{

        var prod_id = $('#manage_item_prod_id').val();

        $.ajax({  
            type: "POST",  
            dataType: "json", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/newGroupName" ,
            data: {
                "prod_id":prod_id,
                "group_name":window.btoa(group_name)
            } ,
            success: function(resp){ 

                if(resp.result=="success"){
                    /*if($('#have_group').val()=="0"){
                        window.location.reload();
                    }else{*/
                        $('#have_group').val("1");
                        $('#select_item_group').append('<option value="'+resp.item_group_id+'">'+group_name+'</option>');
                        showGroupList();

                    //}
                    
                    
                }else{
                    alert(resp.msg);
                }

            }
        });
    }

}

function deleteItemGroup(item_group_id){

    if(confirm("Deleting group confirm?")){
        $.ajax({  
            type: "POST",  
            dataType: "json", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/deleteItemGroup" ,
            data: {
                "item_group_id":item_group_id
            } ,
            success: function(resp){ 

                if(resp.result=="success"){
                    $('#list_group'+item_group_id).fadeOut(500);
                }else{
                    alert(resp.msg);
                }

            }
        });
    }

}

function sortItemGroupView(){

    $('.manage_panel').hide();

    $('#zone_group_sorting').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
    $('#zone_group_sorting').show();

    $('.footer_btn').hide();
    $('.footer_panel').show();
    $('#group_sorting_btn_zone').show();

    var prod_id = $('#manage_item_prod_id').val();

    $.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/sortingGroupView" ,
        data: {
            "prod_id":prod_id
        } ,
        success: function(resp){ 
            
            $('#zone_group_sorting').html(resp);
            $('#inner_group_sorting').sortable(); 
            $('#inner_group_sorting').disableSelection(); 
        }  
    });

}

function saveGroupSorting(){
    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/sortingGroupSubmit" ,
        data: $('#form_group_sorting').serialize() ,
        success: function(resp){ 

            if(resp.result=="success"){

                showGroupList();
                
            }else{
                alert(resp.msg);
            }
        }
    });
}

    function adminEditPrice(prg_id,item_id,curr_id,sat_id,comm_per_id){

        $('#td_sale_type').html($('#sp_sale_type'+sat_id).html());
        $('#td_item_name').html($('#row_item_name'+item_id).html());
        var col_title = $('#col_title'+comm_per_id).html();
        $('#td_col_title').html(col_title.replace("<br>"," "));
        $('#td_comm_value').html($('#col_comm_percent'+comm_per_id).html());
        $('#td_currency').html($('#select_curr_id option:selected').text());

        $('#prg_price').val($('#prg_price'+prg_id).html());

        $('#edit_prg_id').val(prg_id);

        $('#add_cell_id').val(item_id+"00"+comm_per_id);
        $('#add_item_id').val(item_id);
        $('#add_curr_id').val(curr_id);
        $('#add_sat_id').val(sat_id);
        $('#add_comm_per_id').val(comm_per_id);

        $('#edit_price_modal_title').html("Edit Price");
        $('#edit_price_form').attr("onsubmit","return adminSubmitEditPrice();");
        $('#btn_submit_edit_price').attr("onclick","return adminSubmitEditPrice();");

        $('#btn_delete_price').show();

    }

    function adminSubmitEditPrice(){

        var prg_id = $('#edit_prg_id').val();
        var price = $('#prg_price').val();

        if(prg_id==""){
            alert("Invalid parameter");
            return false;
        }

        if( price=="" || price==0){
            alert("Please input price");
            return false;
        }

        $.ajax({  
            type: "POST",  
            dataType: "json", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/adminSubmitEditPrice" ,
            data: {
                "prg_id":prg_id,
                "price":price
            } ,
            success: function(resp){ 
                
                if(resp.result=="success"){

                    $('#prg_price'+prg_id).html(parseFloat(price).toFixed(2));
                    $('#adminEditPriceModal').modal("toggle");
                    $('#prg_price'+prg_id).css("background-color","#F99").css("font-weight","bold");
                    setTimeout(function() {
                        $('#prg_price'+prg_id).css("background-color","transparent").css("font-weight","normal");
                    }, 3000);
                    
                }else{
                    alert(resp.msg);
                }

            }  
        });

        return false;

    }

    function adminAddPrice(cell_id,item_id,curr_id,sat_id,comm_per_id){

        $('#td_sale_type').html($('#sp_sale_type'+sat_id).html());
        $('#td_item_name').html($('#row_item_name'+item_id).html());
        var col_title = $('#col_title'+comm_per_id).html();
        $('#td_col_title').html(col_title.replace("<br>"," "));
        $('#td_comm_value').html($('#col_comm_percent'+comm_per_id).html());
        $('#td_currency').html($('#select_curr_id option:selected').text());

        $('#prg_price').val('');

        $('#add_cell_id').val(cell_id);
        $('#add_item_id').val(item_id);
        $('#add_curr_id').val(curr_id);
        $('#add_sat_id').val(sat_id);
        $('#add_comm_per_id').val(comm_per_id);

        $('#edit_price_modal_title').html("Add Price");
        $('#edit_price_form').attr("onsubmit","return adminSubmitAddPrice();");
        $('#btn_submit_edit_price').attr("onclick","return adminSubmitAddPrice();");

         $('#btn_delete_price').hide();

    }

    function adminSubmitAddPrice(){

        var cell_id = $('#add_cell_id').val();
        var item_id = $('#add_item_id').val();
        var curr_id = $('#add_curr_id').val();
        var sat_id = $('#add_sat_id').val();
        var comm_per_id = $('#add_comm_per_id').val();

        if( cell_id=="" || item_id=="" || curr_id=="" || sat_id=="" || comm_per_id=="" ){
            alert("Invalid parameter");
            return false;
        }

        var price = $('#prg_price').val();

        if( price=="" || price==0){
            alert("Please input price");
            return false;
        }

        $.ajax({  
            type: "POST",  
            dataType: "json", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/adminSubmitAddPrice" ,
            data: {
                "item_id":item_id,
                "curr_id":curr_id,
                "sat_id":sat_id,
                "comm_per_id":comm_per_id,
                "price":price
            } ,
            success: function(resp){ 
                
                if(resp.result=="success"){

                    var prg_id = resp.prg_id;

                    $('#prg_price'+cell_id).removeClass("add_price").addClass("add-to-cart").html(parseFloat(price).toFixed(2));
                    $('#prg_price'+cell_id).attr("onclick","return adminEditPrice("+prg_id+","+item_id+","+curr_id+","+sat_id+","+comm_per_id+");");
                    $('#prg_price'+cell_id).css("background-color","#F99").css("font-weight","bold");
                    $('#prg_price'+cell_id).attr("id","prg_price"+prg_id);

                    $('#adminEditPriceModal').modal("toggle");
                    
                    setTimeout(function() {
                        $('#prg_price'+prg_id).css("background-color","transparent").css("font-weight","normal");
                    }, 3000);
                    
                }else{
                    alert(resp.msg);
                }

            }  
        });

        return false;

    }

    function adminDeletePrice(){

        var prg_id = $('#edit_prg_id').val();
        if(prg_id==""){
            alert("Invalid parameter");
            return false;
        }

        if(confirm("Confirm to delete this Price?")){

            $.ajax({  
                type: "POST",  
                dataType: "json", 
                url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/adminDeletePrice" ,
                data: {
                    "prg_id":prg_id
                } ,
                success: function(resp){ 
                    
                    if(resp.result=="success"){

                        var cell_id = $('#add_cell_id').val();
                        var item_id = $('#add_item_id').val();
                        var curr_id = $('#add_curr_id').val();
                        var sat_id = $('#add_sat_id').val();
                        var comm_per_id = $('#add_comm_per_id').val();

                        $('#prg_price'+prg_id).removeClass("add-to-cart").addClass("add_price").html('<i class="fa fa-plus-circle"></i>');
                        $('#prg_price'+prg_id).attr("onclick","return adminAddPrice("+cell_id+","+item_id+","+curr_id+","+sat_id+","+comm_per_id+");");
                        $('#prg_price'+prg_id).css("background-color","#F99");
                        $('#prg_price'+prg_id).attr("id","prg_price"+cell_id);

                        $('#adminEditPriceModal').modal("toggle");
                        
                        setTimeout(function() {
                            $('#prg_price'+cell_id).css("background-color","transparent");
                        }, 3000);
                        
                    }else{
                        alert(resp.msg);
                    }

                }  
            });
        }

        return false;

    }

function newExtraItem(){

    $('#td_show_prod').html('<?php echo addslashes($row_product[0]["prod_name"]); ?>');
    $('#td_show_curr').html($('#select_curr_id option:selected').text());
    
    $('#new_extra_name').val("");
    $('#new_extra_desc').val("");
    $('#new_extra_value').val("");

}

function copyExtraItem(){
    
    if( $('#num_extra_item').val() == null ){
        alert("There are no extra items to copy");
    }else{

        var curr_now = $('#select_curr_id').val();

        if(curr_now == "1"){
            $('#sp_copy_change_curr').show();
        }else{
            $('#sp_copy_change_curr').hide();
            $('#copy_to_curr_id').val(curr_now);
        }

        $('#adminCopyExtraItemModal').modal("toggle");

        $('#td_show_copy_prod').html('<?php echo addslashes($row_product[0]["prod_name"]); ?>');
        $('#td_show_copy_curr').html($('#select_curr_id option:selected').text());
    }

}

function copyReplaceExtraItem(){
    
    if( $('#num_extra_item').val() == null ){
        alert("There are no extra items to copy");
    }else{

        var curr_now = $('#select_curr_id').val();

        if(curr_now == "1"){
            $('#sp_copy_replace_change_curr').show();
        }else{
            $('#sp_copy_replace_change_curr').hide();
            $('#copy_replace_to_curr_id').val(curr_now);
        }

        var prod_id = <?php echo addslashes($row_product[0]["prod_id"]); ?>;
        $.ajax({
            type:'POST',
            data:{
                prod_id:prod_id,
                curr_now:curr_now
            },
            url:'<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/FetchExtraItems',
            success:function(response){
                var response = JSON.parse(response);
                if(response.status==1){
                    var html='';
                    for(var i=0;i<response.data.length;i++){
                        html+='<option value="'+response.data[i].extra_id+'" selected>'+response.data[i].extra_name+'</option>';
                    }
                    $('#chkveg').empty();
                    $('#chkveg').append(html);
                    // $('#chkveg').multiselect({
                    //     includeSelectAllOption: true
                    //   });
                    $('#adminCopyReplaceExtraItemModal').modal("toggle");
                    $('#td_show_copy_replace_prod').html('<?php echo addslashes($row_product[0]["prod_name"]); ?>');
                    $('#td_show_copy_replace_curr').html($('#select_curr_id option:selected').text());
                }
                else{
                    alert('No Extra Items');
                }
            }
        })
    }

}

$(document).on('change','#copy_replace_to_curr_id',function(){
    $("#copy_replace_to_prod_id").val("").change();
    $('#extra_item_to_product').empty();
})

$(document).on('change','#copy_replace_to_prod_id',function(){
    var prod_id = $(this).val();
    var curr_now = $('#copy_replace_to_curr_id').val();
    $.ajax({
            type:'POST',
            data:{
                prod_id:prod_id,
                curr_now:curr_now
            },
            url:'<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/FetchExtraItems',
            success:function(response){
                var response = JSON.parse(response);
                if(response.status==1){
                    var html='';
                    for(var i=0;i<response.data.length;i++){
                        html+='<option value="'+response.data[i].extra_id+'" selected>'+response.data[i].extra_name+'</option>';
                    }
                }
                $('#extra_item_to_product').empty();
                $('#extra_item_to_product').append(html);
            }
        })
})



function adminSubmitCopyExtra(){

    var from_prod_id = '<?php echo addslashes($row_product[0]["prod_id"]); ?>';
    var to_prod_id = $('#copy_to_prod_id').val();
    var from_curr_id = $('#select_curr_id').val();
    var to_curr_id = $('#copy_to_curr_id').val();

    if( (from_prod_id==to_prod_id) && (from_curr_id==to_curr_id) ){
        alert("Cannot copy to the same product and currency.");
        return false;
    }

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/copyExtraSubmit" ,
        data: {
            "from_prod_id":from_prod_id,
            "to_prod_id":to_prod_id,
            "from_curr_id":from_curr_id,
            "to_curr_id":to_curr_id
        } ,
        success: function(resp){ 

            if(resp.result=="success"){

                alert("Copy successful!");
                $('#adminCopyExtraItemModal').modal("toggle");
                
            }else{
                alert("Copy failure!");
            }
        }
    });

    //alert("["+from_prod_id+" to "+to_prod_id+"] curr="+from_curr_id+" to "+to_curr_id);

}

function adminSubmitNewExtra(){

    if( $('#new_extra_name').val()=="" || $('#new_extra_desc').val()=="" || $('#new_extra_value').val()=="" ){
        alert("Please fill all input.");
        return false;
    }

    $('#new_extra_curr_id').val($('#select_curr_id').val());

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/newExtraSubmit" ,
        data: $('#new_extra_form').serialize() ,
        success: function(resp){ 

            if(resp.result=="success"){

                $('#adminNewExtraItemModal').modal("toggle");
                showExtraV2();
                location.reload();
                
            }else{
                alert(resp.msg);
            }
        }
    });

}

function editExtraItem(extra_id){
    
    $('#sp_edit_loading').show();
    $('#td_show_edit_prod').html('<?php echo addslashes($row_product[0]["prod_name"]); ?>');
    $('#td_show_edit_curr').html($('#select_curr_id option:selected').text());

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/editExtraItem" ,
        data: {
            "extra_id":extra_id
        } ,
        success: function(resp){ 

            if(resp.result=="success"){

                $('#edit_extra_id').val(resp.extra_id);
                $('#edit_extra_name').val(resp.extra_name);
                $('#edit_extra_desc').val(resp.extra_desc);
                $('#edit_extra_value').val(resp.extra_value);
                $('#edit_extra_value_1').val(resp.extra_value_1);
                $('#edit_extra_value_2').val(resp.extra_value_2);
                $('#edit_extra_value_3').val(resp.extra_value_3);

                $('#sp_edit_loading').hide();

            }else{
                alert(resp.msg);
            }
        }
    });

}

function adminSubmitEditExtra(){

    if( $('#edit_extra_id').val()=="" ){
        alert("Error loading info.");
        return false;
    }

    if( $('#edit_extra_name').val()=="" || $('#edit_extra_desc').val()=="" || $('#edit_extra_value').val()=="" ){
        alert("Please fill all input.");
        return false;
    }

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/editExtraSubmit" ,
        data: $('#edit_extra_form').serialize() ,
        success: function(resp){ 

            if(resp.result=="success"){

                $('#adminEditExtraItemModal').modal("toggle");
                showExtraV2();
                
            }else{
                alert(resp.msg);
            }
        }
    });

}

function deleteExtraItem(extra_id){

    if(confirm("Deleting confirm?")){
        $.ajax({  
            type: "POST",  
            dataType: "json", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/deleteExtra" ,
            data: {
                "extra_id":extra_id
            } ,
            success: function(resp){ 

                if(resp.result=="success"){

                    showExtraV2();
                    
                }else{
                    alert(resp.msg);
                }
            }
        });
    }

}

function editNotes(){

    $('#tr_show_notes').hide();
    $('#tr_edit_notes').show();

    $('#btn_edit_notes').hide();
    $('#btn_save_notes').show();
    $('#btn_cancel_edit_notes').show();

}

function cancelEditNotes(){

    $('#txtarea_edit_notes').val($('#old_notes').val());

    $('#tr_show_notes').show();
    $('#tr_edit_notes').hide();

    $('#btn_edit_notes').show();
    $('#btn_save_notes').hide();
    $('#btn_cancel_edit_notes').hide();

}

function saveEditNotes(prod_id){

    var notes = window.btoa($('#txtarea_edit_notes').val());
    var curr_id = $('#select_curr_id').val();

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/saveEditNotes" ,
        data: {
            "prod_id":prod_id,
            "curr_id":curr_id,
            "notes":notes
        } ,
        success: function(resp){ 

            if(resp.result=="success"){

                var show_notes = window.atob(resp.show_notes);
                var old_notes = $('#txtarea_edit_notes').val();

                $('#txtarea_edit_notes').val(old_notes);
                $('#old_notes').val(old_notes);

                $('#td_show_notes').html(show_notes);

                $('#tr_show_notes').show();
                $('#tr_edit_notes').hide();

                $('#btn_edit_notes').show();
                $('#btn_save_notes').hide();
                $('#btn_cancel_edit_notes').hide();
                
            }else{
                alert(resp.msg);
            }
        }
    });

}

$(document).on('click','.open_calc',function(){
    var calc_id = $(this).attr('calc_id');
    var item_id = $(this).attr('item_id');
    var item_name = atob($(this).attr('item_name'));
    $('#cost_add_heading').html("COSTING SHEET ("+item_name+")");
    $('#drafter').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
    $.ajax({
        type:'POST',
        data:{
            item_id:item_id,
            calc_id:calc_id,
            item_name:item_name
        },
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/EditCostCalc" ,
        success:function(response){
            $('#drafter').empty();
            $('#drafter').append(response);
        }
    })
    $('#add_cost_calculator').modal('show');
})

$(document).on('click','.add_cost',function(){
    var item_id = $(this).attr('item_id');
    var item_name = atob($(this).attr('item_name'));
    $('#cost_add_heading').html("COSTING SHEET ("+item_name+")");
    $('#drafter').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');
    $.ajax({
        type:'POST',
        data:{
            item_id:item_id,
            item_name:item_name
        },
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/AddCostCalc" ,
        success:function(response){
            $('#drafter').empty();
            $('#drafter').append(response);
        }
    })
    $('#add_cost_calculator').modal('show');
})
</script>
<?php
}//---End admin zone
?>
