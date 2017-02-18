<?php

require 'vendor/autoload.php'; 
$user = require 'auth.php';

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

/*
 * TODO API's
 * 
 * Bitbucket API - https://gentlero.bitbucket.io/bitbucket-api/0.8/examples/
 * git API - https://github.com/kbjr/Git.php
 *
 */

//$bitbucket = new \Torlax\BitbucketApi($user['username'], $user['password']);
//file_put_contents('test.txt', $bitbucket->repository('BarefaceMedia', 'fm-104'));

$bitbucket = new \Torlax\Client\Bitbucket\BitbucketClient($user['username'], $user['password']);
$repositories = $bitbucket->repositories();

