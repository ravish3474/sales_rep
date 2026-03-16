<style>
	#parent {
		height: Auto; 
		width: 100%;
	}
	
		
	#calculatorHeaderTable {
		width: 100% !important;
	}
	
	#freezer-Table .table tbody td {
		outline: 1px solid #ddd;
	}
	.bg-usd, .bg-cad, .bg-price{
		text-align: center;
		vertical-align: middle;
	}
	.pre {
		white-space: pre;
	}
</style>

<div class="row" id="calculator">
	<div class="row mt-20">
		<div class="col-md-12">
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/SalesOrdersAll" class="link"  >
				<i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Go Back
			</a>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div>
					<?php if(Yii::app()->user->getState('userGroup') == 99 || Yii::app()->user->getState('userGroup') == 1){ ?>
						<h2> <?php echo "Sales Orders - ".$sales; ?> </h2>
					<?php } ?>
					
				
					<!--<a href="<?php //echo Yii::app()->baseUrl; ?>/pdf/commissionSale/year/<?php //echo $year_commission;?>/sale/<?php //echo $sales_commission; ?>" class="paf_dowload" target="_blank"> PDF (ALL)</a>-->
				</div>
				<br>
				<div >
				<?php 
					if(!empty($datedata)){
						if($datedata != "0000-00-00" ){ 
								
							$_month_name = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
																			 
										
							list($year,$momth,$day) = explode("-",$datedata);
																
							if ($day < 10){
								$day = substr($day,1,2);
							}
										
							$date = $_month_name[$momth]." ".$day.",  ".$year;
						}else{
							$date = " ";
						}	
						
						echo "<span style=\"color:red;font-size:12px;\">(Last Update! : ".$date.")</span>";
					}
				?> 
				</div>	

					<div style="margin-bottom:10px;">
						<div class="btn-add">
							<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addData"><i class="fa fa-plus"></i> Add</a>
						</div>
					</div>
					<br>
					
					<div style="margin:0">
						<table id="salesOrders" class="table table-striped table-bordered table-condensed "  >
							<thead>
								<tr>
									<th class="bg-blue-light text-center" style="width:50px;">  </th>
									<th class="bg-blue-light text-center" > Date Order</th>
									<th class="bg-blue-light text-center" > Order No. </th>
									<th class="bg-blue-light text-center" > Order Name </th>
									<th class="bg-blue-light text-center" > Commission% (1)</th>
									<th class="bg-blue-light text-center" > Commission% (2)</th>
									<th class="bg-blue-light text-center" > Remark </th>
									
									<th class="bg-blue-light text-center" > Last Update </th>
								</tr>
							</thead>
							<tbody>
							<?php
									//$num = 1;
									foreach ($litedata as $key => $value) {
										
								?>
								<tr style="background: #ffffff;">

									
									<td class="tbl-btn-box nowrap"  style="vertical-align: middle;">
											<button class="btn btn-success uu" data-toggle="modal" data-target="#editData" data-id="<?php echo $value['id'];?>">
												<i class="fa fa-pencil"></i>
											</button>
											<button class="btn btn-danger confirm" del-id="<?php echo $value['id'];?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/DeleteSalesOrders">
												<i class="fa fa-close"></i>
											</button>
									</td>
									
									<td class="nowrap" style="vertical-align: middle;text-align:center;"> 
										<?php 
										
											if($value['date_saleorder'] != "0000-00-00" ){ 
											
												list($year_sales,$momth_sales,$day_sales) = explode("-",$value['date_saleorder']);
																
												if ($day_sales < 10){
													$day_sales = substr($day_sales,1,2);
												}
															
												$date_sales = $_month_name[$momth_sales]." ".$day_sales.",  ".$year_sales;
											}else{
												$date_sales = " ";
											}	
										?> 
										<span ><?php echo $date_sales; ?> </span> 
									
									</td>
									<td class="text-left " style="vertical-align: middle;text-align:left;" > 
									<div class="col-md-12" style="vertical-align: middle;" >
									<?php 
										echo $value['order_no'];
									?>
									</div>
									</td>
									<td class="" style="vertical-align: middle;text-align:left;">
										
										  <?php echo nl2br($value['order_name']);?> 
										
									</td>

									<td class="text-center nowrap" style="vertical-align: middle;">
										<?php  echo $value['commission_percent']."%"; ?>
									</td>
									<td class="text-center nowrap" style="vertical-align: middle;">
										<?php  echo $value['commission_percent2']."%"; ?>
									</td>
									<td class="text-center" style="word-wrap:break-word;vertical-align: middle;">  
									
										<?php  echo $value['remark']; ?>	
									
									</td>
									
									<td class="text-center" style="word-wrap:break-word;vertical-align: middle;">  
									<?php 	
										if($value['date_update'] != "0000-00-00" ){ 
											$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																													 
											list($year,$momth,$day) = explode("-",$value['date_update']);
																										
											if ($day < 10){
												$day = substr($day,1,2);
											}
																				
											$date = $_month_name[$momth]." ".$day.",  ".$year;
									?>								
											<span style="font-size:12px;"><?php echo $date; ?></span>
									<?php							
										}else{
											$date = " ";
									?>								
											<span style="font-size:12px;"><?php echo $date; ?></span>
									<?php
										}	
									?> 
									</td>
									
								</tr>
									<?php 
										//$num++;
										} 
									?>
							</tbody>
						</table>
					</div>
			</div>
		</div>

	</div>	
</div>	

<div class="modal fade" id="addData" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="flex-header modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Sales Orders - Add</h4>
			</div>
			<div class="modal-body">
				<?php echo $this->renderPartial('/calculator/addSaleOrders');  ?>
			</div>
							
		</div>
	</div>
</div>
				
<div class="modal fade" id="editData" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Sales Orders- Edit</h4>
			</div>
			<div class="modal-body">
			
                <?php echo $this->renderPartial('/calculator/editSaleOrders');  ?>
			</div>
			
		</div>
	</div>
</div>				
