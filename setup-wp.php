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
            'site_url' => 'http://testing.api',
            'db_name' => 'wordpress',
            'db_username' => 'username',
            'db_password' => 'username',
            'db_host' => 'localhost',
            'db_prefix' => 'test_',
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

//$wordpressClient = new Torlax\Client\WordPress;
//$wordpress = $wordpressClient->downloadLatest();
//Utilities::unzipFile($wordpress->getZipFile(), 'test-repo', 'wordpress');

$configFile = file_get_contents('test-repo/wp-config-sample.php');

$wpConfig = $config['wordpress']['config'];
$configFile = str_replace('database_name_here', $wpConfig['db_name'], $configFile);
$configFile = str_replace('username_here', $wpConfig['db_username'], $configFile);
$configFile = str_replace('password_here', $wpConfig['db_password'], $configFile);
$configFile = str_replace('localhost', $wpConfig['db_host'], $configFile);
$configFile = str_ireplace('wp_', $wpConfig['db_prefix'], $configFile);

$siteUrl = $wpConfig['site_url'];
$configFile .= "\n\ndefine('WP_SITEURL', '$siteUrl');\ndefine('WP_HOME', WP_SITEURL);";
$configFile = str_ireplace("\x0D", "", $configFile);

file_put_contents('test-repo/wp-config.php', $configFile);
