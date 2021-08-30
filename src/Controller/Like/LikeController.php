<?php

declare(strict_types=1);

namespace App\Controller\Like;

use App\Service\like\LikeCheck;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class LikeController extends AbstractController
{
    public function __construct(private LikeCheck $likeCheck)
    {
    }

    /**
     * @Route("item/{item_id}/like/add", name="like", methods={"POST"})
     * @IsGranted("ROLE_USER")
     * @param int $item_id
     * @return Response
     */
    public function add(int $item_id): Response
    {
        $user = $this->getUser();
        $this->likeCheck->check($user, $item_id);
        return $this->redirectToRoute('item_show', ['id' => $item_id]);
    }
}