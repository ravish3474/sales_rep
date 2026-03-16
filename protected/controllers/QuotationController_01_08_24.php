<?php

class QuotationController extends AuthController
{

	public function actionIndex()
	{
		/*$result['model'] = new Upload;
		$result['files'] = Upload::model()->findAll();*/
		$this->render('index');
	}
	 
	public function actionSplitcomm()
	{
		$sale1 = $_POST['sales_rep_1'];
		$sale2 = $_POST['sales_rep_2'];
		$split_comm_percent1 = $_POST['split_comm_percent1'];
		$split_comm_percent2 = $_POST['split_comm_percent2'];
		$qdoci_id = $_POST['qdoci_id'];

		$total_value = $split_comm_percent1 + $split_comm_percent2;

		$sql_update = "UPDATE tbl_quote_item SET `comm_percent`='$total_value', `split_sales_1`='$sale1',`split_comm_1`='$split_comm_percent1',`split_sales_2`='$sale2',`split_comm_2`='$split_comm_percent2' WHERE qdoci_id='$qdoci_id';";

		if (Yii::app()->db->createCommand($sql_update)->execute()) {
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to update split.";
		}

		echo json_encode($a_result);
	}
	
	public function actionUpdatecreditcard(){
        $conv_id =  $_POST['conv_id'];
        $credit_value =  $_POST['credit_card_3'];
        if ($credit_value == 1) {           
            $sql = "UPDATE `quotation_data` SET `credit_card_3`= $credit_value WHERE `conv_id` = $conv_id";
        }else {
            $sql = "UPDATE `quotation_data` SET `credit_card_3`= 0 WHERE `conv_id` = $conv_id";
        }
        Yii::app()->db->createCommand($sql)->execute();
    }

	public function actionUpdateCustomerInModal()
	{
		$cust_id = $_POST['cust_selector'];
		$qdoc_id = $_POST['qdoc_id'];
		$sql = "SELECT * FROM tbl_cust_info WHERE cust_id='$cust_id'";
		$a_cust = Yii::app()->db->createCommand($sql)->queryAll();
		$cust_name = addslashes($a_cust[0]['cust_name']);
		$cust_info = addslashes($a_cust[0]['cust_info']);
		$update = "UPDATE tbl_quote_doc SET cust_name='$cust_name',cust_info='$cust_info',cust_id='$cust_id' WHERE qdoc_id='$qdoc_id'";
		Yii::app()->db->createCommand($update)->execute();
		$update2 = "UPDATE tbl_quote_doc_admin SET cust_name='$cust_name',cust_info='$cust_info',cust_id='$cust_id' WHERE qdoc_id='$qdoc_id'";
		Yii::app()->db->createCommand($update2)->execute();
		die(json_encode(array('status' => 1, 'cust_name' => $cust_name, 'cust_info' => $cust_info, 'cust_id' => $cust_id, 'qdoc_id' => $qdoc_id)));
	}

	public function actionGetCustomerList()
	{
		$cust_id = $_POST['cust_id'];
		$return_html .= '<select id="cust_selector" name="cust_selector" ><option value="">=Select Customer=</option>';
		$user_group = Yii::app()->user->getState('userGroup');
		$user_id = Yii::app()->user->getState('userKey');

		$more_condition = "";
		if ($user_group != "1" && $user_group != "99") {

			$more_condition = " AND user_id='" . $user_id . "' ";
		}
		$sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 " . $more_condition . " ORDER BY cust_name ASC; ";
		$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();
		$custom_selector = "";
		foreach ($a_cust as $tmp_key => $row_cust) {
			if ($cust_id == $row_cust['cust_id']) {
				$custom_selector = "selected";
			}
			$return_html .= '<option ' . $custom_selector . ' value="' . $row_cust["cust_id"] . '">' . $row_cust["cust_name"] . '</option>';
			$custom_selector = "";
		}
		$return_html .= '</select>';
		echo $return_html;
	}

	public function actionUpdateCustomerInfoQuote()
	{
		$qdoc_id = $_POST['qdoc_id'];
		$cust_id = $_POST['edit_cust_id_live'];
		$cust_info = addslashes($_POST['edit_cust_info']);
		$sql = "UPDATE tbl_quote_doc SET cust_info='$cust_info' WHERE qdoc_id='$qdoc_id'";
		Yii::app()->db->createCommand($sql)->execute();
		$sql3 = "UPDATE tbl_quote_doc_admin SET cust_info='$cust_info' WHERE qdoc_id='$qdoc_id'";
		Yii::app()->db->createCommand($sql3)->execute();
		$sql2 = "UPDATE tbl_cust_info SET cust_info='$cust_info' WHERE cust_id='$cust_id'";
		Yii::app()->db->createCommand($sql2)->execute();
		die(json_encode(array('status' => '1')));
	}

	public function actionUpdateCustomerInfo()
	{
		$qdoc_id = $_POST['qdoc_id'];
		$cust_id = $_POST['cust_id'];
		$cust_name = addslashes($_POST['cust_name']);
		$cust_info = addslashes($_POST['cust_info']);
		$sql = "UPDATE tbl_quote_doc SET cust_id='$cust_id',cust_name='$cust_name',cust_info='$cust_info' WHERE qdoc_id='$qdoc_id'";
		Yii::app()->db->createCommand($sql)->execute();
		die(json_encode(array('status' => '1')));
	}

	public function actionApproveOnlineStore()
	{
		$conv_id = $_POST['conv_id'];
	    $sql = "SELECT * FROM quotation_data WHERE conv_id='$conv_id'";
	    $data = Yii::app()->db->createCommand($sql)->queryRow();
	    $ex_code = $data['jog_code'];
	    $file_name = $data['online_store'];
	    $main_data = "SELECT * FROM order_main WHERE order_main_code='$ex_code'";
	    $new_data = Yii::app()->db2->createCommand($main_data)->queryRow();
	    $order_main_id = $new_data['order_main_id'];
	    $currentDateTime = date('Y-m-d H:i:s');
	    $ins = "INSERT INTO `order_main_file`(`order_main_id`, `order_main_file_name`, `order_main_file_title`, `order_main_file_type`, `order_main_file_user`, `order_main_file_date`) VALUES ('$order_main_id','$file_name','$ex_code','Online Store Report','8','$currentDateTime')";
	    Yii::app()->db2->createCommand($ins)->execute();
	    
		$sql = "UPDATE quotation_data SET conv_status='2' WHERE conv_id='$conv_id'";
		Yii::app()->db->createCommand($sql)->execute();
		

		die(json_encode(array('status' => '1')));
	}

	public function actionApproveCommission()
	{
		$conv_id = $_POST['conv_id'];
		$sql = "UPDATE quotation_data SET comm_status='1' WHERE conv_id='$conv_id'";
		Yii::app()->db->createCommand($sql)->execute();
		die(json_encode(array('status' => '1')));
	}

	public function actionUploadFreebies()
	{
		$qdoc_id = $_POST['main_conv_id'];
		$old_sql = "SELECT design_name FROM tbl_quote_doc WHERE qdoc_id = '$qdoc_id'";
		$old_query = Yii::app()->db->createCommand($old_sql)->queryAll();
		$design_name = $old_query[0]["design_name"];
		if ($design_name != "") {
			$all_desig = explode(',', $design_name);
			foreach ($all_desig as $des) {
				@unlink(Yii::getPathOfAlias('webroot') . '/upload/new_design/' . $des);
			}
		}
		$file_name = array();
		if (isset($_FILES['files_name']['name']) || isset($_POST['notes_admin'])) {
			if ($_FILES['files_name']['name'][0] != "") {
				for ($i = 0; $i < count($_FILES['files_name']['name']); $i++) {
					$sourcePath = $_FILES['files_name']['tmp_name'][$i];
					$newfile = time() . "-" . $_FILES['files_name']['name'][$i]; //any name sample.jpg
					$targetPath = Yii::getPathOfAlias('webroot') . '/upload/new_design/' . $newfile;
					if (move_uploaded_file($sourcePath, $targetPath)) {
						$file_name[] = $newfile;
					}
				}
				$all_files = implode(',', $file_name);
				$notes_admin = $_POST['notes_admin'];
				$sql = "UPDATE tbl_quote_doc SET design_name='$all_files',design_note='$notes_admin' WHERE qdoc_id='$qdoc_id'";
				if (Yii::app()->db->createCommand($sql)->execute()) {
					die(json_encode(array('status' => 1)));
				} else {
					die(json_encode(array('status' => 2)));
				}
			} else {
				$notes_admin = $_POST['notes_admin'];
				$sql = "UPDATE tbl_quote_doc SET design_note='$notes_admin' WHERE qdoc_id='$qdoc_id'";
				Yii::app()->db->createCommand($sql)->execute();
				die(json_encode(array('status' => 1)));
			}
		} else {
			die(json_encode(array('status' => 0)));
		}
	}

	// 	public function actionConvEstimate(){
	// 	    $strDate = date("Y-m-d H:i:s");
	// 	    $codes = $_POST['codes'];
	// 	    $codes_new = implode(',',$codes);
	// 	    $sales_quote_name = $_POST['sales_quote_name'];
	// 	    $sales_quote_id = $_POST['sales_quote_id'];
	// 	    $qdoci_id = $_POST['qdoci_id'];
	// 	    $conversion_notes = $_POST['conversion_notes'];
	// 	    if($_POST['college']=="No"){
	//     	    $sql = "INSERT INTO `quotation_data`(`qdoci_id`, `jog_code`, `conv_by`, `conv_by_id`, `conv_notes`, `conv_date`, `conv_status`) VALUES ('$qdoci_id','$codes_new','$sales_quote_name','$sales_quote_id','$conversion_notes','$strDate','1')";
	//     	        Yii::app()->db->createCommand($sql)->execute();
	// 	    }
	// 	    else{
	// 	        $college_name = "";
	// 	        $licensing_company = 0;
	// 	        $royalty_bearing = 0;
	// 	        $non_royalty_bearing = 0;
	// 	        $no_report = 0;
	// 	        if(isset($_POST['college_name'])){
	// 	            $college_name = $_POST['college_name'];
	// 	        }
	// 	        if(isset($_POST['licensing_company'])){
	// 	            $licensing_company = 1;
	// 	        }
	// 	        if(isset($_POST['royalty_bearing'])){
	// 	            $royalty_bearing = 1;
	// 	        }
	// 	        if(isset($_POST['non_royalty_bearing'])){
	// 	            $non_royalty_bearing = 1;
	// 	        }
	// 	        if(isset($_POST['no_report'])){
	// 	            $no_report = 1;
	// 	        }
	// 	        $sql = "INSERT INTO `quotation_data`(`qdoci_id`, `jog_code`, `conv_by`, `conv_by_id`, `conv_notes`, `conv_date`, `conv_status`,`collegiate`, `college_name`, `licensing_company`, `royalty_bearing`, `non_royalty_bearing`, `no_report`) VALUES ('$qdoci_id','$codes_new','$sales_quote_name','$sales_quote_id','$conversion_notes','$strDate','1','1','$college_name','$licensing_company','$royalty_bearing','$non_royalty_bearing','$no_report')";
	//     	        Yii::app()->db->createCommand($sql)->execute();
	// 	    }
	// 	    $update = "UPDATE tbl_quote_doc SET conversion_status=1 WHERE qdoc_id='$qdoci_id'";
	// 	    Yii::app()->db->createCommand($update)->execute();
	// 	    die(json_encode(array('status'=>'1')));

	// 	}

	public function actionConvEstimate()
	{
		$strDate = date("Y-m-d H:i:s");
		$codes = $_POST['codes'];
		$codes_new = implode(',', $codes);
		$sales_quote_name = $_POST['sales_quote_name'];
		$sales_quote_id = $_POST['sales_quote_id'];
		$qdoci_id = $_POST['qdoci_id'];
		$conversion_notes = addslashes($_POST['conversion_notes']);

		$isCollege = ($_POST['college'] == "No") ? false : true;

		$isSplit = ($_POST['split_comm'] == "No") ? false : true;
		if ($isSplit) {
			$sales_id = implode(",", $_POST['sales_rep_name']);
			$sales_percent = implode(",", $_POST['sales_percent']);
		} else {
			$sales_id = "";
			$sales_percent = "";
		}

		$commonValues = [
			'qdoci_id' => $qdoci_id,
			'jog_code' => $codes_new,
			'conv_by' => $sales_quote_name,
			'conv_by_id' => $sales_quote_id,
			'conv_notes' => $conversion_notes,
			'conv_date' => $strDate,
			'conv_status' => '1',
			'credit_net_30' => isset($_POST['credit_net_30']) ? 1 : 0,
			'full_payment_b4_ship' => isset($_POST['full_payment_b4_ship']) ? 1 : 0,
			'50_down_payment' => isset($_POST['50_down_payment']) ? 1 : 0,
			'credit_card_3' => isset($_POST['credit_card_3']) ? 1 : 0,
		];

		$collegeValues = [
			'collegiate' => '1',
			'college_name' => isset($_POST['college_name']) ? $_POST['college_name'] : '',
			'royalty_bearing' => isset($_POST['royalty_bearing']) ? 1 : 0,
			'non_royalty_bearing' => isset($_POST['non_royalty_bearing']) ? 1 : 0,
			'no_report' => isset($_POST['no_report']) ? 1 : 0,
		];

		$values = array_merge($commonValues, $isCollege ? $collegeValues : []);

		$sql = "INSERT INTO `quotation_data` (" . implode(", ", array_keys($values)) . ",sales_split_id,sales_split_percent) VALUES ('" . implode("', '", $values) . "','" . $sales_id . "','" . $sales_percent . "')";
		Yii::app()->db->createCommand($sql)->execute();

		$update = "UPDATE tbl_quote_doc SET conversion_status=1 WHERE qdoc_id='$qdoci_id'";
		Yii::app()->db->createCommand($update)->execute();

		die(json_encode(['status' => '1']));
	}


    public function actionConvEstimateOnline()
	{
		$name_file = "";
		if (isset($_FILES['qdoci_id']) && !empty($_FILES['qdoci_id']['name'])) {
	
			$originalName = $_FILES["qdoci_id"]["name"];
			$extension = pathinfo($originalName, PATHINFO_EXTENSION);
			$name_file = time() . '_' . uniqid() . '.' . $extension;
	
			if (move_uploaded_file($_FILES["qdoci_id"]["tmp_name"], Yii::getPathOfAlias('webroot') . '/upload/samples/' . $name_file)) {
				// File successfully uploaded
			}
		}
	
		$sales_summmary = "";
		if (isset($_FILES['sales_summmary']) && !empty($_FILES['sales_summmary']['name'])) {
	
			$originalName = $_FILES["sales_summmary"]["name"];
			$extension = pathinfo($originalName, PATHINFO_EXTENSION);
			$sales_summmary = time() . '_' . uniqid() . '.' . $extension;
	
			if (move_uploaded_file($_FILES["sales_summmary"]["tmp_name"], Yii::getPathOfAlias('webroot') . '/upload/samples/' . $sales_summmary)) {
				// File successfully uploaded
			}
		}
		
		$strDate = date("Y-m-d H:i:s");
		$codes = $_POST['codes'];
		$sales_quote_name = $_POST['sales_quote_name'];
		$sales_quote_id = $_POST['sales_quote_id'];
		$conversion_notes = $_POST['conversion_notes'];
		$online_store_name = $_POST['online_store_name'];
		$store_link = $_POST['store_link'];
		$store_name = $_POST['store_name'];
		
		foreach ($codes as $data) {
			$sql = "INSERT INTO `quotation_data`(`jog_code`, `conv_by`, `conv_by_id`, `conv_notes`, `conv_date`, `conv_status`, `online_store`, `online_store_name`, `sales_summary`, `store_link`, `store_name`) VALUES ('$data','$sales_quote_name','$sales_quote_id','$conversion_notes','$strDate','1','$name_file','$online_store_name','$sales_summmary','$store_link','$store_name')";
			Yii::app()->db->createCommand($sql)->execute();
		}
		
		die(json_encode(array('status' => '1')));
	}

	public function actionCheckExistingQuote()
	{
		$qdoci_id = $_POST['qdoci_id'];
		$sql = "SELECT * FROM quotation_data WHERE qdoci_id='$qdoci_id'";
		$a_count = Yii::app()->db->createCommand($sql)->queryAll();
		if (count($a_count) > 0) {
			die(json_encode(array('status' => 1)));
		} else {
			die(json_encode(array('status' => 0)));
		}
	}

	public function actionSearchList()
	{
		$user_group = Yii::app()->user->getState('userGroup');
		$user_id = Yii::app()->user->getState('userKey');

		$more_condition = "";
		if ($user_group != "1" && $user_group != "99") {

			$more_condition = " AND tbl_quote_doc.user_id='" . $user_id . "' ";
		}

		$result['search'] = "";
		if (isset($_REQUEST["search"]) && ($_REQUEST["search"] != "")) {

			$search_word = "";
			if (isset($_GET["search"])) {
				$search_word = base64_decode($_GET["search"]);
			} else {
				$search_word = $_POST["search"];
			}

			$more_condition .= " AND (cust_name LIKE '%" . addslashes($search_word) . "%' OR fullname LIKE '%" . addslashes($search_word) . "%' OR est_number LIKE '%" . addslashes($search_word) . "%') ";
			$result['search'] = $search_word;
		}

		$data_per_page = 50;

		$page = 1;

		if (isset($_GET["page"]) && ($_GET["page"] != "")) {
			$page = intval($_GET["page"]);
		}
		$start_index = ($page - 1) * $data_per_page;

		$result['act_page'] = "searchList";
		$result['data_per_page'] = $data_per_page;
		$result['page'] = $page;

		$sql_count = "SELECT COUNT(DISTINCT tbl_quote_doc.qdoc_id) AS num_data FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id LEFT JOIN tbl_quote_item ON tbl_quote_doc.qdoc_id=tbl_quote_item.qdoc_id WHERE tbl_quote_doc.enable=1 AND tbl_quote_item.enable=1 " . $more_condition . "; ";
		$a_count = Yii::app()->db->createCommand($sql_count)->queryAll();
		$num_data = $a_count[0]["num_data"];

		$result['num_data'] = $num_data;
		$result['num_page'] = intval($num_data / $data_per_page);
		if (($num_data % $data_per_page) > 0) {
			$result['num_page']++;
		}

// 		$sql = " SELECT tbl_quote_doc.*,user.fullname,SUM(tbl_quote_item.qty) AS sum_qty FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id LEFT JOIN tbl_quote_item ON tbl_quote_doc.qdoc_id=tbl_quote_item.qdoc_id WHERE tbl_quote_doc.enable=1 AND tbl_quote_item.enable=1 " . $more_condition . " GROUP BY tbl_quote_doc.qdoc_id ORDER BY tbl_quote_doc.is_duplicate DESC, tbl_quote_doc.is_editing DESC, tbl_quote_doc.add_date DESC LIMIT " . $start_index . "," . $data_per_page . ";";

        $sql = "SELECT
                tbl_quote_doc.*,
                user.fullname,
                SUM(tbl_quote_item.qty) AS sum_qty,
                (SELECT COUNT(*) FROM quotation_data WHERE qdoci_id = tbl_quote_doc.qdoc_id) AS quotation_data_count,
                (SELECT est_number FROM tbl_quote_doc AS dup_doc WHERE dup_doc.qdoc_id = tbl_quote_doc.dup_from_id AND tbl_quote_doc.dup_from_id != 0) AS old_est_num
            FROM
                tbl_quote_doc
            LEFT JOIN user ON tbl_quote_doc.user_id = user.id
            LEFT JOIN tbl_quote_item ON tbl_quote_doc.qdoc_id = tbl_quote_item.qdoc_id
            WHERE
                tbl_quote_doc.enable = 1
                AND tbl_quote_item.enable = 1
                $more_condition
            GROUP BY
                tbl_quote_doc.qdoc_id
            ORDER BY
                tbl_quote_doc.is_editing DESC,
                tbl_quote_doc.add_date DESC
            LIMIT
                $start_index, $data_per_page;
            ";
		$result['quote_doc'] = Yii::app()->db->createCommand($sql)->queryAll();

		$sql2 = " SELECT * FROM tbl_quote_note WHERE enable=1 ORDER BY qnote_name ASC;";
		$result['quote_note'] = Yii::app()->db->createCommand($sql2)->queryAll();

		$result['page_title'] = "Search result";
		$result['head_color'] = "#559";

		$this->render('new_request', $result);
	}

	public function actionNewRequest()
	{
		$user_group = Yii::app()->user->getState('userGroup');
		$user_id = Yii::app()->user->getState('userKey');

		$more_condition = "";
		if ($user_group != "1" && $user_group != "99") {

			$more_condition = " AND tbl_quote_doc.user_id='" . $user_id . "' ";
		}

		$result['search'] = "";
		if (isset($_REQUEST["search"]) && ($_REQUEST["search"] != "")) {

			$search_word = "";
			if (isset($_GET["search"])) {
				$search_word = base64_decode($_GET["search"]);
			} else {
				$search_word = $_POST["search"];
			}

			$more_condition .= " AND (cust_name LIKE '%" . addslashes($search_word) . "%' OR fullname LIKE '%" . addslashes($search_word) . "%' OR est_number LIKE '%" . addslashes($search_word) . "%') ";
			$result['search'] = $search_word;
		}

		$data_per_page = 50;

		$page = 1;

		if (isset($_GET["page"]) && ($_GET["page"] != "")) {
			$page = intval($_GET["page"]);
		}
		$start_index = ($page - 1) * $data_per_page;

		$result['act_page'] = "newRequest";
		$result['data_per_page'] = $data_per_page;
		$result['page'] = $page;

		$sql_count = "SELECT COUNT(DISTINCT tbl_quote_doc.qdoc_id) AS num_data FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id LEFT JOIN tbl_quote_item ON tbl_quote_doc.qdoc_id=tbl_quote_item.qdoc_id WHERE tbl_quote_doc.enable=1 AND tbl_quote_item.enable=1 AND tbl_quote_doc.approve_status='new' " . $more_condition . "; ";
		$a_count = Yii::app()->db->createCommand($sql_count)->queryAll();
		$num_data = $a_count[0]["num_data"];

		$result['num_data'] = $num_data;
		$result['num_page'] = intval($num_data / $data_per_page);
		if (($num_data % $data_per_page) > 0) {
			$result['num_page']++;
		}

		// 		$sql = " SELECT tbl_quote_doc.*,user.fullname,SUM(tbl_quote_item.qty) AS sum_qty FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id LEFT JOIN tbl_quote_item ON tbl_quote_doc.qdoc_id=tbl_quote_item.qdoc_id WHERE tbl_quote_doc.enable=1 AND tbl_quote_item.enable=1 AND tbl_quote_doc.approve_status='new' ".$more_condition." GROUP BY tbl_quote_doc.qdoc_id ORDER BY add_date DESC LIMIT ".$start_index.",".$data_per_page.";";

		$sql = "SELECT 
            tbl_quote_doc.*,
            user.fullname,
            SUM(tbl_quote_item.qty) AS sum_qty,
            COALESCE(dup_doc.est_number, '') AS old_est_num
        FROM 
            tbl_quote_doc
        LEFT JOIN 
            user ON tbl_quote_doc.user_id = user.id
        LEFT JOIN 
            tbl_quote_item ON tbl_quote_doc.qdoc_id = tbl_quote_item.qdoc_id
        LEFT JOIN 
            tbl_quote_doc AS dup_doc ON tbl_quote_doc.dup_from_id = dup_doc.qdoc_id AND tbl_quote_doc.dup_from_id != 0
        WHERE 
            tbl_quote_doc.enable = 1 
            AND tbl_quote_item.enable = 1 
            AND tbl_quote_doc.approve_status = 'new' 
            " . $more_condition . "
        GROUP BY 
            tbl_quote_doc.qdoc_id
        ORDER BY 
            tbl_quote_doc.add_date DESC 
        LIMIT 
            " . $start_index . "," . $data_per_page . ";";
		$result['quote_doc'] = Yii::app()->db->createCommand($sql)->queryAll();

		$sql2 = " SELECT * FROM tbl_quote_note WHERE enable=1 ORDER BY qnote_name ASC;";
		$result['quote_note'] = Yii::app()->db->createCommand($sql2)->queryAll();

		$result['page_title'] = "New Request List";
		$result['head_color'] = "#995";

		$this->render('new_request', $result);
	}

	// 	public function actionApproveList()
	// 	{
	// 		$user_group = Yii::app()->user->getState('userGroup');
	// 		$user_id = Yii::app()->user->getState('userKey');

	// 		$more_condition = "";
	// 		if( $user_group!="1" && $user_group!="99" ){

	// 			$more_condition = " AND tbl_quote_doc.user_id='".$user_id."' ";
	// 		}


	// 		$result['search'] = "";
	// 		if( isset($_REQUEST["search"]) && ($_REQUEST["search"]!="") ){

	// 			$search_word = "";
	// 			if(isset($_GET["search"])){
	// 				$search_word = base64_decode($_GET["search"]);
	// 			}else{
	// 				$search_word = $_POST["search"];
	// 			}

	// 			$more_condition .= " AND (cust_name LIKE '%".addslashes($search_word)."%' OR inv_no LIKE '%".addslashes($search_word)."%' OR fullname LIKE '%".addslashes($search_word)."%' OR est_number LIKE '%".addslashes($search_word)."%') ";
	// 			$result['search'] = $search_word;
	// 		}

	// 		$data_per_page = 50;

	// 		$page = 1;

	// 		if( isset($_GET["page"]) && ($_GET["page"]!="") ){
	// 			$page = intval($_GET["page"]);
	// 		}
	// 		$start_index = ($page-1)*$data_per_page;

	// 		$result['act_page'] = "approveList";
	// 		$result['data_per_page'] = $data_per_page;
	// 		$result['page'] = $page;

	// 		$sql_count = "SELECT COUNT(DISTINCT tbl_quote_doc.qdoc_id) AS num_data FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id LEFT JOIN tbl_quote_item ON tbl_quote_doc.qdoc_id=tbl_quote_item.qdoc_id WHERE tbl_quote_doc.enable=1 AND tbl_quote_item.enable=1 AND tbl_quote_doc.approve_status='approve' AND tbl_quote_doc.archive=0 ".$more_condition."; ";
	// 		$a_count = Yii::app()->db->createCommand($sql_count)->queryAll();
	// 		$num_data = $a_count[0]["num_data"];

	// 		$result['num_data'] = $num_data;
	// 		$result['num_page'] = intval($num_data/$data_per_page);
	// 		if(($num_data%$data_per_page)>0){ $result['num_page']++; }

	// 		//echo "<hr>num_data=".$sql_count."<hr>";
	// 		$sql = " SELECT tbl_quote_doc.*,user.fullname,SUM(tbl_quote_item.qty) AS sum_qty FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id LEFT JOIN tbl_quote_item ON tbl_quote_doc.qdoc_id=tbl_quote_item.qdoc_id WHERE tbl_quote_doc.enable=1 AND tbl_quote_item.enable=1 AND tbl_quote_doc.approve_status='approve' AND tbl_quote_doc.archive='0' ".$more_condition." GROUP BY tbl_quote_doc.qdoc_id ORDER BY tbl_quote_doc.is_editing DESC,tbl_quote_doc.add_date DESC LIMIT ".$start_index.",".$data_per_page.";";
	// 		$result['quote_doc'] = Yii::app()->db->createCommand($sql)->queryAll();

	// 		$sql2 = " SELECT * FROM tbl_quote_note WHERE enable=1 ORDER BY qnote_name ASC;";
	// 		$result['quote_note'] = Yii::app()->db->createCommand($sql2)->queryAll();

	// 		$result['page_title'] = "Approved List";
	// 		$result['head_color'] = "#599";

	// 		$this->render('new_request',$result);//--- Use same view with New status
	// 	}

	public function actionApproveList()
	{
		$user_group = Yii::app()->user->getState('userGroup');
		$user_id = Yii::app()->user->getState('userKey');

		$more_condition = "";
		if ($user_group != "1" && $user_group != "99") {

			$more_condition = " AND tbl_quote_doc.user_id='" . $user_id . "' ";
		}


		$result['search'] = "";
		if (isset($_REQUEST["search"]) && ($_REQUEST["search"] != "")) {

			$search_word = "";
			if (isset($_GET["search"])) {
				$search_word = base64_decode($_GET["search"]);
			} else {
				$search_word = $_POST["search"];
			}

			$more_condition .= " AND (cust_name LIKE '%" . addslashes($search_word) . "%' OR inv_no LIKE '%" . addslashes($search_word) . "%' OR fullname LIKE '%" . addslashes($search_word) . "%' OR est_number LIKE '%" . addslashes($search_word) . "%') ";
			$result['search'] = $search_word;
		}

		$data_per_page = 50;

		$page = 1;

		if (isset($_GET["page"]) && ($_GET["page"] != "")) {
			$page = intval($_GET["page"]);
		}
		$start_index = ($page - 1) * $data_per_page;

		$result['act_page'] = "approveList";
		$result['data_per_page'] = $data_per_page;
		$result['page'] = $page;

		$sql_count = "SELECT COUNT(DISTINCT tbl_quote_doc.qdoc_id) AS num_data FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id LEFT JOIN tbl_quote_item ON tbl_quote_doc.qdoc_id=tbl_quote_item.qdoc_id WHERE tbl_quote_doc.enable=1 AND tbl_quote_item.enable=1 AND tbl_quote_doc.approve_status='approve' AND tbl_quote_doc.archive=0 " . $more_condition . "; ";
		$a_count = Yii::app()->db->createCommand($sql_count)->queryAll();
		$num_data = $a_count[0]["num_data"];

		$result['num_data'] = $num_data;
		$result['num_page'] = intval($num_data / $data_per_page);
		if (($num_data % $data_per_page) > 0) {
			$result['num_page']++;
		}

		//echo "<hr>num_data=".$sql_count."<hr>";
		// 		$sql = " SELECT tbl_quote_doc.*,user.fullname,SUM(tbl_quote_item.qty) AS sum_qty FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id LEFT JOIN tbl_quote_item ON tbl_quote_doc.qdoc_id=tbl_quote_item.qdoc_id WHERE tbl_quote_doc.enable=1 AND tbl_quote_item.enable=1 AND tbl_quote_doc.approve_status='approve' AND tbl_quote_doc.archive='0' ".$more_condition." GROUP BY tbl_quote_doc.qdoc_id ORDER BY tbl_quote_doc.is_editing DESC,tbl_quote_doc.add_date DESC LIMIT ".$start_index.",".$data_per_page.";";

		$sql = "SELECT
    tbl_quote_doc.*,
    user.fullname,
    SUM(tbl_quote_item.qty) AS sum_qty,
    (SELECT COUNT(*) FROM quotation_data WHERE qdoci_id = tbl_quote_doc.qdoc_id) AS quotation_data_count,
    (SELECT est_number FROM tbl_quote_doc AS dup_doc WHERE dup_doc.qdoc_id = tbl_quote_doc.dup_from_id AND tbl_quote_doc.dup_from_id != 0) AS old_est_num
FROM
    tbl_quote_doc
LEFT JOIN user ON tbl_quote_doc.user_id = user.id
LEFT JOIN tbl_quote_item ON tbl_quote_doc.qdoc_id = tbl_quote_item.qdoc_id
WHERE
    tbl_quote_doc.enable = 1
    AND tbl_quote_item.enable = 1
    AND tbl_quote_doc.approve_status = 'approve'
    AND tbl_quote_doc.archive = '0'
    $more_condition
GROUP BY
    tbl_quote_doc.qdoc_id
ORDER BY
    tbl_quote_doc.is_editing DESC,
    tbl_quote_doc.add_date DESC
LIMIT
    $start_index, $data_per_page;
";
		$result['quote_doc'] = Yii::app()->db->createCommand($sql)->queryAll();
		$sql2 = " SELECT * FROM tbl_quote_note WHERE enable=1 ORDER BY qnote_name ASC;";
		$result['quote_note'] = Yii::app()->db->createCommand($sql2)->queryAll();

		// 		$new_sql = 'SELECT * FROM quotation_data WHERE qdoci_id="'.$row_quote_doc["qdoc_id"].'"';
		// 		$query_check = Yii::app()->db->createCommand($new_sql)->queryAll();
		// $result['counter_edit'] = count($query_check);
		$result['page_title'] = "Approved List";
		$result['head_color'] = "#599";

		$this->render('new_request', $result); //--- Use same view with New status
	}

