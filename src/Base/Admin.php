<?php


namespace Base;


class Admin extends DataBase
{
    public function deleteUser()
    {
        $userId = $_POST['user_id'];
        $this->query('DELETE FROM utilisateurs WHERE id = ?', [
            $userId
        ]);
        return $userId;
    }
}