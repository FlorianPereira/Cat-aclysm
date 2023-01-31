<?php

namespace App\Controller;

use App\Entity\Playlist;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}