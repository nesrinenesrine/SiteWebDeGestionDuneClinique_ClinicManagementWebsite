<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include '../../inc/db.php';
$id=$_SESSION['id_medecin'];

$sql_rdv="SELECT * FROM `rdv` 
JOIN patient ON rdv.id_patient = patient.id_patient 
WHERE rdv.id_medcin = '$id';";
if (mysqli_query($conn,$sql_rdv))
{
    $result = mysqli_query($conn,$sql_rdv);
    $rdvs=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

$sql_operation="SELECT * FROM `operation` 
JOIN patient ON operation.id_patient = patient.id_patient 
WHERE operation.id_medcin = '$id';";
if (mysqli_query($conn,$sql_operation))
{
    $result = mysqli_query($conn,$sql_operation);
    $operations=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style-fichierpat.css">
    <title>fiche medecin</title>
</head>
<body>
<div class="profile">
       <a href="./profile-chef.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
    <div class="fiche">
    <form action="fiche_medecin.php" method="post">
        <h3>Les Rendez-Vous</h3>
        <table>
                       <thead>
                           <tr>
                               
                               <td>Nom Prénom Patient</td>
                               <td>Date de rendez_vous</td>
                               

                           </tr>
                       </thead>
                       <tbody>
                       <?php  foreach($rdvs as $rdv) :?>
                            <tr>
                              
                              <td><?php echo  $rdv['nom'] . $rdv['prenom']?></td>
                              <td><?php echo  $rdv['date'] ?></td>
                              
                              
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>

        <h3>les operation</h3>
        <table>
                       <thead>
                           <tr>
                               
                               <td>Nom Prénom de patient </td>
                               
                               <td>Date</td>

                           </tr>
                       </thead>
                       <tbody>
                       <?php foreach($operations as $operation):?>
                            <tr>
                              
                              <td><?php echo $operation['nom'] . $operation['prenom_medcin']?></td>
                              
                              <td><?php echo $operation['date']?></td>
                              
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
    </form>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>