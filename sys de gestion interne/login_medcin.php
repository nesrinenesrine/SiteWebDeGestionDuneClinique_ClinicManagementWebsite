<?php
session_start();
include '../inc/db.php';
$err="";
$err_username="";
$err_password="";
$err_username_inco ="";

if (isset($_POST['submit']))
{
    $username=htmlspecialchars($_POST['username']);
    $password=htmlspecialchars($_POST['password']);
    
    if(empty($username))
    {
        $err_username="vous devez saisir votre nom d'utilisateur ou email";
    }elseif(empty($password))
    {
        $err_password = "vous devez saisir votre mot de passe";
    }else
    {
        $sql="SELECT * FROM `medcin` WHERE user_name_medcin = '$username' OR email_medcin = '$username';";

        if(mysqli_query($conn , $sql))
        {
            $result =mysqli_query($conn , $sql);
            $row =mysqli_num_rows ($result);
            if ($row==1)
            {
                $userData=mysqli_fetch_assoc($result);
                //$userData['mot_de_passe_medcin']==$password)
                if( password_verify($password,$userData['mot_de_passe_medcin']))
                {
                    $id=$userData["id_medcin"];
                    $_SESSION['userId']=$id;
                    $_SESSION['username']=$username;
                    $nom = $userData["nom_medcin"];
                    $_SESSION['nom_medcin']=$nom;
                    $_SESSION['prenom_medcin'] = $userData["prenom_medcin"];
                    $service=$userData['id_specialite'];
                    $_SESSION['service']=$service;
                    header("location:./profile_medcin/profile_medcin.php");
                        
                    exit();
                }
                else{
                    $err=' mot de pass incorect ';
                }
            }else
            {
                $err_username_inco ="nom d'utilisateur incorrect";
            }
        }else
        {
            echo ("error" . mysqli_error($conn));
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
    <link rel="stylesheet" href="./css/se_connecter.css">
    <link rel="stylesheet" href="../css/style-seconnecter.css">
    <title>Document</title>
</head>
<body>
<div class="box">
        <div class="img"><img src="../img/logo-of-profile.svg" alt=""></div>
        
        <div class="se-connecter">
        <h1>se connecter</h1>
        <form action="login_medcin.php" method="POST" >
        <div class="form-input">
        <input class="form__input" type="text"      name="username"          id="username"  
        placeholder=" "  value="<?php if (isset($_POST['submit'])){ echo  $username;} ?>">
        <label class="form__label" for="nom">Nom de utilisateur /Email</label>
        <span ><?php $err_username; ?></span>
        </div>
        <div class="form-input">
        <input class="form__input" type="password"  name="password"  id="password"  
        placeholder=" "  value="<?php if(isset($_POST['submit'])){ echo $password;}?>">
        <label class="form__label" for="nom">mot de passe:</label>
        <span ><?php echo $err_password;?> </span>
        <span ><?php echo $err_username_inco; ?> </span>
        <span> <?php echo $err;?> </span>
        </div>
        <div class="secon">
            <p class="p-creer">Vous n'avez pas de compte <a href="cree_compte_medecin.php">Creer compte</a></p>
           
        </div>
        <button type="submit" name="submit" id="se_connecter">Se connecter</button>
     </form>
     </div>
    </div>
</body>
</html>
