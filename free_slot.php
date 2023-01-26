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
    <link href='https://css.gg/log-out.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/faeaa9a8c9.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Background & animion & navbar & title -->
  <div class="container-fluid">
    <!-- Background animtion-->
        <div class="background">
           <div class="cube"></div>
           <div class="cube"></div>
           <div class="cube"></div>
           <div class="cube"></div>
          <div class="cube"></div>
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
          </section>
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
                    echo "The slot has been booked by:";
                    echo"\n";
                    echo "Roll number:";
                    echo "\n";
                    echo $rollno;
                    echo "\n";
                    $q3=$conn->prepare("select * from student where roll_no=?;");
                    $q3->bindParam(1,$rollno);
                    $q4=$q3->execute();
                    if($re=$q4->fetchArray()){
                        echo "Name:";
                        echo $re[2];
                        echo " ";
                        echo $re[3];
                        echo "\n";
                        echo "Mail_address:";
                        echo $re[4];
                        echo "\n";
                        
                    }
                    echo "Reason:"."\n";
                    echo $res[3];
                    echo '<button><a href="deleteBooking.php?slotid=' . $slotid. '" style="text-decoration:none; color:red;">Cancel Booking</a></button>';
                    }
                    ?>

                </div>
              </div>
      </header>
    </div>
</body>
</html>
