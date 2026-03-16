<script>
$(document).ready(function() {
    $('#cloneTable').DataTable( {
        dom: 'Bfrtip',
    } );
} );
</script>
<table class="table" id="cloneTable">
    <thead>
      <tr>
        <th>#</th>
        <th>Original Draft</th>
        <th>New Draft Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        foreach($fetcher as $main){
        ?>
        <tr>
            <td><?=$count?></td>
            <td><?=$main['draft_name']?></td>
            <td><input type="text" id="draft_name_<?=$main['calc_id']?>"></td>
            <td><button class="btn btn-primary clone_it" calc_id="<?=$main['calc_id']?>" item_id="<?=$main_item_id?>">Clone</button></td>
        </tr>
        <?php
        $count++;
        }
        ?>
    </tbody>
</table>