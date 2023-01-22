<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="bg.css">
    <link href='https://css.gg/log-out.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/faeaa9a8c9.js" crossorigin="anonymous"></script>
</head>
    <nav>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <nav>
        <ul>
          <li><a href='function.php'> &laquo Back</a></li>
         </ul>
       </nav>
</div>
    </form>
    </nav>
        <!-- logo -->
            <div class="logo"><span><img src="Nitc_logo.png"> </span></div>
<style>
<?php include 'tt.css'; ?>

</style>
</html>
<?php
    session_start();
    include 'dbconnection.php';
    $conn=OpenCon();
    $prof=$_SESSION["pid"];

    $days = array("Monday","Tuesday","Wednesday","Thursday","Friday");
    $all_slots = array("8-9 AM","9-10 AM","10:15-11:15 AM","11:15-12:15 PM","1-2 PM","2-3 PM","3-4 PM","4-5 PM");

    echo "<html><body><center><justify><table class='table1'cellspacing=0 cellpadding=0>";
    echo "<h1>MY TIMETABLE</h1>";
    echo '<tr><center>';
    echo '<th class="days"><center>' . "DAY/SLOT" . '</center></th>';

    foreach($all_slots as $s) 
    {
        echo '<th class="days"><center>' . $s . '</center></th>';
    }
    echo '</center></tr>';
    $slotid=1;
    foreach($days as $day)
    {
        echo '<tr">';
        echo '<td  class="days">' . $day. '</td>';
        $cl=0;

        for($i=1;$i<=8;$slotid++)
        {
            $i++;
            //$sql="select * from proftt where slot_id=? and prof_id=?";
            //echo $prof;
            $q2=$conn->prepare("select * from proftt where slot_id=? and prof_id=?");
            $q2->bindParam(1,$prof);
            $q2->bindParam(2,$slotid);
            $q=$q2->execute();
            $flag=0;
            while($q->fetchArray())
            {
                echo '<span style="color=#FF0000"><td  class="t2">' ."Booked Slot". '</td></span>';
                $flag=1;
            }
            if($flag==0)
            {
                echo '<td  class="t2">' ."Free Slot". '</td>';
            }
        }
        echo '</tr>';
    }
?>