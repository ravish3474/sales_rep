<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<style>
.quote_table th{
    background-color:#5c656d;
    color:white;
    white-space:nowrap;
}
.quote_table table{
    white-space:nowrap;
    border:1px solid #848d94;
}
.btn_edit_inv{
    float: right;
    font-size: 18px;
    cursor: pointer;
}
.dropdown-menu{
    min-width: inherit;
    max-width: -webkit-fill-available;
}
#conv_note_final{
    word-wrap: break-word;
}
</style>
<script>
$(document).ready(function() {
    $('#quote_table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    } );
} );
</script>
<?php
$user_group = Yii::app()->user->getState('userGroup');
$user_id = Yii::app()->user->getState('userKey');
$full_name =Yii::app()->user->getState('fullName');
?>
<div class="container">
  <div class="row">
      <div class="col-sm-4">
      <div class="card">
          <div class="card-body">
            <h2 class="card-title">Quotations</h2>
            <form class="form-inline" action="/quoteEstimate" method="POST">
              <div class="form-group">
                <label for="months">Month</label>
                <select class="form-select" name="year_month" id="months">
                    <option value="1" <?php if($month==1)echo "selected";?>>January</option>
                    <option value="2" <?php if($month==2)echo "selected";?>>February</option>
                    <option value="3" <?php if($month==3)echo "selected";?>>March</option>
                    <option value="4" <?php if($month==4)echo "selected";?>>April</option>
                    <option value="5" <?php if($month==5)echo "selected";?>>May</option>
                    <option value="6" <?php if($month==6)echo "selected";?>>June</option>
                    <option value="7" <?php if($month==7)echo "selected";?>>July</option>
                    <option value="8" <?php if($month==8)echo "selected";?>>August</option>
                    <option value="9" <?php if($month==9)echo "selected";?>>September</option>
                    <option value="10" <?php if($month==10)echo "selected";?>>October</option>
                    <option value="11" <?php if($month==11)echo "selected";?>>November</option>
                    <option value="12" <?php if($month==12)echo "selected";?>>December</option>
                </select>
              </div>
              <div class="form-group">
                <label for="years">Year</label>
                <select class="form-select" name="year_date" id="years">
                    <option value="2020" <?php if($year=="2020"){echo "selected";}?>>2020</option>
                    <option value="2021" <?php if($year=="2021")echo "selected";?>>2021</option>
                    <option value="2022" <?php if($year=="2022")echo "selected";?>>2022</option>
                    <option value="2023" <?php if($year=="2023")echo "selected";?>>2023</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">GO</button>
            </form>
          </div>
      </div>
      </div>
      <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
            <h2 class="card-title">Search Quotations (Any Month/Year)</h2>
            <form class="form-inline" action="SearchList" method="POST">
              <div class="form-group">
                <input type="text" class="form-control" name="search" />
              </div>
              <button type="submit" class="btn btn-primary">Search</button>
            </form>
            </div>
        </div>
      </div>
      <div class="col-sm-4 d-flex justify-content-between">
          <div class="form-group text-right">
            <h2 for="exampleFormControlSelect1">Upload Online Store Report</h2>
            <button class="btn btn-primary text-right" onclick="onlineStore(<?=$user_id?>)">Upload</button>
          </div>
      </div>
  </div>
  <div class="row">
    <div class="col-sm-12 table-responsive">
      <table class="table table-bordered quote_table" id="quote_table">
        <thead>
          <tr>
            <th colspan="4" style="background-color:black;color:white;"><?php
            echo $monthName = strftime('%B', mktime(0, 0, 0, $month));
            ?></th>
            <th rowspan="2">Quote</th>
             <th rowspan="2">Other Quote/Invoice</th>
             <th rowspan="2">Online Store Report</th>
             <?php 
    			if($user_group=="1" || $user_group=="99"){
    			    ?>
    		 <th rowspan="2">Admin Comments</th>
    		 <?php
    			}
    		 ?>
             <th rowspan="2">Invoice #</th>
             <th rowspan="2">Invoice Link</th>
             <!--<th rowspan="2">Company Shipped</th>-->
             <th rowspan="2">Verification</th>
            <th rowspan="2">Action</th>
          </tr>
          <tr>
            <!--<th>#</th>-->
            <th>Sales Rep</th>
            <th>JOG Code</th>
            <!--<th>TH #</th>-->
            <th>Customer Name</th>
            <th>Date Estimate Converted</th>
          </tr>
        </thead>
        <tbody id="rows">
            <?php
            $count = 1;
            foreach($quotes as $data){    
            ?>
          <tr <?php
          if($data['request_update']==1){
              echo "style='background-color:yellow;'";
          }
          ?>>
            <!--<td><?=$count?></td>-->
            <td>
              <span style="font-family:inherit;" id="full_name_admin_<?=$data['conv_id']?>"><?=$data['fullname']?></span>
              <?php 
    			if($user_group=="1" || $user_group=="99"){
    				echo ' <i class="edit_req_by fa fa-pencil" id="full_data_'.$data["conv_id"].'" data-toggle="modal" data-target="#requestByEditModal" onclick="return showReqByEdit(\''.$data["conv_id"].'\',\''.$data["conv_by_id"].'\');"></i>';
    			}
    			?>
            </td>
            <td>
              <?php
              echo $data['jog_code'];
            //   if (strpos($data['jog_code'], 'EX') !== false) { 
            //         echo $data['jog_code'];
            //     }
            //     else{
            //         echo "-";
            //     }
              ?>
            </td>
            <!--<td>-->
              <?php
            //   if (strpos($data['jog_code'], 'TH') !== false) { 
            //         echo $data['jog_code'];
            //     }
            //     else{
            //         echo "-";
            //     }
              ?>
            <!--</td>-->
            <td>
              <?=$data['cust_name']?>
            </td>
            <td>
                <?=date("Y-M-d",strtotime($data['conv_date']));?>
            </td>
            <td>
                <?php
                if($user_group=="99" || $user_group=="1"){
                    if($data['draft_changed']==1){
                        ?>
                        <button class="btn btn-success" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotationFinalDraftAdmin('<?=$data['qdoci_id']?>','vp','<?=$data['jog_code']?>','<?=$data['conv_id']?>');">View Approved Estimate</button>
                        <?php
                    }
                    if($data['conv_status']==0 || $data['conv_status']==1){
                        $tagger = "View & Approve";
                        $condn_class = "btn btn-primary";
                    }
                    else{
                        $tagger = "Approved";
                        $condn_class = "btn btn-success";
                    }
                ?>
                <?php
                if($data['qdoci_id']==0 || $data['qdoci_id']==null){
                        if($data['conv_status']==0 || $data['conv_status']==1){
                        $tagger = "Confirm Approval";
                        $condn_class = "btn btn-primary";
                        }
                        else{
                            $tagger = "Approved";
                            $condn_class = "btn btn-success";
                        }
                        ?>
                        <button class="<?=$condn_class?> online_store_approve" conv_id="<?=$data['conv_id']?>"><?=$tagger?></button>
                        <?php
                    }else{
                ?>
                <button class="btn btn-success" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotationFinal('<?=$data['qdoci_id']?>','vp','<?=$data['jog_code']?>','<?=$data['conv_id']?>');">View</button>
                <button class="<?=$condn_class?>" id="view_approve_<?=$data['conv_id']?>" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotationFinal('<?=$data['qdoci_id']?>','va','<?=$data['jog_code']?>','<?=$data['conv_id']?>');"><?=$tagger?></button>
                <?php
                if($data['comm_status']==0){
                ?>
                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-secondary btn-sm" id="comm_btn_<?=$data['conv_id']?>" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotationFinal('<?=$data['qdoci_id']?>','vc','<?=$data['jog_code']?>','<?=$data['conv_id']?>');">Comm.</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-sm approve_comm" conv_id="<?=$data['conv_id']?>">Approve</button>
                    </div>
                  </div>
                </div>
                <?php
                }
                else{
                ?>
                <button class="btn btn-success" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotationFinal('<?=$data['qdoci_id']?>','vc','<?=$data['jog_code']?>','<?=$data['conv_id']?>');">Comm.</button>
                <?php
                }
                }
                }
                elseif($data['conv_status']==2){
                    if($data['qdoci_id']==0 || $data['qdoci_id']==null){
                    ?>
                    <button class="btn btn-success">Approved (ONLINE STORE)</button>
                    <?php
                    }
                    else{
                    ?>
                    <button class="btn btn-success" data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotationFinal('<?=$data['qdoci_id']?>','vp','<?=$data['jog_code']?>','<?=$data['conv_id']?>');">View (Approved)</button>
                    <?php
                    }
                }
                else{
                ?>
                <button class="btn btn-warning">Awaiting Approval</button>
                <?php }
                if($data['conv_notes']!=""){
                ?>
                <button class="btn btn-success" onclick="fetchSrNote(<?=$data['conv_id']?>)">SR Note</button>
                <?php
                }
                ?>
            </td>
            <td>
                <?php
                if($data['remake']=="" && $data['remake_notes']==""){
                    $rm_class = "btn-danger";
                }
                else{
                    $rm_class = "btn-success";
                }
                
                if($data['sample']=="" && $data['sample_notes']==""){
                    $sm_class = "btn-danger";
                }
                else{
                    $sm_class = "btn-success";
                }
                
                if($data['complimentary']=="" && $data['complimentary_notes']==""){
                    $cm_class = "btn-danger";
                }
                else{
                    $cm_class = "btn-success";
                }
                ?>
                <button data-toggle="modal" data-target="#freebModal" onclick="openQuotationData('1','<?=$data['conv_id']?>','<?=$data['remake']?>','<?=base64_encode($data['remake_notes'])?>')" class="btn <?=$rm_class?> btn-md" style="width:100%">Remake</button>
                <button data-toggle="modal" data-target="#freebModal" onclick="openQuotationData('2','<?=$data['conv_id']?>','<?=$data['sample']?>','<?=base64_encode($data['sample_notes'])?>')" class="btn <?=$sm_class?> btn-md" style="width:100%">Sample</button>
                <button data-toggle="modal" data-target="#freebModal" onclick="openQuotationData('3','<?=$data['conv_id']?>','<?=$data['complimentary']?>','<?=base64_encode($data['complimentary_notes'])?>')" class="btn <?=$cm_class?> btn-md" style="width:100%">Complimentary</button>
            </td>
            <td>
             <div class="row">
                <div class="col-sm-12 text-center">
                    <?php
                    if($data['online_store']==""){
                        $os_class="btn btn-danger";
                        $os_txt = "Click To Upload";
                    }
                    else{
                        $os_class="btn btn-success";
                        $os_txt="View";
                    }
                    ?>
                    <button class="<?=$os_class?> btn-md" data-toggle="modal" data-target="#freebModal" onclick="openQuotationData('4','<?=$data['conv_id']?>','<?=$data['online_store']?>','')" style="width:100%"><?=$os_txt?></button>
                 </div>
            </div>
            </td>
            <?php
                if($user_group=="99" || $user_group=="1"){
                ?>
                <td>
                <?php
                if($user_id=="2" || $user_id=="40"){
                ?>
                <button class="btn btn-primary admin_comment_edit" conv_id="<?=$data['conv_id']?>">Add/Update Note</button>
                <?php
                }
                elseif($data['admin_comments']=="" || $data['admin_comments']==null){
                ?>
                <button class="btn btn-danger">No Notes</button>
                <?php
                }
                else{
                ?>
                <button class="btn btn-success admin_comment_edit" conv_id="<?=$data['conv_id']?>">View Notes</button>
                <?php
                }
                ?>
                    </td>
                    <?php
                }
            ?>
            <td>
			    <div class="cnt_inv" id="d_inv<?=$data['qdoc_id']?>"><?=$data['inv_no']?></div>
			    <?php
                if($user_group=="99" || $user_group=="1"){
                ?>
				    <i class="fa fa-pencil btn_edit_inv" data-toggle="modal" data-target="#editINVModal" onclick="return editInvoice(<?=$data['qdoc_id']?>);"></i>
				<?php } ?>
			</td>
            <td>
                <?php
                if($data['invoice_link']==""){
                ?>
                <button class="btn btn-danger btn-md btn_link_view" style="width:100%">Not Available</button>
                <?php }else{
                $inv_links = explode(',',$data['invoice_link']);
                foreach($inv_links as $invoiced){
                ?>
                
                <a href="<?=$invoiced?>" target="_blank"><button class="btn btn-success btn-md btn_link_view" style="width:100%">View</button></a>
                <?php
                }
                }
                if($user_group=="99" || $user_group=="1"){
                ?>
                <div class="cnt_inv" style="display:none;" id="d_inv_link<?=$data['qdoc_id']?>"><?=$data['invoice_link']?></div>
				    <i class="fa fa-pencil btn_edit_inv" data-toggle="modal" data-target="#editINVNOModal" onclick="return editInvoiceLink(<?=$data['qdoc_id']?>);"></i>
				<?php } ?>
            </td>
            <!--<td>-->
                <?php
                //if($user_group=="99" || $user_group=="1"){
                ?>
                <!--<select class="form-control ship_comp" conv_id="<?=$data['conv_id']?>">-->
                <!--    <option selected="" disabled="" value="">Select Shipping</option>-->
                <!--    <option value="JOG" <?php if($data['ship_comp']=="JOG"){echo "selected";}?>>JOG</option>-->
                <!--    <option value="JS" <?php if($data['ship_comp']=="JS"){echo "selected";}?>>JS</option>-->
                <!--    <option value="G2W" <?php if($data['ship_comp']=="G2W"){echo "selected";}?>>G2W</option>-->
                <!--    <option value="B2C" <?php if($data['ship_comp']=="B2C"){echo "selected";}?>>B2C</option>-->
                <!--    <option value="Local Delivery" <?php if($data['ship_comp']=="Local Delivery"){echo "selected";}?>>Local Delivery</option>-->
                <!--  </select>-->
                  <?php
                //}else{ echo $data['ship_comp']; }
                  ?>
                  
                  
            <!--</td>-->
            <td>
                <?php
                if($data['final_approval']==0){
                    $fn_text = "Pending";
                    $fn_css  = "btn btn-warning";
                }
                else{
                    $fn_text = "Approved";
                    $fn_css  = "btn btn-success";
                }
                if($user_group=="99" || $user_group=="1"){
                ?>
                <div class="dropdown">
                    <button class="<?=$fn_css?> dropdown-toggle" type="button" data-toggle="dropdown"><?=$fn_text?>
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                      <li><a href="javascript:void(0);" onclick="submitCalc('<?=$data['qdoci_id']?>','<?=$data['invoice_link']?>','<?=$data['fullname']?>','<?=$year?>','<?=$data['inv_no']?>')">Sales Comm.</a></li>
                      <?php
                        if($data['final_approval']==0){
                      ?>
                      <li><a href="javascript:void(0);" onclick="approveConv('<?=$data['conv_id']?>')">Approve</a></li>
                      <?php }?>
                    </ul>
                </div>
                <?php
                }
                else{
                ?>
                <button class="btn <?=$fn_css?>"><?=$fn_text?></button>
                <?php
                }
                ?>
            </td>
            <td>
            <?php
            if($user_group=="99" || $user_group=="1"){
                if($data['request_update']==1){
            ?>
                <button class="btn btn-warning" id="btn_upd_<?=$data['conv_id']?>" onclick="openRequest('<?=$data['conv_id']?>','<?=$data['conv_by_id']?>')">Update Requested</button>
                <?php
                }
                ?>
                <button class="btn btn-danger rollback" jog_code="<?=$data['jog_code']?>" fname="<?=$data['conv_by']?>" conv_id="<?=$data['conv_id']?>">Rollback</button>
            <?php
            }else{
                if($data['request_update']==0){
            ?>
            <button class="btn btn-danger" data-toggle="modal" data-target="#requestUpdateModal" onclick="requestData('<?=$data['jog_code']?>','<?=$data['conv_id']?>','<?=base64_encode($data['request_text'])?>')">Request Update</button>
            <?php
            }
            else{
                ?>
                <button class="btn btn-warning" onclick="openRequestUser('<?=$data['conv_id']?>','<?=$data['conv_by_id']?>')">Update Requested</button>
                <?php
            }
            ?>
            <button class="btn btn-secondary archiver" conv_id="<?=$data['conv_id']?>">Archive</button>
            <?php
            }
            ?>
            </td>
          </tr>
          <?php
          $count++;
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="requestUpdateModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title">Input Updation Request</h4>
         	</div>
            <div class="modal-body" >
            	<form class="form-horizontal" id="request_update_ajax">
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="sales_quote_name_online">JOG Code :</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="jog_code" id="jog_code_input" readonly>
                      <input type="hidden" name="conv_id" id="conv_id_update">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Notes:</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="update_notes"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Old Request<br>(if any):</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="old_rq_sales" readonly></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editINVModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title">Enter Invoice No.</h4>
         	</div>
            <div class="modal-body" >
            	<input type="text" id="inv_value" name="inv_value" style="width: 100%; text-align: center;">
            	<input type="hidden" id="edit_inv_qdoc_id">
            	<div style="color: #F00; font-size: 14px; text-align: center; width: 100%; padding: 0px; margin:0px;">* Use "," for separate the Invoice numbers. <br><u>Ex</u>: 00000000,11111111,222222222</div>
            </div>
            <div  class="modal-footer">
                <center><button style="" id="btn_submit_edit" type="button" class="btn btn-success" onclick="return submitInvoice();"> Submit </button>
                </center>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editINVNOModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title">Enter Invoice Link</h4>
         	</div>
            <div class="modal-body" >
            	<input type="text" id="inv_link" name="inv_link" style="width: 100%; text-align: center;">
            	<input type="hidden" id="edit_inv_link_qdoc_id">
            	<div style="color: #F00; font-size: 14px; text-align: center; width: 100%; padding: 0px; margin:0px;">Enter Complete Link to the invoice.* Use "," for separate the Invoice Links. <br><u>Ex</u>: https://www.example.com,https://www.jogsports.com</div>
            </div>
            <div  class="modal-footer">
                <center><button style="" id="btn_submit_edit" type="button" class="btn btn-success" onclick="return submitInvoiceLink();"> Submit </button></center>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="freebModal" tabindex="-1" role="dialog" aria-labelledby="freebModal1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex">
        <h3 class="modal-title" style="float:left;" id="freebModal1"></h3>
        <button style="float:right;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
      </div>
      <div class="modal-body">
        <form id="upload_sample" enctype="multipart/form-data">
          <div class="form-group">
            <label for="exampleInputEmail1">Upload File(*EXCEL OR PDF ONLY)</label>
            <input type="file" class="form-control" name="files_name" id="exampleInputEmail1" accept="application/pdf,application/vnd.ms-excel">
            <input type="hidden" id="main_conv_id" name="main_conv_id" required class="form-control">
            <input type="hidden" id="conv_type" name="conv_type">
          </div>
          <div id="note_div">
          
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <iframe src="" style="display:none;" id="pdf_source" type="frame&amp;vlink=xx&amp;link=xx&amp;css=xxx&amp;bg=xx&amp;bgcolor=xx" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scorlling="yes" width="100%" height="600"></iframe>
        <iframe class="frame_content" id="live_view" style="display:none;" src="" width="100%" height="700" frameborder="0"></iframe>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="rqUpdModal" tabindex="-1" role="dialog" aria-labelledby="convNoteModal12" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <div class="d-flex">
        <h3 class="modal-title" style="float:left;" id="convNoteModal12">Request Update</h3>
        <button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        </div>
      </div>
      <div class="modal-body">
          <div class="container">
        <h5 id="req_upd_text"></h5></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="req_comp_btn">Complete Request</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="rqUpdUserModal" tabindex="-1" role="dialog" aria-labelledby="convNoteModal12User" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <div class="d-flex">
        <h3 class="modal-title" style="float:left;" id="convNoteModal12User">Request Update</h3>
        <button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        </div>
      </div>
      <div class="modal-body">
          <div class="container">
        <h5 id="req_upd_text_user"></h5></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning">Awaiting Request Completion</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="adminCommentModal" tabindex="-1" role="dialog" aria-labelledby="convNoteModal123" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <div class="d-flex">
        <h3 class="modal-title" style="float:left;" id="convNoteModal123">Admin Comments</h3>
        <button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        </div>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" id="submit_note_admin">
              <div class="form-group">
                <input type="hidden" value="" name="conv_id" id="conv_id_note_admin">
                <input type="hidden" value="" name="jog_code" id="jog_code_note_admin">
                <?php
                if($user_id!="2" && $user_id!="40"){
                ?>
                <label class="control-label col-sm-2" for="note_admin">Notes By Admin:</label>
                <div class="col-sm-10">
                  <textarea readonly class="form-control" id="note_admin"></textarea>
                  
                </div>
                <?php
                }
                ?>
              </div>
              <?php
              if($user_id=="2" || $user_id=="40"){
              ?>
              <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Add/Edit:</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="admin_comments" id="note_admin_edit"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Update & Send Email</button>
                </div>
              </div>
              <?php
              }
              ?>
         </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="rollbackModal" tabindex="-1" role="dialog" aria-labelledby="convNoteModal1234" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <div class="d-flex">
        <h3 class="modal-title" style="float:left;" id="convNoteModal1234">Rollback & Notify Sales Rep</h3>
        <button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        </div>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" id="rollback_quote">
              <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">JOG Code:</label>  
                <input type="hidden" value="" name="conv_id" id="rollback_conv_id">
                <div class="col-sm-10">
                <input type="text" class="form-control" readonly id="rollback_ex">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Sales Rep:</label>  
                <div class="col-sm-10">
                <input type="text" class="form-control" readonly id="fname">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Type Email:</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="rollback_email" id="rollback_email"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-danger">Remove & Send Email</button>
                </div>
              </div>
         </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).on('click','.rollback',function(){
    var conv_id = $(this).attr('conv_id');
    var jog_code = $(this).attr('jog_code');
    var fname = $(this).attr('fname');
    $('#fname').val(fname);
    $('#rollback_ex').val(jog_code);
    $('#rollback_conv_id').val(conv_id);
    $('#rollbackModal').modal('show');
})

$(document).on('submit','#rollback_quote',function(e){
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        $.ajax({
            type:'POST',
            data:formData,
            processData:false,
            contentType:false,
            url:"<?php echo Yii::app()->request->baseUrl; ?>/QuoteEstimate/removeConv",
            success:function(response){
              var response = JSON.parse(response);
              if(response.status==1){
                  alert('Quotation Rollback Successfull!');
                  location.reload();
              }
              else{
                  alert('Something Went Wrong');
              }
            }
        })
})

$(document).on('click','.admin_comment_edit',function(){
    var conv_id = $(this).attr('conv_id');
    $.ajax({
        type:'POST',
        data:{
            conv_id:conv_id
        },
        url:'<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/FetchComments',
        success:function(response){
            var response =JSON.parse(response);
            if(response.status==1){
                if(response.msg==null){
                    $('#conv_id_note_admin').val(conv_id);
                    $('#jog_code_note_admin').val(response.jog_code);
                    $('#adminCommentModal').modal('show');
                }
                else{
                    $('#conv_id_note_admin').val(conv_id);
                    $('#note_admin').val(response.msg);
                    $('#note_admin_edit').val(response.msg);
                    $('#jog_code_note_admin').val(response.jog_code);
                    $('#adminCommentModal').modal('show');
                }
            }
        }
    })
})

$(document).on('submit','#submit_note_admin',function(e){
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        $.ajax({
            type:'POST',
            data:formData,
            processData:false,
            contentType:false,
            url:"<?php echo Yii::app()->request->baseUrl; ?>/QuoteEstimate/submitNoteAdmin",
            success:function(response){
              var response = JSON.parse(response);
              if(response.status==1){
                  alert('Comment Added Successfully');
                  $('#adminCommentModal').modal('hide');
              }
              else{
                  alert('Something Went Wrong');
              }
            }
        })
})

function showReqByEdit(conv_id,user_id){

	$('#edit_reqby_qdoc_id').val(conv_id);
	$('#edit_reqby_user_id').val(user_id);

}

function submitReqByEdit(){

	if($('#edit_reqby_qdoc_id').val()==""){

		alert("Can not update to new user.");
		return false;
	}

	var conv_id = $('#edit_reqby_qdoc_id').val();
	var user_id = $('#edit_reqby_user_id').val();
	var full_name = $("#edit_reqby_user_id option:selected").attr("sales_name")

	$.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/updateUserByAdmin" ,
        data:{
        	"conv_id":conv_id,
	        "user_id":user_id,
	        "full_name":full_name
	    },
        success: function(resp){ 
            if(resp.result=="success"){
            	var func = "return showReqByEdit('"+conv_id+"','"+user_id+"')";
            	$('#full_name_admin_'+conv_id).html(full_name);
            	$('#full_data_'+conv_id).attr("onclick",func);
            	$('#requestByEditModal').modal('hide');

            }else{
            	alert(resp.msg);
            }


        }  
    });

}

