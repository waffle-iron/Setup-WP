<?php

require 'vendor/autoload.php';
$user = require 'auth.php';

use GitWrapper\GitWrapper;
use Torlax\Utilities;

/**
 * TODO Process
 *
 * 1. Create an optional config file. If no config file, command arguments must be used.
 * 2. Create repo if it does not exist.
 * 3. Set origin.
 * 4. Setup dev branch.
 * 5. If config.setup is true, download latest Wordpress.
 * 6. Download themes and plugins.
 * 7. Create config.
 * 8. Create mysql DB.
 * 9. Create nginx vhost.
 * 10. Fin.
 */

/*
 * XXX Config options
 *  account_name
 *  repo_slug
 *  wordpress:
 *    setup: true/false
 *    plugins:
 *      -
 *        -
 *          url: Specify only if not on Wordpress website.
 *          name: To rename the folder.
 *          username: If HTTP request requires credentials.
 *          password: If HTTP request requires credentials.
 *    theme:
 *      url: Check if bitbucket/github and use appropriate API HTTP request if not.
 *      name: If changed, rename folder. If not use end of url.
 *    config:
 *      site_url
 *      home_url
 *      db_name
 *      db_username
 *      db_password
 *      db_host
 *      db_prefix
 *    search_replace: URL to replace with config.site_url
 */

// TODO Move to it's own config
$config = [
    'account_name' => 'JayyWalker',
    'repo_slug'    => 'testing-api',
    'directory'    => 'test-repo',
    'wordpress'    => [
        'initialize' => true,
        'plugins'    => [
            [
                'url'      => '',
                'name'     => '',
                'username' => '',
                'password' => '',
            ],
        ],

        'theme' => [
            'url' => ''
        ],

        'config' => [
            'site_url' => '',
            'home_url' => '',
            'db_name' => '',
            'db_username' => '',
            'db_password' => '',
            'db_host' => '',
            'db_prefix' => '',
        ],
        'search_replace' => '',
    ],
];

/*
 * TODO API's
 *
 * Bitbucket API - https://gentlero.bitbucket.io/bitbucket-api/0.8/examples/
 * git API - https://github.com/kbjr/Git.php
 *
 */

$wordpressClient = new Torlax\Client\WordPress;
$wordpress = $wordpressClient->downloadLatest();
Utilities::unzipFile($wordpress->getZipFile(), 'test-repo', 'wordpress');
