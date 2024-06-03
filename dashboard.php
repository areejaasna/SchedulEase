<?php
// define('MYSITE',true);
?>


<?php
session_start();


if(empty($_SESSION['name']))
{
  header('Location:test.php');
}

if(!empty($_SESSION['name']))
{
  $username=$_SESSION['name'];
}

include 'config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>  <!-- indexpage -->
    <!-- custom css -->
    <link rel="stylesheet" href="dashboard.css">

    <!-- Poppins-google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

    <!-- for nav-bar, alignment -->
    <link href="bootM/bootstrap(nav).min.css" rel="stylesheet"/>
    <script src="bootM/jquery.min.js"></script>

    <!-- styling the modal using bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script><link rel="preconnect" href="https://fonts.googleapis.com">
        <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet"> -->
        
        <!-- icon footer styling -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            a{
                
                color:black;
            } 
                a:visited {
                color:black;
                }

                /* mouse over link */
                a:hover {
                color:black;
                }

                /* selected link */
                a:active {
                color:black;
                }
                nav ul li {
                flex: 1;
                text-align:right;
                }

                nav ul li{
                /* display: inline-block; */
                list-style: none;
                margin: 0 15px;
                font-size: 18px;
                }

                nav a{
                    text-decoration: none;
                    color: #fff;
                }
        </style>
</head>
<body>

    
    <div class="feature-sec">

<nav> 

<div class="collapse navbar-collapse" id="menu">
    <ul class="navbar-nav">
        <li class="nav-item ">
        <span>SchedulEase</span>
        </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
         
         <li><a href="test.php" class="color-me" align="right">Logout</a></li>
    </ul>
  </div>
</nav>
<!--NAVBAR SECTION END-->
    <!-- <nav>
            <span>SchedulEase</span>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="test.php" class="" align="right">Logout</a></li>
            </ul>
    </nav> -->
        <h1 id="f">Dashboard</h1>
        <div class="card">
            <div class="card-items">
                 <img class="resize" src="aimg/dept.png"/>
                 <h3><a  style="text-decoration:none" href="adddept.php">Department</a></h3>
                 
                 <p></p>
             </div>
             <div class="card-items">
                 <img class="resize" src="aimg/teach.png"/>
                 <h3><a  style="text-decoration:none" href="addteacher.php">Teacher</a></h3>
                 <p></p>
             </div>
             <div class="card-items">
                 <img class="resize" src="aimg/book.png"/>
                 <h3><a  style="text-decoration:none" href="addsubject.php">Paper</a></h3>
                 <p></p>
             </div>    
             <div class="card-items">
                 <img class="resize" src="aimg/allot.png"/>
                 <h3><a  style="text-decoration:none"  href="allotSub.php">Allotment</a></h3>
                 <p></p>
             </div> 
             <div class="card-items">
                 <img class="resize" src="aimg/g.png"/>
                 <h3><a  style="text-decoration:none" href="generatetimetable.php">Generate Timetable</a></h3>
                 <p></p>
             </div>                                                       
        </div> <!--card div close tag -->

     </div> <!--feature-sec div close tag -->
    

</body>
</html>