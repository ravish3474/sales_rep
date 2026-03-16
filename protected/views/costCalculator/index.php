<form  style="overflow:hidden;" id="drafter2">
<table class="table">
      <h1><input type="text" placeholder="Enter QTY ..." name="draft_name">
        <input type="hidden" name="item_id" value="<?=$item_id?>">
        <input type="hidden" name="item_name" value="<?=$item_name?>">
      </h1>
    <thead>
      <tr>
        <th>#</th>
        <th>Total Cost Of Product</th>
        <th>Yards Per Product</th>
        <th>Cost Per Yard</th>
        <th>Total Cost</th>
      </tr>
    </thead>
    <tbody>
      <tr class="txtMult">
        <td>1</td>
        <td>Material</td>
        <td><input type="text" name="table_data[]" class="calc val1"></td>
        <td><input type="text" name="table_data[]" class="calc val2"></td>
        <td><input type="text" name="table_data[]" class="calc multTotal multTotal1"></td>
      </tr>
      <tr class="txtMult">
        <td>2</td>
        <td>Secondary Material Cost</td>
        <td><input type="text" name="table_data[]" class="calc val1"></td>
        <td><input type="text" name="table_data[]" class="calc val2"></td>
        <td><input type="text" name="table_data[]" class="calc multTotal multTotal1"></td>
      </tr>
      <tr class="txtMult">
        <td>3</td>
        <td>Sublimation Cost</td>
        <td><input type="text" name="table_data[]" class="calc val1"></td>
        <td><input type="text" name="table_data[]" class="calc val2"></td>
        <td><input type="text" name="table_data[]" class="calc multTotal multTotal1"></td>
      </tr>
      <tr class="txtMult">
        <td>4</td>
        <td>Cutting</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc multTotal"></td>
      </tr>
      <tr class="txtMult">
        <td>5</td>
        <td>Sewing</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc multTotal"></td>
      </tr>
      <tr class="txtMult">
        <td>6</td>
        <td>Accessories</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc multTotal"></td>
      </tr>
      <tr class="txtMult">
        <td>7</td>
        <td>Front Logo</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc multTotal"></td>
      </tr>
      <tr class="txtMult">
        <td>8</td>
        <td>Back Numbers</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc multTotal"></td>
      </tr>
      <tr class="txtMult">
        <td>9</td>
        <td>Sleeve Numbers Cost</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc multTotal"></td>
      </tr>
      <tr class="txtMult">
        <td>10</td>
        <td>Front Numbers</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc multTotal"></td>
      </tr>
      <tr class="txtMult">
        <td>11</td>
        <td>Emb Name Cost 1-2 inch</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc multTotal"></td>
      </tr>
      <tr class="txtMult">
        <td>12</td>
        <td>Emb Number Cost 1-2 inch</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc multTotal"></td>
      </tr>
      <tr class="txtMult">
        <td>13</td>
        <td>Emb ZZ Cost for numbers back</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc multTotal"></td>
      </tr>
      <tr class="txtMult">
        <td>14</td>
        <td>Emb Cost for numbers sleeve</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc multTotal"></td>
      </tr>
      <tr class="txtMult">
        <td>15</td>
        <td>Shoulder Logos Cost per unit</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc multTotal"></td>
      </tr>
      <tr class="txtMult">
        <td>16</td>
        <td>Branding Logo Cost</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc multTotal"></td>
      </tr>
      <tr class="txtMult">
        <td>17</td>
        <td>Misc. Cost</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc multTotal"></td>
      </tr>
      <tr>
        <td>18</td>
        <td>Total Cost Product</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc" id="grandTotal"></td>
      </tr>
      <tr>
        <td>19</td>
        <td>Mark Up %</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc markup_percent"></td>
      </tr>
      <tr>
        <td>20</td>
        <td>Total Cost w/ Mark Up</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc markup_cost"></td>
      </tr>
      <tr>
        <td>21</td>
        <td>Exchange Rate</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc exch_rate"></td>
      </tr>
      <tr>
        <td>22</td>
        <td>Total USD Cost</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc usd_cost"></td>
      </tr>
      <tr>
        <td>23</td>
        <td>Duty Cost</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc duty_cost"></td>
      </tr>
      <tr>
        <td>24</td>
        <td>Shipping Cost</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc shipping_cost"></td>
      </tr>
      <tr>
        <td>25</td>
        <td>Exchange Rate %</td>
        <td></td>
        <td><input type="text" name="table_data[]" placeholder="% here" class="calc exch_percent" ></td>
        <td><input type="text" name="table_data[]" readonly class="calc exchange_rate"></td>
      </tr>
      <tr>
        <td>26</td>
        <td>Final Cost minus Sales Comm.</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc final_cost_wo_sales"></td>
      </tr>
      <tr>
        <td>27</td>
        <td>Sales Comm. %</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc sales_percent"></td>
      </tr>
      <tr>
        <td>28</td>
        <td>Total Cost w/ Sales Commission</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc final_cost_w_sales"></td>
      </tr>
      <tr>
        <td></td>
        <td><b>Profit Per Piece % USD</b></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td>Total Profit Per Piece</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc prof_per_piece" readonly></td>
      </tr>
      <tr>
        <td></td>
        <td>Exchange Rate</td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc exchange_rate_final_percent"></td>
        <td><input type="text" name="table_data[]" class="calc exchange_rate_final" readonly></td>
      </tr>
      <tr>
        <td></td>
        <td>Selling Price - Sales Comm</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc sp_ss"></td>
      </tr>
      <tr>
        <td></td>
        <td>Total Profit %</td>
        <td></td>
        <td></td>
        <td><input type="text" name="table_data[]" class="calc profit_percentage" style="background-color: black;
    color: white;
    font-size: medium;" readonly></td>
      </tr>
    </tbody>
  </table>
  
  <button class="btn btn-success" style="float:right;margin-right:28px;" type="submit">Submit Cost</button>
  </form>
  <script>

