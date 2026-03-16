<style type="text/css">
.tbl_content th{
	background-color: #339;
	color: #FFF;
	padding: 5px;
	text-align: center;
	border:1px solid #AAF;
}
.tbl_content tr{
	border-bottom: 1px solid #EEE;
}
.tbl_content tr:hover td{
	background-color: #DDD;
}
.tbl_content td{
	padding: 5px;
	text-align: center;
	border:1px solid #AAF;
}
.btn_more{
	color: #00F;
	text-decoration: underline;
	cursor: pointer;
}
.more_info{
	font-size: 14px;
}
.btn_search{
	color: #000;
	background-color: #AFF;
	border:2px solid #599;
	cursor: pointer;
	border-radius: 5px;
}
.btn_search:hover{
	border-color: #8CC;
}
.btn_search:active{
	background-color: #7AA;
	color: #EEE;
}
</style>

<?php
$user_group = Yii::app()->user->getState('userGroup');
$user_id = Yii::app()->user->getState('userKey');

$y_select = isset($_GET["y"])?intval($_GET["y"]):0;
$m_select = isset($_GET["m"])?intval($_GET["m"]):0;
$u_select = isset($_GET["u"])?intval($_GET["u"]):0;

$s_value = isset($_GET["s"])?base64_decode($_GET["s"]):"";
?>
<div class="row">



	<div class="col-md-12 col-sm-12 col-xs-12">

		<div class="x_panel">

			<div class="x_title">
				<h2 style="float: left;">
					Quotation > <?php echo $page_title; ?>
				</h2>
				<div style="float: left; margin-left: 30px; margin-top: 5px;">
					 Year: <select id="y_select" onchange="changeConditionSearch2();">
					 	<option value="0">=All=</option>
					 	<?php
					 	for($i=intval(date("Y"));$i>=2020;$i--){
					 		echo '<option value="'.$i.'" ';
					 		if( $y_select==$i ){
					 			echo "selected";
					 		}
					 		echo '>'.$i.'</option>';
					 	}
					 	?>
					 </select> 
					 Month: <select id="m_select" onchange="changeConditionSearch2();">
					 	<option value="0">=All=</option>
					 	<?php
					 	for($k=1;$k<=12;$k++){

					 		echo '<option value="'.$k.'" ';
					 		if( $m_select==$k ){
					 			echo "selected";
					 		}
					 		echo '>'.date("F",strtotime("2020-$k-01")).'</option>';
					 	}
					 	?>
					 </select> 
					 User: <select id="u_select" onchange="changeConditionSearch2();">
					 	<option value="0">==All==</option>
					 	<?php
					 	if(sizeof($a_user)>0){

					 		$tmp_group = "0";
					 		$count_u = 0;

						 	foreach($a_user as $tmp_key => $user_row){

						 		if( $user_row["user_group_id"]!=$tmp_group ){
						 			$tmp_group = $user_row["user_group_id"];
						 			$show_group = "";
						 			switch($tmp_group){
						 				case "1": $show_group = "Admin"; break;
						 				case "2": $show_group = "Sales Direct"; break;
						 				case "3": $show_group = "Sales Dealers"; break;
						 				case "4": $show_group = "Dealers"; break;
						 			}
						 			if($count_u>0){
						 				echo '</optgroup>';
						 			}
						 			echo '<optgroup label="'.$show_group.'">';
						 		}
						 		echo '<option value="'.$user_row["id"].'" ';
						 		if( $u_select==intval($user_row["id"]) ){
						 			echo "selected";
						 		}
						 		echo '>'.$user_row["fullname"].'</option>';

						 		$count_u++;
						 	}

						 	echo '</optgroup>';

						 }
					 	?>
					 </select>
					 &nbsp;&nbsp;&nbsp;
					 <input type="text" id="search_val" value="<?php echo $s_value; ?>" onkeypress="if(event.keyCode==13){ changeConditionSearch(); } "> <button type="button"  class="btn_search" onclick="return changeConditionSearch();">Search</button>
				</div>
				<div style="float:right; width: 25%; text-align: right;">
					Found <font color=blue><?php echo number_format($num_data); ?></font> rows.
					<br>
					<input type="hidden" id="show_have_inv_value" value="<?php echo $have_inv_show; ?>">
					<input type="checkbox" id="chk_show_have_inv" <?php if($have_inv_show=="yes"){ echo "checked"; } ?> onclick="changeShowHaveINV();">
					Added INV No. | 
					<input type="hidden" id="show_desc_value" value="<?php echo $desc_show; ?>">
					<input type="checkbox" id="chk_show_desc" <?php if($desc_show=="yes"){ echo "checked"; } ?> onclick="changeShowDESC();">
					Show description | 
					<b>Page:</b> 
					<select id="page_select" onchange="changeConditionSearch();">
						<?php
						for($i=1;$i<=$num_page;$i++){
							echo '<option value="'.$i.'" ';
							if($i==$page){
								echo 'selected';
							}
							echo '>'.$i.'</option>';
						}
						?>
					</select> / <?php echo $num_page; ?>

				</div>
				<a class="btn btn-success" style="float: right;" onclick="return $('#form_download_xls').submit();">Download Excel</a>
					
				
				<div class="clearfix"></div>

			</div>

			<div class="x_content">

				<table class="tbl_content" style="width: 100%;">
					<tr>
						<th>#</th><th>Request by</th><th>Estimate Number</th><th>Invoice No.</th><th style="text-align: left;">Customer</th>
						<th>Estimate Date</th><th>EXP. Date</th><th>Currency</th><th>Status</th>
						<th>Product</th>
						<?php if($desc_show=="yes"){ ?>
						<th>Description</th>
						<?php } ?>
						<th>QTY</th><th>Price</th><th>Amount</th><th>Comm.%</th><th>Comm.</th>
					</tr>
					<?php
					$n_count = (($page-1)*$data_per_page)+1;
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
							<td style="text-align: left;"><?php echo $row_quote_doc["cust_name"]; ?></td>
							<td><?php echo date("M. d, Y",strtotime($row_quote_doc["est_date"])); ?></td>
							<td><?php echo date("M. d, Y",strtotime($row_quote_doc["exp_date"])); ?></td>
							<td><?php echo $row_quote_doc["quote_curr"]; ?></td>
							<td style="width: 110px;"><?php echo $show_status; ?></td>
							<td style="text-align: left;"><?php echo $row_quote_doc["pro_name"]; ?></td>
							<?php if($desc_show=="yes"){ ?>
							<td style="text-align: left;"><?php echo shortDesc($n_count,$row_quote_doc["pro_desc"]); ?></td>
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

			</div>

		</div>

	</div>	

</div>	
<form id="form_download_xls" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/quotation/commReportXLS" target="_blank">
	<input type="hidden" name="with_desc" id="with_desc" value="<?php echo $desc_show; ?>">
	<input type="hidden" name="with_have_inv" id="with_have_inv" value="<?php echo $have_inv_show; ?>">
	<input type="hidden" name="y_select" value="<?php echo $y_select; ?>">
	<input type="hidden" name="m_select" value="<?php echo $m_select; ?>">
	<input type="hidden" name="u_select" value="<?php echo $u_select; ?>">
	<input type="hidden" name="s_value" value="<?php echo $s_value; ?>">
</form>
<script type="text/javascript">

function changeConditionSearch2(){
	$('#page_select').val(1);
	changeConditionSearch();
}

function changeConditionSearch(){

	var desc_show = $('#show_desc_value').val();
	var have_inv_show = $('#show_have_inv_value').val();
	var page_select = $('#page_select').val();

	var y_select = $('#y_select').val();
	var m_select = $('#m_select').val();
	var u_select = $('#u_select').val();

	var search_word = window.btoa($('#search_val').val());

	window.location.href = "<?php echo Yii::app()->request->baseUrl; ?>/quotation/commReport?desc_show="+desc_show+"&have_inv_show="+have_inv_show+"&page="+page_select+"&y="+y_select+"&m="+m_select+"&u="+u_select+"&s="+search_word;

}

function changeShowDESC(){

	var show_desc_value = $('#show_desc_value').val();
	if(show_desc_value=="yes"){
		desc_show = "no";
	}else{
		desc_show = "yes";
	}
	
	var have_inv_show = $('#show_have_inv_value').val();

	var y_select = $('#y_select').val();
	var m_select = $('#m_select').val();
	var u_select = $('#u_select').val();

	var page_select = $('#page_select').val();
	window.location.href = "<?php echo Yii::app()->request->baseUrl; ?>/quotation/commReport?desc_show="+desc_show+"&have_inv_show="+have_inv_show+"&page="+page_select+"&y="+y_select+"&m="+m_select+"&u="+u_select;

}

function changeShowHaveINV(){

	var show_have_inv_value = $('#show_have_inv_value').val();
	if(show_have_inv_value=="yes"){
		have_inv_show = "no";
	}else{
		have_inv_show = "yes";
	}

	var desc_show = $('#show_desc_value').val();
	
	var y_select = $('#y_select').val();
	var m_select = $('#m_select').val();
	var u_select = $('#u_select').val();

	var page_select = $('#page_select').val();
	window.location.href = "<?php echo Yii::app()->request->baseUrl; ?>/quotation/commReport?desc_show="+desc_show+"&have_inv_show="+have_inv_show+"&page="+page_select+"&y="+y_select+"&m="+m_select+"&u="+u_select;
}

function showMoreDESC(row_id){
	$('#sp_desc_more'+row_id).hide();
	$('#sp_desc'+row_id).show();
}

</script>
<?php

function shortDesc($row_id,$long_desc){
	$length_of_str = 75;

	$return_str = "";

	if(strlen($long_desc)>$length_of_str){
		$return_str = substr($long_desc, 0,80);
		$return_str .= '<span id="sp_desc_more'.$row_id.'" class="btn_more" onclick="return showMoreDESC('.$row_id.');"><br>More..</span>';
		$return_str .= '<span id="sp_desc'.$row_id.'" style="display:none;" class="more_info">'.substr($long_desc, 80,(strlen($long_desc)-80)).'</span>';
	}else{
		$return_str = $long_desc;
	}

	return $return_str;

}

?>