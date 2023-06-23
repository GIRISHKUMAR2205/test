<?php
require_once "../config.php";
//require_once "session.php";
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])){
    $name= trim($_POST['name']);
    $Email=trim($_POST['Email']);
    //$phonenu=trim($_POST['phonenu']);
    //$address=trim($_POST['address']);
    $username=trim($_POST['username']);
    $Password=trim($_POST['Password']);
    $Cnfm_Password=trim($_POST["Cnfm_Password"]);
    $password_hash=password_hash($Password,PASSWORD_BCRYPT);
    if($query=$db->prepare("SELECT * FROM newusers WHERE Email=?")){
        $error='';
    $query->bind_param('s',$Email);
    $query->execute();
    $query->store_result();
        if($query->num_rows>0){
            $error='<p class="error">The email address is already registered!</p>';
            echo "$error";
        }else{
            // Validate password
            if(strlen($Password)<6){
                $error='<p class="error">Password must have at least6characters.</p>';
                echo "$error";
           }
        }
    }
           // Validate confirm password
           if(empty($Cnfm_Password)){
               $error='<pclass="error">Please enter confirm password.</p>';
               echo "$error";
           }else{
               if(empty($error)&&($Password!=$Cnfm_Password)){
                   $error='<pclass="error">Password did not match.</p>';
                   echo "$error";
               }
           }
           if(empty($error)){
               $insertQuery=$db->prepare("INSERT INTO newusers (name,Email,username,Password) VALUES( ?,?,?,?);");
               $insertQuery->bind_param("ssss",$name,$Email,$username,$password_hash);
               $result=$insertQuery->execute();
               if($result){
                   $success='
                   <script>if($result)
                   {   
    $(document).ready(function(){
        $("#myModal").modal("show");
    });}</script>
                   <!-- Modal -->
                   <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h1 class="modal-title fs-5" id="exampleModalLabel">Success</h1>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                           Successfully registered
                         </div>
                       </div>
                     </div>
                   </div>';
                   echo "$success";
               }else{
                   $error='<pclass="error">Something went wrong!</p>';
                   echo "$error";
               }
            }
    $query->close();
    $insertQuery->close();
    // Close DB connection
    mysqli_close($db);
            }
            ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>User Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    $(document).ready(function(){
        $("#myModal").modal("show");
    });</script>
	</head>
	<body>
  <div class="wrapper" >
      <nav>
        <a href="../home.php" class="logo"><img src="data:image/png;base64,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" alt="LOGO" width="60px"><span style="padding-left: 25px;">AMB</span></a>
        <div class="menu" >
          <ul>
            <li><a href="../newusers/user_login.php">User Login</a></li>
            <li><a href="../admin/admin_login.php">Admin Login</a></li>
            <li><a href="../home.php#contact" style="padding-right: 35px;">Help</a></li>
          </ul>
        </div>
      </nav>
    </div>
    <section class="vh-100" style="background-color: #eee;">
  <div style="padding-top: 65px;" class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-2">

                <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4 mt-2">User Registration</p>

                <form method="post" class="mx-1 mx-md-4">

                  <div class="d-flex flex-row align-items-center mb-2">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="name" type="text" id="form3Example1c" class="form-control" required/>
                      <label class="form-label" for="form3Example1c">Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-2">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="Email" type="email" id="form3Example3c" class="form-control" required/>
                      <label class="form-label" for="form3Example3c">Email</label>
                    </div>
                  </div>
                  
                  <div class="d-flex flex-row align-items-center mb-2">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="phonenu" type="text" id="form3Example3c" class="form-control" required />
                      <label class="form-label" for="form3Example3c">Phone Number</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-2">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="username" type="text" id="form3Example3c" class="form-control" required />
                      <label class="form-label" for="form3Example3c">Username</label>
                    </div>
                  </div>
                  
                  <div class="d-flex flex-row align-items-center mb-2">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="Password" type="password" id="form3Example4c" class="form-control" required/>
                      <label class="form-label" for="form3Example4c">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-2">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="Cnfm_Password" type="password" id="form3Example4cd" class="form-control" required/>
                      <label class="form-label" for="form3Example4cd">Confirm password</label>
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>
                  <div style="display:grid;place-items:center;">
                    <span>
                      <b>Already have an account? </b><a href="./user_login.php" class="link-danger text-decoration-none"><b>Login</b></a><br>
                    </span>
                  </div>
                  </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="../assets/images/draw1.webp"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
	</body>
  <style>
    *,
*::before,
*::after {
  margin: 0;
  padding: 0;
}
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