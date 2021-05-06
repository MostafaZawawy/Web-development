<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to table</title>
</head>
<body>
<table  class="styled-table">
    <thead>
    <tr>
        <th>Department</th>
        <th>Description</th>
    </tr>
    </thead>
    <tbody>


    <?php

           session_start();
           echo'<h2>Welcome '.$_SESSION['name'].'</h2>';
            $conn= mysqli_connect('localhost', 'root','', 'university');
            $sql = "SELECT name, description from department";
            $result = mysqli_query($conn, $sql);
           if(mysqli_num_rows($result) >0){
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>'. $row['name'] .'</td>';
            echo '<td>'. $row['description'] .'</td>';
            echo '</tr>';
           }
           }
     ?>
    <!-- and so on... -->
    </tbody>
</table>
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
        border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #FF4B2B;
    }
    .styled-table tbody tr.active-row {
        font-weight: bold;
        color:#FF4B2B;
    }
</style>
</html>