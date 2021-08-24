<?php

declare(strict_types=1);

namespace App\Controller\Comment;

use App\Entity\Comment;
use App\Form\Type\Comment\CommentType;
use App\Service\Comment\CommentCreator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("item/{id}/comment/add", name="comment_new", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function add(Request $request, int $id, CommentCreator $commentCreator): Response
    {
        $comment = new Comment();
        $user = $this->getUser();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $commentCreator->create($form, $user, $id);

            return $this->redirectToRoute('item_show', ['id' => $id]);
        }
        return $this->renderForm('comment/add.html.twig', [
            'form' => $form,
        ]);
    }
}