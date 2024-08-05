<?php 
session_start();
include '../../../inc/db.php';
$err="";
$heur_deb=$_SESSION['nv_heur_deb'];
$heur_fin =$_SESSION['nv_heur_fin'];
$nv_date=$_SESSION['date_modif'];
$id_bloq=$_SESSION['id_bloq'];
$id_op=$_SESSION['op_modif'];


$sql_bloq="SELECT * FROM bloq";
if (mysqli_query($conn,$sql_bloq))
{
    $result = mysqli_query($conn,$sql_bloq);
    $bloqs=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}


$sql_bloq_occupe="SELECT * FROM etat_bloq WHERE (etat_bloq.date='$nv_date')
                and(('$heur_deb' BETWEEN etat_bloq.heur_deb and etat_bloq.heur_fin) 
                or ('$heur_fin' BETWEEN etat_bloq.heur_deb and etat_bloq.heur_fin)
                or ('$heur_deb' < etat_bloq.heur_deb and '$heur_fin'> etat_bloq.heur_fin)
                or ('$heur_deb' > etat_bloq.heur_deb and '$heur_fin' > etat_bloq.heur_fin) )";

if (mysqli_query($conn,$sql_bloq_occupe))
{
    $result = mysqli_query($conn,$sql_bloq_occupe);
    $bloqs_occupe=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}



$bloq_dispo=array();
foreach ($bloqs as $bloq)
{
    $b=true;
    foreach($bloqs_occupe as $bloq_occupe)
    {
        if($bloq['id_bloq']==$bloq_occupe['id_bloq'])
        {
            $b=false;
        }
    }
        
    if($b==true)
    {
        array_push($bloq_dispo,$bloq);
    }
}

$bool=false;
if(count($bloq_dispo)==0)
{
    echo "aucun bloque est disponible pour cette date et cette heur";
}else
{
    $bool= true;
}

if (isset($_POST['suivant'])) 
{
    $id_bloq=$_POST['id_bloq'];
    if(empty($id_bloq))
    {
        $err="vous dever choisire un bloque pour loperation";
    }
    else{
        $sql_update="UPDATE `operation` 
        SET `id_bloq`='$id_bloq',`date`='$nv_date',`heur`='$heur_deb',`heur_fin`='$heur_fin' 
        WHERE operation.id_operation='$id_op'";
        if(mysqli_query($conn,$sql_update))
        {
            header("location:../profil_admin.php");
            exit();
        }
        else
        {
            echo ("error" . mysqli_error($conn) );
        }
        
        
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
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
     <?php if($bool==true):?>  
                    <form action="bloc.php"  method="POST">
                        <select name="id_bloq" id="id_bloq"   >
                            <option></option>
                            <label for=""> bloq:</label>
                            <?php if(!isset($_POST['id_bloq'])){$id_bloq=$_SESSION['id_bloq']; }?>
                            <?php foreach($bloq_dispo as $bloq_d) :?>
                                <option  value=" <?php echo $bloq_d['id_bloq'];?> "   <?php  if($bloq_d['id_bloq'] == $id_bloq) {echo "selected";} ?> >
                                    <?php echo  "bloque"." ". $bloq_d['id_bloq']; ?>
                                </option>
                            <?php endforeach;?> 
                        </select>
                        <button type="submit" name="suivant">confirmer</button>
                        <a href="http:heur.php"> precdent</a>
                    </form>
                <?php endif ;?>
                <span><?php echo $err;?></span>
                </div>
   
      </div>
   </div>
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>