<?php


namespace App\Tests\Controller;


class MainControllerTest extends ConfigNewVarForTest
{
    public function testHomePage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        static::assertSame(1, $crawler->filter('h1#homeSentence')->count());
    }

}