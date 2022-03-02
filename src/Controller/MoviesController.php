<?php

namespace App\Controller;

# Below, marked by the "use" keyword the class imports are defined.
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    #[Route('/movies', name: 'movies')]
    public function index(): Response
    {
        $movies = ['Avengers: Endgame', 'Inception', 'Loki', 'Black Widow'];
        return $this->render('index.html.twig', array(
            'movies' => $movies
        ));
    }
}
