<?php
    session_start();
    include 'dbconnection.php';
    $conn=OpenCon();
    $prof=$_SESSION["pid"];
    $slotid=$_GET["slotid"];
    //  $prof=1;
    //  $slotid=1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark busy</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="bg.css">
    <link rel="stylesheet" href="mark.css">
    <link href='https://css.gg/log-out.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/faeaa9a8c9.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
        <!-- logo -->
            
<body>
<div class="background">
           
<div class="logo"><span><img src="Nitc_logo.png"> </span></div>  
<div class="cntrpanelmark">
            <div class="glass-panel" > 
                <div class="qn">
<?php
$q2 = $conn->prepare('SELECT slots.starting_time, slots.ending_time,slots.day from slots where slot_id=?');
$q2->bindParam(1,$slotid);
$q=$q2->execute();
if($row=$q->fetchArray()){
    echo "<span class='sure'><strong>Sure you want to mark $row[0]-$row[1] on $row[2] as busy?</strong></span>";
}
?>
<?php
     
     if(isset($_POST['button1'])) {
        $q2 = $conn->prepare('DELETE from freeslots where freeslots.slot_id=? and prof_id=?');
        $q2->bindParam(2,$prof);
        $q2->bindParam(1,$slotid);
        $q=$q2->execute();
        if($q)
        {
           echo "<script>alert('Slot marked as Unavailable!')</script>";
           echo "<script>window.location.href='view_booking.php'</script>";
        }
        else
        {
           echo "<script>alert('Error')</script>";
           echo "<script>window.location.href='view_booking.php'</script>";
        }
     }
     if(isset($_POST['button2'])) {
        echo "<script>alert('No changes made!')</script>";
        echo "<script>window.location.href='view_booking.php'</script>";
     }
 ?>
</div>
<div class="yesno">
<form method="post">
        <input type="submit" name="button1" class="btn btn-success" value="Yes">
         
        <input type="submit" name="button2" class="btn btn-danger" value="No">
</form>
</div>
    </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
 
</html>