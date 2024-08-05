<?php 
session_start();
include '../../inc/db.php';
$id=$_SESSION['userId'];

$count="";

$sql_chef="SELECT * FROM `medcin` WHERE medcin.id_medcin='$id'";

if (mysqli_query($conn,$sql_chef))
{
    $result = mysqli_query($conn,$sql_chef);
    $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn));
}

$nom=$user[0]['nom_medcin'];
$prenom=$user[0]['prenom_medcin'];
$username=$user[0]['user_name_medcin'];
$email=$user[0]['email_medcin'];
$id_service=$user[0]['id_service'];

$sql="SELECT * FROM `demmande_hospiitalisation` 
WHERE demmande_hospiitalisation.id_service='$id_service' and demmande_hospiitalisation.etat=0 ";
if (mysqli_query($conn,$sql))
{
    $result = mysqli_query($conn,$sql);
    $count=mysqli_num_rows($result);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

include '../../inc/db.php';
include './les_medecin_de_service.php';
include './les_demmande_hospitalisation.php';
include './les_hospitalisation.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style-profile.css">
    <link rel="stylesheet" href="../../css/style _chef.css">
    <title>profile</title>
</head>
<body>
<div class="contaire">
     <div class="nav">
        <ul class="tabs">
           <li>
               <a href="#">
                  
                   
               </a>
          </li>
           <li class="tab">
               <a data-switcher data-tab="1">
                   <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
                   <span class="title">Les hospitalisation</span>
               </a>
           </li>
           <li class="tab">
               <a data-switcher data-tab="2">
                    <?php if($count<>0):?>
                      <span class="notf"><p><?php echo $count ;?></p> </span>
                    <?php endif;?>
                   <span class="icon"><ion-icon name="bed-outline"></ion-icon></span>
                   <span class="title">les demande d'hospitalisation</span>
                   
               </a>
           </li>
           <li class="tab">
               <a data-switcher data-tab="3">
                   <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                   <span class="title">les medecin de service</span>
               </a>
            </li>
            <li class="tab">
                <a href="../profile_medcin/profile_medcin.php">
                    <span class="icon"><ion-icon name="pulse-outline"></ion-icon></span>
                    <span class="title">espace médecin</span>
               
                </a>
            </li>
        
           <li >
               <a href="../logout.php" >
                   <span class="icon"><ion-icon name="log-in-outline"></ion-icon></span>
                   <span class="title">Sortie </span>
               </a> 
               
            </li>

        </ul>
       </div>

    <div class="mains">
           <div class="topbar">
               <div class="toggle">
                 <ion-icon name="menu-outline"></ion-icon>
               </div>
               <div class="user">
               <ion-icon name="home-outline"><a href="../index.php"></a></ion-icon>
               </div>

           </div>
               
        <div class="mod-hos  main is-active" data-main="1">
        <div class="boxs">
            <div class="welcome-box">
                 <h2>Bienvenus <?php echo $username?> à le Clinique de Confort </h3>
            </div>
              <div class="box-info">
                  <h3>Mes informations</h3>
                   
                  <h4>Nom d'utilisateur :<span><?php echo $username?></span></h4>
                 
                  <h4>email :<span><?php echo $email ?></span></h4>
                  
               </div>
         </div> 
        <form action="les_hospitalisation.php" method="post">
             <div class="head"><h3>les hospitalisation</h3></div>
                <table class="tab-rendez">
                       <thead>
                           <tr>
                               
                               <td>Nom prenom patient</td>
                               <td>date de entrée</td>
                               <td>date de sotrie</td>
                               <td>Email médecin</td>
                               <td>nombre de chambre</td>
                               <td>nombre de lit</td>
                               <td>modifie</td>
                               <td>annuler</td>
                               
                            </tr>
                       </thead>
                       <tbody>
                       <?php foreach($hospitalisations as $hospitalisation):?>
                           <tr>
                              <td ><?php echo  $hospitalisation['nom'] . $hospitalisation['prenom'] ?></td>
                              <td><?php echo   $hospitalisation['date_entre']?></td>
                              <td><?php echo   $hospitalisation['date_sortie']?></td>
                              <td><?php echo  $hospitalisation['email'] ?></td>
                              <td><?php echo   $hospitalisation['id_chambre']?></td>
                              <td><?php echo   $hospitalisation['id_lit']?></td>
                              <td><button type="submit" name="supprimer" value="<?php echo $hospitalisation['id_hospitalisation']; ?>"> supprimer</button> </td>
                             <td> <button type="submit" name="modifie" value="<?php echo $hospitalisation['id_hospitalisation']; ?>"> modifie</button></td>
                              
                              
                           </tr>
                     <?php endforeach?>
                       </tbody>
                   </table>
                      
                </form>
          

   
                   
          
            
    
               
        </div>

          

        <div class="aganda main" data-main="2">
           <form method="POST" action ="les_demmande_hospitalisation.php" TARGET=_BLANK >
                <h3>les demande d'hospitalisation</h3>
                   <table>
                       <thead>
                           <tr>
                               
                               <td>Nom médecin</td>
                               <td>Prénom médecin</td>
                               <td>Email médecin</td>
                               <td>Description</td>
                               <td>organiser</td>
                               
                            </tr>
                       </thead>
                       <tbody>
                       <?php foreach($dems_hsop as $dem_hsop) :?>
                           <tr>
                              <td ><?php echo  $dem_hsop['nom'] ?></td>
                              <td><?php echo   $dem_hsop['prenom'] ?></td>
                              <td><?php echo  $dem_hsop['email'] ?></td>
                              <td><?php echo   $dem_hsop['disc']?></td>
                              <td><button type="submit"  name="organiser_hospitalisation"  value="<?php echo $dem_hsop['id_dem_hos'];?>">organiser_hospitalisation</button></td>
                       
                              
                              
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
                  
            </form>
               
        </div>
           <div class="concact main" data-main="3">
           <form action="les_medecin_de_service.php" method="post">
                   <table>
                       <thead>
                           <tr>
                               <td>Id de medecin</td>
                               <td>Nom de medecin</td>
                               <td>Prénom de medecin</td>
                               <td>Email de medecin</td>
                               <td>Fiche de medecin</td>
                               
                               

                           </tr>
                       </thead>
                       <tbody>
                       <?php foreach($medecins as $medecin):?>
                           <tr>
                              <td ><?php echo  $medecin['id_medcin'] ?></td>
                              <td><?php echo   $medecin['nom_medcin'] ?></td>
                              <td><?php echo   $medecin['prenom_medcin'] ?></td>
                              <td><?php echo   $medecin['email_medcin']?></td>
                       
                              
                              <td> <button type="submit" name="fcihe_medecin" value="<?php echo $medecin['id_medcin'] ;?>"> fiche medecin</button></td>
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
            </form>
               
           </div>
           <div class="password main" data-main="4">

           </div>

           <div class="password main" data-main="5">

           </div>
        </div>
      
   </div>

    
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>




    <script src="../../js/main-profile.js"></script>
</body>
</html>

