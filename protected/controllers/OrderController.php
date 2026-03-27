<?php

use PhpOffice\PhpSpreadsheet\Reader\Xml\Style;

class OrderController extends AuthController
{

    public function actionIndex()
    {
        $model = new ImportForm();

        if (isset($_POST['ImportForm'])) {

            $model->excelFile = CUploadedFile::getInstance($model, 'excelFile');
            if ($model->upload()) {
                $filePath = Yii::app()->basePath . '/uploads/' . $model->excelFile->name;
                require_once(Yii::app()->basePath . '/vendors/PHPExcel/Classes/PHPExcel.php');

                $startfrom = strtoupper($_POST['start']);
                $endfrom = strtoupper($_POST['end']);
                $month = $_POST['month'];
                $year = $_POST['year'];
                $code_type = $_POST['code_type'];

                $objPHPExcel = PHPExcel_IOFactory::load($filePath);
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                // Assuming the first row contains column headers
                //$headers = array_shift($sheetData);
                array_shift($sheetData);
                // Assuming the second row contains column headers

                $i = 3;
                // Assuming the first row contains column headers
                $headers = array_shift($sheetData);

                // Convert column letters to their respective indices
                $startIndex = PHPExcel_Cell::columnIndexFromString($startfrom) - 1; // Subtract 1 to get zero-based index
                $endIndex = PHPExcel_Cell::columnIndexFromString($endfrom) - 1; // Subtract 1 to get zero-based index

                foreach ($sheetData as $rowData) {
                    $order = new Order();
                    $invNoColumnIndex = array_search('Inv_no', $headers);
                    // Iterate through the range of columns from BE to BN
                    for ($i = $startIndex; $i <= $endIndex; $i++) {
                        // Convert index back to column letter
                        $columnName = PHPExcel_Cell::stringFromColumnIndex($i);

                        if (isset($headers[$columnName])) {
                            if (!empty($rowData[$startfrom]) && strpos($rowData[$startfrom], 'END OF') !== 0) {
                                // Assign the cell value to the corresponding model attribute 
                                $cellvalue = $invNoColumnIndex . $i;
                                if ($columnName == $invNoColumnIndex) {
                                    $invlink = $objPHPExcel->getActiveSheet()->getCell($cellvalue)->getHyperlink()->getUrl();
                                    $order->Invlink = isset($invlink) ? $invlink : null; //$invlink;
                                }
                                $order->{$headers[$columnName]} = isset($rowData[$columnName]) ? $rowData[$columnName] : null;
                                $order->month = $month;
                                $order->year = $year;
                                $order->typeofcode = $code_type;
                                if ($order->save()) {
                                    $order->sortrow = $order->id;
                                    $order->save(false, array('sortrow'));
                                }
                            }
                        }
                    }

                    // Set additional attributes like month, year, etc.

                }
                //var_dump($order);
                Yii::app()->user->setFlash('success', 'Data imported successfully.');
                $this->redirect(array('order/list'));
            } else {
                Yii::app()->user->setFlash('error', 'Error uploading file.');
            }
        }

        $this->render('index', array('model' => $model));
    }

    public function actionLists()
    {

        if (isset($_FILES['excelFile']) && $_FILES['excelFile']['error'] == 0) {
            $file = $_FILES['excelFile'];
            $month = $_POST['month'];
            $year = $_POST['year'];
            $code_type = $_POST['code_type'];
            $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            // Validate file extension
            $allowed = array('xls', 'xlsx');
            if (in_array($fileExt, $allowed)) {
                $uploadPath = Yii::app()->basePath . '/uploads/' . basename($file['name']);
                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {

                    $this->processExcelFile($uploadPath, $month, $year, $code_type);

                    Yii::app()->session['year_date'] = $year;
                    Yii::app()->session['year_month'] = $month;

                    $sql = "SELECT * FROM `tbl_order` WHERE `month` LIKE '%$month%' AND `year` LIKE '%$year%' AND `typeofcode` = '$code_type'";
                    // Fetch data from the database
                    $command = Yii::app()->db->createCommand($sql)->queryAll();

                    $Orders['Orders'] = $command;
                    $Orders['year'] = $year;
                    $Orders['month'] = $month;
                    $Orders['toc'] = $code_type;

                    $this->render('list', $Orders);
                } else {
                    echo "Failed to upload file.";
                }
            } else {
                echo "Invalid file type. Only .xls and .xlsx files are allowed.";
            }
        } else {
            echo "Error: " . $_FILES['excelFile']['error'];
        }
    }

    protected function processExcelFile($filePath, $month, $year, $code_type)
    {
        // Include PHPExcel library
        require_once(Yii::app()->basePath . '/vendors/PHPExcel/Classes/PHPExcel.php');
        $objPHPExcel = PHPExcel_IOFactory::load($filePath);
        $sheet = $objPHPExcel->getActiveSheet();
        $data = $sheet->toArray();

        foreach ($data as $row) {
            $order = new Order();
            $jogCode = $row[0]; // Column A
            $orderName = $row[1]; // Column B            

            $order->JOG_Code = $jogCode;
            $order->Order_Name = $orderName;
            $order->month = $month;
            $order->year = $year;
            $order->typeofcode = $code_type;
            if ($order->save()) {
                $order->sortrow = $order->id;
                $order->save(false, array('sortrow'));
                $this->afterOrderInserted($order->id, $jogCode);
            }
        }
    }

    protected function afterOrderInserted($orderId, $jogCode)
    {
        $jc = $jogCode;
        $prefix = preg_replace('/[A-Za-z]+$/', '', $jc);
        $fullname='';

        $sqlqid = "SELECT * FROM `quotation_data` WHERE `jog_code` LIKE '$prefix%'";
        $getqid = Yii::app()->db->createCommand($sqlqid)->queryAll();

        if (empty($getqid[0]['qdoci_id'])) {
            return;            
        } else {
            $qdoc_id = $getqid[0]['qdoci_id'];
        }

        $sql_quote = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $qdoc_id . "'; ";
        $a_quote = Yii::app()->db->createCommand($sql_quote)->queryAll();
        if (empty($a_quote)) {  
            
            return;
        }
        $row_quote = $a_quote[0];

        $sql_user = "SELECT * FROM user WHERE id='" . $row_quote["user_id"] . "'; ";
        $a_user = Yii::app()->db->createCommand($sql_user)->queryAll();
        $row_user = $a_user[0];
        $fullname = $row_user["fullname"];
        $salename  = !empty($fullname) ? $fullname : '';
        
        $sql = "UPDATE `tbl_order` SET `Sales_Rep_1`= '$salename'  WHERE `id`= '$orderId'";
        Yii::app()->db->createCommand($sql)->execute();

        
    }

    public function actionList()
    {
        $Orders = array();
        $conditions = array();
        $params = array();

        // Condition based on year and month
        $year_date = date("Y");
        $year_month = date("F");
        if (isset($_POST['year_date'])) {
            $year_date = $_POST['year_date'];
            $year_month = $_POST['year_month'];
        }

        // Get a session variable
        if (!Yii::app()->session['year_month']) {
            // If empty, set it to the current month
            $year_month = date("F");
        } else {
            # code...
            $year_date = Yii::app()->session['year_date'];
            $year_month = Yii::app()->session['year_month'];
        }

        $conditions[] = "`year` LIKE :year_date AND `month` LIKE :year_month";
        $params[':year_date'] = $year_date . '%';
        $params[':year_month'] = $year_month . '%';

        // Add conditions based on checkboxes
        $checkboxes = array('ex', 'th', 'qb', 'noquote');
        foreach ($checkboxes as $checkbox) {
            if (isset($_POST[$checkbox])) {
                $conditions[] = "(`typeofcode`= :$checkbox)";
                $params[":$checkbox"] = strtoupper($checkbox);
                $Orders[$checkbox] = 1;
            }
        }

        // Add search condition
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $searchConditions = array();
            $searchColumns = array('id', 'JOG_Code', 'No_Quote', 'QB_Draft', 'Order_Name', 'Inv_no', 'Sales_Rep_1', 'Percentage_1', 'Sales_Rep_2', 'Percentage_2', 'Remark', 'Invoice_ink', 'month', 'year', 'Invlink', 'typeofcode');
            foreach ($searchColumns as $column) {
                $searchConditions[] = "`$column` LIKE :search";
            }
            $conditions[] = '(' . implode(' OR ', $searchConditions) . ')';
            $params[':search'] = "%$search%";
        }

