
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/home.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="./css/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type='text/css' href="css/manage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Dashboard</title>
</head>
<body>
        
    <div class="title">
        <a href="dashboard.php"><img src="./images/logo1.png" alt="" class="logo"></a>
        <span class="heading">Dashboard</span>
        <a href="logout.php" style="color: white"><span class="fa fa-sign-out fa-2x">Logout</span></a>
    </div>

    <div class="nav">
        <ul>
            <li class="dropdown" onclick="toggleDisplay('1')">
                <a href="" class="dropbtn">Classes &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="1">
                    <a href="add_classes.php">Add Class</a>
                    <a href="manage_classes.php">Manage Class</a>
                </div>
            </li>
            <li class="dropdown" onclick="toggleDisplay('4')">
                <a href="" class="dropbtn">Subjects &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="4">
                    <a href="add_subject.php">Add Subjects</a>
                    <a href="add_subjectcombination.php">Add subjectcombination</a>
                    <a href="manage_subject.php">Manage Subjects</a>
                </div>
            </li>
            <li class="dropdown" onclick="toggleDisplay('2')">
                <a href="#" class="dropbtn">Students &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="2">
                    <a href="add_students.php">Add Students</a>
                    <a href="manage_students.php">Manage Students</a>
                </div>
            </li>
            <li class="dropdown" onclick="toggleDisplay('3')">
                <a href="#" class="dropbtn">Results &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="3">
                    <a href="add_results.php">Add Results</a>
                    <a href="manage_results.php">Manage Results</a>
                </div>
            </li>
        </ul>
    </div>

    <div class="main">
        <?php
            include('init.php');
            include('session.php');

            $sql = "SELECT `name`, `rno`, `class_name` FROM `students`";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
               echo "<table>
                <caption>Manage Students</caption>
                <tr>
                <th>NAME</th>
                <th>ROLL_NO</th>
                <th>CLASS</th>
			   <th>Actions</th>
			   <th></th>

                </tr>";

                while($row = mysqli_fetch_array($result))
                  {
                    echo "<tr>";
					  
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['rno'] . "</td>";
                    echo "<td>" . $row['class_name'] . "</td>";
					  
					 echo  "<div class='btn-group'>";
					 echo"<td>"."<button class='btn btn-primary' style='background-color: darkslategrey'><a class='text=light' style='color:white' href='Update.php? rno=".$row['rno']."'.>Update</a>"; 
					 echo  "</button>"."</td>";
					  
					  
					  echo"<td>"."<button class='btn btn-primary' style='background-color: darkslategrey'><a class='text=light' style='color:white' href='Delete.php? rno=".$row['rno']."'.>Delete</a>"; 
					 echo  "</button>"."</td>";
					  
				
					  echo "</div>";
					  echo "</td>";
					  echo "</tr>"; 

                  }

                echo "</table>";
				

               } 
		
		else {
                echo "0 Students";}
        ?>
       
 
    </div>
    
    

    <div class="footer">
    </div>
</body>
</html>

