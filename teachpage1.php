<?php
session_start();
if(empty($_SESSION['loggedin_name'])) {
  header('Location:test.php');
}

if(!empty($_SESSION['loggedin_name'])) {
  $teachername=$_SESSION['loggedin_name'];
}

include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tstyle1.css">

    <title>Document</title>
    
    <!-- for pdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <!-- open-sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- for modal -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- for nav-bar, alignment -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-fixed-top">
    <div class="collapse navbar-collapse" id="menu">        
        <ul class="nav navbar-nav navbar-left">
            <!-- <li><a href="#"> <?php  ?></a></li> -->
            <!-- echo $teachername; -->
            <li><a href=""> <?php echo $_SESSION['loggedin_name']; ?></a></li>        
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="tlogout.php" class="color-me" align="right">Logout</a></li>
        </ul>
    </div>
</nav>

<div style="margin-top: 100px" align="center">
    <form action="teachpage1.php" method="post">   
        <select name="select_teacher">
            <option selected disabled>Select Teacher</option>
            <?php
            $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                "SELECT * FROM teachers ");
            while ($row = mysqli_fetch_assoc($q)) {
                echo " \"<option value=\"{$row['faculty_number']}\">{$row['name']}</option>\"";
            }
            ?>
        </select>
        <button type="submit" id="viewteacher">VIEW TIMETABLE</button>    
    </form>
</div>
<br><br>
<div align="center" style="margin-top: 10px">
    <form action="teachpage1.php" method="post">
        <select name="select_department" class="">
            <option selected disabled>Select Department</option>
            <?php
            $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                "SELECT * FROM department ");
            while ($row = mysqli_fetch_assoc($q)) {
                echo " \"<option value=\"{$row['d_id']}\">{$row['d_name']}</option>\"";
            }
            ?>
        </select>
        <br><br>            
        <select name="select_semester">
            <option selected disabled>Select Semester</option>
            <option value="Odd">Odd</option>
            <option value="Even">Even</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>
        <button type="submit" id="viewsemester">VIEW TIMETABLE</button>
    </form>
</div>

