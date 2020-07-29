<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DataManager 
{

  private $data;
  private $client;
  private $serializer;

  public function __construct(HttpClientInterface $client, EntityManagerInterface $em, SerializerInterface $serializer)
  {
    $this->em = $em;
    $this->client = $client;
    $this->serializer = $serializer;
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
      $this->data = $response->toArray();
    } else {
      throw new \Exception('Somethink wrong. Response status:' . $statusCode);
    }
  }

  public function saveData()
  {
      list($modelName, $data) = $this->processData();

      $type = "App\\Entity\\$modelName";

      foreach ($data as $row) {
        $model = $this->serializer->deserialize(json_encode($row), $type, 'json');
        $this->em->persist($model);
        $this->em->flush();
      }
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