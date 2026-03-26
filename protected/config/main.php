<?php

// Load database configurations
$dbConfig = require(dirname(__FILE__) . '/database.php');

define('PAGINATION_LIMIT', 20);
define('MONTH_FILTER' ,['01'=>'January' ,
                        '02'=>'February',  
                        '03'=>'March',
                        '04'=>'April',
                        '05'=>'May',
                        '06'=>'June',
                        '07'=>'July',
                        '08'=>'August',
                        '09'=>'September',
                        '10'=>'October',
                        '11'=>'November',
                        '12'=>'December'
                       ]
       ); 

       define('LEAD_STATUS' , 
       ['0'=>'New Lead ' , 
       '1'=>'Follow up ', 
       '2'=>'Won',
       '3'=>'Pending',
       '4'=>'Lost',
       ]
        
    ); 

define('LEAD_CLASSES' ,[
        '0' => 'greenOption' , 
        '1' => 'blueOption ' ,
        '3' =>'yellowOption ', 
        '2'=> 'purpleOption' ,
        '4'=> 'redOption ',
      
]);

define('ACTIVITY_STATUS' ,[
     '1' => 'Edit', 
     '2' => 'Assigned', 
     '3' => 'Status Updated',
     '4' => 'Comment',
     '5' => 'Unassigned Sales Person', 
     '6' => 'Delete Lead',
     '7' => 'Permanent Delete'
]);


define('CountryCodeMap' ,  [
    'Oceania' => 'OC', 
    'Africa' => 'ET',  
    'Canada' => 'CA',
    'USA' =>'US',
    'Asia Pacific' =>'AS',
    'South America' =>'SA',
    'Gulf' =>'UAE',
]);

