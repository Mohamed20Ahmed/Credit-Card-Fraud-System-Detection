<?php 
require_once '../Business/Person.php';
require_once '../Data/AuthDB.php';

$errMsg="";


if(isset($_GET["logout"]))
{
  session_start();
  session_destroy();
}

if(isset($_POST['username']) && isset($_POST['password']))
{
    if(!empty($_POST['username']) && !empty($_POST['password']) )
    {   
        $person=new Person;
        $auth=new AuthDB;
        $person->setUsername($_POST['username']);
        $person->setPassword($_POST['password']);
        if(!$auth->login($person))
        {
           /* if(!isset($_SESSION["id"]))
            {
                session_start();
            }*/
            $errMsg=$_SESSION["errMsg"];

        }
        else
        { if(!isset($_SESSION["id"]))
            {
                session_start();
            }
            if($_SESSION["block"]){
                header("location: security-out.php");

            }
            else{
           
            if($_SESSION["type"]=="Admin")
            {
                header("location: view-users.php");
            }
            else
            {
                header("location: index.php");
            }
                 }
        }

        
    }

    else
    {
        $errMsg="Please fill all fields";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
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
    <div class="container" style="padding-top: 100px;">
        <div class="row justify-content-center" style="width: 1300px;height: 800px;">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5" style="height: 500px;">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 col-xxl-6 offset-xxl-0 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;assets/img/create-account-office.jpeg&quot;);"></div>
                            </div>
                            <div class="col-lg-6" style="height: 500px;">
                                <div class="p-5" style="height: 500px;">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Welcome</h4>
                                    </div>
                                    <form method="post" class="user">
                                        <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleInputEmail" placeholder="Username" name="username"></div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Password" name="password"></div>
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox small"></div>
                                        </div><button class="btn btn-primary d-block btn-user w-100" type="submit">Login</button>
                                        <hr>
                                    </form>
                                    <?php 
              
              if($errMsg!="")
              {
                  ?>
                      <div class="alert alert-danger" role="alert"><?php echo $errMsg ?></div>
                  <?php
              }
            
            ?>
                                    <div class="text-center"><a class="small" href="forgot-password.php">Forgot Password?</a></div>
                                    <div class="text-center"><a class="small" href="register.php">Create an Account!</a></div>
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