# Kirby Impersonate Plugin

This plugin provides a way to impersonate users in the Kirby Panel.
It adds a new button to the user profile page, where you can select a user to impersonate. This is useful for debugging and support purposes.

!["Impersonate"](./.github/impersonate.gif?raw=true)
!["Disclose"](./.github/disclose.gif?raw=true)

## Features

- See what a user sees in the Panel using a different role

## Requirements

> [!NOTE]
> The current version of this plugin requires Kirby 4 or higher.

## Installation

### Composer

```bash
composer require nerdcel/kirby-impersonate
```

### Download

Download and copy this repository to `/site/plugins/kirby-impersonate`.

## Usage

In order to use this plugin, you need to have the necessary permissions or role to impersonate users.

```php
  [
    'nerdcel.kirby-impersonate' => [
        // Add the roles that are allowed to impersonate users. admin is always allowed.
        'roles' => ['superuser', '...']
    ],
  ]
```

## License

[MIT](./LICENSE) License © 2024-PRESENT [Marcel Hieke-Hecht](https://github.com/nerdcel)
