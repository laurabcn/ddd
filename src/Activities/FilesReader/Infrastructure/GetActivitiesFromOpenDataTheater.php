<?php

declare(strict_types=1);

namespace App\Activities\FilesReader\Infrastructure;

use GuzzleHttp\Client;

class GetActivitiesFromOpenDataTheater
{
    const urlApiTheater = 'https://do.diba.cat/api/dataset/escenari/pag-ini/1/pag-fi/100/format/json';

    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function execute(string $language)
    {
        $rootUrlProject = self::urlApiTheater;

        return $this->retrieveFiles($rootUrlProject);
    }

    private function retrieveFiles(string $path): array
    {
        $response = $this->getFromOpenData($path);

        $elements = $response['elements'];

        $files = [];

        foreach ($elements as $key => $value) {
            if (new \DateTime($value['data_fi']) < new \DateTime('today')) {
                continue;
            }
            $files[] = $value;
        }

        return $files;
    }

    protected function getFromOpenData(string $path)
    {
        $response = $this->client->request('GET', $path);

        return json_decode($response->getBody(), true);
    }
}
