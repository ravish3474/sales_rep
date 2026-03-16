<style type="text/css">

	#tbl_addi_sorting th{
		color:#FFF;
		background-color: #737;
		padding: 5px;
		border:1px solid #959;

	}
	#tbl_addi_sorting td{
		color:#000;
		background-color: #FFF;
		padding: 5px;
		border:1px solid #959;
	}
	.action_col{
		border-width: 0px !important;
		background-color: unset !important;
		font-size: 18px;
		color:#F00 !important;
	}

	#inner_addi_sorting tr{
		cursor: grab;
	}
	#inner_addi_sorting tr:active:hover{
		cursor: grabbing;
	}

	#inner_addi_sorting tr:active td.fix_width1{
		width: 30px;
	}
	#inner_addi_sorting tr:active td.fix_width2{
		width: 325px;
	}
	#inner_addi_sorting tr:active td.fix_width3{
		width: 80px;
	}
</style>
<center style="color:#F00;">***Grab the rows and drag for sorting items***</center>
<table style="width: 100%;" id="tbl_addi_sorting">
    <tbody>
        <tr>
            <th style="width: 30px; text-align: center;">#</th>
            <th >Name</th>
            <th style="width: 80px; text-align: center;">Value</th>
            <th style="width: 30px; text-align: center;" class="action_col"></th>
        </tr>
    </tbody>
    <tbody id="inner_addi_sorting">
        <?php
        for($i=0;$i<sizeof($a_addi);$i++){
        ?>
        <tr id="tr_addi_row<?php echo $a_addi[$i]["addi_id"]; ?>">
            <td class="fix_width1" style="text-align: center;"><?php echo ($i+1);?>
                <input type="hidden" name="sort_addi_id[]" value="<?php echo $a_addi[$i]["addi_id"]; ?>">
            </td>
            <td class="fix_width2"><?php echo $a_addi[$i]["addi_name"];?></td>
            <td class="fix_width3" style="text-align: center;"><?php echo $a_addi[$i]["addi_value"]; ?></td>
            <td style="text-align: center;" class="action_col">
            	<i class="fa fa-minus-circle" style="cursor: pointer;" onclick="return deleteAddiItemV2(<?php echo $a_addi[$i]["addi_id"]; ?>);"></i>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<br>
<div style="text-align: center;">
	<button style="padding: 3px 10px;" type="button" class="btn btn-success" onclick="return saveSortAddi();">Save sort</button>
</div>