<?php

namespace App\Controller;

# Below, marked by the "use" keyword the class imports are defined.
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    /**
     * Below, the 'Route' attribute indicates that this is a route (HTTP) defining the route and the method that handles
     * it (the event of the '/movies' subresource being accessed in the browser). The 'index()' is function is called/returned
     * instantly when the '/movies' subresource is accessed (use the url "http://127.0.0.1:8000/movies").
     * @return Response
     */
    #[Route('/movies', name: 'app_movies')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Index !',
            'path' => 'src/Controller/MoviesController.php',
        ]);
    }

    /**
     * Returns a JSON response containing the URI variable string `name`, if no string value is
     * provided, it will return `null` as a JSON string value.
     * @param $name : Variable entered in the url request.
     * @return Response
     */
    #[Route('/movies/{name}', name: 'app_movies', defaults: ['name' => null], methods: ['GET', 'HEAD'])]
    public function getMovieByName($name): Response
    {
        return $this->json([
            'message' => $name,
            'path' => 'src/Controller/MoviesController.php',
        ]);
    }

    // Alternative (old approach to route declaration)

    /**
     * oldRouteMethodDeclaration#
     * Below, the "@Route" annotation indicates that this is an HTTP controller method, the arguments are first, the
     * HTTP subresource/path ("http://127.0.0.1:8000/old") followed by the name of the route.
     * @Route("/old", name="old")
     */
    public function oldRouteMethodDeclaration(): Response
    {
        return $this->json([
            'message' => 'Old Approach.',
            'path' => 'src/Controller/MoviesController.php',
        ]);
    }
}
