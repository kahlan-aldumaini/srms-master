<?php
if(!isset($_GET['rno']))
{
	die('id is not provided');
}
//$id = $_GET['roll_?no'];
require_once 'init.php';
$rno = $_GET['rno'];
$sql = "SELECT `name`, `rno`,`class_name` FROM `students` where rno=$rno";
//$sql = "Update `students` where rno = $rno";

$result = mysqli_query($conn,$sql);

if($row = mysqli_num_rows($result) !=1)
{
		die('id not in db');

}

$row =  mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <style>
	   div.a{
		 text-align: center; 
		  background-color:#3B3B3B;
		  margin: 0px;
		   padding: 8px;
	   }
	</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" type="text/css" href="./css/form.css" media="all">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="./css/font-awesome-4.7.0/css/font-awesome.css">
    <title>Update Student</title>
</head>
<body>
        


    <div class="main">
        <form  method="post">
            <fieldset>
                <legend>Update Student</legend>
                <input type="text" name="student_name" id="name" placeholder="Student Name" value="<?= $row['name']?>">
                <input type="text" name="roll_no" id="rno" placeholder="Roll No" 
                value="<?= $row['rno']?>">
                <?php
                    include('init.php');
                    include('session.php');
                    
                    $class_result=mysqli_query($conn,"SELECT `name` FROM `class`");
                        echo '<select name="class_name">';
                        echo '<option selected disabled>Select Class</option>';
                    while($row = mysqli_fetch_array($class_result)){
                        $display=$row['name'];
                        echo '<option value="'.$display.'">'.$display.'</option>';
                    }
                    echo'</select>'
                ?>
                <input type="submit" name="editForm" value="Update"> 
                <div class="a">          
           <a href="manage_students.php" style="color: white">back</a>	
                </div>

            </fieldset>
        </form>
    </div>
<!--    <button class="btn btn-primary"><a href="manage_students.php" class="text-light">back</a>	-->
    </button>
    <?php
if(isset($_GET['rno']) && isset($_POST['editForm']))
{
	$rno = $_GET['rno'];
	$name = $_POST['student_name'];
	$rnol = $_POST['roll_no'];
	if(!isset($_POST['class_name']))
	{
		$class_name=null;
	}
	else
	{
		$class_name=$_POST['class_name'];
	}
	
	$sql="UPDATE `students` SET `name`='$name',
	`rno` = '$rno',`class_name`='$class_name' WHERE rno=$rno";
	
	if(mysqli_query($conn,$sql) === TRUE)
	{
		echo '<script language="javascript">';
               echo 'alert("Updated")';
               echo '</script>';}
}?>

    <div class="footer">
    </div>
</body>
</html>

