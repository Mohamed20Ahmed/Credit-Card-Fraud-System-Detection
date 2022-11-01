<?php
$errMsg="";
$alert = "";
$u=$_GET["username"];
require_once '../Data/AuthDB.php';
require_once '../Data/UpdateDB.php';
require_once '../Business/User.php';
$auth=new AuthDB;
$arr=$auth->forgotPassword($u);
$userid=$arr[0];
$loginid=$arr[1];
$userinfo=new UpdateDB;
$user=new User;

$user=$userinfo->getUserinfo($loginid,$userid);
if(isset($_POST['a1']) && isset($_POST['a2']) && isset($_POST['a3']))
{
    if(!empty($_POST['a1']) && !empty($_POST['a2']) && !empty($_POST['a3']))
    {   
        $user2=new User;
        $auth=new AuthDB;
        $user2->security->setQuestions($user->security->getQ1(),$user->security->getQ2(),$user->security->getQ3());
        $user2->security->setAnswers($_POST['a1'],$_POST['a2'],$_POST['a3']);
        if($auth->checkSecurity($user2,$userid))
        {  $password=$user->getPassword();
            $alert = "Your password is = $password ";


        }
        else
        {

            $errMsg="Wrong Answers";

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
    <title>Forgot-Password</title>
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
    <div class="container" style="margin-top: 150px;">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image" style="background: url(&quot;assets/img/—Pngtree—network%20security_300153.png&quot;) center / cover;"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Security Questions</h4>
                            </div>
                            <form method="post"class="user">
                                <div class="row mb-3">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input class="form-control form-control-user" type="text" id="exampleFirstName-9" value="<?php echo $user->security->getQ1()?>" name="q1" readonly="">
                                        <input class="form-control form-control-user" type="text" id="exampleFirstName-7" value="<?php echo $user->security->getQ2()?>" name="q2" readonly=""><input class="form-control form-control-user" type="text" id="exampleFirstName-8" value="<?php echo $user->security->getQ1()?>" name="q3" readonly=""></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="text" id="exampleFirstName-10" placeholder="Security Answer 1" name="a1"><input class="form-control form-control-user" type="text" id="exampleFirstName-11" placeholder="Security Answer 2" name="a2"><input class="form-control form-control-user" type="text" id="exampleFirstName-12" placeholder="Security Answer 3" name="a3"></div>
                                </div>
                                <div class="mb-3"></div><button class="btn btn-primary d-block btn-user w-100" type="submit" style="padding-top: 16px;">Done</button>
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
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Dark-Mode-Switch.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>