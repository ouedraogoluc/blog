<?php

namespace app\Entity;

class Comment
{
    private ?int $comment_id;
    private string $text;
    private string $created_date;
    private int $user_id;
    private int $post_id;

    /**
     * Comment constructor.
     * @param int|null $comment_id
     */
    public function __construct(?int $comment_id = null)
    {
        $this->comment_id = $comment_id;
    }


    public function getCommentId(): int
    {
        return $this->comment_id;
    }

    /**
     * @param int $comment_id
     */
    public function setCommentId(int $comment_id): void
    {
        $this->comment_id = $comment_id;
    }

    /**
     * @return string
     */
    public function getCreatedDate(): string
    {
        return $this->created_date;
    }

    /**
     * @param string $created_date
     */
    public function setCreatedDate(string $created_date): void
    {
        $this->created_date = $created_date;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->post_id;
    }

    /**
     * @param int $post_id
     */
    public function setPostId(int $post_id): void
    {
        $this->post_id = $post_id;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}