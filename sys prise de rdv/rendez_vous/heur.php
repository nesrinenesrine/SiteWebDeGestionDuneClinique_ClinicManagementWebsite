<?php 
session_start();
include '../../inc/db.php';
if (!isset($_SESSION['userId'],$_SESSION['id_specialite'],$_SESSION['id_medcin'],$_SESSION['date']))
{
    header("location:../index.php");
}
else{
    $id_specialite=$_SESSION['id_specialite'];
    $id_medcin=$_SESSION['id_medcin'];
    $id_jour_rdv=$_SESSION['id_jour_rdv'];
    $date=$_SESSION['date'];
    $id_patient=$_SESSION['userId'];

    $sql_time="SELECT *
            FROM rdv
            WHERE id_medcin ='$id_medcin' AND   date='$date'";

    if (mysqli_query($conn,$sql_time))
    {
        $result = mysqli_query($conn,$sql_time);
        $id_times=mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else 
    { 
        echo ("error" . mysqli_error($conn) );
    }

    $sql="SELECT *FROM time ";
    if (mysqli_query($conn,$sql))
    {
        $result = mysqli_query($conn,$sql);
        $times=mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else 
    { 
        echo ("error" . mysqli_error($conn) );
    }



    if(isset($_POST['submit'])) 
    {
        $id_time=$_POST['submit'];
        echo $id_time;
        $sql_rdv="INSERT INTO rdv ( `date`, `id_patient`, `id_medcin`, `id_time`,`etat_rdv`)
                VALUES('$date','$id_patient','$id_medcin','$id_time',0)";
        if (mysqli_query($conn,$sql_rdv))
        {
            header("location:../profile.php");
            echo "succ";
        }else 
        { 
            echo ("error" . mysqli_error($conn) );
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-rendezvous.css">
    <title>Document</title>
</head>
<body>
<div class="profile">
       <a href="../profile.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
<div class="box">
    <div class="img"><img src="../../img/logo-of-profile.svg" alt=""></div>
      <div class="rendez-heure">
          <div class="header1">
             <h1>Prendre votre rendez-vous</h1> 
             <h3 >Choisissez une heure pour votre rendez-vous</h3>
          </div>

       <form action="heur.php" method="POST">
         <?php foreach($times as $time):
            $b=true;
             foreach($id_times as $id)
           {
            if($time['id_time']==$id['id_time'])
             {
                $b=false;
             }
           }
          if($b==true):?>
            <button  class ="button-time" type="submit" name="submit" value= "<?php echo $time['id_time']; ?>"><?php echo $time['time']; ?></button>
        <?php endif ?>
         <?php endforeach ?>
    
      </form>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  
</body>
</html>