<?php

namespace ITDoors\RestBundle\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * PointGroupControllerTest
 */
class PointGroupControllerTest extends WebTestCase
{
    public function testGetCharacteristicsAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/v1/point.group/1/characteristics');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}