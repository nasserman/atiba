<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* inputs :
*   [\User_model] $operatorha
*       + \Profile_user_model profile
*/
?>




<div class="uk-panel uk-width-1-1">
    <h3 class="uk-panel-title">لیست اپراتورها (فروشنده‌ها)</h3>


    <div class="uk-form-row" style="text-align:left;">
        <button type="button" onclick="edit(-1);" class="uk-button uk-button-primary" >تعریف اپراتور جدید</button>
    </div>

    <div class="uk-form-row results-div">
        <?php if(count($operatorha) < 1) { ?>
            هیچ اپراتور (فروشنده‌ای) وجود ندارد.
        <?php } else { ?>
            <table class="uk-table">
                <thead>
                    <tr>
                        <th style="text-align:right;">نام/نام خانوادگی</th>
                        <th style="text-align:right;">نام کاربری</th>
                        <th style="text-align:right;">ایمیل</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($operatorha as $item) { ?>
                        <tr>
                            <td><?php echo $item->profile->name. " " . $item->profile->lastname; ?></td>
                            <td><?php echo $item->get_username(); ?></td>
                            <td><?php echo $item->email; ?></td>
                            <td>
                                <button type="button" class="uk-button uk-button-small" onclick="edit(<?php echo $item->PK();?>)" >ویرایش</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        <?php } ?>
    </div>
</div>


<script>
function edit(id_user){
    var href = "<?php echo site_url("admin/operator/edit/"); ?>"+id_user;
    $.colorbox({href:href , width:'700px'});
}
</script>