$(document).on('click','.archiver',function(){
    var conv_id = $(this).attr('conv_id');
    if(confirm('Do you really want to archive this quotation?')){
        $.ajax({
            type:'POST',
            data:{
                conv_id:conv_id
            },
            url:'<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/ArchiveQuote',
            success:function(response){
                var response = JSON.parse(response);
                if(response.status==1){
                    alert('Quote Archived');
                    location.reload();
                }
                else{
                    alert('Something Went Wrong');
                }
            }
        })
    }
})

$(document).on('click','#req_comp_btn',function(){
    if(confirm('Do you really want to update the request?')){
        var conv_id = $(this).attr('conv_id');
        $.ajax({
            type:'POST',
            data:{
                conv_id:conv_id
            },
            url:'<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/ReqUpdateFinal',
            success:function(response){
                var response = JSON.parse(response);
                if(response.status==1){
                    location.reload();
                }
                else{
                    alert('Something Went Wrong');
                }
            }
        })
    }
})

function requestData(jog_code,conv_id,req_text){
    $('#jog_code_input').val(jog_code);
    $('#conv_id_update').val(conv_id);
    $('#old_rq_sales').val(atob(req_text));
}

function openRequest(conv_id,emp_id){
    $.ajax({
        type:'POST',
        data:{
            conv_id:conv_id
        },
        url:'<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/FetchText',
        success:function(response){
            var response = JSON.parse(response);
            if(response.status==1){
                $('#req_upd_text').html(response.data);
                $('#req_comp_btn').attr('conv_id',conv_id);
                $('#rqUpdModal').modal('show');
            }
        }
    })
}

