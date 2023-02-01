<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Repository\CatAclysmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(): Response
    {
        $tracks = [
            ['song' => 'Cazenove', 'artist' => 'Bicep'],
            ['song' => 'Big Chill', 'artist' => 'Mujo/Hakone/Max I Million'],
            ['song' => 'Street Player', 'artist' => 'Chicago'],
            ['song' => 'Delphium', 'artist' => 'Aphex Twin'],
            ['song' => 'Give Me Love', 'artist' => 'Cerrone'],
            ['song' => 'Elle Descend De La Montagne', 'artist' => 'Phenomenal Club'],
            ['song' => 'Daftendirekt', 'artist' => 'Daft Punk'],
            ['song' => 'Somebody', 'artist' => 'Cassius'],
            ['song' => 'The Road Goes On Forever', 'artist' => 'High Contrast'],
            ['song' => 'Cheeki Breeki', 'artist' => 'Apartje'],
        ];

        return $this->render('Page/homepage.html.twig', [
            'title' => 'Bienvenue sur Cat\'aclysm !',
            'tracks' => $tracks,
        ]);
    }

    #[Route('/browse/{slug}', name: 'app_browse')]
    public function browse(CatAclysmRepository $mixRepository,Request $request, string $slug = null ): Response
    {
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;

        $queryBuilder = $mixRepository->createOrderedByVotesQueryBuilder($slug);
        $adapter = new QueryAdapter($queryBuilder);
        $pagerfanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
            $adapter,
            $request->query->get('page', 1),
            9,
        );

        return $this->render('Page/browse.html.twig', [
            'genre' => $genre,
            'pager' => $pagerfanta
        ]);
    }
}