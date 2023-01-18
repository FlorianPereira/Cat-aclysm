<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class PageController extends AbstractController
{
    #[Route('/')]
    public function homepage(): Response
    {


        return $this->render('Page/homepage.html.twig', [
            'title' => 'Bienvenue !'
        ]);
    }

    #[Route('/browse/{slug}')]
    public function browse(string $slug = null ): Response
    {
        if ($slug){
            $title = u(str_replace('-', ' ', $slug))->title(true);
        } else {
            $title = 'Tous les genres';
        }


        return new Response('Genre : ' . $title);
    }
}