<style>
.bg-usd, .bg-cad, .bg-price{
	text-align: center;
	vertical-align: middle;
}
.pre {
	white-space: pre;
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

<div class="row" id="polo">

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
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/polo/v/Dealers/?curr=0">USD North America</option>';
                				$curr_name='USD North America';
                				break;
                			case 1:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/polo/v/Dealers/?curr=1">CAD North America</option>';
                				$curr_name='CAD North America';
                				break;
                			case 2:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/polo/v/Dealers/?curr=2">USD Europe and South America</option>';
                				$curr_name='USD Europe and South America';
                				break;
                			case 3:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/polo/v/Dealers/?curr=3">USD ASIA and Australia</option>';
                				$curr_name='USD ASIA and Australia';
                				break;
                			case 4:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/polo/v/Dealers/?curr=4">THB Thai Baht</option>';
                				$curr_name='THB Thai Baht';
                				break;
                			case 5:
                				$btn= '<option value="'.Yii::app()->request->baseUrl.'/priceGuide/polo/v/Dealers/?curr=5">SGD Singapore</option>';
                				$curr_name='SGD Singapore';
                				break;
                		}
                		echo $btn;
                	?>
                	<option value=""><b>Select Currency</b></option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/polo/v/Dealers/?curr=0">USD North America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/polo/v/Dealers/?curr=1">CAD North America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/polo/v/Dealers/?curr=2">USD Europe and South America</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/polo/v/Dealers/?curr=3">USD ASIA and Australia</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/polo/v/Dealers/?curr=4">THB Thai Baht</option>
                	<option value="<?php echo Yii::app()->request->baseUrl; ?>/priceGuide/polo/v/Dealers/?curr=5">SGD Singapore</option>
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
                <a href="<?php echo Yii::app()->baseUrl; ?>/pdf/dealersPoloXLS/?curr=<?php echo $curr;?>" class="xls_btn"> XLS </a>
				<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/dealersPolo/?curr=<?php echo $curr;?>" class="paf_dowload"> PDF </a>
				
				<div id="freezer-Table" style="margin:0">
						<table id="poloTable" class="table table-striped table-condensed table-freeze-multi table-bordered" data-scroll-height="600"data-cols-number="1" style="border-collapse: initial;">
							<colgroup>
								<col style="width: 270px;">
								<col style="width: 250px;">
								<col style="width: 200px;">
								<col style="width: 220px;">
								<col style="width: 150px;">
								<col style="width: 150px;">
								<col style="width: 150px;">
								<col style="width: 200px;">
							</colgroup>
							<thead>
								<?php foreach ($getDealersheader as $key_header => $value_header) { ?>
								<tr>
									<th class="bg-blue-light pre text-center"><?php echo $value_header['r1c1']; ?></th>
									<th class="bg-blue-light pre text-center" ><?php echo $value_header['r1c2']; ?></th>
									<th class="bg-blue-light pre text-center"><?php echo $value_header['r1c3']; ?></th>
									<th class="bg-blue-light pre text-center" style=""><?php echo $value_header['r1c4']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c5']; ?></th>
									<th class="bg-cad text-center pre" ><?php echo $value_header['r1c6']; ?></th>
									<th class="bg-usd text-center pre" ><?php echo $value_header['r1c7']; ?></th>
									<th class="bg-price text-center pre" ><?php echo $value_header['r1c8']; ?></th>
									
								</tr>
								<tr>
									<th class="bg-blue-light text-center nowrap"><?php echo $value_header['r2c1']; ?></th>
									<th class="bg-blue-light pre text-center" colspan="3"><?php echo $value_header['r2c2']; ?></th>
									
									<th class="bg-usd text-center" colspan="4"><?php echo $curr_name; ?></th>
								</tr>
								
							<?php } ?>	
								
							</thead>
							<tbody >
								
								<?php
									foreach ($getpolo as $key => $value) {
								?>
								<tr>
									<td style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;"><?php echo $value['category']; ?></td>
									<td style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;"><?php echo $value['fabric_options']; ?></td>
									<td style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;"><?php echo $value['style']; ?></td>
									<td style="word-wrap:break-word;vertical-align: middle;background-color: #fff;outline: 1px solid #ddd;text-align: left;"><?php echo $value['notes']; ?></td>
									<td class=" nowrap bg-usd" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$dealers_qty1= $value['dealers_qty1'];
					                			break;
					                		case 1:
					                			$dealers_qty1= $value['dealers_qty1_1'];
					                			break;
					                		case 2:
					                			$dealers_qty1= $value['dealers_qty1_2'];
					                			break;
					                		case 3:
					                			$dealers_qty1= $value['dealers_qty1_3'];
					                			break;
					                		case 4:
					                			$dealers_qty1= $value['dealers_qty1_4'];
					                			break;
					                		case 5:
					                			$dealers_qty1= $value['dealers_qty1_5'];
					                			break;
					                	}
					                	if($dealers_qty1!=0){echo $dealers_qty1.' +';}
									?>
								</td>
								<td class=" nowrap bg-cad" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$dealers_qty2= $value['dealers_qty2'];
					                			break;
					                		case 1:
					                			$dealers_qty2= $value['dealers_qty2_1'];
					                			break;
					                		case 2:
					                			$dealers_qty2= $value['dealers_qty2_2'];
					                			break;
					                		case 3:
					                			$dealers_qty2= $value['dealers_qty2_3'];
					                			break;
					                		case 4:
					                			$dealers_qty2= $value['dealers_qty2_4'];
					                			break;
					                		case 5:
					                			$dealers_qty2= $value['dealers_qty2_5'];
					                			break;
					                	}
					                	if($dealers_qty2!=0){echo $dealers_qty2.' +';}
									?>
								</td>
								<td class=" nowrap bg-usd" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$dealers_qty3= $value['dealers_qty3'];
					                			break;
					                		case 1:
					                			$dealers_qty3= $value['dealers_qty3_1'];
					                			break;
					                		case 2:
					                			$dealers_qty3= $value['dealers_qty3_2'];
					                			break;
					                		case 3:
					                			$dealers_qty3= $value['dealers_qty3_3'];
					                			break;
					                		case 4:
					                			$dealers_qty3= $value['dealers_qty3_4'];
					                			break;
					                		case 5:
					                			$dealers_qty3= $value['dealers_qty3_5'];
					                			break;
					                	}
					                	if($dealers_qty3!=0){echo $dealers_qty3.' +';}
									?>
								</td>
								<td class=" nowrap bg-price" style="vertical-align: middle;font-weight: bold;">
									<?php 
										switch ($curr) {
					                		case 0:
					                			$dealers_msrp= $value['dealers_msrp'];
					                			break;
					                		case 1:
					                			$dealers_msrp= $value['dealers_msrp_1'];
					                			break;
					                		case 2:
					                			$dealers_msrp= $value['dealers_msrp_2'];
					                			break;
					                		case 3:
					                			$dealers_msrp= $value['dealers_msrp_3'];
					                			break;
					                		case 4:
					                			$dealers_msrp= $value['dealers_msrp_4'];
					                			break;
					                		case 5:
					                			$dealers_msrp= $value['dealers_msrp_5'];
					                			break;
					                	}
					                	if($dealers_msrp!=0){echo $dealers_msrp.' +';}
									?>
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