function openRequestUser(conv_id,emp_id){
    $.ajax({
        type:'POST',
        data:{
            conv_id:conv_id
        },
        url:'<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/FetchText',
        success:function(response){
            var response = JSON.parse(response);
            if(response.status==1){
                $('#req_upd_text_user').html(response.data);
                $('#rqUpdUserModal').modal('show');
            }
        }
    })
}

$(document).on('click','.approve_comm',function(){
    var el = $(this);
    if(confirm('Do you really want to approve commission?')){
        var conv_id = $(this).attr('conv_id');
        $.ajax({
            type:'POST',
            data:{
                conv_id:conv_id
            },
            url:'<?php echo Yii::app()->request->baseUrl; ?>/quotation/ApproveCommission',
            success:function(response){
                var response = JSON.parse(response);
                if(response.status==1){
                    $('#comm_btn_'+conv_id).removeClass("btn-secondary");
                    $('#comm_btn_'+conv_id).addClass("btn-success");
                    el.hide();
                }
                else{
                    alert('Something Went Wrong');
                }
            }
        })
    }
})

$(document).on('click','.online_store_approve',function(){
    if(confirm('Do you really want to approve?')){
        var conv_id = $(this).attr('conv_id');
        $.ajax({
            type:'POST',
            data:{
                conv_id:conv_id
            },
            url:'<?php echo Yii::app()->request->baseUrl; ?>/quotation/ApproveOnlineStore',
            success:function(response){
                var response = JSON.parse(response);
                if(response.status==1){
                    location.reload();
                }
                else{
                    alert('Something Went Wrong');
                }
            }
        })
    }
})