<div>
    <br><br>
    <style>
    table {
    border-collapse: collapse;
    width: 100%;
    }
  
    th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
    }
  
    tr:nth-child(even) {
    background-color: #f2f2f2;
    }
    </style>  

    <div id="TT" style="background-color: #FFFFFF">
            <h3 style="text-align:center;"><strong>
                    <?php
                    if (isset($_POST['select_department']) && isset($_POST['select_semester'])) {
			            $id = $_POST['select_department'];
                        $r = mysqli_fetch_assoc(mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * from department
                        WHERE d_id = '$id'"));
                        if ($_POST['select_semester'] == "Odd" || $_POST['select_semester'] == "Even")
                            echo " " . $r['d_name'] . " Department " . " <br> " . $_POST['select_semester'] . " Semester ";
                        else
                            echo " " . $r['d_name'] . " Department Semester - " . $_POST['select_semester'] . " ";
                        $pday="";
                    } else if (isset($_POST['select_teacher'])) {
                        $id = $_POST['select_teacher'];
                        $r = mysqli_fetch_assoc(mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * from teachers
                        WHERE faculty_number = '$id'"));
                        echo $r['name'];
                        $pday=$r['pday'];
                    } else if (isset($_SESSION['loggedin_name'])) {
                        $name = $_SESSION['loggedin_name'];
                        $r = mysqli_fetch_assoc(mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * from teachers
                        WHERE name = '$name'"));
                        echo $r['name'];
                        $pday=$r['pday'];
                    }
                    ?>
            </strong></h3>
                <?php
        echo '<table border="2" cellspacing="3" align="center" id="timetable">';
        if (isset($_POST['select_department']) && isset($_POST['select_semester']) && ($_POST['select_semester'] == "Odd" || $_POST['select_semester'] == "Even")) {
            echo '<tr>
                <th style="text-align:center">WEEKDAYS</th>
                <th style="text-align:center">YEAR</th>
                <th style="text-align:center">10:30-11:30</th>
                <th style="text-align:center">11:30-12:30</th>
                <th style="text-align:center">12:30-1:30</th>
                <th style="text-align:center">1:30-2:00</th>
                <th style="text-align:center">2:00-3:00</th>
                <th style="text-align:center">3:00-4:00</th>
                <th style="text-align:center">4:00-5:00</th>
            </tr>';}
            else if ((isset($_POST['select_department']) && isset($_POST['select_semester']) && $_POST['select_semester'] != "Odd" && $_POST['select_semester'] != "Even") || isset($_POST['select_teacher']) || isset($_SESSION['loggedin_id'])) {
                echo '<tr>
                <th style="text-align:center">WEEKDAYS</th>
                <th style="text-align:center">10:30-11:30</th>
                <th style="text-align:center">11:30-12:30</th>
                <th style="text-align:center">12:30-1:30</th>
                <th style="text-align:center">1:30-2:00</th>
                <th style="text-align:center">2:00-3:00</th>
                <th style="text-align:center">3:00-4:00</th>
                <th style="text-align:center">4:00-5:00</th>
            </tr>';}    
                
                $table = null;
                if (isset($_POST['select_department']) && isset($_POST['select_semester']) && ($_POST['select_semester'] == "Odd" || $_POST['select_semester'] == "Even")) {
                    if($_POST['select_semester'] == "Odd"){
                        $s1=1;
                        $s2=3;
                        $s3=5;
                    } else if($_POST['select_semester'] == "Even"){
                        $s1=2;
                        $s2=4;
                        $s3=6;
                    }
                    $table1 = " " . $_POST['select_department'] . "_semester" . $s1;
                    $table2 = " " . $_POST['select_department'] . "_semester" . $s2;
                    $table3 = " " . $_POST['select_department'] . "_semester" . $s3;
                } else if (isset($_POST['select_department']) && isset($_POST['select_semester']) && $_POST['select_semester'] != "Odd" && $_POST['select_semester'] != "Even") {
                    $table = " " . $_POST['select_department'] . "_semester" . $_POST['select_semester'] . " ";
                } else if (isset($_POST['select_teacher'])) {
                    $table = " " . $_POST['select_teacher'] . " ";
                } else if (isset($_SESSION['loggedin_id'])) {
                    $table = " " . $_SESSION['loggedin_id'] . " ";
                } else
                    echo '</table>';
                if ((isset($_POST['select_department']) && isset($_POST['select_semester'])) || isset($_POST['select_teacher']) || isset($_SESSION['loggedin_id'])) {
                    if (isset($_POST['select_department']) && isset($_POST['select_semester']) && ($_POST['select_semester'] == "Odd" || $_POST['select_semester'] == "Even")) {
                        $q1 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                        "SELECT * FROM" . $table1);
                        $q2 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                        "SELECT * FROM" . $table2);
                        $q3 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                        "SELECT * FROM" . $table3);
                    } else if ((isset($_POST['select_department']) && isset($_POST['select_semester']) && $_POST['select_semester'] != "Odd" && $_POST['select_semester'] != "Even") || isset($_POST['select_teacher']) || isset($_SESSION['loggedin_id']))
                        $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                        "SELECT * FROM" . $table);
                    $qq = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                        "SELECT * FROM subjects");
                    $days = array('MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY');
                    $i = -1;
                    $str = "<br>";
                    $str2 = "<br>";
                    $tid = "";
                    $classes=0;
                    if (isset($_POST['select_department']) && isset($_POST['select_semester']) && ($_POST['select_semester'] == "Odd" || $_POST['select_semester'] == "Even")) {
                        while ($r = mysqli_fetch_assoc($qq)) {
                            if($_POST['select_semester'] == "Odd"){
                                $s1=1;
                                $s2=3;
                                $s3=5;
                            } else if($_POST['select_semester'] == "Even"){
                                $s1=2;
                                $s2=4;
                                $s3=6;
                            }
                            if ($r['isAlloted'] == 1 && $r['d_id'] == $_POST['select_department'] && ($r['semester'] == $s1 || $r['semester'] == $s2 || $r['semester'] == $s3)) {
                                $str .= $r['subject_code'] . ": " . $r['subject_name'] . " <br>";
                                if (isset($r['allotedto'])) {
                                    $id = $r['allotedto'];
                                    $qqq = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                                        "SELECT * FROM teachers WHERE faculty_number = '$id'");
                                    $rr = mysqli_fetch_assoc($qqq);
                                    $pos = strpos($str2, $rr['name']);
                                    if ($pos === false)
                                        $str2 .= " " . $rr['alias'] . ": " . $rr['name'] . " <br>";
                                }
                            }
                        }
                    } else if (isset($_POST['select_department']) && isset($_POST['select_semester']) && $_POST['select_semester'] != "Odd" && $_POST['select_semester'] != "Even") {
                        while ($r = mysqli_fetch_assoc($qq)) {
                            if ($r['isAlloted'] == 1 && $r['d_id'] == $_POST['select_department'] && $r['semester'] == $_POST['select_semester']) {
                                $str .= $r['subject_code'] . ": " . $r['subject_name'] . " <br>";
                                if (isset($r['allotedto'])) {
                                    $id = $r['allotedto'];
                                    $qqq = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                                        "SELECT * FROM teachers WHERE faculty_number = '$id'");
                                    $rr = mysqli_fetch_assoc($qqq);
                                    $str2 .= " " . $rr['alias'] . ": " . $rr['name'] . " <br>";
                                }
                            }
                        }
                    } else if (isset($_POST['select_teacher']) || isset($_SESSION['loggedin_id'])) {
                        while ($r = mysqli_fetch_assoc($q)) {
                            for($m=1; $m<=6; $m++) {
                                if ($r['period' . $m] != "-")
                                    $classes++;
                            } 
                        }
                        $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                        "SELECT * FROM" . $table);
                    }
                    
                    if (isset($_POST['select_department']) && isset($_POST['select_semester']) && ($_POST['select_semester'] == "Odd" || $_POST['select_semester'] == "Even")) {
                        while ($row1 = mysqli_fetch_assoc($q1)) {
                            if($_POST['select_semester'] == "Odd"){
                                $s1=1;
                                $s2=3;
                                $s3=5;
                            } else if($_POST['select_semester'] == "Even"){
                                $s1=2;
                                $s2=4;
                                $s3=6;
                            }
                            $row2 = mysqli_fetch_assoc($q2);
                            $row3 = mysqli_fetch_assoc($q3);
                            $i++;
    
                            echo "
                     <tr><th style=\"text-align:center\" rowspan=\"3\">$days[$i]</th>
                     <td style=\"text-align:center\">Sem-" . $s1 . "</td>
                     <td style=\"text-align:center\">{$row1['period1']}</td>
                    <td style=\"text-align:center\">{$row1['period2']}</td>
                    <td style=\"text-align:center\">{$row1['period3']}</td>
                      <td style=\"text-align:center\" rowspan=\"3\">RECESS</td>
                     <td style=\"text-align:center\">{$row1['period4']}</td>
                      <td style=\"text-align:center\">{$row1['period5']}</td>
                      <td style=\"text-align:center\">{$row1['period6']}</td>
                    </tr>
                    <tr><td style=\"text-align:center\">Sem-" . $s2 . "</td>
                     <td style=\"text-align:center\">{$row2['period1']}</td>
                    <td style=\"text-align:center\">{$row2['period2']}</td>
                    <td style=\"text-align:center\">{$row2['period3']}</td>
                     <td style=\"text-align:center\">{$row2['period4']}</td>
                      <td style=\"text-align:center\">{$row2['period5']}</td>
                      <td style=\"text-align:center\">{$row2['period6']}</td>
                    </tr>
                    <tr><td style=\"text-align:center\">Sem-" . $s3 . "</td>
                     <td style=\"text-align:center\">{$row3['period1']}</td>
                    <td style=\"text-align:center\">{$row3['period2']}</td>
                    <td style=\"text-align:center\">{$row3['period3']}</td>
                     <td style=\"text-align:center\">{$row3['period4']}</td>
                      <td style=\"text-align:center\">{$row3['period5']}</td>
                      <td style=\"text-align:center\">{$row3['period6']}</td>
                    </tr>\n";
                        }
    
                        echo '</table>';
                    }
                    if (isset($_POST['select_department']) && isset($_POST['select_semester']) && $_POST['select_semester'] != "Odd" && $_POST['select_semester'] != "Even") {
                    while ($row = mysqli_fetch_assoc($q)) {
                        $i++;

                        echo "
                 <tr><th style=\"text-align:center\">$days[$i]</th>
                 <td style=\"text-align:center\">{$row['period1']}</td>
                <td style=\"text-align:center\">{$row['period2']}</td>
                <td style=\"text-align:center\">{$row['period3']}</td>
                  <td style=\"text-align:center\">RECESS</td>
                 <td style=\"text-align:center\">{$row['period4']}</td>
                  <td style=\"text-align:center\">{$row['period5']}</td>
                  <td style=\"text-align:center\">{$row['period6']}</td>
                </tr>\n";
                    }

                    echo '</table>';
                } 
                if (isset($_POST['select_teacher']) || isset($_SESSION['loggedin_id'])) {
                    $pday2="";
                    $pos = strpos($pday, ",");
                    if ($pos !== false) {
                        $pday2=substr($pday, $pos+2);
                        $pday=substr($pday, 0, $pos);
                    }
                    while ($row = mysqli_fetch_assoc($q)) {
                        $i++;

                        if(strtoupper($pday) == $days[$i] || strtoupper($pday2) == $days[$i]) {
                            echo "
                <tr><th style=\"text-align:center\">$days[$i]</th>
                <td style=\"text-align:center\" colspan=\"7\">P-DAY</td>
                </tr>\n";
                        }

                        else {
                            echo "
                <tr><th style=\"text-align:center\">$days[$i]</th>
                <td style=\"text-align:center\">{$row['period1']}</td>
                <td style=\"text-align:center\">{$row['period2']}</td>
                <td style=\"text-align:center\">{$row['period3']}</td>
                <td style=\"text-align:center\">RECESS</td>
                <td style=\"text-align:center\">{$row['period4']}</td>
                <td style=\"text-align:center\">{$row['period5']}</td>
                <td style=\"text-align:center\">{$row['period6']}</td>
                </tr>\n";
                        }
                }

                echo '</table>';
            }
                
                if (isset($_POST['select_department']) && isset($_POST['select_semester'])) {
                    echo '<table>
                        <tr>
                            <td width="50%">' . $str . '</td>
                            <td width="50%">' . $str2 . '</td>
                        </tr>
                    </table>';
                }
                else if (isset($_POST['select_teacher']) || isset($_SESSION['loggedin_id']))
    		        echo "<div style='margin-left: 10px'>" . "<br>Number of Classes: " . $classes . "<br></div>";
                }
                ?>
    </div>
</div>

<script>
	function saveAsPDF() {
		const element = document.getElementById('TT');
		const options = {
			margin: 10,
			filename: '<?php
                    if (isset($_POST["select_department"]) && isset($_POST["select_semester"])) {
                        echo "ttms " . $_POST["select_department"] . " semester " . $_POST["select_semester"];
                    } else if (isset($_POST["select_teacher"])) {
                        echo "ttms " . $_POST["select_teacher"];
                    } else if (isset($_SESSION["loggedin_id"])) {
                        echo "ttms " . $_SESSION["loggedin_id"];
                    }
                    ?>.pdf',
			image: { type: 'jpeg', quality: 0.98 },
			html2canvas: { scale: 2 },
			jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
		};

		html2pdf().set(options).from(element).save();
	}
</script>

<div align="center" style="margin-top: 10px">
	<button class="" onclick="saveAsPDF()">SAVE AS PDF</button>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>