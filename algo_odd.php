<?php

/**Class to store department details**/
class Department
{
    public $d_id;
}

/**Class to store subject details**/
class Subject
{
    public $code; //Subject code
    public $classes = 0; //No. of classes
    public $subject_type; //type of subject
    public $credit; //credit of subject
    public $d_id; //department of subject
    public $semester; //semester of subject
    public $alias; //alias for subject teacher
    public $subjectteacher; //faculty number of teacher
}

/**Class to store teachers details**/
class Teacher
{
    public $id; //faculty number
    public $pday; //P-Day 
    public $count_classes = 0;
    public $days = array(); //schedule
}

$subjectslots = array(); //subjects slots for all semesters
$aliasslots = array(); //alias slots corresponding to each subject
$days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');

$query = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * FROM subjects ");
$subjects[] = new Subject(); //to store theory subjects

$count = 0;

/** fetching subjects and saving in subjects array*/
while ($row = mysqli_fetch_assoc($query)) {
    $temp = new Subject();
    $temp->code = $row['subject_code'];
    $temp->subject_type = $row['subject_type'];
    $temp->credit = $row['credit'];
    $temp->d_id = $row['d_id'];
    $temp->semester = $row['semester'];
    $temp->subjectteacher = $row['allotedto'];
    if (isset($temp->subjectteacher)) {
        $teacheralias_query = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
            "SELECT * FROM teachers WHERE faculty_number='$temp->subjectteacher'");
        $row = mysqli_fetch_assoc($teacheralias_query);
        $temp->alias = $row['alias'];
    }
    $subjects[$count++] = $temp;
}
$subjects_count = $count;

/**Fetching department and saving into department array*/
$query = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * FROM department ");

$department[] = new Department();
$count = 0;
while ($row = mysqli_fetch_assoc($query)) {
    $temp = new Department();
    $temp->d_id = $row['d_id'];
    $department[$count++] = $temp;
}
$dept_count = $count;

/**Fetching teachers and saving into teachers array*/
$query = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * FROM teachers ");

$teachers[] = new Teacher();
$count = 0;
while ($row = mysqli_fetch_assoc($query)) {
    $temp = new Teacher();
    $temp->id = $row['faculty_number'];
    $temp->pday = $row['pday'];
    $teachers[$count++] = $temp;
}
$teachers_count = $count;

$r = -1;

/** Generating timetable for practical courses*/
for ($I = 0; $I < $subjects_count * 2; $I++) {
    $i = $I % $subjects_count;
    if ($subjects[$i]->subject_type == 'tutorial')
        continue;
    if ($subjects[$i]->subject_type == 'na')
        continue;
    $dept = $subjects[$i]->d_id;
    $sem = $subjects[$i]->semester;
    for ($j = 0; $j < 36; $j++) {
	    if(($j % 6) == 2 || ($j % 6) == 5)
		continue;
        $subject_teacher;
        $flag=0;
        for ($z = 0; $z < $teachers_count; $z++) {
            if ($teachers[$z]->id == $subjects[$i]->subjectteacher) {
                $flag=1;
                $tindex = $z;
                break;
            }
        }
        if ($flag == 0)
            break;
        if ($j % 6 == 0)
            $r++;
        $pday=$teachers[$tindex]->pday;
        $pday2="";
        $pos = strpos($pday, ",");
        if ($pos !== false) {
            $pday2=substr($pday, $pos+2);
            $pday=substr($pday, 0, $pos);
        }
        if($pday == $days[$r % 6] || $pday2 == $days[$r % 6])
            continue;
        if (isset($subjectslots[$dept][$sem][$r % 6][$j % 6]) || isset($subjectslots[$dept][$sem][$r % 6][($j % 6)+1])) {
            //check if subjectslot is empty
            continue;
        } else if (isset($teachers[$tindex]->days[$sem % 2][$r % 6][$j % 6]) || isset($teachers[$tindex]->days[$sem % 2][$r % 6][($j % 6)+1])) {
            //check if subject teacher is free
            continue;
        } else {

	        if ($subjects[$i]->credit == 2 && $subjects[$i]->subject_type == 'practical' && $subjects[$i]->classes >= 2)
		    continue;
            
            //check if existing in same day
            $already = false;
            for ($z = 0; $z < 6; $z++) {
                if (isset($subjectslots[$dept][$sem][$r % 6][$z])) {
                    if ($z == ($j % 6)) {
                        continue;
                    }
                    if ($subjectslots[$dept][$sem][$r % 6][$z] == $subjects[$i]->code . " Pr") {
                        $already = true;
                    }
                }
            }
            if ($already)
                continue;

            // set subject
            $subjects[$i]->classes=$subjects[$i]->classes+2;
            $subjectslots[$dept][$sem][$r % 6][$j % 6] = $subjects[$i]->code . " Pr";
            $aliasslots[$dept][$sem][$r % 6][$j % 6] = $subjects[$i]->alias;
            $subjectslots[$dept][$sem][$r % 6][($j % 6)+1] = $subjects[$i]->code . " Pr";
            $aliasslots[$dept][$sem][$r % 6][($j % 6)+1] = $subjects[$i]->alias;
            $teachers[$tindex]->days[$sem % 2][$r % 6][$j % 6] = $subjects[$i]->code . " Pr";
            $teachers[$tindex]->days[$sem % 2][$r % 6][($j % 6)+1] = $subjects[$i]->code . " Pr";
	        $teachers[$tindex]->count_classes=$teachers[$tindex]->count_classes+2;
            break;
        }
    }
    if ($flag == 0)
        break;
}

