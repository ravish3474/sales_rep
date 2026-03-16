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

<div class="row" id="tracksuits">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2><?php echo $toppic['details']; ?></h2>
				<div class="clearfix"></div>
			</div>
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
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/tracksuits/v/Sales_Dealers/?curr=0">USD North America</option>';
                				$curr_name='USD North America';
                				break;
                			case 1:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/tracksuits/v/Sales_Dealers/?curr=1">CAD North America</option>';
                				$curr_name='CAD North America';
                				break;
                			case 2:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/tracksuits/v/Sales_Dealers/?curr=2">USD Europe and South America</option>';
                				$curr_name='USD Europe and South America';
                				break;
                			case 3:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/tracksuits/v/Sales_Dealers/?curr=3">USD ASIA and Australia</option>';
                				$curr_name='USD ASIA and Australia';
                				break;
                			case 4:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/tracksuits/v/Sales_Dealers/?curr=4">THB Thai Baht</option>';
                				$curr_name='THB Thai Baht';
                				break;
                			case 5:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/tracksuits/v/Sales_Dealers/?curr=5">SGD Singapore</option>';
                				$curr_name='SGD Singapore';
                				break;
                		}
                		echo $btn;
                	?>
                	<option value=""><b>Select Currency</b></option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/tracksuits/v/Sales_Dealers/?curr=0">USD North America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/tracksuits/v/Sales_Dealers/?curr=1">CAD North America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/tracksuits/v/Sales_Dealers/?curr=2">USD Europe and South America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/tracksuits/v/Sales_Dealers/?curr=3">USD ASIA and Australia</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/tracksuits/v/Sales_Dealers/?curr=4">THB Thai Baht</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/tracksuits/v/Sales_Dealers/?curr=5">SGD Singapore</option>
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
                <a href="<?php echo Yii::app()->baseUrl; ?>/pdf/dtracksuitsXLS/?curr=<?php echo $curr;?>" class="xls_btn"> XLS </a>
				<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/dtracksuits/?curr=<?php echo $curr;?>" class="paf_dowload"> PDF </a>
				
				<div id="freezer-Table" style="margin:0">
					<table id="tracksuitsTable" class="table table-striped table-condensed table-freeze-multi table-bordered" data-scroll-height="600"data-cols-number="1" style="border-collapse: initial;">
						<colgroup>
							<col style="width: 150px;">
							<col style="width: 150px;">
							<col style="width: 150px;">
							<col style="width: 150px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
							<col style="width: 100px;">
						 
						</colgroup>
						<thead>
							<?php foreach ($getDheader as $key_header => $value_header) { ?>
								<tr>
									<th class="bg-blue-light text-center" rowspan="2"> <?php echo $value_header['r1c1']; ?> </th>
									<th class="bg-blue-light pre text-center" rowspan="2"> <?php echo $value_header['r1c2']; ?> </th>
									<th class="bg-blue-light pre text-center"rowspan="2"> <?php echo $value_header['r1c3']; ?> </th>
									<th class="bg-blue-light pre text-center" rowspan="2" style=""> <?php echo $value_header['r1c4']; ?> </th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c5']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c6']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c7']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c8']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c9']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c10']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c11']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c12']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c13']; ?></th>
									<th class="bg-price text-center pre" ><?php echo $value_header['r1c14']; ?></th>
								</tr>
								<tr>
									<th class="bg-usd text-center" colspan="10"><?php echo $curr_name; ?></th>
									<!--<th class="bg-usd text-center pre" ><?php echo $value_header['r2c5']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r2c6']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r2c7']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r2c8']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r2c9']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r2c10']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r2c11']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r2c12']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r2c13']; ?></th>
									<th class="bg-price text-center pre" ><?php echo $value_header['r2c14']; ?></th>-->
								</tr>
								<tr>
									<th class="bg-blue text-center pre" colspan="4" style="text-align: left;"><?php echo $value_header['r3c1_2']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c5']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r3c6']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c7']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r3c8']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c9']; ?></th>
									
									<th class="bg-cad text-center pre" ><?php echo $value_header['r3c10']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c11']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r3c12']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r3c13']; ?></th>
									<th class="bg-price text-center pre" ><?php echo $value_header['r3c14']; ?></th>
									
								</tr>
							<?php } ?>	
						</thead>
						<tbody>
							<?php
								foreach ($tracksuits as $key => $value) {

									$suffix_field = "";
									if($curr!=0){ $suffix_field = $curr; }

									$sql_addi = "SELECT *,addi_value".$suffix_field." AS show_addi_val FROM tbl_additional WHERE product_type='tracksuits' AND pro_id='".$value['id']."' ORDER BY ordering ASC";
									$rs_addi = Yii::app()->db->createCommand($sql_addi)->queryAll();

									$show_addi_info = "";

									$use_pre_curr = "$";
									if($curr==4){ $use_pre_curr = "฿"; }

									foreach($rs_addi as $tmp_key => $row_addi){
										if($row_addi["show_addi_val"]!=0){
											$show_addi_info .= "<br>".$row_addi["addi_name"]." ".$use_pre_curr.$row_addi["show_addi_val"];
										}
										
									}
							?>
							<tr>
								<td style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;"><?php echo $value['category']; ?></td>
								<td style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;"><?php echo nl2br($value['discription']).$show_addi_info; ?></td>
								<td style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;"><?php echo $value['style']; ?></td>
								<td style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;"><?php echo $value['notes']; ?></td>
								<td class=" nowrap bg-usd" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$d_qty1= $value['d_qty1'];
					                			break;
					                		case 1:
					                			$d_qty1= $value['d_qty1_1'];
					                			break;
					                		case 2:
					                			$d_qty1= $value['d_qty1_2'];
					                			break;
					                		case 3:
					                			$d_qty1= $value['d_qty1_3'];
					                			break;
					                		case 4:
					                			$d_qty1= $value['d_qty1_4'];
					                			break;
					                		case 5:
					                			$d_qty1= $value['d_qty1_5'];
					                			break;
					                	}
					                	
					                	$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c5']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c5']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tracksuits',".$value['id'].",'".$d_qty1."','".$show_qty."','".$value_header['r3c5']."'"; ?>);">
											<?php if($d_qty1!=0){echo $d_qty1.' +';} ?>
										</div>
								</td>
								<td class=" nowrap bg-cad" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$d_qty2= $value['d_qty2'];
					                			break;
					                		case 1:
					                			$d_qty2= $value['d_qty2_1'];
					                			break;
					                		case 2:
					                			$d_qty2= $value['d_qty2_2'];
					                			break;
					                		case 3:
					                			$d_qty2= $value['d_qty2_3'];
					                			break;
					                		case 4:
					                			$d_qty2= $value['d_qty2_4'];
					                			break;
					                		case 5:
					                			$d_qty2= $value['d_qty2_5'];
					                			break;
					                	}
					                	
					                	$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c6']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c6']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tracksuits',".$value['id'].",'".$d_qty2."','".$show_qty."','".$value_header['r3c6']."'"; ?>);">
											<?php if($d_qty2!=0){echo $d_qty2.' +';} ?>
										</div>
								</td>
								<td class=" nowrap bg-usd" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$d_qty3= $value['d_qty3'];
					                			break;
					                		case 1:
					                			$d_qty3= $value['d_qty3_1'];
					                			break;
					                		case 2:
					                			$d_qty3= $value['d_qty3_2'];
					                			break;
					                		case 3:
					                			$d_qty3= $value['d_qty3_3'];
					                			break;
					                		case 4:
					                			$d_qty3= $value['d_qty3_4'];
					                			break;
					                		case 5:
					                			$d_qty3= $value['d_qty3_5'];
					                			break;
					                	}
					                	
					                	$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c7']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c7']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tracksuits',".$value['id'].",'".$d_qty3."','".$show_qty."','".$value_header['r3c7']."'"; ?>);">
											<?php if($d_qty3!=0){echo $d_qty3.' +';} ?>
										</div>
								</td>
								<td class=" nowrap bg-cad" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$d_qty4= $value['d_qty4'];
					                			break;
					                		case 1:
					                			$d_qty4= $value['d_qty4_1'];
					                			break;
					                		case 2:
					                			$d_qty4= $value['d_qty4_2'];
					                			break;
					                		case 3:
					                			$d_qty4= $value['d_qty4_3'];
					                			break;
					                		case 4:
					                			$d_qty4= $value['d_qty4_4'];
					                			break;
					                		case 5:
					                			$d_qty4= $value['d_qty4_5'];
					                			break;
					                	}
					                	
					                	$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c8']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c8']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tracksuits',".$value['id'].",'".$d_qty4."','".$show_qty."','".$value_header['r3c8']."'"; ?>);">
											<?php if($d_qty4!=0){echo $d_qty4.' +';} ?>
										</div>
								</td>
								<td class=" nowrap bg-usd" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$d_qty5= $value['d_qty5'];
					                			break;
					                		case 1:
					                			$d_qty5= $value['d_qty5_1'];
					                			break;
					                		case 2:
					                			$d_qty5= $value['d_qty5_2'];
					                			break;
					                		case 3:
					                			$d_qty5= $value['d_qty5_3'];
					                			break;
					                		case 4:
					                			$d_qty5= $value['d_qty5_4'];
					                			break;
					                		case 5:
					                			$d_qty5= $value['d_qty5_5'];
					                			break;
					                	}
					                	
					                	$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c9']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c9']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tracksuits',".$value['id'].",'".$d_qty5."','".$show_qty."','".$value_header['r3c9']."'"; ?>);">
											<?php if($d_qty5!=0){echo $d_qty5.' +';} ?>
										</div>
								</td>
								<td class=" nowrap bg-cad" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$d_qty6= $value['d_qty6'];
					                			break;
					                		case 1:
					                			$d_qty6= $value['d_qty6_1'];
					                			break;
					                		case 2:
					                			$d_qty6= $value['d_qty6_2'];
					                			break;
					                		case 3:
					                			$d_qty6= $value['d_qty6_3'];
					                			break;
					                		case 4:
					                			$d_qty6= $value['d_qty6_4'];
					                			break;
					                		case 5:
					                			$d_qty6= $value['d_qty6_5'];
					                			break;
					                	}
					                	
					                	$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c10']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c10']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tracksuits',".$value['id'].",'".$d_qty6."','".$show_qty."','".$value_header['r3c10']."'"; ?>);">
											<?php if($d_qty6!=0){echo $d_qty6.' +';} ?>
										</div>
								</td>
								<td class=" nowrap bg-usd" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$d_qty7= $value['d_qty7'];
					                			break;
					                		case 1:
					                			$d_qty7= $value['d_qty7_1'];
					                			break;
					                		case 2:
					                			$d_qty7= $value['d_qty7_2'];
					                			break;
					                		case 3:
					                			$d_qty7= $value['d_qty7_3'];
					                			break;
					                		case 4:
					                			$d_qty7= $value['d_qty7_4'];
					                			break;
					                		case 5:
					                			$d_qty7= $value['d_qty7_5'];
					                			break;
					                	}
					                	
					                	$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c11']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c11']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tracksuits',".$value['id'].",'".$d_qty7."','".$show_qty."','".$value_header['r3c11']."'"; ?>);">
											<?php if($d_qty7!=0){echo $d_qty7.' +';} ?>
										</div>
								</td>
								<td class=" nowrap bg-cad" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$d_qty8= $value['d_qty8'];
					                			break;
					                		case 1:
					                			$d_qty8= $value['d_qty8_1'];
					                			break;
					                		case 2:
					                			$d_qty8= $value['d_qty8_2'];
					                			break;
					                		case 3:
					                			$d_qty8= $value['d_qty8_3'];
					                			break;
					                		case 4:
					                			$d_qty8= $value['d_qty8_4'];
					                			break;
					                		case 5:
					                			$d_qty8= $value['d_qty8_5'];
					                			break;
					                	}
					                	
					                	$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c12']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c12']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tracksuits',".$value['id'].",'".$d_qty8."','".$show_qty."','".$value_header['r3c12']."'"; ?>);">
											<?php if($d_qty8!=0){echo $d_qty8.' +';} ?>
										</div>
								</td>
								<td class=" nowrap bg-usd" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$d_qty9= $value['d_qty9'];
					                			break;
					                		case 1:
					                			$d_qty9= $value['d_qty9_1'];
					                			break;
					                		case 2:
					                			$d_qty9= $value['d_qty9_2'];
					                			break;
					                		case 3:
					                			$d_qty9= $value['d_qty9_3'];
					                			break;
					                		case 4:
					                			$d_qty9= $value['d_qty9_4'];
					                			break;
					                		case 5:
					                			$d_qty9= $value['d_qty9_5'];
					                			break;
					                	}
					                	
					                	$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c13']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c13']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tracksuits',".$value['id'].",'".$d_qty9."','".$show_qty."','".$value_header['r3c13']."'"; ?>);">
											<?php if($d_qty9!=0){echo $d_qty9.' +';} ?>
										</div>
								</td>
								<td class=" nowrap bg-price" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$d_msrp= $value['d_msrp'];
					                			break;
					                		case 1:
					                			$d_msrp= $value['d_msrp_1'];
					                			break;
					                		case 2:
					                			$d_msrp= $value['d_msrp_2'];
					                			break;
					                		case 3:
					                			$d_msrp= $value['d_msrp_3'];
					                			break;
					                		case 4:
					                			$d_msrp= $value['d_msrp_4'];
					                			break;
					                		case 5:
					                			$d_msrp= $value['d_msrp_5'];
					                			break;
					                	}
					                	
					                	$tmp_qty = preg_split('/\r\n|\r|\n/', $value_header['r1c14']);
					                		if(sizeof($tmp_qty)>1){ $show_qty = $tmp_qty[1]; }else{ $show_qty = $value_header['r1c14']; }

										?>
										<div class="add-to-cart" onclick="return addToCart(<?php echo "'tracksuits',".$value['id'].",'".$d_msrp."','".$show_qty."','".$value_header['r3c14']."'"; ?>);">
											<?php if($d_msrp!=0){echo $d_msrp.' +';} ?>
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
