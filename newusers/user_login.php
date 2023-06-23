<?php
//require_once "session.php";
session_start();
ob_start();
require_once "../config.php";
$error='';
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']))
{
    $username = trim($_POST['username']);
    $Password = trim($_POST['Password']);

    if(empty($username))
    {
        $error="Pls enter email";
        //echo "$error";
    }
    if(empty($Password))
    {
        $error="Pls enter password";
        //echo "$error";
    }
    if(empty($error))
    {
        if($query = $db->prepare("SELECT * FROM newusers WHERE username=?"))
        {
            //echo"$Password";
            $query->bind_param('s', $username);
            $query->execute();
            //$query->store_result();
            $query->bind_result($id,$name,$email,$username,$password);
             $null="Fatal error: Uncaught Error: mysqli_stmt::bind_result():
              Argument #5 cannot be passed by reference in C:\xampp\htdocs\SECURE LOGIN PAGE\login.php:28 
             Stack trace: #0 {main} thrown in C:\xampp\htdocs\SECURE LOGIN PAGE\login.php on line 28 
             if we add timestamp to database we need to assign like null thats no use is used 
             To bypass error";
            $row=$query->fetch();
            if($row)
            {
                
                if(password_verify($Password,$password))
                {
                  if(!empty($_POST["remember"])) {
                    setcookie ("puser_login",$_POST["username"],time()+ (10 *  24 * 60 * 60));
  //COOKIES for password
  setcookie ("puserpassword",$_POST["Password"],time()+ (10 *  24 * 60 * 60));
  $_SESSION['id']=$id;
  $_SESSION['name']=$name;
  $_SESSION['username']=$username;
  $_SESSION['password']=$password;
  $_SESSION['phonenu']=$phonenu;
  $_SESSION['email']=$email;
  header("Location: user_home.php");
  exit();
  }
  else {
    if(isset($_COOKIE["puser_login"])) {
    setcookie ("puser_login","");
    if(isset($_COOKIE["puserpassword"])) {
    setcookie ("puserpassword","");
            }
          }
          $_SESSION['id']=$id;
          $_SESSION['name']=$name;
          $_SESSION['username']=$username;
          $_SESSION['password']=$password;
          $_SESSION['phonenu']=$phonenu;
          header("Location: user_home.php");
          exit();}}
                else{
                    $error="Password is not valid";
                    echo $error;
                }
            }else{
                $error="No user existed with email";
                echo "$error";
            }
        }$query->close();
    }
    mysqli_close($db);
}

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>User Login</title>
		<link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	</head>
	<body>

  <div class="wrapper">
      <nav>
        <a href="../home.php" class="logo"><img src="data:image/png;base64,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" alt="LOGO" width="60px"><span style="padding-left: 25px;">AMB</span></a>
        <div class="menu" >
          <ul>
            <li><a href="../newusers/user_login.php">User Login</a></li>
            <li><a href="../admin/admin_login.php">Admin Login</a></li>
            <li><a href="../home.php#contact">Help</a></li>
          </ul>
        </div>
      </nav>
    </div>

		<section class="vh-100">
      <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <h2 class="d-flex justify-content-end align-items-end">User Login</h2>
            <img src="../assets/images/draw2.webp"
              class="img-fluid" alt="Sample image">
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form method="post">    
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="username" id="form3Example3" class="form-control form-control-lg"
                  placeholder="Enter a valid username" value="<?php if(isset($_COOKIE["puser_login"])) { echo $_COOKIE["puser_login"]; } ?>" required />
                <label class="form-label" for="form3Example3">Username</label>
              </div>
    
              <!-- Password input -->
              <div class="form-outline mb-3">
                <input type="password" name="Password" id="form3Example4" class="form-control form-control-lg"
                  placeholder="Enter password" value="<?php if(isset($_COOKIE["puserpassword"])) { echo $_COOKIE["puserpassword"]; } ?>" required/>
                <label class="form-label" for="form3Example4">Password</label>
              </div>
    
              <div class="d-flex justify-content-between align-items-center">
                <!-- Checkbox -->
                <div class="form-check mb-0">
                  <input class="form-check-input me-2" type="checkbox" name='remember' <?php if(isset($_COOKIE["puser_login"])) { ?> checked <?php } ?>id="form2Example3" />
                  <label class="form-check-label" for="form2Example3">
                    Remember me
                  </label>
                </div>
                <!--<a href="#!" class="text-body">Forgot password?</a>-->
              </div>
    
              <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" name="submit" class="btn btn-primary btn-lg"
                  style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="./user_register.php"
                    class="link-danger text-decoration-none">Register</a></p>
              </div>
    
            </form>
          </div>
        </div>
      </div>
      <div 
        class="d-flex flex-column flex-md-row text-center text-md-start justify-content-center py-4 px-4 px-xl-5">
        <!-- Copyright -->
        <div class="mb-3 mb-md-0 " style="color:#ccc;"> 
          Copyright © 2023. All rights reserved.
        </div>
        <!-- Copyright -->
      </div>
    </section>









    <style>
      .divider:after,
      .divider:before {
        content: "";
flex: 1;
height: 1px;
background: #eee;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
  .h-custom {
    height: 100%;
  }
}
*,
*::before,
*::after {
margin: 0;
padding: 0;
}
.wrapper {
  width: 100vw;
  margin: 0 auto;
  position: fixed;
  z-index: 999;
}
nav {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
  background-color: hsl(240, 2%, 8%);
  padding: 1rem 1.5rem;
  width: 100%;
}
nav .logo  {
  font-weight: 700;
}
nav ul {
  list-style: none;
  display: flex;
  padding-top: 15px;
  gap: 2rem;
}
nav a {
  text-decoration: none;
  color: white;
}
nav #toggle,
nav label {
  display: none;
}
.menu li{
  font-size: medium;
}
.bottom-right {
  position: absolute;
  bottom: 275px;
  right: 175px;
  color: black;
  font-size: 35px;
}
    </style>
</html>


