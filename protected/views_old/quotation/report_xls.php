<?php
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=CommReport".date("Ymd").".xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?>
<style type="text/css">
.tbl_content th{
	background-color: #339;
	color: #FFF;
	padding: 5px;
	text-align: center;
}
.tbl_content tr:hover td{
	background-color: #EEE;
}
.tbl_content td{
	padding: 5px;
	text-align: center;
}
</style>
<table class="tbl_content" style="width: 100%;" border="1">
	<tr>
		<th>#</th><th>Request by</th><th>Estimate Number</th><th style="text-align: left;">Customer</th>
		<th>Estimate Date</th><th>EXP. Date</th><th>Currency</th><th>Status</th>
		<th>Invoice No.</th><th>Product</th>
		<?php if($desc_show=="yes"){ ?>
		<th>Description</th>
		<?php } ?>
		<th>QTY</th><th>Price</th><th>Amount</th><th>Comm.%</th><th>Comm.</th>
	</tr>
	<?php
	$n_count = 1;
	foreach ( $quote_item as $key1 => $row_quote_doc ) {

		$show_status = strtoupper($row_quote_doc["approve_status"]);
		if($row_quote_doc["approve_status"]=="approve"){
			$show_status = "APPROVED".'<div class="show_date_approve">'.date("Y-m-d H:i",strtotime($row_quote_doc["approve_date"])).'</div>';
		}else if($row_quote_doc["approve_status"]=="reject"){
			$show_status = "REJECTED".'<div class="show_date_reject">'.date("Y-m-d H:i",strtotime($row_quote_doc["reject_time"])).'</div>';
		}
	?>
		<tr <?php if($row_quote_doc["is_editing"]=="2"){ echo 'style="background-color:#FFA;"'; }else if($row_quote_doc["is_duplicate"]=="1"){ echo 'style="background-color:#FAA;"'; }  ?> >
			<td><?php echo $n_count; ?></td>
			<td><?php echo $row_quote_doc["fullname"]; ?></td>
			<td id="td_est_number<?php echo $row_quote_doc["qdoc_id"]; ?>"><?php echo $row_quote_doc["est_number"]; ?></td>
			<td style="text-align: left;"><?php echo $row_quote_doc["cust_name"]; ?></td>
			<td><?php echo date("M. d, Y",strtotime($row_quote_doc["est_date"])); ?></td>
			<td><?php echo date("M. d, Y",strtotime($row_quote_doc["exp_date"])); ?></td>
			
			<td><?php echo $row_quote_doc["quote_curr"]; ?></td>
			<td style="width: 110px;"><?php echo $show_status; ?></td>
			<?php
			
			$s_inv = "";
			if($row_quote_doc["inv_no"]!=""){
				$s_inv = str_replace(",", "<br>", $row_quote_doc["inv_no"]);
			}

			$f_amount = floatval($row_quote_doc["uprice"])*intval($row_quote_doc["qty"]);
			$f_comm = ($f_amount*intval(str_replace("%", "", $row_quote_doc["comm_percent"])))/100;

			?>
			<td>
				<div class="cnt_inv" id="d_inv<?php echo $row_quote_doc["qdoc_id"]; ?>"><?php echo $s_inv; ?></div>
			</td>
			<td style="text-align: left;"><?php echo $row_quote_doc["pro_name"]; ?></td>
			<?php if($desc_show=="yes"){ ?>
			<td style="text-align: left;"><?php echo $row_quote_doc["pro_desc"]; ?></td>
			<?php } ?>
			<td><?php echo $row_quote_doc["qty"]; ?></td>
			<td><?php echo $row_quote_doc["uprice"]; ?></td>
			<td><?php echo number_format($f_amount,2); ?></td>
			<td><?php echo $row_quote_doc["comm_percent"]; ?></td>
			<td><?php echo number_format($f_comm,2); ?></td>
		</tr>
	<?php
		$n_count++;
	}
	?>

</table>

