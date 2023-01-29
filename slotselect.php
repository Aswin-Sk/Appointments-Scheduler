<?php
    session_start();
    include 'dbconnection.php';
    $conn = OpenCon();
    $prof_id = $_SESSION['prof'];
    $rollno = $_SESSION["rollno"];

    $err = "";

    if(isset($_POST['checktt']))
    {
        $flag = 0;
        if(empty($_POST['slot']))
        {
            $err .= '<p>Select a Slot</p>';
            $flag = 1;
        }
        if(empty($_POST['reason']))
        {
            $err .= '<p style="color:red;text-align:center;">Enter the Reason for booking</p>';
            $flag = 1;
        }
        if($flag == 0)
        {
            $q = $conn->prepare("Select* from bookedslots where roll_no=? and slot_id=?");
            $q->bindParam(2,$_POST['slot']);
            $q->bindParam(1,$rollno);
            $q1=$q->execute();
            if($row=$q1->fetchArray())
            {
                $err .= "<p>You have another booking at this slot</p>";
            }
            else
            {
                $q = $conn->prepare("INSERT into bookedslots values (?,?,?,?);");
                $q->bindParam(1,$_POST['slot']);
                $q->bindParam(2,$prof_id);
                $q->bindParam(3,$rollno);
                $q->bindParam(4,$_POST['reason']);
                $q->execute();
                $q = $conn->prepare("Delete from freeslots where slot_id=? and prof_id=?;");
                $q->bindParam(1,$_POST['slot']);
                $q->bindParam(2,$prof_id);
                $q->execute();
                $err = '<p>BOOKED</p>';
                header('Location: ' . "function.php");
            }
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="bg.css">
        <link rel="stylesheet" href="makebooking.css">
        <link rel="stylesheet" href="tt.css">
        <link rel="stylesheet" href="slotselecttt.css">
        <title>Slots</title>

    </head>
    <body>
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
       <h1 style="font-size:57px;">TIMETABLE</h1>';
       </section>
       <div class="ttform">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
        
            <table id="tttable">
                <tr>
                    <th class="days">DAY/SLOT</th>
                    <?php
                        $q=$conn->prepare("SELECT distinct starting_time,ending_time from slots");
                        $res = $q->execute();
                        while($row = $res->fetchArray())
                        {
                            echo '<th class="days">'.$row[0].'-'.$row[1].'</th>';
                        }
                    ?>
                </tr>
                <?php
                    $days = array("Monday","Tuesday","Wednesday","Thursday","Friday");
                    $res = $conn->prepare('SELECT* from freeslots where slot_id=? and prof_id=?');
                    $slot_id=1;
                    foreach($days as $day)
                    {
                        echo '<tr>';
                        echo '<th>'.$day.'</th>';
                        for($i=1;$i<=8;$slot_id++)
                        {
                            $res->bindParam(1,$slot_id);
                            $res->bindParam(2,$prof_id);
                            $result = $res->execute();
                            if($row = $result->fetchArray())
                            {
                                // echo '<td>'.$slot_id.'</td>';
                                echo '<td style="color:green;"><center> <label> <input type="radio" name="slot" value="'.$slot_id.'">AVAILABLE </label></center></td>';
                            }
                            else
                            {
                                echo '<td style="color:red;"><center>UNAVAILABLE</center></td>';
                            }
                            $i++;
                        }
                        echo '</tr>';
                    }
                ?>
            </table>
            <!-- <label>Reason of Appointment: <input type="text" name="reason"></label> -->
            <br>
            <div class="txtarea">
  <textarea name="reason" rows="4" cols="50" placeholder="Reason of Appointment:"></textarea></div>
  <br>
            <?php echo $err; ?>
            <div class="cntrbtn">
            <input class="button bookingbtn" id="hovbtn" type="submit" name="checktt" value="Book">
            </div>
        </form>
        </div>
        
    </body>
</html>