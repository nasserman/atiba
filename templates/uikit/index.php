<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$template_name = 'uikit';
?>
<!DOCTYPE html>
<html lang="fa-IR" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php if(isset($this->contents['title'])) : ?>
        <title><?php echo $this->contents['title']; ?></title>
        <?php else : ?>
        <title>آتیبا - نرم افزار مدیریت مطب پزشکان</title>
        <?php endif; ?>
        <link rel="shortcut icon" href="<?php echo base_url('templates/'.$template_name.'/images/favicon.ico'); ?>" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo base_url('templates/'.$template_name.'/css/jquery-ui.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('templates/'.$template_name.'/css/jquery-ui.theme.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('templates/'.$template_name.'/css/bootstrap.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('templates/'.$template_name.'/css/uikit.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('templates/'.$template_name.'/css/uikit.gradient.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('templates/'.$template_name.'/css/components/notify.gradient.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('templates/'.$template_name.'/css/sweetalert.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('templates/'.$template_name.'/css/chosen.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('templates/'.$template_name.'/css/colorbox/colorbox.css'); ?>">

        <?php if(isset($this->contents['css'])) {echo $this->contents['css'];} ?>

        <?php if(isset($this->contents['_css'])) { ?>
            <?php foreach($this->contents['_css'] as $css) { ?>
            <link rel="stylesheet" href="<?php echo base_url('templates/'.$template_name.'/css/' . $css); ?>">
            <?php } ?>
        <?php } ?>

        <link rel="stylesheet" href="<?php echo base_url('templates/'.$template_name.'/css/custom.css'); ?>">

        <script type="text/javascript" src="<?php echo base_url('templates/'.$template_name.'/js/jquery-2.1.1.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('templates/'.$template_name.'/js/jquery-ui.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('templates/'.$template_name.'/js/uikit.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('templates/'.$template_name.'/js/components/notify.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('templates/'.$template_name.'/js/bootstrap.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('templates/'.$template_name.'/js/jquery.colorbox-min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('templates/'.$template_name.'/js/sweetalert.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('templates/'.$template_name.'/js/handlebars.min-latest.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('templates/'.$template_name.'/js/chosen.jquery.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('templates/'.$template_name.'/js/jquery.ui.touch-punch.min.js'); ?>"></script>

        <script src="<?php echo base_url('templates/'.$template_name.'/js/jquery.mask.min.js'); ?>"></script>
        <script src="<?php echo base_url('templates/'.$template_name.'/js/autoNumeric-min.js'); ?>"></script>


        <script type="text/javascript" src="<?php echo base_url('templates/'.$template_name.'/js/tinymce/tinymce.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('templates/'.$template_name.'/js/progressbar.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('templates/'.$template_name.'/js/application.js'); ?>"></script>



        <?php if(isset($this->contents['_js'])) { ?>
            <?php foreach($this->contents['_js'] as $js) { ?>
            <script type="text/javascript" src="<?php echo base_url('templates/'.$template_name.'/js/'.$js); ?>"></script>
            <?php } ?>
        <?php } ?>

        <?php if(isset($this->contents['_head'])) { ?>
            <?php foreach($this->contents['_head'] as $h) { ?>
            <?php echo $h; ?>
            <?php } ?>
        <?php } ?>

        <?php require_once 'templates/'.$template_name.'/js/application.php'; ?>

    </head>

    <body style="direction:rtl;">

        <div class="top-nav">
            <div class="uk-container uk-container-center">
                <nav class="uk-navbar uk-navbar-attached">
                    <a class="uk-navbar-brand uk-hidden-small" href="<?php echo base_url();?>">
                        <img style="max-height: 36px;" src="<?php echo base_url('templates/'.$template_name.'/images/brand-logo.png'); ?>" />
                    </a>
                    <ul class="uk-navbar-nav uk-hidden-small">
                        <?php if(isset($this->contents['menu1'])) {echo $this->contents['menu1'];} ?>
                    </ul>
                    <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
                    <div class="uk-navbar-brand uk-navbar-center uk-visible-small">Atiba</div>
                </nav>
            </div>
        </div>

        <div class="main-section uk-container uk-container-center">

            <?php display_site_flash_messages(); ?>
            <span id="alerts"></span>

            <?php if(isset($this->contents['masire_safhe'])) : ?>
            <div class='uk-panel uk-panel-box'>
                <?php echo $this->contents['masire_safhe']; ?>
            </div>
            <?php endif; ?>


            <?php
                $_col_right_class = "uk-width-medium-1-1";
                $_col_main_class = "uk-width-medium-1-1";
                $_col_left_class = "uk-width-medium-1-1";

                $_col_right_isset = isset($this->contents['col_right']);
                $_col_main_isset = isset($this->contents['main']);
                $_col_left_isset = isset($this->contents['col_left']);

                if($_col_right_isset && $_col_left_isset){
                    $_col_right_class = "uk-width-medium-2-10";
                    $_col_main_class = "uk-width-medium-7-10";
                    $_col_left_class = "uk-width-medium-1-10";
                }
                else if($_col_right_isset){
                    $_col_right_class = "uk-width-medium-2-10";
                    $_col_main_class = "uk-width-medium-8-10";
                }
                else if($_col_left_isset){
                    $_col_main_class = "uk-width-medium-8-10";
                    $_col_left_class = "uk-width-medium-2-10";
                }
            ?>

            <div class="uk-grid">

                <?php if($_col_right_isset) : ?>
                <div id="col_right" class="uk-width-small-1-1 <?php echo $_col_right_class; ?>">
                    <?php if(isset($this->contents['col_right'])) {echo $this->contents['col_right'];} ?>
                </div>
                <?php endif; ?>

                <div id="col_main" class="uk-width-small-1-1 <?php echo $_col_main_class; ?>">
                    <?php if(isset($this->contents['main'])) {echo $this->contents['main'];} ?>
                </div>

                <?php if($_col_left_isset) : ?>
                <div id="col_left" class="uk-width-small-1-1 <?php echo $_col_left_class; ?>">
                    <?php if(isset($this->contents['col_left'])) {echo $this->contents['col_left'];} ?>
                </div>
                <?php endif; ?>

            </div>
        </div>






        <div class="footer-section">
            <div class="uk-container uk-container-center">
                <?php if(isset($this->contents['footer'])) : ?>
                <div id="footer" class="uk-width-small-1-1">
                    <?php echo $this->contents['footer']; ?>
                </div>
                <?php endif; ?>
            </div>
            <div>
                <div style="font-size: 12px;text-align: left;direction: ltr;padding: 5px 25px;">
                    <?php if(isset($this->contents['version'])) {echo $this->contents['version'];} ?>
                </div>
            </div>
            <div>
                <div class="disigned-by-rahbordir.ir-logo" style="display:inline-block;">
                    <a href="http://rahbordit.ir" target="_blank" >
                        <img alt="لوگوی گروه توسعه خدمات فناوری راهبرد" title="طراحی سایت و نرم افزار وب توسط توسعه خدمات فناوری راهبرد" src="<?php echo base_url('images/footer.png'); ?>" />
                    </a>
                </div>
            </div>
        </div>




        <div id="offcanvas" class="uk-offcanvas">
            <div class="uk-offcanvas-bar uk-offcanvas-bar-flip">
                <ul class="uk-nav uk-nav-offcanvas">
                    <?php if(isset($this->contents['offcanvas'])) {echo $this->contents['offcanvas'];} ?>
                </ul>
            </div>
        </div>





        <script>


        $(function(){

        });



        function alerts(message , type , container_id){
            if (typeof(container_id)==='undefined') container_id = "#alerts";
            $(container_id).html('<div class="uk-alert uk-alert-'+type+'" data-uk-alert><a href="" class="uk-alert-close uk-close"></a>'+message+'</div>');
        }

        function notify(message , type){
            UIkit.notify({
                message : message,
                status  : type,
                timeout : 5000,
                pos     : 'top-left'
            });
        }
        </script>



    </body>
</html>
