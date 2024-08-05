<?php 
session_start();
include '../../inc/db.php';
$id_medcin=$_SESSION['id_medcin'];
$id_patient=$_SESSION['id_patient'];

$err_date_vid="";
$err_date="";
$err="";

if (isset($_POST['suivant'])) 
{
    $date=$_POST['date'];
    $d =strtotime( $_POST['date']);
    $day = date('l',$d);
    if(!empty($date))
    {
        $_SESSION['date']=$date;
        $sql="SELECT * FROM jour_de_rdv WHERE jour_de_rdv.id_jour_rdv = 
        (SELECT id_jour_rdv FROM medcin WHERE medcin.id_medcin='$id_medcin')";

        if (mysqli_query($conn,$sql))
        {
            $result = mysqli_query($conn,$sql);
            $jours=mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach($jours as $jour)
            { 
                if($jour[$day]==1)
                {
                    echo '<head>
                    <link rel="stylesheet" href="./style-operation.css">
                    </head>
                    <div class="err">
                            <form action="date.php" method="POST">
                                <p> la date convient au jour de rdv de medcin choisire une autre date </p>
                                <button type="submit" name="reessayer" value="reessayer"> reessayer </button> 
                            </form>
                         </div>';
                    if(isset($_POST['reessayer']))
                    {
                        header("location:date.php");
                    }
                }
                else
                {
                    header("location:./heur.php");
                }
            }
            exit();
        }
        else 
        { 
            echo ("error" . mysqli_error($conn) );
        }
    }else
    {
        $err="vous dever saisire une datte";
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style-operation.css">
    <title>Document</title>
</head>
<body>
<div class="profile">
       <a href="../profile_admin/profil_admin.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
<div class = "box">
         <div class="img"><img src="../../img/logo-of-profile.svg" alt=""></div>
         <div class="rendez op">
        <h1 >Organisation d'une Opération</h1> 
        <h3 >Choisissez un date pour cette Opération</h3>
            <form action="date.php" method="POST">
                <label for="date">date </label>
                <input type="date" value="" name="date" id="date" > <br>
                <button type="submit" name="suivant"> Suivant</button>
            </form>
            <span> <?php echo $err_date_vid;?> </span>
            <span> <?php echo $err;?> </span>
        </div>
   
</div>
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>