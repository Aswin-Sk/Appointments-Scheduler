<?php
    session_start();
    include 'dbconnection.php';
    $conn = OpenCon();
    $prof_id=$_SESSION['pid'];
    $slot_id=$_SESSION['slotid'];
    // $rollno=$_SESSION["rollno"];

    $q=$conn->prepare("Delete from bookedslots where slot_id=? and prof_id=?;");
    $q->bindParam(1,$slot_id);
    $q->bindParam(2,$prof_id);
    $q->execute();
    // $err='<p>Slot Canceled</p>'

    header('Location: ' . "view_booking.php");

    // $err="";

    // if(isset($_POST['checktt']))
    // {
    //     if(empty($_POST['slot']))
    //     {
    //         $err='<p>Select a slot to cancel</p>';
    //     }
    //     else
    //     {
    //         $q=$conn->prepare("Delete from bookedslots where slot_id=? and prof_id=?;");
    //         $q->bindParam(1,slot_id);
    //         $q->bindParam(2,$prof_id);
    //         q->execute();
    //         $err='<p>Slot Canceled</p>'
    //     }
    // }
?>

<!-- <html>
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    </head>
    <body>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <table border=1>
            <tr>
                <th class="days">DAY/SLOT</th>
                <?php
                $q=$conn->prepare("SELECT distinct starting_time,ending_time from slots");
                $res=$q->execute();
                while($row=$res->fetchArray())
                {
                    echo '<th class="days">'.$row[0].'-'.$row[1].'</th>';
                }
                ?>
            </tr>
            <?php
                $days = array("Monday","Tuesday","Wednesday","Thursday","Friday");
                $res = $conn->prepare('SELECT* from bookedslots where slot_id=? and prof_id=?');
                $slot_id=1;
                foreach($days as $day)
                {
                    echo '<tr>';
                    echo '<th>'.$day.'</th>';
                    for($i=1;$i<=8;$slot_id++)
                    {
                        $res->bindParam(1,$slot_id);
                        $res->bindParam(2,$profid);
                        $result=$res->execute();
                        if($row=$result->fetchArray())
                        {
                            echo '<td><center><input type="radio" name="slot" value="'.$slot_id.'">BOOKED</center></td>';
                        }
                        else
                        {
                            echo '<td><center>-</center></td>';
                        }
                        $i++;
                    }
                    echo '</tr>';
                }
            ?>
        </table>
        <?php echo $err; ?>

        <input type="submit" name="checktt" value="Cancel">
    
    </form>
    </body>
</html> -->
