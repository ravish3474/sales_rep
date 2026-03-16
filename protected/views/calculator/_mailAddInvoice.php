<style> 
table, tr, td {
	border:1px solid #00182f
}
td{
	padding:8px;
}
</style> 

<table style="width:500px;">
	<thead>
		<tr style="background-color: ##198FFF;">
			<td colspan="2" style="margin: auto">
				<h2 style="text-align:center;vertical-align: middle;"><img src="https://jogsports.com/salesrep/images/jog-logo.png">INVOICE</h2>
			</td>
		</tr>
	<thead>
	<tbody>
	<tr >
		<td style="width:20%">
			Invoice : 
		</td>
		<td style="width:80%">
			<?php echo $invoice; ?>
		</td>
	</tr>
	<tr >
		<td style="width:20%">
			Order No. : 
		</td>
		<td style="width:80%">
			<?php echo $order_no; ?>
		</td>
	</tr>
	<tr >
		<td>
			Order Name : 
		</td>
		<td>
			<?php echo $order_name; ?>
		</td>
	</tr>
	<tr >
		<td>
			Date : 
		</td>
		<td>
			<?php echo $date_Quarter; ?>
		</td>
	</tr>
	<tr >
		<td>
			Invoice File : 
		</td>
		<td>
		<?php if($invoice_file != "Array" && $invoice_file != ""){ ?>
			<a href="https://jogsports.com/salesrep/invoice/docs/<?php echo $invoice_file;?>" target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"></i> >>> Click Here <<< </a>
		<?php } ?>	
		</td>
	</tr>
	<?php if($invoice_status == "Paid"){ ?>
	<tr >
		<td colspan="2">
			Invoice Payment
		</td>
	</tr>
	<tr >
		<td>
			Invoice Payment Status :
		</td>
		<td>
			<?php echo $invoice_status; ?>
		</td>
	</tr>
	<tr >
		<td>
			Received Date :
		</td>
		<td>
			<?php echo $date; ?>
		</td>
	</tr>
	<tr >
		<td>
			Amount Received : 
		</td>
		<td>
			<?php echo number_format($invoice_amount_received , 2)." ".$currency ; ?>
		</td>
	</tr>
	<tr >
		<td>
			Payment Method :
		</td>
		<td>
			<?php echo $invoice_payment_method; ?>
		</td>
	</tr>
	<?php }else{ ?>
	<tr >
		<td>
			Invoice Payment Status :
		</td>
		<td>
			<?php echo $invoice_status; ?>
		</td>
	</tr>
	<?php
	} ?>
	<tbody>
</table>