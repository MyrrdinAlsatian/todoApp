<?php

namespace App\Test\Controller;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private TaskRepository $repository;
    private string $path = '/task/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Task::class);

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
        // self::assertCount(10, $crawler->filter('.thumbnail'));
        // self::assertSame("Il n'y a pas encore de tâche enregistrée.", $crawler->filter('.alert-warning')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        // $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Ajouter', [
            'task[title]' => 'Testing',
            'task[content]' => 'Testing Content',
        ]);

        self::assertResponseRedirects('/task/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testEdit(): void
    {
        // $this->markTestIncomplete();
        $fixture = new Task();
        $fixture->setTitle('My Title');
        $fixture->setContent('My Awesome Content');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Modifier', [
            'task[title]' => 'Something Title New',
            'task[content]' => 'Something Content New',
            'task[isDone]' => 1,
        ]);

        self::assertResponseRedirects('/task/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something Title New', $fixture[0]->getTitle());
        self::assertSame('Something Content New', $fixture[0]->getContent());
        self::assertSame(true, $fixture[0]->isIsDone());
    }

    public function testToggle2True() : void
    {
        $fixture = new Task();
        $fixture->setTitle('My Title');
        $fixture->setContent('My Awesome Content');
        $this->repository->save($fixture, true);
        
        $this->client->request('GET', sprintf('%s', $this->path));
        $this->client->submitForm('Marquer comme faite');
        self::assertResponseRedirects('/task/');

        $fixture = $this->repository->findAll();
        self::assertSame(true, $fixture[0]->isIsDone());

        // $this->client->
// Marquer comme faite

    }

    public function testToggle2False(): void
    {
        $this->client->request('GET', sprintf('%s', $this->path));
        $fixture = new Task();
        $fixture->setTitle('My Title');
        $fixture->setContent('My Awesome Content');
        $fixture->toggle(true);
        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s', $this->path));
        $this->client->submitForm('Marquer non terminée');
        self::assertResponseRedirects('/task/');

        // Marquer comme faite
        $fixture = $this->repository->findAll();
        self::assertSame(false, $fixture[0]->isIsDone());

    }


    public function testRemove(): void
    {
        // $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Task();
        $fixture->setTitle('My Title');
        $fixture->setContent('My Content');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s', $this->path ));
        $this->client->submitForm('Supprimer');
        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/task/');
    }
}
