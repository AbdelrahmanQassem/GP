
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            wIDth: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluID">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Patients Details</h2>
                        <a href="create.php" class="btn btn-success pull-right">Add New Patient</a>
                    </div>
                    <?php
					session_start();
					$DOCTOR=$_SESSION[`name`];
                    // Include config file
                    //require_once 'config.php';
                    $conn = new mysqli("localhost", "root", "", "healthcare");
					// Check connection
				if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
											}
                    // Attempt select query execution
                    $sql = "SELECT * FROM patients where Doctor='$DOCTOR'";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
										echo "<th>Tempreture</th>";
										echo "<th>HeartRate</th>";
										echo "<th>Illness</th>";
                                        echo "<th>Medicines</th>";
                                        echo "<th>Phone</th>";
										echo "<th>Birth_Date</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['ID'] . "</td>";
                                        echo "<td>" . $row['Name'] . "</td>";
										echo "<td>" . $row['Tempreture'] . "</td>";
										echo "<td>" . $row['Heart_Rate'] . "</td>";
										echo "<td>" . $row['illness'] . "</td>";
										echo "<td>" . $row['Medicines'] . "</td>";
                                        echo "<td>" . $row['Phone'] . "</td>";
                                        echo "<td>" . $row['Birth_Date'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?ID=". $row['ID'] ."' title='View Patient Details' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?ID=". $row['ID'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?ID=". $row['ID'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                    }
 
                    // Close connection
                    mysqli_close($conn);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>