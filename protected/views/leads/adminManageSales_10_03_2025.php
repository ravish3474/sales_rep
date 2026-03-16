<style>
    input,
    select,
    textarea {
        border: 1px solid #D9E4EE !important;
        padding: 6px 20px;
        background: #FFFFFF !important;
        color: #444;
        font-weight: 400;
        width: 100%;
    }

    .select2.select2-container.select2-container--default {
        min-height: 30px;
        width: 100% !important;
    }

    .select2-container .select2-selection--multiple .select2-selection__rendered {
        position: absolute;
        left: 10px;
        top: 15px;
    }

    #select2-0lex-container {
        border: 1px solid #DDDDDD !important;
        background: #F9F9F9 !important;
        padding: 1vw;
        border-radius: 4px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__clear span {
        padding: 2px 5px;
        top: -4px;
        border-radius: 0 4px 4px 0;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        border: 1px solid #D9E4EE;
        background: #ECF3F9;
        font-size: 14px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;

    }
</style>
<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12  ">
            <div class="x_panel">
                <div class="adminLeadsPage">
                    <div class="pageHeader">
                        <h5 class="xlSize primary">Assign Sales Reps to Regions</h5>
                        <p class="sSize">Enable/Disable Automatic Lead Distribution</p>
                        <div class="alert">
                            <figure><img src="../images/icons/info.png" alt="" class="iconImg"></figure> Automation is enabled. Leads will be assigned automatically based on the regions mapped to each sales rep.
                        </div>
                    </div>
                    <div class="countryLeads">
                        <div class="grid2">
                            <div class="leadsItems">
                                <div class="tableHeader d-flex between">
                                    <h6>Canada</h6>
                                    <button class="d-flex gap2" data-toggle="modal" data-target="#addSalesRepModalCanada" onclick="addSalesRepcounty('canada')">
                                        <figure><img src="../images/icons/addGreen.png" alt="" class="iconImg"></figure> Add Sales Rep
                                    </button>
                                </div>

                                <div class="leadsTableMain">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> </th>
                                                    <th>Sales Rep</th>
                                                    <th>State</th>
                                                    <th>Priority</th>
                                                    <th>Lead Capacity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="sortable-tbody" class="sortable-tbody">
                                                <?php foreach ($adminSales as $sales) { 
                                                  
                                                    //   echo "<pre>";
                                                    //   print_r($sales); die;
                                                    ?>
                                                    <?php if( $sales['country_name'] == 'canada' ){ ?>                                                        
                                                        <tr>
                                                            <td colspan="6" class="stateName"><?php echo $sales['state_name']; ?></td>
                                                        </tr>

                                                        <?php foreach ($sales['data'] as $data) {  
                                                             
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <figure><img src="../images/icons/dragTable.png" alt="" class="iconImg"></figure>                                                                    
                                                                </td>
                                                                <td><?php echo $data['sales_name']; ?></td>

                                                                <td>
                                                                    <select class="form-select assignedTo text-left" aria-label="Default select example" 
                                                                    onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'state_name' ,this)"
                                                                    >                                                                
                                                                    <?php 
                                                                        $country_name = $sales['country_name'];
                                                                        $sql_cust = "SELECT * FROM tbl_country WHERE country_name LIKE '$country_name'  ORDER BY state_name ASC; ";
                                                                        $states = Yii::app()->db->createCommand($sql_cust)->queryAll();                                                                                                                                                
                                                                        foreach ($states as $sta_nmae) {
                                                                            $state = $sta_nmae['state_name'];
                                                                            $selected = ($state == $sales['state_name']) ? 'selected' : '';
                                                                            echo "<option value=\"$state\" $selected>$state</option>";
                                                                        }
                                                                    ?>
                                                                    </select>
                                                                </td>
                                                                <td>                                                        
                                                                    <select class="form-select assignedTo text-left" aria-label="Default select example" id="lead_canada" data-sales-id="<?php echo $data['lead_sales_id']; ?>" onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'sales_priority')">
                                                                        <?php                                                                     
                                                                            $sales_priority = [
                                                                                1,2,3,4,5,6,7,8,9,10
                                                                            ];
                                                                            foreach ($sales_priority as $priority) {
                                                                                $selected = ($priority == $data['sales_priority']) ? 'selected' : '';
                                                                                echo "<option value=\"$priority\" $selected>$priority</option>";
                                                                            }
                                                                        ?>                                                                
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-select assignedTo text-left" aria-label="Default select example"
                                                                     onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'lead_capacity')"> 
                                                                        <?php                                                                     
                                                                            $lead_capacity = [
                                                                                1,2,3,4,5,6,7,8,9,10
                                                                            ];
                                                                            foreach ($lead_capacity as $capacity) {
                                                                                $selected = ($capacity == $data['lead_capacity']) ? 'selected' : '';
                                                                                echo "<option value=\"$capacity\" $selected>$capacity</option>";
                                                                            }
                                                                        ?>                                                                    
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <div class="actionBtns">
                                                                        <button><img src="../images/icons/editBlue.png" alt="" data-toggle="modal" data-target="#editDetailsModal" onclick="editSalesRepcounty(<?php echo $data['lead_sales_id']; ?>,'<?php echo $data['country_name']; ?>','<?php echo $data['lead_capacity']; ?>','<?php echo $sales['state_name']; ?>','<?php echo $data['sales_priority']; ?>')" ></button>
                                                                        
                                                                        <button class="delete_sale_leads" type="button" data-id_lead ="<?php echo $data['lead_sales_id']; ?>"><img src="../images/icons/deleteBlue.png" alt=""></button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>                                                
                                                <?php } ?>                                                
                                            </tbody>                                            
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="leadsItems">
                                <div class="tableHeader d-flex between">
                                    <h6>Europe</h6>
                                    <button class="d-flex gap2" data-toggle="modal" data-target="#addSalesRepModalEURO" onclick="addSalesRepcounty('Europe')">
                                        <figure><img src="../images/icons/addGreen.png" alt="" class="iconImg"></figure> Add Sales Rep
                                    </button>
                                </div>
                                <div class="leadsTableMain">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> </th>
                                                    <th>Sales Rep</th>
                                                    <th>State</th>
                                                    <th>Priority</th>
                                                    <th>Lead Capacity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="sortable-tbody" class="sortable-tbody">
                                                <?php foreach ($adminSales as $sales) { ?>
                                                    <?php if( $sales['country_name'] == 'Europe' ){ ?>                                                        
                                                        <tr>
                                                            <td colspan="6" class="stateName"><?php echo $sales['state_name']; ?></td>
                                                        </tr>
                                                        <?php foreach ($sales['data'] as $data) {  ?>
                                                            <tr>
                                                                <td>
                                                                    <button class="bg-none border-none">
                                                                        <figure><img src="../images/icons/dragTable.png" alt="" class="iconImg"></figure>
                                                                    </button>
                                                                </td>
                                                                <td><?php echo $data['sales_name']; ?></td>
                                                                <td>
                                                                    <select class="form-select assignedTo text-left" aria-label="Default select example">                                                                
                                                                    <?php 
                                                                        $country_name = $sales['country_name'];
                                                                        $sql_cust = "SELECT * FROM tbl_country WHERE country_name LIKE '$country_name'  ORDER BY state_name ASC; ";
                                                                        $states = Yii::app()->db->createCommand($sql_cust)->queryAll(); 
                                                                        foreach ($states as $sta_nmae) {
                                                                            $state = $sta_nmae['state_name'];
                                                                            $selected = ($state == $sales['state_name']) ? 'selected' : '';
                                                                            echo "<option value=\"$state\" $selected>$state</option>";
                                                                        }
                                                                    ?>
                                                                    </select>
                                                                </td>
                                                                <td>                                                        
                                                                    <select class="form-select assignedTo text-left" aria-label="Default select example" id="lead_Europe"  data-sales-id="<?php echo $data['lead_sales_id']; ?>" onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'sales_priority')">
                                                                        <?php                                                                     
                                                                            $sales_priority = [
                                                                                1,2,3,4,5,6,7,8,9,10
                                                                            ];
                                                                            foreach ($sales_priority as $priority) {
                                                                                $selected = ($priority == $data['sales_priority']) ? 'selected' : '';
                                                                                echo "<option value=\"$priority\" $selected>$priority</option>";
                                                                            }
                                                                        ?>                                                                
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-select assignedTo text-left" aria-label="Default select example"
                                                                    onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'lead_capacity')"
                                                                    >
                                                                        <?php                                                                     
                                                                            $lead_capacity = [
                                                                                1,2,3,4,5,6,7,8,9,10
                                                                            ];
                                                                            foreach ($lead_capacity as $capacity) {
                                                                                $selected = ($capacity == $data['lead_capacity']) ? 'selected' : '';
                                                                                echo "<option value=\"$capacity\" $selected>$capacity</option>";
                                                                            }
                                                                        ?>                                                                    
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <div class="actionBtns">

                                                                        <button><img src="../images/icons/editBlue.png" alt="" data-toggle="modal" data-target="#editDetailsModal" onclick="editSalesRepcounty(<?php echo $data['lead_sales_id']; ?>,'<?php echo $data['country_name']; ?>','<?php echo $data['lead_capacity']; ?>','<?php echo $sales['state_name']; ?>','<?php echo $data['sales_priority']; ?>')"></button>

                                                                        <button class="delete_sale_leads" type="button" data-id_lead ="<?php echo $data['lead_sales_id']; ?>"><img src="../images/icons/deleteBlue.png" alt=""></button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>                                                
                                                <?php } ?>
                                            </tbody>                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="leadsItems">
                                <div class="tableHeader d-flex between">
                                    <h6>USA</h6>
                                    <button class="d-flex gap2" data-toggle="modal" data-target="#addSalesRepModalUSA" onclick="addSalesRepcounty('USA')">
                                        <figure><img src="../images/icons/addGreen.png" alt="" class="iconImg"></figure> Add Sales Rep
                                    </button>
                                </div>
                                <div class="leadsTableMain">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> </th>
                                                    <th>Sales Rep</th>
                                                    <th>State</th>
                                                    <th>Priority</th>
                                                    <th>Lead Capacity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="sortable-tbody" class="sortable-tbody">
                                                <?php foreach ($adminSales as $sales) { ?>
                                                    <?php if( $sales['country_name'] == 'USA' ){ ?>                                                        
                                                        <tr>
                                                            <td colspan="6" class="stateName"><?php echo $sales['state_name']; ?></td>
                                                        </tr>
                                                        <?php foreach ($sales['data'] as $data) {  ?>
                                                            <tr>
                                                                <td>
                                                                    <figure><img src="../images/icons/dragTable.png" alt="" class="iconImg"></figure>
                                                                    <!-- <button class="bg-none border-none">
                                                                    </button> -->
                                                                </td>
                                                                <td><?php echo $data['sales_name']; ?></td>
                                                                <td>
                                                                    <select class="form-select assignedTo text-left" aria-label="Default select example">                                                                
                                                                    <?php 
                                                                        $country_name = $sales['country_name'];
                                                                        $sql_cust = "SELECT * FROM tbl_country WHERE country_name LIKE '$country_name'  ORDER BY state_name ASC; ";
                                                                        $states = Yii::app()->db->createCommand($sql_cust)->queryAll(); 
                                                                        foreach ($states as $sta_nmae) {
                                                                            $state = $sta_nmae['state_name'];
                                                                            $selected = ($state == $sales['state_name']) ? 'selected' : '';
                                                                            echo "<option value=\"$state\" $selected>$state</option>";
                                                                        }
                                                                    ?>
                                                                    </select>
                                                                </td>
                                                                <td>                                                        
                                                                    <select class="form-select assignedTo text-left" aria-label="Default select example" id="lead_USA" data-sales-id="<?php echo $data['lead_sales_id']; ?>" onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'sales_priority')">
                                                                        <?php                                                                     
                                                                            $sales_priority = [
                                                                                1,2,3,4,5,6,7,8,9,10
                                                                            ];
                                                                            foreach ($sales_priority as $priority) {
                                                                                $selected = ($priority == $data['sales_priority']) ? 'selected' : '';
                                                                                echo "<option value=\"$priority\" $selected>$priority</option>";
                                                                            }
                                                                        ?>                                                                
                                                                    </select> 
                                                                </td>
                                                                <td>
                                                                    <select class="form-select assignedTo text-left" aria-label="Default select example" onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'lead_capacity')">
                                                                        <?php                                                                     
                                                                            $lead_capacity = [
                                                                                1,2,3,4,5,6,7,8,9,10
                                                                            ];
                                                                            foreach ($lead_capacity as $capacity) {
                                                                                $selected = ($capacity == $data['lead_capacity']) ? 'selected' : '';
                                                                                echo "<option value=\"$capacity\" $selected>$capacity</option>";
                                                                            }
                                                                        ?>   
                                                                        
                                                                      
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <div class="actionBtns">

                                                                        <button><img src="../images/icons/editBlue.png" alt="" data-toggle="modal" data-target="#editDetailsModal" onclick="editSalesRepcounty(<?php echo $data['lead_sales_id']; ?>,'<?php echo $data['country_name']; ?>','<?php echo $data['lead_capacity']; ?>','<?php echo $sales['state_name']; ?>','<?php echo $data['sales_priority']; ?>')"></button>
                                                                        <button class="delete_sale_leads" type="button" data-id_lead ="<?php echo $data['lead_sales_id']; ?>"><img src="../images/icons/deleteBlue.png" alt=""></button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>                                                
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="leadsItems">
                                <div class="tableHeader d-flex between">
                                    <h6>Asia-Pacific</h6>
                                    <button class="d-flex gap2" data-toggle="modal" data-target="#addSalesRepModalAsia" onclick="addSalesRepcounty('Asia-Pacific')">
                                        <figure><img src="../images/icons/addGreen.png" alt="" class="iconImg"></figure> Add Sales Rep
                                    </button>
                                </div>
                                <div class="leadsTableMain">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> </th>
                                                    <th>Sales Rep</th>
                                                    <th>State</th>
                                                    <th>Priority</th>
                                                    <th>Lead Capacity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="sortable-tbody" class="sortable-tbody">
                                                <?php foreach ($adminSales as $sales) { ?>
                                                    <?php if( $sales['country_name'] == 'Asia-Pacific' ){ ?>                                                        
                                                        <tr>
                                                            <td colspan="6" class="stateName"><?php echo $sales['state_name']; ?></td>
                                                        </tr>
                                                        <?php foreach ($sales['data'] as $data) {  ?>
                                                            <tr>
                                                                <td>
                                                                    <figure><img src="../images/icons/dragTable.png" alt="" class="iconImg"></figure>
                                                                    <!-- <button class="bg-none border-none">
                                                                    </button> -->
                                                                </td>
                                                                <td><?php echo $data['sales_name']; ?></td>
                                                                <td>
                                                                    <select class="form-select assignedTo text-left" aria-label="Default select example">                                                                
                                                                    <?php 
                                                                        $country_name = $sales['country_name'];
                                                                        $sql_cust = "SELECT * FROM tbl_country WHERE country_name LIKE '$country_name'  ORDER BY state_name ASC; ";
                                                                        $states = Yii::app()->db->createCommand($sql_cust)->queryAll(); 
                                                                        foreach ($states as $sta_nmae) {
                                                                            $state = $sta_nmae['state_name'];
                                                                            $selected = ($state == $sales['state_name']) ? 'selected' : '';
                                                                            echo "<option value=\"$state\" $selected>$state</option>";
                                                                        }
                                                                    ?>
                                                                    </select>
                                                                </td>
                                                                <td>                                                        
                                                                    <select class="form-select assignedTo text-left" aria-label="Default select example" id="lead_Asia"  data-sales-id="<?php echo $data['lead_sales_id']; ?>" onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'sales_priority')">
                                                                        <?php                                                                     
                                                                            $sales_priority = [
                                                                                1,2,3,4,5,6,7,8,9,10
                                                                            ];
                                                                            foreach ($sales_priority as $priority) {
                                                                                $selected = ($priority == $data['sales_priority']) ? 'selected' : '';
                                                                                echo "<option value=\"$priority\" $selected>$priority</option>";
                                                                            }
                                                                        ?>                                                                
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-select assignedTo text-left" aria-label="Default select example"
                                                                    onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'lead_capacity')"
                                                                    >
                                                                        <?php                                                                     
                                                                            $lead_capacity = [
                                                                                1,2,3,4,5,6,7,8,9,10
                                                                            ];
                                                                            foreach ($lead_capacity as $capacity) {
                                                                                $selected = ($capacity == $data['lead_capacity']) ? 'selected' : '';
                                                                                echo "<option value=\"$capacity\" $selected>$capacity</option>";
                                                                            }
                                                                        ?>                                                                    
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <div class="actionBtns">

                                                                        <button><img src="../images/icons/editBlue.png" alt="" data-toggle="modal" data-target="#editDetailsModal"></button>
                                                                        <button><img src="../images/icons/deleteBlue.png" alt=""></button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>                                                
                                                <?php } ?>
                                            </tbody>                                           
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="leadsItems">
                                <div class="tableHeader d-flex between">
                                    <h6>Others</h6>
                                    <button class="d-flex gap2" data-toggle="modal" data-target="#addSalesRepModalOthers" onclick="addSalesRepcounty('Others')">
                                        <figure><img src="../images/icons/addGreen.png" alt="" class="iconImg"></figure> Add Sales Rep
                                    </button>
                                </div>
                                <div class="leadsTableMain">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> </th>
                                                    <th>Sales Rep</th>
                                                    <th>State</th>
                                                    <th>Priority</th>
                                                    <th>Lead Capacity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="sortable-tbody" class="sortable-tbody">
                                                <?php foreach ($adminSales as $sales) { ?>
                                                    <?php if( $sales['country_name'] == 'Others' ){ ?>                                                        
                                                        <tr>
                                                            <td colspan="6" class="stateName"><?php echo $sales['state_name']; ?></td>
                                                        </tr>
                                                        <?php foreach ($sales['data'] as $data) {  ?>
                                                            <tr>
                                                                <td>
                                                                    <button class="bg-none border-none">
                                                                        <figure><img src="../images/icons/dragTable.png" alt="" class="iconImg"></figure>
                                                                    </button>
                                                                </td>
                                                                <td><?php echo $data['sales_name']; ?></td>
                                                                <td>
                                                                    <select class="form-select assignedTo text-left" aria-label="Default select example">                                                                
                                                                    <?php 
                                                                        $country_name = $sales['country_name'];
                                                                        $sql_cust = "SELECT * FROM tbl_country WHERE country_name LIKE '$country_name'  ORDER BY state_name ASC; ";
                                                                        $states = Yii::app()->db->createCommand($sql_cust)->queryAll(); 
                                                                        foreach ($states as $sta_nmae) {
                                                                            $state = $sta_nmae['state_name'];
                                                                            $selected = ($state == $sales['state_name']) ? 'selected' : '';
                                                                            echo "<option value=\"$state\" $selected>$state</option>";
                                                                        }
                                                                    ?>
                                                                    </select>
                                                                </td>
                                                                <td>                                                        
                                                                    <select class="form-select assignedTo text-left" aria-label="Default select example" id="lead_Others" data-sales-id="<?php echo $data['lead_sales_id']; ?>" onchange="updateSalesPriority(this.value, <?php echo $data['lead_sales_id']; ?>,'sales_priority')">
                                                                        <?php                                                                     
                                                                            $sales_priority = [
                                                                                1,2,3,4,5,6,7,8,9,10
                                                                            ];
                                                                            foreach ($sales_priority as $priority) {
                                                                                $selected = ($priority == $data['sales_priority']) ? 'selected' : '';
                                                                                echo "<option value=\"$priority\" $selected>$priority</option>";
                                                                            }
                                                                        ?>                                                                
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-select assignedTo text-left" aria-label="Default select example">
                                                                        <?php                                                                     
                                                                            $lead_capacity = [
                                                                                1,2,3,4,5,6,7,8,9,10
                                                                            ];
                                                                            foreach ($lead_capacity as $capacity) {
                                                                                $selected = ($capacity == $data['lead_capacity']) ? 'selected' : '';
                                                                                echo "<option value=\"$capacity\" $selected>$capacity</option>";
                                                                            }
                                                                        ?>                                                                    
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <div class="actionBtns">

                                                                        <button><img src="../images/icons/editBlue.png" alt="" data-toggle="modal" data-target="#editDetailsModal"></button>
                                                                        <button class="delete_data"><img src="../images/icons/deleteBlue.png" alt=""></button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>                                                
                                                <?php } ?>
                                            </tbody>                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>


<!-- Canada  -->
<div class="modal fade smallModal" id="addSalesRepModalCanada" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- modal header  -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title  ">Add Sales Rep</h4>
            </div>
            <form action="<?php echo Yii::app()->createUrl('leads/createSales'); ?>" method="post">
                <div class="modal-body">
                    <div class="grid">
                        <div class="form-group">
                            <label for="TSales Rep" class="blackLabel">Sales Rep</label>
                            <select class="js-select2" multiple="multiple" name="sales_name[]">
                            <?php 
                                $user = User::model()->findAll("user_group_id = 2");
                                foreach ($user as $key=> $value){	
                            ?>
                                <option value="<?php echo $value['fullname']; ?>" ><?php echo $value['fullname']; ?></option>
                            <?php } ?>                            
                            </select>
                        </div>
                        <input type="hidden" class="form-control" id="countrycanada" name="country_name" value="">
                        <div>
                            <span class="btn btn-success addNewState" >+</span>
                            <input type="text" name="stateadd" style="display: none;" class="instate  instatecanada">
                            <span class="btn btn-success instatesave" style="display: none;" onclick="addState('canada')">save</span>
                        </div>
                        <div class="form-group stateoption">                           
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- ERUO  -->
<div class="modal fade smallModal" id="addSalesRepModalEURO" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- modal header  -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Sales Rep</h4>
            </div>
            <form action="<?php echo Yii::app()->createUrl('leads/createSales'); ?>" method="post">
                <div class="modal-body">
                    <div class="grid">
                        <div class="form-group">
                            <label for="TSales Rep" class="blackLabel">Sales Rep</label>
                            <select class="js-select2" multiple="multiple" name="sales_name[]">
                            <?php 
                                $user = User::model()->findAll("user_group_id = 2");
                                foreach ($user as $key=> $value){	
                            ?>
                                <option value="<?php echo $value['fullname']; ?>" ><?php echo $value['fullname']; ?></option>
                            <?php } ?>                            
                            </select>
                        </div>
                        <input type="text" class="form-control" id="countryEurope" name="country_name" value="">
                        <div>
                            <span class="btn btn-success addNewState" >+</span>
                            <input type="text" name="stateadd" style="display: none;" class="instate  instateEurope">
                            <span class="btn btn-success instatesave" style="display: none;" onclick="addState('Europe')">save</span>
                        </div>
                        <div class="form-group stateoption">                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- USA  -->
<div class="modal fade smallModal" id="addSalesRepModalUSA" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- modal header  -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title  ">Add Sales Rep</h4>
            </div>
            <form action="<?php echo Yii::app()->createUrl('leads/createSales'); ?>" method="post">
                <div class="modal-body">
                    <div class="grid">
                        <div class="form-group">
                            <label for="TSales Rep" class="blackLabel">Sales Rep</label>
                            <select class="js-select2" multiple="multiple" name="sales_name[]">
                            <?php 
                                $user = User::model()->findAll("user_group_id = 2");
                                foreach ($user as $key=> $value){	
                            ?>
                                <option value="<?php echo $value['fullname']; ?>" ><?php echo $value['fullname']; ?></option>
                            <?php } ?>                            
                            </select>
                        </div>
                        <input type="text" class="form-control" id="countryUSA" name="country_name" value="">
                        <div>
                            <span class="btn btn-success addNewState" >+</span>
                            <input type="text" name="stateadd" style="display: none;" class="instate instateUSA">
                            <span class="btn btn-success instatesave" style="display: none;" onclick="addState('USA')">save</span>
                        </div>
                        <div class="form-group stateoption">                                                        
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- ASia  -->
<div class="modal fade smallModal" id="addSalesRepModalAsia" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- modal header  -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title  ">Add Sales Rep</h4>
            </div>
            <form action="<?php echo Yii::app()->createUrl('leads/createSales'); ?>" method="post">
                <div class="modal-body">
                    <div class="grid">
                        <div class="form-group">
                            <label for="TSales Rep" class="blackLabel">Sales Rep</label>
                            <select class="js-select2" multiple="multiple" name="sales_name[]">
                            <?php 
                                $user = User::model()->findAll("user_group_id = 2");
                                foreach ($user as $key=> $value){	
                            ?>
                                <option value="<?php echo $value['fullname']; ?>" ><?php echo $value['fullname']; ?></option>
                            <?php } ?>                            
                            </select>
                        </div>
                        <input type="text" class="form-control" id="countryAsia-Pacific" name="country_name" value="">
                        <div>
                            <span class="btn btn-success addNewState" >+</span>
                            <input type="text" name="stateadd" style="display: none;" class="instate instateAsia-Pacific">
                            <span class="btn btn-success instatesave" style="display: none;" onclick="addState('Asia-Pacific')">save</span>
                        </div>
                        <div class="form-group stateoption">                          
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Others  -->
<div class="modal fade smallModal" id="addSalesRepModalOthers" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- modal header  -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title  ">Add Sales Rep</h4>
            </div>
            <form action="<?php echo Yii::app()->createUrl('leads/createSales'); ?>" method="post">
                <div class="modal-body">
                    <div class="grid">
                        <div class="form-group">
                            <label for="TSales Rep" class="blackLabel">Sales Rep</label>
                            <select class="js-select2" multiple="multiple" name="sales_name[]">
                            <?php 
                                $user = User::model()->findAll("user_group_id = 2");
                                foreach ($user as $key=> $value){	
                            ?>
                                <option value="<?php echo $value['fullname']; ?>" ><?php echo $value['fullname']; ?></option>
                            <?php } ?>                            
                            </select>
                        </div>
                        <input type="text" class="form-control" id="countryOthers" name="country_name" value="">
                        <div>
                            <span class="btn btn-success addNewState" >+</span>
                            <input type="text" name="stateadd" style="display: none;" class="instate instateOthers">
                            <span class="btn btn-success instatesave" style="display: none;" onclick="addState('Others')">save</span>
                        </div>
                        <div class="form-group stateoption">                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- editDetailsModal  -->
<div class="modal fade smallModal" id="editDetailsModal" role="dialog">
    <div class="modal-dialog  ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- modal header  -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Details</h4>
            </div>
         

            <div class="modal-body">
             
                <div class="grid2">
                    <div class="form-group">
                        <label for="action_ype" class="blackLabel">Country</label>
                        <select class="form-select text-left" id="countrySelect" name="country" onchange="updateStates()">
                            <option value="Europe">Europe</option>
                            <option value="USA">USA</option>
                            <option value="canada">canada</option>
                            <option value="Asia-Pacific">Asia-Pacific</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <!-- <label for="action_ype" class="blackLabel">State</label>     -->
                        <div id="stateSelect">

                        </div>                    
                        <!-- <select id="stateSelect" class="form-select text-left">
                            <option value="">Select State</option>
                        </select> -->
                    </div>
                    <div class="form-group">
                        <label for="action_ype" class="blackLabel">Capacity</label>
                        <select class="form-select text-left" aria-label="Default select example" name="capacity" id="capacitySelect">
                            <option value="">Select Priority</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="action_ype" class="blackLabel">Priority</label>
                        <select class="form-select text-left" aria-label="Default select example" name="salesPriority" id="salesPrioritySelect">
                            <option value="">Select Priority</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>

                  <input type="hidden" name="sales_id" id="sales_id" value="">
                </div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn greenBtn Editform"  >Save</button>
            </div>
         
        </div>

    </div>
</div>
<!-- editDetailsModal  -->

<script>
    $(".js-select2").select2({
        closeOnSelect: false,
        placeholder: "Assigned to..",
        allowHtml: true,
        allowClear: true,
        tags: true
    });

    function iformat(icon, badge, ) {
        var originalOption = icon.element;
        var originalOptionBadge = $(originalOption).data('badge');

        return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '<span class="badge">' + originalOptionBadge + '</span></span>');
    }
</script>

<script>
$(document).ready(function() {
    $(".sortable-tbody").each(function() {
        $(this).sortable({
            update: function(event, ui) {
                var newOrder = [];
                var currentState = null;
                var priorityCounter = 1;
                var table = $(this); // Target the current table's tbody

                table.find("tr").each(function() {
                    var $row = $(this);

                    // Check if the row is a state header
                    if ($row.hasClass("stateName") || $row.find(".stateName").length) {
                        currentState = $row.text().trim(); // Get the state name
                        priorityCounter = 1; // Reset priority for the new state
                    } else {
                        var salesId = $row.find('select[id^="lead_"]').attr('data-sales-id');

                        if (salesId) {
                            newOrder.push({
                                sales_id: salesId,
                                new_priority: priorityCounter,
                                new_state_name: currentState // Assign detected state name
                            });
                            priorityCounter++;
                        }
                    }
                });

                console.log(newOrder); // Debugging: Verify state names and priorities

                // Send AJAX request to update priorities and state_name
                $.ajax({
                    url: 'updatePriorty',
                    method: 'POST',
                    data: { new_order: newOrder },
                    success: function(response) {
                        console.log('Priorities and states updated successfully');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating:', error);
                    }
                });
            }
        });
    });
});




function updateSalesPriority(value ,id, filedName ,ele=false){        


$.ajax({
    type: 'POST',
    url: 'updatePriorty', // specify the URL to handle the update
    data: {
        lead_id: id,
        value: value,
        filedName: filedName                 
    },
    success: function(response) {
        // Handle success response if needed
        
    },
    error: function(xhr, status, error) {
        // Handle errors if any
        console.error(xhr.responseText);
    }
});

}
</script>

<script>
 

       
    $(".addNewState").click(function(){
        $('.instate').show();
        $('.instatesave').show();        
    });

    function addState(countryName){
        var stateName =  $('.instate'+countryName+'').val(); 
        var countryName =  $('#country'+countryName+'').val(); 
        alert(stateName);
        alert(countryName);
        $.ajax({
            type: 'POST',
            url: 'addStateValue', // specify the URL to handle the update
            data: {
                stateName: stateName,                                
                countryName: countryName,                                
            },
            success: function(response) {                               
                $('.stateoption').html(response);
                $('.instate').val('');
            },
            error: function(xhr, status, error) {
                // Handle errors if any
                console.error(xhr.responseText);
            }
        });      
    }

    
    function addSalesRepcounty(countryName) {   
        $('#country'+countryName+'').val(countryName); 

        $.ajax({
            type: 'POST',
            url: 'getCountyValue', // specify the URL to handle the update
            data: {
                countryName: countryName,                                
            },
            success: function(response) {                               
                $('.stateoption').html(response);
            },
            error: function(xhr, status, error) {
                // Handle errors if any
                console.error(xhr.responseText);
            }
        });
    }   

    function editSalesRepcounty(id, country, lead_capacity, state, sales_priority) {
        let countrySelect = document.getElementById("countrySelect");
        let stateSelect = document.getElementById("stateSelect");
        let capacitySelect = document.getElementById("capacitySelect");
        let salesPrioritySelect = document.getElementById("salesPrioritySelect");
         console.log("state"+state);
        if (countrySelect) {
            countrySelect.value = country; // Set country
            updateStates(state); // Update states dropdown based on country
        }

        if (capacitySelect) {
            capacitySelect.value = lead_capacity; // Set Capacity
        }

        if (salesPrioritySelect) {
            salesPrioritySelect.value = sales_priority; // Set Sales Priority
        }

        $('#sales_id').val(id);   


    }

    function updateStates(selectedState = "") {
        let country = document.getElementById("countrySelect").value; // Get selected country

        $.ajax({
             type:"POST",
             url: 'getCountyValue',
             data: {countryName: country , state:selectedState},
            success: function(response) {
                $('#stateSelect').html(response);
             },
             error: function(xhr ,status, error){
                    console.log('error');
             }
        });

   
    }

    $('.Editform').click(function(){
        var country = $('#countrySelect').val();
        var state = $('#editDetailsModal .assignedTo').val();
        var capacity = $('#capacitySelect').val();
        var salesPriority = $('#salesPrioritySelect').val();
        var sales_id = $('#sales_id').val();
        var ele = $(this).closest('tr');
        // console.warn("state..." +state);
        // return false ; 

        $.ajax({
            type: 'POST',
            url: 'updateSales', // specify the URL to handle the update
            data: {
                country: country,
                state: state,
                capacity: capacity,
                salesPriority: salesPriority,
                sales_id: sales_id
            },
            success: function(response) {
                console.warn("response..." +response); 
                $('#editDetailsModal').modal('hide');


            },
            error: function(xhr, status, error) {
                console.error('Error updating:', error);
                Swal.fire({
                    title: 'Something went wrong',
                    icon: 'warning',
                    confirmButtonText: 'Got it!'
                });
            }
        });
    });

    $('.delete_sale_leads').click(function(){
        let id = $(this).data('id_lead');
        let ele = $(this).closest('tr');
     
        Swal.fire({
        title: 'Are you sure?',
        text: 'To Delete The Sales Rep!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) { 
        $.ajax({
            method:"POST",
            url: 'deleteSales', 
            data: {id: id}, 
            success: function(response) {
                Swal.fire({
                    title: 'Admin Leads Deleted Successfully',
                    icon: 'success',
                    confirmButtonText: 'Got it!'
                });
                ele.remove();
            },
            error:function(xhr, status, error){
                console.error('Error updating:', error);
            }
        })
    }
  })
                
     
    });
    
</script>