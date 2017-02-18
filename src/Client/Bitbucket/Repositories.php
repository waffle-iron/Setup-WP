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

    public function read($vendor, $repository, $detail = null)
    {
        $endpoint = "$this->baseEndpoint/$vendor/$repository";

        $url = $this->baseUrl . $endpoint;

        $options = [
            'auth' => [
                $this->auth['username'],
                $this->auth['password'],
            ]
        ];

        return (new ClientRequest)->get($url, $options);
    }

    /**
     * Details:
     *  'scm'         => 'git',
     *  'description' => 'testing the client',
     *  'language'    => 'php',
     *  'is_private'  => true,
     *  'project' => [
     *    'key' => 'KEY'
     *  ]
     *
     */
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

        return (new ClientRequest)->post($url, $options);
    }

    public function delete($vendor, $repository)
    {
        $endpoint = "$this->baseEndpoint/$vendor/$repository";

        $url = $this->baseUrl . $endpoint;

        $options = [
            'auth' => [
                $this->auth['username'],
                $this->auth['password'],
            ]
        ];

        return (new ClientRequest)->delete($url, $options);
    }
}
