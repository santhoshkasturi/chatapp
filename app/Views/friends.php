<style>
  body {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .search-box {
    display: flex;
    align-items: center;
  }

  .search-box input[type="text"] {
    width: 200px;
    height: 30px;
    padding: 5px;
    border: none;
    border-bottom: 1px solid #aaa;
    font-size: 16px;
    margin-right: 10px;
  }

  .search-box button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 8px 16px;
    font-size: 16px;
    cursor: pointer;
  }

  .header-right {
  display: flex;
  align-items: center;
  margin-top: 15px;
}

.header-right form {
  margin-left: 10px;
}

.header-right button {
  display: inline-block;
  padding: 5px 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
  text-decoration: none;
  color: #333;
  background-color: transparent;
  cursor: pointer;
}

.header-right button:hover {
  background-color: #f5f5f5;
}
  /* User table */
.user-table-container {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 25px;
  width:50%;
}

.user-table {
  border-collapse: collapse;
  width: 50%;
}

.user-table th, .user-table td {
  text-align: center;
  padding: 8px;
  background-color:#ddf0e2;
}

.user-table th {
  background-color: #4CAF50;
  color: white;
}

.user-table tr:nth-child(even) {
  background-color: #f2f2f2;
}

.user-table tr:hover {
  background-color: #ddd;
}

.actions {
  background-color: #4CAF50;
  color: white;
  padding: 6px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

  
  .username{
    font-weight: bold;
    text-transform: uppercase;
    text-align: center; 
    padding: 10px;
  }

  .actions {
    background-color: #e3ebe1;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center; 
    padding: 10px;
  }
 
  
  .chat-button {
    background-color:#95afc2;
    border: none;
    padding: 10px;
    border-radius: 5px; 
    cursor: pointer;
    font-size: 14px;
  }
  
  .friend-request-button {
  background-color: #3cadd4;
  border: none;
  color: white;
  padding: 6px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
  border-radius: 8px;
}

.friend-request-button:hover {
  background-color: #4caad4;
}
  
  .friend-label {
    background-color: #F9A7B0;
    color: #FFF;
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
  }


</style>

<body>
<!-- Search form -->
<form action="/user/search" method="get" id="search-user">
    <div class="search-box">
        <input type="text" name="username" placeholder="Search user.." required>
        <button type="submit">Search</button>
    </div>
</form>

<div class="header-right">
    <form method="get" action="/user/friendrequests">
        <button type="submit">Friend Requests</button>
    </form>
    <form method="get" action="/user/friends">
        <button type="submit">Friends</button>
    </form>
</div>

<div class="user-table-container">
<table class="user-table">
<thead>
      <tr>
        <th>User</th>
        <th>Action</th>
      </tr>
    </thead>
  <?php if (!empty($users)): ?> 
    <?php foreach ($users as $user) { ?>
      <tr>
          <td class="username"><?= $user->username ?></td>
          <td  class = "actions">
              <?php if ($user->status === 'friends') { ?>
                <form action="/user/chat/<?= $user->username ?>" method="get">
                <input type="hidden" name="start_chat" value="<?= $user->username ?>">
                <button class="chat-button" type="submit" action="/user/chat">Chat</button>
              </form>
              <?php } else if ($user->status === 'pending') { ?>
                  <span class="friend-label">Friend Request Sent</span>
              <?php }  ?>
            
              <?php  ?>
          </td>
      </tr>
    <?php } ?>
  <?php endif; ?>
</table>
             
</div>
