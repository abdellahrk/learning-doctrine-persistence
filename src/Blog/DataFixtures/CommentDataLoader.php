<?php 
namespace Blog\DataFixtures;

use Blog\Entity\Comment;
use Blog\Entity\Post;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentDataLoader implements FixtureInterface, DependentFixtureInterface
{
    const NUMBER_OF_COMMENTS = 5;

    public function load(ObjectManager $manager) 
    {
        $posts = $manager->getRepository(Post::class)->findAll();

        foreach ($posts as $post) {
            for ($i = 0; $i <= self::NUMBER_OF_COMMENTS; $i++) {
                $comment = new Comment();

                $comment
                    ->setPost($post)
                    ->setBody(<<<EOT
                     This is comment number $i
                    EOT)
                    ->setPublicationDate(new \DateTimeImmutable(sprintf('-%d days', self::NUMBER_OF_COMMENTS -$i)))
                ;
                $manager->persist($comment);
            }
        }

        $manager->flush();
    }   

    public function getDependencies()
    {
        return [PostDataLoader::class];
    }
}