<style>
	
	.bg-usd, .bg-cad, .bg-price{
		text-align: center;
		vertical-align: middle;
	}
	.pre {
		white-space: pre;
	}
	#freezer-Table .table tbody td {
		outline: 1px solid #ddd;
	}
</style>

<div class="row" id="calculator">
	<div class="row mt-20">
		<div class="col-md-12">
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/calculator/Invoice/year/<?php echo $year_commission; ?>" class="link"  >
				<i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Go Back
			</a>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2><?php echo $sales; ?> - Sales Commission Calculator</h2>
				
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<a href="<?php echo Yii::app()->baseUrl; ?>/pdf/commissionDetail/id/<?php echo $id;?>/sale/<?php echo $sales; ?>" class="paf_dowload" style="float: right;" target="_blank"> PDF </a>
				<?php foreach ($getDetail as $key => $value) { 
				?>
					<div class="row" >
						<div class="col-md-6">
							<?php  
								 $_month_name = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
											 
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
									
								
							?>
							<table id="calculatorSendTable">
								<tr>
									<td>Invoice :</td>
									<td>
										&nbsp;<a href="<?php echo Yii::app()->request->baseUrl; ?>/invoice/docs/<?php echo $value['file_path'];?>"><?php echo $value['invoice'];?> <i class="fa fa-file-text-o" aria-hidden="true"></i></a>
									</td>
								</tr>
								<tr>
									<td>Order No :</td>
									<td>
										 <?php echo "&nbsp;".$value['order_no'];?> 
									</td>
								</tr>
								<tr>
									<td>Order Name :</td>
									<td>
										 <?php echo "&nbsp;".$value['order_name'];?> 
									</td>
								</tr>
								<tr>
									<td>Date/Quarter :</td>
									<td>
										 <?php echo "&nbsp;".$date."/ ".$quarter;?>  
									</td>
								</tr>
								<tr>
									<td>Commission Status :</td>
									<td>
										<?php 
											if($value['status_commission'] == "Not Approved"){ 
												echo "&nbsp;<span style=\"color:red\">".$value['status_commission']."</span>";
											}elseif($value['status_commission'] == "Approved"){ 
												echo "&nbsp;<span style=\"color:green\">".$value['status_commission']."</span>"; 
											}else{ 
												echo "&nbsp;<span style=\"color:#e68c00\">Pending</span>"; 
											}
										?>
									</td>
								</tr>
								
								<tr>
									<td>Invoice Mailing Status : </td>
									<td>
										<?php if($value['invoice_mail_status'] == "Send"){ ?>
											&nbsp; <a href="#" data-toggle="modal" data-target="#editSendMail"  data-id="<?php echo $id;?>" title="Send E-mail to Customer"><i class="fa fa-envelope"></i></a> Sent
										<?php }else{ ?>
											&nbsp; <a  href="#" data-toggle="modal" data-target="#editSendMail"  data-id="<?php echo $id;?>" title="Send E-mail to Customer"><i class="fa fa-envelope-o"></i> Not Send </a>
										<?php }	?> 
									</td>
								</tr>
								<tr>
									<td>Last Update! :</td>
									<td>
										<?php
											if($value['update_date'] != "0000-00-00" ){ 
																		
												$_month_name = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
																													 
												list($year,$momth,$day) = explode("-",$value['update_date'] );
																										
												if ($day < 10){
													$day = substr($day,1,2);
												}
																				
												$date = $_month_name[$momth]." ".$day.",  ".$year;
														
											}else{
												$date = " - ";
											}
										?>
										<span style="color:red;font-size:12px;"> <?php echo $date ?><span>
									
									</td>
								</tr>
							</table>
							
						</div>
						<div class="col-md-6">
							<table>
								<tr>
									<td>Sales : </td>
									<td style="padding:0 5px;"><?php echo $value['fullname'];?></td>
								</tr>
								<tr>
									<td>Phone : </td>
									<td style="padding:0 5px;"><?php echo $value['phone'];?></td>
								</tr>
								<tr>
									<td>Email : </td>
									<td style="padding:0 5px;"><?php echo $value['email'];?></td>
								</tr>
								<tr>
									<td>Prosition : </td>
									<td style="padding:0 5px;">
										<?php  
											if($value['sales_status'] == 1){
												echo "Manager";
											}elseif($value['sales_status'] == 2){
												echo "Sales Rep";
											}elseif($value['sales_status'] == 3){
												echo "Processor";
											}
										?>
									</td>
								</tr>
							</table>
						</div>
					</div>
				
						<div class="btn-add" id="calculatorTable">
							<a href="#" class="btn btn-success" data-toggle="modal" data-target="#editData" data-id="<?php echo $id;?>"><i class="fa fa-pencil"></i> Edit </a>
						</div>
						<div id="freezer-Table" style="margin:0">
								<table id="calculatorDetailTable" class="table table-striped table-bordered table-condensed table-freeze-multi" style="border-collapse: initial;" data-scroll-height="180"data-cols-number="4">
									<colgroup>
									  <col style="width: 120px;">
									  <col style="width: 120px;">
									  <col style="width: 150px;">
									  <col style="width: 150px;">
									  <col style="width: 180px;">
									  <col style="width: 150px;">
									  <col style="width: 180px;">
									  <col style="width: 180px;">
									  <col style="width: 120px;">
									  <col style="width: 120px;">
									  <col style="width: 180px;">
									  <col style="width: 150px;">
									</colgroup>
									<thead>
										<tr>
											<th colspan="4" class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Invoice </th>
											<th colspan="4" class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Commission Calculator </th>
											<th colspan="4" class="text-center" style="background-color:#89939c;color:rgb(51, 67, 80);"> Commission </th>

										</tr>
										<tr>
											<th class="bg-blue-light text-center" > Payment Status </th>
											<th class="bg-blue-light text-center" > Date </th>
											<th class="bg-blue-light text-center" > Amount Received </th>
											<th class="bg-blue-light text-center" > Payment Method </th>
											
											<th class="bg-blue-light text-center" > Total Sales </th>
											<th class="bg-blue-light text-center" > Commission% </th>
											<th class="bg-blue-light text-center" > Commission </th>
											<th class="bg-blue-light text-center" > Balance </th>
											
											<th class="bg-blue-light text-center" > Payment Status </th>
											<th class="bg-blue-light text-center" > Date </th>
											<th class="bg-blue-light text-center" > Pay Outs </th>
											<th class="bg-blue-light text-center" > Payment Method</th>
	
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center nowrap" style="vertical-align: middle;">
												<?php if($value['invoice_status'] == "Outstanding"){?>
												<span style="color:red"><?php echo $value['invoice_status']?></span>
												<?php }else{ ?>
												<span><?php echo $value['invoice_status']?></span>
												<?php }?>
									
											</td>
											
											<td class="text-center nowrap" style="vertical-align: middle;">
												<span>
												<?php 
													if($value['invoice_status'] == "Paid"){
														if($value['invoice_date'] != "0000-00-00"){
															
															$_month_invoice = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
															
															$invdate = $value['invoice_date'];
															list($year_v,$momth_v,$day_v) = explode("-",$invdate);
															$yy_v = $year_v;
															$mm_v = $momth_v;
															$dd_v = $day_v; 
															if ($dd_v < 10){
																$dd_v = substr($dd_v,1,2);
															}
															$date_v = $_month_invoice[$mm_v]." ".$dd_v.",  ".$yy_v;
														
															echo $date_v; 
														}
													}		
												?>
														
												</span>
											</td>
											<td class="text-center nowrap" style="vertical-align: middle;">
											<?php 
												if($value['invoice_status'] == "Paid"){
													if(!empty($value['invoice_amount_received'])){ 
														if($value['currency'] == "THB"){
															echo "<span> ฿ ".number_format($value['invoice_amount_received'] , 2)." ".$value['currency']."</span>";
														}else{
															echo "<span> $ ".number_format($value['invoice_amount_received'] , 2)." ".$value['currency']."</span>";
														}
													}
												} ?>
											</td>
											<td class="text-center nowrap" style="vertical-align: middle;">
												<span><?php if($value['invoice_status'] == "Paid"){ echo $value['invoice_payment_method']; } ?></span>
											</td>
											<td class="text-center nowrap" style="vertical-align: middle;">
												<span>
												<?php  $Commissionable = ($value['total_sales'] - $value['shipping_cost']) - $value['creditcard_feecost'];
												if($Commissionable != 0){
													if($value['currency'] == "THB"){
														echo "฿ ".number_format($Commissionable , 2)." ".$value['currency'];
													}else{
														echo "$ ".number_format($Commissionable , 2)." ".$value['currency'];
													}	
												}	
												?> 
												</span>	
											</td>
											<td class="text-center nowrap" style="vertical-align: middle;">  
												<span>
													<?php 
														if($value['commission_percent'] != 0){ 
															echo $value['commission_percent']."%";
														}	
													?> 
												</span>
											</td>
											<td class="text-center nowrap" style="vertical-align: middle;">
												<span>
												<?php 
													$commission = $value['commission'];
													if($commission != 0){
														if($value['currency'] == "THB"){
															echo "฿ ".number_format($commission , 2)." ".$value['currency'];
														}else{
															echo "$ ".number_format($commission , 2)." ".$value['currency'];
														}
															
													}
													
												?> 
												</span>	
											</td>
											
											<td class="text-center nowrap" style="vertical-align: middle;">
											<?php 
												if($value['invoice_status'] == "Paid"){
													if($value['commisson_payment_status'] == "Paid"){
														
														$balance_invoice = $value['commission'] - $value['pay_for_sales'];
														if($balance_invoice != 0 ){
															if($value['currency'] == "THB"){
																echo "<span style=\"color:red\"> ฿ ".number_format($balance_invoice  , 2)." ".$value['currency']."</span>";
															}else{
																echo "<span style=\"color:red\"> $ ".number_format($balance_invoice  , 2)." ".$value['currency']."</span>";
															}
															
														}else{
															if($value['currency'] == "THB"){
																echo "<span> ฿ ".number_format($balance_invoice  , 2)." ".$value['currency']."</span>";
															}else{
																echo "<span> $ ".number_format($balance_invoice  , 2)." ".$value['currency']."</span>";
															}
															
														}
														
													}else{
														if($Commissionable != 0){
															if($value['currency'] == "THB"){
																echo "<span style=\"color:red\"> ฿ ".number_format($value['commission'] , 2)." ".$value['currency']."</span>";
															}else{
																echo "<span style=\"color:red\"> $ ".number_format($value['commission'] , 2)." ".$value['currency']."</span>";
															}
															
														}	
													}
												}	
											?> 
											</td>
											
											<td class="text-center nowrap" style="vertical-align: middle;">
												<?php if($value['commisson_payment_status'] == "Outstanding"){?>
												<span style="color:red"><?php echo $value['commisson_payment_status']?></span>
												<?php }else{ ?>
												<span><?php echo $value['commisson_payment_status']?></span>
												<?php }?>
									
											</td>
											
											<td class="text-center nowrap" style="vertical-align: middle;">
												<span>
												<?php 
												if($value['invoice_status'] == "Paid" && $value['commisson_payment_status'] == "Paid"){
													if($value['date_for_sales'] != "0000-00-00"){
													 $_month_name_s = array("01"=>"Jan.", "02"=>"Feb.", "03"=>"Mar.","04"=>"Apr.", "05"=>"May.", "06"=>"Jun.", "07"=>"Jul.", "08"=>"Aug.", "09"=>"Sep.", "10"=>"Oct.", "11"=>"Nov.", "12"=>"Dec."); 
																 
													$date_for_sales = $value['date_for_sales'];
													list($year_s,$momth_s,$day_s) = explode("-",$date_for_sales);
													
													if ($day_s < 10){
														$day_s = substr($day_s,1,2);
													}
													$date_s = $_month_name_s[$momth_s]." ".$day_s.",  ".$year_s;
													
														echo $date_s;
													}
												}
												?>
												</span>
											</td>
											<td class="text-center nowrap" style="vertical-align: middle;"> 
												<span>
												<?php 
												if($value['invoice_status'] == "Paid" && $value['commisson_payment_status'] == "Paid"){
													if($value['pay_for_sales'] != 0){
														if($value['currency'] == "THB"){
															echo "฿ ".number_format($value['pay_for_sales'] , 2)." ".$value['currency'];
														}else{
															echo "$ ".number_format($value['pay_for_sales'] , 2)." ".$value['currency'];
														}	
													}
												}	
												?>
												</span>												
											</td>
											<td class="text-center nowrap" style="vertical-align: middle;"> <span> <?php if($value['invoice_status'] == "Paid" && $value['commisson_payment_status'] == "Paid"){ echo $value['payment_method']; } ?></span> </td>
											
										</tr>	
									</tbody>
								</table>
							</div>
								
				<?php } ?>	
							
					<br>
					<br>
					<br>
					<div class="row" >
							<div class="form-group">
									
									<h2>Comments</h2>
					
									<?php if(!empty($comments)) : ?>
										<?php foreach ($comments as $cmm => $comment) :  
											if ($comment['user_group'] == 99 || $comment['user_group'] == 1) {
													$style = 'border: 1px solid green;background-color: #e9f3e9;';
												} else {
													$style = '';
												}
										?>
										<div class="row comment-box">
												
												<div class="box" style="<?php echo $style; ?>">
													<button class="btn btn-danger confirm" del-id="<?php echo $comment['id'];?>" del-link="<?php echo Yii::app()->request->baseUrl; ?>/calculator/deleteCommentInvoice" style="float: right;">
														<i class="fa fa-close"></i>
													</button>	
												
													<label><?php echo $comment['salerep']; ?> : </label>
													<span>
														<?php
															echo $comment['comments']; 
														?>
													</span> 
													<br />
													<sup><?php echo $comment['date_comments']; ?></sup>
												</div>
												
										</div>
										<hr>
										<?php endforeach;  ?>
									<?php endif; ?>
									<br>
								
							</div>
							<div class="row" id="comment">
								<?php 
									$form=$this->beginWidget('CActiveForm', array(
										'id'          => 'comment-form',
										'action'      => Yii::app()->request->baseUrl . '/calculator/commentInvioceShow',
										'htmlOptions' => array(
											'class'   => 'form-horizontal',
											),
										)); 
								   
									echo CHtml::hiddenField('Comments[id]', $id);
									
									$model = new Comments;
									$model->salerep = Yii::app()->user->getState('fullName');
									$model->user_group = Yii::app()->user->getState('userGroup');
									echo $form->hiddenField($model, 'salerep');
									echo $form->hiddenField($model, 'user_group');
									
									echo $form->textArea($model, 'comments', array('class' => 'form-control', 'placeholder' => 'Comments', 'required' => true));

								?>
									<input type="hidden" name="year" value="<?php echo $year_commission; ?>">
								<button type="submit" class="btn btn-info pull-right mt-5">Send</button>

								<?php 
									$this->endWidget();
								?>

							</div>
						
						
					</div>
					<br>
					<br>
					<br>
					<div class="btn-add">
						<a href="#" class="btn btn-success" data-toggle="modal" data-target="#editBank"><i class="fa fa-pencil"></i> Edit</a>
					</div>
					<table id="bankTable" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="bg-blue-light" style="width:50%">Notes</th>
								<th class="bg-blue-light" style="width:50%">Bank Account Details:</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="word-wrap:break-word;"><?php echo nl2br($notes['notes']); ?></td>
								<td style="word-wrap:break-word;">
									<div><span style="font-weight: 700;" >Bank Name : </span><?php echo $bankAccount['bank_name']; ?></div>
									<div><span style="font-weight: 700;" >Account Name : </span><?php echo $bankAccount['bank_account_name']; ?></div>
									<div><span style="font-weight: 700;" >Account Number : </span><?php echo $bankAccount['bank_number']; ?></div>
									<div><span style="font-weight: 700;" >Swift Code : </span><?php echo $bankAccount['bank_swift_code']; ?></div>
									<div><span style="font-weight: 700;" >Make check payable to : </span><?php echo $bankAccount['bank_name_check']; ?></div>
									<div><span style="font-weight: 700;" >Mailing Address : </span><?php echo $bankAccount['bank_mailing_address']; ?></div>
									<div><span style="font-weight: 700;" >Other : </span><?php echo $bankAccount['bank_other']; ?></div>
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
				<h4 class="modal-title">Sales Commission Calculator- Edit</h4>
			</div>
			<div class="modal-body">
                <?php echo $this->renderPartial('/calculator/editCalculatorInvoiceDetail');  ?>
			</div>
			
		</div>
	</div>
