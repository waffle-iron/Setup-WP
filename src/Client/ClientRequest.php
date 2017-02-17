<?php

namespace Torlax\Client;

class ClientRequest
{
    public function get($url, $options = null)
    {
        return $this->request('GET', $url, $options);
    }

    public function post($url, $options = null)
    {
        return $this->request('POST', $url, $options);
    }

    protected function request($method, $url, $options)
    {
        if (!$options) {
            $options = [];
        }

        $client = new \GuzzleHttp\Client;

        try {
            $response = $client->request(
                $method,
                $url,
                $options
            );

        } catch(\GuzzleHttp\Exception\RequestException $e) {
            $response = $e->getResponse();
        }

        return $response;
    }
}
