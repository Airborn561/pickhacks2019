<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        #leftaligned {text-align:left; color:#55bbff;}
        #rightaligned {text-align:right}
        .page-header {padding: 20px 0 0 0}
        #left{outline: 20px;
        height: 600px; /* Should be removed. Only for demonstration */
        padding: 20px 100px 0px 0;
        margin: -30px 0px 00px 0;
        text-align: left}
        #right {outline: 20px;
        height: 600px; /* Should be removed. Only for demonstration */
        margin: -30px 0 0 0;
        padding: 0px 0 0 0px;
        }
            .innercontent {
                margin: 0 0px 0px 50px
            }
        .postbutton a{
            background: #55bbff;
            color: #fff;
        }
        .postbutton a:hover
        {
            background: #65cbff;
            text: #fff;  
            text-decoration: none;

        }
        .changebutton a{
            background: #b0b0b0;
            color: #fff;
        }
        .changebutton a:hover
        {
            background: #C0C0C0;
            text: #fff;  
            text-decoration: none;

        }
        #righttext
        {
            text-align:right;
        }
        .leftmost
        {
            text-align:left;
        }
        .rightmost
        {
            text-align:right;
        }
        .stats
        {
            padding: 0 5px 0 5px;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
        <div class="row">
            <div class="col col-xl" id="leftaligned">
            
                 <h1><b>WalkToMe</b></h1>
            </div>
            <div class="col" id="rightaligned">
            <p>
                <a href="logout.php">Log out</a>
            </p>
            </div>
        
    </div>
    <hr>    
    <br>
    <div class="container">
        <div class="row">
            <div class="col" id="left" style="background-color:#fafafa">
                <div class="innercontent">
                    <h3>Welcome back, <?php echo htmlspecialchars($_SESSION["username"]); ?>.</h3>
                    <br>
                    <p>You have traveled <b><?php echo ($_SESSION["week_ran"] + $_SESSION["week_walk"]); ?></b> miles of your weekly <b><?php echo $_SESSION["goal"] ?></b> mile goal this week. </p>
                    <div class="progress">
                    <?php $val = ((($_SESSION["week_ran"] + $_SESSION["week_walk"]) / ($_SESSION["goal"] + 1))*100); ?>
                    <?php    echo "<div class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"$val\"
                        aria-valuemin=\"0\" aria-valuemax=\"10\" style=\"width:$val% \" >" ; ?>
                           <?php echo round( ($_SESSION["week_ran"] + $_SESSION["week_walk"]) / ($_SESSION["goal"] + 1)*100); ?>%
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3" id="right" style="background-color:#F4F4F4">
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <a href="update.php">Post Run</a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <a href="changegoal.php">Change Goal</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <p>So far you have...</p>
                        </div>
                    </div>
                    <div class="row stats">
                        <div class="col leftmost">
                            <p>Total Disance</p>
                        </div>
                        <div class="col rightmost">
                            <p><?php echo ($_SESSION["total_walk"]+$_SESSION["total_ran"]); ?> Miles</p>
                        </div>
                    </div>
                    <div class="row stats">
                        <div class="col leftmost">
                            <p>Disance Walked</p>
                        </div>
                        <div class="col rightmost">
                            <p><?php echo htmlspecialchars($_SESSION["total_walk"]); ?> Miles</p>
                        </div>
                    </div>
                    <div class="row stats">
                        <div class="col leftmost">
                            <p>Distance Ran </p>
                        </div>
                        <div class="col rightmost">
                            <p><?php echo   htmlspecialchars($_SESSION["total_ran"]); ?> Miles</p>
                        </div>
                    </div>
                </div>
            <hr>
            </div>

        </div>
        <div class="row">
            <div class="col" style="background-color:#BFBFBF; height:100px"></div>
        </div>
    </div>  
</body>
</html>