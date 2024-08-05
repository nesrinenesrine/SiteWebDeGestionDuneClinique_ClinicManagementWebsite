
<?php 
session_start();
if (!isset($_SESSION['id']) )
{
    header("location:login.php");
    exit();
}
else{
    include '../inc/db.php';
    $id=$_SESSION['id'];
    $nom_nv_medcin=$_SESSION['nom_nv_medcin'];
    $prenom_nv_medcin=$_SESSION['prenom_nv_medcin'];
    $nv_username=$_SESSION['nv_username'];
    $id_specialite=$_SESSION['id_specialite'];
    
    $nv_email=$_SESSION['nv_email'];
    $nv_telephone=$_SESSION['nv_telephone'];
    $nv_mot_de_passe=$_SESSION['nv_mot_de_passe'];
    $err="";
    
    $tabs =[];
    $jour_de_semain=array('Sunday','Monday','Tuesday','Wednesday','Thursday');
    if(isset($_POST['submit']))
    {
        if(empty($_POST['option']))
        {
            $err = "vous dever choisire au moin un jour";
        }
        else{
            $jours=$_POST['option'];
            foreach($jour_de_semain as $jour_s)
            {
                $b=false;
                foreach($jours as $jour)
                if($jour==$jour_s)
                {
                    $b=true;
                }

                if($b==true)
                {
                    $tabs[$jour_s]=1;
                }
                elseif($b==false)
                {
                    $tabs[$jour_s]=0;
                }
            }
            $sql_jour_rdv="SELECT * FROM jour_de_rdv";
            if (mysqli_query($conn,$sql_jour_rdv))
            {
                $result = mysqli_query($conn,$sql_jour_rdv);
                $jours_rdv=mysqli_fetch_all($result, MYSQLI_ASSOC);
            }else 
            { 
                echo ("error" . mysqli_error($conn));
            }
            foreach($jours_rdv as $jour_rdv)
            {   $b=0;
                foreach($tabs as $tab => $value)
                {
                    if($jour_rdv[$tab] ==  $value)
                    {
                        $b=$b+1;
                    }
                }
                if($b==5)
                {
                    $id_jour_rdv = $jour_rdv['id_jour_rdv'];

                    $sql_insere_medcin= "INSERT INTO medcin (`id_jour_rdv`, `user_name_medcin`, `mot_de_passe_medcin`,
                    `nom_medcin`, `prenom_medcin`, `telephone_medcin`, `email_medcin`, `id_specialite`,`id_service`, `role`) 
                    VALUES('$id_jour_rdv','$nv_username','$nv_mot_de_passe','$nom_nv_medcin','$prenom_nv_medcin','$nv_telephone',
                    '$nv_email','$id_specialite','$id_specialite','user')";
                    if (mysqli_query($conn,$sql_insere_medcin))
                    {
                        $sql="DELETE FROM  nv_medcin WHERE nv_medcin.id='$id'";
                        if (mysqli_query($conn,$sql))
                        {
                            header("location:./profile_admin/profil_admin.php");
                            exit();
                        }else{
                            echo ("error" . mysqli_error($conn) );
                        }
                        exit();
                    }else
                    {
                        echo ("error" . mysqli_error($conn) );
                    }
                }
            }
            if(empty($id_jour_rdv))
            {
                $Sunday=$tabs['Sunday'];
                $Monday=$tabs['Monday'];
                $Tuesday=$tabs['Tuesday'];
                $Wednesday=$tabs['Wednesday'];
                $Thursday=$tabs['Thursday'];

                $sql_insert_jour_rdv = "INSERT INTO jour_de_rdv (`Sunday`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`) 
                        VALUES('$Sunday','$Monday' ,'$Tuesday' ,'$Wednesday' ,'$Thursday')";
                
                if (mysqli_query($conn,$sql_insert_jour_rdv))
                {
                    $last_id = mysqli_insert_id($conn);
                    $sql_insere_medcin= "INSERT INTO medcin (`id_jour_rdv`, `user_name_medcin`, `mot_de_passe_medcin`,
                    `nom_medcin`, `prenom_medcin`, `telephone_medcin`, `email_medcin`, `id_specialite`, `role`) 
                    VALUES('$last_id','$nv_username','$nv_mot_de_passe','$nom_nv_medcin','$prenom_nv_medcin','$nv_telephone',
                    '$nv_email','$id_specialite','user')";

                    if (mysqli_query($conn,$sql_insere_medcin))
                    {
                        $sql="DELETE FROM  nv_medcin WHERE nv_medcin.id='$id'";
                        if (mysqli_query($conn,$sql))
                        {
                            header("location:./profile_admin/profil_admin.php");
                            exit();
                        }else{
                            echo ("error" . mysqli_error($conn) );
                        }
                        echo "succ";
                        exit();
                    }else{
                        echo ("error" . mysqli_error($conn) );
                    }
                    //header("location:afhecter_emploi.php");
                    exit();
                }
                else 
                { 
                    echo ("error" . mysqli_error($conn) );
                }  
            }
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
   <link rel="stylesheet" href="../css/styleadmin.css">
    <title>Document</title>
</head>
<body>
    <div class="profile">
       <a href="./profile_admin/profil_admin.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
 <div class="mains">
    <div class="nv_medecin"> 
        <img src="../img/logo-bleu.svg" alt=""  width= "300px" height= "200px" >
        <h3>Choisissez un jour </h3>
       <form class="form-date emploi" action="affecter_emploi.php" method="POST">

        <input type="checkbox" name="option[]" id="dimanche" value="Sunday"> 
        <label for="dimanche"> Dimanche</label> 
        <input type="checkbox" name="option[]" id="lundi"   value="Monday"> 
        <label for="lundi"> Lundi</label> 
        <input type="checkbox" name="option[]" id="mardi"    value="Tuesday"> 
        <label for="mardi"> Mardi</label> 
        <input type="checkbox" name="option[]" id="mercredi"  value="wednesday"> 
        <label for="mercredi"> Mercredi</label> 
        <input type="checkbox" name="option[]" id="jeudi"   value="Thursday"> 
        <label for="jeudi"> Jeudi</label> 
        <div class="div">
        <button type="submit" name="submit"> submit</button>
        </div>
    </form>
    <span> <?php  echo $err; ?></span>
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>

