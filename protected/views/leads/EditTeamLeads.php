
<?php 
if(!empty($sales)){
 

    ?>

<form id="EditForm" action="<?php echo Yii::app()->createUrl('leads/updateLeadQuery'); ?>"  method="post">
<div class="modal-body">
<div class="grid2">
    <div class="form-group">
        <label for="Team-Association-Company" class="blackLabel">Team / Association / Company</label>
        <input type="text" class="form-control"  name="company_name" value="<?php  echo $sales['TAC_name']?>"  id="Team-Association-Company" placeholder="Enter company name"  >
    </div>

    <div class="form-group ">
        <label for="pro_name" class="blackLabel">Product</label>
        <?php
            if($sales['lead_type'] ==2){
                ?>
                                    
                    <input type="text"  name="pro_name"  value="<?php echo$sales['pro_name'] ?>" class="form-control"  placeholder="Product Name" >
             
               <?

            }else{
               ?>
                    <select class=" form-select assignedTo text-left" name="pro_name" aria-label="Default select example" required>
                                <option value="">Select Product  </option>
                                <?php 
                                    foreach($product as $key=>$value){
                                        ?> 
                                            <option value="<?php echo $value['prod_id'] ?>"  
                                            <?php 
                                                    if($sales['pro_name'] == $value['prod_id']){
                                                        echo 'selected' ; 
                                                    } 
                                            ?>
                                            
                                            > <?php echo $value['prod_name'] ?> </option>
                                        <?php
                                    }
                                ?>
                    </select>
               <?
            }
        ?>
     
    </div>
    <div class="form-group">
        <label for="Name" class="blackLabel">Name</label>
        <input type="text"  name="name"  value="<?php echo $sales['name'] ?>" class="form-control" id="Name" placeholder="Enter Name" required>
    </div>
    <div class="form-group">
        <label for="Name" class="blackLabel">Last Name</label>
        <input type="text"  name="l_name" value="<?php echo $sales['last_name']?>" class="form-control" id="last_name" placeholder="Enter Name">
    </div>
    <div class="form-group">
        <label for="PNumber" class="blackLabel">Phone Number</label>
        <input type="number" name="phone_number" class="form-control" value="<?php echo $sales['phone_no'] ?>" id="PNumber" placeholder="Enter Number">
    </div>
    <div class="form-group">
        <label for="email" class="blackLabel">Email</label>
        <input type="email" name="email"  value="<?php echo $sales['email'] ?>" class="form-control" id="Name" placeholder="Enter Email">
    </div>

    <?php 
    if($sales['lead_type'] ==2){
        ?>
      
        <div class="form-group">
            <label for="country_name" class="blackLabel">Country</label>
            <input type="text"  name="country"  value="<?=$sales['country_name']?>" class="form-control"  placeholder="Country Name" required>
         </div>

         <div class="form-group">
            <label for="country_name" class="blackLabel">State</label>
            <input type="text"  name="TblLeads[state_name]"  value="<?=$sales['state_name']?>" class="form-control"  placeholder="State Name" required>
         </div>

       <?

    }else{
    ?>
        
            <div class="form-group">
                <label for="country_name" class="blackLabel">Country</label>
                <select class="form-select assignedTo text-left country_dropdown" name="country" aria-label="Default select example">
                        <option value="">Select Country</option> 
                            <?php 
                                foreach($countryName as $country){
                                    
                                    ?>
                                        <option value="<?php echo  $country['country_name']?>" 
                                          <?php 
                                              if($sales['country_name'] == $country['country_name']){
                                                   echo 'selected';
                                              }
                                          ?>
                                        
                                        > <?php echo $country['country_name'] ?></option> 
                                    <?
        
                                }
                            ?>
        
                </select>
            </div> 
        
            <div class="form-group get_city_state">
                <label for="state_name" class="blackLabel">State</label>
                <select class="form-select assignedTo text-left state_dropdown" name="state" aria-label="Default select example">
                    <option value="">Select State</option>
                </select>
            </div>

            <?
    }
    ?>    
               
    <div class="form-group">
            <label for="city" class="blackLabel">City</label>
            <input type="text" class="form-control" id="city"  value="<?php echo $sales['city'] ?>"  name="city" placeholder="Enter City Name">
        </div>
    <div class="form-group">
        <label for="QTY" class="blackLabel">QTY</label>
        <input type="number" class="form-control" id="QTY" value="<?php echo $sales['qty'] ?>" name="qty" placeholder="Enter QTY">
    </div>
    <div class="form-group">
        <label for="DueDate" class="blackLabel">Due Date</label>
        <input type="date" class="form-control" id="DueDate" name="due_date" value="<?php echo $sales['due_date'] ?>" placeholder="Enter Due Date">
    </div>
    <div class="form-group column2">
        <label for="Project Overview" class="blackLabel">Project Overview</label>
        <textarea  id="" name="description"  placeholder="Tell us about your project..."><?php echo $sales['description']  ?></textarea>
    </div>
    <div class="form-group column2">
        <label for="Assign to"  class="blackLabel">Assign to : </label>
        <div class="grid3">
            <div class="items">
                <input type="radio" id="none" name="assign_edit" value="none" checked>
                <label for="none">None</label>
            </div>
            <div class="items">
                <input type="radio" id="salesRep_onchange" name="assign_edit" value="salesRep">
                <label for="">Assign to Sales Rep</label>
            </div>
            <div class="items">
                <input type="radio" id="shareLead" name="assign_edit" value="shareLead">
                <label for="shareLead">Share Lead</label>
            </div> 
        </div>
    </div>
    <div class="form-group column2" id="salesRepSelect" style="display: none;">
        <div>
            <label for="Assign to" class="blackLabel">Assign to : </label>
            <select class=" form-select assignedTo text-left" name="assigned_to" aria-label="Default select example">
                <option value>Select Sales Rep</option>
                <?php 
                        foreach($salesPerson as $key=>$value){
                            ?>
                                <option value="<?php echo $value['username'] ?>"   
                                 <?php 
                                    if($value['username'] == $sales['assigned_to']){
                                         echo 'selected' ; 
                                    }
                                 ?>
                                
                                > <?php echo $value['fullname'] ?> </option>
                            <?php

                        }
                ?>
            </select>
        </div>
    </div>

    <div class="items text-left" id="shareLeadSelect" style="display: none;">
        <h6>Assigned to</h6>
        <select class="js-select2" multiple="multiple" name="multipleAssignedTo[]">
            <?php 
                foreach($salesPerson as $key=>$value){
                    ?>
                        <option value="<?php echo $value['username'] ?>" data-badge="" 
                        <?php 
                               if(in_array($value['fullname'] ,$multiple_sales_person )){
                                 echo 'selected';
                               }
                        ?>
                        > <?php echo $value['fullname'] ?> </option>
                    <?php
                }
            ?>
            
        </select>
    </div>
</div>

</div>
<input type="hidden" name="lead_id" value="<?php  echo $sales['lead_id']?>" >
<input type="hidden" name="lead_status" value="<?php echo $sales['status'] ?>">
<input type ="hidden" name="is_dashboard" value="<?  echo $is_dashboard  ?>"  />

<div class="modal-footer">
<button type="submit" class="btn btn-default btn-success">UPDATE</button>
<button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
</div>
</form>

<?php
 }?>

