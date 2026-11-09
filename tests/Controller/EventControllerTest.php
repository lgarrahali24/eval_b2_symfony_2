<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventControllerTest extends WebTestCase
{
    // Test de la page d'accueil 
    public function testHome(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertGreaterThan(0, $crawler->filter('.event-card')->count());
    }

    // Test de la page 404 pour un événement qui n'existe pas
    public function testEventNotFound(): void
    {
        $client = static::createClient();
        $client->request('GET', '/evenement/999999');

        $this->assertResponseStatusCodeSame(404);
    }

    // Test de la page de connexion
    public function testLoginRoute(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
    }
}