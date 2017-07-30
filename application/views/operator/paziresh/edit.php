<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* inputs :
*   string $error
*   \Paziresh_model $paziresh
*       + \Profile_bimar_model profile_bimar
*/
?>


<div class="uk-panel uk-width-1-1">
    <h3 class="uk-panel-title">پذیرش</h3>

    <?php if($error) { ?>
    <div class="uk-alert uk-alert-danger" data-uk-alert>
        <a href="" class="uk-alert-close uk-close"></a>
        <p><?php echo $error; ?></p>
    </div>
    <?php } else { ?>

    <div class="uk-form-row uk-container-center">
        <form class="uk-form uk-form-horizontal" id="edit-frm">
            <?php ajax_setup(true); ?>
            <input type="hidden" name="id_paziresh" value="<?php echo $paziresh->PK(); ?>" />


            <div class="uk-width-1-2" style="display:inline-block;">
                <div class="uk-form-row">
                    <label class="uk-form-label">بیمار:</label>
                    <?php echo $paziresh->profile_bimar->name. " " . $paziresh->profile_bimar->lastname; ?>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label">وضعیت پذیرش:</label>
                    <?php echo Paziresh_model::vaziathaye_paziresh($paziresh->vaziat); ?>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="vaziathaye_paziresh">بیمه:</label>
                    <input type="text" id="vaziathaye_paziresh" name="vaziathaye_paziresh"  value="<?php echo $paziresh->onvane_bime; ?>" />
                </div>
            </div>


            <div class="uk-width-1-2" style="display:inline-block;">
                <div class="uk-form-row">
                    <label class="uk-form-label" for="time_paziresh">تاریخ پذیرش:</label>
                    <?php $_time_paziresh = "";
                    if($paziresh->time_paziresh > 0){
                        $_time_paziresh =  jdate('Y/m/d' , $paziresh->time_paziresh , '' , 'Asia/Tehran' , 'en');
                    } ?>
                    <input type="text" id="time_paziresh" name="time_paziresh" style="text-align:left;direction:ltr;"
                    placeholder="____/__/__"  value="<?php echo $_time_paziresh; ?>" />
                </div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="time_paziresh_saat">ساعت پذیرش:</label>
                    <?php
                    if($paziresh->time_paziresh > 0){
                        $_time_paziresh = jdate('H:i' , $paziresh->time_paziresh , '' , 'Asia/Tehran' , 'en');
                    } ?>
                    <input type="text" id="time_paziresh_saat" name="time_paziresh_saat" style="text-align:left;direction:ltr;"
                    placeholder="__:__" value="<?php echo $_time_paziresh; ?>" />
                </div>
            </div>


            <div class="uk-form-row" style="text-align:left;">
                    <div class="uk-button-group">
                        <button type="button" class="uk-button save-btn uk-button-success" onclick="save()">ثبت و ذخیره</button>
                        <button type="button" class="uk-button uk-button-default" onclick="$.colorbox.close();">بستن</button>
                    </div>
                </div>
        </form>
    </div>

    <?php } ?>

</div>





<script>
$(function(){
    $('#time_paziresh').mask('0000/00/00');
    $('#time_paziresh_saat').mask('00:00');
});
// -----------------------------------------------------------------------------
function save()
{
    $('.save-btn').attr("disabled" , "disabled");
    var req = $.ajax({
        url : "<?php echo site_url('operator/paziresh/save'); ?>",
        data : $("#edit-frm").serializeArray(),
        type : "POST",
        dataType : "json"
    });

    req.fail(function(){
        UIkit.notify({
            message : 'خطایی در ارسال یا دریافت اطلاعات رخ داده است. #2159',
            status  : 'danger',
            timeout : 5000,
            pos     : 'top-left'
        });
        $('.save-btn').removeAttr("disabled");
    });

    req.done(function(data){
        if(data.code > 0){
            $.colorbox.close();
            search();
        }
        else {
            $('.save-btn').removeAttr("disabled");
            UIkit.notify({
                message : data.message + " : " + data.code,
                status  : 'warning',
                timeout : 5000,
                pos     : 'top-left'
            });
        }
    });
}
// -----------------------------------------------------------------------------

</script>
