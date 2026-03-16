<style>
    .product_performance_container .d-none{
         display: none !important;
    }
    .search-bar {
        background: #F5F5F5;
        border-radius: 6px;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        margin-top: 10px;
    }

    .search-bar .w-fit {
        width: fit-content !important;
    }

    .search-label {
        font-size: 13px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .search-bar select,
    .search-bar input {
        height: 32px;
        font-size: 13px;
    }

    .narrow-select {
        width: 90px;
        /* smaller width for ==All== */
    }

    .search-input {
        min-width: 280px;
        /* larger input for typing */
    }

    .search-bar button {
        height: 32px;
        font-size: 13px;
        padding: 0 16px;
    }

    .product_performance_table {
        border: 1px solid #CCCCCC;
        border-radius: 8px;
        overflow: hidden;
        border-collapse: unset;
    }

    .product_performance_table thead {
        background-color: #999955 !important;
    }

    .product_performance_table thead th {
        color: #fff;
    }

    .table>thead>tr>th {
        border: none !important;
    }

    .product_performance_table .tfoot {
        background-color: #555555;
    }

    .product_performance_table .tfoot td {
        color: #fff;
    }

    .product_main_div{
        display: flex;
        justify-content: right;
    }
    .actual_product_div {
    width: 45%;
    margin: 10px 0;

    } 
    .actual_product_div select{
        
         /* text-align: left; */

         
    }
</style>



<div class="row  product_performance_container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title d-flex gap4">
                <h2>Estimate > <?php echo $page_title; ?></h2>
            </div>





            <!-- Tab -->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#table_view" aria-controls="table_view" role="tab" data-toggle="tab">Table</a>
                </li>
                <li role="presentation">
                    <a href="#chart_data" id="chart_data_btn" aria-controls="chart_data" role="tab" data-toggle="tab">Chart</a>
                </li>
            </ul>


            <!-- Filter  -->
            <div class="search-bar">
                <div class="search-label">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/Vector.png" alt="" srcset="">
                    Search For
                </div>

                <select name="" id="year_filter" class="form-control input-sm w-fit ">
                    <option value="">===Select Year ====</option>
                    <?
                    foreach ($year as $key => $value) {
                    ?>
                        <option value="<?= $value['year'] ?>"><?= $value['year'] ?></option>
                    <?
                    }
                    ?>
                </select>


                <div class="w-fit">
                    <input type="text" name="" class="form-control input-sm search-input" id="product_name_input" placeholder="Type to search product..." list="product_name">

                    <datalist id="product_name"></datalist>
                </div>
                <!-- <select name="product_name" id="product_name" class="form-control"></select> -->

                <select name="" id="customer_name" class="form-control  input-sm ">
                    <option value="">=== Select Customer Name ===</option>   
                    
                </select>



                <select name="" id="currency_name" class="form-control input-sm w-fit">
                    <option value="">====Select Currency====</option>

                    <?
                    foreach ($currency as $key => $value) {
                    ?>
                        <option value="<?= $value['curr_id'] ?>"> <?= $value['curr_name'] ?> <?= $value['curr_desc'] ?></option>
                    <?
                    }
                    ?>
                </select>

                <button class="btn btn-sm btn-success search_btn">Search</button>
            </div>
            <!--  -->

         

            <!-- Tab panes -->
            <div class="product_main_div">
            <div class="actual_product_div form-group d-none">
              <select id="act_product_name"  class="form-select sales_person_selection text-left">
                  <option value="">  ====Select Sub Product==== </option>
              </select>
             </div>
             </div> 

            <div class="tab-content"   style="margin-top:15px;">

                <div role="tabpanel" class="tab-pane active" id="table_view"></div>

                <div role="tabpanel" class="tab-pane" id="chart_data">
                    <p class="product_name"></p>
                    <label for="chartTypeSelect">Metrics:</label>
                    <select id="chartTypeSelect" class="form-control" style="width:200px; margin-bottom:15px;">
                        <option value="1">Price Trend</option>
                        <option value="2">Qty Sold </option>
                        <option value="3">Top Customers - By Spend </option>
                        <option value="4">Top Customers - By Qty </option>
                    </select>


                    <canvas id="myChart" height="120"></canvas>
                </div>
                <input type="hidden" name="" id="priceTrends">
                <input type="hidden" name="" id="topCustomer">
                <input type="hidden" name="" id="customer_qty">
            </div>


        </div>





        <!--  -->
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.5.0/chart.umd.min.js"></script>

<!-- chart js  -->
<script>
    let myChart = null;
    var priceTrends = [];
    $(document).on('click', '#chart_data_btn', function(event) {
        event.preventDefault();

        LoadChartDefault();
    })

    $(document).on('change', '#chartTypeSelect', function() {
        LoadChartDefault();
    })

    function LoadChartDefault() {
        priceTrends = JSON.parse($('#priceTrends').val());
        let years = priceTrends.map(item => item.year);
        let price = priceTrends.map(data => data.avg_price);
        let qty = priceTrends.map(data => data.total_qty);
        let selectedValue = $('#chartTypeSelect').val();

        if (selectedValue == '1') {
            ShowChart(years, price, 'line', 'Price Trend');
        } else if (selectedValue == '2') {
            ShowChart(years, qty, 'bar', 'Qty Sold');
        } else if (selectedValue == '3') {
            let topCustomer = JSON.parse($('#topCustomer').val());
            // console.log(topCustomer);  


            const customers = [...new Set(topCustomer.map(item => item.customer))];

            // 2. Extract all unique currencies
            const currencies = [...new Set(topCustomer.map(item => item.currency))];

            // 3. Color palette for currencies
            const colors = [
                "rgba(75, 192, 192, 0.6)",
                "rgba(153, 102, 255, 0.6)",
                "rgba(255, 159, 64, 0.6)",
                "rgba(255, 99, 132, 0.6)"
            ];

            // 4. Build datasets for each currency
            const datasets = currencies.map((currency, index) => {
                return {
                    label: currency,
                    data: customers.map(customer => {
                        const found = topCustomer.find(
                            item => item.customer === customer && item.currency === currency
                        );
                        return found ? found.totprice : 0; // 0 if no data for that customer+currency
                    }),
                    backgroundColor: colors[index % colors.length],
                    borderColor: colors[index % colors.length].replace("0.6", "1"),
                    borderWidth: 1
                };
            });



            // let customer = topCustomer.map(item => item.customer);
            // let customer_price = topCustomer.map(item => item.totprice);
            ShowChart(customers, [], 'bar', 'Top Customer By Spend', datasets);
        } else if (selectedValue == '4') {
            let topCustomer = JSON.parse($('#customer_qty').val());
            let customer = topCustomer.map(item => item.customer);
            let customer_price = topCustomer.map(item => item.total_qty);
            ShowChart(customer, customer_price, 'bar', 'Top Customer By Qty');
        }
    }


    function ShowChart(label, data, type, name, datasets = false) {
        const ctx = document.getElementById('myChart').getContext('2d');
        if (myChart) {
            myChart.destroy();
        }

        // Generate dynamic colors for each bar
        let backgroundColors = data.map(() =>
            `rgba(${Math.floor(Math.random()*255)}, ${Math.floor(Math.random()*255)}, ${Math.floor(Math.random()*255)}, 0.6)`
        );
        let borderColors = backgroundColors.map(color => color.replace('0.6', '1'));
        let dt_sets = !datasets ? [{
            label: name,
            data: data,
            borderColor: borderColors,
            backgroundColor: backgroundColors,
            borderWidth: 2,
            // tension: 0.3 , 
            barPercentage: 0.5, // width of each bar (0 → very thin, 1 → full width)
            categoryPercentage: 0.8 // space taken by group of ba
        }] : datasets;

        // Line chart for sold qty
        myChart = new Chart(ctx, {
            type: type,
            data: {
                labels: label,
                datasets: dt_sets
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },

                onClick: (event, elements) => {
                    if (elements.length > 0) {
                        const element = elements[0]; // clicked bar
                        const datasetIndex = element.datasetIndex;
                        const dataIndex = element.index;

                        const label = myChart.data.labels[dataIndex];
                        const value = myChart.data.datasets[datasetIndex].data[dataIndex];

                        ViewFilterData(label);
                    }
                },
            }
        })
    }

    function ViewFilterData(label = 0) {
        let selectedValue = $('#chartTypeSelect').val();
        var year_value = customer_value = 0;
        let customer = $('#customer_name').val();
       
        if (selectedValue == '1' || selectedValue == '2' || customer) {
            year_value = label;
        } else if ((selectedValue == '3' || selectedValue == '4') && !customer) {
            customer_value = label;
        }
        let productname = $('#product_name_input').val();
        let year = $('#year_filter').val() ? $('#year_filter').val() : year_value;
        let customer_dt = customer ? customer : customer_value;
        let currency_name = $('#currency_name').val();

        console.log(productname);
        console.log(year);
        console.log(customer_dt);
        console.log(currency_name);
       



        // Encode values to make sure URL is valid
        let url = "GetProductPerformanceFilterData?productname=" + encodeURIComponent(productname) + "&year=" + encodeURIComponent(year) +
            "&customer_name=" + encodeURIComponent(customer_dt) + "&currency_name=" + encodeURIComponent(currency_name);


        // Open in new tab
        window.open(url, '_blank');
    }
