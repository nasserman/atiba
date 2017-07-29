function insert_image_to_tinymce(id_file , id_editor) {
    var file    = document.querySelector(id_file).files[0];
    var reader  = new FileReader();

    reader.addEventListener("load", function () {
      tinyMCE.get(id_editor).execCommand("mceInsertContent", true, "<img src='"+reader.result+"' />");
    }, false);

    if (file) {
      reader.readAsDataURL(file);
    }
}

// -----------------------------------------------------------------------------

function adad_ba_jodakonande_3_ragami(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

 // ----------------------------------------------------------------------------
