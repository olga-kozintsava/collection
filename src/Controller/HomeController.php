<?php

declare(strict_types=1);

namespace App\Controller;


use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(private ItemRepository $itemRepository,
                                private CategoryRepository $categoryRepository)
    {
    }

    /**
     * @Route("/", name="main")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $lastUser = $authenticationUtils->getLastUsername();
        $lastItems = $this->itemRepository->findByLastAdded();
        $maxItemCategory = $this->categoryRepository->findByMaxItem();
        return $this->render('main.html.twig',
            ['lastItems' => $lastItems,
                'maxItemCategory' => $maxItemCategory

            ]
        );
    }

}