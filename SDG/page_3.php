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

      <a href="page_2.php" class="btn btn-outline-success my-2 my-sm-0 mr-3" style="color: red"><b>Home</b></a>
      <a href="page_4.html" class="btn btn-outline-success my-2 my-sm-0 mr-4" style="color: red"><b>Apply Here!</b></a>
    </form>
   <a href="#"><i class="fa fa-fw fa-user mr-3"></i> </a>
  </div>

</nav>
<br><br>
<h1 align="center" style="color: red">Your Internship Details</h1><br>


<div class="container">
                <div class="row">
            <?php
                include("connect.php");
                if(isset($_GET['id'])){
                    $rollId=$_GET['p_id'];
                    $topicId=$_GET['id'];
                    $sql = "SELECT * FROM internship_data WHERE internship_data.topic = '$topicId' AND internship_data.roll_no = '$rollId' ";
                    $result = $conn->query($sql);
                    $data = mysqli_fetch_array($result);
                }
                

            ?>

                    <div class="col-lg-12 white a" style="color: red"><b>
                        <br><br>
                        Id: <?php echo $data['id']?><br><br>
                        Topic: <?php echo $data['topic']?><br><br>
                        Year: <?php echo $data['year_new'] ?><br><br>
                        Duration: <?php echo $data['duration'] ?><br><br>
                        Start & End Date: <?php echo $data['starting_date'] ?> to <?php echo $data['end_date'] ?><br><br>
                        Approval Status: <?php echo $data['approval_status'] ?><br><br>
                        Completion Status: <?php echo $data['completion_status'] ?><br><br>
                        Comment: <?php echo $data['comment'] ?><br><br>
                        <form action = "certificate.php" method = "POST" enctype="multipart/form-data">
                        <?php 
                          $_SESSION['id'] = $data['id'];
                          $_SESSION['roll_no'] = $data['roll_no']; 
                        ?>               
                        <label for="certificate">Upload Certificate here:</label>
                        <input type="file" id="certificate" name="certificate" multiple><br><br>   
                        <input type="submit" name="submit"> 
                        </form><br></b>
                    </div>                    
                </div>
            </div>
</body>
</html>