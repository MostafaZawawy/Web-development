<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "lab4";
$x = 0;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$page = '';
$record_per_page=5;
$output = '';

if(isset($_POST["page"]))
{
    $page = $_POST["page"];
}
else {
    $page = 1;
}

$start_from = ($page - 1)*$record_per_page;


if(isset($_POST["query"])!='')
{

    $search = mysqli_real_escape_string($conn, $_POST["query"]);
    $page_query = "
   SELECT * FROM course,department,professor
  WHERE professor.professor_id=course.professor_id AND course.department_id=department.Department_id AND ( course_name LIKE '%".$search."%'
  OR course_discription LIKE '%".$search."%' 
  OR department_name LIKE '%".$search."%' 
  OR professor_name LIKE '%".$search."%' 
  OR  REPLACE(course_name,' ','') LIKE '%".$search."%'
  OR REPLACE(course_discription,' ','') LIKE '%".$search."%' 
  OR REPLACE(department_name,' ','') LIKE '%".$search."%' 
  OR REPLACE(professor_name,' ','') LIKE '%".$search."%' )";

}
else {
    $page_query = "SELECT * FROM course,department,professor WHERE professor.professor_id=course.professor_id AND course.department_id=department.Department_id   ";
}
$query=$page_query.'LIMIT '.$start_from.', '.$record_per_page.'';
$result=mysqli_query($conn,$query);

$output.= "  
      <table class='table  styled-table'>  
           <tr>  
                <th width='50%'>course name</th>  
                <th width='50%'>course description</th> 
                 <th width='50%'>department name</th>
                 <th width='50%'>professor name</th> 
           </tr>  
 ";
while($row = mysqli_fetch_array($result))
{


    $output .= '  
           <tr>  
                <td>'.$row["course_name"].'</td>  
                <td>'.$row["course_discription"].'</td>  
                <td>'.$row["department_name"].'</td>
                <td>'.$row["professor_name"].'</td>
           </tr>  
      ';
}
$output .= '</table><br /><div align="center">';
$page_result = mysqli_query($conn, $page_query);
$total_records = mysqli_num_rows($page_result);

$output .= '
</table>
<br />
<div align="center">
  <ul class="pagination" id="horizontal-list" >
';

$total_links = ceil($total_records/$record_per_page);
$previous_link = '';
$next_link = '';
$page_link = '';

if($total_links ==0){
    echo'no results';
}
else {
    if ($total_links > 4) {
        if ($page < 5) {
            for ($count = 1; $count <= 5; $count++) {
                $page_array[] = $count;
            }
            $page_array[] = '...';
            $page_array[] = $total_links;
        } else {
            $end_limit = $total_links - 5;
            if ($page > $end_limit) {
                $page_array[] = 1;
                $page_array[] = '...';
                for ($count = $end_limit; $count <= $total_links; $count++) {
                    $page_array[] = $count;
                }
            } else {
                $page_array[] = 1;
                $page_array[] = '...';
                for ($count = $page - 1; $count <= $page + 1; $count++) {
                    $page_array[] = $count;
                }
                $page_array[] = '...';
                $page_array[] = $total_links;
            }
        }
    } else {
        for ($count = 1; $count <= $total_links; $count++) {
            $page_array[] = $count;
        }
    }

    for ($count = 0; $count < count($page_array); $count++) {
        if ($page == $page_array[$count]) {
            $page_link .= '
    <li class="page-item active"style="display: inline">
      <a class="pagination_link" href="#">' . $page_array[$count] . ' <span class="sr-only">(current)</span></a>
    </li>
    ';

            $previous_id = $page_array[$count] - 1;
            if ($previous_id > 0) {
                $previous_link = '<li class="page-item"><a class="pagination_link" href="javascript:void(0)" data-page_number="' . $previous_id . '">Previous</a></li>';
            }
            $next_id = $page_array[$count] + 1;
            if ($next_id > $total_links) {

            } else {
                $next_link = '<li class="page-item"><a class="pagination_link" href="javascript:void(0)" data-page_number="' . $next_id . '">Next</a></li>';
            }
        } else {
            if ($page_array[$count] == '...') {
                $page_link .= '
      <li class="page-item disabled">
          <a class="pagination_link" href="#">...</a>
      </li>
      ';
            } else {
                $page_link .= '
      <li class="page-item"><a class="pagination_link" href="javascript:void(0)" data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a></li>
      ';
            }
        }
    }

    $output .= $previous_link . $page_link . $next_link;
    $output .= '
  </ul>

</div>
';
}
echo $output;

?>
</body>
<style>

    .styled-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        margin-left:auto;
        margin-right:auto;
    }

    h2 {
        text-align: center;
    }

    .styled-table thead tr {
        background-color: #FF416C;
        color: #ffffff;
        text-align: left;
    }
    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
    }

    .styled-table tbody tr {
        border-bottom: 1px solid #00203FFF;
    }

    .styled-table tbody tr{
        background-color: #dddddd;
        border-bottom: 2px solid #00203FFF;
    }

    .styled-table tbody tr.active-row {
        font-weight: bold;
        color:#FF4B2B;
    }
</style>
</html>