$(document).on('submit','#request_update_ajax',function(e){
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        $.ajax({
            type:'POST',
            data:formData,
            processData:false,
            contentType:false,
            url:"<?php echo Yii::app()->request->baseUrl; ?>/QuoteEstimate/requestUpdateAjax",
            success:function(response){
               var response = JSON.parse(response);
               if(response.status==1){
                   location.reload();
               }
               else{
                   alert('Something Went Wrong');
               }
            }
        })
})

$(document).on('submit','#conv_estimate_online',function(e){
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        $.ajax({
            type:'POST',
            data:formData,
            processData:false,
            contentType:false,
            url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/ConvEstimateOnline",
            success:function(response){
                var response = JSON.parse(response);
                if(response.status==1){
                    var url="<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate";
                    window.location.href=url;
                }
                else{
                    alert('Something Went Wrong');
                }
            }
        })
})

function onlineStore(salesrep_id){
    $.ajax({
        type:'POST',
        data:{
            salesrep_id:salesrep_id
        },
        url:'<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchOrderNum',
        success:function(response){
            var response = JSON.parse(response);
            if(response.status==1){
                $('#sales_quote_name_online').val(response.salesrep_name);
                $('#sales_quote_id_online').val(response.salesrep_id);
                var html = '';
                for(var i=0;i<response.order_num.length;i++){
                    html+='<option value="'+response.order_num[i].order_main_code+'">'+response.order_num[i].order_main_code+'</option>';
                }
                $('#ex_th_code_online').empty();
                $('#ex_th_code_online').append(html);
                $('#online_store_modal').modal('show');
            }
            else{
                alert('No EX code to sync');
            }
        }
    })
}
</script>
<div class="modal fade" id="online_store_modal" tabindex="-1" role="dialog" aria-labelledby="freebModal1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex">
        <h3 class="modal-title" style="float:left;">Online Store Report (DIRECT)</h3>
        <button style="float:right;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="conv_estimate_online">
          <div class="form-group">
            <label class="control-label col-sm-2" for="sales_quote_name_online">Sales Rep :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sales_quote_name" id="sales_quote_name_online" readonly>
              <input type="hidden" name="sales_quote_id" class="form-control" id="sales_quote_id_online" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="ex_th_code">Available EX/TH Codes:</label>
            <div class="col-sm-10">
              <select class="form-control js-example-basic-multiple" name="codes[]" id="ex_th_code_online"  multiple="multiple">

              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Notes<br>(if any):</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="conversion_notes"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="file_online">Upload File<br>PDF/EXCEL ONLY</label>
            <div class="col-sm-10">
              <input type="file" required name="qdoci_id" class="form-control" id="file_online" accept="application/pdf,application/vnd.ms-excel">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<form method="POST" id="salesCalForm" style="display:none;">
    <input type="hidden" name="invoice_num" value="" id="invoice_num_calc">
    <input type="hidden" name="order_num" value="" id="order_num_calc">
    <input type="hidden" name="invoice_link" value="" id="invoice_link_calc">
    <input type="hidden" name="is_modal_open" value="1">
