<?php

namespace ITDoors\RestBundle\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Tests api controller
 */
class PointControllerTest extends WebTestCase
{
    /**
     * getPointAction
     */
    public function testGetPointAction()
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/point/1,2,3');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * getPointStatisticsRangeAction
     */
    public function testGetPointStatisticsRangeAction()
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/point/1/statistics/1356453707/1396453707');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * getPointStatisticsRangeMoreAction
     */
    public function testGetPointStatisticsRangeMoreAction()
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/point/1/statistics/1396005234/1396453707/86');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * getPointStatisticsMoreAction
     */
    public function testGetPointStatisticsMoreAction()
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/point/1/statistics/86');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}