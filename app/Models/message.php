<?php namespace App\Models;

use CodeIgniter\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $allowedFields = ['from_user_id', 'to_user_id', 'message'];

    public function retrieveChat($sender, $recipient)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT messages.*, from_user.username as from_username, to_user.username as to_username 
        FROM messages
        INNER JOIN users AS from_user ON from_user.id = messages.from_user_id
        INNER JOIN users AS to_user ON to_user.id = messages.to_user_id
        WHERE 
          (from_user.username = '{$sender}' AND to_user.username = '{$recipient}') 
          OR (from_user.username = '{$recipient}' AND to_user.username = '{$sender}')
        ORDER BY created_at;
        
                     ");
        $result = $query->getResult();
        return $result;

    }

    public function sendMessage($sender, $recipient, $message)
    {
        $db = \Config\Database::connect();
        $query = $db->query("INSERT INTO messages (from_user_id, to_user_id, message)
        VALUES (
            (SELECT id FROM users WHERE username = '{$sender}'),
            (SELECT id FROM users WHERE username = '{$recipient}'),
            '{$message}'
        );
        ");
        // $result = $query->getResult();
        // return $result;

    }
}
