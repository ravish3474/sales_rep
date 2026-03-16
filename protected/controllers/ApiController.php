<?php



use PhpOffice\PhpSpreadsheet\Cell\DataType;



class ApiController extends CController

{

    //<!-------------------------login API-----------------!>



    public function actionLogin()

    {

        $data = CJSON::decode(file_get_contents('php://input'), true);

        //print_r($data);

        $username = isset($data['username']) ? $data['username'] : null;

        $password = isset($data['password']) ? $data['password'] : null;

        $device_token = isset($data['device_token']) ? $data['device_token'] : null;



        if ($username && $password) {

            $user = User::model()->find('username=:username', array(':username' => $username));

            if ($user && $user->validatePassword($password)) {

                $token = $user->generateAuthToken($device_token);

                $this->sendResponse(200, CJSON::encode(array('token' => $token)));

                return;
            }
        }



        $this->sendResponse(401, 'Unauthorized');
    }



    // Method to validate token and authenticate user

    protected function authenticate()

    {

        $headers = getallheaders();

        //print_r($headers);

        // Log all received headers for debugging

        Yii::log('Headers: ' . print_r($headers, true), 'info', 'application');



        if (isset($headers['Authorization'])) {

            $token = trim($headers['Authorization']);



            // Log the received token for debugging

            Yii::log('Received token: ' . $token, 'info', 'application');



            $user = User::findByAuthToken($token);

            if ($user) {

                Yii::app()->user->setId($user->id);

                return true;
            } else {

                // Log if token is not found in the database

                Yii::log('User not found for token: ' . $token, 'error', 'application');
            }
        } else {

            // Log if Authorization header is missing

            Yii::log('Authorization header missing', 'error', 'application');
        }



        $this->sendResponse(401, 'Unauthorized');

        return false;
    }





    // Example of a protected endpoint

    public function actionProtected()

    {

        if ($this->authenticate()) {

            // Your protected action logic

            $this->sendResponse(200, CJSON::encode(array('message' => 'You have access')));
        }
    }



    private function sendResponse($status = 200, $body = '', $content_type = 'application/json')

    {

        header('HTTP/1.1 ' . $status);

        header('Content-Type: ' . $content_type);

        echo $body;

        Yii::app()->end();
    }
    