$(function () {
    $(".calc").attr("placeholder", "0.00");
    $('.calc').keydown(function (event) {


        if (event.shiftKey == true) {
            event.preventDefault();
        }

        if ((event.keyCode >= 48 && event.keyCode <= 57) || 
            (event.keyCode >= 96 && event.keyCode <= 105) || 
            event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
            event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

        } else {
            event.preventDefault();
        }

        if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
            event.preventDefault(); 
        //if a decimal has been added, disable the "."-button

    });
});

 $(document).ready(function () {
       $(".txtMult input").keyup(multInputs);

       function multInputs() {
           var mult = 0;
           var multer = 0;
           // for each row:
           $("tr.txtMult").each(function () {
               // get the values from this row:
               var $val1 = parseFloat($('.val1', this).val());
               var $val2 = parseFloat($('.val2', this).val());
               var $total = ($val1) * ($val2)
               if(isNaN($total)) {
                var $total = 0.00;
                }
               $('.multTotal1',this).val($total.toFixed(2));
               multer = parseFloat($('.multTotal',this).val());
               if(isNaN(multer)) {
                var multer = 0.00;
                }
               mult += multer;
           });
           $("#grandTotal").val(mult.toFixed(2));
           
          var percent = parseFloat($('.markup_percent').val());
          var total = parseFloat($('#grandTotal').val());
          var markup = (total*(percent/100))+total;
          if(isNaN(markup)) {
                    var markup = 0.00;
                    }
          $('.markup_cost').val(markup.toFixed(2));
          
          var rate = parseFloat($('.exch_rate').val());
          var markup_cost = parseFloat($('.markup_cost').val());
          var usd_cost = rate*markup_cost;
          if(isNaN(usd_cost)) {
                    var usd_cost = 0.00;
                    }
          $('.usd_cost').val(usd_cost.toFixed(2));
          
        var percent = $('.exch_percent').val();
        var usd_cost = $('.usd_cost').val();
        var duty_cost = $('.duty_cost').val();
        var shipping_cost = $('.shipping_cost').val();
        var exchange_rate = (parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost))*parseFloat(percent)/100;
        if(isNaN(exchange_rate)) {
            var exchange_rate = 0.00;
        }
        $('.exchange_rate').val(exchange_rate.toFixed(2));
        var final = parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost)+exchange_rate;
        if(isNaN(final)) {
            var final = 0.00;
        }
        $('.final_cost_wo_sales').val(final.toFixed(2));
        
        var percent = parseFloat($('.sales_percent').val());
        var final_cost_wo = parseFloat($('.final_cost_wo_sales').val());
        var total = (final_cost_wo*percent/100)+final_cost_wo;
        if(isNaN(total)) {
            var total = 0.00;
        }
        $('.final_cost_w_sales').val(total.toFixed(2));
        
        var markup_percent = parseFloat($('.markup_percent').val());
        var total_cost = parseFloat($('#grandTotal').val());
        var profit = (markup_percent/100)*total_cost;
        if(isNaN(profit)) {
            var profit = 0.00;
        }
        $('.prof_per_piece').val(profit.toFixed(2));
        
        var exchange_rate_percent = parseFloat($('.exchange_rate_final_percent').val());
        var prof_per_piece = parseFloat($('.prof_per_piece').val());
        var exchange_rate_final = exchange_rate_percent*prof_per_piece;
        if(isNaN(exchange_rate_final)) {
            var exchange_rate_final = 0.00;
        }
        $('.exchange_rate_final').val(exchange_rate_final.toFixed(2));
        
        var sp_ss = parseFloat($('.final_cost_wo_sales').val());
        if(isNaN(sp_ss)) {
            var sp_ss = 0.00;
        }
        $('.sp_ss').val(sp_ss.toFixed(2));
        
        var ttl_profit = (exchange_rate_final/sp_ss)*100;
        if(isNaN(ttl_profit)) {
            var ttl_profit = 0.00;
        }
        $('.profit_percentage').val(ttl_profit.toFixed(2));
        
      
       }
  });
  
