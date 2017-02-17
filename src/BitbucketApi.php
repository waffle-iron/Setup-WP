<?php

namespace Torlax;

class BitbucketApi
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

    public function repository($vendor, $repository)
    {
        return $this->makeRequest(
            $this->baseUrl . "repositories/$vendor/$repository"
        );
    }

    protected function makeRequest(string $url)
    {
        $client = new \GuzzleHttp\Client;

        try {
            $response = $client->request(
                'GET',
                $url,
                [
                    'auth' => [
                        $this->auth['username'], 
                        $this->auth['password']
                    ]
                ]
            );

        } catch(\GuzzleHttp\Exception\RequestException $e) {
            $json = json_decode($this->getContents($e->getResponse()), true);

            echo $json['error']['message'];

            return false;
        }

        return $this->getContents($response);
    }

    protected function getContents($response, $prettyPrint = false)
    {
        $contents = $response->getBody()->getContents();

        if ($prettyPrint === true) {
            $jsonArray = json_decode($contents);

            return json_encode($jsonArray, JSON_PRETTY_PRINT);
        }

        return $contents;
    }
}
