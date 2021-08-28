<?php


use app\Entity\Post;

class PostDao
{
    private DbManager $db;

    public function create(Post $post)
    {
        $sql = "INSERT INTO post (title, imageUrl, content, created_date, user_id)
                values (:title , :imageUrl, :content, NOW(), :user_id)";
        $q = $this->db->prepare($sql);
        $q->bindValue(':title', $post->getTitle());
        $q->bindValue(':imageUrl', $post->getImageUrl());
        $q->bindValue(':content', $post->getContent());
        $q->bindValue(':user_id', $post->getUserId(), PDO::PARAM_INT);


        $q->execute();
    }
    public function read(int $id): Post
    {
        $sql = "select * from post where post_id =" . $id;
        $q = $this->db->query($sql);
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $post = new Post();
        $post->hydrate($data);

        return $post;
    }
    public function list(): array
    {
        $posts = [];
        $sql = "select * from post";
        $q = $this->db->query($sql);

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $post = new Post();
            $post->hydrate($donnees);
            $posts[] = $post;
        }
        return $posts;
    }
    public function delete(int $id)
    {
        $sql = "delete from post where post_id=" . $id;
        $this->db->exec($sql);
    }
}
