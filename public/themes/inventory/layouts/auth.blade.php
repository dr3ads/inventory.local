<!DOCTYPE html>
<html>
<head>
    <title><?php echo Theme::get('title'); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php echo Theme::get('keywords'); ?>">
    <meta name="description" content="<?php echo Theme::get('description'); ?>">
    <?php echo Theme::asset()->styles(); ?>
    <?php echo Theme::asset()->scripts(); ?>
</head>
<body>
<div id="wrapper">

    <div class="container">
        <div class="row">

            <div id="main-content" class="col-md-12">
                <?php echo Theme::content(); ?>
            </div>
        </div>
    </div>

    <?php echo Theme::asset()->container('footer')->scripts(); ?>
</div>
</body>
</html>
