            <?
               $user_name = Yii::app()->user->getId() 
          ?>
      
      <? 
           if(count($data)):
                 foreach($data as $key=>$value){
                     ?>
                                         <div class="singleComments activeComment">
                                                 <div class="commenter">         
                                                     <h6>@ <? echo  $value['sales_rep'] ?> <? 
                                                      if($value['sales_rep'] == $user_name){
                                                         echo '(You)';
                                                      }
                                                     
                                                     
                                                     ?> </h6>
                                                     <h6><? echo date('d M Y H:i' ,strtotime($value['created_at']) ) ?> </h6>
                                                 </div>
                                                 <p class="des">
                                                     <? echo $value['comment'] ?>
                                                 </p>
                                        </div>
                     <? 
                 } 
           else:
            ?>
               <h5>No comments found </h5>
              <?
           endif; 
        ?>
                                       
                                       

                                           

        <div class="addCommentArea singleComments panel-collapse collapse " id="collapseOne">
          
            <div class="commenter">
                <h6>@ <? echo $user_name ?>  (You)</h6>
                <h6> <? echo date('d, M Y H:i') ?> </h6>
            </div>
              <form id="cmt_form">
                <input type="hidden" name="lead_id" value="<? echo $id ?>">
                <input type="hidden" name="sales_rep" value="<? echo $user_name ?>">
               <textarea name="cmt" id="cmt" placeholder="Your notes here..." required></textarea>
               <button class="greenBTn  add_comment"> Comment</button>
              </form>
        </div>
                                             

<script>
    
      $('#cmt_form').submit(function(event){
        event.preventDefault();
        let form = $(this); 
        let cmt = $('#cmt').val().trim();
        if(cmt===''){
            Swal.fire("Error" ,'Please enter a comment before submitting.' ,'error');
            return  false ;
        }
        let data = form.serialize();
           $.ajax({
             url : '../addComment', 
             method : 'POST', 
             data : data , 
             success : function(response){
                  form[0].reset(); 
                  // swal.fire({
                  //    title : "Comment Added successfully", 
                  //    icon : "success", 
                  // }); 
                  getAllComments(); 
                  getCommentNotification();

             } , 
             error : function(xhr , status , error){
                  // swal.fire({
                  //    title : " Something went wrong", 
                  //    icon : "warning", 
                  // });
             }
           })

      });

</script>