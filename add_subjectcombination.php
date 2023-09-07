    <?php   
        include('init.php');
    include('session.php');

    if (isset($_POST['class'],$_POST['subject'])) {
        $namClass=$_POST["class"];
        $namSubject=$_POST["subject"];

        // validation
//        if (empty($namClass) or empty($namSubject) or preg_match("/[a-z]/i",$id)) {
//            if(empty($namClass))
//                echo '<p class="error">Please enter Class</p>';
//            if(empty($namSubject))
//                echo '<p class="error">Please enter Subject </p>';
//            if(preg_match("/[a-z]/i",$id))
//                echo '<p class="error">Please enter valid Subject id</p>';
//            exit();
//        }

        $sql = "INSERT INTO `subjectcombination` (`ClassId`, `SubjectId`) VALUES ('$namClass', '$namSubject')";
        $result=mysqli_query($conn,$sql);
        
        if (!$result) {
            echo '<script language="javascript">';
            echo 'alert("Invalid Subject name or Class name")';
            echo '</script>';
        } else{
            echo '<script language="javascript">';
            echo 'alert("Successful)';
            echo '</script>';
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/form.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="./css/font-awesome-4.7.0/css/font-awesome.css">
    <title>Add Class</title>
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
        <form action="" method="post">
            <fieldset>
                <legend>Add Class</legend>
                <div class="form-group">
                    <label for="default" class="col-sm-2 control-label">Class</label>
                    <div class="col-sm-10">
                         <select name="class" class="form-control" id="default" required="required">
                         <option value="">Select Class</option>
                                <?php $sql = "SELECT * from class";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                if($query->rowCount() > 0)
                                {
                                foreach($results as $result)
                                {   ?>
                                <option value="<?php echo htmlentities($result->id); ?>">
                                 <?php echo htmlentities($result->name); ?>&nbsp; </option>
                                <?php }} ?>
                         </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="default" class="col-sm-2 control-label">Subject</label>
                    <div class="col-sm-10">
                         <select name="subject" class="form-control" id="default" required="required">
                                <option value="">Select Subject</option>
                                <?php $sql = "SELECT * from subjects";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                if($query->rowCount() > 0)
                                {
                                     foreach($results as $result){   ?>
                                     <option value="<?php echo htmlentities($result->id); ?>">
                                    <?php echo htmlentities($result->SubjectName); ?></option>
                                    <?php }} ?>
                         </select>
                     </div>
                </div>
                                                    

                                                    
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </fieldset>        
        </form>
    </div>

    <div class="footer">
        <!-- <span>Designed & Coded By Jibin Thomas</span> -->
    </div>
</body>
</html>
  
