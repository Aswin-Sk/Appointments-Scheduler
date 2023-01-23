<?php
    session_start();
    include 'dbconnection.php';
    $conn=OpenCon();
    $prof=$_SESSION["pid"];
    $slotid=$_GET["slotid"];
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
    <link href='https://css.gg/log-out.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/faeaa9a8c9.js" crossorigin="anonymous"></script>
</head>
        <!-- logo -->
            <div class="logo"><span><img src="Nitc_logo.png"> </span></div>
</html>
<?php
$q2 = $conn->prepare('DELETE from freeslots where freeslots.slot_id=? and prof_id=?');
$q2->bindParam(2,$pid);
$q2->bindParam(1,$slotid);
$q=$q2->execute();
if($q)
{
    
    echo "<script>alert('Slot marked as busy')</script>";
    echo "<script>window.location.href='view_booking.php'</script>";
}
else
{
    echo "<script>alert('Error')</script>";
    echo "<script>window.location.href='view_booking.php'</script>";
}
?>