$(document).on('keyup','.sp_ss',function(){
        var sp = $(this).val();
        var ttl_cost = parseFloat($('#grandTotal').val());
        var exch_rate = parseFloat($('.exch_rate').val());
        var total = ttl_cost*exch_rate;
        var duty_cost = parseFloat($('.duty_cost').val());
        var shipping_cost = parseFloat($('.shipping_cost').val());
        var exchange_rate = parseFloat($('.exchange_rate').val());
        var final_cost_wo_sales = parseFloat($('.final_cost_wo_sales').val());
        var sales_percent = parseFloat($('.sales_percent').val());
        if(sales_percent==0 || sales_percent==0.00){
            var sales_final = 0;
        }
        else{
            var sales_final = final_cost_wo_sales/sales_percent;
        }
        var profit = (sp-total-duty_cost-shipping_cost-exchange_rate-sales_final).toFixed(2);
        var percent = ((profit/sp)*100).toFixed(2);
        $('.exchange_rate_final').val(profit);
        $('.profit_percentage').val(percent);
  })
  
  $(document).on('keyup','.markup_percent',function(){
          var percent = parseFloat($('.markup_percent').val());
          var total = parseFloat($('#grandTotal').val());
          var markup = (total*(percent/100))+total;
          if(isNaN(markup)) {
                    var markup = 0.00;
                    }
          $('.markup_cost').val(markup.toFixed(2));
          
          var rate = parseFloat($('.exch_rate').val());
          var markup_cost = parseFloat($('.markup_cost').val());
          var usd_cost = rate*markup_cost;
          if(isNaN(usd_cost)) {
                    var usd_cost = 0.00;
                    }
          $('.usd_cost').val(usd_cost.toFixed(2));
          
        var percent = $('.exch_percent').val();
        var usd_cost = $('.usd_cost').val();
        var duty_cost = $('.duty_cost').val();
        var shipping_cost = $('.shipping_cost').val();
        var exchange_rate = (parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost))*parseFloat(percent)/100;
        if(isNaN(exchange_rate)) {
            var exchange_rate = 0.00;
        }
        $('.exchange_rate').val(exchange_rate.toFixed(2));
        var final = parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost)+exchange_rate;
        if(isNaN(final)) {
            var final = 0.00;
        }
        $('.final_cost_wo_sales').val(final.toFixed(2));
        
        var percent = parseFloat($('.sales_percent').val());
        var final_cost_wo = parseFloat($('.final_cost_wo_sales').val());
        var total = (final_cost_wo*percent/100)+final_cost_wo;
        if(isNaN(total)) {
            var total = 0.00;
        }
        $('.final_cost_w_sales').val(total.toFixed(2));
        
        var markup_percent = parseFloat($('.markup_percent').val());
        var total_cost = parseFloat($('#grandTotal').val());
        var profit = (markup_percent/100)*total_cost;
        if(isNaN(profit)) {
            var profit = 0.00;
        }
        $('.prof_per_piece').val(profit.toFixed(2));
        
        var exchange_rate_percent = parseFloat($('.exchange_rate_final_percent').val());
        var prof_per_piece = parseFloat($('.prof_per_piece').val());
        var exchange_rate_final = exchange_rate_percent*prof_per_piece;
        if(isNaN(exchange_rate_final)) {
            var exchange_rate_final = 0.00;
        }
        $('.exchange_rate_final').val(exchange_rate_final.toFixed(2));
        
        var sp_ss = parseFloat($('.final_cost_wo_sales').val());
        if(isNaN(sp_ss)) {
            var sp_ss = 0.00;
        }
        $('.sp_ss').val(sp_ss.toFixed(2));
        
        var ttl_profit = (exchange_rate_final/sp_ss)*100;
        if(isNaN(ttl_profit)) {
            var ttl_profit = 0.00;
        }
        $('.profit_percentage').val(ttl_profit.toFixed(2));
        
      
  })
  
  $(document).on('keyup','.final_cost_wo_sales',function(){
          var percent = parseFloat($('.markup_percent').val());
          var total = parseFloat($('#grandTotal').val());
          var markup = (total*(percent/100))+total;
          if(isNaN(markup)) {
                    var markup = 0.00;
                    }
          $('.markup_cost').val(markup.toFixed(2));
          
          var rate = parseFloat($('.exch_rate').val());
          var markup_cost = parseFloat($('.markup_cost').val());
          var usd_cost = rate*markup_cost;
          if(isNaN(usd_cost)) {
                    var usd_cost = 0.00;
                    }
          $('.usd_cost').val(usd_cost.toFixed(2));
          
        var percent = $('.exch_percent').val();
        var usd_cost = $('.usd_cost').val();
        var duty_cost = $('.duty_cost').val();
        var shipping_cost = $('.shipping_cost').val();
        var exchange_rate = (parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost))*parseFloat(percent)/100;
        if(isNaN(exchange_rate)) {
            var exchange_rate = 0.00;
        }
        $('.exchange_rate').val(exchange_rate.toFixed(2));
        var final = parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost)+exchange_rate;
        if(isNaN(final)) {
            var final = 0.00;
        }
        $('.final_cost_wo_sales').val(final.toFixed(2));
        
        var percent = parseFloat($('.sales_percent').val());
        var final_cost_wo = parseFloat($('.final_cost_wo_sales').val());
        var total = (final_cost_wo*percent/100)+final_cost_wo;
        if(isNaN(total)) {
            var total = 0.00;
        }
        $('.final_cost_w_sales').val(total.toFixed(2));
        
        var markup_percent = parseFloat($('.markup_percent').val());
        var total_cost = parseFloat($('#grandTotal').val());
        var profit = (markup_percent/100)*total_cost;
        if(isNaN(profit)) {
            var profit = 0.00;
        }
        $('.prof_per_piece').val(profit.toFixed(2));
        
        var exchange_rate_percent = parseFloat($('.exchange_rate_final_percent').val());
        var prof_per_piece = parseFloat($('.prof_per_piece').val());
        var exchange_rate_final = exchange_rate_percent*prof_per_piece;
        if(isNaN(exchange_rate_final)) {
            var exchange_rate_final = 0.00;
        }
        $('.exchange_rate_final').val(exchange_rate_final.toFixed(2));
        
        var sp_ss = parseFloat($('.final_cost_wo_sales').val());
        if(isNaN(sp_ss)) {
            var sp_ss = 0.00;
        }
        $('.sp_ss').val(sp_ss.toFixed(2));
        
        var ttl_profit = (exchange_rate_final/sp_ss)*100;
        if(isNaN(ttl_profit)) {
            var ttl_profit = 0.00;
        }
        $('.profit_percentage').val(ttl_profit.toFixed(2));
        
      
  })
  
  $(document).on('keyup','.exch_rate',function(){
          var percent = parseFloat($('.markup_percent').val());
          var total = parseFloat($('#grandTotal').val());
          var markup = (total*(percent/100))+total;
          if(isNaN(markup)) {
                    var markup = 0.00;
                    }
          $('.markup_cost').val(markup.toFixed(2));
          
          var rate = parseFloat($('.exch_rate').val());
          var markup_cost = parseFloat($('.markup_cost').val());
          var usd_cost = rate*markup_cost;
          if(isNaN(usd_cost)) {
                    var usd_cost = 0.00;
                    }
          $('.usd_cost').val(usd_cost.toFixed(2));
          
        var percent = $('.exch_percent').val();
        var usd_cost = $('.usd_cost').val();
        var duty_cost = $('.duty_cost').val();
        var shipping_cost = $('.shipping_cost').val();
        var exchange_rate = (parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost))*parseFloat(percent)/100;
        if(isNaN(exchange_rate)) {
            var exchange_rate = 0.00;
        }
        $('.exchange_rate').val(exchange_rate.toFixed(2));
        var final = parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost)+exchange_rate;
        if(isNaN(final)) {
            var final = 0.00;
        }
        $('.final_cost_wo_sales').val(final.toFixed(2));
        
        var percent = parseFloat($('.sales_percent').val());
        var final_cost_wo = parseFloat($('.final_cost_wo_sales').val());
        var total = (final_cost_wo*percent/100)+final_cost_wo;
        if(isNaN(total)) {
            var total = 0.00;
        }
        $('.final_cost_w_sales').val(total.toFixed(2));
        
        var markup_percent = parseFloat($('.markup_percent').val());
        var total_cost = parseFloat($('#grandTotal').val());
        var profit = (markup_percent/100)*total_cost;
        if(isNaN(profit)) {
            var profit = 0.00;
        }
        $('.prof_per_piece').val(profit.toFixed(2));
        
        var exchange_rate_percent = parseFloat($('.exchange_rate_final_percent').val());
        var prof_per_piece = parseFloat($('.prof_per_piece').val());
        var exchange_rate_final = exchange_rate_percent*prof_per_piece;
        if(isNaN(exchange_rate_final)) {
            var exchange_rate_final = 0.00;
        }
        $('.exchange_rate_final').val(exchange_rate_final.toFixed(2));
        
        var sp_ss = parseFloat($('.final_cost_wo_sales').val());
        if(isNaN(sp_ss)) {
            var sp_ss = 0.00;
        }
        $('.sp_ss').val(sp_ss.toFixed(2));
        
        var ttl_profit = (exchange_rate_final/sp_ss)*100;
        if(isNaN(ttl_profit)) {
            var ttl_profit = 0.00;
        }
        $('.profit_percentage').val(ttl_profit.toFixed(2));
        
      
  })
  
    $(document).on('keyup','.shipping_cost',function(){
          var percent = parseFloat($('.markup_percent').val());
          var total = parseFloat($('#grandTotal').val());
          var markup = (total*(percent/100))+total;
          if(isNaN(markup)) {
                    var markup = 0.00;
                    }
          $('.markup_cost').val(markup.toFixed(2));
          
          var rate = parseFloat($('.exch_rate').val());
          var markup_cost = parseFloat($('.markup_cost').val());
          var usd_cost = rate*markup_cost;
          if(isNaN(usd_cost)) {
                    var usd_cost = 0.00;
                    }
          $('.usd_cost').val(usd_cost.toFixed(2));
          
        var percent = $('.exch_percent').val();
        var usd_cost = $('.usd_cost').val();
        var duty_cost = $('.duty_cost').val();
        var shipping_cost = $('.shipping_cost').val();
        var exchange_rate = (parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost))*parseFloat(percent)/100;
        if(isNaN(exchange_rate)) {
            var exchange_rate = 0.00;
        }
        $('.exchange_rate').val(exchange_rate.toFixed(2));
        var final = parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost)+exchange_rate;
        if(isNaN(final)) {
            var final = 0.00;
        }
        $('.final_cost_wo_sales').val(final.toFixed(2));
        
        var percent = parseFloat($('.sales_percent').val());
        var final_cost_wo = parseFloat($('.final_cost_wo_sales').val());
        var total = (final_cost_wo*percent/100)+final_cost_wo;
        if(isNaN(total)) {
            var total = 0.00;
        }
        $('.final_cost_w_sales').val(total.toFixed(2));
        
        var markup_percent = parseFloat($('.markup_percent').val());
        var total_cost = parseFloat($('#grandTotal').val());
        var profit = (markup_percent/100)*total_cost;
        if(isNaN(profit)) {
            var profit = 0.00;
        }
        $('.prof_per_piece').val(profit.toFixed(2));
        
        var exchange_rate_percent = parseFloat($('.exchange_rate_final_percent').val());
        var prof_per_piece = parseFloat($('.prof_per_piece').val());
        var exchange_rate_final = exchange_rate_percent*prof_per_piece;
        if(isNaN(exchange_rate_final)) {
            var exchange_rate_final = 0.00;
        }
        $('.exchange_rate_final').val(exchange_rate_final.toFixed(2));
        
        var sp_ss = parseFloat($('.final_cost_wo_sales').val());
        if(isNaN(sp_ss)) {
            var sp_ss = 0.00;
        }
        $('.sp_ss').val(sp_ss.toFixed(2));
        
        var ttl_profit = (exchange_rate_final/sp_ss)*100;
        if(isNaN(ttl_profit)) {
            var ttl_profit = 0.00;
        }
        $('.profit_percentage').val(ttl_profit.toFixed(2));
        
      
})
  
    $(document).on('keyup','.duty_cost',function(){
          var percent = parseFloat($('.markup_percent').val());
          var total = parseFloat($('#grandTotal').val());
          var markup = (total*(percent/100))+total;
          if(isNaN(markup)) {
                    var markup = 0.00;
                    }
          $('.markup_cost').val(markup.toFixed(2));
          
          var rate = parseFloat($('.exch_rate').val());
          var markup_cost = parseFloat($('.markup_cost').val());
          var usd_cost = rate*markup_cost;
          if(isNaN(usd_cost)) {
                    var usd_cost = 0.00;
                    }
          $('.usd_cost').val(usd_cost.toFixed(2));
          
        var percent = $('.exch_percent').val();
        var usd_cost = $('.usd_cost').val();
        var duty_cost = $('.duty_cost').val();
        var shipping_cost = $('.shipping_cost').val();
        var exchange_rate = (parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost))*parseFloat(percent)/100;
        if(isNaN(exchange_rate)) {
            var exchange_rate = 0.00;
        }
        $('.exchange_rate').val(exchange_rate.toFixed(2));
        var final = parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost)+exchange_rate;
        if(isNaN(final)) {
            var final = 0.00;
        }
        $('.final_cost_wo_sales').val(final.toFixed(2));
        
        var percent = parseFloat($('.sales_percent').val());
        var final_cost_wo = parseFloat($('.final_cost_wo_sales').val());
        var total = (final_cost_wo*percent/100)+final_cost_wo;
        if(isNaN(total)) {
            var total = 0.00;
        }
        $('.final_cost_w_sales').val(total.toFixed(2));
        
        var markup_percent = parseFloat($('.markup_percent').val());
        var total_cost = parseFloat($('#grandTotal').val());
        var profit = (markup_percent/100)*total_cost;
        if(isNaN(profit)) {
            var profit = 0.00;
        }
        $('.prof_per_piece').val(profit.toFixed(2));
        
        var exchange_rate_percent = parseFloat($('.exchange_rate_final_percent').val());
        var prof_per_piece = parseFloat($('.prof_per_piece').val());
        var exchange_rate_final = exchange_rate_percent*prof_per_piece;
        if(isNaN(exchange_rate_final)) {
            var exchange_rate_final = 0.00;
        }
        $('.exchange_rate_final').val(exchange_rate_final.toFixed(2));
        
        var sp_ss = parseFloat($('.final_cost_wo_sales').val());
        if(isNaN(sp_ss)) {
            var sp_ss = 0.00;
        }
        $('.sp_ss').val(sp_ss.toFixed(2));
        
        var ttl_profit = (exchange_rate_final/sp_ss)*100;
        if(isNaN(ttl_profit)) {
            var ttl_profit = 0.00;
        }
        $('.profit_percentage').val(ttl_profit.toFixed(2));
        
      
})
  
  $(document).on('keyup','.exch_percent',function(){
          var percent = parseFloat($('.markup_percent').val());
          var total = parseFloat($('#grandTotal').val());
          var markup = (total*(percent/100))+total;
          if(isNaN(markup)) {
                    var markup = 0.00;
                    }
          $('.markup_cost').val(markup.toFixed(2));
          
          var rate = parseFloat($('.exch_rate').val());
          var markup_cost = parseFloat($('.markup_cost').val());
          var usd_cost = rate*markup_cost;
          if(isNaN(usd_cost)) {
                    var usd_cost = 0.00;
                    }
          $('.usd_cost').val(usd_cost.toFixed(2));
          
        var percent = $('.exch_percent').val();
        var usd_cost = $('.usd_cost').val();
        var duty_cost = $('.duty_cost').val();
        var shipping_cost = $('.shipping_cost').val();
        var exchange_rate = (parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost))*parseFloat(percent)/100;
        if(isNaN(exchange_rate)) {
            var exchange_rate = 0.00;
        }
        $('.exchange_rate').val(exchange_rate.toFixed(2));
        var final = parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost)+exchange_rate;
        if(isNaN(final)) {
            var final = 0.00;
        }
        $('.final_cost_wo_sales').val(final.toFixed(2));
        
        var percent = parseFloat($('.sales_percent').val());
        var final_cost_wo = parseFloat($('.final_cost_wo_sales').val());
        var total = (final_cost_wo*percent/100)+final_cost_wo;
        if(isNaN(total)) {
            var total = 0.00;
        }
        $('.final_cost_w_sales').val(total.toFixed(2));
        
        var markup_percent = parseFloat($('.markup_percent').val());
        var total_cost = parseFloat($('#grandTotal').val());
        var profit = (markup_percent/100)*total_cost;
        if(isNaN(profit)) {
            var profit = 0.00;
        }
        $('.prof_per_piece').val(profit.toFixed(2));
        
        var exchange_rate_percent = parseFloat($('.exchange_rate_final_percent').val());
        var prof_per_piece = parseFloat($('.prof_per_piece').val());
        var exchange_rate_final = exchange_rate_percent*prof_per_piece;
        if(isNaN(exchange_rate_final)) {
            var exchange_rate_final = 0.00;
        }
        $('.exchange_rate_final').val(exchange_rate_final.toFixed(2));
        
        var sp_ss = parseFloat($('.final_cost_wo_sales').val());
        if(isNaN(sp_ss)) {
            var sp_ss = 0.00;
        }
        $('.sp_ss').val(sp_ss.toFixed(2));
        
        var ttl_profit = (exchange_rate_final/sp_ss)*100;
        if(isNaN(ttl_profit)) {
            var ttl_profit = 0.00;
        }
        $('.profit_percentage').val(ttl_profit.toFixed(2));
        
      
})

