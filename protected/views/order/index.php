<style>
    .x_content .row {
        padding: 0 0 30px 0;
    }

    .x_panel {
        margin: 50px 0 0 0;
    }

    #ImportForm_excelFile {
        margin-bottom: 10px !important;
    }

    input::file-selector-button {
        background: #337AB7;
        color: #FFF;
        border: none;
        padding: 5px 10px;
        font-size: 12px;
        margin-right: 30px;
    }

    #import-form {
        width: 100%;
        box-shadow: rgb(0 0 0 / 15%) 0px 5px 15px;
        padding: 20px;
        /* min-height: 58vh; */
    }

    #import-form label {
        display: block;
        margin: 5px 0;
        font-size: 14px;
        font-weight: 500;
    }

    .tooltipbtn {
        width: 34px;
        height: 34px;
        background: #00000026;
        border: none;
        color: #858585;
        border-radius: 2px;
    }

    #import-form input {
        padding: 8px 10px;
        margin: 0;
        float: inline-end;
        width: 92%;
        background: #337ab71f;
        border: none;
    }

    #ImportForm_excelFile {
        width: 100% !important;
    }

    #import-form select {
        background: #337ab71f;
        width: 100%;
        padding: 10px;
        border-radius: 3px;
        border: none;
    }

    .type-of-code-div input {
        width: auto !important;
    }

    .type-of-code-div {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        justify-content: flex-start;
    }



    .inner-box {
        width: 65px;
        display: flex;
        align-items: center;
        border: 1px solid #DCDCDCF2;
        border-radius: 10px;
        margin-right: 10px;
        padding: 0px 10px;
        justify-content: space-between;
        cursor: pointer;
    }
    .inner-box:active{
        transform: translateY(5px);
    }

    input[type="submit"] {
        background: #337AB7 !important;
        color: #FFF;
        width: 100% !important;
        margin: 10px 0;
        padding: 7px 10px !important;
    }

    .imobtn {
        background: #337AB7 !important;
        color: #FFF;
        width: 99% !important;
        /* margin: 20px 10px; */
        padding: 7px 10px !important;
        border: none;
    }

    .RightSide #import-form input {
        width: 100%;
    }

    .RightSide #import-form #excelFile {
        margin-bottom: 7px;
    }

    .RightSide #import-form label {
        margin: 10px 0;
    }

    .RightSide #import-form .inner-box label {
        margin: 5px 0px !important;
        cursor: pointer;
    }

    footer {
        height: 100%;
    }

    @media screen and (max-width:1420px) {
        #import-form input {
            width: 90%;
        }
    }

    @media screen and (max-width:520px) {
        .x_title {
            padding: 0 !important;
            margin: 0;
        }

        h2 {
            text-align: center;
        }

        .col-xl-6.col-md-6.col-sm-12 {
            width: 100%;
        }

        #import-form input {

            width: 85%;
        }

        #import-form label {
            margin: 5px 0;
            font-size: 12px;
        }

        .x_content {
            margin: 0;

        }
    }
