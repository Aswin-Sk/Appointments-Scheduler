<?php
    session_start();
    include 'dbconnection.php';
    $conn=OpenCon();
    $prof=$_SESSION["pid"];
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="bg.css">
    <link rel="stylesheet" href="busyslot.css">
    <link href='https://css.gg/log-out.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/faeaa9a8c9.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <!-- Background & animion & navbar & title -->
  <div class="container-fluid">
    <!-- Background animtion-->
        <div class="background">
           
        </div>
    <!-- header -->
       <header>
        <!-- navbar -->
     <nav>
        <div class="logout" name="View" onclick="window.location.href='view_booking.php';" formaction=# value="View" ><img src="logout.png" class="log" aria-hidden="true"></i>
        </div> 
       </nav>
    <!-- logo -->
          <div class="logo"><span><img src="Nitc_logo.png"> </span></div>
    <!-- title & content -->
          <section class="header-content">
          <h1 style="font-size:50px;">Bookings Details</h1>';
          </section>
          <div class="cntrbooking">
            <div class="glass-panel" >
                                    <?php
                    $slotid=$_GET['slotid'];
                    // echo $slotid;
                    //echo $prof;
                    $q2=$conn->prepare("select * from bookedslots where slot_id=? and prof_id=?;");
                    $q2->bindParam(2,$prof);
                    $q2->bindParam(1,$slotid);
                    $q=$q2->execute();
                    if($res=$q->fetchArray()){
                    $rollno=$res[2];
                    echo '<div class="newflex">';
                    echo "The slot has been booked by:";
                    echo"<br>";
                    echo "Roll number: ";
                    echo $rollno;
                    echo "<br>";
                    $q3=$conn->prepare("select * from student where roll_no=?;");
                    $q3->bindParam(1,$rollno);
                    $q4=$q3->execute();
                    if($re=$q4->fetchArray()){
                        echo "Name: ";
                        echo $re[2];
                        echo " ";
                        echo $re[3];
                        echo '<br>';
                        echo "Mail_address: ";
                        echo $re[4];
                        echo "<br>";
                        
                    }
                    echo "Reason: ";
                    echo $res[3];
                    echo '</div>';
                    echo '<button type="button" class="btn btn-danger"><a href="deleteBooking.php?slotid=' . $slotid. '" style="text-decoration:none; color:white;">Cancel Booking</a></button>';
                    }
                    ?>
</div>
                </div>
              </div>
      </header>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
