<!DOCTYPE html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$template_name = 'uikit';

?>

<html lang="fa-IR" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php if(isset($this->contents['title'])) : ?>
            <title><?php echo $this->contents['title']; ?></title>
        <?php endif; ?>

        <?php if(isset($this->contents['_css'])) { ?>
            <?php foreach($this->contents['_css'] as $css) { ?>
            <link rel="stylesheet" href="<?php echo base_url('templates/'.$template_name.'/css/' . $css); ?>">
            <?php } ?>
        <?php } ?>

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

    </head>

    <body style="direction:rtl;">

    <?php if(isset($this->contents['main'])) {echo $this->contents['main'];}  ?>

    </body>
</html>
