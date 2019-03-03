<?php
// Include config file
require_once "config.php";
session_start();

// Define variables and initialize with empty values
$goal = $_SESSION["goal"];
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
// Prepare a select statement
        $sql = "UPDATE users SET goal = ? WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            $newgoal = $_POST["newgoal"];
            mysqli_stmt_bind_param($stmt, "is", $newgoal, $_SESSION["username"]);


            $_SESSION["goal"] = $_POST["newgoal"];
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */

                mysqli_stmt_store_result($stmt);
                header("location: welcome.php");
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
        
    mysqli_close($link);
    }

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Change Goal</h2>
        <p>Set your new weekly goal!</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>New Goal</label>
                <input type="number" name="newgoal" class="form-control" value=<?php echo $goal; ?>>
            </div>   
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>    
    
</body>
</html>