<?php 
session_start();
include '../../inc/db.php';
if (!isset($_SESSION['userId'],$_SESSION['id_specialite'],$_SESSION['id_medcin']))
{
    header("location:../index.php");
}
else{
    $err=" ";
    $jour1="";
    $jour2="";
    $jour3="";
    $jour4="";
    $jour5="";
    $anne=date("y")+2000 ;
    $date_aujour=$anne."-".date("m-d");
    
    $id_jour_rdv= $_SESSION['id_jour_rdv'];

    if (isset($_POST['suivant']))
    {
        if($_POST['date'] >= $date_aujour)
        {
            $_SESSION['date']=$_POST['date'];
            $d =strtotime( $_POST['date']);
            $jour = date('l',$d);
            $_SESSION['jour']=$jour; 
    
            $sql_date="SELECT * 
            FROM `jour_de_rdv` 
            WHERE id_jour_rdv='$id_jour_rdv';";
    
            if (mysqli_query($conn,$sql_date))
            {
                $result = mysqli_query($conn,$sql_date);
                $dates=mysqli_fetch_all($result, MYSQLI_ASSOC);
            }else 
            { 
                echo ("error" . mysqli_error($conn) );
            }
            foreach($dates as $date)
            {
                if($date[$jour]==1)
                {
                    header("location:heur.php");
                    exit();
                }
                else 
                {
                    $err='Date ne convien pas au medecin choisire des date relative au jours suivant';
                    foreach($dates as $date) {
                        if($date["Sunday"]==1)
                        {
                            $jour1 = ",dimanche";
                        }
                        elseif($date["Monday"])
                        {
                            $jour2 = ",lundi";
                        }
                        elseif($date["Tuesday"])
                        {
                            $jour3= ",mardi";
                        }
                        elseif($date["Wednesday"])
                        {
                            $jour4= ",mercredi";
                        }
                        elseif($date["Thursday"])
                        {
                            $jour5=",jeudi";
                        }

                    }
                }
            }
        }else{ $err='Vous devez choisire une date valable';}
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
<div class = "box">
         <div class="img"><img src="../../img/logo-of-profile.svg" alt=""></div>
         <div class="rendez">
        <h1 >Prendre votre rendez-vous</h1> 
        <h3 >Choisissez un jour pour votre rendez-vous</h3>
        <form action="date.php"    method="POST"  class ="formulaire">
        <input id="date" type="date"  name = "date" value="<?php echo $date_aujour; ?>"     class ="zone_de_choix" > <br>

        <span> <?php echo $err.$jour1.$jour2.$jour3.$jour4.$jour5 ;?> </span>

        <div class="link2">
        <button type="submit" name="suivant"  id= "suivant">suivant</button>
        </div>
        

        <div class="link">
        <a href="medcin.php" id="precedant">précédent</a>
        </div>
    </form>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  
</body>
</html>