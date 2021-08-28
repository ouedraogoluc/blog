<?php
class PostManager
{
    private static PostDao $dao = new PostDao();
      
    public static function read(int $id)
    {
        return self::$dao->read($id);
    }

    public static function list()
    {
        return self::$dao->list();
    }
    public function delete()
    {

    }
}
