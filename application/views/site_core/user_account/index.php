<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* inputs :
*   \User_model $current_user
*       + \Profile_user_model profile
*/
?>


<div class="uk-panel uk-panel-box uk-margin-top uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-3" style="margin:5px auto;">
    <h3 class="uk-panel-title">حساب کاربری من</h3>
    <form class="uk-form uk-form-horizontal" method="post" id="myform"  >
        <?php ajax_setup(true); ?>
        <fieldset>
            <div class="uk-form-row">
                <label class="uk-form-label" for="username">نام کاربری</label>
                <?php echo $current_user->get_username(); ?>
            </div>

            <div class="uk-form-row">
                <label class="uk-form-label" for="name">نام</label>
                <input type="text" name="name" id="name" style="text-align:right;direction:rtl;" placeholder="نام" value="<?php echo $current_user->profile->name; ?>" />
            </div>

            <div class="uk-form-row">
                <label class="uk-form-label" for="lastname">نام خانوادگی</label>
                <input type="text" name="lastname" id="lastname" style="text-align:right;direction:rtl;" placeholder="نام خانوادگی" value="<?php echo $current_user->profile->lastname; ?>"/>
            </div>

            <div class="uk-form-row">
                <label class="uk-form-label" for="email">ایمیل</label>
                <input type="text" name="email" id="email" style="text-align:left;direction:ltr;" placeholder="email" value="<?php echo $current_user->email; ?>" />
            </div>

            <hr/>

            <div class="uk-form-row">
                <label class="uk-form-label" for="oldpassword">کلمه عبور فعلی</label>
                <input type="password" name="oldpassword" id="oldpassword" placeholder="Current Password" style="text-align:left;direction:ltr;" />
            </div>

            <div class="uk-form-row">
                <label class="uk-form-label" for="password">کلمه عبور جدید</label>
                <input type="password" name="password" id="password" placeholder="New Password" style="text-align:left;direction:ltr;" />
            </div>

            <div class="uk-form-row">
                <label class="uk-form-label" for="repassword">تکرار کلمه عبور</label>
                <input type="password" name="repassword" id="repassword" placeholder="RePassword" style="text-align:left;direction:ltr;" />
            </div>

            <div class="uk-form-row" style="text-align:left;">
                <button class="uk-button save" type="submit">ثبت و ذخیره</button>
            </div>
        </fieldset>
    </form>

</div>




<script>

$(function(){



    $("#myform").on('submit' , function(e){
        e.preventDefault();
        submita();
    });

});

function submita()
{
    $('.save').attr("disabled" , "disabled");
    var req = $.ajax({
        url : "<?php echo site_url('site_core/user_account/save'); ?>",
        data : $("#myform").serialize() ,
        type : "POST",
        dataType : "json"
    });

    req.fail(function(){
        alerts("failed #1844" , "danger");
        $('.save').removeAttr("disabled");
    });

    req.done(function(data){
        if(data.code > 0){
            location.reload();
        }
        else {
            alerts(data.message , "warning");
            $('.save').removeAttr("disabled");
        }
    });

}

</script>
