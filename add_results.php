<?php
include('init.php');
include('session.php');
error_reporting(0);
if (isset($_POST['class'],$_POST['studentid'],$_POST['marks'])) {
   $marks=array(); 
$class=$_POST['class'];
$studentid=$_POST['studentid'];

$mark=$_POST['marks'];

 $stmt = $dbh->prepare("SELECT subjects.SubjectName,subjects.id FROM subjectcombination join  subjects on  subjects.id=subjectcombination.SubjectId WHERE subjectcombination.ClassId=:cid order by subjects.SubjectName");
 $stmt->execute(array(':cid' => $class));
  $sid1=array();
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {

array_push($sid1,$row['id']);
   } 
  
for($i=0;$i<count($mark);$i++){
    $mar=$mark[$i];
  $sid=$sid1[$i];
$sql="INSERT INTO  result(rno,ClassId,SubjectId,marks) VALUES(:studentid,:class,:sid,:marks)";
$query = $dbh->prepare($sql);
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Result info added successfully";
}
else 
{
$error="Something went wrong. Please try again";
}
}}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/home.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="./css/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="./css/form.css">
     
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
            <legend>Enter Marks</legend>
            
               <div class="form-group">
               <label for="default" class="col-sm-2 control-label">Class</label>
                 <div class="col-sm-10">
                     <select name="class" class="form-control clid" id="classid" onChange="getStudent(this.value);" required="required">
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
                <label for="date" class="col-sm-2 control-label ">Student Name</label>
                    <div class="col-sm-10">
                        <select name="studentid" class="form-control stid" id="studentid" required="required" onChange="getresult(this.value);">
                        </select>
                    </div>
                </div>

                <div class="form-group">

                    <div class="col-sm-10">
                        <div  id="reslt">
                        </div>
                    </div>
                </div>
                                                    
                <div class="form-group">
                 <label for="date" class="col-sm-2 control-label">Subjects</label>
                    <div class="col-sm-10">
                        <div  id="subject">
                        </div>
                    </div>
                </div>


                                                    
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Declare Result</button>
                    </div>
                </div>

               
            </fieldset>
        </form>
    </div>
   <script src="css/modernizr/modernizr.min.js"></script>
    <script>
function getStudent(val) {
    $.ajax({
    type: "POST",
    url: "get_student.php",
    data:'classid='+val,
    success: function(data){
        $("#studentid").html(data);
        
    }
    });
$.ajax({
        type: "POST",
        url: "get_student.php",
        data:'classid1='+val,
        success: function(data){
            $("#subject").html(data);
            
        }
        });
}
    </script>
<script>

function getresult(val,clid) 
{   
    
var clid=$(".clid").val();
var val=$(".stid").val();;
var abh=clid+'$'+val;
//alert(abh);
    $.ajax({
        type: "POST",
        url: "get_student.php",
        data:'studclass='+abh,
        success: function(data){
            $("#reslt").html(data);
            
        }
        });
}
</script>
</body>
</html>

