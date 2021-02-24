<?php
namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Rating;
use App\Form\RatingType;
use App\Repository\GenreRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private LoggerInterface $logger;
    private string $dateFormat;

    public function __construct(LoggerInterface $logger, string $dateFormat)
    {
        $this->logger = $logger;
        $this->dateFormat = $dateFormat;
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $now = new \DateTime();
        $genreRepository = $this->getDoctrine()->getRepository(Genre::class);
        $genres = $genreRepository->findAll();

        $moviesRepository = $this->getDoctrine()->getRepository(Movie::class);
        $movies = $moviesRepository->findAll();

        $rating = new Rating();
        $form = $this->createForm(RatingType::class, $rating);


        return $this->render("home.html.twig",
            [   'genres'=>$genres,
                'movies'=>$movies,
            ]
        );
    }
}
