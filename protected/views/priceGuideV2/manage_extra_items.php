<style>
.hidden{
    display:none;
}
h4{
    margin-top:0px !important;
}
.clickable {
  cursor: pointer;
  transition: background-color 0.3s;
}

.clickable:hover {
  animation: flash 0.5s infinite alternate;
}

@keyframes flash {
  0% {
    background-color: transparent;
  }
  100% {
    background-color: yellow; /* Change this to your preferred highlight color */
  }
}
.mainDivPanel{
  max-height: 70vh;
  overflow-y: auto;
  padding: 0;
  margin: 0;
  scrollbar-width: thin;
  margin-top: 10px;
}
td .btn-danger {
    background: #EA6153;
    border-color: #EA6153;
    padding: 0px;
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    margin: auto;
    justify-content: center;
} 
.modal.in table th{
        padding: 6px 5px !important;
            font-weight: 600;
    }
   #categoryList .btn.btn-warning {
      padding: 0px;
      width: 25px;
      height: 25px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
      
    }
   #categoryList   .btn-warning i.fa.fa-pencil {
        justify-content: center;
        align-items: center;
        display: flex;
    }

</style>
<div class="container">
  <div class="row">
    <div class="col-md-6 text-left">
      <h4 style="float: left;font-size: 15px; font-weight: 500;  color: #444; margin:auto 0" ><?=$name?></h4>
    </div>
    <div class="col-md-6 text-right">
      <button id="addCategoryButton" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Category</button>
      <div id="addCategoryForm" class="hidden">
        <input type="text" id="newCategoryName" class="form-control" placeholder="Enter category name">
        <button id="submitNewCategory" prod_id="<?=$prod_id?>" curr_id="<?=$curr_id?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Submit</button>
        <button id="cancelNewCategory" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Cancel</button>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="mainDivPanel">
        <table class="table table-bordered">
        <thead>
          <tr>
            <th></th>
            <th class="text-center">#</th>
            <th>Category</th>
            <th style="text-align: center !important;">Actions</th>
          </tr>
        </thead>
        <tbody id="categoryList" class="connectedSortableEXT">
            <?php
            $count = 1;
            foreach($data as $main){
            ?>
          <tr data-id="<?=$main['cat_ex_id']?>">
            <td class="drag-handle text-center" style="cursor:move;">
                <i class="fa fa-bars"></i>
            </td>
            <td class="text-center"><?=$count?></td>
            <td class="clickable" style="cursor:pointer;" onclick="viewExtraCat(<?=$prod_id?>,<?=$main['cat_ex_id']?>,<?=$curr_id?>)"><?=$main['cat_ex_name']?></td>
            <td class="d-flex gap-2 gap2 " style="justify-content: center;">
              <button class="btn btn-danger delete-button" style="margin: 0;" prod_id="<?=$prod_id?>" data-id="<?=$main['cat_ex_id']?>"><i class="fa fa-trash"></i></button>
              <button class="btn btn-warning" onclick="return EditExCategort(<?=$main['cat_ex_id']?>);" data-toggle="modal" data-target="#EditExtraItemsModal">
                <i class="fa fa-pencil"></i>
              </button>
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
</div>
<script>
$(document).ready(function() {
  $("#addCategoryButton").click(function() {
    $("#addCategoryButton").addClass("hidden");
    $("#addCategoryForm").removeClass("hidden");
  });

  $("#cancelNewCategory").click(function() {
    $("#addCategoryButton").removeClass("hidden");
    $("#addCategoryForm").addClass("hidden");
  });
});
$(document).ready(function() {
      $("tbody.connectedSortableEXT")
          .sortable({
            connectWith: ".connectedSortableEXT",
            // items: "> tr:not(:first)",
            appendTo: "parent",
            helper: "clone",
            cursor: "move",
            zIndex: 999990,   
            update: function () {
                var order = [];
                $("#categoryList tr").each(function (index) {
                  $(this).find('td:nth-child(2)').text(index + 1);
                    order.push({
                        id: $(this).data("id"),
                        sort_no: index + 1
                    });
                });

                $.post('<?= Yii::app()->request->baseUrl ?>/priceGuideV2/updateExtraSortOrder', {order: order}, function(response) {
                    // This runs after the server responds
                    showExtraV2(); 
                });
            }       
          });
      });
</script>