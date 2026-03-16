

<table class="table product_performance_table">
    <thead class="bg-success">
        <tr>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Customer</th>
            <th scope="col">Qty</th>
            <th scope="col">Year</th>
            <!-- <th scope="col">Currency</th> -->
        </tr>
    </thead>
    <tbody>
        <?
        foreach ($data as $key => $value) {
        ?>
            <tr>
                <td><?=$value['pro_name']?></td>
                <td><?=$value['uprice']?></td>
                <td><?=$value['cust_name']?></td>
                <td><?=$value['qty']?></td>
                <td><?=date('Y' , strtotime($value['add_date']))?></td>
                <!-- <td><?=$value['quote_curr']?></td> -->

            </tr>
        <?
        }

        ?>

    </tbody>
    <tfoot class="tfoot">
        <tr>
            <td>Grand Total</td>
            <td colspan="3"> <?=$grandTotal['sum']?></td>
            <td colspan="3"> <?=$grandTotal['total_qty']?></td>

        </tr>
    </tfoot>
</table>


<div class="main_pagination_container d-flex align-items-center" style="justify-content: space-between;">
    <?php 
        $start_number = $pagination_arr['start_number'];
        $end_number = $pagination_arr['end_number'];
        $totalDataCounnt = $pagination_arr['totalCount']; 
        $currentPage = $pagination_arr['currentPage']; 
        $totalPages = $pagination_arr['totalPages'];
    ?>
    <div>
        <p>Showing <? echo $start_number ?> to <? echo $end_number ?> of <? echo $totalDataCounnt ?> entries</p>
    </div>
    
    <?php
        $buttonsPerPage = 5;
        $currentBlock = ceil($currentPage / $buttonsPerPage);
        $startPage = ($currentBlock - 1) * $buttonsPerPage + 1;
        $endPage = min($startPage + $buttonsPerPage - 1, $totalPages);
     ?>
    <div class="pagination-container">
        <?php if ($currentPage > 1): ?>
            <!-- <button type="button" href="1" class="paginationBtns">First</button> -->
            <button type="button" href="<?= $currentPage - 1 ?>" class="paginationBtns">Previous</button>
        <?php else: ?>
            <span>First</span>
            <span>Previous</span>
        <?php endif; ?>

        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
            <button type="button" href="<?= $i ?>" class="paginationBtns <?= $i == $currentPage ? 'active' : '' ?>">
                <?= $i ?>
            </button>
        <?php endfor; ?>

        <?php if ($endPage < $totalPages): ?>
            <p disable class=" dot_text">....</p>
            <button type="button" href="<?= $endPage + 1 ?>"  class="paginationBtns nextBlock">
               <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            </button>
        <?php endif; ?>

        <?php if ($currentPage < $totalPages): ?>
            <button type="button" href="<?= $currentPage + 1 ?>" class="paginationBtns">Next</button>
            <!-- <button type="button" href="<?= $totalPages ?>" class="paginationBtns">Last</button> -->
        <?php else: ?>
            <span>Next</span>
            <span>Last</span>
        <?php endif; ?>
    </div>

</div>




