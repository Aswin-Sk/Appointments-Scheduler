<?php
    session_start();
    include 'dbconnection.php';
    $conn = OpenCon();
    $prof_id=$_SESSION['pid'];
    $slotid=$_GET["slotid"];

    $q2=$conn->prepare("Delete from bookedslots where slot_id=? and prof_id=?;");
    $q2->bindParam(1,$slotid);
    $q2->bindParam(2,$prof_id);
    $q=$q2->execute();
    if($q)
    {
        echo "<script>alert('Slot cancelled')</script>";
        echo "<script>window.location.href='view_booking.php'</script>";
    }
    
?>


