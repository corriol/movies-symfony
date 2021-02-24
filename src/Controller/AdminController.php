<?php

namespace App\Controller;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $moviesRepository = $this->getDoctrine()->getRepository(Movie::class);
        $movies = $moviesRepository->findAll();
        return $this->render('admin/index.html.twig', [
            'movies' => $movies
        ]);
    }
}
