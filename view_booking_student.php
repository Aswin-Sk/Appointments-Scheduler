<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="bg.css">
    <link rel="stylesheet" href="view_booking_stud.css">
    <link href='https://css.gg/log-out.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/faeaa9a8c9.js" crossorigin="anonymous"></script>
    <title>My Bookings</title>
    
</head>
<body>


<div class="container-fluid">
    <!-- Background animtion-->
        <div class="background">
           
        </div>
    <!-- header -->
       <header>
    <nav>
        <div class="logout" name="View" onclick="window.location.href='function.php';" formaction=# value="View" ><img src="logout.png" class="log" aria-hidden="true"></i>
        </div> 
       </nav>
    <div class="logo"><span><img src="Nitc_logo.png"> </span></div>
    <section class="header-content;">
       <h1 style="font-size:57px;">My Bookings</h1>';
       </section>




    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    
    </form>
    
</body>
</html>

<?php
    session_start();
    include 'dbconnection.php';
    $conn=OpenCon();
    $stud=$_SESSION["rollno"];
    echo '<div class="allmybook">';
    // echo '<p class="bookdetails">'.$dayday.' -> ('.$starttime.'-'.$endtime.') -> '.$firstn.' '.$secondn.'</p>';
    echo '<table border=2 id="bookdetails">';
    echo '<tr><th>Day</th><th>Time</th><th>Professor Name</th></tr>';
    for($i=1;$i<=40;$i++){
        $q2=$conn->prepare("select * from bookedslots where slot_id=? and roll_no=?");
        $q2->bindParam(2,$stud);
        $q2->bindParam(1,$i);
        $q=$q2->execute();
        
        while($r=$q->fetchArray()){
            $q3=$conn->prepare("select prof_id,first_name,second_name from professor where prof_id=?");
            $q3->bindParam(1,$r[1]);
            $q4=$q3->execute();
            if($s=$q4->fetchArray()){
                $firstn=$s[1];
                $secondn=$s[2];
            }
            $q5=$conn->prepare("select day,starting_time,ending_time from slots where slot_id=?");
            $q5->bindParam(1,$i);
            $q6=$q5->execute();
            if($t=$q6->fetchArray()){
                $dayday=$t[0];
                $starttime=$t[1];
                $endtime=$t[2];
            }
            echo '<tr><center>';
            echo '<td>'.$dayday.'</td>';
            echo '<td>'.$starttime.'-'.$endtime.'</td>';
            echo '<td>'.$firstn.' '.$secondn.'</td>';
            echo '</tr>';
            
        }  
        
        
    }
    echo '</div>';
    echo '</table>';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

