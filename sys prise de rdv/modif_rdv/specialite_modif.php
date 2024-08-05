<?php 
session_start();
if (!isset($_SESSION['userId']) )
{
    
    header("location:../index.php");
}
else
{
    include '../../inc/db.php';
    $id_rdv=$_SESSION['id_rdv'];
    
    $sql_specialite ='SELECT * 
        FROM specialite';
    if (mysqli_query($conn,$sql_specialite))
    {
        $result = mysqli_query($conn,$sql_specialite);
        $specialites=mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else 
    { 
        echo ("error" . mysqli_error($conn) );
    }

    $sql_rdv="SELECT * FROM `rdv` 
    JOIN medcin ON rdv.id_medcin=medcin.id_medcin
    join time on rdv.id_time = time.id_time
    WHERE rdv.id_rdv ='$id_rdv'";

    if (mysqli_query($conn,$sql_rdv))
    {
        $result = mysqli_query($conn,$sql_rdv);
        $rdv=mysqli_fetch_all($result, MYSQLI_ASSOC);
        
    }else 
    { 
        echo ("error" . mysqli_error($conn) );
    }

    $specialite_rdv=$rdv[0]['id_specialite'];
    $_SESSION['id_medecin_a_modif']=$rdv[0]['id_medcin'];
    $_SESSION['date_a_modif']=$rdv[0]['date'];
    $_SESSION['heur_a_modif']=$rdv[0]['time'];
    
    
    if(isset($_POST['suivant']))
    {
        $_SESSION['id_specialite_modif']=$_POST['specialite'];
        header("location:medecin_modif.php");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../rendez_vous/style-rendezvous.css">
    <title>specialite</title>
</head>
<body>
<div class="profile">
       <a href="../profile.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
<div class="box">
    
        <div class="img"><img src="../../img/logo-of-profile.svg" alt=""></div>
        <div class="rendez">
        
        <h1> Prendre Votre Rendez-vous </h1> 
        <h3> Choisissez une spécialité pour votre médecin </h3>
        <form action="specialite_modif.php"    method="POST" class = "formulaire" >
        <!-- ******************les specialite**************************  -->
        <?php if(!isset($_POST['specialite'])) { $specialite_rdv = $rdv[0]['id_specialite'];} ?>
           <label for="specialite">spécialité :</label> <br> <br>
           <select name="specialite" id="specialite"   class ="zone_de_choix">
               <option></option>
              <?php  foreach($specialites as $specialite):?>
                <option value="<?php echo $specialite['id_specialite'] ;?>" <?php if($specialite['id_specialite'] == $specialite_rdv) { echo "selected" ;} ?> > 
                    <?php echo  $specialite['nom_specialite']; ?>
                </option>
              <?php endforeach;?>   
           </select> <br>

           <button type="submit" name="suivant" id="suivant" > suivant </button>
      </form>
        </div> 
       
  
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  
   

</body>
</html>

