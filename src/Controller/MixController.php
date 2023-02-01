<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Repository\CatAclysmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MixController extends AbstractController
{
    #[Route('/mix/new')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $mix = new Playlist();
        $mix->setTitle('Perso ' . rand(1, 30));
        $mix->setDescription('Test');
        $genre = ['Chiptune', 'Funk', 'House', 'Metal', 'Ambiant', 'Breakbeat', 'IDM'];
        $mix->setGenre($genre[array_rand($genre)]);
        $mix->setTrackCount(rand(5, 20));
        $mix->setVotes(rand(-50, 100));

        $entityManager->persist($mix);
        $entityManager->flush();

        return new Response(sprintf(
           'Mix %d is %d tracks of pure 80\'s heaven',
            $mix->getId(),
            $mix->getTrackCount()
        ));
    }

    #[Route('/mix/{id}', name: 'app_mix_show')]
    public function show(Playlist $mix): Response
    {
//        $mix = $mixRepository->find($id);
//
//        if (!$mix)
//        {
//            throw $this->createNotFoundException('Playlist  not found :(');
//        }

        return $this->render('mix/show.html.twig', [
            'mix' => $mix,
        ]);
    }

    #[Route('mix/{id}/vote', name: 'app_mix_vote', methods: ['POST'])]
    public function vote(Playlist $mix, Request $request, EntityManagerInterface $entityManager): Response
    {
        $direction = $request->request->get('direction', 'up');

        if ($direction === 'up')
        {
            $mix->upVote();
        } else {
            $mix->downVote();
        }
        $entityManager->flush();

        $this->addFlash('success', 'Vote enregistré !');

        return $this->redirectToRoute('app_mix_show', [
            'id' => $mix->getId(),
        ]);
    }
}