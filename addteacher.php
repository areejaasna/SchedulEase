<?php
// if(!defined('MYSITE'))
// {
//   header('location:test.php');
  
// }
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
    <!-- <link rel="stylesheet" href="modalstyle.css"> -->
    <!-- <link rel="stylesheet" href="style2.css"> -->
    <link rel="stylesheet" href="addteach.css">

    <title>Document</title>

    <!-- open-sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    

    <!-- CSS, modal 2 -->
     <link href="bootM/bootstrap.min.css" rel="stylesheet"/>

    <!-- for nav-bar, alignment -->
    <link href="bootM/bootstrap(nav).min.css" rel="stylesheet"/>
    <script src="bootM/jquery.min.js"></script>
    <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->

    
    <!-- for serach table -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" /> -->
    <link rel="stylesheet" href="css/jquery.dataTables.css" />

    <link rel="stylesheet" href="datatables/bootstrap.min.css">
    <link rel="stylesheet" href="datatables/jquery.dataTables.min.css">
  


</head>
<body>

<nav class="navbar navbar-expand-lg navbar-fixed-top"> 

<div class="collapse navbar-collapse" id="menu">
    <ul class="navbar-nav">
    <li class="nav-item ">
        <a class="nav-link" class="color-me" href="adddept.php">Department </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" class="color-me" href="addteacher.php">Teacher</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"class="color-me"  href="addsubject.php">Paper</a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" class="color-me" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Allotment
        </a>
        <ul class="dropdown-menu">
          <li>
            <a href="allotSub.php">TUTORIAL PAPER</a>
          </li>
          <li>
            <a href="allotPrac.php">PRACTICAL PAPER</a>
          </li>
          <li>
            <a href="allotNa.php">OTHERS</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link " class="color-me" href="generatetimetable.php">Generate Timetable</a>
      </li>
    </ul>
    
    <ul class="nav navbar-nav navbar-right">
         <li><a href="dashboard.php" class="color-me" align="right">Dashboard</a></li>
         <li><a href="test.php" class="color-me" align="right">Logout</a></li>
    </ul>
  </div>
</nav>
<!--NAVBAR SECTION END-->
<br>
    
<!-- Button trigger modal -->
<div align="center" style="margin-top:50px">
<!-- Button trigger modal -->
<button type="button" id="teachermanual" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Add Teacher
</button>
</div>
<br>
<br>
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
        <div class="modal-header">
          <h4 class="modal-title">Add Teacher</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <form action="addteacherValid.php" method="POST" name="myform" onsubmit="return validation()">
                    <div class="form-group">
                        <label for="facultyno">Faculty Number</label>
                        <input type="text" class="form-control" id="facultyno" name="FN" placeholder="Faculty No" required>
                    </div>
                    
                    

                    <div class="form-group">
                        <label for="teachername">Teacher Name</label>
                        <div class="form-group">
                        <label for="Title">Title</label>
                        <select class="form-control" id="title" name="title">
                            <option selected>Select</option>
                            <option value="Ms. ">Ms</option>
                            <option value="Sri. ">Sri</option>
                            <option value="Smt. ">Smt</option>
                            <option value="Dr. ">Dr</option>
                        </select>
                        </div>
                        <label for="Title">Name</label>
                        <input type="text" class="form-control" id="teachername" name="TN"
                               placeholder="Teacher's Name" required>
                    </div>

                    

                    <div class="form-group">
                    
                    <label for="sdept">Select Department</label>
                    <select class="form-control" id="sdept" name="DN">
                        <option selected disabled>Select</option>
                        <?php
                            $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),"SELECT * FROM department ");
                                    while ($row = mysqli_fetch_assoc($q)) {
                                     echo " \"<option value=\"{$row['d_id']}\">{$row['d_name']}</option>\"";
                                     }
                         ?>
                    </select>
                    </div>

                    

                    <div class="form-group">
                        <label for="designation">Designation</label>

                        <select class="form-control" id="designation" name="TD">
                            <option selected>Select</option>
                            <option value="Assistant Professor">Assistant Professor</option>
                            <option value="Associate Professor">Associate Professor</option>
                            <option value="State Aided College Teacher I">State Aided College Teacher I</option>
                            <option value="State Aided College Teacher II">State Aided College Teacher II</option>
                            <option value="Teaching Fellow">Teaching Fellow</option>
                            
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="alias_name">Alias</label>
                        <input type="text" class="form-control" id="alias_name" name="AL" placeholder="Alias" required>
                    </div>
                    

                    <div class="form-group">
                        <label for="P-Day">P-Day</label>

                        <select class="form-control" id="P-Day" name="PD">
                            <option selected>Select</option>
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="friday">Friday</option>
                            <option value="saturday">Saturday</option>
                           
                            
                        </select>
                    </div>
                
                   
                    <div class="form-group">
                        <label for="Email ID">Email ID</label>
                        <input type="email" class="form-control" id="eid" name="eid"
                               placeholder="">
                    </div>
                       
                    <div class="modal-footer">
                      <div align="right">
                        <button type="submit"  class="btn btn-default" name="ADD" value="ADD">ADD</button>
                    </div>
                    </div>
                </form>
                


      </div>
    </div>
  </div>
