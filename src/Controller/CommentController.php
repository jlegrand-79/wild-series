<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/comment', name: 'comment_')]
class CommentController extends AbstractController
{
    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(
        Comment $comment,
        CommentRepository $commentRepository
    ): Response {
        $episode = $comment->getEpisode();
        $season = $episode->getSeason();
        $program = $season->getProgram();
        $user = $this->getUser();

        if (in_array('ROLE_ADMIN', $user->getRoles()) || $user == $comment->getAuthor()) {
            $commentRepository->remove($comment, true);
            $this->addFlash('danger', 'Le commentaire a bien été supprimé.');

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
        // If not the author nor admin, throws a 403 Access Denied exception
        throw $this->createAccessDeniedException('Only the admin or its author can delete a comment!');
    }
}
