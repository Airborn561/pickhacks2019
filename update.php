<?php
// Include config file
require_once "config.php";
session_start();

// Define variables and initialize with empty values
$walked = $ran = 0;
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
// Prepare a select statement
        $sql = "UPDATE users SET week_ran = ?, week_walk = ? WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            $newwalk = $_POST["walked"] + $_SESSION["week_walk"];
            $newran = $_POST["ran"] + $_SESSION["week_ran"];
            mysqli_stmt_bind_param($stmt, "iis", $newran, $newwalk, $_SESSION["username"]);

            
            $newwalk = $_POST["walked"] + $_SESSION["week_walk"];
            $newran = $_POST["ran"]  + $_SESSION["week_ran"];

            $_SESSION["week_walk"] = $_POST["walked"] + $_SESSION["week_walk"];
            $_SESSION["week_ran"] = $_POST["ran"] + $_SESSION["week_ran"];
            
            
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
        <h2>Add run time!</h2>
        <p>Fill out how much you ran or walk today!</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Miles Walked</label>
                <input type="number" name="walked" class="form-control" value=<?php echo $walked; ?>>
            </div>    
            <div class="form-group">
                <label>Miles Ran</label>
                <input type="number" name="ran" class="form-control" value=<?php echo $ran; ?>>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>    
    
</body>
</html>