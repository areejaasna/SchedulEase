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
    <link rel="stylesheet" href="datatable.css">
    <!-- <link rel="stylesheet" href="style2.css"> -->

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
    <!-- <link rel="stylesheet" href="css/jquery.dataTables.css" /> -->

    <link rel="stylesheet" href="datatables/bootstrap.min.css">
    <link rel="stylesheet" href="datatables/jquery.dataTables.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- <link rel="stylesheet" href="datatables/font-awesome.css"> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  


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
      <!-- <li class="nav-item">
        <a class="nav-link"class="color-me"  href="addclass.php">Add Classroom</a>
      </li> -->
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
    <!-- <ul class="nav navbar-nav navbar-right">
         <li><a href="logout.php" class="color-me" align="right">Logout</a></li>
    </ul> -->
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
<!-- <button type="button" id="subjectmanual" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Add Subject
</button> -->
</div>
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <!-- <div class="modal-header">
          <h4 class="modal-title">Add Subject</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> -->
        <div class="modal-header">
          <h4 class="modal-title">Add Paper</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
      <form action="addsubjectValid.php" method="POST">
                    <div class="form-group">
                        <label for="scode">Paper Code</label>
                        <input type="text" class="form-control" id="scode" name="SC" placeholder="Subject Code" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="SN">Paper Name</label>
                        <input type="text" class="form-control" id="SN" name="SN" placeholder="Subject Name" required>
                        <div id="userList"></div>
                    </div>

                    <div class="form-group">
                    <!-- <select name="select_teacher"> -->
                    <label for="sdept">Select Department</label>
                    <select class="form-control" id="sdept" name="SD">
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
                        <label for="subjecttype">Paper Type</label>
                        <select class="form-control" id="subjecttype" name="ST">
                            <option selected disabled>Select</option>
                            <option value="tutorial">Tutorial</option>
                            <option value="practical">Practical</option>
                            <option value="na">NA</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sem">Semester</label>
                        <select class="form-control" id="sem" name="sem">
                            <option selected disabled>Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="credit">Credit</label>
                        <select class="form-control" id="credit" name="credit">
                            <option selected disabled>Select</option>
                            <option value="2">2</option>
                            <option value="6">6</option>
                        </select>
                    </div>

                    
                    
                   

                   

                    <div align="right">
                        <button type="submit"  class="btn btn-default" name="ADD2" value="ADD2">ADD</button>
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
                        <button type="button" id="subjectmanual" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add Paper</button>
                        </div>
                        <div class="col-sm-8 add_flex">
                            <div class="form-group searchInput">
                                <label for="email">Search:</label>
                                <input type="search" class="form-control" id="filterbox" placeholder=" ">
                            </div>
                        </div> 
                    </div>
                    <div class="overflow-x">
                        <table style="width:100%;" id="filtertable"  class="table cust-datatable dataTable no-footer">
                        <thead>
                              <tr>
                                    <th style="min-width:50px;">Paper Code</th>
                                    <th style="min-width:200px;">Paper Name</th>
                                    <th style="min-width:150px;">Paper Type</th>
                                    <th style="min-width:100px;">Department ID</th>
                                    <th style="min-width:80px;">Semester</th>
                                    <th style="min-width:80px;">Credit</th>
                                    <th style="min-width:150px;">Action</th>
                              </tr>
                        </thead>
                        <tbody>
                          <?php
                          include 'config.php';
                          $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                              "SELECT * FROM subjects ORDER BY subject_code ASC");
                              if($q)
                              {
                                  while ($row = mysqli_fetch_assoc($q))
                                  {
                                      $subject_code=$row['subject_code'];
                                      $subject_name=$row['subject_name'];
                                      $subject_type=$row['subject_type'];
                                      $credit=$row['credit'];
                                      $semester=$row['semester'];
                                      $d_id=$row['d_id'];

                                      if($subject_type == "na")
                                        $subject_type="NA";
                                      else
                                      $subject_type=strtoupper(substr($subject_type,0,1)).substr($subject_type,1);

                                      echo  " <tr><td>".$subject_code."</td>
                                      <td>".$subject_name."</td>
                                      <td>".$subject_type."</td>
                                      <td>".$d_id."</td>
                                      <td>".$semester."</td>
                                      <td>".$credit."</td>
                                      
                                      <td>
                                          <a class='btn btn-primary' role='button' href='delsubject.php?deleteid=".$subject_code."'>Delete </a>
                                      </td>
                                </tr>\n  ";
                                  }

                              }

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
<!-- <script src="js/main.js"></script> -->

<script>
// $(document).ready( function () {
//     $('#myTable').DataTable();
// } );

$(document).ready(function() {
    var dataTable = $('#filtertable').DataTable({
        "pageLength":10,
        'aoColumnDefs':[{
            'bSortable':false,
            'aTargets':['nosort'],
        }],
        columnDefs:[
            {type:'date-dd-mm-yyyy',aTargets:[5]}
        ],
        "aoColumns":[
            null,
            null,
            null,
            null,
            null,
            null,
            null
        ],
        "order":true,
        "bLengthChange":false,
        "dom":'<"top">ct<"top"p><"clear">'
    });
    $("#filterbox").keyup(function(){
        dataTable.search(this.value).draw();
    });
} );

</script>

<script>  
    $(document).ready(function(){  
        $('#SN').keyup(function(){  
            var query = $(this).val();  
            if(query != '')  
            {  
                $.ajax({  
                    url:"search.php",  
                    method:"POST",  
                    data:{query:query},  
                    success:function(data)  
                    {  
                        $('#userList').fadeIn();  
                        $('#userList').html(data);  
                    }  
                });  
            }  
        });  
        $(document).on('click', 'li', function(){  
            $('#SN').val($(this).text());  
            $('#userList').fadeOut();  
        });  
    });  
</script>
</body>
</html>