    public function actionAddOnlineData(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
          $response = $_POST;
          $myfile = fopen(Yii::app()->basePath ."/runtime/api_response1.txt", "w") or die("Unable to open file!");
          $filePath = Yii::app()->basePath ."/runtime/api_response1.txt"; 

                if (is_writable($filePath)) {
                    
                } else {
                    // Giving write permission to the file (rw-r--r--)
                    if (chmod($filePath, 0666)) {
                        echo json_encode(["status"=> 503 , 'msg' => "File permissions changed successfully!"]);
                    } else {
                        echo json_encode(["status"=> 503 , 'msg' => "Failed to change file permissions."]);
                    }
                }


                if (!empty($response)) {
                //     // Convert the $_POST array into a string format (using print_r for better readability)
                    $formattedResponse = print_r($response, true);

                    $result =  fwrite($myfile, $formattedResponse);
                
                fclose($myfile);
                
                } else {
                    echo "No POST data received!";
                }



        $is_distribution_enable = Yii::app()->db->createCommand("SELECT status FROM lead_distribution")->queryScalar(); 
      
                if($is_distribution_enable == 1){
                      $create_leads  =  TblLeads::AssignLeadAutoMetic();
                      echo ($create_leads) ;
                      die;
                }else{
                      return TblLeads::AsssignLeadManual();
                }
            }else{
                 return false ; 
            }
    
   }



    public function actionLogout()
    {



        if ($this->authenticate()) {

            $headers = getallheaders();

            if (isset($headers['Authorization'])) {

                $token = $headers['Authorization'];

                $sql_item = "DELETE FROM `user_tokens` WHERE `token`= '$token'";
            }

            if (Yii::app()->db->createCommand($sql_item)->execute()) {

                $result = array(

                    'status' => 200,

                    'message' => 'User Logout successfully .'

                );
            } else {

                $result = array(

                    'status' => 200,

                    'message' => 'User Logout false.'

                );
            }

            $this->sendResponse(200, CJSON::encode($result));
        }
    }



    //<!-------------------------login API-----------------!>





    //<!-------------------------USER info API-----------------!>



    public function actionGetUserData()

    {



        if ($this->authenticate()) {

            $userId = Yii::app()->user->getId();

            $user = User::model()->findByPk($userId);



            if ($user !== null) {

                $userData = array(

                    'id' => $user->id,

                    'username' => $user->username,

                    'fullname' => $user->fullname,

                    'phone' => $user->phone,

                    'email' => $user->email,
                    'user_group_id' => $user->user_group_id,

                    // Add other fields you want to include in the response

                );



                $this->sendResponse(200, CJSON::encode($userData));
            } else {

                $this->sendResponse(404, 'User not found');
            }
        }
    }



    public function actionUpdate_userdata()

    {

        if ($this->authenticate()) {

            $userId = Yii::app()->user->getId();

            $password = isset($_POST['password']) ? $_POST['password'] : null;

            $username = $_POST['username'];

            $fullname = $_POST['fullname'];

            $phone = $_POST['phone'];

            $email = $_POST['email'];



            $params = array(':userId' => $userId, ':username' => $username, ':fullname' => $fullname, ':phone' => $phone, ':email' => $email);



            // Handle password update if provided

            if (!is_null($password)) {

                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

                $password_salt = substr(str_shuffle($characters), 0, 6);

                $hashed_password = hash_hmac('ripemd160', $password, $password_salt);



                $params[':password'] = $hashed_password;

                $params[':password_salt'] = $password_salt;



                $sql = "UPDATE `user` SET `username`=:username, `password`=:password, `password_salt`=:password_salt, `fullname`=:fullname, `phone`=:phone, `email`=:email WHERE id = :userId";
            } else {

                $sql = "UPDATE `user` SET `username`=:username, `fullname`=:fullname, `phone`=:phone, `email`=:email WHERE id = :userId";
            }



            // Execute the SQL query

            $command = Yii::app()->db->createCommand($sql);

            $command->bindValues($params);

            $rowsAffected = $command->execute();



            if ($rowsAffected > 0) {

                $result = array(

                    'status' => 200,

                    'message' => 'User data updated successfully.'

                );
            } else {

                $result = array(

                    'status' => 500,

                    'message' => 'Failed to update user data.'

                );
            }



            $this->sendResponse($result['status'], CJSON::encode($result));
        }
    }





    public function actionAlluser()

    {

        $sql_item = "SELECT * FROM `user` WHERE 1";

        $user["data"] = Yii::app()->db->createCommand($sql_item)->queryAll();



        $this->sendResponse(200, CJSON::encode($user));
    }



    //<!-------------------------USER info API-----------------!>





    //<!-------------------------Product info API-----------------!>



    public function actionGet_sale_type($pro = 1)
    {





        $product = $pro;



        $sql_prod_sat = "SELECT * FROM tbl_prod_sale_type WHERE prod_id='" . $product . "';";

        $row_prod_sat = Yii::app()->db->createCommand($sql_prod_sat)->queryAll();

        $result["sat_id_list"] = $row_prod_sat[0]["sat_id_list"];



        $satid =  explode(',', $result["sat_id_list"]);



        foreach ($satid as $key => $value) {

            $sql = "SELECT * FROM tbl_sale_type WHERE sat_id='" . $value . "' ORDER BY sort ASC; ";

            $a_sat[] = Yii::app()->db->createCommand($sql)->queryAll();
        }



        $this->sendResponse(200, CJSON::encode($a_sat));
    }



    public function actionGet_sales_product($type = 1)

    {

        $sales_type = $type;



        $sql_item = "SELECT * FROM `tbl_prod_sale_type` WHERE `sat_id_list` LIKE '%$sales_type%'";

        $result["salestype"] = Yii::app()->db->createCommand($sql_item)->queryAll();


        $response =[];
        foreach ($result["salestype"] as $key => $value) {

            $sql_item = "SELECT * FROM `tbl_product` WHERE `prod_id` = " . $value['prod_id'] . "";
            $result  = Yii::app()->db->createCommand($sql_item)->queryRow();
            if($result){
                // $product['product'][] = $result ; 
                 $response[]= $result ; 
            }
        }
        $product['product']['0'] = $response ; 



        $sql2 = "SELECT * FROM tbl_currency WHERE enable=1 ORDER BY sort ASC; ";

        $product['currency'] = Yii::app()->db->createCommand($sql2)->queryAll();

        $this->sendResponse(200, CJSON::encode($product));
    }



    public function actionGet_currency()

    {

        $sql2 = "SELECT * FROM tbl_currency WHERE enable=1 ORDER BY sort ASC; ";

        $currency['currency'] = Yii::app()->db->createCommand($sql2)->queryAll();

        $this->sendResponse(200, CJSON::encode($currency));
    }



    // public function actionGet_item_product($product = 1, $type = 1, $curr = 1, $page = 1)

    // {

    //     $user_pricing = Yii::app()->user->getState('userPricing');

    //     $comm_type = Yii::app()->user->getState('commissionType');

    //     $prod_id = $product;

    //     $page = $page;

    //     $sat_id = $type;

    //     $curr_id = $curr;



    //     // Define the number of items per page

    //     $page_size = 10; // You can adjust this value as needed



    //     // Calculate the offset

    //     $offset = ($page - 1) * $page_size;



    //     // Query to get the total number of items

    //     $sql_count = "SELECT COUNT(*) as total_items FROM tbl_item LEFT JOIN tbl_item_group ON tbl_item.group_id=tbl_item_group.item_group_id WHERE tbl_item.prod_id=:prod_id AND tbl_item.enable=1";

    //     $count_command = Yii::app()->db->createCommand($sql_count);

    //     $count_command->bindValue(':prod_id', $prod_id, PDO::PARAM_INT);

    //     $total_items = $count_command->queryScalar();



    //     // Query to get the paginated items

    //     $sql_item = "SELECT tbl_item.* FROM tbl_item LEFT JOIN tbl_item_group ON tbl_item.group_id=tbl_item_group.item_group_id WHERE tbl_item.prod_id=:prod_id AND tbl_item.enable=1 ORDER BY tbl_item_group.sort ASC, tbl_item.sort ASC LIMIT :limit OFFSET :offset";

    //     $item_command = Yii::app()->db->createCommand($sql_item);

    //     $item_command->bindValue(':prod_id', $prod_id, PDO::PARAM_INT);

    //     $item_command->bindValue(':limit', $page_size, PDO::PARAM_INT);

    //     $item_command->bindValue(':offset', $offset, PDO::PARAM_INT);

    //     $a_item = $item_command->queryAll();



    //     $where = "";



    //     if ($user_pricing == 0) {

    //         if ($sat_id == 3 && $comm_type == 7) {

    //             $sat_id = 2;

    //             $where = "AND (comm_value='7' OR comm_value='0')";
    //         }
    //     }



    //     $a_item_id_list = array_column($a_item, 'item_id');

    //     $s_item_id_list = implode(",", $a_item_id_list);



    //     $sql_comm = "SELECT * FROM tbl_comm_percent WHERE sat_id=:sat_id AND enable=1 {$where} ORDER BY sort ASC";

    //     $comm_command = Yii::app()->db->createCommand($sql_comm);

    //     $comm_command->bindValue(':sat_id', $sat_id, PDO::PARAM_INT);

    //     $a_comm = $comm_command->queryAll();



    //     if ($user_pricing != 0 && $sat_id == 3) {

    //         $a_comm = array();

    //         $sql_comm = "SELECT * FROM tbl_comm_percent WHERE sat_id='2' AND enable=1 {$where} ORDER BY sort ASC";

    //         $a_comm = Yii::app()->db->createCommand($sql_comm)->queryAll();



    //         $sql_comm = "SELECT * FROM tbl_comm_percent WHERE sat_id='3' AND enable=1 {$where} ORDER BY sort ASC";

    //         $result["a_comm_low"] = Yii::app()->db->createCommand($sql_comm)->queryAll();
    //     }



    //     $a_comm_per_id = array_column($a_comm, 'comm_per_id');

    //     $s_comm_per_id_list = implode(",", $a_comm_per_id);



    //     $sql_price_guide = "SELECT * FROM tbl_price_guide WHERE sat_id=:sat_id AND curr_id=:curr_id AND item_id IN ({$s_item_id_list})";

    //     if (!empty($a_comm_per_id)) {

    //         $sql_price_guide .= " AND comm_per_id IN ({$s_comm_per_id_list})";
    //     }



    //     if ($user_pricing != 0 && $sat_id == 3) {

    //         $sql_price_guide = "SELECT * FROM tbl_price_guide WHERE sat_id='2' AND curr_id=:curr_id AND item_id IN ({$s_item_id_list})";

    //         if (!empty($a_comm_per_id)) {

    //             $sql_price_guide .= " AND comm_per_id IN ({$s_comm_per_id_list})";
    //         }
    //     }



    //     $price_guide_command = Yii::app()->db->createCommand($sql_price_guide);

    //     $price_guide_command->bindValue(':sat_id', $sat_id, PDO::PARAM_INT);

    //     $price_guide_command->bindValue(':curr_id', $curr_id, PDO::PARAM_INT);

    //     $row_pguide = $price_guide_command->queryAll();



    //     $a_pguide = array();

    //     foreach ($row_pguide as $row) {

    //         $a_pguide[$row["item_id"]][$row["comm_per_id"]] = $row;
    //     }



    //     $data = [];

    //     foreach ($a_item as $item) {

    //         $item_id = $item['item_id'];



    //         $itembadges = "SELECT * FROM `tbl_item_badges` WHERE `item_id` = " . $item_id . "   ORDER BY `id` DESC LIMIT 1";

    //         $result = Yii::app()->db->createCommand($itembadges)->queryAll();

    //         if ((count($result) > 0) && isset($result['status']) && $result['status'] == 1) {

    //             $badegrs =  $result;
    //         } else {



    //             $badge = "SELECT * FROM tbl_badges_products WHERE pro_id = $prod_id";

    //             $badgedata = Yii::app()->db->createCommand($badge)->queryAll();



    //             if (!empty($badgedata)) {

    //                 $sq = "SELECT * FROM `tbl_badges` WHERE id = " . $badgedata[0]['badges_id'] . "";

    //                 $badged = Yii::app()->db->createCommand($sq)->queryAll();

    //                 $badegrs =  $badged;
    //             } else {

    //                 $badged = [];

    //                 $badegrs =  $badged;
    //             }
    //         }

    //         $data[] = [

    //             'a_item' => $item,

    //             'a_pguide' => isset($a_pguide[$item_id]) ? $a_pguide[$item_id] : [],

    //             'a_comm' => $a_comm,

    //             'badged' => $badegrs

    //         ];
    //     }







    //     // Metadata for pagination

    //     $result = [

    //         "data" => $data,

    //         "pagination" => [

    //             "total_items" => $total_items,

    //             "current_page" => $page,

    //             "page_size" => $page_size,

    //             "total_pages" => ceil($total_items / $page_size)

    //         ]

    //     ];



    //     $this->sendResponse(200, CJSON::encode($result));
    // }

    public function actionGet_item_product($product = 1, $type = 1, $curr = 1, $page = 1, $group_id = null)
    {
        $user_pricing = Yii::app()->user->getState('userPricing');
        $comm_type = Yii::app()->user->getState('commissionType');
        $prod_id = $product;
        $page = $page;
        $sat_id = $type;
        $curr_id = $curr;

        // Define the number of items per page
        $page_size = 10;

        // Calculate the offset
        $offset = ($page - 1) * $page_size;

        // Base query for counting total items
        $sql_count = "SELECT COUNT(*) as total_items 
                    FROM tbl_item 
                    LEFT JOIN tbl_item_group ON tbl_item.group_id = tbl_item_group.item_group_id 
                    WHERE tbl_item.prod_id = :prod_id AND tbl_item.enable = 1";

        // Modify the query if `group_id` is provided
        if (!is_null($group_id)) {
            $sql_count .= " AND tbl_item.group_id = :group_id";
        }

        // Prepare and execute the count query
        $count_command = Yii::app()->db->createCommand($sql_count);
        $count_command->bindValue(':prod_id', $prod_id, PDO::PARAM_INT);

        if (!is_null($group_id)) {
            $count_command->bindValue(':group_id', $group_id, PDO::PARAM_INT);
        }

        $total_items = $count_command->queryScalar();

        // Base query to get paginated items
        $sql_item = "SELECT tbl_item.* 
                    FROM tbl_item 
                    LEFT JOIN tbl_item_group ON tbl_item.group_id = tbl_item_group.item_group_id 
                    WHERE tbl_item.prod_id = :prod_id AND tbl_item.enable = 1";

        // Modify the query if `group_id` is provided
        if (!is_null($group_id)) {
            $sql_item .= " AND tbl_item.group_id = :group_id";
        }

        $sql_item .= " ORDER BY tbl_item_group.sort ASC, tbl_item.sort ASC 
                    LIMIT :limit OFFSET :offset";

        // Prepare and execute the item query
        $item_command = Yii::app()->db->createCommand($sql_item);
        $item_command->bindValue(':prod_id', $prod_id, PDO::PARAM_INT);

        if (!is_null($group_id)) {
            $item_command->bindValue(':group_id', $group_id, PDO::PARAM_INT);
        }

        $item_command->bindValue(':limit', $page_size, PDO::PARAM_INT);
        $item_command->bindValue(':offset', $offset, PDO::PARAM_INT);
        $a_item = $item_command->queryAll();

        // The rest of the code remains unchanged...

        // Additional logic for fetching commissions, price guide, and badges
        $where = "";



        if ($user_pricing == 0) {

            if ($sat_id == 3 && $comm_type == 7) {

                $sat_id = 2;

                $where = "AND (comm_value='7' OR comm_value='0')";
            }
        }



        $a_item_id_list = array_column($a_item, 'item_id');

        $s_item_id_list = implode(",", $a_item_id_list);



        $sql_comm = "SELECT * FROM tbl_comm_percent WHERE sat_id=:sat_id AND enable=1 {$where} ORDER BY sort ASC";

        $comm_command = Yii::app()->db->createCommand($sql_comm);

        $comm_command->bindValue(':sat_id', $sat_id, PDO::PARAM_INT);

        $a_comm = $comm_command->queryAll();



        if ($user_pricing != 0 && $sat_id == 3) {

            $a_comm = array();

            $sql_comm = "SELECT * FROM tbl_comm_percent WHERE sat_id='2' AND enable=1 {$where} ORDER BY sort ASC";

            $a_comm = Yii::app()->db->createCommand($sql_comm)->queryAll();



            $sql_comm = "SELECT * FROM tbl_comm_percent WHERE sat_id='3' AND enable=1 {$where} ORDER BY sort ASC";

            $result["a_comm_low"] = Yii::app()->db->createCommand($sql_comm)->queryAll();
        }



        $a_comm_per_id = array_column($a_comm, 'comm_per_id');

        $s_comm_per_id_list = implode(",", $a_comm_per_id);



        $sql_price_guide = "SELECT * FROM tbl_price_guide WHERE sat_id=:sat_id AND curr_id=:curr_id AND item_id IN ({$s_item_id_list})";

        if (!empty($a_comm_per_id)) {

            $sql_price_guide .= " AND comm_per_id IN ({$s_comm_per_id_list})";
        }



        if ($user_pricing != 0 && $sat_id == 3) {

            $sql_price_guide = "SELECT * FROM tbl_price_guide WHERE sat_id='2' AND curr_id=:curr_id AND item_id IN ({$s_item_id_list})";

            if (!empty($a_comm_per_id)) {

                $sql_price_guide .= " AND comm_per_id IN ({$s_comm_per_id_list})";
            }
        }



        $price_guide_command = Yii::app()->db->createCommand($sql_price_guide);

        $price_guide_command->bindValue(':sat_id', $sat_id, PDO::PARAM_INT);

        $price_guide_command->bindValue(':curr_id', $curr_id, PDO::PARAM_INT);

        $row_pguide = $price_guide_command->queryAll();



        $a_pguide = array();

        foreach ($row_pguide as $row) {

            $a_pguide[$row["item_id"]][$row["comm_per_id"]] = $row;
        }



        $data = [];

        foreach ($a_item as $item) {

            $item_id = $item['item_id'];



            $itembadges = "SELECT * FROM `tbl_item_badges` WHERE `item_id` = " . $item_id . "   ORDER BY `id` DESC LIMIT 1";

            $result = Yii::app()->db->createCommand($itembadges)->queryAll();

            if ((count($result) > 0) && isset($result[0]['status']) && $result[0]['status'] == 1) {

                $badegrs =  $result;
            } else {



                $badge = "SELECT * FROM tbl_badges_products WHERE pro_id = $prod_id";

                $badgedata = Yii::app()->db->createCommand($badge)->queryAll();



                if (!empty($badgedata)) {

                    $sq = "SELECT * FROM `tbl_badges` WHERE id = " . $badgedata[0]['badges_id'] . "";

                    $badged = Yii::app()->db->createCommand($sq)->queryAll();

                    $badegrs =  $badged;
                } else {

                    $badged = [];

                    $badegrs =  $badged;
                }
            }

            $data[] = [

                'a_item' => $item,

                'a_pguide' => isset($a_pguide[$item_id]) ? $a_pguide[$item_id] : [],

                'a_comm' => $a_comm,

                'badged' => $badegrs

            ];
        }

        // Returning the response with pagination
        $result = [
            "data" => $data,
            "pagination" => [
                "total_items" => $total_items,
                "current_page" => $page,
                "page_size" => $page_size,
                "total_pages" => ceil($total_items / $page_size)
            ]
        ];

        $this->sendResponse(200, CJSON::encode($result));
    }


    public function actionGet_extra($prod, $curr = 1)

    {



        $curr_id = $curr;

        $sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $curr_id . "'; ";

        $a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

        $result['row_curr'] = $a_curr[0];



        $prod_id = $prod;

        // 		$sql_extra = "SELECT * FROM tbl_extra WHERE curr_id='".$curr_id."' AND prod_id='".$prod_id."' ORDER BY sort_no ASC; ";

        $sql_extra  = "SELECT

            CASE

                WHEN cel.extra_id IS NOT NULL THEN cei.cat_ex_name

                ELSE 'OTHERS'

            END AS group_name,

            te.*

        FROM

            tbl_extra AS te

        LEFT JOIN

            category_extra_listing AS cel ON te.extra_id = cel.extra_id

        LEFT JOIN

            category_extra_items AS cei ON cel.cat_ex_id = cei.cat_ex_id

        WHERE

            te.curr_id = '" . $curr_id . "'

            AND te.prod_id = '" . $prod_id . "'

        ORDER BY

            group_name ASC,

            te.sort_no ASC;

        ";

        $result["a_extra"] = Yii::app()->db->createCommand($sql_extra)->queryAll();

        //$count_sort = 1;

        if (count($result['a_extra']) > 0) {

            foreach ($result["a_extra"] as $incr) {

                $sql_update_doc = "UPDATE tbl_extra SET sort_no='" . $incr['extra_id'] . "',sort_status='1' WHERE  extra_id='" . $incr['extra_id'] . "' AND sort_status='0'";

                Yii::app()->db->createCommand($sql_update_doc)->execute();

                //$count_sort++;

            }
        }

        if (sizeof($result["a_extra"]) > 0) {



            if (isset($_GET["ade"]) && $_GET["ade"] == "yes") {

                $result["admin_edit"] = "yes";
            } else {

                $result["admin_edit"] = "no";
            }



            $this->sendResponse(200, CJSON::encode($result));
        } else {



            $result = array(

                'status' => 200,

                'message' => 'data not found'

            );

            $this->sendResponse(200, CJSON::encode($result));
        }
    }



    public function actionShow_additional()

    {

        $item_id = $_POST["item_id"];

        $curr_id = $_POST['curr'];



        $sql_addi = "SELECT * FROM tbl_additional_new WHERE item_id='" . $item_id . "' AND curr_id='" . $curr_id . "' ORDER BY ordering ASC; ";

        $a_addi = Yii::app()->db->createCommand($sql_addi)->queryAll();



        if (sizeof($a_addi) > 0) {



            $result["a_addi"] = $a_addi;

            $this->sendResponse(200, CJSON::encode($result));
        } else {

            $result = array(

                'status' => 200,

                'message' => 'data not found'

            );

            $this->sendResponse(200, CJSON::encode($result));
        }
    }



    public function actionSubmit_new_addi()

    {

        $item_id = $_POST["item_id"];

        $curr_id = $_POST["curr_id"];

        $addi_name = addslashes($_POST["addi_name"]);

        $addi_value = $_POST["addi_value"];





        $sql_max_sort = "SELECT MAX(ordering) AS max_sort FROM tbl_additional_new WHERE item_id='" . $item_id . "'; ";

        $a_max_sort = Yii::app()->db->createCommand($sql_max_sort)->queryAll();



        $next_ordering = 1;

        if (sizeof($a_max_sort) > 0) {

            $next_ordering = intval($a_max_sort[0]["max_sort"]) + 1;
        }



        $sql_insert = "INSERT INTO tbl_additional_new (addi_name,item_id,curr_id,ordering,addi_value) VALUES ('" . addslashes($addi_name) . "','" . $item_id . "','" . $curr_id . "','" . $next_ordering . "','" . $addi_value . "');";



        Yii::app()->db->createCommand($sql_insert)->execute();

        $result = array(

            'status' => 200,

            'message' => 'success'

        );

        $this->sendResponse(200, CJSON::encode($result));
    }



    public function actionSort_addi()

    {



        //$a_addi_id = $_POST["sort_addi_id"];

        $rawData = file_get_contents('php://input');



        // Clean up control characters

        $cleanData = preg_replace('/[[:cntrl:]]/', '', $rawData);



        // Decode JSON data into PHP array

        $a_addi_id = json_decode($cleanData, true);

        // print_r($reqdata);

        // die;



        $sql_update = "";

        for ($i = 0; $i < sizeof($a_addi_id['sort_addi_id']); $i++) {

            $sql_update .= "UPDATE tbl_additional_new SET ordering='" . ($i + 1) . "' WHERE addi_id='" . $a_addi_id['sort_addi_id'][$i] . "'; ";
        }



        $a_result = array();

        if ($sql_update == "") {

            $a_result["result"] = "fail";

            $a_result["msg"] = "Nothing update.";
        } else {



            Yii::app()->db->createCommand($sql_update)->execute();

            $a_result["result"] = "success";
        }



        $result = array(

            'status' => 200,

            'message' => $a_result

        );

        $this->sendResponse(200, CJSON::encode($result));
    }



    public function  actionItem_gdrive()
    {

        $item_id = Yii::app()->db->quoteValue($_POST['item_id']); // Sanitize input to prevent SQL injection

        $sql = "SELECT * FROM tbl_item_gdrive_link WHERE item_id=$item_id";

        $data['data'] = Yii::app()->db->createCommand($sql)->queryAll();

        $this->sendResponse(200, CJSON::encode($data));
    }



    //<!-------------------------Product info API-----------------!>





    //<!-------------------------order info  API-----------------!>



    public function actionHeader_comp()
    {

        $sql_comp = "SELECT * FROM tbl_comp_info WHERE enable=1; ";

        $a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();

        $this->sendResponse(200, CJSON::encode($a_comp));
    }



    public function actionCust_info()
    {

        $sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 ORDER BY cust_name ASC; ";

        $a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();

        $this->sendResponse(200, CJSON::encode($a_cust));
    }



    //<!-------------------------order info  API-----------------!>







    //-------------------------------CART API's---------------------------



    public function  actionAddToCart()
    {

        //print_r($_POST);

        if ($this->authenticate()) {

            $user_id = Yii::app()->user->getId();



            if (!isset($_POST["prg_id"]) || $_POST["prg_id"] == "") {

                echo "Invalid parameter.";

                exit();
            }



            $prg_id = $_POST["prg_id"];

            if (isset($_POST["qty"]) && $_POST["qty"] != "") {                                
                $qty= $_POST["qty"];
            }else{
                $qty=  0;
            }



            $sql_select = "SELECT tbl_price_guide.*,tbl_product.prod_type,tbl_comm_percent.comm_value,tbl_comm_percent.qty_name,tbl_item.item_name";

            $sql_select .= ",CONCAT(IF(tbl_item.item_style IS NULL,'',tbl_item.item_style),IF(tbl_item.item_detail IS NULL,'',tbl_item.item_detail),IF(tbl_item.item_fabric_opt IS NULL,'',tbl_item.item_fabric_opt)) AS desc_show ";

            $sql_select .= " FROM tbl_price_guide ";

            $sql_select .= " LEFT JOIN tbl_item ON tbl_price_guide.item_id=tbl_item.item_id ";

            $sql_select .= " LEFT JOIN tbl_product ON tbl_item.prod_id=tbl_product.prod_id ";

            $sql_select .= " LEFT JOIN tbl_comm_percent ON tbl_price_guide.comm_per_id=tbl_comm_percent.comm_per_id ";

            $sql_select .= " WHERE tbl_price_guide.prg_id='" . $prg_id . "'; ";



            $row_select = Yii::app()->db->createCommand($sql_select)->queryAll();





            if (count($row_select) > 0) {

                $row_prg = $row_select[0];
            } else {

                $result = array(

                    'status' => 200,

                    'message' => 'No data found'

                );

                $this->sendResponse(200, CJSON::encode($result));
            }



            $have_tmp = 0;

            $a_tmp_obj = array();



            if (isset($_POST["JOG_CART_info"])) {

                $sql_select = " SELECT * FROM tbl_cart_temp WHERE cart_tmp_id='" . $_POST["JOG_CART_info"] . "'; ";

                $a_tmp_obj = Yii::app()->db->createCommand($sql_select)->queryAll();

                if (sizeof($a_tmp_obj) > 0) {

                    $have_tmp = 1;
                }
            }



            if ($have_tmp == 0) {



                $a_cart_info["currency"] = $row_prg["curr_id"];



                $a_cart_info["item"][0]["product_type"] = $row_prg["prod_type"];

                $a_cart_info["item"][0]["item_id"] = $row_prg["item_id"];

                $a_cart_info["item"][0]["prg_id"] = $row_prg["prg_id"];

                $a_cart_info["item"][0]["uprice"] = $row_prg["price"];

                $a_cart_info["item"][0]["qty_note"] = $row_prg["qty_name"];

                $a_cart_info["item"][0]["comm_percent"] = $row_prg["comm_value"];



                $a_cart_info["item"][0]["item_name"] = $row_prg["item_name"];

                $a_cart_info["item"][0]["desc_show"] = str_replace(",", ",\n", $row_prg["desc_show"]);

                $a_cart_info["item"][0]["addi_id_list"] = "";

                $a_cart_info["item"][0]["qty"] = $qty;



                $sql_delete_tmp = "DELETE FROM tbl_cart_temp WHERE user_id=" . $user_id;

                Yii::app()->db->createCommand($sql_delete_tmp)->execute();



                $tmp_json = json_encode($a_cart_info);

                $sql_insert_tmp = "INSERT INTO tbl_cart_temp (user_id,obj_tmp) VALUES (" . $user_id . ",'" . base64_encode($tmp_json) . "');";

                Yii::app()->db->createCommand($sql_insert_tmp)->execute();



                $cart_tmp_id = Yii::app()->db->getLastInsertID();



                setcookie("JOG_CART_info", $cart_tmp_id, time() + 36000); //10 hours



                $return_result = "success";
            } else {



                $s_tmp_obj = base64_decode($a_tmp_obj[0]["obj_tmp"]);



                $obj_cart_info = (array)json_decode($s_tmp_obj);



                if ($obj_cart_info["currency"] != $row_prg["curr_id"]) {

                    echo "Please select the same currency as another items or clear cart before.";

                    exit();
                }



                $a_item = (array)$obj_cart_info["item"];



                $flag_dup = 0;



                $next_index = sizeof($a_item);



                $obj_cart_info["item"] = (array)$obj_cart_info["item"];



                $obj_cart_info["item"][$next_index] = array();



                $obj_cart_info["item"][$next_index]["product_type"] = $row_prg["prod_type"];

                $obj_cart_info["item"][$next_index]["item_id"] = $row_prg["item_id"];

                $obj_cart_info["item"][$next_index]["prg_id"] = $row_prg["prg_id"];

                $obj_cart_info["item"][$next_index]["uprice"] = $row_prg["price"];

                $obj_cart_info["item"][$next_index]["qty_note"] = $row_prg["qty_name"];

                $obj_cart_info["item"][$next_index]["comm_percent"] = $row_prg["comm_value"];



                $obj_cart_info["item"][$next_index]["item_name"] = $row_prg["item_name"];

                $obj_cart_info["item"][$next_index]["desc_show"] = str_replace(",", ",\n", $row_prg["desc_show"]);

                $obj_cart_info["item"][$next_index]["addi_id_list"] = "";

                $obj_cart_info["item"][$next_index]["qty"] = $qty;



                $tmp_json = json_encode($obj_cart_info);

                $sql_update_tmp = "UPDATE tbl_cart_temp SET obj_tmp='" . base64_encode($tmp_json) . "' WHERE cart_tmp_id='" . $_POST["JOG_CART_info"] . "';";

                Yii::app()->db->createCommand($sql_update_tmp)->execute();



                $cart_tmp_id = $_POST["JOG_CART_info"];

                //setcookie("JOG_CART_info",json_encode($obj_cart_info));



                $return_result = "success";
            }



            $result = array(

                'status' => 200,

                'message' => $return_result,

                'cart_id' => $cart_tmp_id

            );

            $this->sendResponse(200, CJSON::encode($result));

            die;
        }
    }



    public function actionExtra_Cart()

    {



        if (!isset($_POST["extra_id"]) || ($_POST["extra_id"] == "")) {

            echo "Invalid parameter.";

            exit();
        }



        if (!isset($_POST["value_id"]) || ($_POST["value_id"] == "")) {

            echo "Invalid parameter.";

            exit();
        }



        $sql = " SELECT * FROM tbl_extra WHERE extra_id='" . $_POST["extra_id"] . "';";

        $a_extra = Yii::app()->db->createCommand($sql)->queryAll();

        $row_extra = $a_extra[0];



        if (isset($_POST["JOG_CART_info"])) {



            $sql_select = " SELECT * FROM tbl_cart_temp WHERE cart_tmp_id='" . $_POST["JOG_CART_info"] . "'; ";

            $a_tmp_obj = Yii::app()->db->createCommand($sql_select)->queryAll();

            $s_tmp_obj = base64_decode($a_tmp_obj[0]["obj_tmp"]);



            $a_cart_info = (array)json_decode($s_tmp_obj);



            if ($a_cart_info["currency"] != $row_extra["curr_id"]) {

                echo "Please select the same currency as another items or clear cart before.";



                exit();
            }



            $a_cart_info["item"] = (array)$a_cart_info["item"];

            $next_index = sizeof($a_cart_info["item"]);



            $a_cart_info["item"][$next_index] = array();



            $a_cart_info["item"][$next_index]["product_type"] = "extra";

            $a_cart_info["item"][$next_index]["item_id"] = "e" . $row_extra["extra_id"];

            $a_cart_info["item"][$next_index]["prg_id"] = "";

            if ($_POST["value_id"] == 0) {

                $a_cart_info["item"][$next_index]["uprice"] = $row_extra["extra_value"];
            } elseif ($_POST["value_id"] == 1) {

                $a_cart_info["item"][$next_index]["uprice"] = $row_extra["extra_value_1"];
            } elseif ($_POST["value_id"] == 2) {

                $a_cart_info["item"][$next_index]["uprice"] = $row_extra["extra_value_2"];
            } else {

                $a_cart_info["item"][$next_index]["uprice"] = $row_extra["extra_value_3"];
            }

            $a_cart_info["item"][$next_index]["qty_note"] = "MSRP";

            $a_cart_info["item"][$next_index]["comm_percent"] = "";



            $a_cart_info["item"][$next_index]["item_name"] = $row_extra["extra_name"];

            $a_cart_info["item"][$next_index]["desc_show"] = $row_extra["extra_desc"];

            $a_cart_info["item"][$next_index]["addi_id_list"] = "";

            $a_cart_info["item"][$next_index]["qty"] = 0;



            $tmp_json = json_encode($a_cart_info);

            $sql_update_tmp = "UPDATE tbl_cart_temp SET obj_tmp='" . base64_encode($tmp_json) . "' WHERE cart_tmp_id='" . $_POST["JOG_CART_info"] . "';";

            Yii::app()->db->createCommand($sql_update_tmp)->execute();



            //setcookie("JOG_CART_info",json_encode($a_cart_info));

            $cart_tmp_id = $_POST["JOG_CART_info"];
        } else {



            $a_cart_info["currency"] = $row_extra["curr_id"];



            $a_cart_info["item"][0]["product_type"] = "extra";

            $a_cart_info["item"][0]["item_id"] = "e" . $row_extra["extra_id"];

            $a_cart_info["item"][0]["prg_id"] = "";

            if ($_POST["value_id"] == 0) {

                $a_cart_info["item"][0]["uprice"] = $row_extra["extra_value"];
            } elseif ($_POST["value_id"] == 1) {

                $a_cart_info["item"][0]["uprice"] = $row_extra["extra_value_1"];
            } elseif ($_POST["value_id"] == 2) {

                $a_cart_info["item"][0]["uprice"] = $row_extra["extra_value_2"];
            } else {

                $a_cart_info["item"][0]["uprice"] = $row_extra["extra_value_3"];
            }

            $a_cart_info["item"][0]["qty_note"] = "MSRP";

            $a_cart_info["item"][0]["comm_percent"] = "";



            $a_cart_info["item"][0]["item_name"] = $row_extra["extra_name"];

            $a_cart_info["item"][0]["desc_show"] = $row_extra["extra_desc"];

            $a_cart_info["item"][0]["addi_id_list"] = "";

            $a_cart_info["item"][0]["qty"] = 0;



            //setcookie("JOG_CART_info",json_encode($a_cart_info),time()+36000); //10 hours

            if ($this->authenticate()) {

                $user_id = Yii::app()->user->getId();

                //$user_id = Yii::app()->user->getState('userKey');



                $sql_delete_tmp = "DELETE FROM tbl_cart_temp WHERE user_id=" . $user_id;

                Yii::app()->db->createCommand($sql_delete_tmp)->execute();



                $tmp_json = json_encode($a_cart_info);

                $sql_insert_tmp = "INSERT INTO tbl_cart_temp (user_id,obj_tmp) VALUES (" . $user_id . ",'" . base64_encode($tmp_json) . "');";

                Yii::app()->db->createCommand($sql_insert_tmp)->execute();



                $cart_tmp_id = Yii::app()->db->getLastInsertID();
            }



            //setcookie("JOG_CART_info", $cart_tmp_id, time() + 36000); //10 hours



        }



        $result = array(

            'status' => 200,

            'message' => $cart_tmp_id

        );

        $this->sendResponse(200, CJSON::encode($result));
    }



    public function actionShow_cart()
    {





        //$n_flag_data = 0;

        $currency = "";



        if (isset($_POST["JOG_CART_info"]) && ($_POST["JOG_CART_info"] != "")) {



            $sql_select = " SELECT * FROM tbl_cart_temp WHERE cart_tmp_id='" . $_POST["JOG_CART_info"] . "'; ";

            $a_tmp_obj = Yii::app()->db->createCommand($sql_select)->queryAll();



            if (count($a_tmp_obj) > 0) {

                $s_tmp_obj = base64_decode($a_tmp_obj[0]["obj_tmp"]);
            } else {

                $result = array(

                    'status' => 200,

                    'message' => 'Cart is empty'

                );

                $this->sendResponse(200, CJSON::encode($result));
            }



            $obj_cart_info = json_decode($s_tmp_obj);



            $a_item = (array)$obj_cart_info->item;



            for ($i = 0; $i < sizeof($a_item); $i++) {



                $row = (array)$a_item[$i];



                $sql2 = " SELECT * FROM tbl_additional_new WHERE item_id='" . $row["item_id"] . "' AND curr_id='" . $obj_cart_info->currency . "' ORDER BY ordering ASC;";

                $addi_list[] = Yii::app()->db->createCommand($sql2)->queryAll();
            }



            $a_data["found_data"] = "yes";

            $a_data["currency"] = $currency;

            $a_data["cart_item"] = $obj_cart_info;

            $a_data["addi_list"] = $addi_list;
        } else {



            $a_data["found_data"] = "no";

            $a_data["currency"] = "";

            $a_data["cart_inner"] = "<center>Empty!</center>";
        }



        // print_r($a_data);

        // die;



        $this->sendResponse(200, CJSON::encode($a_data));
    }



    public function actionLoad_cart()

    {

        $carts_id = $_POST["carts_id"];



        $sql_load = "SELECT * FROM tbl_cart_save WHERE carts_id='" . $carts_id . "'; ";

        $a_load = Yii::app()->db->createCommand($sql_load)->queryAll();



        $a_data = (array)json_decode(base64_decode($a_load[0]["inner_value"]));

        $a_inner_value = (array)json_decode(base64_decode($a_load[0]["inner_value"]));



        $count_row = 1;



        $tmp_html_id = "";



        $a_addi_load = array();

        if (isset($a_data["addi_id"])) {



            $a_addi_load = (array)$a_data["addi_id"];

            foreach ($a_addi_load as $addi_key1 => $a_value1) {

                foreach ($a_value1 as $addi_key2 => $a_value2) {

                    $tmp_expl = explode("|", $a_value2);

                    $a_addi_load[$addi_key1][$addi_key2] = array();

                    $a_addi_load[$addi_key1][$addi_key2]["id"] = $tmp_expl[0];

                    $a_addi_load[$addi_key1][$addi_key2]["value"] = $tmp_expl[1];
                }
            }
        }







        for ($i = 0; $i < sizeof($a_data["item_id"]); $i++) {

            $tmp_s = $a_data["product_type"][$i];

            //print_r($tmp_s);



            if ($tmp_s == "other") {

                $tmp_p = "other" . $count_row;
            } else {

                $tmp_p = $a_data["item_id"][$i];
            }





            if ($tmp_html_id != "") {

                $tmp_html_id .= ",";
            }

            $tmp_html_id .= $tmp_p;



            $a_row = array();

            $tmp_comm_percent = "";



            if ($tmp_s != "other") {

                $sql2 = " SELECT * FROM tbl_additional_new WHERE item_id='" . $a_data["item_id"][$i] . "' AND curr_id='" . $a_data["curr_id"] . "' ORDER BY ordering ASC;";

                $addi_list = Yii::app()->db->createCommand($sql2)->queryAll();



                $tmp_uprice = floatval($a_data["uprice"][$i]);



                foreach ($addi_list as $key_addi => $row_addi) {



                    if (floatval($row_addi[("addi_value")]) != 0) {

                        $show_addi_val = " ";

                        if (floatval($row_addi["addi_value"]) > 0) {

                            $show_addi_val .= "+";
                        }

                        $show_addi_val .= $row_addi["addi_value"];







                        if (isset($a_addi_load[$tmp_p])) {

                            foreach ($a_addi_load[$tmp_p] as $addi_key3 => $a_addi_select) {

                                if ($row_addi["addi_id"] == $a_addi_select["id"]) {

                                    $tmp_uprice += floatval($a_addi_select["value"]);

                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }



        $currency = "";

        $quote_curr = "";

        $sql_curr = " SELECT * FROM tbl_currency WHERE curr_id='" . $a_data["curr_id"] . "'; ";

        $a_tmp_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

        $currency = $a_tmp_curr[0]["curr_name"] . " " . $a_tmp_curr[0]["curr_desc"];

        $quote_curr = $a_tmp_curr[0]["curr_name"];



        $inner_value_array = [];



        // Determine the number of items (assuming all arrays are of the same length)

        $num_items = count($a_inner_value['item_id']);



        for ($i = 0; $i < $num_items; $i++) {

            $inner_value_array[] = [

                'a_qdoci_id' => $a_inner_value['a_qdoci_id'][$i],

                'product_type' => $a_inner_value['product_type'][$i],

                'item_id' => $a_inner_value['item_id'][$i],

                'prg_id' => $a_inner_value['prg_id'][$i],

                'comm_percent' => $a_inner_value['comm_percent'][$i],

                'qty_note' => $a_inner_value['qty_note'][$i],

                'product_item' => $a_inner_value['product_item'][$i],

                'product_desc' => $a_inner_value['product_desc'][$i],

                'qty' => $a_inner_value['qty'][$i],

                'uprice' => $a_inner_value['uprice'][$i],

                'count_item_row' => $a_inner_value['count_item_row'],

                'quote_curr' => $a_inner_value['quote_curr'],

                'curr_id' => $a_inner_value['curr_id'],

                'curr_inner' => $a_inner_value['curr_inner'],

                'num_item' => $a_inner_value['num_item'],

                'draft_name' => $a_inner_value['draft_name'],

                'is_draft' => $a_inner_value['is_draft'],

                'dup_from' => $a_inner_value['dup_from']

            ];
        }



        // Update $a_result with the new structure

        //$a_result["inner_value"] = $a_inner_value;



        $a_result["currency"] = $currency;

        $a_result["inner_value"] = $inner_value_array;



        $a_result["cart_item"] = $tmp_html_id;

        $a_result["found_data"] = $a_data["num_item"];



        $a_result["addi_list"] = "success";

        // echo json_encode($a_result);

        $this->sendResponse(200, CJSON::encode($a_result));
    }



    public function actionUpdate_cart()

    {



        if ($this->authenticate()) {

            $user_id = Yii::app()->user->getId();

            // Read raw POST data

            $rawData = file_get_contents('php://input');



            // Clean up control characters

            $cleanData = preg_replace('/[[:cntrl:]]/', '', $rawData);



            // Decode JSON data into PHP array

            $reqdata = json_decode($cleanData, true);



            if (isset($reqdata['empty']) && $reqdata['empty'] == 0) {

                $sql_delete_tmp = "DELETE FROM tbl_cart_temp WHERE user_id=" . $user_id;

                Yii::app()->db->createCommand($sql_delete_tmp)->execute();

                $result = array(

                    'status' => 200,

                    'message' => 'cart is empty'

                );

                $this->sendResponse(200, CJSON::encode($result));
            }



            // Check if json_decode returned null

            if (json_last_error() !== JSON_ERROR_NONE) {

                $result = array(

                    'status' => 200,

                    'message' => json_last_error_msg()

                );

                $this->sendResponse(200, CJSON::encode($result));
            }



            $n_loop = sizeof($reqdata["item_id"]);



            if ($n_loop > 0) {



                $a_new_obj = array();

                $a_new_obj["currency"] = $reqdata["curr_id"];



                for ($i = 0; $i < $n_loop; $i++) {



                    $a_new_obj["item"][$i]["product_type"] = $reqdata["product_type"][$i];

                    $a_new_obj["item"][$i]["item_id"] = $reqdata["item_id"][$i];

                    $a_new_obj["item"][$i]["prg_id"] = $reqdata["prg_id"][$i];

                    $a_new_obj["item"][$i]["uprice"] = $reqdata["uprice"][$i];

                    $a_new_obj["item"][$i]["qty_note"] = $reqdata["qty_note"][$i];

                    $a_new_obj["item"][$i]["comm_percent"] = $reqdata["comm_percent"][$i];



                    $a_new_obj["item"][$i]["item_name"] = $reqdata["product_item"][$i];

                    $a_new_obj["item"][$i]["desc_show"] = $reqdata["product_desc"][$i];



                    $p_id = $reqdata["item_id"][$i];

                    $addi_id_list = "";

                    if (isset($reqdata["addi_id"][$p_id])) {

                        for ($j = 0; $j < sizeof($reqdata["addi_id"][$p_id]); $j++) {

                            $a_addi_id = explode("|", $reqdata["addi_id"][$p_id][$j]);

                            $addi_id = $a_addi_id[0];

                            if ($addi_id_list != "") {

                                $addi_id_list .= ",";
                            }

                            $addi_id_list .= $addi_id;
                        }
                    }



                    $a_new_obj["item"][$i]["addi_id_list"] = $addi_id_list;

                    $a_new_obj["item"][$i]["qty"] = $reqdata["qty"][$i];
                }



                $tmp_json = json_encode($a_new_obj);



                if (isset($reqdata["JOG_CART_info"])) {



                    $sql_update_tmp = "UPDATE tbl_cart_temp SET obj_tmp='" . base64_encode($tmp_json) . "' WHERE cart_tmp_id='" . $reqdata["JOG_CART_info"] . "';";

                    Yii::app()->db->createCommand($sql_update_tmp)->execute();

                    $cart_tmp_id = $reqdata["JOG_CART_info"];
                } else {



                    $user_id = Yii::app()->user->getId();



                    $sql_delete_tmp = "DELETE FROM tbl_cart_temp WHERE user_id=" . $user_id;

                    Yii::app()->db->createCommand($sql_delete_tmp)->execute();



                    //$tmp_json = json_encode($a_cart_info);

                    $sql_insert_tmp = "INSERT INTO tbl_cart_temp (user_id,obj_tmp) VALUES (" . $user_id . ",'" . base64_encode($tmp_json) . "');";

                    Yii::app()->db->createCommand($sql_insert_tmp)->execute();



                    $cart_tmp_id = Yii::app()->db->getLastInsertID();



                    setcookie("JOG_CART_info", $cart_tmp_id, time() + 36000); //10 hours



                }



                $a_result["result"] = "updated";

                $a_result["num_item"] = $n_loop;
            } else {

                $a_result["result"] = "nothing_change";
            }







            $result = array(

                'status' => 200,

                'message' => $a_result,

                'JOG_CART_info' => $cart_tmp_id

            );

            $this->sendResponse(200, CJSON::encode($result));
        }
    }



    public function actionShow_save_data()
    {



        if ($this->authenticate()) {

            $tmp_user_id = Yii::app()->user->getId();



            $a_load_save = array();

            $sql_load = "SELECT * FROM tbl_cart_save WHERE user_id='" . $tmp_user_id . "' ORDER BY save_time DESC; ";

            $a_load = Yii::app()->db->createCommand($sql_load)->queryAll();





            $this->sendResponse(200, CJSON::encode($a_load));
        }
    }


    public function actionRequest_approve()
    {
        if ($this->authenticate()) {

            $user_id = Yii::app()->user->getId();
            // Read raw POST data
            $rawData = file_get_contents('php://input');
            // Clean up control characters
            $cleanData = preg_replace('/[[:cntrl:]]/', '', $rawData);
            // Decode JSON data into PHP array
            $reqdata = json_decode($cleanData, true);
            // Check if json_decode returned null

            if (json_last_error() !== JSON_ERROR_NONE) {
                $result = array(
                    'status' => 200,
                    'message' => json_last_error_msg()
                );
                $this->sendResponse(200, CJSON::encode($result));
            }
            //$user_group = Yii::app()->user->getState('userGroup');
            $comp_id = $reqdata["head_selector"];
            $sql_comp = "SELECT * FROM tbl_comp_info WHERE comp_id='" . $comp_id . "'; ";
            $a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();
            $row_comp = $a_comp[0];
            $comp_name = $row_comp["comp_name"];
            $comp_info = $row_comp["comp_info"];
            $comp_code = $row_comp["comp_code"];
            $tmp_year = $row_comp["tmp_year"];
            $extra_field = "";
            $extra_value = "";
            $is_editing = "0";
            $edit_for_user_id = "";

            if (isset($reqdata["edit_quote_id"]) && (!isset($reqdata["is_duplicate"]) || $reqdata["is_duplicate"] == "0")) {
                $est_number = $reqdata["edit_est_number"];
                $sql_qdoc = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $reqdata["edit_quote_id"] . "'; ";
                $a_qdoc = Yii::app()->db->createCommand($sql_qdoc)->queryAll();
                $row_qdoc = $a_qdoc[0];
                $is_editing = $row_qdoc["is_editing"];
                $edit_for_user_id = $row_qdoc["user_id"];
                $extra_field = ",history_qdoc_id";
                if ($row_qdoc["history_qdoc_id"] != "") {
                    $extra_value = ",'" . $row_qdoc["history_qdoc_id"] . "," . $row_qdoc["temp_id"] . "'";
                } else {
                    $extra_value = ",'" . $row_qdoc["temp_id"] . "'";
                }
                $sql_disable_doc = "UPDATE tbl_quote_doc SET enable='0' WHERE qdoc_id='" . $reqdata["edit_quote_id"] . "'; ";
                Yii::app()->db->createCommand($sql_disable_doc)->execute();
            } else {
                $doc_number = "000";
                if ($tmp_year == date("Y")) {
                    $year_doc_count = intval($row_comp["year_doc_count"]) + 1;
                    $doc_number .= "" . $year_doc_count;
                    $sql_update_year_doc_count = "UPDATE tbl_comp_info SET year_doc_count='" . $year_doc_count . "' WHERE comp_id='" . $comp_id . "'; ";
                    Yii::app()->db->createCommand($sql_update_year_doc_count)->execute();
                } else {
                    $year_doc_count = 1;
                    $doc_number = "0001";
                    $sql_update_tmp_year = "UPDATE tbl_comp_info SET tmp_year='" . date("Y") . "',year_doc_count='1' WHERE comp_id='" . $comp_id . "'; ";
                    Yii::app()->db->createCommand($sql_update_tmp_year)->execute();
                }
                $est_number = $comp_code . date("Ym") . substr($doc_number, (strlen($doc_number) - 4), 4);
            }

            $cust_id = $reqdata["cust_selector"];
            $sql_cust = "SELECT * FROM tbl_cust_info WHERE cust_id='" . $cust_id . "'; ";
            $a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();
            $row_cust = $a_cust[0];
            $cust_name = $row_cust["cust_name"];
            $cust_info = $row_cust["cust_info"];
            $po_number = $reqdata["po_number"];
            $est_date = $reqdata["est_date"];
            $exp_date = $reqdata["exp_date"];
            $inc_vat = isset($reqdata["inc_vat"]) ? $reqdata["inc_vat"] : "no";
            $add_date = date("Y-m-d H:i:s");
            $num_item = sizeof($reqdata["pro_type"]);
            $curr_id = $reqdata["curr_id"];
            $quote_curr = $reqdata["quote_curr"];
            $sub_total = $reqdata["sub_total"];
            $vat_value = $reqdata["vat_value"];
            $grand_total = $reqdata["gtotal_value"];
            $discount_percent = $reqdata['discount'];
            $actual_discount = $reqdata['actual_discount'];
            $payment_term = $reqdata["payment_term"];
            $sale_note = $reqdata["sale_note"];
            $design_url = $reqdata["design_url"];

            if (isset($reqdata["is_duplicate"]) && $reqdata["is_duplicate"] == "1") {
                $qdoc_id = $reqdata["edit_quote_id"];
                $sql_update_doc = "UPDATE tbl_quote_doc SET user_id='" . $user_id . "',comp_id='" . $comp_id . "',comp_name='" . addslashes($comp_name) . "',comp_info='" . addslashes($comp_info) . "',curr_id='" . $curr_id . "'";
                $sql_update_doc .= ",quote_curr='" . addslashes($quote_curr) . "',payment_term='" . addslashes($payment_term) . "',cust_id='" . $cust_id . "',cust_name='" . addslashes($cust_name) . "'";
                $sql_update_doc .= ",cust_info='" . addslashes($cust_info) . "',est_number='" . $est_number . "',po_number='" . $po_number . "',est_date='" . $est_date . "',exp_date='" . $exp_date . "',inc_vat='" . $inc_vat . "',vat_value='" . $vat_value . "'";
                $sql_update_doc .= ",num_item='" . $num_item . "',discount_percent='" . $discount_percent . "',actual_discount='" . $actual_discount . "',sub_total='" . $sub_total . "',grand_total='" . $grand_total . "',sale_note='" . addslashes($sale_note) . "',design_url='" . addslashes($design_url) . "',note=NULL,approve_status='new'";
                $sql_update_doc .= ",approve_date=NULL,reject_time=NULL,history_qdoc_id=NULL,is_temp=0,temp_id=NULL,is_editing=0,archive=0,is_duplicate=0,add_date='" . $add_date . "' WHERE qdoc_id='" . $qdoc_id . "' ";

                Yii::app()->db->createCommand($sql_update_doc)->execute();
                $delete_old_item = "DELETE FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "'; ";
                Yii::app()->db->createCommand($delete_old_item)->execute();
            } else {
                $tmp_user_id = $user_id;
                if ($edit_for_user_id != "") {
                    $tmp_user_id = $edit_for_user_id;
                }
                $sql_insert_doc = "INSERT INTO tbl_quote_doc (user_id,comp_id,comp_name,comp_info,payment_term,cust_id,cust_name,cust_info,est_number,po_number,est_date,exp_date,inc_vat,vat_value,num_item,curr_id,quote_curr,discount_percent,actual_discount,sub_total,grand_total,sale_note,design_url,add_date" . $extra_field . ")";
                $sql_insert_doc .= " VALUES (";
                $sql_insert_doc .= "'" . $tmp_user_id . "','" . $comp_id . "','" . addslashes($comp_name) . "','" . addslashes($comp_info) . "','" . addslashes($payment_term) . "','" . $cust_id . "','" . addslashes($cust_name) . "','" . addslashes($cust_info) . "','" . $est_number . "','" . $po_number . "','" . $est_date . "','" . $exp_date . "'";
                $sql_insert_doc .= ",'" . $inc_vat . "','" . $vat_value . "','" . $num_item . "','" . $curr_id . "','" . addslashes($quote_curr) . "','" . $discount_percent . "','" . $actual_discount . "','" . $sub_total . "','" . $grand_total . "','" . addslashes($sale_note) . "','" . addslashes($design_url) . "','" . $add_date . "'" . $extra_value;
                $sql_insert_doc .= "); ";

                Yii::app()->db->createCommand($sql_insert_doc)->execute();
                $qdoc_id = Yii::app()->db->getLastInsertID();
                $sql_insert_doc_draft = "INSERT INTO tbl_quote_doc_draft (qdoc_id,user_id,comp_id,comp_name,comp_info,payment_term,cust_id,cust_name,cust_info,est_number,po_number,est_date,exp_date,inc_vat,vat_value,num_item,curr_id,quote_curr,discount_percent,actual_discount,sub_total,grand_total,sale_note,design_url,add_date" . $extra_field . ")";
                $sql_insert_doc_draft .= " VALUES (";
                $sql_insert_doc_draft .= "'" . $qdoc_id . "','" . $tmp_user_id . "','" . $comp_id . "','" . addslashes($comp_name) . "','" . addslashes($comp_info) . "','" . addslashes($payment_term) . "','" . $cust_id . "','" . addslashes($cust_name) . "','" . addslashes($cust_info) . "','" . $est_number . "','" . $po_number . "','" . $est_date . "','" . $exp_date . "'";
                $sql_insert_doc_draft .= ",'" . $inc_vat . "','" . $vat_value . "','" . $num_item . "','" . $curr_id . "','" . addslashes($quote_curr) . "','" . $discount_percent . "','" . $actual_discount . "','" . $sub_total . "','" . $grand_total . "','" . addslashes($sale_note) . "','" . addslashes($design_url) . "','" . $add_date . "'" . $extra_value;
                $sql_insert_doc_draft .= "); ";
                Yii::app()->db->createCommand($sql_insert_doc_draft)->execute();
            }

            $sort_count = 1;
            foreach ($reqdata["pro_type"] as $tmp_key => $pro_type) {
                $pro_name = addslashes(base64_decode($reqdata["pro_name"][$tmp_key]));
                $pro_desc = addslashes(base64_decode($reqdata["pro_desc"][$tmp_key]));
                $qty = $reqdata["qty"][$tmp_key];
                $uprice = $reqdata["uprice"][$tmp_key];
                $uprice_ori = $reqdata["uprice_ori"][$tmp_key];

                if ($pro_type != "other") {

                    if ($pro_type == "extra") {
                        $item_id = str_replace("e", "", $reqdata["item_id"][$tmp_key]);
                    } else {
                        $item_id = $reqdata["item_id"][$tmp_key];
                    }

                    $addi_id_list = "";
                    $addi_desc = "";
                    if (isset($reqdata["addi_id_list"][$tmp_key])) {
                        $addi_id_list = $reqdata["addi_id_list"][$tmp_key];
                    }

                    if (isset($reqdata["addi_desc"][$tmp_key])) {
                        $addi_desc = addslashes($reqdata["addi_desc"][$tmp_key]);
                    }

                    $comm_percent = $reqdata["comm_percent"][$tmp_key];
                    $qty_note = addslashes($reqdata["qty_note"][$tmp_key]);

                    $sql_insert_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,addi_desc,comm_percent,sort,add_date) VALUES (";
                    $sql_insert_item .= "'" . $qdoc_id . "','" . $pro_type . "','" . $item_id . "','" . $pro_name . "','" . $pro_desc . "','" . $qty . "','" . $qty_note . "','" . $uprice . "','" . $uprice_ori . "','" . $addi_id_list . "','" . $addi_desc . "','" . $comm_percent . "','" . $sort_count . "','" . $add_date . "'";
                    $sql_insert_item .= "); ";


                    /*$a_result["result"] = "fail";
                    $a_result["msg"] = "TEST=".$sql_insert_item;
                    echo json_encode($a_result);
                    exit();*/
                    Yii::app()->db->createCommand($sql_insert_item)->execute();

                    $sql_insert_item_draft = "INSERT INTO tbl_quote_item_draft (qdoc_id,pro_type,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,addi_desc,comm_percent,sort,add_date) VALUES (";
                    $sql_insert_item_draft .= "'" . $qdoc_id . "','" . $pro_type . "','" . $item_id . "','" . $pro_name . "','" . $pro_desc . "','" . $qty . "','" . $qty_note . "','" . $uprice . "','" . $uprice_ori . "','" . $addi_id_list . "','" . $addi_desc . "','" . $comm_percent . "','" . $sort_count . "','" . $add_date . "'";
                    $sql_insert_item_draft .= "); ";

                    /*$a_result["result"] = "fail";
                    $a_result["msg"] = "TEST=".$sql_insert_item;
                    echo json_encode($a_result);
                    exit();*/

                    Yii::app()->db->createCommand($sql_insert_item_draft)->execute();
                } else {

                    $sql_insert_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,item_id,pro_name,pro_desc,qty,qty_note,uprice,addi_id_list,comm_percent,sort,add_date) VALUES (";
                    $sql_insert_item .= "'" . $qdoc_id . "','" . $pro_type . "',NULL,'" . $pro_name . "','" . $pro_desc . "','" . $qty . "',NULL,'" . $uprice . "',NULL,NULL,'" . $sort_count . "','" . $add_date . "'";
                    $sql_insert_item .= "); ";

                    Yii::app()->db->createCommand($sql_insert_item)->execute();

                    $sql_insert_item_draft = "INSERT INTO tbl_quote_item_draft (qdoc_id,pro_type,item_id,pro_name,pro_desc,qty,qty_note,uprice,addi_id_list,comm_percent,sort,add_date) VALUES (";
                    $sql_insert_item_draft .= "'" . $qdoc_id . "','" . $pro_type . "',NULL,'" . $pro_name . "','" . $pro_desc . "','" . $qty . "',NULL,'" . $uprice . "',NULL,NULL,'" . $sort_count . "','" . $add_date . "'";
                    $sql_insert_item_draft .= "); ";

                    Yii::app()->db->createCommand($sql_insert_item_draft)->execute();
                }

                $sort_count++;
            }

            $a_result["result"] = "success";
            $a_result["est_number"] = $est_number;
            //echo json_encode($a_result);

            $this->sendResponse(200, CJSON::encode($a_result));
        }
    }

    public function actionRequestApprove()
	{

        if ($this->authenticate()) {
            $user_id = Yii::app()->user->getId();
            $rawData = file_get_contents('php://input');
            // Clean up control characters
            $cleanData = preg_replace('/[[:cntrl:]]/', '', $rawData);
            // Decode JSON data into PHP array
            $reqdata = json_decode($cleanData, true);		

            /*echo '<pre>';

            print_r($reqdata);

            echo '</pre>';

            exit();*/
            //$user_group = Yii::app()->user->getState('userGroup');

            $comp_id = $reqdata["head_selector"];
            $sql_comp = "SELECT * FROM tbl_comp_info WHERE comp_id='" . $comp_id . "'; ";
            $a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();
            $row_comp = $a_comp[0];
            $comp_name = $row_comp["comp_name"];
            $comp_info = $row_comp["comp_info"];
            $comp_code = $row_comp["comp_code"];
            $tmp_year = $row_comp["tmp_year"];
            $extra_field = "";
            $extra_value = "";
            $is_editing = "0";
            $edit_for_user_id = "";

            if (isset($reqdata["edit_quote_id"]) && (!isset($reqdata["is_duplicate"]) || $reqdata["is_duplicate"] == "0")) {
                $est_number = $reqdata["edit_est_number"];
                $sql_qdoc = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $reqdata["edit_quote_id"] . "'; ";
                $a_qdoc = Yii::app()->db->createCommand($sql_qdoc)->queryAll();
                $row_qdoc = $a_qdoc[0];
                $is_editing = $row_qdoc["is_editing"];
                $edit_for_user_id = $row_qdoc["user_id"];
                $extra_field = ",history_qdoc_id";
                if ($row_qdoc["history_qdoc_id"] != "") {
                    $extra_value = ",'" . $row_qdoc["history_qdoc_id"] . "," . $row_qdoc["temp_id"] . "'";
                } else {
                    $extra_value = ",'" . $row_qdoc["temp_id"] . "'";
                }

                $sql_disable_doc = "UPDATE tbl_quote_doc SET enable='0' WHERE qdoc_id='" . $reqdata["edit_quote_id"] . "'; ";

                Yii::app()->db->createCommand($sql_disable_doc)->execute();
            } else {
                $doc_number = "000";
                if ($tmp_year == date("Y")) {
                    $year_doc_count = intval($row_comp["year_doc_count"]) + 1;
                    $doc_number .= "" . $year_doc_count;
                    $sql_update_year_doc_count = "UPDATE tbl_comp_info SET year_doc_count='" . $year_doc_count . "' WHERE comp_id='" . $comp_id . "'; ";
                    Yii::app()->db->createCommand($sql_update_year_doc_count)->execute();
                } else {

                    $year_doc_count = 1;
                    $doc_number = "0001";
                    $sql_update_tmp_year = "UPDATE tbl_comp_info SET tmp_year='" . date("Y") . "',year_doc_count='1' WHERE comp_id='" . $comp_id . "'; ";
                    Yii::app()->db->createCommand($sql_update_tmp_year)->execute();
                }
                $est_number = $comp_code . date("Ym") . substr($doc_number, (strlen($doc_number) - 4), 4);
            }

            $cust_id = $reqdata["cust_selector"];
            $sql_cust = "SELECT * FROM tbl_cust_info WHERE cust_id='" . $cust_id . "'; ";
            $a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();
            $row_cust = $a_cust[0];
            $cust_name = $row_cust["cust_name"];
            $cust_info = $row_cust["cust_info"];
            $po_number = $reqdata["po_number"];
            $est_date = $reqdata["est_date"];
            $exp_date = $reqdata["exp_date"];
            $inc_vat = isset($reqdata["inc_vat"]) ? $reqdata["inc_vat"] : "no";
            $add_date = date("Y-m-d H:i:s");
            $num_item = sizeof($reqdata["pro_type"]);
            $curr_id = $reqdata["curr_id"];
            $quote_curr = $reqdata["quote_curr"];
            $sub_total = $reqdata["sub_total"];
            $vat_value = $reqdata["vat_value"];
            $grand_total = $reqdata["gtotal_value"];
            $discount_percent = $reqdata['discount'];
            $actual_discount = $reqdata['actual_discount'];
            $payment_term = $reqdata["payment_term"];
            $sale_note = $reqdata["sale_note"];
            $design_url = $reqdata["design_url"];
            if ($reqdata["duplicate_by"] == 1) {
                $duplicate_by = 2;
            } else {
                $duplicate_by = 1;
            }
            if (isset($reqdata["is_duplicate"]) && $reqdata["is_duplicate"] == "1") {
                $qdoc_id = $reqdata["edit_quote_id"];

                $sql_update_doc = "UPDATE tbl_quote_doc SET user_id='" . $user_id . "',comp_id='" . $comp_id . "',comp_name='" . addslashes($comp_name) . "',comp_info='" . addslashes($comp_info) . "',curr_id='" . $curr_id . "'";
                $sql_update_doc .= ",quote_curr='" . addslashes($quote_curr) . "',payment_term='" . addslashes($payment_term) . "',cust_id='" . $cust_id . "',cust_name='" . addslashes($cust_name) . "'";
                $sql_update_doc .= ",cust_info='" . addslashes($cust_info) . "',est_number='" . $est_number . "',po_number='" . $po_number . "',est_date='" . $est_date . "',exp_date='" . $exp_date . "',inc_vat='" . $inc_vat . "',vat_value='" . $vat_value . "'";
                $sql_update_doc .= ",num_item='" . $num_item . "',discount_percent='" . $discount_percent . "',actual_discount='" . $actual_discount . "',sub_total='" . $sub_total . "',grand_total='" . $grand_total . "',sale_note='" . addslashes($sale_note) . "',design_url='" . addslashes($design_url) . "',note=NULL,approve_status='new'";
                $sql_update_doc .= ",approve_date=NULL,reject_time=NULL,history_qdoc_id=NULL,is_temp=0,temp_id=NULL,is_editing=0,archive=0,is_duplicate=0,dup_from='" . $duplicate_by . "',add_date='" . $add_date . "' WHERE qdoc_id='" . $qdoc_id . "' ";
                Yii::app()->db->createCommand($sql_update_doc)->execute();

                $delete_old_item = "DELETE FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "'; ";
                Yii::app()->db->createCommand($delete_old_item)->execute();
                $tmp_user_id = $user_id;
                if ($edit_for_user_id != "") {
                    $tmp_user_id = $edit_for_user_id;
                }
                $sql_insert_doc_draft = "INSERT INTO tbl_quote_doc_draft (qdoc_id,user_id,comp_id,comp_name,comp_info,payment_term,cust_id,cust_name,cust_info,est_number,po_number,est_date,exp_date,inc_vat,vat_value,num_item,curr_id,quote_curr,discount_percent,actual_discount,sub_total,grand_total,sale_note,design_url,add_date" . $extra_field . ")";
                $sql_insert_doc_draft .= " VALUES (";
                $sql_insert_doc_draft .= "'" . $qdoc_id . "','" . $tmp_user_id . "','" . $comp_id . "','" . addslashes($comp_name) . "','" . addslashes($comp_info) . "','" . addslashes($payment_term) . "','" . $cust_id . "','" . addslashes($cust_name) . "','" . addslashes($cust_info) . "','" . $est_number . "','" . $po_number . "','" . $est_date . "','" . $exp_date . "'";
                $sql_insert_doc_draft .= ",'" . $inc_vat . "','" . $vat_value . "','" . $num_item . "','" . $curr_id . "','" . addslashes($quote_curr) . "','" . $discount_percent . "','" . $actual_discount . "','" . $sub_total . "','" . $grand_total . "','" . addslashes($sale_note) . "','" . addslashes($design_url) . "','" . $add_date . "'" . $extra_value;
                $sql_insert_doc_draft .= "); ";

                Yii::app()->db->createCommand($sql_insert_doc_draft)->execute();
            } else {

                $tmp_user_id = $user_id;
                if ($edit_for_user_id != "") {
                    $tmp_user_id = $edit_for_user_id;
                }

                $sql_insert_doc = "INSERT INTO tbl_quote_doc (user_id,comp_id,comp_name,comp_info,payment_term,cust_id,cust_name,cust_info,est_number,po_number,est_date,exp_date,inc_vat,vat_value,num_item,curr_id,quote_curr,discount_percent,actual_discount,sub_total,grand_total,sale_note,design_url,add_date" . $extra_field . ")";
                $sql_insert_doc .= " VALUES (";
                $sql_insert_doc .= "'" . $tmp_user_id . "','" . $comp_id . "','" . addslashes($comp_name) . "','" . addslashes($comp_info) . "','" . addslashes($payment_term) . "','" . $cust_id . "','" . addslashes($cust_name) . "','" . addslashes($cust_info) . "','" . $est_number . "','" . $po_number . "','" . $est_date . "','" . $exp_date . "'";
                $sql_insert_doc .= ",'" . $inc_vat . "','" . $vat_value . "','" . $num_item . "','" . $curr_id . "','" . addslashes($quote_curr) . "','" . $discount_percent . "','" . $actual_discount . "','" . $sub_total . "','" . $grand_total . "','" . addslashes($sale_note) . "','" . addslashes($design_url) . "','" . $add_date . "'" . $extra_value;
                $sql_insert_doc .= "); ";

                Yii::app()->db->createCommand($sql_insert_doc)->execute();
                $qdoc_id = Yii::app()->db->getLastInsertID();


                $sql_insert_doc_draft = "INSERT INTO tbl_quote_doc_draft (qdoc_id,user_id,comp_id,comp_name,comp_info,payment_term,cust_id,cust_name,cust_info,est_number,po_number,est_date,exp_date,inc_vat,vat_value,num_item,curr_id,quote_curr,discount_percent,actual_discount,sub_total,grand_total,sale_note,design_url,add_date" . $extra_field . ")";
                $sql_insert_doc_draft .= " VALUES (";
                $sql_insert_doc_draft .= "'" . $qdoc_id . "','" . $tmp_user_id . "','" . $comp_id . "','" . addslashes($comp_name) . "','" . addslashes($comp_info) . "','" . addslashes($payment_term) . "','" . $cust_id . "','" . addslashes($cust_name) . "','" . addslashes($cust_info) . "','" . $est_number . "','" . $po_number . "','" . $est_date . "','" . $exp_date . "'";
                $sql_insert_doc_draft .= ",'" . $inc_vat . "','" . $vat_value . "','" . $num_item . "','" . $curr_id . "','" . addslashes($quote_curr) . "','" . $discount_percent . "','" . $actual_discount . "','" . $sub_total . "','" . $grand_total . "','" . addslashes($sale_note) . "','" . addslashes($design_url) . "','" . $add_date . "'" . $extra_value;
                $sql_insert_doc_draft .= "); ";

                Yii::app()->db->createCommand($sql_insert_doc_draft)->execute();
            }

            $sort_count = 1;
            foreach ($reqdata["pro_type"] as $tmp_key => $pro_type) {
            
                $pro_name = addslashes(base64_decode($reqdata["pro_name"][$tmp_key]));
                $pro_desc = addslashes(base64_decode($reqdata["pro_desc"][$tmp_key]));

                $qty = $reqdata["qty"][$tmp_key];
                $uprice = $reqdata["uprice"][$tmp_key];
                $uprice_ori = $reqdata["uprice_ori"][$tmp_key];

                if ($pro_type != "other") {
                    if ($pro_type == "extra") {
                        $item_id = str_replace("e", "", $reqdata["item_id"][$tmp_key]);
                    } else {
                        $item_id = $reqdata["item_id"][$tmp_key];
                    }
                    $addi_id_list = "";
                    $addi_desc = "";

                    if (isset($reqdata["addi_id_list"][$tmp_key])) {
                        $addi_id_list = $reqdata["addi_id_list"][$tmp_key];
                    }

                    if (isset($reqdata["addi_desc"][$tmp_key])) {
                        $addi_desc = addslashes($reqdata["addi_desc"][$tmp_key]);
                    }
                    // print_r($addi_desc);
                    // print_r($addi_id_list);
                    // die;
                    $comm_percent = $reqdata["comm_percent"][$tmp_key];
                    $qty_note = addslashes($reqdata["qty_note"][$tmp_key]);
                    $sql_insert_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,addi_desc,comm_percent,sort,add_date) VALUES (";
                    $sql_insert_item .= "'" . $qdoc_id . "','" . $pro_type . "','" . $item_id . "','" . $pro_name . "','" . $pro_desc . "','" . $qty . "','" . $qty_note . "','" . $uprice . "','" . $uprice_ori . "','" . $addi_id_list . "','" . $addi_desc . "','" . $comm_percent . "','" . $sort_count . "','" . $add_date . "'";
                    $sql_insert_item .= "); ";

                    /*$a_result["result"] = "fail";
                    $a_result["msg"] = "TEST=".$sql_insert_item;
                    echo json_encode($a_result);
                    exit();*/
                    Yii::app()->db->createCommand($sql_insert_item)->execute();

                    $sql_insert_item_draft = "INSERT INTO tbl_quote_item_draft (qdoc_id,pro_type,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,addi_desc,comm_percent,sort,add_date) VALUES (";
                    $sql_insert_item_draft .= "'" . $qdoc_id . "','" . $pro_type . "','" . $item_id . "','" . $pro_name . "','" . $pro_desc . "','" . $qty . "','" . $qty_note . "','" . $uprice . "','" . $uprice_ori . "','" . $addi_id_list . "','" . $addi_desc . "','" . $comm_percent . "','" . $sort_count . "','" . $add_date . "'";
                    $sql_insert_item_draft .= "); ";

                    /*$a_result["result"] = "fail";

                    $a_result["msg"] = "TEST=".$sql_insert_item;

                    echo json_encode($a_result);

                    exit();*/

                    Yii::app()->db->createCommand($sql_insert_item_draft)->execute();
                } else {

                    $sql_insert_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,item_id,pro_name,pro_desc,qty,qty_note,uprice,addi_id_list,comm_percent,sort,add_date) VALUES (";
                    $sql_insert_item .= "'" . $qdoc_id . "','" . $pro_type . "',NULL,'" . $pro_name . "','" . $pro_desc . "','" . $qty . "',NULL,'" . $uprice . "',NULL,NULL,'" . $sort_count . "','" . $add_date . "'";
                    $sql_insert_item .= "); ";
                    Yii::app()->db->createCommand($sql_insert_item)->execute();

                    $sql_insert_item_draft = "INSERT INTO tbl_quote_item_draft (qdoc_id,pro_type,item_id,pro_name,pro_desc,qty,qty_note,uprice,addi_id_list,comm_percent,sort,add_date) VALUES (";
                    $sql_insert_item_draft .= "'" . $qdoc_id . "','" . $pro_type . "',NULL,'" . $pro_name . "','" . $pro_desc . "','" . $qty . "',NULL,'" . $uprice . "',NULL,NULL,'" . $sort_count . "','" . $add_date . "'";
                    $sql_insert_item_draft .= "); ";
                    Yii::app()->db->createCommand($sql_insert_item_draft)->execute();
                }

                $sort_count++;
            }

            $a_result["result"] = "success";
            $a_result["est_number"] = $est_number;

            $this->sendResponse(200, CJSON::encode($a_result));
        }
	}

    //-------------------------------CART API's---------------------------

    public function actionGet_category($product = 1){

        $sql_item_group = "SELECT * FROM tbl_item_group WHERE prod_id='" . $product . "' ORDER BY sort ASC; ";

        $result["data"] = Yii::app()->db->createCommand($sql_item_group)->queryAll();

        $this->sendResponse(200, CJSON::encode($result));
    }

    public function actionGet_product($product = 1, $type = 1, $curr = 1)

    {

        $user_pricing = Yii::app()->user->getState('userPricing');

        $prod_id = $product;

        $sat_id = $type;

        $curr_id = $curr;



        $comm_type = Yii::app()->user->getState('commissionType');



        $where = "";



        if ($user_pricing == 0) {



            if ($sat_id == 3 && $comm_type == 7) {

                $sat_id = 2;

                $where = "AND (comm_value='7' OR comm_value='0')";
            }
        }



        $sql_item = "SELECT tbl_item.* FROM tbl_item LEFT JOIN tbl_item_group ON tbl_item.group_id=tbl_item_group.item_group_id WHERE tbl_item.prod_id='" . $prod_id . "' AND tbl_item.enable=1 ORDER BY tbl_item_group.sort ASC, tbl_item.sort ASC; ";

        $result["a_item"] = Yii::app()->db->createCommand($sql_item)->queryAll();



        if (sizeof($result["a_item"]) == 0) {



            echo '<div style="width:100%; text-align: center;" class="alert alert-warning">Empty!!</div>';

            exit();
        }



        $a_item_id_list = array();

        for ($i = 0; $i < sizeof($result["a_item"]); $i++) {

            $a_item_id_list[] = $result["a_item"][$i]["item_id"];
        }

        $s_item_id_list = implode(",", $a_item_id_list);



        $sql_comm = "SELECT * FROM tbl_comm_percent WHERE sat_id='" . $sat_id . "' AND enable=1 " . $where . " ORDER BY sort ASC; ";

        $result["a_comm"] = Yii::app()->db->createCommand($sql_comm)->queryAll();



        if ($user_pricing != 0 && $sat_id == 3) {

            $result["a_comm"] = array();

            $sql_comm = "SELECT * FROM tbl_comm_percent WHERE sat_id='2' AND enable=1 " . $where . " ORDER BY sort ASC; ";

            $result["a_comm"] = Yii::app()->db->createCommand($sql_comm)->queryAll();



            $sql_comm = "SELECT * FROM tbl_comm_percent WHERE sat_id='3' AND enable=1 " . $where . " ORDER BY sort ASC; ";

            $result["a_comm_low"] = Yii::app()->db->createCommand($sql_comm)->queryAll();
        }



        $a_comm_per_id = array();

        for ($k = 0; $k < sizeof($result["a_comm"]); $k++) {

            $a_comm_per_id[] = $result["a_comm"][$k]["comm_per_id"];
        }

        $s_comm_per_id_list = implode(",", $a_comm_per_id);



        $sql_price_guide = "SELECT * FROM tbl_price_guide WHERE sat_id='" . $sat_id . "' AND curr_id='" . $curr_id . "' AND item_id IN (" . $s_item_id_list . ")  ";

        if (sizeof($a_comm_per_id) > 0) {

            $sql_price_guide .= " AND comm_per_id IN (" . $s_comm_per_id_list . ") ";
        }



        if ($user_pricing != 0 && $sat_id == 3) {



            $sql_price_guide = "SELECT * FROM tbl_price_guide WHERE sat_id='2' AND curr_id='" . $curr_id . "' AND item_id IN (" . $s_item_id_list . ")  ";

            if (sizeof($a_comm_per_id) > 0) {

                $sql_price_guide .= " AND comm_per_id IN (" . $s_comm_per_id_list . ") ";
            }
        }



        $row_pguide = Yii::app()->db->createCommand($sql_price_guide)->queryAll();



        $a_pguide = array();



        for ($i = 0; $i < sizeof($row_pguide); $i++) {

            $a_pguide[($row_pguide[$i]["item_id"])][($row_pguide[$i]["comm_per_id"])] = $row_pguide[$i];
        }



        $result["a_pguide"] = $a_pguide;



        $sql_item_group = "SELECT * FROM tbl_item_group WHERE prod_id='" . $product . "' ORDER BY sort ASC; ";

        $result["a_item_group"] = Yii::app()->db->createCommand($sql_item_group)->queryAll();







        $result["prod_id"] = $prod_id;

        $result["sat_id"] = $sat_id;

        $result["curr_id"] = $curr_id;



        if (isset($_GET["ade"]) && $_GET["ade"] == "yes") {

            $result["admin_edit"] = "yes";
        } else {

            $result["admin_edit"] = "no";
        }



        $badge = "SELECT * FROM tbl_badges_products WHERE pro_id = $prod_id";

        $badgedata = Yii::app()->db->createCommand($badge)->queryAll();



        if (!empty($badgedata)) {

            $sq = "SELECT * FROM `tbl_badges` WHERE id = " . $badgedata[0]['badges_id'] . "";

            $result['badged'] = Yii::app()->db->createCommand($sq)->queryAll();
        } else {

            $result['badged'] = '';
        }



        $productname  = "SELECT * FROM `tbl_product` WHERE `prod_id` =  $prod_id";

        $result['productname'] = Yii::app()->db->createCommand($productname)->queryAll();



        $this->sendResponse(200, CJSON::encode($result));
    }



    //-------------------------------ESTIMATE---------------------------

    public function actionNew_request()

    {

        if ($this->authenticate()) {

            $user_id = Yii::app()->user->getId();

            $user = User::model()->findByPk($user_id);

            $user_group = $user->user_group_id;



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





            $this->sendResponse(200, CJSON::encode($result));
        }
    }



    public function actionGet_request_byid()
    {

        $qdoc_id = $_POST["qdoc_id"];

        $from_page = $_POST["from_page"];

        // Fetch quote document data

        $sql_quote = "SELECT * FROM tbl_quote_doc WHERE qdoc_id=:qdoc_id";

        $a_quote = Yii::app()->db->createCommand($sql_quote)->queryAll(true, [':qdoc_id' => $qdoc_id]);

        $row_quote = $a_quote[0];

        $comp_id = $row_quote["comp_id"];



        $action_from = $_POST["action_from"];

        $approve_status = $row_quote["approve_status"];

        $is_duplicate = $row_quote["is_duplicate"];



        // Fetch currency data

        $sql_curr = "SELECT * FROM tbl_currency WHERE curr_id=:curr_id";

        $a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll(true, [':curr_id' => $row_quote["curr_id"]]);

        $row_curr = $a_curr[0];

        $pre_cost = $row_curr["curr_symbol"];



        // Fetch all currencies

        $cur_sql = "SELECT * FROM tbl_currency";

        $curr_query = Yii::app()->db->createCommand($cur_sql)->queryAll();



        // Fetch company info and quote note

        $sql_comp = "SELECT tbl_comp_info.comp_logo, tbl_quote_note.qnote_text 

                     FROM tbl_comp_info 

                     LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id 

                     WHERE tbl_comp_info.comp_id=:comp_id";

        $a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll(true, [':comp_id' => $comp_id]);

        $row_comp = $a_comp[0];

        $comp_logo = $row_comp["comp_logo"];

        $qnote_text = $row_comp["qnote_text"];



        // Fetch customers

        $user_group = Yii::app()->user->getState('userGroup');

        $user_id = Yii::app()->user->getState('userKey');

        $more_condition = ($user_group != "1" && $user_group != "99") ? " AND user_id=:user_id " : "";

        $sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 $more_condition ORDER BY cust_name ASC";

        $a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll(true, [':user_id' => $user_id]);



        // Fetch quote items

        $sql_qitem = "SELECT * FROM tbl_quote_item WHERE qdoc_id=:qdoc_id AND enable=1 AND product_status='1' ORDER BY sort ASC";

        $a_qitem = Yii::app()->db->createCommand($sql_qitem)->queryAll(true, [':qdoc_id' => $qdoc_id]);



        $count_row = 1;

        foreach ($a_qitem as $i => $item) {

            $tmp_s = "";

            $tmp_p = "";

            $tmp_e = "";

            $tmp_html_id = "";

            if ($item["pro_type"] == "other") {

                $tmp_s = "other";

                $tmp_p = $count_row;
            } else if ($item["pro_type"] == "extra") {

                $tmp_s = "extra";

                $tmp_p = $count_row;

                $tmp_e = "e";
            } else {

                if ($item["item_id"] != "") {

                    if ($item["item_id"] == "0") {

                        $tmp_s = "old_dup";
                    } else {

                        $tmp_s = "new";
                    }
                } else {

                    $tmp_s = $item["pro_type"];

                    $is_old_process = 1;
                }

                $tmp_p = $item["qdoci_id"];
            }



            if ($tmp_html_id != "") {

                $tmp_html_id .= ",";
            }

            $tmp_html_id .= $tmp_s . "" . $tmp_p;



            $user_group = Yii::app()->user->getState('userGroup');

            $readonly = ($user_group != "1" && $user_group != "99") ? "" : "";



            $tmp_uprice = (isset($item["uprice"])) ? floatval($item["uprice"]) : 0.00;

            $addi_list = [];

            // print_r($tmp_s);
            // echo "=========";
            if ($tmp_s != "other" && $tmp_s != "extra" && $tmp_s != "old_dup") {
                
                // print_r($row_quote["curr_id"]);
                // echo "=========";
                $sql2 = "SELECT * FROM tbl_additional_new WHERE item_id=:item_id AND curr_id=:curr_id ORDER BY ordering ASC";

                $addi_list = Yii::app()->db->createCommand($sql2)->queryAll(true, [':item_id' => $item["item_id"], ':curr_id' => $row_quote["curr_id"]]);
                if (count($addi_list) != 0) {                                   
                    $a_addi_load = [];
                    $tmp_addi_list = $item["addi_id_list"];
                    if ($tmp_addi_list != "") {
                        $a_addi_load = explode(",", $tmp_addi_list);
                    }
                
                    foreach ($addi_list as $key_addi => $row_addi) {
                        if ($row_addi["addi_value"] != 0) {
                            $is_selected = 0;
                            if (sizeof($a_addi_load) > 0 && in_array($row_addi["addi_id"], $a_addi_load)) {
                                $is_selected = 1;
                                if ($is_duplicate != 1 && $from_page != "quote_rej") {
                                    $tmp_uprice += floatval($row_addi["addi_value"]);
                                }
                            }
                            // Add the 'is_selected' field to the row_addi array
                            $addi_list[$key_addi]["is_selected"] = $is_selected;
                        }
                    }
                }else {                    
                    
                        $sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='{$row_quote["curr_id"]}';";
                        $a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();
                        $pre_cost = $a_curr[0]["curr_symbol"];
                        $quote_currency = $a_curr[0]["quote_currency"];
                        
                        $s_addi_id = $item["addi_id_list"];
                        
                        if (!empty($s_addi_id)) {
                        
                            $sql_addi = $is_old_process == "1" ?        
                                "SELECT * FROM tbl_additional WHERE addi_id IN ({$s_addi_id});" :        
                                "SELECT * FROM tbl_additional_new WHERE addi_id IN ({$s_addi_id});";    
                            $a_addi = Yii::app()->db->createCommand($sql_addi)->queryAll(); 
                                
                            foreach ($a_addi as $key_addi => $row_addi) {
                                $row_addi["addi_value"] = $row_addi["addi_value"] * $quote_currency;
                                $row_addi["is_selected"] = 1;
                                $addi_list[$key_addi]= $row_addi;
                            }
                        }                   
                                                              
                }
            }
            

            $response[] = [

                'id' => $item["qdoci_id"],

                'product_type' => $item["pro_type"],

                'product_name' => $item["pro_name"],

                'product_desc' => explode("<br>", $item["pro_desc"])[0],

                'qty' => $item["qty"],

                'uprice' => $tmp_uprice,

                'addi_list' => $addi_list,

                'comm_percent' => $item["comm_percent"],

                'qty_note' => $item["qty_note"],

                'readonly' => $readonly,

                'item_id' => $item["item_id"],
                
                'prod_id' => $item["pro_id"],

            ];



            $count_row++;
        }



        $sql_shipp = "SELECT * FROM tbl_quote_item WHERE qdoc_id=:qdoc_id AND (pro_name LIKE '%Royalty%' OR pro_name LIKE '%Credit Card%' OR pro_name LIKE '%Shipping%')";

        $shipp = Yii::app()->db->createCommand($sql_shipp)->queryAll(true, [':qdoc_id' => $qdoc_id]);

        $shipping = array_reduce($shipp, function ($carry, $item) {

            return $carry + $item['uprice'];
        }, 0.0);



        $sub_total = $row_quote["sub_total"];

        $comm_total = 0.0;



        // Prepare the response data

        $response = [

            'quote' => $row_quote,

            'currency' => $row_curr,

            'all_currencies' => $curr_query,

            'company' => $row_comp,

            'customers' => $a_cust,

            'quote_items' => $response,

            'shipping' => $shipping,

            'sub_total' => $sub_total,

            'comm_total' => $comm_total,

        ];



        // Encode the response as JSON

        echo json_encode($response);
    }



    public function actionUpload_freebies()
    {

        // Logging the $_FILES array for debugging

        error_log(print_r($_FILES, true));



        $qdoc_id = $_POST['main_conv_id'];

        $old_sql = "SELECT design_name FROM tbl_quote_doc WHERE qdoc_id = :qdoc_id";

        $old_query = Yii::app()->db->createCommand($old_sql)->queryAll(true, [':qdoc_id' => $qdoc_id]);

        $design_name = isset($old_query[0]["design_name"]) ? $old_query[0]["design_name"] : '';



        if ($design_name != "") {

            $all_desig = explode(',', $design_name);

            foreach ($all_desig as $des) {

                @unlink(Yii::getPathOfAlias('webroot') . '/upload/new_design/' . $des);
            }
        }



        $file_name = array();

        if (isset($_FILES['files_name']) || isset($_POST['notes_admin'])) {

            if (isset($_FILES['files_name']['name'][0]) && !empty($_FILES['files_name']['name'][0])) {

                $tmp_name = $_FILES['files_name']['tmp_name'];

                $original_name = $_FILES['files_name']['name'];

                $newfile = time() . '-' . uniqid() . '.' . pathinfo($original_name, PATHINFO_EXTENSION);

                $targetPath = Yii::getPathOfAlias('webroot') . '/upload/new_design/' . $newfile;



                // Debugging: Log paths and file information

                error_log("Source Path: " . $tmp_name);

                error_log("Target Path: " . $targetPath);

                error_log("Original Name: " . $original_name);

                error_log("New File Name: " . $newfile);



                if (move_uploaded_file($tmp_name, $targetPath)) {

                    $file_name[] = $newfile;
                } else {

                    $result = array(

                        'status' => 500,

                        'message' => 'Failed to move uploaded file. Please check file permissions and paths.'

                    );

                    $this->sendResponse(500, CJSON::encode($result));

                    return;
                }



                $all_files = $design_name != '' ? $design_name . ',' . implode(',', $file_name) : implode(',', $file_name);

                $notes_admin = $_POST['notes_admin'];

                $sql = "UPDATE tbl_quote_doc SET design_name=:all_files, design_note=:notes_admin WHERE qdoc_id=:qdoc_id";

                $params = [

                    ':all_files' => $all_files,

                    ':notes_admin' => $notes_admin,

                    ':qdoc_id' => $qdoc_id

                ];



                if (Yii::app()->db->createCommand($sql)->execute($params)) {

                    $result = array(

                        'status' => 200,

                        'message' => $all_files

                    );

                    $this->sendResponse(200, CJSON::encode($result));
                } else {

                    $result = array(

                        'status' => 500,

                        'message' => 'Database update failed.'

                    );

                    $this->sendResponse(500, CJSON::encode($result));
                }
            } else {

                $notes_admin = $_POST['notes_admin'];

                $sql = "UPDATE tbl_quote_doc SET design_note=:notes_admin WHERE qdoc_id=:qdoc_id";

                $params = [

                    ':notes_admin' => $notes_admin,

                    ':qdoc_id' => $qdoc_id

                ];

                Yii::app()->db->createCommand($sql)->execute($params);

                $result = array(

                    'status' => 200,

                    'message' => 'Notes updated successfully.'

                );

                $this->sendResponse(200, CJSON::encode($result));
            }
        } else {

            $result = array(

                'status' => 400,

                'message' => 'No files or notes provided.'

            );

            $this->sendResponse(400, CJSON::encode($result));
        }
    }

    public function actionUpload_qu_freebies()
    {

        if (isset($_FILES['files_name']['name']) || isset($_POST['notes_admin'])) {

            if ($_POST['conv_type'] == 1) {
                $data = "remake";
                $data_note = "remake_notes";
            } elseif ($_POST['conv_type'] == 2) {

                $data = "sample";

                $data_note = "sample_notes";
            } elseif ($_POST['conv_type'] == 3) {

                $data = "complimentary";

                $data_note = "complimentary_notes";
            } else {

                $data = "online_store";
            }

            if ($_FILES['files_name']['name'] != "") {

                if ($_POST['conv_type'] == 1 || $_POST['conv_type'] == 2 || $_POST['conv_type'] == 3) {

                    $notes_admin = $_POST['notes_admin'];

                    $conv_id = $_POST['main_conv_id'];

                    $sourcePath = $_FILES['files_name']['tmp_name'];

                    $newfile = time() . "-" . $_FILES['files_name']['name']; //any name sample.jpg

                    $targetPath = Yii::getPathOfAlias('webroot') . '/upload/samples/' . $newfile;

                    if (move_uploaded_file($sourcePath, $targetPath)) {

                        $sql = "UPDATE quotation_data SET $data='$newfile',$data_note='$notes_admin' WHERE conv_id='$conv_id'";

                        Yii::app()->db->createCommand($sql)->execute();

                        $result = array(
                            'status' => 200,
                            'message' => 'Notes updated successfully.'        
                        );        
                        $this->sendResponse(200, CJSON::encode($result));
                    } else {
                        $result = array(
                            'status' => 200,
                            'message' => 'file not uploaded'        
                        );        
                        $this->sendResponse(200, CJSON::encode($result));
                    }
                } else {

                    $conv_id = $_POST['main_conv_id'];

                    $sourcePath = $_FILES['files_name']['tmp_name'];

                    $original_name = $_FILES['files_name']['name'];

                    $newfile = time() . "-" . $_FILES['files_name']['name']; //any name sample.jpg

                    $targetPath = Yii::getPathOfAlias('webroot') . '/upload/samples/' . $newfile;

                    $newfile = time() . '-' . uniqid() . '.' . pathinfo($original_name, PATHINFO_EXTENSION);
                    $targetPath = Yii::getPathOfAlias('webroot') . '/upload/samples/' . $newfile;
                    

                    if (move_uploaded_file($sourcePath, $targetPath)) {

                        $sql = "UPDATE quotation_data SET $data='$newfile' WHERE conv_id='$conv_id'";

                        Yii::app()->db->createCommand($sql)->execute();

                        $result = array(
                            'status' => 200,
                            'message' => $newfile        
                        );        
                        $this->sendResponse(200, CJSON::encode($result));
                    } else {

                        $result = array(
                            'status' => 200,
                            'message' => 'File not upload'        
                        );        
                        $this->sendResponse(200, CJSON::encode($result));
                    }
                }
            } else {

                $conv_id = $_POST['main_conv_id'];

                $notes_admin = $_POST['notes_admin'];

                $sql = "UPDATE quotation_data SET $data_note='$notes_admin' WHERE conv_id='$conv_id'";

                Yii::app()->db->createCommand($sql)->execute();

                $result = array(
                    'status' => 200,
                    'message' => 'Notes updated successfully.'        
                );        
                $this->sendResponse(200, CJSON::encode($result));
            }
        } else {

            $result = array(
                'status' => 200,
                'message' => 'File not found'        
            );        
            $this->sendResponse(200, CJSON::encode($result));
        }
    }



    public function actionGet_upload_freebies()
    {



        $qdoc_id = $_POST['main_conv_id'];

        $old_sql = "SELECT design_name FROM tbl_quote_doc WHERE qdoc_id = '$qdoc_id'";

        $old_query = Yii::app()->db->createCommand($old_sql)->queryAll();

        $design_name = $old_query[0]["design_name"];

        $result = array(

            'status' => 200,

            'message' => $design_name

        );

        $this->sendResponse(200, CJSON::encode($result));
    }



    public function actionDelete_quote()

    {



        $qdoc_id = $_POST["qdoc_id"];



        $sql_update = "UPDATE tbl_quote_doc SET enable=0 WHERE qdoc_id='" . $qdoc_id . "'; ";



        if (Yii::app()->db->createCommand($sql_update)->execute()) {

            $a_result["result"] = "success";

            $a_result["status"] = 200;

            $this->sendResponse(200, CJSON::encode($a_result));
        } else {

            $a_result["result"] = "fail";

            $a_result["msg"] = "Fail to delete.";

            $a_result["status"] = 400;

            $this->sendResponse(400, CJSON::encode($a_result));
        }
    }



    public function actionSave_to_archive()

    {

        $qdoc_id = $_POST["qdoc_id"];

        $sql_update = "UPDATE tbl_quote_doc SET archive=1 WHERE qdoc_id='" . $qdoc_id . "'; ";



        if (Yii::app()->db->createCommand($sql_update)->execute()) {

            $a_result["result"] = "success";

            $this->sendResponse(200, CJSON::encode($a_result));
        } else {

            $a_result["result"] = "fail";

            $a_result["msg"] = "Fail to archive.";

            $this->sendResponse(400, CJSON::encode($a_result));
        }
    }



    public function actionApprove_list()

    {

        if ($this->authenticate()) {

            $user_id = Yii::app()->user->getId();

            $user = User::model()->findByPk($user_id);

            $user_group = $user->user_group_id;





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



            $this->sendResponse(200, CJSON::encode($result)); //--- Use same view with New status

        }
    }

    public function actionadd_product()
	{
		$qdoc_id = $_POST["qdoc_id"];
		$pro_name = $_POST["pro_name"];
		$pro_desc = $_POST["pro_desc"];
		$qty = $_POST["qty"];
		$uprice = $_POST["uprice"];
		$comm_percent = $_POST["comm_percent"];
        // echo "<pre>";
        // print_r($_POST);
        // die;
		$sql_insert = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,pro_name,pro_desc,qty,uprice,comm_percent,add_date,product_status) VALUES ('" . $qdoc_id . "','other','" . $pro_name . "','" . $pro_desc . "','" . $qty . "','" . $uprice . "','" . $comm_percent . "','" . date("Y-m-d H:i:s") . "','1'); ";
		if (Yii::app()->db->createCommand($sql_insert)->execute()) {

			$qdoci_id = Yii::app()->db->getLastInsertID();
			$result = array(
                'status' => 200,
                'message' => $qdoci_id
            );

            $this->sendResponse(200, CJSON::encode($result));
		} else {
			$result = array(
                'status' => 400,
                'message' => 'Fail to delete.'
            );
            $this->sendResponse(200, CJSON::encode($result));
		}
	}

    public function actiondelete_product()
	{
		$qdoci_id = $_POST['qdoci_id'];
		$sql_update = "UPDATE tbl_quote_item SET product_status=2 WHERE qdoci_id='" . $qdoci_id . "'";
		if (Yii::app()->db->createCommand($sql_update)->execute()) {
			$result = array(
                'status' => 200,
                'qdoci_id' => $qdoci_id
            );

            $this->sendResponse(200, CJSON::encode($result));
		} else {
			$result = array(
                'status' => 400,
                'message' => 'Fail to delete.'
            );
            $this->sendResponse(200, CJSON::encode($result));
		}
	}

    public function actionFetch_sales_notes()

    {

        $qdoc_id = $_POST['doc_id'];

        $sql = "SELECT sale_note,add_date FROM tbl_quote_doc WHERE qdoc_id='$qdoc_id'";

        $a_qitem = Yii::app()->db->createCommand($sql)->queryAll();

        if (count($a_qitem) == 0) {

            $result = array(

                'status' => 200,

                'message' => '0'

            );

            $this->sendResponse(200, CJSON::encode($result));
        } else {

            if ($a_qitem[0]['sale_note'] == "" || $a_qitem[0]['sale_note'] == NULL) {

                $result = array(

                    'status' => 200,

                    'message' => '0'

                );

                $this->sendResponse(200, CJSON::encode($result));
            } else {

                $note = $a_qitem[0]['sale_note'];

                $string = date("M d, Y H:i:s", strtotime($a_qitem[0]['add_date']));

                $comments = $note;

                $result = array(

                    'status' => 200,

                    'date' => $string,

                    'comments' => $comments

                );

                $this->sendResponse(200, CJSON::encode($result));
            }
        }
    }



    public function actionReject_list()

    {



        if ($this->authenticate()) {

            $user_id = Yii::app()->user->getId();

            $user = User::model()->findByPk($user_id);

            $user_group = $user->user_group_id;





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



            $this->sendResponse(200, CJSON::encode($result)); //--- Use same view with New status

        }
    }



    public function actionArchived_list()

    {

        if ($this->authenticate()) {

            $user_id = Yii::app()->user->getId();

            $user = User::model()->findByPk($user_id);

            $user_group = $user->user_group_id;



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



            $this->sendResponse(200, CJSON::encode($result)); //--- Use same view with New status

        }
    }

    public function actionChange_currency()
    {
        $rawData = file_get_contents('php://input');
        $cleanData = preg_replace('/[[:cntrl:]]/', '', $rawData);
        $reqdata = json_decode($cleanData, true);

        $old_curr_id = $reqdata["old_curr_id"];
        $curr_id = $reqdata["curr_id"];
        $price_value = $reqdata["curr_price"];
        
        $sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='{$old_curr_id}';";
        $a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();
        $pre_cost = $a_curr[0]["curr_symbol"];
        $quote_currency = $a_curr[0]["quote_currency"];

        $curr_price = [];
                
        foreach($price_value as $key => $price) {
            $curr_price[$key] = $price / $quote_currency;
        }

        //---------------------------------------------

        $sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='{$curr_id}';";
        $a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();
        $pre_cost = $a_curr[0]["curr_symbol"];
        $quote_currency = $a_curr[0]["quote_currency"];

        $price = [];
                
        foreach($curr_price as $key => $price_change) {
            $price[$key] = $price_change * $quote_currency;
        }

        //---------------------------------------------
        $result['old_curr_id'] = $old_curr_id;
        $result['curr_id'] = $curr_id;
        $result['curr_price'] = $price;
        $this->sendResponse(200, CJSON::encode($result));
    }

    public function actionChange_est_cur()

    {

        $rawData = file_get_contents('php://input');

        $cleanData = preg_replace('/[[:cntrl:]]/', '', $rawData);

        $reqdata = json_decode($cleanData, true);



        // Debugging statement to check received data

        // print_r($reqdata);

        // die;



        $curr_id = $reqdata['curr_id'];

        $symbol = $reqdata['symbol'];

        $oldest_curr_id = $reqdata['or_curr_id'];

        $old_data = $reqdata['post_data'];



        $reqdata = array_merge($old_data, [

            'curr_id' => $curr_id,

            'quote_curr' => $symbol,

        ]);



        $all_data = $reqdata;

        $is_old_process = isset($reqdata['is_old_process']) ? $reqdata['is_old_process'] : '0';



        $response_data = [

            'bill_to' => [],

            'est_details' => [],

            'items' => [],

            'sub_total' => 0,

            'currency' => $symbol

        ];



        $user_group = Yii::app()->user->getState('userGroup');

        $user_id = Yii::app()->user->getState('userKey');

        $more_condition = ($user_group != "1" && $user_group != "99") ? " AND user_id='{$user_id}' " : "";



        $sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 {$more_condition} ORDER BY cust_name ASC;";

        $a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();

        foreach ($a_cust as $row_cust) {

            $response_data['bill_to'][] = [

                'cust_id' => $row_cust["cust_id"],

                'cust_name' => $row_cust["cust_name"]

            ];
        }



        $est_date = date("Y-m-d");

        $exp_date = date("Y-m-d", strtotime("+30 days", strtotime($est_date)));

        $response_data['est_details'] = [

            'estimate_number' => '[Auto generate]',

            'po_number' => '',

            'est_date' => $est_date,

            'exp_date' => $exp_date,

            'grand_total' => 0,

            'quote_curr' => $symbol,

            'curr_id' => $curr_id,

            'is_duplicate' => isset($reqdata["is_duplicate"]) ? $reqdata["is_duplicate"] : "0"

        ];



        $sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='{$curr_id}';";

        $a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

        $pre_cost = $a_curr[0]["curr_symbol"];

        $quote_currency = $a_curr[0]["quote_currency"];



        $sub_total = 0.0;



        foreach ($reqdata["item_id"] as $i => $item_id) {

            $tmp_qty = isset($reqdata["qty"][$i]) ? intval($reqdata["qty"][$i]) : 0;

            $tmp_uprice = isset($reqdata["uprice"][$i]) ? floatval($reqdata["uprice"][$i]) : 0.0;

            $tmp_adj = 0.0;

            $s_addi_name = "";

            $tmp_id = $reqdata["tmp_id"][$i];

            
            $addi_name = [];
            $addi_name_price = [];

            if (isset($reqdata["addi_id"][$tmp_id])) {

                $a_addi_id = [];

                $a_addi_val = [];

                foreach ($reqdata["addi_id"][$tmp_id] as $s_adj) {

                    $a_tmp_adj = explode("|", $s_adj);

                    $f_adj = floatval($a_tmp_adj[1]);

                    $a_addi_id[] = floatval($a_tmp_adj[0]);

                    $a_addi_val[$a_tmp_adj[0]] = $f_adj;

                    $tmp_adj += $f_adj;
                }



                $s_addi_id = implode(",", $a_addi_id);



                $sql_addi = $is_old_process == "1" ?

                    "SELECT addi_id, addi_name FROM tbl_additional WHERE addi_id IN ({$s_addi_id});" :

                    "SELECT addi_id, addi_name FROM tbl_additional_new WHERE addi_id IN ({$s_addi_id});";

                $a_addi = Yii::app()->db->createCommand($sql_addi)->queryAll();



                $s_addi_name .= "Price: " . $pre_cost . ($tmp_uprice * $quote_currency);
                
                $tmp_uprice += $tmp_adj;
                $k = 0;
                foreach ($a_addi as $row_addi2) {

                    $tmp_addi_val = $a_addi_val[$row_addi2["addi_id"]];

                    $use_minus = $tmp_addi_val < 0 ? "-" : "";

                    $tmp_addi_val = abs($tmp_addi_val);

                    $s_addi_name .= " + " . $row_addi2["addi_name"] . " " . $use_minus . $pre_cost . number_format($tmp_addi_val * $quote_currency, 2);

                    $addi_name[$k] = $row_addi2["addi_name"];
                    $addi_name_price[$k] = $use_minus  . number_format($tmp_addi_val * $quote_currency, 2);
                    $k++;
                }
            }



            $tmp_amount = $tmp_qty * $tmp_uprice * $quote_currency;



            $response_data['items'][] = [

                'item_id' => $item_id,

                'comm_percent' => $reqdata["comm_percent"][$i],

                'qty_note' => $reqdata["qty_note"][$i],

                'pro_type' => $reqdata["product_type"][$i],

                'pro_name' => $reqdata["product_item"][$i],

                'pro_desc' => $reqdata["product_desc"][$i],

                'qty' => $reqdata["qty"][$i],

                'uprice' => $tmp_uprice * $quote_currency,

                'uprice_ori' => $reqdata["uprice"][$i] * $quote_currency,

                'addi_id_list' => $s_addi_id,

                'addi_name_list' => $s_addi_name,

                'tmp_id' => $tmp_id,

                'amount' => $tmp_amount,
                'addi_name' => $addi_name,
                'addi_price' => $addi_name_price,

            ];



            $sub_total += $tmp_amount;
        }



        $response_data['sub_total'] = $sub_total;

        $response_data['est_details']['grand_total'] = $sub_total;



        $this->sendResponse(200, CJSON::encode($response_data));
    }

    public function actionShowQuoteViewCurrChange()
    {   
        $rawData = file_get_contents('php://input');

        $cleanData = preg_replace('/[[:cntrl:]]/', '', $rawData);

        $reqdata = json_decode($cleanData, true);
        
        $old_curr_id = $reqdata['old_curr_id'];
        $qdoc_id = $reqdata['qdoc_id'];
        $curr_id = $reqdata['curr_id'];        
        $addi_id = $reqdata['addi_id'];

        if ($old_curr_id == 1) {
            //$result = $this->getQuoteDetails($qdoc_id, $curr_id, $action_from);
            $sql_quote = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $qdoc_id . "'; ";
            $a_quote = Yii::app()->db->createCommand($sql_quote)->queryAll();
            $row_quote = $a_quote[0];
            $comp_id = $row_quote["comp_id"];

            // Fetch currency details
            $sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $curr_id . "'; ";
            $a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();
            $row_curr = $a_curr[0];
            $pre_cost = $row_curr["curr_symbol"];
            $quote_currency = $row_curr["quote_currency"];

            // Fetch company details
            $sql_comp = "SELECT tbl_comp_info.comp_logo, tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.comp_id='" . $comp_id . "'; ";
            $a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();
            $row_comp = $a_comp[0];
            $comp_logo = $row_comp["comp_logo"];
            $qnote_text = $row_comp["qnote_text"];

            // Build the JSON data
            $data = [
                'company' => [
                    'logo' => Yii::app()->request->baseUrl . '/images/' . $comp_logo,
                    'name' => $row_quote["comp_name"],
                    'info' => $row_quote["comp_info"],
                ],
                'estimate' => [
                    'number' => $row_quote["est_number"],
                    'date' => date("F d, Y", strtotime($row_quote["est_date"])),
                    'expiration_date' => date("F d, Y", strtotime($row_quote["exp_date"])),
                    'po_number' => $row_quote["po_number"],
                ],
                'customer' => [
                    'name' => $row_quote["cust_name"],
                    'info' => $row_quote["cust_info"],
                ],
                'payment_terms' => $row_quote["payment_term"],
                'currency' => [
                    'symbol' => $pre_cost,
                    'name' => $row_curr["curr_name"],
                ],
                'products' => [],
                'totals' => [
                    'subtotal' => $row_quote["sub_total"] * $quote_currency,
                    'vat' => ($row_quote["sub_total"] - $row_quote['actual_discount']) * 0.07,
                    'grand_total' => $row_quote["grand_total"] * $quote_currency,
                ],
            ];

            // Fetch product details
            $sql_qitem = "SELECT * FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND enable=1 AND product_status='1' ORDER BY sort ASC; ";
            $a_qitem = Yii::app()->db->createCommand($sql_qitem)->queryAll();
            $tmp_adj = 0.0;
            foreach ($a_qitem as $i => $row_qitem) {
                $pro_id = $row_qitem["pro_id"];
                $qty = $row_qitem["qty"];
                $uprice = $row_qitem["uprice"] * $quote_currency;
                $comm_percent = $row_qitem["comm_percent"];
                $comm_value = ($comm_percent != "") ? ($qty * $uprice) * (intval(str_replace("%", "", $comm_percent)) / 100) : 0;

                $data['products'][] = [
                    'name' => htmlspecialchars($row_qitem["pro_name"]),
                    'description' => $row_qitem["pro_desc"],
                    'quantity' => $qty,
                    'unit_price' => $uprice,
                    'total_price' => $qty * $uprice,
                    'commission_percent' => $comm_percent,
                    'commission_value' => $comm_value,
                ];            
                $data['items'][] = $row_qitem;

                $tmp_uprice = isset($row_qitem["uprice"]) ? floatval($row_qitem["uprice"]) : 0.0;

                $is_old_process = isset($reqdata['is_old_process']) ? $reqdata['is_old_process'] : '0';

                if ($row_qitem["addi_id_list"] != "") {
                    //$s_addi_id =  $row_qitem["addi_id_list"];
                    //$s_addi_id = implode(",", $a_addi_id);
                    $a_addi_id = [];

                    $a_addi_val = [];
                    
                    foreach ($reqdata["tmp_id"] as $key => $tmp_id) {
                        $a_addi_id = []; // Reset for each tmp_id
                        $a_addi_val = []; // Reset for each tmp_id
                        $tmp_adj = 0; // Reset adjustment value for each tmp_id
                    
                        // Loop through additional IDs
                        foreach ($reqdata["addi_id"][$tmp_id] as $s_adj) {
                            $a_tmp_adj = explode("|", $s_adj);
                            $addi_id = floatval($a_tmp_adj[0]);
                            $addi_price = floatval($a_tmp_adj[1]);
                    
                            $a_addi_id[] = $addi_id;
                            $a_addi_val[$addi_id] = $addi_price;
                            $tmp_adj += $addi_price;
                        }
                    
                        if (!empty($a_addi_id)) {
                            $s_addi_id = implode(",", $a_addi_id);
                    
                            // Query to get additional names
                            $sql_addi = $is_old_process == "1"
                                ? "SELECT addi_id, addi_name FROM tbl_additional WHERE addi_id IN ({$s_addi_id});"
                                : "SELECT addi_id, addi_name FROM tbl_additional_new WHERE addi_id IN ({$s_addi_id});";
                    
                            $a_addi = Yii::app()->db->createCommand($sql_addi)->queryAll();
                    
                            $tmp_uprice += $tmp_adj;
                    
                            // Ensure array keys exist
                            if (!isset($data['items'][$i]['addi_name'][$tmp_id])) {
                                $data['items'][$i]['addi_name'][$tmp_id] = [];
                                $data['items'][$i]['addi_name_price'][$tmp_id] = [];
                            }
                    
                            // Append values under each tmp_id
                            foreach ($a_addi as $row_addi2) {
                                $tmp_addi_val = $a_addi_val[$row_addi2["addi_id"]];
                                $use_minus = $tmp_addi_val < 0 ? "-" : "";
                                $formatted_price = $use_minus . number_format(abs($tmp_addi_val) * $quote_currency, 2);
                    
                                // Append values correctly
                                $data['items'][$i]['addi_name'][$tmp_id][] = $row_addi2["addi_name"];
                                $data['items'][$i]['addi_name_price'][$tmp_id][] = $formatted_price;
                            }
                        }
                    }
                    
                }
            }
            
            // Add additional data
            $data['notes'] = [
                'sales_note' => $row_quote["sale_note"],
                'approval_comment' => $row_quote["approval_comment"],
            ];
            //return $data;
            $this->sendResponse(200, CJSON::encode($data));
        }else {
            //$result = $this->getQuoteDetailsForother($qdoc_id, $curr_id, $action_from);            
            $sql_quote = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $qdoc_id . "'; ";
            $a_quote = Yii::app()->db->createCommand($sql_quote)->queryAll();
            $row_quote = $a_quote[0];
            $comp_id = $row_quote["comp_id"];
            $older_curr_id = $reqdata['old_curr_id'];
            $oldsql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $older_curr_id . "'; ";
            $old_a_curr = Yii::app()->db->createCommand($oldsql_curr)->queryAll();
            $old_row_curr = $old_a_curr[0];
            $old_quote_currency = 1 / $old_row_curr["quote_currency"];
            
            // Fetch currency details
            $sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $curr_id . "'; ";
            $a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();
            $row_curr = $a_curr[0];
            $pre_cost = $row_curr["curr_symbol"];
            //$quote_currency = $row_curr["quote_currency"];
            $quote_currency = ($row_curr["quote_currency"]) * $old_quote_currency;

            // Fetch company details
            $sql_comp = "SELECT tbl_comp_info.comp_logo, tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.comp_id='" . $comp_id . "'; ";
            $a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();
            $row_comp = $a_comp[0];
            $comp_logo = $row_comp["comp_logo"];
            $qnote_text = $row_comp["qnote_text"];

            // Build the JSON data
            $data = [
                'company' => [
                    'logo' => Yii::app()->request->baseUrl . '/images/' . $comp_logo,
                    'name' => $row_quote["comp_name"],
                    'info' => $row_quote["comp_info"],
                ],
                'estimate' => [
                    'number' => $row_quote["est_number"],
                    'date' => date("F d, Y", strtotime($row_quote["est_date"])),
                    'expiration_date' => date("F d, Y", strtotime($row_quote["exp_date"])),
                    'po_number' => $row_quote["po_number"],
                ],
                'customer' => [
                    'name' => $row_quote["cust_name"],
                    'info' => $row_quote["cust_info"],
                ],
                'payment_terms' => $row_quote["payment_term"],
                'currency' => [
                    'symbol' => $pre_cost,
                    'name' => $row_curr["curr_name"],
                ],
                'products' => [],
                'items' => [],
                'totals' => [
                    'subtotal' => $row_quote["sub_total"] * $quote_currency,
                    'vat' => ($row_quote["sub_total"] - $row_quote['actual_discount']) * 0.07,
                    'grand_total' => $row_quote["grand_total"] * $quote_currency,
                ],
            ];

            // Fetch product details
            $sql_qitem = "SELECT * FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND enable=1 AND product_status='1' ORDER BY sort ASC; ";
            $a_qitem = Yii::app()->db->createCommand($sql_qitem)->queryAll();

            foreach ($a_qitem as $i => $row_qitem) {
                $pro_id = $row_qitem["pro_id"];
                $qty = $row_qitem["qty"];
                $uprice = $row_qitem["uprice"] * $quote_currency;
                $comm_percent = $row_qitem["comm_percent"];
                $comm_value = ($comm_percent != "") ? ($qty * $uprice) * (intval(str_replace("%", "", $comm_percent)) / 100) : 0;

                $data['products'][] = [
                    'name' => htmlspecialchars($row_qitem["pro_name"]),
                    'description' => $row_qitem["pro_desc"],
                    'quantity' => $qty,
                    'unit_price' => $uprice,
                    'total_price' => $qty * $uprice,
                    'commission_percent' => $comm_percent,
                    'commission_value' => $comm_value,                
                    'row_qitem' => $row_qitem,                
                ];

                $data['items'][] = [
                    'item_id' => $row_qitem["item_id"],
                    'comm_percent' => $row_qitem["comm_percent"],
                    'qty_note' => $row_qitem["qty_note"],
                    'pro_type' => $row_qitem["pro_type"],
                    'pro_name' => $row_qitem["pro_name"],
                    'pro_desc' => $row_qitem["pro_desc"],
                    'qty' => $row_qitem["qty"],
                    'uprice' => $qty * $uprice,
                    'uprice_ori' => $uprice,
                ];

                $tmp_uprice = isset($row_qitem["uprice"]) ? floatval($row_qitem["uprice"]) : 0.0;

                $is_old_process = isset($reqdata['is_old_process']) ? $reqdata['is_old_process'] : '0';
                if ($row_qitem["addi_id_list"] != "") {
                    //$s_addi_id =  $row_qitem["addi_id_list"];
                    //$s_addi_id = implode(",", $a_addi_id);
                    $a_addi_id = [];

                    $a_addi_val = [];
                    
                    foreach ($reqdata["tmp_id"] as $key => $tmp_id) {
                        $a_addi_id = []; // Reset for each tmp_id
                        $a_addi_val = []; // Reset for each tmp_id
                        $tmp_adj = 0; // Reset adjustment value for each tmp_id
                    
                        // Loop through additional IDs
                        foreach ($reqdata["addi_id"][$tmp_id] as $s_adj) {
                            $a_tmp_adj = explode("|", $s_adj);
                            $addi_id = floatval($a_tmp_adj[0]);
                            $addi_price = floatval($a_tmp_adj[1]);
                    
                            $a_addi_id[] = $addi_id;
                            $a_addi_val[$addi_id] = $addi_price;
                            $tmp_adj += $addi_price;
                        }
                    
                        if (!empty($a_addi_id)) {
                            $s_addi_id = implode(",", $a_addi_id);
                    
                            // Query to get additional names
                            $sql_addi = $is_old_process == "1"
                                ? "SELECT addi_id, addi_name FROM tbl_additional WHERE addi_id IN ({$s_addi_id});"
                                : "SELECT addi_id, addi_name FROM tbl_additional_new WHERE addi_id IN ({$s_addi_id});";
                    
                            $a_addi = Yii::app()->db->createCommand($sql_addi)->queryAll();
                    
                            $tmp_uprice += $tmp_adj;
                    
                            // Ensure array keys exist
                            if (!isset($data['items'][$i]['addi_name'][$tmp_id])) {
                                $data['items'][$i]['addi_name'][$tmp_id] = [];
                                $data['items'][$i]['addi_name_price'][$tmp_id] = [];
                            }
                    
                            // Append values under each tmp_id
                            foreach ($a_addi as $row_addi2) {
                                $tmp_addi_val = $a_addi_val[$row_addi2["addi_id"]];
                                $use_minus = $tmp_addi_val < 0 ? "-" : "";
                                $formatted_price = $use_minus . number_format(abs($tmp_addi_val) * $quote_currency, 2);
                    
                                // Append values correctly
                                $data['items'][$i]['addi_name'][$tmp_id][] = $row_addi2["addi_name"];
                                $data['items'][$i]['addi_name_price'][$tmp_id][] = $formatted_price;
                            }
                        }
                    }
                    
                }
            }

            // Add additional data
            $data['notes'] = [
                'sales_note' => $row_quote["sale_note"],
                'approval_comment' => $row_quote["approval_comment"],
            ];            
            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    private function getQuoteDetails($qdoc_id, $curr_id, $action_from)
    {
        // Fetch quote details
        $sql_quote = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $qdoc_id . "'; ";
        $a_quote = Yii::app()->db->createCommand($sql_quote)->queryAll();
        $row_quote = $a_quote[0];
        $comp_id = $row_quote["comp_id"];

        // Fetch currency details
        $sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $curr_id . "'; ";
        $a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();
        $row_curr = $a_curr[0];
        $pre_cost = $row_curr["curr_symbol"];
        $quote_currency = $row_curr["quote_currency"];

        // Fetch company details
        $sql_comp = "SELECT tbl_comp_info.comp_logo, tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.comp_id='" . $comp_id . "'; ";
        $a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();
        $row_comp = $a_comp[0];
        $comp_logo = $row_comp["comp_logo"];
        $qnote_text = $row_comp["qnote_text"];

        // Build the JSON data
        $data = [
            'company' => [
                'logo' => Yii::app()->request->baseUrl . '/images/' . $comp_logo,
                'name' => $row_quote["comp_name"],
                'info' => $row_quote["comp_info"],
            ],
            'estimate' => [
                'number' => $row_quote["est_number"],
                'date' => date("F d, Y", strtotime($row_quote["est_date"])),
                'expiration_date' => date("F d, Y", strtotime($row_quote["exp_date"])),
                'po_number' => $row_quote["po_number"],
            ],
            'customer' => [
                'name' => $row_quote["cust_name"],
                'info' => $row_quote["cust_info"],
            ],
            'payment_terms' => $row_quote["payment_term"],
            'currency' => [
                'symbol' => $pre_cost,
                'name' => $row_curr["curr_name"],
            ],
            'products' => [],
            'totals' => [
                'subtotal' => $row_quote["sub_total"] * $quote_currency,
                'vat' => ($row_quote["sub_total"] - $row_quote['actual_discount']) * 0.07,
                'grand_total' => $row_quote["grand_total"] * $quote_currency,
            ],
        ];

        // Fetch product details
        $sql_qitem = "SELECT * FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND enable=1 AND product_status='1' ORDER BY sort ASC; ";
        $a_qitem = Yii::app()->db->createCommand($sql_qitem)->queryAll();

        foreach ($a_qitem as $row_qitem) {
            $pro_id = $row_qitem["pro_id"];
            $qty = $row_qitem["qty"];
            $uprice = $row_qitem["uprice"] * $quote_currency;
            $comm_percent = $row_qitem["comm_percent"];
            $comm_value = ($comm_percent != "") ? ($qty * $uprice) * (intval(str_replace("%", "", $comm_percent)) / 100) : 0;

            $data['products'][] = [
                'name' => htmlspecialchars($row_qitem["pro_name"]),
                'description' => $row_qitem["pro_desc"],
                'quantity' => $qty,
                'unit_price' => $uprice,
                'total_price' => $qty * $uprice,
                'commission_percent' => $comm_percent,
                'commission_value' => $comm_value,
            ];            
            $data['items'][] = $row_qitem;

            $tmp_uprice = isset($row_qitem["uprice"]) ? floatval($row_qitem["uprice"]) : 0.0;

            $is_old_process = isset($reqdata['is_old_process']) ? $reqdata['is_old_process'] : '0';

            if ($row_qitem["addi_id_list"] != "") {
                $s_addi_id =  $row_qitem["addi_id_list"];
                //$s_addi_id = implode(",", $a_addi_id);

                $sql_addi = $is_old_process == "1" ?

                    "SELECT addi_id, addi_name FROM tbl_additional WHERE addi_id IN ({$s_addi_id});" :

                    "SELECT addi_id, addi_name FROM tbl_additional_new WHERE addi_id IN ({$s_addi_id});";

                $a_addi = Yii::app()->db->createCommand($sql_addi)->queryAll();
                
                $k = 0;
                $a_addi_val = [];
                foreach ($a_addi as $row_addi2) {

                    $tmp_addi_val = $a_addi_val[$row_addi2["addi_id"]];

                    $use_minus = $tmp_addi_val < 0 ? "-" : "";

                    $tmp_addi_val = abs($tmp_addi_val);
                    

                    $data['add'][$k] = $row_addi2["addi_name"];

                    $data['addp'][$k] = $use_minus  . number_format($row_addi2["addi_value"] * $quote_currency, 2);
                    $k++;
                }
            }
        }

        // Add additional data
        $data['notes'] = [
            'sales_note' => $row_quote["sale_note"],
            'approval_comment' => $row_quote["approval_comment"],
        ];

        return $data;
    }
    private function getQuoteDetailsForother($qdoc_id, $curr_id, $action_from)
    {
        // Fetch quote details
        $sql_quote = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $qdoc_id . "'; ";
        $a_quote = Yii::app()->db->createCommand($sql_quote)->queryAll();
        $row_quote = $a_quote[0];
        $comp_id = $row_quote["comp_id"];

        $older_curr_id = $_POST['old_curr_id'];



        $oldsql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $older_curr_id . "'; ";

        $old_a_curr = Yii::app()->db->createCommand($oldsql_curr)->queryAll();

        $old_row_curr = $old_a_curr[0];

        $old_quote_currency = 1 / $old_row_curr["quote_currency"];

        // Fetch currency details
        $sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $curr_id . "'; ";
        $a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();
        $row_curr = $a_curr[0];
        $pre_cost = $row_curr["curr_symbol"];
        //$quote_currency = $row_curr["quote_currency"];
        $quote_currency = ($row_curr["quote_currency"]) * $old_quote_currency;

        // Fetch company details
        $sql_comp = "SELECT tbl_comp_info.comp_logo, tbl_quote_note.qnote_text FROM tbl_comp_info LEFT JOIN tbl_quote_note ON tbl_comp_info.comp_id=tbl_quote_note.comp_id WHERE tbl_comp_info.comp_id='" . $comp_id . "'; ";
        $a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();
        $row_comp = $a_comp[0];
        $comp_logo = $row_comp["comp_logo"];
        $qnote_text = $row_comp["qnote_text"];

        // Build the JSON data
        $data = [
            'company' => [
                'logo' => Yii::app()->request->baseUrl . '/images/' . $comp_logo,
                'name' => $row_quote["comp_name"],
                'info' => $row_quote["comp_info"],
            ],
            'estimate' => [
                'number' => $row_quote["est_number"],
                'date' => date("F d, Y", strtotime($row_quote["est_date"])),
                'expiration_date' => date("F d, Y", strtotime($row_quote["exp_date"])),
                'po_number' => $row_quote["po_number"],
            ],
            'customer' => [
                'name' => $row_quote["cust_name"],
                'info' => $row_quote["cust_info"],
            ],
            'payment_terms' => $row_quote["payment_term"],
            'currency' => [
                'symbol' => $pre_cost,
                'name' => $row_curr["curr_name"],
            ],
            'products' => [],
            'items' => [],
            'totals' => [
                'subtotal' => $row_quote["sub_total"] * $quote_currency,
                'vat' => ($row_quote["sub_total"] - $row_quote['actual_discount']) * 0.07,
                'grand_total' => $row_quote["grand_total"] * $quote_currency,
            ],
        ];

        // Fetch product details
        $sql_qitem = "SELECT * FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND enable=1 AND product_status='1' ORDER BY sort ASC; ";
        $a_qitem = Yii::app()->db->createCommand($sql_qitem)->queryAll();

        foreach ($a_qitem as $row_qitem) {
            $pro_id = $row_qitem["pro_id"];
            $qty = $row_qitem["qty"];
            $uprice = $row_qitem["uprice"] * $quote_currency;
            $comm_percent = $row_qitem["comm_percent"];
            $comm_value = ($comm_percent != "") ? ($qty * $uprice) * (intval(str_replace("%", "", $comm_percent)) / 100) : 0;

            $data['products'][] = [
                'name' => htmlspecialchars($row_qitem["pro_name"]),
                'description' => $row_qitem["pro_desc"],
                'quantity' => $qty,
                'unit_price' => $uprice,
                'total_price' => $qty * $uprice,
                'commission_percent' => $comm_percent,
                'commission_value' => $comm_value,                
                'row_qitem' => $row_qitem,                
            ];

            $data['items'][] = [
                'item_id' => $row_qitem["item_id"],
                'comm_percent' => $row_qitem["comm_percent"],
                'qty_note' => $row_qitem["qty_note"],
                'pro_type' => $row_qitem["pro_type"],
                'pro_name' => $row_qitem["pro_name"],
                'pro_desc' => $row_qitem["pro_desc"],
                'qty' => $row_qitem["qty"],
                'uprice' => $qty * $uprice,
                'uprice_ori' => $uprice,
            ];
        }

        // Add additional data
        $data['notes'] = [
            'sales_note' => $row_quote["sale_note"],
            'approval_comment' => $row_quote["approval_comment"],
        ];

        return $data;
    }



    //-------------------------------ESTIMATE---------------------------



    public function actionNotification()
    {



        if ($this->authenticate()) {

            $user_id = Yii::app()->user->getId();

            //$user_id = Yii::app()->user->getState('userKey');

            $noti_sql = "SELECT COUNT(*) as total_noti FROM notifications WHERE employee_id='$user_id' AND noti_status='0'";

            $noti_quoute['total_noti'] = Yii::app()->db->createCommand($noti_sql)->queryAll();



            $noti_sql = "SELECT noti_id,user.fullname AS from_emp_name,tbl_quote_doc.est_number AS est_num,notifications.doc_id as doc_id,notifications.noti_date as noti_date,noti_status,item_id,link_id FROM notifications LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=notifications.doc_id JOIN user ON user.id=notifications.noti_from_employee WHERE notifications.employee_id='$user_id' ORDER BY notifications.noti_date DESC";

            $noti_quoute['noti'] = Yii::app()->db->createCommand($noti_sql)->queryAll();



            $this->sendResponse(200, CJSON::encode($noti_quoute));
        }
    }





    public function actionDelete_Single_notification()
    {

        if ($this->authenticate()) {

            $user_id = Yii::app()->user->getId();

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
    }



    public function actionAdd_chat()

    {

        if ($this->authenticate()) {

            $user_id = Yii::app()->user->getId();

            $text_comment = addslashes($_POST["text_comment"]);

            $doc_id = addslashes($_POST["doc_id"]);

            $emp_id = $user_id;



            $user = User::model()->findByPk($user_id);

            $full_name = $user->fullname;

            $user_group = $user->user_group_id;



            if ($user_group == "99" || $user_group == "1") {

                $chat_type = "A";
            } else {

                $chat_type = "E";
            }



            $sql_insert = "INSERT INTO `tbl_comments_extra`(`doc_id`,`full_name`, `user_id`,`chat_type`, `message_long`) VALUES ('$doc_id','$full_name','$emp_id','$chat_type','$text_comment')";



            if (Yii::app()->db->createCommand($sql_insert)->execute()) {

                if ($chat_type == "E") {

                    $sql_fetch = "SELECT * FROM user WHERE user_group_id='99' OR user_group_id='1'";

                    $a_quote = Yii::app()->db->createCommand($sql_fetch)->queryAll();

                    foreach ($a_quote as $main) {

                        $to_employee_id = $main['id'];

                        $sql_noti = "INSERT INTO `notifications`(`doc_id`, `noti_detail`, `employee_id`, `noti_from_employee`) VALUES ('$doc_id','Comment','$to_employee_id','$emp_id')";

                        Yii::app()->db->createCommand($sql_noti)->execute();



                        $this->sendNotification($to_employee_id, 'Comment', $full_name, $doc_id);
                    }



                    if ($emp_id == "34") {

                        $sql_noti = "INSERT INTO `notifications`(`doc_id`, `noti_detail`, `employee_id`, `noti_from_employee`) VALUES ('$doc_id','Comment','34','34')";

                        Yii::app()->db->createCommand($sql_noti)->execute();

                        $this->sendNotification($to_employee_id, 'Comment', $full_name, $doc_id);
                    }
                } else {

                    $sql_fetch = "SELECT user_id FROM tbl_quote_doc WHERE qdoc_id='$doc_id'";

                    $a_quote = Yii::app()->db->createCommand($sql_fetch)->queryAll();

                    $to_employee_id = $a_quote[0]['user_id'];

                    $sql_noti = "INSERT INTO `notifications`(`doc_id`, `noti_detail`, `employee_id`, `noti_from_employee`) VALUES ('$doc_id','Comment','$to_employee_id','$emp_id')";

                    Yii::app()->db->createCommand($sql_noti)->execute();

                    $this->sendNotification($to_employee_id, 'Comment', $full_name, $doc_id);
                }



                $a_result["result"] = "success";
            } else {

                $a_result["result"] = "fail";

                $a_result["msg"] = "Fail to save new note.";
            }

            $this->sendResponse(200, CJSON::encode($a_result));
        }
    }



    public function actionFetch_chat()

    {

        if ($this->authenticate()) {

            $user_id = Yii::app()->user->getId();

            $user = User::model()->findByPk($user_id);

            $user_group = $user->user_group_id;



            if ($user_group == "99" || $user_group == "1") {

                $chat_type = "A";
            } else {

                $chat_type = "E";
            }

            $doc_id = $_POST['doc_id'];

            $emp_id = $user_id;

            $string = "";

            $sql = "SELECT * FROM tbl_comments_extra WHERE doc_id='$doc_id' ORDER BY add_time ASC";

            $a_qitem = Yii::app()->db->createCommand($sql)->queryAll();
            
              $data  = []; 
            foreach($a_qitem as $key=>$value){
                 $value['message_long'] = $this->cleanCommentText($value['message_long']); 
                 $data[] = $value ; 
            }




            $this->sendResponse(200, CJSON::encode($data));
        }
    }


    
    function cleanCommentText($html)
    {
        // Decode HTML entities like &nbsp;
        $text = html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // Replace <br> and </div> with new lines
        $text = preg_replace('/<br\s*\/?>/i', "\n", $text);
        $text = preg_replace('/<\/div>/i', "\n", $text);

        // Remove all remaining HTML tags
        $text = strip_tags($text);

        // Normalize spaces and line breaks
        $text = preg_replace("/\r\n|\r/", "\n", $text);
        $text = preg_replace("/\n{2,}/", "\n", $text);
        $text = trim($text);

        return $text;
    }



    public function actionNotif_count()
    {
        if ($this->authenticate()) {
            $user_id = Yii::app()->user->getId();
            $user = User::model()->findByPk($user_id);
            $user_group = $user->user_group_id;

            $more_condition = "";
            if( $user_group!="1" && $user_group!="99" ){            
                $more_condition = " AND tbl_quote_doc.user_id='".$user_id."' ";
            }

            

            $sql = "SELECT
                        tbl_quote_doc.approve_status,
                        COUNT(DISTINCT tbl_quote_doc.qdoc_id) AS num_status
                    FROM
                        tbl_quote_doc
                    LEFT JOIN
                        user ON tbl_quote_doc.user_id = user.id
                    LEFT JOIN
                        tbl_quote_item ON tbl_quote_doc.qdoc_id = tbl_quote_item.qdoc_id
                    WHERE
                        tbl_quote_doc.enable = 1
                        AND tbl_quote_doc.archive = '0'
                        AND tbl_quote_item.enable = 1".$more_condition."
                    GROUP BY
                        tbl_quote_doc.approve_status
                    ";

            $quote_status = Yii::app()->db->createCommand($sql)->queryAll();
            $a_app_status["new"] = 0;
            $a_app_status["approve"] = 0;
            $a_app_status["reject"] = 0;
            foreach($quote_status as $tmp_key => $row_qstatus){
                $a_app_status[($row_qstatus["approve_status"])] = $row_qstatus["num_status"];
            }

            if( $user_group!="1" && $user_group!="99" ){
                $more_condition .= " AND tbl_quote_doc.is_editing='2' ";
            }else{
                $more_condition .= " AND tbl_quote_doc.is_editing='1' ";
            }
            

            //$sql = " SELECT tbl_quote_doc.approve_status,COUNT(tbl_quote_doc.qdoc_id) AS num_status FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id WHERE tbl_quote_doc.enable=1 AND tbl_quote_doc.archive='0' " . $more_condition . " GROUP BY tbl_quote_doc.approve_status;";
            // $sql = "SELECT tbl_quote_doc.approve_status,COUNT(tbl_quote_doc.qdoc_id) AS num_status FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id WHERE tbl_quote_doc.enable=1 AND tbl_quote_doc.archive='0' GROUP BY tbl_quote_doc.approve_status;";
            // $quote_status['data'] = Yii::app()->db->createCommand($sql)->queryAll();

            $sql2 = "SELECT COUNT(tbl_quote_doc.qdoc_id) AS num_redit FROM tbl_quote_doc LEFT JOIN user ON tbl_quote_doc.user_id=user.id WHERE tbl_quote_doc.enable=1 AND tbl_quote_doc.archive='1'  AND tbl_quote_doc.is_editing='1' ".$more_condition.";";
            $a_edit_alert = Yii::app()->db->createCommand($sql2)->queryAll();
            $new['Archived'] = $a_edit_alert[0]["num_redit"];
            
            $noti_sql = "SELECT COUNT(*) as total_noti FROM notifications WHERE employee_id='$user_id' AND noti_status='0'";
            $noti_quoute = Yii::app()->db->createCommand($noti_sql)->queryAll();

            $notfi['notification']  = $noti_quoute[0]['total_noti'];

            array_push($a_app_status, $notfi, $new);
        }

        $this->sendResponse(200, CJSON::encode($a_app_status));
    }



    public function actionMark_all_noti()

    {

        if ($this->authenticate()) {



            $user_id = Yii::app()->user->getId();

            $sql = "UPDATE notifications SET noti_status=1 WHERE employee_id='$user_id'";

            if (Yii::app()->db->createCommand($sql)->execute()) {

                $a_result["result"] = "success";

                $this->sendResponse(200, CJSON::encode($a_result));
            } else {

                $a_result["result"] = "fail";

                $a_result["msg"] = "Fail to save new note.";

                $this->sendResponse(400, CJSON::encode($a_result));
            }
        }
    }



    public function actionDelete_all_noti()

    {

        if ($this->authenticate()) {



            $user_id = Yii::app()->user->getId();



            $sql = "DELETE FROM notifications WHERE employee_id='$user_id'";

            if (Yii::app()->db->createCommand($sql)->execute()) {

                $a_result["result"] = "success";

                $this->sendResponse(200, CJSON::encode($a_result));
            } else {

                $a_result["result"] = "fail";

                $a_result["msg"] = "Fail to save new note.";

                $this->sendResponse(400, CJSON::encode($a_result));
            }
        }
    }





    public function actionQuote_estimate()

    {

        if ($this->authenticate()) {

            $user_id = Yii::app()->user->getId();

            $user = User::model()->findByPk($user_id);

            $user_group = $user->user_group_id;







            $year_date = date("Y");

            $year_month = date("m");

            if (isset($_POST['year_date'])) {

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



                $operator = (count($conditions) > 1) ? 'OR' : 'AND';

                if (!empty($conditions)) {

                    $sql .= " AND (" . implode(" $operator ", $conditions) . ")";
                }

                $sql .= " ORDER BY quotation_data.created_date DESC";
            } else {

                $sql = "SELECT * from quotation_data LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=quotation_data.qdoci_id LEFT JOIN user ON user.id=quotation_data.conv_by_id WHERE monthname(`conv_date`)=MONTHNAME(STR_TO_DATE($year_month, '%m')) AND YEAR(`conv_date`)='$year_date' AND (conv_by_id='$user_id' OR original_sales_id='$user_id') AND is_deleted='0' AND archive_status='0' ORDER BY quotation_data.created_date DESC";
            }



            if ($user_id == 34) {

                $sql = "SELECT * from quotation_data LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=quotation_data.qdoci_id LEFT JOIN user ON user.id=quotation_data.conv_by_id WHERE monthname(`conv_date`)=MONTHNAME(STR_TO_DATE($year_month, '%m')) AND YEAR(`conv_date`)='$year_date' AND (conv_by_id='$user_id' OR original_sales_id='$user_id' OR conv_by_id='27' OR original_sales_id='27') AND is_deleted='0' AND archive_status='0' ORDER BY quotation_data.created_date DESC";
            }



            $data['quotes'] = Yii::app()->db->createCommand($sql)->queryAll();

            $data['year'] = $year_date;

            $data['month'] = $year_month;
        }

        /*$result['model'] = new Upload;

		$result['files'] = Upload::model()->findAll();*/



        $this->sendResponse(200, CJSON::encode($data));
    }

    public function actionApproveQuote()
	{   
        
        $rawData = file_get_contents('php://input');
        $cleanData = preg_replace('/[[:cntrl:]]/', '', $rawData);
        $reqdata = json_decode($cleanData, true);

		

        if ($this->authenticate()) {
            $cust_id = $reqdata["cust_selector"];
            $sql_cust = "SELECT * FROM tbl_cust_info WHERE cust_id='" . $cust_id . "'; ";
            $a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();
            $row_cust = $a_cust[0];
            $cust_name = $row_cust["cust_name"];
            $cust_info = $row_cust["cust_info"];
            $qdoc_id = $reqdata["qdoc_id"];

            $comp_id = $reqdata["head_selector_app"];
            $sql_comp = "SELECT * FROM tbl_comp_info WHERE comp_id='" . $comp_id . "'; ";
            $a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();
            $row_comp = $a_comp[0];
            $comp_name = addslashes($row_comp["comp_name"]);
            $comp_info = addslashes($row_comp["comp_info"]);
            $curr_id = $reqdata['curr_id'];
            $quote_curr = $reqdata['quote_curr'];

            $payment_term = addslashes($reqdata["payment_term"]);

            $vat_value = $reqdata["vat_value_app"];
            if (isset($reqdata["inc_vat_app"])) {
                $inc_vat = "yes";
            } else {
                $inc_vat = "no";
            }
            $note_text = addslashes($reqdata["note_text"]);

            $sub_total = 0.0;

            $discount_percent = $reqdata['discount_percent'];
            $actual_discount = $reqdata['actual_discount'];

            for ($i = 0; $i < sizeof($reqdata["qdoci_id"]); $i++) {

                $qdoci_id = $reqdata["qdoci_id"][$i];
                $pro_name = addslashes($reqdata["pro_name"][$i]);
                $pro_desc = addslashes($reqdata["pro_desc"][$i]);
                $comm_percent = $reqdata["app_comm_percent"][$i] . '%';
                $qty = floatval($reqdata["app_qty"][$i]);
                $uprice = floatval($reqdata["app_uprice"][$i]);

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

            $approval_comment = addslashes($reqdata["approval_comment"]);

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
                $a_result = array(
                    'status' => 200,
                    'date' => 'success',
                );
            } else {
                $a_result["result"] = "fail";
                $a_result["msg"] = "Fail to approve.";
            }

            $sql_update_draft = "UPDATE tbl_quote_doc SET draft_changed='1' WHERE qdoc_id='" . $qdoc_id . "'; ";

            Yii::app()->db->createCommand($sql_update_draft)->execute();

        }

        $this->sendResponse(200, CJSON::encode($a_result));
        
	}

    public function actionRejectQuote()
	{

        $rawData = file_get_contents('php://input');
        $cleanData = preg_replace('/[[:cntrl:]]/', '', $rawData);
        $reqdata = json_decode($cleanData, true);

		$qdoc_id = $reqdata["qdoc_id"];
		$note_text = addslashes($reqdata["note_text"]);
		$approval_comment = addslashes($reqdata["approval_comment"]);
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

		$comp_id = $reqdata["head_selector_app"];
		$sql_comp = "SELECT * FROM tbl_comp_info WHERE comp_id='" . $comp_id . "'; ";
		$a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();
		$row_comp = $a_comp[0];
		$comp_name = addslashes($row_comp["comp_name"]);
		$comp_info = addslashes($row_comp["comp_info"]);

		$payment_term = addslashes($reqdata["payment_term"]);

		$vat_value = $reqdata["vat_value_app"];
		if (isset($reqdata["inc_vat_app"])) {
			$inc_vat = "yes";
		} else {
			$inc_vat = "no";
		}
		//$note_text = addslashes($_POST["note_text"]);

		$sub_total = 0.0;

		for ($i = 0; $i < sizeof($reqdata["qdoci_id"]); $i++) {

			$qdoci_id = $reqdata["qdoci_id"][$i];
			$pro_name = addslashes($reqdata["pro_name"][$i]);
			$pro_desc = addslashes($reqdata["pro_desc"][$i]);
			$comm_percent = $reqdata["app_comm_percent"][$i] . '%';
			$qty = floatval($reqdata["app_qty"][$i]);
			$uprice = floatval($reqdata["app_uprice"][$i]);

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
			$a_result = array(
                'status' => 200,
                'date' => 'success',
            );
		} else {
			$a_result["result"] = "fail";
			$a_result["msg"] = "Error saving data.";
		}

		$sql_update_draft = "UPDATE tbl_quote_doc SET draft_changed='1' WHERE qdoc_id='" . $qdoc_id . "'; ";

		Yii::app()->db->createCommand($sql_update_draft)->execute();

		$this->sendResponse(200, CJSON::encode($a_result));
	}


    public function actionEstimate_request_Update()
    {

        if ($this->authenticate()) {

            $conv_id = $_POST['conv_id'];

            $update_notes = addslashes($_POST['update_notes']);

            $sql = "UPDATE quotation_data SET request_update=1,request_text='$update_notes' WHERE conv_id='$conv_id'";

            Yii::app()->db->createCommand($sql)->execute();


            $result = array(
                'status' => 200,
                'date' => 'success',
            );
            $this->sendResponse(200, CJSON::encode($result));
        }
    }

    public function actionDuplicate_Quote(){

		$qdoc_id = $_POST["qdoc_id"];

		$sql_dup_doc = "INSERT INTO tbl_quote_doc (user_id, comp_id, comp_name, comp_info, curr_id, quote_curr, payment_term, cust_id, cust_name, cust_info, est_number, est_date, exp_date, inc_vat, vat_value, num_item, sub_total, grand_total, sale_note, note, approve_status, approve_date, reject_time, is_temp, is_duplicate, archive, add_date, enable, dup_from,dup_from_id)

            SELECT user_id, comp_id, comp_name, comp_info, curr_id, quote_curr, payment_term, cust_id, cust_name, cust_info, est_number, est_date, exp_date, inc_vat, vat_value, num_item, sub_total, grand_total, sale_note, note, approve_status, approve_date, reject_time, is_temp, 1, archive, add_date, enable, 2,'$qdoc_id'

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
		    if($addi_id_list=="" || $addi_id_list==null){
		        $sql_add = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,pro_id,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,addi_desc,comm_percent,sort,add_date,enable) VALUES ('$new_qdoc_id','$pro_type','$pro_id','$item_id','$pro_name','$pro_desc','$qty','$qty_note','$uprice','$uprice_ori','$addi_id_list','$addi_desc','$comm_percent','$sort','$add_date','$enable')";
		        Yii::app()->db->createCommand($sql_add)->execute();
		    }else{
		        //$uprice = $uprice_ori;
		        $sql_add = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,pro_id,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,addi_desc,comm_percent,sort,add_date,enable) VALUES ('$new_qdoc_id','$pro_type','$pro_id','$item_id','$pro_name','$pro_desc','$qty','$qty_note','$uprice','$uprice_ori','$addi_id_list','$addi_desc','$comm_percent','$sort','$add_date','$enable')";

		        Yii::app()->db->createCommand($sql_add)->execute();
		    }

		}

		$a_result["result"] = "success";

		$result = array(
            'status' => 200,
            'date' => $a_result["result"],
        );
        $this->sendResponse(200, CJSON::encode($result));
	}

    public function actionAdd_To_Quotation()
	{

        if ($this->authenticate()) {
            $qdoc_id = $_POST["qdoc_id"];
            $qty = $_POST["qty"];            
            //$obj_cart_info = json_decode($_COOKIE["JOG_CART_info"]);
            $sql_doc = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $qdoc_id . "'; ";

            $a_doc = Yii::app()->db->createCommand($sql_doc)->queryAll();

            $row_doc = $a_doc[0];



            $prg_id = $_POST["prg_id"];



            $sql_select = "SELECT tbl_price_guide.*,tbl_product.prod_type,tbl_comm_percent.comm_value,tbl_comm_percent.qty_name,tbl_item.item_name";

            $sql_select .= ",CONCAT(IF(tbl_item.item_style IS NULL,'',tbl_item.item_style),IF(tbl_item.item_detail IS NULL,'',tbl_item.item_detail),IF(tbl_item.item_fabric_opt IS NULL,'',tbl_item.item_fabric_opt)) AS desc_show ";

            $sql_select .= " FROM tbl_price_guide ";

            $sql_select .= " LEFT JOIN tbl_item ON tbl_price_guide.item_id=tbl_item.item_id ";

            $sql_select .= " LEFT JOIN tbl_product ON tbl_item.prod_id=tbl_product.prod_id ";

            $sql_select .= " LEFT JOIN tbl_comm_percent ON tbl_price_guide.comm_per_id=tbl_comm_percent.comm_per_id ";

            $sql_select .= " WHERE tbl_price_guide.prg_id='" . $prg_id . "'; ";

            $a_prg = Yii::app()->db->createCommand($sql_select)->queryAll();

            $a_prg_data = $a_prg[0];



            $item_id = $a_prg_data["item_id"];



            if ($row_doc["curr_id"] != $a_prg_data["curr_id"]) {

                echo "Please select the same currency as another items in Quotation.";

                exit();
            }

            


            $sql_max = "SELECT MAX(sort) AS max_sort FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND enable=1; ";

            $a_max = Yii::app()->db->createCommand($sql_max)->queryAll();

            $max_sort = intval($a_max[0]["max_sort"]);

            $max_sort++;



            $p_type = $a_prg_data["prod_type"];

            $uprice = $a_prg_data["price"];

            $qty_note = $a_prg_data["qty_name"];

            $comm_percent = $a_prg_data["comm_value"];



            $add_date = date("Y-m-d H:i:s");



            $pro_name = addslashes($a_prg_data["item_name"]);



            $pro_desc = addslashes(str_replace(",", "\n", $a_prg_data["desc_show"]));



            $sql_add_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,comm_percent,sort,add_date) VALUES (";

            $sql_add_item .= "'" . $qdoc_id . "','" . $p_type . "','" . $item_id . "','" . $pro_name . "','" . $pro_desc . "','" . $qty . "','" . $qty_note . "','" . $uprice . "','" . $uprice . "','" . $comm_percent . "','" . $max_sort . "','" . $add_date . "'";

            $sql_add_item .= "); ";

            Yii::app()->db->createCommand($sql_add_item)->execute();



            $sql_update = "UPDATE tbl_quote_doc SET num_item=num_item+1 WHERE qdoc_id='" . $qdoc_id . "'; ";



            $a_data = array();



            if (Yii::app()->db->createCommand($sql_update)->execute()) {



                $obj_cart_quote = (array)json_decode($_COOKIE["JOG_CART_Quote"]);



                $a_data = $obj_cart_quote;

                $a_data["num_item"] = intval($obj_cart_quote["num_item"]) + 1;



                setcookie("JOG_CART_Quote", json_encode($a_data));



                
                $result = array(
                    'status' => 200,
                    'date' => 'success',
                );
                $this->sendResponse(200, CJSON::encode($result));

            } else {

                $result = array(
                    'status' => 200,
                    'date' => 'Fail to add item',
                );
                $this->sendResponse(200, CJSON::encode($result));
                
            }
        }
	}

    public function actionAdd_Extra_To_Quotation(){

		$qdoc_id = $_POST["qdoc_id"];
		//$obj_cart_info = json_decode($_COOKIE["JOG_CART_info"]);
		$sql_doc = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='".$qdoc_id."'; ";
		$a_doc = Yii::app()->db->createCommand($sql_doc)->queryAll();
		$row_doc = $a_doc[0];

		$extra_id = $_POST["extra_id"];
		$sql_extra = "SELECT * FROM tbl_extra WHERE extra_id='".$extra_id."'; ";
		$a_extra = Yii::app()->db->createCommand($sql_extra)->queryAll();
		$row_extra = $a_extra[0];

		if($row_doc["curr_id"]!=$row_extra["curr_id"]){

            $result = array(
                'status' => 200,
                'date' => 'The currency does not match.',
            );
            $this->sendResponse(200, CJSON::encode($result));
		}

		$sql_item_chk = "SELECT * FROM tbl_quote_item WHERE qdoc_id='".$qdoc_id."' AND pro_type='extra' AND item_id='".$extra_id."' AND enable=1; ";
		$a_item_chk = Yii::app()->db->createCommand($sql_item_chk)->queryAll();

		if(sizeof($a_item_chk)>0){
			

            $result = array(
                'status' => 200,
                'date' => 'Duplicate item! \nYou must delete item from Quotation before',
            );
            $this->sendResponse(200, CJSON::encode($result));
		}

		$sql_max = "SELECT MAX(sort) AS max_sort FROM tbl_quote_item WHERE qdoc_id='".$qdoc_id."' AND enable=1; ";
		$a_max = Yii::app()->db->createCommand($sql_max)->queryAll();
		$max_sort = intval($a_max[0]["max_sort"]);
		$max_sort++;


		$uprice = $row_extra["extra_value"];
		$add_date = date("Y-m-d H:i:s");

		$pro_name = addslashes($row_extra["extra_name"]);
		$pro_desc = addslashes($row_extra["extra_desc"]);

		$sql_add_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,item_id,pro_name,pro_desc,uprice,sort,add_date) VALUES (";
		$sql_add_item .= "'".$qdoc_id."','extra','".$extra_id."','".$pro_name."','".$pro_desc."','".$uprice."','".$max_sort."','".$add_date."'";
		$sql_add_item .= "); ";
		Yii::app()->db->createCommand($sql_add_item)->execute();

		$sql_update = "UPDATE tbl_quote_doc SET num_item=num_item+1 WHERE qdoc_id='".$qdoc_id."'; ";

		$a_data = array();

		if(Yii::app()->db->createCommand($sql_update)->execute()){

			$obj_cart_quote = (array)json_decode($_COOKIE["JOG_CART_Quote"]);

			$a_data = $obj_cart_quote;
			$a_data["num_item"] = intval($obj_cart_quote["num_item"])+1;

		
            $result = array(
                'status' => 200,
                'date' => 'success',
            );
            $this->sendResponse(200, CJSON::encode($result));
		}else{
			
            $result = array(
                'status' => 200,
                'date' => 'Fail to add item',
            );
            $this->sendResponse(200, CJSON::encode($result));
		}

	}



    public function actionConv_remove()
    {

        if ($this->authenticate()) {
            $user_id = Yii::app()->user->getId();

            $user = User::model()->findByPk($user_id);

            $fullname = $user->fullname;

            $conv_id = $_POST['conv_id'];
            $email_text = addslashes($_POST['rollback_email']);

            $sql = "SELECT * FROM quotation_data JOIN user ON quotation_data.conv_by_id=user.id WHERE quotation_data.conv_id='$conv_id'";

            $new_data = Yii::app()->db->createCommand($sql)->queryAll();

            $qdoc_id = $new_data[0]['qdoci_id'];



            $nsql = "SELECT est_number FROM tbl_quote_doc WHERE qdoc_id='$qdoc_id'";

            $data = Yii::app()->db->createCommand($nsql)->queryAll();

            $est_number = $data[0]['est_number'];



            $update = "UPDATE tbl_quote_doc SET conversion_status=0 WHERE qdoc_id='$qdoc_id'";

            Yii::app()->db->createCommand($update)->execute();



            $delete = "DELETE FROM quotation_data WHERE conv_id='$conv_id'";

            Yii::app()->db->createCommand($delete)->execute();

            $body = 'Quotation has been Cancel by '.$fullname.'';
            $this->sendNotification(2, 'Cancel Quotation', $body, $email_text );

            $result = array(
                'status' => 200,
                'date' => 'success',
            );
            $this->sendResponse(200, CJSON::encode($result));
        }
    }


    public function actionConv_estimate()

    {

        $strDate = date("Y-m-d H:i:s");

        $codes = $_POST['codes'];

        $codes_new = implode(',', $codes);

        $sales_quote_name = $_POST['sales_quote_name'];

        $sales_quote_id = $_POST['sales_quote_id'];

        $qdoci_id = $_POST['qdoci_id'];

        $conversion_notes = $_POST['conversion_notes'];



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



        $result = array(

            'status' => 200,

            'date' => 'success',

        );



        $this->sendResponse(200, CJSON::encode($result));
    }

    public function actionUpdate_payment_term(){
		$conv_id =  $_POST['conv_id'];
		$credit_value =  $_POST['credit_card_3'];
		$credit_net_30 =  $_POST['credit_net_30'];
		$full_payment_b4_ship =  $_POST['full_payment_b4_ship'];
		$down_payment_50 =  $_POST['down_payment_50'];
		
		$sql = "UPDATE `quotation_data` SET `credit_card_3`= $credit_value, `credit_net_30`= $credit_net_30 ,`full_payment_b4_ship`= $full_payment_b4_ship,`50_down_payment`= $down_payment_50 WHERE `conv_id` = $conv_id";
		Yii::app()->db->createCommand($sql)->execute();

		$result = array(
            'status' => 200,
            'date' => 'success',
        );
        $this->sendResponse(200, CJSON::encode($result));
	}

    public function actionArchive_quote()
    {

        if ($this->authenticate()) {
            $conv_id = $_POST['conv_id'];

            $sql = "UPDATE quotation_data SET archive_status='1' WHERE conv_id='$conv_id'";

            Yii::app()->db->createCommand($sql)->execute();

            $result = array(
                'status' => 200,
                'date' => 'success',
            );
            $this->sendResponse(200, CJSON::encode($result));
        }
    }

    public function actionArchived_estimate()

    {
        if ($this->authenticate()) {

            $user_id = Yii::app()->user->getId();

            $user = User::model()->findByPk($user_id);

            $user_group = $user->user_group_id;

            $year_date = date("Y");

            $year_month = date("m");

            if (isset($_POST['year_date'])) {

                $year_date = $_POST['year_date'];

                $year_month = $_POST['year_month'];
            }

            if ($user_group == "99" || $user_group == "1") {

                $sql = "SELECT * from quotation_data LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=quotation_data.qdoci_id LEFT JOIN user ON user.id=quotation_data.conv_by_id WHERE monthname(`conv_date`)=MONTHNAME(STR_TO_DATE($year_month, '%m')) AND YEAR(`conv_date`)='$year_date' AND is_deleted='0' ORDER BY quotation_data.created_date DESC";
            } else {

                $sql = "SELECT * from quotation_data LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=quotation_data.qdoci_id LEFT JOIN user ON user.id=quotation_data.conv_by_id WHERE monthname(`conv_date`)=MONTHNAME(STR_TO_DATE($year_month, '%m')) AND YEAR(`conv_date`)='$year_date' AND conv_by_id='$user_id' AND is_deleted='0' AND archive_status='1' ORDER BY quotation_data.created_date DESC";
            }



            if ($user_id == "34") {

                $sql = "SELECT * from quotation_data LEFT JOIN tbl_quote_doc ON tbl_quote_doc.qdoc_id=quotation_data.qdoci_id LEFT JOIN user ON user.id=quotation_data.conv_by_id WHERE monthname(`conv_date`)=MONTHNAME(STR_TO_DATE($year_month, '%m')) AND YEAR(`conv_date`)='$year_date' AND (conv_by_id='$user_id' OR conv_by_id='27') AND is_deleted='0' AND archive_status='1' ORDER BY quotation_data.created_date DESC";
            }

            $data['quotes'] = Yii::app()->db->createCommand($sql)->queryAll();

            $data['year'] = $year_date;

            $data['month'] = $year_month;

            /*$result['model'] = new Upload;

            $result['files'] = Upload::model()->findAll();*/

            $result = array(
                'status' => 200,
                'date' => $data,
            );
            $this->sendResponse(200, CJSON::encode($result));
        }
    }


    public function actionFetch_order_num()

    {

        if ($this->authenticate()) {

            $salesrep_id = Yii::app()->user->getId();

            $qdoc_id = $_POST['qdoc_id'];

            //$salesrep_id = $_POST['salesrep_id'];

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



            $result = array(

                'status' => 200,

                'date' => $responseData,

            );



            $this->sendResponse(200, CJSON::encode($result));
        }
    }


    public function actionSearch_list_estimate()
    {
        if ($this->authenticate()) {

            $user_id = Yii::app()->user->getId();

            $user = User::model()->findByPk($user_id);

            $user_group = $user->user_group_id;

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

            
            if ($user_group != 1 && $user_group != 99) {
               $admin_notes_column = ''; // don’t include admin_private_notes
            } else {
               $admin_notes_column = 'tbl_quote_doc.admin_private_notes,';
            }

            $sql = "SELECT
                       tbl_quote_doc.qdoc_id ,
                    tbl_quote_doc.user_id ,
                    tbl_quote_doc.comp_id ,
                    tbl_quote_doc.comp_name ,
                    tbl_quote_doc.comp_info ,
                    tbl_quote_doc.curr_id ,
                    tbl_quote_doc.quote_curr ,
                    tbl_quote_doc.payment_term ,
                    tbl_quote_doc.cust_id ,
                    tbl_quote_doc.cust_name ,
                    tbl_quote_doc.cust_info ,
                    tbl_quote_doc.est_number ,
                    tbl_quote_doc.po_number ,
                    tbl_quote_doc.est_date ,
                    tbl_quote_doc.exp_date ,
                    tbl_quote_doc.inc_vat ,
                    tbl_quote_doc.vat_value ,
                    tbl_quote_doc.num_item ,
                    tbl_quote_doc.discount_percent ,
                    tbl_quote_doc.actual_discount ,
                    tbl_quote_doc.sub_total ,
                    tbl_quote_doc.grand_total ,
                    tbl_quote_doc.sale_note ,
                    tbl_quote_doc.sales_tax ,
                    tbl_quote_doc.customer_type ,
                    tbl_quote_doc.billing_state ,
                    tbl_quote_doc.tax_id ,
                    tbl_quote_doc.design_url ,
                    tbl_quote_doc.approval_comment ,
                    tbl_quote_doc.note ,
                    tbl_quote_doc.approve_status ,
                    tbl_quote_doc.approve_by ,
                    tbl_quote_doc.approve_date ,
                    tbl_quote_doc.update_date ,
                    tbl_quote_doc.reject_time ,
                    tbl_quote_doc.history_qdoc_id ,
                    tbl_quote_doc.is_temp ,
                    tbl_quote_doc.temp_id ,
                    tbl_quote_doc.is_editing ,
                    tbl_quote_doc.archive ,
                    tbl_quote_doc.is_duplicate ,
                    tbl_quote_doc.inv_no ,
                    tbl_quote_doc.add_date ,
                    tbl_quote_doc.conversion_status ,
                    tbl_quote_doc.design_name ,
                    tbl_quote_doc.design_note ,
                    tbl_quote_doc.draft_changed ,
                    tbl_quote_doc.dup_from ,
                    tbl_quote_doc.dup_from_id ,
                    tbl_quote_doc.enable ,
                    tbl_quote_doc.duplicate_by ,
                    tbl_quote_doc.save_quote ,
                    tbl_quote_doc.allow_comm ,
                    $admin_notes_column 
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

            $data = array(
                'status' => 200,
                'date' => $result,
            );



            $this->sendResponse(200, CJSON::encode($data));
        }
    }

    public function actionSearch_list_quotation()

    {
        if ($this->authenticate()) {

            $user_id = Yii::app()->user->getId();

            $user = User::model()->findByPk($user_id);

            $user_group = $user->user_group_id;

            $year_date = date("Y");

            $year_month = date("m");



            $more_condition = "";

            if ($user_group != "1" && $user_group != "99") {



                $more_condition = " AND (conv_by_id='$user_id' OR original_sales_id='$user_id')";
            }



            if ($user_id == "34") {

                $more_condition = " AND (conv_by_id='$user_id' OR original_sales_id='$user_id' OR conv_by_id='27' OR original_sales_id='27')";
            }



            $result['search'] = "";

            if (isset($_REQUEST["search"]) && ($_REQUEST["search"] != "")) {



                $search_word = "";

                if (isset($_GET["search"])) {

                    $search_word = base64_decode($_GET["search"]);
                } else {

                    $search_word = $_POST["search"];
                }

                $search_word = rtrim($search_word, 'Q');



                $more_condition .= "AND (

                                    cust_name LIKE '%" . addslashes($search_word) . "%'

                                    OR conv_by LIKE '%" . addslashes($search_word) . "%'

                                    OR jog_code LIKE '%" . addslashes($search_word) . "%'

                                    OR EXISTS (

                                    SELECT 1

                                    FROM tbl_quote_doc AS doc

                                    WHERE doc.est_number LIKE '%" . addslashes($search_word) . "%'

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

            WHERE is_deleted = '0' " . $more_condition . "";

            $data['quotes'] = Yii::app()->db->createCommand($sql)->queryAll();



            $data['year'] = $year_date;

            $data['month'] = $year_month;
            $result = array(
                'status' => 200,
                'date' => $data,
            );
            $this->sendResponse(200, CJSON::encode($result));
        }
    }


    //-----------------glink comment--------

    public function actionAdd_comment_drive()

    {

        if ($this->authenticate()) {

            $user_from = Yii::app()->user->getId();

            $main_comment = addslashes($_POST['main_comment']);

            $item_id = $_POST['item_id'];

            $link_id = $_POST['link_id'];

            if (isset($_POST['user_ids'])) {

                $user_ids = $_POST['user_ids'];

                $users = implode(',', $user_ids);

                $sql = "INSERT INTO `tbl_comments_drive`(`item_id`, `link_id`, `comment`, `user_ids`, `user_from`) VALUES ('$item_id','$link_id','$main_comment','$users','$user_from')";

                if (Yii::app()->db->createCommand($sql)->execute()) {

                    foreach ($user_ids as $id_user) {

                        $sql_noti = "INSERT INTO `notifications`(`link_id`,`item_id`, `noti_detail`, `employee_id`, `noti_from_employee`) VALUES ('$link_id','$item_id','Comment_Link','$id_user','$user_from')";

                        Yii::app()->db->createCommand($sql_noti)->execute();
                    }



                    $sql_from = "SELECT * FROM user WHERE id='$user_from'";

                    $query = Yii::app()->db->createCommand($sql_from)->queryAll();

                    $from_user = $query[0]['fullname'];



                    $result = array(

                        'status' => 200,

                        'date' => 'success',

                    );



                    $this->sendResponse(200, CJSON::encode($result));
                }
            } else {

                $sql = "INSERT INTO `tbl_comments_drive`(`item_id`, `link_id`, `comment`,`user_from`) VALUES ('$item_id','$link_id','$main_comment','$user_from')";

                Yii::app()->db->createCommand($sql)->execute();

                $result = array(

                    'status' => 200,

                    'date' => 'success',

                );



                $this->sendResponse(200, CJSON::encode($result));
            }
        }
    }



    public function actionFetch_gdrive_chats()

    {

        if ($this->authenticate()) {

            $user_id = Yii::app()->user->getId();

            $driver = $_POST['driver'];



            $string = "";

            $sql = "SELECT c.com_id, c.item_id, c.link_id, GROUP_CONCAT(COALESCE(u1.fullname, '')) AS user_names, c.comment, COALESCE(u2.fullname, '') AS user_from_name, c.user_from, c.created_date FROM tbl_comments_drive c LEFT JOIN user u1 ON FIND_IN_SET(u1.id, c.user_ids) LEFT JOIN user u2 ON u2.id = c.user_from WHERE c.link_id = '$driver' GROUP BY c.com_id, c.item_id, c.link_id, c.comment, c.user_from, c.created_date ORDER BY c.created_date DESC;";

            $a_qitem = Yii::app()->db->createCommand($sql)->queryAll();

            if (count($a_qitem) == 0) {

                $result = array(

                    'status' => 200,

                    'date' => [],

                );

                $this->sendResponse(200, CJSON::encode($result));
            } else {

                $result = array(

                    'status' => 200,

                    'date' => $a_qitem,

                );

                $this->sendResponse(200, CJSON::encode($result));
            }
        }
    }


    public function actionLocation()
    {
        $sql = "SELECT * FROM `tbl_location` WHERE 1;";

        $a_qitem = Yii::app()->db->createCommand($sql)->queryAll();

        $result = array(

            'status' => 200,

            'date' => $a_qitem,

        );

        $this->sendResponse(200, CJSON::encode($result));
    }

    public function actionVersion()
    {
        $sql = "SELECT * FROM `app_version` WHERE 1;";

        $a_qitem = Yii::app()->db->createCommand($sql)->queryAll();

        $result = array(

            'status' => 200,

            'date' => $a_qitem,

        );

        $this->sendResponse(200, CJSON::encode($result));
    }

    // Function to send FCM notification

    public function sendNotification($to_employee_id, $title, $full_name, $doc_id)
    {
        $sql = "SELECT * FROM `user_tokens` WHERE user_id='$to_employee_id'";
        $sendto = Yii::app()->db->createCommand($sql)->queryAll();

        if($title != 'Cancel Quotation' && $title != 'Convert To Quotation' ){
            $docdata = "SELECT * FROM `tbl_quote_doc` WHERE `qdoc_id` ='$doc_id'";
            $doc = Yii::app()->db->createCommand($docdata)->queryAll();

        }        
        if (!empty($sendto)) {

            foreach ($sendto as $key => $autht) {

                if (!empty($autht['device_token']) && $autht['device_token'] != null) {
                    $deviceToken = $autht['device_token'];

                    $url = 'https://fcm.googleapis.com/v1/projects/jog-sales-rep/messages:send';

                    if($title != 'Cancel Quotation' && $title != 'Convert To Quotation' ){
                        $est_number = $doc[0]['est_number'];                        
                        $body = "$full_name Commented on Estimate Number $est_number";

                        $payload = [
                            'message' => [
                                'token' => $deviceToken,
                                'notification' => [
                                    'title' => $title,
                                    'body' => $body,
                                ],
                                "data" => [
                                    "qdoc_id" => $doc_id,
                                    "type" => $title,
                                    "estimate_number" => $est_number
                                ],
                                'apns' => [
                                    'payload' => [
                                        'aps' => [
                                            'badge' => 1,
                                            'sound' => 'default'
                                        ]
                                    ]
                                ]
                            ]
                        ];

                    }else {
                        $body = $full_name;

                        $payload = [
                            'message' => [
                                'token' => $deviceToken,
                                'notification' => [
                                    'title' => $title,
                                    'body' => $body,
                                ],
                                "data" => [                                    
                                    "type" => $title,
                                    "reason" => $doc_id
                                ],
                                'apns' => [
                                    'payload' => [
                                        'aps' => [
                                            'badge' => 1,
                                            'sound' => 'default'
                                        ]
                                    ]
                                ]
                            ]
                        ];
                    }

                    // Initialize cURL
                    $ch = curl_init();
                    // Set the URL and other options
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        'Authorization: Bearer ' . $this->getAccessToken(),
                        'Content-Type: application/json'
                    ]);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
                    // Execute the request
                    $response = curl_exec($ch);
                    // Close cURL session
                    curl_close($ch);
                }
            }
        }

        // Success
        return true;
    }



    // Function to get OAuth2 token

    private function getAccessToken()
    {

        $keyFile = 'protected/controllers/jog-sales-rep-firebase-adminsdk-xeq6j-8801e93c8e.json';
        $jwt = $this->generateJWT($keyFile);
        $token = $this->exchangeJWTForAccessToken($jwt);

        return $token;
    }



    // Function to generate JWT

    private function generateJWT($keyFile)
    {

        $key = json_decode(file_get_contents($keyFile), true);

        $now = time();

        $exp = $now + 3600; // Token valid for 1 hour

        $header = json_encode(['alg' => 'RS256', 'typ' => 'JWT']);

        $payload = json_encode([

            'iss' => $key['client_email'],

            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',

            'aud' => 'https://oauth2.googleapis.com/token',

            'iat' => $now,

            'exp' => $exp

        ]);



        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        $signature = '';

        openssl_sign($base64UrlHeader . '.' . $base64UrlPayload, $signature, $key['private_key'], 'SHA256');

        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));



        return $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;
    }



    // Function to exchange JWT for Access Token

    private function exchangeJWTForAccessToken($jwt)
    {

        $url = 'https://oauth2.googleapis.com/token';

        $data = [

            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',

            'assertion' => $jwt

        ];



        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));



        $response = curl_exec($ch);

        if ($response === false) {

            throw new Exception('Curl error: ' . curl_error($ch));
        }



        $responseData = json_decode($response, true);

        if (isset($responseData['error'])) {

            throw new Exception('Error fetching access token: ' . $responseData['error']);
        }



        return $responseData['access_token'];
    }


    public function actionQuote_notify()

    {
            $user = User::model()->findAllByAttributes(array('user_group_id' => '2'));                

            foreach ($user as $key => $value) {
            
                $sql = "SELECT

                    tbl_quote_doc.*,

                    user.fullname,
                    user.email,

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

                        AND tbl_quote_doc.is_duplicate = 0

                        AND tbl_quote_doc.user_id = $value->id       

                    GROUP BY

                        tbl_quote_doc.qdoc_id

                    ORDER BY

                        tbl_quote_doc.is_editing DESC,

                        tbl_quote_doc.add_date DESC

                ";

                $get_quote_doc = Yii::app()->db->createCommand($sql)->queryAll();            
                $i=0;
                $e_number= '';
                $estnoFound = false;
                if (!empty($get_quote_doc)) {
                 
                    foreach ($get_quote_doc as $key => $quote_doc) {
                        if ($quote_doc['quotation_data_count'] == 0 && $quote_doc['approve_status'] == "approve" && $quote_doc["is_duplicate"] == "0" ) {                    
                            $user_id =$quote_doc['user_id'];
                            $email =$quote_doc['email'];
                            $est_number =$quote_doc['est_number'];
                            $e_number .= $est_number .', ';
                            $estnoFound = true;
                            $i++;
                        }
                    }
                    $words = explode(' ', $e_number);
                    // Check if the word count exceeds 100
                    if (count($words) > 4) {
                        // Get the first 100 words
                        $e_number = implode(' ', array_slice($words, 0, 4)) . '';
                    }                    
                    if($estnoFound){

                    
                        $body = 'Please Convert To Quotation ';
                        $this->sendNotification(21, 'Convert To Quotation', $body, 'testing' );


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
                                            <td bgcolor#F4F4F4" align="center">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 650px;">
                                                    <tr>
                                                        <td align="center" valign="top" style="padding: 10px "> </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor#F4F4F4" align="center">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 650px;">
                                                    <tr>
                                                        <td align="center" valign="top" style="padding: 10px "> </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor#F4F4F4" align="center">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 650px;">
                                                    <tr>
                                                        <td align="center" valign="top" style="padding: 10px "> </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor#F4F4F4" align="center">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 650px;">
                                                    <tr>
                                                        <td align="center" valign="top" style="padding: 10px "> </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#F4F4F4" align="center" style="padding: 0px 10px 0px 10px;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                                    style="max-width: 650px; box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px, rgba(255, 255, 255, 0.31) 0px 0px 0px 3px">
                                                    <tr>
                                                        <td bgcolor="#000000" align="center" valign="top"
                                                            style="padding: 20px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111;  "
                                                            Lato", Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px;
                                                            line-height: 48px;">
                                                            <h1 style="font-size: 48px; font-weight: 400; margin: 2; color: #FFFFFF;">Action Required !
                                                            </h1> <img src="https://online.jog-joinourgame.com/assets/images/logo.png" width="125"
                                                                height="120" style="display: block; border: 0px;background: #FFF;
                                padding: 10px;" />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;margin-top:10px;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 650px;">
                                                    <tr>
                                                        <td bgcolor="#ffffff" align="left"
                                                            style="padding: 20px 30px 30px 30px; color: #666666; font-family: " Lato", Helvetica, Arial,
                                                            sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                            <p style="text-align: center; margin: 0;">
                                                                <img src="https://www.caledonialoghomes.co.uk/wp-content/uploads/2020/06/check-clipart-gif-animation-18.gif"
                                                                    alt="" style="width: 20%;">
                                                            </p>
                                                            <p style="font-size: 20px; margin-top: 0; padding:10px;"> The estimate number
                                                                <strong class="eNum">['.$e_number.']</strong> has been
                                                                approved but has not yet been converted into a quotation.
                                                            </p>
                                                            <p><strong>Please take immediate action
                                                                    by clicking the link below.</strong></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#ffffff" align="left">
                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td bgcolor="#ffffff" align="center" style="padding:0 0 50px 0">
                                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td align="center"><a
                                                                                        href="https://sales-test.jog-joinourgame.com/quotation/approveList"
                                                                                        target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none;font-size: 14px;
                                font-weight: bold; padding: 15px 25px; border-radius: 45px; border: 1px solid #77B43F; background: #77B43F; ">Approve
                                                                                        List</a>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td bgcolor="#ffffff" align="left"
                                                            style="padding: 0px 30px 0 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: "
                                                            Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                            <p style="margin: 4px 0;">Cheers, </p>
                                                            <p style="margin:  5px 0  15px 0;
                                                            font-size: 20px;
                                                            color: #000;
                                                            font-weight: 900;text-transform: uppercase;">JOG Team </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#f4f4f4" align="center">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                                    style="max-width: 650px; background: red;">
                                                    <tr>
                                                        <td bgcolor="#000000" align="center"
                                                            style="padding: 20px 30px 20px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: "
                                                            Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                            <h2 style="font-size: 25px; font-weight: 400; color: #FFFFFF; margin: 5px;">Need more help?
                                                            </h2>
                                                            <p style="margin: 0;"><a href="https://sales-test.jog-joinourgame.com" target="_blank"
                                                                    style="color: #FFFFFF;">We&rsquo;re here to help you out</a></p>
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
                        $mail->Subject = " Immediate Action Needed: Approved Estimate Not Yet Quoted";
                        $mail->MsgHTML($template3);
                        //$mail->AddAddress($mail_customer, $mail_customername);
                        //$mail->addBcc("ravish@jogsportswear.com");
                        $mail->AddAddress('amansharmasasuke@gmail.com');
                        
                        if (!$mail->Send()) {
                            //echo $mail->ErrorInfo;
                        } else {
                            //echo "working";
                            //Yii::app()->user->setFlash('success', 'Message Already sent!');
                        }
                        
                        $mail->ClearAddresses();
                    }
                }
            }
            

            $result = array(

                'status' => 200,
    
                'massage' => 'successful',
    
            );

            $this->sendResponse(200, CJSON::encode($result)); //--- Use same view with New status
        
    }

    public function actionAddContactUs(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $myfile = fopen(Yii::app()->basePath ."/runtime/api_response1.txt", "w") or die("Unable to open file!");
        $filePath = Yii::app()->basePath ."/runtime/api_response1.txt"; 
    
              if (is_writable($filePath)) {
                  echo "The file is already writable.";
              } else {
                  // Giving write permission to the file (rw-r--r--)
                  if (chmod($filePath, 0666)) {
                      echo "File permissions changed successfully!";
                  } else {
                      echo "Failed to change file permissions.";
                  }
              }
    
    
              if (!empty($_POST)) {
              //     // Convert the $_POST array into a string format (using print_r for better readability)
                  $formattedResponse = print_r($_POST, true);
    
                  $result =  fwrite($myfile, $formattedResponse);
              
                  if ($result === false) {
                      echo "Failed to write to file.";
                  } else {
                      echo "POST parameters have been stored in 'api_response.txt'.<br>";
    
                  }
              fclose($myfile);
              
              } else {
                  echo "No POST data received!";
              }
               $is_distribution_enable = Yii::app()->db->createCommand("SELECT status FROM lead_distribution")->queryScalar(); 
      
                if($is_distribution_enable == 1){
                     return TblLeads::AssignLeadAutoMetic($is_contact=true);
                }else{
                      return TblLeads::AsssignLeadManual($is_contact=true);
                }
            //    return TblLeads::AssignLeadAutoMetic($is_contact=true);
            //   return TblLeads::AsssignLeadManual($is_contact=true);
            }else{

                return false; 
            }
    
    }


    // --------------------CRM API --------------------------------------------------

  

    
    public function actionGetProductList(){
          try{
            if($this->authenticate()) {  
                $data = TblLeads::GetProductList();   
                $result = ['status'=>200 , 'data'=>$data];
                $this->sendResponse(200, CJSON::encode($result));
            }
          }catch(Exception $e){
               $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));   
          }
    }

    public function actionGetCountryList(){
        try{
             if($this->authenticate()) {  
                $data = TblLeads::GetCountryList();   
                $result = ['status'=>200 , 'data'=>$data];
                $this->sendResponse(200, CJSON::encode($result));
             }
        }catch(Exception $e){
            $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));    
        }
    }

    public function actionGetStateList(){
          try{
             if($this->authenticate()) {  
                $data = TblLeads::GetStateList();  
                $result = ['status'=>200 , 'data'=>$data];
                $this->sendResponse(200, CJSON::encode($result));    
             }
          }catch(Exception $e){
              $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));    
          }
    }

    public function actionGetSalesPersonList(){
          try{
               if($this->authenticate()) {  
                    $data =  User::GetAlluser(true);
                    $result = ['status'=>200 , 'data'=>$data];
                    $this->sendResponse(200, CJSON::encode($result));
               }
          }catch(Exception $e){
              $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));    
          }
    }
  
    //----------------------------------------------------------


   // Admin Dashboard ------------------
    public function actionGetAdminDashboard(){
            try{
                 if($this->authenticate()) {  
                    $userId = Yii::app()->user->getId();
                    $user = User::model()->findByPk($userId);
                    $data = TblLeads::GetAdminDashboardCount($user);
                    $result = ['status' => 200, 'data' => $data];
                    $this->sendResponse(200, CJSON::encode($result));
                 }

            }catch(Exception $e){
                    $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));
            }
    }

    public function actionGetCountryLeadsCount(){
         try{
            if($this->authenticate()) {  
                 $userId = Yii::app()->user->getId();
                 $user = User::model()->findByPk($userId);
                $data = TblLeads::GetCountryCountLeads($user); 
                $result = ['status'=>200 , 'data'=>$data];
                $this->sendResponse(200, CJSON::encode($result));
            }

         }catch(Exception $e){
               $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));
         }
    }
    

    public function actionGetFollowUp(){
          try{
            if($this->authenticate()) {  
                $data = TblLeads::GetFollowUpData(); 
                $result = ['status'=>200 , 'data'=>$data];
                $this->sendResponse(200, CJSON::encode($result));
            }
          }catch(Exception $e){
               $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));
          }
    }

    public function actionGetUpdatedTasks(){
          try{
            if($this->authenticate()) {  
               $userId = Yii::app()->user->getId();
              $user = User::model()->findByPk($userId);
              $data = TblLeads::GetUpdateData($user); 
              $result = ['status'=>200 , 'data'=>$data];
              $this->sendResponse(200, CJSON::encode($result));
            }
          }catch(Exception $e){
               $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()])); 
          }
    }
  //------------------------------
   
    // Leads tab 
    // List 
    public function actionLeads(){
          try{
            if($this->authenticate()) {
                $data = TblLeads::GetAllLeadsData(); 
                $this->sendResponse(200, CJSON::encode($data));
            }
          }catch(Exception $e){
               $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));    
          }
    }

    // Add/Edit/Delete single leads 
    public function actionLead(){
        try{
             if($this->authenticate()) { 
                
                if($_SERVER['REQUEST_METHOD']=='POST'):
                     $userId = Yii::app()->user->getId();
                     $user = User::model()->findByPk($userId);
                    $data = TblLeads::AddEditLeads($user); 
                    $this->SendCRMNotofication('Lead Edited' ,'New lead edited' ,['lead_id' =>'1']);
                    $this->sendResponse(200, CJSON::encode($data));
                     exit;
                elseif($_SERVER['REQUEST_METHOD']=='GET'):
                     $data = TblLeads::GetSingleLead();
                elseif($_SERVER['REQUEST_METHOD']=='DELETE'):
                      $data = TblLeads::DeleteLeads(); 
                endif ;

                $result = ['status'=>200 , 'data'=>$data];
                $this->sendResponse(200, CJSON::encode($result));
             }
        }catch(Exception $e){
               $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));   
        }
    }


    //---------------View details ------------------

    public function actionStatusAcitivity(){
         try{
           
                 if($this->authenticate()) {
                       if($_SERVER['REQUEST_METHOD']=='GET'):
                          $data = TblLeads::GetFollowUpDetails(); 
                       elseif($_SERVER['REQUEST_METHOD'] == 'POST'):
                          $data = TblLeads::UpdateStatus();
                          $this->sendResponse(200, CJSON::encode($data));
                          exit;
                       else:
                          $data = [];
                       endif;  
                          $result = ['status'=>200 , 'data'=>$data];
                        $this->sendResponse(200, CJSON::encode($result));
                    }
         }catch(Exception $e){
              $this->sendResponse(500 , CJSON::endcode(['status'=>500 , 'Error'=>$e->getMessage()]));
         }
    }

   public function actionCommentActivity(){
          try{
                 if($this->authenticate()) {
                       if($_SERVER['REQUEST_METHOD']=='GET'):
                          $data = TblLeads::GetComments(); 
                       elseif($_SERVER['REQUEST_METHOD'] == 'POST'):
                           $data = TblLeads::AddComment(); 
                           $this->sendResponse(200, CJSON::encode($data));
                          exit;
                       else:
                          $data = [];
                       endif;  
                          $result = ['status'=>200 , 'data'=>$data];
                        $this->sendResponse(200, CJSON::encode($result));
                    }
         }catch(Exception $e){
              $this->sendResponse(500 , CJSON::endcode(['status'=>500 , 'Error'=>$e->getMessage()]));
         }
   }


    
    //-------------------------

    // share same leds with multiple sales person 
    public function actionGetSharedLeads(){
          try{
            if($this->authenticate()){
                    $data = TblLeads::SharedLeadsData(); 
                    $result = ['status'=>200 , 'data'=>$data];
                    $this->sendResponse(200, CJSON::encode($result));   
            }
        }catch(Exception $e){
               $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));    
        }   
    }

    public function actionUpdateSharedLeads(){
        try{
            if($this->authenticate()){
                    $data = TblLeads::UpdateSharedLeads(); 
                    $result = ['status'=>200 , 'data'=>$data];
                    $this->sendResponse(200, CJSON::encode($result));   
            }
        }catch(Exception $e){
               $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));    
        } 
    }
     
    public function actionGetActivityLog(){
      try{
         if($this->authenticate()){
                    $userId = Yii::app()->user->getId();
                     $user = User::model()->findByPk($userId);
                    $data = TblLeads::GetActivityLog($user); 
                    // $result = ['status'=>200 , 'data'=>$data];
                    $this->sendResponse(200, CJSON::encode($data)); 
         }

      }catch(Exception $e){
           $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));  
      }
            
    }


     public function actionGetDeletedLeads(){
          try{
              if($this->authenticate()) {
                     $data = TblLeads::GetDeletedLeads(); 
                    //  $result = ['status'=>200 , 'data'=>$data];
                    $this->sendResponse(200, CJSON::encode($data));
              }
         }catch(Exception $e){
               $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));    
          } 
    }
 
    //  delete lead from database 


    // soft delete 
    public function  actionDeleteLeads(){
            try{
                if($this->authenticate()) {
                        $data = TblLeads::DeleteLeads(); 
                        $result = ['status'=>200 , 'data'=>$data];
                        $this->sendResponse(200, CJSON::encode($result));
                }
            }catch(Exception $e){
                $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));    
            }  
        }

        public function actionRecoverLeads(){
            try{
                if($this->authenticate()) {
                        $data = TblLeads::RecoverLeads(); 
                        $result = ['status'=>200 , 'data'=>$data];
                        $this->sendResponse(200, CJSON::encode($result));
                }
            }catch(Exception $e){
                $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));    
            } 
    }


    //  Mannage sales person api 


    public function actionHandleSalesPerson(){
           try{
              if($this->authenticate()) {
                  if($_SERVER['REQUEST_METHOD'] === "DELETE"){
                       $data = TblLeads::DeleteAssignedSalesPerson();
                  }elseif($_SERVER['REQUEST_METHOD'] === "GET"){
                       $data = TblLeads::GetManageSalesPerson();
                  }else{
                      $data = TblLeads::AddEditSalesPerson(); 
                  }
                $result = ['status'=>200 , 'data'=>$data];
                $this->sendResponse(200, CJSON::encode($result));
              }
         }catch(Exception $e){
               $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));    
          } 
    }

    public function actionUpdateLeadDistribution(){
          try{
              if($this->authenticate()) {
                  if($_SERVER['REQUEST_METHOD'] === 'GET'){
                     $data = TblLeads::UpdateLeadDistribution(true);      
                  }else{
                     $data = TblLeads::UpdateLeadDistribution(); 
                  }
               
                $result = ['status'=>200 , 'data'=>$data];
                $this->sendResponse(200, CJSON::encode($result));
              }
         }catch(Exception $e){
               $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));    
          } 
    }

   


    public function actionManageSalesPerson()
    {
        try {
            if ($this->authenticate()) {
                $data = TblLeads::GetSalesAssignSalesPerson();
                $result = ['status' => 200, 'data' => $data];
                $this->sendResponse(200, CJSON::encode($result));
            }
        } catch (Exception $e) {
            $this->sendResponse(500, CJSON::encode(['status' => 500, 'Error' => $e->getMessage()]));
        }
    }

    public function actionSalesPerson(){
         try {
            if ($this->authenticate()) {
                $data = TblLeads::GetManageSalesPersonDetails();
                $result = ['status' => 200, 'data' => $data];
                $this->sendResponse(200, CJSON::encode($result));
            }
        } catch (Exception $e) {
            $this->sendResponse(500, CJSON::encode(['status' => 500, 'Error' => $e->getMessage()]));
        }
    }

    public function actionUpdateStateOrder(){
          try {
            if ($this->authenticate()) {
                $data = TblLeads::UpdateStatePriority();
                $result = ['status' => 200, 'data' => $data];
                $this->sendResponse(200, CJSON::encode($result));
            }
        } catch (Exception $e) {
            $this->sendResponse(500, CJSON::encode(['status' => 500, 'Error' => $e->getMessage()]));
        }
    }


    public function actionUpdateSalesPersonOrder(){
         try {
            if ($this->authenticate()) {
                $data = TblLeads::UpdateSalesPersonPriority();
                $result = ['status' => 200, 'data' => $data];
                $this->sendResponse(200, CJSON::encode($result));
            }
        } catch (Exception $e) {
            $this->sendResponse(500, CJSON::encode(['status' => 500, 'Error' => $e->getMessage()]));
        }  
    }

   


    // Api for country and map count 
    public function actionGetCountryStateCount(){
         try{
              if($this->authenticate()) {
                 $userId = Yii::app()->user->getId();
                 $user = User::model()->findByPk($userId);
                $data = TblLeads::GetCountryStateCount($user); 
                $result = ['status'=>200 , 'data'=>$data];
                $this->sendResponse(200, CJSON::encode($result));
              }
         }catch(Exception $e){
               $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));    
          }

    }
    

    // Notification for CRM 
      public function   actionCRMNotification(){
       try{
              if($this->authenticate()) {
                 $userId = Yii::app()->user->getId();
                 $user = User::model()->findByPk($userId);
                 $data = TblLeads::GetCRMNotification($user); 
                  if($_SERVER['REQUEST_METHOD'] === 'PUT'){
                        $data = TblLeads::MarkNotificationRead($user);
                    }elseif($_SERVER['REQUEST_METHOD'] === 'DELETE'){
                        $data = TblLeads::MarkNotificationRead($user ,true);
                         
                    }
                // $result = ['status'=>200 , 'data'=>$data];
                $this->sendResponse(200, CJSON::encode($data));
              }
         }catch(Exception $e){
               $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));    
          }
   }



