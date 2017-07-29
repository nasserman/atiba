<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* inputs :
*/
?>




<div class="uk-panel uk-width-1-1">
    <h3 class="uk-panel-title">لیست بیمارها (مراجعان)</h3>


    <div class="uk-form-row" style="text-align:left;">
        <button type="button" onclick="edit(-1);" class="uk-button uk-button-primary" >ثبت بیمار</button>
    </div>

    <div class="uk-form-row results-div">
    </div>
</div>



<script id="results-template" type="text/x-handlebars-template">
<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th style="text-align:right;">نام/نام خانوادگی</th>
            <th style="text-align:right;">کد ملی</th>
            <th style="text-align:right;">شماره ثابت</th>
            <th style="text-align:right;">شماره همراه</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {{#each rows}}
        <tr>
            <td>{{namelastname}}</td>
            <td>{{code_melli}}</td>
            <td>{{tel}}</td>
            <td>{{mobile}}</td>
            <td>
                <div class="uk-button-group">
                    <button type="button" class="uk-button uk-button-small" onclick="view({{pk}});">مشاهده</button>
                    <button type="button" class="uk-button uk-button-small" onclick="edit({{pk}},'{{noe_furush}}');">ویرایش</button>
                </div>
            </td>
        </tr>
        {{/each}}
    </tbody>
</table>
</script>




<script>
$(function(){
    <?php ajax_setup(); ?>

    setInterval(function(){
        search();
    } , 4000);
});
// -----------------------------------------------------------------------------
function edit(id_user){
    var href = "<?php echo site_url("operator/bimar/edit/"); ?>"+id_user;
    $.colorbox({href:href , width:'700px'});
}
// -----------------------------------------------------------------------------
function search(){
    var q = $.ajax({
        url : "<?php echo site_url("operator/bimar/search"); ?>",
        data : {
            page_size : 20 ,
            page_index : 0
        },
        type : "post",
        dataType : "json"
    });

    q.fail(function(){
        $(".results-div").html("");
        UIkit.notify({
            message : 'خطایی در ارسال یا دریافت اطلاعات رخ داده است. #1257',
            status  : 'danger',
            timeout : 5000,
            pos     : 'top-left'
        });
    });

    q.done(function(data){
        if(data.code < 1){
            UIkit.notify({
                message : data.message + " " + data.code,
                status  : 'warning',
                timeout : 5000,
                pos     : 'top-left'
            });
        } else {
            var source   = $("#results-template").html();
            var template = Handlebars.compile(source);
            var context = {
                rows: data.result
            };

            var html    = template(context);
            $(".results-div").html(html);
        }
    });
}
</script>
