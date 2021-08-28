<?php
class UserManager
{
    private static UserDao $dao = new UserDao();
      
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
