<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* inputs :
*   [\Profile_bimar_model] $bimarha
*/
?>


<div class="uk-panel uk-width-1-1">

    <div class="uk-form-row uk-container-center" style="padding:40px;">
        <div class="uk-form-row">
            <div id="div-entekhabe-bimar">
                <select class="chosen chosen-rtl" id="select-entekhabe-bimar">
                    <?php foreach($bimarha as $profile_bimar){ ?>
                    <option value="<?php echo $profile_bimar->PK(); ?>" ><?php echo $profile_bimar->name." ".$profile_bimar->lastname; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="uk-form-row" style="text-align:left;">
            <button class="uk-button uk-button-primary" onclick="entekhabe_bimar();">انتخاب بیمار</button>
        </div>
        <hr/>
        <div class="uk-form-row" style="text-align:left;">
            <button class="uk-button uk-button-success" onclick="sabte_sarie_bimar();" >ثبت سریع اطلاعات بیمار</button>
        </div>

    </div>

</div>





<script>
$(function(){

    $("#select-entekhabe-bimar").chosen({width:"100%"});

});
// -----------------------------------------------------------------------------
function sabte_sarie_bimar(){
    var href = "<?php echo site_url("operator/bimar/edit/-1/".urlencode("edit(pk)")); ?>";
    $.colorbox({href:href , width:'700px'});
}
// -----------------------------------------------------------------------------
function entekhabe_bimar(){
    var id_profile_bimar = $("#select-entekhabe-bimar").val();
    edit(id_profile_bimar);
}
// -----------------------------------------------------------------------------
</script>
