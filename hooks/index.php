<?php

return [
    'system.loadPlugins:after' => function () {
        $path = kirby()->request()->path()->toString();
        $userLoggedIn = kirby()->user()?->isLoggedIn();

        if ($userLoggedIn && $path !== 'panel/disclose' && $user = kirby()->session()->get('impersonate')) {
            kirby()->impersonate($user);
        }
    },
    'user.logout:before' => function (Kirby\Cms\User $user, Kirby\Session\Session $session) {
        $session->remove('impersonate');
    },
];
