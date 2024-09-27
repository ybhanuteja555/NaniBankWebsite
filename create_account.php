<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Creation</title>
</head>
<body>
    <h2>Welcome to Nani's Website</h2>

    <?php

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $user_name = $_POST['user_name'];
        $password  = $_POST['password'];

        $conn = new mysqli("localhost","root","","nani_bank_website");

        if($conn->connect_error)
        {
            die("db connection is failed".$conn->connect_error);
        }

        $stmt =$conn->prepare("select * from bank_users where user_name =?");
        $stmt->bind_param("s",$user_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0)
        {
            echo " user Name already exists";
        }
        else{
            $stmt =$conn->prepare("insert into bank_users (user_name,password) values (?,?)");
            $stmt->bind_param("ss",$user_name,$password);
            if($stmt->execute())
            {
                $stmt =$conn->prepare("select account_number from bank_users where user_name =? and password = ?");
                $stmt->bind_param("ss",$user_name,$password);
                $stmt->execute();
                $result = $stmt->get_result();
                $arr = $result->fetch_assoc();
                $stmt =$conn->prepare("insert into bank_users_profile (first_name,last_name,Address,DOB,Mobile_number,email,gender,father_name,account_number) values (?,?,?,?,?,?,?,?,?)");
                $first_name = $_POST['first_name'];
                $last_name= $_POST['last_name'];
                $address= $_POST['address'];
                $dOB= $_POST['DOB'];
                $mobile_number= $_POST['mobile_number'];
                $email= $_POST['email'];
                $gender= $_POST['first_name'];
                $father_name= $_POST['father_name'];
                $account_number= $arr['account_number'];
                $stmt->bind_param("ssssssssi",$first_name,$last_name,$address,$dOB,$mobile_number,$email,$gender,$father_name,$account_number);
                if($stmt->execute())
                {
                    echo " Account created successfully.";
                    echo "<br> Your Account number is :".$account_number;
                    echo "<br><button><a href = 'login.html' >login</button>";
                }
                else{
                    echo "error adding user";
                }
            }
            else{
                echo "error adding user";
            }

        }
    }
    ?>
</body>
</html>