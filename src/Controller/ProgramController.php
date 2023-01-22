<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\CommentType;
use App\Repository\ProgramRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ProgramType;
use App\Repository\CommentRepository;
use App\Service\ProgramDuration;
use DateTime;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render(
            'program/index.html.twig',
            [
                'programs' => $programs,
            ]
        );
    }

    /**
     * The controller for the program add form
     * Display the form or deal with it
     */
    #[Route('/new', name: 'new')]
    public function new(Request $request, MailerInterface $mailer, ProgramRepository $programRepository, SluggerInterface $slugger): Response
    {
        // Create a new Program Object
        $program = new Program();
        // Create the associated Form
        $form = $this->createForm(ProgramType::class, $program);
        // Get data from HTTP request
        $form->handleRequest($request);
        // Was the form submitted ?
        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($program->getTitle());
            $program->setSlug($slug);
            // Deal with the submitted data
            // For example : persiste & flush the entity
            $programRepository->save($program, true);
            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to($this->getParameter('mailer_to'))
                ->subject('Une nouvelle série vient d\'être publiée !')
                ->html($this->renderView('program/newProgramEmail.html.twig', ['program' => $program]));

            $mailer->send($email);

            // Once the form is submitted, valid and the data inserted in database, you can define the success flash message
            $this->addFlash('success', 'La série a bien été créée.');
            // And redirect to a route that display the result
            // Redirect to programs list
            return $this->redirectToRoute('program_index');
        }

        // Render the form
        return $this->renderForm('program/new.html.twig', [
            'form' => $form,
        ]);
    }

    // EDIT PROGRAM START

    // Route avant de changer l'id par le slug : 
    // #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    #[Route('/{slug}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Program $program, ProgramRepository $programRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($program->getTitle());
            $program->setSlug($slug);
            $programRepository->save($program, true);
            $this->addFlash('success', 'La série a bien été modifiée.');

            return $this->redirectToRoute('program_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('program/edit.html.twig', [
            'program' => $program,
            'form' => $form,
        ]);
    }

    // EDIT PROGRAM END

    // Route avant de changer l'id par le slug : 
    // #[Route('/show/{id<^[0-9]+$>}', name: 'show')]
    #[Route('/show/{slug}', name: 'show')]
    public function show(Program $program, ProgramDuration $programDuration): Response
    {
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'programDuration' => $programDuration->calculate($program),
        ]);
    }


    #[Route('/{programId<^[0-9]+$>}/season/{seasonId<^[0-9]+$>}', name: 'season_show')]
    #[Entity('program', options: ['mapping' => ['programId' => 'id']])]
    #[Entity('season', options: ['mapping' => ['seasonId' => 'id']])]
    public function showSeason(Program $program, Season $season): Response
    {
        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
        ]);
    }

    // #[Route('/{programId<^[0-9]+$>}/season/{seasonId<^[0-9]+$>}/episode/{episodeId<^[0-9]+$>}', name: 'episode_show')]
    #[Route('/{programSlug}/season/{seasonId<^[0-9]+$>}/episode/{episodeSlug}', name: 'episode_show')]
    #[Entity('program', options: ['mapping' => ['programSlug' => 'slug']])]
    #[Entity('season', options: ['mapping' => ['seasonId' => 'id']])]
    #[Entity('episode', options: ['mapping' => ['episodeSlug' => 'slug']])]
    public function showEpisode(
        Program $program,
        Season $season,
        Episode $episode,
        Request $request,
        CommentRepository $commentRepository,
    ): Response {
        $comments = $commentRepository->findBy(
            ['episode' => $episode->getId()],
            ['date' => 'ASC'],
        );
        if (!$this->getUser()) {
            return $this->render('program/episode_show.html.twig', [
                'program' => $program,
                'season' => $season,
                'episode' => $episode,
                'comments' => $comments,
            ]);
        }
        $user = $this->getUser();
        $comment = new Comment();
        $commentForm = $this->createForm(CommentType::class, $comment);
        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $comment->setAuthor($user);
            $comment->setEpisode($episode);
            $comment->setDate(new DateTime('now'));
            $commentRepository->save($comment, true);
            $this->addFlash('success', 'Votre avis a bien été ajouté !');
            return $this->redirectToRoute(
                'program_episode_show',
                [
                    'programSlug' => $program->getSlug(),
                    'seasonId' => $season->getId(),
                    'episodeSlug' => $episode->getSlug(),
                ],
                Response::HTTP_SEE_OTHER
            );
        }
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode,
            'comment_form' => $commentForm->createView(),
            'comments' => $comments,
        ]);
    }

    // DELETE PROGRAM START

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Program $program, ProgramRepository $programRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $program->getId(), $request->request->get('_token'))) {
            $programRepository->remove($program, true);
            $this->addFlash('danger', 'La série a bien été supprimée.');
        }

        return $this->redirectToRoute('program_index', [], Response::HTTP_SEE_OTHER);
    }

    // DELETE PROGRAM END
}
