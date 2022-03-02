<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    /**
     * Will be called when loading the fixtures for the specified entity/class.
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        // The id will automatically be added
        $movie->setTitle('The Dark Knight Rises');
        $movie->setReleaseYear(2008);
        $movie->setDescription('He rises and beats the Joker.');
        $movie->setImagePath('https://cdn.pixabay.com/photo/2021/06/18/11/22/batman-6345897_960_720.jpg');
        // Add data to pivot table
        $movie->addActor($this->getReference('actor_1'));
        $movie->addActor($this->getReference('actor_2'));

        $manager->persist($movie); // Persist/Add the movie to the database

        $movie2 = new Movie();
        // The id will automatically be added
        $movie2->setTitle('Avengers Endgame');
        $movie2->setReleaseYear(2019);
        $movie2->setDescription('They rise and win the day.');
        $movie2->setImagePath('https://pixabay.com/illustrations/captain-america-avengers-marvel-5692937/');
        // Add data to pivot table
        $movie2->addActor($this->getReference('actor_3'));
        $movie2->addActor($this->getReference('actor_4'));

        $manager->persist($movie2); // Persist/Add the movie to the database

        $manager->flush(); // Makes sure that both queries are executed at the same time.
    }
}
