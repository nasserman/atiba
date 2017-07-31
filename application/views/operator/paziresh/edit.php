<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* inputs :
*   string $randomkey
*   string $error
*   \Paziresh_model $paziresh
*       + \Profile_bimar_model profile_bimar
*/
?>


<div class="uk-panel uk-width-1-1" id="<?php echo $randomkey; ?>">
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

            <div class="uk-form-row">
                <div style="display:inline-block;width:49%;">
                    <div class="uk-form-row">
                        <label class="uk-form-label">بیمار:</label>
                        <?php echo $paziresh->profile_bimar->name. " " . $paziresh->profile_bimar->lastname; ?>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label">وضعیت پذیرش:</label>
                        <?php echo Paziresh_model::vaziathaye_paziresh($paziresh->vaziat); ?>
                    </div>
                </div>


                <div style="display:inline-block;width:49%;vertical-align:top;">
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="time_paziresh">تاریخ پذیرش:</label>
                        <?php $_time_paziresh = "";
                        if($paziresh->time_paziresh > 0){
                            $_time_paziresh =  jdate('Y/m/d' , $paziresh->time_paziresh , '' , 'Asia/Tehran' , 'en');
                        } ?>
                        <input type="text" id="time_paziresh" name="time_paziresh" style="text-align:left;direction:ltr;width:90px;"
                        placeholder="____/__/__"  value="<?php echo $_time_paziresh; ?>" />
                        <?php
                        if($paziresh->time_paziresh > 0){
                            $_time_paziresh = jdate('H:i' , $paziresh->time_paziresh , '' , 'Asia/Tehran' , 'en');
                        } ?>
                        <input type="text" id="time_paziresh_saat" name="time_paziresh_saat" style="text-align:left;direction:ltr;width:50px;"
                        placeholder="__:__" value="<?php echo $_time_paziresh; ?>" />
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="vaziathaye_paziresh">بیمه:</label>
                        <input type="text" id="vaziathaye_paziresh" name="vaziathaye_paziresh"  value="<?php echo $paziresh->onvane_bime; ?>" />
                    </div>
                </div>
            </div>

            <hr/>

            <div class="uk-form-row">
                <div style="width:49%;display:inline-block;vertical-align:top;">
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="hazineye_vizit">مبلغ ویزیت:</label>
                        <input type="text" id="hazineye_vizit" name="hazineye_vizit" class="rial" onchange="mohasebe<?php echo "_$randomkey"; ?>();" value="<?php echo number_format($paziresh->hazineye_vizit , 0 , "." , ","); ?>" />ریال
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="takhfif">تخفیف:</label>
                        <input type="text" id="takhfif" name="takhfif" class="rial" onchange="mohasebe<?php echo "_$randomkey"; ?>();" value="<?php echo number_format($paziresh->takhfif , 0 , "." , ","); ?>" />ریال
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label">قابل پرداخت:</label>
                        <span id="mablage_gabele_pardakht"><?php echo number_format($paziresh->mablage_gabele_pardakht , 0 , "." , ","); ?></span>ریال
                    </div>
                </div>
                <div style="width:49%;display:inline-block;">
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="mablage_pardakht_shodeye_kartkhan">پرداخت کارت‌خوان:</label>
                        <input type="text" id="mablage_pardakht_shodeye_kartkhan" name="mablage_pardakht_shodeye_kartkhan" onchange="mohasebe<?php echo "_$randomkey"; ?>();" class="rial" value="<?php echo number_format($paziresh->mablage_pardakht_shodeye_kartkhan , 0 , "." , ","); ?>" />ریال
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="mablage_pardakht_shodeye_nagdi">پرداخت نقدی:</label>
                        <input type="text" id="mablage_pardakht_shodeye_nagdi" name="mablage_pardakht_shodeye_nagdi" onchange="mohasebe<?php echo "_$randomkey"; ?>();" class="rial" value="<?php echo number_format($paziresh->mablage_pardakht_shodeye_nagdi , 0 , "." , ","); ?>" />ریال
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label">جمع پرداخت شده:</label>
                        <span id="mablage_kole_pardakht_shode"><?php echo number_format($paziresh->mablage_kole_pardakht_shode , 0 , "." , ","); ?></span>ریال
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label">باقی مانده:</label>
                        <span id="mablage_kole_bagi_mande"><?php echo number_format($paziresh->mablage_kole_bagi_mande , 0 , "." , ","); ?></span>ریال
                    </div>
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


<style>
<?php echo "#$randomkey"; ?> .rial{text-align: left;direction: ltr;}
</style>


<script>
$(function(){
    $('.rial').mask('000,000,000', {reverse: true});
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
function mohasebe<?php echo "_$randomkey"; ?>(){
    var hazineye_vizit = $("<?php echo "#$randomkey"; ?> #hazineye_vizit").val().replace(/,/g,"");
    hazineye_vizit = parseInt(hazineye_vizit);
    var takhfif = $("<?php echo "#$randomkey"; ?> #takhfif").val().replace(/,/g,"");
    takhfif = parseInt(takhfif);
    var mablage_gabele_pardakht = hazineye_vizit - takhfif;
    $("<?php echo "#$randomkey"; ?> #mablage_gabele_pardakht").html(adad_ba_jodakonande_3_ragami(mablage_gabele_pardakht));

    var mablage_pardakht_shodeye_kartkhan = $("<?php echo "#$randomkey"; ?> #mablage_pardakht_shodeye_kartkhan").val().replace(/,/g,"");
    mablage_pardakht_shodeye_kartkhan = parseInt(mablage_pardakht_shodeye_kartkhan);
    var mablage_pardakht_shodeye_nagdi = $("<?php echo "#$randomkey"; ?> #mablage_pardakht_shodeye_nagdi").val().replace(/,/g,"");
    mablage_pardakht_shodeye_nagdi = parseInt(mablage_pardakht_shodeye_nagdi);

    var mablage_kole_pardakht_shode = mablage_pardakht_shodeye_kartkhan + mablage_pardakht_shodeye_nagdi;
    var mablage_kole_bagi_mande = mablage_gabele_pardakht - mablage_kole_pardakht_shode;
    $("<?php echo "#$randomkey"; ?> #mablage_kole_pardakht_shode").html(adad_ba_jodakonande_3_ragami(mablage_kole_pardakht_shode));
    $("<?php echo "#$randomkey"; ?> #mablage_kole_bagi_mande").html(adad_ba_jodakonande_3_ragami(mablage_kole_bagi_mande));
}
</script>
