<?php

use Kirby\Cms\Find;

return [
    'site' => function ($kirby) {
        return [
            'dropdowns' => [
                'users' => [
                    'pattern' => 'users/(:any)',
                    'options' => function (string $id) use ($kirby) {
                        // find the right page for the dropdown
                        $user = Find::user($id);
                        // load the core dropdown definition
                        $dropdown = $user?->panel()->dropdown();
                        $accessRoles = array_merge(option('nerdcel.kirby-impersonate.roles'), ['admin']);

                        if (! in_array($kirby->user()?->role()->id(), $accessRoles, true)) {
                            return $dropdown;
                        }

                        // append a separator
                        $dropdown[] = '-';
                        // append a new option
                        $dropdown[] = [
                            'icon' => 'brush',
                            'text' => 'Impersonate',
                            'disabled' => false,
                            'link' => 'impersonate/'.$user?->id(),
                        ];

                        return $dropdown;
                    },
                ],
            ],
        ];
    },
    'impersonate' => static function () {
        $accessRoles = array_merge(option('nerdcel.kirby-impersonate.roles'), ['admin']);

        return [
            'label' => 'Impersonate',
            'icon' => 'brush',
            'menu' => false,
            'views' => [
                [
                    'pattern' => 'impersonate/(:any)',
                    'action' => function (string $id) use ($accessRoles) {
                        $user = Find::user($id);

                        if (! in_array(kirby()->user()?->role()->id(), $accessRoles, true)) {
                            return go(site()->panel()->url('users'));
                        }

                        // Impersonate the user
                        // set session and mark the user as impersonated
                        $user && kirby()->session()->set('impersonate', $user->email());

                        return go(site()->panel()->url());
                    },
                ],
            ],
        ];
    },
    'disclose' => static function () {

        $accessPermission = kirby()->session()->get('impersonate') !== null;

        return [
            'label' => 'Disclose',
            'icon' => 'brush',
            'menu' => $accessPermission,
            'views' => [
                [
                    'pattern' => 'disclose',
                    'action' => function () {
                        kirby()->session()->pull('impersonate');
                        kirby()->impersonate(null);

                        return go(site()->panel()->url());
                    },
                ],
            ],
        ];
    },
];
