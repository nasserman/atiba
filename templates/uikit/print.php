<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$template_name = 'uikit';
?>


<!DOCTYPE html>
<html lang="fa-IR" dir="rtl">

    <head>
        <meta charset="utf-8">
        <?php if(isset($this->contents['title'])) : ?>
        <title><?php echo $this->contents['title']; ?></title>
        <?php else : ?>
        <title>چاروق - نرم‌افزار مدیریت یکپارچه فروش</title>
        <?php endif; ?>

        <link rel="stylesheet" href="<?php echo base_url('templates/'.$template_name.'/css/uikit.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('templates/'.$template_name.'/css/uikit.almost-flat.min.css'); ?>">

        <?php if(isset($this->contents['css'])) {echo $this->contents['css'];} ?>
        <?php if(isset($this->contents['_css'])) { ?>
            <?php foreach($this->contents['_css'] as $css) { ?>
            <link rel="stylesheet" href="<?php echo base_url('templates/'.$template_name.'/css/' . $css); ?>">
            <?php } ?>
        <?php } ?>

        <style>
            body{font-family:'vazir' , vazir; font-size:11px;height: 100vh;padding-top:30px;}

            .print-top{
                background-color: rgba(0, 130, 165, 0.37);
                padding: 4px 10px;
                border-radius: 0px 0px 4px 4px;
                width: 150px;
                position: fixed;
                right: 20px;
                top: 0px;
                text-align: center;
                direction: rtl;
            }

            .print-top-brand-image{width: 120px;height: 65px; position: absolute;}
            .print-header{display: inline-block;margin-top:4px;}


            .main-tr hr {margin:3px 0px;border: 1px dotted #ccc;}
            .main-tr table thead tr th {border-top:1px solid #444;border-left:1px solid #444;border-bottom:1px solid #444;font-weight:normal;}
            .main-tr table thead tr th:first-of-type{border-right:1px solid #444;}
            .main-tr table td {border-bottom: 1px solid #666;border-left:1px solid #888;font-size:11px;text-align: center;}
            .main-tr table td:first-of-type{border-right:1px solid #888;}
            .main-tr thead {background-color: #eee;}
            .main-tr table thead th , .main-tr table tbody td {vertical-align: middle;}





            .print-only { display: none !important; }
            .inner-page{width: 230mm;padding: 10mm 10mm;margin:0px auto 0px auto;border: 1px solid #999;border-radius:3px;background-color: #fff;}
            .main-tr {direction: rtl;}
            label{font-weight: bold;}
            .page-break	{ display: none; }
            .uk-grid > * {
                padding-left: 10px;
            }

            @media print {
                * {text-shadow: none !important; filter:none !important;
                -ms-filter: none !important; }
                p a, p a:visited { color: #444 !important; text-decoration: underline; }
                p a[href]:after { content: " (" attr(href) ")"; }
                abbr[title]:after { content: " (" attr(title) ")"; }
                .ir a:after, a[href^="javascript:"]:after, a[href^="#"]:after { content: ""; }
                pre, blockquote { border: 1px solid #999; page-break-inside: avoid; }
                thead { display: table-header-group; }
                @page { margin:4mm 8mm;size:A4;}

                p, h2, h3 { orphans: 3; widows: 3; }
                h2, h3{ page-break-after: avoid; }
                .hide-on-print { display: none !important; }
                .print-only { display: block !important; }
                body{background-color: #fff !important;height: auto;}

                .inner-page{border:none;width:auto;margin:0px !important;padding:0px !important;}
                .inner-page table thead{}
                .inner-page > table > tbody{margin-top:10px;}
                .print-top-brand-image{position: fixed;}

                .page-break	{ display: block; page-break-before: always; }


            }

        </style>

    </head>

    <body style="margin:0px;background-color:rgba(0,100,140,1);">

        <div style="" class="print-top hide-on-print">
            <input type="button" value="چاپ" class="btn uk-button uk-button-primary" onclick="window.print()"/>
            <input type="button" value="بستن" class="btn uk-button uk-button-success" onclick="window.close()"/>
        </div>



        <div class="inner-page section1">

            <table class='' style="width: 100%;">
                <?php if(isset($this->contents['print_header'])) { ?>
                <thead>
                    <tr>
                        <th>
                            <div>
                                <div class="print-header">
                                    <?php if(isset($this->contents['print_header'])) {echo $this->contents['print_header'];} ?>
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <?php } ?>
                <tfoot>
                    <tr>
                        <td><?php if(isset($this->contents['print_footer'])) {echo $this->contents['print_footer'];} ?></td>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td class="main-tr">
                        <?php if(isset($this->contents['main'])) {echo $this->contents['main'];} ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


    </body>

</html>

<?php return; ?>
