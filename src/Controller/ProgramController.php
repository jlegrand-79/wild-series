<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]

    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
        ]);
    }


    // #[Route('/{id}', methods: ['GET'], requirements: ['id' => '\d+'], name: 'show')]
    #[Route('/{id<\d+>}', name: 'show', methods: ['GET'])]
    // Alternative : il est aussi possible d'écrire les requirements de manière plus condensée : #[Route('/program/list/{page<\d+>}', name: 'program_list')]. Cette écriture inline nécessite l'utilisation des chevrons < > pour encadrer la regex.
    public function show(int $id): Response
    {
        return $this->render('program/show.html.twig', [
            'id' => $id,
        ]);
    }
}
