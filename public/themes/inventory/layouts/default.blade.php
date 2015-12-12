<!DOCTYPE html>
<html>
    <head>
        <title><?php echo Theme::get('title'); ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="<?php echo Theme::get('keywords'); ?>">
        <meta name="description" content="<?php echo Theme::get('description'); ?>">
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic,400italic,700,700italic,600,600italic' rel='stylesheet' type='text/css'>
        <?php echo Theme::asset()->styles(); ?>
        <?php echo Theme::asset()->scripts(); ?>
    </head>
    <body>
        <div id="wrapper">
            {!! Theme::partial('header') !!}

            <div class="page-wrap">
                <div class="sidebar-wrap"><?php echo Theme::partial('sidebar'); ?></div>
                <div id="main-content">
                    <?php echo Theme::content(); ?>
                </div>

            </div>
            <div class="container">
                <?php echo Theme::partial('footer'); ?>
            </div>
            <?php echo Theme::asset()->container('footer')->scripts(); ?>
        </div>
    </body>
</html>
