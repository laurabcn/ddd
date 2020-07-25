<?php

declare(strict_types=1);

namespace App\Activities\FilesReader\Infrastructure;

use GuzzleHttp\Client;

class GetActivitiesFromSocrataLocalitzacions
{
    const urlApi = 'https://analisi.transparenciacatalunya.cat/resource/rhpv-yr4f.json';

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
            if (!isset($value['comarca_i_municipi'])) {
                continue;
            }
            
            $files[] = $value;
        }
        var_dump(count($files));
        var_dump('locas');
        return $files;
    }

    protected function getFromOpenData(string $path)
    {
        $response = $this->client->request('GET', $path);

        return json_decode((string) $response->getBody(), true);
    }
}
