<?php
// define('MYSITE',true);
?>


<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>  <!-- indexpage -->
    <!-- custom css -->
    <link rel="stylesheet" href="test.css">

    <!-- Poppins-google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

    <!-- styling the modal using bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script><link rel="preconnect" href="https://fonts.googleapis.com">
        <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet"> -->
        
        <!-- icon footer styling -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<!-- <div class="area" > -->
    
    <div class="context">
        <nav>
            <!-- <img src="img/logo.png" class="logo"> -->
            <span>SchedulEase</span>
            <ul>
                <li><a style="text-decoration:none"  href="">Home</a></li>
                <li><a style="text-decoration:none"  href="#f">Features</a></li>
                <li><a style="text-decoration:none"  href="#a">About</a></li> 
            </ul>
        </nav>

        <div class="row">
            <div class="col-1">
                <img src="img/My project.png" class="">
            </div>
            <div class="col-2">
                <h1 class="word"><span>Time Table</span><br>Management System</h1>
                <p>An Semi-automated timetable Management System helps users create 
                    and manage schedules for their courses routine. By using an automated 
                    timetable, colleges can improve their operational efficiency, reduce 
                    scheduling conflicts, and ensure that students have access to the courses 
                    they need.</p>
                    <!-- <a href="" class="btn">Admin</a> <a href="" class="btn">Teacher</a> -->

                    <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-default btn-lg" id="myBtn">ADMIN</button>
                <button type="button" class="btn btn-default btn-lg" id="myBtn2">TEACHER</button>
        
        
                    <!-- Modal -->
                    <div class="modal fade" id="myModal1" role="dialog">
                    <div class="modal-dialog">
                    
                        <!-- Modal content-->
                        <div class="modal-content">
                                <!-- modal header -->
                                <div class="modal-header" style="padding:35px 50px;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
                                </div>
                                
                                <?php
                                    if(isset($_SESSION['status']) && $_SESSION['status']!='')
                                    {
                                        echo '<center><h2 style="color: red;"> '.$_SESSION['status'].'</h2></center>';
                                        unset($_SESSION['status']);
                                    }
                                    
                                ?> 

                        <!-- modal body -->
                        <div class="modal-body" style="padding:40px 50px;">
                            <form action="adminFormValidation.php" method="POST" role="form">
                            <div class="form-group">
                                <label for="adminname"><span class="glyphicon glyphicon-user"></span> Username</label>
                                <input type="text" class="form-control" id="adminname" name="aname" placeholder="Enter username">
                            </div>
                            <div class="form-group">
                                <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                                <input type="password" class="form-control" id="psw" placeholder="Enter password" name="password">
                            </div>
                            <!-- <div class="checkbox">
                                <label><input type="checkbox" value="" checked>Remember me</label>
                            </div> -->
                            <div align="right">
                                <button type="submit" class="btn btn-default" name="login"><span class="glyphicon glyphicon-off"></span> Login</button>
                            </div>
                                
                            </form>
                        </div>
           
                        </div>  <!-- content's modal close -->
            
                    </div>    <!--modal dialouge -->
                    </div>  <!-- main modal div closing -->

                    <!-- TEACHER MODAL -->

                    <!-- Modal -->
                    <div class="modal fade" id="myModal2" role="dialog">
                    <div class="modal-dialog">
                    
                        <!-- Modal content-->
                        <div class="modal-content">
                                <!-- modal header -->
                                <div class="modal-header" style="padding:35px 50px;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
                                </div>
                                
                                <?php
                                    if(isset($_SESSION['status1']) && $_SESSION['status1']!='')
                                    {
                                        echo '<center><h2 style="color: red;"> '.$_SESSION['status1'].'</h2></center>';
                                        unset($_SESSION['status1']);
                                    }
                                    
                                ?> 

                        <!-- modal body -->
                        <div class="modal-body" style="padding:40px 50px;">
                            <form action="teacherValidation.php" method="POST" role="form">
                            <div class="form-group">
                                <label for="tname"><span class="glyphicon glyphicon-user"></span>Faculty No.</label>
                                <input type="text" class="form-control" id="tname" name="FN" placeholder="Enter your Teacher ID">
                            </div>
                            <div align="right">
                                <button type="submit" class="btn btn-default" name="login1"><span class="glyphicon glyphicon-off"></span> Login</button>
                            </div>
                                
                            </form>
                        </div>
           
                        </div>  <!-- content's modal close -->
            
                    </div>    <!--modal dialouge -->
                    </div>  <!-- main modal div closing -->
    
            </div>   <!--div-col -->
        </div>   <!--div-row -->
    </div>    <!--div-context -->
<!-- <div>   div-area   -->


    <!-- 2nd section for displaying functionality through card -->
    <!-- flexbox -->
    
    <div class="feature-sec">
        <h1 id="f">Feature</h1>
        <div class="card">
            <div class="card-items">
                 <img class="resize" src="aimg/g.png"/>
                 <h3>Generate Schedule</h3>
                 <p>The system use the input data to generate a schedule 
                    for each day of the week, indicating which subject will be 
                    taught during each period, and which teacher will teach each 
                    subject.</p>
             </div>
             <div class="card-items">
                 <img class="resize" src="aimg/d.png"/>
                 <h3>Display Schedule</h3>
                 <p>The system display the final schedule in a user-friendly 
                    format, such as a table, indicating the subjects, 
                    teachers, and periods for each day of the week.</p>
             </div>
             <div class="card-items">
                 <img class="resize" src="aimg/e.png"/>
                 <h3>Export Schedule</h3>
                 <p>The system allow for the schedule to be exported in 
                    different formats, such as PDF or Excel, to be shared with 
                    teachers and students.</p>
             </div>                                                               
        </div>

    </div>
    
    
    <!-- FOOTER -->
    <footer>
        <div class="footer-content">
            <h3 id="a">SchedulEase</h3>
            <p>Overall, this is an automated time table generator system with a combination 
                of input data, optimization algorithms and 
                user-friendly display options to generate a schedule that meets the 
                needs of both teachers and students.</p>
            <ul class="socials">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2023 SchedulEase </p>
        </div>
    </footer>
    
    
    
    <!-- internal javascrtipt -->
    <script>
      $(document).ready(function(){
        $("#myBtn").click(function(){
          $("#myModal1").modal();
        });
      });
      </script>
       
      <script>
        $(document).ready(function(){
          $("#myBtn2").click(function(){
            $("#myModal2").modal();
          });
        });
      </script>

</body>
</html>