	public function actionRejectList()
	{
		$user_group = Yii::app()->user->getState('userGroup');
		$user_id = Yii::app()->user->getState('userKey');

		$more_condition = "";
		if ($user_group != "1" && $user_group != "99") {

			$more_condition = " AND tbl_quote_doc.user_id='" . $user_id . "' ";
		}


		$result['search'] = "";
		if (isset($_REQUEST["search"]) && ($_REQUEST["search"] != "")) {

			$search_word = "";
			if (isset($_GET["search"])) {
				$search_word = base64_decode($_GET["search"]);
			} else {
				$search_word = $_POST["search"];
			}

			$more_condition .= " AND (cust_name LIKE '%" . addslashes($search_word) . "%' OR fullname LIKE '%" . addslashes($search_word) . "%' OR est_number LIKE '%" . addslashes($search_word) . "%') ";
			$result['search'] = $search_word;
		}

		$data_per_page = 50;

		$page = 1;

		if (isset($_GET["page"]) && ($_GET["page"] != "")) {
			$page = intval($_GET["page"]);
		}
		$start_index = ($page - 1) * $data_per_page;

		$result['act_page'] = "rejectList";
		$result['data_per_page'] = $data_per_page;
		$result['page'] = $page;

		$sql_count = "SELECT COUNT(DISTINCT tbl_quote_doc.qdoc_id) AS num_data FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id LEFT JOIN tbl_quote_item ON tbl_quote_doc.qdoc_id=tbl_quote_item.qdoc_id WHERE tbl_quote_doc.enable=1 AND tbl_quote_doc.archive=0 AND tbl_quote_item.enable=1 AND tbl_quote_doc.approve_status='reject' " . $more_condition . "; ";
		$a_count = Yii::app()->db->createCommand($sql_count)->queryAll();
		$num_data = $a_count[0]["num_data"];

		$result['num_data'] = $num_data;
		$result['num_page'] = intval($num_data / $data_per_page);
		if (($num_data % $data_per_page) > 0) {
			$result['num_page']++;
		}

		$sql = "SELECT 
            tbl_quote_doc.*,
            user.fullname,
            SUM(tbl_quote_item.qty) AS sum_qty,
            COALESCE(dup_doc.est_number, '') AS old_est_num
        FROM 
            tbl_quote_doc
        LEFT JOIN 
            user ON tbl_quote_doc.user_id = user.id
        LEFT JOIN 
            tbl_quote_item ON tbl_quote_doc.qdoc_id = tbl_quote_item.qdoc_id
        LEFT JOIN 
            tbl_quote_doc AS dup_doc ON tbl_quote_doc.dup_from_id = dup_doc.qdoc_id AND tbl_quote_doc.dup_from_id != 0
        WHERE 
            tbl_quote_doc.enable = 1 
            AND tbl_quote_item.enable = 1 
            AND tbl_quote_doc.approve_status = 'reject' 
            " . $more_condition . "
        GROUP BY 
            tbl_quote_doc.qdoc_id
        ORDER BY 
            tbl_quote_doc.add_date DESC 
        LIMIT 
            " . $start_index . "," . $data_per_page . ";";
		$result['quote_doc'] = Yii::app()->db->createCommand($sql)->queryAll();

		$sql2 = " SELECT * FROM tbl_quote_note WHERE enable=1 ORDER BY qnote_name ASC;";
		$result['quote_note'] = Yii::app()->db->createCommand($sql2)->queryAll();

		$result['page_title'] = "Rejected List";
		$result['head_color'] = "#959";

		$this->render('new_request', $result); //--- Use same view with New status
	}

	public function actionArchived()
	{
		$user_group = Yii::app()->user->getState('userGroup');
		$user_id = Yii::app()->user->getState('userKey');

		$more_condition = "";
		if ($user_group != "1" && $user_group != "99") {

			$more_condition = " AND tbl_quote_doc.user_id='" . $user_id . "' ";
		}


		$result['search'] = "";
		if (isset($_REQUEST["search"]) && ($_REQUEST["search"] != "")) {

			$search_word = "";
			if (isset($_GET["search"])) {
				$search_word = base64_decode($_GET["search"]);
			} else {
				$search_word = $_POST["search"];
			}

			$more_condition .= " AND (cust_name LIKE '%" . addslashes($search_word) . "%' OR inv_no LIKE '%" . addslashes($search_word) . "%' OR fullname LIKE '%" . addslashes($search_word) . "%' OR est_number LIKE '%" . addslashes($search_word) . "%') ";
			$result['search'] = $search_word;
		}

		$data_per_page = 20;

		$page = 1;

		if (isset($_REQUEST["page"]) && ($_REQUEST["page"] != "")) {
			$page = intval($_REQUEST["page"]);
		}
		$start_index = ($page - 1) * $data_per_page;

		$result['act_page'] = "archived";
		$result['data_per_page'] = $data_per_page;
		$result['page'] = $page;

		$sql_count = "SELECT COUNT(DISTINCT tbl_quote_doc.qdoc_id) AS num_data FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id LEFT JOIN tbl_quote_item ON tbl_quote_doc.qdoc_id=tbl_quote_item.qdoc_id WHERE tbl_quote_doc.enable=1 AND tbl_quote_item.enable=1 AND tbl_quote_doc.archive='1' " . $more_condition . "; ";
		$a_count = Yii::app()->db->createCommand($sql_count)->queryAll();
		$num_data = $a_count[0]["num_data"];
		//echo "HHH=".$num_data;
		$result['num_data'] = $num_data;
		$result['num_page'] = intval($num_data / $data_per_page);
		if (($num_data % $data_per_page) > 0) {
			$result['num_page']++;
		}

		// 		$sql = " SELECT tbl_quote_doc.*,user.fullname,SUM(tbl_quote_item.qty) AS sum_qty FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id LEFT JOIN tbl_quote_item ON tbl_quote_doc.qdoc_id=tbl_quote_item.qdoc_id WHERE tbl_quote_doc.enable=1 AND tbl_quote_item.enable=1 AND tbl_quote_doc.archive='1' ".$more_condition." GROUP BY tbl_quote_doc.qdoc_id ORDER BY tbl_quote_doc.is_duplicate DESC, tbl_quote_doc.is_editing DESC, tbl_quote_doc.add_date DESC LIMIT ".$start_index.",".$data_per_page.";";

		$sql = "SELECT
                tbl_quote_doc.*,
                user.fullname,
                SUM(tbl_quote_item.qty) AS sum_qty,
                IF(tbl_quote_doc.dup_from_id != 0, dup_doc.est_number, NULL) AS old_est_num
            FROM
                tbl_quote_doc
            LEFT JOIN user ON tbl_quote_doc.user_id = user.id
            LEFT JOIN tbl_quote_item ON tbl_quote_doc.qdoc_id = tbl_quote_item.qdoc_id
            LEFT JOIN tbl_quote_doc AS dup_doc ON tbl_quote_doc.dup_from_id = dup_doc.qdoc_id
            WHERE
                tbl_quote_doc.enable = 1
                AND tbl_quote_item.enable = 1
                AND tbl_quote_doc.archive = '1'
                $more_condition
            GROUP BY
                tbl_quote_doc.qdoc_id
            ORDER BY
                tbl_quote_doc.is_duplicate DESC,
                tbl_quote_doc.is_editing DESC,
                tbl_quote_doc.add_date DESC
            LIMIT
                $start_index, $data_per_page;
            ";
		$result['quote_doc'] = Yii::app()->db->createCommand($sql)->queryAll();

		$sql2 = " SELECT * FROM tbl_quote_note WHERE enable=1 ORDER BY qnote_name ASC;";
		$result['quote_note'] = Yii::app()->db->createCommand($sql2)->queryAll();

		$result['page_title'] = "Archived";
		$result['head_color'] = "#555";

		$this->render('new_request', $result); //--- Use same view with New status
	}

	public function actionCompany()
	{
		$this->render('company');
	}

	public function actionCustomer()
	{

		$user_group = Yii::app()->user->getState('userGroup');
		$user_id = Yii::app()->user->getState('userKey');

		$more_condition = "";
		if ($user_group != "1" && $user_group != "99") {

			$more_condition = " AND tbl_cust_info.user_id='" . $user_id . "' ";
		}

		$join_table = "";
		$data['search'] = "";
		if (isset($_REQUEST["search"]) && ($_REQUEST["search"] != "")) {

			$search_word = "";
			if (isset($_GET["search"])) {
				$search_word = base64_decode($_GET["search"]);
			} else {
				$search_word = $_POST["search"];
			}

			$join_table = " LEFT JOIN user ON tbl_cust_info.user_id=user.id ";

			$more_condition .= " AND (tbl_cust_info.cust_name LIKE '%" . addslashes($search_word) . "%' OR tbl_cust_info.cust_info LIKE '%" . addslashes($search_word) . "%' OR user.fullname LIKE '%" . addslashes($search_word) . "%') ";
			$data['search'] = $search_word;
		}

		$num_per_page = 10;
		$select_num_data = "SELECT COUNT(*) AS num_data FROM tbl_cust_info " . $join_table . " WHERE tbl_cust_info.enable=1 " . $more_condition;
		$a_num_data = Yii::app()->db->createCommand($select_num_data)->queryAll();
		$num_data = intval($a_num_data[0]["num_data"]);

		$data['num_data'] = $num_data;
		$data["num_page"] = intval($num_data / $num_per_page);
		if (($num_data % $num_per_page) > 0) {
			$data["num_page"]++;
		}

		$data["page"] = 1;

		//$data["search"] = $search;

		$this->render('customer', $data);
	}

	public function actionAddNewCustomer()
	{

		$cust_name = addslashes($_POST["add_cust_name"]);
		$cust_info = addslashes($_POST["add_cust_info"]);
		$user_id = $_POST["user_id"];
		$sql_insert = "INSERT INTO tbl_cust_info (user_id,cust_name,cust_info,add_date) VALUES ('" . $user_id . "','" . $cust_name . "','" . $cust_info . "','" . date("Y-m-d H:i:s") . "'); ";

		Yii::app()->db->createCommand($sql_insert)->execute();

		echo '<script type="text/javascript">';
		echo 'window.parent.addCustomerSuccess();';
		echo '</script>';
	}

	public function actionShowCustomer()
	{

		$user_group = Yii::app()->user->getState('userGroup');
		$user_id = Yii::app()->user->getState('userKey');

		$more_condition = "";
		if ($user_group != "1" && $user_group != "99") {

			$more_condition = " AND tbl_cust_info.user_id='" . $user_id . "' ";
		}

		$num_per_page = 10;
		$page = intval($_POST["page"]);

		if (isset($_POST["search"]) && ($_POST["search"] != "")) {
			$more_condition .= " AND (tbl_cust_info.cust_name LIKE '%" . addslashes($_POST["search"]) . "%' OR tbl_cust_info.cust_info LIKE '%" . addslashes($_POST["search"]) . "%' OR user.fullname LIKE '%" . addslashes($_POST["search"]) . "%') ";
		}

		$start_index = ($page - 1) * $num_per_page;

		$sql = " SELECT tbl_cust_info.*,user.fullname FROM tbl_cust_info LEFT JOIN user ON tbl_cust_info.user_id=user.id WHERE tbl_cust_info.enable=1 " . $more_condition . " ORDER BY tbl_cust_info.cust_name ASC LIMIT " . $start_index . "," . $num_per_page . ";";

		$cust_list = Yii::app()->db->createCommand($sql)->queryAll();

		$html_return = '<table class="tbl_customer" style="width: 100%;">';
		$html_return .= '<tr>';
		$html_return .= '<th>#</th><th>Name</th><th>Info</th>';

		if ($user_group == "1" || $user_group == "99") {
			$html_return .= '<th>Add by</th>';
		}
		$html_return .= '<th>Action</th>';
		$html_return .= '</tr>';

		$count_row = $start_index + 1;
		foreach ($cust_list as $key => $row) {

			$html_return .= '<tr id="tr_cust' . $row["cust_id"] . '">';
			$html_return .= '<td style="text-align: center;">' . $count_row . '</td>';
			$html_return .= '<td style="text-align: center;" id="td_cust_name' . $row["cust_id"] . '">' . $row["cust_name"] . '</td>';
			$html_return .= '<td><pre id="pr_cust_info' . $row["cust_id"] . '">' . $row["cust_info"] . '</pre></td>';
			if ($user_group == "1" || $user_group == "99") {
				$html_return .= '<td style="text-align: center;">' . $row["fullname"] . '</td>';
			}
			$html_return .= '<td style="text-align: center;">';
			$html_return .= '<button class="btn btn-warning" data-toggle="modal" data-target="#editCustomerModal" onclick="editCustomer(' . $row["cust_id"] . ');">Edit</button>';
			$html_return .= '<button class="btn btn-danger" onclick="deleteCustomer(' . $row["cust_id"] . ');">Delete</button>';
			$html_return .= '</td>';
			$html_return .= '</tr>';

			$count_row++;
		}

		$html_return .= '</table>';

		//$html_return = $start_index;
		echo $html_return;
	}

	public function actionEditCustomerSubmit()
	{

		$cust_id = $_POST["edit_cust_id"];
		$cust_name = addslashes($_POST["edit_cust_name"]);
		$cust_info = addslashes($_POST["edit_cust_info"]);
		$sql_update = "UPDATE tbl_cust_info SET cust_name='" . $cust_name . "',cust_info='" . $cust_info . "' WHERE cust_id=" . $cust_id . "; ";

		Yii::app()->db->createCommand($sql_update)->execute();

		echo '<script type="text/javascript">';
		echo 'window.parent.editCustomerSuccess(' . $cust_id . ');';
		echo '</script>';
	}

	public function actionDeleteCustomer()
	{

		$cust_id = $_POST["cust_id"];
		$sql_update = "UPDATE tbl_cust_info SET enable=0 WHERE cust_id=" . $cust_id . "; ";

		if (Yii::app()->db->createCommand($sql_update)->execute()) {
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to Delete customer.";
		}

		echo json_encode($a_result);
	}

	public function actionfetchChats()
	{
		$chat_type = $_POST['chat_type'];
		$doc_id = $_POST['doc_id'];
		$emp_id = $_POST['emp_id'];
		$string = "";
		$sql = "SELECT * FROM tbl_comments_extra WHERE doc_id='$doc_id' ORDER BY add_time ASC";
		$a_qitem = Yii::app()->db->createCommand($sql)->queryAll();
		if (count($a_qitem) == 0) {
			die(json_encode(array('status' => '0')));
		} else {
			foreach ($a_qitem as $tmp_key => $row_qitem) {
				if ($row_qitem["chat_type"] == $chat_type) {
					$style = "text-align:right";
				} else {
					$style = "text-align:left";
				}
				$string .= '<div><center><pre class="alert" style="' . $style . '; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;">' . $row_qitem['full_name'] . '@' . date("M d, Y H:i:s", strtotime($row_qitem["add_time"])) . ' comments "' . $row_qitem["message_long"] . '"</pre></center></div>';
			}
			die(json_encode(array('status' => '1', 'msg' => base64_encode($string))));
		}
	}

	public function actionfetchSalesNotes()
	{
		$qdoc_id = $_POST['doc_id'];
		$sql = "SELECT sale_note,add_date FROM tbl_quote_doc WHERE qdoc_id='$qdoc_id'";
		$a_qitem = Yii::app()->db->createCommand($sql)->queryAll();
		if (count($a_qitem) == 0) {
			die(json_encode(array('status' => '0')));
		} else {
			if ($a_qitem[0]['sale_note'] == "" || $a_qitem[0]['sale_note'] == NULL) {
				die(json_encode(array('status' => '0')));
			} else {
				$note = $a_qitem[0]['sale_note'];
				$string = 'Salesman @' . date("M d, Y H:i:s", strtotime($a_qitem[0]['add_date'])) . ' comments "' . $note . '"';
				die(json_encode(array('status' => '1', 'note' => $string)));
			}
		}
	}

	public function actionDeleteAllNoti()
	{
		$user_id = Yii::app()->user->getState('userKey');
		$sql = "DELETE FROM notifications WHERE employee_id='$user_id'";
		if (Yii::app()->db->createCommand($sql)->execute()) {
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to save new note.";
		}
		die(json_encode($a_result));
	}

	public function actiondeleteSingleNoti()
	{
		$user_id = Yii::app()->user->getState('userKey');
		$noti_id = $_POST['noti_id'];
		$sql = "DELETE FROM notifications WHERE noti_id='$noti_id'";
		if (Yii::app()->db->createCommand($sql)->execute()) {
			$sql = "SELECT COUNT(*) as total_noti FROM notifications WHERE employee_id='$user_id' AND noti_status='0'";
			$a_quote = Yii::app()->db->createCommand($sql)->queryAll();
			$a_result["result"] = "success";
			$a_result["msg"] = $a_quote[0]['total_noti'];
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to save new note.";
		}
		die(json_encode($a_result));
	}

	public function actionMarkAllNoti()
	{
		$user_id = Yii::app()->user->getState('userKey');
		$sql = "UPDATE notifications SET noti_status=1 WHERE employee_id='$user_id'";
		if (Yii::app()->db->createCommand($sql)->execute()) {
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to save new note.";
		}
		die(json_encode($a_result));
	}

	public function actionmarkNoti()
	{
		$user_id = Yii::app()->user->getState('userKey');
		$noti_id = $_POST['noti_id'];
		$noti_status = $_POST['noti_status'];
		$sql = "UPDATE notifications SET noti_status='$noti_status' WHERE noti_id='$noti_id'";
		if (Yii::app()->db->createCommand($sql)->execute()) {
			$sql = "SELECT COUNT(*) as total_noti FROM notifications WHERE employee_id='$user_id' AND noti_status='0'";
			$a_quote = Yii::app()->db->createCommand($sql)->queryAll();
			$a_result["result"] = "success";
			$a_result["msg"] = $a_quote[0]['total_noti'];
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to save new note.";
		}
		die(json_encode($a_result));
	}

	public function actionAddChatEmail()
	{
		$email_address = array();
		$text_comment = addslashes($_POST["text_comment"]);
		$doc_id = addslashes(base64_decode($_POST["doc_id"]));
		$emp_id = addslashes(base64_decode($_POST["emp_id"]));
		$full_name = addslashes(base64_decode($_POST["full_name"]));
		$chat_type = addslashes(base64_decode($_POST["chat_type"]));
		$sql_insert = "INSERT INTO `tbl_comments_extra`(`doc_id`,`full_name`, `user_id`,`chat_type`, `message_long`) VALUES ('$doc_id','$full_name','$emp_id','$chat_type','$text_comment')";

		if (Yii::app()->db->createCommand($sql_insert)->execute()) {
			if ($chat_type == "E") {
				$sql_fetch = "SELECT * FROM user WHERE user_group_id='99' OR user_group_id='1'";
				$a_quote = Yii::app()->db->createCommand($sql_fetch)->queryAll();
				foreach ($a_quote as $main) {
					$to_employee_id = $main['id'];
					$email_address = "swhitcomb@jogsports.com";
					$sql_noti = "INSERT INTO `notifications`(`doc_id`, `noti_detail`, `employee_id`, `noti_from_employee`) VALUES ('$doc_id','Comment','$to_employee_id','$emp_id')";
					Yii::app()->db->createCommand($sql_noti)->execute();
				}

				if ($emp_id == "34") {
					$sql_noti = "INSERT INTO `notifications`(`doc_id`, `noti_detail`, `employee_id`, `noti_from_employee`) VALUES ('$doc_id','Comment','34','34')";
					Yii::app()->db->createCommand($sql_noti)->execute();
				}

				$sql_fetch = "SELECT est_number FROM tbl_quote_doc WHERE qdoc_id='$doc_id'";
				$a_quote_new = Yii::app()->db->createCommand($sql_fetch)->queryAll();
				$est_number = $a_quote_new[0]['est_number'];
			} else {
				$sql_fetch = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='$doc_id'";
				$a_quote = Yii::app()->db->createCommand($sql_fetch)->queryAll();
				$to_employee_id = $a_quote[0]['user_id'];
				$est_number = $a_quote[0]['est_number'];
				$sql_noti = "INSERT INTO `notifications`(`doc_id`, `noti_detail`, `employee_id`, `noti_from_employee`) VALUES ('$doc_id','Comment','$to_employee_id','$emp_id')";
				Yii::app()->db->createCommand($sql_noti)->execute();

				$sql_fetch_new = "SELECT email FROM user WHERE id='$to_employee_id'";
				$a_quote_new = Yii::app()->db->createCommand($sql_fetch_new)->queryAll();
				$email_address = $a_quote_new[0]['email'];
			}

			// $qnote_id = Yii::app()->db->getLastInsertID();

			// $a_result["qnote_id"] = $qnote_id;
			// $a_result["qnote_name"] = $_POST["note_name"];
			// $a_result["qnote_text"] = $_POST["note_text"];
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to save new note.";
		}
		$bs_url = Yii::app()->request->getBaseUrl(true);
		$template3 = '<!DOCTYPE html>
                    <html>
                    
                    <head>
                        <title></title>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                        <style type="text/css">
                            @media screen {
                                @font-face {
                                    font-family: "Lato";
                                    font-style: normal;
                                    font-weight: 400;
                                    src: local("Lato Regular"), local("Lato-Regular"), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format("woff");
                                }
                    
                                @font-face {
                                    font-family: "Lato";
                                    font-style: normal;
                                    font-weight: 700;
                                    src: local("Lato Bold"), local("Lato-Bold"), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format("woff");
                                }
                    
                                @font-face {
                                    font-family: "Lato";
                                    font-style: italic;
                                    font-weight: 400;
                                    src: local("Lato Italic"), local("Lato-Italic"), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format("woff");
                                }
                    
                                @font-face {
                                    font-family: "Lato";
                                    font-style: italic;
                                    font-weight: 700;
                                    src: local("Lato Bold Italic"), local("Lato-BoldItalic"), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format("woff");
                                }
                            }
                    
                            /* CLIENT-SPECIFIC STYLES */
                            body,
                            table,
                            td,
                            a {
                                -webkit-text-size-adjust: 100%;
                                -ms-text-size-adjust: 100%;
                            }
                    
                            table,
                            td {
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                            }
                    
                            img {
                                -ms-interpolation-mode: bicubic;
                            }
                    
                            /* RESET STYLES */
                            img {
                                border: 0;
                                height: auto;
                                line-height: 100%;
                                outline: none;
                                text-decoration: none;
                            }
                    
                            table {
                                border-collapse: collapse !important;
                            }
                    
                            body {
                                height: 100% !important;
                                margin: 0 !important;
                                padding: 0 !important;
                                width: 100% !important;
                            }
                    
                            /* iOS BLUE LINKS */
                            a[x-apple-data-detectors] {
                                color: inherit !important;
                                text-decoration: none !important;
                                font-size: inherit !important;
                                font-family: inherit !important;
                                font-weight: inherit !important;
                                line-height: inherit !important;
                            }
                    
                            /* MOBILE STYLES */
                            @media screen and (max-width:600px) {
                                h1 {
                                    font-size: 32px !important;
                                    line-height: 32px !important;
                                }
                            }
                    
                            /* ANDROID CENTER FIX */
                            div[style*="margin: 16px 0;"] {
                                margin: 0 !important;
                            }
                        </style>
                    </head>
                    
                    <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
                        <!-- HIDDEN PREHEADER TEXT -->
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <!-- LOGO -->
                            <tr>
                                <td bgcolor="#000000" align="center">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#000000" align="center" style="padding: 0px 10px 0px 10px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                                                <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome!</h1> <img src="https://online.jog-joinourgame.com/assets/images/logo.png" width="125" height="120" style="display: block; border: 0px;" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;margin-top:10px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;">You have a comment - <br> <b>"' . $text_comment . '"</b> <br> in SALES REP PORTAL from ' . $full_name . ' on ESTIMATE NO - ' . $est_number . '</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#ffffff" align="left">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                                            <table border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td align="center" style="border-radius: 3px;" bgcolor="#000000"><a href="' . $bs_url . '" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #000000; display: inline-block;">Login</a></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr> <!-- COPY -->
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;">If that doesnt work, copy and paste the following link in your browser:</p>
                                            </td>
                                        </tr> <!-- COPY -->
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;"><a href="' . $bs_url . '" target="_blank" style="color: #000000;">' . $bs_url . '</a></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;">Cheers,<br>JOG Team</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td bgcolor="#000000" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <h2 style="font-size: 20px; font-weight: 400; color: #FFFFFF; margin: 0;">Need more help?</h2>
                                                <p style="margin: 0;"><a href="https://jogsportswear.com" target="_blank" style="color: #FFFFFF;">We&rsquo;re here to help you out</a></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </body>
                    
                    </html>';

		$mail = Yii::app()->Smtpmail;
		$mail->Host = 'cvps652.serverhostgroup.com';
		$mail->Port = 587; //465
		$mail->CharSet = 'utf-8';
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Username = "no-reply@jog-joinourgame.com";
		$mail->Password = "demo@9090";
		$mail->SetFrom("no-reply@jog-joinourgame.com", 'JOG SPORTS | SALES REP PORTAL');
		$mail->Subject = "COMMENT IN ESTIMATE NUMBER";
		$mail->MsgHTML($template3);
		//$mail->AddAddress($mail_customer, $mail_customername);
		$mail->addBcc("ravish@jogsportswear.com");
		$mail->AddAddress($email_address);
		if ($email_address != "ameyers@jogsportswear.com") {
			if (!$mail->Send()) {
				//echo $mail->ErrorInfo;
			} else {
				//echo "working";
				//Yii::app()->user->setFlash('success', 'Message Already sent!');
			}
		}
		$mail->ClearAddresses(); //clear addresses for next email sending

		die(json_encode($a_result));
	}

	public function actionAddChat()
	{
		$text_comment = addslashes($_POST["text_comment"]);
		$doc_id = addslashes(base64_decode($_POST["doc_id"]));
		$emp_id = addslashes(base64_decode($_POST["emp_id"]));
		$full_name = addslashes(base64_decode($_POST["full_name"]));
		$chat_type = addslashes(base64_decode($_POST["chat_type"]));
		$sql_insert = "INSERT INTO `tbl_comments_extra`(`doc_id`,`full_name`, `user_id`,`chat_type`, `message_long`) VALUES ('$doc_id','$full_name','$emp_id','$chat_type','$text_comment')";

		if (Yii::app()->db->createCommand($sql_insert)->execute()) {
			if ($chat_type == "E") {
				$sql_fetch = "SELECT * FROM user WHERE user_group_id='99' OR user_group_id='1'";
				$a_quote = Yii::app()->db->createCommand($sql_fetch)->queryAll();
				foreach ($a_quote as $main) {
					$to_employee_id = $main['id'];
					$sql_noti = "INSERT INTO `notifications`(`doc_id`, `noti_detail`, `employee_id`, `noti_from_employee`) VALUES ('$doc_id','Comment','$to_employee_id','$emp_id')";
					Yii::app()->db->createCommand($sql_noti)->execute();
				}

				if ($emp_id == "34") {
					$sql_noti = "INSERT INTO `notifications`(`doc_id`, `noti_detail`, `employee_id`, `noti_from_employee`) VALUES ('$doc_id','Comment','34','34')";
					Yii::app()->db->createCommand($sql_noti)->execute();
				}
			} else {
				$sql_fetch = "SELECT user_id FROM tbl_quote_doc WHERE qdoc_id='$doc_id'";
				$a_quote = Yii::app()->db->createCommand($sql_fetch)->queryAll();
				$to_employee_id = $a_quote[0]['user_id'];
				$sql_noti = "INSERT INTO `notifications`(`doc_id`, `noti_detail`, `employee_id`, `noti_from_employee`) VALUES ('$doc_id','Comment','$to_employee_id','$emp_id')";
				Yii::app()->db->createCommand($sql_noti)->execute();
			}

			// $qnote_id = Yii::app()->db->getLastInsertID();

			// $a_result["qnote_id"] = $qnote_id;
			// $a_result["qnote_name"] = $_POST["note_name"];
			// $a_result["qnote_text"] = $_POST["note_text"];
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to save new note.";
		}

		die(json_encode($a_result));
	}

