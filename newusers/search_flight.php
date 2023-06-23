<?php
include('../config.php');
session_start();
$start='';
$stop='';
$date='';
$date1='';
$total='';
$adults='';
$childs='';
$infants='';
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])){
     $start=trim($_POST['start']);
     $stop=trim($_POST['stop']);
     $adults=trim($_POST['adults']);
     $infants=trim($_POST['infants']);
     $childs=trim($_POST['childs']);
     $date=trim($_POST['date']);
     if(isset($_POST['date1'])){
     $date1=trim($_POST['date1']);}

     $total=trim($_POST['adults'])+trim($_POST['childs'])+trim($_POST['infants']);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Flight</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script>
      document.getElementById('xa').hidden = true;
      </script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>


<body>
<script>
      function change(){
        
    var drop1 = document.getElementById("startz");
    var drop2 = document.getElementById("stopz");
    var tempHTML = drop1.innerHTML;

    drop1.innerHTML = drop2.innerHTML;
    drop2.innerHTML = tempHTML;

      };
    </script>
<div class="wrapper">
      <nav>
        <a href="./user_home.php" class="logo"><img src="data:image/png;base64,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" alt="LOGO" width="60px"><span style="padding-left: 25px;">AMB</span></a>
        <input type="checkbox" name="" id="toggle">
        <label for="toggle"><i class="material-icons">menu</i></label>
        <div class="menu" >
          <ul>
            <li><a href="./search_flight.php">Search Flight</a></li>
            <li><a href="./mytickets.php">View Tickets</a></li>
            <li><div class="dropdown">
  <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Profile
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="./changepassword.php">Change Password</a></li>
    <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
  </ul>
</div></li>
          </ul>
        </div>
      </nav>
    </div>

    <div style="padding-top:8%;padding-left:6px;">
<h2>Search Flights</h2><br>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" onclick="bloc()" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
  <label class="form-check-label" for="inlineRadio1">Oneway</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" onclick="chec()" name="inlineRadioOptions" id="inlineRadio2" value="option2">
  <label class="form-check-label" for="inlineRadio2">Roundtrip</label>
</div><br><br><br>
<?php

	// Connect to database
	
	
	// mysqli_connect("servername","username","password","database_name")

	// Get all the categories from category table
	$sql = "SELECT DISTINCT start FROM `flights`";
	$sql1 = "SELECT DISTINCT stop FROM `flights`";
	$sql2 = "SELECT date FROM `flights`";
	// $sql = "SELECT DISTINCT date FROM `flights`";
	$all_categories = mysqli_query($db,$sql);
	$all_categories1 = mysqli_query($db,$sql1);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport"
		content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="col-md-8 col-lg-6 col-xl-4 offset-xl-4">
	<form method="POST" class="row g-3">
		<select name="start" id="startz" class="form-select">
			<?php
				while ($category = mysqli_fetch_array(
						$all_categories,MYSQLI_ASSOC)):;
			?>
				<option value="<?php echo $category["start"];
				?> " selected>
					<?php echo $category["start"];
					?>
				</option>
			<?php
				endwhile;
			?>
		</select><button type="button" onclick="change()" style="border-radius: 50%;border-width:0;background-color:white;align-items:center;"><i class="fa fa-exchange"></i></button>
		
    <select name="stop" id="stopz" class="form-select">
			<?php
				while ($category = mysqli_fetch_array(
						$all_categories1,MYSQLI_ASSOC)):;
			?>
				<option value="<?php echo $category["stop"];
				?>" selected>
					<?php echo $category["stop"];
					?>
				</option>
			<?php
				endwhile;
			?>
		</select>
    <br>
    From Date : <input id="date_picker" name="date" class="form-control" type="date" required>
    <script>
      function chec(){
        var x=document.getElementById("date_picker1");
        x.removeAttribute('disabled');
      }
      function bloc(){
        var x=document.getElementById("date_picker1");
        x.setAttribute('disabled','');
      }
      </script>
      Return Date : <input id="date_picker1"  name="date1" class="form-control" type="date" disabled >
    Adults : <input id="adults" name="adults" class="form-control" type="number" required>
    Child : <input id="childs" name="childs" class="form-control" type="number" required>
    Infants : <input id="infants" name="infants" class="form-control" type="number" required><br>
		<input type="submit" value="search" name="submit">
  </div>
	</form>

	<br>
  <table class="table" style="padding-bottom: 50px;" >
<tr align="center">
    <th>Flight Name</th>
    <th>Start</th>
    <th>Stop</th>
    <th>Departure</th>
    <th>Arrival</th>
    <th>Date</th>
    <th>Seats</th>
    <th>Price</th>
    <th>BOOK</th>
</tr>
<?php
$sql="select * from flights where start='$start' and date='$date' and stop='$stop' and seats>='$total';";
$res=mysqli_query($db,$sql);
while($row = mysqli_fetch_array($res))
{
?>
    
    <tr align="center">
        <td> <?php echo $row['flightname']; ?></td>
        <td> <?php echo $row["start"]; ?></td>
        <td> <?php echo $row["stop"] ?></td>
        <td> <?php echo $row["departure"]  ?></td>
        <td> <?php echo $row["arrival"]; ?></td>
        <td> <?php echo $row['date']; ?></td>
        <td> <?php echo $row['seats']; ?></td>
        <td> <?php echo $row['fare']; ?></td>
        <td>
            <a href="book_flight.php?flightname=<?php echo $row['flightname']?>&adults=<?php echo $adults?>&childs=<?php echo $childs?>&infants=<?php echo $infants?>" class="btn btn-warning" >BOOK NOW</i></a>
        </div></td>
    </tr>

    
 <?php   
}
if(isset($_POST['date1'])){
?>
</table>
<h3 style="text-align: center;">RETURN FLIGHTS</h3>
  <table class="table" style="padding-bottom: 50px;">
<tr align="center">
    <th>Flight Name</th>
    <th>Start</th>
    <th>Stop</th>
    <th>Departure</th>
    <th>Arrival</th>
    <th>Date</th>
    <th>Seats</th>
    <th>Price</th>
    <th>BOOK</th>
</tr>
<?php
$sql="select * from flights where start='$stop' and date='$date' and stop='$start' and seats>='$total';";
$res=mysqli_query($db,$sql);
while($row = mysqli_fetch_array($res))
{
?>
    
    <tr align="center">
        <td> <?php echo $row['flightname']; ?></td>
        <td> <?php echo $row["start"]; ?></td>
        <td> <?php echo $row["stop"] ?></td>
        <td> <?php echo $row["departure"]  ?></td>
        <td> <?php echo $row["arrival"]; ?></td>
        <td> <?php echo $row['date']; ?></td>
        <td> <?php echo $row['seats']; ?></td>
        <td> <?php echo $row['fare']; ?></td>
        <td>
            <a href="book_flight.php?flightname=<?php echo $row['flightname']?>&adults=<?php echo $adults?>&childs=<?php echo $childs?>&infants=<?php echo $infants?>" class="btn btn-warning" >BOOK NOW</i></a>
        </div></td>
    </tr>

    
 <?php   
}}
?>

</table>
</body>
    <style>
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



<script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#date_picker').attr('min',today);
        $('#date_picker1').attr('min',today);
        var today = new Date();
        var dd = String(today.getDate()+1).padStart(2, '0');
        var mm = String(today.getMonth() + 2).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#date_picker').attr('max',today);
        $('#date_picker1').attr('max',today);
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

    </script>
    
</body>
</html>