</style>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <h2>Import Orders</h2>
            <div class="x_title">
            </div>
            <div class="x_content">
                <div class="row">
                    <!-- <div class="col-xl-6 col-md-6 col-sm-12 leftSide">
                    <div class="card">

                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'import-form',
                            'enableAjaxValidation' => false,
                            'htmlOptions' => array('enctype' => 'multipart/form-data'),
                        ));
                        ?>

                        <?php echo $form->errorSummary($model); ?>
                        <label for="start">
                            Upload a File
                        </label>
                        <?php echo CHtml::activeFileField($model, 'excelFile'); ?>
                        <div class="custom-flex">
                            <label for="start">
                                Enter Start column
                            </label>
                            <span class="tooltip">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptext">Tooltip text here</span>
                            </span>
                            <button type="button" class=" tooltipbtn" data-toggle="tooltip" data-placement="top" title="Tooltip on start">
                                <i class="fa fa-info-circle"></i>
                            </button>

                            <?php echo CHtml::textField('start', '', array('required' => 'required')); ?>
                        </div>
                        <div>
                            <label for="start">Enter End column</label>
                            <button type="button" class="  tooltipbtn 
                            " data-toggle="tooltip" data-placement="top" title="Tooltip on end">
                                <i class="fa fa-info-circle"></i>
                            </button>
                            <?php echo CHtml::textField('end', '', array('required' => 'required')); ?>
                        </div>
                        <div>
                            <label for="month">Select Month</label>
                            <?php
                            $monthOptions = array(
                                '' => 'Select Month',
                                'January' => 'January',
                                'February' => 'February',
                                'March' => 'March',
                                'April' => 'April',
                                'May' => 'May',
                                'June' => 'June',
                                'July' => 'July',
                                'August' => 'August',
                                'September' => 'September',
                                'October' => 'October',
                                'November' => 'November',
                                'December' => 'December'
                            );
                            echo CHtml::dropDownList('month', '', $monthOptions, array('required' => 'required'));
                            ?>
                        </div>

                        <div>
                            <label for="year">Select Year</label>
                            <?php
                            // Generate an array of year options from 2003 to the current year
                            $currentYear = date('Y');
                            $startYear = 2003; // Start year
                            $yearOptions = array();
                            for ($year = $startYear; $year <= $currentYear; $year++) {
                                $yearOptions[$year] = $year;
                            }
                            // Display the drop-down list
                            echo CHtml::dropDownList('year', '', $yearOptions, array('required' => 'required'));
                            ?>
                        </div>

                        <label>select type of code</label>
                        <div class="type-of-code-div">
                            <div class="inner-box">
                                <label for="ex">EX</label>
                                <?php echo CHtml::radioButton('code_type', false, array('value' => 'Ex', 'id' => 'ex', 'required' => 'required')); ?>
                            </div>
                            <div class="inner-box">
                                <label for="th">TH</label>
                                <?php echo CHtml::radioButton('code_type', false, array('value' => 'Th', 'id' => 'th')); ?>
                            </div>
                        </div>



                        <div class=" buttons ">
                            <?php echo CHtml::submitButton('Import Data'); ?>
                        </div>

                        <?php $this->endWidget(); ?>

                    </div>
                </div> -->
                    <div class="col-xl-6 col-md-6 col-sm-12 RightSide">
                        <div class="card">
                            <form action="order/Lists" method="post" enctype="multipart/form-data" id="import-form">
                                <div>
                                    <label for="start">
                                        Upload a File
                                    </label>

                                    <input type="file" name="excelFile" id="excelFile" accept=".xls,.xlsx">
                                </div>
                                <div>
                                    <?php  $month = date("F");?>
                                    <label for="month">Select Month</label>
                                    <select class="form-select" name="month" id="months">
                                        <option value="January" <?php if ($month == 'January') echo "selected"; ?>>January</option>
                                        <option value="February" <?php if ($month == 'February') echo "selected"; ?>>February</option>
                                        <option value="March" <?php if ($month == 'March') echo "selected"; ?>>March</option>
                                        <option value="April" <?php if ($month == 'April') echo "selected"; ?>>April</option>
                                        <option value="May" <?php if ($month == 'May') echo "selected"; ?>>May</option>
                                        <option value="June" <?php if ($month == 'June') echo "selected"; ?>>June</option>
                                        <option value="July" <?php if ($month == 'July') echo "selected"; ?>>July</option>
                                        <option value="August" <?php if ($month == 'August') echo "selected"; ?>>August</option>
                                        <option value="September" <?php if ($month == 'September') echo "selected"; ?>>September</option>
                                        <option value="October" <?php if ($month == 'October') echo "selected"; ?>>October</option>
                                        <option value="November" <?php if ($month == 'November') echo "selected"; ?>>November</option>
                                        <option value="December" <?php if ($month == 'December') echo "selected"; ?>>December</option>
                                    </select>
                                </div>                                

                                <div>
                                    <label for="year">Select Year</label>
                                    <?php
                                    // Generate an array of year options from 2003 to the upcoming year
                                    $currentYear = date('Y');
                                    $nextYear = $currentYear + 1; // Upcoming year
                                    $startYear = 2003; // Start year
                                    $yearOptions = array();
                                    
                                    for ($year = $startYear; $year <= $nextYear; $year++) {
                                        $yearOptions[$year] = $year;
                                    }
                                    
                                    // Display the drop-down list
                                    echo CHtml::dropDownList('year', $currentYear, $yearOptions, array('required' => 'required'));
                                    ?>

                                </div>
                                <div>
                                    <label>Select type of code</label>
                                    <div class="type-of-code-div">
                                        <div class="inner-box">
                                            <label for="ex">EX</label>
                                            <?php echo CHtml::radioButton('code_type', false, array('value' => 'Ex', 'id' => 'ex', 'required' => 'required')); ?>
                                        </div>
                                        <div class="inner-box">
                                            <label for="th">TH</label>
                                            <?php echo CHtml::radioButton('code_type', false, array('value' => 'Th', 'id' => 'th')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row buttons ">
                                    <button type="submit" class="imobtn"> Import Data </button>
                                </div>



                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>