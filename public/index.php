<?php 

require_once __DIR__ . '/../src/bootstrap.php';

$posts = $entityManager->getRepository('Blog\Entity\Post')->findAll();
?>

<!doctype html>
<html>
    <head>
        <title>Blog - Home</title>
    </head>

    <body>
        <?php foreach($posts as $post) : ?> 
            <article >
                <h1>
                    <?= htmlspecialchars($post->getTitle()) ?>
                </h1>
                Publication Date: <?= $post->getPublishedAt()->format('Y-m-d H:i:s') ?>

                <p>
                    <?= nl2br(htmlspecialchars($post->getBody()))?>
                </p>
                <ul>
                    <li>
                        <a href="edit-post.php?id=<?=$post->getId()?>">Edit this post</a>
                    </li>
                    <li>
                        <a href="delete-post.php?id=<?=$post->getId()?>">Delete this post</a>
                    </li>
                </ul>
            </article>
        <?php endforeach ?>

        <?php if (empty($posts)): ?>
            <p>
                No post.
            </p>
        <?php endif ?>

        <a href="edit-post.php">
            Create a new post
        </a>
    </body>
</html>