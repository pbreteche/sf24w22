<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SalesControllerTest extends WebTestCase
{
    public function testNewSingleDay()
    {
        $client = static::createClient();
        $client->request('GET', '/sales/new-single');

        $this->assertResponseIsSuccessful();



        $client->submitForm('Ajouter', [
            'single_day_sales[day]' => (new \DateTimeImmutable('tomorrow'))->format('Y-m-d')
        ]);

        $this->assertResponseRedirects('/sales/new-single');
        $client->followRedirect();
        $this->assertResponseIsSuccessful();

        $client->submitForm('Ajouter', [
            'single_day_sales[day]' => (new \DateTimeImmutable('yesterday'))->format('Y-m-d')
        ]);

        $this->assertResponseIsUnprocessable('You should not declare sales day in the past');

    }
}
