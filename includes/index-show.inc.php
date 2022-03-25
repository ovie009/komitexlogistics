<?php
    session_start();

    if (isset($_POST['show'])) {
        # code...
        if ($_POST['show'] == 'more') {
            # code...
            $lastDate = end($_SESSION['dateArray']);
            $previousDate = date('Y-m-d',  (strtotime($lastDate) - 86400));
            array_push($_SESSION['dateArray'], $previousDate);
            echo 'success';
        } else {
            # code...
            array_pop($_SESSION['dateArray']);
            echo 'success';
        }
    } else {
        header("location: ../index.php");
    }
?>