$(document).on('keyup','.sales_percent',function(){
          var percent = parseFloat($('.markup_percent').val());
          var total = parseFloat($('#grandTotal').val());
          var markup = (total*(percent/100))+total;
          if(isNaN(markup)) {
                    var markup = 0.00;
                    }
          $('.markup_cost').val(markup.toFixed(2));
          
          var rate = parseFloat($('.exch_rate').val());
          var markup_cost = parseFloat($('.markup_cost').val());
          var usd_cost = rate*markup_cost;
          if(isNaN(usd_cost)) {
                    var usd_cost = 0.00;
                    }
          $('.usd_cost').val(usd_cost.toFixed(2));
          
        var percent = $('.exch_percent').val();
        var usd_cost = $('.usd_cost').val();
        var duty_cost = $('.duty_cost').val();
        var shipping_cost = $('.shipping_cost').val();
        var exchange_rate = (parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost))*parseFloat(percent)/100;
        if(isNaN(exchange_rate)) {
            var exchange_rate = 0.00;
        }
        $('.exchange_rate').val(exchange_rate.toFixed(2));
        var final = parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost)+exchange_rate;
        if(isNaN(final)) {
            var final = 0.00;
        }
        $('.final_cost_wo_sales').val(final.toFixed(2));
        
        var percent = parseFloat($('.sales_percent').val());
        var final_cost_wo = parseFloat($('.final_cost_wo_sales').val());
        var total = (final_cost_wo*percent/100)+final_cost_wo;
        if(isNaN(total)) {
            var total = 0.00;
        }
        $('.final_cost_w_sales').val(total.toFixed(2));
        
        var markup_percent = parseFloat($('.markup_percent').val());
        var total_cost = parseFloat($('#grandTotal').val());
        var profit = (markup_percent/100)*total_cost;
        if(isNaN(profit)) {
            var profit = 0.00;
        }
        $('.prof_per_piece').val(profit.toFixed(2));
        
        var exchange_rate_percent = parseFloat($('.exchange_rate_final_percent').val());
        var prof_per_piece = parseFloat($('.prof_per_piece').val());
        var exchange_rate_final = exchange_rate_percent*prof_per_piece;
        if(isNaN(exchange_rate_final)) {
            var exchange_rate_final = 0.00;
        }
        $('.exchange_rate_final').val(exchange_rate_final.toFixed(2));
        
        var sp_ss = parseFloat($('.final_cost_wo_sales').val());
        if(isNaN(sp_ss)) {
            var sp_ss = 0.00;
        }
        $('.sp_ss').val(sp_ss.toFixed(2));
        
        var ttl_profit = (exchange_rate_final/sp_ss)*100;
        if(isNaN(ttl_profit)) {
            var ttl_profit = 0.00;
        }
        $('.profit_percentage').val(ttl_profit.toFixed(2));
        
      
})

