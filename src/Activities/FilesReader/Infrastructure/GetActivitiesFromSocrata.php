<?php

declare(strict_types=1);

namespace App\Activities\FilesReader\Infrastructure;

use GuzzleHttp\Client;

class GetActivitiesFromSocrata
{
    const urlApi = 'https://analisi.transparenciacatalunya.cat/resource/ta2y-snj2.json';

    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function execute()
    {
        $rootUrlProject = self::urlApi;

        $where = '?$limit=30000';

        return $this->retrieveFiles($rootUrlProject . $where);
    }

    private function retrieveFiles(string $path): array
    {
        $response = $this->getFromOpenData($path);

        var_dump(count($response));
        var_dump('and limit = 30000');

        foreach ($response as $key => $value) {
            if (!isset($value['data_fi'])) {
                continue;
            }

            if (!isset($value['comarca_i_municipi'])) {
                continue;
            }

            if (!isset($value['adre_a'])) {
                continue;
            }

            if (new \DateTime($value['data_fi']) < new \DateTime('today')) {
                continue;
            }
            $comarca = explode('/', $value['comarca_i_municipi']);

            if ('barcelona' !== $comarca[1]) {
                continue;
            }

            $files[] = $value;
        }
        var_dump(count($files));

        return $files;
    }

    protected function getFromOpenData(string $path)
    {
        $response = $this->client->request('GET', $path);

        return json_decode($response->getBody(), true);
    }
}
