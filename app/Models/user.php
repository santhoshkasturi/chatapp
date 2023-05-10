<?php namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password'];

    public function searchUsers($searchQuery, $sessionUsername)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT u.username, f.status
                     FROM users u
                     LEFT JOIN (
                         SELECT * FROM friends WHERE username1 = '{$sessionUsername}' OR username2 = '{$sessionUsername}'
                     ) f ON u.username = IF(f.username1 = '{$sessionUsername}', f.username2, f.username1)
                     WHERE u.username LIKE '{$searchQuery}%' AND u.username != '{$sessionUsername}'
                     ");
        $result = $query->getResult();
        return $result;

    }

    public function friends($sessionUsername)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT u.username, f.status
                     FROM users u
                     LEFT JOIN (
                         SELECT * FROM friends WHERE username1 = '{$sessionUsername}' OR username2 = '{$sessionUsername}'
                     ) f ON u.username = IF(f.username1 = '{$sessionUsername}', f.username2, f.username1)
                     WHERE u.username != '{$sessionUsername}' AND f.status IS NOT NULL;
                     ");
        $result = $query->getResult();
        return $result;

    }

    public function friendRequests($sessionUsername)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT username1, status from friends where username2 = '{$sessionUsername}' AND status = 'pending' ");
        $result = $query->getResult();
        return $result;     
    }

    public function acceptRequests($sessionUsername, $user)
    {
        $db = \Config\Database::connect();
        $query = $db->query("UPDATE friends SET status = 'friends' WHERE username2 = '{$sessionUsername}' AND username1='{$user}';  ");
        // $result = $query->getResult();
        // return $result;     
    }

    public function deleteRequests($sessionUsername, $user)
    {
        $db = \Config\Database::connect();
        $query = $db->query("DELETE FROM friends WHERE username1 = '{$user}' AND username2 = '{$sessionUsername}'; ");
        // $result = $query->getResult();
        // return $result;     
    }

    

    public function addUser($username1, $username2)
    {
        $db = \Config\Database::connect();
        $query = $db->query("INSERT INTO friends (username1,username2,status) values('{$username1}', '{$username2}', 'pending')"); 

        // $result = $query->getResult();
        // return $query;

    }
}
