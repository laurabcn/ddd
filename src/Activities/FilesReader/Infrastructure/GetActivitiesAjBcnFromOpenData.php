<?php

declare(strict_types=1);

namespace App\Activities\FilesReader\Infrastructure;

use GuzzleHttp\Client;

final class GetActivitiesAjBcnFromOpenData
{
    const API_URL = [
            'http://w10.bcn.es/APPS/asiasiacache/peticioXmlAsia?id=103',
    ];

    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function execute()
    {
        $response = [];
        foreach (self::API_URL as $url) {
            $response[] = $this->retrieveFiles($url);
        }

        return $response;
    }

    private function retrieveFiles(string $path): array
    {
        $xml = $this->getFromOpenData($path);
        $json = json_encode($xml);
        $response = json_decode($json, true);

        $files = [];

        foreach ($response['body']['resultat']['actes'] as $key => $value) {
            if (isset($value['data']) && new \DateTime($value['data']['data_fi']) < new \DateTime('today') ||
                (isset($value['data']) && !is_string($value['data']['data_inici'])) ||
                (isset($value['data']) && !is_string($value['data']['data_fi']))) {
                continue;
            }

            $files[] = $value;
        }

        return $files;
    }

    private function getFromOpenData(string $path): \SimpleXMLElement
    {
        return simplexml_load_string(file_get_contents($path));
    }
}
