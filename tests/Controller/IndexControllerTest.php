<?php
/**
 * Created by PhpStorm.
 * User: kpicaza
 * Date: 13/08/16
 * Time: 21:36
 */

namespace Tests\Controller;


class IndexControllerTest extends WebTestCase
{
    protected $client;

    public function setUp()
    {
        parent::setUp();
        $this->client = $this->createClient();
    }

    public function testIndexAction()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->getStatusCode() === 200);

        $this->assertEquals('Welcome to In Famework app', $crawler->filter('.welcome')->text());
    }
}