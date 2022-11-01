<?php
$errMsg="";
$alert = "";
$u=$_GET["username"];
require_once '../Data/AuthDB.php';
require_once '../Data/UpdateDB.php';
require_once '../Business/Admin.php';
$auth=new AuthDB;
$admin=new Admin;
$admin=$auth->forgotPassword($u);
$AdminID = $admin->getAdminID();
if(isset($_POST['AdminID']))
{
    if(!empty($_POST['AdminID']))
    {   
    
        if($AdminID==$_POST['AdminID'])
        {  $password=$admin->getPassword();
            $alert = "Your password is = $password ";


        }
        else
        {

            $errMsg="Wrong ID";

        }

        
    }

    else
    {
        $errMsg="Please Enter Your ID";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Forget-Password</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Indie+Flower">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Company-desc---img-on-right.css">
    <link rel="stylesheet" href="assets/css/Dark-Mode-Switch.css">
    <link rel="stylesheet" href="assets/css/galeria-descripcion.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Basic.css">
</head>

<body class="bg-gradient-primary">
    <div class="container" style="padding-top: 10px;">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10 col-xxl-5 offset-xxl-0" style="margin-top: 50px;width: 500px;">
                <div class="card shadow-lg o-hidden border-0 my-5" style="height: 450px;">
                   
                            <div class="col">
                                <div class="p-5" style="height: 500px;">
                                    <div class="text-center">
                                        <h1 class="text-dark mb-4" style="margin-top: 100px;"></h1>
                                    </div>
                                    <form method="post" class="user">
                                        <div class="mb-3"><input class="form-control form-control-user" type="number" min="0"id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter your ID" name="AdminID" style="margin-bottom: 0;"></div>
                                        <div class="mb-3"></div>
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox small"></div>
                                        </div>
                                        <div class="text-center"></div><button class="btn btn-primary d-block btn-user w-100" type="submit" style="height: 50px;">Done</button>
                                    <hr>

                                    <?php 
              
              if($errMsg!="")
                     {
                           ?>
                              <div class="alert alert-danger" role="alert"><?php echo $errMsg ?></div>
                          <?php
                     }
                     else if ($alert != "" ){

                        ?>
                        <div class="alert alert-success" role="alert"> <?php echo $alert ?> </div>
                        <div class="text-center"><a class="small" href="login.php" style="font-size: 20px;"><strong>Login</strong></a></div>

                        <?php
        
        
                    }
                    ?>

                                    </form>
                                
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Dark-Mode-Switch.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>