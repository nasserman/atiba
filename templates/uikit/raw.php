<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$template_name = 'uikit';
?>


<!DOCTYPE html>
<html lang="fa-IR" dir="rtl">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo base_url('templates/'.$template_name.'/css/print_raw.css'); ?>" media="print">
        <style>
            .print-only { display: none !important; }
        </style>

    </head>

    <body style="margin:0px;background-color:rgba(0,100,140,1);">

        <div style="" class="print-top hide-on-print">
            <input type="button" value="چاپ" class="btn uk-button uk-button-primary" onclick="window.print()"/>
            <input type="button" value="بستن" class="btn uk-button uk-button-success" onclick="window.close()"/>
        </div>


        <?php if(isset($this->contents['main'])) {echo $this->contents['main'];} ?>


    </body>

</html>

<?php return; ?>
