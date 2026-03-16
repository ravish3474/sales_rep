<style type="text/css">
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


</style>
<?php

$prod_id = $row_product[0]['prod_id'];

?>
<!-- <div id="debug_panel"></div> -->
<div class="row">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2><?php echo $row_product[0]['prod_detail']; ?></h2>
				<div class="clearfix"></div>
			</div>
			
			<div>
				<?php
				$n_loop = sizeof($row_sale_type);
				for($i=0;$i<$n_loop;$i++){

					$extra_class = "";
					if($i==0){ $extra_class = "first_type sale_type_tab_active"; }
					if(($i+1)==$n_loop){ $extra_class = "last_type"; }
					
					?><span id="sp_sale_type<?php echo $row_sale_type[$i]["sat_id"]; ?>" class="sale_type_tab <?php echo $extra_class; ?>" onclick="return selectSaleType(<?php echo $row_sale_type[$i]["sat_id"]; ?>);">
						<?php echo $row_sale_type[$i]["sat_name"]; ?>
					</span><?php
				}
				?>
				<input type="hidden" id="select_sale_type_id" value="1">
				&nbsp;Currency: 
				<select id="select_curr_id" onchange="return showPriceGuide();">
					<?php
					for($i=0;$i<sizeof($row_currency);$i++){
						echo '<option value="'.$row_currency[$i]["curr_id"].'">'.$row_currency[$i]["curr_name"].' '.$row_currency[$i]["curr_desc"].'</option>';
					}
					?>
				</select>

			</div>
			<div class="clearfix"></div>
			
			<div class="x_content">
				<div id="price_guide_content">
					
				</div>

			</div>

			<div class="x_content">
				<div id="extra_price_content">
					
				</div>
			</div>

			<div class="x_content">
				<table class="tbl_notes" style="width: 100%;">
					<tr><th class="bg-blue-light">Notes</th></tr>
					<tr>
						<td>
						<?php
						echo nl2br($row_notes["notes"]);
						?>
						</td>
					</tr>
				</table>
			</div>

		</div>
	</div>

</div>


<script type="text/javascript">
showPriceGuide();

$('#cartV2Modal').on("hide.bs.modal", function() {

    if($('#is_front').val()==1){
        
       $.ajax({  
            type: "POST",  
            dataType: "json", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/updateCart" ,
            data: $('#formCart').serialize() ,
            success: function(resp){ 

            	//$('#debug_panel').html(resp);

                if(resp.result=="updated"){

                    $('#sp_sum_total').html(resp.num_item);

                    //alert(resp.num_item);
                    
                }else{
                    //alert(resp.result);
                }
            }
        });
    }

});

function selectSaleType(sat_id){
	$('#select_sale_type_id').val(sat_id);

	$('.sale_type_tab').removeClass("sale_type_tab_active");
	$('#sp_sale_type'+sat_id).addClass("sale_type_tab_active");

	showPriceGuide();
}

function showPriceGuide(){

	showExtraV2();

	var sat_id = $('#select_sale_type_id').val();
	var curr_id = $('#select_curr_id').val();
	var prod_id = <?php echo $prod_id; ?>;

	$('#price_guide_content').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

	$.ajax({  
        type: "POST",  
        dataType: "html", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showInner/product/"+prod_id+"/type/"+sat_id+"/curr/"+curr_id ,
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
        url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/showExtra/curr/"+curr_id ,
        success: function(resp){ 
            if(resp=="empty"){
            	$('#extra_price_content').hide();
            }else{
	        	$('#extra_price_content').html(resp);
	        }

        }  
    });

}

function addExtraToCartV2(extra_id){

	if($('#qdoc_id_editing').val()==null){

        //alert("extra_id="+extra_id+"\ncurrency="+currency);
        $.ajax({  
            type: "POST",  
            dataType: "html", 
            url:"<?php echo Yii::app()->request->baseUrl; ?>/priceGuideV2/addExtraToCart" ,
            data:{
                "extra_id":extra_id
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
            $('#build_quote').html('Create New Quotation').attr("disabled",false);

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

function addItemRowV2(){
    var row_no = $('#count_item_row').val();

    var inner_new_row = '';
    inner_new_row += '<tbody id="tr_other'+row_no+'"><tr><td style="text-align:center;">'+row_no;

    if( $('#after_approved_editing').val()=="yes" ){
        inner_new_row +=  '<input name="a_qdoci_id[]" type="hidden" value="new_other" >';
    }

    inner_new_row +=  '<input name="product_type[]" type="hidden" value="other" id="product_other'+row_no+'">';
    inner_new_row +=  '<input name="item_id[]" type="hidden" value="ot'+row_no+'" id="id_other'+row_no+'">';
    inner_new_row +=  '<input name="prg_id[]" type="hidden" value="" >';
    inner_new_row +=  '<input name="comm_percent[]" type="hidden" value="" id="comm_percent_other'+row_no+'">';
    inner_new_row +=  '<input name="qty_note[]" type="hidden" value="" id="qty_note_other'+row_no+'">';
    inner_new_row += '</td>';
    inner_new_row += '<td><textarea style="width:200px; min-height:80px; padding:5px;" name="product_item[]" id="product_item_other'+row_no+'"></textarea></td>';
    inner_new_row += '<td><textarea style="width:405px; min-height:80px; padding:5px;" name="product_desc[]" id="product_desc_other'+row_no+'"></textarea></td>';
    inner_new_row += '<td></td>';
    inner_new_row += '<td></td>';
    inner_new_row += '<td style="text-align:center;">';
    inner_new_row += '<input class="chk_qty" name="qty[]" id="qty_other'+row_no+'" type="number" min="0" style="text-align:center; width:50px;" onchange="return calPriceV2(\'other'+row_no+'\',1);" onkeyup="return calPriceV2(\'other'+row_no+'\',1);" value="">';
    inner_new_row += '</td>';
    
    inner_new_row += '<td style="text-align:center;"><input class="chk_uprice" name="uprice[]" type="number" min="0" id="uprice_other'+row_no+'" style="text-align:center; width:50px; " onchange="return calPriceV2(\'other'+row_no+'\',1);" onkeyup="return calPriceV2(\'other'+row_no+'\',1);"></td>';
    inner_new_row += '<td style="text-align:center;" id="amount_other'+row_no+'"></td>';
    inner_new_row += '<td style="text-align:center;"><button type="button" class="btn btn-danger" onclick="return deleteRow(\'other'+row_no+'\',1);">Del</button></td>';
    inner_new_row += '</tr></tbody>';

    $('#tbl_cart_info').append(inner_new_row); 

    row_no = parseInt(row_no)+1;
    $('#count_item_row').val(row_no);
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