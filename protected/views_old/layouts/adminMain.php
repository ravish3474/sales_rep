<!DOCTYPE html>
<html lang="en">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/jog-icon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/plugin/bootstrap/css/bootstrap.min.css">
    <!-- fileinput -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugin/bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <!-- font-awesome -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/plugin/gentelella/fonts/css/font-awesome.min.css">
    <!-- animate -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/plugin/gentelella/css/animate.min.css">
    <!-- Custom styling plus plugins -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugin/gentelella/css/custom.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css">
	
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/multifreezer.css" rel="stylesheet">
    <script type="text/javascript">
        window.baseUrl = '<?php echo Yii::app()->request->baseUrl; ?>';
    </script>

    <!--[if lt IE 9]>
    <script src="../assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/multifreezer.js"></script>
<script>
	$(document).ready(function () {
    var date = new Date();
    var currentMonth = date.getMonth();
    var currentDate = date.getDate();
    var currentYear = date.getFullYear();

    $('#Calculator_date_quarter').datepicker({
        //minDate: new Date(currentYear, currentMonth, currentDate),
        dateFormat: 'yy-mm-dd'
    }); 
	$('#Calculator_date_for_sales').datepicker({
        //minDate: new Date(currentYear, currentMonth, currentDate),
        dateFormat: 'yy-mm-dd'
    });
	$('#Calculator_invoice_date').datepicker({
        //minDate: new Date(currentYear, currentMonth, currentDate),
        dateFormat: 'yy-mm-dd'
    });
	$('#date_quarter_edit').datepicker({
       
        dateFormat: 'yy-mm-dd'
    }); 
	$('#date_for_sales_edit').datepicker({
        
        dateFormat: 'yy-mm-dd'
    });
	$('#invoice_date_edit').datepicker({
        
        dateFormat: 'yy-mm-dd'
    });
	$('#search_dateQuarter').datepicker({
        
        dateFormat: 'yy-mm-dd'
    });
	$('#search_dateQuarter2').datepicker({
        
        dateFormat: 'yy-mm-dd'
    });
	$('#SalesOrders_date_saleorder').datepicker({
        
        dateFormat: 'yy-mm-dd'
    });
	$('#Calculator_date_for_sales_salesrep').datepicker({
        
        dateFormat: 'yy-mm-dd'
    });
});
</script>
	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/tableHeadFixer.js"></script>

	


</head>
<body class="nav-md">
  <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>" class="site_title"><i class="logo"></i> <span>Sales Rep.</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/jog.jpg" class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo Yii::app()->user->getState('fullName'); ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <?php echo $this->renderPartial('/layouts/menu');  ?>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <!-- <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div> -->
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <?php 
            /*if( Yii::app()->controller->id == "priceGuideV2"){
                echo $this->renderPartial('/layouts/top_v2');  
            }else{*/
                echo $this->renderPartial('/layouts/top');  
            //}
            ?>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <?php echo $content;  ?>

                <!-- footer content -->
                <footer>
                    <div class="copyright-info">
                        <p class="pull-right">Copyright &copy; <?php echo date('Y'); ?> All Rights Reserved | Powered by JOG Athletics LLC  
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
            <!-- /page content -->

        </div>
    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

   

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugin/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugin/gentelella/js/nprogress.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugin/gentelella/js/bootstrap.min.js"></script>

    <!-- bootstrap progress js -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugin/gentelella/js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugin/gentelella/js/nicescroll/jquery.nicescroll.min.js"></script>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugin/gentelella/js/custom.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js"></script>
	
	

</body>
</html>
