<?php
session_start();
include("connect.php");
$roll_no = $_POST['roll_no'];
$topic = $_POST['topic'];
$year = $_POST['year'];
$duration = $_POST['duration'];
$starting_date = date('Y-m-d', strtotime($_POST['start_date']));
$end_date = date('Y-m-d', strtotime($_POST['end_date']));
$myfile = $_POST['myfile'];

if(!empty($myfile)){    
    include('upload.php');
}

if(!empty($roll_no) || !empty($topic) || !empty($year) || !empty($duration) || !empty($start_date) || !empty($end_date)){
        
        $INSERT = "INSERT Into internship_data(roll_no,topic,year_new,starting_date,end_date,approval_status,completion_status,certificate,duration,myfile,comment) values (?,?,?,?,?,'Pending','None','Not Uploaded Yet',?,?,'No comment')";


        //Prepare statement
        $stmt = $conn->prepare("SELECT topic,roll_no From internship_data Where topic = ? AND roll_no = ? Limit 1");
        $stmt->bind_param("ss",$topic,$roll_no);
        $stmt->execute();
        
        $stmt->store_result();
        
        $rnum = $stmt->num_rows;
        
        if($rnum==0){
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssissis",$roll_no,$topic,$year,$starting_date,$end_date,$duration,$myfile);
            $stmt->execute();
            echo "Applied Successfully";
        }else{
            echo "Already Applied for this internship";
        }
        $stmt->close();
        $conn->close();
        
    
}
else{
    echo "All field are required";
    die();
}
?>

<?php
include ('connect.php');
$roll_no = $_POST['roll_no'];
$topic = $_POST['topic'];
$year = $_POST['year'];
$duration = $_POST['duration'];
$starting_date = date('Y-m-d', strtotime($_POST['start_date']));
$end_date = date('Y-m-d', strtotime($_POST['end_date']));

$INSERT = "INSERT Into internship_data(roll_no,topic,year_new,starting_date,end_date,approval_status,completion_status,certificate,duration,myfile,comment) values (?,?,?,?,?,'Pending','None','Not Uploaded Yet',?,'','No comment')";
				
	
				$stmt = $conn->prepare("SELECT topic,roll_no From internship_data Where topic = ? AND roll_no = ? Limit 1");
				$stmt->bind_param("ss",$topic,$roll_no);
				$stmt->execute();
				
				$stmt->store_result();
				
				$rnum = $stmt->num_rows;
				
				if($rnum==0){
					echo "Hi";
					$stmt = $conn->prepare($INSERT);
					$stmt->bind_param("ssissi",$roll_no,$topic,$year,$starting_date,$end_date,$duration);
					$stmt->execute();
					echo "Applied Successfully";
				}else{
					echo "Already Applied for this internship";
				}
				$stmt->close();
				$conn->close();


if(isset($_FILES['myfile'])){
	echo $roll_no;
	uploadfile('myfile',$roll_no,$topic);
}




function uploadfile($myfile,$rollno,$topic)
{
	
	$file=$_FILES[$myfile];
	$filename=$myfile;
	echo $filename;
	
	//FILE PROPERTIES
	$file_name=basename($file['name']);
	echo $file_name;
	$file_tmp=$file['tmp_name'];
	$file_size=$file['size'];
	$file_error=$file['error'];
	$file_ext=explode('.',$file_name);
	$file_ext=strtolower(end($file_ext));
	$allowed=array('pdf');
	if(in_array($file_ext,$allowed))
	{
		if($file_error===0)
		{
			
			//$songname=$_POST['songname'];
			//$cat_name=$_POST['categoryname'];
			//$artistname=$_POST['artistname'];
			   
			//preg_replace('/\s+/', '', $rollno).;
			$file_dir = '/opt/lampp/htdocs/SDG/uploads/';
			$file_name_new=$file['name'];
			$file_dest= $file_dir.$rollno.'/'.$file_name_new;
			$filepath= $file_dir.$rollno;
			
			if ( ! is_dir($filepath)) 
			{
				echo $filepath;
				mkdir($filepath);
			}
			if(move_uploaded_file($file_tmp,$file_dest))
			{
				include ('connect.php');
				echo '<div class="box box-danger" style="width:33%;margin-left:33%;margin-top:10%">
				  <div class="box-header with-border">
					<center><h3 class="box-title">Upload Status</h3></center>
					<!-- /.box-tools -->
				  </div><!-- /.box-header -->
				  <div class="box-body">';
				echo '<center>';
				echo '"'.$filename.'"'.' document was successfully uploaded.<br>';
				echo '</center></div></div>';
				echo '</div>';
				$sql="INSERT INTO `internship_data`(`myfile`) VALUES ('$file_name')";
				mysqli_query($conn,$sql);
			}
					
		}
	}
}
// page_3.php
<?php
            if (isset($_POST['completestat'])) {                
              mysqli_query($conn,"UPDATE internship_data SET completion_status = '".$_POST['completestat']."'
              WHERE internship_data.roll_no = '$rollId' AND internship_data.topic = '$topicId'");
              header('location:page_2.php');
            }
            ?>
?>

