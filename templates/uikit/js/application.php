<script>

function init_tinymce(_selector){
    tinymce.init({
        //selector: '.tinymce_editor',
        selector: _selector,
        height : "140",
        width:"100%",
        plugins: [
          'advlist autolink link image lists charmap hr anchor pagebreak spellchecker',
          'searchreplace wordcount visualblocks visualchars code insertdatetime nonbreaking',
          'table contextmenu directionality template paste textcolor'
        ],
        toolbar: 'ltr rtl fontselect fontsizeselect insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
        paste_data_images: true
    });
}
</script>
