<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SongController extends AbstractController
{
    #[Route('/api/songs/{id<\d+>}', methods: ['GET'])]
    public function getSong(int $id, LoggerInterface $logger): Response
    {
        $song = [
            'id' => $id,
            'name' => 'Pedro Va Au Brésil',
            'url' => 'https://www.youtube.com/watch?v=xeVP3WLKP24'
        ];

        $logger->info('Returning API response for song {song)', [
            'song' => $id,
        ]);

        return $this->json($song);
    }
}