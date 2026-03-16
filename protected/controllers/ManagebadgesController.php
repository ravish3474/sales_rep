<?php
class ManagebadgesController extends AuthController
{

    public function actionIndex()
    {
        $sq = "SELECT * FROM `tbl_badges` WHERE 1";
        $badge['badge'] = Yii::app()->db->createCommand($sq)->queryAll();

        $sql_prod = " SELECT * FROM tbl_product ORDER BY sort ASC;";
        $badge['pro'] = Yii::app()->db->createCommand($sql_prod)->queryAll();

       $this->render('index', $badge);
    }

    public function actionAddbadges(){
        
        $Add_Badge =$_POST['Add_Badge'];
        $badge_color =$_POST['badge_color'];
        
        $BadgesStatus=  $_POST['BadgesStatus'];
        $BadgesHighlights = $_POST['BadgesHighlights'];
        $BadgesTitle = $_POST['BadgesTitle'];
        $description= $_POST['description'];


        $TblBadges = new tbl_Badges();
        $TblBadges->title = $BadgesStatus;        
        $TblBadges->badge_color = $badge_color;
        $TblBadges->highlight_title = $BadgesHighlights;
        $TblBadges->badge_title = $BadgesTitle;
        $TblBadges->description = $description;
        $TblBadges->status = 1;

        $TblBadges->save();

        Yii::app()->user->setFlash('success', 'Data imported successfully.');
        $this->redirect(array('index'));
    }

    public function actionAddproductbadge(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Assuming 'bageid' contains the badge ID
            $badgeId = $_POST['bageid'];
    
            // Loop through POST data to extract product IDs
            foreach ($_POST['product'] as $productId => $state) {
                $productId = intval($productId); // Ensure the product ID is an integer
    
                if ($state === 'on') {
                    // Add product if it doesn't exist
                    $query = "SELECT * FROM tbl_badges_products WHERE badges_id = $badgeId AND pro_id = $productId";
                    $result = Yii::app()->db->createCommand($query)->queryAll();
    
                    if (empty($result)) {
                        $insertQuery = "INSERT INTO tbl_badges_products (badges_id, pro_id, status) VALUES ($badgeId, $productId, 1)";
                        Yii::app()->db->createCommand($insertQuery)->execute();
                    }
                } elseif ($state === 'unchecked') {
                    // Delete product if it exists
                    $deleteQuery = "DELETE FROM tbl_badges_products WHERE badges_id = $badgeId AND pro_id = $productId";
                    Yii::app()->db->createCommand($deleteQuery)->execute();
                }
            }
        }
    }

    public function actionAdditembadge(){
        
        
        $badge_color =$_POST['badge_color'];
        $itemid =$_POST['itemid'];
        $BadgesStatus=  $_POST['BadgesStatus'];
        $BadgesHighlights = $_POST['BadgesHighlights'];
        $BadgesTitle = $_POST['BadgesTitle'];
        $description= $_POST['description'];
        $sql = "INSERT INTO `tbl_item_badges`( `title`, `badge_color`, `highlight_title`, `badge_title`, `description`, `item_id`, `status`) VALUES ('$BadgesStatus','$badge_color','$BadgesHighlights','$BadgesTitle','$description','$itemid',1 )";
        $itemadded =Yii::app()->db->createCommand($sql)->execute();

        $lastInsertId = Yii::app()->db->getLastInsertID();

        echo $lastInsertId;
        
    }


    public function actionEdititembadge(){

        $Add_Badge= $_POST['Add_Badge'];
        $badge_color =$_POST['badge_color'];
        $itemid =$_POST['itemid'];
        $BadgesStatus=  $_POST['BadgesStatus'];
        $BadgesHighlights = $_POST['BadgesHighlights'];
        $BadgesTitle = $_POST['BadgesTitle'];
        $description= $_POST['description'];
        $id= $_POST['id'];

        $sql = "UPDATE `tbl_item_badges` SET `title`='$BadgesStatus',`badge_color`= '$badge_color',`highlight_title`= '$BadgesHighlights',`badge_title`= '$BadgesTitle',`description`= '$description' WHERE `id`='$id'";
        Yii::app()->db->createCommand($sql)->execute();

        
    }
    
    public function actionEditcatbadge(){

        $Add_Badge= $_POST['Add_Badge'];
        $badge_color =$_POST['badge_color'];
        
        $BadgesStatus=  $_POST['BadgesStatus'];
        $BadgesHighlights = $_POST['BadgesHighlights'];
        $BadgesTitle = $_POST['BadgesTitle'];
        $description= $_POST['description'];
        $id= $_POST['id'];

        $sql = "UPDATE `tbl_badges` SET `title`='$BadgesStatus',`badge_color`= '$badge_color',`highlight_title`= '$BadgesHighlights',`badge_title`= '$BadgesTitle',`description`= '$description' WHERE `id`='$id'";
        Yii::app()->db->createCommand($sql)->execute();

        
    }

    public function actionAddcarttoitembadge(){
        
        $badge_color =$_POST['badge_color'];
        $itemid =$_POST['itemid'];
        $BadgesStatus=  $_POST['BadgesStatus'];
        $BadgesHighlights = $_POST['BadgesHighlights'];
        $BadgesTitle = $_POST['BadgesTitle'];
        $description= $_POST['description'];
        $id= $_POST['id'];    

        $itembadges ="SELECT * FROM `tbl_item_badges` WHERE `item_id` = $itemid";
		$result = Yii::app()->db->createCommand($itembadges)->queryAll();
      
        if (count($result)>0) {            
            $sql = "UPDATE `tbl_item_badges` SET `title`='$BadgesStatus',`badge_color`= '$badge_color',`highlight_title`= '$BadgesHighlights',`badge_title`= '$BadgesTitle',`description`= '$description' WHERE `id`='$result[0]['id']'";
            Yii::app()->db->createCommand($sql)->execute();
        }else{
            $sql = "INSERT INTO `tbl_item_badges`( `title`, `badge_color`, `highlight_title`, `badge_title`, `description`, `item_id`, `status`) VALUES ('$BadgesStatus','$badge_color','$BadgesHighlights','$BadgesTitle','$description','$itemid',1 )";
            Yii::app()->db->createCommand($sql)->execute();
            // $TblBadges = new tbl_item_badges();
            // $TblBadges->title = $BadgesStatus;
            // $TblBadges->badge_color = $badge_color;
            // $TblBadges->highlight_title = $BadgesHighlights;
            // $TblBadges->badge_title = $BadgesTitle;
            // $TblBadges->description = $description;
            // $TblBadges->item_id = $itemid;
            // $TblBadges->status = 1;
            // $TblBadges->save();
        }
        
    }

    public function actionDeleteitembages(){
        $id =$_POST['itembageid'];
        $sql = "DELETE FROM `tbl_item_badges` WHERE `id` = $id";
        Yii::app()->db->createCommand($sql)->execute();
        
    }

    public function actionDeletecatbages(){
        $id =$_POST['itembageid'];
    
        $sql = "INSERT INTO `tbl_item_badges`( `title`, `badge_color`, `highlight_title`, `badge_title`, `description`, `item_id`, `status`) VALUES ('','','','','','$id',0 )";
        $itemadded =Yii::app()->db->createCommand($sql)->execute();

        $lastInsertId = Yii::app()->db->getLastInsertID();

        echo $lastInsertId;
        
    }

}