<?php

namespace Torlax\Client\Bitbucket;

use Torlax\Client\ClientRequest;

class Repositories
{
    protected $baseUrl;

    protected $baseEndpoint = 'repositories';

    protected $auth;

    public function __construct($baseUrl, array $auth)
    {
        $this->baseUrl = $baseUrl;
        $this->auth = $auth;
    }

    public function create($vendor, $repository, $details = null) 
    {
        $endpoint = "$this->baseEndpoint/$vendor/$repository";

        $url = $this->baseUrl . $endpoint;

        $options = [
            'auth' => [
                $this->auth['username'],
                $this->auth['password'],
            ]
        ];

        if ($details) {
            $options = [
                'json' => $details
            ];
        }

        $response = (new ClientRequest)->post($url, $options);

        var_dump($response->getBody()->getContents());
    }
}
