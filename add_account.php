<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add account</title>
</head>
<body>
	<?php
	session_start();
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$conn = new mysqli("localhost","root","","nani_bank_website",3308);

		if ($conn->connect_error) {
			// code...
			die("db is not connected".$conn->error);
		}
		$my_account_number = $_SESSION['account_number'];
		$account_number = $_POST['account_number_frnd'];
		$query1 ="select * from nani_bank_add_accounts where account_number_frd = $account_number";
		$result = $conn->query($query1);
		if($result->num_rows > 0)
		{
			echo "Account already exists";
			echo " <button><a href = 'add_account.html'>Add account</button>
		&nbsp&nbsp&nbsp
		<button><a href = 'home.html'>Home</button>";
		}
		else
		{
			$name =$_POST['name'];
			$nick_name =$_POST['nick_name'];
			$ifsc_code =$_POST['ifsc_code'];
			$bank_name =$_POST['bank_name'];
			echo $my_account_number;
			$stmt = $conn->prepare("insert into nani_bank_add_accounts (account_number_frd,name,nick_name,bank_name,ifsc_code,my_account_number) values (?,?,?,?,?,?)");
			$stmt->bind_param("issssi",$account_number,$name,$nick_name,$bank_name,$ifsc_code,$my_account_number);
			if($stmt->execute())
			{
				echo "Account Added successfully";
				echo " <button><a href = 'added_account_view.php'>View</button>
				&nbsp&nbsp&nbsp
				<button><a href = 'home.html'>Home</button>";
			}
			else{
				echo"Account not added successfully";
			}
		}
		
	}
	?>

</body>
</html>