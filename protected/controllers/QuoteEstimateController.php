<?php



class QuoteEstimateController extends AuthController

{	



	public function actionIndex()

	{

	    $user_group = Yii::app()->user->getState('userGroup');

	    $user_id = Yii::app()->user->getState('userKey');

	    $year_date = date("Y");

	    $year_month = date("m");

	    if(isset($_POST['year_date'])){

	        $year_date = $_POST['year_date'];

	        $year_month = $_POST['year_month'];

	    }

	    if ($user_group == "99" || $user_group == "1") {

    $sql = "SELECT * FROM quotation_data LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=quotation_data.qdoci_id LEFT JOIN user ON user.id=quotation_data.conv_by_id WHERE monthname(`conv_date`) = MONTHNAME(STR_TO_DATE($year_month, '%m')) AND YEAR(`conv_date`) = '$year_date' AND is_deleted='0'";



    $conditions = array();



    if (isset($_POST['invoice_nos'])) {

        $conditions[] = "(`inv_no`='' OR `inv_no` IS NULL)";

        $data['checked_invoice'] = 1;

    }



    if (isset($_POST['collegiate_only'])) {

        $conditions[] = "collegiate='1'";

        $data['checked_collegiate_only'] = 1;

        $data['college_print'] = 1;

    }



    if (isset($_POST['credit_net_30'])) {

        $conditions[] = "credit_net_30='1'";

        $data['checked_credit_net_30'] = 1;

    }



    if (isset($_POST['full_payment_b4_ship'])) {

        $conditions[] = "full_payment_b4_ship='1'";

        $data['checked_full_payment_b4_ship'] = 1;

    }



    if (isset($_POST['50_down_payment'])) {

        $conditions[] = "50_down_payment='1'";

        $data['checked_50_down_payment'] = 1;

    }



    if (isset($_POST['credit_card_3'])) {

        $conditions[] = "credit_card_3='1'";

        $data['checked_credit_card_3'] = 1;

    }

	if (isset($_POST['ACH_1_Fee'])) {

        $conditions[] = "ACH_1_Fee='1'";

        $data['ACH_1_Fee'] = 1;

    }

	if (isset($_POST['shipment_status'])) {

        $conditions[] = "shipment_status='1'";

        $data['shipment_status'] = 1;

    }
    // Add more conditions as needed...



    // Check if there are multiple conditions, then use OR instead of AND

    $operator = (count($conditions) > 1) ? 'AND' : 'AND';



    if (!empty($conditions)) {

        $sql .= " AND (" . implode(" $operator ", $conditions) . ")";

    }



    $sql .= " ORDER BY quotation_data.created_date DESC";

}



	    else{

	        $sql = "SELECT * from quotation_data LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=quotation_data.qdoci_id LEFT JOIN user ON user.id=quotation_data.conv_by_id WHERE monthname(`conv_date`)=MONTHNAME(STR_TO_DATE($year_month, '%m')) AND YEAR(`conv_date`)='$year_date' AND (conv_by_id='$user_id' OR original_sales_id='$user_id' OR conv_by_id='68' OR original_sales_id='68') AND is_deleted='0' AND archive_status='0' ORDER BY quotation_data.created_date DESC";

	    }

	    

	    if($user_id==34){

	        $sql = "SELECT * from quotation_data LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=quotation_data.qdoci_id LEFT JOIN user ON user.id=quotation_data.conv_by_id WHERE monthname(`conv_date`)=MONTHNAME(STR_TO_DATE($year_month, '%m')) AND YEAR(`conv_date`)='$year_date' AND (conv_by_id='$user_id' OR original_sales_id='$user_id' OR conv_by_id='27' OR original_sales_id='27' OR conv_by_id='68' OR original_sales_id='68') AND is_deleted='0' AND archive_status='0' ORDER BY quotation_data.created_date DESC";

	    }

	    $data['quotes'] = Yii::app()->db->createCommand($sql)->queryAll();

	    $data['year'] = $year_date;

	    $data['month'] = $year_month;

		/*$result['model'] = new Upload;

		$result['files'] = Upload::model()->findAll();*/

		$this->render('index',$data);

	}

	

	public function actionFetchWaveIncome(){

	    $sql = "SELECT * FROM wave_products WHERE income_account='0'";

	    $query = Yii::app()->db->createCommand($sql)->queryAll();

	    $counter = count($query);

	    foreach($query as $main){

	        $prod_id = $main['prod_id'];

	        echo $product_id = $main['product_id'];

	        echo "<br>";

	    }

	    echo "completed";

	}

	

	public function createProductWave($name,$description,$unit_price){

	    // Define the GraphQL query and variables

$query = 'mutation ($input: ProductCreateInput!) {

  productCreate(input: $input) {

    didSucceed

    inputErrors {

      code

      message

      path

    }

    product {

      id

      name

      description

      unitPrice

      incomeAccount {

        id

        name

      }

      expenseAccount {

        id

        name

      }

      isSold

      isBought

      isArchived

      createdAt

      modifiedAt

    }

  }

}';



$variables = '{

  "input": ' . json_encode([

    "businessId" => "QnVzaW5lc3M6Yjg5MTk2NTUtNThjMy00NjRkLWE3MjktYzFlNWFjMjQ0MGFk",

    "name" => $name,

    "description" => $description,

    "unitPrice" => $unit_price,

    "incomeAccountId" => "QWNjb3VudDoxODY3MzE0NDg5OTA5NjQwMTk5O0J1c2luZXNzOmI4OTE5NjU1LTU4YzMtNDY0ZC1hNzI5LWMxZTVhYzI0NDBhZA=="

  ]) . '

}';



// Define the Bearer token

$token = 'H22MI2sFoGZM7zpg0dwtuZaLhanblu';



// Define the GraphQL API URL

$url = 'https://gql.waveapps.com/graphql/public';



// Create cURL request

$ch = curl_init($url);



// Set cURL options

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(

    'query' => $query,

    'variables' => json_decode($variables),

)));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(

    'Content-Type: application/json',

    'Authorization: Bearer ' . $token,

));



// Execute cURL request

$response = curl_exec($ch);



// Check for cURL errors

if (curl_errno($ch)) {

    echo 'cURL error: ' . curl_error($ch);

}



// Close cURL session

curl_close($ch);



// Output the response

return $response;

	}

	

	public function UpdateWaveProduct($inputId,$inputDescription,$inputUnitPrice){



// Base URL and Bearer Token

$baseUrl = "https://gql.waveapps.com/graphql/public";

$bearerToken = "H22MI2sFoGZM7zpg0dwtuZaLhanblu"; // Replace with your actual bearer token



// GraphQL query and variables

    $query = <<<GRAPHQL

mutation ProductPatch(\$input: ProductPatchInput!) {

    productPatch(input: \$input) {

        didSucceed

        product {

            id

            name

            description

            unitPrice

        }

        inputErrors {

            message

            path

            code

        }

    }

}

GRAPHQL;



    $variables = [

        'input' => [

            'id' => $inputId, // Replace with the actual product ID

            'description' => $inputDescription, // Corrected variable name

            'unitPrice' => $inputUnitPrice // Corrected variable name

        ]

    ];



    // Create a cURL request

    $ch = curl_init($baseUrl);

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['query' => $query, 'variables' => $variables]));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [

        'Content-Type: application/json',

        'Authorization: Bearer ' . $bearerToken

    ]);



    // Execute the cURL request

    $response = curl_exec($ch);

    // Close cURL session

    curl_close($ch);



    return $response;



	}

	

	public function actionCreateWaveInvoice(){

	    set_time_limit(300);

	    $customer_name = $_POST['wave_customer'];

	    $cust_id_wave = $_POST['cust_id_wave'];

	    $jog_code_wave = "JOG CODE: ".$_POST['jog_code_wave'];

	    $invoice_date_wave = $_POST['invoice_date_wave'];

	    $due_date_wave = $_POST['due_date_wave'];

	    $conv_id = $_POST['conv_id'];

	    $qdoc_id = $_POST['qdoc_id'];

	    $sql = "SELECT po_number FROM tbl_quote_doc WHERE qdoc_id='$qdoc_id'";

	    $a_quote = Yii::app()->db->createCommand($sql)->queryAll();

		$row_quote = $a_quote[0];

		$po_number = $row_quote["po_number"];

		

		$delete = "DELETE FROM wave_temp_table WHERE conv_id='$conv_id'";

        Yii::app()->db->createCommand($delete)->execute();

        

		$sql_2 = "SELECT pro_name as name,pro_desc as description,qty,uprice as unitPrice FROM tbl_quote_item WHERE qdoc_id = '$qdoc_id'";

		$main_sql = Yii::app()->db->createCommand($sql_2)->queryAll();

		foreach($main_sql as $data){

		    $name = $data['name'];

		    $description = $data['description'];

		    $qty = $data['qty'];

		    $unitPrice = $data['unitPrice'];

            if (stripos($name, "shipping") !== false) {

                $inputId = "QnVzaW5lc3M6Yjg5MTk2NTUtNThjMy00NjRkLWE3MjktYzFlNWFjMjQ0MGFkO1Byb2R1Y3Q6NDQyNTEwNg==";

                $inputDescription = "Flat Rate Shipping Fee";

                $inputUnitPrice = $unitPrice;

                $ship_update = $this->UpdateWaveProduct($inputId,$inputDescription,$inputUnitPrice);

                $prod_id = $inputId;

            } else {

                $name = rtrim($name);

                $name = addslashes($name);

                $sql = "SELECT * FROM wave_products WHERE prod_name LIKE '%$name%' LIMIT 1";

                $main_sql = Yii::app()->db->createCommand($sql)->queryAll();

                if(count($main_sql)>0){

                    $prod_id = $main_sql[0]['product_id'];

                    $prod_update = $this->UpdateWaveProduct($prod_id,$description,$unitPrice);

                }

                else{

                    $create_product = $this->createProductWave($name,$description,$unitPrice);

                    $wave_data = json_decode($create_product,true);

                    $didSucceed = $wave_data['data']['productCreate']['didSucceed'];

                    if($didSucceed==1){

                        $prod_id = $wave_data['data']['productCreate']['product']['id'];

                        $name = addslashes($name);

                        $description = addslashes($description);

                        $ins_sql = "INSERT INTO `wave_products`(`product_id`, `prod_name`, `unit_price`) VALUES ('$prod_id','$name','$unitPrice')";

                        Yii::app()->db->createCommand($ins_sql)->execute();

                    }

                }

            }

            $sql_temp = "INSERT INTO `wave_temp_table`(`conv_id`, `product_id`, `qty`) VALUES ('$conv_id','$prod_id','$qty')";

            Yii::app()->db->createCommand($sql_temp)->execute();

		}

             

 	  

 	  $fetch_sql = "SELECT * FROM wave_temp_table WHERE conv_id='$conv_id' ORDER BY created_date DESC";

 	  $main_sql = Yii::app()->db->createCommand($fetch_sql)->queryAll();

 	  $graphqlVariables = [];



        // Iterate through the $main_sql array to build the GraphQL items array

        $items = [];

 	  foreach ($main_sql as $row) {

            $items[] = [

                "productId" => $row['product_id'],

                "quantity" => $row['qty'],

            ];

        }

        

    // Build the GraphQL variables array

$graphqlVariables['input'] = [

    "businessId" => "QnVzaW5lc3M6Yjg5MTk2NTUtNThjMy00NjRkLWE3MjktYzFlNWFjMjQ0MGFk",

    "customerId" => $cust_id_wave,

    "items" => $items,

    "poNumber" => $po_number,

    "invoiceDate" => $invoice_date_wave,

    "dueDate" => $due_date_wave,

    "subhead" => $jog_code_wave,

];



// Your GraphQL query

$query = 'mutation ($input: InvoiceCreateInput!) { invoiceCreate(input: $input) { didSucceed inputErrors { message code path } invoice { id createdAt modifiedAt pdfUrl viewUrl status title subhead invoiceNumber invoiceDate poNumber customer { id name } currency { code } dueDate amountDue { value currency { symbol } } amountPaid { value currency { symbol } } taxTotal { value currency { symbol } } total { value currency { symbol } } exchangeRate footer memo disableCreditCardPayments disableBankPayments itemTitle unitTitle priceTitle amountTitle hideName hideDescription hideUnit hidePrice hideAmount items { product { id name } description quantity price subtotal { value currency { symbol } } total { value currency { symbol } } account { id name subtype { name value } } taxes { amount { value } salesTax { id name } } } lastSentAt lastSentVia lastViewedAt } } }';



        // Convert the array to a JSON string for GraphQL variable

        $graphqlVariablesJson = json_encode(['variables' => $graphqlVariables, 'query' => $query]);

        

        // Your GraphQL endpoint and bearer token

        $graphqlEndpoint = "https://gql.waveapps.com/graphql/public";

        $bearerToken = "H22MI2sFoGZM7zpg0dwtuZaLhanblu"; // Replace with your actual bearer token

        

        // Initialize cURL session

        $ch = curl_init();

        

        // Set cURL options

        curl_setopt($ch, CURLOPT_URL, $graphqlEndpoint);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $graphqlVariablesJson);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [

            'Content-Type: application/json',

            'Authorization: Bearer ' . $bearerToken,

        ]);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        

        // Execute cURL session and get the response

        $response = curl_exec($ch);

        

        // Check for errors

        if (curl_errno($ch)) {

            echo 'Error: ' . curl_error($ch);

        }

        

        // Close cURL session

        curl_close($ch);

        

        // Output the GraphQL response

        $final_data = json_decode($response,true);

        $didSucceedInvoice = $final_data['data']['invoiceCreate']['didSucceed'];

        if($didSucceedInvoice==1){

            $viewUrl = $final_data['data']['invoiceCreate']['invoice']['viewUrl'];

            $inv_no = $final_data['data']['invoiceCreate']['invoice']['invoiceNumber'];

            $sql_ins = "INSERT INTO wave_inv_table (conv_id, product_id, qty, invoice_num) SELECT '$conv_id', product_id, qty, '$inv_no' FROM wave_temp_table WHERE conv_id = '$conv_id'";

            Yii::app()->db->createCommand($sql_ins)->execute();

            

            $delete = "DELETE FROM wave_temp_table WHERE conv_id='$conv_id'";

            Yii::app()->db->createCommand($delete)->execute();

            

            die(json_encode(array('status'=>1,'viewUrl'=>$viewUrl,'inv'=>$inv_no)));

        }

        else{

            $delete = "DELETE FROM wave_temp_table WHERE conv_id='$conv_id'";

            Yii::app()->db->createCommand($delete)->execute();

            die(json_encode(array('status'=>0)));

        }



	}

	

	public function actionFetchWaveCusData(){

	    $wave_id = $_POST['wave_id'];



// Set your GraphQL query, variables, and endpoint URL

$query = 'query ($businessId: ID!, $customerId: ID!) {

  business(id: $businessId) {

    id

    customer(id: $customerId) {

      id

      name

      firstName

      lastName

      email

      mobile

      phone

      fax

      tollFree

      website

      address {

        addressLine1

        addressLine2

        city

        province {

          code

          name

        }

        country {

          code

          name

        }

        postalCode

      }

      shippingDetails {

        name

        phone

        instructions

        address {

          addressLine1

          addressLine2

          city

          province {

            code

            name

          }

          country {

            code

            name

          }

          postalCode

        }

      }

      currency {

        code

        name

        symbol

      }

      createdAt

      modifiedAt

      overdueAmount {

        raw

        value

      }

      outstandingAmount {

        raw

        value

      }

    }

  }

}';



$variables = [

    "businessId" => "QnVzaW5lc3M6Yjg5MTk2NTUtNThjMy00NjRkLWE3MjktYzFlNWFjMjQ0MGFk",

    "customerId" => $wave_id

];



$baseUrl = 'https://gql.waveapps.com/graphql/public';

$bearerToken = 'H22MI2sFoGZM7zpg0dwtuZaLhanblu'; // Replace with your actual bearer token



// Create cURL handle

$ch = curl_init($baseUrl);



// Set cURL options

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([

    'query' => $query,

    'variables' => $variables,

]));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, [

    'Content-Type: application/json',

    'Authorization: Bearer ' . $bearerToken,

]);



// Execute cURL request and get the response

$response = curl_exec($ch);



// Check for cURL errors

if (curl_errno($ch)) {

    echo 'cURL error: ' . curl_error($ch);

} else {

    // Output the response data

    echo $response;

}



// Close cURL handle

