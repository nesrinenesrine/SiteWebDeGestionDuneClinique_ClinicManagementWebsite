<?php
include '../inc/db.php';


if (isset($_POST["submit"])) {

      $feedback = $_POST["react"];

      $sql ="INSERT INTO `feedback`(feed) VALUES('$feedback')" ;
      if(mysqli_query($conn , $sql))
      {
          
         header("location:./profile.php");
        

      }else {
          echo 'ERROR' . mysqli_error($conn);
      }
}



?>
