<?php
	include('configure.php');
session_start();
	
	$nameErr = $mobileErr = $emailErr = $pswErr_1 = $pswErr_2 = "";
	$error = 0;
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$myuname = mysqli_real_escape_string($connect,$_POST['uname']);
		$mymobilenumber = mysqli_real_escape_string($connect,$_POST['mobilenumber']);
		$myemail = mysqli_real_escape_string($connect,$_POST['email']);
		$mypsw_1 = mysqli_real_escape_string($connect,$_POST['psw_1']);
		$mypsw_2 = mysqli_real_escape_string($connect,$_POST['psw_2']);
		
		if (empty($myuname))
		{ 
			$nameErr = "Name is required"; $error++;
		}
		
		if (empty($mymobilenumber)) 
		{ 	
			$mobileErr = "Mobile Number is required"; $error++;
		}
		
		if (empty($myemail)) { 	
			$emailErr = "Email is required"; $error++;
		}
		else {
			if (!filter_var($myemail, FILTER_VALIDATE_EMAIL)) {
                  $emailErr = "Invalid email format"; $error++;
			}
		}
		
		if (empty($mypsw_1)) 
		{ 
			$pswErr_1 = "Password is required"; $error++;
		}
		if ($mypsw_1 != $mypsw_2) 
		{
			$pswErr_2 = "The two passwords do not match"; $error++;
		}

		
		$sql = "SELECT * FROM patient_details WHERE mobile_no='$mymobilenumber' OR email='$myemail' ";
		$result = mysqli_query($connect, $sql);
		$user = mysqli_fetch_assoc($result);
		  
		if ($user) 
		{ 
			if ($user['mobile_no'] === $mymobilenumber) {
			  $mobileErr = "Mobile Number already exists"; $error++;
			}

			if ($user['email'] === $myemail) {
			  $emailErr = "Email already exists"; $error++;
			}
		}

		  // Finally, register user if there are no errors in the form
		if ($error == 0) {
			$psw = md5($mypsw_1);//encrypt the password before saving in the database

			$query = "INSERT INTO patient_details (username,mobile_no,email,password) 
					  VALUES('$myuname', '$mymobilenumber', '$myemail', '$psw')";
			echo $query;
			mysqli_query($connect, $query);
				$_SESSION['username'] = $myuname;
				$_SESSION['success'] = "You are now logged in";
				header('location:login_p.php');
		}
	}
?>

<html>
	<title>Sign Up Page</title>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<head>
<style>
	body {
		background-image: url("abc.jpg");
		background-size:cover;
		background-color:#aee147;
	}
	
	.display-logo {
		margin-top:-8px;
		margin-left:42%;
		float:center;
		position: center;
	}
	
	.mainbox {
		background-color:#ffffff;
		margin-left:37%;
		margin-right:37%;
		margin-top:15px;
		border:1px solid #DDDDDD;
		padding:0px 25px;
		margin-bottom:20px;
		width:26%;
		height:600px;
		border-radius:10px;
	}
	
	.titlelogin {
		display:block;
		margin-top: 15px;
		margin-bottom: 10px;
		font-size: 28px;
		font-weight: bold;
		text-align:center;
		color:#0096FF;;
	}
	
	input[type="text"], input[type="password"]  {
		width: 100%;
		padding: 5px 10px;
		margin: 5px 0 15px 0;
		display: inline-block;
		border: 1px solid #D9D9D9;
		box-sizing: border-box;
		border-radius:5px;
		font-family:Arial;
	}
	
	label {
		font-family:Arial;
		font-weight:550;
	}
	
	.login-button {
		width:100%;
		padding:5px 0px;
		text-align:center;
		background-color:#0096FF;
		border-color:#0086E5;
		border-radius:5px;
		color:white
	}
	.login-button:hover {
		background-color:#007ACE;
	}
	a {
		text-decoration:none;
	}
	a:hover {
		text-decoration:underline;
	}
	#loginstyle {
		text-align:center;
	}
	
	.container {
		margin-top:20px;
	}
	
	.txt1 {
		font-family: OpenSans-Regular;
		font-size: 15px;
		line-height: 1.4;
		color: #999999;
	}
	.txt2 {
		font-family: OpenSans-Regular;
		font-size: 15px;
		line-height: 1.4;
		color: #0096FF;
	}
	
	.bottom {
		display:block;
		text-align:center;
		padding-top:30px;
	}
	
	.error {
		color:red;
		font-size:15px;
	}
</style>
</head>

<body>

<div class="mainbox">
	<span class="titlelogin">SignUp</span>
	<form action="" method="post">
	<div class="container">
	
		<label for="uname">Username</label>
		<input type="text" placeholder="Enter Username" name="uname">
		<span class = "error"><?php echo $nameErr;?></span><br>
		
		<label for="mobilenumber">Mobile Number</label>
		<input type="text" placeholder="Enter Mobile Number" name="mobilenumber">
		<span class = "error"><?php echo $mobileErr;?></span><br>
		
		<label for="email">Email</label>
		<input type="text" placeholder="Enter Email" name="email">
		<span class = "error"><?php echo $emailErr;?></span><br>
		
		<label for="psw_1">Password</label>
		<input type="password" placeholder="Enter Password" name="psw_1">
		<span class = "error"><?php echo $pswErr_1;?></span><br>
		
		<label for="psw_2">Confirm Password</label>
		<input type="password" placeholder="Confirm Password" name="psw_2">
		<span class = "error"><?php echo $pswErr_2;?></span><br><br>
        <button type="submit" class="login-button">SignUp</button>		
    </div>
	</form>
	
	<div class="bottom">
		<span class="txt1">Already have an Account?</span>
		<a href="login_p.php" class="txt2">Log In</a>
	</div>

</div>
</body>
</html>