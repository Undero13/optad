<?php

namespace App\Tests\Service;

use App\Service\DataManager;
use PHPUnit\Framework\TestCase;

class DataManagerTest extends TestCase
{
  protected $service;
  protected $httpClientMock;

  protected function setUp(): void
  {
    $emMock = $this->getMockBuilder(\Doctrine\ORM\EntityManagerInterface::class)->getMock();
    $serializerMock = $this->getMockBuilder(\Symfony\Component\Serializer\SerializerInterface::class)->getMock();
    $this->httpClientMock = $this->getMockBuilder(\Symfony\Contracts\HttpClient\HttpClientInterface::class)->getMock();
    $this->service = new DataManager($this->httpClientMock, $emMock, $serializerMock);
  }

  public function testItCanGetData()
  {
    $this->service = new DataManager($this->httpClientMock, $emMock, $serializerMock);
    $this->service->getDataFromApi('test');
    $this->assertEquals(200,  $this->httpClientMock->getResponse()->getStatusCode());
  }
}