<?php

use Blog\Entity\Post;

require_once __DIR__ . '/../src/bootstrap.php';

if (isset($_GET['id'])) {
    $post = $entityManager->getRepository(Post::class)->findOneBy(['id' => $_GET['id']]);

    if (!$post) {
        throw new \Exception("Post not found");
    }
}

if ('POST' === $_SERVER['REQUEST_METHOD']) {
    if (!isset($post)) {
        $post = new Post();
        $entityManager->persist($post);
        $post->setPublishedAt(new \DateTimeImmutable());
    }

    $post
        ->setTitle($_POST['title'])
        ->setBody($_POST['body'])
    ;

    $entityManager->flush();

    header('Location: index.php');
    exit;
}


?>
<!doctype html>
<html>
    <head>
        <title>Blog - Home</title>
    </head>

    <body>
        <form method="POST">
            <span>Title<input name="title" value="<?= isset($post) ? htmlspecialchars($post->getTitle()) : '' ?>"/></span><br>
            Body<textarea row=10 name="body">
                <?=isset($post) ? htmlspecialchars($post->getBody()) : '' ?>
            </textarea><br>

            <button type="submit">Save</button>
        </form>
    </body>
</html>