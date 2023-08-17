<?php

namespace Blog\DataFixtures;

use Blog\Entity\Post;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostDataLoader implements FixtureInterface
{
    const NUMBER_OF_POSTS = 20;

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i <= self::NUMBER_OF_POSTS; $i++) {
            $post = new Post();

            $post
                ->setTitle(sprintf('Post number %d', $i))
                ->setBody(<<<EOT
                    This is a post like a lorem ipsum,
                    with a number $i
                    EOT
                )
                ->setPublishedAt(new \DateTimeImmutable(sprintf('-%d days', self::NUMBER_OF_POSTS - $i)))
            ;

            $manager->persist($post);
        }
        $manager->flush();
    }
}