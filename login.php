<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Main</title>
</head>
<body>
	<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		// code...
		if ($_POST['action']=='login') {
			// code...
			$conn = new mysqli("localhost","root","","nani_bank_website");

			if($conn->connect_error)
			{
				die("db connection is failed".$conn->connect_error);
			}

			$user_name = $_POST['user_name'];
			$password = $_POST['password'];

			$query = "select * from bank_users where user_name=? and password=?";
			$stmt = $conn->prepare($query);
			$stmt->bind_param("ss",$user_name,$password);
			$stmt->execute();
			$result = $stmt->get_result();

			if($result->num_rows > 0)
			{
				$_SESSION['account_number'] = $session_account_number;
				header(main_page.html);
			}
			else
			{
				echo "The user_name or password is incorrect";
			}
 
		}
		elseif ($_POST['action']=='Create_Account') {
			// code...
			header("Location:create_account.html",true,301);
			exit();
		}
	}
	?>

</body>
</html>