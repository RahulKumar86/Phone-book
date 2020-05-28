
<!DOCTYPE HTML>  
<html>
<head>
<title>Insertion</title>
<link rel="stylesheet" href="bootstrap.min.css">

		<script src="bootstrap.min.js"></script>
<style>
.error {color: #FF0000;}

body{
			background-color:black;
			text:white;
			color:whitesmoke;
		}
			th,td,table{
				border:3px double lightgrey;
				padding:2px;
				
			}
      .containerr {
  position: relative;
  width: 100%;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.containerr:hover .image {
  opacity: 0.3;
}

.containerr:hover .middle {
  opacity: 1;
}

.textt {
  background-color: #4CAF50;
  color: white;
  font-size: 16px;
  padding: 16px 32px;
}

</style>
</head>
<body>  

<?php

$con=new mysqli('localhost','root','','larave');

$nameErr = $emailErr = $dobErr = $contactErr = "";
$name = $email = $contact = $dob = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["contact"])) {
    $contact = "";
  } else {
    $contact = test_input($_POST["contact"]);
    
  }

  

  if (empty($_POST["dob"])) {
    $dob = "00";
  } else {
    $dob = test_input($_POST["dob"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<div class="container">
		<div class="row">
		<div class="col-md-1">
		<h3 align="center"><b>Quick Links</b></h3>
     <a href="displayp.php">
     <div class="containerr">
	 <img src="pr1.jpg" class="img-fluid rounded-circle image">
	 <div class="middle">
     <div class="text">Home Page</div>
     </div>
     </div></a>
	 <br>
	<a href="insertp.php">
	 <div class="containerr">
	 <img src="pr2.jpg" class="img-fluid rounded-circle image">
	 <div class="middle">
     <div class="text">Insert Data</div>
     </div>
     </div></a>
	 <br>
 
		
	</div>
  <div class="col-md-11">
  <div class="jumbotron jumbotron-fluid text-primary">
 <h1 align="center"><b>INSERTION</b> </h1><br>
 
 
</div>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<legend>
<fieldset>INSERTION
<table>
<tr>
  <th>Name:</th> <th><input type="text" name="name" value="<?php echo $name;?>"></th>
  <td><span class="error">* <?php echo $nameErr;?></span></td>
  </tr>
  <tr>
  <th>
  DOB:</th> <th><input type="date" name="dob" value="<?php echo $dob;?>"></th>
  <td><span class="error">*<?php echo $dobErr;?> </span></td>
  </tr>
  <tr>
  <th>
  Email:</th> <th><input type="text" name="email" value="<?php echo $email;?>"></th>
  <td><span class="error">* <?php echo $emailErr;?></span></td>
  </tr>
  <tr>
  <th>
  Mobile:</th> <th><input type="number" name="contact" value="<?php echo $contact;?>"></th>
 <td> <span class="error">*<?php echo $contactErr;?></span></td>
  </tr>
  <tr>
  
  <td>
  <input type="submit" name="submit" value="Submit">  </td>
  </tr>
  </table>
  </fieldset>
  </legend>
</form>

<hr>
<b><mark>STATUS:</mark></b><br>
<?php





if($con->connect_error)
{
    echo "not connected to server";
}
$sql="INSERT INTO project 
        VALUES ('$name','$dob','$contact','$email')";
if($con->query($sql)===TRUE)
{
    echo "[Inserted]";
}
else {
    echo "[Not Inserted]";
}

$con->close();


?>
<hr>
</div>
</div>
</div>


</body>
</html>
