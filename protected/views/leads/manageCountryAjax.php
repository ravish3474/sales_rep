<div class="table-responsive manageCountryTableMain ">

    <table class="table table-bordered  all_leads_table">
        <thead>
            <tr>

                <th class="text-center">SNo.</th>
                <th style="text-align: left;">Name</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>

        <tbody class="">
            <?
            if (count($data)) {
                foreach ($data as $key => $value) {
            ?>
                    <tr>
                        <td><?= ++$key ?></td>
                        <td style="text-align: left;"><?= $value['country_name'] ?></td>
                        <td>
                            <button data-val_id="<?= $value['id'] ?>" data-name="<?= $value['country_name'] ?>" class="editbtn btn btn-success"> Edit</button>
                        </td>
                    </tr>
                <?
                }
            } else {
                ?>
                <tr>
                    <td colspan="3" class="text-center">No data found!</td>
                </tr>
            <?
            }

            ?>

        </tbody>


    </table>

</div>