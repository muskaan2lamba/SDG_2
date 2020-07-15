
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Internship Homepage</title>
  <link rel="stylesheet" href="css/page_2.css">
  <script src="https://kit.fontawesome.com/dc6b196a84.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
      <a href="#" class="navbar-brand mr-3"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
      <h4 style="color:white;">internship</h4>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ml-auto">
          <a href="#" class="nav-item nav-link">Logout</a>
        </div>
      </div>
    </div>
  </nav>

  <nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
      <h3 class="navbar-brand">RAIT Internships</h3>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ml-auto">
          <a href="#" class="nav-item nav-link"><button type="button" class="btn btn-outline-secondary btn-sm">Admin</button></a>
          
          <a href="#" class="nav-item nav-link"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
         
        </div>
      </div>
    </div>
  </nav>



  <section id="main">

    <h2 class="h2">List of internships for approval</h2>

    <div>
        <button class="btn btn-primary filter-button" data-filter="all">All</button>
        <button class="btn btn-default filter-button" data-filter="Pending">Approval</button>
        <button class="btn btn-default filter-button" data-filter="in-progress">In Progress</button>
        <button class="btn btn-default filter-button" data-filter="Completed">Completed</button>
        <button class="btn btn-default filter-button" data-filter="Rejected">Rejected</button>
    </div>

    <div class="row">

    <?php
					include("connect.php");
          $sql = "SELECT * FROM internship_data";
          $result = $conn->query($sql);       

          if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc())
					{					    
            
					?>
            <div class="col-lg-3 col-md-6 pricing-column filter <?php echo $row['approval_status']; ?> <?php echo $row['completion_status']; ?>">
              <div class="card">
                <a href="admin_2.php?id=<?php echo $row['topic'];?>& p_id=<?php echo $row['roll_no'];?>">
                  <div class="card-header">
                    <h3 class="h3">Internship I</h3>
                  </div>
                  <div class="card-body">
                    <p>
                      <img src="images/internship.jpg" width="102%" height="145%">
                    </p>
                    <h3>Roll No : <?php echo $row['roll_no']; ?></h3>
                    <h3>Topic : <?php echo $row['topic']; ?></h3>
                    <h3>Year: <?php echo $row['year_new']; ?></h3>
                  </div>
                </a>
              </div>
            </div>

            <?php  
            }
            
            } else { echo "0 internships for approval"; }
            $conn->close();	
            ?>
    </div>

  </section>

  <script>
  $(document).ready(function(){

$(".filter-button").click(function(){
    var value = $(this).attr('data-filter');

    if(value == "all")
    {
        //$('.filter').removeClass('hidden');
        $('.filter').show();
    }
    else{
    
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
        $(".filter").not('.'+value).hide();
        $('.filter').filter('.'+value).show();
        
    }
});

});
</script>


</body>

</html>