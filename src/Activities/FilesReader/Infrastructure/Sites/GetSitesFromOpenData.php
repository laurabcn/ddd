<?php

declare(strict_types=1);

namespace App\Activities\FilesReader\Infrastructure\Sites;

use GuzzleHttp\Client;

class GetSitesFromOpenData
{
    const API_URL = [
        'CA' => 'http://www.bcn.cat/tercerlloc/pits_opendata.xml',
        'ES' => 'http://www.bcn.cat/tercerlloc/pits_opendata_es.xml',
        'EN' => 'http://www.bcn.cat/tercerlloc/pits_opendata_en.xml',
        'FR' => 'http://www.bcn.cat/tercerlloc/pits_opendata_fr.xml',
    ];

    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function execute(string $language)
    {
        $rootUrlProject = self::API_URL[strtoupper($language)];

        return $this->retrieveFiles($rootUrlProject);
    }

    private function retrieveFiles(string $path): array
    {
        $xml = $this->getFromOpenData($path);
        $json = json_encode($xml);
        $response = json_decode($json, true);

        return $response['list_items']['row'];
    }

    protected function getFromOpenData(string $path): \SimpleXMLElement
    {
        return new \SimpleXMLElement($path, 0, true);
    }
}
