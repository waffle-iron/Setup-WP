<?php

namespace Torlax\Client\Bitbucket;

use Torlax\Client\Bitbucket\Repositories;

class BitbucketClient
{
    protected $baseUrl = 'https://api.bitbucket.org/2.0/';

    protected $auth;

    public function __construct($username, $password)
    {
        $this->auth = [
            'username' => $username,
            'password' => $password
        ];

        return $this;
    }

    public function repositories()
    {
        return new Repositories($this->baseUrl, $this->auth);
    }
}
