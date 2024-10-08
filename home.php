<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<style>
		html, body {
            margin: 0;
            height: 100%; /* Set full height for body and html */
            display: flex;
            flex-direction: column; /* Use flexbox for vertical layout */
            background-image: url(n_logo.png);
        }
	.nav {
		background: #333;
	    color: white;
	    padding: 20px 0;
	    margin-bottom: 20px;
	  	list-style-type: none;
	}

	.nav li {
	  display: inline-block;
	  font-size: 20px;
	  padding: 20px;
	  color: white;
	  height: 100%;
	}
	img
	{
		width: 30px;
		height: 30px;
	}
	.nav li a{
		color: white;
	}
	.left_content
		{
			float:left;
			display: flex;
			flex-direction :column;
			width: 200px;
			border: 10;
		}
		.left_content button
		{
			margin:10px 0;
			padding: 10px;
		}
	.right_content
		{
			float:right;
			display: flex;
			flex-direction :column;
			width: 200px;
			border: 1;
		}
		.right_content button
		{
			margin:10px 0;
			padding: 10px;
		}
		.content {
            flex: 1; /* Takes up remaining space, pushing footer to the bottom */
            padding: 20px;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            width: 100%;
            margin-bottom:0;
        }
</style>
</head>
<body>
	<ul class="nav">
	  <li><img src="n_logo.png"> Nani Bank</li>
	  <li><a href="home.php">Home</a></li>
	  <li><a href="add_account.html">Add friends account </a></li>
	  <li><a href="account_transaction.html">Money transfer</a></li>
	  <li><a href="view_transactions.html">View statements</a></li>  
	  <li><a href="logout">logout</a></li>
	</ul>
	<div class="block-container">
		<div class="left_content">
			<button><a href="account_transaction.php">Account transfer</a></button>
			<button><a href="view_transactions.php">View Statements</a></button>
			<button>Personal Loan</button>
			<button><a href="add_account.php">View added accounts</a></button>
			<button>Profile</button>
			<button>Summary</button>
		</div>
		<div class="right_content">
			<button>chat with bot</button>
			<button>customer care</button>
			<button>Locate Branch</button>
			<button>Talk with Bot</button>
		</div>
	</div>
	<footer class="content">
        <p>&copy; 2024 My Bank. All rights reserved.</p>
    </footer>
</body>

</html>