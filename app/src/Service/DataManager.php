<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DataManager 
{
  private $client;
  private $em;
  private $data;

  public function __construct(HttpClientInterface $client, EntityManagerInterface $em)
  {
    $this->client = $client;
    $this->em = $em;
  }

  public function getData(string $url)
  {
    try {
      $response = $this->client->request("GET", $url);
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
    
    $statusCode = $response->getStatusCode();

    if ($statusCode === 200) {
      $this->data = $content = $response->toArray();
    } else {
      throw new \Exception('Somethink wrong. Response status:' . $statusCode);
    }
  }

  public function saveData()
  {
      list($tableName, $data) = $this->processData();
      die(print_r($data));
  }

  private function processData(): array
  {
    $name = $this->data['settings']['currency'];
    $headers = $this->normalizeHeaders($this->data['headers']);
    $assocData = [];
    
    foreach ($this->data['data'] as $row) {
      array_push($assocData,array_combine($headers,$row));
    }

    return [$name, $assocData];
  }

  private function normalizeHeaders(array $headers): array
  {
    $callback = function(string $value) { 
      return str_replace(" ", "_", strtolower($value)); 
    };
  
    return array_map($callback, $headers);
  }
}