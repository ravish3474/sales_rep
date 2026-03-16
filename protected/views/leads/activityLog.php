<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12  ">
            <div class="x_panel">
                <div class="dashboardPage adminDash">
               
                <div class="innerBox d-flex between select_parent" data-status="toal_leads">
                                       
                                <select class="form-select  month_count_filter" aria-label="Default select example" style="width: fit-content;"> 
                                        <option value=""> --SELECT MONTH --</option>
                                        
                                        <?
                                        $month =date('m');

                                        foreach (MONTH_FILTER as $key => $value) {
                                                if ($key == $month):
                                                   ?>
                                                    <option value="<? echo $key ?>" selected>  <? echo $value ?></option>
                                                    <?
                                                else:
                                                    ?>
                                                    <option value="<? echo $key ?>" >  <? echo $value ?></option>
                                                  <?
                                                endif;
                                        }
                                    ?>
                                </select>
         


                </div>

                     
                <div class="heading_div"> <span> Today  <? echo date('D ,M,Y') ?> </span></div>
                     <div id="today_data"></div>

                     <div class="heading_div"> <span>All Data</span></div>
                     <div id="output_div"></div>


                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        let page = $('.paginationBtns .active').attr('href');
        let month = $('.month_count_filter').val();

        getActivityLogs(page ,month);
    });


    function getActivityLogs(page=1 ,month , month_filter=false){
       
        showLoader();
        $.ajax({
            url: 'getActivityLogs',
            method: "POST",
            data: {
               page :page , 
               month : month
            },
            success: function(response) {
                let resp  = JSON.parse(response) ;
                // if(month_filter){
                //     $('#today_data').html('');
                // }else{
                //     $('#today_data').html(resp.html1);
                // }

              
                $('#today_data').html(resp.html1);
                $('#output_div').html(resp.html)
             
                hideLoader();
            },
            error: function(xhr, status, error) {
                hideLoader();
                Swal.fire({
                    title: 'Something went wrong',
                    icon: 'warning',
                    confirmButtonText: 'Got it!'
                });

            }
        })
    }

    $(document).on('click'  ,'.paginationBtns' ,function(event) {
        event.preventDefault();
        let month = $('.month_count_filter').val();
        let page = $(this).attr('href');
        getActivityLogs(page ,month)
    });

    $(document).on('change' ,'.month_count_filter' ,function(){
         let month = $(this).val(); 
         let page = $('.paginationBtns.active').attr('href');
         getActivityLogs(1 , month ,true);
         
      

    });

</script>