define("Status_Name_Query" , "CASE 
               WHEN tbl.status = 0  THEN 'New Lead'
               WHEN tbl.status = 1  THEN 'Follow up'
               WHEN tbl.status = 2  THEN 'Won'
               WHEN tbl.status = 3  THEN 'Pending'
               WHEN tbl.status = 4  THEN 'Lost'
              ELSE '' 
        END AS status");
//case  for product name 
define('Product_Query' ," CASE 
            WHEN tbl_pro.prod_id=tbl.pro_name THEN tbl_pro.prod_name 
            ELSE tbl.pro_name 
            END AS product");

function  getMonthdDate($month ,$year = 0){
      if($month):
        $currentYear =$year ? $year :date('Y'); // Get the current year
        $startDate = new DateTime("$currentYear-$month-01"); // First day of the month
        $endDate = new DateTime("$currentYear-$month-01"); // Start with the first day of the month
        $endDate->modify('last day of this month');        // Get the last day of the month


        $start_date = $startDate->format('Y-m-d'); 
        $end_date = $endDate->format('Y-m-d'); 
        return ['start_date'=>$start_date , 'end_date'=>$end_date]; 
      else:
          return ['start_date'=>date('Y-m-d') ,'end_date'=>date('Y-m-d')];
      endif ;
   
}

function getWeekDate($weekNumber, $firstDayOfWeek){
   
    $startDate = (clone $firstDayOfWeek)->modify("+".($weekNumber - 1)." week");
    $endDate = (clone $startDate)->modify('next saturday');
    
    return [
        'start' => $startDate->format('Y-m-d'),
        'end' => $endDate->format('Y-m-d')
    ];
}

function getWeekDateNew($weekNumber){
    $current_month = date('m'); 
    if($weekNumber==1){
       $date1 = date('Y-m-01');
    }elseif($weekNumber==2){
       $date1 = date('Y-m-07');
    }
     $end_date = date('Y-m-d' ,strtotime($date1 . "+ 7 days"));
     
     return [
         'start' => $date1,
         'end' => $end_date
     ];
 }

 function CurrentWeekData(){
    $today = date('Y-m-d');
    $startOfWeek = date('Y-m-d', strtotime('monday this week', strtotime($today)));
    $endOfWeek = date('Y-m-d', strtotime('sunday this week', strtotime($today)));
    return[$startOfWeek ,$endOfWeek];
}

define('lead_activity' ,[
    '1' => 'Edit' ,
    '2' => 'Assigned Leads',
    '3'=> 'Status Udpate' , 
    '4' => 'Add Comment'
]);

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name' => 'Sales Representative',
    'timeZone' => 'Asia/Bangkok',
    'defaultController' => 'priceGuideV2',

    // preloading 'log' component
    'preload' => array('log'),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),

    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '1234',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),

    // application components
    'components' => array_merge(
        array(
            'user' => array(
                // enable cookie-based authentication
                'allowAutoLogin' => true,
                'loginUrl' => array('login'),
                'authTimeout' => 86400 * 30, // 30 days
                'absoluteAuthTimeout' => 86400 * 30, // 30 days
                'autoRenewCookie' => true,
            ),

            'session' => array(
                'class' => 'CHttpSession',
                'timeout' => 86400 * 30, // 30 days
                'cookieParams' => array(
                    'lifetime' => 86400 * 30, // 30 days
                ),
            ),

            // uncomment the following to enable URLs in path-format
            'request' => array(
                'hostInfo' => 'http://localhost',
                'baseUrl' => '/sales_rep',
            ),

            'urlManager' => array(
                'urlFormat' => 'path',
                'showScriptName' => false,
                'rules' => array(
                    '<controller:\w+>/<id:\d+>' => '<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    'api/login' => 'api/login',
                    'api/validateToken' => 'api/validateToken',
                ),
            ),

            'errorHandler' => array(
                // use 'site/error' action to display errors
                'errorAction' => YII_DEBUG ? null : 'site/error',
            ),

            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    array(
                        'class'  => 'CFileLogRoute',
                        'levels' => 'error, warning, info',
                    ),
                    // uncomment the following to show log messages on web pages
                    /*
                    array(
                        'class' => 'CWebLogRoute',
                    ),
                    */
                ),
            ),

            'ePdf' => array(
                'class' => 'ext.yii-pdf.EYiiPdf',
                'params' => array(
                    'mpdf' => array(
                        'librarySourcePath' => 'application.vendors.mpdf.*',
                        'constants' => array(
                            '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                        ),
                        'class' => 'mpdf', // the literal class filename to be loaded from the vendors folder
                    ),
                    'HTML2PDF' => array(
                        'librarySourcePath' => 'application.vendors.html2pdf.*',
                        'classFile' => 'html2pdf.class.php', // For adding to Yii::$classMap
                    ),
                ),
            ),

            'Smtpmail' => array(
                'class' => 'application.extensions.smtpmail.PHPMailer',
                'Host' => "smtp.gmail.com",
                'Username' => 'noreply.jogsports@gmail.com',
                'Password' => 'Joinourgame9999',
                'Mailer' => 'smtp',
                'Port' => 587,
                'SMTPAuth' => true,
                'SMTPSecure' => 'tls',
            ),
        ),
        $dbConfig
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',

        // QuickBooks OAuth2 + Webhooks configuration
        // Fill in credentials from your Intuit Developer app dashboard.
        'QB_CLIENT_ID'              => 'ABVRht0ENDuIRKuBPe6kbK0bmQCHaZSVFdqf9DFmrf1heOIx3C',
        'QB_CLIENT_SECRET'          => 'uqFZjZghbajdCDErrsXcsSHIMGhr1gIQ8Nc5Bwwq',
        'QB_WEBHOOK_VERIFIER_TOKEN' => 'c0f44127-994c-47e7-a065-cf0c6e4d0814',   // Webhook verifier token (from QB dashboard)
        'QB_REALM_ID'               => '9341456685599232',   // QuickBooks Company ID (realm ID)
        'QB_BASE_URL'               => 'production',
    ),
);
