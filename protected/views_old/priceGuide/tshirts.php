<style>
	
	.bg-usd, .bg-cad, .bg-price{
		text-align: center;
		vertical-align: middle;
	}
	.pre {
		white-space: pre;
	}
.add-to-cart{
	cursor: pointer;
}
.add-to-cart:hover{
	text-decoration: underline;
	color: #00F;
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

<div class="row" id="tshirts">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2><?php echo $toppic['details']; ?></h2>
				<div class="clearfix"></div>
			</div>
			<?php if(!empty($toppic['Note'])){ ?>
			<div class="x_title">
				<h6 style="color:red"> >> <?php echo $toppic['Note']; ?> << </h6>
				<div class="clearfix"></div>
			</div>
			<?php } ?>
			<div class="x_content">
                <?php echo $this->renderPartial('/priceGuide/selectors/userType');  ?>
                &nbsp;&nbsp;Currency :
                <select id="dynamic_select">
                	<?php
                		if(isset($_GET['curr'])){
                			$curr=$_GET['curr'];
                		}else{
                			$curr=0;
                		}

                		switch ($curr) {
                			case 0:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/tshirts/?curr=0">USD North America</option>';
                				$curr_name='USD North America';
                				break;
                			case 1:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/tshirts/?curr=1">CAD North America</option>';
                				$curr_name='CAD North America';
                				break;
                			case 2:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/tshirts/?curr=2">USD Europe and South America</option>';
                				$curr_name='USD Europe and South America';
                				break;
                			case 3:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/tshirts/?curr=3">USD ASIA and Australia</option>';
                				$curr_name='USD ASIA and Australia';
                				break;
                			case 4:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/tshirts/?curr=4">THB Thai Baht</option>';
                				$curr_name='THB Thai Baht';
                				break;
                			case 5:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/tshirts/?curr=5">SGD Singapore</option>';
                				$curr_name='SGD Singapore';
                				break;
                		}
                		echo $btn;
                	?>
                	<option value=""><b>Select Currency</b></option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/tshirts/?curr=0">USD North America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/tshirts/?curr=1">CAD North America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/tshirts/?curr=2">USD Europe and South America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/tshirts/?curr=3">USD ASIA and Australia</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/tshirts/?curr=4">THB Thai Baht</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/tshirts/?curr=5">SGD Singapore</option>
                </select>
                <script type="text/javascript">
                	$(function(){
                		$('#dynamic_select').on('change', function () {
                			var url = $(this).val(); // get selected value
                			if (url) { // require a URL
                				window.location = url; // redirect
                			}
                			return false;
                		});
                	});
                </script>
                <a href="<?php echo Yii::app()->baseUrl; ?>/pdf/tshirtsXLS/?curr=<?php echo $curr;?>" class="xls_btn"> XLS </a>
				<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/tshirts/?curr=<?php echo $curr;?>" class="paf_dowload"> PDF </a>
				
					<div id="freezer-Table" style="margin:0">
						<table id="tshirtsTable" class="table table-striped table-condensed table-freeze-multi table-bordered" data-scroll-height="600"data-cols-number="1" style="border-collapse: initial;">
							<colgroup>
							  <col style="width: 150px;">
							  <col style="width: 150px;">
							  <col style="width: 150px;">
							  <col style="width: 150px;">
							  <col>
							  <col>
							  <col>
							  <col>
							  <col>
							  <col>
							  <col>
							  <col>
							  <col>
							  <col>
							  <col>
							  <col>
							  <col>
							  <!--<col>
							  <col>
							  <col>-->
							</colgroup>
							<thead>
							<?php foreach ($getHeader as $key_header => $value_header) { ?>
								<tr>
									<th class="bg-blue-light pre text-center"><?php echo $value_header['r1c1']; ?></th>
									<th class="bg-blue-light pre text-center" ><?php echo $value_header['r1c2']; ?></th>
									<th class="bg-blue-light pre text-center"><?php echo $value_header['r1c3']; ?></th>
									<th class="bg-blue-light pre text-center" style=""><?php echo $value_header['r1c4']; ?></th>
									<!--<th class="bg-usd text-center pre" ><?php //echo $value_header['r1c5']; ?></th>-->
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c6']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c7']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c8']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c9']; ?></th>
									<!--<th class="bg-cad text-center pre" ><?php //echo $value_header['r1c10']; ?></th>-->
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c11']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c12']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c13']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c14']; ?></th>
									<!--<th class="bg-usd text-center pre" ><?php //echo $value_header['r1c15']; ?></th>-->
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c16']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c17']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c18']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c19']; ?></th>
									<th class="bg-price text-center pre" ><?php echo $value_header['r1c20']; ?></th>
								</tr>
								<tr>
									<th class="bg-blue-light text-center nowrap"><?php echo $value_header['r2c1']; ?></th>
									<th class="bg-blue-light pre text-center" colspan="3"><?php echo $value_header['r2c2']; ?></th>
									
									<th class="bg-usd text-center" colspan="13"><?php echo $curr_name; ?></th>
								</tr>
								<tr>
									<th class="bg-blue  text-center pre" colspan="4" style="text-align: left;"><?php echo $value_header['r3c1_2']; ?></th>
									<!--<th class="bg-usd text-center pre" ><?php //echo $value_header['r3c5']; ?></th>-->
									<th class="bg-cad text-center pre" ><?php echo $value_header['r3c6']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c7']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r3c8']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c9']; ?></th>
									
									<!--<th class="bg-cad text-center pre" ><?php //echo $value_header['r3c10']; ?></th>-->
									<th class="bg-cad text-center pre" ><?php echo $value_header['r3c11']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c12']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r3c13']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c14']; ?></th>
									
									<!--<th class="bg-usd text-center pre" ><?php //echo $value_header['r3c15']; ?></th>-->
									<th class="bg-cad text-center pre" ><?php echo $value_header['r3c16']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c17']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r3c18']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c19']; ?></th>
									<th class="bg-price text-center pre" ><?php echo $value_header['r3c20']; ?></th>
								</tr>
							<?php } ?>	
							</thead>
							<tbody >
								
								<?php
									foreach ($gettshirts as $key => $value) {

										$suffix_field = "";
										if($curr!=0){ $suffix_field = $curr; }

										$sql_addi = "SELECT *,addi_value".$suffix_field." AS show_addi_val FROM tbl_additional WHERE product_type='tshirts' AND pro_id='".$value['id']."' ORDER BY ordering ASC";
										$rs_addi = Yii::app()->db->createCommand($sql_addi)->queryAll();

										$show_addi_info = "";

										$use_pre_curr = "$";
										if($curr==4){ $use_pre_curr = "฿"; }

										foreach($rs_addi as $tmp_key => $row_addi){
											if($row_addi["show_addi_val"]!=0){
												$show_addi_info .= $row_addi["addi_name"]." ".$use_pre_curr.$row_addi["show_addi_val"]."\n";
											}
											
										}
								?>
								<tr>
									<td style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;">
										<div id="prod_name<?php echo $value['id'];?>"><?php echo $value['category']; ?></div>	
										<hr style="padding: 5px; margin: 5px;">
										<center>
											<button class="btn btn-primary" data-toggle="modal" data-target="#manageAdditional" onclick="return getAdditional(<?php echo $value['id'];?>,'tshirts');">
												<i class="fa fa-plus-square"></i>
											</button>
										</center>		
									</td>
									<td style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;">
										<span id="prod_desc<?php echo $value['id'];?>" style="line-height: 1.4; font-size: 15px;"><?php echo $value['fabric_options']; ?></span>
										<?php if($show_addi_info!=""){ ?><i class="fa fa-eye" aria-hidden="true" title="<?php echo $show_addi_info; ?>"></i><?php } ?>
									</td>
									<td style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;"><?php echo $value['style']; ?></td>
									<td style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;"><?php echo $value['notes']; ?></td>
									<td class="text-center nowrap bg-cad" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$qty2= $value['qty2'];
					                				break;
					                			case 1:
					                				$qty2= $value['qty2_1'];
					                				break;
					                			case 2:
					                				$qty2= $value['qty2_2'];
					                				break;
					                			case 3:
					                				$qty2= $value['qty2_3'];
					                				break;
					                			case 4:
					                				$qty2= $value['qty2_4'];
					                				break;
					                			case 5:
					                				$qty2= $value['qty2_5'];
					                				break;
					                		}
					                		$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c6']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c6']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tshirts',".$value['id'].",'".$qty2."','".$show_qty."','".$value_header['r3c6']."'"; ?>);">
											<?php if($qty2!=0){echo $qty2.' +';} ?>
										</div>
									</td>
									<td class="text-center nowrap bg-usd" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$qty3= $value['qty3'];
					                				break;
					                			case 1:
					                				$qty3= $value['qty3_1'];
					                				break;
					                			case 2:
					                				$qty3= $value['qty3_2'];
					                				break;
					                			case 3:
					                				$qty3= $value['qty3_3'];
					                				break;
					                			case 4:
					                				$qty3= $value['qty3_4'];
					                				break;
					                			case 5:
					                				$qty3= $value['qty3_5'];
					                				break;
					                		}
					                		$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c7']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c7']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tshirts',".$value['id'].",'".$qty3."','".$show_qty."','".$value_header['r3c7']."'"; ?>);">
											<?php if($qty3!=0){echo $qty3.' +';} ?>
										</div>
									</td>
									<td class="text-center nowrap bg-cad" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$qty4= $value['qty4'];
					                				break;
					                			case 1:
					                				$qty4= $value['qty4_1'];
					                				break;
					                			case 2:
					                				$qty4= $value['qty4_2'];
					                				break;
					                			case 3:
					                				$qty4= $value['qty4_3'];
					                				break;
					                			case 4:
					                				$qty4= $value['qty4_4'];
					                				break;
					                			case 5:
					                				$qty4= $value['qty4_5'];
					                				break;
					                		}
					                		$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c8']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c8']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tshirts',".$value['id'].",'".$qty4."','".$show_qty."','".$value_header['r3c8']."'"; ?>);">
											<?php if($qty4!=0){echo $qty4.' +';} ?>
										</div>
									</td>
									<td class="text-center nowrap bg-usd" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$qty5= $value['qty5'];
					                				break;
					                			case 1:
					                				$qty5= $value['qty5_1'];
					                				break;
					                			case 2:
					                				$qty5= $value['qty5_2'];
					                				break;
					                			case 3:
					                				$qty5= $value['qty5_3'];
					                				break;
					                			case 4:
					                				$qty5= $value['qty5_4'];
					                				break;
					                			case 5:
					                				$qty5= $value['qty5_5'];
					                				break;
					                		}
					                		$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c9']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c9']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tshirts',".$value['id'].",'".$qty5."','".$show_qty."','".$value_header['r3c9']."'"; ?>);">
											<?php if($qty5!=0){echo $qty5.' +';} ?>
										</div>
									</td>
									<!--<td class="text-center nowrap bg-cad" style="vertical-align: middle;"><?php //echo Helper::usFormat($value['qty6']." +"); ?></td>-->
									<td class="text-center nowrap bg-cad" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$qty7= $value['qty7'];
					                				break;
					                			case 1:
					                				$qty7= $value['qty7_1'];
					                				break;
					                			case 2:
					                				$qty7= $value['qty7_2'];
					                				break;
					                			case 3:
					                				$qty7= $value['qty7_3'];
					                				break;
					                			case 4:
					                				$qty7= $value['qty7_4'];
					                				break;
					                			case 5:
					                				$qty7= $value['qty7_5'];
					                				break;
					                		}
					                		$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c11']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c11']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tshirts',".$value['id'].",'".$qty7."','".$show_qty."','".$value_header['r3c11']."'"; ?>);">
											<?php if($qty7!=0){echo $qty7.' +';} ?>
										</div>
									</td>
									<td class="text-center nowrap bg-usd" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$qty8= $value['qty8'];
					                				break;
					                			case 1:
					                				$qty8= $value['qty8_1'];
					                				break;
					                			case 2:
					                				$qty8= $value['qty8_2'];
					                				break;
					                			case 3:
					                				$qty8= $value['qty8_3'];
					                				break;
					                			case 4:
					                				$qty8= $value['qty8_4'];
					                				break;
					                			case 5:
					                				$qty8= $value['qty8_5'];
					                				break;
					                		}
					                		$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c12']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c12']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tshirts',".$value['id'].",'".$qty8."','".$show_qty."','".$value_header['r3c12']."'"; ?>);">
											<?php if($qty8!=0){echo $qty8.' +';} ?>
										</div>
									</td>
									<td class="text-center nowrap bg-cad" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$qty9= $value['qty9'];
					                				break;
					                			case 1:
					                				$qty9= $value['qty9_1'];
					                				break;
					                			case 2:
					                				$qty9= $value['qty9_2'];
					                				break;
					                			case 3:
					                				$qty9= $value['qty9_3'];
					                				break;
					                			case 4:
					                				$qty9= $value['qty9_4'];
					                				break;
					                			case 5:
					                				$qty9= $value['qty9_5'];
					                				break;
					                		}
					                		$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c13']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c13']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tshirts',".$value['id'].",'".$qty9."','".$show_qty."','".$value_header['r3c13']."'"; ?>);">
											<?php if($qty9!=0){echo $qty9.' +';} ?>
										</div>
									</td>
									<td class="text-center nowrap bg-usd" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$qty10= $value['qty10'];
					                				break;
					                			case 1:
					                				$qty10= $value['qty10_1'];
					                				break;
					                			case 2:
					                				$qty10= $value['qty10_2'];
					                				break;
					                			case 3:
					                				$qty10= $value['qty10_3'];
					                				break;
					                			case 4:
					                				$qty10= $value['qty10_4'];
					                				break;
					                			case 5:
					                				$qty10= $value['qty10_5'];
					                				break;
					                		}
					                		$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c14']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c14']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tshirts',".$value['id'].",'".$qty10."','".$show_qty."','".$value_header['r3c14']."'"; ?>);">
											<?php if($qty10!=0){echo $qty10.' +';} ?>
										</div>
									</td>
									<!--<td class="text-center nowrap bg-usd" style="vertical-align: middle;"><?php //echo Helper::usFormat($value['qty11']." +"); ?></td>-->
									<td class="text-center nowrap bg-cad" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$qty12= $value['qty12'];
					                				break;
					                			case 1:
					                				$qty12= $value['qty12_1'];
					                				break;
					                			case 2:
					                				$qty12= $value['qty12_2'];
					                				break;
					                			case 3:
					                				$qty12= $value['qty12_3'];
					                				break;
					                			case 4:
					                				$qty12= $value['qty12_4'];
					                				break;
					                			case 5:
					                				$qty12= $value['qty12_5'];
					                				break;
					                		}
					                		$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c16']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c16']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tshirts',".$value['id'].",'".$qty12."','".$show_qty."','".$value_header['r3c16']."'"; ?>);">
											<?php if($qty12!=0){echo $qty12.' +';} ?>
										</div>
									</td>
									<td class="text-center nowrap bg-usd" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$qty13= $value['qty13'];
					                				break;
					                			case 1:
					                				$qty13= $value['qty13_1'];
					                				break;
					                			case 2:
					                				$qty13= $value['qty13_2'];
					                				break;
					                			case 3:
					                				$qty13= $value['qty13_3'];
					                				break;
					                			case 4:
					                				$qty13= $value['qty13_4'];
					                				break;
					                			case 5:
					                				$qty13= $value['qty13_5'];
					                				break;
					                		}
					                		$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c17']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c17']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tshirts',".$value['id'].",'".$qty13."','".$show_qty."','".$value_header['r3c17']."'"; ?>);">
											<?php if($qty13!=0){echo $qty13.' +';} ?>
										</div>
									</td>
									<td class="text-center nowrap bg-cad" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$qty14= $value['qty14'];
					                				break;
					                			case 1:
					                				$qty14= $value['qty14_1'];
					                				break;
					                			case 2:
					                				$qty14= $value['qty14_2'];
					                				break;
					                			case 3:
					                				$qty14= $value['qty14_3'];
					                				break;
					                			case 4:
					                				$qty14= $value['qty14_4'];
					                				break;
					                			case 5:
					                				$qty14= $value['qty14_5'];
					                				break;
					                		}
					                		$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c18']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c18']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tshirts',".$value['id'].",'".$qty14."','".$show_qty."','".$value_header['r3c18']."'"; ?>);">
											<?php if($qty14!=0){echo $qty14.' +';} ?>
										</div>
									</td>
									<td class="text-center nowrap bg-usd" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$qty15= $value['qty15'];
					                				break;
					                			case 1:
					                				$qty15= $value['qty15_1'];
					                				break;
					                			case 2:
					                				$qty15= $value['qty15_2'];
					                				break;
					                			case 3:
					                				$qty15= $value['qty15_3'];
					                				break;
					                			case 4:
					                				$qty15= $value['qty15_4'];
					                				break;
					                			case 5:
					                				$qty15= $value['qty15_5'];
					                				break;
					                		}
					                		$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c19']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c19']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tshirts',".$value['id'].",'".$qty15."','".$show_qty."','".$value_header['r3c19']."'"; ?>);">
											<?php if($qty15!=0){echo $qty15.' +';} ?>
										</div>
									</td>
									<td class="text-center nowrap bg-price" style="vertical-align: middle;font-weight: bold;">
										<?php 
											switch ($curr) {
					                			case 0:
					                				$msrp= $value['msrp'];
					                				break;
					                			case 1:
					                				$msrp= $value['msrp_1'];
					                				break;
					                			case 2:
					                				$msrp= $value['msrp_2'];
					                				break;
					                			case 3:
					                				$msrp= $value['msrp_3'];
					                				break;
					                			case 4:
					                				$msrp= $value['msrp_4'];
					                				break;
					                			case 5:
					                				$msrp= $value['msrp_5'];
					                				break;
					                		}
					                		$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c20']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c20']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tshirts',".$value['id'].",'".$msrp."','".$show_qty."','".$value_header['r3c20']."'"; ?>);">
											<?php if($msrp!=0){echo $msrp.' +';} ?>
										</div>
									</td>
								</tr>
								<?php
									}
								?>
						
							</tbody>
						</table>
					</div>
				<br>
				<br>
				<br>
				<table id="notesTable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="bg-blue-light" colspan="2">Notes</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo nl2br($notes['notes']); ?></td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
	</div>	
</div>	