$(document).on('keyup','.exchange_rate_final_percent',function(){
          var percent = parseFloat($('.markup_percent').val());
          var total = parseFloat($('#grandTotal').val());
          var markup = (total*(percent/100))+total;
          if(isNaN(markup)) {
                    var markup = 0.00;
                    }
          $('.markup_cost').val(markup.toFixed(2));
          
          var rate = parseFloat($('.exch_rate').val());
          var markup_cost = parseFloat($('.markup_cost').val());
          var usd_cost = rate*markup_cost;
          if(isNaN(usd_cost)) {
                    var usd_cost = 0.00;
                    }
          $('.usd_cost').val(usd_cost.toFixed(2));
          
        var percent = $('.exch_percent').val();
        var usd_cost = $('.usd_cost').val();
        var duty_cost = $('.duty_cost').val();
        var shipping_cost = $('.shipping_cost').val();
        var exchange_rate = (parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost))*parseFloat(percent)/100;
        if(isNaN(exchange_rate)) {
            var exchange_rate = 0.00;
        }
        $('.exchange_rate').val(exchange_rate.toFixed(2));
        var final = parseFloat(usd_cost)+parseFloat(duty_cost)+parseFloat(shipping_cost)+exchange_rate;
        if(isNaN(final)) {
            var final = 0.00;
        }
        $('.final_cost_wo_sales').val(final.toFixed(2));
        
        var percent = parseFloat($('.sales_percent').val());
        var final_cost_wo = parseFloat($('.final_cost_wo_sales').val());
        var total = (final_cost_wo*percent/100)+final_cost_wo;
        if(isNaN(total)) {
            var total = 0.00;
        }
        $('.final_cost_w_sales').val(total.toFixed(2));
        
        var markup_percent = parseFloat($('.markup_percent').val());
        var total_cost = parseFloat($('#grandTotal').val());
        var profit = (markup_percent/100)*total_cost;
        if(isNaN(profit)) {
            var profit = 0.00;
        }
        $('.prof_per_piece').val(profit.toFixed(2));
        
        var exchange_rate_percent = parseFloat($('.exchange_rate_final_percent').val());
        var prof_per_piece = parseFloat($('.prof_per_piece').val());
        var exchange_rate_final = exchange_rate_percent*prof_per_piece;
        if(isNaN(exchange_rate_final)) {
            var exchange_rate_final = 0.00;
        }
        $('.exchange_rate_final').val(exchange_rate_final.toFixed(2));
        
        var sp_ss = parseFloat($('.final_cost_wo_sales').val());
        if(isNaN(sp_ss)) {
            var sp_ss = 0.00;
        }
        $('.sp_ss').val(sp_ss.toFixed(2));
        
        var ttl_profit = (exchange_rate_final/sp_ss)*100;
        if(isNaN(ttl_profit)) {
            var ttl_profit = 0.00;
        }
        $('.profit_percentage').val(ttl_profit.toFixed(2));
        
        
})
</script>