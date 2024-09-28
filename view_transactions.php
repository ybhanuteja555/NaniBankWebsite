<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Transactions</title>
</head>
<body>
	<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		// code...
		$conn = new mysqli("localhost","root","","nani_bank_website");

		if($conn->connect_error)
		{
			die(" db not connected successfully".$conn->connect_error);
		}
		$account_number = 5;// $_SESSION['account_number']
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];
		$query1 = "select * from bank_account_transfer where account_number_to =? and transaction_date between ? and ?";
		$stmt = $conn->prepare($query1);
		$stmt->bind_param("iss",$account_number,$from_date,$to_date);
		$stmt->execute();
		$result = $stmt->get_result();
		echo "<table border=1>
		<tr>
		<td>Transaction date</td>
		<td>Account number from</td>
		<td>Account number to</td>
		<td>Amount</td>
		<td>Debit/credit</td>
		</tr>";
		while($row = $result->fetch_assoc())
		{
			echo "<tr>
			<td>".$row["transaction_date"]."</td>
			<td>".$row["acount_number_transfer"]."</td>
			<td>".$row["account_number_to"]."</td>
			<td>".$row["amount"]."</td>
			<td>".$row["debit_credit"]."</td>
			</tr>";
		}
		echo "</table>";
		

	}
	?>

</body>
</html>