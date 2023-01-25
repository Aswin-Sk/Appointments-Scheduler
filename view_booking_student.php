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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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
    $stud=$_SESSION["rollno"];

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
            echo '<p class="container">'.$dayday.' -> ('.$starttime.'-'.$endtime.') -> '.$firstn.' '.$secondn.'</p><br>';
        }  
        
    }

    // $days = array("Monday","Tuesday","Wednesday","Thursday","Friday");
    // $all_slots = array("8-9 AM","9-10 AM","10:15-11:15 AM","11:15-12:15 PM","1-2 PM","2-3 PM","3-4 PM","4-5 PM");

    // echo "<html><body><center><justify><table class='table1'cellspacing=0 cellpadding=0>";
    // echo "<h1>MY TIMETABLE</h1>";
    // echo '<tr><center>';
    // echo '<th class="days"><center>' . "DAY/SLOT" . '</center></th>';

    // foreach($all_slots as $s) 
    // {
    //     echo '<th class="days"><center>' . $s . '</center></th>';
    // }
    // echo '</center></tr>';
    // $slotid=1;
    // foreach($days as $day)
    // {
    //     echo '<tr">';
    //     echo '<td  class="days">' . $day. '</td>';
    //     $cl=0;

    //     for($i=1;$i<=8;$slotid++)
    //     {
    //         $i++;
    //         //$sql="select * from proftt where slot_id=? and prof_id=?";
    //         //echo $prof;
    //         $q2=$conn->prepare("select * from freeslots where slot_id=? and roll_no=?");
    //         $q2->bindParam(2,$stud);
    //         $q2->bindParam(1,$slotid);
    //         $q=$q2->execute();
    //         $flag=0;
    //         while($r=$q->fetchArray())
    //         {
    //             echo '<td class="t1"><a href="mark_busy.php?slotid=' . $slotid. '" style="text-decoration:none; color:red;">' . "-" . '</a></td>';
    //             $flag=1;
    //         }   
    //         if($flag==0)
    //         {
    //             $q3=$conn->prepare("select * from bookedslots where slot_id=? and roll_no=?");
    //             $q3->bindParam(2,$stud);
    //             $q3->bindParam(1,$slotid);
    //             $q4=$q3->execute();
    //             $flag2=0;
    //             while($r=$q4->fetchArray()){
    //                 echo '<td class="t2"><a href="free_slot.php?slotid=' . $slotid. '" style="text-decoration:none; color:red;">' . $prof_id . '</a></td>';
    //                 $flag2=1;
    //             }
    //             if($flag2==0){
    //                 echo '<td class="t3">'."Class Slot".'</td>';
    //             }
    //         }
    //     }
    //     echo '</tr>';
    
?>