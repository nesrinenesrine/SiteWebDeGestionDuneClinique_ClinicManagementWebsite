<!-- heur_modif.php
Who has access
N
System properties
Type
PHP
Size
2 KB
Storage used
2 KB
Location
modif_rdv
Owner
Nesrine Ait said
Modified
3 Jun 2022 by Nesrine Ait said
Opened
06:20 by me
Created
00:34
No description
Viewers can download -->
<?php 
session_start();
if (!isset($_SESSION['userId']) )
{
    
    header("location:../index.php");
}
else{
    include '../../inc/db.php';
    $id_specialite= $_SESSION['id_specialite_modif'];
    $id_medecin=$_SESSION['medecin_modif'];
    $date=$_SESSION['date_modif'];
    $id_rdv=$_SESSION['id_rdv'];

    $sql_time="SELECT *
                FROM rdv
                WHERE id_medcin ='$id_medecin' AND   date='$date'";

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
            $id_time= $_POST['submit'];
            echo $id_medecin;
            echo $id_specialite;
            echo $date;

            $sql_update="UPDATE `rdv` 
            SET `date`='$date',`id_medcin`='$id_medecin',`id_time`='$id_time',`etat_rdv`='0' 
            WHERE rdv.id_rdv='$id_rdv'";
            if (mysqli_query($conn,$sql_update))
            {
                header("location:../profile.php");
                exit();
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
    <link rel="stylesheet" href="../rendez_vous/style-rendezvous.css">
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

          <form action="heur_modif.php" method="POST">
     
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
             <button type="submit" name="submit" value= "<?php echo $time['id_time']; ?>"><?php echo $time['time']; ?></button>
         <?php endif ?>
     <?php endforeach ?>
    
      </form>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
   
</body>
</html>

