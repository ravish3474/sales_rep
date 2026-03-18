<?php

class CalculatorController extends AuthController
{
	public function actionIndex()
	{
		switch (Yii::app()->user->getState('userGroup')) {
			case 2:
				$result['yearall'] = Array();
				
				
				$result['getData'] = Calculator::model()->findAll("sales_manager = '".Yii::app()->user->getState('fullName')."'");
				
				foreach ($result['getData'] as $key => $value) {
					list($year,$momth,$day) = explode("-",$value['date_quarter']);
					$result['yearall'][] = $year;
				}
				break;
			case 3:
				$result['getData'] = Calculator::model()->findAllByAttributes(array('sales_manager'=> Yii::app()->user->getState('userKey'))); 
				break;
			case 1:
			case 99:
				//$result['getData'] = Calculator::model()->findAll();
				
				$result['getYear'] = Calculator::model()->findAll();
				$result['yearall'] = Array();
				foreach ($result['getYear'] as $key => $value) {
					list($year,$momth,$day) = explode("-",$value['date_quarter']);
					$result['yearall'][] = $year;
				}
				
				//echo $yearall[0].$yearall[1];
					
				
				break;
		}
		
		$this->render('show_fiscalYear', $result);
	}
	
	public function actionUpdateCommissionStatus(){		

		$invoice = $_POST['id'];
		$selectedStatus = $_POST['selectedStatus'];
		$invoicestatus = $_POST['invoicestatus'];		
		$balance = $_POST['balance'];
		
		if ($invoicestatus == "Paid") {			
			$connection=Yii::app()->db;
			$sql = "UPDATE calculator SET  commisson_payment_status = '$selectedStatus', pay_for_sales = '$balance'  WHERE id = $invoice ";
			$command = $connection->createCommand($sql);
			$command->execute();
		}
	}

	public function actionUpdateInvoiceStatus(){				
		$invoice = $_POST['id'];
		$selectedStatus = $_POST['selectedStatus'];							
				
		$connection=Yii::app()->db;
		$sql = "UPDATE calculator SET  invoice_status = '$selectedStatus' WHERE id = $invoice ";		
		$command = $connection->createCommand($sql);
		$command->execute();		
	}
	
	public function actionAddCalculator()
	{
		if (Yii::app()->request->isAjaxRequest) {
			
			$result = Calculator::add($_POST['Calculator']);
        }

		header('Content-type: application/json');
        echo json_encode($result);
	}
	public function actionAddCalculatorEachSalesRep()
	{
		if (Yii::app()->request->isAjaxRequest) {
			
			$result = Calculator::add($_POST['Calculator']);
        }

		header('Content-type: application/json');
        echo json_encode($result);
	}
	public function actionAddCalculatorFiscalYear()
	{
		if (Yii::app()->request->isAjaxRequest) {
			
			$result = Calculator::add($_POST['Calculator']);
        }

		header('Content-type: application/json');
        echo json_encode($result);
	}
	public function actionAddCalculatorSales()
	{
		if (Yii::app()->request->isAjaxRequest) {
				
			//$model = Calculator::model()->findByPk($_POST['id']);
			$model = Calculator::model()->findByAttributes(array('invoice'=>$_POST['id']));
			//$result = Calculator::add($_POST['Calculator']);
			$result = $model->attributes;
        }

		header('Content-type: application/json');
        echo json_encode($result);
	}
	
	public function actionEditCalculator()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$model = Calculator::model()->findByPk($_POST['id']);
			//$model = Calculator::model()->findByAttributes(array('invoice'=>$_POST['id']));
			
