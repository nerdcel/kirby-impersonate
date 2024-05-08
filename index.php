<?php

use Kirby\Cms\App;

App::plugin('nerdcel/kirby-impersonate', [
    'hooks' => require __DIR__ . '/hooks/index.php',
    'areas' => require __DIR__ . '/areas/index.php',
    'options' => require __DIR__ . '/options/index.php',
]);

