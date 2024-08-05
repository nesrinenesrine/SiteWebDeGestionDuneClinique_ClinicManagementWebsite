<?php 
session_start();
include '../../../inc/db.php';
$id_op=$_SESSION['op_modif'];
$sql="SELECT * FROM `operation` WHERE operation.id_operation='$id_op'";
$date=" ";
if (mysqli_query($conn,$sql))
{
    $result = mysqli_query($conn,$sql);
    $operations=mysqli_fetch_all($result, MYSQLI_ASSOC);
    $date=$operations[0]['date'];
    $id_medcin=$operations[0]['id_medcin'];
    
    $_SESSION['heur']=$operations[0]['heur'];
    $_SESSION['heur_fin']=$operations[0]['heur_fin'];
    $_SESSION['id_bloq']=$operations[0]['id_bloq'];
    $_SESSION['dure']=(int)$operations[0]['heur_fin']-(int)$operations[0]['heur'];

}else 
{ 
    echo ("error" . mysqli_error($conn) );
}


if (isset($_POST['suivant'])) 
{
    $date=$_POST['date'];
    $d =strtotime( $_POST['date']);
    $day = date('l',$d);
    
        $_SESSION['date_modif']=$date;
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
                    <link rel="stylesheet" href="../../ajouter_operation/style-operation.css">
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
    
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../ajouter_operation/style-operation.css">
    <title>Document</title>
</head>
<body>
<div class="profile">
       <a href="../profil_admin.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
    <div class = "box">
         <div class="img"><img src="../../../img/logo-of-profile.svg" alt=""></div>
         <div class="rendez op">
         <h1 >Modification d'une Opération</h1> 
        <h3 >Choisissez un nouveux jour pour cette Opération</h3>
            <form action="date.php" method="POST">
                <label for="date"> date:</label>
                <input type="date" value="<?php echo $date;?>" name="date" id="date" > <br>
                <button type="submit" name="suivant"> suivant</button>
            </form>
   </div>
   </div>
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>