			$result = $model->attributes;
			
			
        }

		header('Content-type: application/json');
        echo json_encode($result);
		
	}
	public function actionEditCalculatorInvoice()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$model = Calculator::model()->findByPk($_POST['id']);
			//$model = Calculator::model()->findByAttributes(array('invoice'=>$_POST['id']));
			
			$result = $model->attributes;
			
			
        }

		header('Content-type: application/json');
        echo json_encode($result);
		
	}
	
	public function actionEditCalculatorInvoiceDetail()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$model = Calculator::model()->findByPk($_POST['id']);
			//$model = Calculator::model()->findByAttributes(array('invoice'=>$_POST['id']));
			
			$result = $model->attributes;
			
			
        }

		header('Content-type: application/json');
        echo json_encode($result);
		
	}
	
	public function actionEditCalculatorSalesManager()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$model = Calculator::model()->findByPk($_POST['id']);
			//$model = Calculator::model()->findByAttributes(array('invoice'=>$_POST['id']));
			
			$result = $model->attributes;
			
			
        }

		header('Content-type: application/json');
        echo json_encode($result);
		
	}
	public function actionEditCalculatorSalesRep()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$model = Calculator::model()->findByPk($_POST['id']);
			//$model = Calculator::model()->findByAttributes(array('invoice'=>$_POST['id']));
			
			$result = $model->attributes;
			
			
        }

		header('Content-type: application/json');
        echo json_encode($result);
		
	}
	
	public function actionEditCalculatorSalesProcessor()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$model = Calculator::model()->findByPk($_POST['id']);
			//$model = Calculator::model()->findByAttributes(array('invoice'=>$_POST['id']));
			
			$result = $model->attributes;
			
			
        }

		header('Content-type: application/json');
        echo json_encode($result);
		
	}
	

	public function actionEditSubmitCalculator()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$result = Calculator::edit($_POST['Calculator']);
        }

		header('Content-type: application/json');
        echo json_encode($result);
	} 
	public function actionDeleteInvoice($id)
	{
		$result = array();
		$model = Calculator::model()->findByPk($id);
		
			$date_quarter = $model->date_quarter;
			$sales_manager = $model->sales_manager;
			list($year,$momth,$day) = explode("-",$date_quarter);
			Calculator::model()->deleteByPk($id);
			
		$this->redirect(array('calculator/SalesCommission/year/'.$year.'/sales/'.$sales_manager));

	}
	public function actionDeleteInvoiceAll($id)
	{
		$result = array();
		$model = Calculator::model()->findByPk($id);
		
			$date_quarter = $model->date_quarter;
			$sales_manager = $model->sales_manager;
			list($year,$momth,$day) = explode("-",$date_quarter);
			Calculator::model()->deleteAll('invoice = "'.$model->invoice.'"');
			
		$this->redirect(array('calculator/Invoice/year/'.$year));

	}
	public function actionDeleteInvoiceSeparateSales($id)
	{
		$result = array();
		$model = Calculator::model()->findByPk($id);
		
			$date_quarter = $model->date_quarter;
			$sales_manager = $model->sales_manager;
			list($year,$momth,$day) = explode("-",$date_quarter);
			Calculator::model()->deleteByPk($id);
			
		$this->redirect(array('calculator/Invoice/year/'.$year));

	}
	public function actionDeleteComment($id)
	{
		$result = array();
		
		$comments = Comments::model()->findByPk($id);
		$invoice = $comments->invoice;
		$model = Calculator::model()->findByPk($invoice);
		
			$date_quarter = $model->date_quarter;
			$sales_manager = $model->sales_manager;
			list($year,$momth,$day) = explode("-",$date_quarter);
			
			Comments::model()->deleteByPk($id);
			
		$this->redirect(array('calculator/commission/year/'.$year.'/id/'.$invoice));

	}
	public function actionDeleteCommentInvoice($id)
	{
		$result = array();
		
		$comments = Comments::model()->findByPk($id);
		$invoice = $comments->invoice;
		$model = Calculator::model()->findByPk($invoice);
		
			$date_quarter = $model->date_quarter;
			$sales_manager = $model->sales_manager;
			list($year,$momth,$day) = explode("-",$date_quarter);
			
			Comments::model()->deleteByPk($id);
			
		$this->redirect(array('calculator/InvoiceDetail/year/'.$year.'/id/'.$invoice));
	}
	public function actionEditPayment()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$model = Calculator::model()->findByPk($_POST['id']);
			$result = $model->attributes;
        }

		header('Content-type: application/json');
        echo json_encode($result);
	}
	
	public function actionEditSendmail()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$model = Calculator::model()->findByPk($_POST['id']);
			$model->invoice_mail_status = 'Send';
			$result = $model->attributes;
        }

		header('Content-type: application/json');
        echo json_encode($result);
		
	}
	public function actionSendSubmitMailCustomer()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$result = Calculator::edit($_POST['Calculator']);
			
				//////////// Send Mail /////////////////
			
			
			$data['id'] = $_POST['Calculator']['id'];
			//$data['invoice'] = $_POST['Calculator']['invoice'];
			$data['order_name'] = $_POST['Calculator']['order_name'];
			//$data['date_Quarter'] = $date_s;
			//$data['invoice_file'] = $filePath;
			$data['messages'] = $_POST['Calculator']['invoice_mail_detail'];
			$mail_customer = $_POST['Calculator']['invoice_mail_customer'];
			//$mail_customername = $_POST['Calculator']['invoice_mail_name'];

			$subject = $_POST['Calculator']['invoice_mail_subject'];
			$message = $this->renderPartial('_mailInvoice', $data, true);
			
			//  set send email

				$mail=Yii::app()->Smtpmail;
				$mail->CharSet = 'utf-8'; 
				$mail->SetFrom("noreply.Sale@jogsports.com", 'JogSports Athletics');
				$mail->Subject = $subject;
				$mail->MsgHTML($message);
				//$mail->AddAddress($mail_customer, $mail_customername);

				$countM = count($_POST['Calculator']['invoice_mail_customer']);
				for($i=0;$i<$countM;$i++){
					$mail->AddAddress($_POST['Calculator']['invoice_mail_customer'][$i]);	
				}
			
				// if(!$mail->Send()) {
				// 	Yii::app()->user->setFlash('error', "<strong>Mailer Error!! </strong>" . $mail->ErrorInfo);
				// }else {
				// 	Yii::app()->user->setFlash('success', 'Message Already sent!');
				// }
					//$mail->ClearAddresses(); //clear addresses for next email sending
			
			//////////// End Send Mail ////////////
			
        }

		header('Content-type: application/json');
        echo json_encode($result);
	} 
	// 
	// Notes
	// 
	public function actionEditSubmitNotes()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$model = Notes::model()->findByAttributes(array('type'=>$_POST['Notes']['type']));
			if (sizeof((array)$model) == 0) {
				$model = new Notes;
			}

			$model->attributes = $_POST['Notes'];

			$result = array();
			if ($model->validate()) {
				$model->save();
			} else {
				$model->getErrors();

				$errors = array();
				foreach ($model->getErrors() as $key => $error) {
					foreach ($error as $key => $value) {
						array_push($errors, $value);
					}
				}

				$result['error'] = implode("\n", $errors);
			}
        }

		header('Content-type: application/json');
        echo json_encode($result);
	}
	public function actionEditSubmitBank()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$model = User::model()->findByAttributes(array('fullname'=>$_POST['User']['fullname']));
			if (sizeof((array)$model) == 0) {
				$model = new User;
			}

			//$model->attributes = $_POST['User'];

			$result = array();
			
			$model->bank_name = $_POST['User']['bank_name'];
			$model->bank_account_name = $_POST['User']['bank_account_name'];
			$model->bank_number = $_POST['User']['bank_number'];
			$model->bank_swift_code = $_POST['User']['bank_swift_code'];
			$model->bank_name_check = $_POST['User']['bank_name_check'];
			$model->bank_mailing_address = $_POST['User']['bank_mailing_address'];
			$model->bank_other = $_POST['User']['bank_other'];
			
			if ($model->validate()) {
				$model->save();
			} else {
				$model->getErrors();

				$errors = array();
				foreach ($model->getErrors() as $key => $error) {
					foreach ($error as $key => $value) {
						array_push($errors, $value);
					}
				}

				$result['error'] = implode("\n", $errors);
			}
        }

		header('Content-type: application/json');
        echo json_encode($result);
	}
	// End Notes

	public function actionShowSalesCommission($year, $sales)
	{
		$result['sumtotalUSD'] = 0;
		$result['sumtotalCAD'] = 0;
		$result['sumtotalSGD'] = 0;
		$result['sumtotalTHB'] = 0;
		$result['totalcommissionUSD'] = 0;
		$result['totalcommissionCAD'] = 0;
		$result['totalcommissionSGD'] = 0;
		$result['totalcommissionTHB'] = 0;
		$result['payoutUSD'] = 0;
		$result['payoutCAD'] = 0;
		$result['payoutSGD'] = 0;
		$result['payoutTHB'] = 0;
		
		$result['totalPayByCustomerUSD'] = 0;
		$result['totalPayByCustomerCAD'] = 0;
		$result['totalPayByCustomerSGD'] = 0;
		$result['totalPayByCustomerTHB'] = 0;
		
		$result['commissionPaymentUSD'] = 0;
		$result['commissionPaymentCAD'] = 0;
		$result['commissionPaymentSGD'] = 0;
		$result['commissionPaymentTHB'] = 0;
		
		$result['sumCommissionPaymaentUSD'] = 0;
		$result['sumCommissionPaymaentCAD'] = 0;
		$result['sumCommissionPaymaentSGD'] = 0;
		$result['sumCommissionPaymaentTHB'] = 0;
		
		$result['sumAmountReceivedUSD'] = 0;
		$result['sumAmountReceivedCAD'] = 0;
		$result['sumAmountReceivedSGD'] = 0;
		$result['sumAmountReceivedTHB'] = 0;
		
		$result['currency'] = Array();
			
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		
		$result['bankAccount'] = User::model()->findByAttributes(array('fullname'=> $sales));
		
		
		
		$result['year_commission'] = $year;	
		$result['sales_commission'] = $sales;	
		//$result['getData'] = Calculator::model()->findAll();
		$result['getData'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator cal')
				->where('cal.sales_manager = "'.$sales.'"')
				->andwhere('cal.date_quarter LIKE "'.$year.'%"')
				->order('cal.date_quarter ASC , cal.invoice ASC ')
			    ->queryAll();
		
		foreach ($result['getData']as $key_data => $value_data) {
			
				$result['getDate'] = Yii::app()->db->createCommand()
			    ->select('MAX(update_date) AS datedata')
			    ->from('calculator cal')
				->where('cal.sales_manager = "'.$value_data['sales_manager'].'"')
				->order('cal.date_quarter ASC , cal.invoice ASC ')
				->limit('1')
			    ->queryAll();
				
				$result['search_invoice'] = "";
				$result['search_invoice2'] = "";
				$result['search_dateQuarter'] = "";
				$result['search_dateQuarter2'] = "";
				$result['search_orderno'] = "";
				$result['search_orderno2'] = "";
				$result['search_ordername'] = "";
				$result['commission_status'] = "";
				$result['aproved_status'] = "";
				$result['invoice_status'] = "";
			
				foreach ($result['getDate'] as $key_date => $value_date) {
					$result['datedata'] = $value_date['datedata'];
				}
				
				/*$result['getSalesumtotal'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.invoice = "'.$value_data['invoice'].'"')
				->andwhere('scal.status_commission = "Approved"')
				//->andwhere('scal.commisson_payment_status = "Paid"')
				//->andwhere('scal.currency = "'.$value_data['currency'].'"')
				->limit('1')
				//->order('scal.update_date DESC')
			    ->queryAll();
					
				foreach ($result['getSalesumtotal'] as $key_sumtotal => $value_sumtotal) {
				*/	
					if($value_data['currency'] == "USD"){
						
						if($value_data['invoice_status'] == "Paid"){	
							//$result['sumtotalUSD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							
							$result['sumAmountReceivedUSD'] += $value_data['invoice_amount_received'];
							
							if($value_data['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentUSD'] +=  $value_data['commission'] - $value_data['pay_for_sales'];
							}else{
								$result['commissionPaymentUSD'] += $value_data['commission'];
							}
								
						}
							//if($value_data['status_commission'] == "Approved"){	
							
								$result['sumtotalUSD'] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								$result['totalcommissionUSD'] +=  $value_data['commission'];
								$result['totalPayByCustomerUSD'] +=  $value_data['pay_by_customer'];
								
								$result['sumCommissionPaymaentUSD'] += $value_data['pay_for_sales'];
								$result['payoutUSD'] +=  $value_data['pay_for_sales'];
									
							//}
							//$result['sumAmountReceivedUSD'] += $value_data['invoice_amount_received'];
					
						
						
					}
					if($value_data['currency'] == "CAD"){
						
						if($value_data['invoice_status'] == "Paid"){	

							//$result['sumtotalCAD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							$result['sumAmountReceivedCAD'] += $value_data['invoice_amount_received'];		
							
							if($value_data['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentCAD'] +=  $value_data['commission'] - $value_data['pay_for_sales'];
							}else{
								$result['commissionPaymentCAD'] += $value_data['commission'];
							}
							
						}	
						
						
							//if($value_data['status_commission'] == "Approved"){	
							
								$result['sumtotalCAD'] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								$result['totalcommissionCAD'] +=  $value_data['commission'];
								$result['totalPayByCustomerCAD'] +=  $value_data['pay_by_customer'];
								
								$result['sumCommissionPaymaentCAD'] += $value_data['pay_for_sales'];
								$result['payoutCAD'] +=  $value_data['pay_for_sales'];
								
									
							//}
						
					}
					if($value_data['currency'] == "SGD"){
						
						if($value_data['invoice_status'] == "Paid"){	
							

								//$result['sumtotalSGD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							$result['sumAmountReceivedSGD'] += $value_data['invoice_amount_received'];
							
							if($value_data['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentSGD'] +=  $value_data['commission'] - $value_sumtotal['pay_for_sales'];
							}else{
								$result['commissionPaymentSGD'] += $value_data['commission'];
							}
						
						}				
							//if($value_data['status_commission'] == "Approved"){	
							
								$result['sumtotalSGD'] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								$result['totalcommissionSGD'] +=  $value_data['commission'];
								$result['totalPayByCustomerSGD'] +=  $value_data['pay_by_customer'];
								
								$result['sumCommissionPaymaentSGD'] += $value_data['pay_for_sales'];
								$result['payoutSGD'] +=  $value_data['pay_for_sales'];
								
									
							//}
								
								
								
					}
					if($value_data['currency'] == "THB"){
						
						if($value_data['invoice_status'] == "Paid"){	

							//$result['sumtotalTHB'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							$result['sumAmountReceivedTHB'] += $value_data['invoice_amount_received'];
							
							if($value_data['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentTHB'] +=  $value_data['commission'] - $value_data['pay_for_sales'];
							}else{
								$result['commissionPaymentTHB'] += $value_data['commission'];
							}
						
						}		
							//if($value_data['status_commission'] == "Approved"){	
							
								$result['sumtotalTHB'] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								$result['totalcommissionTHB'] +=  $value_data['commission'];
								$result['totalPayByCustomerTHB'] +=  $value_data['pay_by_customer'];
								
								$result['sumCommissionPaymaentTHB'] += $value_data['pay_for_sales'];
								$result['payoutTHB'] +=  $value_data['pay_for_sales'];
								
									
							//}						
							
		
							
					}
					
				//}
				
				//$model = new Calculator;
				

				$result['currency'][] = $value_data['currency'];	
		}	
			
		$this->render('show_sales_commission', $result);
		//$this->render('sales_rep', $result);
	}
	public function actionShowCommissionAll($year)
	{
		$result['sumtotalUSD'] = 0;
		$result['sumtotalCAD'] = 0;
		$result['sumtotalSGD'] = 0;
		$result['sumtotalTHB'] = 0;
		$result['totalcommissionUSD'] = 0;
		$result['totalcommissionCAD'] = 0;
		$result['totalcommissionSGD'] = 0;
		$result['totalcommissionTHB'] = 0;
		$result['payoutUSD'] = 0;
		$result['payoutCAD'] = 0;
		$result['payoutSGD'] = 0;
		$result['payoutTHB'] = 0;
		
		$result['commissionPaymentUSD'] = 0;
		$result['commissionPaymentCAD'] = 0;
		$result['commissionPaymentSGD'] = 0;
		$result['commissionPaymentTHB'] = 0;
		
		$result['sumAmountReceivedUSD'] = 0;
		$result['sumAmountReceivedCAD'] = 0;
		$result['sumAmountReceivedSGD'] = 0;
		$result['sumAmountReceivedTHB'] = 0;
		
		$result['sumCommissionPaymaentUSD'] = 0;
		$result['sumCommissionPaymaentCAD'] = 0;
		$result['sumCommissionPaymaentSGD'] = 0;
		$result['sumCommissionPaymaentTHB'] = 0;
		
		
		
		$result['currency'] = Array();
		
		$result['search_invoice'] = "";
		$result['search_invoice2'] = "";
		$result['search_dateQuarter'] = "";
		$result['search_dateQuarter2'] = "";
		$result['search_orderno'] = "";
		$result['search_orderno2'] = "";
		$result['search_ordername'] = "";
		$result['commission_status'] = "";
		$result['aproved_status'] = "";
		$result['invoice_status'] = "";
		
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		$result['bankAccount'] = User::model()->findByAttributes(array('fullname'=> Yii::app()->user->getState('fullName')));
		$result['year_commission'] = $year;	
		//$result['sales_commission'] = Yii::app()->user->getState('fullName');	
		//$result['getData'] = Calculator::model()->findAll();
		$result['getData'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator cal')
				->where('cal.sales_manager = "'.Yii::app()->user->getState('fullName').'"')
				->andwhere('cal.date_quarter LIKE "'.$year.'%"')
				->order('cal.date_quarter ASC , cal.invoice ASC ')
			    ->queryAll();
				

		$result['getDataAll'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator cal')
				->where('cal.date_quarter LIKE "'.$year.'%"')
				->andwhere('cal.sales_manager = "'.Yii::app()->user->getState('fullName').'"')
				->andwhere('cal.date_quarter LIKE "'.$year.'%"')
				//->group('cal.sales_manager')
				->order('cal.date_quarter ASC , cal.invoice ASC ')
			    ->queryAll();
				
		foreach ($result['getDataAll']as $key_data => $value_data) {	
				
			/*	$result['getSale'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.sales_manager = "'.Yii::app()->user->getState('fullName').'"')
				->andwhere('scal.status_commission = "Approved"')
				->andwhere('scal.currency = "'.$value_data['currency'].'"')
				->order('scal.update_date DESC')
			    ->queryAll();
			*/	
			
			if($value_data['currency'] == "USD"){
						
						if($value_data['invoice_status'] == "Paid"){
							$result['sumAmountReceivedUSD'] += $value_data['invoice_amount_received'];
							
							if($value_data['commisson_payment_status'] == "Paid"){
									$result['commissionPaymentUSD'] +=  $value_data['commission'] - $value_data['pay_for_sales'];
								}else{
									$result['commissionPaymentUSD'] += $value_data['commission'];
								}
						}
							//if($value_data['status_commission'] == "Approved"){	
							
								$result['sumtotalUSD'] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								$result['sumCommissionPaymaentUSD'] += $value_data['pay_for_sales'];
												
								$result['totalcommissionUSD'] +=  $value_data['commission'];
								$result['payoutUSD'] +=  $value_data['pay_for_sales'];
												
								
								
							//}
						
					}
					if($value_data['currency'] == "CAD"){
						
						if($value_data['invoice_status'] == "Paid"){

							$result['sumAmountReceivedCAD'] += $value_data['invoice_amount_received'];
							
							if($value_data['commisson_payment_status'] == "Paid"){
									$result['commissionPaymentCAD'] +=  $value_data['commission'] - $value_data['pay_for_sales'];
								}else{
									$result['commissionPaymentCAD'] += $value_data['commission'];
								}
						}	
							//if($value_data['status_commission'] == "Approved"){	
								$result['sumtotalCAD'] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								$result['sumCommissionPaymaentCAD'] += $value_data['pay_for_sales'];
												
								$result['totalcommissionCAD'] +=  $value_data['commission'];
								$result['payoutCAD'] +=  $value_data['pay_for_sales'];
												
								
								
							//}	
							
								
					}
					if($value_data['currency'] == "SGD"){
						
						if($value_data['invoice_status'] == "Paid"){
							
							$result['sumAmountReceivedSGD'] += $value_data['invoice_amount_received'];
							
							if($value_data['commisson_payment_status'] == "Paid"){
									$result['commissionPaymentSGD'] +=  $value_data['commission'] - $value_data['pay_for_sales'];
								}else{
									$result['commissionPaymentSGD'] += $value_data['commission'];
								}
						}	
							//if($value_data['status_commission'] == "Approved"){		

								$result['sumtotalSGD'] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								$result['sumCommissionPaymaentSGD'] += $value_data['pay_for_sales'];
												
								$result['totalcommissionSGD'] +=  $value_data['commission'];
								$result['payoutSGD'] +=  $value_data['pay_for_sales'];
												
								
								
							
						//}		
					}
					if($value_data['currency'] == "THB"){
						
						if($value_data['invoice_status'] == "Paid"){
							$result['sumAmountReceivedTHB'] += $value_data['invoice_amount_received'];
							
							if($value_data['commisson_payment_status'] == "Paid"){
									$result['commissionPaymentTHB'] +=  $value_data['commission'] - $value_data['pay_for_sales'];
								}else{
									$result['commissionPaymentTHB'] += $value_data['commission'];
								}
						}		
							//if($value_data['status_commission'] == "Approved"){		

								$result['sumtotalTHB'] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								$result['sumCommissionPaymaentTHB'] += $value_data['pay_for_sales'];
												
								$result['totalcommissionTHB'] +=  $value_data['commission'];
								$result['payoutTHB'] +=  $value_data['pay_for_sales'];
												
								
							//}
							
					}
					
			$result['sales_commission'] = $value_data['sales_manager'];	
				/*	
				foreach ($result['getSale'] as $key => $value) {
					//echo $value['currency'];
					
				
					if($value_data['currency'] == "USD"){
						
						if($value_data['invoice_status'] == "Paid"){	
							$result['sumtotalUSD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							
							$result['totalcommissionUSD'] +=  $value['commission'];
							$result['payoutUSD'] +=  $value['pay_for_sales'];
							
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentUSD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentUSD'] += $value['commission'];
							}	
						}
					}
					if($value_data['currency'] == "CAD"){

						if($value_data['invoice_status'] == "Paid"){	
							$result['sumtotalCAD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							
							$result['totalcommissionCAD'] +=  $value['commission'];
							$result['payoutCAD'] +=  $value['pay_for_sales'];
							
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentCAD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentCAD'] += $value['commission'];
							}	
						}
					}
					if($value_data['currency'] == "SGD"){
						
						if($value_data['invoice_status'] == "Paid"){	
							$result['sumtotalSGD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							
							$result['totalcommissionSGD'] +=  $value['commission'];
							$result['payoutSGD'] +=  $value['pay_for_sales'];
							
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentSGD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentSGD'] += $value['commission'];
							}	
						}
					}
					if($value_data['currency'] == "THB"){
						
						if($value_data['invoice_status'] == "Paid"){	
							$result['sumtotalTHB'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							
							$result['totalcommissionTHB'] +=  $value['commission'];
							$result['payoutTHB'] +=  $value['pay_for_sales'];
							
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentTHB'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentTHB'] += $value['commission'];
							}	
						}	
					}
					
				}
				*/
				$result['currency'][] = $value_data['currency'];	
		}
				
			
		$this->render('show_commission', $result);
		//$this->render('sales_rep', $result);
	}
	public function actionSalesCommission($year, $sales, $month="")
	{
		$result['sumtotalUSD'] = 0;
		$result['sumtotalCAD'] = 0;
		$result['sumtotalSGD'] = 0;
		$result['sumtotalTHB'] = 0;
		$result['totalcommissionUSD'] = 0;
		$result['totalcommissionCAD'] = 0;
		$result['totalcommissionSGD'] = 0;
		$result['totalcommissionTHB'] = 0;
		$result['payoutUSD'] = 0;
		$result['payoutCAD'] = 0;
		$result['payoutSGD'] = 0;
		$result['payoutTHB'] = 0;
		$result['commissionPaymentUSD'] = 0;
		$result['commissionPaymentCAD'] = 0;
		$result['commissionPaymentSGD'] = 0;
		$result['commissionPaymentTHB'] = 0;
		
		$result['payCreditUSD'] = 0;
		$result['payCreditCAD'] = 0;
		$result['payCreditSGD'] = 0;
		$result['payCreditTHB'] = 0;
		
		$result['totalPayByCustomerUSD'] = 0;
		$result['totalPayByCustomerCAD'] = 0;
		$result['totalPayByCustomerSGD'] = 0;
		$result['totalPayByCustomerTHB'] = 0;
		
		$result['sumCommissionPaymaentUSD'] = 0;
		$result['sumCommissionPaymaentCAD'] = 0;
		$result['sumCommissionPaymaentSGD'] = 0;
		$result['sumCommissionPaymaentTHB'] = 0;
		
		$result['sumAmountReceivedUSD'] = 0;
		$result['sumAmountReceivedCAD'] = 0;
		$result['sumAmountReceivedSGD'] = 0;
		$result['sumAmountReceivedTHB'] = 0;
		
		$result['currency'] = Array();
		
		$model = new Calculator;
		
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		$result['bankAccount'] = User::model()->findByAttributes(array('fullname'=> $sales));
		$result['year_commission'] = $year;	
		$result['sales_commission'] = $sales;	
		$result['month_commission'] = $month;	
		//$result['getData'] = Calculator::model()->findAll();

		$tmp_year = $year;
		if(isset($month) && $month!=""){
			$tmp_year .= "-".$month;
		}
		
		$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter LIKE "'.$tmp_year.'%"')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
				
			foreach ($result['getData']as $key_data => $value_data) {	
				//echo $value_data['currency']."<br>";	
				
				if($value_data['currency'] == "USD"){
						
						
							//if($value_data['status_commission'] == "Approved"){	
								
							//}	
								$result['sumtotalUSD'] += ($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost'];
								
								$result['totalcommissionUSD'] +=  $value_data['commission'];
								
								$result['payoutUSD'] +=  $value_data['pay_for_sales'];
								
								$result['totalPayByCustomerUSD'] += $value_data['pay_by_customer'];
								
								$result['payCreditUSD'] += $value_data['pay_by_credit'];
							//}
						if($value_data['invoice_status'] == "Paid"){
									
							$result['sumAmountReceivedUSD'] += $value_data['invoice_amount_received'];
							
							if($value_data['commisson_payment_status'] == "Paid"){
									$result['commissionPaymentUSD'] +=  ($value_data['commission'] - $value_data['pay_for_sales'])-$value_data['pay_by_credit'];
									$result['sumCommissionPaymaentUSD'] += $value_data['pay_for_sales']+$value_data['pay_by_credit'];
							}else{
									$result['commissionPaymentUSD'] += $value_data['commission'];
							}
						}
					}
					if($value_data['currency'] == "CAD"){
						
						
							//if($value_data['status_commission'] == "Approved"){	
								
							//}	
								$result['sumtotalCAD'] +=  ($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost'];
								$result['totalcommissionCAD'] +=  $value_data['commission'];
								
								$result['payoutCAD'] +=  $value_data['pay_for_sales'];
								
								$result['totalPayByCustomerCAD'] +=  $value_data['pay_by_customer'];
								
								$result['payCreditCAD'] += $value_data['pay_by_credit'];
							//}
						if($value_data['invoice_status'] == "Paid"){		
							$result['sumAmountReceivedCAD'] += $value_data['invoice_amount_received'];
							
							if($value_data['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentCAD'] +=  ($value_data['commission']-$value_data['pay_for_sales'])-$value_data['pay_by_credit'];
								$result['sumCommissionPaymaentCAD'] += $value_data['pay_for_sales']+$value_data['pay_by_credit'];;
							}else{
								$result['commissionPaymentCAD'] += $value_data['commission'];
							}
						}		
					}
					if($value_data['currency'] == "SGD"){
						
						
							//if($value_data['status_commission'] == "Approved"){	
								
							//}
								$result['sumtotalSGD'] +=  ($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost'];
								$result['totalcommissionSGD'] +=  $value_data['commission'];
								
								$result['payoutSGD'] +=  $value_data['pay_for_sales'];
								
								$result['totalPayByCustomerSGD'] +=  $value_data['pay_by_customer'];
								$result['payCreditSGD'] += $value_data['pay_by_credit'];
							//}
						if($value_data['invoice_status'] == "Paid"){	
							$result['sumAmountReceivedSGD'] += $value_data['invoice_amount_received'];
							if($value_data['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentSGD'] += ($value_data['commission'] - $value_data['pay_for_sales'])-$value_data['pay_by_credit'];
								$result['sumCommissionPaymaentSGD'] += $value_data['pay_for_sales']+$value_data['pay_by_credit'];;
							}else{
								$result['commissionPaymentSGD'] += $value_data['commission'];
							}
						}		
					}
					if($value_data['currency'] == "THB"){
						
						
							//if($value_data['status_commission'] == "Approved"){		
								
							//}	
								$result['sumtotalTHB'] += ($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost'];
								$result['totalcommissionTHB'] +=  $value_data['commission'];
								
								$result['payoutTHB'] +=  $value_data['pay_for_sales'];
								
								$result['totalPayByCustomerTHB'] +=  $value_data['pay_by_customer'];
								$result['payCreditTHB'] += $value_data['pay_by_credit'];
							//}
						if($value_data['invoice_status'] == "Paid"){	
							$result['sumAmountReceivedTHB'] += $value_data['invoice_amount_received'];
							if($value_data['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentTHB'] += ($value_data['commission'] - $value_data['pay_for_sales'])-$value_data['pay_by_credit'];
								$result['sumCommissionPaymaentTHB'] += $value_data['pay_for_sales']+$value_data['pay_by_credit'];;
							}else{
								$result['commissionPaymentTHB'] += $value_data['commission'];
							}
						}		
					}
				
				
				
				
				
				
				$result['currency'][] = $value_data['currency'];
				//echo $result['sumtotalUSD']."<br>";
		}		
			
		$this->render('sales_commission', $result);
		//$this->render('sales_rep', $result);
	}
	public function actionSales($year)
	{
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		
		$result['year_commission'] = $year;	
		
		//$result['getData'] = Calculator::model()->findAll();
		
		
		$result['getData'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator cal')
				->where('cal.date_quarter LIKE "'.$year.'%"')
				->andwhere('cal.sales_status != "3"')
				->group('cal.sales_manager')
				->order('cal.sales_manager ASC')
			    ->queryAll();
				
		foreach ($result['getData']as $key_data => $value_data) {	
				
				/*$result['getSale'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.sales_manager = "'.$value_data['sales_manager'].'"')
				->andwhere('scal.status_commission = "Approved"')
				->order('scal.id ASC')
			    ->queryAll();
				*/
				$model = new Calculator;
			/*	foreach ($result['getSale'] as $key => $value) {
					
					if($value['currency'] == "USD"){

						$result['sumtotalUSD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
						
						$result['totalcommissionUSD'] +=  $value['commission'];
						$result['payoutUSD'] +=  $value['pay_for_sales'];
					
					}
					if($value['currency'] == "CAD"){

						$result['sumtotalCAD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
						
						$result['totalcommissionCAD'] +=  $value['commission'];
						$result['payoutCAD'] +=  $value['pay_for_sales'];
					}
					if($value['currency'] == "SGD"){

						$result['sumtotalSGD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
						
						$result['totalcommissionSGD'] +=  $value['commission'];
						$result['payoutSGD'] +=  $value['pay_for_sales'];
					}
					if($value['currency'] == "THB"){

						$result['sumtotalTHB'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
						
						$result['totalcommissionTHB'] +=  $value['commission'];
						$result['payoutTHB'] +=  $value['pay_for_sales'];
					}
				}
			*/	
		}
				
		$this->render('sales_rep', $result);
	}
	public function actionShowSales($year)
	{
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		
		$result['year_commission'] = $year;	
	/*	$result['sumtotalUSD'] = 0;
		$result['sumtotalCAD'] = 0;
		$result['sumtotalSGD'] = 0;
		$result['sumtotalTHB'] = 0;
		$result['totalcommissionUSD'] = 0;
		$result['totalcommissionCAD'] = 0;
		$result['totalcommissionSGD'] = 0;
		$result['totalcommissionTHB'] = 0;
		$result['payoutUSD'] = 0;
		$result['payoutCAD'] = 0;
		$result['payoutSGD'] = 0;
		$result['payoutTHB'] = 0;  */
		//$result['getData'] = Calculator::model()->findAll();
		$result['getData'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator cal')
				->where('cal.date_quarter LIKE "'.$year.'%"')
				->andwhere('cal.sales_status != "3"')
				->group('cal.sales_manager')
				->order('cal.sales_manager ASC')
			    ->queryAll();
				
		foreach ($result['getData']as $key_data => $value_data) {
				
			$result['getDate'] = Yii::app()->db->createCommand()
			    ->select('MAX(update_date) AS datedata')
			    ->from('calculator cal')
				->where('cal.sales_manager = "'.$value_data['sales_manager'].'"')
				->order('cal.date_quarter ASC , cal.invoice ASC ')
				->limit('1')
			    ->queryAll();
				
				foreach ($result['getDate'] as $key_date => $value_date) {
					$result['datedata'] = $value_date['datedata'];
				}
		/*			
				$result['getSale'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.sales_manager = "'.$value_data['sales_manager'].'"')
				->order('scal.id ASC')
			    ->queryAll();
				
				$model = new Calculator;
				foreach ($result['getSale'] as $key => $value) {
					
			/*	$aa = (((($value['total_sales'] - $value['shipping_cost'])- $value['creditcard_feecost'])*$value['commission_percent'])/100);
				if($value['commission_percent'] != 0){
				$connection=Yii::app()->db;
				$sql = "UPDATE calculator SET commission = '".$aa."' WHERE id = ".$value['id'];
				$command = $connection->createCommand($sql);
				$command->execute();
				}	*/
		/*	
					if($value['currency'] == "USD"){

						$result['sumtotalUSD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
						
						$result['totalcommissionUSD'] +=  $value['commission'];
						$result['payoutUSD'] +=  $value['pay_for_sales'];
					
					}
					if($value['currency'] == "CAD"){

						$result['sumtotalCAD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
						
						$result['totalcommissionCAD'] +=  $value['commission'];
						$result['payoutCAD'] +=  $value['pay_for_sales'];
					}
					if($value['currency'] == "SGD"){

						$result['sumtotalSGD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
						
						$result['totalcommissionSGD'] +=  $value['commission'];
						$result['payoutSGD'] +=  $value['pay_for_sales'];
					}
					if($value['currency'] == "THB"){

						$result['sumtotalTHB'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
						
						$result['totalcommissionTHB'] +=  $value['commission'];
						$result['payoutTHB'] +=  $value['pay_for_sales'];
					}
				}
			*/	
		}
		
		switch (Yii::app()->user->getState('userGroup')) {
			case 2:
				$this->redirect(array('calculator/ShowCommissionAll/year/'.$year));
				break;
			case 3:
				$this->redirect(array('calculator/SalesCommissionAll/year/'.$year));
				break;
			case 1:
				$this->render('show_sales_rep', $result);
				break;
			case 99:
				$this->render('show_sales_rep', $result);
				break;
		}
	
		
		
	}

	public function actionCommission($id, $year)
	{
		$result['id'] = $id;
		$result['year_commission'] = $year;
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		
		//$result['comments'] = Comments::model()->findByAttributes(array('invoice'=>$id));
		
		//$result['getDetail'] = Calculator::model()->findAllByAttributes(array('id'=> $id)); 
		
		$result['getDetail'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator cal')
				->leftjoin('user u', 'cal.sales_manager = u.fullname')
				->where('cal.id = "'.$id.'"')
			    ->queryAll();
				
		foreach ($result['getDetail'] as $key => $value) {	
			$result['sales'] = $value['sales_manager'];
			$result['bankAccount'] = User::model()->findByAttributes(array('fullname'=> $value['fullname']));
		}
			$result['comments'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('comments com')
				->where('com.invoice = "'.$id.'"')
				->order('com.date_comments DESC')
			    ->queryAll();
				
		$this->render('detail_commission', $result);
		
		
	}
	
	public function actionShowCommission($id, $year)
	{
		$result['id'] = $id;
		$result['year_commission'] = $year;
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		
		//$result['comments'] = Comments::model()->findByAttributes(array('invoice'=>$id));
		
		//$result['getDetail'] = Calculator::model()->findAllByAttributes(array('id'=> $id)); 
		switch (Yii::app()->user->getState('userGroup')) {
			case 2:
			
				$result['getDetail'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator cal')
				->leftjoin('user u', 'cal.sales_manager = u.fullname')
				->where('cal.id = "'.$id.'"')
				->andwhere('cal.sales_manager = "'.Yii::app()->user->getState('fullName').'"')
			    ->queryAll();
				
				break;
			case 3:
				$result['getDetail'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator cal')
				->leftjoin('user u', 'cal.sales_manager = u.fullname')
				->where('cal.id = "'.$id.'"')
				->andwhere('cal.sales_manager = "'.Yii::app()->user->getState('fullName').'"')
			    ->queryAll();
				break;
			case 1:
				$result['getDetail'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator cal')
				->leftjoin('user u', 'cal.sales_manager = u.fullname')
				->where('cal.id = "'.$id.'"')
			    ->queryAll();
				break;
			case 99:
				//$result['getData'] = Calculator::model()->findAll();
				
				$result['getDetail'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator cal')
				->leftjoin('user u', 'cal.sales_manager = u.fullname')
				->where('cal.id = "'.$id.'"')
			    ->queryAll();
					
				
				break;
		}
		
				
		foreach ($result['getDetail'] as $key => $value) {
			$result['sales'] = $value['sales_manager'];
			$result['status_commission'] = $value['status_commission'];
			$result['bankAccount'] = User::model()->findByAttributes(array('fullname'=> $value['fullname']));
		}
			$result['comments'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('comments com')
				->where('com.invoice = "'.$id.'"')
				->order('com.date_comments DESC')
			    ->queryAll();
				
				
		if(!empty($result['getDetail'] )){
			$this->render('show_detail_commission', $result);
		}else{
			$this->redirect(array('calculator/showSalesCommission/year/'.$year.'/sales/'.Yii::app()->user->getState('fullName')));
		}		
		
		
		
	}

	public function actionFiscalYear()
	{
		$result['getYear'] = Calculator::model()->findAll();
		$result['yearall'] = Array();
		foreach ($result['getYear'] as $key => $value) {
			list($year,$momth,$day) = explode("-",$value['date_quarter']);
			$result['yearall'][] = $year;
		}
		
		//echo $yearall[0].$yearall[1];
			
		$this->render('fiscalYear', $result);
		
	}
	
	public function actionAddCalculatorSubmit()
	{	
		$comments = new Comments;
				$mail_sale = "";
		$mail_namesale_processor="";
		$mail_sale_processor = "";
		$mail_namesale = "";
		$mail_sale_manager = "";
		$mail_namesale_manager = "";
		$filePath= "";
		$checkCalculator = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator c')
			->where('c.invoice = "'.$_POST['Calculator']['invoice'].'"')
			->queryAll();
		
		
		list($year_ch,$momth_ch,$day_ch) = explode("-",$_POST['Calculator']['date_quarter']);
		
		foreach ($checkCalculator as $key_check => $value_check) {	
			$checkdouble	= $value_check['invoice'];
		}
		if(empty($checkdouble)){
		
		
			if(!empty($_POST['Calculator']['sales_manager'])){
				//echo $_POST['Calculator']['sales_manager']."<br>";	
				
			$model = new Calculator;
			
			$model->attributes = $_POST['Calculator'];
			
			
			foreach ($_FILES['Calculator']['name']['file_path'] as $key => $value) {
				
				$uploadedFile = CUploadedFile::getInstance($model,"file_path[$key]");
				
				if (!is_null($uploadedFile)) {
					$filePath = date('Ymd') . '-' . $_POST['Calculator']['invoice'] . '.' . $uploadedFile->extensionName;

					$model->file_path = $filePath;
					//$model->file_type = $uploadedFile->extensionName;
					//$model->file_datetime = date('Y-m-d H:i:s');

					if ($model->save()) {
						$uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/invoice/docs/' . $filePath);
						Yii::app()->user->setFlash('success', 'Upload Success');
						//$this->redirect(array('index'));
					} else {
						Yii::app()->user->setFlash('error', 'Upload Error');
						//$this->redirect(array('index'));
					}
				}	
			}
				
				if(!empty($_POST['Calculator']['commission_percent'])){
					$commission = (((((floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost'])) - floatval($_POST['Calculator']['creditcard_feecost'])) - floatval($_POST['Calculator']['comp_itemcost']))*floatval($_POST['Calculator']['commission_percent']))/100);
					
					
				// 	$model->commission_percent = $_POST['Calculator']['commission_percent'];
					$model->commission_percent = round(($commission/$_POST['Calculator']['total_sales'])*100,2);
					$model->commission = $commission;
					$model->status_commission = "Approved";
				}else{
					$model->status_commission = "Pending";
				}
				
				$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));
				
				$model->invoice = $_POST['Calculator']['invoice'];
				$model->inv_link = $_POST['Calculator']['inv_link'];
				$model->order_no = $_POST['Calculator']['order_no'];
				$model->date_quarter = $date_quarter;
				$model->create_date = date("Y-m-d");
				$model->update_date = date("Y-m-d");
				$model->total_sales = $_POST['Calculator']['total_sales'];
				$model->creditcard_feecost = $_POST['Calculator']['creditcard_feecost'];
				$model->royalty_feecost = $_POST['Calculator']['royalty_feecost'];
				$model->comp_itemcost = $_POST['Calculator']['comp_itemcost'];
				$model->shipping_cost = $_POST['Calculator']['shipping_cost'];
				$model->invoice_amount_received = $_POST['Calculator']['invoice_amount_received'];
				$model->sales_manager = $_POST['Calculator']['sales_manager'];

				$model->sales_status = "1";
				$model->date_for_sales = $_POST['Calculator']['date_for_sales'];
				$model->pay_for_sales = $_POST['Calculator']['pay_for_sales'];
				$model->payment_method = $_POST['Calculator']['payment_method'];
				
				if(empty($_POST['Calculator']['invoice_status'])){
					
					$model->invoice_status = "Outstanding";
				}
				
				if(empty($_POST['Calculator']['commisson_payment_status'])){
					
					$model->commisson_payment_status = "Outstanding";
				}else{
					$model->status_commission = "Approved";
					$model->commisson_payment_status = $_POST['Calculator']['commisson_payment_status'];
				}
				/*if(empty($_POST['Calculator']['status_commission'])){
					
					$model->status_commission = "Pending";
				}*/
				
				list($year,$momth,$day) = explode("-",$date_quarter);
				
				$model->save();
				
				//////////// Send Mail /////////////////
				
				$result['sale_tomail'] = Yii::app()->db->createCommand()
					->select('*')
					->from('user u')
					->where('u.fullname = "'.$_POST['Calculator']['sales_manager'].'"')
					->queryAll();
					
				foreach ($result['sale_tomail'] as $key_mail => $value_mail) {
					
					if($value_mail['fullname'] == "Jog Sports"){
						$mail_sale_manager = "";
						$mail_namesale_manager = "Jog Sports";
					}else{
						$mail_sale_manager = $value_mail['email'];
						$mail_namesale_manager = $value_mail['fullname'];
					}
					
				}
				
				
				
				//////////// End Send Mail ////////////
			
			
			}
			
			if(!empty($_POST['Calculator']['sales_rep'])){
				//echo $_POST['Calculator']['sales_rep']."<br>";	
				
			$model_sale = new Calculator;
			
			$model_sale->attributes = $_POST['Calculator'];
			
			foreach ($_FILES['Calculator']['name']['file_path'] as $key => $value) {
				
				$uploadedFile = CUploadedFile::getInstance($model_sale,"file_path[$key]");
				
				if (!is_null($uploadedFile)) {
					$filePath = date('Ymd') . '-' . $_POST['Calculator']['invoice'] . '.' . $uploadedFile->extensionName;

					$model_sale->file_path = $filePath;
					
					if ($model_sale->save()) {
						$uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/invoice/docs/' . $filePath);
						Yii::app()->user->setFlash('success', 'Upload Success');
						//$this->redirect(array('index'));
					} else {
						Yii::app()->user->setFlash('error', 'Upload Error');
						//$this->redirect(array('index'));
					}
				}
			   
			}
			
				if(!empty($_POST['Calculator']['commission_percent_salesrep'])){
					$commission = (((((floatval($_POST['Calculator']['total_salesrep']) - floatval($_POST['Calculator']['shipping_cost_salesrep'])) - floatval($_POST['Calculator']['creditcard_feecost_salesrep'])) - floatval($_POST['Calculator']['comp_itemcost_salesrep']))*floatval($_POST['Calculator']['commission_percent_salesrep']))/100);
					$model_sale->commission_percent = round(($commission/$_POST['Calculator']['total_salesrep'])*100,2);
				// 	$model_sale->commission_percent = $_POST['Calculator']['commission_percent_salesrep'];
					$model_sale->commission = $commission;
					$model_sale->status_commission = "Approved";
					
				}else{
					$model_sale->status_commission = "Pending";
				}
				
				$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));
				
				$model_sale->invoice = $_POST['Calculator']['invoice'];
				$model_sale->date_quarter = $date_quarter;
				$model_sale->create_date = date("Y-m-d");
				$model_sale->update_date = date("Y-m-d");
				$model_sale->total_sales = $_POST['Calculator']['total_salesrep'];
				$model_sale->shipping_cost = $_POST['Calculator']['shipping_cost_salesrep'];
				$model_sale->creditcard_feecost = $_POST['Calculator']['creditcard_feecost_salesrep'];
				$model_sale->comp_itemcost = $_POST['Calculator']['comp_itemcost_salesrep'];
				$model_sale->invoice_amount_received = $_POST['Calculator']['invoice_amount_received'];
				$model_sale->sales_manager = $_POST['Calculator']['sales_rep'];
				$model_sale->sales_status = "2";
				$model_sale->date_for_sales = $_POST['Calculator']['date_for_sales_salesrep'];
				$model_sale->pay_for_sales = $_POST['Calculator']['pay_for_sales_salesrep'];
				$model_sale->payment_method = $_POST['Calculator']['payment_method_salesrep'];
				
				if(empty($_POST['Calculator']['invoice_status'])){
					
					$model_sale->invoice_status = "Outstanding";
				}
				
				if(empty($_POST['Calculator']['commisson_payment_status_salesrep'])){
					
					$model_sale->commisson_payment_status = "Outstanding";
				}else{
					$model_sale->status_commission = "Approved";
					$model_sale->commisson_payment_status = $_POST['Calculator']['commisson_payment_status_salesrep'];
				}
				/*if(empty($_POST['Calculator']['status_commission'])){
					
					$model_sale->status_commission = "Pending";
				}*/
				
				list($year,$momth,$day) = explode("-",$date_quarter);
				
				$model_sale->save();
				$mail_sale = "";
				
				//////////// Send Mail /////////////////
				
				$result['sale_tomail'] = Yii::app()->db->createCommand()
					->select('*')
					->from('user u')
					->where('u.fullname = "'.$_POST['Calculator']['sales_manager'].'"')
					->queryAll();
					
				foreach ($result['sale_tomail'] as $key_mail => $value_mail) {
					
					if($value_mail['fullname'] == "Jog Sports"){
						$mail_sale = "";
						$mail_namesale = "Jog Sports";
					}else{
						$mail_sale = $value_mail['email'];
						$mail_namesale = $value_mail['fullname'];
					}
					
				}
				
				
				//////////// End Send Mail ////////////
			
			
			}
			if(!empty($_POST['Calculator']['sales_processor'])){
			//echo $_POST['Calculator']['sales_processor']."<br>";
				
				$model_processor = new Calculator;
			
				$model_processor->attributes = $_POST['Calculator'];
				
				foreach ($_FILES['Calculator']['name']['file_path'] as $key => $value) {
					
					$uploadedFile = CUploadedFile::getInstance($model_processor,"file_path[$key]");
					
					if (!is_null($uploadedFile)) {
					
						$filePath = date('Ymd') . '-' . $_POST['Calculator']['invoice'] . '.' . $uploadedFile->extensionName;

						$model_processor->file_path = $filePath;
						
						if ($model_processor->save()) {
							$uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/invoice/docs/' . $filePath);
							Yii::app()->user->setFlash('success', 'Upload Success');
							//$this->redirect(array('index'));
						} else {
							Yii::app()->user->setFlash('error', 'Upload Error');
							//$this->redirect(array('index'));
						}
				   
					}				
				}
				
				if(!empty($_POST['Calculator']['commission_percent'])){
					$commission = ((((floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost'])) - floatval($_POST['Calculator']['creditcard_feecost']))*0));
					
					$model_processor->commission_percent = "0";
					$model_processor->commission = $commission;	
				}
				
				$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));
				
				$model_processor->invoice = $_POST['Calculator']['invoice'];
				$model_processor->date_quarter = $date_quarter;
				$model_processor->create_date = date("Y-m-d");
				$model_processor->update_date = date("Y-m-d");
				$model_processor->total_sales = "0";
				$model_processor->shipping_cost = "0";
				$model_processor->creditcard_feecost = "0";
				$model_processor->invoice_amount_received = $_POST['Calculator']['invoice_amount_received'];
				$model_processor->sales_manager = $_POST['Calculator']['sales_processor'];
				$model_processor->sales_status = "3";
				
				if(empty($_POST['Calculator']['invoice_status'])){
					
					$model_processor->invoice_status = "Outstanding";
				}
				
				if(empty($_POST['Calculator']['commisson_payment_status'])){
					
					$model_processor->commisson_payment_status = "Outstanding";
				}
				if(empty($_POST['Calculator']['status_commission'])){
					
					$model_processor->status_commission = "Approved";
				}
				
				list($year,$momth,$day) = explode("-",$date_quarter);
				
				$model_processor->save();
			
				//////////// Send Mail /////////////////
					
					if($value_mail['fullname'] == "Jog Sports"){
						$mail_sale_processor = "";
						$mail_namesale_processor = "Jog Sports";
					}else{
						$mail_sale_processor = "";
						$mail_namesale_processor = $_POST['Calculator']['sales_processor'];
					}
						
			}
			
					
				//////////// Send Mail /////////////////
				
				
				if($_POST['Calculator']['date_quarter'] != "0000-00-00"){
					$_month_name_s = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
														 
					$date_for_sales = $_POST['Calculator']['date_quarter'];
					list($year_s,$momth_s,$day_s) = explode("-",$date_for_sales);
											
					if ($day_s < 10){
						$day_s = substr($day_s,1,2);
					}
					$date_s = $_month_name_s[$momth_s]." ".$day_s.",  ".$year_s;
				}		
				
				
				$data['invoice'] = $_POST['Calculator']['invoice'];
				$data['order_name'] = $_POST['Calculator']['order_name'];
				$data['currency'] = $_POST['Calculator']['currency'];
				$data['date_Quarter'] = $date_s;
				$data['invoice_file'] = $filePath;
				if($_POST['Calculator']['invoice_status'] != ""){
					$data['invoice_status'] = $_POST['Calculator']['invoice_status'];	
				}else{
					$data['invoice_status'] = "<span style=\"color:red\">Outstanding</span>";	
				}
				$date_in= "";
				if($_POST['Calculator']['invoice_date'] != "0000-00-00" && !empty($_POST['Calculator']['invoice_date'])){
					
					$_month_name_in = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
														 
					$invoice_date = $_POST['Calculator']['invoice_date'];
					
					list($year_in,$momth_in,$day_in) = explode("-",$invoice_date);
											
					if ($day_in < 10){
						$day_in = substr($day_in,1,2);
					}
					$date_in = $_month_name_in[$momth_in]." ".$day_in.",  ".$year_in;
					
				}		
				$data['date'] = $date_in;
				$data['invoice_amount_received'] = $_POST['Calculator']['invoice_amount_received'];
				$data['invoice_payment_method'] = $_POST['Calculator']['invoice_payment_method'];
				$data['order_no'] = $_POST['Calculator']['order_no'];
							
				if(!empty($_POST['Calculator']['invoice'])){		
				$subject = 'New! Invoice';
				$message = $this->renderPartial('_mailAddInvoice', $data, true);
				
				//  set send email
				
					$mail=Yii::app()->Smtpmail;
					$mail->CharSet = 'utf-8'; 
					$mail->SetFrom("noreply.salerep@jogathletics.com", 'Sales Commission');
					$mail->Subject = $subject;
					$mail->MsgHTML($message);
					$mail->AddAddress($mail_sale_manager, $mail_namesale_manager);
					$mail->AddCC($mail_sale, $mail_namesale);
					$mail->AddCC($mail_sale_processor, $mail_namesale_processor);
					//$mail->AddAddress('administration@jogsportswear.com', 'Admin');
					//$mail->AddBCC('swhitcomb@jogsports.com', "");
					$mail->AddCC('swhitcomb@jogsports.com', "");
					
					$mail->AddCC('accountsreceivables@jogsportswear.com', "Admin");
					//$mail->AddCC('administration@jogsportswear.com', 'Web Master');

				// 	if(!$mail->Send()) {
				// 		Yii::app()->user->setFlash('error', "<strong>Mailer Error!! </strong>" . $mail->ErrorInfo);
				// 	}else {
				// 		Yii::app()->user->setFlash('success', 'Message Already sent!');
				// 	}
				// 		$mail->ClearAddresses(); //clear addresses for next email sending
				}
				//////////// End Send Mail ////////////
				
				
				//$this->redirect(array('calculator/SalesCommission/year/'.$year.'/sales/'.$_POST['Calculator']['sales_manager']));
				
				$this->redirect(array('calculator/Invoice/year/'.$year));
		}	
		
		$result['error_message'] = "Invoice number repeat, Please recheck and try agian.";
		$result['year'] = $year_ch;
		$this->render('error_FiscalYearInvoice', $result);
	}
	
	public function actionAddCalculatorEachSalesRepSubmit()
	{	
		$comments = new Comments;
		$mail_sale = "";
		$mail_namesale_processor="";
		$mail_sale_processor = "";
		$mail_namesale = "";
		$mail_sale_manager = "";
		$mail_namesale_manager = "";
		
		$checkCalculator = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator c')
			->where('c.invoice = "'.$_POST['Calculator']['invoice'].'"')
			->queryAll();
		
		
		list($year_ch,$momth_ch,$day_ch) = explode("-",$_POST['Calculator']['date_quarter']);
		
		foreach ($checkCalculator as $key_check => $value_check) {	
			$checkdouble	= $value_check['invoice'];
		}
		
		if(empty($checkdouble)){
				
				
			if(!empty($_POST['Calculator']['sales_manager'])){
				//echo $_POST['Calculator']['sales_manager']."<br>";	
				
			$model = new Calculator;
			
			$model->attributes = $_POST['Calculator'];
			
			foreach ($_FILES['Calculator']['name']['file_path'] as $key => $value) {
				
				$uploadedFile = CUploadedFile::getInstance($model,"file_path[$key]");
				
				if (!is_null($uploadedFile)) {
				
					$filePath = date('Ymd') . '-' . $_POST['Calculator']['invoice'] . '.' . $uploadedFile->extensionName;

					$model->file_path = $filePath;
					//$model->file_type = $uploadedFile->extensionName;
					//$model->file_datetime = date('Y-m-d H:i:s');

					if ($model->save()) {
						$uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/invoice/docs/' . $filePath);
						Yii::app()->user->setFlash('success', 'Upload Success');
						//$this->redirect(array('index'));
					} else {
						Yii::app()->user->setFlash('error', 'Upload Error');
						//$this->redirect(array('index'));
					}
				}	
			}
				
				if(!empty($_POST['Calculator']['commission_percent'])){
				// 	$commission = (((((floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost']))- floatval($_POST['Calculator']['creditcard_feecost'])) - floatval($_POST['Calculator']['comp_itemcost']))*floatval($_POST['Calculator']['commission_percent']))/100);
				$cmsn_sales = (((((floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost']))- floatval($_POST['Calculator']['creditcard_feecost'])))*floatval($_POST['Calculator']['commission_percent']))/100);
				$comp_item = (floatval($_POST['Calculator']['comp_itemcost']))*20/100;
				$commission = $cmsn_sales-$comp_item;
				if($_POST['Calculator']['online_order_commission']!=0){
				    $commission = floatval($_POST['Calculator']['online_order_commission']);
				    $new_percent = round(($commission/(floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost'])- floatval($_POST['Calculator']['creditcard_feecost']))*100),2);
				    $_POST['Calculator']['commission_percent'] = $new_percent;
				}
					
					$model->commission = $commission;
					$model->status_commission = "Approved";					
				}else{
				    $model->status_commission = "Pending";
				    if($_POST['Calculator']['online_order_commission']!=0){
				        $commission = floatval($_POST['Calculator']['online_order_commission']);
				        $new_percent = round(($commission/(floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost'])- floatval($_POST['Calculator']['creditcard_feecost']))*100),2);
				        $_POST['Calculator']['commission_percent'] = $new_percent;
				        $model->commission = $commission;
					    $model->status_commission = "Approved";	
				    }
					
				}
				
				if($_POST['Calculator']['pay_for_sales']==''){$pay_for_sales='0';}else{$pay_for_sales=$_POST['Calculator']['pay_for_sales'];}
				if($_POST['Calculator']['pay_by_customer']==''){$pay_by_customer='0';}else{$pay_by_customer=$_POST['Calculator']['pay_by_customer'];}
				if($_POST['Calculator']['pay_by_credit']==''){$pay_by_credit='0';}else{$pay_by_credit=$_POST['Calculator']['pay_by_credit'];}
				
				
				$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));
				
				$model->invoice = $_POST['Calculator']['invoice'];
				$model->inv_link = $_POST['Calculator']['inv_link'];
				$model->order_no = $_POST['Calculator']['order_no'];
				$model->date_quarter = $date_quarter;
				$model->create_date = date("Y-m-d");
				$model->update_date = date("Y-m-d");
				$model->total_sales = $_POST['Calculator']['total_sales'];
				$model->shipping_cost = $_POST['Calculator']['shipping_cost'];
				$model->creditcard_feecost = $_POST['Calculator']['creditcard_feecost'];
				$model->royalty_feecost = $_POST['Calculator']['royalty_feecost'];
				$model->sales_tax = isset($_POST['Calculator']['sales_tax']) ? (float)$_POST['Calculator']['sales_tax'] : 0;
				$model->comp_itemcost = $_POST['Calculator']['comp_itemcost'];
				$model->online_order_commission = $_POST['Calculator']['online_order_commission'];
				$model->namebar_patches = $_POST['Calculator']['namebar_patches'];
				$model->commission_percent = $_POST['Calculator']['commission_percent'];
				// $model->commission_percent = round(($commission/$_POST['Calculator']['total_sales'])*100,2);
				if($_POST['Calculator']['online_order_commission']!=0){
				    $model->commission_percent = round(($commission/(floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost'])- floatval($_POST['Calculator']['creditcard_feecost'])))*100,2);
				}
				$model->invoice_amount_received = $_POST['Calculator']['invoice_amount_received'];
				$model->sales_manager = $_POST['Calculator']['sales_manager'];
				$model->sales_status = "1";
				
				$model->date_for_sales = $_POST['Calculator']['date_for_sales'];
				
				$model->pay_for_sales = $pay_for_sales;
				$model->pay_by_customer = $pay_by_customer;
				$model->pay_by_credit = $pay_by_credit;
				
				$model->payment_method = $_POST['Calculator']['payment_method'];
				
				if(empty($_POST['Calculator']['invoice_status'])){
					
					$model->invoice_status = "Outstanding";
				}
				
				if(empty($_POST['Calculator']['commisson_payment_status'])){
					
					$model->commisson_payment_status = "Outstanding";
				}else{
					$model->status_commission = "Approved";
					$model->commisson_payment_status = $_POST['Calculator']['commisson_payment_status'];
				}
				/*
				if(empty($_POST['Calculator']['status_commission'])){
					
					$model->status_commission = "Pending";
				}
				*/
				list($year,$momth,$day) = explode("-",$date_quarter);
				
				$model->save();
				
				//////////// Send Mail /////////////////
				
				$result['sale_tomail'] = Yii::app()->db->createCommand()
					->select('*')
					->from('user u')
					->where('u.fullname = "'.$_POST['Calculator']['sales_manager'].'"')
					->queryAll();
					
				foreach ($result['sale_tomail'] as $key_mail => $value_mail) {
					
					if($value_mail['fullname'] == "Jog Sports"){
						$mail_sale_manager = "";
						$mail_namesale_manager = "Jog Sports";
					}else{
						$mail_sale_manager = $value_mail['email'];
						$mail_namesale_manager = $value_mail['fullname'];
					}
					
				}
				
				
				
				//////////// End Send Mail ////////////
			
			
			}
			
			if(!empty($_POST['Calculator']['sales_rep'])){
				//echo $_POST['Calculator']['sales_rep']."<br>";	
				
			$model_sale = new Calculator;
			
			$model_sale->attributes = $_POST['Calculator'];
			
			foreach ($_FILES['Calculator']['name']['file_path'] as $key => $value) {
				
				$uploadedFile = CUploadedFile::getInstance($model_sale,"file_path[$key]");
				if (!is_null($uploadedFile)) {
					$filePath = date('Ymd') . '-' . $_POST['Calculator']['invoice'] . '.' . $uploadedFile->extensionName;

					$model_sale->file_path = $filePath;
					
					if ($model_sale->save()) {
						$uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/invoice/docs/' . $filePath);
						Yii::app()->user->setFlash('success', 'Upload Success');
						//$this->redirect(array('index'));
					} else {
						Yii::app()->user->setFlash('error', 'Upload Error');
						//$this->redirect(array('index'));
					}
				}
			}
			
				if(!empty($_POST['Calculator']['commission_percent_salesrep'])){
				// 	$commission = (((((floatval($_POST['Calculator']['total_salesrep']) - floatval($_POST['Calculator']['shipping_cost_salesrep'])) - floatval($_POST['Calculator']['creditcard_feecost_salesrep'])) - floatval($_POST['Calculator']['comp_itemcost_salesrep']))*floatval($_POST['Calculator']['commission_percent_salesrep']))/100);
					
					$cmsn_sales = (((((floatval($_POST['Calculator']['total_salesrep']) - floatval($_POST['Calculator']['shipping_cost_salesrep']))- floatval($_POST['Calculator']['creditcard_feecost_salesrep'])))*floatval($_POST['Calculator']['commission_percent_salesrep']))/100);
				    $comp_item = (floatval($_POST['Calculator']['comp_itemcost_salesrep']))*20/100;
				    $commission = $cmsn_sales-$comp_item;
					
					$model_sale->commission = $commission;
					$model_sale->status_commission = "Approved";					
				}else{
					$model_sale->status_commission = "Pending";
				}
				
				$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));
				
				$model_sale->invoice = $_POST['Calculator']['invoice'];
				$model_sale->date_quarter = $date_quarter;
				$model_sale->create_date = date("Y-m-d");
				$model_sale->update_date = date("Y-m-d");
				$model_sale->total_sales = $_POST['Calculator']['total_salesrep'];
				$model_sale->shipping_cost = $_POST['Calculator']['shipping_cost_salesrep'];
				$model_sale->creditcard_feecost = $_POST['Calculator']['creditcard_feecost_salesrep'];
				$model_sale->comp_itemcost = $_POST['Calculator']['comp_itemcost_salesrep'];
				$model_sale->commission_percent = $_POST['Calculator']['commission_percent_salesrep'];
				//$model_sale->commission_percent = round(($commission/$_POST['Calculator']['total_salesrep'])*100,2);
				$model_sale->invoice_amount_received = $_POST['Calculator']['invoice_amount_received'];
				$model_sale->sales_manager = $_POST['Calculator']['sales_rep'];
				$model_sale->sales_status = "2";
				
				if(empty($_POST['Calculator']['invoice_status'])){
					
					$model_sale->invoice_status = "Outstanding";
				}
				
				if(empty($_POST['Calculator']['commisson_payment_status_salesrep'])){
					
					$model_sale->commisson_payment_status = "Outstanding";
				}else{
					$model_sale->status_commission = "Approved";
					$model_sale->commisson_payment_status = $_POST['Calculator']['commisson_payment_status_salesrep'];
				}


				if(empty($_POST['Calculator']['status_commission'])){
					
					$model_sale->status_commission = "Pending";
				}
				
				list($year,$momth,$day) = explode("-",$date_quarter);
				
				$model_sale->save();
				
				
				//////////// Send Mail /////////////////
				
				$result['sale_tomail'] = Yii::app()->db->createCommand()
					->select('*')
					->from('user u')
					->where('u.fullname = "'.$_POST['Calculator']['sales_manager'].'"')
					->queryAll();
					
				foreach ($result['sale_tomail'] as $key_mail => $value_mail) {
					
					if($value_mail['fullname'] == "Jog Sports"){
						$mail_sale = "";
						$mail_namesale = "Jog Sports";
					}else{
						$mail_sale = $value_mail['email'];
						$mail_namesale = $value_mail['fullname'];
					}
					
				}
				
				
				//////////// End Send Mail ////////////
			
			
			}
			if(!empty($_POST['Calculator']['sales_processor'])){
			//echo $_POST['Calculator']['sales_processor']."<br>";
				
				$model_processor = new Calculator;
			
				$model_processor->attributes = $_POST['Calculator'];
				
				foreach ($_FILES['Calculator']['name']['file_path'] as $key => $value) {
					
					$uploadedFile = CUploadedFile::getInstance($model_processor,"file_path[$key]");
					if (!is_null($uploadedFile)) {
					
						$filePath = date('Ymd') . '-' . $_POST['Calculator']['invoice'] . '.' . $uploadedFile->extensionName;

						$model_processor->file_path = $filePath;
						
						if ($model_processor->save()) {
							$uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/invoice/docs/' . $filePath);
							Yii::app()->user->setFlash('success', 'Upload Success');
							//$this->redirect(array('index'));
						} else {
							Yii::app()->user->setFlash('error', 'Upload Error');
							//$this->redirect(array('index'));
						}
				   
					}				
				}
				
				
				$model_processor->commission = 0;
				
				$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));
				
				$model_processor->invoice = $_POST['Calculator']['invoice'];
				$model_processor->date_quarter = $date_quarter;
				$model_processor->create_date = date("Y-m-d");
				$model_processor->update_date = date("Y-m-d");
				$model_processor->total_sales = $_POST['Calculator']['total_sales'];
				$model_processor->shipping_cost = $_POST['Calculator']['shipping_cost'];
				$model_processor->creditcard_feecost = $_POST['Calculator']['creditcard_feecost'];
				$model_processor->comp_itemcost = $_POST['Calculator']['comp_itemcost'];
				$model_processor->online_order_commission = $_POST['Calculator']['online_order_commission'];
				$model_processor->namebar_patches = $_POST['Calculator']['namebar_patches'];
				$model_processor->commission_percent = "0";
				$model_processor->invoice_amount_received = $_POST['Calculator']['invoice_amount_received'];
				$model_processor->sales_manager = $_POST['Calculator']['sales_processor'];
				$model_processor->sales_status = "3";
				
				if(empty($_POST['Calculator']['invoice_status'])){
					
					$model_processor->invoice_status = "Outstanding";
				}
				
				if(empty($_POST['Calculator']['commisson_payment_status'])){
					
					$model_processor->commisson_payment_status = "Outstanding";
				}
				if(empty($_POST['Calculator']['status_commission'])){
					
					$model_processor->status_commission = "Pending";
				}
				
				list($year,$momth,$day) = explode("-",$date_quarter);
				
				$model_processor->save();
			
				//////////// Send Mail /////////////////
					
					if($value_mail['fullname'] == "Jog Sports"){
						$mail_sale_processor = "";
						$mail_namesale_processor = "Jog Sports";
					}else{
						$mail_sale_processor = "";
						$mail_namesale_processor = $_POST['Calculator']['sales_processor'];
					}
						
			}
			
					
				//////////// Send Mail /////////////////
				
				
				if($_POST['Calculator']['date_quarter'] != "0000-00-00"){
					$_month_name_s = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
														 
					$date_for_sales = $_POST['Calculator']['date_quarter'];
					list($year_s,$momth_s,$day_s) = explode("-",$date_for_sales);
											
					if ($day_s < 10){
						$day_s = substr($day_s,1,2);
					}
					$date_s = $_month_name_s[$momth_s]." ".$day_s.",  ".$year_s;
				}		
				
				$data['invoice'] = $_POST['Calculator']['invoice'];
				$data['order_name'] = $_POST['Calculator']['order_name'];
				$data['currency'] = $_POST['Calculator']['currency'];
				$data['date_Quarter'] = $date_s;
				$data['invoice_file'] = $filePath;
				if($_POST['Calculator']['invoice_status'] != ""){
					$data['invoice_status'] = $_POST['Calculator']['invoice_status'];	
				}else{
					$data['invoice_status'] = "<span style=\"color:red\">Outstanding</span>";	
				}
				
				if($_POST['Calculator']['invoice_date'] != "0000-00-00"){
					$_month_name_in = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
														 
					$invoice_date = $_POST['Calculator']['invoice_date'];
					list($year_in,$momth_in,$day_in) = explode("-",$invoice_date);
											
					if ($day_in < 10){
						$day_in = substr($day_in,1,2);
					}
					$date_in = $_month_name_in[$momth_in]." ".$day_in.",  ".$year_in;
				}		
				$data['date'] = $date_in;
				$data['invoice_amount_received'] = $_POST['Calculator']['invoice_amount_received'];
				$data['invoice_payment_method'] = $_POST['Calculator']['invoice_payment_method'];
				$data['order_no'] = $_POST['Calculator']['order_no'];
							
				if(!empty($_POST['Calculator']['invoice'])){		
				$subject = 'New! Invoice';
				$message = $this->renderPartial('_mailAddInvoice', $data, true);
				
				//  set send email
	
					$mail=Yii::app()->Smtpmail;
					$mail->CharSet = 'utf-8'; 
					$mail->SetFrom("noreply.salerep@jogathletics.com", 'Sales Commission');
					$mail->Subject = $subject;
					$mail->MsgHTML($message);
					$mail->AddAddress($mail_sale_manager, $mail_namesale_manager);
					//$mail->AddCC($mail_sale, $mail_namesale);
					$mail->AddCC($mail_sale_processor, $mail_namesale_processor);
					//$mail->AddAddress('administration@jogsportswear.com', 'Admin');
					//$mail->AddBCC('swhitcomb@jogsports.com', "");
					$mail->AddCC('swhitcomb@jogsports.com', "");
					
					$mail->AddCC('accountsreceivables@jogsportswear.com', "Admin");
					//$mail->AddCC('administration@jogsportswear.com', 'Web Master');

				// 	if(!$mail->Send()) {
				// 		Yii::app()->user->setFlash('error', "<strong>Mailer Error!! </strong>" . $mail->ErrorInfo);
				// 	}else {
				// 		Yii::app()->user->setFlash('success', 'Message Already sent!');
				// 	}
				// 		$mail->ClearAddresses(); //clear addresses for next email sending
				
				//////////// End Send Mail ////////////
				}
				
				//$this->redirect(array('calculator/SalesCommission/year/'.$year.'/sales/'.$_POST['Calculator']['sales_manager']));
				
				$this->redirect(array('calculator/SalesCommission/year/'.$year.'/sales/'.$_POST['salesRep']));
				
			}
			
			$result['error_message'] = "Invoice number repeat, Please recheck and try agian.";
			$result['year'] = $year_ch;
			$result['sales'] = $_POST['salesRep'];
			$this->render('error_InvoiceSalesCommission', $result);
			
	}
	public function actionAddCalculatorFiscalYearSubmit()
	{	
		$comments = new Comments;
				$mail_sale = "";
		$mail_namesale_processor="";
		$mail_sale_processor = "";
		$mail_namesale = "";
		$mail_sale_manager = "";
		$mail_namesale_manager = "";
		
		
		$checkCalculator = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator c')
			->where('c.invoice = "'.$_POST['Calculator']['invoice'].'"')
			->queryAll();
		
		
		list($year_ch,$momth_ch,$day_ch) = explode("-",$_POST['Calculator']['date_quarter']);
		
		foreach ($checkCalculator as $key_check => $value_check) {	
			$checkdouble = $value_check['invoice'];
		}
			if(empty($checkdouble)){
			
				if(!empty($_POST['Calculator']['sales_manager'])){
					//echo $_POST['Calculator']['sales_manager']."<br>";	
					
				$model = new Calculator;
				
				$model->attributes = $_POST['Calculator'];
				
				foreach ($_FILES['Calculator']['name']['file_path'] as $key => $value) {
					
					$uploadedFile = CUploadedFile::getInstance($model,"file_path[$key]");
					
					if (!is_null($uploadedFile)) {
						$filePath = date('Ymd') . '-' . $_POST['Calculator']['invoice'] . '.' . $uploadedFile->extensionName;

						$model->file_path = $filePath;
						//$model->file_type = $uploadedFile->extensionName;
						//$model->file_datetime = date('Y-m-d H:i:s');

						if ($model->save()) {
							$uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/invoice/docs/' . $filePath);
							Yii::app()->user->setFlash('success', 'Upload Success');
							//$this->redirect(array('index'));
						} else {
							Yii::app()->user->setFlash('error', 'Upload Error');
							//$this->redirect(array('index'));
						}
					}	
				}
					
					if(!empty($_POST['Calculator']['commission_percent'])){
						$commission = ((((floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost'])) - floatval($_POST['Calculator']['creditcard_feecost']))*floatval($_POST['Calculator']['commission_percent']))/100);
						
						$model->commission = $commission;
						$model->status_commission = "Approved";						
					}else{
						$model->status_commission = "Pending";
					}
					
					$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));
					
					$model->invoice = $_POST['Calculator']['invoice'];
					$model->order_no = $_POST['Calculator']['order_no'];
					$model->date_quarter = $date_quarter;
					$model->create_date = date("Y-m-d");
					$model->update_date = date("Y-m-d");
					$model->total_sales = $_POST['Calculator']['total_sales'];
					$model->shipping_cost = $_POST['Calculator']['shipping_cost'];
					$model->creditcard_feecost = $_POST['Calculator']['creditcard_feecost'];
					//$model->commission_percent = round(($commission/$_POST['Calculator']['total_sales'])*100,2);
				    $model->commission_percent = $_POST['Calculator']['commission_percent'];
					$model->sales_manager = $_POST['Calculator']['sales_manager'];
					$model->invoice_amount_received = $_POST['Calculator']['invoice_amount_received'];
					$model->sales_status = "1";
					$model->date_for_sales = $_POST['Calculator']['date_for_sales'];
					$model->pay_for_sales = $_POST['Calculator']['pay_for_sales'];
					$model->payment_method = $_POST['Calculator']['payment_method'];
					
					if(empty($_POST['Calculator']['invoice_status'])){
						
						$model->invoice_status = "Outstanding";
					}
					
					if(empty($_POST['Calculator']['commisson_payment_status'])){
						
						$model->commisson_payment_status = "Outstanding";
					}
					else{
						$model->status_commission = "Approved";
						$model->commisson_payment_status = $_POST['Calculator']['commisson_payment_status'];
					}
					/*if(empty($_POST['Calculator']['status_commission'])){
						
						$model->status_commission = "Pending";
					}*/
					
					list($year,$momth,$day) = explode("-",$date_quarter);
					
					$model->save();
					
					//////////// Send Mail /////////////////
					
					$result['sale_tomail'] = Yii::app()->db->createCommand()
						->select('*')
						->from('user u')
						->where('u.fullname = "'.$_POST['Calculator']['sales_manager'].'"')
						->queryAll();
						
					foreach ($result['sale_tomail'] as $key_mail => $value_mail) {
						
						if($value_mail['fullname'] == "Jog Sports"){
							$mail_sale_manager = "";
							$mail_namesale_manager = "Jog Sports";
						}else{
							$mail_sale_manager = $value_mail['email'];
							$mail_namesale_manager = $value_mail['fullname'];
						}
						
					}
					
					
					
					//////////// End Send Mail ////////////
				
				
				}
				
				if(!empty($_POST['Calculator']['sales_rep'])){
					//echo $_POST['Calculator']['sales_rep']."<br>";	
					
				$model_sale = new Calculator;
				
				$model_sale->attributes = $_POST['Calculator'];
				
				foreach ($_FILES['Calculator']['name']['file_path'] as $key => $value) {
					
					$uploadedFile = CUploadedFile::getInstance($model_sale,"file_path[$key]");
					
					if (!is_null($uploadedFile)) {
						$filePath = date('Ymd') . '-' . $_POST['Calculator']['invoice'] . '.' . $uploadedFile->extensionName;

						$model_sale->file_path = $filePath;
						
						if ($model_sale->save()) {
							$uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/invoice/docs/' . $filePath);
							Yii::app()->user->setFlash('success', 'Upload Success');
							//$this->redirect(array('index'));
						} else {
							Yii::app()->user->setFlash('error', 'Upload Error');
							//$this->redirect(array('index'));
						}
				   
					}				
				}
				
					if(!empty($_POST['Calculator']['commission_percent_salesrep'])){
						$commission = ((((floatval($_POST['Calculator']['total_salesrep']) - floatval($_POST['Calculator']['shipping_cost_salesrep'])) - floatval($_POST['Calculator']['creditcard_feecost_salesrep']))*floatval($_POST['Calculator']['commission_percent_salesrep']))/100);
						
						$model_sale->commission = $commission;
						$model_sale->status_commission = "Approved";						
					}else{
						$model_sale->status_commission = "Pending";
					}
					
					$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));
					
					$model_sale->invoice = $_POST['Calculator']['invoice'];
					$model_sale->date_quarter = $date_quarter;
					$model_sale->create_date = date("Y-m-d");
					$model_sale->update_date = date("Y-m-d");
					$model_sale->total_sales = $_POST['Calculator']['total_salesrep'];
					$model_sale->shipping_cost = $_POST['Calculator']['shipping_cost_salesrep'];
					$model_sale->creditcard_feecost = $_POST['Calculator']['creditcard_feecost_salesrep'];
					//$model_sale->commission_percent = round(($commission/$_POST['Calculator']['total_salesrep'])*100,2);
				    $model_sale->commission_percent = $_POST['Calculator']['commission_percent_salesrep'];
					$model_sale->invoice_amount_received = $_POST['Calculator']['invoice_amount_received'];
					$model_sale->sales_manager = $_POST['Calculator']['sales_rep'];
					$model_sale->sales_status = "2";
					
					$model_sale->date_for_sales = $_POST['Calculator']['date_for_sales_salesrep'];
					$model_sale->pay_for_sales = $_POST['Calculator']['pay_for_sales_salesrep'];
					$model_sale->payment_method = $_POST['Calculator']['payment_method_salesrep'];
					
					if(empty($_POST['Calculator']['invoice_status'])){
						
						$model_sale->invoice_status = "Outstanding";
					}
					
					if(empty($_POST['Calculator']['commisson_payment_status'])){
						
						$model_sale->commisson_payment_status = "Outstanding";
					}else{
						$model_sale->status_commission = "Approved";
						$model_sale->commisson_payment_status = $_POST['Calculator']['commisson_payment_status_salesrep'];
					}
					/*if(empty($_POST['Calculator']['status_commission'])){
						
						$model_sale->status_commission = "Pending";
					}*/
					
					list($year,$momth,$day) = explode("-",$date_quarter);
					
					$model_sale->save();
					
					
					//////////// Send Mail /////////////////
					
					$result['sale_tomail'] = Yii::app()->db->createCommand()
						->select('*')
						->from('user u')
						->where('u.fullname = "'.$_POST['Calculator']['sales_manager'].'"')
						->queryAll();
						
					foreach ($result['sale_tomail'] as $key_mail => $value_mail) {
						
						if($value_mail['fullname'] == "Jog Sports"){
							$mail_sale = "";
							$mail_namesale = "Jog Sports";
						}else{
							$mail_sale = $value_mail['email'];
							$mail_namesale = $value_mail['fullname'];
						}
						
					}
					
					
					//////////// End Send Mail ////////////
				
				
				}
				if(!empty($_POST['Calculator']['sales_processor'])){
				//echo $_POST['Calculator']['sales_processor']."<br>";
					
					$model_processor = new Calculator;
				
					$model_processor->attributes = $_POST['Calculator'];
					
					foreach ($_FILES['Calculator']['name']['file_path'] as $key => $value) {
						
						$uploadedFile = CUploadedFile::getInstance($model_processor,"file_path[$key]");
						if (!is_null($uploadedFile)) {
							$filePath = date('Ymd') . '-' . $_POST['Calculator']['invoice'] . '.' . $uploadedFile->extensionName;

							$model_processor->file_path = $filePath;
							
							if ($model_processor->save()) {
								$uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/invoice/docs/' . $filePath);
								Yii::app()->user->setFlash('success', 'Upload Success');
								//$this->redirect(array('index'));
							} else {
								Yii::app()->user->setFlash('error', 'Upload Error');
								//$this->redirect(array('index'));
							}
					   
						}					
					}
					
					if(!empty($_POST['Calculator']['commission_percent'])){
						$commission = ((((floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost'])) - floatval($_POST['Calculator']['creditcard_feecost']))*0));
						
						$model_processor->commission = $commission;	
					}
					
					$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));
					
					$model_processor->invoice = $_POST['Calculator']['invoice'];
					$model_processor->date_quarter = $date_quarter;
					$model_processor->create_date = date("Y-m-d");
					$model_processor->update_date = date("Y-m-d");
					$model_processor->total_sales = "0";
					$model_processor->shipping_cost = "0";
					$model_processor->creditcard_feecost = "0";
					$model_processor->commission_percent = "0";
					$model_processor->invoice_amount_received = $_POST['Calculator']['invoice_amount_received'];
					$model_processor->sales_manager = $_POST['Calculator']['sales_processor'];
					$model_processor->sales_status = "3";
					
					if(empty($_POST['Calculator']['invoice_status'])){
						
						$model_processor->invoice_status = "Outstanding";
					}
					
					if(empty($_POST['Calculator']['commisson_payment_status'])){
						
						$model_processor->commisson_payment_status = "Outstanding";
					}
					if(empty($_POST['Calculator']['status_commission'])){
						
						$model_processor->status_commission = "Pending";
					}
					
					list($year,$momth,$day) = explode("-",$date_quarter);
					
					$model_processor->save();
				
					//////////// Send Mail /////////////////
						
						if($value_mail['fullname'] == "Jog Sports"){
							$mail_sale_processor = "";
							$mail_namesale_processor = "Jog Sports";
						}else{
							$mail_sale_processor = "";
							$mail_namesale_processor = $_POST['Calculator']['sales_processor'];
						}
							
				}
				
						
					//////////// Send Mail /////////////////
					
					
					if($_POST['Calculator']['date_quarter'] != "0000-00-00"){
						$_month_name_s = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
															 
						$date_for_sales = $_POST['Calculator']['date_quarter'];
						list($year_s,$momth_s,$day_s) = explode("-",$date_for_sales);
												
						if ($day_s < 10){
							$day_s = substr($day_s,1,2);
						}
						$date_s = $_month_name_s[$momth_s]." ".$day_s.",  ".$year_s;
					}		
					
					$data['invoice'] = $_POST['Calculator']['invoice'];
					$data['order_name'] = $_POST['Calculator']['order_name'];
					$data['currency'] = $_POST['Calculator']['currency'];
					$data['date_Quarter'] = $date_s;
					$data['invoice_file'] = $filePath;
					if($_POST['Calculator']['invoice_status'] != ""){
						$data['invoice_status'] = $_POST['Calculator']['invoice_status'];	
					}else{
						$data['invoice_status'] = "<span style=\"color:red\">Outstanding</span>";	
					}
					
					if($_POST['Calculator']['invoice_date'] != "0000-00-00"){
						$_month_name_in = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
															 
						$invoice_date = $_POST['Calculator']['invoice_date'];
						list($year_in,$momth_in,$day_in) = explode("-",$invoice_date);
												
						if ($day_in < 10){
							$day_in = substr($day_in,1,2);
						}
						$date_in = $_month_name_in[$momth_in]." ".$day_in.",  ".$year_in;
					}		
					$data['date'] = $date_in;
					$data['invoice_amount_received'] = $_POST['Calculator']['invoice_amount_received'];
					$data['invoice_payment_method'] = $_POST['Calculator']['invoice_payment_method'];
					$data['order_no'] = $_POST['Calculator']['order_no'];
								
					
					if(!empty($_POST['Calculator']['invoice'])){	
						$subject = 'New! Invoice';
						$message = $this->renderPartial('_mailAddInvoice', $data, true);
						
						//  set send email
			
							$mail=Yii::app()->Smtpmail;
							$mail->CharSet = 'utf-8'; 
							$mail->SetFrom("noreply.salerep@jogathletics.com", 'Sales Commission');
							$mail->Subject = $subject;
							$mail->MsgHTML($message);
							$mail->AddAddress($mail_sale_manager, $mail_namesale_manager);
							$mail->AddCC($mail_sale, $mail_namesale);
							$mail->AddCC($mail_sale_processor, $mail_namesale_processor);
							//$mail->AddAddress('administration@jogsportswear.com', 'Admin');
							//$mail->AddBCC('swhitcomb@jogsports.com', "");
							$mail->AddCC('swhitcomb@jogsports.com', "");
							
							$mail->AddCC('accountsreceivables@jogsportswear.com', "Admin");
							//$mail->AddCC('administration@jogsportswear.com', 'Web Master');

				// 			if(!$mail->Send()) {
				// 				Yii::app()->user->setFlash('error', "<strong>Mailer Error!! </strong>" . $mail->ErrorInfo);
				// 			}else {
				// 				Yii::app()->user->setFlash('success', 'Message Already sent!');
				// 			}
								$mail->ClearAddresses(); //clear addresses for next email sending
						
						//////////// End Send Mail ////////////
					}
					
					//$this->redirect(array('calculator/SalesCommission/year/'.$year.'/sales/'.$_POST['Calculator']['sales_manager']));
					
					$this->redirect(array('calculator/sales/year/'.$year));
			}
			
			$result['error_message'] = "Invoice number repeat, Please recheck and try agian.";
			$result['year'] = $year_ch;
			$this->render('error_Invoice', $result);
	}
	public function actionEditCalculatorSubmit()
	{	
		
		//$model = new Calculator;
		$model = Calculator::model()->findByPk($_POST['Calculator']['id']);
		$model->attributes = $_POST['Calculator'];
		
		//echo $model->file_path;
			//foreach ($_FILES['Calculator']['name']['file_path'] as $key => $value) {
				
				$uploadedFile = CUploadedFile::getInstance($model,"file_path");
				
				if (!is_null($uploadedFile)) {
					$filePath = date('Ymd') . '-' . $model['invoice'] . '.' . $uploadedFile->extensionName;

					$model->file_path = $filePath;
					//$model->file_type = $uploadedFile->extensionName;
					//$model->file_datetime = date('Y-m-d H:i:s');

					if ($model->save()) {
						$uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/invoice/docs/' . $filePath);
						Yii::app()->user->setFlash('success', 'Upload Success');
						//$this->redirect(array('index'));
					} else {
						Yii::app()->user->setFlash('error', 'Upload Error');
						//$this->redirect(array('index'));
					}
				}else{
					$filePath = $_POST['Calculator']['file_path'];
				}
			//}
		
			$commission = "";	
			if(!empty($_POST['Calculator']['commission_percent'])){				
				// $commission = (((((floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost'])) - floatval($_POST['Calculator']['creditcard_feecost'])) - floatval($_POST['Calculator']['comp_itemcost']))*floatval($_POST['Calculator']['commission_percent']))/100);
				$cmsn_sales = (((((floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost']) -  floatval($_POST['Calculator']['royalty_feecost']))- floatval($_POST['Calculator']['creditcard_feecost'])))*floatval($_POST['Calculator']['commission_percent']))/100);
				$comp_item = (floatval($_POST['Calculator']['comp_itemcost']))*20/100;
				$commission = $cmsn_sales-$comp_item;
			}
			if($_POST['Calculator']['online_order_commission']!=0){
				    $commission = floatval($_POST['Calculator']['online_order_commission']);
				    $new_percent = round(($commission/(floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost']) - floatval($_POST['Calculator']['royalty_feecost']) - floatval($_POST['Calculator']['creditcard_feecost']))*100),2);
				    $_POST['Calculator']['commission_percent'] = $new_percent;
			}
			
			$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));

			list($year,$momth,$day) = explode("-",$date_quarter);
			//echo $filePath;
			
				$editinvoice = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator c')
				->where('c.id = "'.$_POST['Calculator']['id'].'"')
			    ->queryAll();
				
			foreach ($editinvoice as $key => $value) {
				
				$invoice = $value['invoice'];
				
				$connection2 = Yii::app()->db;
				$sql2 = 'UPDATE calculator SET 
				invoice = "'.$_POST['Calculator']['invoice'].'", 
				inv_link = "'.$_POST['Calculator']['inv_link'].'", 
				order_no = "'.$_POST['Calculator']['order_no'].'", 
				order_name = "'.$_POST['Calculator']['order_name'].'", 
				date_quarter = "'.$date_quarter.'", 
				file_path = "'.$filePath.'", 
				
				invoice_status = "'.$_POST['Calculator']['invoice_status'].'", 
				invoice_date = "'.$_POST['Calculator']['invoice_date'].'", 
				invoice_amount_received = "'.$_POST['Calculator']['invoice_amount_received'].'", 
				invoice_payment_method = "'.$_POST['Calculator']['invoice_payment_method'].'", 
				
				currency = "'.$_POST['Calculator']['currency'].'", 
				update_date = "'.date("Y-m-d").'"
				
				WHERE invoice = "'.$invoice.'"';
				$command2 = $connection2->createCommand($sql2);
				$command2->execute();
				
			//----------------------------------------------------------	
				
				$commission     = (float) $commission;
				$payForSales    = (float) ($_POST['Calculator']['pay_for_sales'] ?? 0);
				$payByCredit    = (float) ($_POST['Calculator']['pay_by_credit'] ?? 0);

				$balance = ($commission - $payForSales) - $payByCredit;
				if($balance == 0){
					$commisson_payment_status = "Paid";
				}else{
					$commisson_payment_status = "Outstanding";
				}

				$connection=Yii::app()->db;
				//$comm_per_rav = round(($commission/$_POST['Calculator']['total_sales'])*100,2);
				$sql = 'UPDATE calculator SET 
				
				sales_manager = "'.$_POST['Calculator']['sales_manager'].'", 
				
				commisson_payment_status = "'.$commisson_payment_status.'", 
				date_for_sales = "'.$_POST['Calculator']['date_for_sales'].'", 
				pay_for_sales = "'.$_POST['Calculator']['pay_for_sales'].'", 
				
				total_sales = "'.$_POST['Calculator']['total_sales'].'", 
				shipping_cost = "'.$_POST['Calculator']['shipping_cost'].'", 
				creditcard_feecost = "'.$_POST['Calculator']['creditcard_feecost'].'",
				royalty_feecost = "'.$_POST['Calculator']['royalty_feecost'].'",  
				comp_itemcost = "'.$_POST['Calculator']['comp_itemcost'].'",
				online_order_commission = "'.$_POST['Calculator']['online_order_commission'].'",
				namebar_patches = "'.$_POST['Calculator']['namebar_patches'].'",
				commission_percent = "'.$_POST['Calculator']['commission_percent'].'", 
				commission = "'.$commission.'", 
				pay_for_sales = "'.$_POST['Calculator']['pay_for_sales'].'",
				pay_by_customer = "'.$_POST['Calculator']['pay_by_customer'].'",
				pay_by_credit = "'.$_POST['Calculator']['pay_by_credit'].'",
				payment_method = "'.$_POST['Calculator']['payment_method'].'",
				update_date = "'.date("Y-m-d").'",
				status_commission = "'.$_POST['Calculator']['status_commission'].'"
				WHERE id = "'.$value['id'].'"';
				$command = $connection->createCommand($sql);
				$command->execute();
			}
			
			$response = [
				'Calculator' => [
					'commission_percent' => $_POST['Calculator']['commission_percent'],
					'commisson_payment_status' => $commisson_payment_status,
					'comp_itemcost' => $_POST['Calculator']['comp_itemcost'],
					'creditcard_feecost' => $_POST['Calculator']['creditcard_feecost'],
					'royalty_feecost' => $_POST['Calculator']['royalty_feecost'],
					'currency' => $_POST['Calculator']['currency'],
					'date_for_sales' => $_POST['Calculator']['date_for_sales'],
					'date_quarter' => $_POST['Calculator']['date_quarter'],
					'file_path' => $_POST['Calculator']['file_path'],
					'id' => $_POST['Calculator']['id'],
					'inv_link' => $_POST['Calculator']['inv_link'],
					'invoice' => $_POST['Calculator']['invoice'],
					'invoice_amount_received' => $_POST['Calculator']['invoice_amount_received'],
					'invoice_date' => $_POST['Calculator']['invoice_date'],
					'invoice_payment_method' => $_POST['Calculator']['invoice_payment_method'],
					'invoice_status' => $_POST['Calculator']['invoice_status'],
					'namebar_patches' => $_POST['Calculator']['namebar_patches'],
					'online_order_commission' => $_POST['Calculator']['online_order_commission'],
					'order_name' => $_POST['Calculator']['order_name'],
					'order_no' => $_POST['Calculator']['order_no'],
					'pay_by_credit' => $_POST['Calculator']['pay_by_credit'],
					'pay_by_customer' => $_POST['Calculator']['pay_by_customer'],
					'pay_for_sales' => $_POST['Calculator']['pay_for_sales'],
					'payment_method' => $_POST['Calculator']['payment_method'],
					'sales_manager' => $_POST['Calculator']['sales_manager'],
					'shipping_cost' => $_POST['Calculator']['shipping_cost'],
					'status_commission' => $_POST['Calculator']['status_commission'],
					'total_sales' => $_POST['Calculator']['total_sales'],
					'commission' => $commission, // Include calculated commission
					// Add other fields as necessary
				]
				
			];
			
			header('Content-Type: application/json');
			echo json_encode($response);
			
				
			
			//////////// Send Mail /////////////////
		/*		
			$result['sale_tomail'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('user u')
				->where('u.fullname = "'.$_POST['Calculator']['sales_manager'].'"')
			    ->queryAll();
				
			foreach ($result['sale_tomail'] as $key_mail => $value_mail) {
				$mail_sale = $value_mail['email'];
				$mail_namesale = $value_mail['fullname'];
			}
			
			
			if($_POST['Calculator']['date_quarter'] != "0000-00-00"){
				$_month_name_s = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
													 
				$date_for_sales = $_POST['Calculator']['date_quarter'];
				list($year_s,$momth_s,$day_s) = explode("-",$date_for_sales);
										
				if ($day_s < 10){
					$day_s = substr($day_s,1,2);
				}
				$date_s = $_month_name_s[$momth_s]." ".$day_s.",  ".$year_s;
			}		
			
			$data['invoice'] = $_POST['Calculator']['invoice'];
			$data['order_name'] = $_POST['Calculator']['order_name'];
			$data['date_Quarter'] = $date_s;
			$data['invoice_file'] = $filePath;
			$data['invoice_status'] = $_POST['Calculator']['invoice_status'];
			$data['date'] = $_POST['Calculator']['date_for_sales'];
			$data['pay_outs'] = $_POST['Calculator']['pay_for_sales'];
			$data['payment_method'] = $_POST['Calculator']['payment_method'];
						
				
			$subject = 'Update! Information';
			$message = $this->renderPartial('_mailAddInvoice', $data, true);
			
			//  set send email
			
				$mail=Yii::app()->Smtpmail;
				$mail->CharSet = 'utf-8'; 
				$mail->SetFrom("noreply.salerep@jogathletics.com", 'Sales Commission');
				$mail->Subject = $subject;
				$mail->MsgHTML($message);
				$mail->AddAddress($mail_sale, $mail_namesale);
				//$mail->AddBCC('swhitcomb@jogsports.com', "");
				//$mail->AddBCC('administration@jogsportswear.com', '');
				//$mail->AddBCC('accountsreceivables@jogsportswear.com', "Admin");

				

		
				if(!$mail->Send()) {
					Yii::app()->user->setFlash('error', "<strong>Mailer Error!! </strong>" . $mail->ErrorInfo);
				}else {
					Yii::app()->user->setFlash('success', 'Message Already sent!');
				}
					$mail->ClearAddresses(); //clear addresses for next email sending
			
			//////////// End Send Mail ////////////
			
		*/	
			
			//$this->redirect(array('calculator/salesCommission/year/'.$year.'/sales/'.$_POST['salesRep'].( ( (isset($_POST['month']) && $_POST['month']!="")?"/month/".$_POST['month']:""))));
			
	}
	public function actionEditCalculatorDetailcommistionSubmit()
	{	
		
		$model = new Calculator;
		$model->attributes = $_POST['Calculator'];
		
		//echo $model->file_path;
			//foreach ($_FILES['Calculator']['name']['file_path'] as $key => $value) {
				
				$uploadedFile = CUploadedFile::getInstance($model,"file_path");
				
				if(!empty($uploadedFile)){
					$filePath = date('Ymd') . '-' . $model['invoice'] . '.' . $uploadedFile->extensionName;

					$model->file_path = $filePath;
					//$model->file_type = $uploadedFile->extensionName;
					//$model->file_datetime = date('Y-m-d H:i:s');

					if ($model->save()) {
						$uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/invoice/docs/' . $filePath);
						Yii::app()->user->setFlash('success', 'Upload Success');
						//$this->redirect(array('index'));
					} else {
						Yii::app()->user->setFlash('error', 'Upload Error');
						//$this->redirect(array('index'));
					}
				}else{
					$filePath = $_POST['Calculator']['file_path'];
				}
			//}
		
			$commission = "";	
			if(!empty($_POST['Calculator']['commission_percent'])){
				$commission = ((((floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost'])) - floatval($_POST['Calculator']['creditcard_feecost']))*floatval($_POST['Calculator']['commission_percent']))/100);
				
				
			}
			
			
			$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));

			list($year,$momth,$day) = explode("-",$date_quarter);
			//echo $filePath;
			
				$editinvoice = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator c')
				->where('c.id = "'.$_POST['Calculator']['id'].'"')
			    ->queryAll();
				
			foreach ($editinvoice as $key => $value) {
				
				$invoice = $value['invoice'];
				
				$connection2 = Yii::app()->db;
				$sql2 = 'UPDATE calculator SET 
				invoice = "'.$_POST['Calculator']['invoice'].'", 
				order_no = "'.$_POST['Calculator']['order_no'].'", 
				order_name = "'.$_POST['Calculator']['order_name'].'", 
				date_quarter = "'.$date_quarter.'", 
				file_path = "'.$filePath.'", 
				
				invoice_status = "'.$_POST['Calculator']['invoice_status'].'", 
				invoice_date = "'.$_POST['Calculator']['invoice_date'].'", 
				invoice_amount_received = "'.$_POST['Calculator']['invoice_amount_received'].'", 
				invoice_payment_method = "'.$_POST['Calculator']['invoice_payment_method'].'", 
				
				currency = "'.$_POST['Calculator']['currency'].'", 
				update_date = "'.date("Y-m-d").'"
				
				WHERE invoice = "'.$invoice.'"';
				$command2 = $connection2->createCommand($sql2);
				$command2->execute();
				
			//----------------------------------------------------------	
			
				$connection=Yii::app()->db;
				$sql = 'UPDATE calculator SET 
				
				sales_manager = "'.$_POST['Calculator']['sales_manager'].'", 
				
				commisson_payment_status = "'.$_POST['Calculator']['commisson_payment_status'].'", 
				date_for_sales = "'.$_POST['Calculator']['date_for_sales'].'", 
				pay_for_sales = "'.$_POST['Calculator']['pay_for_sales'].'", 
				
				total_sales = "'.$_POST['Calculator']['total_sales'].'", 
				shipping_cost = "'.$_POST['Calculator']['shipping_cost'].'", creditcard_feecost = "'.$_POST['Calculator']['creditcard_feecost'].'", commission_percent = "'.$_POST['Calculator']['commission_percent'].'", commission = "'.$commission.'", 
				payment_method = "'.$_POST['Calculator']['payment_method'].'",
				update_date = "'.date("Y-m-d").'",
				status_commission = "'.$_POST['Calculator']['status_commission'].'"
				WHERE id = "'.$value['id'].'"';
				$command = $connection->createCommand($sql);
				$command->execute();
			}
			
			
			
				
			
			//////////// Send Mail /////////////////
		/*		
			$result['sale_tomail'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('user u')
				->where('u.fullname = "'.$_POST['Calculator']['sales_manager'].'"')
			    ->queryAll();
				
			foreach ($result['sale_tomail'] as $key_mail => $value_mail) {
				$mail_sale = $value_mail['email'];
				$mail_namesale = $value_mail['fullname'];
			}
			
			
			if($_POST['Calculator']['date_quarter'] != "0000-00-00"){
				$_month_name_s = array("01"=>"January", "02"=>"February", "03"=>"March","04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"); 
													 
				$date_for_sales = $_POST['Calculator']['date_quarter'];
				list($year_s,$momth_s,$day_s) = explode("-",$date_for_sales);
										
				if ($day_s < 10){
					$day_s = substr($day_s,1,2);
				}
				$date_s = $_month_name_s[$momth_s]." ".$day_s.",  ".$year_s;
			}		
			
			$data['invoice'] = $_POST['Calculator']['invoice'];
			$data['order_name'] = $_POST['Calculator']['order_name'];
			$data['date_Quarter'] = $date_s;
			$data['invoice_file'] = $filePath;
			$data['invoice_status'] = $_POST['Calculator']['invoice_status'];
			$data['date'] = $_POST['Calculator']['date_for_sales'];
			$data['pay_outs'] = $_POST['Calculator']['pay_for_sales'];
			$data['payment_method'] = $_POST['Calculator']['payment_method'];
						
				
			$subject = 'Update! Information';
			$message = $this->renderPartial('_mailAddInvoice', $data, true);
			
			//  set send email
			
				$mail=Yii::app()->Smtpmail;
				$mail->CharSet = 'utf-8'; 
				$mail->SetFrom("noreply.salerep@jogathletics.com", 'Sales Commission');
				$mail->Subject = $subject;
				$mail->MsgHTML($message);
				$mail->AddAddress($mail_sale, $mail_namesale);
				//$mail->AddBCC('swhitcomb@jogsports.com', "");
				//$mail->AddBCC('administration@jogsportswear.com', '');
				//$mail->AddBCC('accountsreceivables@jogsportswear.com', "Admin");

				

		
				if(!$mail->Send()) {
					Yii::app()->user->setFlash('error', "<strong>Mailer Error!! </strong>" . $mail->ErrorInfo);
				}else {
					Yii::app()->user->setFlash('success', 'Message Already sent!');
				}
					$mail->ClearAddresses(); //clear addresses for next email sending
			
			//////////// End Send Mail ////////////
			
		*/	
			
			$this->redirect(array('calculator/commission/year/'.$year.'/id/'.$_POST['Calculator']['id']));
			
	}
	public function actionEditCalculatorInvoiceDetailSubmit()
	{	
		
		$model = new Calculator;
		$model->attributes = $_POST['Calculator'];
		
		//echo $model->file_path;
			//foreach ($_FILES['Calculator']['name']['file_path'] as $key => $value) {
				
				$uploadedFile = CUploadedFile::getInstance($model,"file_path");
				
				if(!empty($uploadedFile)){
					$filePath = date('Ymd') . '-' . $model['invoice'] . '.' . $uploadedFile->extensionName;

					$model->file_path = $filePath;
					//$model->file_type = $uploadedFile->extensionName;
					//$model->file_datetime = date('Y-m-d H:i:s');

					if ($model->save()) {
						$uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/invoice/docs/' . $filePath);
						Yii::app()->user->setFlash('success', 'Upload Success');
						//$this->redirect(array('index'));
					} else {
						Yii::app()->user->setFlash('error', 'Upload Error');
						//$this->redirect(array('index'));
					}
				}else{
					$filePath = $_POST['Calculator']['file_path'];
				}
			//}
		
			$commission = "";	
			if(!empty($_POST['Calculator']['commission_percent'])){
				$commission = ((((floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost'])) - floatval($_POST['Calculator']['creditcard_feecost']))*floatval($_POST['Calculator']['commission_percent']))/100);
				
				
			}
			
			
			$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));

			list($year,$momth,$day) = explode("-",$date_quarter);
			//echo $filePath;
			
				$editinvoice = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator c')
				->where('c.id = "'.$_POST['Calculator']['id'].'"')
			    ->queryAll();
				
			foreach ($editinvoice as $key => $value) {
				
				$invoice = $value['invoice'];
				
				$connection2 = Yii::app()->db;
				$sql2 = 'UPDATE calculator SET 
				invoice = "'.$_POST['Calculator']['invoice'].'", 
				order_no = "'.$_POST['Calculator']['order_no'].'", 
				order_name = "'.$_POST['Calculator']['order_name'].'", 
				date_quarter = "'.$date_quarter.'", 
				file_path = "'.$filePath.'", 
				
				invoice_status = "'.$_POST['Calculator']['invoice_status'].'", 
				invoice_date = "'.$_POST['Calculator']['invoice_date'].'", 
				invoice_amount_received = "'.$_POST['Calculator']['invoice_amount_received'].'", 
				invoice_payment_method = "'.$_POST['Calculator']['invoice_payment_method'].'", 
				
				currency = "'.$_POST['Calculator']['currency'].'", 
				update_date = "'.date("Y-m-d").'"
				
				WHERE invoice = "'.$invoice.'"';
				$command2 = $connection2->createCommand($sql2);
				$command2->execute();
				
			//----------------------------------------------------------	
			
				$connection=Yii::app()->db;
				$sql = 'UPDATE calculator SET 
				
				sales_manager = "'.$_POST['Calculator']['sales_manager'].'", 
				
				commisson_payment_status = "'.$_POST['Calculator']['commisson_payment_status'].'", 
				date_for_sales = "'.$_POST['Calculator']['date_for_sales'].'", 
				pay_for_sales = "'.$_POST['Calculator']['pay_for_sales'].'", 
				
				total_sales = "'.$_POST['Calculator']['total_sales'].'", 
				shipping_cost = "'.$_POST['Calculator']['shipping_cost'].'", creditcard_feecost = "'.$_POST['Calculator']['creditcard_feecost'].'", commission_percent = "'.$_POST['Calculator']['commission_percent'].'", commission = "'.$commission.'", 
				payment_method = "'.$_POST['Calculator']['payment_method'].'",
				update_date = "'.date("Y-m-d").'",
				status_commission = "'.$_POST['Calculator']['status_commission'].'"
				WHERE id = "'.$value['id'].'"';
				$command = $connection->createCommand($sql);
				$command->execute();
			}
			
			
			$this->redirect(array('calculator/InvoiceDetail/year/'.$year.'/id/'.$_POST['Calculator']['id']));
			
	}

	public function actionCheckDuplicateINV(){

		$result["result"] = "not duplicated";

		$sql_chk = "SELECT id FROM calculator WHERE invoice='".$_POST['inv_number']."' AND id<>'".$_POST['id']."' AND sales_manager='".base64_decode($_POST['sales_manager'])."'; ";
		$rs_check = Yii::app()->db->createCommand($sql_chk)->queryAll();
		if(sizeof($rs_check)>0){
			$result["result"] = "duplicated";
		}

		echo json_encode($result);

	}

	public function actionEditCalculatorInvoiceSubmit()
	{	
		
		//$model = new Calculator;
		//$model =  Calculator::model()->findAllByAttributes(array('id'=>$_POST['Calculator']['id']), array('order'=>'id DESC'));
			$model = Calculator::model()->findByPk($_POST['Calculator']['id']);
		//$model->attributes = $_POST['Calculator'];
		
		
				$uploadedFile = CUploadedFile::getInstance($model,"file_path");
				//$uploadedFile = CUploadedFile::getInstancesByName("Calculator[file_path]");
				
				if (!is_null($uploadedFile)) {
					$filePath = date('Ymd') . '-' . $_POST['Calculator']['invoice'] . '.' . $uploadedFile->extensionName;

					$model->file_path = $filePath;
					//$model->file_type = $uploadedFile->extensionName;
					//$model->file_datetime = date('Y-m-d H:i:s');

					if ($model->save()) {
						$uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/invoice/docs/' . $filePath);
						Yii::app()->user->setFlash('success', 'Upload Success');
						//$this->redirect(array('index'));
					} else {
						Yii::app()->user->setFlash('error', 'Upload Error');
						//$this->redirect(array('index'));
					}
				}else{
					$filePath = $_POST['Calculator']['file_path'];
				}
			
			
			
			$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));

			list($year,$month,$day) = explode("-",$date_quarter);
			//echo $filePath;
			//$update_invoice = Calculator::model()->findByAttributes(array('id'=> $_POST['Calculator']['id']));
			
			$update_invoice = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator c')
				->where('c.id = "'.$_POST['Calculator']['id'].'"')
			    ->queryAll();
				
			
				
			foreach ($update_invoice as $key => $value) {	
			
			$connection=Yii::app()->db;
				$sql = 'UPDATE calculator SET 
				invoice = "'.$_POST['Calculator']['invoice'].'", 
				inv_link = "'.$_POST['Calculator']['inv_link'].'", 
				order_no = "'.$_POST['Calculator']['order_no'].'", 
				order_name = "'.$_POST['Calculator']['order_name'].'", 
				date_quarter = "'.$date_quarter.'", 
				file_path = "'.$filePath.'", 
				
				invoice_status = "'.$_POST['Calculator']['invoice_status'].'", 
				invoice_date = "'.$_POST['Calculator']['invoice_date'].'", 
				invoice_amount_received = "'.$_POST['Calculator']['invoice_amount_received'].'", 
				invoice_payment_method = "'.$_POST['Calculator']['invoice_payment_method'].'", 

				update_date = "'.date("Y-m-d").'"
			
				WHERE invoice = "'.$value['invoice'].'"';
				$command = $connection->createCommand($sql);
				$command->execute();

			}
			
			$this->redirect(array('calculator/Invoice/year/'.$year.'/month/'.$month));
			
	}
	public function actionEditCalculatorManagerSubmit()
	{	
		
		$model = new Calculator;
		$model->attributes = $_POST['Calculator'];
		
			$commission = "";	
			if(!empty($_POST['Calculator']['commission_percent'])){
				$commission = (((((floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost'])) - floatval($_POST['Calculator']['creditcard_feecost'])) - floatval($_POST['Calculator']['comp_itemcost']))*floatval($_POST['Calculator']['commission_percent']))/100);
			}
			
			$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));

			list($year,$momth,$day) = explode("-",$date_quarter);
			//echo $filePath;
			
			$connection=Yii::app()->db;
				$sql = 'UPDATE calculator SET 
				invoice = "'.$_POST['Calculator']['invoice'].'", 
				order_name = "'.$_POST['Calculator']['order_name'].'", 
				date_quarter = "'.$date_quarter.'", 
				
				sales_manager = "'.$_POST['Calculator']['sales_manager'].'", 
				sales_status = "'.$_POST['Calculator']['sales_status'].'", 
				commisson_payment_status = "'.$_POST['Calculator']['commisson_payment_status'].'", 
				date_for_sales = "'.$_POST['Calculator']['date_for_sales'].'", 
				pay_for_sales = "'.$_POST['Calculator']['pay_for_sales'].'", 
				currency = "'.$_POST['Calculator']['currency'].'", 
				total_sales = "'.$_POST['Calculator']['total_sales'].'", 
				shipping_cost = "'.$_POST['Calculator']['shipping_cost'].'", 
				creditcard_feecost = "'.$_POST['Calculator']['creditcard_feecost'].'", 
				comp_itemcost = "'.$_POST['Calculator']['comp_itemcost'].'", 
				commission_percent = "'.$_POST['Calculator']['commission_percent'].'", 
				commission = "'.$commission.'", 
				payment_method = "'.$_POST['Calculator']['payment_method'].'",
				update_date = "'.date("Y-m-d").'",
				status_commission = "'.$_POST['Calculator']['status_commission'].'"
				WHERE id = "'.$_POST['Calculator']['id'].'"';
				$command = $connection->createCommand($sql);
				$command->execute();
				
			
			$this->redirect(array('calculator/Invoice/year/'.$year));
			
	}
	
	public function actionEditCalculatorRepSubmit()
	{	
		
		$model = new Calculator;
		$model->attributes = $_POST['Calculator'];
		
			$commission = "";	
			if(!empty($_POST['Calculator']['commission_percent'])){
				$commission = (((((floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost'])) - floatval($_POST['Calculator']['creditcard_feecost'])) - floatval($_POST['Calculator']['comp_itemcost']))*floatval($_POST['Calculator']['commission_percent']))/100);
			}
			
			$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));

			list($year,$momth,$day) = explode("-",$date_quarter);
			//echo $filePath;
			if(!empty($_POST['Calculator']['status_commission'])){
				$status_commission = $_POST['Calculator']['status_commission'];
			}else{
				$status_commission = "Pending";
			}
			$connection=Yii::app()->db;
				$sql = 'UPDATE calculator SET 
				invoice = "'.$_POST['Calculator']['invoice'].'", 
				order_name = "'.$_POST['Calculator']['order_name'] .'", 
				date_quarter = "'.$date_quarter.'", 
				
				sales_manager = "'.$_POST['Calculator']['sales_manager'].'", 
				sales_status = "'.$_POST['Calculator']['sales_status'].'", 
				
				commisson_payment_status = "'.$_POST['Calculator']['commisson_payment_status'].'", 
				date_for_sales = "'.$_POST['Calculator']['date_for_sales'].'", 
				pay_for_sales = "'.$_POST['Calculator']['pay_for_sales'].'", 
				currency = "'.$_POST['Calculator']['currency'].'", 
				total_sales = "'.$_POST['Calculator']['total_sales'].'", 
				shipping_cost = "'.$_POST['Calculator']['shipping_cost'].'", 
				creditcard_feecost = "'.$_POST['Calculator']['creditcard_feecost'].'", 
				comp_itemcost = "'.$_POST['Calculator']['comp_itemcost'].'", 
				commission_percent = "'.$_POST['Calculator']['commission_percent'].'", 
				commission = "'.$commission.'", 
				payment_method = "'.$_POST['Calculator']['payment_method'].'",
				update_date = "'.date("Y-m-d").'",
				status_commission = "'.$status_commission.'"
				WHERE id = "'.$_POST['Calculator']['id'].'"';
				$command = $connection->createCommand($sql);
				$command->execute();
				
			
			$this->redirect(array('calculator/Invoice/year/'.$year));
			
	}
	
	public function actionEditCalculatorProcessorSubmit()
	{	
		
		$model = new Calculator;
		$model->attributes = $_POST['Calculator'];
		
			$commission = "";	
			if(!empty($_POST['Calculator']['commission_percent'])){
				$commission = ((((floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost'])) - floatval($_POST['Calculator']['creditcard_feecost']))*floatval($_POST['Calculator']['commission_percent']))/100);
			}
			
			$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));

			list($year,$momth,$day) = explode("-",$date_quarter);
			//echo $filePath;
			
			$connection=Yii::app()->db;
				$sql = 'UPDATE calculator SET 
				invoice = "'.$_POST['Calculator']['invoice'].'", 
				order_name = "'.$_POST['Calculator']['order_name'].'", 
				date_quarter = "'.$date_quarter.'", 
				
				sales_manager = "'.$_POST['Calculator']['sales_manager'].'", 
				
				commisson_payment_status = "'.$_POST['Calculator']['commisson_payment_status'].'", 
				date_for_sales = "'.$_POST['Calculator']['date_for_sales'].'", 
				pay_for_sales = "'.$_POST['Calculator']['pay_for_sales'].'", 
				currency = "'.$_POST['Calculator']['currency'].'", 
				total_sales = "'.$_POST['Calculator']['total_sales'].'", 
				shipping_cost = "'.$_POST['Calculator']['shipping_cost'].'", 
				creditcard_feecost = "'.$_POST['Calculator']['creditcard_feecost'].'", commission_percent = "'.$_POST['Calculator']['commission_percent'].'", commission = "'.$commission.'", 
				payment_method = "'.$_POST['Calculator']['payment_method'].'",
				update_date = "'.date("Y-m-d").'",
				status_commission = "'.$_POST['Calculator']['status_commission'].'"
				WHERE id = "'.$_POST['Calculator']['id'].'"';
				$command = $connection->createCommand($sql);
				$command->execute();
				
			
			$this->redirect(array('calculator/Invoice/year/'.$year));
			
	}
	
	public function actionAddCalculatorSalesSubmit()
	{	
		
		$model = new Calculator;
		$model->attributes = $_POST['Calculator'];
				$mail_sale = "";
		$mail_namesale_processor="";
		$mail_sale_processor = "";
		$mail_namesale = "";
		$mail_sale_manager = "";
		$mail_namesale_manager = "";
		
			$commission = "";	
			if(!empty($_POST['Calculator']['commission_percent'])){
				$commission = ((((floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost'])) - floatval($_POST['Calculator']['creditcard_feecost']))*floatval($_POST['Calculator']['commission_percent']))/100);
			}
			
			$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));

			list($year,$momth,$day) = explode("-",$date_quarter);
			//echo $filePath;
			
				
				
				if(!empty($_POST['Calculator']['sales_rep'])){
					
					$connection = Yii::app()->db;
					
					$sales_rep = "INSERT INTO calculator (invoice, order_no, order_name, date_quarter, currency, invoice_status, sales_manager, sales_status, commisson_payment_status, status_commission, create_date, update_date, file_path) VALUES ('".$_POST['Calculator']['invoice']."', '".$_POST['Calculator']['order_no']."', '".stripslashes($_POST['Calculator']['order_name'])."', '".$date_quarter."', '".$_POST['Calculator']['currency']."', '".$_POST['Calculator']['invoice_status']."', '".$_POST['Calculator']['sales_rep']."', '2', 'Outstanding', 'Pending', '".date("Y-m-d")."', '".date("Y-m-d")."',  '".$_POST['Calculator']['file_path']."') ";
				
				
				$command = $connection->createCommand($sales_rep);
				$command->execute();
				
				}
				
				if(!empty($_POST['Calculator']['sales_processor'])){
					
					$connection2 = Yii::app()->db;
					
					$processor = "INSERT INTO calculator (invoice, order_no, order_name, date_quarter, currency, invoice_status, sales_manager, sales_status, commisson_payment_status, status_commission, create_date, update_date, file_path) VALUES ('".$_POST['Calculator']['invoice']."', '".$_POST['Calculator']['order_no']."', '".stripslashes($_POST['Calculator']['order_name'])."', '".$date_quarter."', '".$_POST['Calculator']['currency']."', '".$_POST['Calculator']['invoice_status']."', '".$_POST['Calculator']['sales_processor']."', '3', 'Outstanding', 'Pending', '".date("Y-m-d")."', '".date("Y-m-d")."',  '".$_POST['Calculator']['file_path']."') ";
					
				$command2 = $connection2->createCommand($processor);
				$command2->execute();
				}
				

				
			
			$this->redirect(array('calculator/Invoice/year/'.$year));
			
	}
	public function actionEditPaymentSubmit()
	{	
		
		$model = new Calculator;
		$model->attributes = $_POST['Calculator'];
		
			$commission = "";	
			if(!empty($_POST['Calculator']['commission_percent'])){
				$commission = ((((floatval($_POST['Calculator']['total_sales']) - floatval($_POST['Calculator']['shipping_cost'])) - floatval($_POST['Calculator']['creditcard_feecost']))*floatval($_POST['Calculator']['commission_percent']))/100);
				
				
			}
			
			$date_quarter = date('Y-m-d H:i:s',strtotime($_POST['Calculator']['date_quarter']));

			list($year,$momth,$day) = explode("-",$date_quarter);
			//echo $filePath;
			
			$connection=Yii::app()->db;
				$sql = 'UPDATE Calculator SET 
				total_sales = "'.$_POST['Calculator']['total_sales'].'", 
				shipping_cost = "'.$_POST['Calculator']['shipping_cost'].'", 
				creditcard_feecost = "'.$_POST['Calculator']['creditcard_feecost'].'", commission_percent = "'.$_POST['Calculator']['commission_percent'].'", 
				commission = "'.$commission.'",
				update_date = "'.date("Y-m-d").'"
				WHERE id = "'.$_POST['Calculator']['id'].'"';
				$command = $connection->createCommand($sql);
				$command->execute();
				

			$this->redirect(array('calculator/showCommission/year/'.$year.'/id/'.$_POST['Calculator']['id']));
	}

	public function actionCommentShow()
	{	
		$model = new Comments;
		$model->attributes = $_POST['Comments'];
		$id = $_POST['Comments']['id'];
		
		$model->comments = $_POST['Comments']['comments'];
		$model->invoice = $id;
		$model->salerep = $_POST['Comments']['salerep'];
		$model->date_comments = date("Y-m-d h:i:sa");
		$model->user_group = $_POST['Comments']['user_group'];
		$model->save();
		
		$this->redirect(array('calculator/commission/year/'. $_POST['year'].'/id/'.$id));
	}
	public function actionCommentInvoiceDetailShow()
	{	
		$model = new Comments;
		$model->attributes = $_POST['Comments'];
		$id = $_POST['Comments']['id'];
		
		$model->comments = $_POST['Comments']['comments'];
		$model->invoice = $id;
		$model->salerep = $_POST['Comments']['salerep'];
		$model->date_comments = date("Y-m-d h:i:sa");
		$model->user_group = $_POST['Comments']['user_group'];
		$model->save();
		
		$this->redirect(array('calculator/ShowInvoiceDetail/year/'. $_POST['year'].'/id/'.$id));
	}
	public function actionCommentInvioceShow()
	{	
		$model = new Comments;
		$model->attributes = $_POST['Comments'];
		$id = $_POST['Comments']['id'];
		
		$model->comments = $_POST['Comments']['comments'];
		$model->invoice = $id;
		$model->salerep = $_POST['Comments']['salerep'];
		$model->date_comments = date("Y-m-d h:i:sa");
		$model->user_group = $_POST['Comments']['user_group'];
		$model->save();
		
		$this->redirect(array('calculator/InvoiceDetail/year/'. $_POST['year'].'/id/'.$id));
	}
	
	public function actionCommentShowSale()
	{	
		$model = new Comments;
		$model->attributes = $_POST['Comments'];
		$id = $_POST['Comments']['id'];
		
		$model->comments = $_POST['Comments']['comments'];
		$model->invoice = $id;
		$model->salerep = $_POST['Comments']['salerep'];
		$model->date_comments = date("Y-m-d h:i:sa");
		$model->user_group = $_POST['Comments']['user_group'];
		$model->save();
		
		$this->redirect(array('calculator/showCommission/year/'. $_POST['year'].'/id/'.$id));
	}
	
	public function actionInvoiceFile($file)
	{	
		$result['invoice_file'] = $file;
		
		
		$this->render('invoice_file', $result);
	}
	
	public function actionMailinvioce()
	{	
		//$data['id'] = $_POST['id'];
		//$data['teamname_design'] = $result['team']['teamname'];
		
		$this->render('_mailAddInvoice');
	}
	
	public function actionSeachShow()
	{

		$sales = $_POST['sale_rep'];
		$year =	$_POST['year_commission'];
		
		$result['sumtotalUSD'] = 0;
		$result['sumtotalCAD'] = 0;
		$result['sumtotalSGD'] = 0;
		$result['sumtotalTHB'] = 0;
		$result['totalcommissionUSD'] = 0;
		$result['totalcommissionCAD'] = 0;
		$result['totalcommissionSGD'] = 0;
		$result['totalcommissionTHB'] = 0;
		$result['payoutUSD'] = 0;
		$result['payoutCAD'] = 0;
		$result['payoutSGD'] = 0;
		$result['payoutTHB'] = 0;
		$result['commissionPaymentUSD'] = 0;
		$result['commissionPaymentCAD'] = 0;
		$result['commissionPaymentSGD'] = 0;
		$result['commissionPaymentTHB'] = 0;
		
		$result['sumCommissionPaymaentUSD'] = 0;
		$result['sumCommissionPaymaentCAD'] = 0;
		$result['sumCommissionPaymaentSGD'] = 0;
		$result['sumCommissionPaymaentTHB'] = 0;
		
		$result['sumAmountReceivedUSD'] = 0;
		$result['sumAmountReceivedCAD'] = 0;
		$result['sumAmountReceivedSGD'] = 0;
		$result['sumAmountReceivedTHB'] = 0;
		$result['currency'] = Array();
		
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		$result['bankAccount'] = User::model()->findByAttributes(array('fullname'=> $sales));
		$result['year_commission'] = $year;	
		$result['sales_commission'] = $sales;	
		//$result['getData'] = Calculator::model()->findAll();

		$result['search_invoice'] = isset($_POST['search_invoice'])?$_POST['search_invoice']:"";
		$result['search_invoice2'] = "";
		$result['search_dateQuarter'] = isset($_POST['search_dateQuarter'])?$_POST['search_dateQuarter']:"";
		$result['search_dateQuarter2'] = isset($_POST['search_dateQuarter2'])?$_POST['search_dateQuarter2']:"";
		$result['search_orderno'] = isset($_POST['search_orderno'])?$_POST['search_orderno']:"";
		$result['search_orderno2'] = "";
		$result['search_ordername'] = isset($_POST['search_ordername'])?$_POST['search_ordername']:"";
		$result['commission_status'] = isset($_POST['commission_status'])?$_POST['commission_status']:"";
		$result['aproved_status'] = isset($_POST['aproved_status'])?$_POST['aproved_status']:"";
		$result['invoice_status'] = isset($_POST['invoice_status'])?$_POST['invoice_status']:"";

		$condi_date = "";
		if($result['search_dateQuarter']!="" && $result['search_dateQuarter2']!=""){
			$condi_date .= ' AND (date_quarter BETWEEN "'.$result['search_dateQuarter'].'" AND "'.$result['search_dateQuarter2'].'") ';
		}else{
			$condi_date .= ' AND date_quarter LIKE "'.$year.'-%" ';
		}

		if($result['search_invoice']!=""){
			$condi_date .= ' AND invoice LIKE "%'.$result['search_invoice'].'%" ';
		}

		if($result['search_orderno']!=""){
			$condi_date .= ' AND order_no LIKE "%'.$result['search_orderno'].'%" ';
		}

		if($result['search_ordername']!=""){
			$condi_date .= ' AND order_name LIKE "%'.$result['search_ordername'].'%" ';
		}

		if($result['invoice_status']!=""){
			$condi_date .= ' AND invoice_status="'.$result['invoice_status'].'" ';
		}
		if($result['aproved_status']!=""){
			$condi_date .= ' AND status_commission="'.$result['aproved_status'].'" ';
		}
		if($result['commission_status']!=""){
			$condi_date .= ' AND commisson_payment_status="'.$result['commission_status'].'" ';
		}
		//echo 'select * from calculator where sales_manager = "'.$sales.'" '.$condi_date.' ORDER BY `date_quarter` ASC, `invoice` ASC';

		$result['getData'] = Yii::app()->db->createCommand('select * from calculator where sales_manager = "'.$sales.'" '.$condi_date.' GROUP BY invoice ORDER BY `date_quarter` ASC, `invoice` ASC ')->queryAll();
		
		$result['getDataAll'] = Yii::app()->db->createCommand('select * from calculator where sales_manager = "'.$sales.'" '.$condi_date.' ORDER BY `date_quarter` ASC, `invoice` ASC ')->queryAll();
			
			/*$result['getDataAll'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator cal')
				->where('cal.sales_manager = "'.Yii::app()->user->getState('fullName').'"')
				->order('cal.date_quarter ASC , cal.invoice ASC ')
			    ->queryAll();*/
				
			foreach ($result['getDataAll']as $key_data => $value_data) {	
					$result['getSalesumtotal'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.invoice = "'.$value_data['invoice'].'"')
				//->andwhere('scal.status_commission = "Approved"')
				->limit('1')
			    ->queryAll();
					
				foreach ($result['getSalesumtotal'] as $key_sumtotal => $value_sumtotal) {
					if($value_data['currency'] == "USD"){
						
						if($value_sumtotal['invoice_status'] == "Paid"){	
														
							$result['sumAmountReceivedUSD'] += $value_sumtotal['invoice_amount_received'];
						}
						$result['sumtotalUSD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
					}
					if($value_data['currency'] == "CAD"){
						
						if($value_sumtotal['invoice_status'] == "Paid"){								

							$result['sumAmountReceivedCAD'] += $value_sumtotal['invoice_amount_received'];
							
						}		
						$result['sumtotalCAD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
					}
					if($value_data['currency'] == "SGD"){
						
						if($value_sumtotal['invoice_status'] == "Paid"){	

							

							$result['sumAmountReceivedSGD'] += $value_sumtotal['invoice_amount_received'];
						}	
						$result['sumtotalSGD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);	
					}
					if($value_data['currency'] == "THB"){
						
						if($value_data['invoice_status'] == "Paid"){	

							

							$result['sumAmountReceivedTHB'] += $value_sumtotal['invoice_amount_received'];
						}	
						
						$result['sumtotalTHB'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);	
					}
					
				}	
			
				$result['getSale'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.invoice = "'.$value_data['invoice'].'"')
				//->andwhere('scal.status_commission = "Approved"')
				//->andwhere('scal.commisson_payment_status = "Paid"')
				//->andwhere('scal.currency = "'.$value_data['currency'].'"')
				->order('scal.update_date DESC')
			    ->queryAll();
					
				foreach ($result['getSale'] as $key => $value) {
					
			
					if($value_data['currency'] == "USD"){
						
						
							//$result['sumtotalUSD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentUSD'] += $value['pay_for_sales'];
							
							$result['totalcommissionUSD'] +=  $value['commission'];
							$result['payoutUSD'] +=  $value['pay_for_sales'];
							
						if($value_data['invoice_status'] == "Paid"){		
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentUSD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentUSD'] += $value['commission'];
							}
							
							
							
						}
					}
					if($value_data['currency'] == "CAD"){
						
						

							//$result['sumtotalCAD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentCAD'] += $value['pay_for_sales'];
							
							$result['totalcommissionCAD'] +=  $value['commission'];
							$result['payoutCAD'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){		
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentCAD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentCAD'] += $value['commission'];
							}
						}		
					}
					if($value_data['currency'] == "SGD"){
						
						

							//$result['sumtotalSGD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentSGD'] += $value['pay_for_sales'];
							
							$result['totalcommissionSGD'] +=  $value['commission'];
							$result['payoutSGD'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){		
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentSGD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentSGD'] += $value['commission'];
							}
						}		
					}
					if($value_data['currency'] == "THB"){
						
						

							//$result['sumtotalTHB'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentTHB'] += $value['pay_for_sales'];
							
							$result['totalcommissionTHB'] +=  $value['commission'];
							$result['payoutTHB'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){		
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentTHB'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentTHB'] += $value['commission'];
							}
						}		
					}
					
					
				}
				
				$result['currency'][] = $value_data['currency'];
				//echo $result['sumtotalUSD']."<br>";
		}		
		
		$this->render('show_commission', $result);
			
		
		//$this->render('_mailAddInvoice');
	}
	public function actionSeach()
	{

		$sales = $_POST['sale_rep'];
		$year =	$_POST['year_commission'];
		
		$result['sumtotalUSD'] = 0;
		$result['sumtotalCAD'] = 0;
		$result['sumtotalSGD'] = 0;
		$result['sumtotalTHB'] = 0;
		$result['totalcommissionUSD'] = 0;
		$result['totalcommissionCAD'] = 0;
		$result['totalcommissionSGD'] = 0;
		$result['totalcommissionTHB'] = 0;
		$result['payoutUSD'] = 0;
		$result['payoutCAD'] = 0;
		$result['payoutSGD'] = 0;
		$result['payoutTHB'] = 0;
		$result['commissionPaymentUSD'] = 0;
		$result['commissionPaymentCAD'] = 0;
		$result['commissionPaymentSGD'] = 0;
		$result['commissionPaymentTHB'] = 0;
		
		$result['sumCommissionPaymaentUSD'] = 0;
		$result['sumCommissionPaymaentCAD'] = 0;
		$result['sumCommissionPaymaentSGD'] = 0;
		$result['sumCommissionPaymaentTHB'] = 0;
		
		$result['sumAmountReceivedUSD'] = 0;
		$result['sumAmountReceivedCAD'] = 0;
		$result['sumAmountReceivedSGD'] = 0;
		$result['sumAmountReceivedTHB'] = 0;
		
		$result['currency'] = Array();
		
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		$result['bankAccount'] = User::model()->findByAttributes(array('fullname'=> $sales));
		$result['year_commission'] = $year;	
		$result['sales_commission'] = $sales;	
		//$result['getData'] = Calculator::model()->findAll();

		$result['search_invoice'] = isset($_POST['search_invoice'])?$_POST['search_invoice']:"";
		$result['search_invoice2'] = "";
		$result['search_dateQuarter'] = isset($_POST['search_dateQuarter'])?$_POST['search_dateQuarter']:"";
		$result['search_dateQuarter2'] = isset($_POST['search_dateQuarter2'])?$_POST['search_dateQuarter2']:"";
		$result['search_orderno'] = isset($_POST['search_orderno'])?$_POST['search_orderno']:"";
		$result['search_orderno2'] = "";
		$result['search_ordername'] = isset($_POST['search_ordername'])?$_POST['search_ordername']:"";
		$result['commission_status'] = isset($_POST['commission_status'])?$_POST['commission_status']:"";
		$result['aproved_status'] = isset($_POST['aproved_status'])?$_POST['aproved_status']:"";
		$result['invoice_status'] = isset($_POST['invoice_status'])?$_POST['invoice_status']:"";

		$condi_date = "";
		if($result['search_dateQuarter']!="" && $result['search_dateQuarter2']!=""){
			$condi_date .= ' AND (date_quarter BETWEEN "'.$result['search_dateQuarter'].'" AND "'.$result['search_dateQuarter2'].'") ';
		}else{
			$condi_date .= ' AND date_quarter LIKE "'.$year.'-%" ';
		}

		if($result['search_invoice']!=""){
			$condi_date .= ' AND invoice LIKE "%'.$result['search_invoice'].'%" ';
		}

		if($result['search_orderno']!=""){
			$condi_date .= ' AND order_no LIKE "%'.$result['search_orderno'].'%" ';
		}

		if($result['search_ordername']!=""){
			$condi_date .= ' AND order_name LIKE "%'.$result['search_ordername'].'%" ';
		}

		if($result['invoice_status']!=""){
			$condi_date .= ' AND invoice_status="'.$result['invoice_status'].'" ';
		}
		if($result['aproved_status']!=""){
			$condi_date .= ' AND status_commission="'.$result['aproved_status'].'" ';
		}
		if($result['commission_status']!=""){
			$condi_date .= ' AND commisson_payment_status="'.$result['commission_status'].'" ';
		}
		//echo 'select * from calculator where sales_manager = "'.$sales.'" '.$condi_date.' ORDER BY `date_quarter` ASC, `invoice` ASC';

		$result['getData'] = Yii::app()->db->createCommand('select * from calculator where sales_manager = "'.$sales.'" '.$condi_date.' ORDER BY `date_quarter` ASC, `invoice` ASC ')->queryAll();
			
			/*foreach ($result['getData']as $key_data => $value_data) {	
				//echo $value_data['currency']."<br>";	
				$result['getSale'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.sales_manager = "'.$value_data['sales_manager'].'"')
				//->andwhere('scal.status_commission = "Approved"')
				->andwhere('scal.invoice = "'.$value_data['invoice'].'"')
				//->andwhere('scal.commisson_payment_status = "Paid"')
				->andwhere('scal.currency = "'.$value_data['currency'].'"')
				->order('scal.update_date DESC')
			    ->queryAll();*/
				
				//$model = new Calculator;
				foreach ($result['getData'] as $key => $value) {
					
					if($value['currency'] == "USD"){
						
						if($value['invoice_status'] == "Paid"){
							$result['sumAmountReceivedUSD'] += $value['invoice_amount_received'];
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentUSD'] +=  $value['commission'] - $value['pay_for_sales'] - $value['pay_by_credit'];
							}else{
								$result['commissionPaymentUSD'] += $value['commission'];
							}	
						}
						
							$result['sumtotalUSD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							
							$result['totalcommissionUSD'] +=  $value['commission'];
							$result['payoutUSD'] +=  $value['pay_for_sales'];
							
							
						
					}
					if($value['currency'] == "CAD"){
						
						if($value['invoice_status'] == "Paid"){	
							$result['sumAmountReceivedCAD'] += $value['invoice_amount_received'];
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentCAD'] +=  $value['commission'] - $value['pay_for_sales'] - $value['pay_by_credit'];
							}else{
								$result['commissionPaymentCAD'] += $value['commission'];
							}
						}
							$result['sumtotalCAD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							
							$result['totalcommissionCAD'] +=  $value['commission'];
							$result['payoutCAD'] +=  $value['pay_for_sales'];
							
							
								
					}
					if($value['currency'] == "SGD"){
						
						if($value['invoice_status'] == "Paid"){
							$result['sumAmountReceivedSGD'] += $value['invoice_amount_received'];
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentSGD'] +=  $value['commission'] - $value['pay_for_sales'] - $value['pay_by_credit'];
							}else{
								$result['commissionPaymentSGD'] += $value['commission'];
							}
						}
							$result['sumtotalSGD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							
							$result['totalcommissionSGD'] +=  $value['commission'];
							$result['payoutSGD'] +=  $value['pay_for_sales'];
							
							
								
					}
					if($value['currency'] == "THB"){
						
						if($value['invoice_status'] == "Paid"){
							$result['sumAmountReceivedTHB'] += $value['invoice_amount_received'];
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentTHB'] +=  $value['commission'] - $value['pay_for_sales'] - $value['pay_by_credit'];
							}else{
								$result['commissionPaymentTHB'] += $value['commission'];
							}
						}

							$result['sumtotalTHB'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							
							$result['totalcommissionTHB'] +=  $value['commission'];
							$result['payoutTHB'] +=  $value['pay_for_sales'];
							
							
								
					}
					
					$result['currency'][] = $value['currency'];
				}
				
				
				//echo $result['sumtotalUSD']."<br>";
		//}		
		
				$this->render('sales_commission', $result);
					
		//$this->render('_mailAddInvoice');
	}
	public function actionSeachInvoice()
	{
	
		$sales = $_POST['sale_rep'];
		$year =	$_POST['year_commission'];
		
		$result['sumtotalUSD'] = 0;
		$result['sumtotalCAD'] = 0;
		$result['sumtotalSGD'] = 0;
		$result['sumtotalTHB'] = 0;
		$result['totalcommissionUSD'] = 0;
		$result['totalcommissionCAD'] = 0;
		$result['totalcommissionSGD'] = 0;
		$result['totalcommissionTHB'] = 0;
		$result['payoutUSD'] = 0;
		$result['payoutCAD'] = 0;
		$result['payoutSGD'] = 0;
		$result['payoutTHB'] = 0;
		$result['commissionPaymentUSD'] = 0;
		$result['commissionPaymentCAD'] = 0;
		$result['commissionPaymentSGD'] = 0;
		$result['commissionPaymentTHB'] = 0;
		
		$result['sumCommissionPaymaentUSD'] = 0;
		$result['sumCommissionPaymaentCAD'] = 0;
		$result['sumCommissionPaymaentSGD'] = 0;
		$result['sumCommissionPaymaentTHB'] = 0;
		
		$result['sumAmountReceivedUSD'] = 0;
		$result['sumAmountReceivedCAD'] = 0;
		$result['sumAmountReceivedSGD'] = 0;
		$result['sumAmountReceivedTHB'] = 0;
		
		$result['currency'] = Array();
		
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		//$result['bankAccount'] = User::model()->findByAttributes(array('fullname'=> $sales));
		$result['year_commission'] = $year;	
		$result['sales_commission'] = $sales;	
		//$result['getData'] = Calculator::model()->findAll();
		
/*	$_POST['search_invoice']
		$_POST['search_invoice2']
		$_POST['search_dateQuarter']
		$_POST['search_dateQuarter2']
		$_POST['search_orderno']
		$_POST['search_orderno2']
		$_POST['search_ordername']
		$_POST['invoice_status']
		$_POST['aproved_status']
		$_POST['commission_status']
*/		
		if(!empty($_POST['search_invoice']) && (empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status']))){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && (empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status']))){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && (empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status']))){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}else{
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}
			
			foreach ($result['getData']as $key_data => $value_data) {

				$result['getSalesumtotal'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.invoice = "'.$value_data['invoice'].'"')
				//->andwhere('scal.status_commission = "Approved"')
				->limit('1')
			    ->queryAll();
					
				foreach ($result['getSalesumtotal'] as $key_sumtotal => $value_sumtotal) {
					if($value_data['currency'] == "USD"){
						
							
							$result['sumtotalUSD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							
						if($value_sumtotal['invoice_status'] == "Paid"){	
							$result['sumAmountReceivedUSD'] += $value_sumtotal['invoice_amount_received'];
						}
					}
					if($value_data['currency'] == "CAD"){
						
						

							$result['sumtotalCAD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							
						if($value_sumtotal['invoice_status'] == "Paid"){	
							$result['sumAmountReceivedCAD'] += $value_sumtotal['invoice_amount_received'];
							
						}		
					}
					if($value_data['currency'] == "SGD"){
						
						

							$result['sumtotalSGD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							
						if($value_sumtotal['invoice_status'] == "Paid"){	
							$result['sumAmountReceivedSGD'] += $value_sumtotal['invoice_amount_received'];
						}		
					}
					if($value_data['currency'] == "THB"){
						
						

							$result['sumtotalTHB'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							
						if($value_data['invoice_status'] == "Paid"){	
							$result['sumAmountReceivedTHB'] += $value_sumtotal['invoice_amount_received'];
						}		
					}
					
				}	
			
				$result['getSale'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.invoice = "'.$value_data['invoice'].'"')
				//->andwhere('scal.status_commission = "Approved"')
				//->andwhere('scal.commisson_payment_status = "Paid"')
				//->andwhere('scal.currency = "'.$value_data['currency'].'"')
				->order('scal.update_date DESC')
			    ->queryAll();
					
				foreach ($result['getSale'] as $key => $value) {
					
			
					if($value_data['currency'] == "USD"){
						
						
							//$result['sumtotalUSD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentUSD'] += $value['pay_for_sales'];
							
							$result['totalcommissionUSD'] +=  $value['commission'];
							$result['payoutUSD'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){		
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentUSD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentUSD'] += $value['commission'];
							}
							
							
							
						}
					}
					if($value_data['currency'] == "CAD"){
						
						

							//$result['sumtotalCAD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentCAD'] += $value['pay_for_sales'];
							
							$result['totalcommissionCAD'] +=  $value['commission'];
							$result['payoutCAD'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){		
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentCAD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentCAD'] += $value['commission'];
							}
						}		
					}
					if($value_data['currency'] == "SGD"){
						
							

							//$result['sumtotalSGD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentSGD'] += $value['pay_for_sales'];
							
							$result['totalcommissionSGD'] +=  $value['commission'];
							$result['payoutSGD'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){	
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentSGD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentSGD'] += $value['commission'];
							}
						}		
					}
					if($value_data['currency'] == "THB"){
						
						{	

							//$result['sumtotalTHB'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentTHB'] += $value['pay_for_sales'];
							
							$result['totalcommissionTHB'] +=  $value['commission'];
							$result['payoutTHB'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid")	
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentTHB'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentTHB'] += $value['commission'];
							}
						}		
					}
					
					
				}
				
				$result['currency'][] = $value_data['currency'];
				//echo $result['sumtotalUSD']."<br>";
		}		
			
		$this->render('invoice_all', $result);
		//$this->render('_mailAddInvoice');
	
	}
	public function actionFiscalYearInvoice()
	{
		$result['getYear'] = Calculator::model()->findAll();
		$result['yearall'] = Array();
		foreach ($result['getYear'] as $key => $value) {
			list($year,$momth,$day) = explode("-",$value['date_quarter']);
			$result['yearall'][] = $year;
		}
		
		//echo $yearall[0].$yearall[1];
			
		$this->render('fiscalYearInvoice', $result);
		
	}
	public function actionInvoice($year,$month="01"){
		
		$result['year_select'] = $year;
		$result['month_select'] = $month;

		$result['sumtotalUSD'] = 0;
		$result['sumtotalCAD'] = 0;
		$result['sumtotalSGD'] = 0;
		$result['sumtotalTHB'] = 0;
		
		$result['sumCommissionPaymaentUSD'] = 0;
		$result['sumCommissionPaymaentCAD'] = 0;
		$result['sumCommissionPaymaentSGD'] = 0;
		$result['sumCommissionPaymaentTHB'] = 0;
		
		$result['sumAmountReceivedUSD'] = 0;
		$result['sumAmountReceivedCAD'] = 0;
		$result['sumAmountReceivedSGD'] = 0;
		$result['sumAmountReceivedTHB'] = 0;
		
		$result['totalcommissionUSD'] = 0;
		$result['totalcommissionCAD'] = 0;
		$result['totalcommissionSGD'] = 0;
		$result['totalcommissionTHB'] = 0;
		
		$result['payoutUSD'] = 0;
		$result['payoutCAD'] = 0;
		$result['payoutSGD'] = 0;
		$result['payoutTHB'] = 0;
		
		$result['commissionPaymentUSD'] = 0;
		$result['commissionPaymentCAD'] = 0;
		$result['commissionPaymentSGD'] = 0;
		$result['commissionPaymentTHB'] = 0;
		
		$result['currency'] = Array();
		
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		//$result['bankAccount'] = User::model()->findByAttributes(array('fullname'=> $sales));
		$result['year_commission'] = $year;	
		//$result['sales_commission'] = $sales;	
		//$result['getData'] = Calculator::model()->findAll();
		
		$tmp_month = $month;
		if($month=="all"){
			$tmp_month = "";
		}
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'-'.$tmp_month.'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
			
				
			foreach ($result['getData']as $key_data => $value_data) {	
				//echo $value_data['currency']."<br>";	
	
				
				$model = new Calculator;
			
				$result['getSalesumtotal'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.invoice = "'.$value_data['invoice'].'"')
				//->andwhere('scal.status_commission = "Approved"')
				//->andwhere('scal.commisson_payment_status = "Paid"')
				//->andwhere('scal.currency = "'.$value_data['currency'].'"')
				->limit('1')
				//->order('scal.update_date DESC')
			    ->queryAll();
					
				foreach ($result['getSalesumtotal'] as $key_sumtotal => $value_sumtotal) {
					
					if($value_data['currency'] == "USD"){
						
						
						
							$result['sumtotalUSD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							
						if($value_sumtotal['invoice_status'] == "Paid"){		
							$result['sumAmountReceivedUSD'] += $value_sumtotal['invoice_amount_received'];
							
						}
					}
					if($value_data['currency'] == "CAD"){
						
						

							$result['sumtotalCAD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							
							
						if($value_sumtotal['invoice_status'] == "Paid"){		

							$result['sumAmountReceivedCAD'] += $value_sumtotal['invoice_amount_received'];
							
						}		
					}
					if($value_data['currency'] == "SGD"){
						
						
							

								$result['sumtotalSGD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							
						if($value_sumtotal['invoice_status'] == "Paid"){			
								
								$result['sumAmountReceivedSGD'] += $value_sumtotal['invoice_amount_received'];
						}		
					}
					if($value_data['currency'] == "THB"){
						
						

							$result['sumtotalTHB'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							
						if($value_data['invoice_status'] == "Paid"){		
		
							$result['sumAmountReceivedTHB'] += $value_sumtotal['invoice_amount_received'];
						}		
					}
					
				}

				
				$result['getSale'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.invoice = "'.$value_data['invoice'].'"')
				//->andwhere('scal.status_commission = "Approved"')
				//->andwhere('scal.commisson_payment_status = "Paid"')
				//->andwhere('scal.currency = "'.$value_data['currency'].'"')
				->order('scal.update_date DESC')
			    ->queryAll();
					
				foreach ($result['getSale'] as $key => $value) {
					
			
					if($value_data['currency'] == "USD"){
						
							
							//$result['sumtotalUSD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentUSD'] += $value['pay_for_sales'];
							
							$result['totalcommissionUSD'] +=  $value['commission'];
							$result['payoutUSD'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){	
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentUSD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentUSD'] += $value['commission'];
							}
							
							
							
						}
					}
					if($value_data['currency'] == "CAD"){
						
						

							//$result['sumtotalCAD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentCAD'] += $value['pay_for_sales'];
							
							$result['totalcommissionCAD'] +=  $value['commission'];
							$result['payoutCAD'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){		
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentCAD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentCAD'] += $value['commission'];
							}
						}		
					}
					if($value_data['currency'] == "SGD"){
						
							

							//$result['sumtotalSGD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentSGD'] += $value['pay_for_sales'];
							
							$result['totalcommissionSGD'] +=  $value['commission'];
							$result['payoutSGD'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){	
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentSGD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentSGD'] += $value['commission'];
							}
						}		
					}
					if($value_data['currency'] == "THB"){
						
							

							//$result['sumtotalTHB'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentTHB'] += $value['pay_for_sales'];
							
							$result['totalcommissionTHB'] +=  $value['commission'];
							$result['payoutTHB'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){	
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentTHB'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentTHB'] += $value['commission'];
							}
						}		
					}
					
					
				}
				
				$result['currency'][] = $value_data['currency'];
				//echo $result['sumtotalUSD']."<br>";
		}		
		
		$this->render('invoice_all', $result);
	}

	public function actionInvoiceDetail($id, $year)
	{
		$result['id'] = $id;
		$result['year_commission'] = $year;
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		
		
		$result['getDetail'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator cal')
				->leftjoin('user u', 'cal.sales_manager = u.fullname')
				->where('cal.id = "'.$id.'"')
			    ->queryAll();
				
		foreach ($result['getDetail'] as $key => $value) {	
			$result['sales'] = $value['sales_manager'];
			$result['bankAccount'] = User::model()->findByAttributes(array('fullname'=> $value['fullname']));
		}
			$result['comments'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('comments com')
				->where('com.invoice = "'.$id.'"')
				->order('com.date_comments DESC')
			    ->queryAll();
				
		$this->render('invoice_detail', $result);
		
		
	}
	public function actionShowInvoiceDetail($id, $year)
	{
		$result['id'] = $id;
		$result['year_commission'] = $year;
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		
		
		$result['getDetail'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator cal')
				->leftjoin('user u', 'cal.sales_manager = u.fullname')
				->where('cal.id = "'.$id.'"')
			    ->queryAll();
				
		foreach ($result['getDetail'] as $key => $value) {	
			$result['sales'] = $value['sales_manager'];
			$result['bankAccount'] = User::model()->findByAttributes(array('fullname'=> $value['fullname']));
		}
			$result['comments'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('comments com')
				->where('com.invoice = "'.$id.'"')
				->order('com.date_comments DESC')
			    ->queryAll();
				
		$this->render('showInvoice_detail', $result);
		
		
	}
	public function actionShowFiscalYearInvoice()
	{
		$result['getYear'] = Calculator::model()->findAll();
		$result['yearall'] = Array();
		foreach ($result['getYear'] as $key => $value) {
			list($year,$momth,$day) = explode("-",$value['date_quarter']);
			$result['yearall'][] = $year;
		}
		
		//echo $yearall[0].$yearall[1];
			
		$this->render('showfiscalYearInvoice', $result);
		
	}
	public function actionShowInvoice($year){
		
		$result['sumtotalUSD'] = 0;
		$result['sumtotalCAD'] = 0;
		$result['sumtotalSGD'] = 0;
		$result['sumtotalTHB'] = 0;
		$result['totalcommissionUSD'] = 0;
		$result['totalcommissionCAD'] = 0;
		$result['totalcommissionSGD'] = 0;
		$result['totalcommissionTHB'] = 0;
		$result['payoutUSD'] = 0;
		$result['payoutCAD'] = 0;
		$result['payoutSGD'] = 0;
		$result['payoutTHB'] = 0;
		$result['commissionPaymentUSD'] = 0;
		$result['commissionPaymentCAD'] = 0;
		$result['commissionPaymentSGD'] = 0;
		$result['commissionPaymentTHB'] = 0;
		
		$result['sumCommissionPaymaentUSD'] = 0;
		$result['sumCommissionPaymaentCAD'] = 0;
		$result['sumCommissionPaymaentSGD'] = 0;
		$result['sumCommissionPaymaentTHB'] = 0;
		
		$result['sumAmountReceivedUSD'] = 0;
		$result['sumAmountReceivedCAD'] = 0;
		$result['sumAmountReceivedSGD'] = 0;
		$result['sumAmountReceivedTHB'] = 0;
		
		//$result['year'] = $year;
		//$result['sales'] = $_POST['sale_rep'];
		
		$result['currency'] = Array();
		
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		//$result['bankAccount'] = User::model()->findByAttributes(array('fullname'=> $sales));
		$result['year_commission'] = $year;	
		//$result['sales_commission'] = $sales;	
		//$result['getData'] = Calculator::model()->findAll();
		
		$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
				
			foreach ($result['getData']as $key_data => $value_data) {	
				//echo $value_data['currency']."<br>";	
			
			
			$result['getSalesumtotal'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.invoice = "'.$value_data['invoice'].'"')
				//->andwhere('scal.status_commission = "Approved"')
				//->andwhere('scal.commisson_payment_status = "Paid"')
				//->andwhere('scal.currency = "'.$value_data['currency'].'"')
				->limit('1')
				//->order('scal.update_date DESC')
			    ->queryAll();
					
				foreach ($result['getSalesumtotal'] as $key_sumtotal => $value_sumtotal) {
					if($value_data['currency'] == "USD"){
						
							
							$result['sumtotalUSD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
						if($value_sumtotal['invoice_status'] == "Paid"){	
							$result['sumAmountReceivedUSD'] += $value_sumtotal['invoice_amount_received'];	
						}
					}
					if($value_data['currency'] == "CAD"){
						
						

							$result['sumtotalCAD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
						if($value_sumtotal['invoice_status'] == "Paid"){		
							$result['sumAmountReceivedCAD'] += $value_sumtotal['invoice_amount_received'];
							
						}		
					}
					if($value_data['currency'] == "SGD"){
						
							
							

							$result['sumtotalSGD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
						if($value_sumtotal['invoice_status'] == "Paid"){	
							$result['sumAmountReceivedSGD'] += $value_sumtotal['invoice_amount_received'];
						}		
					}
					if($value_data['currency'] == "THB"){
						
						

							$result['sumtotalTHB'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
						if($value_data['invoice_status'] == "Paid"){		
							$result['sumAmountReceivedTHB'] += $value_sumtotal['invoice_amount_received'];
						}		
					}
					
				}
				
	
				$result['getSale'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.invoice = "'.$value_data['invoice'].'"')
				//->andwhere('scal.status_commission = "Approved"')
				//->andwhere('scal.commisson_payment_status = "Paid"')
				//->andwhere('scal.currency = "'.$value_data['currency'].'"')
				->order('scal.update_date DESC')
			    ->queryAll();
				
				$model = new Calculator;
				foreach ($result['getSale'] as $key => $value) {
					
			
					if($value_data['currency'] == "USD"){
						
						
							//$result['sumtotalUSD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentUSD'] += $value['pay_for_sales'];
							
							$result['totalcommissionUSD'] +=  $value['commission'];
							$result['payoutUSD'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){		
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentUSD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentUSD'] += $value['commission'];
							}	
						}
					}
					if($value_data['currency'] == "CAD"){
						
						

							//$result['sumtotalCAD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentCAD'] += $value['pay_for_sales'];
							
							$result['totalcommissionCAD'] +=  $value['commission'];
							$result['payoutCAD'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){		
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentCAD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentCAD'] += $value['commission'];
							}
						}		
					}
					if($value_data['currency'] == "SGD"){
						
						

							//$result['sumtotalSGD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentSGD'] += $value['pay_for_sales'];
							
							$result['totalcommissionSGD'] +=  $value['commission'];
							$result['payoutSGD'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){		
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentSGD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentSGD'] += $value['commission'];
							}
						}		
					}
					if($value_data['currency'] == "THB"){
						
							

							//$result['sumtotalTHB'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentTHB'] += $value['pay_for_sales'];
							
							$result['totalcommissionTHB'] +=  $value['commission'];
							$result['payoutTHB'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){	
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentTHB'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentTHB'] += $value['commission'];
							}
						}		
					}
					
					
				}
				
				$result['currency'][] = $value_data['currency'];
				//echo $result['sumtotalUSD']."<br>";
		}		
		
		$this->render('showInvoice_all', $result);
	}
	
	public function actionSeachShowSalesCommission()
	{
		$sales = $_POST['sale_rep'];
		$year =	$_POST['year_commission'];
		
		$result['sumtotalUSD'] = 0;
		$result['sumtotalCAD'] = 0;
		$result['sumtotalSGD'] = 0;
		$result['sumtotalTHB'] = 0;
		$result['totalcommissionUSD'] = 0;
		$result['totalcommissionCAD'] = 0;
		$result['totalcommissionSGD'] = 0;
		$result['totalcommissionTHB'] = 0;
		$result['payoutUSD'] = 0;
		$result['payoutCAD'] = 0;
		$result['payoutSGD'] = 0;
		$result['payoutTHB'] = 0;
		$result['commissionPaymentUSD'] = 0;
		$result['commissionPaymentCAD'] = 0;
		$result['commissionPaymentSGD'] = 0;
		$result['commissionPaymentTHB'] = 0;
		
		$result['sumCommissionPaymaentUSD'] = 0;
		$result['sumCommissionPaymaentCAD'] = 0;
		$result['sumCommissionPaymaentSGD'] = 0;
		$result['sumCommissionPaymaentTHB'] = 0;
		
		$result['sumAmountReceivedUSD'] = 0;
		$result['sumAmountReceivedCAD'] = 0;
		$result['sumAmountReceivedSGD'] = 0;
		$result['sumAmountReceivedTHB'] = 0;
		
		$result['currency'] = Array();
		
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		$result['bankAccount'] = User::model()->findByAttributes(array('fullname'=> $sales));
		$result['year_commission'] = $year;	
		$result['sales_commission'] = $sales;	
		//$result['getData'] = Calculator::model()->findAll();
		
		if(!empty($_POST['search_invoice']) && (empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status']))){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && (empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status']))){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && (empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status']))){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}else{
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.sales_manager = "'.$sales.'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}
			
			foreach ($result['getData']as $key_data => $value_data) {

			$result['getDate'] = Yii::app()->db->createCommand()
			    ->select('MAX(update_date) AS datedata')
			    ->from('calculator cal')
				->where('cal.sales_manager = "'.$value_data['sales_manager'].'"')
				->order('cal.date_quarter ASC , cal.invoice ASC ')
				->limit('1')
			    ->queryAll();
				
				
			
				foreach ($result['getDate'] as $key_date => $value_date) {
					$result['datedata'] = $value_date['datedata'];
				}	
				
				$result['getSalesumtotal'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.invoice = "'.$value_data['invoice'].'"')
				//->andwhere('scal.status_commission = "Approved"')
				->limit('1')
			    ->queryAll();
					
				foreach ($result['getSalesumtotal'] as $key_sumtotal => $value_sumtotal) {
					if($value_data['currency'] == "USD"){
						
						if($value_sumtotal['invoice_status'] == "Paid"){
							
							$result['sumAmountReceivedUSD'] += $value_sumtotal['invoice_amount_received'];
							
							if($value_sumtotal['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentUSD'] +=  $value_sumtotal['commission'] - $value_sumtotal['pay_for_sales'];
							}else{
								$result['commissionPaymentUSD'] += $value_sumtotal['commission'];
							}	
						}
							//if($value_sumtotal['status_commission'] == "Approved"){	
								
								$result['sumtotalUSD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
								$result['totalcommissionUSD'] +=  $value_sumtotal['commission'];
								$result['payoutUSD'] +=  $value_sumtotal['pay_for_sales'];
								
								
							//}		
						
							
							
							
					}
					if($value_data['currency'] == "CAD"){
						
							if($value_sumtotal['invoice_status'] == "Paid"){
								
								$result['sumAmountReceivedCAD'] += $value_sumtotal['invoice_amount_received'];
								
								if($value_sumtotal['commisson_payment_status'] == "Paid"){
									$result['commissionPaymentCAD'] +=  $value_sumtotal['commission'] - $value_sumtotal['pay_for_sales'];
								}else{
									$result['commissionPaymentCAD'] += $value_sumtotal['commission'];
								}
							
							}			
								//if($value_sumtotal['status_commission'] == "Approved"){			

								$result['sumtotalCAD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
								
								$result['totalcommissionCAD'] +=  $value_sumtotal['commission'];
								$result['payoutCAD'] +=  $value_sumtotal['pay_for_sales'];
								
								
							//}
							
					}
					if($value_data['currency'] == "SGD"){
						
						if($value_sumtotal['invoice_status'] == "Paid"){	
						
							$result['sumAmountReceivedSGD'] += $value_sumtotal['invoice_amount_received'];
							if($value_sumtotal['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentSGD'] +=  $value_sumtotal['commission'] - $value_sumtotal['pay_for_sales'];
							}else{
								$result['commissionPaymentSGD'] += $value_sumtotal['commission'];
							}
							
						}		
							//if($value_sumtotal['status_commission'] == "Approved"){	
								$result['totalcommissionSGD'] +=  $value_sumtotal['commission'];
								$result['payoutSGD'] +=  $value_sumtotal['pay_for_sales'];
								
								
								
								$result['sumtotalSGD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							//}
							
					}
					if($value_data['currency'] == "THB"){
						
						if($value_data['invoice_status'] == "Paid"){

							$result['sumAmountReceivedTHB'] += $value_sumtotal['invoice_amount_received'];
							
							if($value_sumtotal['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentTHB'] +=  $value_sumtotal['commission'] - $value_sumtotal['pay_for_sales'];
							}else{
								$result['commissionPaymentTHB'] += $value_sumtotal['commission'];
							}
						}	
							//if($value_sumtotal['status_commission'] == "Approved"){	
								$result['totalcommissionTHB'] +=  $value_sumtotal['commission'];
								$result['payoutTHB'] +=  $value_sumtotal['pay_for_sales'];
								
									
								$result['sumtotalTHB'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);

								
						//}		
					}
					
				}
				
				//echo $value_data['currency']."<br>";	
				$result['getSale'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.sales_manager = "'.$value_data['sales_manager'].'"')
				//->andwhere('scal.status_commission = "Approved"')
				//->andwhere('scal.commisson_payment_status = "Paid"')
				->andwhere('scal.currency = "'.$value_data['currency'].'"')
				->order('scal.update_date DESC')
			    ->queryAll();
				
				$model = new Calculator;
				foreach ($result['getSale'] as $key => $value) {
					
					if($value_data['currency'] == "USD"){
						
						if($value_data['invoice_status'] == "Paid"){	
							//$result['sumtotalUSD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							
						}
					}
					if($value_data['currency'] == "CAD"){
						
						if($value_data['invoice_status'] == "Paid"){	

							//$result['sumtotalCAD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							
							
						}		
					}
					if($value_data['currency'] == "SGD"){
						
						if($value_data['invoice_status'] == "Paid"){	

							//$result['sumtotalSGD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							
							
						}		
					}
					if($value_data['currency'] == "THB"){
						
						if($value_data['invoice_status'] == "Paid"){	

							//$result['sumtotalTHB'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							
							
						}		
					}
					
					
				}
				
				$result['currency'][] = $value_data['currency'];
				//echo $result['sumtotalUSD']."<br>";
		}		
			
		
		$this->render('show_sales_commission', $result);
			
		
		//$this->render('_mailAddInvoice');
	}
	public function actionSeachShowInvoice()
	{
	
		$sales = $_POST['sale_rep'];
		$year =	$_POST['year_commission'];
		
		$result['sumtotalUSD'] = 0;
		$result['sumtotalCAD'] = 0;
		$result['sumtotalSGD'] = 0;
		$result['sumtotalTHB'] = 0;
		$result['totalcommissionUSD'] = 0;
		$result['totalcommissionCAD'] = 0;
		$result['totalcommissionSGD'] = 0;
		$result['totalcommissionTHB'] = 0;
		$result['payoutUSD'] = 0;
		$result['payoutCAD'] = 0;
		$result['payoutSGD'] = 0;
		$result['payoutTHB'] = 0;
		$result['commissionPaymentUSD'] = 0;
		$result['commissionPaymentCAD'] = 0;
		$result['commissionPaymentSGD'] = 0;
		$result['commissionPaymentTHB'] = 0;
		
		$result['sumCommissionPaymaentUSD'] = 0;
		$result['sumCommissionPaymaentCAD'] = 0;
		$result['sumCommissionPaymaentSGD'] = 0;
		$result['sumCommissionPaymaentTHB'] = 0;
		
		$result['sumAmountReceivedUSD'] = 0;
		$result['sumAmountReceivedCAD'] = 0;
		$result['sumAmountReceivedSGD'] = 0;
		$result['sumAmountReceivedTHB'] = 0;
		
		$result['currency'] = Array();
		
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		//$result['bankAccount'] = User::model()->findByAttributes(array('fullname'=> $sales));
		$result['year_commission'] = $year;	
		$result['sales_commission'] = $sales;	
		//$result['getData'] = Calculator::model()->findAll();
		
/*	$_POST['search_invoice']
		$_POST['search_invoice2']
		$_POST['search_dateQuarter']
		$_POST['search_dateQuarter2']
		$_POST['search_orderno']
		$_POST['search_orderno2']
		$_POST['search_ordername']
		$_POST['invoice_status']
		$_POST['aproved_status']
		$_POST['commission_status']
*/		
		if(!empty($_POST['search_invoice']) && (empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status']))){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && (empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status']))){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice2']) && empty($_POST['search_invoice']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice = "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && (empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status']))){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(!empty($_POST['search_invoice']) && !empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice BETWEEN "'.$_POST['search_invoice'].'" AND "'.$_POST['search_invoice2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = $_POST['search_invoice'];
			$result['search_invoice2'] = $_POST['search_invoice2'];
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter = "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && !empty($_POST['search_dateQuarter']) && !empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.date_quarter BETWEEN "'.$_POST['search_dateQuarter'].'" AND "'.$_POST['search_dateQuarter2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = $_POST['search_dateQuarter'];
			$result['search_dateQuarter2'] = $_POST['search_dateQuarter2'];
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no = "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && !empty($_POST['search_orderno']) && !empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_no BETWEEN "'.$_POST['search_orderno'].'" AND "'.$_POST['search_orderno2'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = $_POST['search_orderno'];
			$result['search_orderno2'] = $_POST['search_orderno2'];
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && !empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.order_name LIKE "%'.$_POST['search_ordername'].'%"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = $_POST['search_ordername'];
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && !empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.invoice_status = "'.$_POST['invoice_status'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = $_POST['invoice_status'];
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && !empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.status_commission = "'.$_POST['aproved_status'].'"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = $_POST['aproved_status'];
			$result['invoice_status'] = "";
			
		}elseif(empty($_POST['search_invoice']) && empty($_POST['search_invoice2']) && empty($_POST['search_dateQuarter']) && empty($_POST['search_dateQuarter2']) && empty($_POST['search_orderno']) && empty($_POST['search_orderno2']) && empty($_POST['search_ordername']) && empty($_POST['invoice_status']) && empty($_POST['aproved_status']) && !empty($_POST['commission_status'])){
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere('cal.commisson_payment_status = "'.$_POST['commission_status'].'"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = $_POST['commission_status'];
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}else{
			
			$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.date_quarter LIKE "'.$year.'%"')
			->group('cal.invoice')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
		}
			
			foreach ($result['getData']as $key_data => $value_data) {

				$result['getSalesumtotal'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.invoice = "'.$value_data['invoice'].'"')
				//->andwhere('scal.status_commission = "Approved"')
				->limit('1')
			    ->queryAll();
					
				foreach ($result['getSalesumtotal'] as $key_sumtotal => $value_sumtotal) {
					if($value_data['currency'] == "USD"){
						
							
							$result['sumtotalUSD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
						if($value_sumtotal['invoice_status'] == "Paid"){	
							$result['sumAmountReceivedUSD'] += $value_sumtotal['invoice_amount_received'];
						}
					}
					if($value_data['currency'] == "CAD"){
						
							

							$result['sumtotalCAD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
						if($value_sumtotal['invoice_status'] == "Paid"){
							$result['sumAmountReceivedCAD'] += $value_sumtotal['invoice_amount_received'];
							
						}		
					}
					if($value_data['currency'] == "SGD"){
						
							

							$result['sumtotalSGD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
						if($value_sumtotal['invoice_status'] == "Paid"){
							$result['sumAmountReceivedSGD'] += $value_sumtotal['invoice_amount_received'];
						}		
					}
					if($value_data['currency'] == "THB"){
						
						

							$result['sumtotalTHB'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
						if($value_data['invoice_status'] == "Paid"){	
							$result['sumAmountReceivedTHB'] += $value_sumtotal['invoice_amount_received'];
						}		
					}
					
				}	
			
				$result['getSale'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.invoice = "'.$value_data['invoice'].'"')
				//->andwhere('scal.status_commission = "Approved"')
				//->andwhere('scal.commisson_payment_status = "Paid"')
				//->andwhere('scal.currency = "'.$value_data['currency'].'"')
				->order('scal.update_date DESC')
			    ->queryAll();
					
				foreach ($result['getSale'] as $key => $value) {
					
			
					if($value_data['currency'] == "USD"){
						
						
							//$result['sumtotalUSD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentUSD'] += $value['pay_for_sales'];
							
							$result['totalcommissionUSD'] +=  $value['commission'];
							$result['payoutUSD'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){		
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentUSD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentUSD'] += $value['commission'];
							}
							
							
							
						}
					}
					if($value_data['currency'] == "CAD"){
						
							

							//$result['sumtotalCAD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentCAD'] += $value['pay_for_sales'];
							
							$result['totalcommissionCAD'] +=  $value['commission'];
							$result['payoutCAD'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){	
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentCAD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentCAD'] += $value['commission'];
							}
						}		
					}
					if($value_data['currency'] == "SGD"){
						
							

							//$result['sumtotalSGD'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentSGD'] += $value['pay_for_sales'];
							
							$result['totalcommissionSGD'] +=  $value['commission'];
							$result['payoutSGD'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){	
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentSGD'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentSGD'] += $value['commission'];
							}
						}		
					}
					if($value_data['currency'] == "THB"){
						
							

							//$result['sumtotalTHB'] +=  (($value['total_sales']-$value['shipping_cost'])-$value['creditcard_feecost']);
							$result['sumCommissionPaymaentTHB'] += $value['pay_for_sales'];
							
							$result['totalcommissionTHB'] +=  $value['commission'];
							$result['payoutTHB'] +=  $value['pay_for_sales'];
						if($value_data['invoice_status'] == "Paid"){	
							if($value['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentTHB'] +=  $value['commission'] - $value['pay_for_sales'];
							}else{
								$result['commissionPaymentTHB'] += $value['commission'];
							}
						}		
					}
					
					
				}
				
				$result['currency'][] = $value_data['currency'];
				//echo $result['sumtotalUSD']."<br>";
		}		
			
		$this->render('showInvoice_all', $result);
		
	
	}
	public function actionSalesOrdersAll()
	{
		
			$result['dateorders'] = Yii::app()->db->createCommand()
					->select('MAX(date_update) AS maxdate')
					->from('sales_orders sodat')
					->queryAll();
					
				foreach ($result['dateorders'] as $key => $value) {
					$result['datedata'] = $value['maxdate'];
				}	
					
			$result['litedata'] = Yii::app()->db->createCommand()
					->select('*')
					->from('sales_orders so')
					//->where('so.invoice = "'.$value_data['invoice'].'"')
					->group('so.sales_rep')
					->order('so.sales_rep ASC')
					->queryAll();
		
		$this->render('salesOrdersAll', $result);
		
	}
	public function actionSalesOrdersOneByOne($sales)
	{
		
			$result['dateorders'] = Yii::app()->db->createCommand()
					->select('MAX(date_update) AS maxdate')
					->from('sales_orders sodat')
					->where('sodat.sales_rep = "'.$sales.'"')
					->queryAll();
					
				foreach ($result['dateorders'] as $key => $value) {
					$result['datedata'] = $value['maxdate'];
				}	
					
			$result['litedata'] = Yii::app()->db->createCommand()
					->select('*')
					->from('sales_orders so')
					->where('so.sales_rep = "'.$sales.'"')
					->order('so.order_no ASC')
					->queryAll();
		
			$connection=Yii::app()->db;
				$sql = 'UPDATE sales_orders SET status_active = "1" WHERE sales_rep = "'.$sales.'"';
				$command = $connection->createCommand($sql);
				$command->execute();
		
		$result['sales'] = $sales;
		
		$this->render('sales_orders', $result);
		
	}
	public function actionSalesOrders()
	{
		
		
		if(Yii::app()->user->getState('userGroup') == 99 || Yii::app()->user->getState('userGroup') == 1){
			
			$result['dateorders'] = Yii::app()->db->createCommand()
					->select('MAX(date_update) AS maxdate')
					->from('sales_orders sodat')
					->queryAll();
					
				foreach ($result['dateorders'] as $key => $value) {
					$result['datedata'] = $value['maxdate'];
				}	
					
			$result['litedata'] = Yii::app()->db->createCommand()
					->select('*')
					->from('sales_orders so')
					//->where('so.invoice = "'.$value_data['invoice'].'"')
					->order('so.order_no ASC')
					->queryAll();

		}elseif(Yii::app()->user->getState('userGroup') == 2){
			
			$result['dateorders'] = Yii::app()->db->createCommand()
					->select('MAX(date_update) AS maxdate')
					->from('sales_orders sodat')
					->where('sodat.sales_rep = "'.Yii::app()->user->getState('fullName').'"')
					->queryAll();
					
				foreach ($result['dateorders'] as $key => $value) {
					$result['datedata'] = $value['maxdate'];
				}		
			
			$result['litedata'] = Yii::app()->db->createCommand()
					->select('*')
					->from('sales_orders so')
					->where('so.sales_rep = "'.Yii::app()->user->getState('fullName').'"')
					->order('so.order_no ASC')
					->queryAll();
					
		}
		
		$this->render('sales_orders', $result);
		
	}
	public function actionAddSalesOrdersSubmit()
	{	
			$model = new SalesOrders;
			
			$model->attributes = $_POST['SalesOrders'];
				
				$model->order_no = $_POST['SalesOrders']['order_no'];
				$model->order_name = $_POST['SalesOrders']['order_name'];
				$model->commission_percent = $_POST['SalesOrders']['commission_percent'];
				$model->commission_percent2 = $_POST['SalesOrders']['commission_percent2'];
				$model->remark = $_POST['SalesOrders']['remark'];
				$model->date_saleorder = $_POST['SalesOrders']['date_saleorder'];
				
				$model->sales_rep = $_POST['SalesOrders']['sales_rep'];
				
				$model->date_update = date("Y-m-d");
				
				$model->save();
				

		//$this->render('sales_orders', $result);
		$this->redirect(array('calculator/SalesOrders'));
	}
	public function actionEditSaleOrders()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$model = SalesOrders::model()->findByPk($_POST['id']);
			$model->status_active = '0';
			//$model = Calculator::model()->findByAttributes(array('invoice'=>$_POST['id']));
			
			$result = $model->attributes;
			
			
        }

		header('Content-type: application/json');
        echo json_encode($result);
		
	}
	public function actionEditSalesOrdersSubmit()
	{	
		
		$model = SalesOrders::model()->findByAttributes(array('id'=>$_POST['SalesOrders']['id']));
			
			$model->attributes = $_POST['SalesOrders'];
				
				$model->order_no = $_POST['SalesOrders']['order_no'];
				$model->order_name = $_POST['SalesOrders']['order_name'];
				$model->commission_percent = $_POST['SalesOrders']['commission_percent'];
				$model->commission_percent2 = $_POST['SalesOrders']['commission_percent2'];
				$model->remark = $_POST['SalesOrders']['remark'];
				$model->date_saleorder = $_POST['SalesOrders']['date_saleorder'];
				
				$model->sales_rep = $_POST['SalesOrders']['sales_rep'];
				
				$model->date_update = date("Y-m-d");
				$model->status_active = $_POST['SalesOrders']['sales_rep'];
				
				$model->save();
				

		//$this->render('sales_orders', $result);
		$this->redirect(array('calculator/SalesOrders'));
	}
	
	/*public function actionAddSaleOrders()
	{
		if (Yii::app()->request->isAjaxRequest) {
			
			$result = SalesOrders::add($_POST['SalesOrders']);
        }

		header('Content-type: application/json');
        echo json_encode($result);
	}*/
	public function actionDeleteSalesOrders($id)
	{
		$result = array();
		
		SalesOrders::model()->deleteByPk($id);
			
		$this->redirect(array('calculator/SalesOrders'));

	}
	public function actionSalesPosition($year, $sales, $positions)
	{
		
		$result['sumtotalUSD'] = 0;
		$result['sumtotalCAD'] = 0;
		$result['sumtotalSGD'] = 0;
		$result['sumtotalTHB'] = 0;
		$result['totalcommissionUSD'] = 0;
		$result['totalcommissionCAD'] = 0;
		$result['totalcommissionSGD'] = 0;
		$result['totalcommissionTHB'] = 0;
		$result['payoutUSD'] = 0;
		$result['payoutCAD'] = 0;
		$result['payoutSGD'] = 0;
		$result['payoutTHB'] = 0;
		$result['commissionPaymentUSD'] = 0;
		$result['commissionPaymentCAD'] = 0;
		$result['commissionPaymentSGD'] = 0;
		$result['commissionPaymentTHB'] = 0;
		
		$result['sumCommissionPaymaentUSD'] = 0;
		$result['sumCommissionPaymaentCAD'] = 0;
		$result['sumCommissionPaymaentSGD'] = 0;
		$result['sumCommissionPaymaentTHB'] = 0;
		
		$result['sumAmountReceivedUSD'] = 0;
		$result['sumAmountReceivedCAD'] = 0;
		$result['sumAmountReceivedSGD'] = 0;
		$result['sumAmountReceivedTHB'] = 0;
		
		$result['currency'] = Array();
		
		if($positions == "All"){
			$responsible = "";
		}else{
			$responsible = 'cal.sales_status = "'.$positions.'"';
		}
		
		$model = new Calculator;
		
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		$result['bankAccount'] = User::model()->findByAttributes(array('fullname'=> $sales));
		$result['year_commission'] = $year;	
		$result['sales_commission'] = $sales;	
		//$result['getData'] = Calculator::model()->findAll();
		
		$result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.sales_manager = "'.$sales.'"')
			->andwhere('cal.date_quarter LIKE "'.$year.'%"')
			->andwhere($responsible)
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
				
			foreach ($result['getData']as $key_data => $value_data) {	
				//echo $value_data['currency']."<br>";	
				
				if($value_data['currency'] == "USD"){
						
						
							//if($value_data['status_commission'] == "Approved"){	
								
							//}	
								$result['sumtotalUSD'] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								$result['totalcommissionUSD'] +=  $value_data['commission'];
								$result['sumCommissionPaymaentUSD'] += $value_data['pay_for_sales'];
								
								
								$result['payoutUSD'] +=  $value_data['pay_for_sales'];
								
									
							//}
						if($value_data['invoice_status'] == "Paid"){
									
							$result['sumAmountReceivedUSD'] += $value_data['invoice_amount_received'];
							
							if($value_data['commisson_payment_status'] == "Paid"){
									$result['commissionPaymentUSD'] +=  $value_data['commission'] - $value_data['pay_for_sales'];
							}else{
									$result['commissionPaymentUSD'] += $value_data['commission'];
							}
						}
					}
					if($value_data['currency'] == "CAD"){
						
						
							//if($value_data['status_commission'] == "Approved"){	
								
							//}	
								$result['sumtotalCAD'] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								$result['totalcommissionCAD'] +=  $value_data['commission'];
								
								$result['sumCommissionPaymaentCAD'] += $value_data['pay_for_sales'];
								$result['payoutCAD'] +=  $value_data['pay_for_sales'];
								
							//}
						if($value_data['invoice_status'] == "Paid"){		
							$result['sumAmountReceivedCAD'] += $value_data['invoice_amount_received'];
							
							if($value_data['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentCAD'] +=  $value_data['commission'] - $value_data['pay_for_sales'];
							}else{
								$result['commissionPaymentCAD'] += $value_data['commission'];
							}
						}		
					}
					if($value_data['currency'] == "SGD"){
						
						
							//if($value_data['status_commission'] == "Approved"){	
								
							//}
								$result['sumtotalSGD'] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								
								$result['totalcommissionSGD'] +=  $value_data['commission'];
								$result['sumCommissionPaymaentSGD'] += $value_data['pay_for_sales'];
								$result['payoutSGD'] +=  $value_data['pay_for_sales'];
								
								
							//}
						if($value_data['invoice_status'] == "Paid"){	
							$result['sumAmountReceivedSGD'] += $value_data['invoice_amount_received'];
							if($value_data['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentSGD'] +=  $value_data['commission'] - $value_data['pay_for_sales'];
							}else{
								$result['commissionPaymentSGD'] += $value_data['commission'];
							}
						}		
					}
					if($value_data['currency'] == "THB"){
						
						
							//if($value_data['status_commission'] == "Approved"){		
								
							//}	
								$result['sumtotalTHB'] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								$result['totalcommissionTHB'] +=  $value_data['commission'];
								$result['sumCommissionPaymaentTHB'] += $value_data['pay_for_sales'];
								
								$result['payoutTHB'] +=  $value_data['pay_for_sales'];
								
							//}
						if($value_data['invoice_status'] == "Paid"){	
							$result['sumAmountReceivedTHB'] += $value_data['invoice_amount_received'];
							if($value_data['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentTHB'] +=  $value_data['commission'] - $value_data['pay_for_sales'];
							}else{
								$result['commissionPaymentTHB'] += $value_data['commission'];
							}
						}		
					}
				
				
				
				
				
				
				$result['currency'][] = $value_data['currency'];
				//echo $result['sumtotalUSD']."<br>";
		}		
			
		$this->render('sales_commission', $result);
		//$this->render('sales_rep', $result);
	

	}
	public function actionShowSalesPosition($year, $sales, $positions)
	{
		$result['sumtotalUSD'] = 0;
		$result['sumtotalCAD'] = 0;
		$result['sumtotalSGD'] = 0;
		$result['sumtotalTHB'] = 0;
		$result['totalcommissionUSD'] = 0;
		$result['totalcommissionCAD'] = 0;
		$result['totalcommissionSGD'] = 0;
		$result['totalcommissionTHB'] = 0;
		$result['payoutUSD'] = 0;
		$result['payoutCAD'] = 0;
		$result['payoutSGD'] = 0;
		$result['payoutTHB'] = 0;
		
		$result['commissionPaymentUSD'] = 0;
		$result['commissionPaymentCAD'] = 0;
		$result['commissionPaymentSGD'] = 0;
		$result['commissionPaymentTHB'] = 0;
		
		$result['sumCommissionPaymaentUSD'] = 0;
		$result['sumCommissionPaymaentCAD'] = 0;
		$result['sumCommissionPaymaentSGD'] = 0;
		$result['sumCommissionPaymaentTHB'] = 0;
		
		$result['sumAmountReceivedUSD'] = 0;
		$result['sumAmountReceivedCAD'] = 0;
		$result['sumAmountReceivedSGD'] = 0;
		$result['sumAmountReceivedTHB'] = 0;
		
		$result['currency'] = Array();
			
		$result['notes'] = Notes::model()->findByAttributes(array('type'=>'Calculator'));
		
		$result['bankAccount'] = User::model()->findByAttributes(array('fullname'=> $sales));
		
		if($positions == "All"){
			$responsible = "";
		}else{
			$responsible = 'cal.sales_status = "'.$positions.'"';
		}
		
		$result['year_commission'] = $year;	
		$result['sales_commission'] = $sales;	
		//$result['getData'] = Calculator::model()->findAll();
		$result['getData'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator cal')
				->where('cal.sales_manager = "'.$sales.'"')
				->andwhere('cal.date_quarter LIKE "'.$year.'%"')
				->andwhere($responsible)
				->order('cal.date_quarter ASC , cal.invoice ASC ')
			    ->queryAll();
		
		foreach ($result['getData']as $key_data => $value_data) {
			
				$result['getDate'] = Yii::app()->db->createCommand()
			    ->select('MAX(update_date) AS datedata')
			    ->from('calculator cal')
				->where('cal.sales_manager = "'.$value_data['sales_manager'].'"')
				->order('cal.date_quarter ASC , cal.invoice ASC ')
				->limit('1')
			    ->queryAll();
				
				$result['search_invoice'] = "";
				$result['search_invoice2'] = "";
				$result['search_dateQuarter'] = "";
				$result['search_dateQuarter2'] = "";
				$result['search_orderno'] = "";
				$result['search_orderno2'] = "";
				$result['search_ordername'] = "";
				$result['commission_status'] = "";
				$result['aproved_status'] = "";
				$result['invoice_status'] = "";
			
				foreach ($result['getDate'] as $key_date => $value_date) {
					$result['datedata'] = $value_date['datedata'];
				}
				
				/*$result['getSalesumtotal'] = Yii::app()->db->createCommand()
			    ->select('*')
			    ->from('calculator scal')
				->where('scal.invoice = "'.$value_data['invoice'].'"')
				->andwhere('scal.status_commission = "Approved"')
				//->andwhere('scal.commisson_payment_status = "Paid"')
				//->andwhere('scal.currency = "'.$value_data['currency'].'"')
				->limit('1')
				//->order('scal.update_date DESC')
			    ->queryAll();
					
				foreach ($result['getSalesumtotal'] as $key_sumtotal => $value_sumtotal) {
				*/	
					if($value_data['currency'] == "USD"){
						
						if($value_data['invoice_status'] == "Paid"){	
							//$result['sumtotalUSD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							
							$result['sumAmountReceivedUSD'] += $value_data['invoice_amount_received'];
							
							if($value_data['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentUSD'] +=  $value_data['commission'] - $value_data['pay_for_sales'];
							}else{
								$result['commissionPaymentUSD'] += $value_data['commission'];
							}
								
						}
							//if($value_data['status_commission'] == "Approved"){	
							
								$result['sumtotalUSD'] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								$result['totalcommissionUSD'] +=  $value_data['commission'];
								
								$result['sumCommissionPaymaentUSD'] += $value_data['pay_for_sales'];
								$result['payoutUSD'] +=  $value_data['pay_for_sales'];
								
									
							//}
							//$result['sumAmountReceivedUSD'] += $value_data['invoice_amount_received'];
					
						
						
					}
					if($value_data['currency'] == "CAD"){
						
						if($value_data['invoice_status'] == "Paid"){	

							//$result['sumtotalCAD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							$result['sumAmountReceivedCAD'] += $value_data['invoice_amount_received'];		
							
							if($value_data['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentCAD'] +=  $value_data['commission'] - $value_data['pay_for_sales'];
							}else{
								$result['commissionPaymentCAD'] += $value_data['commission'];
							}
							
						}	
						
						
							//if($value_data['status_commission'] == "Approved"){	
							
								$result['sumtotalCAD'] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								$result['totalcommissionCAD'] +=  $value_data['commission'];
								
								$result['sumCommissionPaymaentCAD'] += $value_data['pay_for_sales'];
								$result['payoutCAD'] +=  $value_data['pay_for_sales'];
								
									
							//}
						
					}
					if($value_data['currency'] == "SGD"){
						
						if($value_data['invoice_status'] == "Paid"){	
							

								//$result['sumtotalSGD'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							$result['sumAmountReceivedSGD'] += $value_data['invoice_amount_received'];
							
							if($value_data['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentSGD'] +=  $value_data['commission'] - $value_sumtotal['pay_for_sales'];
							}else{
								$result['commissionPaymentSGD'] += $value_data['commission'];
							}
						
						}				
							//if($value_data['status_commission'] == "Approved"){	
							
								$result['sumtotalSGD'] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								$result['totalcommissionSGD'] +=  $value_data['commission'];
								
								$result['sumCommissionPaymaentSGD'] += $value_data['pay_for_sales'];
								$result['payoutSGD'] +=  $value_data['pay_for_sales'];
								
									
							//}
								
								
								
					}
					if($value_data['currency'] == "THB"){
						
						if($value_data['invoice_status'] == "Paid"){	

							//$result['sumtotalTHB'] +=  (($value_sumtotal['total_sales']-$value_sumtotal['shipping_cost'])-$value_sumtotal['creditcard_feecost']);
							$result['sumAmountReceivedTHB'] += $value_data['invoice_amount_received'];
							
							if($value_data['commisson_payment_status'] == "Paid"){
								$result['commissionPaymentTHB'] +=  $value_data['commission'] - $value_data['pay_for_sales'];
							}else{
								$result['commissionPaymentTHB'] += $value_data['commission'];
							}
						
						}		
							//if($value_data['status_commission'] == "Approved"){	
							
								$result['sumtotalTHB'] +=  (($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost']);
								
								$result['totalcommissionTHB'] +=  $value_data['commission'];
								
								$result['sumCommissionPaymaentTHB'] += $value_data['pay_for_sales'];
								$result['payoutTHB'] +=  $value_data['pay_for_sales'];
								
									
							//}						
							
		
							
					}
					
				//}
				
				//$model = new Calculator;
				

				$result['currency'][] = $value_data['currency'];	
		}	
			
		$this->render('show_sales_commission', $result);
		//$this->render('sales_rep', $result);
	}
}