</div>



    <div class="container p-30">
        <div class="row">
            <div class="col-md-12 main-datatable">
                <div class="card_body">
                    <div class="row d-flex">
                        <div class="col-sm-4 createSegment"> 
                        
                        </div>
                        <div class="col-sm-8 add_flex">
                            
                        </div> 
                    </div>
                    <div class="overflow-x">
                        <table style="width:100%;"  id="myTable" class="table cust-datatable dataTable no-footer">
                        <thead>
                              <tr>
                                    <th style="min-width:100px;">Teacher Name</th>
                                    <th style="min-width:50px;">Alias</th>
                                    <th style="min-width:80px;">Department ID</th>
                                    <th style="min-width:120px;">Designation</th>
                                    <th style="min-width:60px;">P-Day</th>
                                    <th style="min-width:200px;">Email ID</th>
                                    <th style="min-width:60px;">Action</th>
                              </tr>
                        </thead>
        <tbody>
        <?php
        include 'config.php';
        $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
            "SELECT * FROM teachers ORDER BY faculty_number ASC");
            if($q)
            {
                while ($row = mysqli_fetch_assoc($q))
                {
                    $faculty_number=$row['faculty_number'];
                    $name=$row['name'];
                    $alias=$row['alias'];
                    $d_id=$row['d_id'];
                    $desig=$row['designation'];
                    $no_odd=$row['no_of_subject_odd'];
                    $no_even=$row['no_of_subject_even'];
                    $pday=$row['pday'];
                    $eid=$row['email_id'];

                    $pday2="";
                    $pos = strpos($pday, ",");
                    if ($pos !== false) {
                      $pday2=substr($pday, $pos+2);
                      $pday=substr($pday, 0, $pos);

                      $pday=strtoupper(substr($pday,0,1)).substr($pday,1);
                      $pday2=strtoupper(substr($pday2,0,1)).substr($pday2,1);
                      $pday=$pday . ", " . $pday2; 
                    }
                    else if($pday == "na")
                      $pday="NA";
                    else
                      $pday=strtoupper(substr($pday,0,1)).substr($pday,1);

                    echo  " <tr>
                    <td>".$name."</td>
                    <td>".$alias."</td>
                    <td>".$d_id."</td>
                    <td>".$desig."</td>
                    <td>".$pday."</td>
                    <td>".$eid."</td>
                   
                    <td>
                        <a class='btn btn-primary' role='button' href='delteacher.php?deleteid=".$faculty_number."'>Delete </a>
                    </td>
               </tr>\n  ";
                }

            }

            // <td>".$no_odd."</td>
            // <td>".$no_even."</td>

        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="bootM/jquery-3.3.1.slim.min.js"></script>
<script src="bootM/popper.min.js"></script>
<script src="bootM/bootstrap(4.31).min.js"></script>

<script src="js/jquery.dataTables.js"></script>

<script src="datatables/jquery-3.2.1.min.js"></script>
<script src="datatables/bootstrap.min.js"></script>
<script src="datatables/jquery.dataTables.min.js"></script>


<script>
// $(document).ready( function () {
//     $('#myTable').DataTable();
// } );

$(document).ready(function() {
$('#myTable').dataTable({
    "bPaginate": true,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": false });
});
</script>
<!-- <script src="bootM/js/jquery-3.6.4.min.js"></script> -->
</body>
</html>