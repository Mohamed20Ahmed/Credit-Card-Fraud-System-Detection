<?php
session_start();
if($_SESSION["block"]){
    header("location: login.php");

}
if (!isset($_SESSION["type"])) {

  header("location:login.php");
} else {
  if ($_SESSION["type"] != "User") {
    header("location:login.php");
  }
}
$userid=$_SESSION["userid"];
$loginid=$_SESSION["id"];
$errMsg="";

require_once '../Data/AuthDB.php';
require_once '../Data/UpdateDB.php';
require_once '../Business/User.php';

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
        if($auth->checkSecurity($user2,$_SESSION["userid"]))
        {
            header("location: Withdraw.php");            


        }
        else
        {
            $userinfo->updateBlock($loginid,1);
            header("location: login.php?logout");           


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
    <title>Security</title>
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
<div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="index.php">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="far fa-money-bill-alt"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>F.D</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Home</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="security-in.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="view-transactions.php"><i class="fas fa-money-check"></i><span>View Transactions</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="Deposit.php"><i class="fas fa-money-bill-wave"></i><span>Deposit</span></a><a class="nav-link" href="Withdraw.php"><i class="fas fa-money-bill-wave"></i><span>Withdraw</span></a><a class="nav-link" href="help.php"><i class="fas fa-hands-helping"></i><span>Help</span></a></li>
                    <li class="nav-item"></li>
                </ul>
                <div class="text-center d-none d-md-inline"></div><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop-1" type="button"><i class="fas fa-bars"></i></button>
                        <h3 class="text-dark mb-4" style="margin-top: 24px;">Profile</h3>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"></div>
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1"></li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><h4><strong><?php echo $_SESSION["username"]; ?></strong></h4></span></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="login.php?logout"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col-lg-8">
                            <div class="row mb-3 d-none">
                                <div class="col">
                                    <div class="card textwhite bg-primary text-white shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card textwhite bg-success text-white shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                            <form method="post" class="user">
                                <div class="row mb-3"  >
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                <input class="form-control form-control-user" type="text" id="exampleFirstName-9" value="<?php echo $user->security->getQ1()?>" name="q1" readonly="">
                                <input class="form-control form-control-user" type="text" id="exampleFirstName-7" value="<?php echo $user->security->getQ2()?>" name="q2" readonly="">
                                <input class="form-control form-control-user" type="text" id="exampleFirstName-8" value="<?php echo $user->security->getQ3()?>" name="q3" readonly=""></div>
                                    <div class="col-sm-6">
                                    <input class="form-control form-control-user" type="text" id="exampleFirstName-10" placeholder="Security Answer 1" name="a1">
                                    <input class="form-control form-control-user" type="text" id="exampleFirstName-11" placeholder="Security Answer 2" name="a2">
                                    <input class="form-control form-control-user" type="text" id="exampleFirstName-12" placeholder="Security Answer 3" name="a3"></div>
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
            
            ?>
            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © hanUka 2022</span></div>
                </div>
            </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Dark-Mode-Switch.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>