        // Construct the SQL query
        $sql = "SELECT o.*, q.conv_id, q.qdoci_id 
        FROM `tbl_order` o 
        LEFT JOIN `quotation_data` q ON o.`JOG_Code` = q.`jog_code`";
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        // Fetch data from the database
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $key => $value) {
            $command->bindParam($key, $params[$key]);
        }
        $Orders['Orders'] = $command->queryAll();
        $Orders['year'] = $year_date;
        $Orders['month'] = $year_month;


        $this->render('list', $Orders);
    }

    public function actionListdata()
    {
        $startTime = microtime(true);

        $Orders = array();
        $start = isset($_POST['start']) ? (int)$_POST['start'] : 0;
        $length = isset($_POST['length']) ? (int)$_POST['length'] : 100;

        $user_group = Yii::app()->user->getState('userGroup');
        $user_id = Yii::app()->user->getState('userKey');
        $user = User::model()->findByPk($user_id);
        $fullname = $user->fullname;

        $year_date = isset($_POST['year_date']) ? $_POST['year_date'] : date("Y");
        $year_month = isset($_POST['year_month']) ? $_POST['year_month'] : date("F");
        Yii::app()->session['year_date'] = $year_date;
        Yii::app()->session['year_month'] = $year_month;

        // Month map for range filters
        $month_map = array(
            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
            'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
            'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
        );

        // Month range condition builder (default single month)
        $month_condition = "`month` = '" . addslashes($year_month) . "'";

        if (isset($_POST['tocheck']) && $_POST['tocheck'] == 'on' && !empty($_POST['year_month_to'])) {
            $year_month_to = $_POST['year_month_to'];

            $start_month_num = isset($month_map[$year_month]) ? $month_map[$year_month] : null;
            $end_month_num = isset($month_map[$year_month_to]) ? $month_map[$year_month_to] : null;

            if ($start_month_num !== null && $end_month_num !== null) {
                if ($start_month_num <= $end_month_num) {
                    // build months between start and end (same year)
                    $months_in_range = array();
                    foreach ($month_map as $mname => $mnum) {
                        if ($mnum >= $start_month_num && $mnum <= $end_month_num) {
                            $months_in_range[] = $mname;
                        }
                    }
                    if (!empty($months_in_range)) {
                        $escaped = array();
                        foreach ($months_in_range as $m) {
                            $escaped[] = addslashes($m);
                        }
                        $month_condition = "`month` IN ('" . implode("','", $escaped) . "')";
                    }
                } else {
                    // spans year end -> take end-of-year months + start-of-year months
                    $months_start = array();
                    $months_end = array();
                    foreach ($month_map as $mname => $mnum) {
                        if ($mnum >= $start_month_num) $months_start[] = $mname;
                        if ($mnum <= $end_month_num) $months_end[] = $mname;
                    }
                    $merged = array_merge($months_start, $months_end);
                    $escaped = array();
                    foreach ($merged as $m) {
                        $escaped[] = addslashes($m);
                    }
                    if (!empty($escaped)) {
                        $month_condition = "`month` IN ('" . implode("','", $escaped) . "')";
                    }
                }
            }
        }

        // Base query templates
        $year_date_esc = addslashes($year_date);
        $baseQueryEx = "
            SELECT o.*, q.conv_id, q.qdoci_id, q.shipment_status
            FROM `tbl_order` o
            LEFT JOIN `quotation_data` q ON o.`JOG_Code` = q.`jog_code`
            WHERE `year` = '$year_date_esc' AND ($month_condition) AND `typeofcode` = 'Ex'";

        $baseQueryTh = "
            SELECT o.*, q.conv_id, q.qdoci_id, q.shipment_status
            FROM `tbl_order` o
            LEFT JOIN `quotation_data` q ON o.`JOG_Code` = q.`jog_code`
            WHERE `year` = '$year_date_esc' AND ($month_condition) AND `typeofcode` = 'Th'";

        // Filter conditions
        $conditions = array();
        if (isset($_POST['qb'])) $conditions[] = "`QB_Draft` = 1";
        if (isset($_POST['noquote'])) $conditions[] = "`No_Quote` = 1";
        if (isset($_POST['noinvoice'])) $conditions[] = "`Inv_no` IS NULL OR `Inv_no` = ''";

        //AND (o.`Inv_no` IS NULL OR o.`Inv_no` = '')
        $operator = (count($conditions) > 1) ? 'OR' : 'AND';

        // === 1) searchtbl branch
        if (isset($_POST['searchtbl']) && !empty($_POST['searchtbl'])) {
            $search = addslashes($_POST['searchtbl']);
            $sql = "
                SELECT o.*, q.conv_id, q.qdoci_id, q.shipment_status FROM `tbl_order` o
                LEFT JOIN `quotation_data` q ON o.`JOG_Code` = q.`jog_code`
                WHERE o.`id` LIKE '%$search%' OR
                    o.`JOG_Code` LIKE '%$search%' OR
                    o.`No_Quote` LIKE '%$search%' OR
                    o.`QB_Draft` LIKE '%$search%' OR
                    o.`Order_Name` LIKE '%$search%' OR
                    o.`Inv_no` LIKE '%$search%' OR
                    o.`Sales_Rep_1` LIKE '%$search%' OR
                    o.`Percentage_1` LIKE '%$search%' OR
                    o.`Sales_Rep_2` LIKE '%$search%' OR
                    o.`Percentage_2` LIKE '%$search%' OR
                    o.`Remark` LIKE '%$search%' OR
                    o.`Invoice_ink` LIKE '%$search%' OR
                    o.`month` LIKE '%$search%' OR
                    o.`year` LIKE '%$search%' OR
                    o.`Invlink` LIKE '%$search%' OR
                    o.`typeofcode` LIKE '%$search%'";

            $countQuery = "SELECT COUNT(*) FROM ($sql) AS subquery";
            $totalRecords = Yii::app()->db->createCommand($countQuery)->queryScalar();
            $paginatedOrders = Yii::app()->db->createCommand($sql . " LIMIT $start, $length")->queryAll();

        // === 2) salesrep branch
        } elseif (isset($_POST['salesrep']) && !empty($_POST['salesrep'])) {
            $salesrepsearch = addslashes($_POST['salesrep']);
            $checkboxaddedEX = '';
            if (!empty($conditions)) {
                $checkboxaddedEX = " AND (" . implode(" $operator ", $conditions) . ")";
            }

            if ($salesrepsearch == 'online store') {
                $sql = "
                    SELECT o.*, q.conv_id, q.qdoci_id, q.shipment_status FROM `tbl_order` o
                    LEFT JOIN `quotation_data` q ON o.`JOG_Code` = q.`jog_code`
                    WHERE (o.`typecode` = 'ON')
                    AND ($month_condition)
                    $checkboxaddedEX
                    AND o.`year` = '$year_date_esc'
                ";
            } else {
                $sql = "
                    SELECT o.*, q.conv_id, q.qdoci_id, q.shipment_status FROM `tbl_order` o
                    LEFT JOIN `quotation_data` q ON o.`JOG_Code` = q.`jog_code`
                    WHERE (o.`Sales_Rep_1` LIKE '%$salesrepsearch%' OR o.`Sales_Rep_2` LIKE '%$salesrepsearch%')
                    AND ($month_condition)
                    $checkboxaddedEX
                    AND o.`year` = '$year_date_esc'
                ";
            }

            $paginatedOrders = Yii::app()->db->createCommand($sql . " LIMIT $start, $length")->queryAll();
            // For salesrep branch we keep totalRecords as full match count (could be optimized to COUNT query)
            $countSql = "SELECT COUNT(*) FROM (`" . addslashes('tbl_order') . "`) as t WHERE 1=1";
            // easier: count from the constructed WHERE by running count on the same where
            $countQuery = "SELECT COUNT(*) FROM ($sql) AS subquery";
            $totalRecords = Yii::app()->db->createCommand($countQuery)->queryScalar();

        // === 3) default branch (Ex + Th)
        } else {
            if (!empty($conditions)) {
                $conditionSQL = " AND (" . implode(" $operator ", $conditions) . ")";
                $baseQueryEx .= $conditionSQL;
                $baseQueryTh .= $conditionSQL;
            }

            $baseQueryEx .= " ORDER BY `sortrow` ASC";
            $baseQueryTh .= " ORDER BY `sortrow` ASC";

            $countQueryEx = "SELECT COUNT(*) FROM ($baseQueryEx) AS subquery";
            $countQueryTh = "SELECT COUNT(*) FROM ($baseQueryTh) AS subquery";
            $totalRecordsEx = Yii::app()->db->createCommand($countQueryEx)->queryScalar();
            $totalRecordsTh = Yii::app()->db->createCommand($countQueryTh)->queryScalar();
            $totalRecords = $totalRecordsEx + $totalRecordsTh;

            $ordersEx = Yii::app()->db->createCommand($baseQueryEx)->queryAll();
            $ordersTh = Yii::app()->db->createCommand($baseQueryTh)->queryAll();

            if (isset($_POST['ex'])) {
                $mergedOrders = $ordersEx;
                $totalRecords = $totalRecordsEx;
                $Orders['ex'] = 1;
            } elseif (isset($_POST['th'])) {
                $mergedOrders = $ordersTh;
                $totalRecords = $totalRecordsTh;
                $Orders['th'] = 1;
            } else {
                if (count($ordersEx) != 0) {
                    $mergedOrders = array_merge($ordersEx, array(array('empty1' => true)), $ordersTh);
                } elseif (count($ordersTh) != 0) {
                    $mergedOrders = $ordersTh;
                } else {
                    $mergedOrders = $ordersEx;
                }
            }

            // Apply pagination (note: this still pulls full Ex/Th sets above;
            // you can optimize further by applying LIMITs to both and merging carefully)
            $paginatedOrders = array_slice($mergedOrders, $start, $length);
        }

        $names = [
            'FREE', 'REMAKE', 'SAMPLE', 'CANCEL',
            'online store','Sami Holmes'
        ];

        // Fetch users from DB only once
        $sql_user = "
            SELECT fullname
            FROM `user`
            WHERE `user_group_id` = 2
            AND `enable` = 1
            AND `fullname` NOT IN (
                'Jim',
                'Lucas Trickle',
                'Matt Carey',
                'Mike Nightingale',
                'Shane Hiley',
                'Trevor Easthope'
            )
            ORDER BY fullname ASC;
        ";

        $sales_user = Yii::app()->db->createCommand($sql_user)->queryAll();

        // Add dynamic names
        foreach ($sales_user as $user) {
            $fullname = trim($user['fullname']);
            switch ($fullname) {
                case 'Trent Whitcomb':
                    $names[] = 'JOG/TRENT';
                    break;
                case 'Dave Kwant':
                    $names[] = 'JOG/DAVE';
                    break;
                case 'Kristy Whitcomb':
                    $names[] = 'JOG/KRISTY';
                    $names[] = 'JOG/TRENT';
                    $names[] = 'JOG/JOHN';
                    break;
                default:
                    $names[] = $fullname;
                    break;
            }
        }

        // Add Trent Whitcomb again manually if needed
        $names[] = 'Trent Whitcomb';

        $Orders['Orders'] = $paginatedOrders;
        $Orders['year'] = $year_date;
        $Orders['month'] = $year_month;
        $data = array();
        $totalrow = count($Orders['Orders']);
        foreach ($Orders['Orders'] as $order) {
            if (isset($order['empty1']) && $order['empty1']) {
                if ($user_group == '1' || $user_group == '99') {
                    $jogcode = '<div class="emptyrow"></div>';
                    $no = '<div class="emptyrow"></div>';
                    $qb = '<div class="emptyrow"></div>';
                    $type = '<div class="emptyrow"></div>';
                    $orderName = '<div class="emptyrow"></div>';
                    $invLink = "<div class='emptyrow'><h6 style='text-align:right;'> $year_month $year_date -</h6></div>";
                    $inv_date_admin = "<div class='emptyrow'><h6 style='text-align:left;'> TH</h6></div>";
                    $inv_date_rep = "<div class='emptyrow'> </div>";
                    $salesRep1 = "<div class='emptyrow'> </div>";
                    $percentage1 = "<div class='emptyrow'> <h6 style='text-align:left;'> </h6> </div>";
                    $salesRep2 = '<div class="emptyrow"></div>';
                    $percentage2 = '<div class="emptyrow"></div>';

                    $remark = '<div class="emptyrow"></div>';
                    $btncalculator = '<div class="emptyrow"></div>';
                    $remove = '<div class="emptyrow"></div>';
                    $approve = '<div class="emptyrow"></div>';
                }else {
                        $jogcode = '<div class="emptyrow"></div>';
                    $no = '<div class="emptyrow"></div>';
                    $qb = '<div class="emptyrow"></div>';
                    $type = '<div class="emptyrow"></div>';
                    $orderName = "<div class='emptyrow'><h6 style='text-align:right;'> $year_month $year_date -</h6></div>";
                    $invLink = "<div class='emptyrow'><h6 style='text-align:left;'> TH</h6></div>";
                    $inv_date_admin = "<div class='emptyrow'></div>";
                    $inv_date_rep = "<div class='emptyrow'> </div>";
                    $salesRep1 = "<div class='emptyrow'> </div>";
                    $percentage1 = "<div class='emptyrow'> <h6 style='text-align:left;'> </h6> </div>";
                    $salesRep2 = '<div class="emptyrow"></div>';
                    $percentage2 = '<div class="emptyrow"></div>';

                    $remark = '<div class="emptyrow"></div>';
                    $btncalculator = '<div class="emptyrow"></div>';
                    $remove = '<div class="emptyrow"></div>';
                    $approve = '<div class="emptyrow"></div>';
                }
            } else {
                if ($user_group == '1' || $user_group == '99') {
                    $qdoci_status = $this->FindQdocsendnot($order['JOG_Code']);
                    
                    
                        if ($qdoci_status == 0) {
                            $sendMailNotif = '';
                            $sendPhoneNotif = '';
                            // $sendMailNotif = "<button onclick='sendnotify(\"mail\",\"" . $order['id'] . "\"," . json_encode($order['JOG_Code']) . ", ". json_encode($order['Sales_Rep_1']).", ". json_encode($order['Sales_Rep_2']).")'  style='padding: 0;border: 0;margin: 0;background: none;'><i class='fa fa-envelope'></i></button> ";
                            // $sendPhoneNotif = "<button onclick='sendnotify(\"phone\",\"" . $order['id'] . "\"," . json_encode($order['JOG_Code']) . ", ". json_encode($order['Sales_Rep_1']).", ". json_encode($order['Sales_Rep_2']).")'style='padding: 0;border: 0;margin: 0;background: none;' ><i class='fa fa-mobile'></i></button> ";
                        }elseif($order['No_Quote'] == true){
                            $sendMailNotif = '';
                            $sendPhoneNotif = '';
                            // $sendMailNotif = "<button onclick='sendnotify(\"mail\",\"" . $order['id'] . "\"," . json_encode($order['JOG_Code']) . ", ". json_encode($order['Sales_Rep_1']).", ". json_encode($order['Sales_Rep_2']).")'  style='padding: 0;border: 0;margin: 0;background: none;'><i class='fa fa-envelope'></i></button> ";
                            // $sendPhoneNotif = "<button onclick='sendnotify(\"phone\",\"" . $order['id'] . "\"," . json_encode($order['JOG_Code']) . ", ". json_encode($order['Sales_Rep_1']).", ". json_encode($order['Sales_Rep_2']).")'style='padding: 0;border: 0;margin: 0;background: none;' ><i class='fa fa-mobile'></i></button> ";

                        }else {
                            $sendMailNotif = '';
                            $sendPhoneNotif = '';
                        }
                    
                    $jogcode = "
                        <div>   
                            <a href='#' style=' opacity: 0;' data-toggle='modal' data-target='#addwutnew' class='EditBtn' onclick='addwutnew(\"up\",\"" . $order['id'] . "\",\"" . $order['sortrow'] . "\")' data-whatever='@mdo'><i class='fa fa-arrow-up aria-hidden='true'></i> </a>
                        </div>
                        <div class='jogcode'>
                            <a data-toggle='modal' class='cursor-pointer' data-target='#quoteDocModal' onclick='viewQuotationFinal(\"" . ($order['qdoci_id'] ?? '') . "\",\"vp\"," . json_encode($order['JOG_Code']) . ",\"" . ($order['conv_id'] ?? '') . "\");'>" . $order['JOG_Code'] . "</a>
                            $sendMailNotif
                            $sendPhoneNotif
                        </div>
                        <div>                
                            <a href='#' style=' opacity: 0;' data-toggle='modal' data-target='#addwutnew' class='EditBtn' onclick='addwutnew(\"down\",\"" . $order['id'] . "\",\"" . $order['sortrow'] . "\")' data-whatever='@mdo'><i class='fa fa-arrow-down' aria-hidden='true'></i> </a>
                        </div>";
                } else {
                    $jogcode = $order['JOG_Code'];
                }

                if ($order['No_Quote'] == true) {
                    $noqcolor = "redtd";
                } else {
                    $noqcolor = " ";
                }
                if ($order['QB_Draft'] == true) {
                    $qbqcolor = "bluetd";
                } else {
                    $qbqcolor = " ";
                }

                if ($user_group == '1' || $user_group == '99') {
                    $readonly = '';
                }else{
                    $readonly = '';
                }

                $no = "<div class='text-center no_quote_" . $order['id'] . " " . $noqcolor . "'>
                            <input type=\"checkbox\" class=\"checkbox\" id=\"no_quote_" . $order['id'] . "\" value=\"" . $order['No_Quote'] . "\" " . ($order['No_Quote'] ? 'checked' : '') . " ". $readonly . ">
                        </div>
                        ";

                $qb = "<div class='text-center qb_draft_" . $order['id'] . " " . $qbqcolor . "'>
                    <input type=\"checkbox\" class=\"checkbox\" id=\"qb_draft_" . $order['id'] . "\" value=\"" . $order['QB_Draft'] . "\" " . ($order['QB_Draft'] ? 'checked' : '') . " ". $readonly . ">
                    </div>";

                if (!empty($order['typecode'])) {
                    $dcode = $order['typecode'];
                    $classactive =  $order['typecode'];
                    if ($order['typecode'] == 'D') {
                        $dcode = ' ';
                    }
                } else {
                    $dcode = '';
                    $classactive = 'defaultActive';
                }
                if ($user_group == '1' || $user_group == '99') {
                    $type = "<div class=\"TypeColorFetch\" >
                        <div class=\"innerBox " . $classactive . "\" id=\"if_click\"> <h6 > " . $dcode . " </h6> </div>
                            <div class=\"ShowTypeColorPallet\"> 
                                    <div class=\"onClickTypeColorFetch\">
                                            <div class=\"innerBox RM\" id=\"if_Remake\" data-nm=\"RM\" data-id=\"" . $order['id'] . "\"> <h6 class=\"text-white\"> RM </h6> </div>
                                            <div class=\"innerBox N\" id=\"if_NewOrder\" data-nm=\"N\" data-id=\"" . $order['id'] . "\"> <h6 class=\"text-secondary\"> N </h6> </div>
                                            <div class=\"innerBox CC\" id=\"if_Cancel\" data-nm=\"CC\" data-id=\"" . $order['id'] . "\"> <h6 class=\"text-white\"> CC </h6> </div>
                                            <div class=\"innerBox F\" id=\"if_Free\" data-nm=\"F\" data-id=\"" . $order['id'] . "\"> <h6 class=\"text-secondary\"> F </h6> </div>
                                            <div class=\"innerBox ON\" id=\"if_Online\" data-nm=\"ON\" data-id=\"" . $order['id'] . "\"> <h6 class=\"text-secondary\"> ON </h6> </div>
                                            <div class=\"innerBox S\" id=\"if_Sample\" data-nm=\"S\" data-id=\"" . $order['id'] . "\"> <h6 class=\"text-secondary\"> S </h6> </div>
                                            <div class=\"innerBox Ro\" id=\"if_Reorder\" data-nm=\"Ro\" data-id=\"" . $order['id'] . "\"> <h6 class=\"text-secondary\"> Ro </h6> </div>
                                            <div class=\"innerBox D\" id=\"if_Default\" data-nm=\"D\" data-id=\"" . $order['id'] . "\"> <h6 class=\"text-secondary\">  </h6> </div>
                                    </div> 
                            </div> 
                    </div>";
                }else {
                     $type = "<div class=\"TypeColorFetch\" >
                        <div class=\"innerBoxsales " . $classactive . "\"> <h6 > " . $dcode . " </h6> </div>
                    </div>";
                }

                $orderName = "<td data-col='4' >
                        <div class='text-center text-left " . ($user_group == '1' || $user_group == '99' ? 'editable-cell' : '') . "'>
                            <span class='editable' data-id='" . $order['id'] . "' data-field='Order_Name'>". 
                            (isset($order['Order_Name']) && $order['Order_Name'] !== '' ? $order['Order_Name'] : '-')  . "</span>
                        </div>
                    </td>";
                $invno = preg_replace('/\s+/', ' ', $order['Inv_no']);
                $cleanInvNo = preg_replace('/[^\w\s\-,]/', '', $invno);

                // Initialize $inv_tital with a default value
                $inv_tital = '-';

                if (!empty($order['Inv_no'])) {
                    $inv_ary = explode(',', $order['Inv_no']);
                    $link_ary = explode(',', $order['Invlink']);
                    $htmlinv = '';
                    $totalarray = count($link_ary);

                    // QB payment status â border on the TD
                    $payStatus = isset($order['payment_status']) ? $order['payment_status'] : 'unpaid';
                    if ($payStatus === 'paid') {
                        $invTdBorder = 'border:2px solid #28a745;';
                    } elseif ($payStatus === 'partial') {
                        $invTdBorder = 'border:2px solid #fd7e14;';
                    } else {
                        $invTdBorder = '';
                    }

                    if (!empty($order['Invlink'])) {
                        foreach ($inv_ary as $index => $inv_no) {
                            if (isset($link_ary[$index])) {
                                $htmlinv .= "<a href='" . trim($link_ary[$index]) . "' target='_blank'><u>" . trim($inv_no) . "</u></a><br>";
                            } else {
                                $htmlinv .= "<span>" . trim($inv_no) . "</span><br>";
                            }
                        }
                    } else {
                        foreach ($inv_ary as $index => $inv_no) {
                            $htmlinv .= "<span>" . trim($inv_no) . "</span><br>";
                        }
                    }
                } else {
                    $htmlinv = $inv_tital;
                    $invTdBorder = '';
                }

                if ($payStatus === 'paid') {
                    $payStatusLabel = "<span style='display:block;font-size:11px;color:#28a745;font-weight:600;'>Paid</span>";
                } elseif ($payStatus === 'partial') {
                    $payStatusLabel = "<span style='display:block;font-size:11px;color:#fd7e14;font-weight:600;'>Partially Paid</span>";
                } else {
                    $payStatusLabel = '';
                }

                $invLink = "<td data-col='5' " . ($user_group == '1' || $user_group == '99' ? "class='invlink'" : "") . " style='position: relative;'>
                    <div class='invlink' data-paystatus='" . $payStatus . "'>
                    <span class='invtital" . $order['id'] . "'>" . ($order['Inv_no'] != '' ? "$htmlinv" : $inv_tital) . "</span>
                    $payStatusLabel
                    " . ($user_group == '1' || $user_group == '99' ? "<span class='edit-icon' id='invlinkatt" . $order['id'] . "' data-toggle='modal' data-target='#invlink" . $order['id'] . "' onclick=\"invcpopup('" . $order['id'] . "', '" . $cleanInvNo . "', '" . $order['Invlink'] . "')\" style='position: absolute; top: 50%; transform: translateY(-50%); right: 5px; cursor: pointer;display:none'>
                        <i class='fa fa-pencil'></i>
                    </span>" : "") . "
                    </div>
                </td>";

                if (!empty($order['Inv_no'])) {
                    $inv_send_date='';
                    $inv_date_ary = explode(',', $order['inv_send_date']);
                    foreach ($inv_date_ary as $index => $inv_date) {
                        $inv_send_date .= "<span>" . $inv_date . "</span><br>";
                    }       
                    
                    $inv_date_admin = "<td data-col='5' " . ($user_group == '1' || $user_group == '99' ? "class='invlink'" : "") . " style='position: relative;'>
                        <div class='invlink'>
                        <span class='invtitaladmindate" . $order['id'] . "'>" . ($order['inv_send_date'] != '' ? "$inv_send_date" : $inv_tital) . "</span>
                        " . ($user_group == '1' || $user_group == '99' ? "<span class='edit-icon-admin' id='invlinkattadmindate" . $order['id'] . "' data-toggle='modal' data-target='#invlink" . $order['id'] . "' onclick=\"invAdminRep('" . $order['id'] . "', '" . $order['inv_send_date'] . "', '".$totalarray."')\" style='position: absolute; top: 50%; transform: translateY(-50%); right: 5px; cursor: pointer;'>
                            <i class='fa fa-pencil'></i>
                        </span>" : "") . "
                        </div>
                    </td>";

                }else {
                    $inv_date_admin = '-';
                }
                
                
                
                $inv_sales_date='';
                $inv_sales_ary = explode(',', $order['inv_sales_date']);
                foreach ($inv_sales_ary as $index => $inv_date) {
                    $inv_sales_date .= "<span>" . $inv_date . "</span><br>";
                }
                if (!empty($order['Inv_no'])) {
                $inv_date_rep = "<td data-col='5' " . ($user_group ? "class='invlink'" : "") . " style='position: relative;'>
                        <div class='invlink'>
                        <span class='invtitalrepdate" . $order['id'] . "'>" . ($order['inv_sales_date'] != '' ? "$inv_sales_date" : $inv_tital) . "</span>
                        " . ($user_group ? "<span class='edit-icon-sales' id='invlinkattrepdate" . $order['id'] . "' data-toggle='modal' data-target='#invlink" . $order['id'] . "' onclick=\"invSalesRep('" . $order['id'] . "', '" . $order['inv_sales_date'] . "', '".$totalarray."')\" style='position: absolute; top: 50%; transform: translateY(-50%); right: 5px; cursor: pointer;'>
                            <i class='fa fa-pencil'></i>
                        </span>" : "") . "
                        </div>
                    </td>";
                } else {
                    $inv_date_rep ="-";
                }


                if ($user_group == '1' || $user_group == '99') {
                    $salesRep1 = "<td data-col='6' class='text-center'>";
                    $salesRep1 .= "<select class='form-select sales_rep_1' name='sales_rep_1' id='sales_rep_1' 
                                    data-initial='" . htmlspecialchars($order['Sales_Rep_1']) . "'>";

                    // Add default empty option
                    $salesRep1 .= "<option value='' data-id='" . $order['id'] . "'></option>";

                    // Loop through pre-fetched $names
                    foreach ($names as $name) {
                        if ($order['Sales_Rep_1'] == 'Kristy Whitcomb') {
                            $salesname = 'JOG/KRISTY';
                        }else{
                            $salesname = $order['Sales_Rep_1'];
                        }

                        $selected = ($name == $salesname) ? 'selected' : '';
                        $salesRep1 .= "<option value=\"$name\" data-id=\"" . $order['id'] . "\" $selected>$name</option>";
                    }

                    $salesRep1 .= "</select></td>";
                } else {
                    $salesRep1 = htmlspecialchars($order['Sales_Rep_1']);
                }

                if ($user_group == '1' || $user_group == '99') {
                    $per1 = $order['Percentage_1'];
                }else {
                    if ($fullname == $order['Sales_Rep_1']) {
                       $per1 = $order['Percentage_1'];
                    } else {
                        $per1 = "";
                    }
                }

                $percentage1 = "<td data-col='7' class='text-center editable-cell' style='text-align: center;'>" .
                    "<div class='text-center " . ($user_group == '1' || $user_group == '99' ? 'editable-cell' : '') . "'>" .
                    "<span class='editable' data-id='" . $order['id'] . "' data-field='percentage_1'>" . 
                    (isset($per1) && $per1 !== '' ? $per1 : '-')  . 
                    "</span>" .
                    "</div>" .
                    "</td>";

                if ($user_group == '1' || $user_group == '99') {
                    $salesRep2 = "<td data-col='6' class='text-center'>";
                    $salesRep2 .= "<select class='form-select sales_rep_2' 
                                        name='sales_rep_2' 
                                        id='sales_rep_2' 
                                        data-initial='" . htmlspecialchars($order['Sales_Rep_2']) . "'>";

                    // Empty default option
                    $salesRep2 .= "<option value='' data-id='" . $order['id'] . "'></option>";

                    // Use preloaded names
                    foreach ($names as $name) {
                        $selected = ($name == $order['Sales_Rep_2']) ? 'selected' : '';
                        $salesRep2 .= "<option value=\"$name\" data-id=\"" . $order['id'] . "\" $selected>$name</option>";
                    }

                    $salesRep2 .= "</select></td>";
                } else {
                    $salesRep2 = htmlspecialchars($order['Sales_Rep_2']);
                }

                if ($user_group == '1' || $user_group == '99') {
                    $per2 = $order['Percentage_2'];
                }else {
                    if ($fullname == $order['Sales_Rep_2']) {
                        $per2 = $order['Percentage_2'];
                    } else {
                        $per2 = "";
                    }
                }

                $percentage2 = "<td data-col='9' class='text-center editable-cell' style='text-align: center;'>" .
                    "<div class='text-center " . ($user_group == '1' || $user_group == '99' ? 'editable-cell' : '') . "'>" .
                    "<span class='editable' data-id='" . $order['id'] . "' data-field='percentage_2'>" . 
                    (isset($per2) && $per2 !== '' ? $per2 : '-') . 
                    "</span>" .
                    "</div>" .
                    "</td>";


                if ($order['online_store'] == "") {
                    $os_class = "btn onclickUpload";
                    $os_txt = "Click To Upload";
                } else {
                    $os_class = "btn btn-primary onclickView";
                    $os_txt = "View";
                }

                $onlineStore = "<td data-col='11'>
                                    <div class='row'>
                                        <div class='col-sm-12 text-center'>
                                            <button class='" . $os_class . " btn-md uploaddoc" . $order['id'] . "' id='btnupdoc" . $order['id'] . "' data-toggle='modal' data-target='#freebModal' onclick=\"openQuotationData('4','" . $order['id'] . "','" . $order['online_store'] . "','')\" style='width:100%'>" . $os_txt . "</button>
                                        </div>
                                    </div>
                                </td>";

                $years = "<td data-col='12' class='text-center'>" . $order['year'] . "</td>";

                $typeofcode = "<td data-col='13' class='text-center' style='text-transform: uppercase;'>" . $order['typeofcode'] . "</td>";

                if ($user_id == "2" || $user_id == "40" || $user_id == "28" || $user_id == "79" || $user_id == "44" || $user_id == "83" ) {
                    if ($user_id == "2" || $user_id == "40" || $user_id == "28" || $user_id == "79" || $user_id == "44" || $user_id == "83") {
                        if ($order['Remark_by'] == "" || $order['Remark_by'] == null) {
                            $remark = "<button class='btn  commentBtnIcon admin_comment_edit noteaddbtn "  . $order['id'] . "' conv_id='" . $order['id'] . "' order_id='" . $order['id'] . "' >  <img src='../images/comment-Icon.png' alt='...'>   </button>";
                        } else {
                            $remark = "<button class='btn commentBtnIcon commentBtnIconInfo admin_comment_edit noteaddbtn" . $order['id'] . "' conv_id='" . $order['id'] . "'> <img src='../images/comment-Icon.png' alt='...'> </button>";
                        }
                    } elseif ($order['Remark_by'] == "" || $order['Remark_by'] == null) {
                        $remark = "<button class='btn btn-danger'>No Notes</button>";
                    } else {
                        $remark = " <button class='btn btn-info admin_comment_edit' conv_id='" . $order['id'] . "'>View Notes</button>";
                    }
                } else {
                    if ($order['Remark_by'] == "" || $order['Remark_by'] == null) {
                        $remark = "<button class='btn  commentBtnIcon admin_comment_edit noteaddbtn "  . $order['id'] . "' conv_id='" . $order['id'] . "' order_id='" . $order['id'] . "' >  <img src='../images/comment-Icon.png' alt='...'>   </button>";
                    } else {
                        $sqlasd = "SELECT * FROM tbl_order_comments WHERE order_id='".$order['id'] . "' AND user_id = '".$user_id."' ORDER BY add_time ASC";
                        $a_qitem = Yii::app()->db->createCommand($sqlasd)->queryAll();
                        if ($order['Remark_by'] == $user_id) {
                            $remark = "<button class='btn commentBtnIcon commentBtnIconInfo admin_comment_edit noteaddbtn" . $order['id'] . "' conv_id='" . $order['id'] . "'> <img src='../images/comment-Icon.png' alt='...'> </button>";
                        }elseif ($user_group == '1' || $user_group == '99') {
                            $remark = "<button class='btn commentBtnIcon commentBtnIconInfo admin_comment_edit noteaddbtn" . $order['id'] . "' conv_id='" . $order['id'] . "'> <img src='../images/comment-Icon.png' alt='...'> </button>";
                        }elseif(count($a_qitem) == 0){                            
                            $remark = "<button class='btn  commentBtnIcon admin_comment_edit noteaddbtn "  . $order['id'] . "' conv_id='" . $order['id'] . "' order_id='" . $order['id'] . "' >  <img src='../images/comment-Icon.png' alt='...'>   </button>";
                        }else {                            
                            $remark = "<button class='btn commentBtnIcon commentBtnIconInfo admin_comment_edit noteaddbtn" . $order['id'] . "' conv_id='" . $order['id'] . "'> <img src='../images/comment-Icon.png' alt='...'> </button>";
                        } 
                        //$remark = "<button class='btn commentBtnIcon commentBtnIconInfo admin_comment_edit noteaddbtn" . $order['id'] . "' conv_id='" . $order['id'] . "'> <img src='../images/comment-Icon.png' alt='...'> </button>";
                    }
                }
                $link_ary = explode(',', $order['Invlink']);

                $encodedInvLink = urlencode($order['Invlink']);
                if ( $order['Sales_Rep_2'] == "JOG SPORTS" || $order['Sales_Rep_1'] == "JOG SPORTS" ||$order['Sales_Rep_2'] == "Jog Sports" || $order['Sales_Rep_1'] == "Jog Sports" || $order['Sales_Rep_2'] == "FREE" || $order['Sales_Rep_1'] == "FREE" || $order['Sales_Rep_2'] == "REMAKE" || $order['Sales_Rep_1'] == "REMAKE" || $order['Sales_Rep_2'] == "SAMPLE" || $order['Sales_Rep_1'] == "SAMPLE" || $order['Sales_Rep_2'] == "CANCEL" || $order['Sales_Rep_1'] == "CANCEL"
                    || $order['Sales_Rep_2'] == "JOG/KRISTY" || $order['Sales_Rep_1'] == "JOG/KRISTY" || $order['Sales_Rep_2'] == "JOG/TRENT" || $order['Sales_Rep_1'] == "JOG/TRENT" || $order['Sales_Rep_2'] == "JOG/JOHN" || $order['Sales_Rep_1'] == "JOG/JOHN" || $order['Sales_Rep_2'] == "JOG/DAVE" || $order['Sales_Rep_1'] == "JOG/DAVE"
                ) {
                    $carclass = "hidden";
                    $carshtml = "<span class='commcar' > N/A </span>";
                } else {
                    $carclass = " ";
                    $carshtml = "";
                }
                if (!empty($order['Sales_Rep_2'])) {
                    $btncalculatorcan = $this->fetchData($order['Inv_no'], $order['year']);
                    if ($btncalculatorcan != 0) {
                        $btncolor = "btn-success";
                    } else {
                        $btncolor = "btn-danger";
                    }
                    if ($btncalculatorcan != 0) {
                        $btntext = "Completed ";
                    } else {
                        $btntext = "Commission";
                    }
                    
                    $btncalculator = "<td data-col='15' class='text-center'>
                                <div class='commdiv " . $carclass . "'>
                                    <a href='#' class='btn " . $btncolor . "' data-toggle='modal' data-target='#Commission' onclick=\"openCommissionData('" . $order['JOG_Code'] . "','" . $order['Sales_Rep_1'] . "','" . $order['Sales_Rep_2'] . "','" . $order['year'] . "','" . $order['Percentage_1'] . "','" . $order['Percentage_2'] . "','" . $order['Inv_no'] . "','" . $link_ary['0'] . "','" . $order['month'] . "','" . str_replace("'", "\\'", $order['Order_Name']) . "')\"> " . $btntext . " </a>
                                    </div>
                                    " . $carshtml . "
                                
                        </td>";
                } else {
                    $btncalculatorcan = $this->fetchData($order['Inv_no'], $order['year']);
                    if ($btncalculatorcan != 0) {
                        $btncolor = "btn-success";
                    } else {
                        $btncolor = "btn-danger";
                    }
                    if ($btncalculatorcan != 0) {
                        $btntext = "Completed ";
                    } else {
                        $btntext = "Commission";
                    }
                    $base  = Yii::app()->baseUrl;
                    $order_name_encoded = urlencode($order['Order_Name']);
                    $btncalculator = "<td data-col='15' class='text-center'>
                            <div class='commdiv " . $carclass . "'>					
                                <a href='" . $base . "/calculator/SalesCommission/year/" . $order['year'] . "/sales/" . $order['Sales_Rep_1'] . "?invno=" . $order['Inv_no'] . "&per=" . $order['Percentage_1'] . "&jogcode=" . $order['JOG_Code'] . "&invlnk=" . $link_ary['0'] . "&ordnm=" . $order_name_encoded . "&month=" . $order['month'] . "' class='btn " . $btncolor . "' target='_blank'> " . $btntext . "</a>                            
                                </div>
                                " . $carshtml . "
                        </td>";
                }

                $remove = "<td data-col='16' class='text-center'>
                                    <span class='removerowtb' data-id='" . $order['id'] . "' data-field='removedata'>
                                        <i class='fa fa-trash-o delete-btn'></i>
                                    </span>
                                </td>";

                $shipment_status = isset($order['shipment_status']) ? (int)$order['shipment_status'] : 0;
                if ($shipment_status == 1) {
                    $approve = "<td data-col='17' class='text-center'>
                                <span title='Shipped' style='display:inline-block;width:16px;height:16px;border-radius:50%;background:#28a745;'></span>
                            </td>";
                } else {
                    $approve = "<td data-col='17'></td>";
                }
            }

            if ($user_group == '1' || $user_group == '99') {
                if ($user_id == "2" || $user_id == "40" || $user_id == "28" || $user_id == "79" || $user_id == "44" || $user_id == "83" || $user_id == "92"  || ($salesRep1 == '' && $salesRep1 == '')) {
                    $rowData = array(
                        $jogcode,
                        $no,
                        $qb,
                        $type,
                        $orderName,
                        $invLink,
                        $inv_date_admin,
                        $inv_date_rep,
                        $salesRep1,
                        $percentage1,
                        $salesRep2,
                        $percentage2,

                        $remark,
                        $btncalculator,
                        $remove,
                        $approve,
                    );
                } else {
                    $rowData = array(
                        $jogcode,
                        $no,
                        $qb,
                        $type,
                        $orderName,
                        $invLink,
                        $salesRep1,
                        $percentage1,
                        $salesRep2,
                        $percentage2,
                        $btncalculator,
                        $remove,
                        $approve,
                    );
                }
            } else {
                $rowData = array(
                    $jogcode,
                    $no,
                    $qb,
                    $type,
                    $orderName,
                    $invLink,
                    $inv_date_admin,
                    $inv_date_rep,
                    $salesRep1,
                    $percentage1,
                    $salesRep2,
                    $percentage2,
                    $remark,
                );
            }
            $data[] = $rowData;
        }

        $response = array(
            "draw" => isset($_POST['draw']) ? intval($_POST['draw']) : 1,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data,
            "execution_time" => round(microtime(true) - $startTime, 3) . "s"
        );

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function actionUpdatList()
    {
        if (isset($_POST['sales_rep_class']) && $_POST['sales_rep_class'] == 'sales_rep_2') {
            $sr2 =  $_POST['sales_rep'];
            $orderid = $_POST['order_id'];
            $sql = "UPDATE `tbl_order` SET `Sales_Rep_2`= '$sr2'  WHERE `id`= '$orderid'";
            $update =  Yii::app()->db->createCommand($sql)->execute();
        }

        if (isset($_POST['sales_rep_class']) && $_POST['sales_rep_class'] == 'sales_rep_1') {
            $sr1 =  $_POST['sales_rep'];
            $orderid = $_POST['order_id'];
            $sql = "UPDATE `tbl_order` SET `Sales_Rep_1`= '$sr1'  WHERE `id`= '$orderid'";

            $update =  Yii::app()->db->createCommand($sql)->execute();
        }

        if (isset($_POST['field']) && $_POST['field'] == 'percentage_1') {
            $field =  $_POST['field'];
            echo $value =  $_POST['value'];
            $orderid = $_POST['orderid'];
            echo $sql = "UPDATE `tbl_order` SET `Percentage_1`= '$value'  WHERE `id`= '$orderid'";
            $update =  Yii::app()->db->createCommand($sql)->execute();
        }

        if (isset($_POST['field']) && $_POST['field'] == 'percentage_2') {
            $field =  $_POST['field'];
            $value =  $_POST['value'];
            $orderid = $_POST['orderid'];
            $sql = "UPDATE `tbl_order` SET `Percentage_2`= '$value'  WHERE `id`= '$orderid'";
            $update =  Yii::app()->db->createCommand($sql)->execute();
        }

        if (isset($_POST['field']) && $_POST['field'] == 'Remark') {
            $field =  $_POST['field'];
            $value =  $_POST['value'];
            $orderid = $_POST['orderid'];
            $sql = "UPDATE `tbl_order` SET `Remark`= '$value'  WHERE `id`= '$orderid'";

            $update =  Yii::app()->db->createCommand($sql)->execute();
        }

        if (isset($_POST['invname'])) {
            $invname =  $_POST['invname'];
            $invlink =  $_POST['invlink'];
            $orderid = $_POST['orderid'];

            // $jog_code  = Yii::app()->db->createCommand("SELECT JOG_Code  FROM tbl_order Where id= '$orderid'")->queryScalar();
            // $qdco_id = Yii::app()->db->createCommand("SELECT qdoci_id FROM quotation_data WHERE jog_code = '$jog_code'")->queryScalar();

            // echo $jog_code . '---'. $qdco_id ; die ; 
         
            $sql = "UPDATE `tbl_order` SET `Inv_no`= '$invname' , `Invlink` = '$invlink' WHERE `id`= '$orderid'";

            // if($qdco_id):
            //         $sql_update = "UPDATE tbl_quote_doc SET inv_no='" . addslashes($invname) . "'  WHERE qdoc_id='" . $qdco_id . "'";
            //         $sql_update_inv_link  = "UPDATE quotation_data SET invoice_link='" . addslashes($invlink) . "' WHERE qdoci_id='" . $qdco_id . "'";
            //         $update_inv_number  = Yii::app()->db->createCommand($sql_update)->execute();
            //         $update_inv_link  = Yii::app()->db->createCommand($sql_update_inv_link)->execute();
            // endif ;

            echo "update successfully";
            $update =  Yii::app()->db->createCommand($sql)->execute();
        }

        if (isset($_POST['inv_sales_date'])) {
            $inv_sales_date =  $_POST['inv_sales_date'];
            $orderid = $_POST['orderid'];
            $sql = "UPDATE `tbl_order` SET `inv_sales_date`= '$inv_sales_date'  WHERE `id`= '$orderid'";
            $update =  Yii::app()->db->createCommand($sql)->execute();
        }

        if (isset($_POST['inv_Admin_date'])) {
            $inv_sales_date =  $_POST['inv_Admin_date'];
            $orderid = $_POST['orderid'];
            $sql = "UPDATE `tbl_order` SET `inv_send_date`= '$inv_sales_date'  WHERE `id`= '$orderid'";
            $update =  Yii::app()->db->createCommand($sql)->execute();
        }

        if (isset($_POST['field']) && $_POST['field'] == 'no') {
            $field =  $_POST['field'];
            $value =  $_POST['value'];
            $orderid = $_POST['id'];
            $sql = "UPDATE `tbl_order` SET `No_Quote`= '$value'  WHERE `id`= '$orderid'";

            $update =  Yii::app()->db->createCommand($sql)->execute();
        }

        if (isset($_POST['field']) && $_POST['field'] == 'qb') {
            $field =  $_POST['field'];
            $value =  $_POST['value'];
            $orderid = $_POST['id'];
            $sql = "UPDATE `tbl_order` SET `QB_Draft`= '$value'  WHERE `id`= '$orderid'";

            $update =  Yii::app()->db->createCommand($sql)->execute();
        }

        if (isset($_POST['field']) && $_POST['field'] == 'approve') {
            $field =  $_POST['field'];
            $value =  $_POST['value'];
            $orderid = $_POST['id'];
            $sql = "UPDATE `tbl_order` SET `approve`= '$value'  WHERE `id`= '$orderid'";
            $update =  Yii::app()->db->createCommand($sql)->execute();
        }

        if (isset($_POST['field']) && $_POST['field'] == 'Order_Name') {
            $field =  $_POST['field'];
            $value =  $_POST['value'];
            $orderid = $_POST['orderid'];
            $sql = "UPDATE `tbl_order` SET `Order_Name`= '$value'  WHERE `id`= '$orderid'";

            $update =  Yii::app()->db->createCommand($sql)->execute();
        }

        if (isset($_POST['field']) && $_POST['field'] == 'removedata') {
            $field =  $_POST['field'];
            $orderid = $_POST['id'];
            $sql = "DELETE FROM `tbl_order` WHERE  `id`= '$orderid'";

            $update =  Yii::app()->db->createCommand($sql)->execute();
        }

        if (isset($_POST['nm']) && $_POST['typechange'] == 'TypeColorFetch') {
            $orderid = $_POST['orderId'];
            $nm = $_POST['nm'];

            $sql = "UPDATE `tbl_order` SET `typecode`= '$nm'  WHERE `id`= '$orderid'";
            $update =  Yii::app()->db->createCommand($sql)->execute();
        }
    }


    public function actionaddUpdate()
    {

        if (!is_array($_POST['jCode'])) {
            // If it's not an array, convert it into an array
            $_POST['jCode'] = array($_POST['jCode']);
            // Similarly, convert other fields into arrays if they are not already arrays
            $_POST['nQuote'] = array($_POST['nQuote']);
            $_POST['qDraft'] = array($_POST['qDraft']);
            $_POST['orderName'] = array($_POST['orderName']);
            $_POST['invNo'] = array($_POST['invNo']);
            $_POST['invLinks'] = array($_POST['invLinks']);
            $_POST['sRep1'] = array($_POST['sRep1']);
            $_POST['percentage1'] = array($_POST['percentage1']);
            $_POST['sRep2'] = array($_POST['sRep2']);
            $_POST['percentage2'] = array($_POST['percentage2']);
            $_POST['month'] = array($_POST['month']);
            $_POST['year'] = array($_POST['year']);
            $_POST['typeOfCode'] = array($_POST['typeOfCode']);
            $_POST['remark'] = array($_POST['remark']);
        }
        // Initialize an empty array to store the SQL queries
        $sqlQueries = [];

        // Iterate over each row in the form data
        foreach ($_POST['jCode'] as $key => $value) {

            $nQuoteValue = isset($_POST['nQuote'][$key]) ? 1 : 0;
            $qDraftValue = isset($_POST['qDraft'][$key]) ? 1 : 0;

            // Construct the SQL query for insertion
            $sql = "INSERT INTO `tbl_order` (`JOG_Code`, `No_Quote`, `QB_Draft`, `Order_Name`, `Inv_no`, `Sales_Rep_1`, `Percentage_1`, `Sales_Rep_2`, `Percentage_2`, `Remark`, `month`, `year`, `Invlink`, `typeofcode`) VALUES (";
            $sql .= "'" . $_POST['jCode'][$key] . "', ";
            $sql .= "'" . $nQuoteValue . "', ";
            $sql .= "'" . $qDraftValue . "', ";
            $sql .= "'" . $_POST['orderName'][$key] . "', ";
            $sql .= "'" . $_POST['invNo'][$key] . "', ";
            $sql .= "'" . $_POST['sRep1'][$key] . "', ";
            $sql .= "'" . $_POST['percentage1'][$key] . "', ";
            $sql .= "'" . $_POST['sRep2'][$key] . "', ";
            $sql .= "'" . $_POST['percentage2'][$key] . "', ";
            $sql .= "'" . $_POST['remark'][$key] . "', ";
            $sql .= "'" . $_POST['month'][$key] . "', ";
            $sql .= "'" . $_POST['year'][$key] . "', ";
            $sql .= "'" . $_POST['invLinks'][$key] . "', ";
            $sql .= "'" . $_POST['typeOfCode'][$key] . "')";

            // Add the SQL query to the array
            $sqlQueries[] = $sql;
        }
        // Execute each SQL query
        foreach ($sqlQueries as $sql) {
            Yii::app()->db->createCommand($sql)->execute();
        }

        return "Records inserted successfully";
    }

    public function actionUploadFreebies()
    {

        if (isset($_FILES['files_name']['name']) || isset($_POST['notes_admin'])) {

            $data = "online_store";

            if ($_FILES['files_name']['name'] != "") {
                $conv_id = $_POST['main_conv_id'];
                $sourcePath = $_FILES['files_name']['tmp_name'];
                $newfile = $_FILES['files_name']['name']; //any name sample.jpg
                $targetPath = Yii::getPathOfAlias('webroot') . '/upload/samples/' . $newfile;

                if (move_uploaded_file($sourcePath, $targetPath)) {
                    $sql = "UPDATE `tbl_order` SET `online_store`='$newfile' WHERE `id`='$conv_id'";
                    Yii::app()->db->createCommand($sql)->execute();
                    die(json_encode(array('status' => 1)));
                } else {
                    die(json_encode(array('status' => 0)));
                }
            }
        } else {
            die(json_encode(array('status' => 0)));
        }
    }

    public function fetchData($invNo, $year)
    {
        // Perform database query or any other logic
        $data = Yii::app()->db->createCommand()
            ->select('COUNT(*)')
            ->from('calculator cal')
            ->where('cal.invoice = :invoice', array(':invoice' => $invNo))
            ->andWhere('cal.date_quarter LIKE :year', array(':year' => $year . '%'))
            ->queryScalar();

        return $data;
    }

    public function actionfetchsalesData()
    {
        $jogcode = $_POST['jogCode'];
        $sales1 = $_POST['salesRep1'];
        $sales2 = $_POST['sales2'];
        $years = $_POST['year'];
        $per = $_POST['per'];
        $per2 = $_POST['per2'];
        $invlnk = $_POST['invlnk'];
        $invno = $_POST['invno'];
        $month = $_POST['month'];

        $ordname = $_POST['ordname'];
        $ordnm = urlencode($ordname);
        $comm_total = isset($_POST['comm_total']) ? floatval($_POST['comm_total']) : 0;
                
        // Perform database query or any other logic
        $salescount1 = Yii::app()->db->createCommand()
            ->select('COUNT(*)')
            ->from('calculator cal')
            ->where('cal.order_no = :order_no', array(':order_no' => $jogcode))
            ->andWhere('cal.sales_manager = :sales_manager', array(':sales_manager' => $sales1))
            ->andWhere('cal.date_quarter LIKE :year', array(':year' => $years . '%'))
            ->queryScalar();

        $salescount2 = Yii::app()->db->createCommand()
            ->select('COUNT(*)')
            ->from('calculator cal')
            ->where('cal.order_no = :order_no', array(':order_no' => $jogcode))
            ->andWhere('cal.sales_manager = :sales_manager', array(':sales_manager' => $sales2))
            ->andWhere('cal.date_quarter LIKE :year', array(':year' => $years . '%'))
            ->queryScalar();

        if ($salescount1 == 0) {
            $btnsales1 =  "btn-danger ";
            $saletext1 = "Commission";
        } else {
            $btnsales1 =  "btn-success";
            $saletext1 = "Completed ";
        }

        if ($salescount2 == 0) {
            $btnsales2 =  "btn-danger ";
            $saletext2 = "Commission";
        } else {
            $btnsales2 =  "btn-success";
            $saletext2 = "Completed ";
        }

        echo  "<div class='col-6'>                                
            <label> $sales1 </label>
			
                <a href='/calculator/SalesCommission/year/$years/sales/$sales1?invno=$invno&jogcode=$jogcode&per=$per&invlnk=$invlnk&ordnm=$ordnm&month=$month&comm_total=$comm_total&from_jog=1' class='btn $btnsales1'  target='_blanck'> $saletext1 </a>
            </div>
            <div class='col-6'>            
                <label> $sales2 </label>
                <a href='/calculator/SalesCommission/year/$years/sales/$sales2?invno=$invno&jogcode=$jogcode&per=$per2&invlnk=$invlnk&ordnm=$ordnm&month=$month&comm_total=$comm_total&from_jog=1' class='btn $btnsales2' target='_blanck'> $saletext2 </a>
            </div>";
    }

    public function actionOrderShowQuoteView()
    {
        $qdoc_id = $_POST["qdoc_id"];
        $jog_code_main = $_POST['jog_code_main'];
        $sql_quote = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $qdoc_id . "'; ";
        $a_quote = Yii::app()->db->createCommand($sql_quote)->queryAll();
        if (empty($a_quote)) {

            $a_result['inner_content'] = '<div> <center> <h2> Quotation not found </h2> </center> <div>';
            echo json_encode($a_result);
            return;
        }
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
        $select_html = '<select style="width:50px;" id="viewQuotationNewFinal" qdoc_id="' . $qdoc_id . '" action_from="' . $action_from . '")">';
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

        $return_html .= '<h1 style="color:#000;">QUOTATION</h1>';
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
        $sql_user = "SELECT * FROM user WHERE id='" . $row_quote["user_id"] . "'; ";
        $a_user = Yii::app()->db->createCommand($sql_user)->queryAll();
        $row_user = $a_user[0];
        $fullname_sales = $row_user["fullname"];

        $return_html .= '<div class="sales_name d-flex" style="margin-bottom:10px;" > <h4 style="background: #ced5db;font-size:14px; padding: 10px 15px !important;text-align: left !important;color: #2A3F54;border-right: 1px solid #2a3f5466;"> Sales Name : </h6> <h6 style="padding: 8px 10px !important;border: 1px solid #00000014;position: relative;color: #000000 !important;font-size: 14px;font-weight: 700;text-transform: capitalize;">' . $fullname_sales.'</h6>';
        $return_html .= '</div>';
        $return_html .= '<div class="bill_to">BILL TO<br>' . $row_quote["cust_name"];
        $return_html .= '<pre>' . $row_quote["cust_info"] . '</pre></div>';
        if ($action_from != "va") {
            //$return_html .= '<a href="#" onclick="edit_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Edit <span id="cus_namer_' . $row_quote["cust_id"] . '">' . $row_quote["cust_name"] . '</span></a><span style="display: inline-block; font-size: 1.5em; margin: 0 5px;">&bull;</span><a href="#" onclick="change_cust_modal(\'' . $row_quote['cust_id'] . '\',\'' . $qdoc_id . '\')" style="color:blue;">Change Customer</a>';
        }
        $return_html .= '</td>';
        $return_html .= '<td padding:20px 0px;">';
        $return_html .= '<table align="right" style="border-collapse: separate; border-spacing: 10px; color:#000;">';
        $return_html .= '<tr><th width="50%" style="text-align:right;">Quotation Number: </th><td style="color:#00F; text-align:left;" id="qdoc_number">' . $row_quote["est_number"] . 'Q</td></tr>';
        $return_html .= '<tr>';
        $return_html .= '<tr><th width="50%" style="text-align:right;">JOG Code: </th><td text-align:left;" id="jog_code">' . $jog_code_main . '</td></tr>';
        $return_html .= '<tr>';
        $return_html .= '<th style="text-align:right;">PO Number: </th>';
        $return_html .= '<td style="text-align:left;" id="po_number">';
        $return_html .= '<span id="sp_po_number' . $qdoc_id . '">' . $row_quote["po_number"] . '</span>';
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

        $return_html .= '<th style="text-align:center; color:#999;">Comm.%</th><th style="text-align:center; color:#999;">Comm.</th>';
        $return_html .= '<th style="text-align:center; width:80px;">Quantity</th><th style="text-align:center; width:80px;">Price</th><th style="text-align:right; width:80px;">Amount</th></tr>';
        // if($action_from=="vc" || $action_from=="va"){
        // }else{
        // 	$return_html .= '<th style="text-align:center;">Quantity</th><th style="text-align:right; width:140px;">Price</th><th style="text-align:right; width:140px;">Amount</th></tr>';
        // }

        $sql_qitem = "SELECT * FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND enable=1 AND product_status='1' ORDER BY sort ASC; ";
        $a_qitem = Yii::app()->db->createCommand($sql_qitem)->queryAll();

        //$sub_total = 0.0;
        $sub_total = $row_quote["sub_total"];
        $comm_total = 0.0;

        $user_group = Yii::app()->user->getState('userGroup');

        // Calculate total product amount excluding shipping to apply $800 commission threshold
        $non_shipping_total = 0.0;
        foreach ($a_qitem as $row_qitem_tmp) {
            if (stripos($row_qitem_tmp["pro_name"], "shipping") === false) {
                $non_shipping_total += $row_qitem_tmp["qty"] * $row_qitem_tmp["uprice"];
            }
        }
        $apply_zero_comm = ($non_shipping_total < 800);

        foreach ($a_qitem as $tmp_key => $row_qitem) {

            $pro_id = $row_qitem["pro_id"];
            $qty = $row_qitem["qty"];
            $uprice = $row_qitem["uprice"];
            $comm_percent = $row_qitem["comm_percent"];
            $comm_value = "";
            $tmp_comm_percent = 0;
            if ($comm_percent != "" && !$apply_zero_comm) {
                $tmp_comm_percent = intval(str_replace("%", "", $comm_percent));
                $comm_value = ($qty * $uprice) * ($tmp_comm_percent / 100);
                $comm_total += $comm_value;
            }

            $tmp_amount = $qty * $uprice;

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

            if ($action_from == "vc" || $action_from == "vp") {

                if( $user_group=="1" || $user_group=="99" ){

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
					$return_html .= '<input type="hidden" value="' . htmlspecialchars($row_qitem["pro_name"]) . '" class="comm_pro_name" data-qdoci="' . $row_qitem["qdoci_id"] . '">';
					$return_html .= '<input type="hidden" value="' . $tmp_comm_percent . '" class="comm_item_percent" data-qdoci="' . $row_qitem["qdoci_id"] . '">';
					$is_shipping = (stripos($row_qitem["pro_name"], "shipping") !== false);
					$is_excluded = ($is_shipping || stripos($row_qitem["pro_name"], "royalty") !== false || stripos($row_qitem["pro_name"], "credit card") !== false || stripos($row_qitem["pro_name"], "namebar") !== false || stripos($row_qitem["pro_name"], "patches") !== false);
					$checked_attr = $is_excluded ? '' : ' checked';
					$return_html .= '<div style="margin-bottom:4px;"><input type="checkbox" class="comm_item_checkbox" data-qdoci="' . $row_qitem["qdoci_id"] . '" data-amount="' . $tmp_amount . '" data-proname="' . htmlspecialchars($row_qitem["pro_name"]) . '" data-commpercent="' . $tmp_comm_percent . '" data-shipping="' . ($is_shipping ? '1' : '0') . '" value="1"' . $checked_attr . ' onchange="recalcCommTotal();"></div>';
					$return_html .= '<spen id="split" class="splitform ' . $splitclass . '" onclick="return formsplit(' . $row_qitem["qdoci_id"] . ');"><i class="fa fa-exchange" aria-hidden="true"></i> Split </spen>
					<div class="formsplit" id="formsplite' . $row_qitem["qdoci_id"] . '" style="display:none;">
						<form class="form__submit" action="form.php" method="post">
							<div class="grid2" >
								<select name="sales_rep_1' . $row_qitem["qdoci_id"] . '" style="width:100%; min-width:80px; height: 28px; text-align:center; padding: 0 5px 0 6px; margin:0; font-size:12px">';
                            $return_html .= '<option value = "" >==Select Sales Rep==</option>';
						foreach ($sales_user as $user) {
							$selected = ($row_qitem["split_sales_1"] == $user['fullname']) ? ' selected' : '';
							$return_html .= '<option value="' . htmlspecialchars($user['fullname']) . '"' . $selected . '>' . htmlspecialchars($user['fullname']) . '</option>';
						}

						$return_html .= '</select>
										<input name="split_comm_percent_1' . $row_qitem["qdoci_id"] . '" value="' . $row_qitem["split_comm_1"] . '" style="width:50px; height: 28px; text-align:center;font-size:12px;" min="0" type="number">
									</div>
									<div class="grid2">
										<select name="sales_rep_2' . $row_qitem["qdoci_id"] . '" style="width:100%; min-width:80px; height: 28px; text-align:center; padding: 0 5px 0 6px; margin:0; font-size:12px">';
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
					$return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app' . $row_qitem["qdoci_id"] . '">'.(($tmp_comm_percent!=0)?($tmp_comm_percent."%"):"0%").'</td>';
				}

                // $return_html .= '<td style="text-align:center; color:#999;">' . (($tmp_comm_percent != 0) ? ($tmp_comm_percent . "%") : "0%");



                // $return_html .= '</td>';
                $return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app' . $row_qitem["qdoci_id"] . '">' . (($comm_value != "") ? number_format($comm_value, 2) : "0") . '</td>';
            } else if ($action_from == "va") {

                $return_html .= '<td style="text-align:center; color:#999;"><input type="hidden" value="' . $row_qitem["qdoci_id"] . '" class="qdoci_id_app">';
                $return_html .= '<input type="hidden" value="' . $tmp_amount . '" id="tmp_amount' . $row_qitem["qdoci_id"] . '">';
                $return_html .= '<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width:60px; text-align:center;" min="0" type="number" value="' . $tmp_comm_percent . '" id="comm_percent_app' . $row_qitem["qdoci_id"] . '"></td>';
                $return_html .= '<td style="text-align:center; color:#999;" id="comm_val_app' . $row_qitem["qdoci_id"] . '">' . (($comm_value != "") ? number_format($comm_value, 2) : "") . '</td>';
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
                    $return_html .= "<tr><th>Design URL</th></tr>";
                    $return_html .= "<tr><td class='alert alert-success'><a style='color:white;' href=" . $row_quote["design_url"] . ">" . $row_quote["design_url"] . "</a></td></tr>";
                }

                $return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Change Currency:</th><td style="padding: 10px 0px; text-align:right;"><span>' . $select_html . '</span></td></tr>';

                $return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="discount_percent" class="number_disc_approval" value="' . $row_quote['discount_percent'] . '" style="width:55px;"></span></td></tr>';

                $return_html .= '<tr><td colspan="2"></td><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span><input type="text" name="actual_discount" id="actual_disc_approval" value="' . $row_quote['actual_discount'] . '" style="width:55px;"></span></td></tr>';
            }

            $return_html .= "<input type='hidden' id='tr_total' value='0'>";

            if ($action_from == "vp" && $row_quote['actual_discount'] != "0") {
                $return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Discount(%):</th><td style="padding: 10px 0px; text-align:right;"><span>' . $row_quote['discount_percent'] . '%</span></td></tr>';

                $return_html .= '<tr><td style="padding: 10px 0px; text-align:center; color:#999; font-weight:bold;"></td><td>&nbsp;</td><th style="padding: 10px 0px; text-align:right;">Actual Discount:</th><td style="padding: 10px 0px; text-align:right;"><span>' . $pre_cost . number_format($row_quote['actual_discount'], 2) . '</span></td></tr>';
            }


            $return_html .= '<tr ><td rowspan="3" colspan="' . $col_span2 . '">';
            if ($row_quote["sale_note"] != "" && ($action_from == "va" || $action_from == "vb")) {
                $return_html .= 'Salesman Notes (<font color=red>Not shown in Quotation</font>)';
                if ($action_from == "vb") {
                    $return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_edit_sale_note" style="background-color:#DDD;" onclick="return editSaleNote(' . $qdoc_id . ');"><i class="fa fa-pencil" style="color:#00F;"></i> Edit</button>';
                    $return_html .= '&nbsp;&nbsp;&nbsp;<button type="button" id="btn_save_sale_note" style="background-color:#FFF;" disabled onclick="return saveSaleNote(' . $qdoc_id . ');"><i class="fa fa-floppy-o" style="color:#070;"></i> Save</button>';
                }

                $return_html .= '<br><pre class="alert alert-success" style="width:100%; height:100%; max-width:700px; overflow-x:auto;" id="pre_sale_note' . $qdoc_id . '">' . $row_quote["sale_note"] . '</pre>';
            } else {
                $return_html .= '&nbsp;';
            }

            if ($action_from == "va") {
                $return_html .= 'Comment (<font color=red>Not shown in Quotation and appear on the top after Approve or Reject.</font>)';
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

        // Hidden fields for commission processing
        $return_html .= '<input type="hidden" id="quote_sales_name" value="' . htmlspecialchars($fullname_sales) . '">';
        $return_html .= '<input type="hidden" id="quote_jog_code" value="' . htmlspecialchars($jog_code_main) . '">';
        $return_html .= '<input type="hidden" id="quote_currency" value="' . htmlspecialchars($row_quote["quote_curr"]) . '">';
        $return_html .= '<input type="hidden" id="quote_grand_total" value="' . $f_total . '">';
        $return_html .= '<input type="hidden" id="quote_est_number" value="' . htmlspecialchars($row_quote["est_number"]) . '">';
        $return_html .= '<input type="hidden" id="quote_qdoc_id" value="' . $qdoc_id . '">';

        // Extra hidden fields from tbl_order for the commission page URL
        $sql_ord = "SELECT `year`, `month`, `Inv_no`, `Invlink`, `Order_Name`, `Percentage_1`, `Percentage_2`, `Sales_Rep_2`
                    FROM `tbl_order`
                    WHERE `JOG_Code` = '" . addslashes($jog_code_main) . "'
                    LIMIT 1";
        $a_ord = Yii::app()->db->createCommand($sql_ord)->queryAll();
        $row_ord = !empty($a_ord) ? $a_ord[0] : array();
        $return_html .= '<input type="hidden" id="quote_year" value="' . htmlspecialchars(isset($row_ord['year']) ? $row_ord['year'] : '') . '">';
        $return_html .= '<input type="hidden" id="quote_month" value="' . htmlspecialchars(isset($row_ord['month']) ? $row_ord['month'] : '') . '">';
        $return_html .= '<input type="hidden" id="quote_invno" value="' . htmlspecialchars(isset($row_ord['Inv_no']) ? $row_ord['Inv_no'] : '') . '">';
        $return_html .= '<input type="hidden" id="quote_invlnk" value="' . htmlspecialchars(isset($row_ord['Invlink']) ? $row_ord['Invlink'] : '') . '">';
        $return_html .= '<input type="hidden" id="quote_ordname" value="' . htmlspecialchars(isset($row_ord['Order_Name']) ? $row_ord['Order_Name'] : '') . '">';
        $return_html .= '<input type="hidden" id="quote_per" value="' . htmlspecialchars(isset($row_ord['Percentage_1']) ? $row_ord['Percentage_1'] : '') . '">';
        $return_html .= '<input type="hidden" id="quote_per2" value="' . htmlspecialchars(isset($row_ord['Percentage_2']) ? $row_ord['Percentage_2'] : '') . '">';
        $return_html .= '<input type="hidden" id="quote_sales2" value="' . htmlspecialchars(isset($row_ord['Sales_Rep_2']) ? $row_ord['Sales_Rep_2'] : '') . '">';

        if ($action_from != "va" && $row_quote["note"] != "") {
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

        if ($action_from == "va") {
            $a_result["show_approve"] = "yes";
            $a_result["show_reject"] = "yes";
            $a_result["show_print"] = "yes";
        }

        $a_result['note_text'] = $row_quote["note"];

        echo json_encode($a_result);
    }

    public function actionExportExcel()
    {
        $month = $_POST['year_month'];
        $years = $_POST['year_date'];
        $conditions = array();
        if(isset($_POST['ex'])){
            $conditions[] = "`typeofcode` = 'Ex'";
        }
        
        if(isset($_POST['th'])){
            $conditions[] = "`typeofcode` = 'Th'";
        }
        
        if(isset($_POST['noquote'])){
            $conditions[] = "`No_Quote` = '1'";
        }
        
        if(isset($_POST['qb'])){
            $conditions[] = "`QB_Draft` = '1'";
        }

        
        $sql = "SELECT * FROM `tbl_order` WHERE `month` = '$month'";
        if (!empty($conditions)) {
            $sql .= " AND " . implode(' AND ', $conditions);
        }

        $result = Yii::app()->db->createCommand($sql)->queryAll();

        // echo "<pre>";
        // print_r($result);
        // die;

        require_once(Yii::app()->basePath . '/vendors/PHPExcel/Classes/PHPExcel.php');

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set properties
        $objPHPExcel->getProperties()->setCreator("Your Name")
            ->setLastModifiedBy("Your Name")
            ->setTitle("Orders list")
            ->setSubject("Order list")
            ->setDescription("Orders list")
            ->setKeywords("Orders list");

        // Set worksheet title
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Order');

        // Set column headers
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'JOG Code');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'No Quote');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'QB Draft');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Order Name');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Inv no');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Sales Rep 1');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Percentage 1');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Sales Rep 2');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Percentage 2');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Invlink');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Year');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Type of Code');
        $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Notes');
        $objPHPExcel->getActiveSheet()->setCellValue('N1', 'approve');

        // Add more columns as needed

        // Populate data
        $row = 2;
        foreach ($result as $row_data) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $row_data['JOG_Code']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $row_data['No_Quote']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $row_data['QB_Draft']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $row_data['Order_Name']);
            //$objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $row_data['Inv_no']);
            $objPHPExcel->getActiveSheet()->getCell('E' . $row)->setValue($row_data['Inv_no']);
            //$objPHPExcel->getActiveSheet()->getCell('E' . $row)->getHyperlink()->setUrl($row_data['Invlink']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $row_data['Sales_Rep_1']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $row_data['Percentage_1']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $row_data['Sales_Rep_2']);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $row_data['Percentage_2']);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $row_data['Invlink']);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, $row_data['year']);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $row_data['typeofcode']);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, $row_data['Remark']);
            $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, $row_data['approve']);
            // Add more cell assignments for other columns

            $row++;
        }

        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '89939c')
                ),
                'font' => array(
                    'color' => array('rgb' => 'ffff'),
                )
            )
        );

        // Set header for Excel file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="JOG_Code__'.$years.'' . "$month" . '.xlsx"');
        header('Cache-Control: max-age=0');

        // Save Excel file to PHP output
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    public function actionExportCSV()
    {
        $month = $_POST['excelex'];
        $years = date('Y');
        $sql = "SELECT * FROM `tbl_order` WHERE `month` = '$month'";

        $result = Yii::app()->db->createCommand($sql)->queryAll();

        // Set CSV content-type header
        header('Content-Type: text/csv');
        // Set content-disposition header to force download
        header('Content-Disposition: attachment;filename="JOG_Code_'.$years.'' . $month . '.csv"');

        // Open output stream
        $output = fopen('php://output', 'w');

        // Write CSV column headers
        fputcsv($output, array(
            'JOG Code',
            'No Quote',
            'QB Draft',
            'Order Name',
            'Inv no',
            'Sales Rep 1',
            'Percentage 1',
            'Sales Rep 2',
            'Percentage 2',
            'Invlink',
            'Year',
            'Type of Code',
            'Notes',
            'approve'
            // Add more columns as needed
        ));

        // Write data rows
        foreach ($result as $row_data) {
            fputcsv($output, array(
                $row_data['JOG_Code'],
                $row_data['No_Quote'],
                $row_data['QB_Draft'],
                $row_data['Order_Name'],
                $row_data['Inv_no'],
                $row_data['Sales_Rep_1'],
                $row_data['Percentage_1'],
                $row_data['Sales_Rep_2'],
                $row_data['Percentage_2'],
                $row_data['Invlink'],
                $row_data['year'],
                $row_data['typeofcode'],
                $row_data['Remark'],
                $row_data['approve']
                // Add more columns as needed
            ));
        }

        // Close output stream
        fclose($output);
        // Terminate script
        Yii::app()->end();
    }


    public function actionExportPDF()
    {
        $month = $_POST['month'];
        //$month = 'January';

        $sql = "SELECT * FROM `tbl_order` WHERE `month` = '$month'";

        $result = Yii::app()->db->createCommand($sql)->queryAll();

        // Check if $result is an array
        if (is_array($result) && !empty($result)) {

            $html = '<h1>Orders List</h1>';
            $html .= "<table border='1'>";
            $html .= '<tr><th>JOG Code</th><th>No Quote</th><th>QB Draft</th><th>Order Name</th><th>Inv no</th><th>Sales Rep 1</th><th>Percentage 1</th><th>Sales Rep 2</th><th>Percentage 2</th><th>Invlink</th><th>Year</th><th>Type of Code</th><th>Notes</th><th>approve</th></tr>';
            foreach ($result as $row_data) {

                $invno = preg_replace('/\s+/', ' ', $row_data['Inv_no']);

                $cleanInvNo = preg_replace('/[^\w\s]/', '', $invno);

                $html .= '<tr>';
                $html .= '<td>' . $row_data['JOG_Code'] . '</td>';
                $html .= '<td>' . $row_data['No_Quote'] . '</td>';
                $html .= '<td>' . $row_data['QB_Draft'] . '</td>';
                $html .= '<td>' . $row_data['Order_Name'] . '</td>';
                $html .= '<td>' . $cleanInvNo . '</td>';
                $html .= '<td>' . $row_data['Sales_Rep_1'] . '</td>';
                $html .= '<td>' . $row_data['Percentage_1'] . '</td>';
                $html .= '<td>' . $row_data['Sales_Rep_2'] . '</td>';
                $html .= '<td>' . $row_data['Percentage_2'] . '</td>';
                $html .= '<td>' . $row_data['Invlink'] . '</td>';
                $html .= '<td>' . $row_data['year'] . '</td>';
                $html .= '<td>' . $row_data['typeofcode'] . '</td>';
                $html .= '<td>' . $row_data['Remark'] . '</td>';
                $html .= '<td>' . $row_data['approve'] . '</td>';
                $html .= '</tr>';
            }
            $html .= '</table>';
            echo $html;
        } else {
            // Handle the case where $result is empty or not an array
            echo "No data found or an error occurred.";
        }
    }

    public function actionExportCopy()
    {
        $month = $_POST['month'];

        $sql = "SELECT * FROM `tbl_order` WHERE `month` = '$month'";

        $result = Yii::app()->db->createCommand($sql)->queryAll();

        // Check if $result is an array
        if (is_array($result) && !empty($result)) {

            $html = ' JOG Code  No Quote  QB Draft Order Name Inv no Sales Rep 1 Percentage 1 Sales Rep 2 Percentage 2 Invlink Year Type of Code Notes approve ';
            foreach ($result as $row_data) {

                $invno = preg_replace('/\s+/', ' ', $row_data['Inv_no']);

                $cleanInvNo = preg_replace('/[^\w\s]/', '', $invno);

                $html .= ' ';
                $html .= ' ' . $row_data['JOG_Code'] . ' ';
                $html .= ' ' . $row_data['No_Quote'] . ' ';
                $html .= ' ' . $row_data['QB_Draft'] . ' ';
                $html .= ' ' . $row_data['Order_Name'] . ' ';
                $html .= ' ' . $cleanInvNo . ' ';
                $html .= ' ' . $row_data['Sales_Rep_1'] . ' ';
                $html .= ' ' . $row_data['Percentage_1'] . ' ';
                $html .= ' ' . $row_data['Sales_Rep_2'] . ' ';
                $html .= ' ' . $row_data['Percentage_2'] . ' ';
                $html .= ' ' . $row_data['Invlink'] . ' ';
                $html .= ' ' . $row_data['year'] . ' ';
                $html .= ' ' . $row_data['typeofcode'] . ' ';
                $html .= ' ' . $row_data['Remark'] . ' ';
                $html .= ' ' . $row_data['approve'] . ' ';
                $html .= ' ';
            }
            echo $html;
        } else {
            // Handle the case where $result is empty or not an array
            echo "No data found or an error occurred.";
        }
    }

    public function actionGetCovtoqoujog()
    {
        $jogarry= array();
        $salesrep = $_POST['salesReP'];
        $sql = "SELECT o.`JOG_code`
        FROM `tbl_order` o
        WHERE (o.`sales_rep_1` LIKE '%$salesrep%' OR o.`sales_rep_2` LIKE '%$salesrep%')
        AND o.`No_Quote` = 0
        AND (COALESCE(o.`sales_rep_1`, '') NOT REGEXP 'ONLINE|SAMPLE|FREE|REMAKE|CANCEL')
        AND (COALESCE(o.`sales_rep_2`, '') NOT REGEXP 'ONLINE|SAMPLE|FREE|REMAKE|CANCEL')";



        $orders = Yii::app()->db->createCommand($sql)->queryAll();
        
        foreach ($orders as $key => $order) {  

            $qdoci_status = $this->FindQdocsendnot($order['JOG_code']);
            if ($qdoci_status == 0) {
                $jogarry[] = $order['JOG_code'];
            }
        }

        $html= '';
        $html .= '<div class="row">';
        foreach ($jogarry as $key => $jogarr) {
            $html .= '<div class="col-md-3 dflex jogcheckCol">';
                $html .= '<input type="checkbox" checked style="margin-top:0;">';
                $html .= '<h6> ' .$jogarr. '</h6>';
            $html .= '</div>';
        }
        $html .= '<div>';                
        
        print_r($html);
        die;
           
    }

    public function FindQdocsendnot($jog_code_main)
    {
        $jc = $jog_code_main;
        $prefix = preg_replace('/[A-Za-z]+$/', '', $jc);

        $sqlqid = "SELECT * FROM `quotation_data` WHERE `jog_code` LIKE '$prefix%'";
        $getqid = Yii::app()->db->createCommand($sqlqid)->queryAll();

        if (empty($getqid[0]['qdoci_id'])) {
            return 0;
        } else {
            return  1;
        }
    }

    public function actionFindQdocId()
    {
        $jc = $_POST['jog_code_main'];
        $prefix = preg_replace('/[A-Za-z]+$/', '', $jc);

        $sqlqid = "SELECT * FROM `quotation_data` WHERE `jog_code` LIKE '%$prefix%'";
        $getqid = Yii::app()->db->createCommand($sqlqid)->queryAll();



        if (empty($getqid[0]['qdoci_id'])) {
            echo 0;
        } else {
            echo  $getqid[0]['qdoci_id'];;
        }
    }

    public function actionDeleteAdminComments()
    {
        $user_id    = Yii::app()->user->getState('userKey');
        $user_group = Yii::app()->user->getState('userGroup');
        $conv_id    = (int) $_POST['conv_id']; // secure casting

        if ($user_group == '1' || $user_group == '99') { 

            // 1. Clear remark first
            $sql = "UPDATE tbl_order 
                    SET Remark = '', Remark_by = '$user_id' 
                    WHERE id = '$conv_id'";
            Yii::app()->db->createCommand($sql)->execute();

            // 2. Check if comments exist for this order
            $checkSql = "SELECT COUNT(*) FROM tbl_order_comments WHERE order_id = '$conv_id'";
            $count = Yii::app()->db->createCommand($checkSql)->queryScalar();

            // 3. If NO comments found → clear Remark_by
            if ($count == 0) {
                $clearSql = "UPDATE tbl_order 
                            SET Remark_by = '' 
                            WHERE id = '$conv_id'";
                Yii::app()->db->createCommand($clearSql)->execute();
            }

            die(json_encode([
                'status' => 1,
                'ord_id' => $conv_id,
                'comments_found' => $count
            ]));
        }
    }

    public function actionDeleteOrderComments()
    {
        $user_id    = Yii::app()->user->getState('userKey');
        $user_group = Yii::app()->user->getState('userGroup');
        $conv_id    = (int) $_POST['conv_id']; // this is comment ID

        if ($user_group == '1' || $user_group == '99') { 

            // ✅ 1. Get order_id BEFORE deleting
            $orderSql = "SELECT order_id FROM tbl_order_comments WHERE id = '$conv_id'";
            $order_id = Yii::app()->db->createCommand($orderSql)->queryScalar();

            // ✅ 2. Delete the comment
            $delSql = "DELETE FROM tbl_order_comments WHERE id = '$conv_id'";
            Yii::app()->db->createCommand($delSql)->execute();

            // ✅ 3. Check if any comments remain for this order
            $countSql = "SELECT COUNT(*) FROM tbl_order_comments WHERE order_id = '$order_id'";
            $count = Yii::app()->db->createCommand($countSql)->queryScalar();

            // ✅ 4. Check if Remark is empty
            $remarkSql = "SELECT Remark FROM tbl_order WHERE id = '$order_id'";
            $remark = Yii::app()->db->createCommand($remarkSql)->queryScalar();

            // ✅ 5. If NO comments left AND Remark is empty → clear Remark_by
            if ($count == 0 && trim($remark) == '') {
                $clearSql = "UPDATE tbl_order SET Remark_by = '' WHERE id = '$order_id'";
                Yii::app()->db->createCommand($clearSql)->execute();
            }

            die(json_encode([
                'status' => 1,
                'ord_id' => $conv_id,
                'comments_left' => $count
            ]));
        }
    }

    public function actionFetchComments()
    {
        $user_id = Yii::app()->user->getState('userKey');
        $user_group = Yii::app()->user->getState('userGroup');
        $conv_id = $_POST['conv_id'];

        $sql = "SELECT * FROM `tbl_order` WHERE id='$conv_id'";
        $data = Yii::app()->db->createCommand($sql)->queryAll();;
        if (count($data) > 0) {
            $note = $data[0]['Remark_by'];
            if (!empty($note)) {
                $is_avail = 1;
            }else {
               $is_avail = 0;
            }
        }else{
            $is_avail = 0;
        }

        if ($user_group == '1' || $user_group == '99') { 
            $sql = "SELECT * FROM `tbl_order` WHERE id='$conv_id'";
            $data = Yii::app()->db->createCommand($sql)->queryAll();;
            if (count($data) > 0) {
                $note = $data[0]['Remark'];
                $jog_code = $data[0]['JOG_Code'];
                $id = $data[0]['id'];
                $dltord= '<span class="btn btn-secondary"  onclick="OrderRemarkDlt('.$id.')"> <i class="fa fa-trash-o" aria-hidden="true"></i> </span>';
                die(json_encode(array('status' => 1, 'msg' => $note, 'is_avail' => $is_avail, 'jog_code' => $jog_code, 'order_id' => $dltord )));
            } else {
                die(json_encode(array('status' => 0)));
            }
        }else{
            $sql = "SELECT * FROM `tbl_order` WHERE id='$conv_id' AND Remark_by = '$user_id'";
            $data = Yii::app()->db->createCommand($sql)->queryAll();;
            if (count($data) > 0) {
                $note = $data[0]['Remark'];
                $jog_code = $data[0]['JOG_Code'];
                die(json_encode(array('status' => 1, 'msg' => $note,'is_avail' => $is_avail, 'jog_code' => $jog_code,'order_id' => '' )));
            }else {
                $note = $data[0]['Remark'];
                $jog_code = $data[0]['JOG_Code'];
                die(json_encode(array('status' => 1, 'msg' => '', 'is_avail' => $is_avail, 'jog_code' => '','order_id' => '')));
            }
        }        
    }

    public function actionfetchChats()
    {
        $conv_id = $_POST['conv_id'];
        $user_group = Yii::app()->user->getState('userGroup');
        $user_id = Yii::app()->user->getState('userKey');
        $string = "";
        if ($user_group == '1' || $user_group == '99') {            
            $sql = "SELECT * FROM tbl_order_comments WHERE order_id='$conv_id' ORDER BY add_time ASC";
        }else {
            $sql = "SELECT * FROM tbl_order_comments WHERE order_id='$conv_id' AND  user_id = '$user_id' ORDER BY add_time ASC";
        }
        $a_qitem = Yii::app()->db->createCommand($sql)->queryAll();
        if (count($a_qitem) == 0) {
            die(json_encode(array('status' => '0')));
        } else {
            $style = "text-align:right";        
            foreach ($a_qitem as $tmp_key => $row_qitem) {
                if ($row_qitem["user_id"] == $user_id) {
                    $style = "text-align:right !important";
                } else {
                    $style = "text-align:left";
                }
                if ($row_qitem["user_id"] == "28") {

                    $full_name = "Administrator";
                } elseif ($row_qitem["user_id"] == "2") {

                    $full_name = "Mirza";
                } elseif ($row_qitem["user_id"] == "79") {
                    $full_name = "Note Nareerats";
                } elseif ($row_qitem["user_id"] == "40") {
                    $full_name = "Scott Whitcomb";
                } else {
                    $user = User::model()->findByPk($row_qitem["user_id"]);        
                    $full_name = $user->fullname;                    
                }
                $id =  $row_qitem["id"];
                $dltord= '<span class="btn btn-secondary"  onclick="OrderCommentsDlt('.$id .')"> <i class="fa fa-trash-o" aria-hidden="true"></i> </span>';
                $string .= '<div id="removeCom'.$id .'"><center> <pre class="alert" style="' . $style . '; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;display: flex;justify-content: space-between;align-items: center;gap: 10px;">'.$dltord.' ' . $full_name . '@' . date("M d, Y H:i:s", strtotime($row_qitem["add_time"])) . ' comments "' . $row_qitem["message_long"] . '"</pre></center></div>';
            }
            die(json_encode(array('status' => '1', 'msg' => base64_encode($string))));
        }
    }

    public function actionSubmitNoteAdmin()
    {
        $user_id = Yii::app()->user->getState('userKey');
        $name_user = "Scott Whitcomb";
        $send_email = "Nam@jogsportswear.com";
        if ($user_id != 40) {
            $name_user = "Administrator";
            $send_email = "swhitcomb@jogsports.com";
        }

        if ($user_id == 2) {
            $name_user = "Mirza";
        }

        if ($user_id == 79) {
            $name_user = "Note Nareerats";
        }

        $is_avail = $_POST['is_avail'];
        $conv_id = $_POST['conv_id'];
        $insertId = '';
        $admin_comments = addslashes($_POST['admin_comments']);
        $jog_code = $_POST['jog_code'];
        if ($is_avail == 0) {
            $sql = "UPDATE tbl_order SET Remark='$admin_comments', Remark_by ='$user_id' WHERE id='$conv_id'";
            Yii::app()->db->createCommand($sql)->execute();
            $insertId = $jog_code; 
        } else {
            $ins = "INSERT INTO `tbl_order_comments`(`order_id`, `user_id`, `message_long`) VALUES ('$conv_id','$user_id','$admin_comments')";
            Yii::app()->db->createCommand($ins)->execute();
            $insertId = Yii::app()->db->getLastInsertID();
        }
        // $bs_url = Yii::app()->request->getBaseUrl(true);
        // $url = $bs_url . "/order/list";
        // $template3 = '<!DOCTYPE html>
        //             <html>

        //             <head>
        //                 <title></title>
        //                 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        //                 <meta name="viewport" content="width=device-width, initial-scale=1">
        //                 <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        //                 <style type="text/css">
        //                     @media screen {
        //                         @font-face {
        //                             font-family: "Lato";
        //                             font-style: normal;
        //                             font-weight: 400;
        //                             src: local("Lato Regular"), local("Lato-Regular"), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format("woff");
        //                         }

        //                         @font-face {
        //                             font-family: "Lato";
        //                             font-style: normal;
        //                             font-weight: 700;
        //                             src: local("Lato Bold"), local("Lato-Bold"), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format("woff");
        //                         }

        //                         @font-face {
        //                             font-family: "Lato";
        //                             font-style: italic;
        //                             font-weight: 400;
        //                             src: local("Lato Italic"), local("Lato-Italic"), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format("woff");
        //                         }

        //                         @font-face {
        //                             font-family: "Lato";
        //                             font-style: italic;
        //                             font-weight: 700;
        //                             src: local("Lato Bold Italic"), local("Lato-BoldItalic"), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format("woff");
        //                         }
        //                     }

        //                     /* CLIENT-SPECIFIC STYLES */
        //                     body,
        //                     table,
        //                     td,
        //                     a {
        //                         -webkit-text-size-adjust: 100%;
        //                         -ms-text-size-adjust: 100%;
        //                     }

        //                     table,
        //                     td {
        //                         mso-table-lspace: 0pt;
        //                         mso-table-rspace: 0pt;
        //                     }

        //                     img {
        //                         -ms-interpolation-mode: bicubic;
        //                     }

        //                     /* RESET STYLES */
        //                     img {
        //                         border: 0;
        //                         height: auto;
        //                         line-height: 100%;
        //                         outline: none;
        //                         text-decoration: none;
        //                     }

        //                     table {
        //                         border-collapse: collapse !important;
        //                     }

        //                     body {
        //                         height: 100% !important;
        //                         margin: 0 !important;
        //                         padding: 0 !important;
        //                         width: 100% !important;
        //                     }

        //                     /* iOS BLUE LINKS */
        //                     a[x-apple-data-detectors] {
        //                         color: inherit !important;
        //                         text-decoration: none !important;
        //                         font-size: inherit !important;
        //                         font-family: inherit !important;
        //                         font-weight: inherit !important;
        //                         line-height: inherit !important;
        //                     }

        //                     /* MOBILE STYLES */
        //                     @media screen and (max-width:600px) {
        //                         h1 {
        //                             font-size: 32px !important;
        //                             line-height: 32px !important;
        //                         }
        //                     }

        //                     /* ANDROID CENTER FIX */
        //                     div[style*="margin: 16px 0;"] {
        //                         margin: 0 !important;
        //                     }
        //                 </style>
        //             </head>

        //             <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
        //                 <!-- HIDDEN PREHEADER TEXT -->
        //                 <table border="0" cellpadding="0" cellspacing="0" width="100%">
        //                     <!-- LOGO -->
        //                     <tr>
        //                         <td bgcolor="#000000" align="center">
        //                             <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
        //                                 <tr>
        //                                     <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
        //                                 </tr>
        //                             </table>
        //                         </td>
        //                     </tr>
        //                     <tr>
        //                         <td bgcolor="#000000" align="center" style="padding: 0px 10px 0px 10px;">
        //                             <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
        //                                 <tr>
        //                                     <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
        //                                         <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome!</h1> <img src="https://online.jog-joinourgame.com/assets/images/logo.png" width="125" height="120" style="display: block; border: 0px;" />
        //                                     </td>
        //                                 </tr>
        //                             </table>
        //                         </td>
        //                     </tr>
        //                     <tr>
        //                         <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
        //                             <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
        //                                 <tr>
        //                                     <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 40px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
        //                                         <p style="margin: 0;">You have a comment - <br> <b>"' . $admin_comments . '"</b> <br> from ' . $name_user . ' on Quotation with JOG CODE - ' . $jog_code . ' Continue clicking on the button below and search for the mentioned JOG CODE.</p>
        //                                     </td>
        //                                 </tr>
        //                                 <tr>
        //                                     <td bgcolor="#ffffff" align="center">
        //                                         <table width="100%" border="0" cellspacing="0" cellpadding="0">
        //                                             <tr>
        //                                                 <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
        //                                                     <table border="0" cellspacing="0" cellpadding="0">
        //                                                         <tr>
        //                                                             <td align="center" style="border-radius: 3px;" bgcolor="#000000"><a href="' . $url . '" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #000000; display: inline-block;">Continue</a></td>
        //                                                         </tr>
        //                                                     </table>
        //                                                 </td>
        //                                             </tr>
        //                                         </table>
        //                                     </td>
        //                                 </tr> <!-- COPY -->
        //                                 <tr>
        //                                     <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
        //                                         <p style="margin: 0;">If that doesnt work, copy and paste the following link in your browser:</p>
        //                                     </td>
        //                                 </tr> <!-- COPY -->
        //                                 <tr>
        //                                     <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
        //                                         <p style="margin: 0;"><a href="' . $url . '" target="_blank" style="color: #000000;">' . $url . '</a></p>
        //                                     </td>
        //                                 </tr>
        //                                 <tr>
        //                                     <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
        //                                         <p style="margin: 0;">Cheers,<br>JOG Team</p>
        //                                     </td>
        //                                 </tr>
        //                             </table>
        //                         </td>
        //                     </tr>
        //                     <tr>
        //                         <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
        //                             <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
        //                                 <tr>
        //                                     <td bgcolor="#000000" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
        //                                         <h2 style="font-size: 20px; font-weight: 400; color: #FFFFFF; margin: 0;">Need more help?</h2>
        //                                         <p style="margin: 0;"><a href="https://jogsportswear.com" target="_blank" style="color: #FFFFFF;">We&rsquo;re here to help you out</a></p>
        //                                     </td>
        //                                 </tr>
        //                             </table>
        //                         </td>
        //                     </tr>
        //                 </table>
        //             </body>

        //             </html>';

        // $mail = Yii::app()->Smtpmail;
        // $mail->Host = 'cvps652.serverhostgroup.com';
        // $mail->Port = 587; //465
        // $mail->CharSet = 'utf-8';
        // $mail->SMTPAuth = true;
        // $mail->SMTPSecure = 'tls';
        // $mail->Username = "no-reply@jog-joinourgame.com";
        // $mail->Password = "demo@9090";
        // $mail->SetFrom("no-reply@jog-joinourgame.com", 'JOG SPORTS | SALES REP PORTAL');
        // $mail->Subject = "Order Comments - " . $jog_code;
        // $mail->MsgHTML($template3);
        // //$mail->AddAddress($mail_customer, $mail_customername);
        // $mail->addBcc("ravish@jogsportswear.com");
        // $mail->AddAddress($send_email);

        // if (!$mail->Send()) {
        //     //echo $mail->ErrorInfo;
        // } else {
        //     //echo "working";
        //     //Yii::app()->user->setFlash('success', 'Message Already sent!');
        // }
        // $mail->ClearAddresses();
        die(json_encode(array('status' => 1, 'comment' => base64_encode($admin_comments), 'order_id' => $insertId)));
    }

    public function actioninsertsortrow()
    {
        if (isset($_POST['jCode'])) {
            $jCode = $_POST['jCode'];
            $dir = $_POST['dir'];
            $sortrowid = $_POST['sortrowid'];
            $nQuoteValue = isset($_POST['nQuote']) ? 1 : 0;
            $qDraftValue = isset($_POST['qDraft']) ? 1 : 0;

            // Determine the new sortrow value
            if ($dir == 'up') {
                $newSortrow = $sortrowid;
            } else {
                $newSortrow = $sortrowid + 1;
            }

            // Update the sortrow values of existing rows to make room for the new row
            $updateSql = "UPDATE `tbl_order` SET `sortrow` = `sortrow` + 1 WHERE `sortrow` >= :newSortrow";
            $command = Yii::app()->db->createCommand($updateSql);
            $command->bindParam(':newSortrow', $newSortrow, PDO::PARAM_INT);
            $command->execute();

            // Construct the SQL query for insertion    
            $sql = "INSERT INTO `tbl_order` (`JOG_Code`, `No_Quote`, `QB_Draft`, `Order_Name`, `Inv_no`, `Sales_Rep_1`, `Percentage_1`, `Sales_Rep_2`, `Percentage_2`, `Remark`, `month`, `year`, `Invlink`, `typeofcode`, `sortrow`) VALUES (";
            $sql .= "'" . $jCode . "', ";
            $sql .= "'" . $nQuoteValue . "', ";
            $sql .= "'" . $qDraftValue . "', ";
            $sql .= "'" . addslashes($_POST['orderName']). "', ";
            $sql .= "'" . $_POST['invNo'] . "', ";
            $sql .= "'" . $_POST['sRep1'] . "', ";
            $sql .= "'" . $_POST['percentage1'] . "', ";
            $sql .= "'" . $_POST['sRep2'] . "', ";
            $sql .= "'" . $_POST['percentage2'] . "', ";
            $sql .= "'" . $_POST['remark'] . "', ";
            $sql .= "'" . $_POST['month'] . "', ";
            $sql .= "'" . $_POST['year'] . "', ";
            $sql .= "'" . $_POST['invLinks'] . "', ";
            $sql .= "'" . $_POST['typeOfCode'] . "', ";
            $sql .= "'" . $newSortrow . "')";

            // Execute the insertion
            Yii::app()->db->createCommand($sql)->execute();

            // Prepare the response data
            $response = [
                'jCode' => $jCode,
                'nQuote' => $nQuoteValue,
                'qDraft' => $qDraftValue,
                'orderName' => $_POST['orderName'],
                'invNo' => $_POST['invNo'],
                'invLinks' => $_POST['invLinks'],
                'sRep1' => $_POST['sRep1'],
                'percentage1' => $_POST['percentage1'],
                'sRep2' => $_POST['sRep2'],
                'percentage2' => $_POST['percentage2'],
                'remark' => $_POST['remark'],
                'month' => $_POST['month'],
                'year' => $_POST['year'],
                'typeOfCode' => $_POST['typeOfCode'],
                'sortrowid' => $newSortrow,
                'dir' => $dir
            ];

            // Return the response as JSON
            echo json_encode($response);
            Yii::app()->end();
        }
    }

    public function actionGetCommissionRate()
    {
        $salesRepName = isset($_POST['sales_rep_name']) ? trim($_POST['sales_rep_name']) : '';
        $commissionRate = '';

        if (!empty($salesRepName)) {
            // Map display names (JOG/*) to actual fullnames stored in user table
            $nameMap = array(
                'JOG/KRISTY' => 'Kristy Whitcomb',
                'JOG/TRENT'  => 'Trent Whitcomb',
                'JOG/DAVE'   => 'Dave Kwant',
                'JOG/JOHN'   => 'John',
            );
            $lookupName = isset($nameMap[$salesRepName]) ? $nameMap[$salesRepName] : $salesRepName;

            $rate = Yii::app()->db->createCommand(
                "SELECT commission_type FROM `user` WHERE `fullname` = :name AND `enable` = 1 LIMIT 1"
            )->bindValue(':name', $lookupName, PDO::PARAM_STR)->queryScalar();

            if ($rate !== false && $rate !== null && $rate !== '') {
                $commissionRate = $rate;
            }
        }

        header('Content-Type: application/json');
        echo json_encode(array('commission_type' => $commissionRate));
        Yii::app()->end();
    }

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

    public function actionConvtoquote_jog_mail()
    {            
       $selse1 =  $_POST['salesReP'];
       $sql ="SELECT * FROM user WHERE fullname LIKE '%$selse1%'";
       $user = Yii::app()->db->createCommand($sql)->queryAll();
       
       $words = $_POST['jog_code'];
       $jogcode = implode(', ', array_slice($words, 0, 4)) . '';
       
       foreach ($user as $key => $value) {     
        $email= $value['email'];       
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
                                                height="120" style="display: block; border: 0px;background: #FFF;padding: 10px;" />
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
                                            <p style="font-size: 20px; margin-top: 0; padding:10px;">
                                            No quote is available in SRP for this '.$jogcode.' number,kindly add a quote for this ASAP.                                                    
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
                $mail->addBcc("ravish@jogsportswear.com");
                $mail->AddAddress($email);
                
                if (!$mail->Send()) {
                    //echo $mail->ErrorInfo;
                } else {
                    //echo "working";                    
                    //Yii::app()->user->setFlash('success', 'Message Already sent!');
                }
                
                $mail->ClearAddresses();
        }
    
        return true;
    }

    public function actionQuote_notify()
    {             
        if (!empty($_POST['Sales_Rep_1']) || $_POST['Sales_Rep_1'] != 'FREE' || $_POST['Sales_Rep_1'] != 'REMAKE' || $_POST['Sales_Rep_1'] != 'SAMPLE' || $_POST['Sales_Rep_1'] != 'CANCEL') {
            $selse1 =  $_POST['Sales_Rep_1'];
            $user = User::model()->findAllByAttributes(array('fullname' => $selse1));                
        }elseif (!empty($_POST['Sales_Rep_2']) || $_POST['Sales_Rep_1'] != 'FREE' || $_POST['Sales_Rep_1'] != 'REMAKE' || $_POST['Sales_Rep_1'] != 'SAMPLE' || $_POST['Sales_Rep_1'] != 'CANCEL') {
            $selse2 =  $_POST['Sales_Rep_2'];
            $user = User::model()->findAllByAttributes(array('fullname' => $selse2)); 
        }else {
            $user = 'USER Not found';
            return true;
        }
        foreach ($user as $key => $value) {
            $jogcode= $_POST['jogcode'];
            if ($_POST['type']=="phone") {
                
                $body = 'Please Convert To Quotation '.$jogcode.'';
                $this->sendNotification($value->id, 'Convert To Quotation', $body, 'Convert To Quotation' );

            }else{
                
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
                                                    height="120" style="display: block; border: 0px;background: #FFF;padding: 10px;" />
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
                                                <p style="font-size: 20px; margin-top: 0; padding:10px;">
                                                No quote is available in SRP for this '.$jogcode.' number,kindly add a quote for this ASAP.                                                    
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
                    $mail->Subject = "Immediate Action Needed: Approved Estimate Not Yet Quoted";
                    $mail->MsgHTML($template3);
                    //$mail->AddAddress($mail_customer, $mail_customername);
                    //$mail->addBcc("ravish@jogsportswear.com");
                    $mail->AddAddress($value->email);
                    
                    if (!$mail->Send()) {
                        //echo $mail->ErrorInfo;
                    } else {
                        //echo "working";
                        //Yii::app()->user->setFlash('success', 'Message Already sent!');
                    }
                    
                    $mail->ClearAddresses();
            }
            }
            return true;
        
    }
}
