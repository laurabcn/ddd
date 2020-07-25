<?php

declare(strict_types=1);

namespace App\Activities\FilesReader\Infrastructure;

use GuzzleHttp\Client;

class GetActivitiesFromSocrataOrganitzadors
{
    const urlApi = 'https://analisi.transparenciacatalunya.cat/resource/2n2k-gg9s.json';

    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function execute()
    {
        $rootUrlProject = self::urlApi;

        return $this->retrieveFiles($rootUrlProject);
    }

    private function retrieveFiles(string $path): array
    {
        $response = $this->getFromOpenData($path);

        var_dump(count($response));

        $i =0;
        foreach ($response as $key => $value) {
            
            $files[] = $value;
        }
        var_dump(count($files));

        return $files;
    }

    protected function getFromOpenData(string $path)
    {
        $response = $this->client->request('GET', $path);

        return json_decode((string) $response->getBody(), true);
    }
}
