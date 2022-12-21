<?php

namespace App\Controller;

use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/actor', name: 'actor_')]
class ActorController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ActorRepository $actorRepository): Response
    {
        $actors = $actorRepository->findAll();

        return $this->render(
            'actor/index.html.twig',
            [
                'actors' => $actors,
            ]
        );
    }

    #[Route('/{actorId}', name: 'show')]
    public function show(int $actorId, ActorRepository $actorRepository): Response
    {
        $actor = $actorRepository->findOneBy(['id' => $actorId]);

        if (!$actor) {
            throw $this->createNotFoundException(
                'No actor with id : ' . $actorId . ' found in actor\'s table.'
            );
        }

        $programs = $actor->getPrograms();

        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
            'programs' => $programs,
        ]);
    }
}
