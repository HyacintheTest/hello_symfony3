<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/list');
    }

    public function testRead()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/read');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/add');
    }

    public function testFind()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/find');
    }

}
