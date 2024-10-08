<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Transaction details</title>
</head>
<body>
	<?php
		session_start();
		function selectAddedBankAccounts($conn,$account_number_from,$newbalance,$payment_type,$amount)
		{
			$result = $conn->query("Select * from nani_bank_add_accounts where account_number_frd=$account_number_from");
			$account = $result->fetch_assoc();
			print_r($account);
			insert($conn,$account,$amount,$payment_type,$newbalance);
		}
		function update($balance,$conn)
		{
			$account_number = $_SESSION['account_number'];
			
			$conn->query("update nani_bank_users set available_balance = $balance where account_number=$account_number");
		}
		function insert($conn,$account,$amount,$payment_type,$newbalance)
		{
			$query1 = "insert into nani_bank_account_transfer (account_number_from,account_number_to,transaction_date,bank_name,bank_ifsc,amount,account_holder_name,debit_credit) values (".$account['account_number_frd'].",".$account['my_account_number'].",'".date("Y-m-d")."','".$account['bank_name']."','".$account['ifsc_code']."',".$amount.",'".$account['name']."','".$payment_type."')";
				if($conn->query($query1) == TRUE)
				{
				echo "Transaction is succesful";
				update($newbalance,$conn);

				}
				else
				{
				echo "Transaction failed";
				}
		}
		$conn = new mysqli("localhost","root","","nani_bank_website",3308);

		if($conn->connect_error)
		{
			die("db is not connected successfully".$conn->connect_error);
		}

		$account_number = $_SESSION['account_number'];
		$account_number_from = $_POST['accounts'];
		$payment_type = $_POST['type'];
		$payment_via = $_POST['Payment_via'];
		$available_balance = $_POST['available_balance'];
		$amount = $_POST['amount'];

		if($payment_type == 'debit' and $amount > $available_balance)
		{
			echo 'Insuffucient funds';
			
		}
		elseif($payment_type == 'debit' and $amount<$available_balance)
		{
			$newbalance = $available_balance-$amount;
			selectAddedBankAccounts($conn,$account_number_from,$newbalance,$payment_type,$amount);
		}
		elseif ($payment_type == 'credit') {
			// code...
			$newbalance = $available_balance+$amount;
			selectAddedBankAccounts($conn,$account_number_from,$newbalance,$payment_type,$amount);
		}
	?>
	<table>
		<tr>
			<td>From_account:</td>
			<td>
				<?php
					echo '<input type="text" name="acount_number_to" 
					 value ="'.$account_number_from.'"readonly>'; 
				?>
			</td>
		</tr>
		<tr>
			<td>To_account:</td>
			<td>
				<?php
					echo '<input type="text" name="acount_number_to" 
					 value ="'.$account_number.'"readonly>'; 
				?>
			</td>
		</tr>
		<tr>
			<td>Amount:</td>
			<td>
				<?php
					echo '<input type="text" name="acount_number_to" 
					 value ="'.$amount.'"readonly>'; 
				?>
			</td>
		</tr>
		<tr>
			<td>Transaction date:</td>
			<td>
				<?php
					echo '<input type="text" name="acount_number_to" 
					 value ="'.date("Y-m-d").'"readonly>'; 
				?>
			</td>
		</tr>
		<tr>
			<td>Transaction date:</td>
			<td>
				<?php
					echo '<input type="text" name="acount_number_to" 
					 value ="'.$payment_type.'"readonly>'; 
				?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td><button><a href="home.html">Home</a></button>
				<button><a href="account_transaction_1.php">New Transaction</a></button>
			</td>
		</tr>
	</table>
</body>
</html>