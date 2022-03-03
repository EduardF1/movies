<?php

namespace App\Controller;

# Below, marked by the "use" keyword the class imports are defined.
use App\Entity\Actor;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class MoviesController extends AbstractController
{
    #[Route('/movies', name: 'movies')]
    public function index(EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
//        $repository = $entityManager->getRepository(Movie::class);
//        $movies = $repository->findAll();
//        return new JsonResponse($movies, Response::HTTP_OK);

//        $sql = 'SELECT a.name FROM Actor a INNER JOIN  movie_actor ma ON a.id = ma.actor_id INNER JOIN movie m on ma.movie_id = m.id WHERE movie_id = 7';
//        $statement = $entityManager->getConnection()->prepare($sql);
//        $statement->executeQuery();
//        $result = $statement->();
//
//        return new JsonResponse($rsm, Response::HTTP_OK);
//        $sql = "
//       SELECT a.name FROM actor a INNER JOIN  movie_actor ma ON a.id = ma.actor_id INNER JOIN movie m on ma.movie_id = m.id WHERE movie_id = 7;
//    ";
//        $sql = "SELECT * FROM movie m INNER JOIN movie_actor ma ON m.id = ma.movie_id INNER JOIN actor a ON a.id = ma.actor_id WHERE a.name LIKE 'Christian Bale'";
//
//        $stmt = $entityManager->getConnection()->prepare($sql);
//        $result = $stmt->executeQuery()->fetchAllAssociative();
                $repository = $entityManager->getRepository(Movie::class);
        $movies = $repository->findAll();
        return new JsonResponse($movies, Response::HTTP_OK);
    }
}
