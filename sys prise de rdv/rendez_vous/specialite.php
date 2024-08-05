
<?php
session_start();
include '../../inc/db.php';

if (!isset($_SESSION['userId']))
{
    header("location:../index.php");
}
else{

   /* $specialite_recommander=$_SESSION['les_symp'];
    if(empty($specialite_recommander))
    {*/
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

        

        if(isset($_POST['submit'])) 
        {
            if(empty($_POST['specialite']))
            {
                $err = "vous devez choisire une specialite";
            }
            else{

                $_SESSION['id_specialite'] =$_POST['specialite'];
                header("location:medcin.php");
                exit();
            }
        }

   /* }
   else
    {
        $specialites=$specialite_recommander;
    }*/
    
 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-rendezvous.css">
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
        <form action="specialite.php"    method="POST" class = "formulaire" >
        <!-- ******************les specialite**************************  -->
           <label for="specialite">spécialité :</label> <br> <br>
           <select name="specialite" id="specialite"  onchange="javascript:submit(this);" class ="zone_de_choix">
               <option></option>
              <?php  foreach($specialites as $specialite):?>
                <option value="<?php echo $specialite['id_specialite'];?>" <?php if(isset($_POST['specialite'])){if($_POST['specialite']==$specialite['id_specialite']){echo "selected";}} ?> class="option"> 
                    <?php echo  $specialite['nom_specialite']; ?>
                </option>
              <?php endforeach;?>   
           </select> <br>

          <span><?php if (isset($_POST['submit']) && empty($_POST['specialite'])){echo $err;} ?> </span>
          <button type="submit" name="submit"  id= "suivant">suivant</button>
      </form>
        </div> 
       
  
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  
</body>
</html>