<?php


use app\Entity\Comment;

class CommentDao
{
    private DbManager $db;

    public function create(Comment $comment)
    {
        $sql = "INSERT INTO comment (text, created_date, user_id, post_id)
                values (:text , NOW(), :user_id, :post_id)";
        $q = $this->db->prepare($sql);
        $q->bindValue(':text', $comment->getText());
        $q->bindValue(':user_id', $comment->getUserId(), PDO::PARAM_INT);
        $q->bindValue(':post_id', $comment->getPostId(), PDO::PARAM_INT);
        $q->execute();
    }

    public function read(int $id): Comment
    {
        $sql = "SELECT *
                from comment
                where comment_id =" . $id;
        $q = $this->db->query($sql);
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $comment = new Comment();
        $comment->hydrate($data);

        return $comment;
    }
    public function list(): array
    {
        $comments = array();
        $sql = "SELECT * from comment";
        $q = $this->db->query($sql);

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->hydrate($donnees);
            $comments[] = $comment;
        }
        return $comments;
    }
    public function delete(int $id)
    {
        $sql = "DELETE from comment where comment_id=" . $id;
        $this->db->exec($sql);
    }
}
