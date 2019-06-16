<?php
declare(strict_types=1);

namespace App\Activities\Infrastructure\FilesReader;

use GuzzleHttp\Client;
use function GuzzleHttp\Psr7\str;
use phpDocumentor\Reflection\Types\Self_;

final class GetActivitiesAjBcnFromOpenData
{
    const API_URL = [
            'http://w10.bcn.es/APPS/asiasiacache/peticioXmlAsia?id=203',
            'http://w10.bcn.es/APPS/asiasiacache/peticioXmlAsia?id=103',
            'http://w10.bcn.es/APPS/asiasiacache/peticioXmlAsia?id=104',
            'http://w10.bcn.es/APPS/asiasiacache/peticioXmlAsia?id=105',
            'http://w10.bcn.es/APPS/asiasiacache/peticioXmlAsia?id=106'
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
        foreach (self::API_URL as $url)
        {
            $response[] = $this->retrieveFiles($url);
        }

        return $response;
    }

    private function retrieveFiles(String $path): array
    {
        $xml =  $this->getFromOpenData($path);
        $json = json_encode($xml);
        $response = json_decode($json,true);

        $files = [];

        foreach ($response['body']['resultat']['actes'] as $key => $value) {
            var_dump($value);
            if(isset($value['data']) && new \DateTime($value['data']['data_fi']) < new \DateTime('today')){
                continue;
            }
            $files[] = $value;
        }
        return $files;
    }
    protected function getFromOpenData(string $path): \SimpleXMLElement
    {
        return new \SimpleXMLElement($path, 0, true);
    }
}
