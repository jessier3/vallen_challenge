<?php

namespace MagazineBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PublicationControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'publication_create');
    }

    public function testNew()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/new');
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/show');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/edit');
    }

}
