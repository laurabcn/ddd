<?php

declare(strict_types=1);

namespace App\Activities\FilesReader\Infrastructure;

use GuzzleHttp\Client;

class GetActivitiesFromSocrata
{
    const urlApi = 'https://analisi.transparenciacatalunya.cat/resource/rhpv-yr4f.json?$where=data_fi>';

    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function execute()
    {
        $rootUrlProject = self::urlApi;

        $where = (new \DateTime('today'))->format("'Y-m-d\TH:i:s'");
        $limit = '&$limit=30000';

        return $this->retrieveFiles($rootUrlProject . $where . $limit);
    }

    private function retrieveFiles(string $path): array
    {
        $response = $this->getFromOpenData($path);

        var_dump(count($response));
        var_dump('and limit = 300000');
        $i =0;
        foreach ($response as $key => $value) {
            if (!isset($value['comarca_i_municipi'])) {
                continue;
            }

            if (!isset($value['adre_a'])) {
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

        return json_decode((string) $response->getBody(), true);
    }
}
