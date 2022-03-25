<?php
    session_start();

    if (isset($_POST['limit'])) {
        # code...
        if ($_POST['limit'] == 'more') {
            # code...
            $_SESSION['searchArray'] += 10;
            // $_SESSION['searchArray'] -= 4;
            echo 'success';
            
        } else {
            # code...
            $_SESSION['searchArray'] -= 10;
            echo 'success';

        }

    } else {
        header("location: ../index.php");
    }

?>