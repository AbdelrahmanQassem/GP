<?php
// Check existence of ID parameter before processing further
if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
    // Include config file
$conn = new mysqli("localhost", "root", "", "healthcare");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    
    // Prepare a select statement
    $sql = "SELECT * FROM patients WHERE ID = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_ID);
        
        // Set parameters
        $param_ID = trim($_GET["ID"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve indivIDual field value
                $username = $row["Name"];
				$tempreture = $row["Tempreture"];
				$heartrate = $row["Heart_Rate"];
				$illness = $row["illness"];
				$medicines = $row["Medicines"];
                $Phone = $row["Phone"];
                $Birth_Date = $row["Birth_Date"];
            } else{
                // URL doesn't contain valID ID parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conn);
} else{
    // URL doesn't contain ID parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            wIDth: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluID">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Details</h1>
                    </div>
                    <div class="form-group">
                        <label>Patient Name</label>
                        <p class="form-control-static"><?php echo $row["Name"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Tempreture</label>
                        <p class="form-control-static"><?php echo $row["Tempreture"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Heart Rate</label>
                        <p class="form-control-static"><?php echo $row["Heart_Rate"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Illness</label>
                        <p class="form-control-static"><?php echo $row["illness"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Medicines</label>
                        <p class="form-control-static"><?php echo $row["Medicines"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <p class="form-control-static"><?php echo $row["Phone"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Birth_Date</label>
                        <p class="form-control-static"><?php echo $row["Birth_Date"]; ?></p>
                    </div>
                    <p><a href="crud.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>