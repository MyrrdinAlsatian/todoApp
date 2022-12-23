<?php

namespace App\Test\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private UserRepository $repository;
    private string $path = '/user/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(User::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('To Do List app');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        // $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snouveau', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Ajouter', [
            'user[username]' => 'Testing',
            'user[email]' => 'Testing@test.test',
            'user[password][first]' => 'Testing',
            'user[password][second]' => 'Testing',
        ]);

        self::assertResponseRedirects('/user/');
        $datas = $this->repository->findAll(); 
        self::assertSame($originalNumObjectsInRepository + 1, count($datas));
        self::assertContains('ROLE_USER', $datas[0]->getRoles()); 
        self::assertNotContains('ROLE_ADMIN', $datas[0]->getRoles());
    }

    // public function testShow(): void
    // {
    //     $this->markTestIncomplete();
    //     $fixture = new User();
    //     $fixture->setEmail('My Title');
    //     $fixture->setPassword('My Title');
    //     $fixture->setUsername('My Title');
    //     $fixture->setIsVerified('My Title');

    //     $this->repository->save($fixture, true);

    //     $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

    //     self::assertResponseStatusCodeSame(200);
    //     self::assertPageTitleContains('User');

    //     // Use assertions to check that the properties are properly displayed.
    // }

    public function testEdit(): void
    {
        // $this->markTestIncomplete();
        $fixture = new User();
        $fixture->setEmail('My Title');
        $fixture->setPassword('My Title');
        $fixture->setUsername('My Title');
        $fixture->setIsVerified('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/editer', $this->path, $fixture->getId()));

        $this->client->submitForm('Modifier', [
            'user[email]' => 'Something@New.tes',
            // 'user[password][first]' => 'Testing', //TODO: check when User is Logged
            // 'user[password][second]' => 'Testing',
            'user[username]' => 'Something New',
        ]);

        self::assertResponseRedirects('/user/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something@New.tes', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getUsername());
    }

    // public function testRemove(): void
    // {
    //     $this->markTestIncomplete();

    //     $originalNumObjectsInRepository = count($this->repository->findAll());

    //     $fixture = new User();
    //     $fixture->setEmail('My Title');
    //     $fixture->setRoles('My Title');
    //     $fixture->setPassword('My Title');
    //     $fixture->setUsername('My Title');
    //     $fixture->setIsVerified('My Title');

    //     $this->repository->save($fixture, true);

    //     self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

    //     $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
    //     $this->client->submitForm('Delete');

    //     self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
    //     self::assertResponseRedirects('/user/');
    // }
}