</form>

<div class="modal fade" id="convNoteModal" tabindex="-1" role="dialog" aria-labelledby="convNoteModal1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <div class="d-flex">
        <h3 class="modal-title" style="float:left;" id="convNoteModal1">Sales Person Note</h3>
        <button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
      </div>
      <div class="modal-body">
          <div class="container">
        <h5 id="conv_note_final"></5>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="requestByEditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="float: left;" class="modal-title">Select Quotation Request by</h4>
         	</div>
            <div class="modal-body" style="max-height: 500px;" >
            	
            	<input type="hidden" id="edit_reqby_qdoc_id" value="">
            	User : <select id="edit_reqby_user_id">
            	<?php
            	$sql_user = " SELECT id,fullname,username FROM user WHERE enable=1 AND user_group_id IN (1,99,2) ORDER BY fullname ASC;";
				$a_user_data = Yii::app()->db->createCommand($sql_user)->queryAll();
				for($i=0;$i<sizeof($a_user_data);$i++){
					echo '<option value="'.$a_user_data[$i]["id"].'" sales_name="'.$a_user_data[$i]["fullname"].'">'.$a_user_data[$i]["fullname"].' ('.$a_user_data[$i]["username"].')</option>';
				}
            	?>
				</select>
            </div>
            <div class="modal-footer">
                <button style="float:right;" type="button" class="btn btn-success" onclick="return submitReqByEdit();">Submit</button>
            </div>
        </div>
    </div>
</div>
<script>
function fetchSrNote(conv_id){
    $.ajax({
        type:'POST',
        data:{
            conv_id:conv_id
        },
        url:'<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/fetchNote',
        success:function(response){
            var response = JSON.parse(response);
            if(response.status==1){
                $('#conv_note_final').html(response.msg);
                $('#convNoteModal').modal('show');
            }
            else{
                alert('Something went wrong');
            }
        }
    })
}

function deleteConv(conv_id){
    if(confirm('Do you really want to Delete?')){
        $.ajax({
            type:'POST',
            data:{
                conv_id:conv_id
            },
            url:'<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/deleteConv',
            success:function(response){
                var response = JSON.parse(response);
                if(response.status==1){
                    location.reload();
                }
                else{
                    alert('Something Went Wrong');
                }
            }
        })
    }
}

function approveConv(conv_id){
    if(confirm('Do you really want to approve?')){
        $.ajax({
            type:'POST',
            data:{
                conv_id:conv_id
            },
            url:'<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/approveConv',
            success:function(response){
                var response = JSON.parse(response);
                if(response.status==1){
                    location.reload();
                }
                else{
                    alert('Something Went Wrong');
                }
            }
        })
    }
}

function submitCalc(qdoci_id,inv_link,full_name,year,inv_no){
    $.ajax({
        type:'POST',
        data:{
            qdoci_id:qdoci_id
        },
        url:'<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/fetchOrderNum',
        success:function(response){
            var response = JSON.parse(response);
            if(response.status==1){
                var order_num = response.data;
                $('#invoice_num_calc').val(inv_no);
                $('#order_num_calc').val(order_num);
                $('#invoice_link_calc').val(inv_link);
                var url = "calculator/SalesCommission/year/"+year+"/sales/"+full_name;
                $('#salesCalForm').attr('action',url);
                $("#salesCalForm").submit();
            }
            else{
                alert('Something Went Wrong');
            }
        }
    })
}

$(document).on('submit','#upload_sample',function(e){
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        $.ajax({
            type:'POST',
            data:formData,
            processData:false,
            contentType:false,
            url:"<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/uploadFreebies",
            success:function(response){
                var response = JSON.parse(response);
                if(response.status==1){
                    location.reload();
                }
                else{
                    alert('Something Went Wrong');
                }
            }
        })
})

function openQuotationData(type,conv_id,file_name,notes){
    var html = '';
    html+='<div class="form-group">'+
            '<label for="exampleInputEmail111">Notes For Admin <span style="color:red;">* Do not use apostrophes</span></label>'+
            '<textarea class="form-control" name="notes_admin" id="exampleInputEmail111">'+atob(notes)+'</textarea>'+
          '</div>';
    if(type==1){
        $('#freebModal1').html('Remake Quote/Invoice');
        $('#exampleInputEmail1').attr('required',false);
        $('#conv_type').val(1);
        $('#note_div').empty();
        $('#note_div').append(html);
    }else if(type==2){
        $('#freebModal1').html('Sample Quote/Invoice');
        $('#exampleInputEmail1').attr('required',false);
        $('#conv_type').val(2);
        $('#note_div').empty();
        $('#note_div').append(html);
    }else if(type==3){
        $('#freebModal1').html('Complimentary Quote/Invoice');
        $('#exampleInputEmail1').attr('required',false);
        $('#conv_type').val(3);
        $('#note_div').empty();
        $('#note_div').append(html);
    }
    else{
        $('#freebModal1').html('Online Store Report');
        $('#exampleInputEmail1').attr('required',true);
        $('#conv_type').val(4);
        $('#note_div').empty();
    }
    $('#main_conv_id').val(conv_id);
    if(file_name.length>0){
        var fileExt = file_name.split('.').pop();
        if(fileExt=='pdf'){
            var url= "upload/samples/"+file_name;
            $('#pdf_source').attr('src',url);
            $('#live_view').hide();
            $('#pdf_source').show();
        }
        else{
            var baseURL = '<?php echo Yii::app()->request->getBaseUrl(true); ?>'; 
            var url = "https://view.officeapps.live.com/op/embed.aspx?src="+baseURL+"/upload/samples/"+file_name;
            $('#live_view').attr('src',url);
            $('#pdf_source').hide();
            $('#live_view').show();
        }
    }
    else{
        $('#pdf_source').hide();
        $('#live_view').hide();
    }
}

function changeQuoteHeadApp(){

	var head_select = $('#head_selector_app').val();

    var obj_comp = $.parseJSON( window.atob($('#hide_comp_info_app'+head_select).val()) );

    //alert( window.atob($('#hide_comp_info'+head_select).val()) );

    var head_img_logo = "";
    if( obj_comp.comp_logo!="" && obj_comp.comp_logo != null){
        head_img_logo = '<img style="max-height: 180px; max-width: 180px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/'+obj_comp.comp_logo+'" >';
        $('#head_img_logo_app').html(head_img_logo);
    }else{
    	$('#head_img_logo_app').html('');
    }

    //alert(obj_comp.have_vat);

    if(obj_comp.have_vat=="1"){
        $('.subnvat').show();
    }else{
        $('.subnvat').hide();
    }

    var pre_comp_info = '<b>'+obj_comp.comp_name+'</b><br>'+obj_comp.comp_info;
    $('#pre_comp_info_app').html(pre_comp_info);

    $('#note_text').val(obj_comp.qnote_text);

}

