<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Account_transaction</title>
</head>
<body>
	<p>
	<?php
		// session_start();
		$conn = new mysqli("localhost","root","","nani_bank_website");

		if($conn->connect_error)
		{
			die("db is not connected successfully".$conn->connect_error);
		}
		$acc_num = 5;
		$result = $conn->query("Select * from bank_add_accounts where my_account_number=$acc_num");
		$result1 = $conn->query("select * from bank_users where account_number = $acc_num");
		$user = $result1->fetch_assoc();
	?>
</p>
<h2>Account transaction</h2>
	<form action="account_transaction.php" method="post">
		<table>
			<tr>
				<td>Payment type :</td>
				<td><select name="type" required>
        				<option value="credit">Deposit</option>
        				<option value="debit">Withdraw</option>
				</td>
			</tr>
			<tr>
				<td>Available Balance:</td>
				<td>
					
					<input type="text" name="available_balance" value=<?php echo $user['available_balance']; ?> readonly>
					
					</td>
			</tr>
			<tr>
				<td>
					Account number from:
				</td>
				<td>
					<select name="accounts" placeholder="select an account" style="width:170px">
					<?php
						 if($result->num_rows >0)
						{
							while($row = $result->fetch_assoc())
							{
								echo '<option value="' . $row['account_number_frd'] .'">'.htmlspecialchars( $row['account_number_frd']).'</option>';
							}
						}
						else
						{
							echo '<option value="">No accounts available</option>';
						 }
					?>
				</select>
				</td>
			</tr>
			<tr>
				<td>Account number to</td>
				<td>
					
						<input type="text" name="acount_number_to" 
					 value = <?php echo $user['account_number']; ?> readonly>
				</td>
			</tr>
			<tr>
				<td>Amount :</td>
				<td><input type="text" name="amount"></td>
			</tr>
			<tr>
				<td>Payment via :</td>
				<td><input type="radio" name="Payment_via" value="Debit card">debit card
					<input type="radio" name="Payment_via" value="credit card">credit card
					<input type="radio" name="Payment_via" value="UPI">upi
					<input type="radio" name="Payment_via" value="KTGS">ktgs

				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Transfer"></td>
			</tr>
		</table>
	</form>

</body>
</html>