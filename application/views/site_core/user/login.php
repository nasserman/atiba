<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="uk-panel uk-panel-box uk-margin-top" style="max-width: 300px;margin:auto;">
    <h3 class="uk-panel-title">ورود</h3>
    <span id="alerts"></span>
    <form class="uk-form uk-form-stacked" method="post" id="myform"  >
        <?php ajax_setup(true); ?>
        <fieldset>
            <div class="uk-form-row">
                <label class="uk-form-label" for="username">نام کاربری</label>
                <input type="text" name="username" id="username" placeholder="Username" class="uk-width-1-1" style="text-align:left;direction:ltr;" />
            </div>

            <div class="uk-form-row">
                <label class="uk-form-label" for="password">کلمه عبور</label>
                <input type="password" name="password" id="password" placeholder="Password" class="uk-width-1-1" style="text-align:left;direction:ltr;" />
            </div>

            <div class="uk-form-row" style="text-align:left;">
                <button class="uk-button login" type="submit">ورود</button>
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

    var req = $.ajax({
        url : "<?php echo site_url('site_core/user/submit_login'); ?>",
        data : $("#myform").serialize() ,
        type : "POST",
        dataType : "json"
    });

    req.fail(function(){
        $("#alerts").html('<div class="uk-alert uk-alert-danger" data-uk-alert><a href="" class="uk-alert-close uk-close"></a><p>ارسال ناموفق اطلاعات ...</p></div>');
    });

    req.done(function(data){

        if(data.code > 0){
            $("#alerts").html('<div class="uk-alert" data-uk-alert><a href="" class="uk-alert-close uk-close"></a><p>'+data.message+'</p></div>');
            window.location = data.redirect_url;
        }
        else {
            $("#alerts").html('<div class="uk-alert uk-alert-warning" data-uk-alert><a href="" class="uk-alert-close uk-close"></a><p>'+data.message+'</p></div>');
        }
    });

}

</script>