//   Firebase function for send notification 
    public function  SendCRMNotofication($title='' ,$body='' ,$data=[]){
          $accesstoken  = $this->getAccessToken(); 
          $url = "https://fcm.googleapis.com/v1/projects/jog-sales-rep/messages:send";
          $userId = Yii::app()->user->getId();
          $sql = "SELECT * FROM `user_tokens` WHERE user_id=:userId AND device_token!='' ORDER BY created_at DESC LIMIT 1";
          $Alluser = Yii::app()->db->createCommand($sql)
            ->bindValue(":userId", $userId)
            ->queryAll();

            if(!empty($Alluser)) :
            foreach ($Alluser as $key => $val) {
                $targetToken = $val['device_token'] ?? null; 
                if (!$targetToken) continue;

                $message = [
                    'message' => [
                        'token' => $targetToken,
                        'notification' => [
                            'title' => $title,
                            'body'  => $body,
                        ],
                        'data' => $data
                    ]
                ];

                $headers = [
                    'Authorization: Bearer ' . $accesstoken,
                    'Content-Type: application/json',
                ]; 

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));

                $response = curl_exec($ch);
                curl_close($ch);

                if ($response === false) {
                    die('Curl error: ' . curl_error($ch));
                }

                $json = json_decode($response, true);

                // 🔎 Check for UNREGISTERED error
                if (isset($json['error']['details'][0]['errorCode']) 
                    && $json['error']['details'][0]['errorCode'] === 'UNREGISTERED') {
                    
                    Yii::app()->db->createCommand()
                        ->delete('user_tokens', 'device_token=:token', [':token' => $targetToken]);

                    return "Device token was invalid and removed from DB.";
                }

                return $response;
            }
        endif;


    }

    public function TestNotification() {
        $accesstoken  = $this->getAccessToken(); 
        // $accesstoken = ""
        $url = "https://fcm.googleapis.com/v1/projects/jog-sales-rep/messages:send";

        $userId = Yii::app()->user->getId();
        $sql = "SELECT * FROM `user_tokens` WHERE user_id=:userId AND device_token!='' ORDER BY created_at DESC LIMIT 1";
        $Alluser = Yii::app()->db->createCommand($sql)
            ->bindValue(":userId", $userId)
            ->queryAll();

        $title = 'This is New  test message'; 
        $body  = 'Test messagesssess dsadsadsad';
        $data  = ['id' => '2']; // always use strings in "data"

        if (!empty($Alluser)) :
            foreach ($Alluser as $key => $val) {
                $targetToken = $val['device_token'] ?? null; 
                if (!$targetToken) continue;

                $message = [
                    'message' => [
                        'token' => $targetToken,
                        'notification' => [
                            'title' => $title,
                            'body'  => $body,
                        ],
                        'data' => $data
                    ]
                ];

                $headers = [
                    'Authorization: Bearer ' . $accesstoken,
                    'Content-Type: application/json',
                ]; 

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));

                $response = curl_exec($ch);
                curl_close($ch);

                if ($response === false) {
                    die('Curl error: ' . curl_error($ch));
                }

                $json = json_decode($response, true);

                // 🔎 Check for UNREGISTERED error
                if (isset($json['error']['details'][0]['errorCode']) 
                    && $json['error']['details'][0]['errorCode'] === 'UNREGISTERED') {
                    
                    Yii::app()->db->createCommand()
                        ->delete('user_tokens', 'device_token=:token', [':token' => $targetToken]);

                    return "Device token was invalid and removed from DB.";
                }

                return $response;
            }
        endif;
    }


  public function actionTestFireBaseNotifcation(){

     try{
              if($this->authenticate()) {
                  $resp =  $this->TestNotification(); 
                  $this->sendResponse(200, CJSON::encode($resp));
              }
         }catch(Exception $e){
               $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));    
          }
    
  }


    // Api for update sales notes for sales person estimate
    public function actionUpdateSalesNotes()
    {
        try {
            if ($this->authenticate()) {
                $userId = Yii::app()->user->getId();
                $user = User::model()->findByPk($userId);
                $qdoc_id  = $_POST['qdoc_id'];
                $notes = $_POST['notes'];

                if ($user && ($user['user_group_id'] != 1 || $user['user_group_id'] != 99)) {
                    $sql  = "UPDATE tbl_quote_doc SET  sale_note='$notes' Where qdoc_id = '$qdoc_id'";
                    $update = Yii::app()->db->createCommand($sql)->execute();
                    $result = ['status' => 200, 'data' => $update, 'msg' => 'Notes updated successfully'];
                    $this->sendResponse(200, CJSON::encode($result));
                }
            }
        } catch (Exception $e) {
            $this->sendResponse(500, CJSON::encode(['status' => 500, 'Error' => $e->getMessage()]));
        }
    }


  //   ------------------ THIS API IS FOR POWER BI DASHBOARD------------------


public function actionGetProductPerformance(){
  try{
                 $data = TblLeads::GetProductPerformance(); 
                 $this->sendResponse(200, CJSON::encode($data));
             
         }catch(Exception $e){
               $this->sendResponse(500, CJSON::encode(['status'=>500 , 'Error' =>$e->getMessage()]));    
          }  
    
}

 

  




}
