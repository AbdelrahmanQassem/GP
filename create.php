<?php
session_start();
// Include config file
//require_once 'config.php';
 $conn = new mysqli("localhost", "root", "", "healthcare");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
/* echo "<th>Name</th>";
										echo "<th>Tempreture</th>";
										echo "<th>HeartRate</th>";
										echo "<th>Illness</th>";
                                        echo "<th>Medicines</th>";
                                        echo "<th>Phone</th>";
										echo "<th>Birth_Date</th>";*/
// Define variables and initialize with empty values
$username = $tempreture = $heartrate = $illness = $medicines =$phone = $Birth_Date = "";
$username_err = $tempreture_err = $heartrate_err = $illness_err = $medicines_err = $phone_err = $Birth_Date_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    $input_username = trim($_POST["username"]);
    if(empty($input_username)){
        $username_err = "Please enter a username.";
    } elseif(!filter_var(trim($_POST["username"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $username_err = 'Please enter a valid username.';
    } else{
        $username = $input_username;
    }
	  // Validate tempreture
    $input_tempreture = trim($_POST["tempreture"]);
    if(empty($input_tempreture)){
        $tempreture_err = 'Please enter a tempreture.';     
    } else{
        $tempreture = $input_tempreture;
    }
	  // Validate heartrate
    $input_heartrate = trim($_POST["heartrate"]);
    if(empty($input_heartrate)){
        $heartrate_err = 'Please enter an heartrate.';     
    } else{
        $heartrate = $input_heartrate;
    }
      // Validate illness
    $input_illness = trim($_POST["illness"]);
    if(empty($input_illness)){
        $illness_err = 'Please enter an illness.';     
    } else{
        $illness = $input_illness;
    }
	  // Validate medicines
    $input_medicines = trim($_POST["medicines"]);
    if(empty($input_medicines)){
        $medicines_err = 'Please enter a medicine.';     
    } else{
        $medicines = $input_medicines;
    }
    // Validate phone
    $input_phone = trim($_POST["phone"]);
    if(empty($input_phone)){
        $phone_err = 'Please enter an phone.';     
    } else{
        $phone = $input_phone;
    }
    
    // Validate Birth_Date
    $input_Birth_Date = trim($_POST["Birth_Date"]);
    if(empty($input_Birth_Date)){
        $Birth_Date_err = "Please enter the Birth_Date amount.";     
    } //elseif(!ctype_digit($input_Birth_Date)){
       // $Birth_Date_err = 'Please enter a positive integer value.';
     else{
        $Birth_Date = $input_Birth_Date;
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($tempreture_err) && empty($heartrate_err) && empty($illness_err) && empty($medicines_err) && empty($phone_err) && empty($Birth_Date_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO patients (Name, Tempreture ,Heart_Rate ,illness, Medicines, phone, Birth_Date, Doctor) VALUES (?, ?, ?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "siississ", $param_username, $param_tempreture, $param_heartrate, $param_illness, $param_medicines, $param_phone, $param_Birth_Date, $param_doctor);
            
            // Set parameters
            $param_username = $username;
			$param_tempreture = $tempreture;
			$param_heartrate = $heartrate;
			$param_illness = $illness;
			$param_medicines = $medicines;
            $param_phone = $phone;
            $param_Birth_Date = $Birth_Date;
			$param_doctor = $_SESSION[`name`];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: crud.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
       // mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add Patient record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label>Patient Name</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($tempreture_err)) ? 'has-error' : ''; ?>">
                            <label>tempreture</label>
                            <input type="text" name="tempreture" class="form-control" value="<?php echo $tempreture; ?>">
                            <span class="help-block"><?php echo $tempreture_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label>Heartrate</label>
                            <input type="text" name="heartrate" class="form-control" value="<?php echo $heartrate; ?>">
                            <span class="help-block"><?php echo $heartrate_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($illness_err)) ? 'has-error' : ''; ?>">
                            <label>Illness</label>
                            <input type="text" name="illness" class="form-control" value="<?php echo $illness; ?>">
                            <span class="help-block"><?php echo $illness_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label>Medicines</label>
                            <input type="text" name="medicines" class="form-control" value="<?php echo $medicines; ?>">
                            <span class="help-block"><?php echo $medicines_err;?></span>
                        </div>
					
                        <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
                            <span class="help-block"><?php echo $phone_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Birth_Date_err)) ? 'has-error' : ''; ?>">
                            <label>Birth_Date</label>
                            <input type="text" name="Birth_Date" class="form-control" value="<?php echo $Birth_Date; ?>">
                            <span class="help-block"><?php echo $Birth_Date_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="crud.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>