</div>
<div class="modal fade" id="editBank" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Bank Account</h4>
			</div>
			<div class="modal-body">
            <?php 
            	$form=$this->beginWidget('CActiveForm', array(
					'id'          => 'edit-bank-form',
					'htmlOptions' => array(
						'class'  => 'form-horizontal form-label-left',
						),
					));
				?>
				<div class="form-group">
					<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $bankAccount->getAttributeLabel('bank_name'); ?></label>
					<div class="col-md-9 col-sm-6 col-xs-12">
						<?php echo $form->hiddenField($bankAccount, 'fullname'); ?>
						
						<?php echo $form->textField($bankAccount, 'bank_name', array('class'=>'form-control', 'required' => true)); ?>
					</div>
				</div>

                <div class="form-group">
					<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $bankAccount->getAttributeLabel('bank_account_name'); ?></label>
					<div class="col-md-9 col-sm-6 col-xs-12">
						
						<?php echo $form->textField($bankAccount, 'bank_account_name', array('class'=>'form-control', 'required' => true)); ?>
						
					</div>
				</div>

                <div class="form-group">
					<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $bankAccount->getAttributeLabel('bank_number'); ?></label>
					<div class="col-md-9 col-sm-6 col-xs-12">

						<?php echo $form->textField($bankAccount, 'bank_number', array('class'=>'form-control', 'required' => true)); ?>
						
					</div>
				</div>

                <div class="form-group">
					<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $bankAccount->getAttributeLabel('bank_swift_code'); ?></label>
					<div class="col-md-9 col-sm-6 col-xs-12">
						
						<?php echo $form->textField($bankAccount, 'bank_swift_code', array('class'=>'form-control')); ?>
						
					</div>
				</div>

                <div class="form-group">
					<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $bankAccount->getAttributeLabel('bank_name_check'); ?></label>
					<div class="col-md-9 col-sm-6 col-xs-12">
						
						<?php echo $form->textField($bankAccount, 'bank_name_check', array('class'=>'form-control')); ?>
						
					</div>
				</div>

                <div class="form-group">
					<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $bankAccount->getAttributeLabel('bank_mailing_address'); ?></label>
					<div class="col-md-9 col-sm-6 col-xs-12">
						
						<?php echo $form->textArea($bankAccount, 'bank_mailing_address', array('class'=>'form-control')); ?>
						
					</div>
				</div>

                 <div class="form-group">
					<label class=" col-md-3 col-sm-3 col-xs-12"><?php echo $bankAccount->getAttributeLabel('bank_other'); ?></label>
					<div class="col-md-9 col-sm-6 col-xs-12">
						
						<?php echo $form->textArea($bankAccount, 'bank_other', array('class'=>'form-control')); ?>
					</div>
				</div>

                
                
			<?php 
                
				$this->endWidget();
            ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="edit-submit-bank">Save</button>
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