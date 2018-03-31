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
    $user=$_POST['username'];  
	$pass =$_POST['password'] ;
	$fname=$_POST['fname'];	
	$lname=$_POST['lname'];
	$phone=$_POST['phone'];
	$type=$_POST['type'];
	$birth=$_POST['date'];
	$date=date_create($birth);
	
	//echo $birth;
	//echo $time;
	//$newformat = date('Y-m-d',$time);
	// Create connection
$conn = new mysqli("localhost", "root", "", "healthcare");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//check if the username exists already in the database
	 $sql =$conn->prepare("SELECT * FROM `Users` WHERE username =? ");
	 $sql->bind_param("s",$user);
	 $sql->execute();
	 $sql->store_result();
	 if ($sql->num_rows == 0 && !empty($pass)) {
                          
		 //set session
	//	session_start();
		// $_SESSION[`newname`] = $newuser;
			//store the new username and password in the database
			$sqli = $conn->prepare("INSERT INTO `users` ( First_name,Last_name,username,Password,phone,Birth_date,type) VALUES ( ?,?,?,?,?,?,?)");
			$sqli->bind_param("ssssiss",$fname,$lname,$user,$pass,$phone,$birth,$type);
			$sqli->execute();
			echo " Successful Sign up " ;
	 }
	 else{
		 
		 echo "This username exict Try another " ;
		 
	 }
/*$sql = "SELECT patientname,password FROM patientinf";
$result = $conn->query($sql);

if ($result->num_rows > 0) { $f=0;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if( $user==$row["patientname"] && $pass==$row["password"]){
        	echo "This username exict Try another " ;
        	echo " <a href='http://localhost/healthcare/signup.php'>try sign up again</a>";
        	$f=1;}
    }}
else {
    echo "0 results";
}
*/
$conn->close();
 		/*if($f==0){
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "healthcare";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			$sql = "INSERT INTO patientinf(doctor,patientname,password,temp,heartrate) 
			VALUES ('mnnh', '$user', $pass,37,78);";
			if ($conn->multi_query($sql) === TRUE) {
			    echo "New records created successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();}*/


?>
    </div>
     <div class="footer">
       Copyright &copy; 2018 all Right Reserved To EECE-CUFE healthcare project team
    </div> 
</body>
</HTML>
