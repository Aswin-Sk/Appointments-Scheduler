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
            $err .= '<p>Enter the Reason for booking</p>';
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
                header('Location: ' . "booking.php");
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
    </head>
    <body>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
            <table border=1>
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
                                echo '<td><center><input type="radio" name="slot" value="'.$slot_id.'">AVAILABLE</center></td>';
                            }
                            else
                            {
                                echo '<td><center>BOOKED</center></td>';
                            }
                            $i++;
                        }
                        echo '</tr>';
                    }
                ?>
            </table>
            <label>Reason of Appointment: <input type="text" name="reason"></label>
            <?php echo $err; ?>
            <input type="submit" name="checktt" value="Book">
        </form>
    </body>
</html>