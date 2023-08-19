<?php

namespace Blog\Entity;

use DateTime;
use Blog\Entity\Post;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'comment')]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::TEXT)]
    private string $body;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private DateTimeImmutable $publicationDate;

    #[ORM\ManyToOne(targetEntity: Post::class, inversedBy: 'comments')]
    private $post;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set body.
     *
     * @param string $body
     *
     * @return Comment
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set publicationDate.
     *
     * @param datetime_immutable $publicationDate
     *
     * @return Comment
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get publicationDate.
     *
     * @return datetime_immutable
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }


    /**
     * Set post.
     *
     * @param \Blog\Entity\Post|null $post
     *
     * @return Comment
     */
    public function setPost(\Blog\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post.
     *
     * @return \Blog\Entity\Post|null
     */
    public function getPost()
    {
        return $this->post;
    }
}