$(document).on('click','.add_row',function(){
	var qdoc_id = $(this).attr("qdoc_id");
	$.ajax({
		type:'POST',
		data:{
			qdoc_id:qdoc_id
		},
		url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/add_product" ,
		success:function(response){
			var response = JSON.parse(response);
			if (response.status==1) {
				var qdoci_id = response.qdoci_id;
				var html = '';
			html+='<tr>'+
		    '<td style="padding: 10px 0px; text-align: left; display: block; white-space: pre-wrap; word-break: break-all; word-wrap: break-word;">'+
		        '<input type="hidden" name="qdoci_id[]" value="'+qdoci_id+'" /><input style="width: 100%; font-weight: bold;" type="text" name="pro_name[]" value="" /><br />'+
		        '<textarea style="width: 100%; min-height: 70px;" name="pro_desc[]"></textarea>'+
		    '</td>'+
		    '<td style="text-align: center; color: #999;">'+
		        '<input type="hidden" value="'+qdoci_id+'" class="qdoci_id_app" /><input type="hidden" value="0" id="tmp_amount'+qdoci_id+'" />'+
		        '<input name="app_comm_percent[]" onchange="return calComm();" onkeyup="return calComm();" style="width: 60px; text-align: center;" min="0" type="number" value="0" id="comm_percent_app'+qdoci_id+'" />'+
		    '</td>'+
		    '<td style="text-align: center; color: #999;" id="comm_val_app'+qdoci_id+'"></td>'+
		    '<td style="text-align: center;"><input name="app_qty[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width: 55px; text-align: center;" min="0" type="number" value="1" id="app_qty'+qdoci_id+'" /></td>'+
		    '<td style="text-align: right;"><input name="app_uprice[]" onchange="return calPriceVA();" onkeyup="return calPriceVA();" style="width: 70px; text-align: center;" min="0.00" type="number" value="0" id="app_uprice'+qdoci_id+'" /></td>'+
		    '<td style="text-align: center;">$<span id="sp_app_amount'+qdoci_id+'">0</span></td>'+
		    '<td style="text-align: center;cursor:pointer;" qdoci_id="'+qdoci_id+'"" class="remover"><i style="color: red;" class="fa fa-minus-circle"></i></td>'+
		'</tr>';
		$('.number_disc_approval').val(0);
        $('#actual_disc_approval').val(0);
		var tr_counter = $('#tr_total').val();
		var lengther = 5;
		if (tr_counter==1) {
			lengther=6;
		}
		var rowCount = $('#product_list tr').length-lengther;
		$('#product_list > tbody > tr').eq(rowCount-3).after(html);
			}
		}

	})
})

$(document).on('click','.remover',function(){
	var el = $(this);
	var qdoci_id = el.attr('qdoci_id');
	if (confirm('Are you sure?')) {
		$.ajax({
			type:'POST',
			data:{
				qdoci_id:qdoci_id
			},
			url:'<?php echo Yii::app()->request->baseUrl; ?>/quotation/delete_product',
			success:function(response){
				var response = JSON.parse(response);
				if (response.status==1) {
					el.parent("tr:first").remove();
					calPriceVA();
					calComm();
				}
			}
		})
	}
	// $(this).parent("tr:first").remove();
})

function calPriceVA(){

	var amount_total = 0.0;
	$('.qdoci_id_app').each(function(){
		var qdoci_id = $(this).val();

		row_qty = $('#app_qty'+qdoci_id).val();
		row_uprice = $('#app_uprice'+qdoci_id).val();

		amount_val = row_qty*row_uprice;

		$('#sp_app_amount'+qdoci_id).html(amount_val.toFixed(2));
		$('#tmp_amount'+qdoci_id).val(amount_val.toFixed(2));

		amount_total += amount_val;
	});

	$('#sp_app_sub_total').html(amount_total.toFixed(2));

	$('#sub_total_app').val(amount_total);
	tmp_vat = amount_total*0.07;
	$('#vat_value_app').val(tmp_vat);
    $('.number_disc_approval').val(0);
    $('#actual_disc_approval').val(0);
	changeIncludeVATApprove();
	calComm();

}

function calComm(){

	var comm_total = 0.0;
	$('.qdoci_id_app').each(function(){
		var row_id = $(this).val();

		tmp_amount = $('#tmp_amount'+row_id).val();
		comm_percent = $('#comm_percent_app'+row_id).val();

		comm_val = (comm_percent/100)*tmp_amount;

		$('#comm_val_app'+row_id).html(comm_val.toFixed(2));

		comm_total += comm_val;
	});

	$('#td_comm_total').html(comm_total.toFixed(2));

}

function changeIncludeVATApprove(){

    var total_value = 0.0;

    if($('#inc_vat_app').prop("checked")){

    	var vat_value = parseFloat($('#vat_value_app').val());
        
        var sub_tt = parseFloat($('#sp_app_sub_total').html());
        var discount = (parseFloat($('.number_disc_approval').val())/100)*sub_tt;
        
        var final_after_disc = (sub_tt-discount).toFixed(2);
        var new_vat = parseFloat((7/100) * final_after_disc).toFixed(2);
        $('#sp_show_vat_value_app').html($('#pre_cost_app').val()+new_vat);

        //var sub_total = parseFloat($('#sub_total').val());
        
        total_value = parseFloat(final_after_disc)+parseFloat(new_vat);
        $('#sp_show_total_value_app').html($('#pre_cost_app').val()+parseFloat(total_value).toFixed(2));
        $('#total_value_app').val(parseFloat(total_value).toFixed(2));
        $('#sp_show_gtotal_value_app').html($('#pre_cost_app').val()+parseFloat(total_value).toFixed(2));
        //$('#gtotal_value').val(total_value);
        $('#td_grand_total_app').html($('#pre_cost_app').val()+parseFloat(total_value).toFixed(2));
    }else{
        $('#sp_show_vat_value_app').html('');
        var sub_tt = parseFloat($('#sp_app_sub_total').html());
        var discount = (parseFloat($('.number_disc_approval').val())/100)*sub_tt;
        
        var final_after_disc = (sub_tt-discount).toFixed(2);
        total_value = parseFloat(final_after_disc);
        $('#sp_show_total_value_app').html($('#pre_cost_app').val()+total_value.toFixed(2));
        $('#total_value_app').val(total_value);
        $('#sp_show_gtotal_value_app').html($('#pre_cost_app').val()+total_value.toFixed(2));
        $('#td_grand_total_app').html($('#pre_cost_app').val()+total_value.toFixed(2));
        //$('#gtotal_value').val(total_value);
    }

}

