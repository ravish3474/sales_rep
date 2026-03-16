<?php
$chartArr = [];
?>
<div class="container customer_log_container">

  <input type="hidden" id="quto_id" value="<?= $quto_id ?>">
  <div class="table_div">

  </div>
  <table class="w-100  data-table customer_log_tbl" style="min-height: 234px;">

    <thead>
      <th>Product Name</th>
      <?php
      foreach ($year as $key => $value) {
      ?>
        <th><?= $value ?></th>
      <?
      }


      ?>
      <!-- <th>Total</th> -->
    </thead>
    <tbody>

      <?php
      foreach ($data as $key => $value) {
      //  print_r($value); 

        $prices = $value['price'];
        $qdoc_id = $value['qdoc_id'];
        $est_number = $value['est_number'];
      

      ?>

        <tr>

          <td><?= $value['name'] ?></td>
          <?
          foreach ($prices as $key2 => $price) {
            $chartArr[] = [
              'Price' => $price
            ];
          ?>

            <td class="tooltip_test"><?= $price ?>

              <!-- <button    onclick='viewQuotation(<?php echo $qdoc_id[$key2] ?? 0; ?>,"vp")' target="_blank" class="tooltiptext"><?= $qdoc_id[$key2] ?? 0 ?></button> -->

              <!-- <button
                onclick="window.open('<?php echo Yii::app()->request->baseUrl; ?>/quotation/archived?id=<?=  $qdoc_id[$key2] ?? 0 ?>&mode=vp', '_blank')"

                class="tooltiptext">
                <?=  $qdoc_id[$key2] ?? 0 ?>
              </button> -->

                <button
                onclick="window.open('<?php echo Yii::app()->request->baseUrl; ?>/quotation/archived?est_number=<?=  $est_number[$key2] ?? 0 ?>&mode=vp', '_blank')"

                class="tooltiptext">
                <?=  $est_number[$key2] ?? 0 ?>
              </button>

            </td>
          <?
          }
          ?>
          <!-- <td>  <strong> <?= $value['sum'] ?> </strong> </td> -->

        </tr>
      <?
      }
      ?>

      <!-- <tr class="total-row">
                <td colspan="3"> Total Price  $ <?= $grandTotal ?></td>
           </tr> -->
    </tbody>


  </table>


  <?

  $values = array_column($chartArr, 'Price');
  ?>

  <input type="hidden" id="labels" value='<?= json_encode($year) ?>'>
  <input type="hidden" id="values" value='<?= json_encode($values) ?>'>


  <div class="char_output_div d-none" id="chart_out_div">
    <select id="product_list">
      <?
      foreach ($productArr as $key => $value) {
        $selected =  $value['pro_name'] == $selected_prouct ? 'selected' : ''
      ?>
        <option value='<?= $value['pro_name'] ?>' <?= $selected ?>> <?= $value['pro_name'] ?> </option>
      <?
      }
      ?>
    </select>
    <canvas id="myBarChart" width="400" height="200"></canvas>
  </div>
</div>