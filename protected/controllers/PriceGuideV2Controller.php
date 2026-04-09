<?php

class PriceGuideV2Controller extends AuthController

{



	public function actionIndex()

	{



		if ((Yii::app()->user->getState('userGroup') == 7)){
			$this->redirect('priceGuideV2/designShow/product/1');
		}else{
			$this->redirect('priceGuideV2/show/product/1');
		}
	}



public function actionCopyExtraSubmitCat()
{
    $action = $_POST['action'];
    $from_prod_id = $_POST["from_prod_id"];
    $to_prod_id = $_POST["to_prod_id"];
    $from_curr_id = $_POST["from_curr_id"];
    $to_curr_id = $_POST["to_curr_id"];
    $data = json_decode($_POST['selectedData']);

    if ($action == "copy_replace") {
        $deleter = "SELECT cat_ex_id 
                    FROM category_extra_items 
                    WHERE prod_id='$to_prod_id' 
                    AND curr_id='$to_curr_id'";
        $del_data = Yii::app()->db->createCommand($deleter)->queryAll();
        foreach ($del_data as $del) {
            $del_cat_ex_id = $del['cat_ex_id'];
            $delete = "DELETE FROM category_extra_listing WHERE cat_ex_id='$del_cat_ex_id'";
            Yii::app()->db->createCommand($delete)->execute();
        }

        $del_new = "DELETE FROM category_extra_items WHERE prod_id='$to_prod_id' AND curr_id='$to_curr_id'";
        Yii::app()->db->createCommand($del_new)->execute();

        $del_final = "DELETE FROM tbl_extra WHERE prod_id='$to_prod_id' AND curr_id='$to_curr_id'";
        Yii::app()->db->createCommand($del_final)->execute();
    }

    // Fetch exchange rate once
    $sql_curr = "SELECT exchange_from_usd FROM tbl_currency WHERE curr_id='$to_curr_id'";
    $a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();
    $ex_rate = $a_curr[0]["exchange_from_usd"];

    foreach ($data as $key) {
        $cat_id = trim($key->value);
        $value = addslashes(trim($key->namer));

        // Fetch sort_no from the source category_extra_items
        $sql_sort = "SELECT sort_no FROM category_extra_items WHERE cat_ex_id='$cat_id'";
        $sort_data = Yii::app()->db->createCommand($sql_sort)->queryRow();
        $cat_sort_no = $sort_data ? $sort_data['sort_no'] : 0;

        $ins = "INSERT INTO `category_extra_items`(`cat_ex_name`, `prod_id`, `curr_id`, `sort_no`) 
                VALUES ('$value','$to_prod_id','$to_curr_id','$cat_sort_no')";
        Yii::app()->db->createCommand($ins)->execute();
        $new_cat_id = Yii::app()->db->getLastInsertID();

        $sql = "SELECT extra_id FROM category_extra_listing WHERE cat_ex_id='$cat_id'";
        $cat_data = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($cat_data as $main) {
            $extra_id = $main['extra_id'];

            // Always apply rounding with exchange rate + copy sort_no from tbl_extra
            $sql_insert  = "INSERT INTO tbl_extra (extra_name,extra_desc,curr_id,prod_id,extra_value,extra_value_1,extra_value_2,extra_value_3,sort_no) ";
            $sql_insert .= "SELECT extra_name,extra_desc,'$to_curr_id','$to_prod_id',";
            $sql_insert .= "ROUND((extra_value*$ex_rate),0),";
            $sql_insert .= "ROUND((extra_value_1*$ex_rate),0),";
            $sql_insert .= "ROUND((extra_value_2*$ex_rate),0),";
            $sql_insert .= "ROUND((extra_value_3*$ex_rate),0),";
            $sql_insert .= "sort_no ";
            $sql_insert .= "FROM tbl_extra WHERE extra_id='$extra_id'";

            Yii::app()->db->createCommand($sql_insert)->execute();
            $new_extra_id = Yii::app()->db->getLastInsertID();

            $new_cat_listing = "INSERT INTO `category_extra_listing`(`cat_ex_id`, `extra_id`) VALUES ('$new_cat_id','$new_extra_id')";
            Yii::app()->db->createCommand($new_cat_listing)->execute();
        }
    }

    die(json_encode(array('status' => 1)));
}



	public function actionFetchExtraCategory()

	{

		$prod_id = $_POST['prod_id'];

		$curr_id = $_POST['curr_id'];

// 		echo $sql = "SELECT * FROM category_extra_items WHERE prod_id='$prod_id' AND curr_id='$curr_id'";
		$sql = "SELECT DISTINCT c.*
                FROM category_extra_items c
                INNER JOIN category_extra_listing l 
                    ON c.cat_ex_id = l.cat_ex_id
                WHERE c.prod_id = '$prod_id' 
                AND c.curr_id = '$curr_id' ORDER BY c.sort_no ASC";

		$data = Yii::app()->db->createCommand($sql)->queryAll();

		if (count($data) > 0) {

			die(json_encode(array('status' => 1, 'data' => $data)));
		} else {

			die(json_encode(array('status' => 0)));
		}
	}



	public function actionFinalUpdateLink()

	{

		$link_id = $_POST['link_id'];

		$input = $_POST['input'];

		$sql = "UPDATE `tbl_item_gdrive_link` SET `gdrive_link`='$input' WHERE `gdrive_id`='$link_id'";

		Yii::app()->db->createCommand($sql)->execute();

		die(json_encode(array('status' => 1)));
	}



	public function actionQuickbookExcel()

	{



		$prod_id = $_POST['selected_product'];

		// Your SQL query

		$sql = "SELECT 

                    item_name,

                    CONCAT(item_style, ' ', item_detail, ' ', item_fabric_opt) AS sales_description

                FROM 

                    `tbl_item` 

                WHERE 

                    enable = '1' AND prod_id = '$prod_id'";



		// Execute the query

		$data = Yii::app()->db->createCommand($sql)->queryAll();



		// Load PHPExcel library

		require_once(Yii::getPathOfAlias('application.vendors.PHPExcel.Classes') . '/PHPExcel.php');



		// Create a new PHPExcel object

		$objPHPExcel = new PHPExcel();



		// Set the active sheet to the first sheet

		$objPHPExcel->setActiveSheetIndex(0);



		// Set column headers

		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Product/Service Name');

		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Sales Description');

		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'SKU');

		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Type');

		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Sales Price / Rate');

		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Income Account');

		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Purchase Description');

		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Purchase Cost');

		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Expense Account');

		$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Quantity on Hand');

		$objPHPExcel->getActiveSheet()->setCellValue('K1', 'Reorder Point');

		$objPHPExcel->getActiveSheet()->setCellValue('L1', 'Inventory Asset Account');

		$objPHPExcel->getActiveSheet()->setCellValue('M1', 'Quantity as-of Date');



		// Fill data starting from the second row

		$row = 2;

		foreach ($data as $item) {

			// Sample values for fixed columns

			$typeValue = 'Noninventory';



			// Set data for each column

			$objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $item['item_name']);

