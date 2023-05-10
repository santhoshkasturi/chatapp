<?php namespace App\Controllers;

use App\Models\Message;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;

class ChatController extends BaseController
{
    use ResponseTrait;

    protected $message;
    protected $user;

    public function __construct()
    {
        $this->message = new Message();
        $this->user = new User();
    }

    public function view($username) {
  
        $chatModal = new Message();
        $sender = session()->get('username');
        $chat = $chatModal->retrieveChat($sender, $username);
        $data['messages'] = $chat;
        $data['sender'] = $sender;
        $data['recipient'] = $username;
        return view('chat', $data);
        // foreach ($chat as $row) {
        //     echo $row->from_username . '-' . $row->to_username . ' - ' . $row->message . '<br>';
        // }
      }

    public function sendRequest()
    {
        $from_user_id = $this->request->getVar('from_user_id');
        $to_user_id = $this->request->getVar('to_user_id');

        $this->message->insert([
            'from_user_id' => $from_user_id,
            'to_user_id' => $to_user_id,
            'message' => 'chat request'
        ]);

        return $this->respondCreated(['status' => 'success']);
    }

    public function acceptRequest()
    {
        $from_user_id = $this->request->getVar('from_user_id');
        $to_user_id = $this->request->getVar('to_user_id');

        $this->message->insert([
            'from_user_id' => $from_user_id,
            'to_user_id' => $to_user_id,
            'message' => 'chat request accepted'
        ]);

        return $this->respondCreated(['status' => 'success']);
    }

    public function sendMessage($username)
    {
        $chatModal = new Message();
        $message = $this->request->getVar('message');
        $sender = session()->get('username');
        $send = $chatModal->sendMessage($sender, $username, $message);
        $chat = $chatModal->retrieveChat($sender, $username);
        $data['messages'] = $chat;
        $data['sender'] = $sender;
        $data['recipient'] = $username;
        return view('chat', $data);
    }

}