function viewQuotationFinalDraftAdmin(qdoc_id,action_from,jog_code_main,conv_id){

    $('#main_qdoc_id').val(qdoc_id);
    $('#view_doc_id').val(btoa(qdoc_id));
    $('#quote_approve_bar').show();

    $('#d_quote_body').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

    $('#head_selector_app').hide();
    $('#btn_approve').hide();
    $('#btn_reject').hide();
    $('#btn_print').hide();
    $('#btn_refresh_date').hide();
    //$('#d_quote_below').hide();
    $('#sp_remark').hide();
    if(action_from!="va"){
        $('#note_text').hide();
    }
    else{
        $('#note_text').show();
    }

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/showQuoteViewAdminDraft" ,
        data:{
            "qdoc_id":qdoc_id,
            "action_from":action_from,
            "jog_code_main":jog_code_main
        },
        success: function(resp){ 
            $('#d_quote_body').html(resp.inner_content); 

            $('#quote_history').hide();
            
            $('#d_approval_comment').html(window.atob(resp.approval_comment));
            $('#btn_approve').hide();
            $('#btn_reject').hide();
            $('#btn_print').show();
            // $('#note_text').val(resp.note_text);
            // $('#d_quote_body').html(resp.inner_content); 
            // $('#btn_approve').attr('conv_id',conv_id);
            // $('#quote_history').hide();
            
            // $('#d_approval_comment').html(window.atob(resp.approval_comment));

            //     if(action_from!="va"){
            //     $('#d_quote_below').show();
            //     $('#sp_remark').show();
            //     $('#btn_print').show();
            //     }
            //     //$('.subnvat').hide();

            //     if(action_from=='va'){
            //         $('#btn_reject').show();
            //         $('#btn_approve').show();
            //         $('#head_selector_app').show();
            //         $('#head_selector_app').val(resp.comp_id);
            //         $('#note_text').val(resp.note_text);
            //         changeQuoteHeadApp();
            //     }

            //     //alert(resp.history_inner);
            //     if(resp.history_inner!=""){
            //         $('#quote_history').show();
            //         $('#select_history').html(resp.history_inner);
            //     }
                
            // if(resp.show_reject=="yes"){
            //     $('#btn_reject').show();
            //     $('#sp_remark').show();
            // }
            // if( resp.show_print=="yes" ){
            //     //if(action_from=="vp"){
            //         $('#btn_refresh_date').show();
            //     //}
                
            // }

                $.ajax({
                    type:'POST',
                    data:{
                        chat_type:"<?=$chat_type?>",
                        doc_id:qdoc_id,
                        emp_id:"<?=$user_id?>",
                    },
                    url:'<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchChats',
                    success:function(response){
                        var response = JSON.parse(response);
                        if (response.status==1) {
                            var html = '';
                            html = atob(response.msg);
                            $('#d_approval_comment').append(html);
                        }
                    }
                })

                $.ajax({
                    type:'POST',
                    data:{
                        doc_id:qdoc_id
                    },
                    url:'<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchSalesNotes',
                    success:function(response){
                        
                        var response = JSON.parse(response);
                        if (response.status=="0") {
                            $('#notes_modal_div').hide();
                        }
                        else{
                            $('#pre_sale_note_modal').html(response.note);
                            $('#notes_modal_div').show();
                        }
                    }
                })

        }  
    });
}

function viewQuotationFinal(qdoc_id,action_from,jog_code_main,conv_id){

    $('#main_qdoc_id').val(qdoc_id);
    $('#view_doc_id').val(btoa(qdoc_id));
    $('#quote_approve_bar').show();

    $('#d_quote_body').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

    $('#head_selector_app').hide();
    $('#btn_approve').hide();
    $('#btn_reject').hide();
    $('#btn_print').hide();
    $('#btn_refresh_date').hide();
    //$('#d_quote_below').hide();
    $('#sp_remark').hide();
    if(action_from!="va"){
        $('#note_text').hide();
    }
    else{
        $('#note_text').show();
    }

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/showQuoteView" ,
        data:{
            "qdoc_id":qdoc_id,
            "action_from":action_from,
            "jog_code_main":jog_code_main
        },
        success: function(resp){ 
            $('#note_text').val(resp.note_text);
            $('#d_quote_body').html(resp.inner_content); 
            $('#btn_approve').attr('conv_id',conv_id);
            $('#quote_history').hide();
            
            $('#d_approval_comment').html(window.atob(resp.approval_comment));

                if(action_from!="va"){
                $('#d_quote_below').show();
                $('#sp_remark').show();
                $('#btn_print').show();
                }
                //$('.subnvat').hide();

                if(action_from=='va'){
                    $('#btn_reject').show();
                    $('#btn_approve').show();
                    $('#head_selector_app').show();
                    $('#head_selector_app').val(resp.comp_id);
                    $('#note_text').val(resp.note_text);
                    changeQuoteHeadApp();
                }

                //alert(resp.history_inner);
                if(resp.history_inner!=""){
                    $('#quote_history').show();
                    $('#select_history').html(resp.history_inner);
                }
                
            if(resp.show_reject=="yes"){
                $('#btn_reject').show();
                $('#sp_remark').show();
            }
            if( resp.show_print=="yes" ){
                //if(action_from=="vp"){
                    $('#btn_refresh_date').show();
                //}
                
            }

                $.ajax({
                    type:'POST',
                    data:{
                        chat_type:"<?=$chat_type?>",
                        doc_id:qdoc_id,
                        emp_id:"<?=$user_id?>",
                    },
                    url:'<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchChats',
                    success:function(response){
                        var response = JSON.parse(response);
                        if (response.status==1) {
                            var html = '';
                            html = atob(response.msg);
                            $('#d_approval_comment').append(html);
                        }
                    }
                })

                $.ajax({
                    type:'POST',
                    data:{
                        doc_id:qdoc_id
                    },
                    url:'<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchSalesNotes',
                    success:function(response){
                        
                        var response = JSON.parse(response);
                        if (response.status=="0") {
                            $('#notes_modal_div').hide();
                        }
                        else{
                            $('#pre_sale_note_modal').html(response.note);
                            $('#notes_modal_div').show();
                        }
                    }
                })

        }  
    });
}

$(document).on('change','#viewQuotationNewFinal',function(){
    var qdoc_id = $(this).attr("qdoc_id");
    var action_from = $(this).attr("action_from");
    var symbol = $('option:selected', this).attr('curr_symbol');
    var curr_id = $(this).val();
    var old_curr_id = $('#old_curr_id').val();
    $('#main_qdoc_id').val(qdoc_id);
    $('#view_doc_id').val(btoa(qdoc_id));
    $('#quote_approve_bar').show();

    $('#d_quote_body').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

    $('#head_selector_app').hide();
    $('#btn_approve').hide();
    $('#btn_reject').hide();
    $('#btn_print').hide();
    $('#btn_refresh_date').hide();
    //$('#d_quote_below').hide();
    $('#sp_remark').hide();
    if(action_from!="va"){
        $('#note_text').hide();
    }
    else{
        $('#note_text').show();
    }

    $.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/showQuoteViewCurrChange" ,
        data:{
            "qdoc_id":qdoc_id,
            "action_from":action_from,
            "symbol":symbol,
            "curr_id":curr_id,
            "old_curr_id":old_curr_id
        },
        success: function(resp){ 
            $('#d_quote_body').html(resp.inner_content); 
            $('#note_text').val(resp.note_text);

            $('#quote_history').hide();
            
            $('#d_approval_comment').html(window.atob(resp.approval_comment));
                if(action_from!="va"){
                    $('#btn_print').show();
                $('#d_quote_below').show();
                $('#sp_remark').show();
                }
                //$('.subnvat').hide();

                if(action_from=='va'){
                    $('#btn_reject').show();
                    $('#btn_approve').show();
                    $('#head_selector_app').show();
                    $('#head_selector_app').val(resp.comp_id);
                    $('#note_text').val(resp.note_text);
                    changeQuoteHeadApp();
                }

                //alert(resp.history_inner);
                if(resp.history_inner!=""){
                    $('#quote_history').show();
                    $('#select_history').html(resp.history_inner);
                }
                
            if(resp.show_reject=="yes"){
                $('#btn_reject').show();
                $('#sp_remark').show();
            }
            if( resp.show_print=="yes" ){
                //if(action_from=="vp"){
                    
                    $('#btn_refresh_date').show();
                //}
                
            }

                $.ajax({
        type:'POST',
        data:{
            chat_type:"<?=$chat_type?>",
            doc_id:qdoc_id,
            emp_id:"<?=$user_id?>",
        },
        url:'<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchChats',
        success:function(response){
            var response = JSON.parse(response);
            if (response.status==1) {
                var html = '';
                html = atob(response.msg);
                $('#d_approval_comment').append(html);
            }
        }
    })

                $.ajax({
                    type:'POST',
                    data:{
                        doc_id:qdoc_id
                    },
                    url:'<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchSalesNotes',
                    success:function(response){
                        
                        var response = JSON.parse(response);
                        if (response.status=="0") {
                            $('#notes_modal_div').hide();
                        }
                        else{
                            $('#pre_sale_note_modal').html(response.note);
                            $('#notes_modal_div').show();
                        }
                    }
                })

        }  
    });
}
)