			$objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $item['sales_description']);

			$objPHPExcel->getActiveSheet()->setCellValue('C' . $row, '');

			$objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $typeValue);

			$objPHPExcel->getActiveSheet()->setCellValue('E' . $row, '');

			$objPHPExcel->getActiveSheet()->setCellValue('F' . $row, '');

			$objPHPExcel->getActiveSheet()->setCellValue('G' . $row, '');

			$objPHPExcel->getActiveSheet()->setCellValue('H' . $row, '');

			$objPHPExcel->getActiveSheet()->setCellValue('I' . $row, '');

			$objPHPExcel->getActiveSheet()->setCellValue('J' . $row, '');

			$objPHPExcel->getActiveSheet()->setCellValue('K' . $row, '');

			$objPHPExcel->getActiveSheet()->setCellValue('L' . $row, '');

			$objPHPExcel->getActiveSheet()->setCellValue('M' . $row, '');



			// Auto-size each column

			foreach (range('A', 'M') as $col) {

				$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
			}



			$row++;
		}



		// Set header for Excel file

		header('Content-Type: application/vnd.ms-excel');

		header('Content-Disposition: attachment;filename="exported_data.xls"');

		header('Cache-Control: max-age=0');



		// Save the Excel file to output

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

		$objWriter->save('php://output');

		echo '<script type="text/javascript">window.close();</script>';
	}



	public function actionCreateBlankLink()

	{

		$item_id = $_POST['item_id'];

		$sql = "INSERT INTO `tbl_item_gdrive_link`(`item_id`) VALUES ('$item_id')";

		Yii::app()->db->createCommand($sql)->execute();

		$new_item_id = Yii::app()->db->getLastInsertID();

		die(json_encode(array('status' => 1, 'link_id' => $new_item_id)));
	}



	public function actionRemoveDriveLinkUpdate()

	{

		$link_id = $_POST['link_id'];

		$item_id = $_POST['item_id'];

		$del_sql = "DELETE FROM notifications WHERE link_id='$link_id'";

		Yii::app()->db->createCommand($del_sql)->execute();

		$del_sql1 = "DELETE FROM tbl_comments_drive WHERE link_id='$link_id'";

		Yii::app()->db->createCommand($del_sql1)->execute();

		$del_sql2 = "DELETE FROM tbl_item_gdrive_link WHERE gdrive_id='$link_id'";

		Yii::app()->db->createCommand($del_sql2)->execute();

		$update = "UPDATE tbl_item SET gdrive_link='0' WHERE item_id='$item_id'";

		Yii::app()->db->createCommand($update)->execute();

		die(json_encode(array('status' => 1)));
	}



	public function actionRemoveDriveLink()

	{

		$link_id = $_POST['link_id'];

		$item_id = $_POST['item_id'];

		$del_sql = "DELETE FROM notifications WHERE link_id='$link_id'";

		Yii::app()->db->createCommand($del_sql)->execute();

		$del_sql1 = "DELETE FROM tbl_comments_drive WHERE link_id='$link_id'";

		Yii::app()->db->createCommand($del_sql1)->execute();

		$del_sql2 = "DELETE FROM tbl_item_gdrive_link WHERE gdrive_id='$link_id'";

		Yii::app()->db->createCommand($del_sql2)->execute();

		die(json_encode(array('status' => 1)));
	}



	public function actionFetchGdriveChats()

	{

		$driver = $_POST['driver'];

		$user_id = Yii::app()->user->getState('userKey');

		$string = "";

		$sql = "SELECT c.com_id, c.item_id, c.link_id, GROUP_CONCAT(COALESCE(u1.fullname, '')) AS user_names, c.comment, COALESCE(u2.fullname, '') AS user_from_name, c.user_from, c.created_date FROM tbl_comments_drive c LEFT JOIN user u1 ON FIND_IN_SET(u1.id, c.user_ids) LEFT JOIN user u2 ON u2.id = c.user_from WHERE c.link_id = '$driver' GROUP BY c.com_id, c.item_id, c.link_id, c.comment, c.user_from, c.created_date ORDER BY c.created_date DESC;";

		$a_qitem = Yii::app()->db->createCommand($sql)->queryAll();

		if (count($a_qitem) == 0) {

			die(json_encode(array('status' => '0')));
		} else {

			foreach ($a_qitem as $tmp_key => $row_qitem) {

				if ($row_qitem["user_from"] == $user_id) {

					$style = "text-align:right";
				} else {

					$style = "text-align:left";
				}

				if ($row_qitem['user_names'] == "") {

					$string .= '<div class=""><center><pre class="alert alert-info" style="' . $style . ';">' . $row_qitem['user_from_name'] . '@' . date("M d, Y H:i:s", strtotime($row_qitem["created_date"])) . ' comments "' . $row_qitem["comment"] . '"</pre></center></div>';
				} else {

					$string .= '<div class=""><center><pre class="alert alert-info" style="' . $style . ';">' . $row_qitem['user_from_name'] . '@' . date("M d, Y H:i:s", strtotime($row_qitem["created_date"])) . ' comments "' . $row_qitem["comment"] . '"  for "' . $row_qitem['user_names'] . '"</pre></center></div>';
				}
			}

			//echo $string;

			die(json_encode(array('status' => '1', 'msg' => base64_encode($string))));
		}
	}



	public function actionAddCommentDrive()

	{

		$main_comment = addslashes($_POST['main_comment']);

		$item_id = $_POST['item_id'];

		$link_id = $_POST['link_id'];

		$bs_url = "https://sales.jog-joinourgame.com";

		$user_from = Yii::app()->user->getState('userKey');

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



				$nsql = "SELECT * FROM user WHERE id IN ($users)";

				$query = Yii::app()->db->createCommand($nsql)->queryAll();

				foreach ($query as $fetch) {

					$email[] = $fetch['email'];
				}

				$emails = implode(',', $email);



				$sql_item = "SELECT * FROM tbl_item WHERE item_id='$item_id'";

				$query = Yii::app()->db->createCommand($sql_item)->queryAll();

				$item_name = $query[0]['item_name'];



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

                                                    <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Gdrive Comment!</h1> <img src="https://online.jog-joinourgame.com/assets/images/logo.png" width="125" height="120" style="display: block; border: 0px;" />

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

                                                    <p style="margin: 0;text-align:center;">You have a comment - <br> <b>"' . $main_comment . '"</b> <br> in SALES REP PORTAL from ' . $user_from . ' on Item - ' . $item_name . ' Please check all the link for comment in this item.</p>

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

				$mail->Subject = "GDRIVE COMMENT";

				$mail->MsgHTML($template3);

				//$mail->AddAddress($mail_customer, $mail_customername);

				$mail->addBcc("ravish@jogsportswear.com");

				$mail->AddAddress('ravish3474@gmail.com');

				// 		if(!$mail->Send()) {

				// 			//echo $mail->ErrorInfo;

				// 		}else {

				// 		    //echo "working";

				// 			//Yii::app()->user->setFlash('success', 'Message Already sent!');

				// 		}

				$mail->ClearAddresses();

				die(json_encode(array('status' => 1)));
			}
		} else {

			$sql = "INSERT INTO `tbl_comments_drive`(`item_id`, `link_id`, `comment`,`user_from`) VALUES ('$item_id','$link_id','$main_comment','$user_from')";

			Yii::app()->db->createCommand($sql)->execute();

			die(json_encode(array('status' => 1)));
		}
	}



	public function actionLinkUpdate()

	{

		$item_id = $_POST['item_id'];

		$gdrive_link = $_POST['gdrive_link'];

		foreach ($gdrive_link as $url) {

			$url = addslashes($url);

			$sql_new = "INSERT INTO `tbl_item_gdrive_link`(`item_id`, `gdrive_link`) VALUES ('$item_id','$url')";

			Yii::app()->db->createCommand($sql_new)->execute();
		}

		$update = "UPDATE tbl_item SET gdrive_link='1' WHERE item_id='$item_id'";

		Yii::app()->db->createCommand($update)->execute();

		die(json_encode(array('status' => 1)));
	}



	public function actionFetchGdriveLink()

	{

		$item_id = Yii::app()->db->quoteValue($_POST['item_id']); // Sanitize input to prevent SQL injection

		$sql = "SELECT * FROM tbl_item_gdrive_link WHERE item_id=$item_id";

		$data = Yii::app()->db->createCommand($sql)->queryAll();

		if (count($data) > 0) {

			die(json_encode(array('status' => 1, 'data' => $data)));
		} else {

			die(json_encode(array('status' => 0)));
		}

		// if ($fetch && isset($fetch['gdrive_link']) && strlen($fetch['gdrive_link']) > 0) {

		//     $fetcher = $fetch['gdrive_link'];

		//     die(json_encode(array('status' => 1, 'data' => $fetcher)));

		// } else {

		//     die(json_encode(array('status' => 0)));

		// }

	}



	public function actionUpdateUserMSRP()

	{

		$value = $_POST['value'];

		$user_id = $_POST['user_id'];

		$sql = "UPDATE user SET msrp_active='$value' WHERE id='$user_id'";

		Yii::app()->db->createCommand($sql)->execute();

		die(json_encode(array('status' => 1)));
	}





	public function actionUpdateUserPricing()

	{

		$pricing = $_POST['pricing'];

		$user_id = $_POST['user_id'];

		$sql = "UPDATE user SET pricing_module='$pricing' WHERE id='$user_id'";

		Yii::app()->db->createCommand($sql)->execute();

		die(json_encode(array('status' => 1)));
	}



	public function actionDeleteExtraCat()

	{

		$cat_ex_id = $_POST['cat_ex_id'];

		$sql = "DELETE FROM category_extra_listing WHERE cat_ex_id='$cat_ex_id'";

		Yii::app()->db->createCommand($sql)->execute();



		$nsql = "DELETE FROM category_extra_items WHERE cat_ex_id='$cat_ex_id'";

		Yii::app()->db->createCommand($nsql)->execute();

		echo 1;
	}



	public function actionUpdateCatExtraItems()

	{

		$cat_ex_id = $_POST['cat_ex_id'];

		$prod_id = $_POST['prod_id'];

		$sql = "DELETE FROM category_extra_listing WHERE cat_ex_id='$cat_ex_id'";

		Yii::app()->db->createCommand($sql)->execute();



		$list_ids = $_POST['list_ids'];

		foreach ($list_ids as $id) {

			$ins = "INSERT INTO `category_extra_listing`(`cat_ex_id`, `extra_id`) VALUES ('$cat_ex_id','$id')";

			Yii::app()->db->createCommand($ins)->execute();
		}



		echo 1;
	}



	public function actionViewCatExtraItems()

	{

		$curr_id = $_POST['curr_id'];

		$prod_id = $_POST['prod_id'];

		$cat_ex_id = $_POST['cat_ex_id'];

		$result['prod_id'] = $_POST['prod_id'];

		$result['cat_ex_id'] = $_POST['cat_ex_id'];

		$sql_extra = "

            SELECT e.*, cel.extra_id AS selected

            FROM tbl_extra e

            LEFT JOIN category_extra_listing cel ON e.extra_id = cel.extra_id AND cel.cat_ex_id = '" . $cat_ex_id . "'

            WHERE e.curr_id = '" . $curr_id . "' AND e.prod_id = '" . $prod_id . "'

            ORDER BY cel.extra_id DESC, e.sort_no ASC;

        ";

		$main = Yii::app()->db->createCommand($sql_extra)->queryAll();

		$result['data'] = $main;

		$result['curr_id'] = $curr_id;

		echo $this->renderPartial('/priceGuideV2/view_extra_items_list', $result);
	}



	public function actionSubmitExtraItemCat()

	{

		$curr_id = $_POST['curr_id'];

		$prod_id = $_POST['prod_id'];

		$cat_name = addslashes($_POST['cat_name']);

		$sql = "SELECT * FROM category_extra_items WHERE prod_id='$prod_id' AND cat_ex_name='$cat_name' AND curr_id='$curr_id'";

		$query = Yii::app()->db->createCommand($sql)->queryAll();

		if (count($query) == 0) {

			$ins = "INSERT INTO `category_extra_items`(`cat_ex_name`, `prod_id`,`curr_id`) VALUES ('$cat_name','$prod_id','$curr_id')";

			if (Yii::app()->db->createCommand($ins)->execute()) {

				die(json_encode(array('status' => 1)));
			}
		} else {

			die(json_encode(array('status' => 0)));
		}
	}



	public function actionManageExtraItems()

	{

		$curr_id = $_POST['curr_id'];

		$prod_id = $_POST['prod_id'];

		$sql = "SELECT * FROM tbl_product where prod_id='$prod_id'";

		$main = Yii::app()->db->createCommand($sql)->queryAll();

		$data = $main[0]['prod_name'];

		$result['name'] = $data;

		$sql_2 = "SELECT * FROM category_extra_items WHERE prod_id='$prod_id' AND curr_id='$curr_id' ORDER BY sort_no ASC, created_date DESC";

		$main_2 = Yii::app()->db->createCommand($sql_2)->queryAll();

		$result['data'] = $main_2;

		$result['prod_id'] = $prod_id;

		$result['curr_id'] = $curr_id;

		echo $this->renderPartial('/priceGuideV2/manage_extra_items', $result);
	}

	public function actionEditExtraItems()

	{

		$cat_ex_id = $_POST['cat_ex_id'];
		

		$sql_2 = "SELECT * FROM category_extra_items WHERE cat_ex_id='$cat_ex_id' ORDER BY sort_no ASC, created_date DESC";

		$main_2 = Yii::app()->db->createCommand($sql_2)->queryAll();

		$result = $main_2;		

		die(json_encode(array('status' => 1, 'data' => $result)));
	}

	public function actionEditSubexCategory()

	{

		$cat_id = $_POST['edit_extra_cat_id'];		

		$cat_name = $_POST['edit_extra_cat_name'];
		

		$update = "UPDATE `category_extra_items` SET cat_ex_name='" . $cat_name . "' WHERE cat_ex_id='$cat_id'";

		Yii::app()->db->createCommand($update)->execute();

		die(json_encode(array('status' => 1)));
	}

	public function actionUpdateExtraSortOrder()
	{
		$order = $_POST['order'];

		foreach ($order as $row) {
			Yii::app()->db->createCommand()->update(
				'category_extra_items',
				['sort_no' => $row['sort_no']],
				'cat_ex_id=:id',
				[':id' => $row['id']]
			);
		}

		echo 1;
	}



	public function actionCloneSubmit()

	{

		$item_name = $_POST['item_name'];

		$item_id = $_POST['main_item_id'];

		$prod_id = $_POST['prod_id'];

		$group_id = $_POST['group_id'];

		$categories = $_POST['categories'];



		//GET SORT NO.

		$group_info = $group_id;



		$group_id = "";

		$group_name = "";



		$sql_select_max = "SELECT MAX(sort) AS max_sort FROM tbl_item WHERE prod_id='" . $prod_id . "' ";

		if ($group_info == "==no_group==") {

			$sql_select_max .= " AND group_id IS NULL ";
		} else {



			$tmp_ginfo = explode("#&#", $group_info);

			$group_id = $tmp_ginfo[0];

			$group_name = $tmp_ginfo[1];



			$sql_select_max .= " AND group_id='" . $group_id . "' ";
		}

		$a_max = Yii::app()->db->createCommand($sql_select_max)->queryAll();

		$new_sort = intval($a_max[0]["max_sort"]) + 1;



		$sql = "SELECT * FROM tbl_item WHERE item_id='$item_id'";

		$main = Yii::app()->db->createCommand($sql)->queryAll();

		$item_style = $main[0]['item_style'];

		$item_detail = $main[0]['item_detail'];

		$item_fabric_opt = $main[0]['item_fabric_opt'];

		$item_image = $main[0]['item_image'];



		$ins_sql = "INSERT INTO `tbl_item`(`item_name`, `item_style`, `item_detail`, `item_fabric_opt`, `item_image`, `group_name`, `group_id`, `prod_id`, `sort`) VALUES ('" . addslashes($item_name) . "','" . addslashes($item_style) . "','" . addslashes($item_detail) . "','" . addslashes($item_fabric_opt) . "','" . $item_image . "','" . addslashes($group_name) . "','" . $group_id . "','" . $prod_id . "','" . $new_sort . "')";



		Yii::app()->db->createCommand($ins_sql)->execute();

		$new_item_id = Yii::app()->db->getLastInsertID();



		if (count($categories) > 0) {

			foreach ($categories as $tar) {

				$pr_sql = "INSERT INTO `tbl_price_guide`(`item_id`, `curr_id`, `sat_id`, `comm_per_id`, `price`) SELECT $new_item_id,curr_id,sat_id,comm_per_id,price FROM `tbl_price_guide` WHERE item_id='$item_id' AND sat_id='$tar'";

				Yii::app()->db->createCommand($pr_sql)->execute();
			}
		}



		echo "success";
	}



	public function actionFetchGroup()

	{

		$prod_id = $_POST['prod_id'];

		$sql = "SELECT * FROM tbl_item_group WHERE prod_id='$prod_id' ORDER BY sort ASC";

		$fetch = Yii::app()->db->createCommand($sql)->queryAll();

		if (count($fetch) > 0) {

			die(json_encode(array('status' => 1, 'data' => $fetch)));
		} else {

			die(json_encode(array('status' => 0)));
		}
	}



	public function actionUpdateCTC()

	{

		$ctc = $_POST['ctc'];

		$extra_id = $_POST['extra_id'];

		$updater = "UPDATE tbl_extra SET ctc='" . $ctc . "' WHERE extra_id='" . $extra_id . "'";

		Yii::app()->db->createCommand($updater)->execute();

		die(json_encode(array('status' => 1)));
	}



	public function actionCloneCalc()

	{

		$calc_id = $_POST['calc_id'];

		$draft_name = $_POST['draft_name'];

		$item_id = $_POST['item_id'];

		$sql = "SELECT calculations,item_name FROM `tbl_cost_calc` WHERE calc_id='$calc_id'";

		$fetch = Yii::app()->db->createCommand($sql)->queryAll();

		$calculations = $fetch[0]['calculations'];

		$item_name = $fetch[0]['item_name'];

		$insert = "INSERT INTO `tbl_cost_calc`(`item_id`, `item_name`,`draft_name`, `calculations`) VALUES ('" . $item_id . "','" . $item_name . "','" . $draft_name . "','" . $calculations . "')";

		if (Yii::app()->db->createCommand($insert)->execute()) {

			die(json_encode(array('status' => 1)));
		} else {

			die(json_encode(array('status' => 0)));
		}
	}



	public function actionFetchCalcData()

	{

		$item_id = $_POST['item_id'];

		$result['main_item_id'] = $item_id;

		$sql = "SELECT calc_id,draft_name FROM `tbl_cost_calc`";

		$fetch = Yii::app()->db->createCommand($sql)->queryAll();

		if (count($fetch) > 0) {

			$result['fetcher'] = $fetch;

			echo $this->renderPartial('/costCalculator/clone_table', $result);
		} else {

			echo "<h3>No cost exists, please add one in any product to clone.</h3>";
		}
	}



	public function actionAddCalc()

	{

		$table_data = implode('-', $_POST['table_data']);

		$item_id = $_POST['item_id'];

		$item_name = $_POST['item_name'];

		$draft_name = $_POST['draft_name'];

		$insert = "INSERT INTO `tbl_cost_calc`(`item_id`, `item_name`,`draft_name`, `calculations`) VALUES ('" . $item_id . "','" . $item_name . "','" . $draft_name . "','" . $table_data . "')";

		Yii::app()->db->createCommand($insert)->execute();

		$lastInsertID = Yii::app()->db->getLastInsertID();

		die(json_encode(array('status' => 1, 'calc_id' => $lastInsertID)));
	}



	public function actionDeleteCalc()

	{

		$calc_id = $_POST['calc_id'];

		$sql = "DELETE FROM `tbl_cost_calc` WHERE calc_id='" . $calc_id . "'";

		if (Yii::app()->db->createCommand($sql)->execute()) {

			die(json_encode(array('status' => 1)));
		} else {

			die(json_encode(array('status' => 0)));
		}
	}



	public function actionEditCalc()

	{

		$calc_id = $_POST['calc_id'];

		$table_data = implode('-', $_POST['table_data']);

		$item_name = $_POST['item_name'];

		$draft_name = $_POST['draft_name'];

		$update = "UPDATE `tbl_cost_calc` SET item_name='" . $item_name . "',calculations='" . $table_data . "',draft_name='" . $draft_name . "' WHERE calc_id='$calc_id'";

		Yii::app()->db->createCommand($update)->execute();

		die(json_encode(array('status' => 1)));
	}



	public function actionAddCostCalc()

	{

		$item_id = $_POST['item_id'];

		$result['item_id'] = $item_id;

		$result['item_name'] = base64_encode($_POST['item_name']);

		echo $this->renderPartial('/costCalculator/index', $result);
	}



	public function actionEditCostCalc()

	{

		$calc_id = $_POST['calc_id'];

		$item_id = $_POST['item_id'];

		$result['item_id'] = $item_id;

		$result['item_name'] = base64_encode($_POST['item_name']);

		$sql = "SELECT * FROM `tbl_cost_calc` WHERE calc_id='" . $calc_id . "'";

		$fetch = Yii::app()->db->createCommand($sql)->queryAll();

		if (count($fetch) > 0) {

			$result['fetcher'] = $fetch;

			echo $this->renderPartial('/costCalculator/index_update', $result);
		} else {

			echo $this->renderPartial('/costCalculator/index', $result);
		}
	}



	public function actionFetchColorsUser()

	{

		$main_data = "";

		$item_id = $_POST['item_id'];

		$sql = " SELECT * FROM tbl_color_item WHERE item_id='" . $item_id . "'";

		$fetch = Yii::app()->db->createCommand($sql)->queryAll();

		if (count($fetch) > 0) {

			foreach ($fetch as $data) {

				$color_desc = $data['color_desc'];

				$color_code = $data['color_code'];

				$color_name = $data['color_name'];

				$main_data .= '<tr><td><p>' . $color_desc . '</p></td><td>' . $color_name . ' <span style="float: right;height: 20px;width: 20px;border-radius: 50%;border:1px solid #D9D9D9;clear: both;background-color:' . $color_code . ';"></span></td><td>' . $color_code . '</td></tr>';
			}

			die(json_encode(array('status' => 1, 'data' => base64_encode($main_data))));
		} else {

			die(json_encode(array('status' => 0)));
		}
	}



	public function actionFetchColorsAdmin()

	{

		$main_data = "";

		$item_id = $_POST['item_id'];

		$sql = " SELECT * FROM tbl_color_item WHERE item_id='" . $item_id . "'";

		$fetch = Yii::app()->db->createCommand($sql)->queryAll();

		if (count($fetch) > 0) {

			foreach ($fetch as $data) {

				$color_desc = $data['color_desc'];

				$color_code = $data['color_code'];

				$color_name = $data['color_name'];

				$main_data .= '<tr><td><textarea name="color_desc[]" style="width:100%;">' . $color_desc . '</textarea></td><td><input type="text" name="color_name[]" value="' . $color_name . '" style="width:75%;"> <span style="float: right;height: 20px;width: 20px;margin-bottom: 15px;clear: both;background-color:' . $color_code . ';"></span></td><td><input type="text" name="color_code[]" value="' . $color_code . '"></td><td><button class="btn btn-danger remCF">Delete</button></td></tr>';
			}

			die(json_encode(array('status' => 1, 'data' => base64_encode($main_data))));
		} else {

			die(json_encode(array('status' => 0)));
		}
	}



	public function actionFetchCurrency()

	{

		$sql2 = "SELECT * FROM tbl_currency WHERE enable=1 ORDER BY sort ASC; ";

		$result['row_currency'] = Yii::app()->db->createCommand($sql2)->queryAll();

		die(json_encode($result));
	}



	public function actionColorUpdate()

	{

		$item_id = $_POST['item_id'];

		if (isset($_POST['color_desc'])) {

			$color_desc = $_POST['color_desc'];

			$color_code = $_POST['color_code'];

			$color_name = $_POST['color_name'];

			$del_sql = "DELETE FROM tbl_color_item WHERE item_id='$item_id'";

			Yii::app()->db->createCommand($del_sql)->execute();



			$ins_sql = "INSERT INTO `tbl_color_item`(`item_id`, `color_desc`, `color_name`, `color_code`) VALUES ";

			for ($i = 0; $i < count($color_desc); $i++) {

				$ins_sql .= "('" . $item_id . "','" . $color_desc[$i] . "','" . $color_name[$i] . "','" . $color_code[$i] . "'),";
			}

			$ins_sql = rtrim($ins_sql, ',');

			Yii::app()->db->createCommand($ins_sql)->execute();



			$update = "UPDATE tbl_item SET color_available='1' WHERE item_id='$item_id'";

			Yii::app()->db->createCommand($update)->execute();

			die(json_encode(array('status' => 1)));
		} else {

			$del_sql = "DELETE FROM tbl_color_item WHERE item_id='$item_id'";

			Yii::app()->db->createCommand($del_sql)->execute();



			$update = "UPDATE tbl_item SET color_available='0' WHERE item_id='$item_id'";

			Yii::app()->db->createCommand($update)->execute();

			die(json_encode(array('status' => 1)));
		}
	}



	public function actionUploadFabricImage()

	{

		$item_id = $_POST['item_id'];

		$sourcePath = $_FILES['fab_image']['tmp_name'];

		$newfile = time() . "-" . $_FILES['fab_image']['name']; //any name sample.jpg

		$targetPath = Yii::getPathOfAlias('webroot') . '/upload/pattern/' . $newfile;

		if (move_uploaded_file($sourcePath, $targetPath)) {

			$sql = "UPDATE tbl_item SET item_image='$newfile' WHERE item_id='$item_id'";

			Yii::app()->db->createCommand($sql)->execute();

			die(json_encode(array('status' => 1, 'file_name' => $newfile)));
		} else {

			die(json_encode(array('status' => 2)));
		}
	}



	public function actionShow($product = 1)

	{



		if ($product == "" || $product == 0) {

			$product = 1;
		}



		$sql = "SELECT * FROM tbl_sale_type WHERE enable=1 ORDER BY sort ASC; ";

		$result['row_sale_type'] = Yii::app()->db->createCommand($sql)->queryAll();



		$sql2 = "SELECT * FROM tbl_currency WHERE enable=1 ORDER BY sort ASC; ";

		$result['row_currency'] = Yii::app()->db->createCommand($sql2)->queryAll();



		$sql3 = "SELECT * FROM tbl_product WHERE prod_id='" . $product . "'; ";

		$result['row_product'] = Yii::app()->db->createCommand($sql3)->queryAll();



		$sql4 = "SELECT * FROM notes WHERE prod_id='" . $product . "' ORDER BY id ASC LIMIT 0,1; ";

		$a_notes = Yii::app()->db->createCommand($sql4)->queryAll();

		if (sizeof($a_notes) > 0) {

			$result['row_notes'] = $a_notes[0];
		} else {

			$result['row_notes'] = array();
		}



		$sql_prod_sat = "SELECT * FROM tbl_prod_sale_type WHERE prod_id='" . $product . "';";

		$row_prod_sat = Yii::app()->db->createCommand($sql_prod_sat)->queryAll();

		$result["sat_id_list"] = $row_prod_sat[0]["sat_id_list"];



		$result['admin_edit'] = "no";



		$this->render('product_template', $result);
	}

	public function actionDesignShow($product = 1)
	{
		if ($product == "" || $product == 0) {
			$product = 1;
		}

		$sql = "SELECT * FROM tbl_sale_type WHERE enable=1 ORDER BY sort ASC; ";
		$result['row_sale_type'] = Yii::app()->db->createCommand($sql)->queryAll();

		$sql2 = "SELECT * FROM tbl_currency WHERE enable=1 ORDER BY sort ASC; ";
		$result['row_currency'] = Yii::app()->db->createCommand($sql2)->queryAll();

		$sql3 = "SELECT * FROM tbl_product WHERE prod_id='" . $product . "'; ";
		$result['row_product'] = Yii::app()->db->createCommand($sql3)->queryAll();

		$sql4 = "SELECT * FROM notes WHERE prod_id='" . $product . "' ORDER BY id ASC LIMIT 0,1; ";
		$a_notes = Yii::app()->db->createCommand($sql4)->queryAll();
		if (sizeof($a_notes) > 0) {
			$result['row_notes'] = $a_notes[0];
		} else {
			$result['row_notes'] = array();
		}

		$sql_prod_sat = "SELECT * FROM tbl_prod_sale_type WHERE prod_id='" . $product . "';";
		$row_prod_sat = Yii::app()->db->createCommand($sql_prod_sat)->queryAll();
		$result["sat_id_list"] = $row_prod_sat[0]["sat_id_list"];

		$result['admin_edit'] = "no";

		$this->render('design_product_template', $result);
	}


	public function actionFetchExtraItems()

	{

		$prod_id = $_POST['prod_id'];

		$curr_id = $_POST['curr_now'];

		$sql_extra = "SELECT * FROM tbl_extra WHERE curr_id='" . $curr_id . "' AND prod_id='" . $prod_id . "' ORDER BY sort_no ASC; ";

		$result = Yii::app()->db->createCommand($sql_extra)->queryAll();

		if (count($result) > 0) {

			die(json_encode(array('status' => '1', 'data' => $result)));
		} else {

			die(json_encode(array('status' => '0')));
		}
	}



	public function actionShowExtraUser($prod, $curr = 1)

	{



		$user_id = Yii::app()->user->getState('userKey');

		$curr_id = $curr;

		$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $curr_id . "'; ";

		$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

		$result['row_curr'] = $a_curr[0];



		$prod_id = $prod;

		$sql_extra = "SELECT *,t1.extra_id as main_id FROM `tbl_extra` AS t1 LEFT JOIN (SELECT * FROM tbl_lib_extra 

            WHERE user_id='" . $user_id . "') AS t2 ON (t1.`extra_id` = t2.`extra_id`) WHERE curr_id='" . $curr_id . "' AND prod_id='" . $prod_id . "' ORDER BY sort_no ASC";

		$result["a_extra"] = Yii::app()->db->createCommand($sql_extra)->queryAll();

		//$count_sort = 1;

		if (sizeof($result["a_extra"]) > 0) {



			if (isset($_GET["ade"]) && $_GET["ade"] == "yes") {

				$result["admin_edit"] = "yes";
			} else {

				$result["admin_edit"] = "no";
			}



			echo $this->renderPartial('/priceGuideV2/show_extra_user', $result);
		} else {

			echo "empty";
		}
	}



	public function actionShowExtra($prod, $curr = 1)

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
			cei.sort_no ASC,
			group_name ASC,

            te.sort_no ASC;
			;

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



			echo $this->renderPartial('/priceGuideV2/show_extra', $result);
		} else {

			echo "empty";
		}
	}



	public function actionShowNote($prod, $curr = 1)

	{



		$curr_id = $curr;

		$prod_id = $prod;

		$sql_notes = "SELECT * FROM notes WHERE curr_id='" . $curr_id . "' AND prod_id='" . $prod_id . "'; ";

		$a_note = Yii::app()->db->createCommand($sql_notes)->queryAll();



		if (sizeof($a_note) > 0) {



			echo isset($a_note[0]["notes"]) ? nl2br($a_note[0]["notes"]) : "";
		} else {

			echo "empty";
		}
	}



	public function actionAddExtraToCart()

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



		if (isset($_COOKIE["JOG_CART_info"])) {



			$sql_select = " SELECT * FROM tbl_cart_temp WHERE cart_tmp_id='" . $_COOKIE["JOG_CART_info"] . "'; ";

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

			$sql_update_tmp = "UPDATE tbl_cart_temp SET obj_tmp='" . base64_encode($tmp_json) . "' WHERE cart_tmp_id='" . $_COOKIE["JOG_CART_info"] . "';";

			Yii::app()->db->createCommand($sql_update_tmp)->execute();



			//setcookie("JOG_CART_info",json_encode($a_cart_info));



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

			$user_id = Yii::app()->user->getState('userKey');



			$sql_delete_tmp = "DELETE FROM tbl_cart_temp WHERE user_id=" . $user_id;

			Yii::app()->db->createCommand($sql_delete_tmp)->execute();



			$tmp_json = json_encode($a_cart_info);

			$sql_insert_tmp = "INSERT INTO tbl_cart_temp (user_id,obj_tmp) VALUES (" . $user_id . ",'" . base64_encode($tmp_json) . "');";

			Yii::app()->db->createCommand($sql_insert_tmp)->execute();



			$cart_tmp_id = Yii::app()->db->getLastInsertID();



			setcookie("JOG_CART_info", $cart_tmp_id, time() + 36000); //10 hours



		}



		echo "success";
	}



	public function actionAddExtraToCartUser()

	{



		if (!isset($_POST["extra_id"]) || ($_POST["extra_id"] == "")) {

			echo "Invalid parameter.";

			exit();
		}



		if (!isset($_POST["value_id"]) || ($_POST["value_id"] == "")) {

			echo "Invalid parameter.";

			exit();
		}



		$user_id = Yii::app()->user->getState('userKey');



		// 		$sql = " SELECT * FROM tbl_extra WHERE extra_id='".$_POST["extra_id"]."';";



		$sql = "SELECT *,t1.extra_id as main_id FROM `tbl_extra` AS t1 LEFT JOIN (SELECT * FROM tbl_lib_extra 

            WHERE user_id='" . $user_id . "') AS t2 ON (t1.`extra_id` = t2.`extra_id`) WHERE t1.extra_id='" . $_POST["extra_id"] . "'";

		$a_extra = Yii::app()->db->createCommand($sql)->queryAll();

		$row_extra = $a_extra[0];



		if (isset($_COOKIE["JOG_CART_info"])) {



			$sql_select = " SELECT * FROM tbl_cart_temp WHERE cart_tmp_id='" . $_COOKIE["JOG_CART_info"] . "'; ";

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

			$a_cart_info["item"][$next_index]["item_id"] = "e" . $row_extra["main_id"];

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

			if ($row_extra["description"] == "" || $row_extra["description"] == NULL) {

				$a_cart_info["item"][$next_index]["desc_show"] = $row_extra["extra_desc"];
			} else {

				$a_cart_info["item"][$next_index]["desc_show"] = $row_extra["description"];
			}

			$a_cart_info["item"][$next_index]["addi_id_list"] = "";

			$a_cart_info["item"][$next_index]["qty"] = 0;



			$tmp_json = json_encode($a_cart_info);

			$sql_update_tmp = "UPDATE tbl_cart_temp SET obj_tmp='" . base64_encode($tmp_json) . "' WHERE cart_tmp_id='" . $_COOKIE["JOG_CART_info"] . "';";

			Yii::app()->db->createCommand($sql_update_tmp)->execute();



			//setcookie("JOG_CART_info",json_encode($a_cart_info));



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

			if ($row_extra["description"] == "" || $row_extra["description"] == NULL) {

				$a_cart_info["item"][0]["desc_show"] = $row_extra["extra_desc"];
			} else {

				$a_cart_info["item"][0]["desc_show"] = $row_extra["description"];
			}

			$a_cart_info["item"][0]["addi_id_list"] = "";

			$a_cart_info["item"][0]["qty"] = 0;



			//setcookie("JOG_CART_info",json_encode($a_cart_info),time()+36000); //10 hours

			$user_id = Yii::app()->user->getState('userKey');



			$sql_delete_tmp = "DELETE FROM tbl_cart_temp WHERE user_id=" . $user_id;

			Yii::app()->db->createCommand($sql_delete_tmp)->execute();



			$tmp_json = json_encode($a_cart_info);

			$sql_insert_tmp = "INSERT INTO tbl_cart_temp (user_id,obj_tmp) VALUES (" . $user_id . ",'" . base64_encode($tmp_json) . "');";

			Yii::app()->db->createCommand($sql_insert_tmp)->execute();



			$cart_tmp_id = Yii::app()->db->getLastInsertID();



			setcookie("JOG_CART_info", $cart_tmp_id, time() + 36000); //10 hours



		}



		echo "success";
	}



	public function actionAddExtraToQuotation()

	{



		$qdoc_id = $_POST["qdoc_id"];

		//$obj_cart_info = json_decode($_COOKIE["JOG_CART_info"]);

		$sql_doc = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $qdoc_id . "'; ";

		$a_doc = Yii::app()->db->createCommand($sql_doc)->queryAll();

		$row_doc = $a_doc[0];



		$extra_id = $_POST["extra_id"];

		$sql_extra = "SELECT * FROM tbl_extra WHERE extra_id='" . $extra_id . "'; ";

		$a_extra = Yii::app()->db->createCommand($sql_extra)->queryAll();

		$row_extra = $a_extra[0];



		if ($row_doc["curr_id"] != $row_extra["curr_id"]) {

			echo "The currency does not match.";

			exit();
		}



		$sql_item_chk = "SELECT * FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND pro_type='extra' AND item_id='" . $extra_id . "' AND enable=1; ";

		$a_item_chk = Yii::app()->db->createCommand($sql_item_chk)->queryAll();



		if (sizeof($a_item_chk) > 0) {

			echo "Duplicate item! \nYou must delete item from Quotation before.";

			exit();
		}



		$sql_max = "SELECT MAX(sort) AS max_sort FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND enable=1; ";

		$a_max = Yii::app()->db->createCommand($sql_max)->queryAll();

		$max_sort = intval($a_max[0]["max_sort"]);

		$max_sort++;





		$uprice = $row_extra["extra_value"];

		$add_date = date("Y-m-d H:i:s");



		$pro_name = addslashes($row_extra["extra_name"]);

		$pro_desc = addslashes($row_extra["extra_desc"]);



		$sql_add_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,item_id,pro_name,pro_desc,uprice,sort,add_date) VALUES (";

		$sql_add_item .= "'" . $qdoc_id . "','extra','" . $extra_id . "','" . $pro_name . "','" . $pro_desc . "','" . $uprice . "','" . $max_sort . "','" . $add_date . "'";

		$sql_add_item .= "); ";

		Yii::app()->db->createCommand($sql_add_item)->execute();



		$sql_update = "UPDATE tbl_quote_doc SET num_item=num_item+1 WHERE qdoc_id='" . $qdoc_id . "'; ";



		$a_data = array();



		if (Yii::app()->db->createCommand($sql_update)->execute()) {



			$obj_cart_quote = (array)json_decode($_COOKIE["JOG_CART_Quote"]);



			$a_data = $obj_cart_quote;

			$a_data["num_item"] = intval($obj_cart_quote["num_item"]) + 1;



			setcookie("JOG_CART_Quote", json_encode($a_data));



			echo "success";
		} else {

			echo "Fail to add item.";
		}
	}



	public function actionShowInner($product = 1, $type = 1, $curr = 1)

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

			//$a_pguide[($row_pguide[$i]["item_id"])][($row_pguide[$i]["comm_per_id"])]["price"] = $row_pguide[$i]["price"];

			//$a_pguide[($row_pguide[$i]["item_id"])][($row_pguide[$i]["comm_per_id"])]["prg_id"] = $row_pguide[$i]["prg_id"];

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

		echo $this->renderPartial('/priceGuideV2/show_inner', $result);
	}

	public function actionDesignShowInner($product = 1, $type = 1, $curr = 1)
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
			//$a_pguide[($row_pguide[$i]["item_id"])][($row_pguide[$i]["comm_per_id"])]["price"] = $row_pguide[$i]["price"];
			//$a_pguide[($row_pguide[$i]["item_id"])][($row_pguide[$i]["comm_per_id"])]["prg_id"] = $row_pguide[$i]["prg_id"];
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



		echo $this->renderPartial('/priceGuideV2/design_show_inner', $result);
	}

	public function actionShowInnerUser($product = 1, $type = 1, $curr = 1)

	{

		$user_id = Yii::app()->user->getState('userKey');

		$prod_id = $product;

		$sat_id = $type;

		$curr_id = $curr;



		$comm_type = Yii::app()->user->getState('commissionType');



		$where = "";



		if ($sat_id == 3 && $comm_type == 7) {

			$sat_id = 2;

			$where = "AND (comm_value='7' OR comm_value='0')";
		}



		$sql_item = "SELECT *,t1.item_id as main_id FROM tbl_item AS t1 LEFT JOIN (SELECT * FROM tbl_lib_item

            WHERE user_id='" . $user_id . "') AS t2 ON (t1.`item_id` = t2.`item_id`) LEFT JOIN tbl_item_group ON t1.group_id=tbl_item_group.item_group_id WHERE t1.prod_id='" . $prod_id . "' AND t1.enable=1 ORDER BY tbl_item_group.sort ASC, t1.sort ASC; ";

		$result["a_item"] = Yii::app()->db->createCommand($sql_item)->queryAll();



		if (sizeof($result["a_item"]) == 0) {



			echo '<div style="width:100%; text-align: center;" class="alert alert-warning">Empty!!</div>';

			exit();
		}



		$a_item_id_list = array();

		for ($i = 0; $i < sizeof($result["a_item"]); $i++) {

			$a_item_id_list[] = $result["a_item"][$i]["main_id"];
		}

		$s_item_id_list = implode(",", $a_item_id_list);

		$sql_comm = "SELECT * FROM tbl_comm_percent WHERE sat_id='" . $sat_id . "' AND enable=1 " . $where . " ORDER BY sort ASC; ";

		$result["a_comm"] = Yii::app()->db->createCommand($sql_comm)->queryAll();



		$a_comm_per_id = array();

		for ($k = 0; $k < sizeof($result["a_comm"]); $k++) {

			$a_comm_per_id[] = $result["a_comm"][$k]["comm_per_id"];
		}

		$s_comm_per_id_list = implode(",", $a_comm_per_id);



		$sql_price_guide = "SELECT * FROM tbl_price_guide WHERE sat_id='" . $sat_id . "' AND curr_id='" . $curr_id . "' AND item_id IN (" . $s_item_id_list . ")  ";

		if (sizeof($a_comm_per_id) > 0) {

			$sql_price_guide .= " AND comm_per_id IN (" . $s_comm_per_id_list . ") ";
		}

		$row_pguide = Yii::app()->db->createCommand($sql_price_guide)->queryAll();

		$a_pguide = array();



		for ($i = 0; $i < sizeof($row_pguide); $i++) {

			//$a_pguide[($row_pguide[$i]["item_id"])][($row_pguide[$i]["comm_per_id"])]["price"] = $row_pguide[$i]["price"];

			//$a_pguide[($row_pguide[$i]["item_id"])][($row_pguide[$i]["comm_per_id"])]["prg_id"] = $row_pguide[$i]["prg_id"];

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



		echo $this->renderPartial('/priceGuideV2/show_inner_user', $result);
	}



	public function actionAddToCart()

	{



		$user_id = Yii::app()->user->getState('userKey');



		if (!isset($_POST["prg_id"]) || $_POST["prg_id"] == "") {

			echo "Invalid parameter.";

			exit();
		}



		$prg_id = $_POST["prg_id"];



		$sql_select = "SELECT tbl_price_guide.*,tbl_product.prod_type,tbl_comm_percent.comm_value,tbl_comm_percent.qty_name,tbl_item.item_name";

		$sql_select .= ",CONCAT(IF(tbl_item.item_style IS NULL,'',tbl_item.item_style),IF(tbl_item.item_detail IS NULL,'',tbl_item.item_detail),IF(tbl_item.item_fabric_opt IS NULL,'',tbl_item.item_fabric_opt)) AS desc_show ";

		$sql_select .= " FROM tbl_price_guide ";

		$sql_select .= " LEFT JOIN tbl_item ON tbl_price_guide.item_id=tbl_item.item_id ";

		$sql_select .= " LEFT JOIN tbl_product ON tbl_item.prod_id=tbl_product.prod_id ";

		$sql_select .= " LEFT JOIN tbl_comm_percent ON tbl_price_guide.comm_per_id=tbl_comm_percent.comm_per_id ";

		$sql_select .= " WHERE tbl_price_guide.prg_id='" . $prg_id . "'; ";



		$row_select = Yii::app()->db->createCommand($sql_select)->queryAll();

		$row_prg = $row_select[0];



		$have_tmp = 0;

		$a_tmp_obj = array();



		if (isset($_COOKIE["JOG_CART_info"])) {

			$sql_select = " SELECT * FROM tbl_cart_temp WHERE cart_tmp_id='" . $_COOKIE["JOG_CART_info"] . "'; ";

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

			// 			$a_cart_info["item"][0]["desc_show"] = str_replace(",", ",\n", $row_prg["desc_show"]);
			$a_cart_info["item"][0]["desc_show"] = $row_prg["desc_show"];

			$a_cart_info["item"][0]["addi_id_list"] = "";

			$a_cart_info["item"][0]["qty"] = 0;



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



			/*for($i=0;$i<$next_index;$i++){

				$a_tmp = (array)$a_item[$i];

				if( ($a_tmp["item_id"]==$row_prg["item_id"]) ){

					$flag_dup = 1;

				}

			}



			if($flag_dup==1){

				echo "Duplicate product";

				exit();

			}*/



			$obj_cart_info["item"] = (array)$obj_cart_info["item"];



			$obj_cart_info["item"][$next_index] = array();



			$obj_cart_info["item"][$next_index]["product_type"] = $row_prg["prod_type"];

			$obj_cart_info["item"][$next_index]["item_id"] = $row_prg["item_id"];

			$obj_cart_info["item"][$next_index]["prg_id"] = $row_prg["prg_id"];

			$obj_cart_info["item"][$next_index]["uprice"] = $row_prg["price"];

			$obj_cart_info["item"][$next_index]["qty_note"] = $row_prg["qty_name"];

			$obj_cart_info["item"][$next_index]["comm_percent"] = $row_prg["comm_value"];



			$obj_cart_info["item"][$next_index]["item_name"] = $row_prg["item_name"];

			// 			$obj_cart_info["item"][$next_index]["desc_show"] = str_replace(",", ",\n", $row_prg["desc_show"]);

			$obj_cart_info["item"][$next_index]["desc_show"] = $row_prg["desc_show"];

			$obj_cart_info["item"][$next_index]["addi_id_list"] = "";

			$obj_cart_info["item"][$next_index]["qty"] = 0;



			$tmp_json = json_encode($obj_cart_info);

			$sql_update_tmp = "UPDATE tbl_cart_temp SET obj_tmp='" . base64_encode($tmp_json) . "' WHERE cart_tmp_id='" . $_COOKIE["JOG_CART_info"] . "';";

			Yii::app()->db->createCommand($sql_update_tmp)->execute();



			//setcookie("JOG_CART_info",json_encode($obj_cart_info));



			$return_result = "success";
		}



		echo $return_result;
	}



	public function actionAddToCartUser()

	{



		$user_id = Yii::app()->user->getState('userKey');



		if (!isset($_POST["prg_id"]) || $_POST["prg_id"] == "") {

			echo "Invalid parameter.";

			exit();
		}



		$prg_id = $_POST["prg_id"];



		$sql_select = "SELECT tbl_price_guide.*,tbl_product.prod_type,tbl_comm_percent.comm_value,tbl_comm_percent.qty_name,tbl_item.item_name,t2.description";

		$sql_select .= ",CONCAT(IF(tbl_item.item_style IS NULL,'',tbl_item.item_style),IF(tbl_item.item_detail IS NULL,'',tbl_item.item_detail),IF(tbl_item.item_fabric_opt IS NULL,'',tbl_item.item_fabric_opt)) AS desc_show ";

		$sql_select .= " FROM tbl_price_guide ";

		$sql_select .= " LEFT JOIN tbl_item ON tbl_price_guide.item_id=tbl_item.item_id ";

		$sql_select .= " LEFT JOIN (SELECT * FROM tbl_lib_item

            WHERE user_id='" . $user_id . "') AS t2 ON (tbl_item.`item_id` = t2.`item_id`)";

		$sql_select .= " LEFT JOIN tbl_product ON tbl_item.prod_id=tbl_product.prod_id ";

		$sql_select .= " LEFT JOIN tbl_comm_percent ON tbl_price_guide.comm_per_id=tbl_comm_percent.comm_per_id ";

		$sql_select .= " WHERE tbl_price_guide.prg_id='" . $prg_id . "'; ";

		$row_select = Yii::app()->db->createCommand($sql_select)->queryAll();

		$row_prg = $row_select[0];



		$have_tmp = 0;

		$a_tmp_obj = array();



		if (isset($_COOKIE["JOG_CART_info"])) {

			$sql_select = " SELECT * FROM tbl_cart_temp WHERE cart_tmp_id='" . $_COOKIE["JOG_CART_info"] . "'; ";

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

			if ($row_prg["description"] == "" || $row_prg["description"] == NULL) {

				$a_cart_info["item"][0]["desc_show"] = str_replace(",", "\n", $row_prg["desc_show"]);
			} else {

				$a_cart_info["item"][0]["desc_show"] = str_replace(",", "\n", $row_prg["description"]);
			}

			$a_cart_info["item"][0]["addi_id_list"] = "";

			$a_cart_info["item"][0]["qty"] = 0;



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



			/*for($i=0;$i<$next_index;$i++){

				$a_tmp = (array)$a_item[$i];

				if( ($a_tmp["item_id"]==$row_prg["item_id"]) ){

					$flag_dup = 1;

				}

			}



			if($flag_dup==1){

				echo "Duplicate product";

				exit();

			}*/



			$obj_cart_info["item"] = (array)$obj_cart_info["item"];



			$obj_cart_info["item"][$next_index] = array();



			$obj_cart_info["item"][$next_index]["product_type"] = $row_prg["prod_type"];

			$obj_cart_info["item"][$next_index]["item_id"] = $row_prg["item_id"];

			$obj_cart_info["item"][$next_index]["prg_id"] = $row_prg["prg_id"];

			$obj_cart_info["item"][$next_index]["uprice"] = $row_prg["price"];

			$obj_cart_info["item"][$next_index]["qty_note"] = $row_prg["qty_name"];

			$obj_cart_info["item"][$next_index]["comm_percent"] = $row_prg["comm_value"];



			$obj_cart_info["item"][$next_index]["item_name"] = $row_prg["item_name"];



			if ($row_prg["description"] == "" || $row_prg["description"] == NULL) {

				$obj_cart_info["item"][$next_index]["desc_show"] = str_replace(",", "\n", $row_prg["desc_show"]);
			} else {

				$obj_cart_info["item"][$next_index]["desc_show"] = str_replace(",", "\n", $row_prg["description"]);
			}



			$obj_cart_info["item"][$next_index]["addi_id_list"] = "";

			$obj_cart_info["item"][$next_index]["qty"] = 0;



			$tmp_json = json_encode($obj_cart_info);

			$sql_update_tmp = "UPDATE tbl_cart_temp SET obj_tmp='" . base64_encode($tmp_json) . "' WHERE cart_tmp_id='" . $_COOKIE["JOG_CART_info"] . "';";

			Yii::app()->db->createCommand($sql_update_tmp)->execute();



			//setcookie("JOG_CART_info",json_encode($obj_cart_info));



			$return_result = "success";
		}



		echo $return_result;
	}



	public function actionShowCart()

	{



		//$n_flag_data = 0;

		$currency = "";

		$quote_curr = "";

		$count_row = 1;



		$html_table = '<table id="tbl_cart_info" class="tbl-cart-info"><tr class="stickyheader"><th style="width:20px; text-align:center;">#</th><th style="width:150px;" >Product</th><th>Description</th><th style="text-align:center;">Additional</th><th style="text-align:center; width:75px;">Note</th><th style="width:20px; text-align:center;">QTY</th><th style="width:90px; text-align:center;">Price</th><th style="width:70px; text-align:center;">Amount</th><th style="width:60px; text-align:center;">Action</th></tr>';



		if (isset($_COOKIE["JOG_CART_info"]) && ($_COOKIE["JOG_CART_info"] != "")) {



			$sql_select = " SELECT * FROM tbl_cart_temp WHERE cart_tmp_id='" . $_COOKIE["JOG_CART_info"] . "'; ";

			$a_tmp_obj = Yii::app()->db->createCommand($sql_select)->queryAll();

			$s_tmp_obj = base64_decode($a_tmp_obj[0]["obj_tmp"]);



			$obj_cart_info = json_decode($s_tmp_obj);



			$suffix_field = "";

			if ($obj_cart_info->currency != "0") {

				$suffix_field = $obj_cart_info->currency;
			}



			$a_item = (array)$obj_cart_info->item;



			for ($i = 0; $i < sizeof($a_item); $i++) {



				$row = (array)$a_item[$i];



				$other_param = "";

				$tmp_type = $row["product_type"];

				$tmp_id = $row["item_id"] . "_" . ($count_row);

				if ($tmp_type == "other") {

					$tmp_id = "other_" . ($count_row);

					$other_param = ",1";
				} else if ($tmp_type == "extra") {

					$tmp_id = "extra_" . ($count_row);

					$other_param = ",2";
				}



				$html_table .= '<tbody class="thatTbody" id="tr_' . $tmp_id . '">
				<td style="text-align:center;" class="tableFilterMove">
					<div style="display:flex; flex-direction: column;">
					
						<span style="cursor:pointer; color:#939393; line-height:0;" class="moveUpArrow">
						 
					<img src="https://sales-test.jog-joinourgame.com/images/icons/dragTable.png" alt="" class="iconImg">
						</span> 
						 
					</div>                      
				</td>
                    
                 ';

				$html_table .= '<input name="product_type[]" type="hidden" value="' . $row["product_type"] . '" id="product_' . $tmp_id . '">';

				$html_table .= '<input name="item_id[]" type="hidden" value="' . $row["item_id"] . '" id="item_id_' . $tmp_id . '">';

				$html_table .= '<input name="tmp_id[]" type="hidden" value="' . $tmp_id . '" >';

				$html_table .= '<input name="prg_id[]" type="hidden" value="' . $row["prg_id"] . '" id="prg_id_' . $tmp_id . '">';

				$tmp_comm_percent = "";

				if ($row["qty_note"] != "MSRP") {

					$tmp_comm_percent = $row["comm_percent"];
				}

				$html_table .= '<input name="comm_percent[]" type="hidden" value="' . $tmp_comm_percent . '" id="comm_percent_' . $tmp_id . '">';

				$html_table .= '<input name="qty_note[]" type="hidden" value="' . $row["qty_note"] . '" id="qty_note_' . $tmp_id . '">';

				$html_table .= '</td>';



				$user_group = Yii::app()->user->getState('userGroup');

				$user_id = Yii::app()->user->getState('userKey');



				if ($user_group != "1" && $user_group != "99") {



					$readonly = "readonly";
				} else {

					$readonly = "";
				}



				$html_table .= '<td><textarea hello style="min-height:80px; padding:5px;" name="product_item[]" id="product_item_' . $tmp_id . '" ' . $readonly . '>' . $row["item_name"] . '</textarea></td>';

				$html_table .= '<td><textarea style="min-height:80px; padding:5px;" name="product_desc[]" id="product_desc_' . $tmp_id . '">' . $row["desc_show"] . '</textarea>';

				//$html_table .= '<pre>'.json_encode($row).'</pre>';

				$html_table .= '</td>';

				$html_table .= '<td>';



				$a_addi_id = array();

				if ($row["addi_id_list"] != "") {

					$a_addi_id = explode(",", $row["addi_id_list"]);
				}



				$f_addi_val = 0.0;



				if ($tmp_type != "other" && $tmp_type != "extra") {



					$html_table .= '<select name="addi_id[' . $tmp_id . '][]" multiple id="select_addi_' . $tmp_id . '" onchange="return selectAddiV2(\'' . $tmp_id . '\');">';

					$sql2 = " SELECT * FROM tbl_additional_new WHERE item_id='" . $row["item_id"] . "' AND curr_id='" . $obj_cart_info->currency . "' ORDER BY ordering ASC;";

					$addi_list = Yii::app()->db->createCommand($sql2)->queryAll();

					foreach ($addi_list as $key_addi => $row_addi) {



						if (floatval($row_addi["addi_value"]) != 0) {

							$show_addi_val = " ";

							if (floatval($row_addi["addi_value"]) > 0) {

								$show_addi_val .= "+";
							}

							$show_addi_val .= $row_addi["addi_value"];



							$html_table .= '<option value="' . $row_addi["addi_id"] . '|' . $row_addi["addi_value"] . '" ';

							if (in_array($row_addi["addi_id"], $a_addi_id)) {

								$html_table .= 'selected';

								$f_addi_val += floatval($row_addi["addi_value"]);
							}

							$html_table .= '>' . $row_addi["addi_name"] . $show_addi_val . '</option>';
						}
					}

					$html_table .= '<option value="0|0.0">= Nothing =</option>';

					$html_table .= '</select>';
				}

				//$html_table .= $sql2;



				$html_table .= '</td>';

				$html_table .= '<td style="text-align:center;">';



				if ($row["qty_note"] != "") {

					if ($row["qty_note"] != "MSRP") {

						$html_table .= $row["qty_note"] . '<br>Com. ' . $row["comm_percent"] . '%';
					} else {

						$html_table .= 'MSRP';
					}
				}



				$html_table .= '</td>';

				$html_table .= '<td style="text-align:center;">';

				$html_table .= '<input class="chk_qty" name="qty[]" id="qty_' . $tmp_id . '" type="number" min="0" style="text-align:center; width:50px; padding:4px 0;" onchange="return calPriceV2(\'' . $tmp_id . '\'' . $other_param . ');" onkeyup="return calPriceV2(\'' . $tmp_id . '\'' . $other_param . ');" value="' . $row["qty"] . '">';

				$html_table .= '</td>';



				$html_table .= '<td style="text-align:center;">';



				$show_uprice = $row["uprice"];

				if ($tmp_type == "other") {



					//$tmp_other_id = "other".$tmp_id;



					$html_table .= '<input class="chk_uprice" name="uprice[]" type="number" min="0" id="uprice_' . $tmp_id . '" style="text-align:center; width:100%; " onchange="return calPriceV2(\'' . $tmp_id . '\',1);" onkeyup="return calPriceV2(\'' . $tmp_id . '\',1);" value="' . $show_uprice . '">';
				} else {



					$show_uprice = floatval($row["uprice"]) + $f_addi_val;

					$html_table .= '<input name="uprice[]" type="hidden" id="uprice_' . $tmp_id . '" value="' . $row["uprice"] . '">';

					$html_table .= '<span id="show_uprice_' . $tmp_id . '">' . $show_uprice . '</span>';
				}

				$html_table .= '</td>';



				$show_amount = number_format((intval($row["qty"]) * floatval($show_uprice)), 2, ".", "");



				$html_table .= '<td style="text-align:center;" id="amount_' . $tmp_id . '">' . $show_amount . '</td>';

				$html_table .= '<td style="text-align:center;"><button type="button" class="btn btn-danger" onclick="return deleteRowV2(\'' . $tmp_id . '\');">Del</button></td>';

				$html_table .= '</tr></tbody>';

				$count_row++;
			}





			$html_table .= '</table>';

			$html_table .= '<input name="count_item_row" type="hidden" value="' . $count_row . '" id="count_item_row">';



			$sql_curr = " SELECT * FROM tbl_currency WHERE curr_id='" . $obj_cart_info->currency . "'; ";

			$a_tmp_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

			$currency = $a_tmp_curr[0]["curr_name"] . " " . $a_tmp_curr[0]["curr_desc"];

			$quote_curr = $a_tmp_curr[0]["curr_name"];



			$html_table .= '<input name="quote_curr" type="hidden" value="' . $quote_curr . '" id="quote_curr">';

			$html_table .= '<input name="curr_id" type="hidden" value="' . $obj_cart_info->currency . '" id="curr_id">';



			$a_data["found_data"] = "yes";

			$a_data["currency"] = $currency;

			$a_data["cart_inner"] = $html_table;



			//$n_flag_data = 1;



		} else {



			$a_data["found_data"] = "no";

			$a_data["currency"] = "";

			$a_data["cart_inner"] = "<center>Empty!</center>";
		}



		echo json_encode($a_data);
	}



	public function actionClearCart()

	{

		setcookie("JOG_CART_info", "", time() - 3600);

		setcookie("JOG_CART_extra", "", time() - 3600);

		setcookie("JOG_CART_Quote", "", time() - 3600);

		echo "success";
	}



	public function actionUpdateCart()

	{



		$n_loop = sizeof($_POST["item_id"]);



		if ($n_loop > 0) {



			$a_new_obj = array();

			$a_new_obj["currency"] = $_POST["curr_id"];



			for ($i = 0; $i < $n_loop; $i++) {



				$a_new_obj["item"][$i]["product_type"] = $_POST["product_type"][$i];

				$a_new_obj["item"][$i]["item_id"] = $_POST["item_id"][$i];

				$a_new_obj["item"][$i]["prg_id"] = $_POST["prg_id"][$i];

				$a_new_obj["item"][$i]["uprice"] = $_POST["uprice"][$i];

				$a_new_obj["item"][$i]["qty_note"] = $_POST["qty_note"][$i];

				$a_new_obj["item"][$i]["comm_percent"] = $_POST["comm_percent"][$i];



				$a_new_obj["item"][$i]["item_name"] = $_POST["product_item"][$i];

				$a_new_obj["item"][$i]["desc_show"] = $_POST["product_desc"][$i];



				$p_id = $_POST["item_id"][$i];

				$addi_id_list = "";

				if (isset($_POST["addi_id"][$p_id])) {

					for ($j = 0; $j < sizeof($_POST["addi_id"][$p_id]); $j++) {

						$a_addi_id = explode("|", $_POST["addi_id"][$p_id][$j]);

						$addi_id = $a_addi_id[0];

						if ($addi_id_list != "") {

							$addi_id_list .= ",";
						}

						$addi_id_list .= $addi_id;
					}
				}



				$a_new_obj["item"][$i]["addi_id_list"] = $addi_id_list;

				$a_new_obj["item"][$i]["qty"] = $_POST["qty"][$i];
			}



			$tmp_json = json_encode($a_new_obj);



			if (isset($_COOKIE["JOG_CART_info"])) {



				$sql_update_tmp = "UPDATE tbl_cart_temp SET obj_tmp='" . base64_encode($tmp_json) . "' WHERE cart_tmp_id='" . $_COOKIE["JOG_CART_info"] . "';";

				Yii::app()->db->createCommand($sql_update_tmp)->execute();
			} else {



				$user_id = Yii::app()->user->getState('userKey');



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



		echo json_encode($a_result);
	}



	public function actionSaveCart()

	{



		$user_id = Yii::app()->user->getState('userKey');



		//$obj_cart_info = json_decode($_COOKIE["JOG_CART_info"]);

		$curr_id = $_POST["curr_id"];



		$inner_value = base64_encode(json_encode($_POST));



		$tmp_datetime = date("Y-m-d H:i:s");



		$a_result["draft_name"] = "";

		$extra_field = "";

		$extra_value = "";

		if (isset($_POST["is_draft"]) && $_POST["is_draft"] == "yes") {

			$draft_name = $_POST["draft_name"];

			$extra_field = ",is_draft,draft_name";

			$extra_value = ",'1','" . addslashes($draft_name) . "'";



			$a_result["draft_name"] = $draft_name;
		}



		$sql_insert_save = "INSERT INTO tbl_cart_save (user_id,currency_num,inner_value,save_time" . $extra_field . ") VALUES (";

		$sql_insert_save .= "'" . $user_id . "','" . $curr_id . "','" . $inner_value . "','" . $tmp_datetime . "'" . $extra_value;

		$sql_insert_save .= "); ";

		Yii::app()->db->createCommand($sql_insert_save)->execute();



		$a_result["carts_id"] = Yii::app()->db->getLastInsertID();



		$a_result["save_time"] = $tmp_datetime;



		$a_result["result"] = "success";

		echo json_encode($a_result);
	}



	public function actionDeleteCartSave()

	{



		$carts_id = $_POST["carts_id"];



		$sql_delete = "DELETE FROM tbl_cart_save WHERE carts_id='" . $carts_id . "'; ";



		if (Yii::app()->db->createCommand($sql_delete)->execute()) {

			$a_result["result"] = "success";
		} else {

			$a_result["result"] = "fail";

			$a_result["msg"] = "Fail to delete draft";
		}



		echo json_encode($a_result);
	}



	public function actionLoadCart()

	{



		$carts_id = $_POST["carts_id"];



		$sql_load = "SELECT * FROM tbl_cart_save WHERE carts_id='" . $carts_id . "'; ";

		$a_load = Yii::app()->db->createCommand($sql_load)->queryAll();



		$a_data = (array)json_decode(base64_decode($a_load[0]["inner_value"]));



		$html_table = '<table id="tbl_cart_info" class="tbl-cart-info"><tr><th style="width:20px; text-align:center;">#</th><th style="width:150px;" >Product</th><th>Description</th><th style="text-align:center;">Additional</th><th style="text-align:center; width:75px;">Note</th><th style="width:20px; text-align:center;">QTY</th><th style="width:90px; text-align:center;">Price</th><th style="width:70px; text-align:center;">Amount</th><th style="width:60px; text-align:center;">Action</th></tr>';





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



			$html_table .= '<tbody id="tr_' . $tmp_p . '"><tr><td style="text-align:center;">' . $count_row;

			$html_table .= '<input name="product_type[]" type="hidden" value="' . $tmp_s . '" id="product_' . $tmp_p . '">';

			$html_table .= '<input name="item_id[]" type="hidden" value="' . $tmp_p . '" id="id_' . $tmp_p . '">';

			$html_table .= '<input name="tmp_id[]" type="hidden" value="' . $tmp_p . '" >';

			$html_table .= '<input name="prg_id[]" type="hidden" value="' . $a_data["prg_id"][$i] . '" id="prg_id_' . $tmp_p . '">';

			$tmp_comm_percent = "";



			$html_table .= '<input name="comm_percent[]" type="hidden" value="' . $a_data["comm_percent"][$i] . '" id="comm_percent_' . $tmp_p . '">';

			$html_table .= '<input name="qty_note[]" type="hidden" value="' . $a_data["qty_note"][$i] . '" id="qty_note_' . $tmp_p . '">';

			$html_table .= '</td>';

			$html_table .= '<td><textarea style="min-height:80px;padding:5px;" name="product_item[]" id="product_item_' . $tmp_p . '">' . $a_data["product_item"][$i] . '</textarea></td>';

			$html_table .= '<td><textarea style="min-height:80px; padding:5px;" name="product_desc[]" id="product_desc_' . $tmp_p . '">' . $a_data["product_desc"][$i] . '</textarea></td>';

			$html_table .= '<td>';



			if ($tmp_s != "other") {

				$html_table .= '<select name="addi_id[' . $tmp_p . '][]" multiple id="select_addi_' . $tmp_p . '" onchange="return selectAddiV2(\'' . $tmp_p . '\');">';

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



						$html_table .= '<option value="' . $row_addi["addi_id"] . '|' . $row_addi["addi_value"] . '" ';



						if (isset($a_addi_load[$tmp_p])) {

							foreach ($a_addi_load[$tmp_p] as $addi_key3 => $a_addi_select) {

								if ($row_addi["addi_id"] == $a_addi_select["id"]) {

									$html_table .= 'selected';

									$tmp_uprice += floatval($a_addi_select["value"]);

									break;
								}
							}
						}



						$html_table .= '>' . $row_addi["addi_name"] . $show_addi_val . '</option>';
					}
				}

				$html_table .= '<option value="0|0.0">= Nothing =</option>';

				$html_table .= '</select>';
			}

			$html_table .= '</td>';

			$html_table .= '<td style="text-align:center;">';



			if ($tmp_s != "other") {

				$html_table .= $a_data["qty_note"][$i] . '<br>Com. ' . $a_data["comm_percent"][$i];
			}



			$html_table .= '</td>';

			$html_table .= '<td style="text-align:center;">';

			$html_table .= '<input class="chk_qty" name="qty[]" id="qty_' . $tmp_p . '" type="number" min="0" style="text-align:center; width:50px; padding:4px 0;" onchange="return calPriceV2(\'' . $tmp_p . '\'';

			if ($tmp_s == "other") {

				$html_table .= ',1';
			}

			$html_table .= ');" onkeyup="return calPriceV2(\'' . $tmp_p . '\'';

			if ($tmp_s == "other") {

				$html_table .= ',1';
			}

			$html_table .= ');" value="' . $a_data["qty"][$i] . '">';

			$html_table .= '</td>';



			if ($tmp_s == "other") {

				$html_table .= '<td style="text-align:center;"><input class="chk_uprice" name="uprice[]" type="number" min="0" id="uprice_' . $tmp_p . '" value="' . $a_data["uprice"][$i] . '" style="text-align:center; width:100%; " onchange="return calPriceV2(\'' . $tmp_p . '\',1);" onkeyup="return calPriceV2(\'' . $tmp_p . '\',1);"></td>';
			} else {

				$html_table .= '<td style="text-align:center;"><input name="uprice[]" type="hidden" id="uprice_' . $tmp_p . '" value="' . $a_data["uprice"][$i] . '"><span id="show_uprice_' . $tmp_p . '">' . $tmp_uprice . '</span></td>';
			}



			$html_table .= '<td style="text-align:center;" id="amount_' . $tmp_p . '"></td>';

			$html_table .= '<td style="text-align:center;"><button type="button" class="btn btn-danger" onclick="return deleteRowV2(\'' . $tmp_p . '\'';

			if ($tmp_s == "other") {

				$html_table .= ',1';
			} else {

				$html_table .= ',2';
			}

			$html_table .= ');">Del</button></td>';

			$html_table .= '</tr></tbody>';

			$count_row++;
		}



		$html_table .= '</table>';

		$html_table .= '<input name="count_item_row" type="hidden" value="' . $count_row . '" id="count_item_row">';



		$currency = "";

		$quote_curr = "";

		$sql_curr = " SELECT * FROM tbl_currency WHERE curr_id='" . $a_data["curr_id"] . "'; ";

		$a_tmp_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

		$currency = $a_tmp_curr[0]["curr_name"] . " " . $a_tmp_curr[0]["curr_desc"];

		$quote_curr = $a_tmp_curr[0]["curr_name"];



		$html_table .= '<input name="quote_curr" type="hidden" value="' . $quote_curr . '" id="quote_curr">';

		$html_table .= '<input name="curr_id" type="hidden" value="' . $a_data["curr_id"] . '" id="curr_id">';



		$a_result["currency"] = $currency;

		$a_result["form_inner"] = base64_encode($html_table);



		$a_result["tmp_html_id"] = $tmp_html_id;

		$a_result["num_item"] = $a_data["num_item"];



		$a_result["result"] = "success";

		echo json_encode($a_result);
	}



	public function actionShowQuoteFormUpdate()

	{

		$curr_id = $_POST['curr_id'];

		$symbol = $_POST['symbol'];

		if ($_POST['or_curr_id'] == "1") {

			$oldest_curr_id = $_POST['or_curr_id'];

			$old_data = json_decode(base64_decode($_POST['post_data']));

			$_POST = [];

			//$_POST = $old_data;

			$_POST = json_decode(json_encode($old_data), true);

			$_POST['curr_id'] = $curr_id;

			$_POST['quote_curr'] = $symbol;

			$all_data = $_POST;

			$is_old_process = "0";

			if (isset($_POST["is_old_process"])) {

				$is_old_process = $_POST["is_old_process"];
			}



			$return_html = '<div class="row">';

			$return_html .= '<div class="col-md-8" style="text-align:left; padding:20px 0px;">';

			$return_html .= 'BILL TO<br>';



			$return_html .= '<select id="cust_selector" name="cust_selector" onchange="return changeCustomerV2();"><option value="">=Select Customer=</option>';

			$user_group = Yii::app()->user->getState('userGroup');

			$user_id = Yii::app()->user->getState('userKey');



			$more_condition = "";

			// if ($user_group != "1" && $user_group != "99") {



			// 	$more_condition = " AND user_id='" . $user_id . "' ";
			// }

			$sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 " . $more_condition . " AND add_date >= '2025-02-12' ORDER BY cust_name ASC; ";

			$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();

			foreach ($a_cust as $tmp_key => $row_cust) {

				$return_html .= '<option value="' . $row_cust["cust_id"] . '">' . $row_cust["cust_name"] . '</option>';
			}

			$return_html .= '</select><pre id="pr_show_cust_info"></pre>';

			$return_html .= '
			<div >
				<label for="salestax">Sales Tax</label><br>
				<select name="sales_tax" id="sales_tax">
					<option value="">Select Sales Tax</option>
					<option value="Exempt">Exempt</option>
					<option value="Non Exempt">Non Exempt</option>				
				</select>
			</div>';

			$return_html .= '</div>';

			$return_html .= '<div class="col-md-4" style="text-align:right; padding:20px 0px;">';

			$return_html .= '<table class="est_zone" style="width:100%; border-collapse: separate; border-spacing: 10px;">';

			$return_html .= '<tr><th width="50%">Estimate Number: </th><td id="td_auto_code" style="color:#00F;">[Auto generate]</td></tr>';

			$return_html .= '<tr><th >PO Number: </th><td><input type="text" style="width:100px;" name="po_number" maxlength="30"></td></tr>';

			$est_date = date("Y-m-d");

			$return_html .= '<tr><th>Estimate Date: </th><td><input type="hidden" name="est_date" value="' . $est_date . '">' . date("F d, Y", strtotime($est_date)) . '</td></tr>';

			$exp_date = date("Y-m-d", strtotime("+30 days", strtotime($est_date)));

			$return_html .= '<tr><th>Expires On: </th><td><input type="hidden" name="exp_date" value="' . $exp_date . '">' . date("F d, Y", strtotime($exp_date)) . '</td></tr>';

			$return_html .= '<tr><th>Grand Total (' . $_POST["quote_curr"] . '): </th><td id="td_grand_total"></td></tr>';

			$return_html .= '</table>';

			$return_html .= '</div>';

			$return_html .= '<div class="col-md-12">';

			$return_html .= '<input type="hidden" name="quote_curr" value="' . $_POST["quote_curr"] . '">';

			$return_html .= '<input type="hidden" name="curr_id" value="' . $_POST["curr_id"] . '">';
			$return_html .= '<input type="hidden" name="duplicate_by" value="' . $_POST["duplicate_by"] . '">';

			$return_html .= '<input name="is_duplicate" id="is_duplicate" type="hidden" value="' . (isset($_POST["is_duplicate"]) ? $_POST["is_duplicate"] : "0") . '" >';



			if (isset($_POST["edit_quote_id"])) {



				$return_html .= '<input name="edit_quote_id" id="qdoc_id_old" type="hidden" value="' . $_POST["edit_quote_id"] . '">';

				$return_html .= '<input name="edit_est_number" id="est_number_old" type="hidden" value="' . $_POST["edit_est_number"] . '">';

				$return_html .= '<input name="edit_comp_id" id="comp_id_old" type="hidden" value="' . $_POST["edit_comp_id"] . '" >';

				$return_html .= '<input name="edit_cust_id" id="cust_id_old" type="hidden" value="' . $_POST["edit_cust_id"] . '">';

				$return_html .= '<input name="edit_payment_term" id="payment_term_old" type="hidden" value="' . $_POST["edit_payment_term"] . '">';

				$return_html .= '<input name="edit_inc_vat" id="inc_vat_old" type="hidden" value="' . $_POST["edit_inc_vat"] . '">';
			}





			$return_html .= '<table class="item_zone" style="width:100%;">';

			$return_html .= '<tr><th width="60%">Product</th><th style="text-align:center;">Quantity</th><th style="text-align:right; width:140px;">Price</th><th style="text-align:right; width:120px;">Amount</th></tr>';



			$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $_POST["curr_id"] . "'; ";

			$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();



			$pre_cost = $a_curr[0]["curr_symbol"];

			$quote_currency = $a_curr[0]["quote_currency"];



			$sub_total = 0.0;



			for ($i = 0; $i < sizeof($_POST["item_id"]); $i++) {



				$item_id = $_POST["item_id"][$i];



				$tmp_qty = isset($_POST["qty"][$i]) ? intval($_POST["qty"][$i]) : 0;

				$tmp_uprice = isset($_POST["uprice"][$i]) ? floatval($_POST["uprice"][$i]) : 0.0;

				$tmp_uprice;



				$s_addi_id = "";

				$s_addi_name = "";

				$tmp_adj = 0.0;



				$product_type = $_POST["product_type"][$i];



				$tmp_id = $_POST["tmp_id"][$i];



				if (isset($_POST["addi_id"][$tmp_id])) {

					$a_addi_id = array();

					$a_addi_val = array();

					foreach ($_POST["addi_id"][$tmp_id] as $tmp_key2 => $s_adj) {

						$a_tmp_adj = explode("|", $s_adj);

						$f_adj = floatval($a_tmp_adj[1]);

						$a_addi_id[] = floatval($a_tmp_adj[0]);

						$a_addi_val[($a_tmp_adj[0])] = floatval($a_tmp_adj[1]);

						$tmp_adj += $f_adj;
					}



					$s_addi_id = implode(",", $a_addi_id);



					if ($is_old_process == "1") {

						$sql_addi = "SELECT addi_id,addi_name FROM tbl_additional WHERE addi_id IN (" . $s_addi_id . "); ";
					} else {

						$sql_addi = "SELECT addi_id,addi_name FROM tbl_additional_new WHERE addi_id IN (" . $s_addi_id . "); ";
					}



					$a_addi = Yii::app()->db->createCommand($sql_addi)->queryAll();



					$s_addi_name .= "<br><i>Price: " . $pre_cost . ($tmp_uprice * $quote_currency);



					$tmp_uprice += $tmp_adj;



					foreach ($a_addi as $tmp_key3 => $row_addi2) {

						$tmp_addi_val = $a_addi_val[($row_addi2["addi_id"])];

						$use_minus = "";

						if ($tmp_addi_val < 0) {

							$use_minus = "-";

							$tmp_addi_val = abs($tmp_addi_val);
						}

						$s_addi_name .= " + " . $row_addi2["addi_name"] . " <b>" . $use_minus . $pre_cost . number_format($tmp_addi_val * $quote_currency, 2) . "</b>";
					}



					$s_addi_name .= "</i>";
				}



				$tmp_amount = $tmp_qty * $tmp_uprice * $quote_currency;



				$return_html .= '<tr><td style="padding:10px 0px; display: block; white-space: pre-wrap; word-break: break-all; word-wrap: break-word;">';

				$return_html .= '<input type="hidden" name="item_id[]" value="' . $item_id . '">';

				$return_html .= '<input type="hidden" name="comm_percent[]" value="' . $_POST["comm_percent"][$i] . '">';

				$return_html .= '<input type="hidden" name="qty_note[]" value="' . $_POST["qty_note"][$i] . '">';

				$return_html .= '<input type="hidden" name="pro_type[]" value="' . $_POST["product_type"][$i] . '">';

				$return_html .= '<input type="hidden" name="pro_name[]" value="' . base64_encode($_POST["product_item"][$i]) . '">';

				$return_html .= '<input type="hidden" name="pro_desc[]" value="' . base64_encode($_POST["product_desc"][$i]) . '">';

				$return_html .= '<input type="hidden" name="qty[]" value="' . $_POST["qty"][$i] . '">';

				$return_html .= '<input type="hidden" name="uprice[]" value="' . $tmp_uprice * $quote_currency . '">';

				$return_html .= '<input type="hidden" name="uprice_ori[]" value="' . $_POST["uprice"][$i] * $quote_currency . '">';

				$return_html .= '<input type="hidden" name="addi_id_list[]" value="' . $s_addi_id . '">';

				$return_html .= '<input type="hidden" name="addi_desc[]" value="' . base64_encode($s_addi_name) . '">';



				$return_html .= '<b>' . $_POST["product_item"][$i] . '</b><br>' . $_POST["product_desc"][$i] . $s_addi_name . '</td>';

				$return_html .= '<td style="text-align:center;">' . $_POST["qty"][$i] . '</td>';



				$return_html .= '<td style="text-align:right;">' . $pre_cost . number_format($tmp_uprice * $quote_currency, 2) . '</td><td style="text-align:right;">' . $pre_cost . number_format($tmp_amount, 2) . '</td></tr>';



				$sub_total += $tmp_amount;
			}



			$sub_total = $sub_total;



			//$return_html .='<tr><td>Discount</td><td style="text-align:center;">1</td><td style="text-align:right;">$100.00</td><td style="text-align:right;">$100.00</td></tr>';



			$return_html .= '<tr><th>Design URL (<font color=red>Not shown in Quotation</font>)</th></tr>';

			$return_html .= '<tr><td><input type="url" name="design_url" placeholder="Type or Paste URL here, should start with http:// or https://" style="width:100%"></td></tr>';





			$return_html .= '<tr class="total_zone" style="border-top:1px solid #EEE;"><td colspan="2" style="padding-bottom:0px;"><b>Notes</b> (<font color=red>Not shown in Quotation</font>)</td><th style="text-align:right;"><span class="subnvat">Subtotal:</span></th>';

			$return_html .= '<td style="text-align:right;"><span class="subnvat" id="sp_show_sub_total">' . $pre_cost . number_format($sub_total, 2) . '</span>';

			$return_html .= '<input type="hidden" name="pre_cost" id="pre_cost" value="' . $pre_cost . '"><input type="hidden" name="sub_total" id="sub_total" value="' . $sub_total . '"></td></tr>';



			$vat_7percent = $sub_total * 0.07;

			$return_html .= '<tr class="total_zone" ><td colspan="2" rowspan="5" style="padding-top:0px;"><textarea style="width:100%; height:100%; border:1px solid #F00; resize: none;" name="sale_note"></textarea></td>';

			$return_html .= '<td style=" text-align:right;"><span class="subnvat"><input type="checkbox" name="inc_vat" id="inc_vat" value="yes" onclick="changeIncludeVAT();" > VAT 7%:</span></td>';

			$return_html .= '<td style="text-align:right;"><span class="subnvat" id="sp_show_vat_value"></span>'; //'.$pre_cost.number_format($vat_7percent,2).'

			$return_html .= '<input type="hidden" name="vat_value" id="vat_value" value="' . $vat_7percent . '"></td></tr>';



			$f_total = $sub_total; //+$vat_7percent;



			$return_html .= '<tr class="total_zone" ><th style="border-top:1px solid #EEE; text-align:left;"><div class="row"><div class="block">Discount (In %)&nbsp;&nbsp;:</div><div class="block">Actual Discount :</div></div></th>';

			$return_html .= '<th style="border-top:1px solid #EEE; text-align:right;"><div class="row"><div class="form-group col-xs-6"><input type="text" min="0" placeholder = "0" value="0" name="discount" class="number_disc"><input type="text" placeholder = "0" value="0" name="actual_discount" id="actual_disc"></div></div></th></tr>';



			//$return_html .= '<input type="hidden" name="gtotal_value" id="gtotal_value" value="'.$f_total.'"></th></tr>';



			$return_html .= '<tr class="total_zone" ><th style="border-top:1px solid #EEE; text-align:right;"><span class="subnvat">Total:</span></th>';

			$return_html .= '<td style="border-top:1px solid #EEE; text-align:right;"><span class="subnvat" id="sp_show_total_value">' . $pre_cost . number_format($f_total, 2) . '</span>';

			$return_html .= '<input type="hidden" name="total_value" id="total_value" value="' . $f_total . '"></td></tr>';



			$return_html .= '<tr class="total_zone" ><th style="border-top:1px solid #EEE; text-align:right;"><span class="subnvat">Grand </span>Total (' . $_POST["quote_curr"] . '):</th>';

			$return_html .= '<th style="border-top:1px solid #EEE; text-align:right;"><span id="sp_show_gtotal_value">' . $pre_cost . number_format($f_total, 2) . '</span>';

			$return_html .= '<input type="hidden" name="gtotal_value" id="gtotal_value" prefix="' . $pre_cost . '" value="' . $f_total . '"></th></tr>';



			$return_html .= '<tr class="total_zone" ><th style="border-top:1px solid #EEE; text-align:right;">Change Currency:</th>';

			$cur_sql = "SELECT * FROM tbl_currency";

			$curr_query = Yii::app()->db->createCommand($cur_sql)->queryAll();

			$select_html = "<select name='curr_name' style='width:100%;' id='change_curr_quote'>";

			foreach ($curr_query as $fetched) {

				$curr_select = "";

				if ($fetched['curr_id'] == $_POST["curr_id"]) {

					$curr_select = "selected";
				}

				$select_html .= "<option curr_symbol=" . $fetched['curr_name'] . " value=" . $fetched['curr_id'] . " $curr_select >" . $fetched["curr_name"] . " " . $fetched["curr_desc"] . "</option>";
			}

			$select_html .= "</select>";

			$return_html .= '<th style="border-top:1px solid #EEE; text-align:right;">' . $select_html . '</span>';

			$return_html .= '</th></tr>';



			// 		$return_html .= '<tr class="total_zone" ><th style="border-top:1px solid #EEE; text-align:right;"><span class="subnvat">Grand </span>Total ('.$_POST["quote_curr"].') (Including Discount, if any):</th>';

			// 		$return_html .= '<th style="border-top:1px solid #EEE; text-align:right;"><span id="sp_show_gtotal_value_discounted">'.$pre_cost.number_format($f_total,2).'</span>';

			// 		$return_html .= '<input type="hidden" name="gtotal_value_discounted" id="gtotal_value_discounted" value="'.$f_total.'"></th></tr>';



			$return_html .= '</table>';

			$return_html .= '</div>';



			$return_html .= '</div>';



			$return_html .= '<input type="hidden" id="post_data" value="' . base64_encode(json_encode($all_data)) . '">';

			$return_html .= '<input type="hidden" id="or_curr_id" value="' . $oldest_curr_id . '">';



			echo $return_html;
		} else {



			$oldest_curr_id = $_POST['or_curr_id'];

			$old_data = json_decode(base64_decode($_POST['post_data']));

			$_POST = [];

			//$_POST = $old_data;

			$_POST = json_decode(json_encode($old_data), true);

			$_POST['curr_id'] = $curr_id;

			$_POST['quote_curr'] = $symbol;

			$all_data = $_POST;

			$is_old_process = "0";

			if (isset($_POST["is_old_process"])) {

				$is_old_process = $_POST["is_old_process"];
			}



			$return_html = '<div class="row">';

			$return_html .= '<div class="col-md-8" style="text-align:left; padding:20px 0px;">';

			$return_html .= 'BILL TO :<br>';



			$return_html .= '<select id="cust_selector" name="cust_selector" onchange="return changeCustomerV2();"><option value="">=Select Customer=</option>';

			$user_group = Yii::app()->user->getState('userGroup');

			$user_id = Yii::app()->user->getState('userKey');



			$more_condition = "";

			// if ($user_group != "1" && $user_group != "99") {



			// 	$more_condition = " AND user_id='" . $user_id . "' ";
			// }

			$sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 " . $more_condition . " ORDER BY cust_name ASC; ";

			$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();

			foreach ($a_cust as $tmp_key => $row_cust) {

				$return_html .= '<option value="' . $row_cust["cust_id"] . '">' . $row_cust["cust_name"] . '</option>';
			}

			$return_html .= '</select><pre id="pr_show_cust_info"></pre>';

			$return_html .= '</div>';

			$return_html .= '<div class="col-md-4" style="text-align:right; padding:20px 0px;">';

			$return_html .= '<table class="est_zone" style="width:100%; border-collapse: separate; border-spacing: 10px;">';

			$return_html .= '<tr><th width="50%">Estimate Number: </th><td id="td_auto_code" style="color:#00F;">[Auto generate]</td></tr>';

			$return_html .= '<tr><th >PO Number: </th><td><input type="text" style="width:100px;" name="po_number" maxlength="30"></td></tr>';

			$est_date = date("Y-m-d");

			$return_html .= '<tr><th>Estimate Date: </th><td><input type="hidden" name="est_date" value="' . $est_date . '">' . date("F d, Y", strtotime($est_date)) . '</td></tr>';

			$exp_date = date("Y-m-d", strtotime("+30 days", strtotime($est_date)));

			$return_html .= '<tr><th>Expires On: </th><td><input type="hidden" name="exp_date" value="' . $exp_date . '">' . date("F d, Y", strtotime($exp_date)) . '</td></tr>';

			$return_html .= '<tr><th>Grand Total (' . $_POST["quote_curr"] . '): </th><td id="td_grand_total"></td></tr>';

			$return_html .= '</table>';

			$return_html .= '</div>';

			$return_html .= '<div class="col-md-12">';

			$return_html .= '<input type="hidden" name="quote_curr" value="' . $_POST["quote_curr"] . '">';

			$return_html .= '<input type="hidden" name="curr_id" value="' . $_POST["curr_id"] . '">';

			$return_html .= '<input name="is_duplicate" id="is_duplicate" type="hidden" value="' . (isset($_POST["is_duplicate"]) ? $_POST["is_duplicate"] : "0") . '" >';



			if (isset($_POST["edit_quote_id"])) {



				$return_html .= '<input name="edit_quote_id" id="qdoc_id_old" type="hidden" value="' . $_POST["edit_quote_id"] . '">';

				$return_html .= '<input name="edit_est_number" id="est_number_old" type="hidden" value="' . $_POST["edit_est_number"] . '">';

				$return_html .= '<input name="edit_comp_id" id="comp_id_old" type="hidden" value="' . $_POST["edit_comp_id"] . '" >';

				$return_html .= '<input name="edit_cust_id" id="cust_id_old" type="hidden" value="' . $_POST["edit_cust_id"] . '">';

				$return_html .= '<input name="edit_payment_term" id="payment_term_old" type="hidden" value="' . $_POST["edit_payment_term"] . '">';

				$return_html .= '<input name="edit_inc_vat" id="inc_vat_old" type="hidden" value="' . $_POST["edit_inc_vat"] . '">';
			}





			$return_html .= '<table class="item_zone" style="width:100%;">';

			$return_html .= '<tr><th width="60%">Product</th><th style="text-align:center;">Quantity</th><th style="text-align:right; width:140px;">Price</th><th style="text-align:right; width:120px;">Amount</th></tr>';



			$older_sql = "SELECT * FROM tbl_currency WHERE curr_id='" . $oldest_curr_id . "'; ";

			$a_curr_old = Yii::app()->db->createCommand($older_sql)->queryAll();

			$quote_currency_old = $a_curr_old[0]["quote_currency"];



			$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $_POST["curr_id"] . "'; ";

			$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();



			$pre_cost = $a_curr[0]["curr_symbol"];

			$quote_currency = $a_curr[0]["quote_currency"];



			$sub_total = 0.0;



			for ($i = 0; $i < sizeof($_POST["item_id"]); $i++) {



				$item_id = $_POST["item_id"][$i];



				$tmp_qty = isset($_POST["qty"][$i]) ? intval($_POST["qty"][$i]) : 0;

				$tmp_uprice = isset($_POST["uprice"][$i]) ? floatval($_POST["uprice"][$i]) : 0.0;

				$tmp_uprice;



				$s_addi_id = "";

				$s_addi_name = "";

				$tmp_adj = 0.0;



				$product_type = $_POST["product_type"][$i];



				$tmp_id = $_POST["tmp_id"][$i];



				if (isset($_POST["addi_id"][$tmp_id])) {

					$a_addi_id = array();

					$a_addi_val = array();

					foreach ($_POST["addi_id"][$tmp_id] as $tmp_key2 => $s_adj) {

						$a_tmp_adj = explode("|", $s_adj);

						$f_adj = floatval($a_tmp_adj[1]);

						$a_addi_id[] = floatval($a_tmp_adj[0]);

						$a_addi_val[($a_tmp_adj[0])] = floatval($a_tmp_adj[1]);

						$tmp_adj += $f_adj;
					}



					$s_addi_id = implode(",", $a_addi_id);



					if ($is_old_process == "1") {

						$sql_addi = "SELECT addi_id,addi_name FROM tbl_additional WHERE addi_id IN (" . $s_addi_id . "); ";
					} else {

						$sql_addi = "SELECT addi_id,addi_name FROM tbl_additional_new WHERE addi_id IN (" . $s_addi_id . "); ";
					}



					$a_addi = Yii::app()->db->createCommand($sql_addi)->queryAll();



					$s_addi_name .= "<br><i>Price: " . $pre_cost . (($tmp_uprice / $quote_currency_old) * $quote_currency);



					$tmp_uprice += $tmp_adj;



					foreach ($a_addi as $tmp_key3 => $row_addi2) {

						$tmp_addi_val = $a_addi_val[($row_addi2["addi_id"])];

						$use_minus = "";

						if ($tmp_addi_val < 0) {

							$use_minus = "-";

							$tmp_addi_val = abs($tmp_addi_val);
						}

						$s_addi_name .= " + " . $row_addi2["addi_name"] . " <b>" . $use_minus . $pre_cost . number_format(($tmp_addi_val / $quote_currency_old) * $quote_currency, 2) . "</b>";
					}



					$s_addi_name .= "</i>";
				}



				$tmp_amount = (($tmp_qty * $tmp_uprice) / $quote_currency_old) * $quote_currency;



				$tmp_uprice_new = ($tmp_uprice / $quote_currency_old) * $quote_currency;



				$return_html .= '<tr><td style="padding:10px 0px; display: block; white-space: pre-wrap; word-break: break-all; word-wrap: break-word;">';

				$return_html .= '<input type="hidden" name="item_id[]" value="' . $item_id . '">';

				$return_html .= '<input type="hidden" name="comm_percent[]" value="' . $_POST["comm_percent"][$i] . '">';

				$return_html .= '<input type="hidden" name="qty_note[]" value="' . $_POST["qty_note"][$i] . '">';

				$return_html .= '<input type="hidden" name="pro_type[]" value="' . $_POST["product_type"][$i] . '">';

				$return_html .= '<input type="hidden" name="pro_name[]" value="' . base64_encode($_POST["product_item"][$i]) . '">';

				$return_html .= '<input type="hidden" name="pro_desc[]" value="' . base64_encode($_POST["product_desc"][$i]) . '">';

				$return_html .= '<input type="hidden" name="qty[]" value="' . $_POST["qty"][$i] . '">';

				$return_html .= '<input type="hidden" name="uprice[]" value="' . $tmp_uprice_new . '">';

				$return_html .= '<input type="hidden" name="uprice_ori[]" value="' . $_POST["uprice"][$i] . '">';

				$return_html .= '<input type="hidden" name="addi_id_list[]" value="' . $s_addi_id . '">';

				$return_html .= '<input type="hidden" name="addi_desc[]" value="' . base64_encode($s_addi_name) . '">';



				$return_html .= '<b>' . $_POST["product_item"][$i] . '</b><br>' . $_POST["product_desc"][$i] . $s_addi_name . '</td>';

				$return_html .= '<td style="text-align:center;">' . $_POST["qty"][$i] . '</td>';



				$return_html .= '<td style="text-align:right;">' . $pre_cost . number_format(($tmp_uprice / $quote_currency_old) * $quote_currency, 2) . '</td><td style="text-align:right;">' . $pre_cost . number_format($tmp_amount, 2) . '</td></tr>';



				$sub_total += $tmp_amount;
			}



			$sub_total = $sub_total;



			//$return_html .='<tr><td>Discount</td><td style="text-align:center;">1</td><td style="text-align:right;">$100.00</td><td style="text-align:right;">$100.00</td></tr>';



			$return_html .= '<tr><th>Design URL (<font color=red>Not shown in Quotation</font>)</th></tr>';

			$return_html .= '<tr><td><input type="url" name="design_url" placeholder="Type or Paste URL here, should start with http:// or https://" style="width:100%"></td></tr>';





			$return_html .= '<tr class="total_zone" style="border-top:1px solid #EEE;"><td colspan="2" style="padding-bottom:0px;"><b>Notes</b> (<font color=red>Not shown in Quotation</font>)</td><th style="text-align:right;"><span class="subnvat">Subtotal:</span></th>';

			$return_html .= '<td style="text-align:right;"><span class="subnvat" id="sp_show_sub_total">' . $pre_cost . number_format($sub_total, 2) . '</span>';

			$return_html .= '<input type="hidden" name="pre_cost" id="pre_cost" value="' . $pre_cost . '"><input type="hidden" name="sub_total" id="sub_total" value="' . $sub_total . '"></td></tr>';



			$vat_7percent = $sub_total * 0.07;

			$return_html .= '<tr class="total_zone" ><td colspan="2" rowspan="5" style="padding-top:0px;"><textarea style="width:100%; height:100%; border:1px solid #F00; resize: none;" name="sale_note"></textarea></td>';

			$return_html .= '<td style=" text-align:right;"><span class="subnvat"><input type="checkbox" name="inc_vat" id="inc_vat" value="yes" onclick="changeIncludeVAT();" > VAT 7%:</span></td>';

			$return_html .= '<td style="text-align:right;"><span class="subnvat" id="sp_show_vat_value"></span>'; //'.$pre_cost.number_format($vat_7percent,2).'

			$return_html .= '<input type="hidden" name="vat_value" id="vat_value" value="' . $vat_7percent . '"></td></tr>';



			$f_total = $sub_total; //+$vat_7percent;



			$return_html .= '<tr class="total_zone" ><th style="border-top:1px solid #EEE; text-align:left;"><div class="row"><div class="block">Discount (In %)&nbsp;&nbsp;:</div><div class="block">Actual Discount :</div></div></th>';

			$return_html .= '<th style="border-top:1px solid #EEE; text-align:right;"><div class="row"><div class="form-group col-xs-6"><input type="text" min="0" placeholder = "0" value="0" name="discount" class="number_disc"><input type="text" placeholder = "0" value="0" name="actual_discount" id="actual_disc"></div></div></th></tr>';



			//$return_html .= '<input type="hidden" name="gtotal_value" id="gtotal_value" value="'.$f_total.'"></th></tr>';



			$return_html .= '<tr class="total_zone" ><th style="border-top:1px solid #EEE; text-align:right;"><span class="subnvat">Total:</span></th>';

			$return_html .= '<td style="border-top:1px solid #EEE; text-align:right;"><span class="subnvat" id="sp_show_total_value">' . $pre_cost . number_format($f_total, 2) . '</span>';

			$return_html .= '<input type="hidden" name="total_value" id="total_value" value="' . $f_total . '"></td></tr>';



			$return_html .= '<tr class="total_zone" ><th style="border-top:1px solid #EEE; text-align:right;"><span class="subnvat">Grand </span>Total (' . $_POST["quote_curr"] . '):</th>';

			$return_html .= '<th style="border-top:1px solid #EEE; text-align:right;"><span id="sp_show_gtotal_value">' . $pre_cost . number_format($f_total, 2) . '</span>';

			$return_html .= '<input type="hidden" name="gtotal_value" id="gtotal_value" prefix="' . $pre_cost . '" value="' . $f_total . '"></th></tr>';



			$return_html .= '<tr class="total_zone" ><th style="border-top:1px solid #EEE; text-align:right;">Change Currency:</th>';

			$cur_sql = "SELECT * FROM tbl_currency";

			$curr_query = Yii::app()->db->createCommand($cur_sql)->queryAll();

			$select_html = "<select name='curr_name' style='width:100%;' id='change_curr_quote'>";

			foreach ($curr_query as $fetched) {

				$curr_select = "";

				if ($fetched['curr_id'] == $_POST["curr_id"]) {

					$curr_select = "selected";
				}

				$select_html .= "<option curr_symbol=" . $fetched['curr_name'] . " value=" . $fetched['curr_id'] . " $curr_select >" . $fetched["curr_name"] . " " . $fetched["curr_desc"] . "</option>";
			}

			$select_html .= "</select>";

			$return_html .= '<th style="border-top:1px solid #EEE; text-align:right;">' . $select_html . '</span>';

			$return_html .= '</th></tr>';



			// 		$return_html .= '<tr class="total_zone" ><th style="border-top:1px solid #EEE; text-align:right;"><span class="subnvat">Grand </span>Total ('.$_POST["quote_curr"].') (Including Discount, if any):</th>';

			// 		$return_html .= '<th style="border-top:1px solid #EEE; text-align:right;"><span id="sp_show_gtotal_value_discounted">'.$pre_cost.number_format($f_total,2).'</span>';

			// 		$return_html .= '<input type="hidden" name="gtotal_value_discounted" id="gtotal_value_discounted" value="'.$f_total.'"></th></tr>';



			$return_html .= '</table>';

			$return_html .= '</div>';



			$return_html .= '</div>';



			$return_html .= '<input type="hidden" id="post_data" value="' . base64_encode(json_encode($all_data)) . '">';

			$return_html .= '<input type="hidden" id="or_curr_id" value="' . $oldest_curr_id . '">';



			echo $return_html;
		}
	}



	public function actionShowQuoteForm()

	{

		$all_data = $_POST;

		$dup_from = $_POST['dup_from'];

		/*echo "<pre>";

		print_r($_POST);

		echo "</pre>";*/



		$is_old_process = "0";

		if (isset($_POST["is_old_process"])) {

			$is_old_process = $_POST["is_old_process"];
		}



		$return_html = '<div class="row">';

		$return_html .= '<div class="col-md-8" style="text-align:left; padding:20px 0px;">';

		$return_html .= 'BILL TO<br>';



		$return_html .= '<select id="cust_selector" name="cust_selector" class="estimate_create_dropdown"  style="width:100%" onchange="return changeCustomerV2();"><option value="">=Select Customer=</option>';

		$user_group = Yii::app()->user->getState('userGroup');

		$user_id = Yii::app()->user->getState('userKey');



		$more_condition = "";

		// if ($user_group != "1" && $user_group != "99") {



		// 	$more_condition = " AND user_id='" . $user_id . "' ";
		// }

		$sql_cust = "SELECT * FROM tbl_cust_info WHERE enable=1 " . $more_condition . " AND add_date >= '2025-02-12' ORDER BY cust_name ASC; ";

		$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();

		foreach ($a_cust as $tmp_key => $row_cust) {

			$return_html .= '<option value="' . $row_cust["cust_id"] . '">' . $row_cust["cust_name"] . ' - <strong>' . $row_cust["cust_full_name"] . ' </strong></option>';
		}

		$return_html .= '</select> ';

		// Add "Add New Customer" button
		//$return_html .= '<button type="button" id="addNewCustomer" onclick="toggleCustomerForm()" class="tooltip-button" style="background: #5CB85C; font-size: 16px; font-weight: 600; border: none; color: #FFF; padding: 6px 10px; border-radius: 3px;"><i class="fa fa-plus"></i></button>';
		$return_html .= '<span class="tooltip-button" onclick="addnewcust();" style="background: #5CB85C; font-size: 14px; cursor:pointer; font-weight: 600; border: none; color: #FFF; padding: 9px 12px; border-radius: 3px;"><i class="fa fa-plus"></i></span>';

		// Form to add new customer (hidden by default)
		$return_html .= '
		<div id="newCustomerForm" style="display:none; padding-top: 20px;">
			<div name="form1" id="updateCustomerAjax">
				<div style="text-align: center;">
					<input type="text" name="add_cust_name" id="add_cust_name" placeholder="Customer Name" style="width:100%">
				</div>
				
				<div style="text-align: center;">
					<textarea name="add_cust_info" id="add_cust_info" placeholder="Customer Info:"  style="width:100%"></textarea>
				</div>
				<div style="text-align: center;">
					<span class="btn submitBtn" id="CustomerUpdater">Submit</span>
				</div>
			</div>
		</div>';

		$return_html .= '<pre id="pr_show_cust_info"></pre>';

		$return_html .= '<div id="pr_showing_state"></div>';

		$return_html .= '<div class="" style="margin:5px 0;">';
		$return_html .= '<div id="tax_id_fortax">
									<label for="salestax">Tax ID</label><br> 
									<input type="text" name="tax_id" id="add_tax_id" placeholder="" style="width:50%">
								</div>';
		$return_html .= '
							<div >
								<label for="salestax"> Sales Tax Exemption</label><br>
								<select name="sales_tax" id="sales_tax">
									<option value="">Select Sales Tax</option>
									<option value="Exempt">Exempt</option>
									<option value="Non Exempt">Non Exempt</option>				
								</select>
							</div>';
		$return_html .= '
						<div >
							<label for="salestax">Customer Type</label><br>
							<select name="customer_type" id="add_customer_type" style="width:50% !important">
								<option value="">Select Customer Type</option>
								<option value="College Retail - Bookstore">College Retail - Bookstore</option>
								<option value="College/Junior/Semi Pro/Pro">College/Junior/Semi Pro/Pro</option>
								<option value="Dealer">Dealer</option>
								<option value="Factory Direct Customers">Factory Direct Customers</option>
								<option value="International Sales">International Sales</option>
								<option value="Online Stores Collegiate">Online Stores Collegiate</option>
								<option value="Online Spirit Stores">Online Spirit Stores</option>
								<option value="Private Label Companies">Private Label Companies</option>
								<option value="Sales Direct Hockey Related - Youth, High School">Sales Direct Hockey Related - Youth, High School</option>
								<option value="Sales Direct College & Juniors">Sales Direct College & Juniors</option>
								<option value="Sales Direct to Business Camps, Misc.">Sales Direct to Business Camps, Misc.</option>
								<option value="Sales Direct - Other Sports">Sales Direct - Other Sports</option>
								<option value="Sales Direct - Adult Hockey Teams/Leagues">Sales Direct - Adult Hockey Teams/Leagues</option>
												
							</select>
						</div>';
		$return_html .= '</div>';

		$return_html .= '</div>';

		$return_html .= '<div class="col-md-4" style="text-align:right; padding:20px 0px;">';

		$return_html .= '<table class="est_zone" style="width:100%; border-collapse: separate; border-spacing: 10px;">';

		$return_html .= '<tr><th width="50%">Estimate Number: </th><td id="td_auto_code" style="color:#00F;">[Auto generate]</td></tr>';

		$return_html .= '<tr><th >PO Number: </th><td><input type="text" style="width:100px;" name="po_number" maxlength="30"></td></tr>';

		$est_date = date("Y-m-d");

		$return_html .= '<tr><th>Estimate Date: </th><td><input type="hidden" name="est_date" value="' . $est_date . '">' . date("F d, Y", strtotime($est_date)) . '</td></tr>';

		$exp_date = date("Y-m-d", strtotime("+30 days", strtotime($est_date)));

		$return_html .= '<tr><th>Expires On: </th><td><input type="hidden" name="exp_date" value="' . $exp_date . '">' . date("F d, Y", strtotime($exp_date)) . '</td></tr>';

		$return_html .= '<tr><th>Grand Total (' . $_POST["quote_curr"] . '): </th><td id="td_grand_total"></td></tr>';

		$return_html .= '</table>';

		$return_html .= '</div>';

		$return_html .= '<div class="col-md-12">';

		$return_html .= '<input type="hidden" name="quote_curr" value="' . $_POST["quote_curr"] . '">';

		$return_html .= '<input type="hidden" name="curr_id" value="' . $_POST["curr_id"] . '">';

		$return_html .= '<input type="hidden" name="duplicate_by" value="' . $_POST["duplicate_by"] . '">';

		$return_html .= '<input name="is_duplicate" id="is_duplicate" type="hidden" value="' . (isset($_POST["is_duplicate"]) ? $_POST["is_duplicate"] : "0") . '" >';



		if (isset($_POST["edit_quote_id"])) {



			$return_html .= '<input name="edit_quote_id" id="qdoc_id_old" type="hidden" value="' . $_POST["edit_quote_id"] . '">';

			$return_html .= '<input name="edit_est_number" id="est_number_old" type="hidden" value="' . $_POST["edit_est_number"] . '">';

			$return_html .= '<input name="edit_comp_id" id="comp_id_old" type="hidden" value="' . $_POST["edit_comp_id"] . '" >';

			$return_html .= '<input name="edit_cust_id" id="cust_id_old" type="hidden" value="' . $_POST["edit_cust_id"] . '">';

			$return_html .= '<input name="edit_payment_term" id="payment_term_old" type="hidden" value="' . $_POST["edit_payment_term"] . '">';

			$return_html .= '<input name="edit_inc_vat" id="inc_vat_old" type="hidden" value="' . $_POST["edit_inc_vat"] . '">';
		}





		$return_html .= '<table class="item_zone" style="width:100%;">';

		$return_html .= '<tr><th width="60%">Product</th><th style="text-align:center;">Quantity</th><th style="text-align:right; width:140px;">Price</th><th style="text-align:right; width:120px;">Amount</th></tr>';



		$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $_POST["curr_id"] . "'; ";

		$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();



		$pre_cost = $a_curr[0]["curr_symbol"];



		$sub_total = 0.0;



		for ($i = 0; $i < sizeof($_POST["item_id"]); $i++) {



			$item_id = $_POST["item_id"][$i];



			$tmp_qty = isset($_POST["qty"][$i]) ? intval($_POST["qty"][$i]) : 0;

			$tmp_uprice = isset($_POST["uprice"][$i]) ? floatval($_POST["uprice"][$i]) : 0.0;



			$s_addi_id = "";

			$s_addi_name = "";

			$tmp_adj = 0.0;



			$product_type = $_POST["product_type"][$i];



			$tmp_id = $_POST["tmp_id"][$i];



			if (isset($_POST["addi_id"][$tmp_id])) {

				$a_addi_id = array();

				$a_addi_val = array();

				foreach ($_POST["addi_id"][$tmp_id] as $tmp_key2 => $s_adj) {

					$a_tmp_adj = explode("|", $s_adj);

					$f_adj = floatval($a_tmp_adj[1]);

					$a_addi_id[] = floatval($a_tmp_adj[0]);

					$a_addi_val[($a_tmp_adj[0])] = floatval($a_tmp_adj[1]);

					//if($_POST["is_duplicate"]!=1){

					if ($dup_from != 2) {

						$tmp_adj += $f_adj;
					}

					//};

				}



				$s_addi_id = implode(",", $a_addi_id);



				if ($is_old_process == "1") {

					$sql_addi = "SELECT addi_id,addi_name FROM tbl_additional WHERE addi_id IN (" . $s_addi_id . "); ";
				} else {

					$sql_addi = "SELECT addi_id,addi_name FROM tbl_additional_new WHERE addi_id IN (" . $s_addi_id . "); ";
				}



				$a_addi = Yii::app()->db->createCommand($sql_addi)->queryAll();

				$new_price = 0.0;
				if (isset($_POST["is_duplicate"]) && $_POST["is_duplicate"] == "1" || $_POST["is_duplicate"] == "0") {
					$new_price += $tmp_adj;
					$s_addi_name .= "<br><i>Price: " . $pre_cost . ($tmp_uprice - $new_price);
				} else {
					$s_addi_name .= "<br><i>Price: " . $pre_cost . $tmp_uprice;
					$tmp_uprice += $tmp_adj;
				}

				// $s_addi_name .= "<br><i>Price: " . $pre_cost . $tmp_uprice;



				// $tmp_uprice += $tmp_adj;



				foreach ($a_addi as $tmp_key3 => $row_addi2) {

					$tmp_addi_val = $a_addi_val[($row_addi2["addi_id"])];

					$use_minus = "";

					if ($tmp_addi_val < 0) {

						$use_minus = "-";

						$tmp_addi_val = abs($tmp_addi_val);
					}

					$s_addi_name .= " + " . $row_addi2["addi_name"] . " <b>" . $use_minus . $pre_cost . number_format($tmp_addi_val, 2) . "</b>";
				}



				$s_addi_name .= "</i>";

				// if($_POST["is_duplicate"]==1){

				//     $s_addi_name = "";

				// }

			}



			$tmp_amount = $tmp_qty * $tmp_uprice;



			$return_html .= '<tr><td style="padding:10px 0px; display: block; white-space: pre-wrap; word-break: break-all; word-wrap: break-word;">';

			$return_html .= '<input type="hidden" name="item_id[]" value="' . $item_id . '">';

			$return_html .= '<input type="hidden" name="comm_percent[]" value="' . $_POST["comm_percent"][$i] . '">';

			$return_html .= '<input type="hidden" name="qty_note[]" value="' . $_POST["qty_note"][$i] . '">';

			$return_html .= '<input type="hidden" name="pro_type[]" value="' . $_POST["product_type"][$i] . '">';

			$return_html .= '<input type="hidden" name="pro_name[]" value="' . base64_encode($_POST["product_item"][$i]) . '">';

			$return_html .= '<input type="hidden" name="pro_desc[]" value="' . base64_encode($_POST["product_desc"][$i]) . '">';

			$return_html .= '<input type="hidden" name="qty[]" value="' . $_POST["qty"][$i] . '">';

			$return_html .= '<input type="hidden" name="uprice[]" value="' . $tmp_uprice . '">';

			$return_html .= '<input type="hidden" name="uprice_ori[]" value="' . $_POST["uprice"][$i] . '">';

			$return_html .= '<input type="hidden" name="addi_id_list[]" value="' . $s_addi_id . '">';

			$return_html .= '<input type="hidden" name="addi_desc[]" value="' . base64_encode($s_addi_name) . '">';



			$return_html .= '<b>' . $_POST["product_item"][$i] . '</b><br>' . $_POST["product_desc"][$i] . $s_addi_name . '</td>';

			$return_html .= '<td style="text-align:center;">' . $_POST["qty"][$i] . '</td>';



			$return_html .= '<td style="text-align:right;">' . $pre_cost . number_format($tmp_uprice, 2) . '</td><td style="text-align:right;">' . $pre_cost . number_format($tmp_amount, 2) . '</td></tr>';



			$sub_total += $tmp_amount;
		}



		//$return_html .='<tr><td>Discount</td><td style="text-align:center;">1</td><td style="text-align:right;">$100.00</td><td style="text-align:right;">$100.00</td></tr>';



		$return_html .= '<tr><th>Design URL (<font color=red>Not shown in Quotation</font>)</th></tr>';

		$return_html .= '<tr><td><input type="url" name="design_url" placeholder="Type or Paste URL here, should start with http:// or https://" style="width:100%"></td></tr>';





		$return_html .= '<tr class="total_zone" style="border-top:1px solid #EEE;"><td colspan="2" style="padding-bottom:0px;"><b>Notes</b> (<font color=red>Not shown in Quotation</font>)</td><th style="text-align:right;"><span class="subnvat">Subtotal:</span></th>';

		$return_html .= '<td style="text-align:right;"><span class="subnvat" id="sp_show_sub_total">' . $pre_cost . number_format($sub_total, 2) . '</span>';

		$return_html .= '<input type="hidden" name="pre_cost" id="pre_cost" value="' . $pre_cost . '"><input type="hidden" name="sub_total" id="sub_total" value="' . $sub_total . '"></td></tr>';



		$vat_7percent = $sub_total * 0.07;

		$return_html .= '<tr class="total_zone" ><td colspan="2" rowspan="5" style="padding-top:0px;"><textarea style="width:100%; height:100%; border:1px solid #F00; resize: none;" name="sale_note"></textarea></td>';

		$return_html .= '<td style=" text-align:right;"><span class="subnvat"><input type="checkbox" name="inc_vat" id="inc_vat" value="yes" onclick="changeIncludeVAT();" > VAT 7%:</span></td>';

		$return_html .= '<td style="text-align:right;"><span class="subnvat" id="sp_show_vat_value"></span>'; //'.$pre_cost.number_format($vat_7percent,2).'

		$return_html .= '<input type="hidden" name="vat_value" id="vat_value" value="' . $vat_7percent . '"></td></tr>';



		$f_total = $sub_total; //+$vat_7percent;



		$return_html .= '<tr class="total_zone" ><th style="border-top:1px solid #EEE; text-align:left;"><div class="row"><div class="block">Discount (In %)&nbsp;&nbsp;:</div><div class="block">Actual Discount :</div></div></th>';

		$return_html .= '<th style="border-top:1px solid #EEE; text-align:right;"><div class="row"><div class="form-group col-xs-6"><input type="text" min="0" placeholder = "0" value="0" name="discount" class="number_disc"><input type="text" placeholder = "0" value="0" name="actual_discount" id="actual_disc"></div></div></th></tr>';



		//$return_html .= '<input type="hidden" name="gtotal_value" id="gtotal_value" value="'.$f_total.'"></th></tr>';



		$return_html .= '<tr class="total_zone" ><th style="border-top:1px solid #EEE; text-align:right;"><span class="subnvat">Total:</span></th>';

		$return_html .= '<td style="border-top:1px solid #EEE; text-align:right;"><span class="subnvat" id="sp_show_total_value">' . $pre_cost . number_format($f_total, 2) . '</span>';

		$return_html .= '<input type="hidden" name="total_value" id="total_value" value="' . $f_total . '"></td></tr>';



		$return_html .= '<tr class="total_zone" ><th style="border-top:1px solid #EEE; text-align:right;"><span class="subnvat">Grand </span>Total (' . $_POST["quote_curr"] . '):</th>';

		$return_html .= '<th style="border-top:1px solid #EEE; text-align:right;"><span id="sp_show_gtotal_value">' . $pre_cost . number_format($f_total, 2) . '</span>';

		$return_html .= '<input type="hidden" name="gtotal_value" id="gtotal_value" prefix="' . $pre_cost . '" value="' . $f_total . '"></th></tr>';



		$return_html .= '<tr class="total_zone" ><th style="border-top:1px solid #EEE; text-align:right;">Change Currency:</th>';

		$cur_sql = "SELECT * FROM tbl_currency";

		$curr_query = Yii::app()->db->createCommand($cur_sql)->queryAll();

		$select_html = "<select name='curr_name' style='width:100%;' id='change_curr_quote'>";

		foreach ($curr_query as $fetched) {

			$curr_select = "";

			if ($fetched['curr_id'] == $_POST["curr_id"]) {

				$curr_select = "selected";
			}

			$select_html .= "<option curr_symbol=" . $fetched['curr_name'] . " value=" . $fetched['curr_id'] . " $curr_select >" . $fetched["curr_name"] . " " . $fetched["curr_desc"] . "</option>";
		}

		$select_html .= "</select>";

		$return_html .= '<th style="border-top:1px solid #EEE; text-align:right;">' . $select_html . '</span>';

		$return_html .= '</th></tr>';



		// 		$return_html .= '<tr class="total_zone" ><th style="border-top:1px solid #EEE; text-align:right;"><span class="subnvat">Grand </span>Total ('.$_POST["quote_curr"].') (Including Discount, if any):</th>';

		// 		$return_html .= '<th style="border-top:1px solid #EEE; text-align:right;"><span id="sp_show_gtotal_value_discounted">'.$pre_cost.number_format($f_total,2).'</span>';

		// 		$return_html .= '<input type="hidden" name="gtotal_value_discounted" id="gtotal_value_discounted" value="'.$f_total.'"></th></tr>';



		$return_html .= '</table>';

		$return_html .= '</div>';



		$return_html .= '</div>';



		$return_html .= '<input type="hidden" id="post_data" value="' . base64_encode(json_encode($all_data)) . '">';

		$return_html .= '<input type="hidden" id="or_curr_id" value="' . $_POST['curr_id'] . '">';



		echo $return_html;
	}



	public function actionGetCustomerInfo()
	{
		$sql_cust = "SELECT * FROM tbl_cust_info WHERE cust_id='" . $_POST["cust_id"] . "'; ";
		$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();
		$sql_state = "SELECT DISTINCT billing_state FROM tbl_cust_info ORDER BY billing_state; ";
		$s_state = Yii::app()->db->createCommand($sql_state)->queryAll();

		$a_result["tax_id"] =  $a_cust[0]["tax_id"];
		$a_result["customer_type"] =  $a_cust[0]["customer_type"];
		$a_result["cust_info"] = $a_cust[0]["cust_info"];
		$a_result["selected_state"] = $a_cust[0]["billing_state"];
		$a_result["sales_tax"] = $a_cust[0]['sales_tax'];
		$a_result["states"] = $s_state;

		echo json_encode($a_result);
	}



	public function actionGetCustomerInfoNew()

	{



		$sql_cust = "SELECT * FROM tbl_cust_info WHERE cust_id='" . $_POST["cust_id"] . "'; ";

		$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();

		$sql_qdoc = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $_POST["qdoc_id"] . "'; ";

		$a_qdoc = Yii::app()->db->createCommand($sql_qdoc)->queryAll();


		die(json_encode(array('status' => 1, 'data' => $a_cust, 'sales' => $a_qdoc)));
	}

	public function actionRequestApprove()

	{



		$user_id = Yii::app()->user->getState('userKey');

		/*echo '<pre>';

		print_r($_POST);

		echo '</pre>';

		exit();*/



		//$user_group = Yii::app()->user->getState('userGroup');

		$comp_id = $_POST["head_selector"];

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



		if (isset($_POST["edit_quote_id"]) && (!isset($_POST["is_duplicate"]) || $_POST["is_duplicate"] == "0")) {



			$est_number = $_POST["edit_est_number"];



			$sql_qdoc = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $_POST["edit_quote_id"] . "'; ";

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



			$sql_disable_doc = "UPDATE tbl_quote_doc SET enable='0' WHERE qdoc_id='" . $_POST["edit_quote_id"] . "'; ";

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



		$cust_id = $_POST["cust_selector"];

		$sql_cust = "SELECT * FROM tbl_cust_info WHERE cust_id='" . $cust_id . "'; ";

		$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();

		$row_cust = $a_cust[0];

		$cust_name = $row_cust["cust_name"];

		$cust_info = $row_cust["cust_info"];



		$po_number = $_POST["po_number"];

		$est_date = $_POST["est_date"];

		$exp_date = $_POST["exp_date"];

		$inc_vat = isset($_POST["inc_vat"]) ? $_POST["inc_vat"] : "no";

		$add_date = date("Y-m-d H:i:s");



		$num_item = sizeof($_POST["pro_type"]);

		$curr_id = $_POST["curr_id"];

		$quote_curr = $_POST["quote_curr"];

		$vat_value = $_POST["vat_value"];

		$discount_percent = $_POST['discount'];

		$actual_discount = $_POST['actual_discount'];

		// Recalculate sub_total server-side from posted item qty/uprice to avoid JS miscalculation
		$sub_total = 0.0;
		foreach ($_POST["pro_type"] as $tmp_key => $pro_type) {
			$sub_total += floatval($_POST["qty"][$tmp_key]) * floatval($_POST["uprice"][$tmp_key]);
		}

		$grand_total = $sub_total - floatval($actual_discount);
		if ($inc_vat === "yes") {
			$grand_total += floatval($vat_value);
		}



		$payment_term = $_POST["payment_term"];


		$customer_type = $_POST["customer_type"];
		$sale_note = $_POST["sale_note"];
		$sales_tax = $_POST["sales_tax"];

		$billing_state = $_POST["billing_state"];

		if ($sales_tax == 'Exempt') {
			$tax_id = $_POST["tax_id"];

			if (empty($row_cust["tax_id"]) && !empty($tax_id)) {
				$sql2 = "UPDATE tbl_cust_info SET sales_tax= '$sales_tax',tax_id='$tax_id' WHERE cust_id='$cust_id'";
				Yii::app()->db->createCommand($sql2)->execute();
			}
		} else {
			$tax_id = '';
		}

		if (empty($row_cust["customer_type"]) && !empty($customer_type)) {
			$sql3 = "UPDATE tbl_cust_info SET customer_type= '$customer_type' WHERE cust_id='$cust_id[0]'";
			Yii::app()->db->createCommand($sql3)->execute();
		}

		$design_url = $_POST["design_url"];

		if ($_POST["duplicate_by"] == 1) {
			$duplicate_by = 2;
		} else {
			$duplicate_by = 1;
		}

		if (isset($_POST["is_duplicate"]) && $_POST["is_duplicate"] == "1") {



			$qdoc_id = $_POST["edit_quote_id"];



			$sql_update_doc = "UPDATE tbl_quote_doc SET user_id='" . $user_id . "',comp_id='" . $comp_id . "',comp_name='" . addslashes($comp_name) . "',comp_info='" . addslashes($comp_info) . "',curr_id='" . $curr_id . "'";

			$sql_update_doc .= ",quote_curr='" . addslashes($quote_curr) . "',payment_term='" . addslashes($payment_term) . "',cust_id='" . $cust_id . "',cust_name='" . addslashes($cust_name) . "'";

			$sql_update_doc .= ",cust_info='" . addslashes($cust_info) . "',est_number='" . $est_number . "',po_number='" . $po_number . "',est_date='" . $est_date . "',exp_date='" . $exp_date . "',inc_vat='" . $inc_vat . "',vat_value='" . $vat_value . "'";

			$sql_update_doc .= ",num_item='" . $num_item . "',discount_percent='" . $discount_percent . "',actual_discount='" . $actual_discount . "',sub_total='" . $sub_total . "',grand_total='" . $grand_total . "',sale_note='" . addslashes($sale_note) . "',sales_tax='" . addslashes($sales_tax) . "',customer_type='" . addslashes($customer_type) . "',billing_state='" . $billing_state . "',sales_tax='" . addslashes($sales_tax) . "',design_url='" . addslashes($design_url) . "',note=NULL,approve_status='new'";

			$sql_update_doc .= ",approve_date=NULL,reject_time=NULL,history_qdoc_id=NULL,is_temp=0,temp_id=NULL,is_editing=0,archive=0,enable=1,is_duplicate=0,dup_from='" . $duplicate_by . "',add_date='" . $add_date . "' WHERE qdoc_id='" . $qdoc_id . "' ";

			Yii::app()->db->createCommand($sql_update_doc)->execute();



			$delete_old_item = "DELETE FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "'; ";

			Yii::app()->db->createCommand($delete_old_item)->execute();

			$tmp_user_id = $user_id;
			if ($edit_for_user_id != "") {
				$tmp_user_id = $edit_for_user_id;
			}

			$sql_insert_doc_draft = "INSERT INTO tbl_quote_doc_draft (qdoc_id,user_id,comp_id,comp_name,comp_info,payment_term,cust_id,cust_name,cust_info,est_number,po_number,est_date,exp_date,inc_vat,vat_value,num_item,curr_id,quote_curr,discount_percent,actual_discount,sub_total,grand_total,sale_note,sales_tax,customer_type,billing_state,tax_id,design_url,add_date" . $extra_field . ")";
			$sql_insert_doc_draft .= " VALUES (";
			$sql_insert_doc_draft .= "'" . $qdoc_id . "','" . $tmp_user_id . "','" . $comp_id . "','" . addslashes($comp_name) . "','" . addslashes($comp_info) . "','" . addslashes($payment_term) . "','" . $cust_id . "','" . addslashes($cust_name) . "','" . addslashes($cust_info) . "','" . $est_number . "','" . $po_number . "','" . $est_date . "','" . $exp_date . "'";
			$sql_insert_doc_draft .= ",'" . $inc_vat . "','" . $vat_value . "','" . $num_item . "','" . $curr_id . "','" . addslashes($quote_curr) . "','" . $discount_percent . "','" . $actual_discount . "','" . $sub_total . "','" . $grand_total . "','" . addslashes($sale_note) . "','" . addslashes($sales_tax) . "','" . addslashes($customer_type) . "','" . $billing_state . "','" . addslashes($tax_id) . "','" . addslashes($design_url) . "','" . $add_date . "'" . $extra_value;
			$sql_insert_doc_draft .= "); ";

			Yii::app()->db->createCommand($sql_insert_doc_draft)->execute();
		} else {



			$tmp_user_id = $user_id;

			if ($edit_for_user_id != "") {

				$tmp_user_id = $edit_for_user_id;
			}



			$sql_insert_doc = "INSERT INTO tbl_quote_doc (user_id,comp_id,comp_name,comp_info,payment_term,cust_id,cust_name,cust_info,est_number,po_number,est_date,exp_date,inc_vat,vat_value,num_item,curr_id,quote_curr,discount_percent,actual_discount,sub_total,grand_total,sale_note,sales_tax,customer_type,billing_state,tax_id,design_url,add_date" . $extra_field . ")";

			$sql_insert_doc .= " VALUES (";

			$sql_insert_doc .= "'" . $tmp_user_id . "','" . $comp_id . "','" . addslashes($comp_name) . "','" . addslashes($comp_info) . "','" . addslashes($payment_term) . "','" . $cust_id . "','" . addslashes($cust_name) . "','" . addslashes($cust_info) . "','" . $est_number . "','" . $po_number . "','" . $est_date . "','" . $exp_date . "'";

			$sql_insert_doc .= ",'" . $inc_vat . "','" . $vat_value . "','" . $num_item . "','" . $curr_id . "','" . addslashes($quote_curr) . "','" . $discount_percent . "','" . $actual_discount . "','" . $sub_total . "','" . $grand_total . "','" . addslashes($sale_note) . "','" . addslashes($sales_tax) . "','" . addslashes($customer_type) . "','" . $billing_state . "','" . addslashes($tax_id) . "','" . addslashes($design_url) . "','" . $add_date . "'" . $extra_value;

			$sql_insert_doc .= "); ";



			Yii::app()->db->createCommand($sql_insert_doc)->execute();

			$qdoc_id = Yii::app()->db->getLastInsertID();



			$sql_insert_doc_draft = "INSERT INTO tbl_quote_doc_draft (qdoc_id,user_id,comp_id,comp_name,comp_info,payment_term,cust_id,cust_name,cust_info,est_number,po_number,est_date,exp_date,inc_vat,vat_value,num_item,curr_id,quote_curr,discount_percent,actual_discount,sub_total,grand_total,sale_note,sales_tax,customer_type,design_url,add_date" . $extra_field . ")";

			$sql_insert_doc_draft .= " VALUES (";

			$sql_insert_doc_draft .= "'" . $qdoc_id . "','" . $tmp_user_id . "','" . $comp_id . "','" . addslashes($comp_name) . "','" . addslashes($comp_info) . "','" . addslashes($payment_term) . "','" . $cust_id . "','" . addslashes($cust_name) . "','" . addslashes($cust_info) . "','" . $est_number . "','" . $po_number . "','" . $est_date . "','" . $exp_date . "'";

			$sql_insert_doc_draft .= ",'" . $inc_vat . "','" . $vat_value . "','" . $num_item . "','" . $curr_id . "','" . addslashes($quote_curr) . "','" . $discount_percent . "','" . $actual_discount . "','" . $sub_total . "','" . $grand_total . "','" . addslashes($sale_note) . "','" . addslashes($sales_tax) . "','" . addslashes($customer_type) . "','" . addslashes($design_url) . "','" . $add_date . "'" . $extra_value;

			$sql_insert_doc_draft .= "); ";



			Yii::app()->db->createCommand($sql_insert_doc_draft)->execute();
		}





		$sort_count = 1;

		foreach ($_POST["pro_type"] as $tmp_key => $pro_type) {



			$pro_name = addslashes(base64_decode($_POST["pro_name"][$tmp_key]));

			$pro_desc = addslashes(base64_decode($_POST["pro_desc"][$tmp_key]));

			$qty = $_POST["qty"][$tmp_key];

			$uprice = $_POST["uprice"][$tmp_key];

			$uprice_ori = $_POST["uprice_ori"][$tmp_key];







			if ($pro_type != "other") {



				if ($pro_type == "extra") {

					$item_id = str_replace("e", "", $_POST["item_id"][$tmp_key]);
				} else {

					$item_id = $_POST["item_id"][$tmp_key];
				}



				$addi_id_list = "";

				$addi_desc = "";



				if (isset($_POST["addi_id_list"][$tmp_key])) {

					$addi_id_list = $_POST["addi_id_list"][$tmp_key];
				}

				if (isset($_POST["addi_desc"][$tmp_key])) {

					$addi_desc = addslashes(base64_decode($_POST["addi_desc"][$tmp_key]));
				}



				$comm_percent = $_POST["comm_percent"][$tmp_key];

				$qty_note = addslashes($_POST["qty_note"][$tmp_key]);



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

				$comm_percent = $_POST["comm_percent"][$tmp_key];

				$sql_insert_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,item_id,pro_name,pro_desc,qty,qty_note,uprice,addi_id_list,comm_percent,sort,add_date) VALUES (";

				$sql_insert_item .= "'" . $qdoc_id . "','" . $pro_type . "',NULL,'" . $pro_name . "','" . $pro_desc . "','" . $qty . "',NULL,'" . $uprice . "',NULL,'".$comm_percent."','" . $sort_count . "','" . $add_date . "'";

				$sql_insert_item .= "); ";

				Yii::app()->db->createCommand($sql_insert_item)->execute();



				$sql_insert_item_draft = "INSERT INTO tbl_quote_item_draft (qdoc_id,pro_type,item_id,pro_name,pro_desc,qty,qty_note,uprice,addi_id_list,comm_percent,sort,add_date) VALUES (";

				$sql_insert_item_draft .= "'" . $qdoc_id . "','" . $pro_type . "',NULL,'" . $pro_name . "','" . $pro_desc . "','" . $qty . "',NULL,'" . $uprice . "',NULL,'".$comm_percent."','" . $sort_count . "','" . $add_date . "'";

				$sql_insert_item_draft .= "); ";

				Yii::app()->db->createCommand($sql_insert_item_draft)->execute();
			}



			$sort_count++;
		}





		$a_result["result"] = "success";

		$a_result["est_number"] = $est_number;



			//-----------------------------changes for update customer type for quotation ---------------------
		
		if($_POST['customer_type']){
			$customer_type = $_POST['customer_type'] ?? NULL; 
			$cust_count = $_POST['cust_selector'] ; 
            
			      $is_exsits = "SELECT id FROM estimate_customer_type Where customer_id='$cust_count'";	  
				  $data =  Yii::app()->db->createCommand($is_exsits)->queryScalar(); 
				  if($data){
					  $update_sql = "UPDATE estimate_customer_type SET  customer_type='$customer_type' Where id='$data'";
					  $update = Yii::app()->db->createCommand($update_sql)->execute();
				  }else{
					 $insert_sql = "INSERT INTO estimate_customer_type(customer_id , customer_type) VALUES('$cust_count' , '$customer_type')"; 
                     $insert = Yii::app()->db->createCommand($insert_sql)->execute(); 
				  }			  
			
		}

		echo json_encode($a_result);
	}

	// 	public function actionRequestApprove()

	// 	{



	// 		$user_id = Yii::app()->user->getState('userKey');

	// 		/*echo '<pre>';

	// 		print_r($_POST);

	// 		echo '</pre>';

	// 		exit();*/



	// 		//$user_group = Yii::app()->user->getState('userGroup');

	// 		$comp_id = $_POST["head_selector"];

	// 		$sql_comp = "SELECT * FROM tbl_comp_info WHERE comp_id='" . $comp_id . "'; ";

	// 		$a_comp = Yii::app()->db->createCommand($sql_comp)->queryAll();

	// 		$row_comp = $a_comp[0];

	// 		$comp_name = $row_comp["comp_name"];

	// 		$comp_info = $row_comp["comp_info"];

	// 		$comp_code = $row_comp["comp_code"];

	// 		$tmp_year = $row_comp["tmp_year"];



	// 		$extra_field = "";

	// 		$extra_value = "";

	// 		$is_editing = "0";

	// 		$edit_for_user_id = "";



	// 		if (isset($_POST["edit_quote_id"]) && (!isset($_POST["is_duplicate"]) || $_POST["is_duplicate"] == "0")) {



	// 			$est_number = $_POST["edit_est_number"];



	// 			$sql_qdoc = "SELECT * FROM tbl_quote_doc WHERE qdoc_id='" . $_POST["edit_quote_id"] . "'; ";

	// 			$a_qdoc = Yii::app()->db->createCommand($sql_qdoc)->queryAll();

	// 			$row_qdoc = $a_qdoc[0];



	// 			$is_editing = $row_qdoc["is_editing"];

	// 			$edit_for_user_id = $row_qdoc["user_id"];



	// 			$extra_field = ",history_qdoc_id";

	// 			if ($row_qdoc["history_qdoc_id"] != "") {

	// 				$extra_value = ",'" . $row_qdoc["history_qdoc_id"] . "," . $row_qdoc["temp_id"] . "'";
	// 			} else {

	// 				$extra_value = ",'" . $row_qdoc["temp_id"] . "'";
	// 			}



	// 			$sql_disable_doc = "UPDATE tbl_quote_doc SET enable='0' WHERE qdoc_id='" . $_POST["edit_quote_id"] . "'; ";

	// 			Yii::app()->db->createCommand($sql_disable_doc)->execute();
	// 		} else {

	// 			$doc_number = "000";

	// 			if ($tmp_year == date("Y")) {

	// 				$year_doc_count = intval($row_comp["year_doc_count"]) + 1;

	// 				$doc_number .= "" . $year_doc_count;

	// 				$sql_update_year_doc_count = "UPDATE tbl_comp_info SET year_doc_count='" . $year_doc_count . "' WHERE comp_id='" . $comp_id . "'; ";

	// 				Yii::app()->db->createCommand($sql_update_year_doc_count)->execute();
	// 			} else {

	// 				$year_doc_count = 1;

	// 				$doc_number = "0001";

	// 				$sql_update_tmp_year = "UPDATE tbl_comp_info SET tmp_year='" . date("Y") . "',year_doc_count='1' WHERE comp_id='" . $comp_id . "'; ";

	// 				Yii::app()->db->createCommand($sql_update_tmp_year)->execute();
	// 			}



	// 			$est_number = $comp_code . date("Ym") . substr($doc_number, (strlen($doc_number) - 4), 4);
	// 		}



	// 		$cust_id = $_POST["cust_selector"];

	// 		$sql_cust = "SELECT * FROM tbl_cust_info WHERE cust_id='" . $cust_id . "'; ";

	// 		$a_cust = Yii::app()->db->createCommand($sql_cust)->queryAll();

	// 		$row_cust = $a_cust[0];

	// 		$cust_name = $row_cust["cust_name"];

	// 		$cust_info = $row_cust["cust_info"];



	// 		$po_number = $_POST["po_number"];

	// 		$est_date = $_POST["est_date"];

	// 		$exp_date = $_POST["exp_date"];

	// 		$inc_vat = isset($_POST["inc_vat"]) ? $_POST["inc_vat"] : "no";

	// 		$add_date = date("Y-m-d H:i:s");



	// 		$num_item = sizeof($_POST["pro_type"]);

	// 		$curr_id = $_POST["curr_id"];

	// 		$quote_curr = $_POST["quote_curr"];

	// 		$sub_total = $_POST["sub_total"];

	// 		$vat_value = $_POST["vat_value"];

	// 		$grand_total = $_POST["gtotal_value"];

	// 		$discount_percent = $_POST['discount'];

	// 		$actual_discount = $_POST['actual_discount'];



	// 		$payment_term = $_POST["payment_term"];



	// 		$sale_note = $_POST["sale_note"];

	// 		$design_url = $_POST["design_url"];



	// 		if (isset($_POST["is_duplicate"]) && $_POST["is_duplicate"] == "1") {



	// 			$qdoc_id = $_POST["edit_quote_id"];



	// 			$sql_update_doc = "UPDATE tbl_quote_doc SET user_id='" . $user_id . "',comp_id='" . $comp_id . "',comp_name='" . addslashes($comp_name) . "',comp_info='" . addslashes($comp_info) . "',curr_id='" . $curr_id . "'";

	// 			$sql_update_doc .= ",quote_curr='" . addslashes($quote_curr) . "',payment_term='" . addslashes($payment_term) . "',cust_id='" . $cust_id . "',cust_name='" . addslashes($cust_name) . "'";

	// 			$sql_update_doc .= ",cust_info='" . addslashes($cust_info) . "',est_number='" . $est_number . "',po_number='" . $po_number . "',est_date='" . $est_date . "',exp_date='" . $exp_date . "',inc_vat='" . $inc_vat . "',vat_value='" . $vat_value . "'";

	// 			$sql_update_doc .= ",num_item='" . $num_item . "',discount_percent='" . $discount_percent . "',actual_discount='" . $actual_discount . "',sub_total='" . $sub_total . "',grand_total='" . $grand_total . "',sale_note='" . addslashes($sale_note) . "',design_url='" . addslashes($design_url) . "',note=NULL,approve_status='new'";

	// 			$sql_update_doc .= ",approve_date=NULL,reject_time=NULL,history_qdoc_id=NULL,is_temp=0,temp_id=NULL,is_editing=0,archive=0,is_duplicate=0,add_date='" . $add_date . "' WHERE qdoc_id='" . $qdoc_id . "' ";

	// 			Yii::app()->db->createCommand($sql_update_doc)->execute();



	// 			$delete_old_item = "DELETE FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "'; ";

	// 			Yii::app()->db->createCommand($delete_old_item)->execute();
	// 		} else {



	// 			$tmp_user_id = $user_id;

	// 			if ($edit_for_user_id != "") {

	// 				$tmp_user_id = $edit_for_user_id;
	// 			}



	// 			$sql_insert_doc = "INSERT INTO tbl_quote_doc (user_id,comp_id,comp_name,comp_info,payment_term,cust_id,cust_name,cust_info,est_number,po_number,est_date,exp_date,inc_vat,vat_value,num_item,curr_id,quote_curr,discount_percent,actual_discount,sub_total,grand_total,sale_note,design_url,add_date" . $extra_field . ")";

	// 			$sql_insert_doc .= " VALUES (";

	// 			$sql_insert_doc .= "'" . $tmp_user_id . "','" . $comp_id . "','" . addslashes($comp_name) . "','" . addslashes($comp_info) . "','" . addslashes($payment_term) . "','" . $cust_id . "','" . addslashes($cust_name) . "','" . addslashes($cust_info) . "','" . $est_number . "','" . $po_number . "','" . $est_date . "','" . $exp_date . "'";

	// 			$sql_insert_doc .= ",'" . $inc_vat . "','" . $vat_value . "','" . $num_item . "','" . $curr_id . "','" . addslashes($quote_curr) . "','" . $discount_percent . "','" . $actual_discount . "','" . $sub_total . "','" . $grand_total . "','" . addslashes($sale_note) . "','" . addslashes($design_url) . "','" . $add_date . "'" . $extra_value;

	// 			$sql_insert_doc .= "); ";



	// 			Yii::app()->db->createCommand($sql_insert_doc)->execute();

	// 			$qdoc_id = Yii::app()->db->getLastInsertID();



	// 			$sql_insert_doc_draft = "INSERT INTO tbl_quote_doc_draft (qdoc_id,user_id,comp_id,comp_name,comp_info,payment_term,cust_id,cust_name,cust_info,est_number,po_number,est_date,exp_date,inc_vat,vat_value,num_item,curr_id,quote_curr,discount_percent,actual_discount,sub_total,grand_total,sale_note,design_url,add_date" . $extra_field . ")";

	// 			$sql_insert_doc_draft .= " VALUES (";

	// 			$sql_insert_doc_draft .= "'" . $qdoc_id . "','" . $tmp_user_id . "','" . $comp_id . "','" . addslashes($comp_name) . "','" . addslashes($comp_info) . "','" . addslashes($payment_term) . "','" . $cust_id . "','" . addslashes($cust_name) . "','" . addslashes($cust_info) . "','" . $est_number . "','" . $po_number . "','" . $est_date . "','" . $exp_date . "'";

	// 			$sql_insert_doc_draft .= ",'" . $inc_vat . "','" . $vat_value . "','" . $num_item . "','" . $curr_id . "','" . addslashes($quote_curr) . "','" . $discount_percent . "','" . $actual_discount . "','" . $sub_total . "','" . $grand_total . "','" . addslashes($sale_note) . "','" . addslashes($design_url) . "','" . $add_date . "'" . $extra_value;

	// 			$sql_insert_doc_draft .= "); ";



	// 			Yii::app()->db->createCommand($sql_insert_doc_draft)->execute();
	// 		}





	// 		$sort_count = 1;

	// 		foreach ($_POST["pro_type"] as $tmp_key => $pro_type) {



	// 			$pro_name = addslashes(base64_decode($_POST["pro_name"][$tmp_key]));

	// 			$pro_desc = addslashes(base64_decode($_POST["pro_desc"][$tmp_key]));

	// 			$qty = $_POST["qty"][$tmp_key];

	// 			$uprice = $_POST["uprice"][$tmp_key];

	// 			$uprice_ori = $_POST["uprice_ori"][$tmp_key];







	// 			if ($pro_type != "other") {



	// 				if ($pro_type == "extra") {

	// 					$item_id = str_replace("e", "", $_POST["item_id"][$tmp_key]);
	// 				} else {

	// 					$item_id = $_POST["item_id"][$tmp_key];
	// 				}



	// 				$addi_id_list = "";

	// 				$addi_desc = "";



	// 				if (isset($_POST["addi_id_list"][$tmp_key])) {

	// 					$addi_id_list = $_POST["addi_id_list"][$tmp_key];
	// 				}

	// 				if (isset($_POST["addi_desc"][$tmp_key])) {

	// 					$addi_desc = addslashes(base64_decode($_POST["addi_desc"][$tmp_key]));
	// 				}



	// 				$comm_percent = $_POST["comm_percent"][$tmp_key];

	// 				$qty_note = addslashes($_POST["qty_note"][$tmp_key]);



	// 				$sql_insert_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,addi_desc,comm_percent,sort,add_date) VALUES (";

	// 				$sql_insert_item .= "'" . $qdoc_id . "','" . $pro_type . "','" . $item_id . "','" . $pro_name . "','" . $pro_desc . "','" . $qty . "','" . $qty_note . "','" . $uprice . "','" . $uprice_ori . "','" . $addi_id_list . "','" . $addi_desc . "','" . $comm_percent . "','" . $sort_count . "','" . $add_date . "'";

	// 				$sql_insert_item .= "); ";



	// 				/*$a_result["result"] = "fail";

	// 				$a_result["msg"] = "TEST=".$sql_insert_item;

	// 				echo json_encode($a_result);

	// 				exit();*/

	// 				Yii::app()->db->createCommand($sql_insert_item)->execute();



	// 				$sql_insert_item_draft = "INSERT INTO tbl_quote_item_draft (qdoc_id,pro_type,item_id,pro_name,pro_desc,qty,qty_note,uprice,uprice_ori,addi_id_list,addi_desc,comm_percent,sort,add_date) VALUES (";

	// 				$sql_insert_item_draft .= "'" . $qdoc_id . "','" . $pro_type . "','" . $item_id . "','" . $pro_name . "','" . $pro_desc . "','" . $qty . "','" . $qty_note . "','" . $uprice . "','" . $uprice_ori . "','" . $addi_id_list . "','" . $addi_desc . "','" . $comm_percent . "','" . $sort_count . "','" . $add_date . "'";

	// 				$sql_insert_item_draft .= "); ";



	// 				/*$a_result["result"] = "fail";

	// 				$a_result["msg"] = "TEST=".$sql_insert_item;

	// 				echo json_encode($a_result);

	// 				exit();*/

	// 				Yii::app()->db->createCommand($sql_insert_item_draft)->execute();
	// 			} else {



	// 				$sql_insert_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,item_id,pro_name,pro_desc,qty,qty_note,uprice,addi_id_list,comm_percent,sort,add_date) VALUES (";

	// 				$sql_insert_item .= "'" . $qdoc_id . "','" . $pro_type . "',NULL,'" . $pro_name . "','" . $pro_desc . "','" . $qty . "',NULL,'" . $uprice . "',NULL,NULL,'" . $sort_count . "','" . $add_date . "'";

	// 				$sql_insert_item .= "); ";

	// 				Yii::app()->db->createCommand($sql_insert_item)->execute();



	// 				$sql_insert_item_draft = "INSERT INTO tbl_quote_item_draft (qdoc_id,pro_type,item_id,pro_name,pro_desc,qty,qty_note,uprice,addi_id_list,comm_percent,sort,add_date) VALUES (";

	// 				$sql_insert_item_draft .= "'" . $qdoc_id . "','" . $pro_type . "',NULL,'" . $pro_name . "','" . $pro_desc . "','" . $qty . "',NULL,'" . $uprice . "',NULL,NULL,'" . $sort_count . "','" . $add_date . "'";

	// 				$sql_insert_item_draft .= "); ";

	// 				Yii::app()->db->createCommand($sql_insert_item_draft)->execute();
	// 			}



	// 			$sort_count++;
	// 		}





	// 		$a_result["result"] = "success";

	// 		$a_result["est_number"] = $est_number;

	// 		echo json_encode($a_result);
	// 	}



	public function actionEnableQuoteCart()

	{



		$a_data["qdoc_id"] = $_POST["qdoc_id"];

		$a_data["num_item"] = $_POST["num_item"];

		$a_data["est_number"] = $_POST["est_number"];

		$a_data["edit_after_approved"] = isset($_POST["edit_after_approved"]) ? $_POST["edit_after_approved"] : "no";



		setcookie("JOG_CART_Quote", json_encode($a_data), time() + 36000); //10 hours



		//$this->redirect(array('priceGuide/hockeyLine'));

		$a_result["result"] = "success";

		echo json_encode($a_result);
	}



	public function actionAddToQuotation()

	{



		$qdoc_id = $_POST["qdoc_id"];

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



		/*$sql_item_chk = "SELECT * FROM tbl_quote_item WHERE qdoc_id='".$qdoc_id."' AND item_id='".$item_id."' AND enable=1; ";

		$a_item_chk = Yii::app()->db->createCommand($sql_item_chk)->queryAll();



		if(sizeof($a_item_chk)>0){

			echo "Duplicate item! \nYou must delete item from Quotation before if you want to change price.";

			exit();

		}*/

		//exit();



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



		$sql_add_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,item_id,pro_name,pro_desc,qty_note,uprice,uprice_ori,comm_percent,sort,add_date) VALUES (";

		$sql_add_item .= "'" . $qdoc_id . "','" . $p_type . "','" . $item_id . "','" . $pro_name . "','" . $pro_desc . "','" . $qty_note . "','" . $uprice . "','" . $uprice . "','" . $comm_percent . "','" . $max_sort . "','" . $add_date . "'";

		$sql_add_item .= "); ";

		Yii::app()->db->createCommand($sql_add_item)->execute();



		$sql_update = "UPDATE tbl_quote_doc SET num_item=num_item+1 WHERE qdoc_id='" . $qdoc_id . "'; ";



		$a_data = array();



		if (Yii::app()->db->createCommand($sql_update)->execute()) {



			$obj_cart_quote = (array)json_decode($_COOKIE["JOG_CART_Quote"]);



			$a_data = $obj_cart_quote;

			$a_data["num_item"] = intval($obj_cart_quote["num_item"]) + 1;



			setcookie("JOG_CART_Quote", json_encode($a_data));



			echo "success";
		} else {

			echo "Fail to add item.";
		}
	}



	public function actionDisableQuoteCart()

	{



		setcookie("JOG_CART_Quote", "", time() - 3600);



		$a_result["result"] = "success";

		echo json_encode($a_result);
	}



	public function actionDeleteItemFromQuote()

	{



		$qdoci_id = $_POST["qdoci_id"];



		$sql_item = "SELECT * FROM tbl_quote_item WHERE qdoci_id='" . $qdoci_id . "'; ";

		$a_item = Yii::app()->db->createCommand($sql_item)->queryAll();

		$row_item = $a_item[0];

		$tmp_uprice = floatval($row_item["uprice"]);

		$qty = intval($row_item["qty"]);

		$addi_id_list = $row_item["addi_id_list"];

		$qdoc_id = $row_item["qdoc_id"];

		$sort = $row_item["sort"];


		if (!empty($a_item)) {
			$sql_doc = "SELECT * FROM tbl_quote_doc WHERE qdoc_id=" . $qdoc_id . "; ";

			$a_doc = Yii::app()->db->createCommand($sql_doc)->queryAll();

			$row_doc = $a_doc[0];



			$vat_value = floatval($row_doc["vat_value"]);



			$num_item = intval($row_doc["num_item"]);

			$sub_total = floatval($row_doc["sub_total"]);

			//$grand_total = floatval($row_doc["grand_total"]);

			$curr_id = $row_doc["curr_id"];



			$tmp_amount = $tmp_uprice * $qty;



			$new_vat_value = $vat_value - ($tmp_amount * 0.07);



			$new_num_item = $num_item - 1;

			$new_sub_total = $sub_total - $tmp_amount;

			$new_grand_total = 0.0;

			if ($row_doc["inc_vat"] == "yes") {

				$new_grand_total = $new_sub_total + $new_vat_value;
			} else {

				$new_grand_total = $new_sub_total;
			}



			$sql_update1 = "UPDATE tbl_quote_doc SET vat_value='" . $new_vat_value . "',num_item='" . $new_num_item . "',sub_total='" . $new_sub_total . "',grand_total='" . $new_grand_total . "' WHERE qdoc_id='" . $qdoc_id . "'; ";

			Yii::app()->db->createCommand($sql_update1)->execute();



			$sql_update2 = "UPDATE tbl_quote_item SET enable=0 WHERE qdoci_id='" . $qdoci_id . "'; ";



			if (Yii::app()->db->createCommand($sql_update2)->execute()) {



				if (isset($_COOKIE["JOG_CART_Quote"]) && $_COOKIE["JOG_CART_Quote"] != "") {

					$obj_cart_quote = (array)json_decode($_COOKIE["JOG_CART_Quote"]);



					$a_data = $obj_cart_quote;

					$a_data["num_item"] = intval($obj_cart_quote["num_item"]) - 1;



					setcookie("JOG_CART_Quote", json_encode($a_data));
				}



				$sql_update3 = "UPDATE tbl_quote_item SET sort=sort-1 WHERE qdoc_id='" . $qdoc_id . "' AND sort>'" . $sort . "' AND enable=1; ";

				Yii::app()->db->createCommand($sql_update3)->execute();



				$a_result["result"] = "success";

				$a_result["qdoc_id"] = $qdoc_id;
			} else {

				$a_result["result"] = "fail";

				$a_result["msg"] = "Fail to delete.";
			}



			echo json_encode($a_result);
		} else {
			echo json_encode(['status' => 'failed']);
		}
	}



	public function actionSaveRejectQuoteData()

	{

		// print_r($_POST);

		// die;

		$num_item = sizeof($_POST["a_qdoci_id"]);

		$time_now = date("Y-m-d H:i:s");

		$sub_total = 0.0;

		$qdoc_id = $_POST["edit_quote_id"];



		$delete_data = array_diff($_POST['a_qdoci_id'], array("new_other"));

		$a_qdoci_id_exp = implode(',', $delete_data);

		// print_r($a_qdoci_id_exp); 
		// print_r($qdoc_id); die ; 

		$num_item = sizeof($_POST["a_qdoci_id"]);

		$time_now = date("Y-m-d H:i:s");



		$qdoc_id = $_POST["edit_quote_id"];

		$del_sql = "DELETE FROM tbl_quote_item WHERE qdoc_id='$qdoc_id' AND qdoci_id NOT IN ($a_qdoci_id_exp)";

		Yii::app()->db->createCommand($del_sql)->execute();

		$num_new_other = 0;



		$sql_max = "SELECT MAX(sort) AS max_sort FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND enable=1; ";

		$a_max = Yii::app()->db->createCommand($sql_max)->queryAll();

		$max_sort = intval($a_max[0]["max_sort"]);

		$max_sort++;



		$num_new_other = 0;



		for ($i = 0; $i < $num_item; $i++) {



			$qdoci_id = $_POST["a_qdoci_id"][$i];

			$pro_name = addslashes($_POST["product_item"][$i]);

			$pro_desc = addslashes($_POST["product_desc"][$i]);



			$uprice = floatval($_POST["uprice"][$i]);

			$qty = floatval($_POST["qty"][$i]);







			if ($qdoci_id == "new_other") {



				$num_new_other++;



				$sql_add_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,pro_name,pro_desc,qty,uprice,sort,add_date) VALUES (";

				$sql_add_item .= "'" . $qdoc_id . "','other','" . $pro_name . "','" . $pro_desc . "','" . $qty . "','" . $uprice . "','" . $max_sort . "','" . date("Y-m-d H:i:s") . "'";

				$sql_add_item .= "); ";

				Yii::app()->db->createCommand($sql_add_item)->execute();



				$max_sort++;
			} else {



				//$product_id = $_POST["product_id"][$i];

				$tmp_id = $_POST["tmp_id"][$i];

				$addi_id_list = "";

				$a_addi_id = array();

				if (isset($_POST["addi_id"][$tmp_id])) {

					$a_addi_id = $_POST["addi_id"][$tmp_id];

					for ($j = 0; $j < sizeof($a_addi_id); $j++) {



						$a_tmp = explode("|", $a_addi_id[$j]);

						$addi_id = $a_tmp[0];

						$addi_value = floatval($a_tmp[1]);



						if (intval($addi_id) != 0) {

							if ($addi_id_list != "") {

								$addi_id_list .= ",";
							}

							$addi_id_list .= $addi_id;



							//$user_group = Yii::app()->user->getState('userGroup');



							//if( $user_group!="1" && $user_group!="99" ){

							//	$uprice += $addi_value;

							//}



						}
					}
				}



				$sql_update = "UPDATE tbl_quote_item SET pro_name='" . $pro_name . "',pro_desc='" . $pro_desc . "',qty='" . $qty . "',uprice='" . $uprice . "',addi_id_list='" . $addi_id_list . "',modified_date='" . $time_now . "' WHERE qdoci_id='" . $qdoci_id . "';";

				Yii::app()->db->createCommand($sql_update)->execute();
			}



			$sub_total += ($qty * $uprice);
		}



		$vat_value = $sub_total * 0.07;





		$sql_vat = "SELECT inc_vat FROM tbl_quote_doc WHERE qdoc_id=" . $qdoc_id . "; ";

		$a_vat = Yii::app()->db->createCommand($sql_vat)->queryAll();

		$inc_vat = $a_vat[0]["inc_vat"];



		$grand_total = 0.0;



		if ($inc_vat == "yes") {

			$grand_total = $sub_total + $vat_value;
		} else {

			$grand_total = $sub_total;
		}



		$sql_update2 = "UPDATE tbl_quote_doc SET vat_value='" . $vat_value . "',num_item='" . $num_item . "',sub_total='" . $sub_total . "',grand_total='" . $grand_total . "' WHERE qdoc_id='" . $qdoc_id . "';";

		Yii::app()->db->createCommand($sql_update2)->execute();



		if (isset($_COOKIE["JOG_CART_Quote"]) && $_COOKIE["JOG_CART_Quote"] != "") {

			$obj_cart_quote = (array)json_decode($_COOKIE["JOG_CART_Quote"]);



			$a_data = $obj_cart_quote;

			$a_data["num_item"] = intval($obj_cart_quote["num_item"]) + $num_new_other;



			setcookie("JOG_CART_Quote", json_encode($a_data));
		}



		echo "success";
	}



	public function actionSaveQuoteData()

	{

		$delete_data = array_diff($_POST['a_qdoci_id'], array("new_other"));

		$a_qdoci_id_exp = implode(',', $delete_data);

		$num_item = sizeof($_POST["a_qdoci_id"]);

		$time_now = date("Y-m-d H:i:s");



		$qdoc_id = $_POST["edit_quote_id"];

		$del_sql = "DELETE FROM tbl_quote_item WHERE qdoc_id='$qdoc_id' AND qdoci_id NOT IN ($a_qdoci_id_exp)";

		Yii::app()->db->createCommand($del_sql)->execute();

		$num_new_other = 0;



		$sql_max = "SELECT MAX(sort) AS max_sort FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND enable=1; ";

		$a_max = Yii::app()->db->createCommand($sql_max)->queryAll();

		$max_sort = intval($a_max[0]["max_sort"]);

		$max_sort++;



		for ($i = 0; $i < $num_item; $i++) {



			$qdoci_id = $_POST["a_qdoci_id"][$i];

			$pro_name = addslashes($_POST["product_item"][$i]);

			$pro_desc = addslashes($_POST["product_desc"][$i]);

			$up_price =  empty($_POST['uprice'][$i]) ?  0 : $_POST['uprice'][$i];


			$qty = $_POST["qty"][$i];



			if ($qdoci_id == "new_other") {



				$num_new_other++;



				$uprice = floatval($_POST["uprice"][$i]);

				$qty = floatval($_POST["qty"][$i]);



				// $sql_add_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,pro_name,pro_desc,qty,sort,add_date) VALUES (";

				// $sql_add_item .= "'".$qdoc_id."','other','".$pro_name."','".$pro_desc."','".$qty."','".$max_sort."','".date("Y-m-d H:i:s")."'";

				// $sql_add_item .= "); ";



				$sql_add_item = "INSERT INTO tbl_quote_item (qdoc_id,pro_type,pro_name,pro_desc,qty,uprice,sort,add_date) VALUES (";

				$sql_add_item .= "'" . $qdoc_id . "','other','" . $pro_name . "','" . $pro_desc . "','" . $qty . "','" . $uprice . "','" . $max_sort . "','" . date("Y-m-d H:i:s") . "'";

				$sql_add_item .= "); ";



				Yii::app()->db->createCommand($sql_add_item)->execute();



				$max_sort++;
			} else {

				$sql_update = "UPDATE tbl_quote_item SET pro_name='" . $pro_name . "',pro_desc='" . $pro_desc . "',qty='" . $qty . "',modified_date='" . $time_now . "', uprice = " . $up_price . " WHERE qdoci_id='" . $qdoci_id . "';";
				Yii::app()->db->createCommand($sql_update)->execute();
			}
		}



		$sql_subtotal = "SELECT SUM(qty*uprice) AS sub_total FROM tbl_quote_item WHERE qdoc_id='" . $qdoc_id . "' AND enable=1; ";

		$a_subtotal = Yii::app()->db->createCommand($sql_subtotal)->queryAll();

		$sub_total = floatval($a_subtotal[0]["sub_total"]);



		$sql_vat = "SELECT * FROM tbl_quote_doc WHERE qdoc_id=" . $qdoc_id . "; ";

		$a_vat = Yii::app()->db->createCommand($sql_vat)->queryAll();

		$inc_vat = $a_vat[0]["inc_vat"];

		$discount_percent = $a_vat[0]["discount_percent"];



		$discount = ($discount_percent / 100) * $sub_total;

		$discount_val = number_format((float)$discount, 2, '.', '');



		$new_sub_total = $sub_total - $discount_val;



		$vat_value = $new_sub_total * 0.07;

		$grand_total = 0.0;



		if ($inc_vat == "yes") {

			$grand_total = $new_sub_total + $vat_value;
		} else {

			$grand_total = $new_sub_total;
		}



		$sql_update2 = "UPDATE tbl_quote_doc SET vat_value='" . $vat_value . "',num_item='" . $num_item . "',sub_total='" . $sub_total . "',actual_discount='" . $discount_val . "',grand_total='" . $grand_total . "' WHERE qdoc_id='" . $qdoc_id . "';";

		Yii::app()->db->createCommand($sql_update2)->execute();



		if (isset($_COOKIE["JOG_CART_Quote"]) && $_COOKIE["JOG_CART_Quote"] != "") {

			$obj_cart_quote = (array)json_decode($_COOKIE["JOG_CART_Quote"]);



			$a_data = $obj_cart_quote;

			$a_data["num_item"] = intval($obj_cart_quote["num_item"]) + $num_new_other;



			setcookie("JOG_CART_Quote", json_encode($a_data));
		}



		echo "success";
	}



	public function actionAdminPanel()

	{



		if (Yii::app()->user->getState('userGroup') != 99 && Yii::app()->user->getState('userGroup') != 1) {

			echo "Invalid path";

			exit();
		}



		$sql_sat = "SELECT * FROM tbl_sale_type WHERE enable=1 ORDER BY sort ASC; ";

		$result["a_sat"] = Yii::app()->db->createCommand($sql_sat)->queryAll();



		echo $this->renderPartial('admin_panel', $result);
	}



	public function actionUserShow($product = 1)

	{



		$user_group = Yii::app()->user->getState('userGroup');



		if ($product == "" || $product == 0) {

			$product = 1;
		}



		$sql = "SELECT * FROM tbl_sale_type WHERE enable=1 ORDER BY sort ASC; ";

		$result['row_sale_type'] = Yii::app()->db->createCommand($sql)->queryAll();



		$sql2 = "SELECT * FROM tbl_currency WHERE enable=1 ORDER BY sort ASC; ";

		$result['row_currency'] = Yii::app()->db->createCommand($sql2)->queryAll();



		$sql3 = "SELECT * FROM tbl_product WHERE prod_id='" . $product . "'; ";

		$result['row_product'] = Yii::app()->db->createCommand($sql3)->queryAll();



		$sql4 = "SELECT * FROM notes WHERE prod_id='" . $product . "' ORDER BY id ASC LIMIT 0,1; ";

		$a_notes = Yii::app()->db->createCommand($sql4)->queryAll();

		if (sizeof($a_notes) > 0) {

			$result['row_notes'] = $a_notes[0];
		} else {

			$result['row_notes'] = array();
		}



		$sql_item_group = "SELECT * FROM tbl_item_group WHERE prod_id='" . $product . "' ORDER BY sort ASC; ";

		$result["a_item_group"] = Yii::app()->db->createCommand($sql_item_group)->queryAll();



		$sql_prod_sat = "SELECT * FROM tbl_prod_sale_type WHERE prod_id='" . $product . "';";

		$row_prod_sat = Yii::app()->db->createCommand($sql_prod_sat)->queryAll();

		$result["sat_id_list"] = $row_prod_sat[0]["sat_id_list"];



		$sql_prod = "SELECT * FROM tbl_product WHERE enable=1 ORDER BY sort ASC; ";

		$a_prod = Yii::app()->db->createCommand($sql_prod)->queryAll();

		$result['a_row_product'] = $a_prod;



		$result['admin_edit'] = "yes";



		$this->render('user_product_template', $result);
	}



	public function actionAdminShow($product = 1)

	{



		$user_group = Yii::app()->user->getState('userGroup');



		if ($user_group != "1" && $user_group != "99") {



			echo $this->renderPartial('not_allow');

			exit();
		}



		if ($product == "" || $product == 0) {

			$product = 1;
		}



		$sql = "SELECT * FROM tbl_sale_type WHERE enable=1 ORDER BY sort ASC; ";

		$result['row_sale_type'] = Yii::app()->db->createCommand($sql)->queryAll();



		$sql2 = "SELECT * FROM tbl_currency WHERE enable=1 ORDER BY sort ASC; ";

		$result['row_currency'] = Yii::app()->db->createCommand($sql2)->queryAll();



		$sql3 = "SELECT * FROM tbl_product WHERE prod_id='" . $product . "'; ";

		$result['row_product'] = Yii::app()->db->createCommand($sql3)->queryAll();



		$sql4 = "SELECT * FROM notes WHERE prod_id='" . $product . "' ORDER BY id ASC LIMIT 0,1; ";

		$a_notes = Yii::app()->db->createCommand($sql4)->queryAll();

		if (sizeof($a_notes) > 0) {

			$result['row_notes'] = $a_notes[0];
		} else {

			$result['row_notes'] = array();
		}



		$sql_item_group = "SELECT * FROM tbl_item_group WHERE prod_id='" . $product . "' ORDER BY sort ASC; ";

		$result["a_item_group"] = Yii::app()->db->createCommand($sql_item_group)->queryAll();



		$sql_prod_sat = "SELECT * FROM tbl_prod_sale_type WHERE prod_id='" . $product . "';";

		$row_prod_sat = Yii::app()->db->createCommand($sql_prod_sat)->queryAll();

		$result["sat_id_list"] = $row_prod_sat[0]["sat_id_list"];



		$sql_prod = "SELECT * FROM tbl_product WHERE enable=1 ORDER BY sort ASC; ";

		$a_prod = Yii::app()->db->createCommand($sql_prod)->queryAll();

		$result['a_row_product'] = $a_prod;



		$result['admin_edit'] = "yes";



		$this->render('product_template', $result);
	}


	public function actionDesignAdminShow($product = 1)
	{
		$user_group = Yii::app()->user->getState('userGroup');
		if ($user_group != "" && $user_group != "7") {
			echo $this->renderPartial('not_allow');
			exit();
		}

		if ($product == "" || $product == 0) {
			$product = 1;
		}
		$sql = "SELECT * FROM tbl_sale_type WHERE enable=1 ORDER BY sort ASC; ";
		$result['row_sale_type'] = Yii::app()->db->createCommand($sql)->queryAll();

		$sql2 = "SELECT * FROM tbl_currency WHERE enable=1 ORDER BY sort ASC; ";
		$result['row_currency'] = Yii::app()->db->createCommand($sql2)->queryAll();

		$sql3 = "SELECT * FROM tbl_product WHERE prod_id='" . $product . "'; ";
		$result['row_product'] = Yii::app()->db->createCommand($sql3)->queryAll();

		$sql4 = "SELECT * FROM notes WHERE prod_id='" . $product . "' ORDER BY id ASC LIMIT 0,1; ";
		$a_notes = Yii::app()->db->createCommand($sql4)->queryAll();
		if (sizeof($a_notes) > 0) {
			$result['row_notes'] = $a_notes[0];
		} else {
			$result['row_notes'] = array();
		}

		$sql_item_group = "SELECT * FROM tbl_item_group WHERE prod_id='" . $product . "' ORDER BY sort ASC; ";
		$result["a_item_group"] = Yii::app()->db->createCommand($sql_item_group)->queryAll();
		$sql_prod_sat = "SELECT * FROM tbl_prod_sale_type WHERE prod_id='" . $product . "';";
		$row_prod_sat = Yii::app()->db->createCommand($sql_prod_sat)->queryAll();
		$result["sat_id_list"] = $row_prod_sat[0]["sat_id_list"];

		$sql_prod = "SELECT * FROM tbl_product WHERE enable=1 ORDER BY sort ASC; ";
		$a_prod = Yii::app()->db->createCommand($sql_prod)->queryAll();
		$result['a_row_product'] = $a_prod;

		$result['admin_edit'] = "yes";

		$this->render('design_product_template', $result);
	}

	/*public function actionAdminShowExtra($prod,$curr = 1){



		$curr_id = $curr;

		$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='".$curr_id."'; ";

		$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

		$result['row_curr'] = $a_curr[0];



		$prod_id = $prod;

		$sql_extra = "SELECT * FROM tbl_extra WHERE curr_id='".$curr_id."' AND prod_id='".$prod_id."' ORDER BY extra_name ASC; ";

		$result["a_extra"] = Yii::app()->db->createCommand($sql_extra)->queryAll();



		if(sizeof($result["a_extra"])>0){

			echo $this->renderPartial('/priceGuideV2/show_extra',$result);

		}else{

			echo "empty";

		}



	}*/



	public function actionAdminPanelShowProduct()

	{



		$sql = "SELECT tbl_product.*,tbl_prod_sale_type.sat_id_list FROM tbl_product LEFT JOIN tbl_prod_sale_type ON tbl_product.prod_id=tbl_prod_sale_type.prod_id ORDER BY tbl_product.sort ASC; ";

		$result['a_product'] = Yii::app()->db->createCommand($sql)->queryAll();



		echo $this->renderPartial('admin_show_product', $result);
	}



	public function actionupdateCurrQuote()

	{

		$curr_id = $_POST['curr_id'];

		$price = $_POST['value'];

		$update_sql = "UPDATE tbl_currency SET quote_currency=" . $price . " WHERE curr_id='" . $curr_id . "' ";

		Yii::app()->db->createCommand($update_sql)->execute();

		die(json_encode(array('status' => '1')));
	}



	public function actionadminPanelShowQuoteCurrency()

	{

		$sql = "SELECT * FROM tbl_currency WHERE curr_id<>'1'";

		$result['a_product'] = Yii::app()->db->createCommand($sql)->queryAll();



		echo $this->renderPartial('admin_panel_currency_quotation', $result);
	}



	public function actionAdminPanelShowProductAll()

	{



		$sql = "SELECT tbl_product.*,tbl_prod_sale_type.sat_id_list FROM tbl_product LEFT JOIN tbl_prod_sale_type ON tbl_product.prod_id=tbl_prod_sale_type.prod_id ORDER BY tbl_product.sort ASC; ";

		$result['a_product'] = Yii::app()->db->createCommand($sql)->queryAll();



		die(json_encode($result));
	}



	public function actionAdminSwapProductItem()

	{



		$own_id = $_POST["own_id"];

		$swap_id = $_POST["swap_id"];



		$sql = "SELECT sort_no FROM tbl_extra WHERE extra_id='" . $own_id . "'; ";

		$a_own = Yii::app()->db->createCommand($sql)->queryAll();



		$own_sort = $a_own[0]["sort_no"];



		$sql2 = "SELECT sort_no FROM tbl_extra WHERE extra_id='" . $swap_id . "'; ";

		$a_swap = Yii::app()->db->createCommand($sql2)->queryAll();

		$swap_sort = $a_swap[0]["sort_no"];



		$sql_update = "UPDATE tbl_extra SET sort_no='" . $swap_sort . "' WHERE extra_id='" . $own_id . "'; ";

		Yii::app()->db->createCommand($sql_update)->execute();



		$sql_update2 = "UPDATE tbl_extra SET sort_no='" . $own_sort . "' WHERE extra_id='" . $swap_id . "'; ";

		Yii::app()->db->createCommand($sql_update2)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionAdminSwapProductItemSortable()

	{

		$production_id_list = $_POST['production_id_list'];

		$sort_no_list = $_POST['sort_no_list'];



		$a_production_id = explode(",", $production_id_list);

		$a_sort_no = explode(",", $sort_no_list);



		for ($i = 0; $i < sizeof($a_production_id); $i++) {



			$update_sql = "UPDATE tbl_extra SET sort_no=" . $a_sort_no[$i] . " WHERE extra_id='" . $a_production_id[$i] . "' ";

			Yii::app()->db->createCommand($update_sql)->execute();
		}



		echo json_encode(array("result" => "success"));
	}



	public function actionAdminSwapProduct()

	{



		$own_id = $_POST["own_id"];

		$swap_id = $_POST["swap_id"];



		$sql = "SELECT sort FROM tbl_product WHERE prod_id='" . $own_id . "'; ";

		$a_own = Yii::app()->db->createCommand($sql)->queryAll();

		$own_sort = $a_own[0]["sort"];



		$sql2 = "SELECT sort FROM tbl_product WHERE prod_id='" . $swap_id . "'; ";

		$a_swap = Yii::app()->db->createCommand($sql2)->queryAll();

		$swap_sort = $a_swap[0]["sort"];



		$sql_update = "UPDATE tbl_product SET sort='" . $swap_sort . "' WHERE prod_id='" . $own_id . "'; ";

		Yii::app()->db->createCommand($sql_update)->execute();



		$sql_update2 = "UPDATE tbl_product SET sort='" . $own_sort . "' WHERE prod_id='" . $swap_id . "'; ";

		Yii::app()->db->createCommand($sql_update2)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionSubmitAdminAddProduct()

	{



		$sql = "SELECT MAX(sort) AS max_sort FROM tbl_product; ";

		$a_max_sort = Yii::app()->db->createCommand($sql)->queryAll();

		$max_sort = $a_max_sort[0]["max_sort"];



		$new_sort = intval($max_sort) + 1;



		$prod_name = addslashes($_POST["new_prod_name"]);

		$prod_type = addslashes($_POST["new_prod_type"]);

		$prod_detail = addslashes($_POST["new_prod_detail"]);

		$prod_note = addslashes($_POST["new_prod_note"]);

		$date_add = date("Y-m-d H:i:s");



		$a_sat_select = array();

		if (isset($_POST["sat_select"])) {

			$a_sat_select = $_POST["sat_select"];
		}



		$s_sat_id_list = "";

		if (sizeof($a_sat_select) > 0) {

			$s_sat_id_list = implode(",", $a_sat_select);
		}



		$sql_insert = "INSERT INTO tbl_product (prod_name,prod_type,prod_detail,prod_note,sort,date_add) VALUES ('" . $prod_name . "','" . $prod_type . "','" . $prod_detail . "','" . $prod_note . "','" . $new_sort . "','" . $date_add . "'); ";

		Yii::app()->db->createCommand($sql_insert)->execute();

		$prod_id = Yii::app()->db->getLastInsertID();



		$sql_insert2 = "INSERT INTO tbl_prod_sale_type (prod_id,sat_id_list,modified_date) VALUES ('" . $prod_id . "','" . $s_sat_id_list . "','" . date("Y-m-d H:i:s") . "'); ";

		Yii::app()->db->createCommand($sql_insert2)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionSubmitAdminEditProduct()

	{



		$prod_id = $_POST["edit_prod_id"];

		$prod_name = addslashes($_POST["edit_prod_name"]);

		$prod_type = addslashes($_POST["edit_prod_type"]);

		$prod_detail = addslashes($_POST["edit_prod_detail"]);

		$prod_note = addslashes($_POST["edit_prod_note"]);

		$prod_enable = $_POST["edit_prod_enable"];



		$a_sat_select = array();

		if (isset($_POST["edit_sat_select"])) {

			$a_sat_select = $_POST["edit_sat_select"];
		}



		$s_sat_id_list = "";

		if (sizeof($a_sat_select) > 0) {

			$s_sat_id_list = implode(",", $a_sat_select);
		}



		$sql_update = "UPDATE tbl_product SET prod_name='" . $prod_name . "',prod_type='" . $prod_type . "',prod_detail='" . $prod_detail . "',prod_note='" . $prod_note . "',enable='" . $prod_enable . "' WHERE prod_id='" . $prod_id . "'; ";

		Yii::app()->db->createCommand($sql_update)->execute();



		$sql_update2 = "UPDATE tbl_prod_sale_type SET sat_id_list='" . $s_sat_id_list . "' WHERE prod_id='" . $prod_id . "'; ";

		Yii::app()->db->createCommand($sql_update2)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionGetProductInfo()

	{



		$prod_id = $_POST["prod_id"];



		$sql = "SELECT tbl_product.*,tbl_prod_sale_type.sat_id_list FROM tbl_product LEFT JOIN tbl_prod_sale_type ON tbl_product.prod_id=tbl_prod_sale_type.prod_id WHERE tbl_product.prod_id='" . $prod_id . "'; ";

		$a_product = Yii::app()->db->createCommand($sql)->queryAll();



		$a_return = array();



		if (sizeof($a_product) == 0) {

			$a_return["result"] = "fail";

			$a_return["msg"] = "Not found data.";
		} else {



			$a_return = $a_product[0];

			$a_return["result"] = "success";
		}



		echo json_encode($a_return);
	}



	public function actionAdminPanelShowCurrency()

	{



		$sql = "SELECT * FROM tbl_currency ORDER BY sort ASC; ";

		$result['a_curr'] = Yii::app()->db->createCommand($sql)->queryAll();



		$sql_count = "SELECT curr_id,COUNT(*) AS num_prices FROM tbl_price_guide GROUP BY curr_id; ";

		$a_count_data = Yii::app()->db->createCommand($sql_count)->queryAll();



		$a_curr_prices = array();

		for ($i = 0; $i < sizeof($a_count_data); $i++) {

			$a_curr_prices[($a_count_data[$i]["curr_id"]) . ""] = $a_count_data[$i]["num_prices"];
		}

		$result['a_curr_prices'] = $a_curr_prices;



		$this->renderPartial('admin_show_currency', $result);
	}



	public function actionAdminPanelShowCurrencyProduct()

	{

		$sql = "SELECT * FROM tbl_currency ORDER BY sort ASC; ";

		$result['a_curr'] = Yii::app()->db->createCommand($sql)->queryAll();



		$sql_count = "SELECT curr_id,COUNT(*) AS num_prices FROM tbl_price_guide GROUP BY curr_id; ";

		$a_count_data = Yii::app()->db->createCommand($sql_count)->queryAll();



		$a_curr_prices = array();

		for ($i = 0; $i < sizeof($a_count_data); $i++) {

			$a_curr_prices[($a_count_data[$i]["curr_id"]) . ""] = $a_count_data[$i]["num_prices"];
		}

		$result['a_curr_prices'] = $a_curr_prices;



		$sql_prod = "SELECT * FROM tbl_product; ";

		$a_product = Yii::app()->db->createCommand($sql_prod)->queryAll();

		$result['a_product'] = $a_product;



		$this->renderPartial('admin_show_currency_product', $result);
	}



	public function actionAdminSwapCurrency()

	{



		$own_id = $_POST["own_id"];

		$swap_id = $_POST["swap_id"];



		$sql = "SELECT sort FROM tbl_currency WHERE curr_id='" . $own_id . "'; ";

		$a_own = Yii::app()->db->createCommand($sql)->queryAll();

		$own_sort = $a_own[0]["sort"];



		$sql2 = "SELECT sort FROM tbl_currency WHERE curr_id='" . $swap_id . "'; ";

		$a_swap = Yii::app()->db->createCommand($sql2)->queryAll();

		$swap_sort = $a_swap[0]["sort"];



		$sql_update = "UPDATE tbl_currency SET sort='" . $swap_sort . "' WHERE curr_id='" . $own_id . "'; ";

		Yii::app()->db->createCommand($sql_update)->execute();



		$sql_update2 = "UPDATE tbl_currency SET sort='" . $own_sort . "' WHERE curr_id='" . $swap_id . "'; ";

		Yii::app()->db->createCommand($sql_update2)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionSubmitAdminAddCurrency()

	{



		$sql = "SELECT MAX(sort) AS max_sort FROM tbl_currency; ";

		$a_max_sort = Yii::app()->db->createCommand($sql)->queryAll();

		$max_sort = $a_max_sort[0]["max_sort"];



		$new_sort = intval($max_sort) + 1;



		$curr_name = addslashes($_POST["new_curr_name"]);

		$curr_desc = addslashes($_POST["new_curr_desc"]);

		$curr_symbol = addslashes($_POST["new_curr_symbol"]);

		$exchange_from_usd = $_POST["new_exchange_from_usd"];



		$sql_insert = "INSERT INTO tbl_currency (curr_name,curr_desc,curr_symbol,exchange_from_usd,sort) VALUES ('" . $curr_name . "','" . $curr_desc . "','" . $curr_symbol . "','" . $exchange_from_usd . "','" . $new_sort . "'); ";

		Yii::app()->db->createCommand($sql_insert)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionSubmitAdminEditCurrency()

	{



		$curr_id = $_POST["edit_curr_id"];

		$curr_name = addslashes($_POST["edit_curr_name"]);

		$curr_desc = addslashes($_POST["edit_curr_desc"]);

		$curr_symbol = addslashes($_POST["edit_curr_symbol"]);

		$exchange_from_usd = $_POST["edit_exchange_from_usd"];

		$curr_enable = $_POST["edit_curr_enable"];



		$sql_update = "UPDATE tbl_currency SET curr_name='" . $curr_name . "',curr_desc='" . $curr_desc . "',curr_symbol='" . $curr_symbol . "',exchange_from_usd='" . $exchange_from_usd . "',enable='" . $curr_enable . "' WHERE curr_id='" . $curr_id . "'; ";

		Yii::app()->db->createCommand($sql_update)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionGetCurrencyInfo()

	{



		$curr_id = $_POST["curr_id"];



		$sql = "SELECT * FROM tbl_currency WHERE curr_id='" . $curr_id . "'; ";

		$a_curr = Yii::app()->db->createCommand($sql)->queryAll();



		$a_return = array();



		if (sizeof($a_curr) == 0) {

			$a_return["result"] = "fail";

			$a_return["msg"] = "Not found data.";
		} else {



			$a_return = $a_curr[0];

			$a_return["result"] = "success";
		}



		echo json_encode($a_return);
	}



	public function actionBuildPricesFromUSDproduct()

	{

		$prd_id = $_POST["prd_id"];

		$curr_id = $_POST["curr_id"];



		$sql_select = "SELECT * FROM tbl_currency WHERE curr_id='" . $curr_id . "'; ";

		$a_curr = Yii::app()->db->createCommand($sql_select)->queryAll();

		$row_curr = $a_curr[0];

		$ex_rate = floatval($row_curr["exchange_from_usd"]);



		$sql_delete = "DELETE FROM tbl_price_guide WHERE curr_id = '" . $curr_id . "' AND item_id IN (SELECT item_id FROM tbl_item WHERE prod_id = '" . $prd_id . "' );";



		Yii::app()->db->createCommand($sql_delete)->execute();



		// 		$sql_insert = "INSERT INTO tbl_price_guide (item_id,curr_id,sat_id,comm_per_id,price) SELECT item_id,".$curr_id.",sat_id,comm_per_id,ROUND((price*".$ex_rate."),0) LEFT JOIN tbl_item ON tbl_item.item_id=tbl_price_guid.item_id FROM tbl_price_guide WHERE curr_id=1 AND prod_id='".$prd_id."';";

		// $sql_insert = "INSERT INTO tbl_price_guide (item_id, curr_id, sat_id, comm_per_id, price)

		// SELECT tbl_price_guide.item_id, '$curr_id', tbl_price_guide.sat_id, tbl_price_guide.comm_per_id, ROUND((tbl_price_guide.price * '$ex_rate'), 0)

		// FROM tbl_price_guide

		// JOIN tbl_item ON tbl_item.item_id = tbl_price_guide.item_id

		// WHERE tbl_price_guide.curr_id = 1

		// AND tbl_item.prod_id = '$prd_id';

		//";

		if ($curr_id == 5) {

			$sql_insert = "INSERT INTO tbl_price_guide (item_id, curr_id, sat_id, comm_per_id, price)

            SELECT tbl_price_guide.item_id, '$curr_id', tbl_price_guide.sat_id, tbl_price_guide.comm_per_id, ROUND(ROUND(((tbl_price_guide.price * '$ex_rate' + 0.25) * 2), 0) / 2,-1)

            FROM tbl_price_guide

            JOIN tbl_item ON tbl_item.item_id = tbl_price_guide.item_id

            WHERE tbl_price_guide.curr_id = 1

            AND tbl_item.prod_id = '$prd_id'";
		} else {



			$sql_insert = "INSERT INTO tbl_price_guide (item_id, curr_id, sat_id, comm_per_id, price)

            SELECT tbl_price_guide.item_id, '$curr_id', tbl_price_guide.sat_id, tbl_price_guide.comm_per_id, ROUND(((tbl_price_guide.price * '$ex_rate' + 0.25) * 2), 0) / 2

            FROM tbl_price_guide

            JOIN tbl_item ON tbl_item.item_id = tbl_price_guide.item_id

            WHERE tbl_price_guide.curr_id = 1

            AND tbl_item.prod_id = '$prd_id'";
		}

		Yii::app()->db->createCommand($sql_insert)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionBuildPricesFromUSD()

	{



		$curr_id = $_POST["curr_id"];



		$sql_select = "SELECT * FROM tbl_currency WHERE curr_id='" . $curr_id . "'; ";

		$a_curr = Yii::app()->db->createCommand($sql_select)->queryAll();

		$row_curr = $a_curr[0];

		$ex_rate = floatval($row_curr["exchange_from_usd"]);



		$sql_delete = "DELETE FROM tbl_price_guide WHERE curr_id='" . $curr_id . "'; ";

		Yii::app()->db->createCommand($sql_delete)->execute();



		//$sql_insert = "INSERT INTO tbl_price_guide (item_id,curr_id,sat_id,comm_per_id,price) SELECT item_id,".$curr_id.",sat_id,comm_per_id,ROUND((price*".$ex_rate."),0) FROM tbl_price_guide WHERE curr_id=1;";

		if ($curr_id == 5) {

			$sql_insert = "INSERT INTO tbl_price_guide (item_id,curr_id,sat_id,comm_per_id,price) SELECT item_id," . $curr_id . ",sat_id,comm_per_id,ROUND(ROUND(((tbl_price_guide.price * '$ex_rate' + 0.25) * 2), 0) / 2,-1) FROM tbl_price_guide WHERE curr_id=1;";
		} else {

			$sql_insert = "INSERT INTO tbl_price_guide (item_id,curr_id,sat_id,comm_per_id,price) SELECT item_id," . $curr_id . ",sat_id,comm_per_id,ROUND(((tbl_price_guide.price * '$ex_rate' + 0.25) * 2), 0) / 2 FROM tbl_price_guide WHERE curr_id=1;";
		}



		Yii::app()->db->createCommand($sql_insert)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionupdateOverall()

	{

		$percent_value = $_POST['percent_value'];

		$increase_decrease = $_POST['increase_decrease'];

		$sql_insert = "INSERT INTO `overall_price_change`(`percent_value`, `increase_decrease`) VALUES ('" . $percent_value . "','" . $increase_decrease . "')";

		Yii::app()->db->createCommand($sql_insert)->execute();

		if ($increase_decrease == 1) {

			$sql_update = "UPDATE tbl_price_guide set price = ROUND(price + (price * " . $percent_value . " / 100.0))";

			Yii::app()->db->createCommand($sql_update)->execute();

			$sql_update = "UPDATE tbl_extra set extra_value = ROUND(extra_value + (extra_value * " . $percent_value . " / 100.0))";

			Yii::app()->db->createCommand($sql_update)->execute();
		} else {

			$sql_update = "UPDATE tbl_price_guide set price = ROUND(price - (price * " . $percent_value . " / 100.0))";

			Yii::app()->db->createCommand($sql_update)->execute();

			$sql_update = "UPDATE tbl_extra set extra_value = ROUND(extra_value - (extra_value * " . $percent_value . " / 100.0))";

			Yii::app()->db->createCommand($sql_update)->execute();
		}

		die(json_encode(array('status' => '1')));
	}



	public function actionundoOverall()

	{

		$change_id = $_POST['change_id'];

		$percent_value = $_POST['percent_value'];

		$increase_decrease = $_POST['increase_decrease'];

		if ($increase_decrease == 1) {

			$x = 100 + $percent_value;

			$sql_update = "UPDATE tbl_price_guide set price = ROUND((price * 100.0 / " . $x . "))";

			Yii::app()->db->createCommand($sql_update)->execute();

			$sql_update = "UPDATE tbl_extra set extra_value = ROUND((extra_value * 100.0 / " . $x . "))";

			Yii::app()->db->createCommand($sql_update)->execute();
		} else {

			$x = 100 - $percent_value;

			$sql_update = "UPDATE tbl_price_guide set price = ROUND((price * 100.0 / " . $x . "))";

			Yii::app()->db->createCommand($sql_update)->execute();

			$sql_update = "UPDATE tbl_extra set extra_value = ROUND((extra_value * 100.0 / " . $x . "))";

			Yii::app()->db->createCommand($sql_update)->execute();
		}

		$sql_update = "UPDATE overall_price_change set undo_status = 1 WHERE change_id='$change_id'";

		Yii::app()->db->createCommand($sql_update)->execute();

		die(json_encode(array('status' => '1')));
	}



	public function actionundoOverallProduct()

	{

		$prod_id = $_POST['prod_id'];

		$curr_id = $_POST['curr_id'];

		$sat_id = $_POST['sat_id'];

		$change_id = $_POST['change_id'];

		$percent_value = $_POST['percent_value'];

		$increase_decrease = $_POST['increase_decrease'];

		if ($increase_decrease == 1) {

			$x = 100 + $percent_value;



			$fetch_sql = "SELECT item_id FROM tbl_item WHERE prod_id='" . $prod_id . "'";

			$a_count_data = Yii::app()->db->createCommand($fetch_sql)->queryAll();



			for ($i = 0; $i < sizeof($a_count_data); $i++) {

				//$a_curr_prices[($a_count_data[$i]["curr_id"]).""] = $a_count_data[$i]["num_prices"];

				$item_id = $a_count_data[$i]["item_id"];
				if ($sat_id == 0) {
					$sql_update = "UPDATE tbl_price_guide set price = (price - " . $percent_value . ") WHERE item_id='" . $item_id . "' AND curr_id='" . $curr_id . "'";
				}else {
					$sql_update = "UPDATE tbl_price_guide set price = (price - " . $percent_value . ") WHERE item_id='" . $item_id . "' AND curr_id='" . $curr_id . "' AND sat_id='" . $sat_id . "'";
					
				}
				Yii::app()->db->createCommand($sql_update)->execute();
			}

		} else {

			$x = 100 - $percent_value;



			$fetch_sql = "SELECT item_id FROM tbl_item WHERE prod_id='" . $prod_id . "'";

			$a_count_data = Yii::app()->db->createCommand($fetch_sql)->queryAll();



			for ($i = 0; $i < sizeof($a_count_data); $i++) {

				//$a_curr_prices[($a_count_data[$i]["curr_id"]).""] = $a_count_data[$i]["num_prices"];

				$item_id = $a_count_data[$i]["item_id"];
				if ($sat_id == 0) {
					$sql_update = "UPDATE tbl_price_guide set price = (price + " . $percent_value . ") WHERE item_id='" . $item_id . "' AND curr_id='" . $curr_id . "'";
				}else {
					$sql_update = "UPDATE tbl_price_guide set price = (price + " . $percent_value . ") WHERE item_id='" . $item_id . "' AND curr_id='" . $curr_id . "' AND sat_id='" . $sat_id . "'";
					
				}
				Yii::app()->db->createCommand($sql_update)->execute();
			}

		}

		$sql_update = "UPDATE overall_price_change_product set undo_status = 1 WHERE change_id='$change_id'";

		Yii::app()->db->createCommand($sql_update)->execute();

		die(json_encode(array('status' => '1')));
	}

	public function actionundoOverallExtra()
	{

		$prod_id = $_POST['prod_id'];

		$curr_id = $_POST['curr_id'];

		$change_id = $_POST['change_id'];

		$percent_value = $_POST['percent_value'];

		$increase_decrease = $_POST['increase_decrease'];

		if ($increase_decrease == 1) {
		
			$sql_update = "UPDATE tbl_extra set extra_value = (extra_value - " . $percent_value . ") WHERE prod_id='" . $prod_id . "' AND curr_id='" . $curr_id . "' AND extra_value IS NOT NULL AND extra_value != 0";

			Yii::app()->db->createCommand($sql_update)->execute();
		} else {

			$sql_update = "UPDATE tbl_extra set extra_value = (extra_value + " . $percent_value . ")  WHERE prod_id='" . $prod_id . "' AND curr_id='" . $curr_id . "' AND extra_value IS NOT NULL AND extra_value != 0";

			Yii::app()->db->createCommand($sql_update)->execute();
		}

		$sql_update = "UPDATE overall_price_change_extra set undo_status = 1 WHERE change_id='$change_id'";

		Yii::app()->db->createCommand($sql_update)->execute();

		die(json_encode(array('status' => '1')));
	}


	function roundUpToAnyCurr($price)

	{

		$intVal = intval($price);

		if ($price - $intVal < .25) return (float)$intVal;

		elseif (($price - $intVal > .24) && ($price - $intVal < .75)) return $intVal + 0.50;

		return $intVal + 1.00;
	}



	function roundUpToTHB($price)

	{

		return round($price / 50, 0) * 50;
	}



	public function actionroundOffPrice()

	{

		$curr_id = $_POST['curr_id'];

		$prod_id = $_POST['prod_id'];

		$sql = "SELECT * FROM `tbl_price_guide` JOIN tbl_item ON tbl_item.item_id=tbl_price_guide.item_id WHERE tbl_item.prod_id='" . $prod_id . "' AND tbl_price_guide.curr_id='" . $curr_id . "'";

		$a_count_data = Yii::app()->db->createCommand($sql)->queryAll();

		for ($i = 0; $i < sizeof($a_count_data); $i++) {

			$prg_id = $a_count_data[$i]["prg_id"];

			$price = $a_count_data[$i]["price"];

			if ($curr_id == "5") {

				$new_price = number_format((float)$this->roundUpToTHB($price), 2, '.', '');
			} else {

				$new_price = number_format((float)$this->roundUpToAnyCurr($price), 2, '.', '');
			}

			$up_sql = "UPDATE tbl_price_guide SET price='" . $new_price . "' WHERE prg_id='" . $prg_id . "'";

			Yii::app()->db->createCommand($up_sql)->execute();
		}

		$ins_sql = "INSERT INTO `tbl_round_off`(`curr_id`, `prod_id`) VALUES ('" . $curr_id . "','" . $prod_id . "')";

		if (Yii::app()->db->createCommand($ins_sql)->execute()) {

			die(json_encode(array('status' => '1')));
		} else {

			die(json_encode(array('status' => '0')));
		}
	}



	public function actionupdateOverallProduct()

	{

		$curr_id = $_POST['curr_id'];

		$roles = $_POST['roles'];

		$prod_id = $_POST['prod_id'];

		$percent_value = $_POST['percent_value'];

		$increase_decrease = $_POST['increase_decrease'];

		$sql_insert = "INSERT INTO `overall_price_change_product`(`prod_id`,`curr_id`,`sat_id`,`percent_value`, `increase_decrease`) VALUES ('" . $prod_id . "','" . $curr_id . "','" . $roles . "','" . $percent_value . "','" . $increase_decrease . "')";

		Yii::app()->db->createCommand($sql_insert)->execute();

		if ($increase_decrease == 1) {

			$fetch_sql = "SELECT item_id FROM tbl_item WHERE prod_id='" . $prod_id . "'";

			$a_count_data = Yii::app()->db->createCommand($fetch_sql)->queryAll();



			for ($i = 0; $i < sizeof($a_count_data); $i++) {

				//$a_curr_prices[($a_count_data[$i]["curr_id"]).""] = $a_count_data[$i]["num_prices"];

				$item_id = $a_count_data[$i]["item_id"];

				if ($roles == 0) {
					$sql_update = "UPDATE tbl_price_guide SET price = (price + " . $percent_value . ") WHERE item_id='" . $item_id . "' AND curr_id='" . $curr_id . "'";
				}else{
					$sql_update = "UPDATE tbl_price_guide SET price = (price + " . $percent_value . ") WHERE item_id='" . $item_id . "' AND curr_id='" . $curr_id . "' AND sat_id='" . $roles . "'";

				}

				Yii::app()->db->createCommand($sql_update)->execute();
			}



			// $sql_update = "UPDATE tbl_extra SET extra_value = ROUND(extra_value + " . $percent_value . ") WHERE prod_id='" . $prod_id . "' AND curr_id='" . $curr_id . "'";

			// Yii::app()->db->createCommand($sql_update)->execute();
		} else {



			$fetch_sql = "SELECT item_id FROM tbl_item WHERE prod_id='" . $prod_id . "'";

			$a_count_data = Yii::app()->db->createCommand($fetch_sql)->queryAll();



			for ($i = 0; $i < sizeof($a_count_data); $i++) {

				//$a_curr_prices[($a_count_data[$i]["curr_id"]).""] = $a_count_data[$i]["num_prices"];

				$item_id = $a_count_data[$i]["item_id"];
				if ($roles == 0) {
					$sql_update = "UPDATE tbl_price_guide set price = (price - " . $percent_value . ") WHERE item_id='" . $item_id . "' AND curr_id='" . $curr_id . "'";
				}else{
					$sql_update = "UPDATE tbl_price_guide set price = (price - " . $percent_value . ") WHERE item_id='" . $item_id . "' AND curr_id='" . $curr_id . "' AND sat_id='" . $roles . "'";

				}

				Yii::app()->db->createCommand($sql_update)->execute();
			}



			// $sql_update = "UPDATE tbl_extra set extra_value = ROUND(extra_value - " . $percent_value . ") WHERE prod_id='" . $prod_id . "' AND curr_id='" . $curr_id . "'";

			// Yii::app()->db->createCommand($sql_update)->execute();
		}

		die(json_encode(array('status' => '1')));
	}

	public function actionupdateOverallextra()

	{

		$curr_id = $_POST['curr_id'];

		$prod_id = $_POST['prod_id'];

		$percent_value = $_POST['percent_value'];

		$increase_decrease = $_POST['increase_decrease'];

		$sql_insert = "INSERT INTO `overall_price_change_extra`(`prod_id`,`curr_id`,`percent_value`, `increase_decrease`) VALUES ('" . $prod_id . "','" . $curr_id . "','" . $percent_value . "','" . $increase_decrease . "')";

		Yii::app()->db->createCommand($sql_insert)->execute();

		if ($increase_decrease == 1) {
			$sql_update = "UPDATE tbl_extra SET extra_value = (extra_value + " . $percent_value . ") WHERE prod_id='" . $prod_id . "' AND curr_id='" . $curr_id . "' AND extra_value IS NOT NULL AND extra_value != 0";

			Yii::app()->db->createCommand($sql_update)->execute();
		} else {

			$sql_update = "UPDATE tbl_extra set extra_value = (extra_value - " . $percent_value . ") WHERE prod_id='" . $prod_id . "' AND curr_id='" . $curr_id . "' AND extra_value IS NOT NULL AND extra_value != 0";

			Yii::app()->db->createCommand($sql_update)->execute();
		}

		die(json_encode(array('status' => '1')));
	}

	public function actionAdminPanelShowSaleType()

	{



		$sql = "SELECT * FROM tbl_sale_type ORDER BY sort ASC; ";

		$result['a_sat'] = Yii::app()->db->createCommand($sql)->queryAll();



		echo $this->renderPartial('admin_show_sale_type', $result);
	}



	public function actionfetchIncreaseDecreasePercentage()

	{

		$sql = "SELECT * FROM overall_price_change ORDER BY change_timestamp DESC; ";

		$result['a_sat'] = Yii::app()->db->createCommand($sql)->queryAll();



		echo $this->renderPartial('admin_show_change_price', $result);
	}



	public function actionfetchRoundOffChange()

	{

		$sql = "SELECT * FROM tbl_round_off JOIN tbl_product ON tbl_product.prod_id=tbl_round_off.prod_id JOIN tbl_currency ON tbl_currency.curr_id=tbl_round_off.curr_id  ORDER BY create_timestamp DESC; ";

		$result['a_sat'] = Yii::app()->db->createCommand($sql)->queryAll();



		echo $this->renderPartial('admin_show_round_off', $result);
	}



	public function actionfetchIncreaseDecreasePercentageProduct()

	{

		$sql = "SELECT * FROM overall_price_change_product JOIN tbl_product ON tbl_product.prod_id=overall_price_change_product.prod_id JOIN tbl_currency ON tbl_currency.curr_id=overall_price_change_product.curr_id  ORDER BY change_timestamp DESC; ";

		$result['a_sat'] = Yii::app()->db->createCommand($sql)->queryAll();



		echo $this->renderPartial('admin_show_change_price_product', $result);
	}

	public function actionfetchIncreaseDecreaseExtra()

	{

		$sql = "SELECT * FROM overall_price_change_extra JOIN tbl_product ON tbl_product.prod_id=overall_price_change_extra.prod_id JOIN tbl_currency ON tbl_currency.curr_id=overall_price_change_extra.curr_id  ORDER BY change_timestamp DESC; ";

		$result['a_sat'] = Yii::app()->db->createCommand($sql)->queryAll();



		echo $this->renderPartial('admin_show_change_price_extra', $result);
	}



	public function actionAdminSwapSaleType()

	{



		$own_id = $_POST["own_id"];

		$swap_id = $_POST["swap_id"];



		$sql = "SELECT sort FROM tbl_sale_type WHERE sat_id='" . $own_id . "'; ";

		$a_own = Yii::app()->db->createCommand($sql)->queryAll();

		$own_sort = $a_own[0]["sort"];



		$sql2 = "SELECT sort FROM tbl_sale_type WHERE sat_id='" . $swap_id . "'; ";

		$a_swap = Yii::app()->db->createCommand($sql2)->queryAll();

		$swap_sort = $a_swap[0]["sort"];



		$sql_update = "UPDATE tbl_sale_type SET sort='" . $swap_sort . "' WHERE sat_id='" . $own_id . "'; ";

		Yii::app()->db->createCommand($sql_update)->execute();



		$sql_update2 = "UPDATE tbl_sale_type SET sort='" . $own_sort . "' WHERE sat_id='" . $swap_id . "'; ";

		Yii::app()->db->createCommand($sql_update2)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionSubmitAdminAddSaleType()

	{



		$sql = "SELECT MAX(sort) AS max_sort FROM tbl_sale_type; ";

		$a_max_sort = Yii::app()->db->createCommand($sql)->queryAll();

		$max_sort = $a_max_sort[0]["max_sort"];



		$new_sort = intval($max_sort) + 1;



		$sat_name = addslashes($_POST["new_sat_name"]);



		$sql_insert = "INSERT INTO tbl_sale_type (sat_name,sort) VALUES ('" . $sat_name . "','" . $new_sort . "'); ";

		Yii::app()->db->createCommand($sql_insert)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionSubmitAdminEditSaleType()

	{



		$sat_id = $_POST["edit_sat_id"];

		$sat_name = addslashes($_POST["edit_sat_name"]);

		$sat_enable = $_POST["edit_sat_enable"];



		$sql_update = "UPDATE tbl_sale_type SET sat_name='" . $sat_name . "',enable='" . $sat_enable . "' WHERE sat_id='" . $sat_id . "'; ";

		Yii::app()->db->createCommand($sql_update)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionGetSaleTypeInfo()

	{



		$sat_id = $_POST["sat_id"];



		$sql = "SELECT * FROM tbl_sale_type WHERE sat_id='" . $sat_id . "'; ";

		$a_sat = Yii::app()->db->createCommand($sql)->queryAll();



		$a_return = array();



		if (sizeof($a_sat) == 0) {

			$a_return["result"] = "fail";

			$a_return["msg"] = "Not found data.";
		} else {



			$a_return = $a_sat[0];

			$a_return["result"] = "success";
		}



		echo json_encode($a_return);
	}



	public function actionAdminPanelShowCommission()

	{



		$sat_id = $_POST["sat_id"];



		$sql = "SELECT * FROM tbl_comm_percent WHERE sat_id='" . $sat_id . "' ORDER BY sort ASC; ";

		$result['a_comm_info'] = Yii::app()->db->createCommand($sql)->queryAll();



		echo $this->renderPartial('admin_show_comm_info', $result);
	}



	public function actionGetCommissionInfo()

	{



		$comm_per_id = $_POST["comm_per_id"];



		$sql = "SELECT * FROM tbl_comm_percent WHERE comm_per_id='" . $comm_per_id . "'; ";

		$a_comm = Yii::app()->db->createCommand($sql)->queryAll();



		$a_return = array();



		if (sizeof($a_comm) == 0) {

			$a_return["result"] = "fail";

			$a_return["msg"] = "Not found data.";
		} else {



			$a_return = $a_comm[0];

			$a_return["result"] = "success";
		}



		echo json_encode($a_return);
	}



	public function actionSubmitAdminEditCommission()

	{



		$comm_per_id = $_POST["edit_comm_per_id"];

		$qty_name = addslashes($_POST["edit_qty_name"]);

		$comm_value = $_POST["edit_comm_value"];

		$comm_enable = $_POST["edit_comm_enable"];



		$sql_update = "UPDATE tbl_comm_percent SET qty_name='" . $qty_name . "',comm_value='" . $comm_value . "',enable='" . $comm_enable . "' WHERE comm_per_id='" . $comm_per_id . "'; ";

		Yii::app()->db->createCommand($sql_update)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionAdminSwapCommission()

	{



		$comm_per_id = $_POST["comm_per_id"];

		$sat_id = $_POST["sat_id"];

		$direction = $_POST["direction"];



		$a_result = array();



		$sql = "SELECT sort FROM tbl_comm_percent WHERE comm_per_id='" . $comm_per_id . "'; ";

		$a_own = Yii::app()->db->createCommand($sql)->queryAll();

		$own_sort = intval($a_own[0]["sort"]);

		$effect_sort = 0;

		if ($direction == "left") {

			$effect_sort = $own_sort - 1;
		} else if ($direction == "right") {

			$effect_sort = $own_sort + 1;
		} else {

			$a_result["result"] = "fail";

			$a_result["msg"] = "Error: Invalid parameter code 1.";

			echo json_encode($a_result);

			exit();
		}



		$sql2 = "SELECT comm_per_id FROM tbl_comm_percent WHERE sat_id='" . $sat_id . "' AND sort='" . $effect_sort . "'; ";

		$a_swap_id = Yii::app()->db->createCommand($sql2)->queryAll();

		if (sizeof($a_swap_id) != 1) {

			$a_result["result"] = "fail";

			$a_result["msg"] = "Error: There is something wrong in sort data.\nPlease contact Programmer to check it.";

			echo json_encode($a_result);

			exit();
		}

		$swap_id = $a_swap_id[0]["comm_per_id"];



		$sql_update = "UPDATE tbl_comm_percent SET sort='" . $effect_sort . "' WHERE comm_per_id='" . $comm_per_id . "'; ";

		Yii::app()->db->createCommand($sql_update)->execute();



		$sql_update2 = "UPDATE tbl_comm_percent SET sort='" . $own_sort . "' WHERE comm_per_id='" . $swap_id . "'; ";

		Yii::app()->db->createCommand($sql_update2)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionSubmitAdminAddCommission()

	{



		$sat_id = $_POST["new_comm_sat_id"];



		$sql = "SELECT MAX(sort) AS max_sort FROM tbl_comm_percent WHERE sat_id='" . $sat_id . "'; ";

		$a_max_sort = Yii::app()->db->createCommand($sql)->queryAll();

		$max_sort = $a_max_sort[0]["max_sort"];



		$new_sort = intval($max_sort) + 1;



		$qty_name = addslashes($_POST["new_qty_name"]);

		$comm_value = $_POST["new_comm_value"];





		$sql_insert = "INSERT INTO tbl_comm_percent (sat_id,qty_name,comm_value,sort,date_add) VALUES ('" . $sat_id . "','" . $qty_name . "','" . $comm_value . "','" . $new_sort . "','" . date("Y-m-d H:i:s") . "'); ";

		Yii::app()->db->createCommand($sql_insert)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionAdminSubmitEditPrice()

	{



		$prg_id = $_POST["prg_id"];

		$price = $_POST["price"];



		$sql_update = "UPDATE tbl_price_guide SET price='" . $price . "' WHERE prg_id='" . $prg_id . "'; ";

		if (Yii::app()->db->createCommand($sql_update)->execute()) {

			echo json_encode(array("result" => "success"));
		} else {

			echo json_encode(array("result" => "fail", "msg" => "Error: Cannot update Price"));
		}
	}



	public function actionAdminSubmitAddPrice()

	{



		$item_id = $_POST["item_id"];

		$curr_id = $_POST["curr_id"];

		$sat_id = $_POST["sat_id"];

		$comm_per_id = $_POST["comm_per_id"];



		$price = $_POST["price"];



		$sql_insert = "INSERT INTO tbl_price_guide (item_id,curr_id,sat_id,comm_per_id,price) VALUES ('" . $item_id . "','" . $curr_id . "','" . $sat_id . "','" . $comm_per_id . "','" . $price . "'); ";

		if (Yii::app()->db->createCommand($sql_insert)->execute()) {



			$prg_id = Yii::app()->db->getLastInsertID();

			echo json_encode(array("result" => "success", "prg_id" => $prg_id));
		} else {

			echo json_encode(array("result" => "fail", "msg" => "Error: Cannot add Price"));
		}
	}



	public function actionAdminDeletePrice()

	{



		$prg_id = $_POST["prg_id"];



		$sql_delete = "DELETE FROM tbl_price_guide WHERE prg_id='" . $prg_id . "'; ";

		if (Yii::app()->db->createCommand($sql_delete)->execute()) {



			echo json_encode(array("result" => "success"));
		} else {

			echo json_encode(array("result" => "fail", "msg" => "Error: Cannot delete Price"));
		}
	}



	public function actionShowItemList()

	{



		$prod_id = $_POST["prod_id"];

		$item_group_id = $_POST["group_id"];

		$have_group = $_POST["have_group"];



		$sql_select = "SELECT * FROM tbl_item ";

		if ($have_group == "1" && $item_group_id != "==no_group==") {

			$sql_select .= " LEFT JOIN tbl_item_group ON tbl_item.group_id=tbl_item_group.item_group_id ";
		}

		$sql_select .= " WHERE tbl_item.prod_id='" . $prod_id . "' AND tbl_item.enable=1 ";

		if ($item_group_id == "==no_group==") {

			$sql_select .= " AND tbl_item.group_id IS NULL ";
		} else if ($item_group_id != "==all==") {

			$sql_select .= " AND tbl_item.group_id='" . $item_group_id . "' ";
		}

		$sql_select .= " ORDER BY ";

		if ($have_group == "1" && $item_group_id != "==no_group==") {

			$sql_select .= " tbl_item_group.sort ASC, ";
		}

		$sql_select .= " tbl_item.sort ASC; ";



		/*$return["inner_content"] = $sql_select;

		echo json_encode($return);

		exit();*/



		$result["a_item"] = Yii::app()->db->createCommand($sql_select)->queryAll();



		if ($have_group == "1" && $item_group_id != "==no_group==") {

			$sql_group = "SELECT * FROM tbl_item_group WHERE prod_id='" . $prod_id . "' ";

			if ($item_group_id != "==all==") {

				$sql_group .= " AND item_group_id='" . $item_group_id . "' ";
			} else {

				$sql_group .= " ORDER BY sort ASC ";
			}

			$result["a_group"] = Yii::app()->db->createCommand($sql_group)->queryAll();
		}



		$result["have_group"] = $have_group;



		if (sizeof($result["a_item"]) > 0) {



			$result["item_group_id"] = $item_group_id;

			$return["inner_content"] = $this->renderPartial('manage_item/show', $result, true);
		} else {

			$return["inner_content"] = '<h4 style="width:100%; text-align:center; color:#F55;">Not found.</h4>';
		}



		$return["num_show_item"] = sizeof($result["a_item"]);



		echo json_encode($return);
	}



	public function actionShowItemListUser()

	{



		$prod_id = $_POST["prod_id"];

		$item_group_id = $_POST["group_id"];

		$have_group = $_POST["have_group"];

		$user_id = Yii::app()->user->getState('userKey');

		$sql_select = "SELECT *,t1.item_id as main_id FROM tbl_item AS t1 LEFT JOIN (SELECT * FROM tbl_lib_item

            WHERE user_id='" . $user_id . "') AS t2 ON (t1.`item_id` = t2.`item_id`)";

		if ($have_group == "1" && $item_group_id != "==no_group==") {

			$sql_select .= " LEFT JOIN tbl_item_group ON t1.group_id=tbl_item_group.item_group_id ";
		}

		$sql_select .= " WHERE t1.prod_id='" . $prod_id . "' AND t1.enable=1 ";

		if ($item_group_id == "==no_group==") {

			$sql_select .= " AND t1.group_id IS NULL ";
		} else if ($item_group_id != "==all==") {

			$sql_select .= " AND t1.group_id='" . $item_group_id . "' ";
		}

		$sql_select .= " ORDER BY ";

		if ($have_group == "1" && $item_group_id != "==no_group==") {

			$sql_select .= " tbl_item_group.sort ASC, ";
		}

		$sql_select .= " t1.sort ASC; ";



		/*$return["inner_content"] = $sql_select;

		echo json_encode($return);

		exit();*/



		$result["a_item"] = Yii::app()->db->createCommand($sql_select)->queryAll();



		if ($have_group == "1" && $item_group_id != "==no_group==") {

			$sql_group = "SELECT * FROM tbl_item_group WHERE prod_id='" . $prod_id . "' ";

			if ($item_group_id != "==all==") {

				$sql_group .= " AND item_group_id='" . $item_group_id . "' ";
			} else {

				$sql_group .= " ORDER BY sort ASC ";
			}

			$result["a_group"] = Yii::app()->db->createCommand($sql_group)->queryAll();
		}



		$result["have_group"] = $have_group;



		if (sizeof($result["a_item"]) > 0) {



			$result["item_group_id"] = $item_group_id;

			$return["inner_content"] = $this->renderPartial('manage_item/showUser', $result, true);
		} else {

			$return["inner_content"] = '<h4 style="width:100%; text-align:center; color:#F55;">Not found.</h4>';
		}



		$return["num_show_item"] = sizeof($result["a_item"]);



		echo json_encode($return);
	}



	public function actionDeleteProductItem()

	{



		$item_id = $_POST["item_id"];



		$sql_update = "UPDATE tbl_item SET enable=0 WHERE item_id='" . $item_id . "'; ";

		if (Yii::app()->db->createCommand($sql_update)->execute()) {

			echo json_encode(array("result" => "success"));
		} else {

			echo json_encode(array("result" => "fail", "msg" => "Error: Cannot delete Item"));
		}
	}



	public function actioneditProductItemFormUser()

	{

		$item_id = $_POST["item_id"];

		$user_id = Yii::app()->user->getState('userKey');

		$sql_select = "SELECT *,t1.item_id as main_id FROM tbl_item AS t1 LEFT  JOIN (SELECT * FROM tbl_lib_item

            WHERE user_id='" . $user_id . "') AS t2 ON (t1.`item_id` = t2.`item_id`) WHERE t1.item_id='" . $item_id . "'; ";



		$a_item = Yii::app()->db->createCommand($sql_select)->queryAll();

		$prod_id = $a_item[0]["prod_id"];

		$result["a_item"] = $a_item[0];



		$sql_group = "SELECT * FROM tbl_item_group WHERE prod_id='" . $prod_id . "' ORDER BY sort ASC";

		$result["a_group"] = Yii::app()->db->createCommand($sql_group)->queryAll();



		$this->renderPartial('manage_item/edit_form_user', $result);
	}



	public function actionEditProductItemForm()

	{



		$item_id = $_POST["item_id"];



		$sql_select = "SELECT * FROM tbl_item WHERE item_id='" . $item_id . "'; ";



		$a_item = Yii::app()->db->createCommand($sql_select)->queryAll();

		$prod_id = $a_item[0]["prod_id"];

		$result["a_item"] = $a_item[0];



		$sql_group = "SELECT * FROM tbl_item_group WHERE prod_id='" . $prod_id . "' ORDER BY sort ASC";

		$result["a_group"] = Yii::app()->db->createCommand($sql_group)->queryAll();



		$this->renderPartial('manage_item/edit_form', $result);
	}



	public function actionEditProductItemSubmitUser()

	{

		$item_id = $_POST["edit_item_id"];

		$description = addslashes($_POST['main_desc']);

		$user_id = Yii::app()->user->getState('userKey');

		$sql = "SELECT COUNT(*) as total FROM tbl_lib_item WHERE user_id='$user_id' AND item_id='$item_id'";

		$row_fetch_all = Yii::app()->db->createCommand($sql)->queryAll();

		if ($row_fetch_all[0]['total'] == 1) {

			$sql_update = "UPDATE tbl_lib_item SET description='" . addslashes($description) . "' WHERE item_id='" . $item_id . "' AND user_id='$user_id'";

			if (Yii::app()->db->createCommand($sql_update)->execute()) {

				echo json_encode(array("result" => "success"));
			} else {

				echo json_encode(array("result" => "fail", "msg" => "Error: Cannot update Item.\nPlease careful about using special characters."));
			}
		} else {

			$insert_sql = "INSERT INTO tbl_lib_item(item_id,user_id,description) VALUES('" . $item_id . "','" . $user_id . "','" . addslashes($description) . "')";

			if (Yii::app()->db->createCommand($insert_sql)->execute()) {

				echo json_encode(array("result" => "success"));
			} else {

				echo json_encode(array("result" => "fail", "msg" => "Error: Cannot update Item.\nPlease careful about using special characters."));
			}
		}
	}



// 	public function actionEditProductItemSubmit()

// 	{



// 		$item_id = $_POST["edit_item_id"];

// 		$item_name = $_POST["edit_item_name"];



// 		$item_detail = $_POST["edit_item_detail"];

// 		$item_style = $_POST["edit_item_style"];

// 		$item_fabric_opt = $_POST["edit_item_fabric_opt"];



// 		$sql_update = "UPDATE tbl_item SET item_name='" . addslashes($item_name) . "',item_detail='" . addslashes($item_detail) . "',item_style='" . addslashes($item_style) . "',item_fabric_opt='" . addslashes($item_fabric_opt) . "'";



// 		$group_info = addslashes($_POST["edit_item_group"]);

// 		$old_group_id = $_POST["old_group_id"];

// 		$old_sort = $_POST["old_sort"];

// 		$b_no_update = true;

// 		$group_id = "";

// 		$group_name = "";



// 		if ($group_info == "==no_group==") {



// 			if ($old_group_id != "==no_group==") {

// 				$b_no_update = false;

// 				$sql_update .= ",group_name=NULL,group_id=NULL";
// 			}
// 		} else {



// 			$tmp_ginfo = explode("#&#", $group_info);

// 			$group_id = $tmp_ginfo[0];

// 			$group_name = $tmp_ginfo[1];



// 			if ($old_group_id != $group_id) {

// 				$b_no_update = false;

// 				$sql_update .= ",group_name='" . addslashes($group_name) . "',group_id='" . $group_id . "'";
// 			}
// 		}



// 		if (!$b_no_update) {



// 			$prod_id = $_POST["edit_prod_id"];



// 			if ($group_info == "==no_group==") {



// 				$sql_select_max = "SELECT MAX(sort) AS max_sort FROM tbl_item WHERE group_id IS NULL AND prod_id='" . $prod_id . "'; ";

// 				$a_max = Yii::app()->db->createCommand($sql_select_max)->queryAll();

// 				$max_sort = $a_max[0]["max_sort"];



// 				$new_sort = intval($max_sort) + 1;



// 				$sql_update .= ",sort='" . $new_sort . "'";



// 				$sql_update_old_group = "UPDATE tbl_item SET sort=sort-1 WHERE group_id='" . $old_group_id . "' AND prod_id='" . $prod_id . "' AND sort>'" . $old_sort . "'; ";

// 				Yii::app()->db->createCommand($sql_update_old_group)->execute();
// 			} else {



// 				$sql_select_max = "SELECT MAX(sort) AS max_sort FROM tbl_item WHERE group_id='" . $group_id . "' AND prod_id='" . $prod_id . "'; ";

// 				$a_max = Yii::app()->db->createCommand($sql_select_max)->queryAll();

// 				$max_sort = $a_max[0]["max_sort"];



// 				$new_sort = intval($max_sort) + 1;



// 				$sql_update .= ",sort='" . $new_sort . "'";



// 				if ($old_group_id == "==no_group==") {

// 					$sql_update_old_group = "UPDATE tbl_item SET sort=sort-1 WHERE group_id IS NULL AND prod_id='" . $prod_id . "' AND sort>'" . $old_sort . "'; ";
// 				} else {

// 					$sql_update_old_group = "UPDATE tbl_item SET sort=sort-1 WHERE group_id='" . $old_group_id . "' AND prod_id='" . $prod_id . "' AND sort>'" . $old_sort . "'; ";
// 				}



// 				Yii::app()->db->createCommand($sql_update_old_group)->execute();
// 			}
// 		}



// 		$sql_update .= " WHERE item_id='" . $item_id . "';";
        
//         echo $sql_update;

// 		if (Yii::app()->db->createCommand($sql_update)->execute()) {

// 			echo json_encode(array("result" => "success"));
// 		} else {

// 			echo json_encode(array("result" => "fail", "msg" => "Error: Cannot update Item.\nPlease careful about using special characters."));
// 		}
// 	}

public function actionEditProductItemSubmit()
{
    $item_id = $_POST["edit_item_id"];
    $item_name = $_POST["edit_item_name"];
    $item_detail = $_POST["edit_item_detail"];
    $item_style = $_POST["edit_item_style"];
    $item_fabric_opt = $_POST["edit_item_fabric_opt"];
    $group_info = $_POST["edit_item_group"];
    $old_group_id = $_POST["old_group_id"];
    $old_sort = $_POST["old_sort"];
    $prod_id = $_POST["edit_prod_id"];

    $sql_update = "UPDATE tbl_item SET 
        item_name = :item_name,
        item_detail = :item_detail,
        item_style = :item_style,
        item_fabric_opt = :item_fabric_opt";

    $params = array(
        ':item_name' => $item_name,
        ':item_detail' => $item_detail,
        ':item_style' => $item_style,
        ':item_fabric_opt' => $item_fabric_opt,
        ':item_id' => $item_id
    );

    $b_no_update = true;
    $group_id = "";
    $group_name = "";

    if ($group_info == "==no_group==") {
        if ($old_group_id != "==no_group==") {
            $b_no_update = false;
            $sql_update .= ", group_name = NULL, group_id = NULL";
        }
    } else {
        $tmp_ginfo = explode("#&#", $group_info);
        $group_id = $tmp_ginfo[0];
        $group_name = $tmp_ginfo[1];

        if ($old_group_id != $group_id) {
            $b_no_update = false;
            $sql_update .= ", group_name = :group_name, group_id = :group_id";
            $params[':group_name'] = $group_name;
            $params[':group_id'] = $group_id;
        }
    }

    if (!$b_no_update) {
        if ($group_info == "==no_group==") {
            $sql_select_max = "SELECT MAX(sort) AS max_sort FROM tbl_item WHERE group_id IS NULL AND prod_id = :prod_id";
            $a_max = Yii::app()->db->createCommand($sql_select_max)->bindParam(":prod_id", $prod_id)->queryAll();
            $max_sort = $a_max[0]["max_sort"];
            $new_sort = intval($max_sort) + 1;
            $sql_update .= ", sort = :new_sort";
            $params[':new_sort'] = $new_sort;

            $sql_update_old_group = "UPDATE tbl_item SET sort = sort - 1 WHERE group_id IS NULL AND prod_id = :prod_id AND sort > :old_sort";
            Yii::app()->db->createCommand($sql_update_old_group)
                ->bindParam(":prod_id", $prod_id)
                ->bindParam(":old_sort", $old_sort)
                ->execute();
        } else {
            $sql_select_max = "SELECT MAX(sort) AS max_sort FROM tbl_item WHERE group_id = :group_id AND prod_id = :prod_id";
            $cmd = Yii::app()->db->createCommand($sql_select_max);
            $cmd->bindParam(":group_id", $group_id);
            $cmd->bindParam(":prod_id", $prod_id);
            $a_max = $cmd->queryAll();

            $max_sort = $a_max[0]["max_sort"];
            $new_sort = intval($max_sort) + 1;
            $sql_update .= ", sort = :new_sort";
            $params[':new_sort'] = $new_sort;

            if ($old_group_id == "==no_group==") {
                $sql_update_old_group = "UPDATE tbl_item SET sort = sort - 1 WHERE group_id IS NULL AND prod_id = :prod_id AND sort > :old_sort";
            } else {
                $sql_update_old_group = "UPDATE tbl_item SET sort = sort - 1 WHERE group_id = :old_group_id AND prod_id = :prod_id AND sort > :old_sort";
            }

            $cmd = Yii::app()->db->createCommand($sql_update_old_group);
            $cmd->bindParam(":prod_id", $prod_id);
            $cmd->bindParam(":old_sort", $old_sort);
            if ($old_group_id != "==no_group==") {
                $cmd->bindParam(":old_group_id", $old_group_id);
            }
            $cmd->execute();
        }
    }

    $sql_update .= " WHERE item_id = :item_id";

    $command = Yii::app()->db->createCommand($sql_update);

    if ($command->execute($params)) {
        echo json_encode(array("result" => "success"));
    } else {
        echo json_encode(array("result" => "fail", "msg" => "Error: Cannot update Item.\nPlease careful about using special characters."));
    }
}




	public function actionSortingItemView()

	{



		$prod_id = $_POST["prod_id"];

		$group_id = $_POST["group_id"];



		$sql_select = "SELECT * FROM tbl_item WHERE prod_id='" . $prod_id . "' AND enable=1 ";

		if ($group_id == "==no_group==") {

			$sql_select .= " AND group_id IS NULL ";
		} else {

			$sql_select .= " AND group_id='" . $group_id . "' ";
		}

		$sql_select .= " ORDER BY sort ASC; ";



		$result["a_item"] = Yii::app()->db->createCommand($sql_select)->queryAll();

		$result["prod_id"] = $prod_id;

		$result["group_id"] = $group_id;



		$this->renderPartial('manage_item/sorting_form', $result);
	}



	public function actionSortingItemSubmit()

	{



		$a_sort_item_id = $_POST["sort_item_id"];

		$sql_update = "";



		for ($i = 0; $i < sizeof($a_sort_item_id); $i++) {



			$sql_update .= "UPDATE tbl_item SET sort=" . ($i + 1) . " WHERE item_id='" . $a_sort_item_id[$i] . "'; ";
		}



		Yii::app()->db->createCommand($sql_update)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionNewProductItemForm()

	{



		$prod_id = $_POST["prod_id"];



		$sql_group = "SELECT * FROM tbl_item_group WHERE prod_id='" . $prod_id . "' ORDER BY sort ASC ";

		$result["a_group"] = Yii::app()->db->createCommand($sql_group)->queryAll();



		$result["prod_id"] = $prod_id;



		$this->renderPartial('manage_item/new_form', $result);
	}



	public function actionNewProductItemSubmit()

	{



		$prod_id = $_POST["new_prod_id"];

		$group_info = addslashes($_POST["new_item_group"]);



		$group_id = "";

		$group_name = "";



		$sql_select_max = "SELECT MAX(sort) AS max_sort FROM tbl_item WHERE prod_id='" . $prod_id . "' ";

		if ($group_info == "==no_group==") {

			$sql_select_max .= " AND group_id IS NULL ";
		} else {



			$tmp_ginfo = explode("#&#", $group_info);

			$group_id = $tmp_ginfo[0];

			$group_name = $tmp_ginfo[1];



			$sql_select_max .= " AND group_id='" . $group_id . "' ";
		}

		$a_max = Yii::app()->db->createCommand($sql_select_max)->queryAll();

		$new_sort = intval($a_max[0]["max_sort"]) + 1;



		$item_name = addslashes($_POST["new_item_name"]);



		$item_detail = addslashes($_POST["new_item_detail"]);

		$item_style = addslashes($_POST["new_item_style"]);

		$item_fabric_opt = addslashes($_POST["new_item_fabric_opt"]);



		$sql_insert = "INSERT INTO tbl_item (item_name,item_style,item_detail,item_fabric_opt,group_name,group_id,prod_id,sort,date_add) VALUES (";

		$sql_insert .= "'" . addslashes($item_name) . "','" . addslashes($item_style) . "','" . addslashes($item_detail) . "','" . addslashes($item_fabric_opt) . "'";

		if ($group_info == "==no_group==") {

			$sql_insert .= ",NULL,NULL";
		} else {

			$sql_insert .= ",'" . $group_name . "','" . $group_id . "'";
		}

		$sql_insert .= ",'" . $prod_id . "','" . $new_sort . "','" . date("Y-m-d H:i:s") . "'";

		$sql_insert .= ");";



		if (Yii::app()->db->createCommand($sql_insert)->execute()) {

			echo json_encode(array("result" => "success"));
		} else {

			echo json_encode(array("result" => "fail", "msg" => "Error: Cannot add new Item"));
		}
	}



	public function actionShowGroupList()

	{



		$prod_id = $_POST["prod_id"];



		$sql_select = "SELECT tbl_item_group.*,SUM(tbl_item.enable) AS num_item FROM tbl_item_group ";

		$sql_select .= " LEFT JOIN tbl_item ON tbl_item_group.item_group_id=tbl_item.group_id ";

		$sql_select .= " WHERE tbl_item_group.prod_id='" . $prod_id . "' ";

		$sql_select .= " GROUP BY tbl_item_group.item_group_id ORDER BY tbl_item_group.sort ASC; ";



		$result["a_group"] = Yii::app()->db->createCommand($sql_select)->queryAll();

		$result["prod_id"] = $prod_id;



		//echo $sql_select;





		$this->renderPartial('manage_item/group_show', $result);
	}



	public function actionUpdateGroupName()

	{



		$item_group_id = $_POST["item_group_id"];

		$group_name = base64_decode($_POST["group_name"]);



		$sql_update = "UPDATE tbl_item_group SET group_name='" . addslashes($group_name) . "' WHERE item_group_id='" . $item_group_id . "'; ";



		if (Yii::app()->db->createCommand($sql_update)->execute()) {



			$sql_update2 = "UPDATE tbl_item SET group_name='" . addslashes($group_name) . "' WHERE group_id='" . $item_group_id . "';";

			Yii::app()->db->createCommand($sql_update2)->execute();



			echo json_encode(array("result" => "success"));
		} else {

			echo json_encode(array("result" => "fail", "msg" => "Error: Cannot update Group name"));
		}
	}



	public function actionNewGroupName()

	{



		$prod_id = $_POST["prod_id"];

		$group_name = base64_decode($_POST["group_name"]);



		$sql_select_max = "SELECT MAX(sort) AS max_sort FROM tbl_item_group WHERE prod_id='" . $prod_id . "' ";

		$a_max = Yii::app()->db->createCommand($sql_select_max)->queryAll();



		$new_sort = 1;

		if (sizeof($a_max) > 0) {

			$new_sort = intval($a_max[0]["max_sort"]) + 1;
		}



		$sql_insert = "INSERT INTO tbl_item_group (group_name,prod_id,sort,date_add) VALUES ('" . addslashes($group_name) . "','" . $prod_id . "','" . $new_sort . "','" . date("Y-m-d H:i:s") . "'); ";



		if (Yii::app()->db->createCommand($sql_insert)->execute()) {



			$item_group_id = Yii::app()->db->getLastInsertID();



			echo json_encode(array("result" => "success", "item_group_id" => $item_group_id));
		} else {

			echo json_encode(array("result" => "fail", "msg" => "Error: Cannot New Group"));
		}
	}



	public function actionDeleteItemGroup()

	{



		$item_group_id = $_POST["item_group_id"];



		$sql_delete = "DELETE FROM tbl_item_group WHERE item_group_id='" . $item_group_id . "';";



		if (Yii::app()->db->createCommand($sql_delete)->execute()) {

			echo json_encode(array("result" => "success"));
		} else {

			echo json_encode(array("result" => "fail", "msg" => "Error: Cannot Delete Group"));
		}
	}



	public function actionSortingGroupView()

	{



		$prod_id = $_POST["prod_id"];



		$sql_select = "SELECT * FROM tbl_item_group WHERE prod_id='" . $prod_id . "' ";

		$sql_select .= " ORDER BY sort ASC; ";



		$result["a_group"] = Yii::app()->db->createCommand($sql_select)->queryAll();

		$result["prod_id"] = $prod_id;



		$this->renderPartial('manage_item/group_sorting_form', $result);
	}



	public function actionSortingGroupSubmit()

	{



		$a_sort_group_id = $_POST["sort_item_group_id"];

		$sql_update = "";



		for ($i = 0; $i < sizeof($a_sort_group_id); $i++) {



			$sql_update .= "UPDATE tbl_item_group SET sort=" . ($i + 1) . " WHERE item_group_id='" . $a_sort_group_id[$i] . "'; ";
		}



		Yii::app()->db->createCommand($sql_update)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionNewExtraSubmit()

	{		

		$extra_name = $_POST["new_extra_name"];

		$extra_desc = $_POST["new_extra_desc"];

		$extra_value = $_POST["new_extra_value"];

		$extra_value_1 = $_POST["new_extra_value_1"];

		$extra_value_2 = $_POST["new_extra_value_2"];

		$extra_value_3 = $_POST["new_extra_value_3"];



		$prod_id = $_POST["new_extra_prod_id"];

		$curr_id = $_POST["new_extra_curr_id"];



		$sql_insert = "INSERT INTO tbl_extra (extra_name,extra_desc,curr_id,prod_id,extra_value,extra_value_1,extra_value_2,extra_value_3) VALUES ('" . addslashes($extra_name) . "','" . addslashes($extra_desc) . "','" . $curr_id . "','" . $prod_id . "','" . $extra_value . "','" . $extra_value_1 . "','" . $extra_value_2 . "','" . $extra_value_3 . "');";
		

		Yii::app()->db->createCommand($sql_insert)->execute();
		$extra_id = Yii::app()->db->getLastInsertId();
		$new_extra_cat = $_POST['new_extra_cat'];

		foreach ($new_extra_cat as $id) {

			$ins = "INSERT INTO `category_extra_listing`(`cat_ex_id`, `extra_id`) VALUES ('$id','$extra_id')";

			Yii::app()->db->createCommand($ins)->execute();
		}


		echo json_encode(array("result" => "success"));
	}



	public function actionEditExtraItem()

	{



		$extra_id = $_POST["extra_id"];
		$prod_id = $_POST["prod_id"];
		$curr_id = $_POST["curr_id"];



		$sql_select = "SELECT * FROM tbl_extra WHERE extra_id='" . $extra_id . "'; ";



		$a_extra = Yii::app()->db->createCommand($sql_select)->queryAll();

		$sql_edit="SELECT cat_ex_id FROM category_extra_listing WHERE extra_id='$extra_id'";
		$extra_cat = Yii::app()->db->createCommand($sql_edit)->queryAll();
				
		$sqlext_cat = "SELECT * FROM category_extra_items WHERE prod_id='$prod_id' AND curr_id='$curr_id'";

		$data = Yii::app()->db->createCommand($sqlext_cat)->queryAll();

		$ectcate_opt = '';
		foreach($data as $key=>$value){
			$ectcate_opt.='<option value="'.$value['cat_ex_id'].'" '.(in_array($value['cat_ex_id'],array_column($extra_cat,'cat_ex_id'))?'selected':'').'>'.$value['cat_ex_name'].'</option>';
		}


		$a_return = array();

		$a_return = $a_extra[0];

		$a_return["result"] = "success";
		$a_return["ext_cat"] = $ectcate_opt;


		echo json_encode($a_return);
	}



	public function actionEditExtraItemLib()

	{

		$extra_id = $_POST["extra_id"];

		$user_id = Yii::app()->user->getState('userKey');

		$sql_select = "SELECT *,t1.extra_id as main_id FROM `tbl_extra` AS t1 LEFT JOIN (SELECT * FROM tbl_lib_extra 

            WHERE user_id='" . $user_id . "') AS t2 ON (t1.`extra_id` = t2.`extra_id`) WHERE t1.extra_id='" . $extra_id . "'";



		$a_extra = Yii::app()->db->createCommand($sql_select)->queryAll();



		$a_return = array();

		$a_return = $a_extra[0];

		$a_return["result"] = "success";



		echo json_encode($a_return);
	}



	public function actionEditExtraSubmit()
{
    $extra_id      = $_POST["edit_extra_id"];
    $extra_name    = $_POST["edit_extra_name"];
    $extra_desc    = $_POST["edit_extra_desc"];
    $extra_value   = $_POST["edit_extra_value"];
    $extra_value_1 = $_POST["edit_extra_value_1"];
    $extra_value_2 = $_POST["edit_extra_value_2"];
    $extra_value_3 = $_POST["edit_extra_value_3"];
    $edit_extra_cat = isset($_POST["edit_extra_cat"]) ? (array)$_POST["edit_extra_cat"] : [];

    $sql_update = "UPDATE tbl_extra SET 
        extra_name='"   . addslashes($extra_name) . "',
        extra_desc='"   . addslashes($extra_desc) . "',
        extra_value='"  . $extra_value   . "',
        extra_value_1='" . $extra_value_1 . "',
        extra_value_2='" . $extra_value_2 . "',
        extra_value_3='" . $extra_value_3 . "'
        WHERE extra_id='" . $extra_id . "'";

    Yii::app()->db->createCommand($sql_update)->execute();

    // DELETE once, outside the loop
    $sql_delete = "DELETE FROM category_extra_listing WHERE extra_id='$extra_id'";
    Yii::app()->db->createCommand($sql_delete)->execute();

    foreach ($edit_extra_cat as $id) {
        $ins = "INSERT INTO `category_extra_listing`(`cat_ex_id`, `extra_id`) VALUES ('$id','$extra_id')";
        Yii::app()->db->createCommand($ins)->execute();
    }

    echo json_encode([
        "result" => "success",
        "data"   => [
            "extra_id"     => $extra_id,
            "extra_name"   => $extra_name,
            "extra_desc"   => $extra_desc,
            "extra_value"  => $extra_value,
            "extra_value_1" => $extra_value_1,
            "extra_value_2" => $extra_value_2,
            "extra_value_3" => $extra_value_3,
        ]
    ]);
}



	public function actionEditLibExtraSubmit()

	{

		$user_id = Yii::app()->user->getState('userKey');

		$extra_id = $_POST["edit_extra_id"];

		$extra_desc = $_POST["edit_extra_desc"];

		$sql = "SELECT COUNT(*) as total FROM tbl_lib_extra WHERE user_id='$user_id' AND extra_id='$extra_id'";

		$row_fetch_all = Yii::app()->db->createCommand($sql)->queryAll();

		if ($row_fetch_all[0]['total'] == 1) {

			$sql_update = "UPDATE tbl_lib_extra SET description='" . addslashes($extra_desc) . "' WHERE extra_id='" . $extra_id . "' AND user_id='$user_id'";

			Yii::app()->db->createCommand($sql_update)->execute();

			echo json_encode(array("result" => "success"));
		} else {

			$insert_sql = "INSERT INTO tbl_lib_extra(extra_id,user_id,description) VALUES('" . $extra_id . "','" . $user_id . "','" . addslashes($extra_desc) . "')";

			Yii::app()->db->createCommand($insert_sql)->execute();

			echo json_encode(array("result" => "success"));
		}
	}



	public function actionDeleteExtra()

	{



		$extra_id = $_POST["extra_id"];



		$sql_delete = "DELETE FROM tbl_extra WHERE extra_id='" . $extra_id . "';";



		Yii::app()->db->createCommand($sql_delete)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionReplaceCopyExtraSubmit()

	{

		$from_extra_item = implode(",", $_POST['from_product']);

		if (isset($_POST['to_product'])) {

			$to_extra_item = implode(",", $_POST['to_product']);
		} else {

			$to_extra_item = "";
		}



		$from_curr_id = $_POST['from_curr_id'];

		$to_curr_id = $_POST['curr_id'];



		$from_product_id = $_POST['prod_id'];

		$to_product_id = $_POST['to_prod_id'];



		if ($from_product_id == $to_product_id && $from_curr_id == $to_curr_id) {

			die(json_encode(array('status' => 0)));
		} else {

			if (isset($_POST['to_product'])) {

				$sql_delete = "DELETE FROM tbl_extra WHERE extra_id IN ($to_extra_item);";

				Yii::app()->db->createCommand($sql_delete)->execute();
			}

			$sql_curr = "SELECT exchange_from_usd FROM tbl_currency WHERE curr_id='" . $to_curr_id . "'; ";

			$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

			$ex_rate = $a_curr[0]["exchange_from_usd"];

			$sql_fetch_all = "SELECT * FROM tbl_extra WHERE extra_id IN ($from_extra_item) ORDER BY sort_no ASC";

			$row_fetch_all = Yii::app()->db->createCommand($sql_fetch_all)->queryAll();

			foreach ($row_fetch_all as $iteration) {

				$extra_name = Yii::app()->db->quoteValue($iteration['extra_name']);

				$extra_desc = Yii::app()->db->quoteValue($iteration['extra_desc']);

				//$to_curr_id = 

				$extra_value = $iteration['extra_value'];

				$extra_value_1 = $iteration['extra_value_1'];

				$extra_value_2 = $iteration['extra_value_2'];

				$extra_value_3 = $iteration['extra_value_3'];

				//$to_product_id

				$insert_sql = "INSERT INTO tbl_extra (extra_name, extra_desc, curr_id, prod_id, extra_value, extra_value_1, extra_value_2, extra_value_3)

                    VALUES (

                        " . $extra_name . ",

                        " . $extra_desc . ",

                        " . $to_curr_id . ",

                        " . $to_product_id . ",

                        ROUND(((" . $extra_value . "* " . $ex_rate . ") / 0.25)) * 0.25,

                        ROUND(((" . $extra_value_1 . "* " . $ex_rate . ") / 0.25)) * 0.25,

                        ROUND(((" . $extra_value_2 . "* " . $ex_rate . ") / 0.25)) * 0.25,

                        ROUND(((" . $extra_value_3 . "* " . $ex_rate . ") / 0.25)) * 0.25

                    )";



				Yii::app()->db->createCommand($insert_sql)->execute();
			}

			die(json_encode(array('status' => 1)));

			//  $result["sat_id_list"] = $row_prod_sat[0]["sat_id_list"];

		}
	}



	public function actionCopyExtraSubmit()

	{



		$from_prod_id = $_POST["from_prod_id"];

		$to_prod_id = $_POST["to_prod_id"];

		$from_curr_id = $_POST["from_curr_id"];

		$to_curr_id = $_POST["to_curr_id"];



		if ($from_curr_id != "1" || ($from_curr_id == "1" && $to_curr_id == "1")) {



			$sql_insert = "INSERT INTO tbl_extra (extra_name,extra_desc,curr_id,prod_id,extra_value) SELECT extra_name,extra_desc,'" . $from_curr_id . "','" . $to_prod_id . "'";

			$sql_insert .= ",extra_value FROM tbl_extra WHERE prod_id='" . $from_prod_id . "' AND curr_id='" . $from_curr_id . "'; ";
		} else {



			$sql_curr = "SELECT exchange_from_usd FROM tbl_currency WHERE curr_id='" . $to_curr_id . "'; ";

			$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

			$ex_rate = $a_curr[0]["exchange_from_usd"];



			$sql_insert = "INSERT INTO tbl_extra (extra_name,extra_desc,curr_id,prod_id,extra_value) SELECT extra_name,extra_desc,'" . $to_curr_id . "','" . $to_prod_id . "'";

			$sql_insert .= ",ROUND((extra_value*" . $ex_rate . "),0) FROM tbl_extra WHERE prod_id='" . $from_prod_id . "' AND curr_id='" . $from_curr_id . "'; ";
		}



		if (Yii::app()->db->createCommand($sql_insert)->execute()) {

			echo json_encode(array("result" => "success"));
		} else {

			echo json_encode(array("result" => "fail"));
		}
	}



	public function actionSaveEditNotes()

	{



		$prod_id = $_POST["prod_id"];

		$curr_id = $_POST["curr_id"];

		$notes = base64_decode($_POST["notes"]);



		$sql_chk = "SELECT * FROM notes WHERE prod_id='" . $prod_id . "' AND curr_id='" . $curr_id . "'; ";

		$a_check = Yii::app()->db->createCommand($sql_chk)->queryAll();



		if (sizeof($a_check) > 0) {



			$sql_update = "UPDATE notes SET notes='" . addslashes($notes) . "' WHERE prod_id='" . $prod_id . "' AND curr_id='" . $curr_id . "';";

			Yii::app()->db->createCommand($sql_update)->execute();
		} else {



			$sql_insert = "INSERT INTO notes (notes,prod_id,curr_id) VALUES ('" . addslashes($notes) . "','" . $prod_id . "','" . $curr_id . "');";

			Yii::app()->db->createCommand($sql_insert)->execute();
		}





		echo json_encode(array("result" => "success", "show_notes" => base64_encode(nl2br($notes))));
	}



	public function actionExportToAllZip()

	{

		include_once(Yii::app()->getBasePath() . "/vendors/mpdf/mpdf.php");

		$mpdf = new mPDF('c');



		$download_type = $_POST["dl_type"];



		$prod_id = $_POST["dl_prod_id"];

		$sat_id = $_POST["dl_sale_type"];

		$curr_id = $_POST["dl_curr_id"];

		$comm_type = Yii::app()->user->getState('commissionType');

		$data = '';

		$where = "";



		if ($sat_id == 3 && $comm_type == 7) {

			$sat_id = 2;

			$where = "AND (comm_value='7' OR comm_value='0')";
		}



		$main_sql = "SELECT * FROM tbl_product";

		$main_sql_query = Yii::app()->db->createCommand($main_sql)->queryAll();

		foreach ($main_sql_query as $prods) {

			//echo $prods['prod_id'];



			$sql_product = "SELECT * FROM tbl_product WHERE prod_id='" . $prods['prod_id'] . "'; ";

			$a_product = Yii::app()->db->createCommand($sql_product)->queryAll();

			$result["a_product"] = $a_product[0];



			$sql_sale_type = "SELECT * FROM tbl_sale_type WHERE sat_id='" . $sat_id . "'; ";

			$a_sale_type = Yii::app()->db->createCommand($sql_sale_type)->queryAll();

			$result["a_sale_type"] = $a_sale_type[0];



			$sql_item = "SELECT tbl_item.* FROM tbl_item LEFT JOIN tbl_item_group ON tbl_item.group_id=tbl_item_group.item_group_id WHERE tbl_item.prod_id='" . $prods['prod_id'] . "' AND tbl_item.enable=1 ORDER BY tbl_item_group.sort ASC, tbl_item.sort ASC; ";

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



			$a_comm_per_id = array();

			for ($k = 0; $k < sizeof($result["a_comm"]); $k++) {

				$a_comm_per_id[] = $result["a_comm"][$k]["comm_per_id"];
			}

			$s_comm_per_id_list = implode(",", $a_comm_per_id);



			$sql_price_guide = "SELECT * FROM tbl_price_guide WHERE sat_id='" . $sat_id . "' AND curr_id='" . $curr_id . "' AND item_id IN (" . $s_item_id_list . ")  ";

			if (sizeof($a_comm_per_id) > 0) {

				$sql_price_guide .= " AND comm_per_id IN (" . $s_comm_per_id_list . ") ";
			}

			$row_pguide = Yii::app()->db->createCommand($sql_price_guide)->queryAll();

			$a_pguide = array();



			for ($i = 0; $i < sizeof($row_pguide); $i++) {

				$a_pguide[($row_pguide[$i]["item_id"])][($row_pguide[$i]["comm_per_id"])] = $row_pguide[$i];
			}



			$result["a_pguide"] = $a_pguide;



			$sql_item_group = "SELECT * FROM tbl_item_group WHERE prod_id='" . $prods['prod_id'] . "' ORDER BY sort ASC; ";

			$result["a_item_group"] = Yii::app()->db->createCommand($sql_item_group)->queryAll();



			$result["prod_id"] = $prods['prod_id'];

			$result["sat_id"] = $sat_id;

			$result["curr_id"] = $curr_id;





			$result["admin_edit"] = "no";



			$sql_extra = "SELECT * FROM tbl_extra WHERE curr_id='" . $curr_id . "' AND prod_id='" . $prods['prod_id'] . "' ORDER BY sort_no ASC; ";

			$result["a_extra"] = Yii::app()->db->createCommand($sql_extra)->queryAll();



			$sql_notes = "SELECT * FROM notes WHERE prod_id='" . $prods['prod_id'] . "' ORDER BY id ASC LIMIT 0,1; ";

			$a_notes = Yii::app()->db->createCommand($sql_notes)->queryAll();

			if (sizeof($a_notes) > 0) {

				$result['row_notes'] = $a_notes[0];
			}

			$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $curr_id . "'; ";

			$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

			$result['row_curr'] = $a_curr[0];



			if ($download_type == "pdf") {



				$html = $this->renderPartial('download_file', $result, true);

				$mpdf->AddPage('L');

				$mpdf->WriteHTML($html);
			} else {



				$data = $this->renderPartial('download_file_ajax', $result, true);



				// Set the filename for the Excel file

				$filename = $a_product[0]["prod_type"] . ".xls";



				// Write the Excel data to a file on the server

				$file_path = Yii::getPathOfAlias('webroot') . '/upload/temp_pdf/' . $filename;

				file_put_contents($file_path, $data);

				$xlsFiles[] = $file_path;
			}
		}

		if ($download_type == "pdf") {

			$mpdf->Output();
		} else {

			// Create a new zip archive

			$zip = new ZipArchive;

			$zip_filename = 'PG_' . $a_sale_type[0]["sat_name"] . '_' . date("Ymd") . '.zip';

			if ($zip->open($zip_filename, ZipArchive::CREATE) === TRUE) {

				// Loop through the file paths and add each file to the zip archive

				foreach ($xlsFiles as $file_path) {

					// Get the file name from the path

					$filename = basename($file_path);



					// Add the file to the zip archive

					$zip->addFile($file_path, $filename);
				}



				// Close the zip archive

				$zip->close();



				// Send the zip file to the browser for download

				header('Content-Type: application/zip');

				header('Content-Disposition: attachment; filename="' . $zip_filename . '"');

				header('Content-Length: ' . filesize($zip_filename));

				header("Expires: 0");

				readfile($zip_filename);
			} else {

				echo 'Failed to create zip archive';
			}
		}
	}



	public function actionExportToAll()

	{

		include_once(Yii::app()->getBasePath() . "/vendors/mpdf/mpdf.php");



		$mpdf = new mPDF('c');



		$download_type = $_POST["dl_type"];



		$prod_id = $_POST["dl_prod_id"];

		$sat_id = $_POST["dl_sale_type"];

		$curr_id = $_POST["dl_curr_id"];

		$comm_type = Yii::app()->user->getState('commissionType');



		$where = "";



		if ($sat_id == 3 && $comm_type == 7) {

			$sat_id = 2;

			$where = "AND (comm_value='7' OR comm_value='0')";
		}



		$main_sql = "SELECT * FROM tbl_product";

		$main_sql_query = Yii::app()->db->createCommand($main_sql)->queryAll();

		if ($download_type != "pdf") {

			header("Content-Type: application/vnd.ms-excel; charset=utf-8");

			header("Content-Disposition: attachment; filename=PG_" . $a_sale_type[0]["sat_name"] . "_" . $a_product[0]["prod_type"] . "_" . date("Ymd") . ".xls");

			header("Expires: 0");

			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

			header("Cache-Control: private", false);
		}

		foreach ($main_sql_query as $prods) {

			//echo $prods['prod_id'];



			$sql_product = "SELECT * FROM tbl_product WHERE prod_id='" . $prods['prod_id'] . "'; ";

			$a_product = Yii::app()->db->createCommand($sql_product)->queryAll();

			$result["a_product"] = $a_product[0];



			$sql_sale_type = "SELECT * FROM tbl_sale_type WHERE sat_id='" . $sat_id . "'; ";

			$a_sale_type = Yii::app()->db->createCommand($sql_sale_type)->queryAll();

			$result["a_sale_type"] = $a_sale_type[0];



			$sql_item = "SELECT tbl_item.* FROM tbl_item LEFT JOIN tbl_item_group ON tbl_item.group_id=tbl_item_group.item_group_id WHERE tbl_item.prod_id='" . $prods['prod_id'] . "' AND tbl_item.enable=1 ORDER BY tbl_item_group.sort ASC, tbl_item.sort ASC; ";

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



			$a_comm_per_id = array();

			for ($k = 0; $k < sizeof($result["a_comm"]); $k++) {

				$a_comm_per_id[] = $result["a_comm"][$k]["comm_per_id"];
			}

			$s_comm_per_id_list = implode(",", $a_comm_per_id);



			$sql_price_guide = "SELECT * FROM tbl_price_guide WHERE sat_id='" . $sat_id . "' AND curr_id='" . $curr_id . "' AND item_id IN (" . $s_item_id_list . ")  ";

			if (sizeof($a_comm_per_id) > 0) {

				$sql_price_guide .= " AND comm_per_id IN (" . $s_comm_per_id_list . ") ";
			}

			$row_pguide = Yii::app()->db->createCommand($sql_price_guide)->queryAll();

			$a_pguide = array();



			for ($i = 0; $i < sizeof($row_pguide); $i++) {

				$a_pguide[($row_pguide[$i]["item_id"])][($row_pguide[$i]["comm_per_id"])] = $row_pguide[$i];
			}



			$result["a_pguide"] = $a_pguide;



			$sql_item_group = "SELECT * FROM tbl_item_group WHERE prod_id='" . $prods['prod_id'] . "' ORDER BY sort ASC; ";

			$result["a_item_group"] = Yii::app()->db->createCommand($sql_item_group)->queryAll();



			$result["prod_id"] = $prods['prod_id'];

			$result["sat_id"] = $sat_id;

			$result["curr_id"] = $curr_id;





			$result["admin_edit"] = "no";



			$sql_extra = "SELECT * FROM tbl_extra WHERE curr_id='" . $curr_id . "' AND prod_id='" . $prods['prod_id'] . "' ORDER BY sort_no ASC; ";

			$result["a_extra"] = Yii::app()->db->createCommand($sql_extra)->queryAll();



			$sql_notes = "SELECT * FROM notes WHERE prod_id='" . $prods['prod_id'] . "' ORDER BY id ASC LIMIT 0,1; ";

			$a_notes = Yii::app()->db->createCommand($sql_notes)->queryAll();

			if (sizeof($a_notes) > 0) {

				$result['row_notes'] = $a_notes[0];
			}



			$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $curr_id . "'; ";

			$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

			$result['row_curr'] = $a_curr[0];



			if ($download_type == "pdf") {



				$html = $this->renderPartial('download_file', $result, true);

				$mpdf->AddPage('L');

				$mpdf->WriteHTML($html);
			} else {



				$this->renderPartial('download_file', $result);
			}
		}

		if ($download_type == "pdf") {

			$mpdf->Output();
		}
	}



	public function actionExportTo()

	{



		$download_type = $_POST["dl_type"];



		$prod_id = $_POST["dl_prod_id"];

		$sat_id = $_POST["dl_sale_type"];

		$curr_id = $_POST["dl_curr_id"];



		$comm_type = Yii::app()->user->getState('commissionType');



		$where = "";



		if ($sat_id == 3 && $comm_type == 7) {

			$sat_id = 2;

			$where = "AND (comm_value='7' OR comm_value='0')";
		}



		$sql_product = "SELECT * FROM tbl_product WHERE prod_id='" . $prod_id . "'; ";

		$a_product = Yii::app()->db->createCommand($sql_product)->queryAll();

		$result["a_product"] = $a_product[0];



		$sql_sale_type = "SELECT * FROM tbl_sale_type WHERE sat_id='" . $sat_id . "'; ";

		$a_sale_type = Yii::app()->db->createCommand($sql_sale_type)->queryAll();

		$result["a_sale_type"] = $a_sale_type[0];



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



		$a_comm_per_id = array();

		for ($k = 0; $k < sizeof($result["a_comm"]); $k++) {

			$a_comm_per_id[] = $result["a_comm"][$k]["comm_per_id"];
		}

		$s_comm_per_id_list = implode(",", $a_comm_per_id);



		$sql_price_guide = "SELECT * FROM tbl_price_guide WHERE sat_id='" . $sat_id . "' AND curr_id='" . $curr_id . "' AND item_id IN (" . $s_item_id_list . ")  ";

		if (sizeof($a_comm_per_id) > 0) {

			$sql_price_guide .= " AND comm_per_id IN (" . $s_comm_per_id_list . ") ";
		}

		$row_pguide = Yii::app()->db->createCommand($sql_price_guide)->queryAll();

		$a_pguide = array();



		for ($i = 0; $i < sizeof($row_pguide); $i++) {

			$a_pguide[($row_pguide[$i]["item_id"])][($row_pguide[$i]["comm_per_id"])] = $row_pguide[$i];
		}



		$result["a_pguide"] = $a_pguide;



		$sql_item_group = "SELECT * FROM tbl_item_group WHERE prod_id='" . $prod_id . "' ORDER BY sort ASC; ";

		$result["a_item_group"] = Yii::app()->db->createCommand($sql_item_group)->queryAll();



		$result["prod_id"] = $prod_id;

		$result["sat_id"] = $sat_id;

		$result["curr_id"] = $curr_id;





		$result["admin_edit"] = "no";



		$sql_extra = "SELECT * FROM tbl_extra WHERE curr_id='" . $curr_id . "' AND prod_id='" . $prod_id . "' ORDER BY sort_no ASC; ";

		$result["a_extra"] = Yii::app()->db->createCommand($sql_extra)->queryAll();



		$sql_notes = "SELECT * FROM notes WHERE prod_id='" . $prod_id . "' AND curr_id='" . $curr_id . "' ORDER BY id ASC LIMIT 0,1; ";

		$a_notes = Yii::app()->db->createCommand($sql_notes)->queryAll();

		if (sizeof($a_notes) > 0) {

			$result['row_notes'] = $a_notes[0];
		}



		$sql_curr = "SELECT * FROM tbl_currency WHERE curr_id='" . $curr_id . "'; ";

		$a_curr = Yii::app()->db->createCommand($sql_curr)->queryAll();

		$result['row_curr'] = $a_curr[0];



		if ($download_type == "pdf") {



			$html = $this->renderPartial('download_file', $result, true);



			include_once(Yii::app()->getBasePath() . "/vendors/mpdf/mpdf.php");

			$mpdf = new mPDF('c');

			$mpdf->AddPage('L');

			$mpdf->WriteHTML($html);

			$mpdf->Output();
		} else {



			header("Content-Type: application/vnd.ms-excel; charset=utf-8");

			header("Content-Disposition: attachment; filename=PG_" . $a_sale_type[0]["sat_name"] . "_" . $a_product[0]["prod_type"] . "_" . date("Ymd") . ".xls");

			header("Expires: 0");

			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

			header("Cache-Control: private", false);



			$this->renderPartial('download_file', $result);
		}
	}



	public function actionShowAddiSortForm()

	{



		$item_id = $_POST["item_id"];

		$curr_id = $_POST['curr'];



		$sql_addi = "SELECT * FROM tbl_additional_new WHERE item_id='" . $item_id . "' AND curr_id='" . $curr_id . "' ORDER BY ordering ASC; ";

		$a_addi = Yii::app()->db->createCommand($sql_addi)->queryAll();



		if (sizeof($a_addi) > 0) {



			$result["a_addi"] = $a_addi;

			$this->renderPartial('sort_addi', $result);
		} else {

			echo '<center style="color:#F00;"><b>Not found.</b></center>';
		}
	}



	public function actionSaveSortAddi()

	{



		$a_addi_id = $_POST["sort_addi_id"];



		$sql_update = "";

		for ($i = 0; $i < sizeof($a_addi_id); $i++) {

			$sql_update .= "UPDATE tbl_additional_new SET ordering='" . ($i + 1) . "' WHERE addi_id='" . $a_addi_id[$i] . "'; ";
		}



		$a_result = array();

		if ($sql_update == "") {

			$a_result["result"] = "fail";

			$a_result["msg"] = "Nothing update.";
		} else {



			Yii::app()->db->createCommand($sql_update)->execute();

			$a_result["result"] = "success";
		}



		echo json_encode($a_result);
	}



	public function actionSubmitNewAddiV2()

	{



		$item_id = $_POST["new_addi_item_id"];

		$curr_id = $_POST["new_addi_curr_id"];

		$addi_name = addslashes($_POST["new_addi_name"]);

		$addi_value = $_POST["new_addi_value"];



		$sql_max_sort = "SELECT MAX(ordering) AS max_sort FROM tbl_additional_new WHERE item_id='" . $item_id . "'; ";

		$a_max_sort = Yii::app()->db->createCommand($sql_max_sort)->queryAll();



		$next_ordering = 1;

		if (sizeof($a_max_sort) > 0) {

			$next_ordering = intval($a_max_sort[0]["max_sort"]) + 1;
		}



		$sql_insert = "INSERT INTO tbl_additional_new (addi_name,item_id,curr_id,ordering,addi_value) VALUES ('" . addslashes($addi_name) . "','" . $item_id . "','" . $curr_id . "','" . $next_ordering . "','" . $addi_value . "');";



		Yii::app()->db->createCommand($sql_insert)->execute();



		echo json_encode(array("result" => "success"));
	}



	public function actionDeleteAddiV2()

	{



		$addi_id = $_POST["addi_id"];



		$sql_chk = "SELECT * FROM tbl_additional_new WHERE addi_id='" . $addi_id . "'; ";

		$a_chk = Yii::app()->db->createCommand($sql_chk)->queryAll();



		$sql_delete = "DELETE FROM tbl_additional_new WHERE addi_id='" . $addi_id . "';";

		Yii::app()->db->createCommand($sql_delete)->execute();



		$sql_update = "UPDATE tbl_additional_new SET ordering=ordering-1 WHERE item_id='" . $a_chk[0]["item_id"] . "' AND ordering>'" . $a_chk[0]["ordering"] . "'; ";

		Yii::app()->db->createCommand($sql_update)->execute();



		echo json_encode(array("result" => "success"));
	}

	public function actionaddNewCustd()
	{

		$user_id =  $_POST['user_id']; // Customer Name
		$cust_name = isset($_POST['cust_full_name']) ? $_POST['cust_full_name'] : ''; // Customer Name
		$cust_info = isset($_POST['full_name']) ? $_POST['full_name'] . PHP_EOL : ''; // Contact Person
		$cust_info .= isset($_POST['billing_address']) ? $_POST['billing_address'] . PHP_EOL : ''; // Address
		$cust_info .= isset($_POST['email']) ? $_POST['email'] : ''; // Email
		$cust_full_name = isset($_POST['cust_full_name']) ? $_POST['cust_full_name'] : ''; // Full Name
		$phone_no = isset($_POST['phone_no']) ? $_POST['phone_no'] : ''; // Phone Number
		$email = isset($_POST['email']) ? $_POST['email'] : ''; // Email
		$full_name = isset($_POST['full_name']) ? $_POST['full_name'] : ''; // Full Name
		$billing_address = isset($_POST['billing_address']) ? $_POST['billing_address'] : ''; // Billing Address
		$billing_country = isset($_POST['billing_country']) ? $_POST['billing_country'] : ''; // Billing Country
		$billing_state = isset($_POST['billing_state']) ? $_POST['billing_state'] : ''; // Billing State
		$sales_tax = isset($_POST['sales_tax']) ? $_POST['sales_tax'] : ''; // Default empty (if you have a rule, modify it)
		$customer_type = isset($_POST['customer_type']) ? $_POST['customer_type'] : ''; // Default empty (if you have a rule, modify it)
		$tax_id = isset($_POST['tax_id']) ? $_POST['tax_id'] : ''; // Default empty (if you have a rule, modify it)
		$billing_zip_code = isset($_POST['billing_zip_code']) ? $_POST['billing_zip_code'] : ''; // Default empty (if you have a rule, modify it)
		$state_name = isset($_POST['state_name']) ? $_POST['state_name'] : ''; // State Name		


		$sql_insert = "INSERT INTO tbl_cust_info 
		(user_id, cust_name, cust_info, cust_full_name, phone_no, email, full_name, billing_address, billing_country, billing_state, billing_zip_code, sales_tax, customer_type, tax_id, state_name, add_date) 
		VALUES 
		('" . $user_id . "', '" . $cust_name . "', '" . $cust_info . "', '" . $cust_full_name . "', '" . $phone_no . "', '" . $email . "', '" . $full_name . "', '" . $billing_address . "', '" . $billing_country . "', '" . $billing_state . "', '" . $billing_zip_code . "', '" . $sales_tax . "','" . $customer_type . "', '" . $tax_id . "', '" . $state_name . "', '" . date("Y-m-d H:i:s") . "');";


		Yii::app()->db->createCommand($sql_insert)->execute();
		$cust_id = Yii::app()->db->getLastInsertId();

		echo json_encode([
			"status" => "success",
			"message" => "Customer added successfully!",
			"cust_id" => $cust_id,
			"cust_name" => $cust_name,
			"cust_full_name" => $cust_full_name
		]);
	}


	
	// license aggrement and privacy policy
	public function actionUserLicenseAggrement(){		 
		 $this->render('end_user_license' , ['title' => '  End‑User License Agreement (EULA)']);
	}

	public function actionPrivacyPolicy(){
		  $this->render('privacy_and_policy' ,['title'=> 'Privacy And Policy']);
	}


	// get customer list according to customer 

	public function actionGetCustomerTypeList(){ 
		 $is_quotation = $_POST['is_quotation'] ?? 0; 
		 $is_estimate = $_POST['is_estimate'] ?? 0; 
		 $customer_id = $is_quotation  || $is_estimate ? $_POST['customer_id']  :$_POST['customer_id'];
		 $sql =  "SELECT customer_type AS customer_type  FROM estimate_customer_type Where customer_id = '$customer_id'";
		 $customer_type = Yii::app()->db->createCommand($sql)->queryScalar(); 
    
         
			$customer_type_arr = [
				'5' => 'College Retail - Bookstore' , 
				'2' => 'Dealer' , 
				'3' => 'Factory Direct Customers' , 
				'8' => 'International Sales' , 
				'6' => 'Online Stores Collegiate' , 
				'7' => 'Online Spirit Stores' , 
				'4' => 'Private Label Companies' , 
				'1' => 'Sales Direct Hockey Related - Youth, High School' , 
				'9' => 'Sales Direct College & Juniors',
				'10' => 'Sales Direct to Business Camps, Misc.' , 
				'11'=> 'Sales Direct - Other Sports' , 
				'12' => 'Sales Direct - Adult Hockey Teams/Leagues'
			];
	

		 $str='';
		$updated_customer_type =  in_array($customer_type, $customer_type_arr) ?  $customer_type : $customer_type_arr[1]  ;

 
		 foreach($customer_type_arr as $key=>$value){
		      $selected =  $value == $updated_customer_type ? "Selected" : ""; 
			  $str .='<option value="'.$value.'" '.$selected.'> '.$value.' </option>';
		 }
	
		 echo json_encode(['status' => 200 ,'selected_id' =>$updated_customer_type , 'html'=> $str]); 
		 exit ; 
	}
}
