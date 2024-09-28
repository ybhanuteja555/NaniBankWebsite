<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Accounts Added</title>
</head>
<body>
	<?php
		session_start();
		$conn = new mysqli("localhost","root","","nani_bank_website");

		if ($conn->connect_error) {
		// code...
			die("db is not connected".$conn);
		}

		$query1 ="Select * from bank_add_accounts where my_account_number=?";
		$stmt=$conn->prepare($query1);
		$acc_num =6;
		$stmt->bind_param("i",$acc_num);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows >0)
		{
			echo "<table border='1'>
            <tr>
                <th>Account number</th>
                <th>Name</th>
                <th>Nick name</th>
                <th>Bank name</th>
                <th>IFSC Code</th>
            </tr>";

    		// Fetch the results as an associative array and print each row
    		while ($row = $result->fetch_assoc()) {
        		echo "<tr>
	                <td>" .$row['account_number_frd'] . "</td>
	                <td>" .$row['name']."</td>
	                <td>" .$row['nick_name'] . "</td>
	                <td>" .$row['bank_name'] . "</td>
	                <td>" .$row['ifsc_code'] . "</td>
	              </tr>";
    		}
    		echo "</table>";
		}
			
	?>
</body>
</html>