</script>



<script>

    $(document).ready(function(){
           GetCustomerListByProdudct();
    });

    $(document).on('keypress', '#product_name_input', function() {
         // Clear the previous time
            GetYearProductList();           // Call your function after delay
    });

    function GetYearProductList() {

        let productname = $('#product_name_input').val();
        showLoader();
        $.ajax({
            url: "getYearProductList",
            type: "POST", // or "GET"
            dataType: 'json',
            data: {
                productname: productname
            },

            success: function(response) {
                $('#product_name').html(response.html);
                hideLoader();
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                hideLoader();
            },

        });

    }

    function GetCustomerListByProdudct(customer_name=0){
        let product = $('#product_name_input').val();
        showLoader();
        $.ajax({
            url: "GetCustomerListByProdudct",
            type: "POST", // or "GET"
            dataType: 'json',
            data: {
                product: product,  
                customer_name :customer_name 
            },

            success: function(response) {
                if(product){
                    $('.actual_product_div').removeClass('d-none');
                    $('#act_product_name').html(response.product_opt);
                }
                $('#customer_name').html(response.option);
                hideLoader();
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                hideLoader();
            },

        }); 
    }

    $(document).on('click', '.search_btn', function() {
        GetProductList();
    });

    $(document).on('click', '.paginationBtns', function() {
        $('.paginationBtns').removeClass('active');
        $(this).addClass('active');
        GetProductList();
    });

    $(document).on('change' ,'#act_product_name' ,function(){
         GetProductList();
    })

    function GetProductList() {
        let product = $('#product_name_input').val();
        let customer_name = $('#customer_name').val();
        let currency = $('#currency_name').val();
        let page = $('.paginationBtns.active').attr('href');
        let year = $('#year_filter').val();
        let actual_product = $('#act_product_name').val(); 
  
        showLoader();
        $.ajax({
            url: "GetProductList",
            type: "POST", // or "GET"
            dataType: 'json',
            data: {
                product: product,
                customer_name: customer_name,
                currency: currency,
                page: page,
                year: year,
                actual_product : actual_product
            },

            success: function(response) {
                if(!actual_product){
                    GetCustomerListByProdudct(customer_name);
                }
                // console.log("Success:", response);
                $('#table_view').html(response.html);
                $('#priceTrends').val(JSON.stringify(response.priceTrends));
                $('#topCustomer').val(JSON.stringify(response.topCustomer));
                $('#customer_qty').val(JSON.stringify(response.customer_qty));
                $('#chart_data').find('.product_name').text(response.product_name);
                // Check if chart tab is active before showing chart
                if ($('#chart_data').hasClass('active')) {
                    LoadChartDefault();
                }
                

                hideLoader();

            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                hideLoader();

            },

        });

    }


</script>