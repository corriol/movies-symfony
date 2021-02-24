<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Rating;
use App\Form\MovieType;
use App\Form\RatingType;
use App\Service\DBTest;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{

    private array $movies;

    public function __construct(DBTest $data)
    {
        $this->movies = $data->get();
    }

    /**
     * @Route("/movies/{id}", name="movies_show", requirements={"id"="\d+"})
     */
    public function show(Movie $movie, Request $request)
    {
        $user = $this->getUser();

        $ratingRepository = $this->getDoctrine()->getRepository(Rating::class);
        // we find a related rating
        $ratings = $ratingRepository->findBy(["movie"=>$movie, "user"=>$user]);

        // if not we created a new one
        if (empty($ratings)) {
            $rating = new Rating();
            $rating->setMovie($movie);
            $rating->setUser($user);
        }
        // if yes we extract the first element from the returned array
        else
            $rating = $ratings[0];


        $form = $this->createForm(RatingType::class, $rating);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rating);
            $entityManager->flush();

            $this->addFlash('success', 'Your rating has been saved!');
        }

        if ($movie) {
            return $this->render('movies_show.html.twig',
                [
                    'movie' => $movie,
                    'form' => $form->createView()
                ]
            );
        }
    }


    /*
       * @Route("/movies/create", name="movies_create")

      public function create()
      {
          $entityManager = $this->getDoctrine()->getManager();
          $movie = new Movie();
          $movie->setTitle("Ava");
          $movie->setTagline("Kill. Or be killed.");
          $movie->setOverview("A black ops assassin is forced to fight for her
          own survival after a job goes dangerously wrong.");
          $movie->setReleaseDate(new \DateTime("2020-09-25"));
          $movie->setPoster("noposter.jpg");

          $entityManager->persist($movie);
          $entityManager->flush();
          return new Response("The movie with id " . $movie->getId().
              " has been inserted successfully!" );
      }*/

    /**
     * @Route("/movies/filter", name="movies_filter")
     */
    public function filter(Request $request)
    {
        $text = $request->query->getAlnum("text");
        $movieRepository = $this->getDoctrine()->getRepository(Movie::class);
        if (!empty($text))
            $movies = $movieRepository->filterByText($text);
        else
            $movies = $movieRepository->findBy([], ["title" => "ASC"]);
        return $this->render('movies_filter.html.twig', array(
            'movies' => $movies
        ));

    }

    /**
     * @Route("/movies/create", name="movies_create")
     */
    public function create(Request $request)
    {
        $movie = new Movie();

        $form = $this->createForm(MovieType::class, $movie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $movie = $form->getData();
            if ($posterFile = $form['posterFile']->getData()) {
                $filename = bin2hex(random_bytes(6)) . '.' . $posterFile->guessExtension();
                dump($filename);
                try {
                    $projectDir = $this->getParameter('kernel.project_dir');
                    $posterFile->move($projectDir . '/pu5blic/images/posters/', $filename);
                    $movie->setPoster($filename);
                } catch (FileException $e) {
                    $this->addFlash(
                        'danger',
                        $e->getMessage()
                    );
                    return $this->redirectToRoute('admin');
                }
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($movie);
            $entityManager->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('movies_create.html.twig', array(
            'form' => $form->createView()));
    }


    /**
     * @Route("/movies/{id}/edit", name="movies_edit")
     * @param Movie $movie
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Exception
     */
    public function edit(Movie $movie, Request $request)
    {
        $form = $this->createForm(MovieType::class, $movie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $movie = $form->getData();
            if ($posterFile = $form['posterFile']->getData()) {
                $filename = bin2hex(random_bytes(6)) . '.' . $posterFile->guessExtension();
                try {
                    $postersDir = $this->getParameter('posters_directory');
                    $posterFile->move($postersDir, $filename);
                    $movie->setPoster($filename);
                } catch (FileException $e) {
                    $this->addFlash(
                        'danger',
                        $e->getMessage()
                    );

                }
            }
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($movie);
            $entityManager->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('movies_edit.html.twig', array(
            'form' => $form->createView()));
    }

}

?>