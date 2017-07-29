<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* inputs :
*   string $error
*   \User_model $user
*       + \Profile_user_model profile
*   [int] $id_shobehaye_user
*   [\Shobe_model] $shobeha
*/
// var_dump($id_shobehaye_operator);
// var_dump($shobeha);
?>


<div class="uk-panel uk-width-1-1">
    <?php
        if($id_user<1){
            echo'<h3 class="uk-panel-title">ثبت اپراتور جدید</h3>';
        }else{
               echo'<h3 class="uk-panel-title">ویرایش اطلاعات اپراتور</h3>';
        }
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
            <input type="hidden" name="id_user" value="<?php echo $user->PK(); ?>" />
            <div class="uk-panel uk-panel-box">

                <div class="uk-form-row">
                    <label class="uk-form-label" for="username">نام کاربری:</label>
                    <?php if($user->PK() > 0) { ?>
                        <?php echo $user->get_username(); ?>
                    <?php } else { ?>
                        <input type="text" id="username" name="username" style="text-align:left;direction:ltr;"  value="<?php echo $user->get_username(); ?>" />
                    <?php } ?>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="email">ایمیل:</label>
                    <input type="text" id="email" name="email" style="text-align:left;direction:ltr;"  value="<?php echo $user->email; ?>" />
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="email_taid_shode">ایمیل تایید شده؟</label>
                    <input type="checkbox" name="email_taid_shode" id="email_taid_shode" value="true" <?php echo ($user->email_taid_shode) ? "checked" : ""; ?> />
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="password">کلمه عبور:</label>
                    <input type="text" id="password" name="password" style="text-align:center;direction:ltr;" />
                </div>

                <hr/>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="name">نام:</label>
                    <input type="text" id="name" name="name" style="text-align:right;direction:rtl;" value="<?php echo $user->profile->name; ?>" />
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="lastname">نام خانوادگی:</label>
                    <input type="text" id="lastname" name="lastname" style="text-align:right;direction:rtl;" value="<?php echo $user->profile->lastname; ?>" />
                </div>

                <hr/>

                <fieldset>
                    <legend>لیست شعب اپراتور</legend>
                    <div class="uk-form-row">
                        <?php foreach($shobeha as $shobe) { ?>
                        <input type="checkbox" id="chbx-<?php echo $shobe->PK(); ?>" name="shobeha[]"
                        <?php echo (in_array($shobe->PK() , $id_shobehaye_operator))?"checked":""; ?> value="<?php echo $shobe->PK(); ?>" />
                        <label for="chbx-<?php echo $shobe->PK(); ?>" style="min-width:80px;margin-left:5px;" ><?php echo $shobe->name; ?></label>
                        <?php } ?>
                    </div>
                </fieldset>


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

$(function(){

});

function save()
{
    $('.save-btn').attr("disabled" , "disabled");
    var req = $.ajax({
        url : "<?php echo site_url('admin/operator/save'); ?>",
        data : $("#edit-frm").serializeArray(),
        type : "POST",
        dataType : "json"
    });

    req.fail(function(){
        alerts("failed #1137" , "danger");
        $('.save-btn').removeAttr("disabled");
    });

    req.done(function(data){
        if(data.code > 0){
            location.reload();
        }
        else {
            $('.save-btn').removeAttr("disabled");
            alert(data.message+" : "+data.code);
        }
    });
}
// -----------------------------------------------------------------------------

</script>
