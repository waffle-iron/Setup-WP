<?php

namespace Torlax\Client;

use Torlax\Client\ClientRequest;
use Torlax\Messenger;

class WordPress
{
    protected $baseUri = 'https://api.wordpress.org';

    protected $latest;

    protected $zipFile;

    public function getLatest()
    {
        echo Messenger::createMessage('Checking wordpress.org for the latest download...');

        $version = (new ClientRequest)->get(
            $this->baseUri . '/core/version-check/1.7/'
        );

        $json = json_decode($version->getBody()->getContents());

        return $json->offers[0];
    }

    public function downloadLatest()
    {
        $latest  = $this->getLatest();
        $version = $latest->version;

        $response = (new ClientRequest)->get(
            $latest->download
        );

        echo Messenger::createMessage("Downloaded Wordpress@$version...");

        $file = "wordpress-$version.zip";
        $this->zipFile = $file;
        file_put_contents(
            $file,
            $response->getBody()->getContents()
        );

        return $this;
    }

    public function getZipFile()
    {
        return $this->zipFile;
    }
}

