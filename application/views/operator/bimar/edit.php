<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* inputs :
*   string $error
*   \Profile_bimar_model $profile_bimar
*   string $callback_function
*/
?>


<div class="uk-panel uk-width-1-1">
    <?php
    echo'<h3 class="uk-panel-title">ویرایش پروفایل بیمار</h3>';
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
            <input type="hidden" name="id_profile_bimar" value="<?php echo $profile_bimar->PK(); ?>" />
            <div class="uk-panel uk-panel-box">

                <div class="uk-form-row">
                    <label class="uk-form-label" for="name">نام:</label>
                    <input type="text" id="name" name="name" style="text-align:right;direction:rtl;"  value="<?php echo $profile_bimar->name; ?>" />
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="lastname">نام خانوادگی:</label>
                    <input type="text" id="lastname" name="lastname" style="text-align:right;direction:rtl;"  value="<?php echo $profile_bimar->lastname; ?>" />
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="name_pedar">نام پدر:</label>
                    <input type="text" id="name_pedar" name="name_pedar" style="text-align:right;direction:rtl;"  value="<?php echo $profile_bimar->name_pedar; ?>" />
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="jensiat">جنسیت:</label>
                    <select id="jensiat" name="jensiat">
                        <option value="n" <?php echo $profile_bimar->jensiat === "n" ? "selected" : ""; ?> >تعیین نشده</option>
                        <option value="f" <?php echo $profile_bimar->jensiat === "f" ? "selected" : ""; ?> >زن</option>
                        <option value="m" <?php echo $profile_bimar->jensiat === "m" ? "selected" : ""; ?> >مرد</option>
                    </select>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="codemelli">کد ملی:</label>
                    <input type="text" id="codemelli" name="codemelli" style="text-align:center;direction:ltr;"  value="<?php echo $profile_bimar->codemelli; ?>" />
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="adres">آدرس:</label>
                    <input type="text" id="adres" name="adres" style="text-align:right;direction:rtl;"  value="<?php echo $profile_bimar->adres; ?>" />
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="tel">تلفن ثابت:</label>
                    <input type="text" id="tel" name="tel" style="text-align:left;direction:ltr;"  value="<?php echo $profile_bimar->tel; ?>" />
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="mobile">شماره موبایل:</label>
                    <input type="text" id="mobile" name="mobile" style="text-align:left;direction:ltr;"  value="<?php echo $profile_bimar->mobile; ?>" />
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
        url : "<?php echo site_url('operator/bimar/save'); ?>",
        data : $("#edit-frm").serializeArray(),
        type : "POST",
        dataType : "json"
    });

    req.fail(function(){
        UIkit.notify({
            message : 'خطایی در ارسال یا دریافت اطلاعات رخ داده است. #1334',
            status  : 'danger',
            timeout : 5000,
            pos     : 'top-left'
        });
        $('.save-btn').removeAttr("disabled");
    });

    req.done(function(data){
        if(data.code > 0){
            // $.colorbox.close();
            var callback_function = "<?php echo $callback_function; ?>";
            callback_function = callback_function.replace("pk" , data.pk);
            eval(callback_function);
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
