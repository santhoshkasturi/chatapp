<!-- app/Views/login.php -->
<script src="<?= base_url('public/js/login.js') ?>"></script>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<style>
		body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
		}
		.container {
			width: 400px;
			margin: 0 auto;
			padding: 150px;
			border: 1px solid #ddd;
			border-radius: 5px;
			box-shadow: 0 0 5px rgba(0,0,0,.1);
			background-color: #fff;
		}
		h2 {
			text-align: center;
		}
		form {
			display: flex;
			flex-direction: column;
		}
		input[type=text], input[type=password] {
			padding: 10px;
			margin-bottom: 15px;
			border-radius: 3px;
			border: 1px solid #ddd;
			font-size: 16px;
			box-shadow: 0 0 5px rgba(0,0,0,.1);
			transition: box-shadow .2s ease-in-out;
		}
		input[type=text]:focus, input[type=password]:focus {
			box-shadow: 0 0 10px rgba(0,0,0,.2);
		}
		input[type=submit] {
			padding: 10px 15px;
			background-color: #428bca;
			color: #fff;
			border: none;
			border-radius: 3px;
			font-size: 16px;
			cursor: pointer;
			box-shadow: 0 0 5px rgba(0,0,0,.1);
			transition: background-color .2s ease-in-out;
		}
		input[type=submit]:hover {
			background-color: #3071a9;
		}
		.disclaimer {
            background-color: #ffcccc;
            color: #d8000c;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #d8000c;
            border-radius: 3px;
            font-size: 16px;
			text-align: center;
        }

	</style>
</head>
<body>
	<div class="container">
		<h2>Login</h2>
		<form action="/user/login" method="post" id="login-form>
			<label for="username">Username</label>
			<input type="text" name="username" id="username" required>
			<label for="password">Password</label>
			<input type="password" name="password" id="password" required>
			<input type="submit" value="Login">
		</form>
	</div>
	<?php if (isset($error)) { ?>
		<div class="disclaimer">
			<?= $error ?>
		</div>
	<?php } ?>
</body>
</html>


