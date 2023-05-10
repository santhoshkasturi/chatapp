<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class UserController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        return view('login');
    }

public function checkDatabaseConnection()
{
try {
$model = new User();
$model->db->connect();
return $this->response->setJSON(['status' => 'success', 'message' => 'Database connection is successful']);
} catch (\Exception $e) {
return $this->response->setJSON(['status' => 'error', 'message' => 'Database connection failed: '.$e->getMessage()]);
}
}

public function display_users()
{
    $db = \Config\Database::connect();
    $username = "santhosh";
    $search_query = "test2";
    $query = $db->query("SELECT u.username, f.status
                     FROM users u
                     LEFT JOIN (
                         SELECT * FROM friends WHERE username1 = '{$username}' OR username2 = '{$username}'
                     ) f ON u.username = IF(f.username1 = '{$username}', f.username2, f.username1)
                     WHERE u.username LIKE '{$search_query}%'");

    $result = $query->getResult();
    foreach ($result as $row) {
        echo $row->username . ' - ' . $row->status . '<br>';
    }
}


    public function login()
    {
       
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');


        if (empty($username) || empty($password)) {
            return $this->failValidationErrors('Please provide a username and password.');
        }


        $model = new User();
        $user = $model->where('username', $username)->first();
        if (!$user || $user['password'] !== $password) {
            $data['error'] = 'Incorrect username or password.';
            return view('login', $data);
        }

        session()->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
        ]);

        $data['users'] = '';

        // return $this->respondCreated(['message' => 'Login successful.']);
        return view('logged_user', $data);
    }

    

    public function searchUser()
    {
        $username = $this->request->getVar('username', FILTER_SANITIZE_STRING);
        $searchQuery = $username;

  
        $rules = [
            'username' => 'required',
        ];
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $userModel = new User();
       
        $sessionUsername = session()->get('username');
        $users = $userModel->searchUsers($searchQuery, $sessionUsername);

        $data['users'] = $users;
        return view('logged_user', $data);

    }

    public function friends()
    {
        
        $userModel = new User();
      
        $sessionUsername = session()->get('username');
        $users = $userModel->friends($sessionUsername);

        $data['users'] = $users;
        return view('friends', $data);

    }

    public function friendRequests()
    {
        
        $userModel = new User();
      
        $sessionUsername = session()->get('username');
        $users = $userModel->friendRequests($sessionUsername);

        $data['users'] = $users;
        return view('friend_request', $data);

    }

    public function acceptRequest()
    {
        $userModel = new User();
      
        $sessionUsername = session()->get('username');
        $username = $this->request->getVar('username', FILTER_SANITIZE_STRING);
        $accept = $userModel->acceptRequests($sessionUsername, $username);
        $users = $userModel->friendRequests($sessionUsername);
        $data['users'] = $users;
        return view('friend_request', $data);
    }

    public function deleteRequest()
    {
        $userModel = new User();
 
        $sessionUsername = session()->get('username');
        $delete = $userModel->deleteRequests($sessionUsername, $username);
        $users = $userModel->friendRequests($sessionUsername);
        $data['users'] = $users;
        return view('friend_request', $data);
    }

    public function addFriend()
    {
        $username2 = $this->request->getVar('send_request', FILTER_SANITIZE_STRING);
        $username1 = session()->get('username');

        $userModel = new User();
        $addfriend =  $userModel->addUser($username1, $username2);

    
        // $sessionUsername = session()->get('username');
        $users = $userModel->searchUsers($username2, $username1);

        $data['users'] = $users;

        return view('logged_user', $data);



    }
}