	public function actionadd_product()
	{
		$qdoc_id = $_POST["qdoc_id"];
		$sql_insert = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,add_date,product_status) VALUES ('" . $qdoc_id . "','other','" . date("Y-m-d H:i:s") . "','1'); ";
		if (Yii::app()->db->createCommand($sql_insert)->execute()) {

			$qdoci_id = Yii::app()->db->getLastInsertID();
			die(json_encode(array('status' => '1', 'qdoci_id' => $qdoci_id)));
		} else {
			die(json_encode(array('status' => '0')));
		}
	}

	public function actiondelete_product()
	{
		$qdoci_id = $_POST['qdoci_id'];
		$sql_update = "UPDATE tbl_quote_item SET product_status=2 WHERE qdoci_id='" . $qdoci_id . "'";
		if (Yii::app()->db->createCommand($sql_update)->execute()) {
			die(json_encode(array('status' => '1')));
		} else {
			die(json_encode(array('status' => '0')));
		}
	}

	public function actionShowQuoteViewCurrChange()
	{

		if ($_POST['old_curr_id'] == 1) {

			$qdoc_id = $_POST["qdoc_id"];

			$sql_quote = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $qdoc_id . "'; ";
			$a_quote = Yii::app()->db->createCommand($sql_quote)->queryAll();
			$row_quote = $a_quote[0];
			$comp_id = $row_quote["comp_id"];

			$action_from = $_POST["action_from"];

			$approve_status = $row_quote["approve_status"];
			$curr_id = $_POST['curr_id'];

			$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $curr_id . "'; ";
			$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();
			$row_curr = $a_curr[0];
			$pre_cost = $row_curr["curr_symbol"];
			$quote_currency = $row_curr["quote_currency"];

			$cur_sql = "SELECT * FROM tbl_currency";
			$curr_query = Yii::app()->db->createCommand($cur_sql)->queryAll();
			$select_html = '<select style="width:50px;" id="viewQuotationNew" qdoc_id="' . $qdoc_id . '" action_from="' . $action_from . '">';
			foreach ($curr_query as $fetched) {
				$curr_select = "";
				if ($fetched['curr_id'] == $curr_id) {
					$curr_select = "selected";
				}
				$select_html .= "<option curr_symbol=" . $fetched['curr_name'] . " value=" . $fetched['curr_id'] . " $curr_select >" . $fetched["curr_name"] . " " . $fetched["curr_desc"] . "</option>";
			}
			$select_html .= "</select>";

			$sql_comp = "SELECT tbl_comp_info.comp_logo,tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.comp_id='" . $comp_id . "'; ";
			$a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();
			$row_comp = $a_comp[0];
			$comp_logo = $row_comp["comp_logo"];
			$qnote_text = $row_comp["qnote_text"];

			$return_html = '<style type="text/css">';
			$return_html .= 'pre{ ';
			$return_html .= 'font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif; ';
			$return_html .= 'border:0px; ';
			$return_html .= 'background-color: #FFF; ';
			$return_html .= 'font-size: 14px; ';
			$return_html .= 'color: #000; ';
			$return_html .= 'line-height: 1.3; ';
			$return_html .= 'margin: 0px; ';
			$return_html .= '}';
			$return_html .= '</style>';

			$return_html .= '<table style="width:100%;"><tr><td style="width:50%; text-align:left;" id="head_img_logo_app">';

			if ($comp_logo != "") {
				//$return_html .= '<img style="max-height: 180px; max-width: 180px;" src="https://'.$_SERVER['SERVER_NAME'].'/salesrep/images/'.$comp_logo.'" >';
				$return_html .= '<img style="max-height: 180px; max-width: 180px;" src="' . Yii::app()->request->baseUrl . '/images/' . $comp_logo . '" >';
			}

			$return_html .= '</td>';
			$return_html .= '<td style="width:50%; text-align:right;">';
			$return_html .= '<h1 style="color:#000;">ESTIMATE</h1>';
			$old_curr_id = $curr_id;
			$return_html .= '<input type="hidden" value="' . $row_quote["curr_id"] . '" id="old_curr_id">';

			$return_html .= '<input type="hidden" name="curr_id" value="' . $curr_id . '">';
			$return_html .= '<input type="hidden" name="quote_curr" value="' . $row_curr["curr_name"] . '">';

			$return_html .= 'Payment Terms: ';

			if ($action_from == "va") {
				$return_html .= '<select name="payment_term" id="edit_payment_term">';
				$return_html .= '<option ' . (($row_quote["payment_term"] == "Net 15") ? "selected" : "") . ' value="Net 15">Net 15</option>';
				$return_html .= '<option ' . (($row_quote["payment_term"] == "Net 30") ? "selected" : "") . ' value="Net 30">Net 30</option>';
				$return_html .= '<option ' . (($row_quote["payment_term"] == "Payment Due at Order Confirmation") ? "selected" : "") . ' value="Payment Due at Order Confirmation">Payment Due at Order Confirmation</option>';
				$return_html .= '<option ' . (($row_quote["payment_term"] == "50% Due At Order Confirmation. Balance Due At Delivery") ? "selected" : "") . ' value="50% Due At Order Confirmation. Balance Due At Delivery">50% Due At Order Confirmation. Balance Due At Delivery</option>';
				$return_html .= '<option ' . (($row_quote["payment_term"] == "Balance Due before Ship Date") ? "selected" : "") . ' value="Balance Due before Ship Date">Balance Due before Ship Date</option>';
				$return_html .= '<option ' . (($row_quote["payment_term"] == "50% Down Payment. Balance Due Net 15") ? "selected" : "") . ' value="50% Down Payment. Balance Due Net 15">50% Down Payment. Balance Due Net 15</option>';
				$return_html .= '<option ' . (($row_quote["payment_term"] == "50% Down Payment. Balance Due at Delivery") ? "selected" : "") . ' value="50% Down Payment. Balance Due at Delivery">50% Down Payment. Balance Due at Delivery</option>';
				$return_html .= '</select>';
			} else {
				$return_html .= $row_quote["payment_term"];
			}

			$return_html .= '<pre style="width:100%;" id="pre_comp_info_app"><b>' . $row_quote["comp_name"] . '</b><br>' . $row_quote["comp_info"] . '</pre>';
			$return_html .= '</td></tr><tr style="height:5px;"><td colspan="2"><hr></td></tr>';
			$return_html .= '<tr>';
			$return_html .= '<td style="text-align:left; padding:20px 0px;">';
			if ($action_from == "va") {
				$return_html .= '<select id="cust_selector" name="cust_selector" onchange="return changeCustomerV2();"><option value="">=Select Customer=</option>';
				$user_group = Yii::app()->user->getState('userGroup');
				$user_id = Yii::app()->user->getState('userKey');

				$more_condition = "";
				if ($user_group != "1" && $user_group != "99") {

					$more_condition = " AND user_id='" . $user_id . "' ";
				}
				$sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 " . $more_condition . " ORDER BY cust_name ASC; ";
				$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();
				$custom_selector = "";
				foreach ($a_cust as $tmp_key => $row_cust) {
					if ($row_quote['cust_id'] == $row_cust['cust_id']) {
						$custom_selector = "selected";
					}
					$return_html .= '<option ' . $custom_selector . ' value="' . $row_cust["cust_id"] . '">' . $row_cust["cust_name"] . '</option>';
					$custom_selector = "";
				}
				$return_html .= '</select><pre id="pr_show_cust_info"></pre>';
			}
			$return_html .= '<div class="bill_to">BILL TO<br>' . $row_quote["cust_name"];
			$return_html .= '<pre>' . $row_quote["cust_info"] . '</pre></div>';
			if ($action_from != "va") {
				$return_html .= '<a href="#" onclick="edit_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Edit <span id="cus_namer_' . $row_quote["cust_id"] . '">' . $row_quote["cust_name"] . '</span></a><span style="display: inline-block; font-size: 1.5em; margin: 0 5px;">&bull;</span><a href="#" onclick="change_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Change Customer</a>';
			}
			$return_html .= '</td>';
			$return_html .= '<td padding:20px 0px;">';
			$return_html .= '<table align="right" style="border-collapse: separate; border-spacing: 10px; color:#000;">';
			$return_html .= '<tr><th width="50%" style="text-align:right;">Estimate Number: </th><td style="color:#00F; text-align:left;" id="qdoc_number">' . $row_quote["est_number"] . '</td></tr>';
			$return_html .= '<tr>';
			$return_html .= '<th style="text-align:right;">PO Number: </th>';
			$return_html .= '<td style="text-align:left;" id="po_number">';
			$return_html .= '<span id="sp_po_number' . $qdoc_id . '">' . $row_quote["po_number"] . '</span> <i class="fa fa-pencil" style="cursor:pointer; font-size:16px; color:#00F;" onclick="return editPONumber(' . $qdoc_id . ');"></i>';
			$return_html .= '</td>';
			$return_html .= '</tr>';
			$return_html .= '<tr><th style="text-align:right;">Estimate Date: </th><td style="text-align:left;" id="show_est_date">' . date("F d, Y", strtotime($row_quote["est_date"])) . '</td></tr>';
			$return_html .= '<tr><th style="text-align:right;">Expires On: </th><td style="text-align:left;" id="show_exp_date">' . date("F d, Y", strtotime($row_quote["exp_date"])) . '</td></tr>';
			$return_html .= '<tr><th style="text-align:right;">Grand Total (' . $row_curr['curr_name'] . '): </th><td style="text-align:left;" id="td_grand_total_app">' . $pre_cost . number_format($row_quote["grand_total"] * $quote_currency, 2) . '</td></tr>';
			$return_html .= '</table>';
			$return_html .= '<input type="hidden" name="qdoc_id" id="qdoc_id" value="' . $qdoc_id . '">';
			$return_html .= '</td></tr>';
			$return_html .= '<tr><td colspan="2">';
			$return_html .= '<table style="color:#000; width:100%;" id="product_list">';
			$return_html .= '<tr style="font-size: 15px;"><th width="100%" style="text-align:left;">Product</th>';

			if ($action_from == "vc" || $action_from == "va") {
				$return_html .= '<th style="text-align:center; color:#999;">Comm.%</th><th style="text-align:center; color:#999;">Comm.</th>';
				$return_html .= '<th style="text-align:center; width:80px;">Quantity</th><th style="text-align:center; width:80px;">Price</th><th style="text-align:right; width:80px;">Amount</th><th style="text-align:right; width:10%"></th></tr>';
			} else {
				$return_html .= '<th style="text-align:center;">Quantity</th><th style="text-align:right; width:140px;">Price</th><th style="text-align:right; width:140px;">Amount</th></tr>';
			}
			$shipping = 0.0;
			$sql_qitem = "SELECT * FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND enable=1 AND product_status='1' ORDER BY sort ASC; ";
			$a_qitem = Yii::app()->db->createCommand($sql_qitem)->queryAll();

			$sql = "SELECT * FROM `tbl_quote_item` WHERE `qdoc_id` = '$qdoc_id' AND (`pro_name` LIKE '%Royalty%' OR `pro_name` LIKE '%Credit Card%' OR `pro_name` LIKE '%Shipping%')";
			$shipp = Yii::app()->db->createCommand($sql)->queryAll();
			if (isset($shipp[0])) {	
				foreach ($shipp as $key => $value) {
			
					$shipping += $value['uprice'];
				}			
			}

			//$sub_total = 0.0;
			$sub_total = $row_quote["sub_total"] * $quote_currency;
			$comm_total = 0.0;

			$user_group = Yii::app()->user->getState('userGroup');

			foreach ($a_qitem as $tmp_key => $row_qitem) {

				$pro_id = $row_qitem["pro_id"];
				$qty = $row_qitem["qty"];
				$uprice = $row_qitem["uprice"] * $quote_currency;
				$comm_percent = $row_qitem["comm_percent"];
				$comm_value = "";
				$tmp_comm_percent = 0;
				if ($comm_percent != "") {
					$tmp_comm_percent = intval(str_replace("%", "", $comm_percent));
					$comm_value = ($qty * $uprice) * ($tmp_comm_percent / 100);
					$comm_total += $comm_value;
				}

				$tmp_amount = $qty * $uprice;

				$return_html .= '<tr><td style="padding:10px 0px; text-align:left; display: block; white-space: pre-wrap;word-wrap: break-word;">';
				/*$return_html .= '<input type="hidden" name="quote_curr" value="'.$_POST["quote_curr"].'">';
			$return_html .= '<input type="hidden" name="pro_id[]" value="'.$product_id.'">';
			$return_html .= '<input type="hidden" name="comm_percent[]" value="'.$_POST["comm_percent"][$i].'">';
			$return_html .= '<input type="hidden" name="qty_note[]" value="'.$_POST["qty_note"][$i].'">';
			$return_html .= '<input type="hidden" name="pro_type[]" value="'.$_POST["product_type"][$i].'">';
			$return_html .= '<input type="hidden" name="pro_name[]" value="'.base64_encode($_POST["product_item"][$i]).'">';
			$return_html .= '<input type="hidden" name="pro_desc[]" value="'.base64_encode($_POST["product_desc"][$i].$s_addi_name).'">';
			$return_html .= '<input type="hidden" name="qty[]" value="'.$_POST["qty"][$i].'">';
			$return_html .= '<input type="hidden" name="uprice[]" value="'.$tmp_uprice.'">';
			$return_html .= '<input type="hidden" name="addi_id_list[]" value="'.$s_addi_id.'">';*/

				if ($action_from == "va") {
					$return_html .= '<input type="hidden" name="qdoci_id[]" value="' . $row_qitem["qdoci_id"] . '">';
					$return_html .= '<input style="width:100%; font-weight:bold;" type="text" name="pro_name[]" value="' . htmlspecialchars($row_qitem["pro_name"]) . '">';
					$return_html .= '<br><textarea style="width:100%; min-height:70px;" name="pro_desc[]">' . $row_qitem["pro_desc"] . '</textarea>';
					if ($row_qitem["addi_desc"] != "") {
						$return_html .= $row_qitem["addi_desc"];
					}
				} else {
					$return_html .= '<b>' . htmlspecialchars($row_qitem["pro_name"]) . '</b><br>' . $row_qitem["pro_desc"];
				}

				$return_html .= '</td>';

				if ($action_from == "vc") {

					$return_html .= '<td style="text-align:center; color:#999;">' . (($tmp_comm_percent != 0) ? ($tmp_comm_percent . "%") : "0%");
					if ($user_group == "1" || $user_group == "99") {
						$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editCommAfterApprove(\'' . $qdoc_id . '\',\'' . $row_qitem["qdoci_id"] . '\',\'' . $tmp_comm_percent . '\');"></i>';
					}


					$return_html .= '</td>';
					$return_html .= '<td style="text-align:center; color:#999;">' . (($comm_value != "") ? number_format($comm_value * $quote_currency, 2) : "") . '</td>';
				} else if ($action_from == "va") {

					$return_html .= '<td style="text-align:center; color:#999;"><input type="hidden" value="' . $row_qitem["qdoci_id"] . '" class="qdoci_id_app">';
					$return_html .= '<input type="hidden" value="' . $tmp_amount . '" id="tmp_amount' . $row_qitem["qdoci_id"] . '">';
					$return_html .= '<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width:60px; text-align:center;" min="0" type="number" value="' . $tmp_comm_percent . '" id="comm_percent_app' . $row_qitem["qdoci_id"] . '"></td>';
					$return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app' . $row_qitem["qdoci_id"] . '">' . (($comm_value != "") ? number_format($comm_value * $quote_currency, 2) : "") . '</td>';
				}
				$return_html .= '<td style="text-align:center;">';
				if ($action_from == "va") {
					$return_html .= '<input name="app_qty[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:55px; text-align:center;" min="0" type="number" value="' . $qty . '" id="app_qty' . $row_qitem["qdoci_id"] . '">';
				} else {
					$return_html .= number_format($qty, 0);
				}
				$return_html .= '</td>';

				$return_html .= '<td style="text-align:right;">';
				if ($action_from == "va") {
					$return_html .= '<input name="app_uprice[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:70px; text-align:center;" min="0.00" type="number" value="' . $uprice . '" id="app_uprice' . $row_qitem["qdoci_id"] . '">';
				} else if ($action_from == "vc" && ($user_group == "1" || $user_group == "99")) {
					$return_html .= $pre_cost . number_format($uprice, 2);

					$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editUPriceAfterApprove(\'' . $qdoc_id . '\',\'' . $row_qitem["qdoci_id"] . '\',\'' . $uprice . '\');"></i>';
				} else {
					$return_html .= $pre_cost . number_format($uprice, 2);
				}
				$return_html .= '</td><td style="text-align:center;">' . $pre_cost . '<span id="sp_app_amount' . $row_qitem["qdoci_id"] . '">';

				if ($action_from == "va") {
					$return_html .= $tmp_amount;
				} else {
					$return_html .= number_format($tmp_amount, 2);
				}

				$return_html .= '</span></td>';

				if ($action_from == "va") {
					$return_html .= '<td style="text-align:center;cursor:pointer;" class="remover" qdoci_id="' . $row_qitem['qdoci_id'] . '"><i style="color:red;" class="fa fa-minus-circle"></i></td>';
				}

				$return_html .= '</tr>';

				//$sub_total += $tmp_amount;
			}

			$col_span = 4;
			$col_span2 = 2;
			if ($action_from == "vc" || $action_from == "va") {
				$col_span = 6;
				$col_span2 = 4;
			}
			$return_html .= '<tr><td colspan="' . $col_span . '" style="padding:0px;"><hr style="margin:0px;"></td></tr>';



			$vat_7percent = ($sub_total - $row_quote['actual_discount']) * 0.07;

			$f_total = 0.0;
			if ($row_quote["inc_vat"] == "yes" || $action_from == "va" || $action_from == "vb") {
				if ($action_from != "vp") {
					$return_html .= '<tr><td colspan="2"><span qdoc_id="' . $qdoc_id . '" class="btn btn-success add_row" style="padding:5px;">Add Row  <i class="fa fa-plus" aria-hidden="true"></i></span></td>';
				}
				if ($action_from == "vc" || $action_from == "va") {
					$return_html .= '<td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">' . number_format($comm_total, 2) . '</td><td>&nbsp;</td>';
				}
				$colspaner = '';
				$colspaner_1 = '';
				if ($action_from == "vp") {
					$colspaner = "colspan='3'";
					$colspaner_1 = "colspan='1'";
				}
				$return_html .= '<th ' . $colspaner . ' style="padding: 10px 0px; text-align:right;">Subtotal:</th>';
				$return_html .= '<td ' . $colspaner_1 . ' style="padding: 10px 0px; text-align:right;">' . $pre_cost . '<span id="sp_app_sub_total">' . $sub_total . '</span></td></tr>';

				if ($row_quote["inc_vat"] == "yes") {
					$f_total = ($sub_total - ($row_quote['actual_discount'] * $quote_currency)) + $vat_7percent;
				} else {
					$f_total = $sub_total - ($row_quote['actual_discount'] * $quote_currency);
				}
				if ($action_from != "vp") {

					if ($row_quote["design_url"] != "" || $row_quote["design_url"] != NULL) {
						$return_html .= "<input type='hidden' id='tr_total' value='1'>";
						$return_html .= "<tr><th colspan='2'>Design URL</th></tr>";
						$return_html .= "<tr><td colspan='2' class='alert alert-success'><a style='color:white;' href=" . $row_quote["design_url"] . ">" . $row_quote["design_url"] . "</a></td></tr>";
					}

					$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Change Currency:</th><td style="padding: 10px 0px; text-align:right;"><span>' . $select_html . '</span></td></tr>';

					$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="discount_percent" class="number_disc_approval" data-shipp="'.$shipping.'" value="' . $row_quote['discount_percent'] . '" style="width:55px;"></span></td></tr>';

					$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="actual_discount" id="actual_disc_approval" data-shipp="'.$shipping.'" value="' . $row_quote['actual_discount'] . '" style="width:55px;"></span></td></tr>';
				}

				$return_html .= "<input type='hidden' id='tr_total' value='0'>";

				if ($action_from == "vp" && $row_quote['actual_discount'] != "0") {
					$return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>' . $row_quote['discount_percent'] . '%</span></td></tr>';

					$return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>' . $pre_cost . number_format($row_quote['actual_discount'], 2) . '</span></td></tr>';
				}


				$return_html .= '<tr ><td rowspan="3" colspan="' . $col_span2 . '">';
				if ($row_quote["sale_note"] != "" && ($action_from == "va" || $action_from == "vb")) {
					$return_html .= 'Salesman Notes (<font color=red>Not shown in Estimate</font>)';
					if ($action_from == "vb") {
						$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_edit_sale_note" style="background-color:#DDD;" onclick="return editSaleNote(' . $qdoc_id . ');"><i class="fa fa-pencil" style="color:#00F;"></i> Edit</button>';
						$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_save_sale_note" style="background-color:#FFF;" disabled onclick="return saveSaleNote(' . $qdoc_id . ');"><i class="fa fa-floppy-o" style="color:#070;"></i> Save</button>';
					}

					$return_html .= '<br><pre class="alert alert-success" style="width:100%; height:100%; max-width:700px; overflow-x:auto;" id="pre_sale_note' . $qdoc_id . '">' . $row_quote["sale_note"] . '</pre>';
				} else {
					$return_html .= '&nbsp;';
				}

				if ($action_from == "va") {
					$return_html .= 'Comment (<font color=red>Not shown in Estimate and appear on the top after Approve or Reject.</font>)';
					$return_html .= '<div style="text-align:left;">';
					$return_html .= '<textarea name="approval_comment" id="approval_comment" style="width: 700px; height: 100px; min-height: 101px; margin: 3px;"></textarea>';
					$return_html .= '</div>';
				}

				$return_html .= '</td>';
				$return_html .= '<td style="padding: 10px 0px; text-align:right;">';
				$return_html .= '<input type="hidden" id="sub_total_app" value="' . $sub_total . '">';
				$return_html .= '<input type="hidden" id="pre_cost_app" value="' . $pre_cost . '">';
				$return_html .= '<input type="hidden" name="vat_value_app" id="vat_value_app" value="' . $vat_7percent . '">';
				$return_html .= '<input type="hidden" id="total_value_app" value="' . $f_total . '">';



				if ($row_quote["approve_status"] == "new" && ($user_group == "1" || $user_group == "99")) {
					$return_html .= '<span class="subnvat"><input type="checkbox" name="inc_vat_app" id="inc_vat_app" value="yes" onclick="changeIncludeVATApprove();" ';
					if ($row_quote["inc_vat"] == "yes") {
						$return_html .= 'checked';
					}
					$return_html .= '>';
				}
				$return_html .= ' VAT 7%:</span></td>';
				$return_html .= '<td style="padding: 10px 0px; text-align:right;"><span class="subnvat" id="sp_show_vat_value_app">';
				if ($row_quote["inc_vat"] == "yes") {
					$return_html .= $pre_cost . number_format($vat_7percent, 2);
				}
				$return_html .= '</span></td></tr>';

				$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Total:</span></th>';
				$return_html .= '<td style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat" id="sp_show_total_value_app">' . $pre_cost . number_format($f_total, 2) . '</span></td></tr>';


				$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total (' . $row_curr["curr_name"] . '):</th>';
				$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="' . $pre_cost . '">' . $pre_cost . number_format($f_total, 2) . '</span></th></tr>';
			} else {
				//$f_total = $sub_total;
				$f_total = $row_quote["grand_total"];
				$return_html .= '<tr ><td>&nbsp;</td>';
				$colspan_grand = "colspan='2'";
				if ($action_from == "vc" || $action_from == "va") {
					$return_html .= '<td>&nbsp;</td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">' . number_format($comm_total, 2) . '</td>';
				}
				if ($action_from == "vp" && $row_quote['actual_discount'] != "0") {
					$return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>' . $row_quote['discount_percent'] . '%</span></td></tr>';

					$return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>' . $pre_cost . number_format($row_quote['actual_discount'], 2) . '</span></td></tr>';
					$colspan_grand = "colspan='3'";
				}
				$return_html .= '<th ' . $colspan_grand . ' style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total (' . $row_quote["quote_curr"] . '):</th>';
				$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="' . $pre_cost . '">' . $pre_cost . number_format($f_total, 2) . '</span></th></tr>';
			}



			$return_html .= '</table>';
			$return_html .= '</td></tr>';

			$return_html .= '</table>';

			if ($row_quote["approve_status"] != "new" && $row_quote["note"] != "") {
				$return_html .= '<b>Notes</b> ';
				$return_html .= '<pre ';
				if ($row_quote["approve_status"] == "reject") {
					$return_html .= ' class="alert alert-dark" ';
				}
				$return_html .= '>' . $row_quote["note"] . '</pre>';
			}

			//print_r($return_html);

			$a_result["inner_content"] = $return_html;

			$a_result["show_approve"] = "no";
			$a_result["show_reject"] = "no";
			$a_result["show_print"] = "no";

			$a_result["comp_id"] = $comp_id;
			$a_result["qnote_text"] = base64_encode($qnote_text);

			$a_result["history_inner"] = "";

			$a_result["approval_comment"] = "";
			if ($row_quote["approval_comment"] != "") {
				$a_result["approval_comment"] = base64_encode('<div><center><pre class="alert" style="text-align:left; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;" id="approval_comment' . $qdoc_id . '">' . $row_quote["approval_comment"] . '</pre></center></div>');
			}

			if ($approve_status == "new") {

				$a_result["show_approve"] = "yes";
				$a_result["show_reject"] = "yes";

				if ($row_quote["history_qdoc_id"] != "") {

					$a_result["history_inner"] .= '<option value="' . $qdoc_id . '">==Main Document==</option>';

					$sql_history = "SELECT qdoc_id,add_date FROM tbl_quote_doc WHERE qdoc_id IN (" . rtrim($row_quote["history_qdoc_id"], ',') . ") ORDER BY add_date DESC; ";
					//$a_result["history_inner"] .= $sql_history;
					$a_history = Yii::app()->db->createCommand($sql_history)->queryAll();
					foreach ($a_history as $tmp_key_his => $row_history) {
						$a_result["history_inner"] .= '<option value="' . $row_history["qdoc_id"] . '">' . $row_history["add_date"] . '</option>';
					}
				}
			} else if ($approve_status == "approve") {

				$a_result["show_print"] = "yes";
			}

			echo json_encode($a_result);
		} else {
			$qdoc_id = $_POST["qdoc_id"];

			$sql_quote = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $qdoc_id . "'; ";
			$a_quote = Yii::app()->db->createCommand($sql_quote)->queryAll();
			$row_quote = $a_quote[0];
			$comp_id = $row_quote["comp_id"];

			$action_from = $_POST["action_from"];

			$approve_status = $row_quote["approve_status"];
			$curr_id = $_POST['curr_id'];
			$older_curr_id = $_POST['old_curr_id'];

			$oldsql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $older_curr_id . "'; ";
			$old_a_curr = Yii::app()->db->createCommand($oldsql_curr)->queryAll();
			$old_row_curr = $old_a_curr[0];
			$old_quote_currency = 1 / $old_row_curr["quote_currency"];

			$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $curr_id . "'; ";
			$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();
			$row_curr = $a_curr[0];
			$pre_cost = $row_curr["curr_symbol"];
			$quote_currency = ($row_curr["quote_currency"]) * $old_quote_currency;

			$cur_sql = "SELECT * FROM tbl_currency";
			$curr_query = Yii::app()->db->createCommand($cur_sql)->queryAll();
			$select_html = '<select style="width:50px;" id="viewQuotationNew" qdoc_id="' . $qdoc_id . '" action_from="' . $action_from . '">';
			foreach ($curr_query as $fetched) {
				$curr_select = "";
				if ($fetched['curr_id'] == $curr_id) {
					$curr_select = "selected";
				}
				$select_html .= "<option curr_symbol=" . $fetched['curr_name'] . " value=" . $fetched['curr_id'] . " $curr_select >" . $fetched["curr_name"] . " " . $fetched["curr_desc"] . "</option>";
			}
			$select_html .= "</select>";

			$sql_comp = "SELECT tbl_comp_info.comp_logo,tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.comp_id='" . $comp_id . "'; ";
			$a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();
			$row_comp = $a_comp[0];
			$comp_logo = $row_comp["comp_logo"];
			$qnote_text = $row_comp["qnote_text"];

			$return_html = '<style type="text/css">';
			$return_html .= 'pre{ ';
			$return_html .= 'font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif; ';
			$return_html .= 'border:0px; ';
			$return_html .= 'background-color: #FFF; ';
			$return_html .= 'font-size: 14px; ';
			$return_html .= 'color: #000; ';
			$return_html .= 'line-height: 1.3; ';
			$return_html .= 'margin: 0px; ';
			$return_html .= '}';
			$return_html .= '</style>';

			$return_html .= '<table style="width:100%;"><tr><td style="width:50%; text-align:left;" id="head_img_logo_app">';

			if ($comp_logo != "") {
				//$return_html .= '<img style="max-height: 180px; max-width: 180px;" src="https://'.$_SERVER['SERVER_NAME'].'/salesrep/images/'.$comp_logo.'" >';
				$return_html .= '<img style="max-height: 180px; max-width: 180px;" src="' . Yii::app()->request->baseUrl . '/images/' . $comp_logo . '" >';
			}

			$return_html .= '</td>';
			$return_html .= '<td style="width:50%; text-align:right;">';
			$return_html .= '<h1 style="color:#000;">ESTIMATE</h1>';
			$old_curr_id = $curr_id;
			$return_html .= '<input type="hidden" value="' . $row_quote["curr_id"] . '" id="old_curr_id">';

			$return_html .= '<input type="hidden" name="curr_id" value="' . $curr_id . '">';
			$return_html .= '<input type="hidden" name="quote_curr" value="' . $row_curr["curr_name"] . '">';

			$return_html .= 'Payment Terms: ';

			if ($action_from == "va") {
				$return_html .= '<select name="payment_term" id="edit_payment_term">';
				$return_html .= '<option ' . (($row_quote["payment_term"] == "Net 15") ? "selected" : "") . ' value="Net 15">Net 15</option>';
				$return_html .= '<option ' . (($row_quote["payment_term"] == "Net 30") ? "selected" : "") . ' value="Net 30">Net 30</option>';
				$return_html .= '<option ' . (($row_quote["payment_term"] == "Payment Due at Order Confirmation") ? "selected" : "") . ' value="Payment Due at Order Confirmation">Payment Due at Order Confirmation</option>';
				$return_html .= '<option ' . (($row_quote["payment_term"] == "50% Due At Order Confirmation. Balance Due At Delivery") ? "selected" : "") . ' value="50% Due At Order Confirmation. Balance Due At Delivery">50% Due At Order Confirmation. Balance Due At Delivery</option>';
				$return_html .= '</select>';
			} else {
				$return_html .= $row_quote["payment_term"];
			}

			$return_html .= '<pre style="width:100%;" id="pre_comp_info_app"><b>' . $row_quote["comp_name"] . '</b><br>' . $row_quote["comp_info"] . '</pre>';
			$return_html .= '</td></tr><tr style="height:5px;"><td colspan="2"><hr></td></tr>';
			$return_html .= '<tr>';
			$return_html .= '<td style="text-align:left; padding:20px 0px;">';
			if ($action_from == "va") {
				$return_html .= '<select id="cust_selector" name="cust_selector" onchange="return changeCustomerV2();"><option value="">=Select Customer=</option>';
				$user_group = Yii::app()->user->getState('userGroup');
				$user_id = Yii::app()->user->getState('userKey');

				$more_condition = "";
				if ($user_group != "1" && $user_group != "99") {

					$more_condition = " AND user_id='" . $user_id . "' ";
				}
				$sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 " . $more_condition . " ORDER BY cust_name ASC; ";
				$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();
				$custom_selector = "";
				foreach ($a_cust as $tmp_key => $row_cust) {
					if ($row_quote['cust_id'] == $row_cust['cust_id']) {
						$custom_selector = "selected";
					}
					$return_html .= '<option ' . $custom_selector . ' value="' . $row_cust["cust_id"] . '">' . $row_cust["cust_name"] . '</option>';
					$custom_selector = "";
				}
				$return_html .= '</select><pre id="pr_show_cust_info"></pre>';
			}
			$return_html .= '<div class="bill_to">BILL TO<br>' . $row_quote["cust_name"];
			$return_html .= '<pre>' . $row_quote["cust_info"] . '</pre></div>';
			if ($action_from != "va") {
				$return_html .= '<a href="#" onclick="edit_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Edit <span id="cus_namer_' . $row_quote["cust_id"] . '">' . $row_quote["cust_name"] . '</span></a><span style="display: inline-block; font-size: 1.5em; margin: 0 5px;">&bull;</span><a href="#" onclick="change_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Change Customer</a>';
			}
			$return_html .= '</td>';
			$return_html .= '<td padding:20px 0px;">';
			$return_html .= '<table align="right" style="border-collapse: separate; border-spacing: 10px; color:#000;">';
			$return_html .= '<tr><th width="50%" style="text-align:right;">Estimate Number: </th><td style="color:#00F; text-align:left;" id="qdoc_number">' . $row_quote["est_number"] . '</td></tr>';
			$return_html .= '<tr>';
			$return_html .= '<th style="text-align:right;">PO Number: </th>';
			$return_html .= '<td style="text-align:left;" id="po_number">';
			$return_html .= '<span id="sp_po_number' . $qdoc_id . '">' . $row_quote["po_number"] . '</span> <i class="fa fa-pencil" style="cursor:pointer; font-size:16px; color:#00F;" onclick="return editPONumber(' . $qdoc_id . ');"></i>';
			$return_html .= '</td>';
			$return_html .= '</tr>';
			$return_html .= '<tr><th style="text-align:right;">Estimate Date: </th><td style="text-align:left;" id="show_est_date">' . date("F d, Y", strtotime($row_quote["est_date"])) . '</td></tr>';
			$return_html .= '<tr><th style="text-align:right;">Expires On: </th><td style="text-align:left;" id="show_exp_date">' . date("F d, Y", strtotime($row_quote["exp_date"])) . '</td></tr>';
			$return_html .= '<tr><th style="text-align:right;">Grand Total (' . $row_curr['curr_name'] . '): </th><td style="text-align:left;" id="td_grand_total_app">' . $pre_cost . number_format($row_quote["grand_total"] * $quote_currency, 2) . '</td></tr>';
			$return_html .= '</table>';
			$return_html .= '<input type="hidden" name="qdoc_id" id="qdoc_id" value="' . $qdoc_id . '">';
			$return_html .= '</td></tr>';
			$return_html .= '<tr><td colspan="2">';
			$return_html .= '<table style="color:#000; width:100%;" id="product_list">';
			$return_html .= '<tr style="font-size: 15px;"><th width="55%" style="text-align:left;">Product</th>';

			if ($action_from == "vc" || $action_from == "va") {
				$return_html .= '<th style="text-align:center; color:#999;">Comm.%</th><th style="text-align:center; color:#999;">Comm.</th>';
				$return_html .= '<th style="text-align:center; width:80px;">Quantity</th><th style="text-align:center; width:80px;">Price</th><th style="text-align:right; width:80px;">Amount</th><th style="text-align:right; width:10%"></th></tr>';
			} else {
				$return_html .= '<th style="text-align:center;">Quantity</th><th style="text-align:right; width:140px;">Price</th><th style="text-align:right; width:140px;">Amount</th></tr>';
			}

			$shipping = 0.0;

			$sql_qitem = "SELECT * FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND enable=1 AND product_status='1' ORDER BY sort ASC; ";
			$a_qitem = Yii::app()->db->createCommand($sql_qitem)->queryAll();

			$sql = "SELECT * FROM `tbl_quote_item` WHERE `qdoc_id` = '$qdoc_id' AND (`pro_name` LIKE '%Royalty%' OR `pro_name` LIKE '%Credit Card%' OR `pro_name` LIKE '%Shipping%')";
			$shipp = Yii::app()->db->createCommand($sql)->queryAll();
			if (isset($shipp[0])) {	
				foreach ($shipp as $key => $value) {		
					$shipping += $value['uprice'];
				}			
			}
			
			//$sub_total = 0.0;
			$sub_total_main = $row_quote["sub_total"];
			$sub_total = $row_quote["sub_total"] * $quote_currency;
			$comm_total = 0.0;

			$user_group = Yii::app()->user->getState('userGroup');

			foreach ($a_qitem as $tmp_key => $row_qitem) {

				$pro_id = $row_qitem["pro_id"];
				$qty = $row_qitem["qty"];
				$uprice = $row_qitem["uprice"] * $quote_currency;
				$comm_percent = $row_qitem["comm_percent"];
				$comm_value = "";
				$tmp_comm_percent = 0;
				if ($comm_percent != "") {
					$tmp_comm_percent = intval(str_replace("%", "", $comm_percent));
					$comm_value = ($qty * $uprice) * ($tmp_comm_percent / 100);
					$comm_total += $comm_value;
				}

				$tmp_amount = $qty * $uprice;

				$return_html .= '<tr><td style="padding:10px 0px; text-align:left; display: block; white-space: pre-wrap; word-wrap: break-word;">';
				/*$return_html .= '<input type="hidden" name="quote_curr" value="'.$_POST["quote_curr"].'">';
			$return_html .= '<input type="hidden" name="pro_id[]" value="'.$product_id.'">';
			$return_html .= '<input type="hidden" name="comm_percent[]" value="'.$_POST["comm_percent"][$i].'">';
			$return_html .= '<input type="hidden" name="qty_note[]" value="'.$_POST["qty_note"][$i].'">';
			$return_html .= '<input type="hidden" name="pro_type[]" value="'.$_POST["product_type"][$i].'">';
			$return_html .= '<input type="hidden" name="pro_name[]" value="'.base64_encode($_POST["product_item"][$i]).'">';
			$return_html .= '<input type="hidden" name="pro_desc[]" value="'.base64_encode($_POST["product_desc"][$i].$s_addi_name).'">';
			$return_html .= '<input type="hidden" name="qty[]" value="'.$_POST["qty"][$i].'">';
			$return_html .= '<input type="hidden" name="uprice[]" value="'.$tmp_uprice.'">';
			$return_html .= '<input type="hidden" name="addi_id_list[]" value="'.$s_addi_id.'">';*/

				if ($action_from == "va") {
					$return_html .= '<input type="hidden" name="qdoci_id[]" value="' . $row_qitem["qdoci_id"] . '">';
					$return_html .= '<input style="width:100%; font-weight:bold;" type="text" name="pro_name[]" value="' . htmlspecialchars($row_qitem["pro_name"]) . '">';
					$return_html .= '<br><textarea style="width:100%; min-height:70px;" name="pro_desc[]">' . $row_qitem["pro_desc"] . '</textarea>';
					if ($row_qitem["addi_desc"] != "") {
						$return_html .= $row_qitem["addi_desc"];
					}
				} else {
					$return_html .= '<b>' . htmlspecialchars($row_qitem["pro_name"]) . '</b><br>' . $row_qitem["pro_desc"];
				}

				$return_html .= '</td>';

				if ($action_from == "vc") {

					$return_html .= '<td style="text-align:center; color:#999;">' . (($tmp_comm_percent != 0) ? ($tmp_comm_percent . "%") : "0%");
					if ($user_group == "1" || $user_group == "99") {
						$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editCommAfterApprove(\'' . $qdoc_id . '\',\'' . $row_qitem["qdoci_id"] . '\',\'' . $tmp_comm_percent . '\');"></i>';
					}


					$return_html .= '</td>';
					$return_html .= '<td style="text-align:center; color:#999;">' . (($comm_value != "") ? number_format($comm_value * $quote_currency, 2) : "") . '</td>';
				} else if ($action_from == "va") {

					$return_html .= '<td style="text-align:center; color:#999;"><input type="hidden" value="' . $row_qitem["qdoci_id"] . '" class="qdoci_id_app">';
					$return_html .= '<input type="hidden" value="' . $tmp_amount . '" id="tmp_amount' . $row_qitem["qdoci_id"] . '">';
					$return_html .= '<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width:60px; text-align:center;" min="0" type="number" value="' . $tmp_comm_percent . '" id="comm_percent_app' . $row_qitem["qdoci_id"] . '"></td>';
					$return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app' . $row_qitem["qdoci_id"] . '">' . (($comm_value != "") ? number_format($comm_value * $quote_currency, 2) : "") . '</td>';
				}
				$return_html .= '<td style="text-align:center;">';
				if ($action_from == "va") {
					$return_html .= '<input name="app_qty[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:55px; text-align:center;" min="0" type="number" value="' . $qty . '" id="app_qty' . $row_qitem["qdoci_id"] . '">';
				} else {
					$return_html .= number_format($qty, 0);
				}
				$return_html .= '</td>';

				$return_html .= '<td style="text-align:right;">';
				if ($action_from == "va") {
					$return_html .= '<input name="app_uprice[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:70px; text-align:center;" min="0.00" type="number" value="' . $uprice . '" id="app_uprice' . $row_qitem["qdoci_id"] . '">';
				} else if ($action_from == "vc" && ($user_group == "1" || $user_group == "99")) {
					$return_html .= $pre_cost . number_format($uprice, 2);

					$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editUPriceAfterApprove(\'' . $qdoc_id . '\',\'' . $row_qitem["qdoci_id"] . '\',\'' . $uprice . '\');"></i>';
				} else {
					$return_html .= $pre_cost . number_format($uprice, 2);
				}
				$return_html .= '</td><td style="text-align:center;">' . $pre_cost . '<span id="sp_app_amount' . $row_qitem["qdoci_id"] . '">';

				if ($action_from == "va") {
					$return_html .= $tmp_amount;
				} else {
					$return_html .= number_format($tmp_amount, 2);
				}

				$return_html .= '</span></td>';

				if ($action_from == "va") {
					$return_html .= '<td style="text-align:center;cursor:pointer;" class="remover" qdoci_id="' . $row_qitem['qdoci_id'] . '"><i style="color:red;" class="fa fa-minus-circle"></i></td>';
				}

				$return_html .= '</tr>';

				//$sub_total += $tmp_amount;
			}

			$col_span = 4;
			$col_span2 = 2;
			if ($action_from == "vc" || $action_from == "va") {
				$col_span = 6;
				$col_span2 = 4;
			}
			$return_html .= '<tr><td colspan="' . $col_span . '" style="padding:0px;"><hr style="margin:0px;"></td></tr>';



			$vat_7percent = ($sub_total_main - $row_quote['actual_discount']) * 0.07 * $quote_currency;
			$f_total = 0.0;
			if ($row_quote["inc_vat"] == "yes" || $action_from == "va" || $action_from == "vb") {
				if ($action_from != "vp") {
					$return_html .= '<tr><td colspan="2"><span qdoc_id="' . $qdoc_id . '" class="btn btn-success add_row" style="padding:5px;">Add Row  <i class="fa fa-plus" aria-hidden="true"></i></span></td>';
				}
				if ($action_from == "vc" || $action_from == "va") {
					$return_html .= '<td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">' . number_format($comm_total, 2) . '</td><td>&nbsp;</td>';
				}
				$colspaner = '';
				$colspaner_1 = '';
				if ($action_from == "vp") {
					$colspaner = "colspan='3'";
					$colspaner_1 = "colspan='1'";
				}
				$return_html .= '<th ' . $colspaner . ' style="padding: 10px 0px; text-align:right;">Subtotal:</th>';
				$return_html .= '<td ' . $colspaner_1 . ' style="padding: 10px 0px; text-align:right;">' . $pre_cost . '<span id="sp_app_sub_total">' . $sub_total . '</span></td></tr>';

				if ($row_quote["inc_vat"] == "yes") {
					$f_total = ($sub_total - ($row_quote['actual_discount']) * $quote_currency) + $vat_7percent;
				} else {
					$f_total = $sub_total - ($row_quote['actual_discount'] * $quote_currency);
				}
				if ($action_from != "vp") {

					if ($row_quote["design_url"] != "" || $row_quote["design_url"] != NULL) {
						$return_html .= "<input type='hidden' id='tr_total' value='1'>";
						$return_html .= "<tr><th colspan='2'>Design URL</th></tr>";
						$return_html .= "<tr><td colspan='2' class='alert alert-success'><a style='color:white;' href=" . $row_quote["design_url"] . ">" . $row_quote["design_url"] . "</a></td></tr>";
					}

					$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Change Currency:</th><td style="padding: 10px 0px; text-align:right;"><span>' . $select_html . '</span></td></tr>';

					$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="discount_percent" class="number_disc_approval" data-shipp="'.$shipping.'" value="' . $row_quote['discount_percent'] . '" style="width:55px;"></span></td></tr>';

					$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="actual_discount" id="actual_disc_approval" data-shipp="'.$shipping.'" value="' . $row_quote['actual_discount'] * $quote_currency . '" style="width:55px;"></span></td></tr>';
				}

				$return_html .= "<input type='hidden' id='tr_total' value='0'>";

				if ($action_from == "vp" && $row_quote['actual_discount'] != "0") {
					$return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>' . $row_quote['discount_percent'] . '%</span></td></tr>';

					$return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>' . $pre_cost . number_format($row_quote['actual_discount'] * $quote_currency, 2) . '</span></td></tr>';
				}


				$return_html .= '<tr ><td rowspan="3" colspan="' . $col_span2 . '">';
				if ($row_quote["sale_note"] != "" && ($action_from == "va" || $action_from == "vb")) {
					$return_html .= 'Salesman Notes (<font color=red>Not shown in Estimate</font>)';
					if ($action_from == "vb") {
						$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_edit_sale_note" style="background-color:#DDD;" onclick="return editSaleNote(' . $qdoc_id . ');"><i class="fa fa-pencil" style="color:#00F;"></i> Edit</button>';
						$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_save_sale_note" style="background-color:#FFF;" disabled onclick="return saveSaleNote(' . $qdoc_id . ');"><i class="fa fa-floppy-o" style="color:#070;"></i> Save</button>';
					}

					$return_html .= '<br><pre class="alert alert-success" style="width:100%; height:100%; max-width:700px; overflow-x:auto;" id="pre_sale_note' . $qdoc_id . '">' . $row_quote["sale_note"] . '</pre>';
				} else {
					$return_html .= '&nbsp;';
				}

				if ($action_from == "va") {
					$return_html .= 'Comment (<font color=red>Not shown in Estimate and appear on the top after Approve or Reject.</font>)';
					$return_html .= '<div style="text-align:left;">';
					$return_html .= '<textarea name="approval_comment" id="approval_comment" style="width: 700px; height: 100px; min-height: 101px; margin: 3px;"></textarea>';
					$return_html .= '</div>';
				}

				$return_html .= '</td>';
				$return_html .= '<td style="padding: 10px 0px; text-align:right;">';
				$return_html .= '<input type="hidden" id="sub_total_app" value="' . $sub_total . '">';
				$return_html .= '<input type="hidden" id="pre_cost_app" value="' . $pre_cost . '">';
				$return_html .= '<input type="hidden" name="vat_value_app" id="vat_value_app" value="' . $vat_7percent . '">';
				$return_html .= '<input type="hidden" id="total_value_app" value="' . $f_total . '">';



				if ($row_quote["approve_status"] == "new" && ($user_group == "1" || $user_group == "99")) {
					$return_html .= '<span class="subnvat"><input type="checkbox" name="inc_vat_app" id="inc_vat_app" value="yes" onclick="changeIncludeVATApprove();" ';
					if ($row_quote["inc_vat"] == "yes") {
						$return_html .= 'checked';
					}
					$return_html .= '>';
				}
				$return_html .= ' VAT 7%:</span></td>';
				$return_html .= '<td style="padding: 10px 0px; text-align:right;"><span class="subnvat" id="sp_show_vat_value_app">';
				if ($row_quote["inc_vat"] == "yes") {
					$return_html .= $pre_cost . number_format($vat_7percent, 2);
				}
				$return_html .= '</span></td></tr>';

				$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Total:</span></th>';
				$return_html .= '<td style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat" id="sp_show_total_value_app">' . $pre_cost . number_format($f_total, 2) . '</span></td></tr>';


				$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total (' . $row_curr["curr_name"] . '):</th>';
				$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="' . $pre_cost . '">' . $pre_cost . number_format($f_total, 2) . '</span></th></tr>';
			} else {
				//$f_total = $sub_total;
				$f_total = $row_quote["grand_total"] * $quote_currency;
				$return_html .= '<tr ><td>&nbsp;</td>';
				$colspan_grand = "colspan='2'";
				if ($action_from == "vc" || $action_from == "va") {
					$return_html .= '<td>&nbsp;</td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">' . number_format($comm_total, 2) . '</td>';
				}
				if ($action_from == "vp" && $row_quote['actual_discount'] != "0") {
					$return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>' . $row_quote['discount_percent'] . '%</span></td></tr>';

					$return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>' . $pre_cost . number_format($row_quote['actual_discount'], 2) . '</span></td></tr>';
					$colspan_grand = "colspan='3'";
				}
				$return_html .= '<th ' . $colspan_grand . ' style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total (' . $row_quote["quote_curr"] . '):</th>';
				$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="' . $pre_cost . '">' . $pre_cost . number_format($f_total, 2) . '</span></th></tr>';
			}



			$return_html .= '</table>';
			$return_html .= '</td></tr>';

			$return_html .= '</table>';

			if ($row_quote["approve_status"] != "new" && $row_quote["note"] != "") {
				$return_html .= '<b>Notes</b> ';
				$return_html .= '<pre ';
				if ($row_quote["approve_status"] == "reject") {
					$return_html .= ' class="alert alert-dark" ';
				}
				$return_html .= '>' . $row_quote["note"] . '</pre>';
			}

			//print_r($return_html);

			$a_result["inner_content"] = $return_html;

			$a_result["show_approve"] = "no";
			$a_result["show_reject"] = "no";
			$a_result["show_print"] = "no";

			$a_result["comp_id"] = $comp_id;
			$a_result["qnote_text"] = base64_encode($qnote_text);

			$a_result["history_inner"] = "";

			$a_result["approval_comment"] = "";
			if ($row_quote["approval_comment"] != "") {
				$a_result["approval_comment"] = base64_encode('<div><center><pre class="alert" style="text-align:left; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;" id="approval_comment' . $qdoc_id . '">' . $row_quote["approval_comment"] . '</pre></center></div>');
			}

			if ($approve_status == "new") {

				$a_result["show_approve"] = "yes";
				$a_result["show_reject"] = "yes";

				if ($row_quote["history_qdoc_id"] != "") {

					$a_result["history_inner"] .= '<option value="' . $qdoc_id . '">==Main Document==</option>';

					$sql_history = "SELECT qdoc_id,add_date FROM tbl_quote_doc WHERE qdoc_id IN (" . rtrim($row_quote["history_qdoc_id"], ',') . ") ORDER BY add_date DESC; ";
					//$a_result["history_inner"] .= $sql_history;
					$a_history = Yii::app()->db->createCommand($sql_history)->queryAll();
					foreach ($a_history as $tmp_key_his => $row_history) {
						$a_result["history_inner"] .= '<option value="' . $row_history["qdoc_id"] . '">' . $row_history["add_date"] . '</option>';
					}
				}
			} else if ($approve_status == "approve") {

				$a_result["show_print"] = "yes";
			}

			echo json_encode($a_result);
		}
	}

	public function actionShowQuoteViewDraft()
	{
		$qdoc_id = $_POST["qdoc_id"];

		$sql_quote = "SELECT * FROM tbl_quote_doc_draft WHERE qdoc_id='" . $qdoc_id . "'; ";
		$a_quote = Yii::app()->db->createCommand($sql_quote)->queryAll();
		$row_quote = $a_quote[0];
		$comp_id = $row_quote["comp_id"];

		$action_from = $_POST["action_from"];

		$approve_status = $row_quote["approve_status"];

		$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $row_quote["curr_id"] . "'; ";
		$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();
		$row_curr = $a_curr[0];
		$pre_cost = $row_curr["curr_symbol"];

		$cur_sql = "SELECT * FROM tbl_currency";
		$curr_query = Yii::app()->db->createCommand($cur_sql)->queryAll();
		$select_html = '<select style="width:50px;" id="viewQuotationNew" qdoc_id="' . $qdoc_id . '" action_from="' . $action_from . '")">';
		foreach ($curr_query as $fetched) {
			$curr_select = "";
			if ($fetched['curr_id'] == $row_quote["curr_id"]) {
				$curr_select = "selected";
			}
			$select_html .= "<option curr_symbol=" . $fetched['curr_name'] . " value=" . $fetched['curr_id'] . " $curr_select >" . $fetched["curr_name"] . " " . $fetched["curr_desc"] . "</option>";
		}
		$select_html .= '</select>';

		$sql_comp = "SELECT tbl_comp_info.comp_logo,tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.comp_id='" . $comp_id . "'; ";
		$a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();
		$row_comp = $a_comp[0];
		$comp_logo = $row_comp["comp_logo"];
		$qnote_text = $row_comp["qnote_text"];

		$return_html = '<style type="text/css">';
		$return_html .= 'pre{ ';
		$return_html .= 'font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif; ';
		$return_html .= 'border:0px; ';
		$return_html .= 'background-color: #FFF; ';
		$return_html .= 'font-size: 14px; ';
		$return_html .= 'color: #000; ';
		$return_html .= 'line-height: 1.3; ';
		$return_html .= 'margin: 0px; ';
		$return_html .= '}';
		$return_html .= '</style>';

		$return_html .= '<table style="width:100%;"><tr><td style="width:50%; text-align:left;" id="head_img_logo_app">';

		if ($comp_logo != "") {
			//$return_html .= '<img style="max-height: 180px; max-width: 180px;" src="https://'.$_SERVER['SERVER_NAME'].'/salesrep/images/'.$comp_logo.'" >';
			$return_html .= '<img style="max-height: 180px; max-width: 180px;" src="' . Yii::app()->request->baseUrl . '/images/' . $comp_logo . '" >';
		}


		$return_html .= '</td>';
		$return_html .= '<td style="width:50%; text-align:right;">';
		$old_curr_id = $row_quote["curr_id"];
		$return_html .= '<input type="hidden" value="' . $row_quote["curr_id"] . '" id="old_curr_id">';

		$return_html .= '<input type="hidden" name="curr_id" value="' . $row_curr["curr_id"] . '">';
		$return_html .= '<input type="hidden" name="quote_curr" value="' . $row_curr["curr_name"] . '">';

		$return_html .= '<h1 style="color:#000;">ESTIMATE(Orignal Draft)</h1>';
		$return_html .= 'Payment Terms: ';

		if ($action_from == "va") {
			$return_html .= '<select name="payment_term" id="edit_payment_term">';
			$return_html .= '<option ' . (($row_quote["payment_term"] == "Net 15") ? "selected" : "") . ' value="Net 15">Net 15</option>';
			$return_html .= '<option ' . (($row_quote["payment_term"] == "Net 30") ? "selected" : "") . ' value="Net 30">Net 30</option>';
			$return_html .= '<option ' . (($row_quote["payment_term"] == "Payment Due at Order Confirmation") ? "selected" : "") . ' value="Payment Due at Order Confirmation">Payment Due at Order Confirmation</option>';
			$return_html .= '<option ' . (($row_quote["payment_term"] == "50% Due At Order Confirmation. Balance Due At Delivery") ? "selected" : "") . ' value="50% Due At Order Confirmation. Balance Due At Delivery">50% Due At Order Confirmation. Balance Due At Delivery</option>';
			$return_html .= '<option ' . (($row_quote["payment_term"] == "Balance Due before Ship Date") ? "selected" : "") . ' value="Balance Due before Ship Date">Balance Due before Ship Date</option>';
			$return_html .= '<option ' . (($row_quote["payment_term"] == "50% Down Payment. Balance Due Net 15") ? "selected" : "") . ' value="50% Down Payment. Balance Due Net 15">50% Down Payment. Balance Due Net 15</option>';
			$return_html .= '<option ' . (($row_quote["payment_term"] == "50% Down Payment. Balance Due at Delivery") ? "selected" : "") . ' value="50% Down Payment. Balance Due at Delivery">50% Down Payment. Balance Due at Delivery</option>';
			$return_html .= '</select>';
		} else {
			$return_html .= $row_quote["payment_term"];
		}

		$return_html .= '<pre style="width:100%;" id="pre_comp_info_app"><b>' . $row_quote["comp_name"] . '</b><br>' . $row_quote["comp_info"] . '</pre>';
		$return_html .= '</td></tr><tr style="height:5px;"><td colspan="2"><hr></td></tr>';
		$return_html .= '<tr>';
		$return_html .= '<td style="text-align:left; padding:20px 0px;">';
		if ($action_from == "va") {
			$return_html .= '<select id="cust_selector" name="cust_selector" onchange="return changeCustomerV2();"><option value="">=Select Customer=</option>';
			$user_group = Yii::app()->user->getState('userGroup');
			$user_id = Yii::app()->user->getState('userKey');

			$more_condition = "";
			if ($user_group != "1" && $user_group != "99") {

				$more_condition = " AND user_id='" . $user_id . "' ";
			}
			$sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 " . $more_condition . " ORDER BY cust_name ASC; ";
			$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();
			$custom_selector = "";
			foreach ($a_cust as $tmp_key => $row_cust) {
				if ($row_quote['cust_id'] == $row_cust['cust_id']) {
					$custom_selector = "selected";
				}
				$return_html .= '<option ' . $custom_selector . ' value="' . $row_cust["cust_id"] . '">' . $row_cust["cust_name"] . '</option>';
				$custom_selector = "";
			}
			$return_html .= '</select><pre id="pr_show_cust_info"></pre>';
		}
		if ($action_from == "vp") {
			$return_html .= '<select id="cust_selector" name="cust_selector" onchange="return changeCustomerV3(' . $qdoc_id . ');"><option value="">=Select Customer=</option>';
			$user_group = Yii::app()->user->getState('userGroup');
			$user_id = Yii::app()->user->getState('userKey');

			$more_condition = "";
			if ($user_group != "1" && $user_group != "99") {

				$more_condition = " AND user_id='" . $user_id . "' ";
			}
			$sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 " . $more_condition . " ORDER BY cust_name ASC; ";
			$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();
			$custom_selector = "";
			foreach ($a_cust as $tmp_key => $row_cust) {
				if ($row_quote['cust_id'] == $row_cust['cust_id']) {
					$custom_selector = "selected";
				}
				$return_html .= '<option ' . $custom_selector . ' value="' . $row_cust["cust_id"] . '">' . $row_cust["cust_name"] . '</option>';
				$custom_selector = "";
			}
			$return_html .= '</select><pre id="pr_show_cust_info"></pre>';
		}
		$return_html .= '<div class="bill_to">BILL TO<br>' . $row_quote["cust_name"];
		$return_html .= '<pre>' . $row_quote["cust_info"] . '</pre></div>';
		if ($action_from != "va") {
			$return_html .= '<a href="#" onclick="edit_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Edit <span id="cus_namer_' . $row_quote["cust_id"] . '">' . $row_quote["cust_name"] . '</span></a><span style="display: inline-block; font-size: 1.5em; margin: 0 5px;">&bull;</span><a href="#" onclick="change_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Change Customer</a>';
		}
		$return_html .= '</td>';
		$return_html .= '<td padding:20px 0px;">';
		$return_html .= '<table align="right" style="border-collapse: separate; border-spacing: 10px; color:#000;">';
		$return_html .= '<tr><th width="50%" style="text-align:right;">Estimate Number: </th><td style="color:#00F; text-align:left;" id="qdoc_number">' . $row_quote["est_number"] . '</td></tr>';
		$return_html .= '<tr>';
		$return_html .= '<th style="text-align:right;">PO Number: </th>';
		$return_html .= '<td style="text-align:left;" id="po_number">';
		$return_html .= '<span id="sp_po_number' . $qdoc_id . '">' . $row_quote["po_number"] . '</span> <i class="fa fa-pencil" style="cursor:pointer; font-size:16px; color:#00F;" onclick="return editPONumber(' . $qdoc_id . ');"></i>';
		$return_html .= '</td>';
		$return_html .= '</tr>';
		$return_html .= '<tr><th style="text-align:right;">Estimate Date: </th><td style="text-align:left;" id="show_est_date">' . date("F d, Y", strtotime($row_quote["est_date"])) . '</td></tr>';
		$return_html .= '<tr><th style="text-align:right;">Expires On: </th><td style="text-align:left;" id="show_exp_date">' . date("F d, Y", strtotime($row_quote["exp_date"])) . '</td></tr>';
		$return_html .= '<tr><th style="text-align:right;">Grand Total (' . $row_quote["quote_curr"] . '): </th><td style="text-align:left;" id="td_grand_total_app">' . $pre_cost . number_format($row_quote["grand_total"], 2) . '</td></tr>';
		$return_html .= '</table>';
		$return_html .= '<input type="hidden" name="qdoc_id" id="qdoc_id" value="' . $qdoc_id . '">';
		$return_html .= '</td></tr>';
		$return_html .= '<tr><td colspan="2">';
		$return_html .= '<table style="color:#000; width:100%;" id="product_list">';
		$return_html .= '<tr style="font-size: 15px;"><th width="55%" style="text-align:left;">Product</th>';

		if ($action_from == "vc" || $action_from == "va") {
			$return_html .= '<th style="text-align:center; color:#999;">Comm.%</th><th style="text-align:center; color:#999;">Comm.</th>';
			$return_html .= '<th style="text-align:center; width:80px;">Quantity</th><th style="text-align:center; width:80px;">Price</th><th style="text-align:right; width:80px;">Amount</th><th style="text-align:right; width:10%"></th></tr>';
		} else {
			$return_html .= '<th style="text-align:center;">Quantity</th><th style="text-align:right; width:140px;">Price</th><th style="text-align:right; width:140px;">Amount</th></tr>';
		}
		$shipping = 0.0;

		$sql_qitem = "SELECT * FROM tbl_quote_item_draft WHERE qdoc_id='" . $qdoc_id . "' AND enable=1 AND product_status='1' ORDER BY sort ASC; ";
		$a_qitem = Yii::app()->db->createCommand($sql_qitem)->queryAll();

		$sql = "SELECT * FROM `tbl_quote_item` WHERE `qdoc_id` = '$qdoc_id' AND (`pro_name` LIKE '%Royalty%' OR `pro_name` LIKE '%Credit Card%' OR `pro_name` LIKE '%Shipping%')";
		$shipp = Yii::app()->db->createCommand($sql)->queryAll();
		if (isset($shipp[0])) {	
			foreach ($shipp as $key => $value) {
		
				$shipping += $value['uprice'];
			}			
		}

		//$sub_total = 0.0;
		$sub_total = $row_quote["sub_total"];
		$comm_total = 0.0;

		$user_group = Yii::app()->user->getState('userGroup');

		foreach ($a_qitem as $tmp_key => $row_qitem) {

			$pro_id = $row_qitem["pro_id"];
			$qty = $row_qitem["qty"];
			$uprice = $row_qitem["uprice"];
			$comm_percent = $row_qitem["comm_percent"];
			$comm_value = "";
			$tmp_comm_percent = 0;
			if ($comm_percent != "") {
				$tmp_comm_percent = intval(str_replace("%", "", $comm_percent));
				$comm_value = ($qty * $uprice) * ($tmp_comm_percent / 100);
				$comm_total += $comm_value;
			}

			$tmp_amount = $qty * $uprice;

			$return_html .= '<tr><td style="padding:10px 0px; text-align:left; display: block; white-space: pre-wrap; word-wrap: break-word;">';
			/*$return_html .= '<input type="hidden" name="quote_curr" value="'.$_POST["quote_curr"].'">';
			$return_html .= '<input type="hidden" name="pro_id[]" value="'.$product_id.'">';
			$return_html .= '<input type="hidden" name="comm_percent[]" value="'.$_POST["comm_percent"][$i].'">';
			$return_html .= '<input type="hidden" name="qty_note[]" value="'.$_POST["qty_note"][$i].'">';
			$return_html .= '<input type="hidden" name="pro_type[]" value="'.$_POST["product_type"][$i].'">';
			$return_html .= '<input type="hidden" name="pro_name[]" value="'.base64_encode($_POST["product_item"][$i]).'">';
			$return_html .= '<input type="hidden" name="pro_desc[]" value="'.base64_encode($_POST["product_desc"][$i].$s_addi_name).'">';
			$return_html .= '<input type="hidden" name="qty[]" value="'.$_POST["qty"][$i].'">';
			$return_html .= '<input type="hidden" name="uprice[]" value="'.$tmp_uprice.'">';
			$return_html .= '<input type="hidden" name="addi_id_list[]" value="'.$s_addi_id.'">';*/

			if ($action_from == "va") {
				$return_html .= '<input type="hidden" name="qdoci_id[]" value="' . $row_qitem["qdoci_id"] . '">';
				$return_html .= '<input style="width:100%; font-weight:bold;" type="text" name="pro_name[]" value="' . htmlspecialchars($row_qitem["pro_name"]) . '">';
				$return_html .= '<br><textarea style="width:100%; min-height:70px;" name="pro_desc[]">' . $row_qitem["pro_desc"] . '</textarea>';
				if ($row_qitem["addi_desc"] != "") {
					$return_html .= $row_qitem["addi_desc"];
				}
			} else {
				$return_html .= '<b>' . htmlspecialchars($row_qitem["pro_name"]) . '</b><br>' . $row_qitem["pro_desc"];
			}

			$return_html .= '</td>';

			if ($action_from == "vc") {

				$return_html .= '<td style="text-align:center; color:#999;">' . (($tmp_comm_percent != 0) ? ($tmp_comm_percent . "%") : "0%");
				if ($user_group == "1" || $user_group == "99") {
					$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editCommAfterApprove(\'' . $qdoc_id . '\',\'' . $row_qitem["qdoci_id"] . '\',\'' . $tmp_comm_percent . '\');"></i>';
				}


				$return_html .= '</td>';
				$return_html .= '<td style="text-align:center; color:#999;">' . (($comm_value != "") ? number_format($comm_value, 2) : "0") . '</td>';
			} else if ($action_from == "va") {

				$return_html .= '<td style="text-align:center; color:#999;"><input type="hidden" value="' . $row_qitem["qdoci_id"] . '" class="qdoci_id_app">';
				$return_html .= '<input type="hidden" value="' . $tmp_amount . '" id="tmp_amount' . $row_qitem["qdoci_id"] . '">';
				$return_html .= '<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width:60px; text-align:center;" min="0" type="number" value="' . $tmp_comm_percent . '" id="comm_percent_app' . $row_qitem["qdoci_id"] . '"></td>';
				$return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app' . $row_qitem["qdoci_id"] . '">' . (($comm_value != "") ? number_format($comm_value, 2) : "0") . '</td>';
			}
			$return_html .= '<td style="text-align:center;">';
			if ($action_from == "va") {
				$return_html .= '<input name="app_qty[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:55px; text-align:center;" min="0" type="number" value="' . $qty . '" id="app_qty' . $row_qitem["qdoci_id"] . '">';
			} else {
				$return_html .= number_format($qty, 0);
			}
			$return_html .= '</td>';

			$return_html .= '<td style="text-align:right;">';
			if ($action_from == "va") {
				$return_html .= '<input name="app_uprice[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:70px; text-align:center;" min="0.00" type="number" value="' . $uprice . '" id="app_uprice' . $row_qitem["qdoci_id"] . '">';
			} else if ($action_from == "vc" && ($user_group == "1" || $user_group == "99")) {
				$return_html .= $pre_cost . number_format($uprice, 2);

				$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editUPriceAfterApprove(\'' . $qdoc_id . '\',\'' . $row_qitem["qdoci_id"] . '\',\'' . $uprice . '\');"></i>';
			} else {
				$return_html .= $pre_cost . number_format($uprice, 2);
			}
			$return_html .= '</td><td style="text-align:center;">' . $pre_cost . '<span id="sp_app_amount' . $row_qitem["qdoci_id"] . '">';

			if ($action_from == "va") {
				$return_html .= $tmp_amount;
			} else {
				$return_html .= number_format($tmp_amount, 2);
			}

			$return_html .= '</span></td>';

			if ($action_from == "va") {
				$return_html .= '<td style="text-align:center;cursor:pointer;" class="remover" qdoci_id="' . $row_qitem['qdoci_id'] . '"><i style="color:red;" class="fa fa-minus-circle"></i></td>';
			}

			$return_html .= '</tr>';

			//$sub_total += $tmp_amount;
		}

		$col_span = 4;
		$col_span2 = 2;
		if ($action_from == "vc" || $action_from == "va") {
			$col_span = 6;
			$col_span2 = 4;
		}
		$return_html .= '<tr><td colspan="' . $col_span . '" style="padding:0px;"><hr style="margin:0px;"></td></tr>';



		$vat_7percent = ($sub_total - $row_quote['actual_discount']) * 0.07;

		$f_total = 0.0;
		if ($row_quote["inc_vat"] == "yes" || $action_from == "va" || $action_from == "vb") {
			if ($action_from != "vp") {
				$return_html .= '<tr><td colspan="2"><span qdoc_id="' . $qdoc_id . '" class="btn btn-success add_row" style="padding:5px;">Add Row  <i class="fa fa-plus" aria-hidden="true"></i></span></td>';
			}
			if ($action_from == "vc" || $action_from == "va") {
				$return_html .= '<td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">' . number_format($comm_total, 2) . '</td><td>&nbsp;</td>';
			}
			$colspaner = '';
			$colspaner_1 = '';
			if ($action_from == "vp") {
				$colspaner = "colspan='3'";
				$colspaner_1 = "colspan='1'";
			}
			$return_html .= '<th ' . $colspaner . ' style="padding: 10px 0px; text-align:right;">Subtotal:</th>';
			$return_html .= '<td ' . $colspaner_1 . ' style="padding: 10px 0px; text-align:right;">' . $pre_cost . '<span id="sp_app_sub_total">' . $sub_total . '</span></td></tr>';

			if ($row_quote["inc_vat"] == "yes") {
				$f_total = ($sub_total - $row_quote['actual_discount']) + $vat_7percent;
			} else {
				$f_total = $sub_total - $row_quote['actual_discount'];
			}
			if ($action_from != "vp") {

				if ($row_quote["design_url"] != "" || $row_quote["design_url"] != NULL) {
					$return_html .= "<input type='hidden' id='tr_total' value='1'>";
					$return_html .= "<tr><th colspan='2'>Design URL</th></tr>";
					$return_html .= "<tr><td colspan='2' class='alert alert-success'><a style='color:white;' href=" . $row_quote["design_url"] . ">" . $row_quote["design_url"] . "</a></td></tr>";
				}

				$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Change Currency:</th><td style="padding: 10px 0px; text-align:right;"><span>' . $select_html . '</span></td></tr>';

				$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="discount_percent" class="number_disc_approval" data-shipp="'.$shipping.'"  value="' . $row_quote['discount_percent'] . '" style="width:55px;"></span></td></tr>';

				$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="actual_discount" id="actual_disc_approval" data-shipp="'.$shipping.'"  value="' . $row_quote['actual_discount'] . '" style="width:55px;"></span></td></tr>';
			}

			$return_html .= "<input type='hidden' id='tr_total' value='0'>";

			if ($action_from == "vp" && $row_quote['actual_discount'] != "0") {
				$return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>' . $row_quote['discount_percent'] . '%</span></td></tr>';

				$return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>' . $pre_cost . number_format($row_quote['actual_discount'], 2) . '</span></td></tr>';
			}


			$return_html .= '<tr ><td rowspan="3" colspan="' . $col_span2 . '">';
			if ($row_quote["sale_note"] != "" && ($action_from == "va" || $action_from == "vb")) {
				$return_html .= 'Salesman Notes (<font color=red>Not shown in Estimate</font>)';
				if ($action_from == "vb") {
					$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_edit_sale_note" style="background-color:#DDD;" onclick="return editSaleNote(' . $qdoc_id . ');"><i class="fa fa-pencil" style="color:#00F;"></i> Edit</button>';
					$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_save_sale_note" style="background-color:#FFF;" disabled onclick="return saveSaleNote(' . $qdoc_id . ');"><i class="fa fa-floppy-o" style="color:#070;"></i> Save</button>';
				}

				$return_html .= '<br><pre class="alert alert-success" style="width:100%; height:100%; max-width:700px; overflow-x:auto;" id="pre_sale_note' . $qdoc_id . '">' . $row_quote["sale_note"] . '</pre>';
			} else {
				$return_html .= '&nbsp;';
			}

			if ($action_from == "va") {
				$return_html .= 'Comment (<font color=red>Not shown in Estimate and appear on the top after Approve or Reject.</font>)';
				$return_html .= '<div style="text-align:left;">';
				$return_html .= '<textarea name="approval_comment" id="approval_comment" style="width: 700px; height: 100px; min-height: 101px; margin: 3px;"></textarea>';
				$return_html .= '</div>';
			}

			$return_html .= '</td>';
			$return_html .= '<td style="padding: 10px 0px; text-align:right;">';
			$return_html .= '<input type="hidden" id="sub_total_app" value="' . $sub_total . '">';
			$return_html .= '<input type="hidden" id="pre_cost_app" value="' . $pre_cost . '">';
			$return_html .= '<input type="hidden" name="vat_value_app" id="vat_value_app" value="' . $vat_7percent . '">';
			$return_html .= '<input type="hidden" id="total_value_app" value="' . $f_total . '">';



			if ($row_quote["approve_status"] == "new" && ($user_group == "1" || $user_group == "99")) {
				$return_html .= '<span class="subnvat"><input type="checkbox" name="inc_vat_app" id="inc_vat_app" value="yes" onclick="changeIncludeVATApprove();" ';
				if ($row_quote["inc_vat"] == "yes") {
					$return_html .= 'checked';
				}
				$return_html .= '>';
			}
			$return_html .= ' VAT 7%:</span></td>';
			$return_html .= '<td style="padding: 10px 0px; text-align:right;"><span class="subnvat" id="sp_show_vat_value_app">';
			if ($row_quote["inc_vat"] == "yes") {
				$return_html .= $pre_cost . number_format($vat_7percent, 2);
			}
			$return_html .= '</span></td></tr>';

			$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Total:</span></th>';
			$return_html .= '<td style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat" id="sp_show_total_value_app">' . $pre_cost . number_format($f_total, 2) . '</span></td></tr>';


			$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total (' . $row_quote["quote_curr"] . '):</th>';
			$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="' . $pre_cost . '">' . $pre_cost . number_format($f_total, 2) . '</span></th></tr>';
		} else {
			//$f_total = $sub_total;
			$f_total = $row_quote["grand_total"];
			$return_html .= '<tr ><td>&nbsp;</td>';
			$colspan_grand = "colspan='2'";
			if ($action_from == "vc" || $action_from == "va") {
				$return_html .= '<td>&nbsp;</td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">' . number_format($comm_total, 2) . '</td>';
			}
			if ($action_from == "vp" && $row_quote['actual_discount'] != "0") {
				$return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>' . $row_quote['discount_percent'] . '%</span></td></tr>';

				$return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>' . $pre_cost . number_format($row_quote['actual_discount'], 2) . '</span></td></tr>';
				$colspan_grand = "colspan='3'";
			}
			$return_html .= '<th ' . $colspan_grand . ' style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total (' . $row_quote["quote_curr"] . '):</th>';
			$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="' . $pre_cost . '">' . $pre_cost . number_format($f_total, 2) . '</span></th></tr>';
		}



		$return_html .= '</table>';
		$return_html .= '</td></tr>';

		$return_html .= '</table>';

		if ($row_quote["approve_status"] != "new" && $row_quote["note"] != "") {
			$return_html .= '<b>Notes</b> ';
			$return_html .= '<pre ';
			if ($row_quote["approve_status"] == "reject") {
				$return_html .= ' class="alert alert-dark" ';
			}
			$return_html .= '>' . $row_quote["note"] . '</pre>';
		}

		//print_r($return_html);

		$a_result["inner_content"] = $return_html;

		$a_result["show_approve"] = "no";
		$a_result["show_reject"] = "no";
		$a_result["show_print"] = "no";

		$a_result["comp_id"] = $comp_id;
		$a_result["qnote_text"] = base64_encode($qnote_text);

		$a_result["history_inner"] = "";

		$a_result["approval_comment"] = "";
		if ($row_quote["approval_comment"] != "") {
			$a_result["approval_comment"] = base64_encode('<div><center><pre class="alert" style="text-align:left; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;" id="approval_comment' . $qdoc_id . '">' . $row_quote["approval_comment"] . '</pre></center></div>');
		}

		if ($approve_status == "new") {

			$a_result["show_approve"] = "yes";
			$a_result["show_reject"] = "yes";

			if ($row_quote["history_qdoc_id"] != "") {

				$a_result["history_inner"] .= '<option value="' . $qdoc_id . '">==Main Document==</option>';

				$sql_history = "SELECT qdoc_id,add_date FROM tbl_quote_doc WHERE qdoc_id IN (" . rtrim($row_quote["history_qdoc_id"], ',') . ") ORDER BY add_date DESC; ";
				//$a_result["history_inner"] .= $sql_history;
				$a_history = Yii::app()->db->createCommand($sql_history)->queryAll();
				foreach ($a_history as $tmp_key_his => $row_history) {
					$a_result["history_inner"] .= '<option value="' . $row_history["qdoc_id"] . '">' . $row_history["add_date"] . '</option>';
				}
			}
		} else if ($approve_status == "approve") {

			$a_result["show_print"] = "yes";
		}

		echo json_encode($a_result);
	}

	public function actionShowQuoteView()
	{
		$qdoc_id = $_POST["qdoc_id"];

		$sql_quote = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $qdoc_id . "'; ";
		$a_quote = Yii::app()->db->createCommand($sql_quote)->queryAll();
		$row_quote = $a_quote[0];
		$comp_id = $row_quote["comp_id"];

		$action_from = $_POST["action_from"];

		$approve_status = $row_quote["approve_status"];

		$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $row_quote["curr_id"] . "'; ";
		$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();
		$row_curr = $a_curr[0];
		$pre_cost = $row_curr["curr_symbol"];

		$cur_sql = "SELECT * FROM tbl_currency";
		$curr_query = Yii::app()->db->createCommand($cur_sql)->queryAll();
		$select_html = '<select style="width:50px;" id="viewQuotationNew" qdoc_id="' . $qdoc_id . '" action_from="' . $action_from . '")">';
		foreach ($curr_query as $fetched) {
			$curr_select = "";
			if ($fetched['curr_id'] == $row_quote["curr_id"]) {
				$curr_select = "selected";
			}
			$select_html .= "<option curr_symbol=" . $fetched['curr_name'] . " value=" . $fetched['curr_id'] . " $curr_select >" . $fetched["curr_name"] . " " . $fetched["curr_desc"] . "</option>";
		}
		$select_html .= '</select>';

		$sql_comp = "SELECT tbl_comp_info.comp_logo,tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.comp_id='" . $comp_id . "'; ";
		$a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();
		$row_comp = $a_comp[0];
		$comp_logo = $row_comp["comp_logo"];
		$qnote_text = $row_comp["qnote_text"];

		$return_html = '<style type="text/css">';
		$return_html .= 'pre{ ';
		$return_html .= 'font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif; ';
		$return_html .= 'border:0px; ';
		$return_html .= 'background-color: #FFF; ';
		$return_html .= 'font-size: 14px; ';
		$return_html .= 'color: #000; ';
		$return_html .= 'line-height: 1.3; ';
		$return_html .= 'margin: 0px; ';
		$return_html .= '}';
		$return_html .= '</style>';

		$return_html .= '<table style="width:100%;"><tr><td style="width:50%; text-align:left;" id="head_img_logo_app">';

		if ($comp_logo != "") {
			//$return_html .= '<img style="max-height: 180px; max-width: 180px;" src="https://'.$_SERVER['SERVER_NAME'].'/salesrep/images/'.$comp_logo.'" >';
			$return_html .= '<img style="max-height: 180px; max-width: 180px;" src="' . Yii::app()->request->baseUrl . '/images/' . $comp_logo . '" >';
		}


		$return_html .= '</td>';
		$return_html .= '<td style="width:50%; text-align:right;">';
		$old_curr_id = $row_quote["curr_id"];
		$return_html .= '<input type="hidden" value="' . $row_quote["curr_id"] . '" id="old_curr_id">';

		$return_html .= '<input type="hidden" name="curr_id" value="' . $row_curr["curr_id"] . '">';
		$return_html .= '<input type="hidden" name="quote_curr" value="' . $row_curr["curr_name"] . '">';

		$return_html .= '<h1 style="color:#000;">ESTIMATE</h1>';
		$return_html .= 'Payment Terms: ';

		if ($action_from == "va") {
			$return_html .= '<select name="payment_term" id="edit_payment_term">';
			$return_html .= '<option ' . (($row_quote["payment_term"] == "Net 15") ? "selected" : "") . ' value="Net 15">Net 15</option>';
			$return_html .= '<option ' . (($row_quote["payment_term"] == "Net 30") ? "selected" : "") . ' value="Net 30">Net 30</option>';
			$return_html .= '<option ' . (($row_quote["payment_term"] == "Payment Due at Order Confirmation") ? "selected" : "") . ' value="Payment Due at Order Confirmation">Payment Due at Order Confirmation</option>';
			$return_html .= '<option ' . (($row_quote["payment_term"] == "50% Due At Order Confirmation. Balance Due At Delivery") ? "selected" : "") . ' value="50% Due At Order Confirmation. Balance Due At Delivery">50% Due At Order Confirmation. Balance Due At Delivery</option>';
			$return_html .= '<option ' . (($row_quote["payment_term"] == "Balance Due before Ship Date") ? "selected" : "") . ' value="Balance Due before Ship Date">Balance Due before Ship Date</option>';
			$return_html .= '<option ' . (($row_quote["payment_term"] == "50% Down Payment. Balance Due Net 15") ? "selected" : "") . ' value="50% Down Payment. Balance Due Net 15">50% Down Payment. Balance Due Net 15</option>';
			$return_html .= '<option ' . (($row_quote["payment_term"] == "50% Down Payment. Balance Due at Delivery") ? "selected" : "") . ' value="50% Down Payment. Balance Due at Delivery">50% Down Payment. Balance Due at Delivery</option>';
			$return_html .= '</select>';
		} else {
			$return_html .= $row_quote["payment_term"];
		}

		$return_html .= '<pre style="width:100%;" id="pre_comp_info_app"><b>' . $row_quote["comp_name"] . '</b><br>' . $row_quote["comp_info"] . '</pre>';
		$return_html .= '</td></tr><tr style="height:5px;"></tr>';
		$return_html .= '<tr>';
		$return_html .= '<td style="text-align:left; padding:20px 0px;">';
		if ($action_from == "va") {
			$return_html .= '<select id="cust_selector" name="cust_selector" onchange="return changeCustomerV2();"><option value="">=Select Customer=</option>';
			$user_group = Yii::app()->user->getState('userGroup');
			$user_id = Yii::app()->user->getState('userKey');

			$more_condition = "";
			if ($user_group != "1" && $user_group != "99") {

				$more_condition = " AND user_id='" . $user_id . "' ";
			}
			$sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 " . $more_condition . " ORDER BY cust_name ASC; ";
			$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();
			$custom_selector = "";
			foreach ($a_cust as $tmp_key => $row_cust) {
				if ($row_quote['cust_id'] == $row_cust['cust_id']) {
					$custom_selector = "selected";
				}
				$return_html .= '<option ' . $custom_selector . ' value="' . $row_cust["cust_id"] . '">' . $row_cust["cust_name"] . '</option>';
				$custom_selector = "";
			}
			$return_html .= '</select><pre id="pr_show_cust_info"></pre>';
		}
		if ($action_from == "vp") {
			$return_html .= '<select id="cust_selector" name="cust_selector" onchange="return changeCustomerV3(' . $qdoc_id . ');"><option value="">=Select Customer=</option>';
			$user_group = Yii::app()->user->getState('userGroup');
			$user_id = Yii::app()->user->getState('userKey');

			$more_condition = "";
			if ($user_group != "1" && $user_group != "99") {

				$more_condition = " AND user_id='" . $user_id . "' ";
			}
			$sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 " . $more_condition . " ORDER BY cust_name ASC; ";
			$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();
			$custom_selector = "";
			foreach ($a_cust as $tmp_key => $row_cust) {
				if ($row_quote['cust_id'] == $row_cust['cust_id']) {
					$custom_selector = "selected";
				}
				$return_html .= '<option ' . $custom_selector . ' value="' . $row_cust["cust_id"] . '">' . $row_cust["cust_name"] . '</option>';
				$custom_selector = "";
			}
			$return_html .= '</select><pre id="pr_show_cust_info"></pre>';
		}
		$return_html .= '<div class="bill_to">BILL TO<br>' . $row_quote["cust_name"];

		$return_html .= '<pre>' . $row_quote["cust_info"] . '</pre></div>';
		if ($action_from != "va") {
			$return_html .= '<a href="#" onclick="edit_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Edit <span id="cus_namer_' . $row_quote["cust_id"] . '">' . $row_quote["cust_name"] . '</span></a><span style="display: inline-block; font-size: 1.5em; margin: 0 5px;">&bull;</span><a href="#" onclick="change_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Change Customer</a>';
		}
		$return_html .= '</td>';
		$return_html .= '<td padding:20px 0px;">';
		$return_html .= '<table align="right" style="border-collapse: separate; border-spacing: 10px; color:#000;">';
		$return_html .= '<tr><th width="50%" style="text-align:right;">Estimate Number: </th><td style="color:#00F; text-align:left;" id="qdoc_number">' . $row_quote["est_number"] . '</td></tr>';
		$return_html .= '<tr>';
		$return_html .= '<th style="text-align:right;">PO Number: </th>';
		$return_html .= '<td style="text-align:left;" id="po_number">';
		$return_html .= '<span id="sp_po_number' . $qdoc_id . '">' . $row_quote["po_number"] . '</span> <i class="fa fa-pencil" style="cursor:pointer; font-size:16px; color:#00F;" onclick="return editPONumber(' . $qdoc_id . ');"></i>';
		$return_html .= '</td>';
		$return_html .= '</tr>';
		$return_html .= '<tr><th style="text-align:right;">Estimate Date: </th><td style="text-align:left;" id="show_est_date">' . date("F d, Y", strtotime($row_quote["est_date"])) . '</td></tr>';
		$return_html .= '<tr><th style="text-align:right;">Expires On: </th><td style="text-align:left;" id="show_exp_date">' . date("F d, Y", strtotime($row_quote["exp_date"])) . '</td></tr>';
		$return_html .= '<tr><th style="text-align:right;">Grand Total (' . $row_quote["quote_curr"] . '): </th><td style="text-align:left;" id="td_grand_total_app">' . $pre_cost . number_format($row_quote["grand_total"], 2) . '</td></tr>';
		$return_html .= '</table>';
		$return_html .= '<input type="hidden" name="qdoc_id" id="qdoc_id" value="' . $qdoc_id . '">';
		$return_html .= '</td></tr>';
		$return_html .= '<tr><td colspan="2">';
		$return_html .= '<table style="color:#000; width:100%;" id="product_list">';
		$return_html .= '<tr style="font-size: 15px;"><th width="40%" style="text-align:left;">Product</th>';

		if ($action_from == "vc" || $action_from == "va") {
			$return_html .= '<th style="text-align:center; color:#999;">Comm.%</th><th style="text-align:center; color:#999;">Comm.</th>';
			$return_html .= '<th style="text-align:center; width:80px;">Quantity</th><th style="text-align:center; width:80px;">Price</th><th style="text-align:right; width:80px;">Amount</th><th style="text-align:right; width:10%"></th></tr>';
		} else {
			$return_html .= '<th style="text-align:center;">Quantity</th><th style="text-align:right; width:140px;">Price</th><th style="text-align:right; width:140px;">Amount</th></tr>';
		}

		$shipping = 0.0;

		$sql_qitem = "SELECT * FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND enable=1 AND product_status='1' ORDER BY sort ASC; ";
		$a_qitem = Yii::app()->db->createCommand($sql_qitem)->queryAll();

		$sql = "SELECT * FROM `tbl_quote_item` WHERE `qdoc_id` = '$qdoc_id' AND (`pro_name` LIKE '%Royalty%' OR `pro_name` LIKE '%Credit Card%' OR `pro_name` LIKE '%Shipping%')";
		$shipp = Yii::app()->db->createCommand($sql)->queryAll();
		if (isset($shipp[0])) {	
			foreach ($shipp as $key => $value) {		
				$shipping += $value['uprice'];
			}			
		}

		//$sub_total = 0.0;
		$sub_total = $row_quote["sub_total"];
		$comm_total = 0.0;

		$user_group = Yii::app()->user->getState('userGroup');

		foreach ($a_qitem as $tmp_key => $row_qitem) {

			$pro_id = $row_qitem["pro_id"];
			$qty = $row_qitem["qty"];
			$uprice = $row_qitem["uprice"];
			$comm_percent = $row_qitem["comm_percent"];
			$comm_value = "";
			$tmp_comm_percent = 0;
			if ($comm_percent != "") {
				$tmp_comm_percent = intval(str_replace("%", "", $comm_percent));
				$comm_value = ($qty * $uprice) * ($tmp_comm_percent / 100);
				$comm_total += $comm_value;
			}

			$tmp_amount = $qty * $uprice;

			$return_html .= '<tr><td style="padding:10px 0px; text-align:left; display: block; white-space: pre-wrap; word-wrap: break-word;">';
			/*$return_html .= '<input type="hidden" name="quote_curr" value="'.$_POST["quote_curr"].'">';
			$return_html .= '<input type="hidden" name="pro_id[]" value="'.$product_id.'">';
			$return_html .= '<input type="hidden" name="comm_percent[]" value="'.$_POST["comm_percent"][$i].'">';
			$return_html .= '<input type="hidden" name="qty_note[]" value="'.$_POST["qty_note"][$i].'">';
			$return_html .= '<input type="hidden" name="pro_type[]" value="'.$_POST["product_type"][$i].'">';
			$return_html .= '<input type="hidden" name="pro_name[]" value="'.base64_encode($_POST["product_item"][$i]).'">';
			$return_html .= '<input type="hidden" name="pro_desc[]" value="'.base64_encode($_POST["product_desc"][$i].$s_addi_name).'">';
			$return_html .= '<input type="hidden" name="qty[]" value="'.$_POST["qty"][$i].'">';
			$return_html .= '<input type="hidden" name="uprice[]" value="'.$tmp_uprice.'">';
			$return_html .= '<input type="hidden" name="addi_id_list[]" value="'.$s_addi_id.'">';*/

			if ($action_from == "va") {
				$return_html .= '<input type="hidden" name="qdoci_id[]" value="' . $row_qitem["qdoci_id"] . '">';
				$return_html .= '<input style="width:100%; font-weight:bold;" type="text" name="pro_name[]" value="' . htmlspecialchars($row_qitem["pro_name"]) . '">';
				$return_html .= '<br><textarea style="width:100%; min-height:70px;" name="pro_desc[]">' . $row_qitem["pro_desc"] . '</textarea>';
				if ($row_qitem["addi_desc"] != "") {
					$return_html .= $row_qitem["addi_desc"];
				}
			} else {
				$return_html .= '<b>' . htmlspecialchars($row_qitem["pro_name"]) . '</b><br>' . $row_qitem["pro_desc"];
			}

			// 			if($action_from=="vp"){
			// 			    if($row_qitem["addi_desc"]!=""){
			// 					$return_html .= $row_qitem["addi_desc"];
			// 				}
			// 			}

			$return_html .= '</td>';

// 			if ($action_from == "vc") {

// 				$return_html .= '<td style="text-align:center; color:#999;">' . (($tmp_comm_percent != 0) ? ($tmp_comm_percent . "%") : "0%");
// 				if ($user_group == "1" || $user_group == "99") {
// 					$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editCommAfterApprove(\'' . $qdoc_id . '\',\'' . $row_qitem["qdoci_id"] . '\',\'' . $tmp_comm_percent . '\');"></i>';
// 				}


// 				$return_html .= '</td>';
// 				$return_html .= '<td style="text-align:center; color:#999;">' . (($comm_value != "") ? number_format($comm_value, 2) : "0") . '</td>';
// 			} else if ($action_from == "va") {

// 				$return_html .= '<td style="text-align:center; color:#999;"><input type="hidden" value="' . $row_qitem["qdoci_id"] . '" class="qdoci_id_app">';
// 				$return_html .= '<input type="hidden" value="' . $tmp_amount . '" id="tmp_amount' . $row_qitem["qdoci_id"] . '">';
// 				$return_html .= '<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width:60px; text-align:center;" min="0" type="number" value="' . $tmp_comm_percent . '" id="comm_percent_app' . $row_qitem["qdoci_id"] . '"></td>';
// 				$return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app' . $row_qitem["qdoci_id"] . '">' . (($comm_value != "") ? number_format($comm_value, 2) : "0") . '</td>';
// 			}

if ($action_from == "vc") {

				if( $user_group=="1" || $user_group=="99" ){

					$sql_user = "SELECT * FROM `user` WHERE `user_group_id` = 2 AND `enable` = 1 AND `id` NOT IN (29, 73, 76) ORDER BY fullname ASC;";

					$sales_user = Yii::app()->db->createCommand($sql_user)->queryAll();
					
					//$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editCommAfterApprove(\''.$qdoc_id.'\',\''.$row_qitem["qdoci_id"].'\',\''.$tmp_comm_percent.'\');"></i>';
					if ($row_qitem["split_sales_1"] =='' || $row_qitem["split_comm_1"] == 0 || $row_qitem["split_comm_1"] == '') {
						$splitclass= 'splitdef';
					}else{
						$splitclass= 'splitGreen';							
					}

					$return_html .= '<td style="text-align:center; color:#999;"><input type="hidden" value="' . $row_qitem["qdoci_id"] . '" class="qdoci_id_app">';
					$return_html .= '<input type="hidden" value="' . $tmp_amount . '" id="tmp_amount' . $row_qitem["qdoci_id"] . '">';
					$return_html .= '';
					$return_html .= '<span id="split" class="splitform ' . $splitclass . '" onclick="return formsplit(' . $row_qitem["qdoci_id"] . ');"><i class="fa fa-exchange" aria-hidden="true"></i> Split </span>
					<div class="formsplit" id="formsplite' . $row_qitem["qdoci_id"] . '" style="display:none;">
						<form class="form__submit" action="form.php" method="post">
							<div class="grid2" >
								<select name="sales_rep_1' . $row_qitem["qdoci_id"] . '" style="width:100%; height: 28px; text-align:center; padding: 0 5px 0 6px; margin:0; font-size:12px">';
								$return_html .= '<option value = "" >==Select Sales Rep==</option>';
						foreach ($sales_user as $user) {
							$selected = ($row_qitem["split_sales_1"] == $user['fullname']) ? ' selected' : '';
							$return_html .= '<option value="' . htmlspecialchars($user['fullname']) . '"' . $selected . '>' . htmlspecialchars($user['fullname']) . '</option>';
						}

						$return_html .= '</select>
										<input name="split_comm_percent_1' . $row_qitem["qdoci_id"] . '" value="' . $row_qitem["split_comm_1"] . '" style="width:50px; height: 28px; text-align:center;font-size:12px;" min="0" type="number">
									</div>
									<div class="grid2">
										<select name="sales_rep_2' . $row_qitem["qdoci_id"] . '" style="width:100%; height: 28px; text-align:center; padding: 0 5px 0 6px; margin:0; font-size:12px">';
										$return_html .= '<option value = "" >==Select Sales Rep==</option>';
						foreach ($sales_user as $user) {
							$selected = ($row_qitem["split_sales_2"] == $user['fullname']) ? ' selected' : '';
							$return_html .= '<option value="' . htmlspecialchars($user['fullname']) . '"' . $selected . '>' . htmlspecialchars($user['fullname']) . '</option>';
						}

						$return_html .= '</select>
										<input name="split_comm_percent_2' . $row_qitem["qdoci_id"] . '" value="' . $row_qitem["split_comm_2"] . '" style="width:50px; height: 28px; text-align:center; font-size:12px;" min="0" type="number">
									</div>
									<a href="#" class="submitFormBtn" onclick="submitForm(' . $row_qitem["qdoci_id"] . ')" style="color: #FFF !important;">Submit</a>
								</form>
							</div>
							<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width:60px; text-align:center;" min="0" type="number" value="' . $tmp_comm_percent . '" id="comm_percent_app' . $row_qitem["qdoci_id"] . '">
						</td>';					
					}else {
						$return_html .= '<td style="text-align:center; color:#999;">'.(($tmp_comm_percent!=0)?($tmp_comm_percent."%"):"0%").'</td>';
					}
					
					$return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app' . $row_qitem["qdoci_id"] . '">' . (($comm_value != "") ? number_format($comm_value, 2) : "0") . '';				

				// $return_html .= '<td style="text-align:center; color:#999;">' . (($tmp_comm_percent != 0) ? ($tmp_comm_percent . "%") : "0%");
				// if ($user_group == "1" || $user_group == "99") {
				// 	$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editCommAfterApprove(\'' . $qdoc_id . '\',\'' . $row_qitem["qdoci_id"] . '\',\'' . $tmp_comm_percent . '\');"></i>';
				// }


				// $return_html .= '</td>';
				// $return_html .= '<td style="text-align:center; color:#999;">' . (($comm_value != "") ? number_format($comm_value, 2) : "0") . '</td>';
			} else if ($action_from == "va") {

				if ($user_group == "1" || $user_group == "99") {
					$sql_user = "SELECT * FROM `user` WHERE `user_group_id` = 2 AND `enable` = 1 AND `id` NOT IN (29, 73, 76) ORDER BY fullname ASC;";

					$sales_user = Yii::app()->db->createCommand($sql_user)->queryAll();
					
					//$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editCommAfterApprove(\''.$qdoc_id.'\',\''.$row_qitem["qdoci_id"].'\',\''.$tmp_comm_percent.'\');"></i>';
					if ($row_qitem["split_sales_1"] =='' ||
					    $row_qitem["split_comm_1"] == 0 || $row_qitem["split_comm_1"] == '') {
						$splitclass= 'splitdef';
					}else{
						$splitclass= 'splitGreen';							
					}

					$return_html .= '<td style="text-align:center; color:#999;"><input type="hidden" value="' . $row_qitem["qdoci_id"] . '" class="qdoci_id_app">';
					$return_html .= '<input type="hidden" value="' . $tmp_amount . '" id="tmp_amount' . $row_qitem["qdoci_id"] . '">';
					$return_html .= '';
					$return_html .= '<span id="split" class="splitform ' . $splitclass . '" onclick="return formsplit(' . $row_qitem["qdoci_id"] . ');"><i class="fa fa-exchange" aria-hidden="true"></i> Split </span>
					<div class="formsplit" id="formsplite' . $row_qitem["qdoci_id"] . '" style="display:none;">
						<form class="form__submit" action="form.php" method="post">
							<div class="grid2" >
								<select name="sales_rep_1' . $row_qitem["qdoci_id"] . '" style="width:100%; height: 28px; text-align:center; padding: 0 5px 0 6px; margin:0; font-size:12px">';
								$return_html .= '<option value = "" >==Select Sales Rep==</option>';
						foreach ($sales_user as $user) {
							$selected = ($row_qitem["split_sales_1"] == $user['fullname']) ? ' selected' : '';
							$return_html .= '<option value="' . htmlspecialchars($user['fullname']) . '"' . $selected . '>' . htmlspecialchars($user['fullname']) . '</option>';
						}

						$return_html .= '</select>
										<input name="split_comm_percent_1' . $row_qitem["qdoci_id"] . '" value="' . $row_qitem["split_comm_1"] . '" style="width:50px; height: 28px; text-align:center;font-size:12px;" min="0" type="number">
									</div>
									<div class="grid2">
										<select name="sales_rep_2' . $row_qitem["qdoci_id"] . '" style="width:100%; height: 28px; text-align:center; padding: 0 5px 0 6px; margin:0; font-size:12px">';
										$return_html .= '<option value = "" >==Select Sales Rep==</option>';
						foreach ($sales_user as $user) {
							$selected = ($row_qitem["split_sales_2"] == $user['fullname']) ? ' selected' : '';
							$return_html .= '<option value="' . htmlspecialchars($user['fullname']) . '"' . $selected . '>' . htmlspecialchars($user['fullname']) . '</option>';
						}

						$return_html .= '</select>
										<input name="split_comm_percent_2' . $row_qitem["qdoci_id"] . '" value="' . $row_qitem["split_comm_2"] . '" style="width:50px; height: 28px; text-align:center; font-size:12px;" min="0" type="number">
									</div>
									<a href="#" class="submitFormBtn" onclick="submitForm(' . $row_qitem["qdoci_id"] . ')" style="color: #FFF !important;">Submit</a>
								</form>
							</div>
							<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width:60px; text-align:center;" min="0" type="number" value="' . $tmp_comm_percent . '" id="comm_percent_app' . $row_qitem["qdoci_id"] . '">
						</td>';
					$return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app' . $row_qitem["qdoci_id"] . '">' . (($comm_value != "") ? number_format($comm_value, 2) : "0") . '</td>';
				} else {

					$return_html .= '<td style="text-align:center; color:#999;"><input type="hidden" value="' . $row_qitem["qdoci_id"] . '" class="qdoci_id_app">';
					$return_html .= '<input type="hidden" value="' . $tmp_amount . '" id="tmp_amount' . $row_qitem["qdoci_id"] . '">';
					$return_html .= '<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width:60px; text-align:center;" min="0" type="number" value="' . $tmp_comm_percent . '" id="comm_percent_app' . $row_qitem["qdoci_id"] . '"></td>';
					$return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app' . $row_qitem["qdoci_id"] . '">' . (($comm_value != "") ? number_format($comm_value, 2) : "0") . '</td>';
				}
				// $return_html .= '<td style="text-align:center; color:#999;"><input type="hidden" value="' . $row_qitem["qdoci_id"] . '" class="qdoci_id_app">';
				// $return_html .= '<input type="hidden" value="' . $tmp_amount . '" id="tmp_amount' . $row_qitem["qdoci_id"] . '">';
				// $return_html .= '<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width:60px; text-align:center;" min="0" type="number" value="' . $tmp_comm_percent . '" id="comm_percent_app' . $row_qitem["qdoci_id"] . '"></td>';
				// $return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app' . $row_qitem["qdoci_id"] . '">' . (($comm_value != "") ? number_format($comm_value, 2) : "0") . '</td>';
			}
			$return_html .= '<td style="text-align:center;">';
			if ($action_from == "va") {
				$return_html .= '<input name="app_qty[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:55px; text-align:center;" min="0" type="number" value="' . $qty . '" id="app_qty' . $row_qitem["qdoci_id"] . '">';
			} else {
				$return_html .= number_format($qty, 0);
			}
			$return_html .= '</td>';

			$return_html .= '<td style="text-align:right;">';
			if ($action_from == "va") {
				$return_html .= '<input name="app_uprice[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:70px; text-align:center;" min="0.00" type="number" value="' . $uprice . '" id="app_uprice' . $row_qitem["qdoci_id"] . '">';
			} else if ($action_from == "vc" && ($user_group == "1" || $user_group == "99")) {
				$return_html .= $pre_cost . number_format($uprice, 2);

				$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editUPriceAfterApprove(\'' . $qdoc_id . '\',\'' . $row_qitem["qdoci_id"] . '\',\'' . $uprice . '\');"></i>';
			} else {
				$return_html .= $pre_cost . number_format($uprice, 2);
			}
			$return_html .= '</td><td style="text-align:center;">' . $pre_cost . '<span id="sp_app_amount' . $row_qitem["qdoci_id"] . '">';

			if ($action_from == "va") {
				$return_html .= $tmp_amount;
			} else {
				$return_html .= number_format($tmp_amount, 2);
			}

			$return_html .= '</span></td>';

			if ($action_from == "va") {
				$return_html .= '<td style="text-align:center;cursor:pointer;" class="remover" qdoci_id="' . $row_qitem['qdoci_id'] . '"><i style="color:red;" class="fa fa-minus-circle"></i></td>';
			}

			$return_html .= '</tr>';

			//$sub_total += $tmp_amount;
		}

		$col_span = 4;
		$col_span2 = 2;
		if ($action_from == "vc" || $action_from == "va") {
			$col_span = 6;
			$col_span2 = 4;
		}
		$return_html .= '<tr><td colspan="' . $col_span . '" style="padding:0px;"><hr style="margin:0px;"></td></tr>';



		$vat_7percent = ($sub_total - $row_quote['actual_discount']) * 0.07;

		$f_total = 0.0;
		if ($row_quote["inc_vat"] == "yes" || $action_from == "va" || $action_from == "vb") {
			if ($action_from != "vp") {
				$return_html .= '<tr><td colspan="2"><span qdoc_id="' . $qdoc_id . '" class="btn btn-success add_row" style="padding:5px;">Add Row  <i class="fa fa-plus" aria-hidden="true"></i></span></td>';
			}
			if ($action_from == "vc" || $action_from == "va") {
				$return_html .= '<td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">' . number_format($comm_total, 2) . '</td><td>&nbsp;</td>';
			}
			$colspaner = '';
			$colspaner_1 = '';
			if ($action_from == "vp") {
				$colspaner = "colspan='3'";
				$colspaner_1 = "colspan='1'";
			}
			$return_html .= '<th ' . $colspaner . ' style="padding: 10px 0px; text-align:right;">Subtotal:</th>';
			$return_html .= '<td ' . $colspaner_1 . ' style="padding: 10px 0px; text-align:right;">' . $pre_cost . '<span id="sp_app_sub_total">' . $sub_total . '</span></td></tr>';

			if ($row_quote["inc_vat"] == "yes") {
				$f_total = ($sub_total - $row_quote['actual_discount']) + $vat_7percent;
			} else {
				$f_total = $sub_total - $row_quote['actual_discount'];
			}
			if ($action_from != "vp") {

				if ($row_quote["design_url"] != "" || $row_quote["design_url"] != NULL) {
					$return_html .= "<input type='hidden' id='tr_total' value='1'>";
					$return_html .= "<tr><th colspan='2'>Design URL</th></tr>";
					$return_html .= "<tr><td colspan='2' class='alert alert-success'><a style='color:white;' href=" . $row_quote["design_url"] . ">" . $row_quote["design_url"] . "</a></td></tr>";
				}

				$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Change Currency:</th><td style="padding: 10px 0px; text-align:right;"><span>' . $select_html . '</span></td></tr>';

				$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="discount_percent" class="number_disc_approval" data-shipp="'.$shipping.'" value="' . $row_quote['discount_percent'] . '"  style="width:55px;"></span></td></tr>';

				$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="actual_discount" id="actual_disc_approval" data-shipp="'.$shipping.'"  value="' . $row_quote['actual_discount'] . '" style="width:55px;"></span></td></tr>';
			}

			$return_html .= "<input type='hidden' id='tr_total' value='0'>";

			if ($action_from == "vp" && $row_quote['actual_discount'] != "0") {
				$return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>' . $row_quote['discount_percent'] . '%</span></td></tr>';

				$return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>' . $pre_cost . number_format($row_quote['actual_discount'], 2) . '</span></td></tr>';
			}


			$return_html .= '<tr ><td rowspan="3" colspan="' . $col_span2 . '">';
			if ($row_quote["sale_note"] != "" && ($action_from == "va" || $action_from == "vb")) {
				$return_html .= 'Salesman Notes (<font color=red>Not shown in Estimate</font>)';
				if ($action_from == "vb") {
					$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_edit_sale_note" style="background-color:#DDD;" onclick="return editSaleNote(' . $qdoc_id . ');"><i class="fa fa-pencil" style="color:#00F;"></i> Edit</button>';
					$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_save_sale_note" style="background-color:#FFF;" disabled onclick="return saveSaleNote(' . $qdoc_id . ');"><i class="fa fa-floppy-o" style="color:#070;"></i> Save</button>';
				}

				$return_html .= '<br><pre class="alert alert-success" style="width:100%; height:100%; max-width:700px; overflow-x:auto;" id="pre_sale_note' . $qdoc_id . '">' . $row_quote["sale_note"] . '</pre>';
			} else {
				$return_html .= '&nbsp;';
			}

			if ($action_from == "va") {
				$return_html .= 'Comment (<font color=red>Not shown in Estimate and appear on the top after Approve or Reject.</font>)';
				$return_html .= '<div style="text-align:left;">';
				$return_html .= '<textarea name="approval_comment" id="approval_comment" style="width: 700px; height: 100px; min-height: 101px; margin: 3px;"></textarea>';
				$return_html .= '</div>';
			}

			$return_html .= '</td>';
			$return_html .= '<td style="padding: 10px 0px; text-align:right;">';
			$return_html .= '<input type="hidden" id="sub_total_app" value="' . $sub_total . '">';
			$return_html .= '<input type="hidden" id="pre_cost_app" value="' . $pre_cost . '">';
			$return_html .= '<input type="hidden" name="vat_value_app" id="vat_value_app" value="' . $vat_7percent . '">';
			$return_html .= '<input type="hidden" id="total_value_app" value="' . $f_total . '">';



			if ($row_quote["approve_status"] == "new" && ($user_group == "1" || $user_group == "99")) {
				$return_html .= '<span class="subnvat"><input type="checkbox" name="inc_vat_app" id="inc_vat_app" value="yes" onclick="changeIncludeVATApprove();" ';
				if ($row_quote["inc_vat"] == "yes") {
					$return_html .= 'checked';
				}
				$return_html .= '>';
			}
			$return_html .= ' VAT 7%:</span></td>';
			$return_html .= '<td style="padding: 10px 0px; text-align:right;"><span class="subnvat" id="sp_show_vat_value_app">';
			if ($row_quote["inc_vat"] == "yes") {
				$return_html .= $pre_cost . number_format($vat_7percent, 2);
			}
			$return_html .= '</span></td></tr>';

			$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Total:</span></th>';
			$return_html .= '<td style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat" id="sp_show_total_value_app">' . $pre_cost . number_format($f_total, 2) . '</span></td></tr>';


			$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total (' . $row_quote["quote_curr"] . '):</th>';
			$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="' . $pre_cost . '">' . $pre_cost . number_format($f_total, 2) . '</span></th></tr>';
		} else {
			//$f_total = $sub_total;
			$f_total = $row_quote["grand_total"];
			$return_html .= '<tr ><td>&nbsp;</td>';
			$colspan_grand = "colspan='2'";
			if ($action_from == "vc" || $action_from == "va") {
				$return_html .= '<td>&nbsp;</td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">' . number_format($comm_total, 2) . '</td>';
			}
			if ($action_from == "vp" && $row_quote['actual_discount'] != "0") {
				$return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>' . $row_quote['discount_percent'] . '%</span></td></tr>';

				$return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>' . $pre_cost . number_format($row_quote['actual_discount'], 2) . '</span></td></tr>';
				$colspan_grand = "colspan='3'";
			}
			$return_html .= '<th ' . $colspan_grand . ' style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total (' . $row_quote["quote_curr"] . '):</th>';
			$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="' . $pre_cost . '">' . $pre_cost . number_format($f_total, 2) . '</span></th></tr>';
		}



		$return_html .= '</table>';
		$return_html .= '</td></tr>';

		$return_html .= '</table>';

		if ($row_quote["approve_status"] != "new" && $row_quote["note"] != "") {
			$return_html .= '<b>Notes</b> ';
			$return_html .= '<pre ';
			if ($row_quote["approve_status"] == "reject") {
				$return_html .= ' class="alert alert-dark" ';
			}
			$return_html .= '>' . $row_quote["note"] . '</pre>';
		}

		//print_r($return_html);

		$a_result["inner_content"] = $return_html;

		$a_result["show_approve"] = "no";
		$a_result["show_reject"] = "no";
		$a_result["show_print"] = "no";

		$a_result["comp_id"] = $comp_id;
		$a_result["qnote_text"] = base64_encode($qnote_text);

		$a_result["history_inner"] = "";

		$a_result["approval_comment"] = "";
		if ($row_quote["approval_comment"] != "") {
			$a_result["approval_comment"] = base64_encode('<div><center><pre class="alert" style="text-align:left; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;" id="approval_comment' . $qdoc_id . '">' . $row_quote["approval_comment"] . '</pre></center></div>');
		}

		if ($approve_status == "new") {

			$a_result["show_approve"] = "yes";
			$a_result["show_reject"] = "yes";

			if ($row_quote["history_qdoc_id"] != "") {

				$a_result["history_inner"] .= '<option value="' . $qdoc_id . '">==Main Document==</option>';

				$sql_history = "SELECT qdoc_id,add_date FROM tbl_quote_doc WHERE qdoc_id IN (" . rtrim($row_quote["history_qdoc_id"], ',') . ") ORDER BY add_date DESC; ";
				//$a_result["history_inner"] .= $sql_history;
				$a_history = Yii::app()->db->createCommand($sql_history)->queryAll();
				foreach ($a_history as $tmp_key_his => $row_history) {
					$a_result["history_inner"] .= '<option value="' . $row_history["qdoc_id"] . '">' . $row_history["add_date"] . '</option>';
				}
			}
		} else if ($approve_status == "approve") {

			$a_result["show_print"] = "yes";
		}

		echo json_encode($a_result);
	}

	public function actionSaveNewNote()
	{

		$note_name = addslashes(base64_decode($_POST["note_name"]));
		$note_text = addslashes(base64_decode($_POST["note_text"]));

		$sql_insert = "INSERT INTO tbl_quote_note (qnote_name,qnote_text,add_date) VALUES ('" . $note_name . "','" . $note_text . "','" . date("Y-m-d H:i:s") . "'); ";

		if (Yii::app()->db->createCommand($sql_insert)->execute()) {

			$qnote_id = Yii::app()->db->getLastInsertID();

			$a_result["qnote_id"] = $qnote_id;
			$a_result["qnote_name"] = $_POST["note_name"];
			$a_result["qnote_text"] = $_POST["note_text"];
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to save new note.";
		}

		echo json_encode($a_result);
	}

	public function actionUpdateQuoteNote()
	{

		$qdoc_id = $_POST["qdoc_id"];
		$note_text = addslashes(base64_decode($_POST["note_text"]));
		$approve_status = $_POST["approve_status"];

		$sql_update = "UPDATE tbl_quote_doc SET note='" . $note_text . "',approve_status='" . $approve_status . "'";
		if ($approve_status == "approve") {

			$qdoci_id_list = $_POST["qdoci_id_list"];
			$a_qdoci_id = explode(",", $qdoci_id_list);
			$comm_val_list = $_POST["comm_val_list"];
			$a_comm_val = explode(",", $comm_val_list);

			for ($i = 0; $i < sizeof($a_qdoci_id); $i++) {

				$tmp_comm_val = $a_comm_val[$i];
				if ($tmp_comm_val != "") {
					$tmp_comm_val .= "%";
				}
				$sql_update2 = "UPDATE tbl_quote_item SET comm_percent='" . $tmp_comm_val . "' WHERE qdoci_id='" . $a_qdoci_id[$i] . "'; ";
				Yii::app()->db->createCommand($sql_update2)->execute();
			}

			$inc_vat = $_POST["inc_vat"];

			if ($inc_vat == "yes") {
				$total_value = $_POST["total_value"];
				$sql_update .= ",inc_vat='yes',grand_total='" . $total_value . "'";
			} else {
				$sql_update .= ",inc_vat='no',grand_total=sub_total";
			}
			$sql_update .= ",approve_date='" . date("Y-m-d H:i:s") . "' ";
		}

		if ($approve_status == "reject") {


			$sql_log = "INSERT INTO tbl_quote_doc (user_id,comp_id,comp_name,comp_info,curr_id,quote_curr,payment_term,cust_id,cust_name,cust_info,est_number,est_date
,exp_date,inc_vat,vat_value,num_item,sub_total,grand_total,sale_note,note,approve_status,approve_date
,reject_time,history_qdoc_id,is_temp,is_editing,archive,add_date,enable) SELECT user_id,comp_id,comp_name,comp_info,curr_id,quote_curr,payment_term,cust_id,cust_name,cust_info,est_number,est_date
,exp_date,inc_vat,vat_value,num_item,sub_total,grand_total,sale_note,'" . $note_text . "','reject',approve_date
,'" . date("Y-m-d H:i:s") . "',history_qdoc_id,is_temp,is_editing,archive,add_date,0 FROM tbl_quote_doc WHERE qdoc_id=" . $qdoc_id;
			Yii::app()->db->createCommand($sql_log)->execute();

			$new_qdoc_id = Yii::app()->db->getLastInsertID();

			$sql_log_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,pro_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,comm_percent,sort,add_date,enable) SELECT '" . $new_qdoc_id . "',pro_type,pro_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,comm_percent,sort,add_date,enable FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "'";
			Yii::app()->db->createCommand($sql_log_item)->execute();

			$sql_update .= ",reject_time='" . date("Y-m-d H:i:s") . "',is_temp=1,temp_id='" . $new_qdoc_id . "' ";
		}

		$sql_update .= " WHERE qdoc_id='" . $qdoc_id . "'; ";

		if (Yii::app()->db->createCommand($sql_update)->execute()) {
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Error saving data.";
		}

		echo json_encode($a_result);
	}

	public function actionRejectQuote()
	{

		$qdoc_id = $_POST["qdoc_id"];
		$note_text = addslashes($_POST["note_text"]);
		$approval_comment = addslashes($_POST["approval_comment"]);
		//$approve_status = $_POST["approve_status"];



		$sql_log = "INSERT INTO tbl_quote_doc (user_id,comp_id,comp_name,comp_info,curr_id,quote_curr,payment_term,cust_id,cust_name,cust_info,est_number,est_date
,exp_date,inc_vat,vat_value,num_item,sub_total,grand_total,sale_note,approval_comment,note,approve_status,approve_date
,reject_time,history_qdoc_id,is_temp,is_editing,archive,add_date,enable) SELECT user_id,comp_id,comp_name,comp_info,curr_id,quote_curr,payment_term,cust_id,cust_name,cust_info,est_number,est_date
,exp_date,inc_vat,vat_value,num_item,sub_total,grand_total,sale_note,'" . $approval_comment . "','" . $note_text . "','reject',approve_date
,'" . date("Y-m-d H:i:s") . "',history_qdoc_id,is_temp,is_editing,archive,add_date,0 FROM tbl_quote_doc WHERE qdoc_id=" . $qdoc_id;
		Yii::app()->db->createCommand($sql_log)->execute();

		$new_qdoc_id = Yii::app()->db->getLastInsertID();

		$sql_log_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,pro_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,comm_percent,sort,add_date,enable) SELECT '" . $new_qdoc_id . "',pro_type,pro_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,comm_percent,sort,add_date,enable FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "'";
		Yii::app()->db->createCommand($sql_log_item)->execute();

		$comp_id = $_POST["head_selector_app"];
		$sql_comp = "SELECT * FROM tbl_comp_info WHERE comp_id='" . $comp_id . "'; ";
		$a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();
		$row_comp = $a_comp[0];
		$comp_name = addslashes($row_comp["comp_name"]);
		$comp_info = addslashes($row_comp["comp_info"]);

		$payment_term = addslashes($_POST["payment_term"]);

		$vat_value = $_POST["vat_value_app"];
		if (isset($_POST["inc_vat_app"])) {
			$inc_vat = "yes";
		} else {
			$inc_vat = "no";
		}
		//$note_text = addslashes($_POST["note_text"]);

		$sub_total = 0.0;

		for ($i = 0; $i < sizeof($_POST["qdoci_id"]); $i++) {

			$qdoci_id = $_POST["qdoci_id"][$i];
			$pro_name = addslashes($_POST["pro_name"][$i]);
			$pro_desc = addslashes($_POST["pro_desc"][$i]);
			$comm_percent = $_POST["app_comm_percent"][$i] . '%';
			$qty = floatval($_POST["app_qty"][$i]);
			$uprice = floatval($_POST["app_uprice"][$i]);

			$amount = $qty * $uprice;
			$sub_total += $amount;

			$sql_update = "UPDATE tbl_quote_item SET pro_name='" . $pro_name . "',pro_desc='" . $pro_desc . "',qty='" . intval($qty) . "',uprice='" . $uprice . "',comm_percent='" . $comm_percent . "' WHERE qdoci_id='" . $qdoci_id . "'; ";

			Yii::app()->db->createCommand($sql_update)->execute();
		}

		if ($inc_vat == "yes") {
			$grand_total = $sub_total + floatval($vat_value);
		} else {
			$grand_total = $sub_total;
		}

		//$sql_update = "UPDATE tbl_quote_doc SET note='".$note_text."',approve_status='reject'";
		$sql_update2 = "UPDATE tbl_quote_doc SET comp_id='" . $comp_id . "',comp_name='" . $comp_name . "',comp_info='" . $comp_info . "',payment_term='" . $payment_term . "',inc_vat='" . $inc_vat . "'";
		$sql_update2 .= ",vat_value='" . $vat_value . "',sub_total='" . $sub_total . "',grand_total='" . $grand_total . "',approval_comment='" . $approval_comment . "',note='" . $note_text . "',approve_status='reject'";
		$sql_update2 .= ",reject_time='" . date("Y-m-d H:i:s") . "',is_temp=1,temp_id='" . $new_qdoc_id . "' ";
		$sql_update2 .= " WHERE qdoc_id='" . $qdoc_id . "'; ";

		if (Yii::app()->db->createCommand($sql_update2)->execute()) {
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Error saving data.";
		}

		$sql_update_draft = "UPDATE tbl_quote_doc SET draft_changed='1' WHERE qdoc_id='" . $qdoc_id . "'; ";

		Yii::app()->db->createCommand($sql_update_draft)->execute();

		echo json_encode($a_result);
	}

	public function actionApproveQuote()
	{
		$cust_id = $_POST["cust_selector"];
		$sql_cust = "SELECT * FROM tbl_cust_info WHERE cust_id='" . $cust_id . "'; ";
		$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();
		$row_cust = $a_cust[0];
		$cust_name = $row_cust["cust_name"];
		$cust_info = $row_cust["cust_info"];
		$qdoc_id = $_POST["qdoc_id"];

		$comp_id = $_POST["head_selector_app"];
		$sql_comp = "SELECT * FROM tbl_comp_info WHERE comp_id='" . $comp_id . "'; ";
		$a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();
		$row_comp = $a_comp[0];
		$comp_name = addslashes($row_comp["comp_name"]);
		$comp_info = addslashes($row_comp["comp_info"]);
		$curr_id = $_POST['curr_id'];
		$quote_curr = $_POST['quote_curr'];

		$payment_term = addslashes($_POST["payment_term"]);

		$vat_value = $_POST["vat_value_app"];
		if (isset($_POST["inc_vat_app"])) {
			$inc_vat = "yes";
		} else {
			$inc_vat = "no";
		}
		$note_text = addslashes($_POST["note_text"]);

		$sub_total = 0.0;

		$discount_percent = $_POST['discount_percent'];
		$actual_discount = $_POST['actual_discount'];

		for ($i = 0; $i < sizeof($_POST["qdoci_id"]); $i++) {

			$qdoci_id = $_POST["qdoci_id"][$i];
			$pro_name = addslashes($_POST["pro_name"][$i]);
			$pro_desc = addslashes($_POST["pro_desc"][$i]);
			$comm_percent = $_POST["app_comm_percent"][$i] . '%';
			$qty = floatval($_POST["app_qty"][$i]);
			$uprice = floatval($_POST["app_uprice"][$i]);

			$amount = $qty * $uprice;
			$sub_total += $amount;

			$deleter = "DELETE FROM tbl_quote_item_admin WHERE qdoci_id='$qdoci_id'";
			Yii::app()->db->createCommand($deleter)->execute();

			$insertion_data = "INSERT INTO tbl_quote_item_admin SELECT * FROM tbl_quote_item WHERE qdoci_id='" . $qdoci_id . "'";
			Yii::app()->db->createCommand($insertion_data)->execute();

			$sql_update = "UPDATE tbl_quote_item SET pro_name='" . $pro_name . "',pro_desc='" . $pro_desc . "',qty='" . intval($qty) . "',uprice='" . $uprice . "',comm_percent='" . $comm_percent . "' WHERE qdoci_id='" . $qdoci_id . "'; ";

			Yii::app()->db->createCommand($sql_update)->execute();

			$sql_update_admin = "UPDATE tbl_quote_item_admin SET pro_name='" . $pro_name . "',pro_desc='" . $pro_desc . "',qty='" . intval($qty) . "',uprice='" . $uprice . "',comm_percent='" . $comm_percent . "' WHERE qdoci_id='" . $qdoci_id . "'; ";

			Yii::app()->db->createCommand($sql_update_admin)->execute();
		}

		//$sub_total = $sub_total-$actual_discount;

		if ($inc_vat == "yes") {
			$grand_total = $sub_total - floatval($actual_discount) + floatval($vat_value);
		} else {
			$grand_total = $sub_total - floatval($actual_discount);
		}

		$approval_comment = addslashes($_POST["approval_comment"]);

		$insertion_quote_admin = "INSERT INTO tbl_quote_doc_admin SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $qdoc_id . "'";
		Yii::app()->db->createCommand($insertion_quote_admin)->execute();

		$sql_update2 = "UPDATE tbl_quote_doc SET comp_id='" . $comp_id . "',comp_name='" . $comp_name . "',curr_id='" . $curr_id . "',quote_curr='" . $quote_curr . "',comp_info='" . $comp_info . "',payment_term='" . $payment_term . "',inc_vat='" . $inc_vat . "',vat_value='" . $vat_value . "',discount_percent='" . $discount_percent . "',actual_discount='$actual_discount',cust_id='" . $cust_id . "',cust_name='" . addslashes($cust_name) . "',cust_info='" . addslashes($cust_info) . "',sub_total='" . $sub_total . "'";
		$sql_update2 .= ",grand_total='" . $grand_total . "',approval_comment='" . $approval_comment . "',note='" . $note_text . "',approve_status='approve',approve_date='" . date("Y-m-d H:i:s") . "' WHERE qdoc_id='" . $qdoc_id . "'; ";

		$sql_update3 = "UPDATE tbl_quote_doc_admin SET comp_id='" . $comp_id . "',comp_name='" . $comp_name . "',curr_id='" . $curr_id . "',quote_curr='" . $quote_curr . "',comp_info='" . $comp_info . "',payment_term='" . $payment_term . "',inc_vat='" . $inc_vat . "',vat_value='" . $vat_value . "',discount_percent='" . $discount_percent . "',actual_discount='$actual_discount',cust_id='" . $cust_id . "',cust_name='" . addslashes($cust_name) . "',cust_info='" . addslashes($cust_info) . "',sub_total='" . $sub_total . "'";
		$sql_update3 .= ",grand_total='" . $grand_total . "',approval_comment='" . $approval_comment . "',note='" . $note_text . "',approve_status='approve',approve_date='" . date("Y-m-d H:i:s") . "' WHERE qdoc_id='" . $qdoc_id . "'; ";

		Yii::app()->db->createCommand($sql_update3)->execute();

		if (Yii::app()->db->createCommand($sql_update2)->execute()) {
			$sql = "DELETE FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND product_status='2'";
			Yii::app()->db->createCommand($sql)->execute();

			$sql_del_admin = "DELETE FROM tbl_quote_item_admin WHERE qdoc_id='" . $qdoc_id . "' AND product_status='2'";
			Yii::app()->db->createCommand($sql_del_admin)->execute();
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to approve.";
		}

		$sql_update_draft = "UPDATE tbl_quote_doc SET draft_changed='1' WHERE qdoc_id='" . $qdoc_id . "'; ";

		Yii::app()->db->createCommand($sql_update_draft)->execute();



		echo json_encode($a_result);
	}

	public function actionSaveToArchive()
	{

		$qdoc_id = $_POST["qdoc_id"];

		$sql_update = "UPDATE tbl_quote_doc SET archive=1 WHERE qdoc_id='" . $qdoc_id . "'; ";

		if (Yii::app()->db->createCommand($sql_update)->execute()) {
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to archive.";
		}

		echo json_encode($a_result);
	}

	public function actionShowItemAddMode()
	{

		$qdoc_id = $_POST["qdoc_id"];

		$sql_item = "SELECT * FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND enable=1 ORDER BY sort ASC; ";
		$a_item = Yii::app()->db->createCommand($sql_item)->queryAll();

		$html_table = '<table class="tbl-cart-info"><tr><th style="text-align:center;">#</th><th >Product</th><th>Description</th></tr>';

		for ($i = 0; $i < sizeof($a_item); $i++) {

			$html_table .= '<tr><td style="text-align:center; padding:10px 3px;">' . ($i + 1) . '</td><td>' . $a_item[$i]["pro_name"] . '</td>';
			$html_table .= '<td style="padding:10px 3px; display: block; white-space: pre-wrap; word-wrap: break-word;">' . $a_item[$i]["pro_desc"] . '</td>';
			$html_table .= '</tr>';
		}

		$html_table .= '</table>';

		echo $html_table;
	}

	public function actionSendToCart()
	{

		$qdoc_id = $_POST["qdoc_id"];

		$sql_doc = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $qdoc_id . "'; ";
		$a_doc = Yii::app()->db->createCommand($sql_doc)->queryAll();
		$row_doc = $a_doc[0];

		$doc_status = $row_doc["approve_status"];
		$is_archive = $row_doc["archive"];
		$is_duplicate = $row_doc["is_duplicate"];
		$is_editing = $row_doc["is_editing"];
		$dup_from = $row_doc["dup_from"];

		$use_note = "";
		if ($_POST["from_page"] == "equote" || ($_POST["from_page"] == "quote_rej" && $is_editing == "1")) {
			$sql_edit = "SELECT * FROM tbl_qdoc_edit WHERE qdoc_id='" . $qdoc_id . "' ORDER BY add_date DESC LIMIT 0,1; ";
			$a_doc_edit = Yii::app()->db->createCommand($sql_edit)->queryAll();
			$row_doc_edit = $a_doc_edit[0];

			$use_note = $row_doc_edit["edit_note"];
		} else {
			$use_note = $row_doc["approval_comment"];
		}


		$sql_item = "SELECT * FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND enable=1 ORDER BY sort ASC; ";
		$a_item = Yii::app()->db->createCommand($sql_item)->queryAll();

		//$a_data = (array)json_decode(base64_decode($a_load[0]["inner_value"]));
		$html_table = '';
		if ($is_duplicate == "0") {
			$html_table .= 'Note: <pre style="width:100%;" class="alert alert-danger">' . $use_note . '</pre>';
		} else {
			$html_table .= '<div style="width:100%; text-align:center;"><center><div style="width:100%; text-align:center;" class="alert alert-warning"><b>DUPLICATION</b></div></center></div>';
		}
		$html_table .= '<input name="is_duplicate" id="is_duplicate" type="hidden" value="' . $row_doc["is_duplicate"] . '" >';

		$html_table .= '<table id="tbl_cart_info" class="tbl-cart-info"><tr><th style="width:20px; text-align:center;">#</th><th style="width:150px;" >Product</th><th>Description</th><th style="text-align:center;">Additional</th><th style="text-align:center; width:75px;">Note</th><th style="width:20px; text-align:center;">QTY</th><th style="width:90px; text-align:center;">Price</th><th style="width:70px; text-align:center;">Amount</th>';
		// 		if( !($doc_status=="approve" && $is_duplicate=="0") || ($is_editing=="1") ){
		$html_table .= '<th style="width:60px; text-align:center;">Action</th>';
		// 		}
		$html_table .= '</tr>';


		$count_row = 1;



		$tmp_html_id = "";

		$is_old_process = 0;

		for ($i = 0; $i < sizeof($a_item); $i++) {

			$tmp_s = "";
			$tmp_p = "";
			$tmp_e = "";

			if ($a_item[$i]["pro_type"] == "other") {
				$tmp_s = "other";
				$tmp_p = $count_row;
			} else if ($a_item[$i]["pro_type"] == "extra") {
				$tmp_s = "extra";
				$tmp_p = $count_row;
				$tmp_e = "e";
			} else {
				if ($a_item[$i]["item_id"] != "") {

					if ($a_item[$i]["item_id"] == "0") {
						$tmp_s = "old_dup";
						//$tmp_p = $count_row;
					} else {
						$tmp_s = "new";
						//$tmp_p = $a_item[$i]["item_id"];
					}
				} else {
					$tmp_s = $a_item[$i]["pro_type"];
					//$tmp_p = $a_item[$i]["pro_id"];
					$is_old_process = 1;
				}
				$tmp_p = $a_item[$i]["qdoci_id"];
			}

			if ($tmp_html_id != "") {
				$tmp_html_id .= ",";
			}
			$tmp_html_id .= $tmp_s . "" . $tmp_p;

			$a_row = array();

			$qdoci_id_above = "";
			$qdoci_id_below = "";
			$html_table .= '<tbody id="tr_' . $tmp_s . $tmp_p . '"><tr><td style="text-align:center;">';
			if ($i != 0) {
				$html_table .= '<i class="fa fa-arrow-up move_btn" onclick="return sortQuoteItem(\'up\',\'' . $_POST["from_page"] . '\',' . $a_item[$i]["qdoci_id"] . ');"></i><br>';
				$qdoci_id_above = $a_item[($i - 1)]["qdoci_id"];
			}

			$html_table .= $count_row;
			if (($i + 1) != sizeof($a_item)) {
				$html_table .= '<br><i class="fa fa-arrow-down move_btn" onclick="return sortQuoteItem(\'down\',\'' . $_POST["from_page"] . '\',' . $a_item[$i]["qdoci_id"] . ');"></i>';
				$qdoci_id_below = $a_item[($i + 1)]["qdoci_id"];
			}

			/*$html_table .= '<input id="record_type'.$a_item[$i]["qdoci_id"].'" type="hidden" value="'.$tmp_s.'" >';
			$html_table .= '<input id="record_key'.$a_item[$i]["qdoci_id"].'" type="hidden" value="'.$tmp_s.$tmp_p.'" >';*/
			$html_table .= '<input id="record_above' . $a_item[$i]["qdoci_id"] . '" type="hidden" value="' . $qdoci_id_above . '" >';
			$html_table .= '<input id="record_below' . $a_item[$i]["qdoci_id"] . '" type="hidden" value="' . $qdoci_id_below . '" >';

			$html_table .= '<input name="a_qdoci_id[]" type="hidden" value="' . $a_item[$i]["qdoci_id"] . '" >';
			$html_table .= '<input name="tmp_id[]" type="hidden" value="' . $tmp_s . $tmp_p . '" >';
			$html_table .= '<input name="product_type[]" type="hidden" value="' . $a_item[$i]["pro_type"] . '" id="product_' . $tmp_s . $tmp_p . '">';
			$html_table .= '<input name="item_id[]" type="hidden" value="' . $tmp_e . $a_item[$i]["item_id"] . '" id="id_' . $tmp_s . $tmp_p . '">';
			$tmp_comm_percent = "";

			$html_table .= '<input name="comm_percent[]" type="hidden" value="' . $a_item[$i]["comm_percent"] . '" id="comm_percent_' . $tmp_s . $tmp_p . '">';
			$html_table .= '<input name="qty_note[]" type="hidden" value="' . $a_item[$i]["qty_note"] . '" id="qty_note_' . $tmp_s . $tmp_p . '">';
			$html_table .= '</td>';
			$user_group = Yii::app()->user->getState('userGroup');
			$user_id = Yii::app()->user->getState('userKey');

			if ($user_group != "1" && $user_group != "99") {
                $readonly = "";
				// $readonly = "readonly";
			} else {
				$readonly = "";
			}

			$html_table .= '<td><textarea style="width:200px; min-height:80px; padding:5px;" name="product_item[]" id="product_item_' . $tmp_s . $tmp_p . '" ' . $readonly . '>' . $a_item[$i]["pro_name"] . '</textarea></td>';

			$show_pro_desc = "";
			$tmp_pro_desc = explode("<br>", $a_item[$i]["pro_desc"]);

			$show_pro_desc = $tmp_pro_desc[0];

			$html_table .= '<td><textarea style="width:405px; min-height:80px; padding:5px;" name="product_desc[]" id="product_desc_' . $tmp_s . $tmp_p . '">' . $show_pro_desc . '</textarea></td>';
			$html_table .= '<td>';

			$tmp_uprice = (isset($a_item[$i]["uprice"])) ? floatval($a_item[$i]["uprice"]) : 0.00;

			if ($tmp_s != "other" && $tmp_s != "extra" && $tmp_s != "old_dup") {



				// if( ($doc_status=="approve" && $is_duplicate=="0") ){

				// 	if($a_item[$i]["addi_id_list"]!=""){

				// 		$sql2 = " SELECT * FROM tbl_additional_new WHERE addi_id IN (".$a_item[$i]["addi_id_list"].") ORDER BY ordering ASC;";
				// 		$addi_list = Yii::app()->db->createCommand($sql2)->queryAll();

				// 		foreach($addi_list as $key_addi => $row_addi){

				// 			$show_addi_val = " ";
				// 			if($row_addi["addi_value"]>0){ $show_addi_val .= "+"; }
				// 			$show_addi_val .= $row_addi["addi_value"];

				// 			$html_table .= $row_addi["addi_name"].$show_addi_val.'<br>';

				// 			$tmp_uprice += floatval($row_addi["addi_value"]);

				// 		}
				// 	}


				// }else{

				$html_table .= '<select name="addi_id[' . $tmp_s . $tmp_p . '][]" multiple id="select_' . $tmp_s . $tmp_p . '" onchange="return selectAddi(\'' . $tmp_s . $tmp_p . '\');"> ';

				$sql2 = " SELECT * FROM tbl_additional_new WHERE item_id='" . $a_item[$i]["item_id"] . "' AND curr_id='" . $row_doc["curr_id"] . "' ORDER BY ordering ASC;";

				$addi_list = Yii::app()->db->createCommand($sql2)->queryAll();

				$a_addi_load = array();
				$tmp_addi_list = $a_item[$i]["addi_id_list"];
				if ($tmp_addi_list != "") {
					$a_addi_load = explode(",", $tmp_addi_list);
				}

				foreach ($addi_list as $key_addi => $row_addi) {

					if ($row_addi["addi_value"] != 0) {
						$show_addi_val = " ";
						if ($row_addi["addi_value"] > 0) {
							$show_addi_val .= "+";
						}
						$show_addi_val .= $row_addi["addi_value"];

						$html_table .= '<option value="' . $row_addi["addi_id"] . '|' . $row_addi["addi_value"] . '" ';

						if (sizeof($a_addi_load) > 0) {
							if (in_array($row_addi["addi_id"], $a_addi_load)) {

								$html_table .= 'selected';
								if ($is_duplicate != 1 && $_POST['from_page'] != "quote_rej") {
									$tmp_uprice += floatval($row_addi["addi_value"]);
								}
							}
						}

						$html_table .= '>' . $row_addi["addi_name"] . $show_addi_val . '</option>';
					}
				}
				$html_table .= '<option value="0|0.0">= Nothing =</option>';
				$html_table .= '</select>';
				//}
			} else if ($tmp_s != "other" && $tmp_s != "extra") {

				$html_table .= '<select name="addi_id[' . $tmp_s . $tmp_p . '][]" multiple id="select_' . $tmp_s . $tmp_p . '" onchange="return selectAddi(\'' . $tmp_s . $tmp_p . '\');"> ';
				$html_table .= '<option value="0|0.0">= Nothing =</option>';
				$html_table .= '</select>';
			}
			$html_table .= '</td>';
			$html_table .= '<td style="text-align:center;">';

			if ($tmp_s != "other" && $tmp_s != "extra") {
				$html_table .= $a_item[$i]["qty_note"] . '<br>Com. ' . $a_item[$i]["comm_percent"];
			} else if ($tmp_s == "extra") {
				$html_table .= "MSRP";
			}

			$html_table .= '</td>';
			$html_table .= '<td style="text-align:center;">';

			/*if( ($doc_status=="approve" && $is_duplicate=="0") && ($is_editing=="0") ){

				$html_table .= $a_item[$i]["qty"];
				$html_table .= '<input class="chk_qty" name="qty[]" id="qty_'.$tmp_s.$tmp_p.'" type="hidden" value="'.$a_item[$i]["qty"].'">';

			}else{*/
			$html_table .= '<input class="chk_qty" name="qty[]" id="qty_' . $tmp_s . $tmp_p . '" type="number" min="0" style="text-align:center; width:50px;" onchange="return calPrice(\'' . $tmp_s . $tmp_p . '\'';
			if ($tmp_s == "other") {
				$html_table .= ',1';
			}
			$html_table .= ');" onkeyup="return calPrice(\'' . $tmp_s . $tmp_p . '\'';
			if ($tmp_s == "other") {
				$html_table .= ',1';
			}
			$html_table .= ');" value="' . $a_item[$i]["qty"] . '" >';
			//}

			$html_table .= '</td>';
			$html_table .= '<td style="text-align:center;">';

			if ($tmp_s == "other") {

				if ($doc_status == "approve" && $is_duplicate == "0") {
					$html_table .= $a_item[$i]["uprice"];
					$html_table .= '<input class="chk_uprice" name="uprice[]" type="hidden" id="uprice_other' . $tmp_p . '" value="' . $a_item[$i]["uprice"] . '">';
				} else {
					$html_table .= '<input class="chk_uprice" name="uprice[]" type="number" min="0" id="uprice_other' . $tmp_p . '" value="' . $a_item[$i]["uprice"] . '" style="text-align:center; width:100%; " onchange="return calPrice(\'other' . $tmp_p . '\',1);" onkeyup="return calPrice(\'other' . $tmp_p . '\',1);" >';
				}
			} else if ($tmp_s == "extra") {

				$html_table .= '<input type="hidden" id="old_uprice_' . $tmp_s . $tmp_p . '" value="' . $a_item[$i]["uprice"] . '"><input name="uprice[]" type="hidden" id="uprice_' . $tmp_s . $tmp_p . '" value="' . $a_item[$i]["uprice"] . '"><span id="show_uprice_' . $tmp_s . $tmp_p . '">' . $a_item[$i]["uprice"] . '</span>';
			} else {

				$html_table .= '<input type="hidden" id="old_uprice_' . $tmp_s . $tmp_p . 'land" value="' . $a_item[$i]["uprice"] . '"><input name="uprice[]" type="hidden" id="uprice_' . $tmp_s . $tmp_p . '" value="' . $a_item[$i]["uprice"] . '"><span id="show_uprice_' . $tmp_s . $tmp_p . '">' . $tmp_uprice . '</span>';
			}
			$html_table .= '</td>';

			$html_table .= '<td style="text-align:center;" id="amount_' . $tmp_s . $tmp_p . '"></td>';

			// 			if( !($doc_status=="approve" && $is_duplicate=="0") || ($is_editing=="1") ){
			$html_table .= '<td style="text-align:center;"><button type="button" class="btn btn-danger deleter" tr_full="' . $tmp_s . '" tr_id="' . $tmp_p . '" tr_main="' . $a_item[$i]["qdoci_id"] . '">Del. from Quote</button></td>';
			//}

			// if( !($doc_status=="approve" && $is_duplicate=="0") || ($is_editing=="1") ){
			// 	$html_table .= '<td style="text-align:center;"><button type="button" class="btn btn-danger" onclick="return deleteFromQuote(\''.$tmp_s.$tmp_p.'\','.$a_item[$i]["qdoci_id"];
			// 	$html_table .= ',\''.$_POST["from_page"].'\');">Del. from Quote</button></td>';
			// }

			$html_table .= '</tr></tbody>';
			$count_row++;
		}



		$html_table .= '</table>';
		$html_table .= '<input name="count_item_row" type="hidden" value="' . $count_row . '" id="count_item_row"><input name="curr_id" type="hidden" value="' . $row_doc["curr_id"] . '" id="curr_id">';
		$html_table .= '<input name="edit_quote_id" type="hidden" value="' . $qdoc_id . '" id="edit_quote_id"><input name="edit_est_number" type="hidden" value="' . $row_doc["est_number"] . '" id="edit_est_number">';
		$html_table .= '<input name="edit_comp_id" type="hidden" value="' . $row_doc["comp_id"] . '" id="edit_comp_id"><input name="edit_cust_id" type="hidden" value="' . $row_doc["cust_id"] . '" id="edit_cust_id">';
		$html_table .= '<input name="edit_payment_term" type="hidden" value="' . $row_doc["payment_term"] . '" id="edit_payment_term">';
		$html_table .= '<input name="edit_inc_vat" type="hidden" value="' . $row_doc["inc_vat"] . '" id="edit_inc_vat">';
		$html_table .= '<input name="is_old_process" type="hidden" value="' . $is_old_process . '" id="is_old_process">';

		$currency = "";
		$quote_curr = "";

		/*$new_curr_id = 0;
		if($is_old_process==1){
			$new_curr_id = intval($row_doc["curr_id"])+1;
		}else{
			$new_curr_id = intval($row_doc["curr_id"]);
		}*/

		$sql_curr = " SELECT * FROM tbl_currency WHERE curr_id='" . intval($row_doc["curr_id"]) . "'; ";
		/*echo "<pre>";
		print_r($sql_curr);
		echo "</pre>";
		exit();	*/
		$a_tmp_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();
		$currency = $a_tmp_curr[0]["curr_name"] . " " . $a_tmp_curr[0]["curr_desc"];
		$quote_curr = $a_tmp_curr[0]["curr_name"];



		$html_table .= '<input name="quote_curr" type="hidden" value="' . $quote_curr . '" id="quote_curr">';


		$a_result["currency"] = $currency;
		$a_result["form_inner"] = base64_encode($html_table);

		$a_result["tmp_html_id"] = $tmp_html_id;
		$a_result["num_item"] = $row_doc["num_item"];
		$a_result["est_number"] = $row_doc["est_number"];
		$a_result["dup_from"] = $dup_from;

		$a_result["result"] = "success";
		echo json_encode($a_result);
	}

	// 	public function actionSendToCart(){

	// 		$qdoc_id = $_POST["qdoc_id"];

	// 		$sql_doc = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='".$qdoc_id."'; ";
	// 		$a_doc = Yii::app()->db->createCommand($sql_doc)->queryAll();
	// 		$row_doc = $a_doc[0];

	// 		$doc_status = $row_doc["approve_status"];
	// 		$is_archive = $row_doc["archive"];
	// 		$is_duplicate = $row_doc["is_duplicate"];
	// 		$is_editing = $row_doc["is_editing"];

	// 		$use_note = "";
	// 		if($_POST["from_page"]=="equote" || ($_POST["from_page"]=="quote_rej" && $is_editing=="1") ){
	// 			$sql_edit = "SELECT * FROM tbl_qdoc_edit WHERE qdoc_id='".$qdoc_id."' ORDER BY add_date DESC LIMIT 0,1; ";
	// 			$a_doc_edit = Yii::app()->db->createCommand($sql_edit)->queryAll();
	// 			$row_doc_edit = $a_doc_edit[0];

	// 			$use_note = $row_doc_edit["edit_note"];
	// 		}else{
	// 			$use_note = $row_doc["approval_comment"];
	// 		}


	// 		$sql_item = "SELECT * FROM tbl_quote_item WHERE qdoc_id='".$qdoc_id."' AND enable=1 ORDER BY sort ASC; ";
	// 		$a_item = Yii::app()->db->createCommand($sql_item)->queryAll();

	// 		//$a_data = (array)json_decode(base64_decode($a_load[0]["inner_value"]));
	// 		$html_table = '';
	// 		if($is_duplicate=="0"){
	// 			$html_table .= 'Note: <pre style="width:100%;" class="alert alert-danger">'.$use_note.'</pre>';
	// 		}else{
	// 			$html_table .= '<div style="width:100%; text-align:center;"><center><div style="width:40%; text-align:center;" class="alert alert-warning"><b>DUPLICATION</b></div></center></div>';

	// 		}
	// 		$html_table .= '<input name="is_duplicate" id="is_duplicate" type="hidden" value="'.$row_doc["is_duplicate"].'" >';

	// 		$html_table .= '<table id="tbl_cart_info" class="tbl-cart-info"><tr><th style="width:20px; text-align:center;">#</th><th style="width:150px;" >Product</th><th>Description</th><th style="text-align:center;">Additional</th><th style="text-align:center; width:75px;">Note</th><th style="width:20px; text-align:center;">QTY</th><th style="width:90px; text-align:center;">Price</th><th style="width:70px; text-align:center;">Amount</th>';
	// // 		if( !($doc_status=="approve" && $is_duplicate=="0") || ($is_editing=="1") ){
	// 			$html_table .= '<th style="width:60px; text-align:center;">Action</th>';
	// // 		}
	// 		$html_table .= '</tr>';


	// 		$count_row = 1;



	// 		$tmp_html_id = "";

	// 		$is_old_process = 0;

	// 		for($i=0;$i<sizeof($a_item);$i++){

	// 			$tmp_s = "";
	// 			$tmp_p = "";
	// 			$tmp_e = "";

	// 			if($a_item[$i]["pro_type"]=="other"){
	// 				$tmp_s = "other";
	// 				$tmp_p = $count_row;
	// 			}else if($a_item[$i]["pro_type"]=="extra"){
	// 				$tmp_s = "extra";
	// 				$tmp_p = $count_row;
	// 				$tmp_e = "e";
	// 			}else{
	// 				if( $a_item[$i]["item_id"]!="" ){

	// 					if($a_item[$i]["item_id"]=="0"){
	// 						$tmp_s = "old_dup";
	// 						//$tmp_p = $count_row;
	// 					}else{
	// 						$tmp_s = "new";
	// 						//$tmp_p = $a_item[$i]["item_id"];
	// 					}

	// 				}else{
	// 					$tmp_s = $a_item[$i]["pro_type"];
	// 					//$tmp_p = $a_item[$i]["pro_id"];
	// 					$is_old_process = 1;
	// 				}
	// 				$tmp_p = $a_item[$i]["qdoci_id"];

	// 			}

	// 			if($tmp_html_id!=""){  $tmp_html_id .= ","; }
	// 			$tmp_html_id .= $tmp_s."".$tmp_p;

	// 			$a_row = array();

	// 			$qdoci_id_above = "";
	// 			$qdoci_id_below = "";
	// 			$html_table .= '<tbody id="tr_'.$tmp_s.$tmp_p.'"><tr><td style="text-align:center;">';
	// 			if($i!=0){
	// 				$html_table .= '<i class="fa fa-arrow-up move_btn" onclick="return sortQuoteItem(\'up\',\''.$_POST["from_page"].'\','.$a_item[$i]["qdoci_id"].');"></i><br>';
	// 				$qdoci_id_above = $a_item[($i-1)]["qdoci_id"];
	// 			}

	// 			$html_table .= $count_row;
	// 			if(($i+1)!=sizeof($a_item)){
	// 				$html_table .= '<br><i class="fa fa-arrow-down move_btn" onclick="return sortQuoteItem(\'down\',\''.$_POST["from_page"].'\','.$a_item[$i]["qdoci_id"].');"></i>';
	// 				$qdoci_id_below = $a_item[($i+1)]["qdoci_id"];
	// 			}

	// 			/*$html_table .= '<input id="record_type'.$a_item[$i]["qdoci_id"].'" type="hidden" value="'.$tmp_s.'" >';
	// 			$html_table .= '<input id="record_key'.$a_item[$i]["qdoci_id"].'" type="hidden" value="'.$tmp_s.$tmp_p.'" >';*/
	// 			$html_table .= '<input id="record_above'.$a_item[$i]["qdoci_id"].'" type="hidden" value="'.$qdoci_id_above.'" >';
	// 			$html_table .= '<input id="record_below'.$a_item[$i]["qdoci_id"].'" type="hidden" value="'.$qdoci_id_below.'" >';

	// 			$html_table .= '<input name="a_qdoci_id[]" type="hidden" value="'.$a_item[$i]["qdoci_id"].'" >';
	// 			$html_table .= '<input name="tmp_id[]" type="hidden" value="'.$tmp_s.$tmp_p.'" >';
	// 			$html_table .= '<input name="product_type[]" type="hidden" value="'.$a_item[$i]["pro_type"].'" id="product_'.$tmp_s.$tmp_p.'">';
	// 			$html_table .= '<input name="item_id[]" type="hidden" value="'.$tmp_e.$a_item[$i]["item_id"].'" id="id_'.$tmp_s.$tmp_p.'">';
	// 			$tmp_comm_percent = "";

	// 			$html_table .= '<input name="comm_percent[]" type="hidden" value="'.$a_item[$i]["comm_percent"].'" id="comm_percent_'.$tmp_s.$tmp_p.'">';
	// 			$html_table .= '<input name="qty_note[]" type="hidden" value="'.$a_item[$i]["qty_note"].'" id="qty_note_'.$tmp_s.$tmp_p.'">';
	// 			$html_table .= '</td>';
	// 			$html_table .= '<td><textarea style="width:200px; min-height:80px; padding:5px;" name="product_item[]" id="product_item_'.$tmp_s.$tmp_p.'">'.$a_item[$i]["pro_name"].'</textarea></td>';

	// 			$show_pro_desc = "";
	// 			$tmp_pro_desc = explode("<br>", $a_item[$i]["pro_desc"]);

	// 			$show_pro_desc = $tmp_pro_desc[0];

	// 			$html_table .= '<td><textarea style="width:405px; min-height:80px; padding:5px;" name="product_desc[]" id="product_desc_'.$tmp_s.$tmp_p.'">'.$show_pro_desc.'</textarea></td>';
	// 			$html_table .= '<td>';
	//             if($is_duplicate=="1"){
	// 			    $tmp_uprice = (isset($a_item[$i]["uprice"]))?floatval($a_item[$i]["uprice"]):0.00;
	//             }
	//             else{
	//                 $tmp_uprice = (isset($a_item[$i]["uprice_ori"]))?floatval($a_item[$i]["uprice_ori"]):0.00;
	//             }

	// 			if($tmp_s!="other" && $tmp_s!="extra" && $tmp_s!="old_dup"){



	// 				// if( ($doc_status=="approve" && $is_duplicate=="0") ){

	// 				// 	if($a_item[$i]["addi_id_list"]!=""){

	// 				// 		$sql2 = " SELECT * FROM tbl_additional_new WHERE addi_id IN (".$a_item[$i]["addi_id_list"].") ORDER BY ordering ASC;";
	// 				// 		$addi_list = Yii::app()->db->createCommand($sql2)->queryAll();

	// 				// 		foreach($addi_list as $key_addi => $row_addi){

	// 				// 			$show_addi_val = " ";
	// 				// 			if($row_addi["addi_value"]>0){ $show_addi_val .= "+"; }
	// 				// 			$show_addi_val .= $row_addi["addi_value"];

	// 				// 			$html_table .= $row_addi["addi_name"].$show_addi_val.'<br>';

	// 				// 			$tmp_uprice += floatval($row_addi["addi_value"]);

	// 				// 		}
	// 				// 	}


	// 				// }else{

	// 					$html_table .= '<select name="addi_id['.$tmp_s.$tmp_p.'][]" multiple id="select_'.$tmp_s.$tmp_p.'" onchange="return selectAddi(\''.$tmp_s.$tmp_p.'\');"> ';

	// 					$sql2 = " SELECT * FROM tbl_additional_new WHERE item_id='".$a_item[$i]["item_id"]."' AND curr_id='".$row_doc["curr_id"]."' ORDER BY ordering ASC;";

	// 					$addi_list = Yii::app()->db->createCommand($sql2)->queryAll();

	// 					$a_addi_load = array();
	// 					$tmp_addi_list = $a_item[$i]["addi_id_list"];
	// 					if($tmp_addi_list!=""){
	// 						$a_addi_load = explode(",", $tmp_addi_list);
	// 					}

	// 					foreach($addi_list as $key_addi => $row_addi){

	// 						if($row_addi["addi_value"]!=0){
	// 							$show_addi_val = " ";
	// 							if($row_addi["addi_value"]>0){ $show_addi_val .= "+"; }
	// 							$show_addi_val .= $row_addi["addi_value"];

	// 							$html_table .= '<option value="'.$row_addi["addi_id"].'|'.$row_addi["addi_value"].'" ';

	// 							if(sizeof($a_addi_load)>0){
	// 								if( in_array($row_addi["addi_id"], $a_addi_load) ){

	// 									$html_table .= 'selected';
	// 									if($is_duplicate!=1){
	// 									$tmp_uprice += floatval($row_addi["addi_value"]);
	// 									}

	// 								}
	// 							}

	// 							$html_table .= '>'.$row_addi["addi_name"].$show_addi_val.'</option>';
	// 						}
	// 					}
	// 					$html_table .= '<option value="0|0.0">= Nothing =</option>';
	// 					$html_table .= '</select>';
	// 				//}
	// 			}else if($tmp_s!="other" && $tmp_s!="extra"){

	// 				$html_table .= '<select name="addi_id['.$tmp_s.$tmp_p.'][]" multiple id="select_'.$tmp_s.$tmp_p.'" onchange="return selectAddi(\''.$tmp_s.$tmp_p.'\');"> ';
	// 				$html_table .= '<option value="0|0.0">= Nothing =</option>';
	// 				$html_table .= '</select>';
	// 			}
	// 			$html_table .= '</td>';
	// 			$html_table .= '<td style="text-align:center;">';

	// 			if($tmp_s!="other" && $tmp_s!="extra"){
	// 				$html_table .= $a_item[$i]["qty_note"].'<br>Com. '.$a_item[$i]["comm_percent"];
	// 			}else if($tmp_s=="extra"){
	// 				$html_table .= "MSRP";
	// 			}

	// 			$html_table .= '</td>';
	// 			$html_table .= '<td style="text-align:center;">';

	// 			/*if( ($doc_status=="approve" && $is_duplicate=="0") && ($is_editing=="0") ){

	// 				$html_table .= $a_item[$i]["qty"];
	// 				$html_table .= '<input class="chk_qty" name="qty[]" id="qty_'.$tmp_s.$tmp_p.'" type="hidden" value="'.$a_item[$i]["qty"].'">';

	// 			}else{*/
	// 				$html_table .= '<input class="chk_qty" name="qty[]" id="qty_'.$tmp_s.$tmp_p.'" type="number" min="0" style="text-align:center; width:50px;" onchange="return calPrice(\''.$tmp_s.$tmp_p.'\'';
	// 				if($tmp_s=="other"){
	// 					$html_table .= ',1';
	// 				}
	// 				$html_table .= ');" onkeyup="return calPrice(\''.$tmp_s.$tmp_p.'\'';
	// 				if($tmp_s=="other"){
	// 					$html_table .= ',1';
	// 				}
	// 				$html_table .= ');" value="'.$a_item[$i]["qty"].'" >';
	// 			//}

	// 			$html_table .= '</td>';
	// 			$html_table .= '<td style="text-align:center;">';

	// 			if($tmp_s=="other"){

	// 				if( $doc_status=="approve" && $is_duplicate=="0" ){
	// 					$html_table .= $a_item[$i]["uprice_ori"];
	// 					$html_table .= '<input class="chk_uprice" name="uprice[]" type="hidden" id="uprice_other'.$tmp_p.'" value="'.$a_item[$i]["uprice_ori"].'">';
	// 				}else{
	// 					$html_table .= '<input class="chk_uprice" name="uprice[]" type="number" min="0" id="uprice_other'.$tmp_p.'" value="'.$a_item[$i]["uprice_ori"].'" style="text-align:center; width:100%; " onchange="return calPrice(\'other'.$tmp_p.'\',1);" onkeyup="return calPrice(\'other'.$tmp_p.'\',1);" >';
	// 				}
	// 			}else if($tmp_s=="extra"){

	// 				$html_table .= '<input type="hidden" id="old_uprice_'.$tmp_s.$tmp_p.'" value="'.$a_item[$i]["uprice_ori"].'"><input name="uprice[]" type="hidden" id="uprice_'.$tmp_s.$tmp_p.'" value="'.$a_item[$i]["uprice_ori"].'"><span id="show_uprice_'.$tmp_s.$tmp_p.'">'.$a_item[$i]["uprice_ori"].'</span>';

	// 			}else{

	// 				$html_table .= '<input type="hidden" id="old_uprice_'.$tmp_s.$tmp_p.'land" value="'.$a_item[$i]["uprice_ori"].'"><input name="uprice[]" type="hidden" id="uprice_'.$tmp_s.$tmp_p.'" value="'.$a_item[$i]["uprice_ori"].'"><span id="show_uprice_'.$tmp_s.$tmp_p.'">'.$tmp_uprice.'</span>';

	// 			}
	// 			$html_table .= '</td>';

	// 			$html_table .= '<td style="text-align:center;" id="amount_'.$tmp_s.$tmp_p.'"></td>';

	// // 			if( !($doc_status=="approve" && $is_duplicate=="0") || ($is_editing=="1") ){
	// 				$html_table .= '<td style="text-align:center;"><button type="button" class="btn btn-danger deleter" tr_full="'.$tmp_s.'" tr_id="'.$tmp_p.'" tr_main="'.$a_item[$i]["qdoci_id"].'">Del. from Quote</button></td>';
	// 			//}

	// 			// if( !($doc_status=="approve" && $is_duplicate=="0") || ($is_editing=="1") ){
	// 			// 	$html_table .= '<td style="text-align:center;"><button type="button" class="btn btn-danger" onclick="return deleteFromQuote(\''.$tmp_s.$tmp_p.'\','.$a_item[$i]["qdoci_id"];
	// 			// 	$html_table .= ',\''.$_POST["from_page"].'\');">Del. from Quote</button></td>';
	// 			// }

	// 			$html_table .= '</tr></tbody>';
	// 			$count_row++;

	// 		}



	// 		$html_table .= '</table>';
	// 		$html_table .= '<input name="count_item_row" type="hidden" value="'.$count_row.'" id="count_item_row"><input name="curr_id" type="hidden" value="'.$row_doc["curr_id"].'" id="curr_id">';
	// 		$html_table .= '<input name="edit_quote_id" type="hidden" value="'.$qdoc_id.'" id="edit_quote_id"><input name="edit_est_number" type="hidden" value="'.$row_doc["est_number"].'" id="edit_est_number">';
	// 		$html_table .= '<input name="edit_comp_id" type="hidden" value="'.$row_doc["comp_id"].'" id="edit_comp_id"><input name="edit_cust_id" type="hidden" value="'.$row_doc["cust_id"].'" id="edit_cust_id">';
	// 		$html_table .= '<input name="edit_payment_term" type="hidden" value="'.$row_doc["payment_term"].'" id="edit_payment_term">';
	// 		$html_table .= '<input name="edit_inc_vat" type="hidden" value="'.$row_doc["inc_vat"].'" id="edit_inc_vat">';
	// 		$html_table .= '<input name="is_old_process" type="hidden" value="'.$is_old_process.'" id="is_old_process">';

	// 		$currency = "";
	// 		$quote_curr = "";

	// 		/*$new_curr_id = 0;
	// 		if($is_old_process==1){
	// 			$new_curr_id = intval($row_doc["curr_id"])+1;
	// 		}else{
	// 			$new_curr_id = intval($row_doc["curr_id"]);
	// 		}*/

	// 		$sql_curr = " SELECT * FROM tbl_currency WHERE curr_id='".intval($row_doc["curr_id"])."'; ";
	// 		/*echo "<pre>";
	// 		print_r($sql_curr);
	// 		echo "</pre>";
	// 		exit();	*/
	// 		$a_tmp_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();
	// 		$currency = $a_tmp_curr[0]["curr_name"]." ".$a_tmp_curr[0]["curr_desc"];
	// 		$quote_curr = $a_tmp_curr[0]["curr_name"];



	// 		$html_table .= '<input name="quote_curr" type="hidden" value="'.$quote_curr.'" id="quote_curr">';


	// 		$a_result["currency"] = $currency;
	// 		$a_result["form_inner"] = base64_encode($html_table);

	// 		$a_result["tmp_html_id"] = $tmp_html_id;
	// 		$a_result["num_item"] = $row_doc["num_item"];
	// 		$a_result["est_number"] = $row_doc["est_number"];

	// 		$a_result["result"] = "success";
	// 		echo json_encode($a_result);

	// 	}

	public function actionSortQuoteItem()
	{

		$qdoci_id1 = $_POST["qdoci_id1"];
		$qdoci_id2 = $_POST["qdoci_id2"];

		$sql_select1 = " SELECT qdoc_id,sort FROM tbl_quote_item WHERE qdoci_id='" . $qdoci_id1 . "'; ";
		$a_item1 = Yii::app()->db->createCommand($sql_select1)->queryAll();
		$qdoc_id = intval($a_item1[0]["qdoc_id"]);

		$sql_select2 = " SELECT sort FROM tbl_quote_item WHERE qdoci_id='" . $qdoci_id2 . "'; ";
		$a_item2 = Yii::app()->db->createCommand($sql_select2)->queryAll();

		$sql_update1 = "UPDATE tbl_quote_item SET sort='" . $a_item2[0]["sort"] . "' WHERE qdoci_id='" . $qdoci_id1 . "'; ";
		Yii::app()->db->createCommand($sql_update1)->execute();

		$sql_update2 = "UPDATE tbl_quote_item SET sort='" . $a_item1[0]["sort"] . "' WHERE qdoci_id='" . $qdoci_id2 . "'; ";
		Yii::app()->db->createCommand($sql_update2)->execute();

		$a_result["result"] = "success";
		$a_result["qdoc_id"] = $qdoc_id;

		echo json_encode($a_result);
	}

	public function actionDeleteQuote()
	{

		$qdoc_id = $_POST["qdoc_id"];

		$sql_update = "UPDATE tbl_quote_doc SET enable=0 WHERE qdoc_id='" . $qdoc_id . "'; ";

		if (Yii::app()->db->createCommand($sql_update)->execute()) {
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to delete.";
		}

		echo json_encode($a_result);
	}

	public function actionSaveRequestEditNotes()
	{

		$qdoc_id = $_POST["edit_qdoc_id"];
		$edit_note = addslashes($_POST["edit_note"]);

		$sql_insert = "INSERT INTO tbl_qdoc_edit (qdoc_id,edit_note,add_date) VALUES ('" . $qdoc_id . "','" . $edit_note . "','" . date("Y-m-d H:i:s") . "'); ";

		if (Yii::app()->db->createCommand($sql_insert)->execute()) {

			$sql_update = "UPDATE tbl_quote_doc SET is_editing=1 WHERE qdoc_id='" . $qdoc_id . "'; ";
			Yii::app()->db->createCommand($sql_update)->execute();

			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to delete.";
		}

		echo json_encode($a_result);
	}

	public function actionSetAcknowledge()
	{

		$qdoc_id = $_POST["qdoc_id"];
		$sql_update = "UPDATE tbl_quote_doc SET is_editing=0 WHERE qdoc_id='" . $qdoc_id . "'; ";

		if (Yii::app()->db->createCommand($sql_update)->execute()) {
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to set Acknowledge.";
		}

		echo json_encode($a_result);
	}

	public function actionDuplicateQuote()
	{

		$qdoc_id = $_POST["qdoc_id"];
		$sql_dup_doc = "INSERT INTO tbl_quote_doc (user_id,comp_id,comp_name,comp_info,curr_id,quote_curr,payment_term,cust_id,cust_name,cust_info,est_number,est_date
                    ,exp_date,inc_vat,vat_value,num_item,sub_total,grand_total,sale_note,note,approve_status,approve_date
                    ,reject_time,is_temp,is_duplicate,archive,add_date,enable,dup_from,dup_from_id) SELECT user_id,comp_id,comp_name,comp_info,curr_id,quote_curr,payment_term,cust_id,cust_name,cust_info,est_number,est_date
                    ,exp_date,inc_vat,vat_value,num_item,sub_total,grand_total,sale_note,note,approve_status,approve_date
                    ,reject_time,is_temp,1,archive,add_date,enable,1,'$qdoc_id' FROM tbl_quote_doc WHERE qdoc_id=" . $qdoc_id;
		Yii::app()->db->createCommand($sql_dup_doc)->execute();

		$new_qdoc_id = Yii::app()->db->getLastInsertID();

		$sql_new = "SELECT pro_type,pro_id,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,addi_desc,comm_percent,sort,add_date,enable FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "'";
		$data = Yii::app()->db->createCommand($sql_new)->queryAll();
		foreach ($data as $entries) {
			$pro_type = addslashes($entries['pro_type']);
			$pro_id = addslashes($entries['pro_id']);
			$item_id = addslashes($entries['item_id']);
			$pro_name = addslashes($entries['pro_name']);
			$pro_desc = addslashes($entries['pro_desc']);
			$qty = addslashes($entries['qty']);
			$qty_note = addslashes($entries['qty_note']);
			$uprice = addslashes($entries['uprice']);
			$uprice_ori = addslashes($entries['uprice_ori']);
			$addi_id_list = addslashes($entries['addi_id_list']);
			$addi_desc = addslashes($entries['addi_desc']);
			$comm_percent = addslashes($entries['comm_percent']);
			$sort = addslashes($entries['sort']);
			$add_date = addslashes($entries['add_date']);
			$enable = addslashes($entries['enable']);
			if ($addi_id_list == "" || $addi_id_list == null) {
				$sql_add = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,pro_id,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,addi_desc,comm_percent,sort,add_date,enable) VALUES ('$new_qdoc_id','$pro_type','$pro_id','$item_id','$pro_name','$pro_desc','$qty','$qty_note','$uprice','$uprice_ori','$addi_id_list','$addi_desc','$comm_percent','$sort','$add_date','$enable')";
				Yii::app()->db->createCommand($sql_add)->execute();
			} else {
				//$uprice = $uprice_ori;
				$sql_add = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,pro_id,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,addi_desc,comm_percent,sort,add_date,enable) VALUES ('$new_qdoc_id','$pro_type','$pro_id','$item_id','$pro_name','$pro_desc','$qty','$qty_note','$uprice','$uprice_ori','$addi_id_list','$addi_desc','$comm_percent','$sort','$add_date','$enable')";
				Yii::app()->db->createCommand($sql_add)->execute();
				//  $prices = 0;
				//  $exploder = explode(',',$add_id_list);
				//  foreach($exploder as $list){
				//      $sql_list = "SELECT * FROM tbl_additional_new WHERE addi_id='$list'";
				//  $data_new = Yii::app()->db->createCommand($sql_new)->queryAll();
				//      foreach($data_new as $add){
				//          $prices = $add['addi_value']+$prices;
				//      }
				//  }

			}
		}

		// 		$sql_dup_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,pro_id,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,comm_percent,sort,add_date,enable) SELECT '".$new_qdoc_id."',pro_type,pro_id,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,comm_percent,sort,add_date,enable FROM tbl_quote_item WHERE qdoc_id='".$qdoc_id."'";

		// 		Yii::app()->db->createCommand($sql_dup_item)->execute();

		$a_result["result"] = "success";

		echo json_encode($a_result);
	}

	public function actionUpdateSaleNote()
	{

		$qdoc_id = $_POST["qdoc_id"];
		$sale_note = base64_decode($_POST["edit_sale_note"]);

		$sql_update = "UPDATE tbl_quote_doc SET sale_note='" . addslashes($sale_note) . "' WHERE qdoc_id='" . $qdoc_id . "'; ";

		if (Yii::app()->db->createCommand($sql_update)->execute()) {
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to update Notes.";
		}

		echo json_encode($a_result);
	}

	public function actionShowCompanyList()
	{

		$user_group = Yii::app()->user->getState('userGroup');

		$can_edit = "disabled";
		if ($user_group == "1" || $user_group == "99") {
			$can_edit = "";
		}

		$sql = " SELECT tbl_comp_info.*,tbl_quote_note.qnote_id,tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.enable=1 ORDER BY tbl_comp_info.add_date DESC;";
		$comp_list = Yii::app()->db->createCommand($sql)->queryAll();

		$inner_html = '<table class="tbl_company" style="width: 100%;">';
		$inner_html .= '<tr>';
		$inner_html .= '<th>#</th><th>Logo</th><th>Name / Code / VAT</th><th>Info</th><th>Default Note</th><th>Action</th>';
		$inner_html .= '</tr>';

		$count_row = 1;
		foreach ($comp_list as $key => $row) {

			$inner_html .= '<tr style="border-bottom:3px solid #FFF;">';
			$inner_html .= '<td style="text-align: center;">' . $count_row . '</td>';
			$inner_html .= '<td style="text-align: center;">';

			if ($row["comp_logo"] != "") {
				$inner_html .= '<img src="../images/' . $row["comp_logo"] . '" style="max-width:150px;">';
			}

			$inner_html .= '</td>';
			$inner_html .= '<td style="text-align: center;">';
			$inner_html .= '<div class="ncv_content">' . $row["comp_name"] . '</div>';
			$inner_html .= '<div class="ncv_content"><b>' . $row["comp_code"] . '</b></div>';
			$inner_html .= '<div class="ncv_content">VAT : ' . (($row["have_vat"] == "1") ? "Included" : "No") . '</div>';
			$inner_html .= '</td>';
			$inner_html .= '<td><pre>' . $row["comp_info"] . '</pre></td>';
			$inner_html .= '<td><pre style="word-wrap: break-word; width: 250px;">' . $row["qnote_text"] . '</pre></td>';
			$inner_html .= '<td style="text-align: center;">';
			$inner_html .= '<button class="btn btn-warning" ' . $can_edit . ' onclick="return editCompanyData(' . $row["comp_id"] . ');">Edit</button>';
			$inner_html .= '<button class="btn btn-danger" ' . $can_edit . ' onclick="return deleteCompanyData(' . $row["comp_id"] . ');">Delete</button>';

			$s_obj_tmp = base64_encode(json_encode($row));

			$inner_html .= '<input type="hidden" id="comp_obj' . $row["comp_id"] . '" value="' . $s_obj_tmp . '">';
			$inner_html .= '</td>';
			$inner_html .= '</tr>';

			$count_row++;
		}

		$inner_html .= '</table>';

		echo $inner_html;
	}

	public function actionSaveCompanyData()
	{

		$comp_name = addslashes($_POST["add_comp_name"]);
		$comp_info = addslashes($_POST["add_comp_info"]);

		$note = addslashes($_POST["add_note"]);

		$comp_code = $_POST["add_comp_code"];
		$have_vat = ((isset($_POST["add_have_vat"]) && ($_POST["add_have_vat"] == "yes")) ? 1 : 0);

		$date_now = date("Y-m-d H:i:s");

		$sql_insert = "INSERT INTO tbl_comp_info (comp_name,comp_info,comp_code,have_vat,tmp_year,year_doc_count,add_date) VALUES (";
		$sql_insert .= "'" . $comp_name . "','" . $comp_info . "','" . $comp_code . "','" . $have_vat . "','" . date("Y") . "',1,'" . $date_now . "'";
		$sql_insert .= ");";

		$comp_id = "";

		if (Yii::app()->db->createCommand($sql_insert)->execute()) {

			$comp_id = Yii::app()->db->getLastInsertID();

			$sql_insert2 = "INSERT INTO tbl_quote_note (comp_id,qnote_name,qnote_text,add_date) VALUES (";
			$sql_insert2 .= "'" . $comp_id . "','" . $comp_name . "','" . $note . "','" . $date_now . "'";
			$sql_insert2 .= ");";

			Yii::app()->db->createCommand($sql_insert2)->execute();

			if (isset($_FILES['logo_file']) && !empty($_FILES['logo_file'])) {

				$name_file = $comp_id . '_' . $_FILES["logo_file"]["name"];

				if (move_uploaded_file($_FILES["logo_file"]["tmp_name"], Yii::getPathOfAlias('webroot') . '/images/' . $name_file)) {

					$sql_update = "UPDATE tbl_comp_info SET comp_logo='" . $name_file . "' WHERE comp_id='" . $comp_id . "'; ";
					Yii::app()->db->createCommand($sql_update)->execute();
				}
			}
		}
	}

	public function actionSaveEditCompanyData()
	{

		$comp_id = $_POST["edit_comp_id"];
		$comp_name = addslashes($_POST["edit_comp_name"]);
		$comp_info = addslashes($_POST["edit_comp_info"]);

		$comp_code = $_POST["edit_comp_code"];
		$have_vat = ((isset($_POST["edit_have_vat"]) && ($_POST["edit_have_vat"] == "yes")) ? 1 : 0);

		$extra_sql = "";
		if (isset($_FILES['edit_logo_file']) && !empty($_FILES['edit_logo_file'])) {

			$name_file = $comp_id . '_' . $_FILES["edit_logo_file"]["name"];

			if (move_uploaded_file($_FILES["edit_logo_file"]["tmp_name"], Yii::getPathOfAlias('webroot') . '/images/' . $name_file)) {

				$extra_sql = ",comp_logo='" . $name_file . "'";
			}
		}

		$sql_update = "UPDATE tbl_comp_info SET comp_name='" . $comp_name . "',comp_info='" . $comp_info . "',comp_code='" . $comp_code . "',have_vat='" . $have_vat . "'" . $extra_sql . " WHERE comp_id='" . $comp_id . "'; ";
		Yii::app()->db->createCommand($sql_update)->execute();

		$qnote_id = $_POST["edit_qnote_id"];
		$note = addslashes($_POST["edit_note"]);

		$sql_update2 = "UPDATE tbl_quote_note SET qnote_text='" . $note . "' WHERE qnote_id='" . $qnote_id . "'; ";
		Yii::app()->db->createCommand($sql_update2)->execute();
	}

	public function actionDeleteCompanyData()
	{

		$comp_id = $_POST["comp_id"];
		$a_result = array();

		$sql_update = "UPDATE tbl_comp_info SET enable=0 WHERE comp_id='" . $comp_id . "'; ";
		if (Yii::app()->db->createCommand($sql_update)->execute()) {

			$sql_update2 = "UPDATE tbl_quote_note SET enable=0 WHERE comp_id='" . $comp_id . "'; ";
			Yii::app()->db->createCommand($sql_update2)->execute();

			$a_result["result"] = "success";
		} else {

			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to delete Data.";
		}

		echo json_encode($a_result);
	}

	public function actionRefreshDate()
	{

		$qdoc_id = $_POST["qdoc_id"];

		$est_date = date("Y-m-d");
		$exp_date = date("Y-m-d", strtotime("+30 days", strtotime($est_date)));

		$a_result = array();

		$sql_update = "UPDATE tbl_quote_doc SET est_date='" . $est_date . "',exp_date='" . $exp_date . "' WHERE qdoc_id='" . $qdoc_id . "'; ";
		if (Yii::app()->db->createCommand($sql_update)->execute()) {

			$a_result["result"] = "success";
			$a_result["est_date"] = date("F d, Y", strtotime($est_date));
			$a_result["exp_date"] = date("F d, Y", strtotime($exp_date));
		} else {

			$sql_chk = "SELECT est_date,exp_date FROM tbl_quote_doc WHERE qdoc_id='" . $qdoc_id . "';";
			$a_date_data = Yii::app()->db->createCommand($sql_chk)->queryAll();

			if (($a_date_data[0]["est_date"] == $est_date) && ($a_date_data[0]["exp_date"] == $exp_date)) {

				$a_result["result"] = "success";
				$a_result["est_date"] = date("F d, Y", strtotime($est_date));
				$a_result["exp_date"] = date("F d, Y", strtotime($exp_date));
			} else {
				$a_result["result"] = "fail";
				$a_result["msg"] = "Fail to refresh Date.";
			}
		}

		echo json_encode($a_result);
	}

	public function actionSubmitInvoice()
    {
        $qdoc_id = $_POST["qdoc_id"];
        $inv_no = $_POST["inv_value"];
        $sql_update = "UPDATE tbl_quote_doc SET inv_no='" . addslashes($inv_no) . "' WHERE qdoc_id='" . $qdoc_id . "'; ";
        if (Yii::app()->db->createCommand($sql_update)->execute()) {
            $a_result["result"] = "success";
            $a_result["inv_show"] = str_replace(",", "<br>", $inv_no);
            $sqlqid = "SELECT * FROM `quotation_data` WHERE `qdoci_id` = $qdoc_id";
            $getqid = Yii::app()->db->createCommand($sqlqid)->queryAll();
            if (!empty($getqid)) {
                $prefix = preg_replace('/-[A-Za-z].*$/', '', $getqid[0]['jog_code']);
                $prefix = preg_replace('/[A-Za-z]$/', '', $prefix);
                $jogid = "SELECT * FROM `tbl_order` WHERE `JOG_Code` LIKE '".$prefix."%'";
                $ordid = Yii::app()->db->createCommand($jogid)->queryAll();
                foreach ($ordid as $key => $odr) {
                    $sql = "UPDATE `tbl_order` SET `Inv_no`= '$inv_no' WHERE `id`= ".$odr['id']."";
                    $update =  Yii::app()->db->createCommand($sql)->execute();
                }
            }
        } else {
            $a_result["result"] = "fail";
            $a_result["msg"] = "Fail to save Invoice Number.";
        }
        echo json_encode($a_result);
    }

	public function actionSubmitInvoiceLink()
	{

		$qdoc_id = $_POST["qdoc_id"];
		$inv_no = $_POST["inv_value"];

		$sql_update = "UPDATE quotation_data SET invoice_link='" . addslashes($inv_no) . "' WHERE qdoci_id='" . $qdoc_id . "'; ";
		if (Yii::app()->db->createCommand($sql_update)->execute()) {
			$a_result["result"] = "success";
			$a_result["inv_show"] = str_replace(",", "<br>", $inv_no);

			$sqlqid = "SELECT * FROM `quotation_data` WHERE `qdoci_id` = $qdoc_id";
        	$getqid = Yii::app()->db->createCommand($sqlqid)->queryAll();
					
			if (!empty($getqid)) {	
				$prefix = preg_replace('/-[A-Za-z].*$/', '', $getqid[0]['jog_code']);				
				$prefix = preg_replace('/[A-Za-z]$/', '', $prefix);
				$jogid = "SELECT * FROM `tbl_order` WHERE `JOG_Code` LIKE '".$prefix."%'";
				$ordid = Yii::app()->db->createCommand($jogid)->queryAll();				
				foreach ($ordid as $key => $odr) {					
					$sql = "UPDATE `tbl_order` SET `Invlink`= '$inv_no' WHERE `id`= ".$odr['id']."";	
					$update =  Yii::app()->db->createCommand($sql)->execute();								
				}
			}


		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to save Invoice Link.";
		}

		echo json_encode($a_result);
	}

	public function actionCommReport()
	{

		$desc_show = "no";
		if (isset($_GET["desc_show"]) && ($_GET["desc_show"] != "")) {
			$desc_show = $_GET["desc_show"];
		}

		$data_per_page = 20;

		$page = 1;

		if (isset($_GET["page"]) && ($_GET["page"] != "") && ($_GET["page"] != "null")) {
			$page = intval($_GET["page"]);
		}
		$start_index = ($page - 1) * $data_per_page;

		$result['act_page'] = "archived";
		$result['data_per_page'] = $data_per_page;
		$result['page'] = $page;

		$y_select = "";
		$m_select = "";
		$u_select = "";
		$extra_condition = "";
		if (isset($_GET["y"]) && ($_GET["y"] != "")) {
			$y_select = intval($_GET["y"]);
			if ($y_select == "0") {
				$extra_condition .= "%";
			} else {
				$extra_condition .= $y_select;
			}
			$extra_condition .= "-";
		}

		if (isset($_GET["m"]) && ($_GET["m"] != "")) {
			$m_select = intval($_GET["m"]);
			if ($m_select == "0") {
				$extra_condition .= "%";
			} else {

				$extra_condition .= ((intval($m_select) > 9) ? $m_select : "0" . $m_select) . "-%";
			}
		}

		if ($extra_condition != "") {
			$extra_condition = " AND tbl_quote_doc.est_date LIKE '" . $extra_condition . "' ";
		}

		if (isset($_GET["u"]) && ($_GET["u"] != "")) {
			$u_select = intval($_GET["u"]);

			if ($u_select != "0") {
				$extra_condition .= " AND tbl_quote_doc.user_id='" . $u_select . "' ";
			}
		}

		$have_inv_show = "yes";
		if (isset($_GET["have_inv_show"]) && ($_GET["have_inv_show"] != "")) {

			$have_inv_show = $_GET["have_inv_show"];
		}
		if ($have_inv_show == "yes") {
			$extra_condition .= " AND tbl_quote_doc.inv_no<>'' AND tbl_quote_doc.inv_no IS NOT NULL ";
		}

		$s_value = "";
		if (isset($_GET["s"]) && ($_GET["s"] != "")) {
			$s_value = base64_decode($_GET["s"]);

			if ($s_value != "") {
				$s_value = addslashes($s_value);
				$extra_condition .= " AND (tbl_quote_doc.est_number LIKE '%" . $s_value . "%' OR tbl_quote_doc.inv_no LIKE '%" . $s_value . "%' OR tbl_quote_doc.cust_name LIKE '%" . $s_value . "%') ";
			}
		}

		$sql = " FROM tbl_quote_item LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=tbl_quote_item.qdoc_id LEFT JOIN user ON tbl_quote_doc.user_id=user.id WHERE tbl_quote_doc.enable=1 AND tbl_quote_item.enable=1 ";
		$sql .= " AND ( tbl_quote_doc.archive='1' OR tbl_quote_doc.approve_status='approve' ) " . $extra_condition;

		$s_order_by = " ORDER BY tbl_quote_doc.is_duplicate DESC, tbl_quote_doc.add_date DESC,tbl_quote_item.sort ASC ";

		$s_limit = " LIMIT " . $start_index . "," . $data_per_page . ";";

		$sql_count = "SELECT COUNT(*) AS num_data " . $sql;

		$a_count = Yii::app()->db->createCommand($sql_count)->queryAll();
		$num_data = $a_count[0]["num_data"];
		$result['num_page'] = intval($num_data / $data_per_page);
		if (($num_data % $data_per_page) > 0) {
			$result['num_page']++;
		}

		$result['num_data'] = $num_data;

		$sql_select = "SELECT tbl_quote_item.*,tbl_quote_doc.*,user.fullname " . $sql . $s_order_by . $s_limit;
		$result['quote_item'] = Yii::app()->db->createCommand($sql_select)->queryAll();

		$result['page_title'] = "Commission Report";
		$result['desc_show'] = $desc_show;
		$result['have_inv_show'] = $have_inv_show;

		$sql_user = "SELECT id,fullname,user_group_id FROM user WHERE enable=1 AND user_group_id<>99 ORDER BY user_group_id ASC,fullname ASC";
		$result['a_user'] = Yii::app()->db->createCommand($sql_user)->queryAll();

		//echo $sql_select;

		$this->render('report', $result);
	}

	public function actionCommReportXLS()
	{

		$desc_show = "yes";
		if (isset($_POST["with_desc"]) && ($_POST["with_desc"] != "")) {
			$desc_show = $_POST["with_desc"];
		}

		$y_select = "";
		$m_select = "";
		$u_select = "";
		$extra_condition = "";
		if (isset($_POST["y_select"]) && ($_POST["y_select"] != "")) {
			$y_select = intval($_POST["y_select"]);
			if ($y_select == "0") {
				$extra_condition .= "%";
			} else {
				$extra_condition .= $y_select;
			}
			$extra_condition .= "-";
		}

		if (isset($_POST["m_select"]) && ($_POST["m_select"] != "")) {
			$m_select = intval($_POST["m_select"]);
			if ($m_select == "0") {
				$extra_condition .= "%";
			} else {

				$extra_condition .= ((intval($m_select) > 9) ? $m_select : "0" . $m_select) . "-%";
			}
		}

		if ($extra_condition != "") {
			$extra_condition = " AND tbl_quote_doc.est_date LIKE '" . $extra_condition . "' ";
		}

		if (isset($_POST["u_select"]) && ($_POST["u_select"] != "")) {
			$u_select = intval($_POST["u_select"]);

			if ($u_select != "0") {
				$extra_condition .= " AND tbl_quote_doc.user_id='" . $u_select . "' ";
			}
		}

		if (isset($_POST["with_have_inv"]) && ($_POST["with_have_inv"] != "")) {
			if ($_POST["with_have_inv"] == "yes") {
				$extra_condition .= " AND tbl_quote_doc.inv_no<>'' AND tbl_quote_doc.inv_no IS NOT NULL ";
			}
		}

		$s_value = "";
		if (isset($_POST["s_value"]) && ($_POST["s_value"] != "")) {
			$s_value = $_POST["s_value"];

			if ($s_value != "") {
				$s_value = addslashes($s_value);
				$extra_condition .= " AND (tbl_quote_doc.est_number LIKE '%" . $s_value . "%' OR tbl_quote_doc.inv_no LIKE '%" . $s_value . "%' OR tbl_quote_doc.cust_name LIKE '%" . $s_value . "%') ";
			}
		}

		$sql = " FROM tbl_quote_item LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=tbl_quote_item.qdoc_id LEFT JOIN user ON tbl_quote_doc.user_id=user.id WHERE tbl_quote_doc.enable=1 AND tbl_quote_item.enable=1 ";
		$sql .= " AND ( tbl_quote_doc.archive='1' OR tbl_quote_doc.approve_status='approve' ) " . $extra_condition;

		$s_order_by = " ORDER BY tbl_quote_doc.is_duplicate DESC, tbl_quote_doc.add_date DESC,tbl_quote_item.sort ASC ";

		$sql_select = "SELECT tbl_quote_item.*,tbl_quote_doc.*,user.fullname " . $sql . $s_order_by;
		$result['quote_item'] = Yii::app()->db->createCommand($sql_select)->queryAll();

		$result['desc_show'] = $desc_show;

		$this->renderPartial('report_xls', $result);
	}

	public function actionEditPONumber()
	{

		$qdoc_id = $_POST["qdoc_id"];
		$po_number = base64_decode($_POST["po_number"]);

		$sql_update = "UPDATE tbl_quote_doc SET po_number='" . addslashes($po_number) . "' WHERE qdoc_id='" . $qdoc_id . "'; ";
		if (Yii::app()->db->createCommand($sql_update)->execute()) {
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to save PO Number.";
		}

		echo json_encode($a_result);
	}

	/*public function actionTest(){
		$sql = "SELECT 'hockey_line' AS product,style AS item,discription AS desc_show,id FROM hockey_line UNION SELECT 'hoodies' AS product,category AS item,CONCAT(discription,' ',style,' ',notes) AS desc_show,id FROM hoodies UNION SELECT 'tracksuits' AS product,category AS item,CONCAT(discription,' ',style,' ',notes) AS desc_show,id FROM tracksuits UNION SELECT 'polo' AS product,category AS item,CONCAT(fabric_options,' ',style,' ',notes) AS desc_show,id FROM polo UNION SELECT 'tshirts' AS product,category AS item,CONCAT(fabric_options,' ',style,' ',notes) AS desc_show,id FROM tshirts UNION SELECT 'volleyball' AS product,category AS item,notes AS desc_show,id FROM volleyball UNION SELECT 'basketball' AS product,category AS item,notes AS desc_show,id FROM basketball UNION SELECT 'baseball' AS product,category AS item,notes AS desc_show,id FROM baseball UNION SELECT 'soccer' AS product,category AS item,notes AS desc_show,id FROM soccer";

		$a_test = Yii::app()->db->createCommand($sql)->queryAll();

		echo '<table><tr><th>Type</th><th>Product</th><th>Description</th><th>ID</th></tr>';

		foreach($a_test as $key => $val){
			echo '<tr>';
			echo '<td>'.$val["product"].'</td>';
			echo '<td>'.$val["item"].'</td>';
			echo '<td>'.$val["desc_show"].'</td>';
			echo '<td>'.$val["id"].'</td>';
			echo '</tr>';
		}

		echo '</table>';
	}*/

	public function actionUpdateSort()
	{

		$sql_select = "SELECT * FROM tbl_quote_item WHERE enable=1 ORDER BY qdoc_id ASC,qdoci_id ASC";

		$a_data = Yii::app()->db->createCommand($sql_select)->queryAll();

		$qdoc_id = "";
		$n_sort = 0;

		for ($i = 0; $i < sizeof($a_data); $i++) {

			if ($qdoc_id != $a_data[$i]["qdoc_id"]) {
				$n_sort = 1;
				$qdoc_id = $a_data[$i]["qdoc_id"];
			}

			$sql_update = "UPDATE tbl_quote_item SET sort='" . $n_sort . "' WHERE qdoci_id='" . $a_data[$i]["qdoci_id"] . "';";

			Yii::app()->db->createCommand($sql_update)->execute();

			$n_sort++;
		}
	}

	public function actionEditCommAfterApprove()
	{

		$new_comm = $_POST["new_comm"];
		$qdoci_id = $_POST["qdoci_id"];
		$qdoc_id = $_POST["qdoc_id"];
		$old_comm = $_POST["comm_percent"];

		$sql_update = "UPDATE tbl_quote_item SET comm_percent='" . $new_comm . "' WHERE qdoci_id='" . $qdoci_id . "';";

		if (Yii::app()->db->createCommand($sql_update)->execute()) {

			$sql_select = "SELECT * FROM tbl_quote_item WHERE qdoci_id='" . $qdoci_id . "';";
			$a_data = Yii::app()->db->createCommand($sql_select)->queryAll();
			$pro_name = $a_data[0]["pro_name"];

			$append_comment = "<br>" . $pro_name . " update commission percent from " . $old_comm . " to " . $new_comm;

			$sql_update2 = "UPDATE tbl_quote_doc SET approval_comment=CONCAT(approval_comment,'" . $append_comment . "') WHERE qdoc_id='" . $qdoc_id . "';";
			Yii::app()->db->createCommand($sql_update2)->execute();

			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to update Commission percent.";
		}

		echo json_encode($a_result);
	}

	public function actionEditUPriceAfterApprove()
	{

		$old_uprice = $_POST["uprice"];
		$new_uprice = $_POST["new_uprice"];
		$qdoci_id = $_POST["qdoci_id"];
		$qdoc_id = $_POST["qdoc_id"];

		$sql_update = "UPDATE tbl_quote_item SET uprice='" . $new_uprice . "',uprice_ori='" . $new_uprice . "',addi_id_list=NULL WHERE qdoci_id='" . $qdoci_id . "';";
		Yii::app()->db->createCommand($sql_update)->execute();

		$sql_select = "SELECT * FROM tbl_quote_item WHERE enable=1 AND qdoc_id='" . $qdoc_id . "';";
		$a_data = Yii::app()->db->createCommand($sql_select)->queryAll();

		$update_pro_name = "";
		$sub_total = 0.0;
		for ($i = 0; $i < sizeof($a_data); $i++) {
			$sub_total += (floatval($a_data[$i]["qty"]) * floatval($a_data[$i]["uprice"]));
			if ($a_data[$i]["qdoci_id"] == $qdoci_id) {
				$update_pro_name = $a_data[$i]["pro_name"];
			}
		}

		$grand_total = 0.0;
		$sql_select2 = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $qdoc_id . "';";
		$a_select = Yii::app()->db->createCommand($sql_select2)->queryAll();
		$inc_vat = $a_select[0]["inc_vat"];
		if ($inc_vat == "yes") {
			$grand_total = $sub_total * 1.07;
		} else {
			$grand_total = $sub_total;
		}

		$append_comment = "<br>" . $update_pro_name . " update price from " . $old_uprice . " to " . $new_uprice;

		$sql_update2 = "UPDATE tbl_quote_doc SET sub_total='" . $sub_total . "',grand_total='" . $grand_total . "',approval_comment=CONCAT(approval_comment,'" . $append_comment . "') WHERE qdoc_id='" . $qdoc_id . "';";
		if (Yii::app()->db->createCommand($sql_update2)->execute()) {
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to update Price.";
		}

		echo json_encode($a_result);
	}

	public function actionUpdateUserByAdmin()
	{

		$qdoc_id = $_POST["qdoc_id"];
		$user_id = $_POST["user_id"];

		$sql_update = "UPDATE tbl_quote_doc SET user_id='" . $user_id . "' WHERE qdoc_id='" . $qdoc_id . "';";
		if (Yii::app()->db->createCommand($sql_update)->execute()) {
			$a_result["result"] = "success";
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Fail to update User.";
		}

		echo json_encode($a_result);
	}

	public function actionfetchOrderNum()
{
    $qdoc_id = $_POST['qdoc_id'];
    $salesrep_id = $_POST['salesrep_id'];
    $post = [
        'qdoc_id' => $qdoc_id,
        'salesrep_id' => $salesrep_id,
    ];

    $ch = curl_init('https://locker.jog-joinourgame.com/salesrep_api/fetch_order_num.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    // Execute the request
    $response = curl_exec($ch);

    // Close the connection, release resources used
    curl_close($ch);

    // Decode the JSON response
    $responseData = json_decode($response, true);

    // Check if salesrep_name is blank and set it to 'Ravish' if it is
    if (empty($responseData['salesrep_name'])) {
        $userName = Yii::app()->user->getState('userName');
        $responseData['salesrep_name'] = $userName;
    }

    // Encode the modified response back to JSON
    $modifiedResponse = json_encode($responseData);

    // Echo the modified response
    echo $modifiedResponse;
}

}
