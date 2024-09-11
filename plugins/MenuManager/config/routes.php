<?php
use Cake\Routing\Router;

Router::plugin(
    'MenuManager',
    ['path' => '/menu-manager'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);