curl_close($ch);





	}

	

	public function actionSearchWaveCustomers(){

	    $searchTerm  = addslashes($_POST['searchTerm']);

	    $sql = "SELECT cust_name as name,wave_id as id FROM wave_customers WHERE cust_name LIKE '%$searchTerm%' ";

	    $data = Yii::app()->db->createCommand($sql)->queryAll();

	    die(json_encode($data));

	}

	

	public function actionRefreshWaveCustomers(){

	    $del_sql = "DELETE FROM wave_customers";

	    Yii::app()->db->createCommand($del_sql)->execute();

        $graphqlEndpoint = 'https://gql.waveapps.com/graphql/public';

        $bearerToken = 'H22MI2sFoGZM7zpg0dwtuZaLhanblu'; // Replace with your actual bearer token





$query = <<<GRAPHQL

{

  business(id: "QnVzaW5lc3M6Yjg5MTk2NTUtNThjMy00NjRkLWE3MjktYzFlNWFjMjQ0MGFk") {

    id

    customers(page: PAGE_NUMBER, pageSize: 100, sort: [NAME_ASC]) {

      pageInfo {

        currentPage

        totalPages

        totalCount

      }

      edges {

        node {

          id

          name

          email

        }

      }

    }

  }

}

GRAPHQL;



        $headers = [

            'Content-Type: application/json',

            'Authorization: Bearer ' . $bearerToken,

        ];

        

        $pageNumber = 1;

        $hasMorePages = true;

        

        while ($hasMorePages) {

            $queryWithPage = str_replace('PAGE_NUMBER', $pageNumber, $query);

        

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $graphqlEndpoint);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($ch, CURLOPT_POST, 1);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['query' => $queryWithPage]));

        

            $response = curl_exec($ch);

            curl_close($ch);

        

            $data = json_decode($response, true);

        

            if (isset($data['data']['business']['customers']['edges'])) {

                $customers = $data['data']['business']['customers']['edges'];

        

                foreach ($customers as $customer) {

                    $id = $customer['node']['id'];

                    $name = addslashes($customer['node']['name']); // Escape single quotes

                    $email = addslashes($customer['node']['email']);

        

                    // Generate SQL query to insert data into the MySQL database table

                    $insertQuery = "INSERT INTO wave_customers (wave_id, cust_name, cust_email) VALUES ('$id', '$name', '$email');";

        

                    Yii::app()->db->createCommand($insertQuery)->execute();

                }

        

                // Check if there are more pages

                $hasMorePages = $pageNumber < $data['data']['business']['customers']['pageInfo']['totalPages'];

        

                $pageNumber++;

            } else {

                $hasMorePages = false;

            }

        }

	}

	

	public function actionfetchChats(){

		$conv_id = $_POST['conv_id'];

		$user_id = Yii::app()->user->getState('userKey');

		$string = "";

		$sql = "SELECT * FROM tbl_quotes_comments_admin WHERE conv_id='$conv_id' ORDER BY add_time ASC";

		$a_qitem = Yii::app()->db->createCommand($sql)->queryAll();

		if(count($a_qitem)==0){

			die(json_encode(array('status' => '0')));

		}

		else{

		    $style = "text-align:right";

		foreach( $a_qitem as $tmp_key => $row_qitem ){

				if ($row_qitem["user_id"]==$user_id) {

					$style = "text-align:right";

				}

				else{

					$style = "text-align:left";

				}

			    if($row_qitem["user_id"]=="28"){

        		    $full_name = "Administrator";

        		}

        		else{

        		    $full_name = "Scott Whitcomb";

        		}

				$string .= '<div><center><pre class="alert" style="'.$style.'; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;">'.$full_name.'@'.date("M d, Y H:i:s",strtotime($row_qitem["add_time"])).' comments "'.$row_qitem["message_long"].'"</pre></center></div>';

			}

			die(json_encode(array('status'=>'1','msg'=>base64_encode($string))));



		}



	}

	

	public function actionDuplicateQuote(){



		$qdoc_id = $_POST["qdoc_id"];

		$sql_dup_doc = "INSERT INTO tbl_quote_doc (user_id, comp_id, comp_name, comp_info, curr_id, quote_curr, payment_term, cust_id, cust_name, cust_info, est_number, est_date, exp_date, inc_vat, vat_value, num_item, sub_total, grand_total, sale_note, note, approve_status, approve_date, reject_time, is_temp, is_duplicate, archive, add_date, enable, dup_from,dup_from_id,duplicate_by)

            SELECT user_id, comp_id, comp_name, comp_info, curr_id, quote_curr, payment_term, cust_id, cust_name, cust_info, est_number, est_date, exp_date, inc_vat, vat_value, num_item, sub_total, grand_total, sale_note, note, approve_status, approve_date, reject_time, is_temp, 1, archive, add_date, enable, 2,'$qdoc_id','1'

            FROM tbl_quote_doc

            WHERE qdoc_id=" . $qdoc_id;



		Yii::app()->db->createCommand($sql_dup_doc)->execute();



		$new_qdoc_id = Yii::app()->db->getLastInsertID();

		

		$sql_new = "SELECT pro_type,pro_id,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,addi_desc,comm_percent,sort,add_date,enable FROM tbl_quote_item WHERE qdoc_id='".$qdoc_id."'";

		$data = Yii::app()->db->createCommand($sql_new)->queryAll();

		foreach($data as $entries){

		    $pro_type = addslashes($entries['pro_type']);

		    $pro_id = addslashes($entries['pro_id']);

		    $item_id = addslashes($entries['item_id']);

		    $pro_name = addslashes(rtrim($entries['pro_name']));

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

		    if($addi_id_list=="" || $addi_id_list==null){

		        $sql_add = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,pro_id,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,addi_desc,comm_percent,sort,add_date,enable) VALUES ('$new_qdoc_id','$pro_type','$pro_id','$item_id','$pro_name','$pro_desc','$qty','$qty_note','$uprice','$uprice_ori','$addi_id_list','$addi_desc','$comm_percent','$sort','$add_date','$enable')";

		        Yii::app()->db->createCommand($sql_add)->execute();

		    }

		    else{

		        //$uprice = $uprice_ori;

		        $sql_add = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,pro_id,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,addi_desc,comm_percent,sort,add_date,enable) VALUES ('$new_qdoc_id','$pro_type','$pro_id','$item_id','$pro_name','$pro_desc','$qty','$qty_note','$uprice','$uprice_ori','$addi_id_list','$addi_desc','$comm_percent','$sort','$add_date','$enable')";

		        Yii::app()->db->createCommand($sql_add)->execute();

		        

		    }

		}



		$a_result["result"] = "success";

		$a_result["new_qdoc_id"] = $new_qdoc_id;

		echo json_encode($a_result);



	}

	

	public function actionSearchList()

	{

		$user_group = Yii::app()->user->getState('userGroup');

		$user_id = Yii::app()->user->getState('userKey');

		$year_date = date("Y");

	    $year_month = date("m");

        if (trim($_POST["search"]) === "") {
            $this->redirect(Yii::app()->createAbsoluteUrl('/quoteEstimate'));
            return;
        }

		$more_condition = "";

		if( $user_group!="1" && $user_group!="99" ){

		

			$more_condition = " AND (conv_by_id='$user_id' OR original_sales_id='$user_id' OR conv_by_id='68' OR original_sales_id='68')";

		}

		

		if($user_id=="34"){

		    $more_condition = " AND (conv_by_id='$user_id' OR original_sales_id='$user_id' OR conv_by_id='27' OR original_sales_id='27' OR conv_by_id='68' OR original_sales_id='68')";

		}



		$result['search'] = "";

		if( isset($_REQUEST["search"]) && ($_REQUEST["search"]!="") ){



			$search_word = "";

			if(isset($_GET["search"])){

				$search_word = base64_decode($_GET["search"]);

			}else{

				$search_word = $_POST["search"];

			}

			$search_word = rtrim($search_word, 'Q');



			$more_condition .= "AND (

                                cust_name LIKE '%".addslashes($search_word)."%'

                                OR conv_by LIKE '%".addslashes($search_word)."%'

                                OR jog_code LIKE '%".addslashes($search_word)."%'

                                OR EXISTS (

                                  SELECT 1

                                  FROM tbl_quote_doc AS doc

                                  WHERE doc.est_number LIKE '%".addslashes($search_word)."%'

                                    AND doc.qdoc_id = quotation_data.qdoci_id

                                )

                              );";

			$result['search'] = $search_word;

		}

		

		//$sql = "SELECT * from quotation_data LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=quotation_data.qdoci_id LEFT JOIN user ON user.id=quotation_data.conv_by_id WHERE is_deleted='0' ".$more_condition."";

		$sql = "SELECT *

        FROM quotation_data

        LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id = quotation_data.qdoci_id

        LEFT JOIN user ON user.id = quotation_data.conv_by_id

        WHERE is_deleted = '0' ".$more_condition."";

		$data['quotes'] = Yii::app()->db->createCommand($sql)->queryAll();



		$data['year'] = $year_date;

	    $data['month'] = $year_month;



		$this->render('search',$data);

	}

	

	

	

	public function actionCreatePDF($qdoc_id,$jog_code_main){

	    include_once(Yii::app()->getBasePath()."/vendors/mpdf/mpdf.php");



	    $mpdf=new mPDF('c');

	    $qdoc_id = $qdoc_id;//$_POST["qdoc_id"];

        $jog_code_main = $jog_code_main;//$_POST['jog_code_main'];

		$sql_quote = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='".$qdoc_id."'; ";

		$a_quote = Yii::app()->db->createCommand($sql_quote)->queryAll();

		$row_quote = $a_quote[0];

		$comp_id = $row_quote["comp_id"];



		$action_from = 'vp';//$_POST["action_from"];



		$approve_status = $row_quote["approve_status"];



		$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='".$row_quote["curr_id"]."'; ";

		$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

		$row_curr = $a_curr[0];

		$pre_cost = $row_curr["curr_symbol"];

		

		$cur_sql = "SELECT * FROM tbl_currency";

    	$curr_query = Yii::app()->db->createCommand($cur_sql)->queryAll();

    	$select_html = '<select style="width:50px;" id="viewQuotationNewFinal" qdoc_id="'.$qdoc_id.'" action_from="'.$action_from.'")">';

		foreach($curr_query as $fetched){

		    $curr_select="";

		    if($fetched['curr_id']==$row_quote["curr_id"]){

		        $curr_select = "selected";

		    }

		    $select_html .="<option curr_symbol=".$fetched['curr_name']." value=".$fetched['curr_id']." $curr_select >".$fetched["curr_name"]." ".$fetched["curr_desc"]."</option>";

		}

		$select_html .='</select>';



		$sql_comp = "SELECT tbl_comp_info.comp_logo,tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.comp_id='".$comp_id."'; ";

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



		if($comp_logo!=""){

		    //$return_html .= '<img style="max-height: 180px; max-width: 180px;" src="https://'.$_SERVER['SERVER_NAME'].'/salesrep/images/'.$comp_logo.'" >';

		    $return_html .= '<img style="max-height: 180px; max-width: 180px;" src="'.Yii::app()->request->baseUrl.'/images/'.$comp_logo.'" >';

		}



	    

	    $return_html .= '</td>';

	    $return_html .= '<td style="width:50%; text-align:right;">';

	    $old_curr_id = $row_quote["curr_id"];

	    $return_html .= '<input type="hidden" value="'.$row_quote["curr_id"].'" id="old_curr_id">';

	    

	    $return_html .= '<input type="hidden" name="curr_id" value="'.$row_curr["curr_id"].'">';

	    $return_html .= '<input type="hidden" name="quote_curr" value="'.$row_curr["curr_name"].'">';

	    

	    $return_html .= '<h1 style="color:#000;">QUOTATION</h1>';

	    $return_html .= 'Payment Terms: ';



	    if($action_from=="va"){

		    $return_html .= '<select name="payment_term" id="edit_payment_term">';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Net 15")?"selected":"").' value="Net 15">Net 15</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Net 30")?"selected":"").' value="Net 30">Net 30</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Payment Due at Order Confirmation")?"selected":"").' value="Payment Due at Order Confirmation">Payment Due at Order Confirmation</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="50% Due At Order Confirmation. Balance Due At Delivery")?"selected":"").' value="50% Due At Order Confirmation. Balance Due At Delivery">50% Due At Order Confirmation. Balance Due At Delivery</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Balance Due before Ship Date")?"selected":"").' value="Balance Due before Ship Date">Balance Due before Ship Date</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="50% Down Payment. Balance Due Net 15")?"selected":"").' value="50% Down Payment. Balance Due Net 15">50% Down Payment. Balance Due Net 15</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="50% Down Payment. Balance Due at Delivery")?"selected":"").' value="50% Down Payment. Balance Due at Delivery">50% Down Payment. Balance Due at Delivery</option>';

	        $return_html .= '</select>';

	    }else{

	    	$return_html .= $row_quote["payment_term"];

	    }



	    $return_html .= '<pre style="width:100%;" id="pre_comp_info_app"><b>'.$row_quote["comp_name"].'</b><br>'.$row_quote["comp_info"].'</pre>';

	    $return_html .= '</td></tr><tr style="height:5px;"><td colspan="2"><hr></td></tr>';

		$return_html .= '<tr>';

		$return_html .= '<td style="text-align:left; padding:20px 0px;">';

		if($action_from=="va"){

		$return_html .= '<select id="cust_selector" name="cust_selector" onchange="return changeCustomerV2();"><option value="">=Select Customer=</option>';

		$user_group = Yii::app()->user->getState('userGroup');

		$user_id = Yii::app()->user->getState('userKey');



		$more_condition = "";

		if( $user_group!="1" && $user_group!="99" ){

		

			$more_condition = " AND user_id='".$user_id."' ";

		}

		$sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 ".$more_condition." ORDER BY cust_name ASC; ";

		$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();

		$custom_selector = "";

		foreach($a_cust as $tmp_key => $row_cust){

		    if($row_quote['cust_id']==$row_cust['cust_id']){

		        $custom_selector = "selected";

		    }

			$return_html .= '<option '.$custom_selector.' value="'.$row_cust["cust_id"].'">'.$row_cust["cust_name"].'</option>';

			$custom_selector = "";

		}

		$return_html .= '</select><pre id="pr_show_cust_info"></pre>';

		}

		$return_html .= '<div class="bill_to">BILL TO<br>'.$row_quote["cust_name"];

		$return_html .= '<pre>'.$row_quote["cust_info"].'</pre></div>';

		$return_html .= '</td>';

		$return_html .= '<td>';

		$return_html .= '<table   style="border-collapse: separate; border-spacing: 10px; color:#000;">';

		$return_html .= '<tr><th width="50%" style="text-align:right;">Quotation Number: </th><td style="color:#00F; text-align:left;" id="qdoc_number">'.$row_quote["est_number"].'Q</td></tr>';

		//$return_html .= '<tr>';

		$return_html .= '<tr><th width="50%" style="text-align:right;">JOG Code: </th><td>'.$jog_code_main.'</td></tr>';

		$return_html .= '<tr>';

		$return_html .= '<th style="text-align:right;">PO Number: </th>';

		$return_html .= '<td style="text-align:left;" id="po_number">';

		$return_html .= '<span id="sp_po_number'.$qdoc_id.'">'.$row_quote["po_number"].'</span> <i class="fa fa-pencil" style="cursor:pointer; font-size:16px; color:#00F;" onclick="return editPONumber('.$qdoc_id.');"></i>';

		$return_html .= '</td>';

		$return_html .= '</tr>';

		$return_html .= '<tr><th style="text-align:right;">Estimate Date: </th><td style="text-align:left;" id="show_est_date">'.date("F d, Y",strtotime($row_quote["est_date"])).'</td></tr>';

		$return_html .= '<tr><th style="text-align:right;">Expires On: </th><td style="text-align:left;" id="show_exp_date">'.date("F d, Y",strtotime($row_quote["exp_date"])).'</td></tr>';

		$return_html .= '<tr><th style="text-align:right;">Grand Total ('.$row_quote["quote_curr"].'): </th><td style="text-align:left;" id="td_grand_total_app">'.$pre_cost.number_format($row_quote["grand_total"],2).'</td></tr>';

		$return_html .= '</table>';

		$return_html .= '<input type="hidden" name="qdoc_id" id="qdoc_id" value="'.$qdoc_id.'">';

		$return_html .= '</td></tr>';

		$return_html .= '<tr><td colspan="2">';

		$return_html .= '<table style="color:#000; width:100%;" id="product_list">';

		$return_html .= '<tr style="font-size: 15px;"><th style="text-align:left;">Product</th>';



		if($action_from=="vc" || $action_from=="va"){

			$return_html .= '<th style="text-align:center; color:#999;">Comm.%</th><th style="text-align:center; color:#999;">Comm.</th>';

			$return_html .= '<th style="text-align:center; width:80px;">Quantity</th><th style="text-align:center; width:80px;">Price</th><th style="text-align:right; width:80px;">Amount</th><th style="text-align:right; width:10%"></th></tr>';

		}else{

			$return_html .= '<th style="text-align:center;">Quantity</th><th style="text-align:right; width:140px;">Price</th><th style="text-align:right; width:140px;">Amount</th></tr>';

		}

		$shipping = 0.0;

		$sql_qitem = "SELECT * FROM tbl_quote_item WHERE qdoc_id='".$qdoc_id."' AND enable=1 AND product_status='1' ORDER BY sort ASC; ";

		$a_qitem = Yii::app()->db->createCommand($sql_qitem)->queryAll();

		$sql = "SELECT * FROM `tbl_quote_item` WHERE `qdoc_id` = '$qdoc_id' AND enable='1' AND (`pro_name` LIKE '%Royalty%' OR `pro_name` LIKE '%Credit Card%' OR `pro_name` LIKE '%Shipping%')";
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



		foreach( $a_qitem as $tmp_key => $row_qitem ){



			$pro_id = $row_qitem["pro_id"];

			$qty = $row_qitem["qty"];

			$uprice = $row_qitem["uprice"];

			$comm_percent = $row_qitem["comm_percent"];
			$qdoci_id = $row_qitem["qdoci_id"];
			$comm_value = "";

			$tmp_comm_percent = 0;

			if($comm_percent!=""){

				$tmp_comm_percent = intval(str_replace("%", "", $comm_percent));

				$comm_value = ($qty*$uprice)*($tmp_comm_percent/100);

				$comm_total += $comm_value;

			}

			$sql = "SELECT * FROM `tbl_quote_item` WHERE `qdoci_id` = '$qdoci_id' AND enable='1' AND (`pro_name` LIKE '%Royalty%' OR `pro_name` LIKE '%Credit Card%' OR `pro_name` LIKE '%Shipping%')";
			$shipp = Yii::app()->db->createCommand($sql)->queryAll();

			$shippcount= count($shipp);

			$tmp_amount = $qty*$uprice;



			$return_html .= '<tr><td style="padding:10px 0px; text-align:left; display: block; white-space: pre-wrap; word-break: break-all; word-wrap: break-word;">';

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



			if($action_from=="va"){

				$return_html .= '<input type="hidden" name="qdoci_id[]" value="'.$row_qitem["qdoci_id"].'">';

				$return_html .= '<input style="width:100%; font-weight:bold;" type="text" name="pro_name[]" value="'.htmlspecialchars($row_qitem["pro_name"]).'">';

				$return_html .= '<br><textarea style="width:100%; min-height:70px;" name="pro_desc[]">'.$row_qitem["pro_desc"].'</textarea>';

				if($row_qitem["addi_desc"]!=""){

					$return_html .= $row_qitem["addi_desc"];

				}

			}else{

				$return_html .= '<b>'.htmlspecialchars($row_qitem["pro_name"]).'</b><br>'.$row_qitem["pro_desc"];

			}



			$return_html .= '</td>';



			if($action_from=="vc"){



				$return_html .= '<td style="text-align:center; color:#999;">'.(($tmp_comm_percent!=0)?($tmp_comm_percent."%"):"0%");

				if( $user_group=="1" || $user_group=="99" ){

					$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editCommAfterApprove(\''.$qdoc_id.'\',\''.$row_qitem["qdoci_id"].'\',\''.$tmp_comm_percent.'\');"></i>';

				}

				



				$return_html .= '</td>';

				$return_html .= '<td style="text-align:center; color:#999;">'.(($comm_value!="")?number_format($comm_value,2):"0").'</td>';



			}else if($action_from=="va"){



				$return_html .= '<td style="text-align:center; color:#999;"><input type="hidden" value="'.$row_qitem["qdoci_id"].'" class="qdoci_id_app">';

				$return_html .= '<input type="hidden" value="'.$tmp_amount.'" id="tmp_amount'.$row_qitem["qdoci_id"].'">';

				$return_html .= '<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width:60px; text-align:center;" min="0" type="number" value="'.$tmp_comm_percent.'" id="comm_percent_app'.$row_qitem["qdoci_id"].'"></td>';

				$return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app'.$row_qitem["qdoci_id"].'">'.(($comm_value!="")?number_format($comm_value,2):"").'</td>';



			}

			$return_html .= '<td style="text-align:center;">';

			if($action_from=="va"){

				$return_html .= '<input name="app_qty[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:55px; text-align:center;" min="0" type="number" value="'.$qty.'" id="app_qty'.$row_qitem["qdoci_id"].'">';

			}else{

				$return_html .= number_format($qty,0);

			}

			$return_html .= '</td>';

			

			$return_html .= '<td style="text-align:right;">';

			if($action_from=="va"){

				$return_html .= '<input name="app_uprice[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:70px; text-align:center;" min="0.00" type="number" value="'.$uprice.'" id="app_uprice'.$row_qitem["qdoci_id"].'">';

			}else if( $action_from=="vc" && ($user_group=="1" || $user_group=="99") ){

				$return_html .= $pre_cost.number_format($uprice,2);



				$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editUPriceAfterApprove(\''.$qdoc_id.'\',\''.$row_qitem["qdoci_id"].'\',\''.$uprice.'\');"></i>';



			}else{

				$return_html .= $pre_cost.number_format($uprice,2);

			}

			$return_html .= '</td><td style="text-align:center;">'.$pre_cost.'<span class="shippcount'.$shippcount.'" id="sp_app_amount'.$row_qitem["qdoci_id"].'">';



			if($action_from=="va"){

				$return_html .= $tmp_amount;

			}else{

				$return_html .= number_format($tmp_amount,2);

			}



			$return_html .= '</span></td>';



			if($action_from=="va"){

				$return_html .= '<td style="text-align:center;cursor:pointer;" class="remover" qdoci_id="'.$row_qitem['qdoci_id'].'"><i style="color:red;" class="fa fa-minus-circle"></i></td>';

			}



			$return_html .='</tr>';



			//$sub_total += $tmp_amount;

		}



		$col_span = 4;

		$col_span2 = 2;

		if($action_from=="vc" || $action_from=="va"){

			$col_span = 6;

			$col_span2 = 4;

		}

		$return_html .= '<tr><td colspan="'.$col_span.'" style="padding:0px;"><hr style="margin:0px;"></td></tr>';



		

		

		$vat_7percent = ($sub_total-$row_quote['actual_discount'])*0.07;



		$f_total = 0.0;

		if($row_quote["inc_vat"]=="yes" || $action_from=="va" || $action_from=="vb"){

            if($action_from!="vp"){

			$return_html .= '<tr><td colspan="2"><span qdoc_id="'.$qdoc_id.'" class="btn btn-success add_row" style="padding:5px;">Add Row  <i class="fa fa-plus" aria-hidden="true"></i></span></td>';

            }

			if($action_from=="vc" || $action_from=="va"){

				$return_html .= '<td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">'.number_format($comm_total,2).'</td><td>&nbsp;</td>';

			}

            $colspaner = '';

            $colspaner_1 = '';

            if($action_from=="vp"){

                $colspaner = "colspan='3'";

                $colspaner_1 = "colspan='1'";

            }

			$return_html .= '<th '.$colspaner.' style="padding: 10px 0px; text-align:right;">Subtotal:</th>';

			$return_html .= '<td '.$colspaner_1.' style="padding: 10px 0px; text-align:right;">'.$pre_cost.'<span id="sp_app_sub_total">'.$sub_total.'</span></td></tr>';



			if($row_quote["inc_vat"]=="yes"){

				$f_total = ($sub_total-$row_quote['actual_discount'])+$vat_7percent;

			}else{

				$f_total = $sub_total-$row_quote['actual_discount'];

			}

			if($action_from!="vp"){

			

    			if ($row_quote["design_url"]!="" || $row_quote["design_url"]!=NULL) {

    				$return_html .= "<input type='hidden' id='tr_total' value='1'>";

    				$return_html .="<tr><th>Design URL</th></tr>";

    				$return_html .="<tr><td class='alert alert-success'><a style='color:white;' href=".$row_quote["design_url"].">".$row_quote["design_url"]."</a></td></tr>";

    			}

    			

    			$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Change Currency:</th><td style="padding: 10px 0px; text-align:right;"><span>'.$select_html.'</span></td></tr>';

    			

    			$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="discount_percent" class="number_disc_approval" data-shipp="'.$shipping.'"  value="'.$row_quote['discount_percent'].'" style="width:55px;"></span></td></tr>';

			

			    $return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="actual_discount" id="actual_disc_approval" data-shipp="'.$shipping.'"  value="'.$row_quote['actual_discount'].'" style="width:55px;"></span></td></tr>';

		    }



			$return_html .= "<input type='hidden' id='tr_total' value='0'>";

			

			if($action_from=="vp" && $row_quote['actual_discount']!="0"){

			    $return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>'.$row_quote['discount_percent'].'%</span></td></tr>';

			

			    $return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>'.$pre_cost.number_format($row_quote['actual_discount'],2).'</span></td></tr>';

			}

			



			$return_html .= '<tr ><td rowspan="3" colspan="'.$col_span2.'">';

			if($row_quote["sale_note"]!="" && ($action_from=="va" || $action_from=="vb") ){

				$return_html .= 'Salesman Notes (<font color=red>Not shown in Quotation</font>)';

				if($action_from=="vb"){

					$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_edit_sale_note" style="background-color:#DDD;" onclick="return editSaleNote('.$qdoc_id.');"><i class="fa fa-pencil" style="color:#00F;"></i> Edit</button>';

					$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_save_sale_note" style="background-color:#FFF;" disabled onclick="return saveSaleNote('.$qdoc_id.');"><i class="fa fa-floppy-o" style="color:#070;"></i> Save</button>';

				}

				

				$return_html .= '<br><pre class="alert alert-success" style="width:100%; height:100%; max-width:700px; overflow-x:auto;" id="pre_sale_note'.$qdoc_id.'">'.$row_quote["sale_note"].'</pre>';

			}else{

				$return_html .= '&nbsp;';

			}



			if($action_from=="va"){

				$return_html .= 'Comment (<font color=red>Not shown in Quotation and appear on the top after Approve or Reject.</font>)';

				$return_html .= '<div style="text-align:left;">';

				$return_html .= '<textarea name="approval_comment" id="approval_comment" style="width: 700px; height: 100px; min-height: 101px; margin: 3px;"></textarea>';

				$return_html .= '</div>';

			}



			$return_html .= '</td>';

			$return_html .= '<td style="padding: 10px 0px; text-align:right;">';

			$return_html .= '<input type="hidden" id="sub_total_app" value="'.$sub_total.'">';

			$return_html .= '<input type="hidden" id="pre_cost_app" value="'.$pre_cost.'">';

			$return_html .= '<input type="hidden" name="vat_value_app" id="vat_value_app" value="'.$vat_7percent.'">';

			$return_html .= '<input type="hidden" id="total_value_app" value="'.$f_total.'">';



			

			

			if($row_quote["approve_status"]=="new" && ( $user_group=="1" || $user_group=="99" ) ){

				$return_html .= '<span class="subnvat"><input type="checkbox" name="inc_vat_app" id="inc_vat_app" value="yes" onclick="changeIncludeVATApprove();" ';

				if($row_quote["inc_vat"]=="yes"){

					$return_html .= 'checked';

				}

				$return_html .= '>';

			}

			$return_html .= ' VAT 7%:</span></td>';

			$return_html .= '<td style="padding: 10px 0px; text-align:right;"><span class="subnvat" id="sp_show_vat_value_app">';

			if($row_quote["inc_vat"]=="yes"){

				$return_html .= $pre_cost.number_format($vat_7percent,2);

			}

			$return_html .= '</span></td></tr>';



			$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Total:</span></th>';

			$return_html .= '<td style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat" id="sp_show_total_value_app">'.$pre_cost.number_format($f_total,2).'</span></td></tr>';

			

			

			$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total ('.$row_quote["quote_curr"].'):</th>';

			$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="'.$pre_cost.'">'.$pre_cost.number_format($f_total,2).'</span></th></tr>';

		

		}else{

			//$f_total = $sub_total;

            $f_total = $row_quote["grand_total"];

			$return_html .= '<tr ><td>&nbsp;</td>';

			$colspan_grand = "colspan='2'";

			if($action_from=="vc" || $action_from=="va"){

				$return_html .= '<td>&nbsp;</td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">'.number_format($comm_total,2).'</td>';

			}

			if($action_from=="vp" && $row_quote['actual_discount']!="0"){

			    $return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>'.$row_quote['discount_percent'].'%</span></td></tr>';

			

			    $return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>'.$pre_cost.number_format($row_quote['actual_discount'],2).'</span></td></tr>';

			    $colspan_grand = "colspan='3'";

			}

			$return_html .= '<th '.$colspan_grand.' style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total ('.$row_quote["quote_curr"].'):</th>';

			$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="'.$pre_cost.'">'.$pre_cost.number_format($f_total,2).'</span></th></tr>';

		}



		



		$return_html .= '</table>';

		$return_html .= '</td></tr>';



		$return_html .= '</table>';



		if($action_from!="va" && $row_quote["note"]!=""){

			$return_html .= '<b>Notes</b> ';

			$return_html .= '<pre ';

			if($row_quote["approve_status"]=="reject"){

				$return_html .= ' class="alert alert-dark" ';

			}

			$return_html .= '>'.$row_quote["note"].'</pre>';

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

		if($row_quote["approval_comment"]!=""){

			$a_result["approval_comment"] = base64_encode('<div><center><pre class="alert" style="text-align:left; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;" id="approval_comment'.$qdoc_id.'">'.$row_quote["approval_comment"].'</pre></center></div>');

		}



		if($approve_status=="new"){



			$a_result["show_approve"] = "yes";

			$a_result["show_reject"] = "yes";



			if($row_quote["history_qdoc_id"]!=""){



				$a_result["history_inner"] .= '<option value="'.$qdoc_id.'">==Main Document==</option>'; 



				$sql_history = "SELECT qdoc_id,add_date FROM tbl_quote_doc WHERE qdoc_id IN (".rtrim($row_quote["history_qdoc_id"],',').") ORDER BY add_date DESC; ";

				//$a_result["history_inner"] .= $sql_history;

				$a_history = Yii::app()->db->createCommand($sql_history)->queryAll();

				foreach($a_history as $tmp_key_his => $row_history){

					$a_result["history_inner"] .= '<option value="'.$row_history["qdoc_id"].'">'.$row_history["add_date"].'</option>'; 

				}

				

			}

			

		}else if($approve_status=="approve"){



			$a_result["show_print"] = "yes";



		}

		

		if($action_from=="va"){

		    $a_result["show_approve"] = "yes";

			$a_result["show_reject"] = "yes";

			$a_result["show_print"] = "yes";

		}

		

		$a_result['note_text'] = $row_quote["note"];

// 		print_r($return_html);

// 		die;

        $jog_code_array = explode(",",$jog_code_main); 

        $jog_code_fin = implode("_",$jog_code_array);

        $fname = $row_quote["est_number"]."Q-".$jog_code_fin."-".time().".pdf";

        $path = 'pdfs/'.$fname;

        $mpdf->setFooter('{PAGENO} / {nb}');

        $mpdf->setHeader('{DATE j-m-Y H:i:s}');

		$mpdf->AddPage('P');

	    $mpdf->WriteHTML($return_html);

	    

	    $mpdf->Output($path,'F');

	    

	    return $fname;

	}

	

	public function actionArchived()

	{

	    $user_group = Yii::app()->user->getState('userGroup');

	    $user_id = Yii::app()->user->getState('userKey');

	    $year_date = date("Y");

	    $year_month = date("m");

	    if(isset($_POST['year_date'])){

	        $year_date = $_POST['year_date'];

	        $year_month = $_POST['year_month'];

	    }

	    if($user_group=="99" || $user_group=="1"){

    	    $sql = "SELECT * from quotation_data LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=quotation_data.qdoci_id LEFT JOIN user ON user.id=quotation_data.conv_by_id WHERE monthname(`conv_date`)=MONTHNAME(STR_TO_DATE($year_month, '%m')) AND YEAR(`conv_date`)='$year_date' AND is_deleted='0' ORDER BY quotation_data.created_date DESC";

	    }

	    else{

	        $sql = "SELECT * from quotation_data LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=quotation_data.qdoci_id LEFT JOIN user ON user.id=quotation_data.conv_by_id WHERE monthname(`conv_date`)=MONTHNAME(STR_TO_DATE($year_month, '%m')) AND YEAR(`conv_date`)='$year_date' AND conv_by_id='$user_id' AND is_deleted='0' AND archive_status='1' ORDER BY quotation_data.created_date DESC";

	    }

	    

	    if($user_id=="34"){

	        $sql = "SELECT * from quotation_data LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=quotation_data.qdoci_id LEFT JOIN user ON user.id=quotation_data.conv_by_id WHERE monthname(`conv_date`)=MONTHNAME(STR_TO_DATE($year_month, '%m')) AND YEAR(`conv_date`)='$year_date' AND (conv_by_id='$user_id' OR conv_by_id='27') AND is_deleted='0' AND archive_status='1' ORDER BY quotation_data.created_date DESC";

	    }

	    $data['quotes'] = Yii::app()->db->createCommand($sql)->queryAll();

	    $data['year'] = $year_date;

	    $data['month'] = $year_month;

		/*$result['model'] = new Upload;

		$result['files'] = Upload::model()->findAll();*/

		$this->render('archived',$data);

	}

	

	public function actionArchiveQuote(){

	    $conv_id = $_POST['conv_id'];

	    $sql = "UPDATE quotation_data SET archive_status='1' WHERE conv_id='$conv_id'";

	    Yii::app()->db->createCommand($sql)->execute();

	    die(json_encode(array('status'=>'1')));

	}
	
	public function actionUpdateCreditCard(){
		$conv_id =  $_POST['conv_id'];
		$credit_value =  $_POST['credit_card_3'];
		$credit_net_30 =  $_POST['credit_net_30'];
		$full_payment_b4_ship =  $_POST['full_payment_b4_ship'];
		$down_payment_50 =  $_POST['down_payment_50'];
		$ACH_1_Fee =  $_POST['ACH_1_Fee'];
		
		$sql = "UPDATE `quotation_data` SET `credit_card_3`= $credit_value, `credit_net_30`= $credit_net_30 ,`full_payment_b4_ship`= $full_payment_b4_ship,`50_down_payment`= $down_payment_50, `ACH_1_Fee`= $ACH_1_Fee WHERE `conv_id` = $conv_id";
		Yii::app()->db->createCommand($sql)->execute();
		
	}

	

	public function actionUpdateUserByAdmin(){

	    $conv_id = $_POST["conv_id"];

	    $full_name = $_POST['full_name'];

		$user_id = $_POST["user_id"];

        $fetch = "SELECT conv_by,conv_by_id,qdoci_id FROM quotation_data WHERE conv_id='$conv_id'";

        $data = Yii::app()->db->createCommand($fetch)->queryAll();

        $original_sales_id = $data[0]['conv_by_id'];

        $original_sales_name = $data[0]['conv_by'];
        
        $qdoci_id = $data[0]['qdoci_id'];

		$sql_update = "UPDATE quotation_data SET conv_by_id='".$user_id."',conv_by='".$full_name."',original_sales_id='".$original_sales_id."',original_sales_name='".$original_sales_name."' WHERE conv_id='".$conv_id."';";

		if(Yii::app()->db->createCommand($sql_update)->execute()){
		    
		    $sql_main = "UPDATE tbl_quote_doc SET user_id='".$user_id."' WHERE qdoc_id='$qdoci_id'";
		    Yii::app()->db->createCommand($sql_main)->execute();

			$a_result["result"] = "success";



		}else{

			$a_result["result"] = "fail";

			$a_result["msg"] = "Fail to update User.";

		}



		echo json_encode($a_result);

	}

	

	public function actionFetchText(){

	    $conv_id = $_POST['conv_id'];

	    $sql = "SELECT request_text FROM quotation_data WHERE conv_id='$conv_id'";

	    $data = Yii::app()->db->createCommand($sql)->queryAll();

	    $text = $data[0]['request_text'];

	    die(json_encode(array('status'=>'1','data'=>$text)));

	}

	public function actionFetchReqText(){

	    $conv_id = $_POST['conv_id'];

	    $sql = "SELECT request_text,created_at,req_text_id FROM quot_request_text WHERE conv_id='$conv_id' AND status = 0";
	    $data = Yii::app()->db->createCommand($sql)->queryAll();
		$text = [];
		foreach($data as $key => $value) {	
			$text[$key]['request_text'] = $value['request_text'];
			$text[$key]['created_at'] = $value['created_at'];
			$text[$key]['req_text_id'] = $value['req_text_id'];
		}

		$sql = "SELECT request_text FROM quotation_data WHERE conv_id='$conv_id'";

	    $data = Yii::app()->db->createCommand($sql)->queryAll();

	    $old_text = $data[0]['request_text'];

	    die(json_encode(array('status'=>'1','data'=>$text,'old_text'=>$old_text)));

	}

	public function actionRemoveConv(){

	    $conv_id = $_POST['conv_id'];

	    $email_text = addslashes($_POST['rollback_email']);

	    $sql = "SELECT * FROM quotation_data JOIN user ON quotation_data.conv_by_id=user.id WHERE quotation_data.conv_id='$conv_id'";

	    $new_data = Yii::app()->db->createCommand($sql)->queryAll();

	    $email = $new_data[0]['email'];

	    $jog_code = $new_data[0]['jog_code'];

	    $qdoc_id = $new_data[0]['qdoci_id'];

	    

	    $nsql = "SELECT est_number FROM tbl_quote_doc WHERE qdoc_id='$qdoc_id'";

	    $data = Yii::app()->db->createCommand($nsql)->queryAll();

	    $est_number = $data[0]['est_number'];

	    

	    $update = "UPDATE tbl_quote_doc SET conversion_status=0 WHERE qdoc_id='$qdoc_id'";

	    Yii::app()->db->createCommand($update)->execute();

	    

	    $delete = "DELETE FROM quotation_data WHERE conv_id='$conv_id'";

	    Yii::app()->db->createCommand($delete)->execute();

	    $mail=Yii::app()->Smtpmail;

		$mail->Host = 'cvps652.serverhostgroup.com';

        $mail->Port = 587;//465

		$mail->CharSet = 'utf-8'; 

		$mail->SMTPAuth = true;

		$mail->SMTPSecure = 'tls';

		$mail->Username = "no-reply@jog-joinourgame.com";

        $mail->Password = "demo@9090";

		$mail->SetFrom("no-reply@jog-joinourgame.com", 'JOG SPORTS | SALES REP PORTAL');

		$mail->Subject = "Quotation Rollbacked - ".$jog_code." | ".$est_number;

		$mail->Body    = $email_text;

		//$mail->AddAddress($mail_customer, $mail_customername);

        $mail->addBcc("ravish@jogsportswear.com");

        $mail->addBcc("swhitcomb@jogsports.com");

        $mail->addReplyTo('swhitcomb@jogsports.com', 'Scott Whitcomb');

	    $mail->AddAddress($email);

		if(!$mail->Send()) {

			//echo $mail->ErrorInfo;

		}else {

		    //echo "working";

			//Yii::app()->user->setFlash('success', 'Message Already sent!');

		}

		$mail->ClearAddresses();

	    die(json_encode(array('status'=>1)));

	}

	

	public function actionQuoteFinalEmail(){

	    $conv_id = $_POST['conv_id'];

	    $sql = "SELECT * FROM quotation_data JOIN user ON quotation_data.conv_by_id=user.id WHERE quotation_data.conv_id='$conv_id'";

	    $new_data = Yii::app()->db->createCommand($sql)->queryAll();

	    $email = $new_data[0]['email'];

	    $jog_code = $new_data[0]['jog_code'];

	    $qdoci_id = $new_data[0]['qdoci_id'];

	    $name = $this->actionCreatePDF($qdoci_id,$jog_code);

	    $post = [

            'jog_code' => $jog_code,

            'file_name' => $name,

        ];

        

        $ch = curl_init('https://locker.jog-joinourgame.com/salesrep_api/upload_files.php');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        

        // execute!

        $response = curl_exec($ch);

        

        // close the connection, release resources used

        curl_close($ch);

        

        // do anything you want with your response

        $response;

        $del_path = $_SERVER['DOCUMENT_ROOT']."/pdfs/".$name;

        unlink($del_path);

	    $bs_url = Yii::app()->request->getBaseUrl(true);

	    $url = $bs_url."/quoteEstimate";

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

                                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">

                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                                        <tr>

                                            <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 40px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">

                                                <p style="margin: 0;">Quotation has been approved for '.$jog_code.'</p>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td bgcolor="#ffffff" align="left">

                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                    <tr>

                                                        <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">

                                                            <table border="0" cellspacing="0" cellpadding="0">

                                                                <tr>

                                                                    <td align="center" style="border-radius: 3px;" bgcolor="#000000"><a href="'.$url.'" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #000000; display: inline-block;">Continue</a></td>

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

                                                <p style="margin: 0;"><a href="'.$url.'" target="_blank" style="color: #000000;">'.$url.'</a></p>

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

		

		$mail=Yii::app()->Smtpmail;

		$mail->Host = 'cvps652.serverhostgroup.com';

        $mail->Port = 587;//465

		$mail->CharSet = 'utf-8'; 

		$mail->SMTPAuth = true;

		$mail->SMTPSecure = 'tls';

		$mail->Username = "no-reply@jog-joinourgame.com";

        $mail->Password = "demo@9090";

		$mail->SetFrom("no-reply@jog-joinourgame.com", 'JOG SPORTS | SALES REP PORTAL');

		$mail->Subject = "QUOTATION APPROVED - ".$jog_code;

		$mail->MsgHTML($template3);

		//$mail->AddAddress($mail_customer, $mail_customername);

        $mail->addBcc("ravish@jogsportswear.com");

	    $mail->AddAddress($email);

		if ($email != "ameyers@jogsportswear.com") {
			if (!$mail->Send()) {
				//echo $mail->ErrorInfo;
			} else {
				//echo "working";
				//Yii::app()->user->setFlash('success', 'Message Already sent!');
			}
		}

		$mail->ClearAddresses();

		die(json_encode(array('status'=>1)));

	}

	

	public function actionReqUpdateFinal(){

	    $conv_id = $_POST['conv_id'];

		if(isset($_POST['req_text'])){
			$req_text = $_POST['req_text'];
		}else {
			$req_text = '';
		}
		
		$close_status= 0;

	    $sql = "SELECT * FROM quotation_data WHERE conv_id='$conv_id'";

	    $data = Yii::app()->db->createCommand($sql)->queryAll();

	    $emp_id = $data[0]['conv_by_id'];

	    $jog_code = $data[0]['jog_code'];

	    $nsql = "SELECT * FROM user WHERE id='$emp_id'";

	    $new_data = Yii::app()->db->createCommand($nsql)->queryAll();

	    $fullname = $new_data[0]['fullname'];

	    $email = $new_data[0]['email'];

	    
		if (!empty($req_text)) {					
			$upText_sql = "UPDATE quot_request_text SET status=1 WHERE req_text_id='$req_text'";
			Yii::app()->db->createCommand($upText_sql)->execute();

			$sql = "SELECT * FROM quot_request_text WHERE conv_id='$conv_id' AND status = 0";
			$data = Yii::app()->db->createCommand($sql)->queryScalar();		
			if ($data == 0) {
				$up_sql = "UPDATE quotation_data SET request_update=0 WHERE conv_id='$conv_id'";
				Yii::app()->db->createCommand($up_sql)->execute();
				$close_status = 1;
			}
		}else{
			$up_sql = "UPDATE quotation_data SET request_update=0 WHERE conv_id='$conv_id'";
			Yii::app()->db->createCommand($up_sql)->execute();
			$close_status = 0;
		}

	    

	    $bs_url = Yii::app()->request->getBaseUrl(true);

	    $url = $bs_url."/quoteEstimate";

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

                                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">

                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                                        <tr>

                                            <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">

                                                <p style="margin: 0;">Request Update Completed by Admin in SALES REP PORTAL on Quotation with JOG CODE - '.$jog_code.'</p>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td bgcolor="#ffffff" align="left">

                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                    <tr>

                                                        <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">

                                                            <table border="0" cellspacing="0" cellpadding="0">

                                                                <tr>

                                                                    <td align="center" style="border-radius: 3px;" bgcolor="#000000"><a href="'.$url.'" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #000000; display: inline-block;">Continue</a></td>

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

                                                <p style="margin: 0;"><a href="'.$url.'" target="_blank" style="color: #000000;">'.$url.'</a></p>

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

		

		$mail=Yii::app()->Smtpmail;

		$mail->Host = 'cvps652.serverhostgroup.com';

        $mail->Port = 587;//465

		$mail->CharSet = 'utf-8'; 

		$mail->SMTPAuth = true;

		$mail->SMTPSecure = 'tls';

		$mail->Username = "no-reply@jog-joinourgame.com";

        $mail->Password = "demo@9090";

		$mail->SetFrom("no-reply@jog-joinourgame.com", 'JOG SPORTS | SALES REP PORTAL');

		$mail->Subject = "REQUEST UPDATE COMPLTED - ".$jog_code;

		$mail->MsgHTML($template3);

		//$mail->AddAddress($mail_customer, $mail_customername);

        $mail->addBcc("ravish@jogsportswear.com");

	    $mail->AddAddress($email);

		if(!$mail->Send()) {

			//echo $mail->ErrorInfo;

		}else {

		    //echo "working";

			//Yii::app()->user->setFlash('success', 'Message Already sent!');

		}

		$mail->ClearAddresses();

		die(json_encode(array('status'=>1,'msg'=>$close_status)));

	    

	}

	

	public function actionSubmitNoteAdmin(){

	    $user_id = Yii::app()->user->getState('userKey');

	    $name_user = "Scott Whitcomb";

	    $send_email = "Nam@jogsportswear.com";

	    if($user_id!=40){

	        $name_user = "Administrator";

	        $send_email = "swhitcomb@jogsports.com";

	    }

	    $is_avail = $_POST['is_avail'];

	    $conv_id = $_POST['conv_id'];

	    $admin_comments = addslashes($_POST['admin_comments']);

	    $jog_code = $_POST['jog_code'];

	    if($is_avail==0){

    	    $sql = "UPDATE quotation_data SET admin_comments='$admin_comments' WHERE conv_id='$conv_id'";

    	    Yii::app()->db->createCommand($sql)->execute();

	    }

	    else{

	        $ins = "INSERT INTO `tbl_quotes_comments_admin`(`conv_id`, `user_id`, `message_long`) VALUES ('$conv_id','$user_id','$admin_comments')";

	        Yii::app()->db->createCommand($ins)->execute();

	    }

	    $bs_url = Yii::app()->request->getBaseUrl(true);

	    $url = $bs_url."/quoteEstimate";

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

                                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">

                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                                        <tr>

                                            <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 40px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">

                                                <p style="margin: 0;">You have a comment - <br> <b>"'.$admin_comments.'"</b> <br> from '.$name_user.' on Quotation with JOG CODE - '.$jog_code.' Continue clicking on the button below and search for the mentioned JOG CODE.</p>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td bgcolor="#ffffff" align="center">

                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                    <tr>

                                                        <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">

                                                            <table border="0" cellspacing="0" cellpadding="0">

                                                                <tr>

                                                                    <td align="center" style="border-radius: 3px;" bgcolor="#000000"><a href="'.$url.'" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #000000; display: inline-block;">Continue</a></td>

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

                                                <p style="margin: 0;"><a href="'.$url.'" target="_blank" style="color: #000000;">'.$url.'</a></p>

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

		

		$mail=Yii::app()->Smtpmail;

		$mail->Host = 'cvps652.serverhostgroup.com';

        $mail->Port = 587;//465

		$mail->CharSet = 'utf-8'; 

		$mail->SMTPAuth = true;

		$mail->SMTPSecure = 'tls';

		$mail->Username = "no-reply@jog-joinourgame.com";

        $mail->Password = "demo@9090";

		$mail->SetFrom("no-reply@jog-joinourgame.com", 'JOG SPORTS | SALES REP PORTAL');

		$mail->Subject = "Quotation Admin Note - ".$jog_code;

		$mail->MsgHTML($template3);

		//$mail->AddAddress($mail_customer, $mail_customername);

        $mail->addBcc("ravish@jogsportswear.com");

	    $mail->AddAddress($send_email);
	    if($send_email=="Nam@jogsportswear.com"){
	        $mail->AddAddress("note@jogsportswear.com");
	        $mail->AddAddress("mo@jogsportswear.com");
	    }

	    

		if(!$mail->Send()) {

			//echo $mail->ErrorInfo;

		}else {

		    //echo "working";

			//Yii::app()->user->setFlash('success', 'Message Already sent!');

		}

		$mail->ClearAddresses();

		die(json_encode(array('status'=>1,'comment'=>base64_encode($admin_comments))));

	}

	public function actionUpdateRequestedAjax(){

		
	    $full_name = Yii::app()->user->getState('fullName');

	    $jog_code = $_POST['jog_code'];

	    $conv_id = $_POST['conv_id'];

		$req_upd_text = $_POST['req_upd_text'];
		$update_notes1 = addslashes($_POST['update_notes']);
	
		

	    $sql = "UPDATE quotation_data SET request_update=1 WHERE conv_id='$conv_id'";

	    Yii::app()->db->createCommand($sql)->execute();

		

		$ins = "INSERT INTO `quot_request_text`(`conv_id`, `jog_code`, `request_text`,status, created_at) VALUES ('$conv_id','$jog_code','$update_notes1',0,NOW())";

	    Yii::app()->db->createCommand($ins)->execute();

	    $bs_url = Yii::app()->request->getBaseUrl(true);

	    $url = $bs_url."/quoteEstimate";

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

                                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">

                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                                        <tr>

                                            <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">

                                                <p style="margin: 0;">Request Update in SALES REP PORTAL from '.$full_name.' on Quotation with JOG CODE - '.$jog_code.'</p>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td bgcolor="#ffffff" align="left">

                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                    <tr>

                                                        <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">

                                                            <table border="0" cellspacing="0" cellpadding="0">

                                                                <tr>

                                                                    <td align="center" style="border-radius: 3px;" bgcolor="#000000"><a href="'.$url.'" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #000000; display: inline-block;">Continue</a></td>

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

                                                <p style="margin: 0;"><a href="'.$url.'" target="_blank" style="color: #000000;">'.$url.'</a></p>

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

		

		$mail=Yii::app()->Smtpmail;

		$mail->Host = 'cvps652.serverhostgroup.com';

        $mail->Port = 587;//465

		$mail->CharSet = 'utf-8'; 

		$mail->SMTPAuth = true;

		$mail->SMTPSecure = 'tls';

		$mail->Username = "no-reply@jog-joinourgame.com";

        $mail->Password = "demo@9090";

		$mail->SetFrom("no-reply@jog-joinourgame.com", 'JOG SPORTS | SALES REP PORTAL');

		$mail->Subject = "REQUEST UPDATE - ".$jog_code;

		$mail->MsgHTML($template3);

		//$mail->AddAddress($mail_customer, $mail_customername);

        $mail->addBcc("ravish@jogsportswear.com");

	    $mail->AddAddress('swhitcomb@jogsports.com');

	    

		if(!$mail->Send()) {

			//echo $mail->ErrorInfo;

		}else {

		    //echo "working";

			//Yii::app()->user->setFlash('success', 'Message Already sent!');

		}

		$mail->ClearAddresses();

		die(json_encode(array('status'=>1,)));

	}

	public function actionRequestUpdateAjax(){

	    $full_name = Yii::app()->user->getState('fullName');

	    $jog_code = $_POST['jog_code'];

	    $conv_id = $_POST['conv_id'];

	    $update_notes = addslashes($_POST['update_notes']);

	    $sql = "UPDATE quotation_data SET request_update=1 WHERE conv_id='$conv_id'";

	    Yii::app()->db->createCommand($sql)->execute();

		$ins = "INSERT INTO `quot_request_text`(`conv_id`, `jog_code`, `request_text`,status, created_at) VALUES ('$conv_id','$jog_code','$update_notes',0,NOW())";

	    Yii::app()->db->createCommand($ins)->execute();

	    $bs_url = Yii::app()->request->getBaseUrl(true);

	    $url = $bs_url."/quoteEstimate";

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

                                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">

                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                                        <tr>

                                            <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">

                                                <p style="margin: 0;">Request Update in SALES REP PORTAL from '.$full_name.' on Quotation with JOG CODE - '.$jog_code.'</p>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td bgcolor="#ffffff" align="left">

                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                    <tr>

                                                        <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">

                                                            <table border="0" cellspacing="0" cellpadding="0">

                                                                <tr>

                                                                    <td align="center" style="border-radius: 3px;" bgcolor="#000000"><a href="'.$url.'" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #000000; display: inline-block;">Continue</a></td>

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

                                                <p style="margin: 0;"><a href="'.$url.'" target="_blank" style="color: #000000;">'.$url.'</a></p>

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

		

		$mail=Yii::app()->Smtpmail;

		$mail->Host = 'cvps652.serverhostgroup.com';

        $mail->Port = 587;//465

		$mail->CharSet = 'utf-8'; 

		$mail->SMTPAuth = true;

		$mail->SMTPSecure = 'tls';

		$mail->Username = "no-reply@jog-joinourgame.com";

        $mail->Password = "demo@9090";

		$mail->SetFrom("no-reply@jog-joinourgame.com", 'JOG SPORTS | SALES REP PORTAL');

		$mail->Subject = "REQUEST UPDATE - ".$jog_code;

		$mail->MsgHTML($template3);

		//$mail->AddAddress($mail_customer, $mail_customername);

        $mail->addBcc("ravish@jogsportswear.com");

	    $mail->AddAddress('swhitcomb@jogsports.com');

	    

		if(!$mail->Send()) {

			//echo $mail->ErrorInfo;

		}else {

		    //echo "working";

			//Yii::app()->user->setFlash('success', 'Message Already sent!');

		}

		$mail->ClearAddresses();

		die(json_encode(array('status'=>1,)));

	}

	

	public function actionFetchComments(){

	    $conv_id = $_POST['conv_id'];

	    $sql = "SELECT admin_comments AS note,jog_code FROM quotation_data WHERE conv_id='$conv_id'";

	    $data = Yii::app()->db->createCommand($sql)->queryAll();;

	    if(count($data)>0){

	        $note = $data[0]['note'];

	        $jog_code = $data[0]['jog_code'];

	        die(json_encode(array('status'=>1,'msg'=>$note,'jog_code'=>$jog_code)));

	    }

	    else{

	        die(json_encode(array('status'=>0)));

	    }

	}

	public function actionShippingDate(){

	    $jog_code = $_POST['jog_code'];

		
	    $sql = "SELECT * FROM tbl_split_shipment WHERE order_main_code = '$jog_code'";

	    $data = Yii::app()->db2->createCommand($sql)->queryAll();

		$html = '';
		$html .= '<div class="modal-body">';
		$html .= '<table id="shippingTable" class="table table-striped">';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<th>Date</th>';
		$html .= '<th>Shipping Cost (baht)</th>';				
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';
		foreach($data as $key => $value) {			
			$html .= '<tr>';
				$html .= '<td>';
				$html .= '	<input type="date" name="shipdate[]" value="'.$value['shipping_date'].'" class="form-control">';					
				$html .= '</td>';
				$html .= '<td>';
				$html .= '	<input type="text" name="shipcost[]" value="'.$value['shipping_cost'].'" class="form-control shipcost">';
				$html .= '</td>';				
			$html .= '</tr>';
		}
			$html .= '</tbody>';
			$html .= '</table>';			
			$html .= '<br>';
			$html .= '<div class="form-group">';
			$html .= '<label for="recipient-name" class="col-form-label">Shipping:</label>';

			$html .= '<input type="hidden" name="order_main_code" value="Ex23-0258A-C">';
			$html .= '<input type="text" name="shipping" value="'.$data[0]['shipping'].'" class="form-control" id="shippingTotal">';
			$html .= '</div>';
			$html .= '<div class="form-group">';
			$html .= '<label for="message-text" class="col-form-label">Shipping With:</label>';
			$html .= '<input type="text" name="shippingwith" value="'.$data[0]['shippingwith'].'" class="form-control">';
			$html .= '</div>';
			$html .= '</div>';
		
		die(json_encode(array('status'=>1,'data'=>$html,'jog_code'=>$jog_code)));
	    

	}

	public function actionFetchNote(){

	    $conv_id = $_POST['conv_id'];

	    $sql = "SELECT conv_notes AS note FROM quotation_data WHERE conv_id='$conv_id'";

	    $data = Yii::app()->db->createCommand($sql)->queryAll();;

	    if(count($data)>0){

	        $note = $data[0]['note'];

	        die(json_encode(array('status'=>1,'msg'=>$note)));

	    }

	    else{

	        die(json_encode(array('status'=>0)));

	    }

	}

	

	public function actionApproveConv(){

	    $conv_id = $_POST['conv_id'];

	    $sql = "UPDATE quotation_data SET final_approval='1' WHERE conv_id='$conv_id'";

	    Yii::app()->db->createCommand($sql)->execute();

	    die(json_encode(array('status'=>'1')));

	}

	

	public function actionDeleteConv(){

	    $conv_id = $_POST['conv_id'];

	    $sql = "UPDATE quotation_data SET is_deleted='1' WHERE conv_id='$conv_id'";

	    Yii::app()->db->createCommand($sql)->execute();

	    die(json_encode(array('status'=>'1')));

	}

	

	public function actionFetchOrderNum(){

	    $qdoci_id = $_POST['qdoci_id'];

	    $sql = "SELECT jog_code FROM quotation_data WHERE qdoci_id='$qdoci_id'";

	    $a_comp = Yii::app()->db->createCommand($sql)->queryAll();

	    $data = array();

	    if(count($a_comp)>0){

	        foreach($a_comp as $jog){

	            $data[] = $jog['jog_code'];

	        }

	        $main_data = implode(',',$data);

	        die(json_encode(array('status'=>'1','data'=>$main_data)));

	    }

	    else{

	        die(json_encode(array('status'=>0)));

	    }

	}

	

	public function actionUpdateShippingCharges(){

	    $conv_id = $_POST['conv_id'];

	    $value = addslashes($_POST['value']);

	    $sql = "UPDATE quotation_data SET shipping_charges='$value' WHERE conv_id='$conv_id'";

	    Yii::app()->db->createCommand($sql)->execute();

	    die(json_encode(array('status'=>'1')));

	}

	public function actionUpdateShippingWith(){
	    $conv_id = $_POST['conv_id'];
	    $value = addslashes($_POST['value']);
	    $sql = "UPDATE quotation_data SET shipping_with='$value' WHERE conv_id='$conv_id'";
	    Yii::app()->db->createCommand($sql)->execute();
	    die(json_encode(array('status'=>'1')));
	}

	

	public function actionUpdateShipping(){

	    $value = $_POST['value'];

	    $conv_id = $_POST['conv_id'];

	    $sql = "UPDATE quotation_data SET ship_comp='$value' WHERE conv_id='$conv_id'";

	    Yii::app()->db->createCommand($sql)->execute();

	    die(json_encode(array('status'=>'1')));

	}

	

	public function actionUploadFreebies(){

	    if(isset($_FILES['files_name']['name']) || isset($_POST['notes_admin']))

	    {

    	    if($_POST['conv_type']==1){

    	        $data = "remake";

    	        $data_note = "remake_notes";

    	    }

    	    elseif($_POST['conv_type']==2){

    	        $data = "sample";

    	        $data_note = "sample_notes";

    	    }

    	    elseif($_POST['conv_type']==3){

    	        $data = "complimentary";

    	        $data_note = "complimentary_notes";

    	    }

    	    else{

    	        $data = "online_store";

    	    }

    	    if($_FILES['files_name']['name']!=""){

        	    if($_POST['conv_type']==1 || $_POST['conv_type']==2 || $_POST['conv_type']==3){

        	        $notes_admin = $_POST['notes_admin'];

            	    $conv_id = $_POST['main_conv_id'];

            	    $sourcePath = $_FILES['files_name']['tmp_name'];

                    $newfile=time()."-".$_FILES['files_name']['name']; //any name sample.jpg

                    $targetPath = Yii::getPathOfAlias('webroot').'/upload/samples/'.$newfile;

                    if(move_uploaded_file($sourcePath,$targetPath)){

                        $sql = "UPDATE quotation_data SET $data='$newfile',$data_note='$notes_admin' WHERE conv_id='$conv_id'";

                        Yii::app()->db->createCommand($sql)->execute();

                        die(json_encode(array('status'=>1)));

                    }

                    else{

                        die(json_encode(array('status'=>2)));

                    }

        	    }

        	    else{

        	        $conv_id = $_POST['main_conv_id'];

            	    $sourcePath = $_FILES['files_name']['tmp_name'];

                    $newfile=time()."-".$_FILES['files_name']['name']; //any name sample.jpg

                    $targetPath = Yii::getPathOfAlias('webroot').'/upload/samples/'.$newfile;

                    if(move_uploaded_file($sourcePath,$targetPath)){

                        $sql = "UPDATE quotation_data SET $data='$newfile' WHERE conv_id='$conv_id'";

                        Yii::app()->db->createCommand($sql)->execute();

                        die(json_encode(array('status'=>1)));

                    }

                    else{

                        die(json_encode(array('status'=>0)));

                    }

        	    }

    	    }

    	    else

    	    {

    	        $conv_id = $_POST['main_conv_id'];

    	        $notes_admin = $_POST['notes_admin'];

    	        $sql = "UPDATE quotation_data SET $data_note='$notes_admin' WHERE conv_id='$conv_id'";

                    Yii::app()->db->createCommand($sql)->execute();

                die(json_encode(array('status'=>1)));

    	    }

	    }

	    else{

	        die(json_encode(array('status'=>0)));

	    }

	}

	

	public function actionApproveQuoteFinal(){

		$qdoc_id = $_POST["qdoc_id"];
				
	    $cust_id = $_POST["cust_selector"];

		if (!empty($cust_id)) {			
			$sql_cust = "SELECT * FROM tbl_cust_info WHERE cust_id='".$cust_id."'; ";
			$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();
			$row_cust = $a_cust[0];
			$cust_name = $row_cust["cust_name"];
			$cust_info = $row_cust["cust_info"];
			$cust_id = $row_cust["cust_id"];
		}else {			

			$sql_qdoc = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='".$qdoc_id."'; ";
			$a_qdoc = Yii::app()->db->createCommand($sql_qdoc)->queryAll();
			$row_a_qdoc = $a_qdoc[0];
			$cust_name = $row_a_qdoc["cust_name"];
			$cust_info = $row_a_qdoc["cust_info"];
			$cust_id = $row_a_qdoc["cust_id"];
		}



		$comp_id = $_POST["head_selector_app"];

		$sql_comp = "SELECT * FROM tbl_comp_info WHERE comp_id='".$comp_id."'; ";

		$a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();

		$row_comp = $a_comp[0];

		$comp_name = addslashes($row_comp["comp_name"]);

		$comp_info = addslashes($row_comp["comp_info"]);

		$curr_id = $_POST['curr_id'];

		$quote_curr = $_POST['quote_curr'];

		$customer_type = $_POST["customer_type"];

		$sales_tax = $_POST["sales_tax"];
		$tax_id = $_POST["tax_id"];
		$allow_comm = $_POST['allow_comm'];
		$payment_term = addslashes($_POST["payment_term"]);



		$vat_value = $_POST["vat_value_app"];

		if(isset($_POST["inc_vat_app"])){

			$inc_vat = "yes";

		}else{

			$inc_vat = "no";

		}

		$note_text = addslashes($_POST["note_text"]);



		$sub_total = 0.0;

		

		$discount_percent = $_POST['discount_percent'];

		$actual_discount = $_POST['actual_discount'];



		for($i=0;$i<sizeof($_POST["qdoci_id"]);$i++){



			$qdoci_id = $_POST["qdoci_id"][$i];

			$pro_name = addslashes(rtrim($_POST["pro_name"][$i]));

			$pro_desc = addslashes($_POST["pro_desc"][$i]);

			$comm_percent = $_POST["app_comm_percent"][$i].'%';

			$qty = floatval($_POST["app_qty"][$i]);

			$uprice = floatval($_POST["app_uprice"][$i]);



			$amount = $qty*$uprice;

			$sub_total += $amount;



			$sql_update = "UPDATE tbl_quote_item SET pro_name='".$pro_name."',pro_desc='".$pro_desc."',qty='".intval($qty)."',uprice='".$uprice."',comm_percent='".$comm_percent."' WHERE qdoci_id='".$qdoci_id."'; ";



			Yii::app()->db->createCommand($sql_update)->execute();

		}

		

		//$sub_total = $sub_total-$actual_discount;



		if($inc_vat=="yes"){

			$grand_total = $sub_total-floatval($actual_discount)+floatval($vat_value);

		}else{

			$grand_total = $sub_total-floatval($actual_discount);

		}

		

		$approval_comment = addslashes($_POST["approval_comment"]);



		$sql_update2 = "UPDATE tbl_quote_doc SET comp_id='".$comp_id."',comp_name='".$comp_name."',curr_id='".$curr_id."',quote_curr='".$quote_curr."',comp_info='".$comp_info."',payment_term='".$payment_term."',inc_vat='".$inc_vat."',vat_value='".$vat_value."',discount_percent='".$discount_percent."',actual_discount='$actual_discount',conversion_status='2',cust_id='".$cust_id."',cust_name='".addslashes($cust_name)."',cust_info='".addslashes($cust_info)."',sub_total='".$sub_total."'";

		$sql_update2 .= ",grand_total='".$grand_total."',sales_tax='".$sales_tax."',customer_type='" . $customer_type . "',tax_id='".$tax_id."',approval_comment='".$approval_comment."',allow_comm='".$allow_comm."',note='".$note_text."',approve_status='approve',approve_date='".date("Y-m-d H:i:s")."' WHERE qdoc_id='".$qdoc_id."'; ";



		if(Yii::app()->db->createCommand($sql_update2)->execute()){
			$user_id = Yii::app()->user->getState('userKey');
		    $final_sql = "UPDATE quotation_data SET conv_status='2', conv_approve_by = '$user_id' WHERE qdoci_id='$qdoc_id'";

		    Yii::app()->db->createCommand($final_sql)->execute();

			$sql = "DELETE FROM tbl_quote_item WHERE qdoc_id='".$qdoc_id."' AND product_status='2'";

			Yii::app()->db->createCommand($sql)->execute();

			$a_result["result"] = "success";

		}else{

			$a_result["result"] = "fail";

			$a_result["msg"] = "Fail to approve.";

		}

		$this->UpdateCustomerTypeList($cust_id , $_POST['customer_type']) ;
		echo json_encode($a_result);



	

	}

	

	public function actionApproveQuote(){

		$qdoc_id = $_POST["qdoc_id"];

		$cust_id = $_POST["cust_selector"];

		$sql_cust = "SELECT * FROM tbl_cust_info WHERE cust_id='".$cust_id."'; ";

		$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();

		$row_cust = $a_cust[0];

		$cust_name = $row_cust["cust_name"];

		$cust_info = $row_cust["cust_info"];

		$customer_type = $_POST["customer_type"];

		$comp_id = $_POST["head_selector_app"];

		$sql_comp = "SELECT * FROM tbl_comp_info WHERE comp_id='".$comp_id."'; ";

		$a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();

		$row_comp = $a_comp[0];

		$comp_name = addslashes($row_comp["comp_name"]);

		$comp_info = addslashes($row_comp["comp_info"]);

		$curr_id = $_POST['curr_id'];
		$admin_private_notes = $_POST['admin_private_notes'];

		$quote_curr = $_POST['quote_curr'];

		$allow_comm = $_POST['allow_comm'];

		$payment_term = addslashes($_POST["payment_term"]);

		$sales_tax = $_POST["sales_tax"];
		$tax_id = $_POST["tax_id"];	
		
		$vat_value = $_POST["vat_value_app"];

		if(isset($_POST["inc_vat_app"])){

			$inc_vat = "yes";

		}else{

			$inc_vat = "no";

		}

		$note_text = addslashes($_POST["note_text"]);



		$sub_total = 0.0;

		

		$discount_percent = $_POST['discount_percent'];

		$actual_discount = $_POST['actual_discount'];



		for($i=0;$i<sizeof($_POST["qdoci_id"]);$i++){



			$qdoci_id = $_POST["qdoci_id"][$i];

			$pro_name = addslashes(rtrim($_POST["pro_name"][$i]));

			$pro_desc = addslashes($_POST["pro_desc"][$i]);

			$comm_percent = $_POST["app_comm_percent"][$i].'%';

			$qty = floatval($_POST["app_qty"][$i]);

			$uprice = floatval($_POST["app_uprice"][$i]);



			$amount = $qty*$uprice;

			$sub_total += $amount;



			$sql_update = "UPDATE tbl_quote_item SET pro_name='".$pro_name."',pro_desc='".$pro_desc."',qty='".intval($qty)."',uprice='".$uprice."',comm_percent='".$comm_percent."' WHERE qdoci_id='".$qdoci_id."'; ";



			Yii::app()->db->createCommand($sql_update)->execute();

		}

		

		//$sub_total = $sub_total-$actual_discount;



		if($inc_vat=="yes"){

			$grand_total = $sub_total-floatval($actual_discount)+floatval($vat_value);

		}else{

			$grand_total = $sub_total-floatval($actual_discount);

		}

		

		$approval_comment = addslashes($_POST["approval_comment"]);



		$sql_update2 = "UPDATE tbl_quote_doc SET comp_id='".$comp_id."',comp_name='".$comp_name."',curr_id='".$curr_id."',quote_curr='".$quote_curr."',comp_info='".$comp_info."',payment_term='".$payment_term."',inc_vat='".$inc_vat."',vat_value='".$vat_value."',discount_percent='".$discount_percent."',actual_discount='$actual_discount',cust_id='".$cust_id."',cust_name='".addslashes($cust_name)."',cust_info='".addslashes($cust_info)."',sub_total='".$sub_total."'";

		$sql_update2 .= ",grand_total='".$grand_total."',sales_tax='".$sales_tax."',customer_type='" . $customer_type . "',tax_id='".$tax_id."',approval_comment='".$approval_comment."',note='".$note_text."',admin_private_notes='".$admin_private_notes."',allow_comm='".$allow_comm."',approve_status='approve',approve_date='".date("Y-m-d H:i:s")."' WHERE qdoc_id='".$qdoc_id."'; ";



		if(Yii::app()->db->createCommand($sql_update2)->execute()){

			$sql = "DELETE FROM tbl_quote_item WHERE qdoc_id='".$qdoc_id."' AND product_status='2'";

			Yii::app()->db->createCommand($sql)->execute();

			$a_result["result"] = "success";

		}else{

			$a_result["result"] = "fail";

			$a_result["msg"] = "Fail to approve.";

		}



		$this->UpdateCustomerTypeList($cust_id , $_POST['customer_type']) ;
		echo json_encode($a_result);


	}

	

	public function actionShowQuoteViewAdminDraft(){

	    

		$qdoc_id = $_POST["qdoc_id"];

        $jog_code_main = $_POST['jog_code_main'];

		$sql_quote = "SELECT * FROM tbl_quote_doc_admin WHERE qdoc_id='".$qdoc_id."'; ";

		$a_quote = Yii::app()->db->createCommand($sql_quote)->queryAll();

		$row_quote = $a_quote[0];

		$comp_id = $row_quote["comp_id"];

		$admin_private_notes = $row_quote["admin_private_notes"];


		$action_from = $_POST["action_from"];



		$approve_status = $row_quote["approve_status"];



		$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='".$row_quote["curr_id"]."'; ";

		$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

		$row_curr = $a_curr[0];

		$pre_cost = $row_curr["curr_symbol"];

		

		$cur_sql = "SELECT * FROM tbl_currency";

    	$curr_query = Yii::app()->db->createCommand($cur_sql)->queryAll();

    	$select_html = '<select style="width:50px;" id="viewQuotationNewFinal" qdoc_id="'.$qdoc_id.'" action_from="'.$action_from.'")">';

		foreach($curr_query as $fetched){

		    $curr_select="";

		    if($fetched['curr_id']==$row_quote["curr_id"]){

		        $curr_select = "selected";

		    }

		    $select_html .="<option curr_symbol=".$fetched['curr_name']." value=".$fetched['curr_id']." $curr_select >".$fetched["curr_name"]." ".$fetched["curr_desc"]."</option>";

		}

		$select_html .='</select>';



		$sql_comp = "SELECT tbl_comp_info.comp_logo,tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.comp_id='".$comp_id."'; ";

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



		if($comp_logo!=""){

		    //$return_html .= '<img style="max-height: 180px; max-width: 180px;" src="https://'.$_SERVER['SERVER_NAME'].'/salesrep/images/'.$comp_logo.'" >';

		    $return_html .= '<img style="max-height: 180px; max-width: 180px;" src="'.Yii::app()->request->baseUrl.'/images/'.$comp_logo.'" >';

		}



	    

	    $return_html .= '</td>';

	    $return_html .= '<td style="width:50%; text-align:right;">';

	    $old_curr_id = $row_quote["curr_id"];

	    $return_html .= '<input type="hidden" value="'.$row_quote["curr_id"].'" id="old_curr_id">';

	    

	    $return_html .= '<input type="hidden" name="curr_id" value="'.$row_curr["curr_id"].'">';

	    $return_html .= '<input type="hidden" name="quote_curr" value="'.$row_curr["curr_name"].'">';

	    

	    $return_html .= '<h1 style="color:#000;">APPROVED ESTIMATE</h1>';

	    $return_html .= 'Payment Terms: ';



	    if($action_from=="va"){

		    $return_html .= '<select name="payment_term" id="edit_payment_term">';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Net 15")?"selected":"").' value="Net 15">Net 15</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Net 30")?"selected":"").' value="Net 30">Net 30</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Payment Due at Order Confirmation")?"selected":"").' value="Payment Due at Order Confirmation">Payment Due at Order Confirmation</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="50% Due At Order Confirmation. Balance Due At Delivery")?"selected":"").' value="50% Due At Order Confirmation. Balance Due At Delivery">50% Due At Order Confirmation. Balance Due At Delivery</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Balance Due before Ship Date")?"selected":"").' value="Balance Due before Ship Date">Balance Due before Ship Date</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="50% Down Payment. Balance Due Net 15")?"selected":"").' value="50% Down Payment. Balance Due Net 15">50% Down Payment. Balance Due Net 15</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="50% Down Payment. Balance Due at Delivery")?"selected":"").' value="50% Down Payment. Balance Due at Delivery">50% Down Payment. Balance Due at Delivery</option>';

	        $return_html .= '</select>';

	    }else{

	    	$return_html .= $row_quote["payment_term"];

	    }



	    $return_html .= '<pre style="width:100%;" id="pre_comp_info_app"><b>'.$row_quote["comp_name"].'</b><br>'.$row_quote["comp_info"].'</pre>';

	    $return_html .= '</td></tr><tr style="height:5px;"><td colspan="2"><hr></td></tr>';

		$return_html .= '<tr>';

		$return_html .= '<td style="text-align:left; padding:20px 0px;">';

		if($action_from=="va"){

		$return_html .= '<select id="cust_selector" name="cust_selector" onchange="return changeCustomerV2();"><option value="">=Select Customer=</option>';

		$user_group = Yii::app()->user->getState('userGroup');

		$user_id = Yii::app()->user->getState('userKey');



		$more_condition = "";

		if( $user_group!="1" && $user_group!="99" ){

		

			$more_condition = " AND user_id='".$user_id."' ";

		}

		$sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 ".$more_condition." ORDER BY cust_name ASC; ";

		$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();

		$custom_selector = "";

		foreach($a_cust as $tmp_key => $row_cust){

		    if($row_quote['cust_id']==$row_cust['cust_id']){

		        $custom_selector = "selected";

		    }

			$return_html .= '<option '.$custom_selector.' value="'.$row_cust["cust_id"].'">'.$row_cust["cust_name"].'</option>';

			$custom_selector = "";

		}

		$return_html .= '</select><pre id="pr_show_cust_info"></pre>';

		}

		$return_html .= '<div class="bill_to">BILL TO<br>'.$row_quote["cust_name"];

		$return_html .= '<pre>'.$row_quote["cust_info"].'</pre></div>';

		if($action_from!="va"){

        $return_html .= '<a href="#" onclick="edit_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Edit <span id="cus_namer_' . $row_quote["cust_id"] . '">' . $row_quote["cust_name"] . '</span></a><span style="display: inline-block; font-size: 1.5em; margin: 0 5px;">&bull;</span><a href="#" onclick="change_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Change Customer</a>';

		}
		if ($action_from == "va") {
			$return_html .= '
			<div>		
				<sapn class="bill_to">Sales Tax Exemption</span><br>		
				<select name="sales_tax" id="sales_tax">
					<option value="">Select Sales Tax</option>
					<option value="Exempt" ' . ($row_quote["sales_tax"] == "Exempt" ? 'selected' : '') . '>Exempt</option>
					<option value="Non Exempt" ' . ($row_quote["sales_tax"] == "Non Exempt" ? 'selected' : '') . '>Non Exempt</option>
				</select>
			</div>';	
		}
		if (!empty($row_quote["sales_tax"])) {
			$return_html .= '<br><sapn class="bill_to">Sales Tax Exemption</span><br>';
			$return_html .= '<pre>' . $row_quote["sales_tax"] . '</pre></div>';
		}
		$return_html .= '</td>';

		$return_html .= '<td padding:20px 0px;">';

		$return_html .= '<table  style="border-collapse: separate; border-spacing: 10px; color:#000;">';

		$return_html .= '<tr><th width="50%" style="text-align:right;">Estimate Number: </th><td style="color:#00F; text-align:left;" id="qdoc_number">'.$row_quote["est_number"].'</td></tr>';

		$return_html .= '<tr>';

		$return_html .= '<tr><th width="50%" style="text-align:right;">JOG Code: </th><td text-align:left;" id="jog_code">'.$jog_code_main.'</td></tr>';

		$return_html .= '<tr>';

		$return_html .= '<th style="text-align:right;">PO Number: </th>';

		$return_html .= '<td style="text-align:left;" id="po_number">';

		$return_html .= '<span id="sp_po_number'.$qdoc_id.'">'.$row_quote["po_number"].'</span> <i class="fa fa-pencil" style="cursor:pointer; font-size:16px; color:#00F;" onclick="return editPONumber('.$qdoc_id.');"></i>';

		$return_html .= '</td>';

		$return_html .= '</tr>';

		$return_html .= '<tr><th style="text-align:right;">Estimate Date: </th><td style="text-align:left;" id="show_est_date">'.date("F d, Y",strtotime($row_quote["est_date"])).'</td></tr>';

		$return_html .= '<tr><th style="text-align:right;">Expires On: </th><td style="text-align:left;" id="show_exp_date">'.date("F d, Y",strtotime($row_quote["exp_date"])).'</td></tr>';

		$return_html .= '<tr><th style="text-align:right;">Grand Total ('.$row_quote["quote_curr"].'): </th><td style="text-align:left;" id="td_grand_total_app">'.$pre_cost.number_format($row_quote["grand_total"],2).'</td></tr>';

		$return_html .= '</table>';

		$return_html .= '<input type="hidden" name="qdoc_id" id="qdoc_id" value="'.$qdoc_id.'">';

		$return_html .= '</td></tr>';

		$return_html .= '<tr><td colspan="2">';

		$return_html .= '<table style="color:#000; width:100%;" id="product_list">';

		$return_html .= '<tr style="font-size: 15px;"><th style="text-align:left;">Product</th>';



		if($action_from=="vc" || $action_from=="va"){

			$return_html .= '<th style="text-align:center; color:#999;">Comm.%</th><th style="text-align:center; color:#999;">Comm.</th>';

			$return_html .= '<th style="text-align:center; width:80px;">Quantity</th><th style="text-align:center; width:80px;">Price</th><th style="text-align:right; width:80px;">Amount</th><th style="text-align:right; width:10%"></th></tr>';

		}else{

			$return_html .= '<th style="text-align:center;">Quantity</th><th style="text-align:right; width:140px;">Price</th><th style="text-align:right; width:140px;">Amount</th></tr>';

		}


		$shipping = 0.0;
		$sql_qitem = "SELECT * FROM tbl_quote_item_admin WHERE qdoc_id='".$qdoc_id."' AND enable=1 AND product_status='1' ORDER BY sort ASC; ";

		$a_qitem = Yii::app()->db->createCommand($sql_qitem)->queryAll();

		$sql = "SELECT * FROM `tbl_quote_item` WHERE `qdoc_id` = '$qdoc_id' AND enable='1' AND (`pro_name` LIKE '%Royalty%' OR `pro_name` LIKE '%Credit Card%' OR `pro_name` LIKE '%Shipping%')";
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



		foreach( $a_qitem as $tmp_key => $row_qitem ){



			$pro_id = $row_qitem["pro_id"];

			$qty = $row_qitem["qty"];

			$uprice = $row_qitem["uprice"];

			$comm_percent = $row_qitem["comm_percent"];
			$qdoci_id = $row_qitem["qdoci_id"];
			$comm_value = "";

			$tmp_comm_percent = 0;

			if($comm_percent!=""){

				$tmp_comm_percent = intval(str_replace("%", "", $comm_percent));

				$comm_value = ($qty*$uprice)*($tmp_comm_percent/100);

				$comm_total += $comm_value;

			}


			$sql = "SELECT * FROM `tbl_quote_item` WHERE `qdoci_id` = '$qdoci_id' AND enable='1' AND (`pro_name` LIKE '%Royalty%' OR `pro_name` LIKE '%Credit Card%' OR `pro_name` LIKE '%Shipping%')";
			$shipp = Yii::app()->db->createCommand($sql)->queryAll();

			$shippcount= count($shipp);
			$tmp_amount = $qty*$uprice;



			$return_html .= '<tr><td style="padding:10px 0px; text-align:left; display: block; white-space: pre-wrap; word-break: break-all; word-wrap: break-word;">';

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



			if($action_from=="va"){

				$return_html .= '<input type="hidden" name="qdoci_id[]" value="'.$row_qitem["qdoci_id"].'">';

				$return_html .= '<input style="width:100%; font-weight:bold;" type="text" name="pro_name[]" value="'.htmlspecialchars($row_qitem["pro_name"]).'">';

				$return_html .= '<br><textarea style="width:100%; min-height:70px;" name="pro_desc[]">'.$row_qitem["pro_desc"].'</textarea>';

				if($row_qitem["addi_desc"]!=""){

					$return_html .= $row_qitem["addi_desc"];

				}

			}else{

				$return_html .= '<b>'.htmlspecialchars($row_qitem["pro_name"]).'</b><br>'.$row_qitem["pro_desc"];

			}



			$return_html .= '</td>';



			if($action_from=="vc"){



				$return_html .= '<td style="text-align:center; color:#999;">'.(($tmp_comm_percent!=0)?($tmp_comm_percent."%"):"0%");

				if( $user_group=="1" || $user_group=="99" ){

					$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editCommAfterApprove(\''.$qdoc_id.'\',\''.$row_qitem["qdoci_id"].'\',\''.$tmp_comm_percent.'\');"></i>';

				}

				



				$return_html .= '</td>';

				$return_html .= '<td style="text-align:center; color:#999;">'.(($comm_value!="")?number_format($comm_value,2):"0").'</td>';



			}else if($action_from=="va"){



				$return_html .= '<td style="text-align:center; color:#999;"><input type="hidden" value="'.$row_qitem["qdoci_id"].'" class="qdoci_id_app">';

				$return_html .= '<input type="hidden" value="'.$tmp_amount.'" id="tmp_amount'.$row_qitem["qdoci_id"].'">';

				$return_html .= '<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width:60px; text-align:center;" min="0" type="number" value="'.$tmp_comm_percent.'" id="comm_percent_app'.$row_qitem["qdoci_id"].'"></td>';

				$return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app'.$row_qitem["qdoci_id"].'">'.(($comm_value!="")?number_format($comm_value,2):"").'</td>';



			}

			$return_html .= '<td style="text-align:center;">';

			if($action_from=="va"){

				$return_html .= '<input name="app_qty[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:55px; text-align:center;" min="0" type="number" value="'.$qty.'" id="app_qty'.$row_qitem["qdoci_id"].'">';

			}else{

				$return_html .= number_format($qty,0);

			}

			$return_html .= '</td>';

			

			$return_html .= '<td style="text-align:right;">';

			if($action_from=="va"){

				$return_html .= '<input name="app_uprice[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:70px; text-align:center;" min="0.00" type="number" value="'.$uprice.'" id="app_uprice'.$row_qitem["qdoci_id"].'">';

			}else if( $action_from=="vc" && ($user_group=="1" || $user_group=="99") ){

				$return_html .= $pre_cost.number_format($uprice,2);



				$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editUPriceAfterApprove(\''.$qdoc_id.'\',\''.$row_qitem["qdoci_id"].'\',\''.$uprice.'\');"></i>';



			}else{

				$return_html .= $pre_cost.number_format($uprice,2);

			}

			$return_html .= '</td><td style="text-align:center;">'.$pre_cost.'<span class="shippcount'.$shippcount.'" id="sp_app_amount'.$row_qitem["qdoci_id"].'">';



			if($action_from=="va"){

				$return_html .= $tmp_amount;

			}else{

				$return_html .= number_format($tmp_amount,2);

			}



			$return_html .= '</span></td>';



			if($action_from=="va"){

				$return_html .= '<td style="text-align:center;cursor:pointer;" class="remover" qdoci_id="'.$row_qitem['qdoci_id'].'"><i style="color:red;" class="fa fa-minus-circle"></i></td>';

			}



			$return_html .='</tr>';



			//$sub_total += $tmp_amount;

		}



		$col_span = 4;

		$col_span2 = 2;

		if($action_from=="vc" || $action_from=="va"){

			$col_span = 6;

			$col_span2 = 4;

		}

		$return_html .= '<tr><td colspan="'.$col_span.'" style="padding:0px;"><hr style="margin:0px;"></td></tr>';



		

		

		$vat_7percent = ($sub_total-$row_quote['actual_discount'])*0.07;



		$f_total = 0.0;

		if($row_quote["inc_vat"]=="yes" || $action_from=="va" || $action_from=="vb"){

            if($action_from!="vp"){

			$return_html .= '<tr><td colspan="2"><span qdoc_id="'.$qdoc_id.'" class="btn btn-success add_row" style="padding:5px;">Add Row  <i class="fa fa-plus" aria-hidden="true"></i></span></td>';

            }

			if($action_from=="vc" || $action_from=="va"){

				$return_html .= '<td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">'.number_format($comm_total,2).'</td><td>&nbsp;</td>';

			}

            $colspaner = '';

            $colspaner_1 = '';

            if($action_from=="vp"){

                $colspaner = "colspan='3'";

                $colspaner_1 = "colspan='1'";

            }

			$return_html .= '<th '.$colspaner.' style="padding: 10px 0px; text-align:right;">Subtotal:</th>';

			$return_html .= '<td '.$colspaner_1.' style="padding: 10px 0px; text-align:right;">'.$pre_cost.'<span id="sp_app_sub_total">'.$sub_total.'</span></td></tr>';



			if($row_quote["inc_vat"]=="yes"){

				$f_total = ($sub_total-$row_quote['actual_discount'])+$vat_7percent;

			}else{

				$f_total = $sub_total-$row_quote['actual_discount'];

			}

			if($action_from!="vp"){

			

    			if ($row_quote["design_url"]!="" || $row_quote["design_url"]!=NULL) {

    				$return_html .= "<input type='hidden' id='tr_total' value='1'>";

    				$return_html .="<tr><th>Design URL</th></tr>";

    				$return_html .="<tr><td class='alert alert-success'><a style='color:white;' href=".$row_quote["design_url"].">".$row_quote["design_url"]."</a></td></tr>";

    			}

    			

    			$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Change Currency:</th><td style="padding: 10px 0px; text-align:right;"><span>'.$select_html.'</span></td></tr>';

    			

    			$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="discount_percent" class="number_disc_approval" data-shipp="'.$shipping.'" value="'.$row_quote['discount_percent'].'" style="width:55px;"></span></td></tr>';

			

			    $return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="actual_discount" id="actual_disc_approval" data-shipp="'.$shipping.'" value="'.$row_quote['actual_discount'].'" style="width:55px;"></span></td></tr>';

		    }



			$return_html .= "<input type='hidden' id='tr_total' value='0'>";

			

			if($action_from=="vp" && $row_quote['actual_discount']!="0"){

			    $return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>'.$row_quote['discount_percent'].'%</span></td></tr>';

			

			    $return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>'.$pre_cost.number_format($row_quote['actual_discount'],2).'</span></td></tr>';

			}

			



			$return_html .= '<tr ><td rowspan="3" colspan="'.$col_span2.'">';

			if($row_quote["sale_note"]!="" && ($action_from=="va" || $action_from=="vb") ){

				$return_html .= 'Salesman Notes (<font color=red>Not shown in Quotation</font>)';

				if($action_from=="vb"){

					$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_edit_sale_note" style="background-color:#DDD;" onclick="return editSaleNote('.$qdoc_id.');"><i class="fa fa-pencil" style="color:#00F;"></i> Edit</button>';

					$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_save_sale_note" style="background-color:#FFF;" disabled onclick="return saveSaleNote('.$qdoc_id.');"><i class="fa fa-floppy-o" style="color:#070;"></i> Save</button>';

				}

				

				$return_html .= '<br><pre class="alert alert-success" style="width:100%; height:100%; max-width:700px; overflow-x:auto;" id="pre_sale_note'.$qdoc_id.'">'.$row_quote["sale_note"].'</pre>';

			}else{

				$return_html .= '&nbsp;';

			}



			if($action_from=="va"){

				$return_html .= 'Comment (<font color=red>Not shown in Quotation and appear on the top after Approve or Reject.</font>)';

				$return_html .= '<div style="text-align:left;">';

				$return_html .= '<textarea name="approval_comment" id="approval_comment" style="width: 700px; height: 100px; min-height: 101px; margin: 3px;"></textarea>';

				$return_html .= '</div>';

			}
			if($action_from=="va" && ($user_group == "1" || $user_group == "99")){

				$return_html .= 'Private Notes  (<font color=red>Private notes only for admin.</font>)';

				$return_html .= '<div style="text-align:left;">';

				$return_html .= '<textarea name="admin_private_notes" id="admin_private_notes" style="width: 700px; height: 100px; min-height: 101px; margin: 3px;">'.$admin_private_notes.'</textarea>';

				$return_html .= '</div>';

			}



			$return_html .= '</td>';

			$return_html .= '<td style="padding: 10px 0px; text-align:right;">';

			$return_html .= '<input type="hidden" id="sub_total_app" value="'.$sub_total.'">';

			$return_html .= '<input type="hidden" id="pre_cost_app" value="'.$pre_cost.'">';

			$return_html .= '<input type="hidden" name="vat_value_app" id="vat_value_app" value="'.$vat_7percent.'">';

			$return_html .= '<input type="hidden" id="total_value_app" value="'.$f_total.'">';



			

			

			if($row_quote["approve_status"]=="new" && ( $user_group=="1" || $user_group=="99" ) ){

				$return_html .= '<span class="subnvat"><input type="checkbox" name="inc_vat_app" id="inc_vat_app" value="yes" onclick="changeIncludeVATApprove();" ';

				if($row_quote["inc_vat"]=="yes"){

					$return_html .= 'checked';

				}

				$return_html .= '>';

			}

			$return_html .= ' VAT 7%:</span></td>';

			$return_html .= '<td style="padding: 10px 0px; text-align:right;"><span class="subnvat" id="sp_show_vat_value_app">';

			if($row_quote["inc_vat"]=="yes"){

				$return_html .= $pre_cost.number_format($vat_7percent,2);

			}

			$return_html .= '</span></td></tr>';



			$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Total:</span></th>';

			$return_html .= '<td style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat" id="sp_show_total_value_app">'.$pre_cost.number_format($f_total,2).'</span></td></tr>';

			

			

			$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total ('.$row_quote["quote_curr"].'):</th>';

			$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="'.$pre_cost.'">'.$pre_cost.number_format($f_total,2).'</span></th></tr>';

		

		}else{

			//$f_total = $sub_total;

            $f_total = $row_quote["grand_total"];

			$return_html .= '<tr ><td>&nbsp;</td>';

			$colspan_grand = "colspan='2'";

			if($action_from=="vc" || $action_from=="va"){

				$return_html .= '<td>&nbsp;</td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">'.number_format($comm_total,2).'</td>';

			}

			if($action_from=="vp" && $row_quote['actual_discount']!="0"){

			    $return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>'.$row_quote['discount_percent'].'%</span></td></tr>';

			

			    $return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>'.$pre_cost.number_format($row_quote['actual_discount'],2).'</span></td></tr>';

			    $colspan_grand = "colspan='3'";

			}

			$return_html .= '<th '.$colspan_grand.' style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total ('.$row_quote["quote_curr"].'):</th>';

			$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="'.$pre_cost.'">'.$pre_cost.number_format($f_total,2).'</span></th></tr>';

		}



		



		$return_html .= '</table>';

		$return_html .= '</td></tr>';



		$return_html .= '</table>';



		if($action_from!="va" && $row_quote["note"]!=""){

			$return_html .= '<b>Notes</b> ';

			$return_html .= '<pre ';

			if($row_quote["approve_status"]=="reject"){

				$return_html .= ' class="alert alert-dark" ';

			}

			$return_html .= '>'.$row_quote["note"].'</pre>';

		}

		if ($action_from!="va" && $row_quote["admin_private_notes"]!="" && ($user_group == "1" || $user_group == "99")) {
			$return_html .= 'Private Notes  (<font color=red>Private notes only for admin.</font>)';			
			$return_html .= '<pre>'.$admin_private_notes.' </pre>';
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

		if($row_quote["approval_comment"]!=""){

			$a_result["approval_comment"] = base64_encode('<div><center><pre class="alert" style="text-align:left; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;" id="approval_comment'.$qdoc_id.'">'.$row_quote["approval_comment"].'</pre></center></div>');

		}



		if($approve_status=="new"){



			$a_result["show_approve"] = "yes";

			$a_result["show_reject"] = "yes";



			if($row_quote["history_qdoc_id"]!=""){



				$a_result["history_inner"] .= '<option value="'.$qdoc_id.'">==Main Document==</option>'; 



				$sql_history = "SELECT qdoc_id,add_date FROM tbl_quote_doc_admin WHERE qdoc_id IN (".rtrim($row_quote["history_qdoc_id"],',').") ORDER BY add_date DESC; ";

				//$a_result["history_inner"] .= $sql_history;

				$a_history = Yii::app()->db->createCommand($sql_history)->queryAll();

				foreach($a_history as $tmp_key_his => $row_history){

					$a_result["history_inner"] .= '<option value="'.$row_history["qdoc_id"].'">'.$row_history["add_date"].'</option>'; 

				}

				

			}

			

		}else if($approve_status=="approve"){



			$a_result["show_print"] = "yes";



		}

		

		if($action_from=="va"){

		    $a_result["show_approve"] = "yes";

			$a_result["show_reject"] = "yes";

			$a_result["show_print"] = "yes";

		}

		

		$a_result['note_text'] = $row_quote["note"];



		echo json_encode($a_result);



	

	}
	
	public function actionSplitcomm()
	{
		$sale1= $_POST['sales_rep_1'];
		$sale2= $_POST['sales_rep_2'];
		$split_comm_percent1= $_POST['split_comm_percent1'];
		$split_comm_percent2= $_POST['split_comm_percent2'];
		$qdoci_id= $_POST['qdoci_id'];

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

	

	public function actionShowQuoteView(){

		$user_group = Yii::app()->user->getState('userGroup');

		$qdoc_id = isset($_POST["qdoc_id"]) ? $_POST["qdoc_id"] : '';

        $jog_code_main = isset($_POST['jog_code_main']) ? $_POST['jog_code_main'] : '';

		$sql_quote = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='".$qdoc_id."'; ";

		$a_quote = Yii::app()->db->createCommand($sql_quote)->queryAll();

		$row_quote = $a_quote[0];

		$comp_id = $row_quote["comp_id"];

		$admin_private_notes = $row_quote["admin_private_notes"];

		$action_from = isset($_POST["action_from"]) ? $_POST["action_from"] : '';



		$approve_status = $row_quote["approve_status"];



		$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='".$row_quote["curr_id"]."'; ";

		$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

		$row_curr = $a_curr[0];

		$pre_cost = $row_curr["curr_symbol"];

		

		$cur_sql = "SELECT * FROM tbl_currency";

    	$curr_query = Yii::app()->db->createCommand($cur_sql)->queryAll();

    	$select_html = '<select style="width:50px;" id="viewQuotationNewFinal" qdoc_id="'.$qdoc_id.'" action_from="'.$action_from.'")">';

		foreach($curr_query as $fetched){

		    $curr_select="";

		    if($fetched['curr_id']==$row_quote["curr_id"]){

		        $curr_select = "selected";

		    }

		    $select_html .="<option curr_symbol=".$fetched['curr_name']." value=".$fetched['curr_id']." $curr_select >".$fetched["curr_name"]." ".$fetched["curr_desc"]."</option>";

		}

		$select_html .='</select>';



		$sql_comp = "SELECT tbl_comp_info.comp_logo,tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.comp_id='".$comp_id."'; ";

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



		if($comp_logo!=""){

		    //$return_html .= '<img style="max-height: 180px; max-width: 180px;" src="https://'.$_SERVER['SERVER_NAME'].'/salesrep/images/'.$comp_logo.'" >';

		    $return_html .= '<img style="max-height: 180px; max-width: 180px;" src="'.Yii::app()->request->baseUrl.'/images/'.$comp_logo.'" >';

		}



	    

	    $return_html .= '</td>';

	    $return_html .= '<td style="width:50%; text-align:right;">';

	    $old_curr_id = $row_quote["curr_id"];

	    $return_html .= '<input type="hidden" value="'.$row_quote["curr_id"].'" id="old_curr_id">';

	    

	    $return_html .= '<input type="hidden" name="curr_id" value="'.$row_curr["curr_id"].'">';

	    $return_html .= '<input type="hidden" name="quote_curr" value="'.$row_curr["curr_name"].'">';

	    

	    $return_html .= '<h1 style="color:#000;">QUOTATION</h1>';

	    $return_html .= 'Payment Terms: ';



	    if($action_from=="va"){

		    $return_html .= '<select name="payment_term" id="edit_payment_term">';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Net 15")?"selected":"").' value="Net 15">Net 15</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Net 30")?"selected":"").' value="Net 30">Net 30</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Payment Due at Order Confirmation")?"selected":"").' value="Payment Due at Order Confirmation">Payment Due at Order Confirmation</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="50% Due At Order Confirmation. Balance Due At Delivery")?"selected":"").' value="50% Due At Order Confirmation. Balance Due At Delivery">50% Due At Order Confirmation. Balance Due At Delivery</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Balance Due before Ship Date")?"selected":"").' value="Balance Due before Ship Date">Balance Due before Ship Date</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="50% Down Payment. Balance Due Net 15")?"selected":"").' value="50% Down Payment. Balance Due Net 15">50% Down Payment. Balance Due Net 15</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="50% Down Payment. Balance Due at Delivery")?"selected":"").' value="50% Down Payment. Balance Due at Delivery">50% Down Payment. Balance Due at Delivery</option>';

	        $return_html .= '</select>';

	    }else{

	    	$return_html .= $row_quote["payment_term"];

	    }



	    $return_html .= '<pre style="width:100%;" id="pre_comp_info_app"><b>'.$row_quote["comp_name"].'</b><br>'.$row_quote["comp_info"].'</pre>';

	    $return_html .= '</td></tr><tr style="height:5px;"><td colspan="2"><hr></td></tr>';

		$return_html .= '<tr>';

		$return_html .= '<td style="text-align:left; padding:20px 0px;">';

		if($action_from=="va"){

		$return_html .= '<select id="cust_selector" name="cust_selector"  class="customer_select_for_quotation"  onchange="return changeCustomerV2();"><option value="">=Select Customer=</option>';

		$user_group = Yii::app()->user->getState('userGroup');

		$user_id = Yii::app()->user->getState('userKey');



		$more_condition = "";

		if( $user_group!="1" && $user_group!="99" ){

		

			$more_condition = " AND user_id='".$user_id."' ";

		}
		if ($row_quote["est_date"] >= '2025-02-12') {
			$more_condition = " AND add_date >= '2025-02-12'";
		}else {
			$more_condition = " AND add_date <= '2025-02-12'";				
		}
		$sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 ".$more_condition." ORDER BY cust_name ASC; ";

		$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();

		$custom_selector = "";

		foreach($a_cust as $tmp_key => $row_cust){

		    if($row_quote['cust_id']==$row_cust['cust_id']){

		        $custom_selector = "selected";

		    }

			$return_html .= '<option '.$custom_selector.' value="'.$row_cust["cust_id"].'">'.$row_cust["cust_name"].'</option>';

			$custom_selector = "";

		}

		$return_html .= '</select><pre id="pr_show_cust_info"></pre>';

		}

		if ($user_group == "1" || $user_group == "99") {

			$sql_state = "SELECT DISTINCT billing_state FROM tbl_cust_info ORDER BY billing_state; ";
			$states = Yii::app()->db->createCommand($sql_state)->queryAll();
			
			$billing_state = '<br><span class="locatonhead" >Location (hidden)</span><select id="billing_state" name="billing_state" class="form-control" style="margin: 0px;">';    		
			$billing_state .= '<option value="">Select State</option>';
			foreach ($states as $state) {
				$selected = ($state['billing_state'] == $row_quote["billing_state"]) ? 'selected' : '';
				$billing_state .= '<option value="' . $state['billing_state'] . '" ' . $selected . '>' . $state['billing_state'] . '</option>';
			}
			$billing_state .= '</select>';

		}else {
			$billing_state = '';
		}

		$return_html .= '<div class="bill_to">BILL TO<br>'.$row_quote["cust_name"];

		$return_html .= '<pre>' . $row_quote["cust_info"] . ' '.$billing_state.' ' . ($row_quote["tax_id"] == "" ? '' : '</br><b>TAX ID : </b><span id="tax_id_preview">' . $row_quote["tax_id"] . '</span>') . ' </pre>';
		
		$return_html .='</div>';
		

		if($action_from!="va"){

        $return_html .= '<a href="#" onclick="edit_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Edit <span id="cus_namer_' . $row_quote["cust_id"] . '">' . $row_quote["cust_name"] . '</span></a><span style="display: inline-block; font-size: 1.5em; margin: 0 5px;">&bull;</span><a href="#" onclick="change_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Change Customer</a>';

		}

		if ($action_from == "va") {
			$return_html .= '<div id="tax_id_fortax">
								<label for="salestax">Tax ID</label><br> 
								<input type="text" name="tax_id" id="add_tax_id" value="'. $row_quote["tax_id"] .'" style="width:50%">
							</div>';
			$return_html .= '
			<div style="margin-top:10px;">			
				<sapn >Sales Tax Exemption</span><br>		
				<select name="sales_tax" id="sales_tax">
					<option value="">Select Sales Tax</option>
					<option value="Exempt" ' . ($row_quote["sales_tax"] == "Exempt" ? 'selected' : '') . '>Exempt</option>
					<option value="Non Exempt" ' . ($row_quote["sales_tax"] == "Non Exempt" ? 'selected' : '') . '>Non Exempt</option>
				</select>
			</div>';
			$return_html .= '
			<div style="margin-top:15px;">
				<label for="salestax">Customer Type</label><br> 						
				<select name="customer_type" id="customer_type" style="margin:0px;">
					<option value="">Select Customer Type</option>					
					<option value="College Retail - Bookstore" ' . ($row_quote["customer_type"] == "College Retail - Bookstore" ? 'selected' : '') . '>College Retail - Bookstore</option>
					<option value="Dealer" ' . ($row_quote["customer_type"] == "Dealer" ? 'selected' : '') . '>Dealer</option>
					<option value="Factory Direct Customers" ' . ($row_quote["customer_type"] == "Factory Direct Customers" ? 'selected' : '') . '>Factory Direct Customers</option>
					<option value="International Sales" ' . ($row_quote["customer_type"] == "International Sales" ? 'selected' : '') . '>International Sales</option>
					<option value="Online Stores Collegiate" ' . ($row_quote["customer_type"] == "Online Stores Collegiate" ? 'selected' : '') . '>Online Stores Collegiate</option>
					<option value="Online Spirit Stores" ' . ($row_quote["customer_type"] == "Online Spirit Stores" ? 'selected' : '') . '>Online Spirit Stores</option>
					<option value="Private Label Companies" ' . ($row_quote["customer_type"] == "Private Label Companies" ? 'selected' : '') . '>Private Label Companies</option>
					<option value="Sales Direct Hockey Related - Youth, High School" ' . ($row_quote["customer_type"] == "Sales Direct Hockey Related - Youth, High School" ? 'selected' : '') . '>Sales Direct Hockey Related - Youth, High School</option>
					<option value="Sales Direct College & Juniors" ' . ($row_quote["customer_type"] == "Sales Direct College & Juniors" ? 'selected' : '') . '>Sales Direct College & Juniors</option>
					<option value="Sales Direct to Business Camps, Misc." ' . ($row_quote["customer_type"] == "Sales Direct to Business Camps, Misc." ? 'selected' : '') . '>Sales Direct to Business Camps, Misc.</option>
					<option value="Sales Direct - Other Sports" ' . ($row_quote["customer_type"] == "Sales Direct - Other Sports" ? 'selected' : '') . '>Sales Direct - Other Sports</option>
					<option value="Sales Direct - Adult Hockey Teams/Leagues" ' . ($row_quote["customer_type"] == "Sales Direct - Adult Hockey Teams/Leagues" ? 'selected' : '') . '>Sales Direct - Adult Hockey Teams/Leagues</option>				
				</select>
			</div>';				
		}else{		
			$return_html .= '<div style="display: flex;justify-content: space-between; ">';		
				if (!empty($row_quote["sales_tax"])) {
					$return_html .= '<div><sapn>Sales Tax Exemption</span>';
					$return_html .= '<pre id="sales_tax_preview">' . $row_quote["sales_tax"] . '</pre></div>';
				}	
				$return_html .= '<div class="college_name_div" style="width: 50%;">';
					$sql_state_com = "SELECT * FROM `quotation_data` WHERE `qdoci_id` = '".$qdoc_id."'; ";
					$states_com = Yii::app()->db->createCommand($sql_state_com)->queryAll();
					foreach ($states_com as $states_co) {
						if ($states_co['collegiate'] == 1) {
							$return_html .= $states_co['college_name'];
							if ($states_co['licensing_company'] != 0) {
								$return_html .=  "<span>Licensing Company</span>";
							}
							if ($states_co['royalty_bearing'] != 0) {
								$return_html .= "<span>Royalty Bearing</span>";
							}
							if ($states_co['non_royalty_bearing'] != 0) {
								$return_html .= "<span>Non Royalty Bearing</span>";
							}
							if ($states_co['no_report'] != 0) {
								$return_html .= "<span>No Report/Non Licensed</span>";
							}
						}

					}
				
				$return_html .= '</div>';
			$return_html .= '</div>';

			if (!empty($row_quote["customer_type"])) {
				$return_html .= '<div><sapn>Customer Type</span>';
				$return_html .= '<pre id="customer_type_preview">' . $row_quote["customer_type"] . '</pre></div>';
			}	
		}

		
		
		$return_html .= '</td>';

		$return_html .= '<td padding:20px 0px;">';

		$return_html .= '<table  style="border-collapse: separate; border-spacing: 10px; color:#000;justify-content: right;display: flex;">';

		$return_html .= '<tr><th width="50%" style="text-align:right;">Quotation Number: </th><td style="color:#00F; text-align:left;" id="qdoc_number">'.$row_quote["est_number"].'Q</td></tr>';

		$return_html .= '<tr>';

		$return_html .= '<tr><th width="50%" style="text-align:right;">JOG Code: </th><td text-align:left;" id="jog_code">'.$jog_code_main.'</td></tr>';

		$return_html .= '<tr>';

		$return_html .= '<th style="text-align:right;">PO Number: </th>';

		$return_html .= '<td style="text-align:left;" id="po_number">';

		$return_html .= '<span id="sp_po_number'.$qdoc_id.'">'.$row_quote["po_number"].'</span> <i class="fa fa-pencil" style="cursor:pointer; font-size:16px; color:#00F;" onclick="return editPONumber('.$qdoc_id.');"></i>';

		$return_html .= '</td>';

		$return_html .= '</tr>';

		$return_html .= '<tr><th style="text-align:right;">Estimate Date: </th><td style="text-align:left;" id="show_est_date">'.date("F d, Y",strtotime($row_quote["est_date"])).'</td></tr>';

		$return_html .= '<tr><th style="text-align:right;">Due Date: </th><td style="text-align:left;" id="show_exp_date">'.date("F d, Y",strtotime($row_quote["exp_date"])).'</td></tr>';

		$return_html .= '<tr><th style="text-align:right;">Grand Total ('.$row_quote["quote_curr"].'): </th><td style="text-align:left;" id="td_grand_total_app">'.$pre_cost.number_format($row_quote["grand_total"],2).'</td></tr>';

		$return_html .= '</table>';

		$return_html .= '<input type="hidden" name="qdoc_id" id="qdoc_id" value="'.$qdoc_id.'">';

		$return_html .= '</td></tr>';

		$return_html .= '<tr><td colspan="2">';

		$return_html .= '<table style="color:#000; width:100%;" id="product_list">';

		$return_html .= '<tr style="font-size: 15px;"><th style="text-align:left;">Product</th>';



		if($action_from=="vc" || $action_from=="va"){

			$user_group = Yii::app()->user->getState('userGroup');
			$return_html .= '<th style="text-align:center; color:#999;">Comm.%</th><th style="text-align:center; color:#999;position: relative;">Comm.';
			if($user_group == "1" || $user_group == "99"){
				$return_html .= '<input type="checkbox" name="allow_comm" '. (($row_quote["allow_comm"] == 'on') ? "checked": "").' style="width: 14px;position: absolute;right: 2px;top: 5px;">';
			}
			$return_html .= '</th>';

			$return_html .= '<th style="text-align:center; width:80px;">Quantity</th><th style="text-align:center; width:80px;">Price</th><th style="text-align:right; width:80px;">Amount</th><th style="text-align:right; width:10%"></th></tr>';

		}else{

			$return_html .= '<th style="text-align:center;">Quantity</th><th style="text-align:right; width:140px;">Price</th><th style="text-align:right; width:140px;">Amount</th></tr>';

		}


		$shipping = 0.0;
		$sql_qitem = "SELECT * FROM tbl_quote_item WHERE qdoc_id='".$qdoc_id."' AND enable=1 AND product_status='1' ORDER BY sort ASC; ";

		$a_qitem = Yii::app()->db->createCommand($sql_qitem)->queryAll();

		$sql = "SELECT * FROM `tbl_quote_item` WHERE `qdoc_id` = '$qdoc_id' AND enable='1' AND (`pro_name` LIKE '%Royalty%' OR `pro_name` LIKE '%Credit Card%' OR `pro_name` LIKE '%Shipping%')";
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



		foreach( $a_qitem as $tmp_key => $row_qitem ){



			$pro_id = $row_qitem["pro_id"];

			$qty = $row_qitem["qty"];

			$uprice = $row_qitem["uprice"];

			$comm_percent = $row_qitem["comm_percent"];

			$comm_value = "";

			$tmp_comm_percent = 0;

			if($comm_percent!=""){

				$tmp_comm_percent = intval(str_replace("%", "", $comm_percent));

				$comm_value = ($qty*$uprice)*($tmp_comm_percent/100);

				$comm_total += $comm_value;

			}



			$tmp_amount = $qty*$uprice;



			$return_html .= '<tr><td style="padding:10px 0px; text-align:left; display: block; white-space: pre-wrap; word-break: break-all; word-wrap: break-word;">';

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



			if($action_from=="va"){

				$return_html .= '<input type="hidden" name="qdoci_id[]" value="'.$row_qitem["qdoci_id"].'">';

				$return_html .= '<input style="width:100%; font-weight:bold;" type="text" name="pro_name[]" value="'.htmlspecialchars($row_qitem["pro_name"]).'">';

				$return_html .= '<br><textarea style="width:100%; min-height:70px;" id="pro_desc'.$row_qitem["qdoci_id"].'" class="ckeditorquview" name="pro_desc[]">'.$row_qitem["pro_desc"].'</textarea>';

				if($row_qitem["addi_desc"]!=""){

					$return_html .= $row_qitem["addi_desc"];

				}

			}else{

				$return_html .= '<b>'.htmlspecialchars($row_qitem["pro_name"]).'</b><br>'.$row_qitem["pro_desc"];

			}



			$return_html .= '</td>';



			if($action_from=="vc"){
				

				if( $user_group=="1" || $user_group=="99" ){

					$sql_user = "SELECT * FROM `user` WHERE `user_group_id` = 2 AND `enable` = 1 AND `id` NOT IN (29, 73, 76) AND `fullname` NOT IN ('Jim', 'Lucas Trickle', 'Matt Carey', 'Mike Nightingale', 'Shane Hiley', 'Trevor Easthope') ORDER BY fullname ASC;";

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
					$return_html .= '<spen id="split" class="splitform ' . $splitclass . '" onclick="return formsplit(' . $row_qitem["qdoci_id"] . ');"><i class="fa fa-exchange" aria-hidden="true"></i> Split </spen>
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
				
				//$return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app' . $row_qitem["qdoci_id"] . '">' . (($comm_value != "") ? number_format($comm_value, 2) : "0") . '';
				$return_html .= '<td style="text-align:center; color:#999;" 
                    id="comm_val_app' . $row_qitem["qdoci_id"] . '" 
                    class="comm_val_est" 
                    data-comm-valueest="' . (($comm_value != "") ? $comm_value : "0") . '">'
                    . (($row_quote["allow_comm"] == 'on')
                        ? (($comm_value != "") ? number_format($comm_value, 2) : "0") 
                        : "0")
                . '</td>';
				



				// $return_html .= '</td>';

				// $return_html .= '<td style="text-align:center; color:#999;">'.(($comm_value!="")?number_format($comm_value,2):"0").'</td>';





				// $return_html .= '<td style="text-align:center; color:#999;">'.(($tmp_comm_percent!=0)?($tmp_comm_percent."%"):"0%");

				// if( $user_group=="1" || $user_group=="99" ){

				// 	$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editCommAfterApprove(\''.$qdoc_id.'\',\''.$row_qitem["qdoci_id"].'\',\''.$tmp_comm_percent.'\');"></i>';

				// }

				



				// $return_html .= '</td>';

				// $return_html .= '<td style="text-align:center; color:#999;">'.(($comm_value!="")?number_format($comm_value,2):"0").'</td>';



			}else if($action_from=="va"){



				if ($user_group == "1" || $user_group == "99") {
					$sql_user = "SELECT * FROM `user` WHERE `user_group_id` = 2 AND `enable` = 1 AND `id` NOT IN (29, 73, 76) AND `fullname` NOT IN ('Jim', 'Lucas Trickle', 'Matt Carey', 'Mike Nightingale', 'Shane Hiley', 'Trevor Easthope') ORDER BY fullname ASC;";

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
					$return_html .= '<spen id="split" class="splitform ' . $splitclass . '" onclick="return formsplit(' . $row_qitem["qdoci_id"] . ');"><i class="fa fa-exchange" aria-hidden="true"></i> Split </spen>
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
					//$return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app' . $row_qitem["qdoci_id"] . '">' . (($comm_value != "") ? number_format($comm_value, 2) : "0") . '</td>';
					$return_html .= '<td style="text-align:center; color:#999;" 
						id="comm_val_app' . $row_qitem["qdoci_id"] . '" 
						class="comm_val_est" 
						data-comm-valueest="' . (($comm_value != "") ? $comm_value: "0") . '">'
						. (($row_quote["allow_comm"] == 'on') 
							? (($comm_value != "") ? number_format($comm_value, 2) : "0") 
							: "0")
					. '</td>';
			} else {

				$return_html .= '<td style="text-align:center; color:#999;"><input type="hidden" value="' . $row_qitem["qdoci_id"] . '" class="qdoci_id_app">';
				$return_html .= '<input type="hidden" value="' . $tmp_amount . '" id="tmp_amount' . $row_qitem["qdoci_id"] . '">';
				$return_html .= '<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width:60px; text-align:center;" min="0" type="number" value="' . $tmp_comm_percent . '" id="comm_percent_app' . $row_qitem["qdoci_id"] . '"></td>';
				//$return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app' . $row_qitem["qdoci_id"] . '">' . (($comm_value != "") ? number_format($comm_value, 2) : "0") . '</td>';
				$return_html .= '<td style="text-align:center; color:#999;" 
						id="comm_val_app' . $row_qitem["qdoci_id"] . '" 
						class="comm_val_est" 
						data-comm-valueest="' . (($comm_value != "") ? $comm_value: "0") . '">'
						. (($row_quote["allow_comm"] == 'on') 
							? (($comm_value != "") ? number_format($comm_value, 2) : "0") 
							: "0")
					. '</td>';
			}

				// $return_html .= '<td style="text-align:center; color:#999;"><input type="hidden" value="'.$row_qitem["qdoci_id"].'" class="qdoci_id_app">';

				// $return_html .= '<input type="hidden" value="'.$tmp_amount.'" id="tmp_amount'.$row_qitem["qdoci_id"].'">';

				// $return_html .= '<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width:60px; text-align:center;" min="0" type="number" value="'.$tmp_comm_percent.'" id="comm_percent_app'.$row_qitem["qdoci_id"].'"></td>';

				// $return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app'.$row_qitem["qdoci_id"].'">'.(($comm_value!="")?number_format($comm_value,2):"").'</td>';



			

				// $return_html .= '<td style="text-align:center; color:#999;"><input type="hidden" value="'.$row_qitem["qdoci_id"].'" class="qdoci_id_app">';

				// $return_html .= '<input type="hidden" value="'.$tmp_amount.'" id="tmp_amount'.$row_qitem["qdoci_id"].'">';

				// $return_html .= '<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width:60px; text-align:center;" min="0" type="number" value="'.$tmp_comm_percent.'" id="comm_percent_app'.$row_qitem["qdoci_id"].'"></td>';

				// $return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app'.$row_qitem["qdoci_id"].'">'.(($comm_value!="")?number_format($comm_value,2):"").'</td>';



			}

			$return_html .= '<td style="text-align:center;">';

			if($action_from=="va"){

				$return_html .= '<input name="app_qty[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:55px; text-align:center;" min="0" type="number" value="'.$qty.'" id="app_qty'.$row_qitem["qdoci_id"].'">';

			}else{

				$return_html .= number_format($qty,0);

			}

			$return_html .= '</td>';

			

			$return_html .= '<td style="text-align:right;">';

			if($action_from=="va"){

				$return_html .= '<input name="app_uprice[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:70px; text-align:center;" min="0.00" type="number" value="'.$uprice.'" id="app_uprice'.$row_qitem["qdoci_id"].'">';

			}else if( $action_from=="vc" && ($user_group=="1" || $user_group=="99") ){

				$return_html .= $pre_cost.number_format($uprice,2);



				$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editUPriceAfterApprove(\''.$qdoc_id.'\',\''.$row_qitem["qdoci_id"].'\',\''.$uprice.'\');"></i>';



			}else{

				$return_html .= $pre_cost.number_format($uprice,2);

			}

			$return_html .= '</td><td style="text-align:center;">'.$pre_cost.'<span id="sp_app_amount'.$row_qitem["qdoci_id"].'">';



			if($action_from=="va"){

				$return_html .= $tmp_amount;

			}else{

				$return_html .= number_format($tmp_amount,2);

			}



			$return_html .= '</span></td>';



			if($action_from=="va"){

				$return_html .= '<td style="text-align:center;cursor:pointer;" class="remover" qdoci_id="'.$row_qitem['qdoci_id'].'"><i style="color:red;" class="fa fa-minus-circle"></i></td>';

			}



			$return_html .='</tr>';



			//$sub_total += $tmp_amount;

		}



		$col_span = 4;

		$col_span2 = 2;

		if($action_from=="vc" || $action_from=="va"){

			$col_span = 6;

			$col_span2 = 4;

		}

		$return_html .= '<tr><td colspan="'.$col_span.'" style="padding:0px;"><hr style="margin:0px;"></td></tr>';



		

		

		$vat_7percent = ($sub_total-$row_quote['actual_discount'])*0.07;



		$f_total = 0.0;

		if($row_quote["inc_vat"]=="yes" || $action_from=="va" || $action_from=="vb"){

            if($action_from!="vp"){

			$return_html .= '<tr><td colspan="2"><span qdoc_id="'.$qdoc_id.'" class="btn btn-success add_row" style="padding:5px;">Add Row  <i class="fa fa-plus" aria-hidden="true"></i></span></td>';

            }

			if($action_from=="vc" || $action_from=="va"){

				//$return_html .= '<td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">'.number_format($comm_total,2).'</td><td>&nbsp;</td>';
				$return_html .= '<td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">'
                    . (($row_quote["allow_comm"] == 'on') ? number_format($comm_total, 2) : "0"). '</td><td>&nbsp;</td>';

			}

            $colspaner = '';

            $colspaner_1 = '';

            if($action_from=="vp"){

                $colspaner = "colspan='3'";

                $colspaner_1 = "colspan='1'";

            }

			$return_html .= '<th '.$colspaner.' style="padding: 10px 0px; text-align:right;">Subtotal:</th>';

			$return_html .= '<td '.$colspaner_1.' style="padding: 10px 0px; text-align:right;">'.$pre_cost.'<span id="sp_app_sub_total">'.$sub_total.'</span></td></tr>';



			if($row_quote["inc_vat"]=="yes"){

				$f_total = ($sub_total-$row_quote['actual_discount'])+$vat_7percent;

			}else{

				$f_total = $sub_total-$row_quote['actual_discount'];

			}

			if($action_from!="vp"){

			

    			if ($row_quote["design_url"]!="" || $row_quote["design_url"]!=NULL) {

    				$return_html .= "<input type='hidden' id='tr_total' value='1'>";

    				$return_html .="<tr><th>Design URL</th></tr>";

    				$return_html .="<tr><td class='alert alert-success'><a style='color:white;' href=".$row_quote["design_url"].">".$row_quote["design_url"]."</a></td></tr>";

    			}

    			

    			$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Change Currency:</th><td style="padding: 10px 0px; text-align:right;"><span>'.$select_html.'</span></td></tr>';

    			

    			$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="discount_percent" class="number_disc_approval" data-shipp="'.$shipping.'" value="'.$row_quote['discount_percent'].'" style="width:55px;"></span></td></tr>';

			

			    $return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="actual_discount" id="actual_disc_approval" data-shipp="'.$shipping.'" value="'.$row_quote['actual_discount'].'" style="width:55px;"></span></td></tr>';

		    }



			$return_html .= "<input type='hidden' id='tr_total' value='0'>";

			

			if($action_from=="vp" && $row_quote['actual_discount']!="0"){

			    $return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>'.$row_quote['discount_percent'].'%</span></td></tr>';

			

			    $return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>'.$pre_cost.number_format($row_quote['actual_discount'],2).'</span></td></tr>';

			}

			



			$return_html .= '<tr ><td rowspan="3" colspan="'.$col_span2.'">';

			if($row_quote["sale_note"]!="" && ($action_from=="va" || $action_from=="vb") ){

				$return_html .= 'Salesman Notes (<font color=red>Not shown in Quotation</font>)';

				if($action_from=="vb"){

					$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_edit_sale_note" style="background-color:#DDD;" onclick="return editSaleNote('.$qdoc_id.');"><i class="fa fa-pencil" style="color:#00F;"></i> Edit</button>';

					$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_save_sale_note" style="background-color:#FFF;" disabled onclick="return saveSaleNote('.$qdoc_id.');"><i class="fa fa-floppy-o" style="color:#070;"></i> Save</button>';

				}

				

				$return_html .= '<br><pre class="alert alert-success" style="width:100%; height:100%; max-width:700px; overflow-x:auto;" id="pre_sale_note'.$qdoc_id.'">'.$row_quote["sale_note"].'</pre>';

			}else{

				$return_html .= '&nbsp;';

			}



			if($action_from=="va"){

				$return_html .= 'Comment (<font color=red>Not shown in Quotation and appear on the top after Approve or Reject.</font>)';

				$return_html .= '<div style="text-align:left;">';

				$return_html .= '<textarea name="approval_comment" id="approval_comment" style="width: 700px; height: 100px; min-height: 101px; margin: 3px;"></textarea>';

				$return_html .= '</div>';

			}

			if($action_from=="va" && ($user_group == "1" || $user_group == "99")){

				$return_html .= 'Private Notes  (<font color=red>Private notes only for admin.</font>)';

				$return_html .= '<div style="text-align:left;">';

				$return_html .= '<textarea name="admin_private_notes" id="admin_private_notes" style="width: 700px; height: 100px; min-height: 101px; margin: 3px;">'.$admin_private_notes.'</textarea>';

				$return_html .= '</div>';			
		
			}


			$return_html .= '</td>';

			$return_html .= '<td style="padding: 10px 0px; text-align:right;">';

			$return_html .= '<input type="hidden" id="sub_total_app" value="'.$sub_total.'">';

			$return_html .= '<input type="hidden" id="pre_cost_app" value="'.$pre_cost.'">';

			$return_html .= '<input type="hidden" name="vat_value_app" id="vat_value_app" value="'.$vat_7percent.'">';

			$return_html .= '<input type="hidden" id="total_value_app" value="'.$f_total.'">';



			

			

			if($row_quote["approve_status"]=="approve" && ( $user_group=="1" || $user_group=="99" ) ){

				$return_html .= '<span class="subnvat" style="display: flex;white-space: nowrap;gap: 6px;align-items: center;" ><input type="checkbox" name="inc_vat_app" id="inc_vat_app" value="yes" style="height: 15px;" onclick="changeIncludeVATApprove();" ';

				if($row_quote["inc_vat"]=="yes"){

					$return_html .= 'checked';

				}

				$return_html .= '>';

			}

			$return_html .= ' VAT 7%:</span></td>';

			$return_html .= '<td style="padding: 10px 0px; text-align:right;"><span class="subnvat" id="sp_show_vat_value_app">';

			if($row_quote["inc_vat"]=="yes"){

				$return_html .= $pre_cost.number_format($vat_7percent,2);

			}

			$return_html .= '</span></td></tr>';



			$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Total:</span></th>';

			$return_html .= '<td style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat" id="sp_show_total_value_app">'.$pre_cost.number_format($f_total,2).'</span></td></tr>';

			

			

			$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total ('.$row_quote["quote_curr"].'):</th>';

			$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="'.$pre_cost.'">'.$pre_cost.number_format($f_total,2).'</span></th></tr>';

		

		}else{

			//$f_total = $sub_total;

            $f_total = $row_quote["grand_total"];

			$return_html .= '<tr ><td>&nbsp;</td>';

			$colspan_grand = "colspan='2'";

			if($action_from=="vc" || $action_from=="va"){

				//$return_html .= '<td>&nbsp;</td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">'.number_format($comm_total,2).'</td>';
				$return_html .= '<td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">'
                    . (($row_quote["allow_comm"] == 'on') ? number_format($comm_total, 2) : "0"). '</td><td>&nbsp;</td>';

			}

			if($action_from=="vp" && $row_quote['actual_discount']!="0"){

			    $return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>'.$row_quote['discount_percent'].'%</span></td></tr>';

			

			    $return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>'.$pre_cost.number_format($row_quote['actual_discount'],2).'</span></td></tr>';

			    $colspan_grand = "colspan='3'";

			}

			$return_html .= '<th '.$colspan_grand.' style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total ('.$row_quote["quote_curr"].'):</th>';

			$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="'.$pre_cost.'">'.$pre_cost.number_format($f_total,2).'</span></th></tr>';

		}



		



		$return_html .= '</table>';

		$return_html .= '</td></tr>';



		$return_html .= '</table>';



		if($action_from!="va" && $row_quote["note"]!=""){

			$return_html .= '<b>Notes</b> ';

			$return_html .= '<pre ';

			if($row_quote["approve_status"]=="reject"){

				$return_html .= ' class="alert alert-dark" ';

			}

			$return_html .= '>'.$row_quote["note"].'</pre>';

		}

		if($action_from!="va" && $row_quote["admin_private_notes"]!="" && ($user_group == "1" || $user_group == "99")){
			$return_html .= '<b>Private Notes (<font color="red">Private notes only for admin.</font>.)</b> ';
			$return_html .=  '<pre>'.$row_quote["admin_private_notes"].'</pre>';

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

		if($row_quote["approval_comment"]!=""){

			$a_result["approval_comment"] = base64_encode('<div><center><pre class="alert" style="text-align:left; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;" id="approval_comment'.$qdoc_id.'">'.$row_quote["approval_comment"].'</pre></center></div>');

		}



		if($approve_status=="new"){



			$a_result["show_approve"] = "yes";

			$a_result["show_reject"] = "yes";



			if($row_quote["history_qdoc_id"]!=""){



				$a_result["history_inner"] .= '<option value="'.$qdoc_id.'">==Main Document==</option>'; 



				$sql_history = "SELECT qdoc_id,add_date FROM tbl_quote_doc WHERE qdoc_id IN (".rtrim($row_quote["history_qdoc_id"],',').") ORDER BY add_date DESC; ";

				//$a_result["history_inner"] .= $sql_history;

				$a_history = Yii::app()->db->createCommand($sql_history)->queryAll();

				foreach($a_history as $tmp_key_his => $row_history){

					$a_result["history_inner"] .= '<option value="'.$row_history["qdoc_id"].'">'.$row_history["add_date"].'</option>'; 

				}

				

			}

			

		}else if($approve_status=="approve"){



			$a_result["show_print"] = "yes";



		}

		

		if($action_from=="va"){

		    $a_result["show_approve"] = "yes";

			$a_result["show_reject"] = "yes";

			$a_result["show_print"] = "yes";

		}

		

		$a_result['note_text'] = $row_quote["note"];



		echo json_encode($a_result);



	}

	

	public function actionShowQuoteViewCurrChange(){

	    

	    if($_POST['old_curr_id']==1){



		$qdoc_id = $_POST["qdoc_id"];



		$sql_quote = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='".$qdoc_id."'; ";

		$a_quote = Yii::app()->db->createCommand($sql_quote)->queryAll();

		$row_quote = $a_quote[0];

		$comp_id = $row_quote["comp_id"];



		$action_from = $_POST["action_from"];



		$approve_status = $row_quote["approve_status"];

		$curr_id = $_POST['curr_id'];



		$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='".$curr_id."'; ";

		$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

		$row_curr = $a_curr[0];

		$pre_cost = $row_curr["curr_symbol"];

		$quote_currency = $row_curr["quote_currency"];

		

		$cur_sql = "SELECT * FROM tbl_currency";

    	$curr_query = Yii::app()->db->createCommand($cur_sql)->queryAll();

    	$select_html = '<select style="width:50px;" id="viewQuotationNewFinal" qdoc_id="'.$qdoc_id.'" action_from="'.$action_from.'">';

		foreach($curr_query as $fetched){

		    $curr_select="";

		    if($fetched['curr_id']==$curr_id){

		        $curr_select = "selected";

		    }

		    $select_html .="<option curr_symbol=".$fetched['curr_name']." value=".$fetched['curr_id']." $curr_select >".$fetched["curr_name"]." ".$fetched["curr_desc"]."</option>";

		}

		$select_html .="</select>";



		$sql_comp = "SELECT tbl_comp_info.comp_logo,tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.comp_id='".$comp_id."'; ";

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



		if($comp_logo!=""){

		    //$return_html .= '<img style="max-height: 180px; max-width: 180px;" src="https://'.$_SERVER['SERVER_NAME'].'/salesrep/images/'.$comp_logo.'" >';

		    $return_html .= '<img style="max-height: 180px; max-width: 180px;" src="'.Yii::app()->request->baseUrl.'/images/'.$comp_logo.'" >';

		}

	    

	    $return_html .= '</td>';

	    $return_html .= '<td style="width:50%; text-align:right;">';

	    $return_html .= '<h1 style="color:#000;">QUOTATION</h1>';

	    $old_curr_id = $curr_id;

	    $return_html .= '<input type="hidden" value="'.$row_quote["curr_id"].'" id="old_curr_id">';

	    

	    $return_html .= '<input type="hidden" name="curr_id" value="'.$curr_id.'">';

	    $return_html .= '<input type="hidden" name="quote_curr" value="'.$row_curr["curr_name"].'">';

	    

	    $return_html .= 'Payment Terms: ';



	    if($action_from=="va"){

		    $return_html .= '<select name="payment_term" id="edit_payment_term">';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Net 15")?"selected":"").' value="Net 15">Net 15</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Net 30")?"selected":"").' value="Net 30">Net 30</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Payment Due at Order Confirmation")?"selected":"").' value="Payment Due at Order Confirmation">Payment Due at Order Confirmation</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="50% Due At Order Confirmation. Balance Due At Delivery")?"selected":"").' value="50% Due At Order Confirmation. Balance Due At Delivery">50% Due At Order Confirmation. Balance Due At Delivery</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Balance Due before Ship Date")?"selected":"").' value="Balance Due before Ship Date">Balance Due before Ship Date</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="50% Down Payment. Balance Due Net 15")?"selected":"").' value="50% Down Payment. Balance Due Net 15">50% Down Payment. Balance Due Net 15</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="50% Down Payment. Balance Due at Delivery")?"selected":"").' value="50% Down Payment. Balance Due at Delivery">50% Down Payment. Balance Due at Delivery</option>';

	        $return_html .= '</select>';

	    }else{

	    	$return_html .= $row_quote["payment_term"];

	    }



	    $return_html .= '<pre style="width:100%;" id="pre_comp_info_app"><b>'.$row_quote["comp_name"].'</b><br>'.$row_quote["comp_info"].'</pre>';

	    $return_html .= '</td></tr><tr style="height:5px;"><td colspan="2"><hr></td></tr>';

		$return_html .= '<tr>';

		if($action_from=="va"){

		$return_html .= '<select id="cust_selector" name="cust_selector" onchange="return changeCustomerV2();"><option value="">=Select Customer=</option>';

		$user_group = Yii::app()->user->getState('userGroup');

		$user_id = Yii::app()->user->getState('userKey');



		$more_condition = "";

		if( $user_group!="1" && $user_group!="99" ){

		

			$more_condition = " AND user_id='".$user_id."' ";

		}

		$sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 ".$more_condition." ORDER BY cust_name ASC; ";

		$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();

		$custom_selector = "";

		foreach($a_cust as $tmp_key => $row_cust){

		    if($row_quote['cust_id']==$row_cust['cust_id']){

		        $custom_selector = "selected";

		    }

			$return_html .= '<option '.$custom_selector.' value="'.$row_cust["cust_id"].'">'.$row_cust["cust_name"].'</option>';

			$custom_selector = "";

		}

		$return_html .= '</select><pre id="pr_show_cust_info"></pre>';

		}

		$return_html .= '<td style="text-align:left; padding:20px 0px;">';

		$return_html .= '<div class="bill_to">BILL TO<br>'.$row_quote["cust_name"];

		$return_html .= '<pre>'.$row_quote["cust_info"].'</pre></div>';

		if($action_from!="va"){

        $return_html .= '<a href="#" onclick="edit_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Edit <span id="cus_namer_' . $row_quote["cust_id"] . '">' . $row_quote["cust_name"] . '</span></a><span style="display: inline-block; font-size: 1.5em; margin: 0 5px;">&bull;</span><a href="#" onclick="change_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Change Customer</a>';

		}

		$return_html .= '</td>';

		$return_html .= '<td padding:20px 0px;">';

		$return_html .= '<table  style="border-collapse: separate; border-spacing: 10px; color:#000;">';

		$return_html .= '<tr><th width="50%" style="text-align:right;">Estimate Number: </th><td style="color:#00F; text-align:left;" id="qdoc_number">'.$row_quote["est_number"].'</td></tr>';

		$return_html .= '<tr>';

		$return_html .= '<th style="text-align:right;">PO Number: </th>';

		$return_html .= '<td style="text-align:left;" id="po_number">';

		$return_html .= '<span id="sp_po_number'.$qdoc_id.'">'.$row_quote["po_number"].'</span> <i class="fa fa-pencil" style="cursor:pointer; font-size:16px; color:#00F;" onclick="return editPONumber('.$qdoc_id.');"></i>';

		$return_html .= '</td>';

		$return_html .= '</tr>';

		$return_html .= '<tr><th style="text-align:right;">Estimate Date: </th><td style="text-align:left;" id="show_est_date">'.date("F d, Y",strtotime($row_quote["est_date"])).'</td></tr>';

		$return_html .= '<tr><th style="text-align:right;">Expires On: </th><td style="text-align:left;" id="show_exp_date">'.date("F d, Y",strtotime($row_quote["exp_date"])).'</td></tr>';

		$return_html .= '<tr><th style="text-align:right;">Grand Total ('.$row_curr['curr_name'].'): </th><td style="text-align:left;" id="td_grand_total_app">'.$pre_cost.number_format($row_quote["grand_total"]*$quote_currency,2).'</td></tr>';

		$return_html .= '</table>';

		$return_html .= '<input type="hidden" name="qdoc_id" id="qdoc_id" value="'.$qdoc_id.'">';

		$return_html .= '</td></tr>';

		$return_html .= '<tr><td colspan="2">';

		$return_html .= '<table style="color:#000; width:100%;" id="product_list">';

		$return_html .= '<tr style="font-size: 15px;"><th style="text-align:left;">Product</th>';



		if($action_from=="vc" || $action_from=="va"){

			$return_html .= '<th style="text-align:center; color:#999;">Comm.%</th><th style="text-align:center; color:#999;">Comm.</th>';

			$return_html .= '<th style="text-align:center; width:80px;">Quantity</th><th style="text-align:center; width:80px;">Price</th><th style="text-align:right; width:80px;">Amount</th><th style="text-align:right; width:10%"></th></tr>';

		}else{

			$return_html .= '<th style="text-align:center;">Quantity</th><th style="text-align:right; width:140px;">Price</th><th style="text-align:right; width:140px;">Amount</th></tr>';

		}


		$shipping = 0.0;
		$sql_qitem = "SELECT * FROM tbl_quote_item WHERE qdoc_id='".$qdoc_id."' AND enable=1 AND product_status='1' ORDER BY sort ASC; ";

		$a_qitem = Yii::app()->db->createCommand($sql_qitem)->queryAll();

		$sql = "SELECT * FROM `tbl_quote_item` WHERE `qdoc_id` = '$qdoc_id' AND enable='1' AND (`pro_name` LIKE '%Royalty%' OR `pro_name` LIKE '%Credit Card%' OR `pro_name` LIKE '%Shipping%')";
		$shipp = Yii::app()->db->createCommand($sql)->queryAll();
		if (isset($shipp[0])) {	
			foreach ($shipp as $key => $value) {
		
				$shipping += $value['uprice'];
			}			
		}


		//$sub_total = 0.0;

		$sub_total = $row_quote["sub_total"]*$quote_currency;

		$comm_total = 0.0;



		$user_group = Yii::app()->user->getState('userGroup');



		foreach( $a_qitem as $tmp_key => $row_qitem ){



			$pro_id = $row_qitem["pro_id"];

			$qty = $row_qitem["qty"];

			$uprice = $row_qitem["uprice"]*$quote_currency;

			$comm_percent = $row_qitem["comm_percent"];
			$qdoci_id = $row_qitem["qdoci_id"];

			$comm_value = "";

			$tmp_comm_percent = 0;

			if($comm_percent!=""){

				$tmp_comm_percent = intval(str_replace("%", "", $comm_percent));

				$comm_value = ($qty*$uprice)*($tmp_comm_percent/100);

				$comm_total += $comm_value;

			}

			$sql = "SELECT * FROM `tbl_quote_item` WHERE `qdoci_id` = '$qdoci_id' AND enable='1' AND (`pro_name` LIKE '%Royalty%' OR `pro_name` LIKE '%Credit Card%' OR `pro_name` LIKE '%Shipping%')";
			$shipp = Yii::app()->db->createCommand($sql)->queryAll();

			$shippcount= count($shipp);

			$tmp_amount = $qty*$uprice;



			$return_html .= '<tr><td style="padding:10px 0px; text-align:left; display: block; white-space: pre-wrap; word-break: break-all; word-wrap: break-word;">';

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



			if($action_from=="va"){

				$return_html .= '<input type="hidden" name="qdoci_id[]" value="'.$row_qitem["qdoci_id"].'">';

				$return_html .= '<input style="width:100%; font-weight:bold;" type="text" name="pro_name[]" value="'.htmlspecialchars($row_qitem["pro_name"]).'">';

				$return_html .= '<br><textarea style="width:100%; min-height:70px;" name="pro_desc[]">'.$row_qitem["pro_desc"].'</textarea>';

				if($row_qitem["addi_desc"]!=""){

					$return_html .= $row_qitem["addi_desc"];

				}

			}else{

				$return_html .= '<b>'.htmlspecialchars($row_qitem["pro_name"]).'</b><br>'.$row_qitem["pro_desc"];

			}



			$return_html .= '</td>';



			if($action_from=="vc"){



				$return_html .= '<td style="text-align:center; color:#999;">'.(($tmp_comm_percent!=0)?($tmp_comm_percent."%"):"0%");

				if( $user_group=="1" || $user_group=="99" ){

					$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editCommAfterApprove(\''.$qdoc_id.'\',\''.$row_qitem["qdoci_id"].'\',\''.$tmp_comm_percent.'\');"></i>';

				}

				



				$return_html .= '</td>';

				$return_html .= '<td style="text-align:center; color:#999;">'.(($comm_value!="")?number_format($comm_value*$quote_currency,2):"0").'</td>';



			}else if($action_from=="va"){



				$return_html .= '<td style="text-align:center; color:#999;"><input type="hidden" value="'.$row_qitem["qdoci_id"].'" class="qdoci_id_app">';

				$return_html .= '<input type="hidden" value="'.$tmp_amount.'" id="tmp_amount'.$row_qitem["qdoci_id"].'">';

				$return_html .= '<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width:60px; text-align:center;" min="0" type="number" value="'.$tmp_comm_percent.'" id="comm_percent_app'.$row_qitem["qdoci_id"].'"></td>';

				$return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app'.$row_qitem["qdoci_id"].'">'.(($comm_value!="")?number_format($comm_value*$quote_currency,2):"").'</td>';



			}

			$return_html .= '<td style="text-align:center;">';

			if($action_from=="va"){

				$return_html .= '<input name="app_qty[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:55px; text-align:center;" min="0" type="number" value="'.$qty.'" id="app_qty'.$row_qitem["qdoci_id"].'">';

			}else{

				$return_html .= number_format($qty,0);

			}

			$return_html .= '</td>';

			

			$return_html .= '<td style="text-align:right;">';

			if($action_from=="va"){

				$return_html .= '<input name="app_uprice[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:70px; text-align:center;" min="0.00" type="number" value="'.$uprice.'" id="app_uprice'.$row_qitem["qdoci_id"].'">';

			}else if( $action_from=="vc" && ($user_group=="1" || $user_group=="99") ){

				$return_html .= $pre_cost.number_format($uprice,2);



				$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editUPriceAfterApprove(\''.$qdoc_id.'\',\''.$row_qitem["qdoci_id"].'\',\''.$uprice.'\');"></i>';



			}else{

				$return_html .= $pre_cost.number_format($uprice,2);

			}

			$return_html .= '</td><td style="text-align:center;">'.$pre_cost.'<span class="shippcount'.$shippcount.'" id="sp_app_amount'.$row_qitem["qdoci_id"].'">';



			if($action_from=="va"){

				$return_html .= $tmp_amount;

			}else{

				$return_html .= number_format($tmp_amount,2);

			}



			$return_html .= '</span></td>';



			if($action_from=="va"){

				$return_html .= '<td style="text-align:center;cursor:pointer;" class="remover" qdoci_id="'.$row_qitem['qdoci_id'].'"><i style="color:red;" class="fa fa-minus-circle"></i></td>';

			}



			$return_html .='</tr>';



			//$sub_total += $tmp_amount;

		}



		$col_span = 4;

		$col_span2 = 2;

		if($action_from=="vc" || $action_from=="va"){

			$col_span = 6;

			$col_span2 = 4;

		}

		$return_html .= '<tr><td colspan="'.$col_span.'" style="padding:0px;"><hr style="margin:0px;"></td></tr>';



		

		

		$vat_7percent = ($sub_total-$row_quote['actual_discount'])*0.07;



		$f_total = 0.0;

		if($row_quote["inc_vat"]=="yes" || $action_from=="va" || $action_from=="vb"){

            if($action_from!="vp"){

			$return_html .= '<tr><td colspan="2"><span qdoc_id="'.$qdoc_id.'" class="btn btn-success add_row" style="padding:5px;">Add Row  <i class="fa fa-plus" aria-hidden="true"></i></span></td>';

            }

			if($action_from=="vc" || $action_from=="va"){

				$return_html .= '<td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">'.number_format($comm_total,2).'</td><td>&nbsp;</td>';

			}

            $colspaner = '';

            $colspaner_1 = '';

            if($action_from=="vp"){

                $colspaner = "colspan='3'";

                $colspaner_1 = "colspan='1'";

            }

			$return_html .= '<th '.$colspaner.' style="padding: 10px 0px; text-align:right;">Subtotal:</th>';

			$return_html .= '<td '.$colspaner_1.' style="padding: 10px 0px; text-align:right;">'.$pre_cost.'<span id="sp_app_sub_total">'.$sub_total.'</span></td></tr>';



			if($row_quote["inc_vat"]=="yes"){

				$f_total = ($sub_total-($row_quote['actual_discount']*$quote_currency))+$vat_7percent;

			}else{

				$f_total = $sub_total-($row_quote['actual_discount']*$quote_currency);

			}

			if($action_from!="vp"){

			

    			if ($row_quote["design_url"]!="" || $row_quote["design_url"]!=NULL) {

    				$return_html .= "<input type='hidden' id='tr_total' value='1'>";

    				$return_html .="<tr><th>Design URL</th></tr>";

    				$return_html .="<tr><td class='alert alert-success'><a style='color:white;' href=".$row_quote["design_url"].">".$row_quote["design_url"]."</a></td></tr>";

    			}

    			

    			$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Change Currency:</th><td style="padding: 10px 0px; text-align:right;"><span>'.$select_html.'</span></td></tr>';

    			

    			$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="discount_percent" class="number_disc_approval" data-shipp="'.$shipping.'" value="'.$row_quote['discount_percent'].'" style="width:55px;"></span></td></tr>';

			

			    $return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="actual_discount" id="actual_disc_approval" data-shipp="'.$shipping.'" value="'.$row_quote['actual_discount'].'" style="width:55px;" readonly></span></td></tr>';

		    }



			$return_html .= "<input type='hidden' id='tr_total' value='0'>";

			

			if($action_from=="vp" && $row_quote['actual_discount']!="0"){

			    $return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>'.$row_quote['discount_percent'].'%</span></td></tr>';

			

			    $return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>'.$pre_cost.number_format($row_quote['actual_discount'],2).'</span></td></tr>';

			}

			



			$return_html .= '<tr ><td rowspan="3" colspan="'.$col_span2.'">';

			if($row_quote["sale_note"]!="" && ($action_from=="va" || $action_from=="vb") ){

				$return_html .= 'Salesman Notes (<font color=red>Not shown in Quotation</font>)';

				if($action_from=="vb"){

					$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_edit_sale_note" style="background-color:#DDD;" onclick="return editSaleNote('.$qdoc_id.');"><i class="fa fa-pencil" style="color:#00F;"></i> Edit</button>';

					$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_save_sale_note" style="background-color:#FFF;" disabled onclick="return saveSaleNote('.$qdoc_id.');"><i class="fa fa-floppy-o" style="color:#070;"></i> Save</button>';

				}

				

				$return_html .= '<br><pre class="alert alert-success" style="width:100%; height:100%; max-width:700px; overflow-x:auto;" id="pre_sale_note'.$qdoc_id.'">'.$row_quote["sale_note"].'</pre>';

			}else{

				$return_html .= '&nbsp;';

			}



			if($action_from=="va"){

				$return_html .= 'Comment (<font color=red>Not shown in Quotation and appear on the top after Approve or Reject.</font>)';

				$return_html .= '<div style="text-align:left;">';

				$return_html .= '<textarea name="approval_comment" id="approval_comment" style="width: 700px; height: 100px; min-height: 101px; margin: 3px;"></textarea>';

				$return_html .= '</div>';

			}



			$return_html .= '</td>';

			$return_html .= '<td style="padding: 10px 0px; text-align:right;">';

			$return_html .= '<input type="hidden" id="sub_total_app" value="'.$sub_total.'">';

			$return_html .= '<input type="hidden" id="pre_cost_app" value="'.$pre_cost.'">';

			$return_html .= '<input type="hidden" name="vat_value_app" id="vat_value_app" value="'.$vat_7percent.'">';

			$return_html .= '<input type="hidden" id="total_value_app" value="'.$f_total.'">';



			

			

			if($row_quote["approve_status"]=="new" && ( $user_group=="1" || $user_group=="99" ) ){

				$return_html .= '<span class="subnvat"><input type="checkbox" name="inc_vat_app" id="inc_vat_app" value="yes" onclick="changeIncludeVATApprove();" ';

				if($row_quote["inc_vat"]=="yes"){

					$return_html .= 'checked';

				}

				$return_html .= '>';

			}

			$return_html .= ' VAT 7%:</span></td>';

			$return_html .= '<td style="padding: 10px 0px; text-align:right;"><span class="subnvat" id="sp_show_vat_value_app">';

			if($row_quote["inc_vat"]=="yes"){

				$return_html .= $pre_cost.number_format($vat_7percent,2);

			}

			$return_html .= '</span></td></tr>';



			$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Total:</span></th>';

			$return_html .= '<td style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat" id="sp_show_total_value_app">'.$pre_cost.number_format($f_total,2).'</span></td></tr>';

			

			

			$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total ('.$row_curr["curr_name"].'):</th>';

			$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="'.$pre_cost.'">'.$pre_cost.number_format($f_total,2).'</span></th></tr>';

		

		}else{

			//$f_total = $sub_total;

            $f_total = $row_quote["grand_total"];

			$return_html .= '<tr ><td>&nbsp;</td>';

			$colspan_grand = "colspan='2'";

			if($action_from=="vc" || $action_from=="va"){

				$return_html .= '<td>&nbsp;</td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">'.number_format($comm_total,2).'</td>';

			}

			if($action_from=="vp" && $row_quote['actual_discount']!="0"){

			    $return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>'.$row_quote['discount_percent'].'%</span></td></tr>';

			

			    $return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>'.$pre_cost.number_format($row_quote['actual_discount'],2).'</span></td></tr>';

			    $colspan_grand = "colspan='3'";

			}

			$return_html .= '<th '.$colspan_grand.' style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total ('.$row_quote["quote_curr"].'):</th>';

			$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="'.$pre_cost.'">'.$pre_cost.number_format($f_total,2).'</span></th></tr>';

		}



		



		$return_html .= '</table>';

		$return_html .= '</td></tr>';



		$return_html .= '</table>';



		if($action_from!="va" && $row_quote["note"]!=""){

			$return_html .= '<b>Notes</b> ';

			$return_html .= '<pre ';

			if($row_quote["approve_status"]=="reject"){

				$return_html .= ' class="alert alert-dark" ';

			}

			$return_html .= '>'.$row_quote["note"].'</pre>';

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

		if($row_quote["approval_comment"]!=""){

			$a_result["approval_comment"] = base64_encode('<div><center><pre class="alert" style="text-align:left; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;" id="approval_comment'.$qdoc_id.'">'.$row_quote["approval_comment"].'</pre></center></div>');

		}



		if($approve_status=="new"){



			$a_result["show_approve"] = "yes";

			$a_result["show_reject"] = "yes";



			if($row_quote["history_qdoc_id"]!=""){



				$a_result["history_inner"] .= '<option value="'.$qdoc_id.'">==Main Document==</option>'; 



				$sql_history = "SELECT qdoc_id,add_date FROM tbl_quote_doc WHERE qdoc_id IN (".rtrim($row_quote["history_qdoc_id"],',').") ORDER BY add_date DESC; ";

				//$a_result["history_inner"] .= $sql_history;

				$a_history = Yii::app()->db->createCommand($sql_history)->queryAll();

				foreach($a_history as $tmp_key_his => $row_history){

					$a_result["history_inner"] .= '<option value="'.$row_history["qdoc_id"].'">'.$row_history["add_date"].'</option>'; 

				}

				

			}

			

		}else if($approve_status=="approve"){



			$a_result["show_print"] = "yes";



		}



		echo json_encode($a_result);

	    }

	    else{

		$qdoc_id = $_POST["qdoc_id"];



		$sql_quote = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='".$qdoc_id."'; ";

		$a_quote = Yii::app()->db->createCommand($sql_quote)->queryAll();

		$row_quote = $a_quote[0];

		$comp_id = $row_quote["comp_id"];



		$action_from = $_POST["action_from"];



		$approve_status = $row_quote["approve_status"];

		$curr_id = $_POST['curr_id'];

		$older_curr_id = $_POST['old_curr_id'];

		

		$oldsql_curr = "SELECT * FROM tbl_currency WHERE curr_id='".$older_curr_id."'; ";

		$old_a_curr = Yii::app()->db->createCommand($oldsql_curr)->queryAll();

		$old_row_curr = $old_a_curr[0];

		$old_quote_currency = 1/$old_row_curr["quote_currency"];



		$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='".$curr_id."'; ";

		$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

		$row_curr = $a_curr[0];

		$pre_cost = $row_curr["curr_symbol"];

		$quote_currency = ($row_curr["quote_currency"])*$old_quote_currency;

		

		$cur_sql = "SELECT * FROM tbl_currency";

    	$curr_query = Yii::app()->db->createCommand($cur_sql)->queryAll();

    	$select_html = '<select style="width:50px;" id="viewQuotationNewFinal" qdoc_id="'.$qdoc_id.'" action_from="'.$action_from.'">';

		foreach($curr_query as $fetched){

		    $curr_select="";

		    if($fetched['curr_id']==$curr_id){

		        $curr_select = "selected";

		    }

		    $select_html .="<option curr_symbol=".$fetched['curr_name']." value=".$fetched['curr_id']." $curr_select >".$fetched["curr_name"]." ".$fetched["curr_desc"]."</option>";

		}

		$select_html .="</select>";



		$sql_comp = "SELECT tbl_comp_info.comp_logo,tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.comp_id='".$comp_id."'; ";

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



		if($comp_logo!=""){

		    //$return_html .= '<img style="max-height: 180px; max-width: 180px;" src="https://'.$_SERVER['SERVER_NAME'].'/salesrep/images/'.$comp_logo.'" >';

		    $return_html .= '<img style="max-height: 180px; max-width: 180px;" src="'.Yii::app()->request->baseUrl.'/images/'.$comp_logo.'" >';

		}

	    

	    $return_html .= '</td>';

	    $return_html .= '<td style="width:50%; text-align:right;">';

	    $return_html .= '<h1 style="color:#000;">QUOTATION</h1>';

	    $old_curr_id = $curr_id;

	    $return_html .= '<input type="hidden" value="'.$row_quote["curr_id"].'" id="old_curr_id">';

	    

	    $return_html .= '<input type="hidden" name="curr_id" value="'.$curr_id.'">';

	    $return_html .= '<input type="hidden" name="quote_curr" value="'.$row_curr["curr_name"].'">';

	    

	    $return_html .= 'Payment Terms: ';



	    if($action_from=="va"){

		    $return_html .= '<select name="payment_term" id="edit_payment_term">';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Net 15")?"selected":"").' value="Net 15">Net 15</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Net 30")?"selected":"").' value="Net 30">Net 30</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Payment Due at Order Confirmation")?"selected":"").' value="Payment Due at Order Confirmation">Payment Due at Order Confirmation</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="50% Due At Order Confirmation. Balance Due At Delivery")?"selected":"").' value="50% Due At Order Confirmation. Balance Due At Delivery">50% Due At Order Confirmation. Balance Due At Delivery</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="Balance Due before Ship Date")?"selected":"").' value="Balance Due before Ship Date">Balance Due before Ship Date</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="50% Down Payment. Balance Due Net 15")?"selected":"").' value="50% Down Payment. Balance Due Net 15">50% Down Payment. Balance Due Net 15</option>';

            $return_html .= '<option '.(($row_quote["payment_term"]=="50% Down Payment. Balance Due at Delivery")?"selected":"").' value="50% Down Payment. Balance Due at Delivery">50% Down Payment. Balance Due at Delivery</option>';

	        $return_html .= '</select>';

	    }else{

	    	$return_html .= $row_quote["payment_term"];

	    }



	    $return_html .= '<pre style="width:100%;" id="pre_comp_info_app"><b>'.$row_quote["comp_name"].'</b><br>'.$row_quote["comp_info"].'</pre>';

	    $return_html .= '</td></tr><tr style="height:5px;"><td colspan="2"><hr></td></tr>';

		$return_html .= '<tr>';

		if($action_from=="va"){

		$return_html .= '<select id="cust_selector" name="cust_selector" onchange="return changeCustomerV2();"><option value="">=Select Customer=</option>';

		$user_group = Yii::app()->user->getState('userGroup');

		$user_id = Yii::app()->user->getState('userKey');



		$more_condition = "";

		if( $user_group!="1" && $user_group!="99" ){

		

			$more_condition = " AND user_id='".$user_id."' ";

		}

		$sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 ".$more_condition." ORDER BY cust_name ASC; ";

		$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();

		$custom_selector = "";

		foreach($a_cust as $tmp_key => $row_cust){

		    if($row_quote['cust_id']==$row_cust['cust_id']){

		        $custom_selector = "selected";

		    }

			$return_html .= '<option '.$custom_selector.' value="'.$row_cust["cust_id"].'">'.$row_cust["cust_name"].'</option>';

			$custom_selector = "";

		}

		$return_html .= '</select><pre id="pr_show_cust_info"></pre>';

		}

		$return_html .= '<td style="text-align:left; padding:20px 0px;">';

		$return_html .= '<div class="bill_to">BILL TO<br>'.$row_quote["cust_name"];



		$return_html .= '<pre>'.$row_quote["cust_info"].'</pre></div>';

		if($action_from!="va"){

        $return_html .= '<a href="#" onclick="edit_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Edit <span id="cus_namer_' . $row_quote["cust_id"] . '">' . $row_quote["cust_name"] . '</span></a><span style="display: inline-block; font-size: 1.5em; margin: 0 5px;">&bull;</span><a href="#" onclick="change_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Change Customer</a>';

		}

		$return_html .= '</td>';

		$return_html .= '<td padding:20px 0px;">';

		$return_html .= '<table   style="border-collapse: separate; border-spacing: 10px; color:#000;">';

		$return_html .= '<tr><th width="50%" style="text-align:right;">Estimate Number: </th><td style="color:#00F; text-align:left;" id="qdoc_number">'.$row_quote["est_number"].'</td></tr>';

		$return_html .= '<tr>';

		$return_html .= '<th style="text-align:right;">PO Number: </th>';

		$return_html .= '<td style="text-align:left;" id="po_number">';

		$return_html .= '<span id="sp_po_number'.$qdoc_id.'">'.$row_quote["po_number"].'</span> <i class="fa fa-pencil" style="cursor:pointer; font-size:16px; color:#00F;" onclick="return editPONumber('.$qdoc_id.');"></i>';

		$return_html .= '</td>';

		$return_html .= '</tr>';

		$return_html .= '<tr><th style="text-align:right;">Estimate Date: </th><td style="text-align:left;" id="show_est_date">'.date("F d, Y",strtotime($row_quote["est_date"])).'</td></tr>';

		$return_html .= '<tr><th style="text-align:right;">Expires On: </th><td style="text-align:left;" id="show_exp_date">'.date("F d, Y",strtotime($row_quote["exp_date"])).'</td></tr>';

		$return_html .= '<tr><th style="text-align:right;">Grand Total ('.$row_curr['curr_name'].'): </th><td style="text-align:left;" id="td_grand_total_app">'.$pre_cost.number_format($row_quote["grand_total"]*$quote_currency,2).'</td></tr>';

		$return_html .= '</table>';

		$return_html .= '<input type="hidden" name="qdoc_id" id="qdoc_id" value="'.$qdoc_id.'">';

		$return_html .= '</td></tr>';

		$return_html .= '<tr><td colspan="2">';

		$return_html .= '<table style="color:#000; width:100%;" id="product_list">';

		$return_html .= '<tr style="font-size: 15px;"><th style="text-align:left;">Product</th>';



		if($action_from=="vc" || $action_from=="va"){

			$return_html .= '<th style="text-align:center; color:#999;">Comm.%</th><th style="text-align:center; color:#999;">Comm.</th>';

			$return_html .= '<th style="text-align:center; width:80px;">Quantity</th><th style="text-align:center; width:80px;">Price</th><th style="text-align:right; width:80px;">Amount</th><th style="text-align:right; width:10%"></th></tr>';

		}else{

			$return_html .= '<th style="text-align:center;">Quantity</th><th style="text-align:right; width:140px;">Price</th><th style="text-align:right; width:140px;">Amount</th></tr>';

		}

		$shipping = 0.0;

		$sql_qitem = "SELECT * FROM tbl_quote_item WHERE qdoc_id='".$qdoc_id."' AND enable=1 AND product_status='1' ORDER BY sort ASC; ";

		$a_qitem = Yii::app()->db->createCommand($sql_qitem)->queryAll();

		$sql = "SELECT * FROM `tbl_quote_item` WHERE `qdoc_id` = '$qdoc_id' AND enable='1' AND (`pro_name` LIKE '%Royalty%' OR `pro_name` LIKE '%Credit Card%' OR `pro_name` LIKE '%Shipping%')";
			$shipp = Yii::app()->db->createCommand($sql)->queryAll();
			if (isset($shipp[0])) {	
				foreach ($shipp as $key => $value) {
			
					$shipping += $value['uprice'];
				}			
			}

		//$sub_total = 0.0;

		$sub_total_main = $row_quote["sub_total"];

		$sub_total = $row_quote["sub_total"]*$quote_currency;

		$comm_total = 0.0;



		$user_group = Yii::app()->user->getState('userGroup');



		foreach( $a_qitem as $tmp_key => $row_qitem ){



			$pro_id = $row_qitem["pro_id"];

			$qty = $row_qitem["qty"];

			$uprice = $row_qitem["uprice"]*$quote_currency;

			$comm_percent = $row_qitem["comm_percent"];

			$qdoci_id = $row_qitem["qdoci_id"];

			$comm_value = "";

			$tmp_comm_percent = 0;

			if($comm_percent!=""){

				$tmp_comm_percent = intval(str_replace("%", "", $comm_percent));

				$comm_value = ($qty*$uprice)*($tmp_comm_percent/100);

				$comm_total += $comm_value;

			}

			$sql = "SELECT * FROM `tbl_quote_item` WHERE `qdoci_id` = '$qdoci_id' AND enable='1' AND (`pro_name` LIKE '%Royalty%' OR `pro_name` LIKE '%Credit Card%' OR `pro_name` LIKE '%Shipping%')";
			$shipp = Yii::app()->db->createCommand($sql)->queryAll();

			$shippcount= count($shipp);

			$tmp_amount = $qty*$uprice;



			$return_html .= '<tr><td style="padding:10px 0px; text-align:left; display: block; white-space: pre-wrap; word-break: break-all; word-wrap: break-word;">';

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



			if($action_from=="va"){

				$return_html .= '<input type="hidden" name="qdoci_id[]" value="'.$row_qitem["qdoci_id"].'">';

				$return_html .= '<input style="width:100%; font-weight:bold;" type="text" name="pro_name[]" value="'.htmlspecialchars($row_qitem["pro_name"]).'">';

				$return_html .= '<br><textarea style="width:100%; min-height:70px;" name="pro_desc[]">'.$row_qitem["pro_desc"].'</textarea>';

				if($row_qitem["addi_desc"]!=""){

					$return_html .= $row_qitem["addi_desc"];

				}

			}else{

				$return_html .= '<b>'.htmlspecialchars($row_qitem["pro_name"]).'</b><br>'.$row_qitem["pro_desc"];

			}



			$return_html .= '</td>';



			if($action_from=="vc"){



				$return_html .= '<td style="text-align:center; color:#999;">'.(($tmp_comm_percent!=0)?($tmp_comm_percent."%"):"0%");

				if( $user_group=="1" || $user_group=="99" ){

					$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editCommAfterApprove(\''.$qdoc_id.'\',\''.$row_qitem["qdoci_id"].'\',\''.$tmp_comm_percent.'\');"></i>';

				}

				



				$return_html .= '</td>';

				$return_html .= '<td style="text-align:center; color:#999;">'.(($comm_value!="")?number_format($comm_value*$quote_currency,2):"0").'</td>';



			}else if($action_from=="va"){



				$return_html .= '<td style="text-align:center; color:#999;"><input type="hidden" value="'.$row_qitem["qdoci_id"].'" class="qdoci_id_app">';

				$return_html .= '<input type="hidden" value="'.$tmp_amount.'" id="tmp_amount'.$row_qitem["qdoci_id"].'">';

				$return_html .= '<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width:60px; text-align:center;" min="0" type="number" value="'.$tmp_comm_percent.'" id="comm_percent_app'.$row_qitem["qdoci_id"].'"></td>';

				$return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app'.$row_qitem["qdoci_id"].'">'.(($comm_value!="")?number_format($comm_value*$quote_currency,2):"").'</td>';



			}

			$return_html .= '<td style="text-align:center;">';

			if($action_from=="va"){

				$return_html .= '<input name="app_qty[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:55px; text-align:center;" min="0" type="number" value="'.$qty.'" id="app_qty'.$row_qitem["qdoci_id"].'">';

			}else{

				$return_html .= number_format($qty,0);

			}

			$return_html .= '</td>';

			

			$return_html .= '<td style="text-align:right;">';

			if($action_from=="va"){

				$return_html .= '<input name="app_uprice[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width:70px; text-align:center;" min="0.00" type="number" value="'.$uprice.'" id="app_uprice'.$row_qitem["qdoci_id"].'">';

			}else if( $action_from=="vc" && ($user_group=="1" || $user_group=="99") ){

				$return_html .= $pre_cost.number_format($uprice,2);



				$return_html .= ' <i class="edit_ap fa fa-pencil" onclick="return editUPriceAfterApprove(\''.$qdoc_id.'\',\''.$row_qitem["qdoci_id"].'\',\''.$uprice.'\');"></i>';



			}else{

				$return_html .= $pre_cost.number_format($uprice,2);

			}

			$return_html .= '</td><td style="text-align:center;">'.$pre_cost.'<span class="shippcount'.$shippcount.'" id="sp_app_amount'.$row_qitem["qdoci_id"].'">';



			if($action_from=="va"){

				$return_html .= $tmp_amount;

			}else{

				$return_html .= number_format($tmp_amount,2);

			}



			$return_html .= '</span></td>';



			if($action_from=="va"){

				$return_html .= '<td style="text-align:center;cursor:pointer;" class="remover" qdoci_id="'.$row_qitem['qdoci_id'].'"><i style="color:red;" class="fa fa-minus-circle"></i></td>';

			}



			$return_html .='</tr>';



			//$sub_total += $tmp_amount;

		}



		$col_span = 4;

		$col_span2 = 2;

		if($action_from=="vc" || $action_from=="va"){

			$col_span = 6;

			$col_span2 = 4;

		}

		$return_html .= '<tr><td colspan="'.$col_span.'" style="padding:0px;"><hr style="margin:0px;"></td></tr>';



		

		

		$vat_7percent = ($sub_total_main-$row_quote['actual_discount'])*0.07*$quote_currency;

		$f_total = 0.0;

		if($row_quote["inc_vat"]=="yes" || $action_from=="va" || $action_from=="vb"){

            if($action_from!="vp"){

			$return_html .= '<tr><td colspan="2"><span qdoc_id="'.$qdoc_id.'" class="btn btn-success add_row" style="padding:5px;">Add Row  <i class="fa fa-plus" aria-hidden="true"></i></span></td>';

            }

			if($action_from=="vc" || $action_from=="va"){

				$return_html .= '<td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">'.number_format($comm_total,2).'</td><td>&nbsp;</td>';

			}

            $colspaner = '';

            $colspaner_1 = '';

            if($action_from=="vp"){

                $colspaner = "colspan='3'";

                $colspaner_1 = "colspan='1'";

            }

			$return_html .= '<th '.$colspaner.' style="padding: 10px 0px; text-align:right;">Subtotal:</th>';

			$return_html .= '<td '.$colspaner_1.' style="padding: 10px 0px; text-align:right;">'.$pre_cost.'<span id="sp_app_sub_total">'.$sub_total.'</span></td></tr>';



			if($row_quote["inc_vat"]=="yes"){

				$f_total = ($sub_total-($row_quote['actual_discount'])*$quote_currency)+$vat_7percent;

			}else{

				$f_total = $sub_total-($row_quote['actual_discount']*$quote_currency);

			}

			if($action_from!="vp"){

			

    			if ($row_quote["design_url"]!="" || $row_quote["design_url"]!=NULL) {

    				$return_html .= "<input type='hidden' id='tr_total' value='1'>";

    				$return_html .="<tr><th>Design URL</th></tr>";

    				$return_html .="<tr><td class='alert alert-success'><a style='color:white;' href=".$row_quote["design_url"].">".$row_quote["design_url"]."</a></td></tr>";

    			}

    			

    			$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Change Currency:</th><td style="padding: 10px 0px; text-align:right;"><span>'.$select_html.'</span></td></tr>';

    			

    			$return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="discount_percent" class="number_disc_approval" data-shipp="'.$shipping.'" value="'.$row_quote['discount_percent'].'" style="width:55px;"></span></td></tr>';

			

			    $return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="actual_discount" id="actual_disc_approval" data-shipp="'.$shipping.'" value="'.$row_quote['actual_discount']*$quote_currency.'" style="width:55px;"></span></td></tr>';

		    }



			$return_html .= "<input type='hidden' id='tr_total' value='0'>";

			

			if($action_from=="vp" && $row_quote['actual_discount']!="0"){

			    $return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>'.$row_quote['discount_percent'].'%</span></td></tr>';

			

			    $return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>'.$pre_cost.number_format($row_quote['actual_discount']*$quote_currency,2).'</span></td></tr>';

			}

			



			$return_html .= '<tr ><td rowspan="3" colspan="'.$col_span2.'">';

			if($row_quote["sale_note"]!="" && ($action_from=="va" || $action_from=="vb") ){

				$return_html .= 'Salesman Notes (<font color=red>Not shown in Quotation</font>)';

				if($action_from=="vb"){

					$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_edit_sale_note" style="background-color:#DDD;" onclick="return editSaleNote('.$qdoc_id.');"><i class="fa fa-pencil" style="color:#00F;"></i> Edit</button>';

					$return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_save_sale_note" style="background-color:#FFF;" disabled onclick="return saveSaleNote('.$qdoc_id.');"><i class="fa fa-floppy-o" style="color:#070;"></i> Save</button>';

				}

				

				$return_html .= '<br><pre class="alert alert-success" style="width:100%; height:100%; max-width:700px; overflow-x:auto;" id="pre_sale_note'.$qdoc_id.'">'.$row_quote["sale_note"].'</pre>';

			}else{

				$return_html .= '&nbsp;';

			}



			if($action_from=="va"){

				$return_html .= 'Comment (<font color=red>Not shown in Quotation and appear on the top after Approve or Reject.</font>)';

				$return_html .= '<div style="text-align:left;">';

				$return_html .= '<textarea name="approval_comment" id="approval_comment" style="width: 700px; height: 100px; min-height: 101px; margin: 3px;"></textarea>';

				$return_html .= '</div>';

			}



			$return_html .= '</td>';

			$return_html .= '<td style="padding: 10px 0px; text-align:right;">';

			$return_html .= '<input type="hidden" id="sub_total_app" value="'.$sub_total.'">';

			$return_html .= '<input type="hidden" id="pre_cost_app" value="'.$pre_cost.'">';

			$return_html .= '<input type="hidden" name="vat_value_app" id="vat_value_app" value="'.$vat_7percent.'">';

			$return_html .= '<input type="hidden" id="total_value_app" value="'.$f_total.'">';



			

			

			if($row_quote["approve_status"]=="new" && ( $user_group=="1" || $user_group=="99" ) ){

				$return_html .= '<span class="subnvat"><input type="checkbox" name="inc_vat_app" id="inc_vat_app" value="yes" onclick="changeIncludeVATApprove();" ';

				if($row_quote["inc_vat"]=="yes"){

					$return_html .= 'checked';

				}

				$return_html .= '>';

			}

			$return_html .= ' VAT 7%:</span></td>';

			$return_html .= '<td style="padding: 10px 0px; text-align:right;"><span class="subnvat" id="sp_show_vat_value_app">';

			if($row_quote["inc_vat"]=="yes"){

				$return_html .= $pre_cost.number_format($vat_7percent,2);

			}

			$return_html .= '</span></td></tr>';



			$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Total:</span></th>';

			$return_html .= '<td style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat" id="sp_show_total_value_app">'.$pre_cost.number_format($f_total,2).'</span></td></tr>';

			

			

			$return_html .= '<tr ><th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total ('.$row_curr["curr_name"].'):</th>';

			$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="'.$pre_cost.'">'.$pre_cost.number_format($f_total,2).'</span></th></tr>';

		

		}else{

			//$f_total = $sub_total;

            $f_total = $row_quote["grand_total"]*$quote_currency;

			$return_html .= '<tr ><td>&nbsp;</td>';

			$colspan_grand = "colspan='2'";

			if($action_from=="vc" || $action_from=="va"){

				$return_html .= '<td>&nbsp;</td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;" id="td_comm_total">'.number_format($comm_total,2).'</td>';

			}

			if($action_from=="vp" && $row_quote['actual_discount']!="0"){

			    $return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>'.$row_quote['discount_percent'].'%</span></td></tr>';

			

			    $return_html .= '<tr><th colspan="3" style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>'.$pre_cost.number_format($row_quote['actual_discount'],2).'</span></td></tr>';

			    $colspan_grand = "colspan='3'";

			}

			$return_html .= '<th '.$colspan_grand.' style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span class="subnvat">Grand </span>Total ('.$row_quote["quote_curr"].'):</th>';

			$return_html .= '<th style="padding: 10px 0px; border-top:1px solid #BBB; text-align:right;"><span id="sp_show_gtotal_value_app" prefix="'.$pre_cost.'">'.$pre_cost.number_format($f_total,2).'</span></th></tr>';

		}



		



		$return_html .= '</table>';

		$return_html .= '</td></tr>';



		$return_html .= '</table>';



		if($action_from!="va" && $row_quote["note"]!=""){

			$return_html .= '<b>Notes</b> ';

			$return_html .= '<pre ';

			if($row_quote["approve_status"]=="reject"){

				$return_html .= ' class="alert alert-dark" ';

			}

			$return_html .= '>'.$row_quote["note"].'</pre>';

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

		if($row_quote["approval_comment"]!=""){

			$a_result["approval_comment"] = base64_encode('<div><center><pre class="alert" style="text-align:left; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;" id="approval_comment'.$qdoc_id.'">'.$row_quote["approval_comment"].'</pre></center></div>');

		}



		if($approve_status=="new"){



			$a_result["show_approve"] = "yes";

			$a_result["show_reject"] = "yes";



			if($row_quote["history_qdoc_id"]!=""){



				$a_result["history_inner"] .= '<option value="'.$qdoc_id.'">==Main Document==</option>'; 



				$sql_history = "SELECT qdoc_id,add_date FROM tbl_quote_doc WHERE qdoc_id IN (".rtrim($row_quote["history_qdoc_id"],',').") ORDER BY add_date DESC; ";

				//$a_result["history_inner"] .= $sql_history;

				$a_history = Yii::app()->db->createCommand($sql_history)->queryAll();

				foreach($a_history as $tmp_key_his => $row_history){

					$a_result["history_inner"] .= '<option value="'.$row_history["qdoc_id"].'">'.$row_history["add_date"].'</option>'; 

				}

				

			}

			

		}else if($approve_status=="approve"){



			$a_result["show_print"] = "yes";



		}

		

		if($action_from=="va"){

		    $a_result["show_approve"] = "yes";

			$a_result["show_reject"] = "yes";

			$a_result["show_print"] = "yes";

		}

		$a_result['note_text'] = $row_quote["note"];

		echo json_encode($a_result);

	    }
	}
	
	public function actionSrNoteUpdate(){
	    $sr_note = addslashes($_POST['noteTextarea']);
	    $conv_id = $_POST['hidden_conv_id'];
	    $full_name = Yii::app()->user->getState('fullName');
	    $fetch_sql = "SELECT jog_code FROM quotation_data WHERE conv_id='$conv_id'";
	    $a_quote = Yii::app()->db->createCommand($fetch_sql)->queryAll();
		$row_quote = $a_quote[0];
		$jog_code = $row_quote['jog_code'];
	    $sql = "UPDATE quotation_data SET conv_notes='$sr_note' WHERE conv_id='$conv_id'";
	    if(Yii::app()->db->createCommand($sql)->execute()){
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

                                                <h1 style="font-size: 48px; font-weight: 400; margin: 2;">SR Note Updated!</h1> <img src="https://online.jog-joinourgame.com/assets/images/logo.png" width="125" height="120" style="display: block; border: 0px;" />

                                            </td>

                                        </tr>

                                    </table>

                                </td>

                            </tr>
                        
                            <tr>

                                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">

                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                                        <tr>

                                            <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">

                                                <p style="margin: 0;" align="center">'.$full_name.' updated SR note on Quotation with JOG CODE - '.$jog_code.'</p>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td bgcolor="#ffffff" align="left">

                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                    <tr>

                                                        <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">

                                                            <table border="0" cellspacing="0" cellpadding="0">

                                                                <tr>

                                                                    <td align="center" style="border-radius: 3px;" bgcolor="#000000"><a href="'.$url.'" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #000000; display: inline-block;">Continue</a></td>

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

                                                <p style="margin: 0;"><a href="'.$url.'" target="_blank" style="color: #000000;">'.$url.'</a></p>

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

		

		$mail=Yii::app()->Smtpmail;

		$mail->Host = 'cvps652.serverhostgroup.com';

        $mail->Port = 587;//465

		$mail->CharSet = 'utf-8'; 

		$mail->SMTPAuth = true;

		$mail->SMTPSecure = 'tls';

		$mail->Username = "no-reply@jog-joinourgame.com";

        $mail->Password = "demo@9090";

		$mail->SetFrom("no-reply@jog-joinourgame.com", 'JOG SPORTS | SALES REP PORTAL');

		$mail->Subject = "SR Note Updated - ".$jog_code;

		$mail->MsgHTML($template3);

		//$mail->AddAddress($mail_customer, $mail_customername);

        $mail->addBcc("ravish@jogsportswear.com");

	    $mail->AddAddress('nam@jogsportswear.com');
	    $mail->AddAddress('note@jogsportswear.com');
	    $mail->AddAddress('mo@jogsportswear.com');

	    

		if(!$mail->Send()) {


		}else {


			//Yii::app()->user->setFlash('success', 'Message Already sent!');

		}

		$mail->ClearAddresses();
	    }
	    die(json_encode(array('status'=>1,'conv_id'=>$conv_id)));
	}


	
	//-------------------Update and add new Customer Type ------------------- 

	function UpdateCustomerTypeList($customer_id, $customer_type)
	{
		if ($customer_id && $customer_type) {
			$customer_exsists = "SELECT id FROM estimate_customer_type  Where customer_id ='$customer_id'";
			$Id = Yii::app()->db->createCommand($customer_exsists)->queryScalar();
					if($Id) {
					$updateSql = "UPDATE estimate_customer_type SET customer_type='$customer_type' WHERE id='$Id'";
					Yii::app()->db->createCommand($updateSql)->execute();
					} else {
					$insertSql = "INSERT INTO estimate_customer_type(customer_type, customer_id) 
							    VALUES('$customer_type', '$customer_id')";
					Yii::app()->db->createCommand($insertSql)->execute();
					}


			return true;
		} else {
			return false;
		}
	}

}