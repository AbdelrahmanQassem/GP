<!DOCTYPE html>
<HTML lang="en">
<HEAD>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> healthcare </title>
    <link rel='stylesheet' href='css/style.css' />
</HEAD>
<body background="img.png" >
    <div class="header">
        your Doctor
    </div> 
    <div class="navigation">
      <ul>
        <li>our products</li>
        <li>How to use it</li>
        <li>about us</li>
        <li>help</li>
      </ul>
    </div>
    <div class="content">
    <?php
	$user=($_POST['username']);  
	$pass =($_POST['password']) ; 
	session_start();
	$_SESSION[`name`]=$user;
	// Create connection
$conn = new mysqli("localhost", "root", "", "healthcare");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$statement = $conn->prepare ("SELECT * FROM `users` WHERE (username =? AND Password =?);");
if($statement)
{$statement->bind_param("ss",$user,$pass);
$statement->execute();
$statement->store_result();
if ($statement->num_rows > 0) {
                          //set session
						// session_start();
						//  $_SESSION[`name`] = $user;
                        // header('Location: ./first.php');
                        // exit;
						echo "login success !!!!! Welcome $user";


   } else {
               // login failed save error to a session
               //$_SESSION['error'] = 'Sorry, wrong username or password';
			   echo 'Error logged in, The username or the password is not correct, Try agian please';
  }

}

/*$sql = "SELECT patientname,password FROM patientinf";
$result = $conn->query($sql);

if ($result->num_rows > 0) { $f=0;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if( $user==$row["patientname"] && $pass==$row["password"]){
        	echo "wellcome: ".$row["patientname"]." يا خول يا ";
        	$f=1;}
       }
   if($f==0){echo "Incorrect username and password "."<br>"."try to sign again or sign up if you are not signed ";
}
} else {
    echo "0 results";
}*/
$conn->close();
?>    <br>
	<a href="crud.php">your patients</a>
    </div>
	
     <div class="footer">
       Copyright &copy; 2018 all Right Reserved To EECE-CUFE healthcare project team
    </div> 
</body>
</HTML>