<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* inputs :
*/
?>




<div class="uk-panel uk-width-1-1">
    <h3 class="uk-panel-title">لیست پذیرش‌ها</h3>


    <div class="uk-form-row" style="text-align:left;">
        <button type="button" onclick="edit(-1);" class="uk-button uk-button-primary" >ثبت پذیرش</button>
    </div>

    <div class="uk-form-row results-div">
    </div>
</div>



<script id="results-template" type="text/x-handlebars-template">
<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th style="text-align:right;">نام/نام خانوادگی</th>
            <th style="text-align:right;">وضعیت</th>
            <th style="text-align:right;">تاریخ پذیرش</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {{#each rows}}
        <tr>
            <td>{{namelastname}}</td>
            <td>{{vaziat}}</td>
            <td>{{time_paziresh_shode}}</td>
            <td>
                <button type="button" class="uk-button uk-button-small" onclick="edit({{pk}});">مشاهده</button>
            </td>
        </tr>
        {{/each}}
    </tbody>
</table>
</script>




<script>
$(function(){
    <?php ajax_setup(); ?>

    search();

    setInterval(function(){
        search();
    } , 10000);
});
// -----------------------------------------------------------------------------
function edit(id_user){
    var href = "<?php echo site_url("operator/paziresh/edit/"); ?>"+id_user;
    $.colorbox({href:href , width:'700px'});
}
// -----------------------------------------------------------------------------
function search(){
    var q = $.ajax({
        url : "<?php echo site_url("operator/paziresh/search"); ?>",
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
            message : 'خطایی در ارسال یا دریافت اطلاعات رخ داده است. #2059',
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
