<?php

use Blog\Entity\Comment;
use Blog\Entity\Post;

require_once __DIR__ . '/../src/bootstrap.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = $_GET['id'];
$post = $entityManager->getRepository(Post::class)->find($id);

if (!$post) {
    throw new \Exception("Post not found");
}

$comments = $post->getComments();

if ('POST' === $_SERVER['REQUEST_METHOD']) {
    $comment = new Comment();
    
    $body = $_POST['body'];
    $comment
        ->setBody($body)
        ->setPublicationDate(new \DateTimeImmutable())
        ->setPost($post)
    ;

    $entityManager->persist($comment);
    $entityManager->flush();

    header(sprintf('Location: show.php?id=%d', $post->getId()));
    exit;
}

?>

<!doctype html>
<html>
    <head>
        <title><?=$post->getTitle()?> - Blog</title>
    </head>
        <h1><?=htmlspecialchars($post->getTitle())?></h1>
        <p><?=htmlspecialchars($post->getBody())?></p>
        Published at: <?=$post->getPublishedAt()->format('Y-m-d H:i:s')?>
        <br>
        <br>
        <form method="POST">
            <textarea type="text" name="body" placeholder="comment goes here"></textarea><br>
            <button type="submit">Submit</button>
        </form>

        <h3>Comments</h3>
        <?php if (empty($comments)): ?>
            <p>No comment for this post</p>
        <?php else: ?>
            <?php foreach ($comments as $comment):  ?>
                <p><?= htmlspecialchars($comment->getBody())?></p>
                Published on: <span><?=$comment->getPublicationDate()->format('Y-m-d H:i:s') ?></span>
                
            <?php endforeach ?>
        <?php endif ?>
    <body>
       
    </body>
</html>