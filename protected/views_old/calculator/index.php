<div class="row" id="calculator">

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Invoice</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div> 2018 Year </div>
					<table id="calculatorTable" class="table table-striped table-bordered" style="border-collapse: initial;">
						<thead>
							<tr>
								<th class="bg-blue-light text-center" > Invoice # </th>
								<th class="bg-blue-light text-center" > Order Name </th>
								<th class="bg-blue-light text-center" > Date/Quarter </th>
								<th class="bg-blue-light text-center" > Commissionable Sales </th>
								<th class="bg-blue-light text-center" > Comments </th>
							</tr>
						</thead>
						<tbody>
						<?php
								foreach ($getData as $key => $value) {
							?>
							<tr>
								<td class="text-center" > 
									<a href="<?php echo Yii::app()->request->baseUrl; ?>"> 
										<?php echo $value['invoice'];?> 
									</a>
								</td>
								<td class="text-center" >
									  <?php echo $value['order_name'];?>  
								</td>
								<?php  
									 $_month_name = array("01"=>"January",  "02"=>"February",  "03"=>"March",    
										"04"=>"April",  "05"=>"May",  "06"=>"June",    
										"07"=>"July",  "08"=>"August",  "09"=>"September",    
										"10"=>"October", "11"=>"November",  "12"=>"December"); 
									 
									 $vardate= $value['date_quarter'];
									 $yy=date('Y');
									 $mm =date('m');
									 $dd=date('d'); 
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
								<td class="text-center" >  <?php echo $date."/ ".$quarter;?> </td>
								<td class="text-center" >  <?php  $Commissionable = ($value['total_sales'] - $value['shipping_cost']) - $value['creditcard_feecost']; 
									echo "$ ".$Commissionable." ".$value['currency'];
									?>  
									<i class="fa fa-calculator" aria-hidden="true" data-toggle="modal" data-target="#editData" data-id="<?php echo $value['id']; ?>"></i>
									</td>
								<td class="text-center" >  Test System</td>
							</tr>
								<?php } ?>	
						</tbody>
					</table>
					
					<table id="notesTable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="bg-blue-light" >Notes</th> 
							<th class="bg-blue-light" >Bank Account Details:</th> 
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Shipping Fee is not included in the commission total  if stated on the invoice <br> Payments will be paid within 30 days after payment has been received <br> Sales Commission % on orders that the sales reps handles all details etc. is 10% <br> Sales Commission % on referals to JOG Sports  7%   ( extra work via phone calls etc. to seal the deal) <br>Sales Commision % on re-orders from customers 5%   (example small re-load of inventory etc) <br> Commission % on referrals that lead to sales will be 3% <br> **  Note on some projects where we have to lower the price to seal the deal commission % maybe decreased a bit **</td>
							<td> Bank account name:Jogsports <br>
								 Bank name and adress: Bangkok <br> Account number: 999999999999

							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>	
</div>	

<div class="modal fade" id="editData" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Sales Commission Calculator</h4>
			</div>
			<div class="modal-body">
                <?php echo $this->renderPartial('/calculator/editCalculator');  ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-calculator">Save</button>
			</div>
		</div>
	</div>
</div>