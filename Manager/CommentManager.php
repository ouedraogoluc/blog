<?php
class CommentManager
{
    private static CommentDao $dao = new CommentDao();
    
    public static function read(int $id)
    {
        return self::$dao->read($id);
    }

    public static function list()
    {
        return self:: $dao->list();
    }
    public static function delete()
    {
        
    }
}
