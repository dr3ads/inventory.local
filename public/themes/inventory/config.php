<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Inherit from another theme
    |--------------------------------------------------------------------------
    |
    | Set up inherit from another if the file is not exists,
    | this is work with "layouts", "partials", "views" and "widgets"
    |
    | [Notice] assets cannot inherit.
    |
    */

    'inherit' => null, //default

    /*
    |--------------------------------------------------------------------------
    | Listener from events
    |--------------------------------------------------------------------------
    |
    | You can hook a theme when event fired on activities
    | this is cool feature to set up a title, meta, default styles and scripts.
    |
    | [Notice] these event can be override by package config.
    |
    */

    'events' => array(

        // Before event inherit from package config and the theme that call before,
        // you can use this event to set meta, breadcrumb template or anything
        // you want inheriting.
        'before' => function ($theme) {
            // You can remove this line anytime.
            $theme->setTitle('Copyright ©  2013 - Laravel.in.th');

            // Breadcrumb template.
            // $theme->breadcrumb()->setTemplate('
            //     <ul class="breadcrumb">
            //     @foreach ($crumbs as $i => $crumb)
            //         @if ($i != (count($crumbs) - 1))
            //         <li><a href="{{ $crumb["url"] }}">{{ $crumb["label"] }}</a><span class="divider">/</span></li>
            //         @else
            //         <li class="active">{{ $crumb["label"] }}</li>
            //         @endif
            //     @endforeach
            //     </ul>
            // ');
        },

        // Listen on event before render a theme,
        // this event should call to assign some assets,
        // breadcrumb template.
        'beforeRenderTheme' => function ($theme) {
            // You may use this event to set up your assets.
            // $theme->asset()->usePath()->add('core', 'core.js');
            // $theme->asset()->add('jquery', 'vendor/jquery/jquery.min.js');
            // $theme->asset()->add('jquery-ui', 'vendor/jqueryui/jquery-ui.min.js', array('jquery'));

            // Partial composer.
            // $theme->partialComposer('header', function($view)
            // {
            //     $view->with('auth', Auth::user());
            // });

            //css
            $theme->asset()->usePath()->add('bootstrap-css', 'vendors/bootstrap/css/bootstrap.min.css');
            $theme->asset()->usePath()->add('font-awesome-css', 'vendors/font-awesome/css/font-awesome.min.css');
            $theme->asset()->usePath()->add('sb-admin-css', 'vendors/sb-admin/css/sb-admin.css');
            $theme->asset()->usePath()->add('metismenu-css', 'vendors/metisMenu/metisMenu.min.css');
            $theme->asset()->usePath()->add('bs-select-css', 'vendors/bootstrap-select/css/bootstrap-select.min.css', array('bootstrap-css'));

            //scripts
            $theme->asset()->container('footer')->usePath()->add('jquery', 'vendors/jquery/jquery.min.js');
            $theme->asset()->container('footer')->usePath()->add('bootstrap-js',
                'vendors/bootstrap/js/bootstrap.min.js', array('jquery'));
            $theme->asset()->container('footer')->usePath()->add('metismenu-js', 'vendors/metisMenu/metisMenu.min.js');
            $theme->asset()->container('footer')->usePath()->add('bs-select-js',
                'vendors/bootstrap-select/js/bootstrap-select.min.js', array('bootstrap-js'));
            $theme->asset()->container('footer')->usePath()->add('sb-admin-js', 'vendors/sb-admin/js/sb-admin-2.js');
            $theme->asset()->container('footer')->usePath()->add('global', 'js/global.js');

        },

        // Listen on event before render a layout,
        // this should call to assign style, script for a layout.
        'beforeRenderLayout' => array(

            'default' => function ($theme) {
                // $theme->asset()->usePath()->add('ipad', 'css/layouts/ipad.css');
            }

        )

    )

);