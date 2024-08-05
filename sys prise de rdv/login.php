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
        $sql="SELECT * FROM `patient` WHERE user_name= '$username' OR email = '$username';";

        if(mysqli_query($conn , $sql))
        {
            $result =mysqli_query($conn , $sql);
            $row =mysqli_num_rows ($result);
            if ($row==1)
            {
                $userData=mysqli_fetch_assoc($result);
                if(password_verify($password,$userData['mot_de_passe']))
                {
                    
                    $id=$userData["id_patient"];
                    $_SESSION['userId']=$id;
                    header ("location:profile.php");
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
    <link rel="stylesheet" href="../css/style-seconnecter.css">
    <title>Document</title>
</head>
<body>
<div class="box">
    <div class="img"><img src="../img/logo-of-profile.svg" alt=""></div>
    
      <div class="se-connecter">
         <form action="login.php" method="POST" >
         <h1>se connecter</h1>
         
        <div class="form-input">
           <input   class ="form__input" type="text"      name="username"          id="username"  
            placeholder=" " value="<?php if (isset($_POST['submit'])){ echo  $username;} ?>">
           <label class="form__label" for="username">nom d'utilisateur/Email</label>
           <span ><?php $err_username; ?></span>
        </div>
        <div class="form-input">
          <input class ="form__input" type="password"  name="password"  id="password"  
          placeholder=" "  value="<?php if(isset($_POST['submit'])){ echo $password;}?>">
          <label class="form__label" for="username">mot de passe</label>
          <span ><?php echo $err_password;?> </span>
    
          <span ><?php echo $err_username_inco; ?> </span>
          <span> <?php echo $err;?> </span>
        </div>
        <div class="secon">
        <p class="p-creer">Vous n'avez pas de compte <a href="cree_compte.php">Creer compte</a></p>
         <button type="submit" name="submit" id="se_connecter">Se connecter</button>
         </div>
     </form>
    
  </div>
</div>
</body>
</html>
