<?php


use app\Entity\User;

class UserDao
{
    private DbManager $db;
    public function create(User $user)
    {
        $sql = "INSERT INTO user (name, firstname, imageUrl, metier, login, password)
                values (:name , :firstname, :imageUrl, :metier, :login, :password)";
        $q = $this->db->prepare($sql);
        $q->bindValue(':name', $user->getName());
        $q->bindValue(':firstname', $user->getFirstName());
        $q->bindValue(':imageUrl', $user->getImageUrl());
        $q->bindValue(':metier', $user->getMetier());
        $q->bindValue(':login', $user->getLogin());
        $q->bindValue(':password', $user->getPassword());

        $q->execute();
    }

    public function read(int $id): User
    {
        $sql = "select user_id, name, firstName, imageUrl, metier, login, password 
                from user
                where user_id =" . $id;
        $q = $this->db->query($sql);
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $user = new User();
        $user->hydrate($data);

        return $user;
    }
    public function list(): array
    {
        $users = array();
        $sql = "select * from user";
        $q = $this->db->query($sql);

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $user = new User();
            $user->hydrate($donnees);
            $users[] = $user;
        }
        return $users;
    }
    public function update(User $user)
    {
        $sql = "update user set :name, :firstname, :imageUrl, :metier, :login, :password,
                 where user_id=:id";


        $q = $this->db->prepare($sql);
        $q->bindValue(':name', $user->getName());
        $q->bindValue(':firstname', $user->getFirstName());
        $q->bindValue(':imageUrl', $user->getImageUrl());
        $q->bindValue(':metier', $user->getMetier());
        $q->bindValue(':login', $user->getLogin());
        $q->bindValue(':password', $user->getPassword());
        $q->bindValue(':user_id', $user->getUserId(), PDO::PARAM_INT);

        $q->execute();
    }
    public function delete(int $id)
    {
        $sql = "delete from user where user_id=" . $id;
        $this->db->exec($sql);
    }
}