$r = -1;

/** Generating timetable for tutorial courses*/
if($flag == 1) {
for ($I = 0; $I < $subjects_count * 6; $I++) {
    $i = $I % $subjects_count;
    $dept = $subjects[$i]->d_id;
    $sem = $subjects[$i]->semester;
    for ($j = 0; $j < 36; $j++) {
        $subject_teacher;
        $flag=0;
        for ($z = 0; $z < $teachers_count; $z++) {
            if ($teachers[$z]->id == $subjects[$i]->subjectteacher) {
                $flag=1;
                $tindex = $z;
                break;
            }
        }
        if ($flag == 0)
            break;
        if ($j % 6 == 0)
            $r++;
        $pday=$teachers[$tindex]->pday;
        $pday2="";
        $pos = strpos($pday, ",");
        if ($pos !== false) {
            $pday2=substr($pday, $pos+2);
            $pday=substr($pday, 0, $pos);
        }
        if($pday == $days[$r % 6] || $pday2 == $days[$r % 6])
            continue;
        if($teachers[$tindex]->pday == $days[$r % 6])
            continue;
        if (isset($subjectslots[$dept][$sem][$r % 6][$j % 6])) {
            //check if subjectslot is empty
            continue;
        } else if (isset($teachers[$tindex]->days[$sem % 2][$r % 6][$j % 6])) {
            //check if subject teacher is free
            continue;
        } else {
	        if ($subjects[$i]->credit == 2 && $subjects[$i]->subject_type == 'practical')
		        continue;

            if ($subjects[$i]->credit == 6 && $subjects[$i]->subject_type == 'practical' && $subjects[$i]->classes >= 8)
		        continue;

            if ($subjects[$i]->credit == 2 && $subjects[$i]->subject_type == 'tutorial' && $subjects[$i]->classes >= 2)
		        continue;

            if ($subjects[$i]->credit == 2 && $subjects[$i]->subject_type == 'na' && $subjects[$i]->classes >= 2)
                continue;   
        
            else {
            //check if existing in same day
            $count = 0;
            for ($z = 0; $z < 6; $z++) {
                if (isset($subjectslots[$dept][$sem][$r % 6][$z])) {
                    if ($z == ($j % 6)) {
                        continue;
                    }
                    if ($subjectslots[$dept][$sem][$r % 6][$z] == $subjects[$i]->code) {
                        $count++;
                    }
                }
            }
            if ($count >= 2)
                continue;
            
            // set subject
            $subjects[$i]->classes++;
            $subjectslots[$dept][$sem][$r % 6][$j % 6] = $subjects[$i]->code;
            $aliasslots[$dept][$sem][$r % 6][$j % 6] = $subjects[$i]->alias;
            $teachers[$tindex]->days[$sem % 2][$r % 6][$j % 6] = $subjects[$i]->code;
            //$teachers[$tindex]->classroom_names[$sem % 2][$r][$j % 6] = $classroom;
	        $teachers[$tindex]->count_classes++;
            break;
            }
        }
    }
    if ($flag == 0)
        break;
}

/**********************check for empty slots in semester's timetable*******************************/
if($flag == 1) {
for ($m = 0; $m < $dept_count; $m++) {
    $dept = $department[$m]->d_id;
    for ($i = 1; $i <= 5; $i += 2) {
    	for ($k = 0; $k < 6; $k++) {
        	for ($j = 0; $j < 6; $j++) {

            	if (isset($subjectslots[$dept][$i][$k][$j])) {
            	} else {
                	$subjectslots[$dept][$i][$k][$j] = "-";
                	$aliasslots[$dept][$i][$k][$j] = "-";
            	}
            }
        }
    }
}

/**********************check for empty slots in teacher's timetable*******************************/
for ($i = 0; $i < $teachers_count; $i++) {
    for ($k = 0; $k < 6; $k++) {
        for ($j = 0; $j < 6; $j++) {

            if (isset($teachers[$i]->days[1][$k][$j])) {
            } else {
                $teachers[$i]->days[1][$k][$j] = "-";			//0 for even sem, 1 for odd sem
            }
        }
    }
}


/******Saving semesters timetable into database*****/

for ($m = 0; $m < $dept_count; $m++) {
    $dept = $department[$m]->d_id;
    for ($i = 1; $i <= 5; $i += 2) {
    	$database_name = " " . strtolower($dept) . "_semester" . $i . " ";
    	for ($j = 0; $j < 6; $j++) {
        	$query = "UPDATE" . $database_name . " SET  period1= '" . $subjectslots[$dept][$i][$j][0] . " [" . $aliasslots[$dept][$i][$j][0] . "]',
period2='" . $subjectslots[$dept][$i][$j][1] . " [" . $aliasslots[$dept][$i][$j][1] . "]', 
period3='" . $subjectslots[$dept][$i][$j][2] . " [" . $aliasslots[$dept][$i][$j][2] . "]',
period4='" . $subjectslots[$dept][$i][$j][3] . " [" . $aliasslots[$dept][$i][$j][3] . "]', 
period5='" . $subjectslots[$dept][$i][$j][4] . " [" . $aliasslots[$dept][$i][$j][4] . "]', 
period6='" . $subjectslots[$dept][$i][$j][5] . " [" . $aliasslots[$dept][$i][$j][5] . "]'
 WHERE day='" . $days[$j] . "' ";
        	$q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), $query);
    	}
    }
}

/******Saving teachers timetable into database*****/
for ($i = 0; $i < $teachers_count; $i++) {
    $database_name = " " . strtolower($teachers[$i]->id) . " ";
    for ($j = 0; $j < 6; $j++) {
        $query = "UPDATE" . $database_name . " SET  period1= '" . $teachers[$i]->days[1][$j][0] . "',
period2='" . $teachers[$i]->days[1][$j][1] . "', 
period3='" . $teachers[$i]->days[1][$j][2] . "',
period4='" . $teachers[$i]->days[1][$j][3] . "', 
period5='" . $teachers[$i]->days[1][$j][4] . "', 
period6='" . $teachers[$i]->days[1][$j][5] . "'
 WHERE day='" . $days[$j] . "' ";
        $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), $query);
    }
}
}
}

/******redirect back to generate timetable **/
if ($flag == 0) {
    header("Location:generatetimetable.php?failure=true");
    exit;
}
else {
    header("Location:generatetimetable.php?success=true");
    exit;
}

?>