function editPONumber(qdoc_id){
	
	var po_number = $('#sp_po_number'+qdoc_id).html();

	var new_po_number = prompt("PO Number:",po_number);

	if(new_po_number!=null ){

		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/editPONumber" ,
	        data:{
		        "qdoc_id":qdoc_id,
		        "po_number":window.btoa(new_po_number)
		    },
	        success: function(resp){ 
	            if(resp.result=="success"){
	            	
	            	$('#sp_po_number'+qdoc_id).html(new_po_number);

	            }else{
	            	alert(resp.msg);
	            }


	        }  
	    });
	}

}

function quotationApproveFinal(){

	if(confirm("Confirm to save this Quotation?")){

		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/approveQuote" ,
	        data:$('#app_quote').serialize(),
	        success: function(resp){ 
	            if(resp.result=="success"){
                    $('#quoteDocModal').modal('hide');
	            	//location.reload();

	            }else{
	            	alert(resp.msg);
	            }
	        }  
	    });
		
	}

}

$(document).on('click','.quotationApproveFinalApprove',function(){
    var conv_id = $(this).attr('conv_id');
    if(confirm("Confirm to approve this Quotation?")){

		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/approveQuoteFinal" ,
	        data:$('#app_quote').serialize(),
	        success: function(resp){ 
	            if(resp.result=="success"){
	                $.ajax({
	                    type:'POST',
	                    data:{
	                        conv_id:conv_id
	                    },
	                    url:"<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/quoteFinalEmail",
	                    success:function(response){
	                        $('#view_approve_'+conv_id).removeClass("btn-primary");
                            $('#view_approve_'+conv_id).addClass("btn-success");
                            $('#view_approve_'+conv_id).text("Approved");
                            $('#quoteDocModal').modal('hide');
	                    }
	                })
	            }else{
	            	alert(resp.msg);
	            }
	        }  
	    });
		
	}
})

function refreshDate(){
	var qdoc_id = $('#main_qdoc_id').val();
	if(confirm("This action will update Estimate Date and Expire Date permanently. Confirm?")){

		$('#show_est_date').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>');
		$('#show_exp_date').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>');

		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/refreshDate" ,
	        data:{
		        "qdoc_id":qdoc_id
		    },
	        success: function(resp){ 
	            if(resp.result=="success"){
	            	
	            	$('#show_est_date').html(resp.est_date);
	            	$('#show_exp_date').html(resp.exp_date);

	            }else{
	            	alert(resp.msg);
	            }


	        }  
	    });
	}
	
}

function printQuotation(){

	var qdoc_number = $("#qdoc_number").html();
    var jog_code    = $('#jog_code').html();
	var divContents = $("#d_quote_body").html();
    var printWindow = window.open('', '', 'height=2000,width=1200');
    printWindow.document.write('<html><head><title>'+qdoc_number+' '+jog_code+'</title>');
    printWindow.document.write('</head><body >');
    printWindow.document.write(divContents);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();

}

function editCommAfterApprove(qdoc_id,qdoci_id,comm_percent){

	var new_comm = prompt("Edit Commission percent:",comm_percent);

	if(new_comm!=null){
		//alert('qdoc_id='+qdoc_id+',qdoci_id='+qdoci_id+',comm_percent='+comm_percent+',new_comm='+new_comm);

		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/editCommAfterApprove" ,
	        data:{
		        "qdoci_id":qdoci_id,
		        "new_comm":new_comm,
		        "qdoc_id":qdoc_id,
		        "comm_percent":comm_percent
		    },
	        success: function(resp){ 
	            if(resp.result=="success"){
	            	
	            	viewQuotation(qdoc_id,'vc');

	            }else{
	            	alert(resp.msg);
	            }


	        }  
	    });
	}

}

function editUPriceAfterApprove(qdoc_id,qdoci_id,uprice){

	var new_uprice = prompt("Edit Price:",uprice);

	if(new_uprice!=null){

		$.ajax({  
	        type: "POST",  
	        dataType: "json", 
	        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/editUPriceAfterApprove" ,
	        data:{
	        	"qdoc_id":qdoc_id,
		        "qdoci_id":qdoci_id,
		        "new_uprice":new_uprice,
		        "uprice":uprice
		    },
	        success: function(resp){ 
	            if(resp.result=="success"){
	            	
	            	viewQuotation(qdoc_id,'vc');

	            }else{
	            	alert(resp.msg);
	            }


	        }  
	    });
	}

}

function editInvoice(qdoc_id){

	var inv_show = $('#d_inv'+qdoc_id).html();

	$('#edit_inv_qdoc_id').val(qdoc_id);
	inv_value = inv_show.replace(/<br>/g ,",");

	$('#inv_value').val(inv_value);	

}

function editInvoiceLink(qdoc_id){

	var inv_show = $('#d_inv_link'+qdoc_id).html();

	$('#edit_inv_link_qdoc_id').val(qdoc_id);
	inv_value = inv_show.replace(/<br>/g ,",");

	$('#inv_link').val(inv_value);	

}

function submitInvoiceLink(){

	var qdoc_id = $('#edit_inv_link_qdoc_id').val();
	var inv_value = $('#inv_link').val();

	$.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/submitInvoiceLink" ,
        data:{
	        "qdoc_id":qdoc_id,
	        "inv_value":inv_value
	    },
        success: function(resp){ 
            if(resp.result=="success"){
            	
            	$('#d_inv_link'+qdoc_id).html(resp.inv_show);
            	$('#edit_inv_link_qdoc_id').val('');
            	$('#inv_link').val('');
                $('#btn_link_view').hide();
            	$('#editINVNOModal').modal("toggle");
            	location.reload();

            }else{
            	alert(resp.msg);
            }


        }  
    });

}

function submitInvoice(){

	var qdoc_id = $('#edit_inv_qdoc_id').val();
	var inv_value = $('#inv_value').val();

	$.ajax({  
        type: "POST",  
        dataType: "json", 
        url:"<?php echo Yii::app()->request->baseUrl; ?>/quotation/submitInvoice" ,
        data:{
	        "qdoc_id":qdoc_id,
	        "inv_value":inv_value
	    },
        success: function(resp){ 
            if(resp.result=="success"){
            	
            	$('#d_inv'+qdoc_id).html(resp.inv_show);
            	$('#edit_inv_qdoc_id').val('');
            	$('#inv_value').val('');

            	$('#editINVModal').modal("toggle");

            }else{
            	alert(resp.msg);
            }


        }  
    });

}

$(document).on('change','.ship_comp',function(){
    var value = $(this).val();
    var conv_id = $(this).attr("conv_id");
    $.ajax({
        type:'POST',
        data:{
            value:value,
            conv_id:conv_id
        },
        url:'<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/updateShipping',
        success:function(response){
            console.log(response);
        }
    })
})
</script>