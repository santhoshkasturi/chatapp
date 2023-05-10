<!DOCTYPE html>
<html>
<head>
	<title>Search User</title>
</head>
<body>
	<h1>Search User</h1>
	
	<!-- Form to submit search query -->
	<form method="get" action="/user/search">
		<label>Search:</label><br>
		<input type="text" name="username"><br>
		
		<input type="submit" value="Search">
	</form>
	
	<!-- Display search results -->
	<?php if (!empty($users)): ?>
		<h2>Results:</h2>
		<ul>
			<?php foreach ($users as $user): ?>
				<li><a href="/chat/send_request/<?= $user['id'] ?>"><?= $user['username'] ?></a></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</body>
</html>
