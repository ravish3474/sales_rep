<style>
	#parent {
		height: Auto; 
		width: 100%;
		max-height:600px;
	}
	
		
	#calculatorHeaderTable {
		width: 100% !important;
	}
	
	.bg-usd, .bg-cad, .bg-price{
		text-align: center;
		vertical-align: middle;
	}
	.pre {
		white-space: pre;
	}
	.text-left{
		text-align: left;
	}
	#freezer-Table .table tbody td {
		outline: 1px solid #ddd;
	}
</style>
<script>
			
	$(document).ready(function() {
		$("#calculatorHeaderTable").tableHeadFixer({"left" : 0}); 
		
	});
	
</script>
<div class="row" id="calculator">
	<div class="row mt-20">
		<div class="col-md-12">
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/ShowFiscalYearInvoice" class="link"  >
				<i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Go Back
			</a>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Invoice</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
			<h2> <?php echo $year_commission." Year"; ?> </h2>
			
			<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/invioceAll/year/<?php echo $year_commission;?>" class="paf_dowload" target="_blank"> PDF (ALL)</a>
			
			<div >
			<?php
				$getDate = Yii::app()->db->createCommand('select MAX(update_date) AS datedata  from calculator where 1 order by id DESC limit 1')->queryAll();
						
					foreach ($getDate as $key_date => $value_date) {
						$datedata = $value_date['datedata'];
					}
	
					if($datedata != "0000-00-00" ){ 
										
						$_month_name = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
																					 
						list($year,$momth,$day) = explode("-",$datedata);
																		
						if ($day < 10){
							$day = substr($day,1,2);
						}
												
						$date = $_month_name[$momth]." ".$day.",  ".$year;
						
					}else{
						$date = " - ";
					}
			?>
				<span style="color:red;font-size:12px;">Last Update! : <?php echo $date ?><span>
			</div>
			
					<?php if($sumtotalUSD != 0 || $sumtotalCAD != 0 || $sumtotalSGD != 0 || $sumtotalTHB != 0){ ?>
					<div id="parent">
						<table id="calculatorHeaderTable" class="table table-striped table-bordered" style="border-collapse: initial;">
							<thead>
								<tr>
								<?php	if($sumtotalUSD != 0 ){  ?>
									<th colspan="3" class="text-center" style="background-color: rgb(0, 65, 121);color:#fff;font-weight: 700;">
										<span> USD </span>
									</th>
								<?php	}
									if($sumtotalCAD != 0){  ?>			
									<th colspan="3" class="text-center" style="background-color:rgb(0, 65, 121);color:#fff;font-weight: 700;">
										<span> CAD </span>
									</th>
								<?php	}
									if($sumtotalSGD != 0){  ?>			
									<th colspan="3" class="text-center" style="background-color:rgb(0, 65, 121);color:#fff;font-weight: 700;">
										<span> SGD </span>
									</th>
								<?php	}
									if($sumtotalTHB != 0){  ?>	
									<th colspan="3" class="text-center" style="background-color:rgb(0, 65, 121);color:#fff;font-weight: 700;">
										<span> THB </span>
									</th>
								<?php	} ?>	
								</tr>
								<tr>
							<?php	if($sumtotalUSD != 0 ){  ?>
									<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Total Sales </th>
									<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Total commissions Earned </th>
									<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Balance </th>
							<?php	}
									if($sumtotalCAD != 0){  ?>		
									<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Total Sales </th>
									<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Total commissions Earned </th>
									<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Balance </th>
							<?php	}
									if($sumtotalSGD != 0){  ?>		
									<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Total Sales </th>
									<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Total commissions Earned </th>
									<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Balance </th>
							<?php	}
									if($sumtotalTHB != 0){  ?>
									<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Total Sales </th>
									<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Total commissions Earned </th>
									<th class="text-center" style="background-color: #012f5d;border: 1px solid #848d94 !important;color: #fff;"> Balance </th>
							<?php	} ?>				
								</tr>
							</thead>
							<tbody>
							
								<tr>
								<?php	if($sumtotalUSD != 0 ){  ?>
									<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
										<span><?php echo "$ ".number_format($sumtotalUSD , 2);?>  </span>
									</td>
									<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
										<span><?php echo "$ ".number_format($totalcommissionUSD , 2);?>  </span>									  
									</td>
									<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
										<?php if($commissionPaymentUSD == 0){	?>
											<span><?php echo "$ ".number_format($commissionPaymentUSD , 2);?></span>
										<?php }else{ ?>
											<span style="color:red;padding:5px 10px;"><?php echo "$ ".number_format($commissionPaymentUSD , 2);?></span>
										<?php } ?>
									</td>
								<?php	}
									if($sumtotalCAD != 0){  ?>			
									<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">  
										<span><?php echo "$ ".number_format($sumtotalCAD, 2);?></span>
									</td>
									<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">  
										<span><?php echo "$ ".number_format($totalcommissionCAD, 2);?></span>
									</td> 
									<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;"> 
										<?php if($commissionPaymentCAD == 0){	?>
											<span><?php echo "$ ".number_format($commissionPaymentCAD, 2);?></span>
										<?php }else{ ?>
											<span style="color:red;padding:5px 10px;"><?php echo "$ ".number_format($commissionPaymentCAD , 2);?></span>
										<?php } ?>
									</td>
								<?php	}
									if($sumtotalSGD != 0){  ?>
									<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
										<span><?php echo "$ ".number_format($sumtotalSGD , 2);?>  </span>
									</td>
									<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
										<span><?php echo "$ ".number_format($totalcommissionSGD , 2);?>  </span>									  
									</td>
									<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">
										
										<?php if($commissionPaymentSGD == 0){	?>
											<span><?php echo "$ ".number_format($commissionPaymentSGD , 2);?></span>
										<?php }else{ ?>
											<span style="color:red;padding:5px 10px;"><?php echo "$ ".number_format($commissionPaymentSGD , 2);?></span>
										<?php } ?>
									</td>
								<?php	}
									if($sumtotalTHB != 0){  ?>	
									<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">  
										<span><?php echo "฿ ".number_format($sumtotalTHB, 2);?></span>
									</td>
									<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;">  
										<span><?php echo "฿ ".number_format($totalcommissionTHB, 2);?></span>
									</td>
									<td class="text-center nowrap" style="background-color: #87c1fb;color: #001a33;border: 1px solid #848d94 !important;font-weight: 700;"> 
										<?php if($commissionPaymentTHB == 0){	?>
											<span><?php echo "฿ ".number_format($commissionPaymentTHB , 2);?></span>
										<?php }else{ ?>
											<span style="color:red;padding:5px 10px;"><?php echo "฿ ".number_format($commissionPaymentTHB , 2);?></span>
										<?php } ?>
									</td>
								<?php	} ?>	
								</tr>
								
							</tbody>
						</table>
					
				</div>
				
				<br>
					<hr style=" border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
					<br>	
					<?php } ?>
				<div class="col-md-12" >
					
				<form id="form_checkbox1" class="form-horizontal" action="<?php echo Yii::app()->request->baseUrl; ?>/calculator/SeachShowInvoice" method="post">
					<input type="hidden" name="sale_rep" value="<?php //echo $sales_commission; ?>">
					<input type="hidden" name="year_commission" value="<?php echo $year_commission; ?>">
					
						<h4 style="font-weight: 700;">SEARCH</h4>
							<div class="row" style="padding-top:10px;">
								<div class="col-md-2" style="text-align:right;">
									<span style="font-weight: 700;"> Invoice : </span>
									
								</div>
							
								<div class="col-md-4" >
									<?php $db_invoice = Yii::app()->db->createCommand('select invoice from calculator where invoice != "" order by invoice ASC')->queryAll(); ?>
									
									<select name="search_invoice"  class="form-control" >
										<option hidden></option>
									<?php foreach ($db_invoice as $key => $value) { ?>
										<option value="<?php echo $value['invoice'];?>" <?php if($search_invoice == $value['invoice']){ echo "selected"; } ?>># <?php echo $value['invoice'];?></option>
									<?php } ?>	
									</select>
									
								</div>
								<div class="col-md-1" style="text-align:center;font-size:18px;"> - </div>
								<div class="col-md-4" >
									<select name="search_invoice2"  class="form-control" >
										<option hidden></option>
									<?php foreach ($db_invoice as $key => $value) { ?>
										<option value="<?php echo $value['invoice'];?>" <?php if($search_invoice2 == $value['invoice']){ echo "selected"; } ?>># <?php echo $value['invoice'];?></option>
									<?php } ?>	
									</select>
								</div>
							</div>	
							
							<div class="row" style="padding-top:10px;">
								<div class="col-md-2" style="text-align:right;">
									<span style="font-weight: 700;"> Date Quarter : </span>
									
								</div>
							
								<div class="col-md-4" >
									<input type="text" name="search_dateQuarter"  class="form-control" id="search_dateQuarter" value="<?php if(!empty($search_dateQuarter)){ echo $search_dateQuarter; } ?>" style="float: left;">
								</div>
								<div class="col-md-1" style="text-align:center;font-size:18px;"> - </div>
								<div class="col-md-4" >
									<input type="text" name="search_dateQuarter2"  class="form-control" id="search_dateQuarter2" value="<?php if(!empty($search_dateQuarter2)){ echo $search_dateQuarter2; } ?>">
								</div>
							</div>	
							<div class="row" style="padding-top:10px;">
								<div class="col-md-2" style="text-align:right;" >
									<span style="font-weight: 700;"> Order No. : </span>
								</div>
							
								<div class="col-md-4" >
									<?php $db_orderno = Yii::app()->db->createCommand('select order_no from calculator where order_no != "" order by order_no ASC')->queryAll(); ?>
									
									<select name="search_orderno"  class="form-control" >
										<option hidden></option>
									<?php foreach ($db_orderno as $key => $value) { ?>
										<option value="<?php echo $value['order_no'];?>" <?php if($search_orderno == $value['order_no']){ echo "selected"; } ?>># <?php echo $value['order_no'];?></option>
									<?php } ?>	
									</select>
									
								</div>
								<div class="col-md-1" style="text-align:center;font-size:18px;"> - </div>
								<div class="col-md-4" >
									<select name="search_orderno2"  class="form-control" >
										<option hidden></option>
									<?php foreach ($db_orderno as $key => $value) { ?>
										<option value="<?php echo $value['order_no'];?>" <?php if($search_orderno2 == $value['order_no']){ echo "selected"; } ?>># <?php echo $value['order_no'];?></option>
									<?php } ?>	
									</select>
								</div>
							</div>	
							<div class="row" style="padding-top:10px;">
								<div class="col-md-2" style="text-align:right;">
									<span style="font-weight: 700;"> Order Name : </span>
								</div>
							
								<div class="col-md-9" >
									<input type="text" name="search_ordername"  class="form-control" value="<?php if(!empty($search_ordername)){ echo $search_ordername; } ?>">
								</div>
								
							</div>	
							
							<div class="row" style="padding-top:10px;">
								<div class="col-md-2" style="text-align:right;">
									<span style="font-weight: 700;"> Invoice Status: </span>
								</div>
							
								<div class="col-md-2" >
									<input class="invoice_status" type="checkbox" name="invoice_status" value="Paid" <?php if($invoice_status == "Paid"){ echo "checked"; } ?>> Paid
								</div>
								<div class="col-md-2" >
									<input class="invoice_status" type="checkbox" name="invoice_status" value="Outstanding" <?php if($invoice_status == "Outstanding"){ echo "checked"; } ?>> Outstanding
								</div>
								
							</div>	
							
							<div class="row" style="padding-top:10px;">
								<div class="col-md-2" style="text-align:right;">
									<span style="font-weight: 700;"> Aproved Status: </span>
								</div>
								<div class="col-md-2" >
									<input class="aproved_status" type="checkbox" name="aproved_status" value="Pending" <?php if($aproved_status == "Pending"){ echo "checked"; } ?>> Pending
								</div>
								<div class="col-md-2" >
									<input class="aproved_status" type="checkbox" name="aproved_status" value="Approved"  <?php if($aproved_status == "Approved"){ echo "checked"; } ?>> Approved
								</div>
								<div class="col-md-3" >
									<input class="aproved_status" type="checkbox" name="aproved_status" value="Not Approved" <?php if($aproved_status == "Not Approved"){ echo "checked"; } ?>> Not Approved
								</div>
								
								
							</div>	
							<div class="row" style="padding-top:10px;">
								<div class="col-md-2" style="text-align:right;">
									<span style="font-weight: 700;"> Commission Status: </span>
								</div>
							
								<div class="col-md-2" >
									<input class="commission_status" type="checkbox" name="commission_status" value="Paid"  <?php if($commission_status == "Paid"){ echo "checked"; } ?>> Paid
								</div>
								<div class="col-md-2" >
									<input class="commission_status" type="checkbox" name="commission_status" value="Outstanding" <?php if($commission_status == "Outstanding"){ echo "checked"; } ?>> Outstanding 
								</div>
							</div>	
							<div class="row" style="padding-top:30px;">
								<div class="col-md-12" style="text-align:center;">
									<input type="button" value="Clear" onclick="window.location.href='<?php echo Yii::app()->request->baseUrl; ?>/calculator/ShowInvoice/year/<?php echo $year_commission;?>'" />
									<input type="submit"  value="Submit">
								</div>

							</div>	
					</form>
					<script type="text/javascript">  
					$(function(){        
						   
						$(".invoice_status").click(function(){  // เมื่อคลิก checkbox  ใดๆ  
							if($(this).prop("checked")==true){ // ตรวจสอบ property  การ ของ   
								var indexObj=$(this).index(".invoice_status"); //   
								$(".invoice_status").not(":eq("+indexObj+")").prop( "checked", false ); // ยกเลิกการคลิก รายการอื่น  
							}  
						});  
						
						$(".aproved_status").click(function(){  // เมื่อคลิก checkbox  ใดๆ  
							if($(this).prop("checked")==true){ // ตรวจสอบ property  การ ของ   
								var indexObj=$(this).index(".aproved_status"); //   
								$(".aproved_status").not(":eq("+indexObj+")").prop( "checked", false ); // ยกเลิกการคลิก รายการอื่น  
							}  
						});  
						
						$(".commission_status").click(function(){  // เมื่อคลิก checkbox  ใดๆ  
							if($(this).prop("checked")==true){ // ตรวจสอบ property  การ ของ   
								var indexObj=$(this).index(".commission_status"); //   
								$(".commission_status").not(":eq("+indexObj+")").prop( "checked", false ); // ยกเลิกการคลิก รายการอื่น  
							}  
						});  
					 
						    
							   
					});  
					</script>  
					<br>
					<hr style=" border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
						
				</div>
				<div class="row mt-20" style="margin-left:5px;">						
					<div >
					
						<span>Commission Status : </span>
						<i class="fa fa-square" aria-hidden="true" style="color:green"> Approved </i>&nbsp; &nbsp; <i class="fa fa-square" aria-hidden="true" style="color:red"> Not Approved </i>&nbsp; &nbsp;<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"> Pending </i>
					</div>
					<div >
					
						<span>Invoice Status : </span>
						<i class="fa fa-square" aria-hidden="true" style="color:green"> Paid </i>&nbsp; &nbsp; <i class="fa fa-square" aria-hidden="true" style="color:red"> Outstanding </i>
					</div>
					<div >
						<span>Invoice Mailing Status : </span>
						<i class="fa fa-envelope" ></i> Sent </i>&nbsp;&nbsp;<i class="fa fa-envelope-o" ></i> Not Send </i>&nbsp;&nbsp;
					</div>
					<div >
						<span>Sales Responsible : </span>
						<i class="fa fa-user" aria-hidden="true"></i> Sales Manager (M) &nbsp;&nbsp; <i class="fa fa-user" aria-hidden="true"></i> Sales Rep (R) &nbsp;&nbsp; <i class="fa fa-user" aria-hidden="true"></i> Processor (P) 
					</div>
				</div>
				
			<br>	
	<?php 
		$currency_curr = array_unique ($currency);
		foreach($currency_curr as $curr){ 
					
			if( $curr == "USD"){ ?>
				<div style="margin-bottom:10px;">
					<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/invioceUSD/year/<?php echo $year_commission;?>" class="paf_dowload" target="_blank"> PDF (USD)</a>
				</div>
				<br>
				<div class="text-center" style="background-color:rgb(169, 185, 199);color:rgb(51, 67, 80);padding: 10px 0" > 
					<h4  style="font-weight: 700;"><?php echo  $curr;?>  </h4>
				</div>
				<div id="freezer-Table" style="margin:0">	
					<table id="calculatorUSDcomTable" class="table table-striped table-condensed table-freeze-multi table-bordered data_invoice " style="border-collapse: initial;"  data-scroll-max-height="600" data-cols-number="4">
						<colgroup>
							<col style="width:150px;">
							<col style="width:120px;">
							<col style="width:150px;">
							<col style="width:100px;">
							<col style="width:80px;">
							<col style="width:120px;">
							<col style="width:200px;">
							<col style="width:180px;">
							<col style="width:100px;">
							<col style="width:160px;">
							<col style="width:160px;">
							<col style="width:100px;">
							<col style="width:150px;">
							<col style="width:200px;">
							<col style="width:110px;">
						</colgroup>
						<thead>
							<tr>	
								<th colspan = "4" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Invoice </th>
								<th colspan = "2"  class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Invoice Payment Status </th>
								<th colspan = ""  class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Sales Responsible </th>
								<th colspan = "4"  class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Commission Calculator</th>
								
								<th colspan = "2"  class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Commission Payment Status </th>
								<th colspan = ""  class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Comment </th>
								<th colspan = ""  class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Update
								</th>
							</tr>
							<tr>
								
								<th class="bg-blue-light text-center" > Invoice # </th>
								<th class="bg-blue-light text-center" > Order No. </th>
								<th class="bg-blue-light text-center" > Order Name <br><span style="color:#fd6262;font-size:11px;">** Click Order Name ** <br> for Commission Calculator </span></th>
								<th class="bg-blue-light text-center" > Date/Quarter </th>
								
								<th class="bg-blue-light text-center" > Invoice Status</th>
								<th class="bg-blue-light text-center" > Amount Received</th>
								
								<th class="bg-blue-light text-center" > Sales Responsible </th>
								
								<th class="bg-blue-light text-center" > Total Sales </th>
								<th class="bg-blue-light text-center" > Commission% </th>
								<th class="bg-blue-light text-center" > Commission </th>
								<th class="bg-blue-light text-center" > Balance </th>
								
								<th class="bg-blue-light text-center" > Commission Status</th>
								<th class="bg-blue-light text-center" > Commission Payment</th>
								
								<th class="bg-blue-light text-center" > Comments </th>
								<th class="bg-blue-light text-center" > Last Update </th>
							</tr>
						</thead>
						<tbody>
						<?php
								foreach ($getData as $key => $value) {
									if($value['currency'] ==   $curr ){
							?>
							<tr style="background: #ffffff;">
								
								<td class="text-left nowrap" style="vertical-align: middle;text-align: left;" > 
									<?php if($value['file_path'] != "Array" && $value['file_path'] != ""){ ?>
									<a href="<?php echo Yii::app()->request->baseUrl; ?>/invoice/docs/<?php echo $value['file_path'];?>" target="_blank"> 
										<?php echo $value['invoice'];?> 
									</a>
									<?php }else{?>
										<span style="color:red;"> 
										<?php echo $value['invoice'];?> 
										</span> 
									<?php
									} ?>
									
									<?php if($value['invoice_mail_status'] == "Send"){ ?>
										&nbsp; <a href="#" data-toggle="modal" data-target="#editSendMail"  data-id="<?php echo $value['id'];?>" title="Send E-mail to Customer"><i class="fa fa-envelope"></i></a>
									<?php }else{ ?>
										&nbsp; <a  href="#" data-toggle="modal" data-target="#editSendMail"  data-id="<?php echo $value['id'];?>" title="Send E-mail to Customer"><i class="fa fa-envelope-o"></i></a>
									<?php }	?>
								</td>
								<td class="text-left " style="vertical-align: middle;text-align:left;" > 
									<div class="col-md-12" style="vertical-align: middle;" >
									<?php 
										$data_order_no = str_replace(" ", '<br />', $value['order_no']);
										echo $data_order_no;
									?>
									</div>
								</td>
								<td class="" style="vertical-align: middle;text-align:left;">
									
										<div class="col-md-1" style="vertical-align: middle;" >
										<?php 
											if($value['invoice_status'] == "Paid"){ ?>
											<i class="fa fa-square" aria-hidden="true" style="color:green;display: initial;"></i>&nbsp;
										<?php 		
											}elseif($value['invoice_status'] == "Outstanding"){ ?>
											
											<i class="fa fa-square" aria-hidden="true" style="color:red;display: initial;"></i>&nbsp;
										<?php }	?>
										</div>
										<div class="col-md-10" style="vertical-align: middle;"><?php echo nl2br($value['order_name']);?></div>
								</td>
								<?php  
									 $_month_name = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
										"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
										"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
										"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
									 
									 $vardate = $value['date_quarter'];
										list($year,$momth,$day) = explode("-",$vardate);
										$yy = $year;
										$mm = $momth;
										$dd = $day; 
									 
									if ($dd<10){
										$dd=substr($dd,1,2);
									}
									  $date= $_month_name[$mm]." ".$dd.",  ".$yy;
									  if($mm == "01" || $mm == "02" || $mm == "03"){
										  $quarter = "QTR 1";
									  }elseif($mm == "04" || $mm == "05" || $mm == "06"){
										  $quarter = "QTR 2";
									  }elseif($mm == "07" || $mm == "08" || $mm == "09"){
										  $quarter = "QTR 3";
									  }elseif($mm == "10" || $mm == "11" || $mm == "12"){
										  $quarter = "QTR 4";
									  }
									 //echo $date;
									?>
								<td class="text-center nowrap" style="vertical-align: middle;">  <?php echo $date."/<br>".$quarter;?> </td>
								<td class="text-center nowrap" style="vertical-align: middle;"> 
									<?php 
										if($value['invoice_status'] == "Outstanding"){
											echo "<span style=\"color:red\">".$value['invoice_status']."</span>";
										}else{
											echo "<span> ".$value['invoice_status']."</span>";
										}
									?> 
								
								</td>
									
								<td class="text-center nowrap" style="vertical-align: middle;"> 
									<?php 
										if($value['invoice_status'] == "Paid"){
											if($value['invoice_amount_received'] != 0){
												echo "<span > $ ".number_format($value['invoice_amount_received']  , 2)." ".$value['currency']."</span><br>";
												if($value['invoice_date'] != "0000-00-00"){
													 $_month_name_int = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
													"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
													"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
													"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
													 
													 $invoicedate = $value['invoice_date'];
													 
													 list($year_int,$momth_int,$day_int) = explode("-",$invoicedate);
													 
													 $yy_int = $year_int;
													 $mm_int = $momth_int;
													 $dd_int = $day_int; 
													if ($dd_int < 10){
														$dd_int = substr($dd_int,1,2);
													}
													  $date_int = $_month_name_int[$mm_int]." ".$dd_int.",  ".$yy_int;
													  
													echo "<span style=\"font-size:11px\">(Date : ".$date_int.")</span><br>";
												}
											}
										}
									?> 
								
								</td>
								<td class="text-left nowrap" style="text-align:left;"> 
								<?php 
									if(!empty($commission_status)){
										$getResponsible = Yii::app()->db->createCommand()
										->select('*')
										->from('calculator c')
										->where('c.invoice = "'.$value['invoice'].'"')
										->andwhere('c.commisson_payment_status = "'.$commission_status.'"')
										->order('c.sales_status ASC')
										->queryAll();
									}else{
										$getResponsible = Yii::app()->db->createCommand()
										->select('*')
										->from('calculator c')
										->where('c.invoice = "'.$value['invoice'].'"')
										->order('c.sales_status ASC')
										->queryAll();
									}
									
									
									foreach ($getResponsible as $key_res => $value_res) {
				
										if($value_res['sales_status'] == "1"){ ?>
											<div id="sales_Responsible_manager">
													
												<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/ShowInvoiceDetail/year/<?php echo $year_commission; ?>/id/<?php echo $value_res['id'];?>" ><?php echo "<span style=\"font-weight: 700;\">M : </span>"; ?><?php echo $value_res['sales_manager'];  ?></a><br>
											</div>		
													
										<?php }elseif($value_res['sales_status'] == "2"){ ?>
											<div id="sales_Responsible_salesrep">
												
												<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/ShowInvoiceDetail/year/<?php echo $year_commission; ?>/id/<?php echo $value_res['id'];?>" ><?php echo "<span style=\"font-weight: 700;\">R : </span>"; ?>
												<?php echo $value_res['sales_manager'];  ?></a><br>
											</div>		
										<?php }elseif($value_res['sales_status'] == "3"){ ?>
											<div id="sales_Responsible_processor">
												
												<?php echo "<span style=\"font-weight: 700;\">P : </span>"; ?>
												<?php echo $value_res['sales_manager']."<br>";  ?>
											</div>			
										<?php } 
									} 
									 ?>
										
								</td>
								
								<td class="text-left nowrap" style="text-align:left;">
									<?php 

										foreach ($getResponsible as $key_res => $value_res) {
									
											$totalsale = (($value_res['total_sales'] - $value_res['shipping_cost']) - $value_res['creditcard_feecost']);
												if($value_res['sales_status'] == "1"){
													if($value_res['total_sales'] != 0){
														if($value_res['status_commission'] == "Approved"){ ?>
															<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
									<?php 		
														}elseif($value_res['status_commission'] == "Not Approved"){ ?>
															<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
									<?php 				}else{	?>
															<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
									<?php 				}
									
														echo "<span style=\"font-weight: 700;\">M : </span>";
														echo "$ ".number_format($totalsale , 2)." ".$value_res['currency']."<br>";
													}else{
														echo "<span style=\"font-weight: 700;\"> </span><br>";
													}	
												}elseif($value_res['sales_status'] == "2"){
													if($value_res['total_sales'] != 0){
														if($value_res['status_commission'] == "Approved"){ ?>
															<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
									<?php 		
														}elseif($value_res['status_commission'] == "Not Approved"){ ?>
															<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
									<?php 				}else{	?>
															<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
									<?php 				}
														echo "<span style=\"font-weight: 700;\">R : </span>";
														echo "$ ".number_format($totalsale , 2)." ".$value_res['currency']."<br>";
													}else{
														echo "<span style=\"font-weight: 700;\"> </span><br>";
													}	
												}
												
											 
										} 
								
									?>
								</td>
								<td class="text-left nowrap" style="text-align:left;">
									
									<?php 
									foreach ($getResponsible as $key_res => $value_res) {
										if($value_res['sales_status'] == "1"){
											if($value_res['total_sales'] != 0){
												echo "<span style=\"font-weight: 700;\">M : </span>";
												echo $value_res['commission_percent']."% <br>";
											}else{
												echo "<span style=\"font-weight: 700;\"> </span><br>";
											}
										}elseif($value_res['sales_status'] == "2"){
											if($value_res['total_sales'] != 0){
												echo "<span style=\"font-weight: 700;\">R : </span>";
												echo $value_res['commission_percent']."% <br>";
											}else{
												echo "<span style=\"font-weight: 700;\"> </span><br>";
											}
										}	
									}	
									?>
								</td>
								<td class="text-left nowrap" style="text-align:left;">
									<?php 
									foreach ($getResponsible as $key_res => $value_res) {
											
										if($value_res['sales_status'] == "1"){
											if($value_res['total_sales'] != 0){
												echo "<span style=\"font-weight: 700;\">M : </span>";
												echo "$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."<br>";
											}else{
												echo "<span style=\"font-weight: 700;\"> </span><br>";
											}
										}elseif($value_res['sales_status'] == "2"){
											if($value_res['total_sales'] != 0){
												echo "<span style=\"font-weight: 700;\">R : </span>";
												echo "$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."<br>";
											}else{
												echo "<span style=\"font-weight: 700;\"> </span><br>";
											}	
										}	
									}	
									?>
								</td>
								<td class="text-left nowrap" style="text-align:left;">
								<?php 
									foreach ($getResponsible as $key_res => $value_res) {
										if($value_res['sales_status'] != "3"){
											if($value_res['invoice_status'] == "Paid"){	
											
												if($value_res['commisson_payment_status'] == "Paid"){
													
													if($value_res['sales_status'] == "1"){
														
														echo "<span style=\"font-weight: 700;\">M : </span>";
														$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];
														
														if($balance_invoice != 0 ){
															echo "<span style=\"color:red\">$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}else{
															echo "<span>$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}
														
													}elseif($value_res['sales_status'] == "2"){
														
														echo "<span style=\"font-weight: 700;\">R : </span>";
														
														$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];
														
														if($balance_invoice != 0 ){
															echo "<span style=\"color:red\">$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}else{
															echo "<span>$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}
														
													}else{
														echo "<span style=\"font-weight: 700;\">P : </span>";
														
														$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];
														
														if($balance_invoice != 0 ){
															echo "<span style=\"color:red\">$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}else{
															echo "<span>$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}
													}	
													
													
													
												}else{
													if($totalsale != 0){
														if($value_res['sales_status'] == "1"){
															echo "<span style=\"font-weight: 700;\">M : </span>";
															
															if($value_res['commission'] != 0 ){
																echo "<span style=\"color:red\">$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}else{
																echo "<span>$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}
															
														}elseif($value_res['sales_status'] == "2"){
															echo "<span style=\"font-weight: 700;\">R : </span>";
															
															if($value_res['commission'] != 0 ){
																echo "<span style=\"color:red\">$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}else{
																echo "<span>$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}
															
														}else{
															echo "<span style=\"font-weight: 700;\">P : </span>";
															
															if($value_res['commission'] != 0 ){
																echo "<span style=\"color:red\">$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}else{
																echo "<span>$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}
															
														}	
														
													}
												}
											}
										}	
									}		
									?>
								</td>	
								
									
								<td class="text-left nowrap" style="text-align:left;"> 	
									<?php 
										foreach ($getResponsible as $key_res => $value_res) {
											if($value_res['sales_status'] != "3"){
												if($value_res['sales_status'] == "1"){
													
													echo "<span style=\"font-weight: 700;\">M : </span>";
													
													if($value_res['commisson_payment_status'] == "Outstanding"){
														echo "<span style=\"color:red\">".$value_res['commisson_payment_status']."</span><br>";
													}else{
														echo "<span> ".$value_res['commisson_payment_status']."</span><br>";
													}
												}elseif($value_res['sales_status'] == "2"){
													
													echo "<span style=\"font-weight: 700;\">R : </span>";
													
													if($value_res['commisson_payment_status'] == "Outstanding"){
														echo "<span style=\"color:red\">".$value_res['commisson_payment_status']."</span><br>";
													}else{
														echo "<span> ".$value_res['commisson_payment_status']."</span><br>";
													}
													
												}else{
													
													echo "<span style=\"font-weight: 700;\">P : </span>";
													
													if($value_res['commisson_payment_status'] == "Outstanding"){
														echo "<span style=\"color:red\">".$value_res['commisson_payment_status']."</span><br>";
													}else{
														echo "<span> ".$value_res['commisson_payment_status']."</span><br>";
													}
													
												}
												
												
											}	
										}	
									?> 
									</td>
									<td class="text-left nowrap" style="text-align:left;"> 	
									<?php 
									foreach ($getResponsible as $key_res => $value_res) {
										if($value_res['sales_status'] != "3"){
											if($value_res['commisson_payment_status'] == "Paid"){
												
												if($value_res['sales_status'] == "1"){
													echo "<span style=\"font-weight: 700;\">M : </span>";
													
													echo "<span > $ ".number_format($value_res['pay_for_sales']  , 2)." ".$value_res['currency']."</span><br>";
													
													if($value_res['date_for_sales'] != "0000-00-00" ){ 
														$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
														"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
														"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
														"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
														 
														$commissiondate = $value_res['date_for_sales'];
														 
														list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
														  
														$yy_comm = $year_comm;
														$mm_comm = $momth_comm;
														$dd_comm = $day_comm; 
														
														if ($dd_comm < 10){
															$dd_comm = substr($dd_comm,1,2);
														}
														  $date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
														  
														echo "<span style=\"font-size:11px\">(Date : ".$date_comm.")</span><br>";
													}
												
												}elseif($value_res['sales_status'] == "2"){
													echo "<span style=\"font-weight: 700;\">R : </span>";
													
													echo "<span > $ ".number_format($value_res['pay_for_sales']  , 2)." ".$value_res['currency']."</span><br>";
													if($value_res['date_for_sales'] != "0000-00-00" ){ 
														$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
														"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
														"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
														"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
														 
														$commissiondate = $value_res['date_for_sales'];
														 
														list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
														  
														$yy_comm = $year_comm;
														$mm_comm = $momth_comm;
														$dd_comm = $day_comm; 
														
														if ($dd_comm < 10){
															$dd_comm = substr($dd_comm,1,2);
														}
														  $date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
														  
														echo "<span style=\"font-size:11px\">(Date : ".$date_comm.")</span><br>";
													}
												}else{
													echo "<span style=\"font-weight: 700;\">P : </span>";
													
													echo "<span > $ ".number_format($value_res['pay_for_sales']  , 2)." ".$value_res['currency']."</span><br>";
													if($value_res['date_for_sales'] != "0000-00-00" ){ 
														$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
														"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
														"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
														"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
														 
														$commissiondate = $value_res['date_for_sales'];
														 
														list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
														  
														$yy_comm = $year_comm;
														$mm_comm = $momth_comm;
														$dd_comm = $day_comm; 
														
														if ($dd_comm < 10){
															$dd_comm = substr($dd_comm,1,2);
														}
														  $date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
														  
														echo "<span style=\"font-size:11px\">(Date : ".$date_comm.")</span><br>";
													}
												}
												
												
											}
										}	
									}	
									?> 
									</td>
								<td class="text-left " style="word-wrap:break-word;text-align:left;">  
									<?php 	
									foreach ($getResponsible as $key_res => $value_res) {
										if($value_res['sales_status'] != "3"){
											
											$comments = Yii::app()->db->createCommand()
												->select('*')
												->from('comments com')
												->where('com.invoice = "'.$value_res['id'].'"')
												->order('com.date_comments DESC')
												->limit('1')
												->queryAll();
												
												foreach ($comments as $key_co => $value_co) {
													if($value_res['sales_status'] == "1"){
														echo "<span style=\"font-weight: 700;\">(M) </span>";
															
														if($value_co['user_group']== "1"){
															echo "JOG : ";
														}elseif($value_co['user_group']== "2"){
																
														}		
														echo nl2br($value_co['comments'])."<br>" ;
															
													}elseif($value_res['sales_status'] == "2"){
														echo "<span style=\"font-weight: 700;\">(R) </span>";
															
														if($value_co['user_group']== "1"){
															echo "JOG : ";
														}elseif($value_co['user_group']== "2"){
																
														}		
														echo nl2br($value_co['comments'])."<br>" ;
															
													}else{
														echo "<span style=\"font-weight: 700;\">(P) : </span>";
															
														if($value_co['user_group']== "1"){
															echo "JOG : ";
														}elseif($value_co['user_group']== "2"){
																
														}		
														echo nl2br($value_co['comments'])."<br>" ;
													}
													
												}
										}		
									}		
									?> 
								</td>
								<td class="text-left nowrap" style="word-wrap:break-word;text-align:left;">  
									<?php 	
										foreach ($getResponsible as $key_res => $value_res) {
											if($value_res['sales_status'] != "3"){
												if($value_res['sales_status'] == "1"){
													echo "<span style=\"font-weight: 700;\">M : </span>";
													
													if($value_res['update_date'] != "0000-00-00" ){ 
														$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																																 
														list($year,$momth,$day) = explode("-",$value_res['update_date']);
																													
														if ($day < 10){
															$day = substr($day,1,2);
														}
																							
														$date = $_month_name[$momth]." ".$day.",  ".$year;
									?>								
														<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php							
													}else{
														$date = " ";
									?>								
												<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php
													}
													
												}elseif($value_res['sales_status'] == "2"){
													echo "<span style=\"font-weight: 700;\">R : </span>";
													
													if($value_res['update_date'] != "0000-00-00" ){ 
														$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																																 
														list($year,$momth,$day) = explode("-",$value_res['update_date']);
																													
														if ($day < 10){
															$day = substr($day,1,2);
														}
																							
														$date = $_month_name[$momth]." ".$day.",  ".$year;
									?>								
														<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php							
													}else{
														$date = " ";
									?>								
												<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php
													}
													
												}else{
													echo "<span style=\"font-weight: 700;\">P : </span>";
													
													if($value_res['update_date'] != "0000-00-00" ){ 
														$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																																 
														list($year,$momth,$day) = explode("-",$value_res['update_date']);
																													
														if ($day < 10){
															$day = substr($day,1,2);
														}
																							
														$date = $_month_name[$momth]." ".$day.",  ".$year;
									?>								
														<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php							
													}else{
														$date = " ";
									?>								
												<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php
													}
													
												}
												
											}
										}		
									?> 
								</td>
							</tr>
								<?php }} ?>	
							<?php	if($sumtotalUSD != 0 ){  ?>
							
							<tr style="background-color: #c1ffe6;">
								<td colspan=""></td>
								<td colspan=""></td>
								<td colspan=""></td>
								<td colspan=""></td>
								<td colspan=""></td>
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
									<span><?php echo "$ ".number_format($sumAmountReceivedUSD , 2)." USD";?>  </span>
								</td>
								<td colspan=""></td>
								
								
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<span><?php echo "$ ".number_format($sumtotalUSD , 2)." USD";?>  </span>
								</td>
								<td></td>
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<span><?php echo "$ ".number_format($totalcommissionUSD , 2)." USD";?>  </span>									  
								</td>
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<?php if($commissionPaymentUSD == 0){	?>
											<span><?php echo "$ ".number_format($commissionPaymentUSD , 2)." USD";?></span>
										<?php }else{ ?>
											<span style="color:red;padding:5px 10px;"><?php echo "$ ".number_format($commissionPaymentUSD , 2)." USD";?></span>
										<?php } ?>
								</td>
								<td></td>
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<?php if(!empty($sumCommissionPaymaentUSD)){	?>
											<span><?php echo "$ ".number_format($sumCommissionPaymaentUSD , 2)." USD";?></span>
										<?php } ?>
								</td>
								<td></td>
								<td></td>
							</tr>
						<?php	} ?>			
						</tbody>
					</table>
				</div>
				<br>
			<?php }
			}
			foreach($currency_curr as $curr){ 
				if( $curr == "CAD"){ ?>
				<div style="margin-bottom:10px;">
					<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/invioceCAD/year/<?php echo $year_commission;?>" class="paf_dowload" target="_blank"> PDF (CAD)</a>
				</div>
				<br>
				<div class="text-center" style="background-color:rgb(169, 185, 199);color:rgb(51, 67, 80);padding: 10px 0" > 
					<h4  style="font-weight: 700;"><?php echo  $curr;?>  </h4>
				</div>
				<div id="freezer-Table" style="margin:0">
					<table id="calculatorCADcomTable" class="table table-striped table-bordered table-condensed table-freeze-multi" style="border-collapse: initial;" data-scroll-max-height="600"data-cols-number="4">
						<colgroup>
							<col style="width:150px;">
							<col style="width:120px;">
							<col style="width:150px;">
							<col style="width:100px;">
							<col style="width:80px;">
							<col style="width:120px;">
							<col style="width:200px;">
							<col style="width:180px;">
							<col style="width:100px;">
							<col style="width:160px;">
							<col style="width:160px;">
							<col style="width:100px;">
							<col style="width:150px;">
							<col style="width:200px;">
							<col style="width:110px;">
						</colgroup>
						<thead>
							
							<tr>	
								
								<th colspan = "4" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Invoice </th>
								<th colspan = "2"  class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Invoice Payment Status </th>
								<th colspan = ""  class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Sales Responsible </th>
								<th colspan = "4"  class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Commission Calculator</th>
								
								<th colspan = "2"  class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Commission Payment Status </th>
								<th colspan = ""  class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Comment </th>
								<th colspan = ""  class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Update
								</th>
							</tr>
								<tr>
								
								<th class="bg-blue-light text-center" > Invoice # </th>
								<th class="bg-blue-light text-center" > Order No. </th>
								<th class="bg-blue-light text-center" > Order Name <br><span style="color:#fd6262;font-size:11px;">** Click Order Name ** <br> for Commission Calculator </span></th>
								<th class="bg-blue-light text-center" > Date/Quarter </th>
								
								<th class="bg-blue-light text-center" > Invoice Status</th>
								<th class="bg-blue-light text-center" > Amount Received</th>
								
								<th class="bg-blue-light text-center" > Sales Responsible </th>
								
								<th class="bg-blue-light text-center" > Total Sales </th>
								<th class="bg-blue-light text-center" > Commission% </th>
								<th class="bg-blue-light text-center" > Commission </th>
								<th class="bg-blue-light text-center" > Balance </th>
								
								<th class="bg-blue-light text-center" > Commission Status</th>
								<th class="bg-blue-light text-center" > Commission Payment</th>
								
								<th class="bg-blue-light text-center" > Comments </th>
								<th class="bg-blue-light text-center" > Last Update </th>
							</tr>
						</thead>
						<tbody>
						<?php
								foreach ($getData as $key => $value) {
									if($value['currency'] ==   $curr ){		
							?>
							<tr style="background: #ffffff;">
								<td class="text-left nowrap" style="vertical-align: middle;" > 
									<?php if($value['file_path'] != "Array" && $value['file_path'] != ""){ ?>
									<a href="<?php echo Yii::app()->request->baseUrl; ?>/invoice/docs/<?php echo $value['file_path'];?>" target="_blank"> 
										<?php echo $value['invoice'];?> 
									</a>
									<?php }else{?>
										<span style="color:red;"> 
										<?php echo $value['invoice'];?> 
										</span> 
									<?php
									} ?>
									
									<?php if($value['invoice_mail_status'] == "Send"){ ?>
										&nbsp; <a href="#" data-toggle="modal" data-target="#editSendMail"  data-id="<?php echo $value['id'];?>" title="Send E-mail to Customer"><i class="fa fa-envelope"></i></a>
									<?php }else{ ?>
										&nbsp; <a  href="#" data-toggle="modal" data-target="#editSendMail"  data-id="<?php echo $value['id'];?>" title="Send E-mail to Customer"><i class="fa fa-envelope-o"></i></a>
									<?php }	?>
								</td>
								<td class="text-left " style="vertical-align: middle;text-align:left;" > 
									<div class="col-md-12" style="vertical-align: middle;" >
									<?php 
										$data_order_no = str_replace(" ", '<br />', $value['order_no']);
										echo $data_order_no;
									?>
									</div>
								</td>
								<td class="" style="vertical-align: middle;text-align:left;">
									<div class="col-md-1" style="vertical-align: middle;" >
								<?php 
									if($value['invoice_status'] == "Paid"){ ?>
										<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
								<?php 		
									}elseif($value['invoice_status'] == "Outstanding"){ ?>
									
									<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
								<?php }	?>
									</div>
									<div class="col-md-10" style="vertical-align: middle;">
										<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/commission/year<?php //echo $year_commission; ?>/id/<?php echo $value['id'];?>" ><?php echo nl2br($value['order_name']);?>  </a>
									</div>	
								</td>
								<?php  
									 $_month_name = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
										"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
										"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
										"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
									 
									 $vardate = $value['date_quarter'];
										list($year,$momth,$day) = explode("-",$vardate);
										$yy = $year;
										$mm = $momth;
										$dd = $day; 
									 
									if ($dd<10){
										$dd=substr($dd,1,2);
									}
									  $date= $_month_name[$mm]." ".$dd.",  ".$yy;
									  if($mm == "01" || $mm == "02" || $mm == "03"){
										  $quarter = "QTR 1";
									  }elseif($mm == "04" || $mm == "05" || $mm == "06"){
										  $quarter = "QTR 2";
									  }elseif($mm == "07" || $mm == "08" || $mm == "09"){
										  $quarter = "QTR 3";
									  }elseif($mm == "10" || $mm == "11" || $mm == "12"){
										  $quarter = "QTR 4";
									  }
									 //echo $date;
									?>
								<td class="text-center nowrap" style="vertical-align: middle;">  <?php echo $date."/<br>".$quarter;?> </td>
								<td class="text-center nowrap" style="vertical-align: middle;"> 
									<?php 
										if($value['invoice_status'] == "Outstanding"){
											echo "<span style=\"color:red\">".$value['invoice_status']."</span>";
										}else{
											echo "<span> ".$value['invoice_status']."</span>";
										}
									?> 
								
								</td>
									
								<td class="text-center nowrap" style="vertical-align: middle;"> 
									<?php 
										if($value['invoice_status'] == "Paid"){
											if($value['invoice_amount_received'] != 0){
												echo "<span > $ ".number_format($value['invoice_amount_received']  , 2)." ".$value['currency']."</span><br>";
												
												if($value['invoice_date'] != "0000-00-00"){
													 $_month_name_int = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
													"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
													"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
													"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
													 
													 $invoicedate = $value['invoice_date'];
													 
													 list($year_int,$momth_int,$day_int) = explode("-",$invoicedate);
													 
													 $yy_int = $year_int;
													 $mm_int = $momth_int;
													 $dd_int = $day_int; 
													if ($dd_int < 10){
														$dd_int = substr($dd_int,1,2);
													}
													  $date_int = $_month_name_int[$mm_int]." ".$dd_int.",  ".$yy_int;
													  
													echo "<span style=\"font-size:11px\">(Date : ".$date_int.")</span><br>";
												}	
											}
										}
									?> 
								
								</td>
								<td class="text-left nowrap" style="text-align:left;" > 
								<?php 
									if(!empty($commission_status)){
										$getResponsible = Yii::app()->db->createCommand()
										->select('*')
										->from('calculator c')
										->where('c.invoice = "'.$value['invoice'].'"')
										->andwhere('c.commisson_payment_status = "'.$commission_status.'"')
										->order('c.sales_status ASC')
										->queryAll();
									}else{
										$getResponsible = Yii::app()->db->createCommand()
										->select('*')
										->from('calculator c')
										->where('c.invoice = "'.$value['invoice'].'"')
										->order('c.sales_status ASC')
										->queryAll();
									}
									
									
									foreach ($getResponsible as $key_res => $value_res) {
				
										if($value_res['sales_status'] == "1"){ ?>
											<div id="sales_Responsible_manager">
														
												
													
												<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/ShowInvoiceDetail/year/<?php echo $year_commission; ?>/id/<?php echo $value_res['id'];?>" ><?php echo "<span style=\"font-weight: 700;\">M : </span>"; ?>
												<?php echo $value_res['sales_manager']; ?></a><br>
											</div>		
													
										<?php }elseif($value_res['sales_status'] == "2"){ ?>
											<div id="sales_Responsible_salesrep">
												
													
												<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/ShowInvoiceDetail/year/<?php echo $year_commission; ?>/id/<?php echo $value_res['id'];?>" ><?php echo "<span style=\"font-weight: 700;\">R : </span>"; ?>
												<?php echo $value_res['sales_manager'];  ?></a><br>
											</div>		
										<?php }elseif($value_res['sales_status'] == "3"){ ?>
											<div id="sales_Responsible_processor">
												
														
												<?php echo "<span style=\"font-weight: 700;\">P : </span>"; ?>
												<?php echo $value_res['sales_manager']."<br>";  ?>
											</div>			
										<?php } 
									} 
									 ?>
										
								</td>
								
								<td class="text-left nowrap" style="text-align:left;">
									<?php 

										foreach ($getResponsible as $key_res => $value_res) {
									
											$totalsale = (($value_res['total_sales'] - $value_res['shipping_cost']) - $value_res['creditcard_feecost']);
												if($value_res['sales_status'] == "1"){
													if($value_res['total_sales'] != 0){
														if($value_res['status_commission'] == "Approved"){ ?>
															<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
									<?php 		
														}elseif($value_res['status_commission'] == "Not Approved"){ ?>
															<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
									<?php 				}else{	?>
															<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
									<?php 				}
									
														echo "<span style=\"font-weight: 700;\">M : </span>";
														echo "$ ".number_format($totalsale , 2)." ".$value_res['currency']."<br>";
													}else{
														echo "<span style=\"font-weight: 700;\"> </span><br>";
													}	
												}elseif($value_res['sales_status'] == "2"){
													if($value_res['total_sales'] != 0){
														if($value_res['status_commission'] == "Approved"){ ?>
															<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
									<?php 		
														}elseif($value_res['status_commission'] == "Not Approved"){ ?>
															<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
									<?php 				}else{	?>
															<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
									<?php 				}
														echo "<span style=\"font-weight: 700;\">R : </span>";
														echo "$ ".number_format($totalsale , 2)." ".$value_res['currency']."<br>";
													}else{
														echo "<span style=\"font-weight: 700;\"> </span><br>";
													}	
												}
												
											 
										} 
								
									?>
								</td>
								<td class="text-left nowrap" style="text-align:left;">
									
									<?php 
									foreach ($getResponsible as $key_res => $value_res) {
										if($value_res['sales_status'] == "1"){
											if($value_res['total_sales'] != 0){
												echo "<span style=\"font-weight: 700;\">M : </span>";
												echo $value_res['commission_percent']."% <br>";
											}else{
												echo "<span style=\"font-weight: 700;\"> </span><br>";
											}
										}elseif($value_res['sales_status'] == "2"){
											if($value_res['total_sales'] != 0){
												echo "<span style=\"font-weight: 700;\">R : </span>";
												echo $value_res['commission_percent']."% <br>";
											}else{
												echo "<span style=\"font-weight: 700;\"> </span><br>";
											}
										}	
									}	
									?>
								</td>
								<td class="text-left nowrap" style="text-align:left;">
									<?php 
									foreach ($getResponsible as $key_res => $value_res) {
											
										if($value_res['sales_status'] == "1"){
											if($value_res['total_sales'] != 0){
												echo "<span style=\"font-weight: 700;\">M : </span>";
												echo "$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."<br>";
											}else{
												echo "<span style=\"font-weight: 700;\"> </span><br>";
											}
										}elseif($value_res['sales_status'] == "2"){
											if($value_res['total_sales'] != 0){
												echo "<span style=\"font-weight: 700;\">R : </span>";
												echo "$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."<br>";
											}else{
												echo "<span style=\"font-weight: 700;\"> </span><br>";
											}	
										}	
									}	
									?>
								</td>
								<td class="text-left nowrap" style="text-align:left;">
								<?php 
									foreach ($getResponsible as $key_res => $value_res) {
										if($value_res['sales_status'] != "3"){
											if($value_res['invoice_status'] == "Paid"){	
											
												if($value_res['commisson_payment_status'] == "Paid"){
													
													if($value_res['sales_status'] == "1"){
														
														echo "<span style=\"font-weight: 700;\">M : </span>";
														$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];
														
														if($balance_invoice != 0 ){
															echo "<span style=\"color:red\">$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}else{
															echo "<span>$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}
														
													}elseif($value_res['sales_status'] == "2"){
														
														echo "<span style=\"font-weight: 700;\">R : </span>";
														
														$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];
														
														if($balance_invoice != 0 ){
															echo "<span style=\"color:red\">$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}else{
															echo "<span>$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}
														
													}else{
														echo "<span style=\"font-weight: 700;\">P : </span>";
														
														$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];
														
														if($balance_invoice != 0 ){
															echo "<span style=\"color:red\">$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}else{
															echo "<span>$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}
													}	
													
													
													
												}else{
													if($totalsale != 0){
														if($value_res['sales_status'] == "1"){
															echo "<span style=\"font-weight: 700;\">M : </span>";
															
															if($value_res['commission'] != 0 ){
																echo "<span style=\"color:red\">$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}else{
																echo "<span>$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}
															
														}elseif($value_res['sales_status'] == "2"){
															echo "<span style=\"font-weight: 700;\">R : </span>";
															
															if($value_res['commission'] != 0 ){
																echo "<span style=\"color:red\">$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}else{
																echo "<span>$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}
															
														}else{
															echo "<span style=\"font-weight: 700;\">P : </span>";
															
															if($value_res['commission'] != 0 ){
																echo "<span style=\"color:red\">$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}else{
																echo "<span>$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}
															
														}	
														
													}
												}
											}
										}	
									}		
									?>
								</td>	
								
									
								<td class="text-left nowrap" style="text-align:left;"> 	
									<?php 
										foreach ($getResponsible as $key_res => $value_res) {
											if($value_res['sales_status'] != "3"){
												if($value_res['sales_status'] == "1"){
													
													echo "<span style=\"font-weight: 700;\">M : </span>";
													
													if($value_res['commisson_payment_status'] == "Outstanding"){
														echo "<span style=\"color:red\">".$value_res['commisson_payment_status']."</span><br>";
													}else{
														echo "<span> ".$value_res['commisson_payment_status']."</span><br>";
													}
												}elseif($value_res['sales_status'] == "2"){
													
													echo "<span style=\"font-weight: 700;\">R : </span>";
													
													if($value_res['commisson_payment_status'] == "Outstanding"){
														echo "<span style=\"color:red\">".$value_res['commisson_payment_status']."</span><br>";
													}else{
														echo "<span> ".$value_res['commisson_payment_status']."</span><br>";
													}
													
												}else{
													
													echo "<span style=\"font-weight: 700;\">P : </span>";
													
													if($value_res['commisson_payment_status'] == "Outstanding"){
														echo "<span style=\"color:red\">".$value_res['commisson_payment_status']."</span><br>";
													}else{
														echo "<span> ".$value_res['commisson_payment_status']."</span><br>";
													}
													
												}
												
												
											}	
										}	
									?> 
									</td>
									<td class="text-left nowrap" style="text-align:left;"> 	
									<?php 
									foreach ($getResponsible as $key_res => $value_res) {
										if($value_res['sales_status'] != "3"){
											if($value_res['commisson_payment_status'] == "Paid"){
												
												if($value_res['sales_status'] == "1"){
													echo "<span style=\"font-weight: 700;\">M : </span>";
													
													echo "<span > $ ".number_format($value_res['pay_for_sales']  , 2)." ".$value_res['currency']."</span><br>";
												
													if($value_res['date_for_sales'] != "0000-00-00" ){ 
														$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
														"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
														"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
														"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
														 
														$commissiondate = $value_res['date_for_sales'];
														 
														list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
														  
														$yy_comm = $year_comm;
														$mm_comm = $momth_comm;
														$dd_comm = $day_comm; 
														
														if ($dd_comm < 10){
															$dd_comm = substr($dd_comm,1,2);
														}
														  $date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
														  
														echo "<span style=\"font-size:11px\">(Date : ".$date_comm.")</span><br>";
													}
												
												}elseif($value_res['sales_status'] == "2"){
													echo "<span style=\"font-weight: 700;\">R : </span>";
													
													echo "<span > $ ".number_format($value_res['pay_for_sales']  , 2)." ".$value_res['currency']."</span><br>";
												
													if($value_res['date_for_sales'] != "0000-00-00" ){ 
														$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
														"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
														"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
														"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
														 
														$commissiondate = $value_res['date_for_sales'];
														 
														list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
														  
														$yy_comm = $year_comm;
														$mm_comm = $momth_comm;
														$dd_comm = $day_comm; 
														
														if ($dd_comm < 10){
															$dd_comm = substr($dd_comm,1,2);
														}
														  $date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
														  
														echo "<span style=\"font-size:11px\">(Date : ".$date_comm.")</span><br>";
													}
												}else{
													echo "<span style=\"font-weight: 700;\">P : </span>";
													
													echo "<span > $ ".number_format($value_res['pay_for_sales']  , 2)." ".$value_res['currency']."</span><br>";
													
													if($value_res['date_for_sales'] != "0000-00-00" ){ 
														$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
														"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
														"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
														"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
														 
														$commissiondate = $value_res['date_for_sales'];
														 
														list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
														  
														$yy_comm = $year_comm;
														$mm_comm = $momth_comm;
														$dd_comm = $day_comm; 
														
														if ($dd_comm < 10){
															$dd_comm = substr($dd_comm,1,2);
														}
														  $date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
														  
														echo "<span style=\"font-size:11px\">(Date : ".$date_comm.")</span><br>";
													}
												}
												
												
											}
										}	
									}	
									?> 
									</td>
								<td class="text-left " style="word-wrap:break-word;text-align:left;">  
									<?php 	
									foreach ($getResponsible as $key_res => $value_res) {
										if($value_res['sales_status'] != "3"){
											
											$comments = Yii::app()->db->createCommand()
												->select('*')
												->from('comments com')
												->where('com.invoice = "'.$value_res['id'].'"')
												->order('com.date_comments DESC')
												->limit('1')
												->queryAll();
												
												foreach ($comments as $key_co => $value_co) {
													if($value_res['sales_status'] == "1"){
														echo "<span style=\"font-weight: 700;\">(M) </span>";
															
														if($value_co['user_group']== "1"){
															echo "JOG : ";
														}elseif($value_co['user_group']== "2"){
																
														}		
														echo nl2br($value_co['comments'])."<br>" ;
															
													}elseif($value_res['sales_status'] == "2"){
														echo "<span style=\"font-weight: 700;\">(R) </span>";
															
														if($value_co['user_group']== "1"){
															echo "JOG : ";
														}elseif($value_co['user_group']== "2"){
																
														}		
														echo nl2br($value_co['comments'])."<br>" ;
															
													}else{
														echo "<span style=\"font-weight: 700;\">(P) : </span>";
															
														if($value_co['user_group']== "1"){
															echo "JOG : ";
														}elseif($value_co['user_group']== "2"){
																
														}		
														echo nl2br($value_co['comments'])."<br>" ;
													}
													
												}
										}		
									}		
									?> 
								</td>
								<td class="text-left nowrap" style="word-wrap:break-word;text-align:left;">  
									<?php 	
										foreach ($getResponsible as $key_res => $value_res) {
											if($value_res['sales_status'] != "3"){
												if($value_res['sales_status'] == "1"){
													echo "<span style=\"font-weight: 700;\">M : </span>";
													
													if($value_res['update_date'] != "0000-00-00" ){ 
														$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																																 
														list($year,$momth,$day) = explode("-",$value_res['update_date']);
																													
														if ($day < 10){
															$day = substr($day,1,2);
														}
																							
														$date = $_month_name[$momth]." ".$day.",  ".$year;
									?>								
														<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php							
													}else{
														$date = " ";
									?>								
												<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php
													}
													
												}elseif($value_res['sales_status'] == "2"){
													echo "<span style=\"font-weight: 700;\">R : </span>";
													
													if($value_res['update_date'] != "0000-00-00" ){ 
														$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																																 
														list($year,$momth,$day) = explode("-",$value_res['update_date']);
																													
														if ($day < 10){
															$day = substr($day,1,2);
														}
																							
														$date = $_month_name[$momth]." ".$day.",  ".$year;
									?>								
														<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php							
													}else{
														$date = " ";
									?>								
												<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php
													}
													
												}else{
													echo "<span style=\"font-weight: 700;\">P : </span>";
													
													if($value_res['update_date'] != "0000-00-00" ){ 
														$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																																 
														list($year,$momth,$day) = explode("-",$value_res['update_date']);
																													
														if ($day < 10){
															$day = substr($day,1,2);
														}
																							
														$date = $_month_name[$momth]." ".$day.",  ".$year;
									?>								
														<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php							
													}else{
														$date = " ";
									?>								
												<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php
													}
													
												}
												
											}
										}		
									?> 
								</td>
							</tr>
								<?php }} ?>	
								<?php	if($sumtotalCAD != 0 ){  ?>
							
							<tr style="background-color: #c1ffe6;">
								<td colspan=""></td>
								<td colspan=""></td>
								<td colspan=""></td>
								<td colspan=""></td>
								<td colspan=""></td>
								
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<span><?php echo "$ ".number_format($sumAmountReceivedCAD , 2)." CAD";?>  </span>
								</td>
								<td colspan=""></td>
								
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<span><?php echo "$ ".number_format($sumtotalCAD , 2)." CAD";?>  </span>
								</td>
								<td></td>
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<span><?php echo "$ ".number_format($totalcommissionCAD , 2)." CAD";?>  </span>									  
								</td>
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<?php if($commissionPaymentCAD == 0){	?>
											<span><?php echo "$ ".number_format($commissionPaymentCAD , 2)." CAD";?></span>
										<?php }else{ ?>
											<span style="color:red;padding:5px 10px;"><?php echo "$ ".number_format($commissionPaymentCAD , 2)." CAD";?></span>
										<?php } ?>
								</td>
								<td></td>
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<?php if(!empty($sumCommissionPaymaentCAD)){	?>
											<span><?php echo "$ ".number_format($sumCommissionPaymaentCAD , 2)." CAD";?></span>
										<?php } ?>
								</td>
								<td></td>
								<td></td>
							</tr>
						<?php	} ?>			
						</tbody>
					</table>
				</div>
				<br>				
			<?php }
			}
			
			foreach($currency_curr as $curr){ 
			if( $curr == "SGD"){ ?>
				<div style="margin-bottom:10px;">
					<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/invioceSGD/year/<?php echo $year_commission;?>" class="paf_dowload" target="_blank"> PDF (SGD)</a>
				</div>
				<br>
				<div class="text-center" style="background-color:rgb(169, 185, 199);color:rgb(51, 67, 80);padding: 10px 0" > 
					<h4  style="font-weight: 700;"><?php echo  $curr;?>  </h4>
				</div>
				<div id="parentSGD">	
					<table id="calculatorSGDcomTable" class="table table-striped table-bordered table-condensed table-freeze-multi" style="border-collapse: initial;" data-scroll-max-height="600"data-cols-number="4">
						<colgroup>
							<col style="width:150px;">
							<col style="width:120px;">
							<col style="width:150px;">
							<col style="width:100px;">
							<col style="width:80px;">
							<col style="width:120px;">
							<col style="width:200px;">
							<col style="width:180px;">
							<col style="width:100px;">
							<col style="width:160px;">
							<col style="width:160px;">
							<col style="width:100px;">
							<col style="width:150px;">
							<col style="width:200px;">
							<col style="width:110px;">
						</colgroup>
						<thead>
							
							<tr>	
								
								<th colspan = "4" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Invoice </th>
								<th colspan = "2"  class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Invoice Payment Status </th>
								<th colspan = ""  class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Sales Responsible </th>
								<th colspan = "4"  class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Commission Calculator</th>
								
								<th colspan = "2"  class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Commission Payment Status </th>
								<th colspan = ""  class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Comment </th>
								<th colspan = ""  class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Update
								</th>
							</tr>
								<tr>
								
								<th class="bg-blue-light text-center" > Invoice # </th>
								<th class="bg-blue-light text-center" > order No. </th>
								<th class="bg-blue-light text-center" > Order Name <br><span style="color:#fd6262;font-size:11px;">** Click Order Name ** <br> for Commission Calculator </span></th>
								<th class="bg-blue-light text-center" > Date/Quarter </th>
								
								<th class="bg-blue-light text-center" > Invoice Status</th>
								<th class="bg-blue-light text-center" > Amount Received</th>
								
								<th class="bg-blue-light text-center" > Sales Responsible </th>
								
								<th class="bg-blue-light text-center" > Total Sales </th>
								<th class="bg-blue-light text-center" > Commission% </th>
								<th class="bg-blue-light text-center" > Commission </th>
								<th class="bg-blue-light text-center" > Balance </th>
								
								<th class="bg-blue-light text-center" > Commission Status</th>
								<th class="bg-blue-light text-center" > Commission Payment</th>
								
								<th class="bg-blue-light text-center" > Comments </th>
								<th class="bg-blue-light text-center" > Last Update </th>
							</tr>
						</thead>
						<tbody>
						<?php
								foreach ($getData as $key => $value) {
									if($value['currency'] ==   $curr ){		
							?>
							<tr style="background: #ffffff;">
								
								<td class="text-left nowrap" style="vertical-align: middle;" > 
									<?php if($value['file_path'] != "Array" && $value['file_path'] != ""){ ?>
									<a href="<?php echo Yii::app()->request->baseUrl; ?>/invoice/docs/<?php echo $value['file_path'];?>" target="_blank"> 
										<?php echo $value['invoice'];?> 
									</a>
									<?php }else{?>
										<span style="color:red;"> 
										<?php echo $value['invoice'];?> 
										</span> 
									<?php
									} ?>
									
									<?php if($value['invoice_mail_status'] == "Send"){ ?>
										&nbsp; <a href="#" data-toggle="modal" data-target="#editSendMail"  data-id="<?php echo $value['id'];?>" title="Send E-mail to Customer"><i class="fa fa-envelope"></i></a>
									<?php }else{ ?>
										&nbsp; <a  href="#" data-toggle="modal" data-target="#editSendMail"  data-id="<?php echo $value['id'];?>" title="Send E-mail to Customer"><i class="fa fa-envelope-o"></i></a>
									<?php }	?>
								</td>	
								<td class="text-left " style="vertical-align: middle;text-align:left;" > 
									<div class="col-md-12" style="vertical-align: middle;" >
									<?php 
										$data_order_no = str_replace(" ", '<br />', $value['order_no']);
										echo $data_order_no;
									?>
									</div>
								</td>
								<td class="" style="vertical-align: middle;text-align:left;">
								
									<div class="col-md-1" style="vertical-align: middle;" >
								<?php 
									if($value['invoice_status'] == "Paid"){ ?>
										<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
								<?php 		
									}elseif($value['invoice_status'] == "Outstanding"){ ?>
									
									<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
								<?php }	?>
									</div>
									<div class="col-md-10" style="vertical-align: middle;" >
										<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/commission/year/<?php //echo $year_commission; ?>/id/<?php echo $value['id'];?>" ><?php echo nl2br($value['order_name']);?>  </a>
									</div>	
								</td>
								<?php  
									 $_month_name = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
										"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
										"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
										"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
									 
									 $vardate = $value['date_quarter'];
										list($year,$momth,$day) = explode("-",$vardate);
										$yy = $year;
										$mm = $momth;
										$dd = $day; 
									 
									if ($dd<10){
										$dd=substr($dd,1,2);
									}
									  $date= $_month_name[$mm]." ".$dd.",  ".$yy;
									  if($mm == "01" || $mm == "02" || $mm == "03"){
										  $quarter = "QTR 1";
									  }elseif($mm == "04" || $mm == "05" || $mm == "06"){
										  $quarter = "QTR 2";
									  }elseif($mm == "07" || $mm == "08" || $mm == "09"){
										  $quarter = "QTR 3";
									  }elseif($mm == "10" || $mm == "11" || $mm == "12"){
										  $quarter = "QTR 4";
									  }
									 //echo $date;
									?>
								<td class="text-center nowrap" style="vertical-align: middle;">  
									<?php echo $date."/<br>".$quarter;?> </td>
								<td class="text-center nowrap" style="vertical-align: middle;"> 
									<?php 
										if($value['invoice_status'] == "Outstanding"){
											echo "<span style=\"color:red\">".$value['invoice_status']."</span>";
										}else{
											echo "<span> ".$value['invoice_status']."</span>";
										}
									?> 
								
								</td>
									
								<td class="text-center nowrap" style="vertical-align: middle;"> 
									<?php 
										if($value['invoice_status'] == "Paid"){
											if($value['invoice_amount_received'] != 0){
												echo "<span > $ ".number_format($value['invoice_amount_received']  , 2)." ".$value['currency']."</span><br>";
												
												if($value['invoice_date'] != "0000-00-00"){
													 $_month_name_int = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
													"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
													"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
													"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
													 
													 $invoicedate = $value['invoice_date'];
													 
													 list($year_int,$momth_int,$day_int) = explode("-",$invoicedate);
													 
													 $yy_int = $year_int;
													 $mm_int = $momth_int;
													 $dd_int = $day_int; 
													if ($dd_int < 10){
														$dd_int = substr($dd_int,1,2);
													}
													  $date_int = $_month_name_int[$mm_int]." ".$dd_int.",  ".$yy_int;
													  
													echo "<span style=\"font-size:11px\">(Date : ".$date_int.")</span><br>";
												}	
											}
										}
									?> 
								
								</td>
								<td class="text-left nowrap" style="text-align:left;"> 
								<?php 
									if(!empty($commission_status)){
										$getResponsible = Yii::app()->db->createCommand()
										->select('*')
										->from('calculator c')
										->where('c.invoice = "'.$value['invoice'].'"')
										->andwhere('c.commisson_payment_status = "'.$commission_status.'"')
										->order('c.sales_status ASC')
										->queryAll();
									}else{
										$getResponsible = Yii::app()->db->createCommand()
										->select('*')
										->from('calculator c')
										->where('c.invoice = "'.$value['invoice'].'"')
										->order('c.sales_status ASC')
										->queryAll();
									}
									
									
									foreach ($getResponsible as $key_res => $value_res) {
				
										if($value_res['sales_status'] == "1"){ ?>
											<div id="sales_Responsible_manager">
														
													
												<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/ShowInvoiceDetail/year/<?php echo $year_commission; ?>/id/<?php echo $value_res['id'];?>" ><?php echo "<span style=\"font-weight: 700;\">M : </span>"; ?>
												<?php echo $value_res['sales_manager'];  ?></a><br>
											</div>		
													
										<?php }elseif($value_res['sales_status'] == "2"){ ?>
											<div id="sales_Responsible_salesrep">
												
												<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/ShowInvoiceDetail/year/<?php echo $year_commission; ?>/id/<?php echo $value_res['id'];?>" ><?php echo "<span style=\"font-weight: 700;\">R : </span>"; ?>
												<?php echo $value_res['sales_manager'];  ?></a><br>
											</div>		
										<?php }elseif($value_res['sales_status'] == "3"){ ?>
											<div id="sales_Responsible_processor">
												
												<?php echo "<span style=\"font-weight: 700;\">P : </span>"; ?>
												<?php echo $value_res['sales_manager']."<br>";  ?>
											</div>			
										<?php } 
									} 
									 ?>
										
								</td>
								
								<td class="text-left nowrap" style="text-align:left;">
									<?php 

										foreach ($getResponsible as $key_res => $value_res) {
									
											$totalsale = (($value_res['total_sales'] - $value_res['shipping_cost']) - $value_res['creditcard_feecost']);
												if($value_res['sales_status'] == "1"){
													if($value_res['total_sales'] != 0){
														if($value_res['status_commission'] == "Approved"){ ?>
															<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
									<?php 		
														}elseif($value_res['status_commission'] == "Not Approved"){ ?>
															<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
									<?php 				}else{	?>
															<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
									<?php 				}
									
														echo "<span style=\"font-weight: 700;\">M : </span>";
														echo "$ ".number_format($totalsale , 2)." ".$value_res['currency']."<br>";
													}else{
														echo "<span style=\"font-weight: 700;\"> </span><br>";
													}	
												}elseif($value_res['sales_status'] == "2"){
													if($value_res['total_sales'] != 0){
														if($value_res['status_commission'] == "Approved"){ ?>
															<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
									<?php 		
														}elseif($value_res['status_commission'] == "Not Approved"){ ?>
															<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
									<?php 				}else{	?>
															<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
									<?php 				}
														echo "<span style=\"font-weight: 700;\">R : </span>";
														echo "$ ".number_format($totalsale , 2)." ".$value_res['currency']."<br>";
													}else{
														echo "<span style=\"font-weight: 700;\"> </span><br>";
													}	
												}
												
											 
										} 
								
									?>
								</td>
								<td class="text-left nowrap" style="text-align:left;">
									
									<?php 
									foreach ($getResponsible as $key_res => $value_res) {
										if($value_res['sales_status'] == "1"){
											if($value_res['total_sales'] != 0){
												echo "<span style=\"font-weight: 700;\">M : </span>";
												echo $value_res['commission_percent']."% <br>";
											}else{
												echo "<span style=\"font-weight: 700;\"> </span><br>";
											}
										}elseif($value_res['sales_status'] == "2"){
											if($value_res['total_sales'] != 0){
												echo "<span style=\"font-weight: 700;\">R : </span>";
												echo $value_res['commission_percent']."% <br>";
											}else{
												echo "<span style=\"font-weight: 700;\"> </span><br>";
											}
										}	
									}	
									?>
								</td>
								<td class="text-left nowrap" style="text-align:left;">
									<?php 
									foreach ($getResponsible as $key_res => $value_res) {
											
										if($value_res['sales_status'] == "1"){
											if($value_res['total_sales'] != 0){
												echo "<span style=\"font-weight: 700;\">M : </span>";
												echo "$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."<br>";
											}else{
												echo "<span style=\"font-weight: 700;\"> </span><br>";
											}
										}elseif($value_res['sales_status'] == "2"){
											if($value_res['total_sales'] != 0){
												echo "<span style=\"font-weight: 700;\">R : </span>";
												echo "$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."<br>";
											}else{
												echo "<span style=\"font-weight: 700;\"> </span><br>";
											}	
										}	
									}	
									?>
								</td>
								<td class="text-left nowrap" style="text-align:left;">
								<?php 
									foreach ($getResponsible as $key_res => $value_res) {
										if($value_res['sales_status'] != "3"){
											if($value_res['invoice_status'] == "Paid"){	
											
												if($value_res['commisson_payment_status'] == "Paid"){
													
													if($value_res['sales_status'] == "1"){
														
														echo "<span style=\"font-weight: 700;\">M : </span>";
														$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];
														
														if($balance_invoice != 0 ){
															echo "<span style=\"color:red\">$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}else{
															echo "<span>$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}
														
													}elseif($value_res['sales_status'] == "2"){
														
														echo "<span style=\"font-weight: 700;\">R : </span>";
														
														$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];
														
														if($balance_invoice != 0 ){
															echo "<span style=\"color:red\">$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}else{
															echo "<span>$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}
														
													}else{
														echo "<span style=\"font-weight: 700;\">P : </span>";
														
														$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];
														
														if($balance_invoice != 0 ){
															echo "<span style=\"color:red\">$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}else{
															echo "<span>$ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}
													}	
													
													
													
												}else{
													if($totalsale != 0){
														if($value_res['sales_status'] == "1"){
															echo "<span style=\"font-weight: 700;\">M : </span>";
															
															if($value_res['commission'] != 0 ){
																echo "<span style=\"color:red\">$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}else{
																echo "<span>$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}
															
														}elseif($value_res['sales_status'] == "2"){
															echo "<span style=\"font-weight: 700;\">R : </span>";
															
															if($value_res['commission'] != 0 ){
																echo "<span style=\"color:red\">$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}else{
																echo "<span>$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}
															
														}else{
															echo "<span style=\"font-weight: 700;\">P : </span>";
															
															if($value_res['commission'] != 0 ){
																echo "<span style=\"color:red\">$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}else{
																echo "<span>$ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}
															
														}	
														
													}
												}
											}
										}	
									}		
									?>
								</td>	
								
									
								<td class="text-left nowrap" style="text-align:left;"> 	
									<?php 
										foreach ($getResponsible as $key_res => $value_res) {
											if($value_res['sales_status'] != "3"){
												if($value_res['sales_status'] == "1"){
													
													echo "<span style=\"font-weight: 700;\">M : </span>";
													
													if($value_res['commisson_payment_status'] == "Outstanding"){
														echo "<span style=\"color:red\">".$value_res['commisson_payment_status']."</span><br>";
													}else{
														echo "<span> ".$value_res['commisson_payment_status']."</span><br>";
													}
												}elseif($value_res['sales_status'] == "2"){
													
													echo "<span style=\"font-weight: 700;\">R : </span>";
													
													if($value_res['commisson_payment_status'] == "Outstanding"){
														echo "<span style=\"color:red\">".$value_res['commisson_payment_status']."</span><br>";
													}else{
														echo "<span> ".$value_res['commisson_payment_status']."</span><br>";
													}
													
												}else{
													
													echo "<span style=\"font-weight: 700;\">P : </span>";
													
													if($value_res['commisson_payment_status'] == "Outstanding"){
														echo "<span style=\"color:red\">".$value_res['commisson_payment_status']."</span><br>";
													}else{
														echo "<span> ".$value_res['commisson_payment_status']."</span><br>";
													}
													
												}
												
												
											}	
										}	
									?> 
									</td>
									<td class="text-left nowrap" style="text-align:left;"> 	
									<?php 
									foreach ($getResponsible as $key_res => $value_res) {
										if($value_res['sales_status'] != "3"){
											if($value_res['commisson_payment_status'] == "Paid"){
												
												if($value_res['sales_status'] == "1"){
													echo "<span style=\"font-weight: 700;\">M : </span>";
													
													echo "<span > $ ".number_format($value_res['pay_for_sales']  , 2)." ".$value_res['currency']."</span><br>";
												
													if($value_res['date_for_sales'] != "0000-00-00" ){ 
														$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
														"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
														"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
														"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
														 
														$commissiondate = $value_res['date_for_sales'];
														 
														list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
														  
														$yy_comm = $year_comm;
														$mm_comm = $momth_comm;
														$dd_comm = $day_comm; 
														
														if ($dd_comm < 10){
															$dd_comm = substr($dd_comm,1,2);
														}
														  $date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
														  
														echo "<span style=\"font-size:11px\">(Date : ".$date_comm.")</span><br>";
													}
												
												}elseif($value_res['sales_status'] == "2"){
													echo "<span style=\"font-weight: 700;\">R : </span>";
													
													echo "<span > $ ".number_format($value_res['pay_for_sales']  , 2)." ".$value_res['currency']."</span><br>";
												
													if($value_res['date_for_sales'] != "0000-00-00" ){ 
														$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
														"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
														"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
														"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
														 
														$commissiondate = $value_res['date_for_sales'];
														 
														list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
														  
														$yy_comm = $year_comm;
														$mm_comm = $momth_comm;
														$dd_comm = $day_comm; 
														
														if ($dd_comm < 10){
															$dd_comm = substr($dd_comm,1,2);
														}
														  $date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
														  
														echo "<span style=\"font-size:11px\">(Date : ".$date_comm.")</span><br>";
													}
												}else{
													echo "<span style=\"font-weight: 700;\">P : </span>";
													
													echo "<span > $ ".number_format($value_res['pay_for_sales']  , 2)." ".$value_res['currency']."</span><br>";
												
													if($value_res['date_for_sales'] != "0000-00-00" ){ 
														$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
														"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
														"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
														"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
														 
														$commissiondate = $value_res['date_for_sales'];
														 
														list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
														  
														$yy_comm = $year_comm;
														$mm_comm = $momth_comm;
														$dd_comm = $day_comm; 
														
														if ($dd_comm < 10){
															$dd_comm = substr($dd_comm,1,2);
														}
														  $date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
														  
														echo "<span style=\"font-size:11px\">(Date : ".$date_comm.")</span><br>";
													}
												}
												
												
											}
										}	
									}	
									?> 
									</td>
								<td class="text-left " style="word-wrap:break-word;text-align:left;" >  
									<?php 	
									foreach ($getResponsible as $key_res => $value_res) {
										if($value_res['sales_status'] != "3"){
											
											$comments = Yii::app()->db->createCommand()
												->select('*')
												->from('comments com')
												->where('com.invoice = "'.$value_res['id'].'"')
												->order('com.date_comments DESC')
												->limit('1')
												->queryAll();
												
												foreach ($comments as $key_co => $value_co) {
													if($value_res['sales_status'] == "1"){
														echo "<span style=\"font-weight: 700;\">(M) </span>";
															
														if($value_co['user_group']== "1"){
															echo "JOG : ";
														}elseif($value_co['user_group']== "2"){
																
														}		
														echo nl2br($value_co['comments'])."<br>" ;
															
													}elseif($value_res['sales_status'] == "2"){
														echo "<span style=\"font-weight: 700;\">(R) </span>";
															
														if($value_co['user_group']== "1"){
															echo "JOG : ";
														}elseif($value_co['user_group']== "2"){
																
														}		
														echo nl2br($value_co['comments'])."<br>" ;
															
													}else{
														echo "<span style=\"font-weight: 700;\">(P) : </span>";
															
														if($value_co['user_group']== "1"){
															echo "JOG : ";
														}elseif($value_co['user_group']== "2"){
																
														}		
														echo nl2br($value_co['comments'])."<br>" ;
													}
													
												}
										}		
									}		
									?> 
								</td>
								<td class="text-left nowrap" style="word-wrap:break-word;text-align:left;">  
									<?php 	
										foreach ($getResponsible as $key_res => $value_res) {
											if($value_res['sales_status'] != "3"){
												if($value_res['sales_status'] == "1"){
													echo "<span style=\"font-weight: 700;\">M : </span>";
													
													if($value_res['update_date'] != "0000-00-00" ){ 
														$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																																 
														list($year,$momth,$day) = explode("-",$value_res['update_date']);
																													
														if ($day < 10){
															$day = substr($day,1,2);
														}
																							
														$date = $_month_name[$momth]." ".$day.",  ".$year;
									?>								
														<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php							
													}else{
														$date = " ";
									?>								
												<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php
													}
													
												}elseif($value_res['sales_status'] == "2"){
													echo "<span style=\"font-weight: 700;\">R : </span>";
													
													if($value_res['update_date'] != "0000-00-00" ){ 
														$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																																 
														list($year,$momth,$day) = explode("-",$value_res['update_date']);
																													
														if ($day < 10){
															$day = substr($day,1,2);
														}
																							
														$date = $_month_name[$momth]." ".$day.",  ".$year;
									?>								
														<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php							
													}else{
														$date = " ";
									?>								
												<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php
													}
													
												}else{
													echo "<span style=\"font-weight: 700;\">P : </span>";
													
													if($value_res['update_date'] != "0000-00-00" ){ 
														$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																																 
														list($year,$momth,$day) = explode("-",$value_res['update_date']);
																													
														if ($day < 10){
															$day = substr($day,1,2);
														}
																							
														$date = $_month_name[$momth]." ".$day.",  ".$year;
									?>								
														<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php							
													}else{
														$date = " ";
									?>								
												<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php
													}
													
												}
												
											}
										}		
									?> 
								</td>
							</tr>
								<?php }} ?>	
								<?php	if($sumtotalSGD != 0 ){  ?>
							
							<tr style="background-color: #c1ffe6;">
								<td colspan=""></td>
								<td colspan=""></td>
								<td colspan=""></td>
								<td colspan=""></td>
								<td colspan=""></td>
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<span><?php echo "$ ".number_format($sumAmountReceivedSGD , 2)." SGD";?>  </span>
								</td>
								<td colspan=""></td>
								
								
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<span><?php echo "$ ".number_format($sumtotalSGD , 2)." SGD";?>  </span>
								</td>
								<td></td>
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<span><?php echo "$ ".number_format($totalcommissionSGD , 2)." SGD";?>  </span>									  
								</td>
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<?php if($commissionPaymentSGD == 0){	?>
											<span><?php echo "$ ".number_format($commissionPaymentSGD , 2)." SGD";?></span>
										<?php }else{ ?>
											<span style="color:red;padding:5px 10px;"><?php echo "$ ".number_format($commissionPaymentSGD , 2)." SGD";?></span>
										<?php } ?>
								</td>
								<td></td>
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<?php if(!empty($sumCommissionPaymaentSGD)){ ?>
										<span><?php echo "$ ".number_format($sumCommissionPaymaentSGD , 2)." SGD";?>  </span>
										<?php } ?>
								</td>
								<td></td>
								<td></td>
							</tr>
						<?php	} ?>			
						</tbody>
					</table>
				</div>
				<br>
			<?php }
			}
			foreach($currency_curr as $curr){ 
			if( $curr == "THB"){ ?>
				<div style="margin-bottom:10px;">
					<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/invioceTHB/year/<?php echo $year_commission;?>" class="paf_dowload" target="_blank"> PDF (THB)</a>
				</div>
				<br>
				<div class="text-center" style="background-color:rgb(169, 185, 199);color:rgb(51, 67, 80);padding: 10px 0" > 
					<h4  style="font-weight: 700;"><?php echo  $curr;?>  </h4>
				</div>
				<div id="freezer-Table" style="margin:0">
					<table id="calculatorTHBcomTable" class="table table-striped table-bordered table-condensed table-freeze-multi" style="border-collapse: initial;" data-scroll-max-height="600"data-cols-number="4">
						<colgroup>
							<col style="width:150px;">
							<col style="width:120px;">
							<col style="width:150px;">
							<col style="width:100px;">
							<col style="width:80px;">
							<col style="width:120px;">
							<col style="width:200px;">
							<col style="width:180px;">
							<col style="width:100px;">
							<col style="width:160px;">
							<col style="width:160px;">
							<col style="width:100px;">
							<col style="width:150px;">
							<col style="width:200px;">
							<col style="width:110px;">
						</colgroup>
						<thead>
							<tr>	
								
								<th colspan = "4" class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Invoice </th>
								<th colspan = "2"  class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Invoice Payment Status </th>
								<th colspan = ""  class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Sales Responsible </th>
								<th colspan = "4"  class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Commission Calculator</th>
								
								<th colspan = "2"  class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Commission Payment Status </th>
								<th colspan = ""  class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Comment </th>
								<th colspan = ""  class=" text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Update
								</th>
							</tr>
								<tr>
								
								<th class="bg-blue-light text-center" > Invoice # </th>
								<th class="bg-blue-light text-center" > Order No. </th>
								<th class="bg-blue-light text-center" > Order Name <br><span style="color:#fd6262;font-size:11px;">** Click Order Name ** <br> for Commission Calculator </span></th>
								<th class="bg-blue-light text-center" > Date/Quarter </th>
								
								<th class="bg-blue-light text-center" > Invoice Status</th>
								<th class="bg-blue-light text-center" > Amount Received</th>
								
								<th class="bg-blue-light text-center" > Sales Responsible </th>
								
								<th class="bg-blue-light text-center" > Total Sales </th>
								<th class="bg-blue-light text-center" > Commission% </th>
								<th class="bg-blue-light text-center" > Commission </th>
								<th class="bg-blue-light text-center" > Balance </th>
								
								<th class="bg-blue-light text-center" > Commission Status</th>
								<th class="bg-blue-light text-center" > Commission Payment</th>
								
								<th class="bg-blue-light text-center" > Comments </th>
								<th class="bg-blue-light text-center" > Last Update </th>
							</tr>
						</thead>
						<tbody>
						<?php
								foreach ($getData as $key => $value) {
									if($value['currency'] ==   $curr ){		
							?>
							<tr style="background: #ffffff;">
								
								<td class="text-left nowrap" style="vertical-align: middle;" > 
									<?php if($value['file_path'] != "Array" && $value['file_path'] != ""){ ?>
									<a href="<?php echo Yii::app()->request->baseUrl; ?>/invoice/docs/<?php echo $value['file_path'];?>" target="_blank"> 
										<?php echo $value['invoice'];?> 
									</a>
									<?php }else{?>
										<span style="color:red;"> 
										<?php echo $value['invoice'];?> 
										</span> 
									<?php
									} ?>
									
									<?php if($value['invoice_mail_status'] == "Send"){ ?>
										&nbsp; <a href="#" data-toggle="modal" data-target="#editSendMail"  data-id="<?php echo $value['id'];?>" title="Send E-mail to Customer"><i class="fa fa-envelope"></i></a>
									<?php }else{ ?>
										&nbsp; <a  href="#" data-toggle="modal" data-target="#editSendMail"  data-id="<?php echo $value['id'];?>" title="Send E-mail to Customer"><i class="fa fa-envelope-o"></i></a>
									<?php }	?>
								</td>
								<td class="text-left " style="vertical-align: middle;text-align:left;" > 
									<div class="col-md-12" style="vertical-align: middle;" >
									<?php 
										$data_order_no = str_replace(" ", '<br />', $value['order_no']);
										echo $data_order_no;
									?>
									</div>
								</td>
								<td class="" style="vertical-align: middle;text-align:left;">
									<div class="col-md-1" style="vertical-align: middle;" >
								<?php 
									if($value['invoice_status'] == "Paid"){ ?>
										<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
								<?php 		
									}elseif($value['invoice_status'] == "Outstanding"){ ?>
									
									<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
								<?php }	?>
									</div>
									<div class="col-md-10" style="vertical-align: middle;" >
										<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/commission/year/<?php //echo $year_commission; ?>/id/<?php echo $value['id'];?>" ><?php echo nl2br($value['order_name']);?>  </a>
									</div>
								</td>
								<?php  
									 $_month_name = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
										"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
										"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
										"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
									 
									 $vardate = $value['date_quarter'];
										list($year,$momth,$day) = explode("-",$vardate);
										$yy = $year;
										$mm = $momth;
										$dd = $day; 
									 
									if ($dd<10){
										$dd=substr($dd,1,2);
									}
									  $date= $_month_name[$mm]." ".$dd.",  ".$yy;
									  if($mm == "01" || $mm == "02" || $mm == "03"){
										  $quarter = "QTR 1";
									  }elseif($mm == "04" || $mm == "05" || $mm == "06"){
										  $quarter = "QTR 2";
									  }elseif($mm == "07" || $mm == "08" || $mm == "09"){
										  $quarter = "QTR 3";
									  }elseif($mm == "10" || $mm == "11" || $mm == "12"){
										  $quarter = "QTR 4";
									  }
									 //echo $date;
									?>
								<td class="text-center nowrap" style="vertical-align: middle;">  <?php echo $date."/<br>".$quarter;?> </td>
								<td class="text-center nowrap" style="vertical-align: middle;"> 
									<?php 
										if($value['invoice_status'] == "Outstanding"){
											echo "<span style=\"color:red\">".$value['invoice_status']."</span>";
										}else{
											echo "<span> ".$value['invoice_status']."</span>";
										}
									?> 
								
								</td>
									
								<td class="text-center nowrap" style="vertical-align: middle;"> 
									<?php 
										if($value['invoice_status'] == "Paid"){
											if($value['invoice_amount_received'] != 0){
												echo "<span > ฿ ".number_format($value['invoice_amount_received']  , 2)." ".$value['currency']."</span><br>";
												
												if($value['invoice_date'] != "0000-00-00"){
												 $_month_name_int = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
													"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
													"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
													"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
													 
													 $invoicedate = $value['invoice_date'];
													 
													 list($year_int,$momth_int,$day_int) = explode("-",$invoicedate);
													 
													 $yy_int = $year_int;
													 $mm_int = $momth_int;
													 $dd_int = $day_int; 
													if ($dd_int < 10){
														$dd_int = substr($dd_int,1,2);
													}
													  $date_int = $_month_name_int[$mm_int]." ".$dd_int.",  ".$yy_int;
													  
													echo "<span style=\"font-size:11px\">(Date : ".$date_int.")</span><br>";
												}	
											}
										}
									?> 
								
								</td>
								<td class="text-left nowrap" style="text-align:left;"> 
								<?php 
									if(!empty($commission_status)){
										$getResponsible = Yii::app()->db->createCommand()
										->select('*')
										->from('calculator c')
										->where('c.invoice = "'.$value['invoice'].'"')
										->andwhere('c.commisson_payment_status = "'.$commission_status.'"')
										->order('c.sales_status ASC')
										->queryAll();
									}else{
										$getResponsible = Yii::app()->db->createCommand()
										->select('*')
										->from('calculator c')
										->where('c.invoice = "'.$value['invoice'].'"')
										->order('c.sales_status ASC')
										->queryAll();
									}
									
									
									foreach ($getResponsible as $key_res => $value_res) {
				
										if($value_res['sales_status'] == "1"){ ?>
											<div id="sales_Responsible_manager">
														
												
													
												<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/ShowInvoiceDetail/year/<?php echo $year_commission; ?>/id/<?php echo $value_res['id'];?>" ><?php echo "<span style=\"font-weight: 700;\">M : </span>"; ?>
												<?php echo $value_res['sales_manager'];  ?></a><br>
											</div>		
													
										<?php }elseif($value_res['sales_status'] == "2"){ ?>
											<div id="sales_Responsible_salesrep">
												
													
												<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/ShowInvoiceDetail/year/<?php echo $year_commission; ?>/id/<?php echo $value_res['id'];?>" ><?php echo "<span style=\"font-weight: 700;\">R : </span>"; ?>
												<?php echo $value_res['sales_manager'];  ?></a><br>
											</div>		
										<?php }elseif($value_res['sales_status'] == "3"){ ?>
											<div id="sales_Responsible_processor">
												
														
												<?php echo "<span style=\"font-weight: 700;\">P : </span>"; ?>
												<?php echo $value_res['sales_manager']."<br>";  ?>
											</div>			
										<?php } 
									} 
									 ?>
										
						
								</td>
								
								<td class="text-left nowrap" style="text-align:left;">
									<?php 

										foreach ($getResponsible as $key_res => $value_res) {
									
											$totalsale = (($value_res['total_sales'] - $value_res['shipping_cost']) - $value_res['creditcard_feecost']);
												if($value_res['sales_status'] == "1"){
													if($value_res['total_sales'] != 0){
														if($value_res['status_commission'] == "Approved"){ ?>
															<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
									<?php 		
														}elseif($value_res['status_commission'] == "Not Approved"){ ?>
															<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
									<?php 				}else{	?>
															<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
									<?php 				}
									
														echo "<span style=\"font-weight: 700;\">M : </span>";
														echo "฿ ".number_format($totalsale , 2)." ".$value_res['currency']."<br>";
													}else{
														echo "<span style=\"font-weight: 700;\"> </span><br>";
													}	
												}elseif($value_res['sales_status'] == "2"){
													if($value_res['total_sales'] != 0){
														if($value_res['status_commission'] == "Approved"){ ?>
															<i class="fa fa-square" aria-hidden="true" style="color:green"></i>&nbsp;
									<?php 		
														}elseif($value_res['status_commission'] == "Not Approved"){ ?>
															<i class="fa fa-square" aria-hidden="true" style="color:red"></i>&nbsp;
									<?php 				}else{	?>
															<i class="fa fa-square" aria-hidden="true" style="color:#e68c00"></i>&nbsp;
									<?php 				}
														echo "<span style=\"font-weight: 700;\">R : </span>";
														echo "฿ ".number_format($totalsale , 2)." ".$value_res['currency']."<br>";
													}else{
														echo "<span style=\"font-weight: 700;\"> </span><br>";
													}	
												}
												
											 
										} 
								
									?>
								</td>
								<td class="text-left nowrap" style="text-align:left;">
									
									<?php 
									foreach ($getResponsible as $key_res => $value_res) {
										if($value_res['sales_status'] == "1"){
											if($value_res['total_sales'] != 0){
												echo "<span style=\"font-weight: 700;\">M : </span>";
												echo $value_res['commission_percent']."% <br>";
											}else{
												echo "<span style=\"font-weight: 700;\"> </span><br>";
											}
										}elseif($value_res['sales_status'] == "2"){
											if($value_res['total_sales'] != 0){
												echo "<span style=\"font-weight: 700;\">R : </span>";
												echo $value_res['commission_percent']."% <br>";
											}else{
												echo "<span style=\"font-weight: 700;\"> </span><br>";
											}
										}	
									}	
									?>
								</td>
								<td class="text-left nowrap" style="text-align:left;">
									<?php 
									foreach ($getResponsible as $key_res => $value_res) {
											
										if($value_res['sales_status'] == "1"){
											if($value_res['total_sales'] != 0){
												echo "<span style=\"font-weight: 700;\">M : </span>";
												echo "฿ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."<br>";
											}else{
												echo "<span style=\"font-weight: 700;\"> </span><br>";
											}
										}elseif($value_res['sales_status'] == "2"){
											if($value_res['total_sales'] != 0){
												echo "<span style=\"font-weight: 700;\">R : </span>";
												echo "฿ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."<br>";
											}else{
												echo "<span style=\"font-weight: 700;\"> </span><br>";
											}	
										}	
									}	
									?>
								</td>
								<td class="text-left nowrap" style="text-align:left;">
								<?php 
									foreach ($getResponsible as $key_res => $value_res) {
										if($value_res['sales_status'] != "3"){
											if($value_res['invoice_status'] == "Paid"){	
											
												if($value_res['commisson_payment_status'] == "Paid"){
													
													if($value_res['sales_status'] == "1"){
														
														echo "<span style=\"font-weight: 700;\">M : </span>";
														$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];
														
														if($balance_invoice != 0 ){
															echo "<span style=\"color:red\">฿ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}else{
															echo "<span>฿ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}
														
													}elseif($value_res['sales_status'] == "2"){
														
														echo "<span style=\"font-weight: 700;\">R : </span>";
														
														$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];
														
														if($balance_invoice != 0 ){
															echo "<span style=\"color:red\">฿ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}else{
															echo "<span>฿ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}
														
													}else{
														echo "<span style=\"font-weight: 700;\">P : </span>";
														
														$balance_invoice = $value_res['commission'] - $value_res['pay_for_sales'];
														
														if($balance_invoice != 0 ){
															echo "<span style=\"color:red\">฿ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}else{
															echo "<span>฿ ".number_format($balance_invoice  , 2)." ".$value_res['currency']."</span><br>";
														}
													}	
													
													
													
												}else{
													if($totalsale != 0){
														if($value_res['sales_status'] == "1"){
															echo "<span style=\"font-weight: 700;\">M : </span>";
															
															if($value_res['commission'] != 0 ){
																echo "<span style=\"color:red\">฿ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}else{
																echo "<span>฿ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}
															
														}elseif($value_res['sales_status'] == "2"){
															echo "<span style=\"font-weight: 700;\">R : </span>";
															
															if($value_res['commission'] != 0 ){
																echo "<span style=\"color:red\">฿ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}else{
																echo "<span>฿ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}
															
														}else{
															echo "<span style=\"font-weight: 700;\">P : </span>";
															
															if($value_res['commission'] != 0 ){
																echo "<span style=\"color:red\">฿ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}else{
																echo "<span>฿ ".number_format($value_res['commission'] , 2)." ".$value_res['currency']."</span><br>";
															}
															
														}	
														
													}
												}
											}
										}	
									}		
									?>
								</td>	
								
									
								<td class="text-left nowrap" style="text-align:left;"> 	
									<?php 
										foreach ($getResponsible as $key_res => $value_res) {
											if($value_res['sales_status'] != "3"){
												if($value_res['sales_status'] == "1"){
													
													echo "<span style=\"font-weight: 700;\">M : </span>";
													
													if($value_res['commisson_payment_status'] == "Outstanding"){
														echo "<span style=\"color:red\">".$value_res['commisson_payment_status']."</span><br>";
													}else{
														echo "<span> ".$value_res['commisson_payment_status']."</span><br>";
													}
												}elseif($value_res['sales_status'] == "2"){
													
													echo "<span style=\"font-weight: 700;\">R : </span>";
													
													if($value_res['commisson_payment_status'] == "Outstanding"){
														echo "<span style=\"color:red\">".$value_res['commisson_payment_status']."</span><br>";
													}else{
														echo "<span> ".$value_res['commisson_payment_status']."</span><br>";
													}
													
												}else{
													
													echo "<span style=\"font-weight: 700;\">P : </span>";
													
													if($value_res['commisson_payment_status'] == "Outstanding"){
														echo "<span style=\"color:red\">".$value_res['commisson_payment_status']."</span><br>";
													}else{
														echo "<span> ".$value_res['commisson_payment_status']."</span><br>";
													}
													
												}
												
												
											}	
										}	
									?> 
									</td>
									<td class="text-left nowrap" style="text-align:left;"> 	
									<?php 
									foreach ($getResponsible as $key_res => $value_res) {
										if($value_res['sales_status'] != "3"){
											if($value_res['commisson_payment_status'] == "Paid"){
												
												if($value_res['sales_status'] == "1"){
													echo "<span style=\"font-weight: 700;\">M : </span>";
													
													echo "<span > ฿ ".number_format($value_res['pay_for_sales']  , 2)." ".$value_res['currency']."</span><br>";
												
													if($value_res['date_for_sales'] != "0000-00-00" ){ 
														$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
														"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
														"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
														"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
														 
														$commissiondate = $value_res['date_for_sales'];
														 
														list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
														  
														$yy_comm = $year_comm;
														$mm_comm = $momth_comm;
														$dd_comm = $day_comm; 
														
														if ($dd_comm < 10){
															$dd_comm = substr($dd_comm,1,2);
														}
														  $date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
														  
														echo "<span style=\"font-size:11px\">(Date : ".$date_comm.")</span><br>";
													}
												
												}elseif($value_res['sales_status'] == "2"){
													echo "<span style=\"font-weight: 700;\">R : </span>";
													
													echo "<span > ฿ ".number_format($value_res['pay_for_sales']  , 2)." ".$value_res['currency']."</span><br>";
												
													if($value_res['date_for_sales'] != "0000-00-00" ){ 
														$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
														"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
														"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
														"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
														 
														$commissiondate = $value_res['date_for_sales'];
														 
														list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
														  
														$yy_comm = $year_comm;
														$mm_comm = $momth_comm;
														$dd_comm = $day_comm; 
														
														if ($dd_comm < 10){
															$dd_comm = substr($dd_comm,1,2);
														}
														  $date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
														  
														echo "<span style=\"font-size:11px\">(Date : ".$date_comm.")</span><br>";
													}
												}else{
													echo "<span style=\"font-weight: 700;\">P : </span>";
													
													echo "<span > ฿ ".number_format($value_res['pay_for_sales']  , 2)." ".$value_res['currency']."</span><br>";
													
													if($value_res['date_for_sales'] != "0000-00-00" ){ 
														$_month_name_comm = array("01"=>"Jan.",  "02"=>"Feb.",  "03"=>"Mar.",    
														"04"=>"Apr.",  "05"=>"May.",  "06"=>"Jun.",    
														"07"=>"Jul.",  "08"=>"Aug.",  "09"=>"Sep.",    
														"10"=>"Oct.", "11"=>"Nov.",  "12"=>"Dec."); 
														 
														$commissiondate = $value_res['date_for_sales'];
														 
														list($year_comm,$momth_comm,$day_comm) = explode("-",$commissiondate);
														  
														$yy_comm = $year_comm;
														$mm_comm = $momth_comm;
														$dd_comm = $day_comm; 
														
														if ($dd_comm < 10){
															$dd_comm = substr($dd_comm,1,2);
														}
														  $date_comm = $_month_name_comm[$mm_comm]." ".$dd_comm.",  ".$yy_comm;
														  
														echo "<span style=\"font-size:11px\">(Date : ".$date_comm.")</span><br>";
													}
												}
												
												
											}
										}	
									}	
									?> 
									</td>
								<td class="text-left " style="word-wrap:break-word;text-align:left;" >  
									<?php 	
									foreach ($getResponsible as $key_res => $value_res) {
										if($value_res['sales_status'] != "3"){
											
											$comments = Yii::app()->db->createCommand()
												->select('*')
												->from('comments com')
												->where('com.invoice = "'.$value_res['id'].'"')
												->order('com.date_comments DESC')
												->limit('1')
												->queryAll();
												
												foreach ($comments as $key_co => $value_co) {
													if($value_res['sales_status'] == "1"){
														echo "<span style=\"font-weight: 700;\">(M) </span>";
															
														if($value_co['user_group']== "1"){
															echo "JOG : ";
														}elseif($value_co['user_group']== "2"){
																
														}		
														echo nl2br($value_co['comments'])."<br>" ;
															
													}elseif($value_res['sales_status'] == "2"){
														echo "<span style=\"font-weight: 700;\">(R) </span>";
															
														if($value_co['user_group']== "1"){
															echo "JOG : ";
														}elseif($value_co['user_group']== "2"){
																
														}		
														echo nl2br($value_co['comments'])."<br>" ;
															
													}else{
														echo "<span style=\"font-weight: 700;\">(P) : </span>";
															
														if($value_co['user_group']== "1"){
															echo "JOG : ";
														}elseif($value_co['user_group']== "2"){
																
														}		
														echo nl2br($value_co['comments'])."<br>" ;
													}
													
												}
										}		
									}		
									?> 
								</td>
								<td class="text-left nowrap" style="word-wrap:break-word;text-align:left;">  
									<?php 	
										foreach ($getResponsible as $key_res => $value_res) {
											if($value_res['sales_status'] != "3"){
												if($value_res['sales_status'] == "1"){
													echo "<span style=\"font-weight: 700;\">M : </span>";
													
													if($value_res['update_date'] != "0000-00-00" ){ 
														$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																																 
														list($year,$momth,$day) = explode("-",$value_res['update_date']);
																													
														if ($day < 10){
															$day = substr($day,1,2);
														}
																							
														$date = $_month_name[$momth]." ".$day.",  ".$year;
									?>								
														<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php							
													}else{
														$date = " ";
									?>								
												<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php
													}
													
												}elseif($value_res['sales_status'] == "2"){
													echo "<span style=\"font-weight: 700;\">R : </span>";
													
													if($value_res['update_date'] != "0000-00-00" ){ 
														$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																																 
														list($year,$momth,$day) = explode("-",$value_res['update_date']);
																													
														if ($day < 10){
															$day = substr($day,1,2);
														}
																							
														$date = $_month_name[$momth]." ".$day.",  ".$year;
									?>								
														<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php							
													}else{
														$date = " ";
									?>								
												<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php
													}
													
												}else{
													echo "<span style=\"font-weight: 700;\">P : </span>";
													
													if($value_res['update_date'] != "0000-00-00" ){ 
														$_month_name = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																																 
														list($year,$momth,$day) = explode("-",$value_res['update_date']);
																													
														if ($day < 10){
															$day = substr($day,1,2);
														}
																							
														$date = $_month_name[$momth]." ".$day.",  ".$year;
									?>								
														<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php							
													}else{
														$date = " ";
									?>								
												<span style="font-size:12px;"><?php echo $date; ?></span><br>
									<?php
													}
													
												}
												
											}
										}		
									?> 
								</td>
							</tr>
								<?php }} ?>	
								<?php	if($sumtotalTHB!= 0 ){  ?>
							
							<tr style="background-color: #c1ffe6;">
								<td colspan=""></td>
								<td colspan=""></td>
								<td colspan=""></td>
								<td colspan=""></td>
								<td colspan=""></td>
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<span><?php echo "฿ ".number_format($sumAmountReceivedTHB , 2)." THB";?>  </span>
								</td>
								<td colspan=""></td>
								
								
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<span><?php echo "฿ ".number_format($sumtotalTHB , 2)." THB";?>  </span>
								</td>
								<td></td>
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<span><?php echo "฿ ".number_format($totalcommissionTHB , 2)." THB";?>  </span>									  
								</td>
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<?php if($commissionPaymentTHB == 0){	?>
											<span><?php echo "฿ ".number_format($commissionPaymentTHB , 2)." THB";?></span>
										<?php }else{ ?>
											<span style="color:red;padding:5px 10px;"><?php echo "฿ ".number_format($commissionPaymentTHB , 2). " THB";?></span>
										<?php } ?>
								</td>
								<td></td>
								<td class="text-right nowrap" style="color: #006400;vertical-align: middle;font-weight:700;">
										<?php if(!empty($sumCommissionPaymaentTHB)){	?>
											<span><?php echo "฿ ".number_format($commissionPaymentTHB , 2)." THB";?></span>
										<?php } ?>
								</td>
								<td></td>
								<td></td>
							</tr>
						<?php	} ?>	
						</tbody>
					</table>
				</div>
				<br>				
			<?php }?>
		<?php }?>
					
				<br>
				<br>
				
				<table id="bankTable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="bg-blue-light" >Notes</th>
							
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="word-wrap:break-word;"><?php echo nl2br($notes['notes']); ?></td>
							
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>	
</div>	


<div class="modal fade" id="editSendMail" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Send Mail to Customer</h4>
			</div>
			<div class="modal-body">
           
                <?php echo $this->renderPartial('/calculator/editSendmail');  ?>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="send-submit-mail">Send</button>
			</div>
		</div>
	</div>
</div>
