<?php

namespace App\Activities\Infrastructure\FilesReader;

use GuzzleHttp\Client;

class GetActivitiesFromOpenDataLibraries
{

    CONST urlApiTurisme = 'https://do.diba.cat/api/dataset/actesbiblioteques_';
    CONST format = '/format/json';

    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function execute(string $language)
    {
        $rootUrlProject = self::urlApiTurisme . $language . self::format;
        return $this->retrieveFiles($rootUrlProject);
    }

    private function retrieveFiles(String $path): array
    {
        $response = $this->getFromOpenData($path);

        $elements = $response['elements'];

        $files = [];

        foreach ($elements as $key => $value) {
            if(new \DateTime($value['data_fi']) < new \DateTime('today')){
                //var_dump($value['data_fi']);
                continue;
            }


            $files[] = $value;
        }
        return $files;
    }

    protected function getFromOpenData(string $path){

        $response =  $this->client->request('GET', $path);

        return json_decode($response->getBody(), true);
    }
}
