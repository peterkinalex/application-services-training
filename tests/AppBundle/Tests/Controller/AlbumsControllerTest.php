<?php

namespace AppBundle\Tests\Controller;

use Chinook\DigitalMedia\DomainModel\Album\Album;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Faker\Factory;
use Symfony\Component\Console\Tester\CommandTester;

class AlbumsControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $expected = count(
            $client->getContainer()->get('doctrine')->getRepository('DigitalMedia:Album\Album')->findAll()
        );

        $this->assertCount($expected, $crawler->filter('tbody tr'));
    }

    public function testCreateNewAlbum()
    {
        $faker = Factory::create();

        $client = static::createClient();
        $client->followRedirects();

        $albumTitle = $faker->sentence();

        $crawler = $client->request('POST', '/albums', ['title' => $albumTitle, 'artist_id' => 1]);

        $this->assertCount(1, $crawler->filter('.alert.alert-info'));

        $id = $crawler->filterXPath(sprintf('//*[text() = "%s"]/preceding-sibling::td/text()', $albumTitle))->text();

        $album = $client->getContainer()->get('doctrine')->getManager()->find('DigitalMedia:Album\Album', $id);

        $client->getContainer()->get('doctrine')->getManager()->remove($album);
    }

    public function testRemoveAlbum()
    {
        $faker = Factory::create();

        $client = static::createClient();
        $client->followRedirects();

        $newAlbum = new Album(
            $faker->sentence(),
            1
        );

        $em = $client->getContainer()->get('doctrine')->getManager();
        $em->persist($newAlbum);
        $em->flush($newAlbum);

        $crawler = $client->request('DELETE', sprintf('/albums/%d', $newAlbum->id()));

        $this->assertCount(1, $crawler->filter('.alert.alert-info'));
    }

    public function testChangeAlbumName()
    {
        $client = static::createClient();
        $client->followRedirects();

        $faker = Factory::create();

        $client->getContainer()->get('predis')->flushall();

        $originalTitle = $faker->sentence();

        $newAlbum = new Album(
            $originalTitle,
            1
        );

        $em = $client->getContainer()->get('doctrine')->getManager();
        $em->persist($newAlbum);
        $em->flush($newAlbum);

        $newTitle = $faker->sentence();

        $crawler = $client->request('PUT', sprintf('/albums/%d', $newAlbum->id()), [
            'title' => $newTitle
        ]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertCount(1, $crawler->filter('.alert.alert-info'));
        $this->assertEquals(
            $originalTitle,
            $crawler->filterXPath(
                sprintf('//*[text() = "%s"]/following-sibling::td/text()', $newAlbum->id())
            )->text()
        );

        $this->executeConsumeCommand();

        $crawler = $client->request('GET', '/albums');

        $this->assertEmpty($crawler->filter('.alert.alert-info'));
        $this->assertEquals(
            $newTitle,
            $crawler->filterXPath(sprintf('//tbody/tr/td[text() = "%s"]', $newAlbum->id()))->nextAll()->eq(0)->text()
        );
    }

    private function executeConsumeCommand()
    {
        $kernel = $this->createKernel();
        $kernel->boot();

        $application = new Application($kernel);
        $application->add($kernel->getContainer()->get('bernard.command.consume_command'));

        $command = $application->find('bernard:consume');
        $commandTester = new CommandTester($command);
        $commandTester->execute(['command' => $command->getName(), '--max-messages' => 1, 'queue' => 'league\\-tactician\\-bernard\\-queueable-command']);
    }
}
