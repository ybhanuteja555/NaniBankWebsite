<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Main</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
	<style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .bg-gradient {
            background: linear-gradient(to right, #0044cc, #00aaff);
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .login-card {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
            max-width: 450px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .login-card .form-control:focus {
            box-shadow: none;
            border-color: #00aaff;
        }
        .login-card .btn-primary {
            background-color: #00aaff;
            border: none;
            transition: background-color 0.3s;
        }
        .login-card .btn-primary:hover {
            background-color: #008ecc;
        }
        .login-card .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .login-card .logo img {
            width: 80px;
            height: 80px;
        }
        .login-card .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }
        .strength-meter {
            height: 5px;
            width: 100%;
            background-color: #ddd;
            border-radius: 3px;
            margin-top: -10px;
            margin-bottom: 15px;
            overflow: hidden;
        }
        .strength-meter-fill {
            height: 100%;
            width: 0%;
            background-color: red;
            transition: width 0.3s, background-color 0.3s;
        }
        @media (max-width: 576px) {
            .login-card {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
	<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		// code...
		if ($_POST['action']=='login') {
			// code...
			$conn = new mysqli("localhost","root","","nani_bank_website",3308);

			if($conn->connect_error)
			{
				die("db connection is failed".$conn->connect_error);
			}

			$user_name = $_POST['user_name'];
			$password = $_POST['password'];

			$query = "select * from nani_bank_users where user_name=? and password=?";
			$stmt = $conn->prepare($query);
			$stmt->bind_param("ss",$user_name,$password);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0)
			{
				$login = $result->fetch_assoc();
				print_r($login);
				$_SESSION['account_number'] = $login['account_number'];
				header("Location:home.php",true,302);
			}
			else
			{?>
	<div class="bg-gradient">
        <div class="login-card">
            <div class="logo">
                <img src="n_logo.png" alt="Nani Bank Logo">
            </div>
            <h3 class="text-center mb-4">Nani Bank</h3>
            <form class="needs-validation" action="login.php" method="post">
                <div class="mb-4 position-relative">
                    <label for="email" class="form-label">Email address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="text" class="form-control" id="email" name="user_name" value="<?php echo $user_name ?>" >
                        <div class="invalid-feedback">
                            Please enter a valid username.
                        </div>
                    </div>
                </div>
                <div class="mb-4 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required aria-describedby="passwordHelp">
                        <span class="password-toggle" id="togglePassword"><i class="fas fa-eye"></i></span>
                        <div class="invalid-feedback">
                            Please enter your password.
                        </div>
                    </div>
                    <div class="strength-meter">
                        <div class="strength-meter-fill" id="strengthMeter"></div>
                    </div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
				<div>
					<p style="color:red;"><?php echo "The username or password is incorrect";}}}?></p>
				</div>
                <div class="d-grid mb-3">
                    <button class="btn btn-primary" type="submit" value="login" name="action">Login</button>
                </div>
                <div class="d-flex justify-content-center mb-3">
                    <a href="add_account.html" class="text-decoration-none" value="Create_Account" >Create account</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome for Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

</body>
</html>