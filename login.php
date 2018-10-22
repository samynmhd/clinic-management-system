<?php
    include("creds.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<style type="text/css">
		.form{
			width: 360px;
			margin: 50px auto;
			border-radius: 10px;
			border: 2px solid #ccc;
			padding: 10px 40px 25px;
			margin-top: 70px;
			font-family: Cambria, "Hoefler Text","Liberation Serif",Times,"Times New Roman",serif;
		}
		input[type=text],input[type=password]{
			width: 90%;
			padding: 10px;
			margin-top: 8px;
			border: 1px solid #ccc;
			padding-left: 5px;
			font-size: 16px;
			font-family: Cambria, "Hoefler Text","Liberation Serif",Times,"Times New Roman",serif;
		}
        select {
            width: 90%;
			padding: 10px;
			margin-top: 8px;
			border: 1px solid #ccc;
			padding-left: 5px;
			font-size: 16px;
			font-family: Cambria, "Hoefler Text","Liberation Serif",Times,"Times New Roman",serif;
        }
		input[type=submit]{
			width: 100%;
			background-color: #9FB48B;
			border: 2px solid #000;
			padding: 10px;
			font-size: 20px;
			cursor: pointer;
			border-radius: 5px;
			margin-bottom: 15px;
            color: white;
		}
	</style>
</head>
<body>
<div class="form">
	<h1 align="Center">LOGIN</h1>
	<form name="login" method="POST" action="" style="text-align: center;">
		<input type="text" name="user" placeholder="username" id="user"><br><br>
		<input type="password" name="pass" placeholder="password" id="pass"><br><bR>
        <select name="userType" id="userType">
            <option value="admin">Admin</option>
            <option value="doctor">Doctor</option>
            <option value="staff">Staff</option>
        </select><br><br>
		<input type="submit" name="login" value="Login">
		<span><?php echo $error; ?></span>
	</form>
</div>
</body>
</html>