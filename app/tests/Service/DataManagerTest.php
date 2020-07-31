<?php

namespace App\Tests\Service;

use App\Entity\EUR;
use App\Service\DataManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class DataManagerTest extends WebTestCase
{

    private $clientMock;
    private $em;
    private $service;
    private $serializer;

    protected function setUp() : void
    {
        self::bootKernel();
        $container = self::$kernel->getContainer();

        $this->em = $container->get('doctrine.orm.default_entity_manager');
        $this->serializer = $container->get('serializer');

        $this->clientMock =  $this->getClientMock();
        $this->service = new DataManager($this->clientMock, $this->em, $this->serializer);
    }

    public function testItCanGetAndSaveData()
    {
        $this->service->getDataFromApi('https://api.optad360.com/testapi');
        $this->service->saveData();

        $data = $this->service->getData();
        $eurModel = $this->em->getRepository(EUR::class)->findOneBy(['urls' => 'optad360.test']);
    
        $this->assertArrayHasKey('settings', $data);
        $this->assertArrayHasKey('headers', $data);
        $this->assertArrayHasKey('data', $data);
        $this->assertEquals(true, !empty($data['data']));

        $this->assertEquals('optad360.test', $eurModel->getUrls());
        $this->assertEquals('optad360.test_am_S1', $eurModel->getTags());
        $this->assertEquals(0.02, $eurModel->getEstimatedRevenue());
        $this->assertEquals(3688, $eurModel->getAdImpressions());
        $this->assertEquals(0.01, $eurModel->getAdEcpm());
        $this->assertEquals(10, $eurModel->getClicks());
        $this->assertEquals(0.27, $eurModel->getAdCtr());
    }

    private function getClientMock()
    {
        $body = <<<EOD
    {
      "settings": {
        "currency": "EUR",
        "PeriodLength": 1,
        "groupby": ""
      },
      "headers": [
        "URLs",
        "Tags",
        "DATE",
        "Estimated revenue",
        "Ad impressions",
        "Ad eCPM",
        "CLICKS",
        "Ad CTR"
      ],
      "data": [
        [
          "mastercuriosidadesbr.com",
          "mastercuriosidadesbr.com Â» mastercuriosidadesbr.com_S1-static",
          "2019-07-02",
          65.37,
          42475,
          1.54,
          2044,
          4.81
        ],
        [
          "optad360.test",
          "optad360.test_am_S1",
          "2019-07-02",
          0.02,
          3688,
          0.01,
          10,
          0.27
        ],
        [
          "optad360.test",
          "optad360.test_am_S2",
          "2019-07-02",
          0.02,
          2685,
          0.01,
          23,
          0.86
        ],
        [
          "optad360.test",
          "optad360.test_am_S3",
          "2019-07-02",
          0.03,
          2079,
          0.01,
          11,
          0.53
        ]
      ]
    }
    EOD;

        $responses = [
        new MockResponse($body),
        ];

        return new MockHttpClient($responses);
    }
}
