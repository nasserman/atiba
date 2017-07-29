<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* inputs :
*   string $error
*   \Paziresh_model $paziresh
*/
?>


<div class="uk-panel uk-width-1-1">
    <?php
    echo'<h3 class="uk-panel-title">پذیرش</h3>';
    ?>
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
            <div class="uk-panel uk-panel-box">

                <div class="uk-form-row">
                    <label class="uk-form-label" for="name">نام:</label>
                    <input type="text" id="name" name="name" style="text-align:right;direction:rtl;"  value="<?php echo ""; ?>" />
                </div>

                <div class="uk-form-row" style="text-align:left;">
                    <div class="uk-button-group">
                        <button type="button" class="uk-button save-btn uk-button-success" onclick="save()">ثبت و ذخیره</button>
                        <button type="button" class="uk-button uk-button-default" onclick="$.colorbox.close();">بستن</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php } ?>

</div>





<script>
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
