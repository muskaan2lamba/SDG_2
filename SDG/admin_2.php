<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>RAIT</title>
	<link rel="stylesheet" type="text/css" href="css/page_4.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
	.pink {
		background: #fac093;
		
	}
	.white {
		background: white;
		border: 1px solid purple;
	}
	div.a{
		font-size: 18px;
	}

</style>
</head>
<body class="pink">
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#" style="color: red"><b>RAIT Internships</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      </ul>
    <form class="form-inline my-2 my-lg-0">

      <a href="admin_1.php" class="btn btn-outline-success my-2 my-sm-0 mr-3" style="color: red"><b>Admin</b></a>
      
    </form>
   <a href="#"><i class="fa fa-fw fa-user mr-3"></i> </a>
  </div>

</nav>
<br><br>
<h1 align="center" style="color: red">Internship Details</h1><br>


<div class="container">
                <div class="row">
            <?php
                include("connect.php");
                if(isset($_GET['id'])){
                    $topicId=$_GET['id'];
                    $rollId=$_GET['p_id'];
                    $sql = "SELECT * FROM internship_data WHERE internship_data.topic = '$topicId' AND internship_data.roll_no = '$rollId'";
                    $result = $conn->query($sql);
                    $data = mysqli_fetch_array($result);
                }

            ?>

                    <div class="col-lg-12 white a" style="color: red"><b>
                        <br><br>
                        Roll No: <?php echo $data['roll_no']?><br><br>
                        Topic: <?php echo $data['topic']?><br><br>
                        Year: <?php echo $data['year_new'] ?><br><br>
                        Duration: <?php echo $data['duration'] ?> months<br><br>
                        Start & End Date: <?php echo $data['starting_date'] ?> to <?php echo $data['end_date'] ?><br><br>
                        <?php
                        if($data['approval_status'] == 'Pending'){
                        ?>
                          <a href="<?php echo $data['myfile']; ?>"><button class="btn btn-primary">Additional Documents</button></a><br><br>
                        <?php  
                        }
                        ?>
                        
                        <form method = "POST">
                          <input type="text" placeholder = "Comments" name="comments"><br><br>
                          <button id="apprrovalstat" name="apprrovalstat" value = "Approved" type="submit" style="margin-left: 5%">Approved</button>
                          <button id="apprrovalstat" name="apprrovalstat" value = "Rejected" type="submit" style="margin-left: 1%" >Rejected</button>
                        </form><br></b>
             <?php
            if (isset($_POST['apprrovalstat'])) {   
              if($_POST['apprrovalstat']=='Approved'){
                mysqli_query($conn,"UPDATE internship_data SET completion_status = 'in-progress',approval_status = '".$_POST['apprrovalstat']."',comment = 'Applied Successfully'
                WHERE internship_data.roll_no = '$rollId' AND internship_data.topic = '$topicId'");
                header('location:admin_1.php');
              }else{
                mysqli_query($conn,"UPDATE internship_data SET approval_status = '".$_POST['apprrovalstat']."',comment = '".$_POST['comments']."'
                WHERE internship_data.roll_no = '$rollId' AND internship_data.topic = '$topicId'");
                header('location:admin_1.php');
              }             
              
            }
            ?>
                    </div>
                    
                </div>
            </div>
</body>
</html>