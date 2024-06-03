<?php  
    $connect = mysqli_connect("localhost", "root", "", "ttms");  
    
    if(isset($_POST["query"])){  
        $output = '';  
        $query = "SELECT * FROM autofill_sub WHERE sname LIKE '%".$_POST["query"]."%'";  
        $result = mysqli_query($connect, $query);  
        $output = '<ul class="list-unstyled">';  
        
        if(mysqli_num_rows($result) > 0){  
            while($row = mysqli_fetch_array($result)){  
                $output .= '<li>'.$row["sname"].'</li>';  
            }  
        }else{  
            $output .= '<li>User Not Found</li>';  
        }  
    
    $output .= '</ul>';  
    echo $output;  
    } 
?>