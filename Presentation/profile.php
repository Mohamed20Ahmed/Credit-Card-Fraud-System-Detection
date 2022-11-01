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
require_once '../Data/AuthDB.php';
require_once '../Data/UpdateDB.php';
require_once '../Business/User.php';
$userid=$_SESSION["userid"];
$loginid=$_SESSION["id"];

$auth=new AuthDB;
$userinfo=new UpdateDB;
$user=new User;
$user=$userinfo->getUserinfo($loginid,$userid);
$errMsg="";

if (isset($_POST['firstname']) && isset($_POST['password']) && isset($_POST['username'])
   && isset($_POST['cdnumber']) && isset($_POST['cvv']) && isset($_POST['average'])
   && isset($_POST['q1']) && isset($_POST['q2']) && isset($_POST['q3'])
   && isset($_POST['lastname']) && isset($_POST['balance']) && isset($_POST['expdate'])
   && isset($_POST['email']) && isset($_POST['cdpassword']) && isset($_POST['location'])
   && isset($_POST['ans1']) && isset($_POST['ans2']) && isset($_POST['ans3'])) 

{   

  if (!empty($_POST['firstname']) && !empty($_POST['password']) && !empty($_POST['username'])
   && !empty($_POST['cdnumber']) && !empty($_POST['cvv']) && !empty($_POST['average'])
   && !empty($_POST['q1']) && !empty($_POST['q2']) && !empty($_POST['q3'])
   && !empty($_POST['lastname']) && !empty($_POST['balance']) && !empty($_POST['expdate'])
   && !empty($_POST['email']) && !empty($_POST['cdpassword']) && !empty($_POST['location'])
   && !empty($_POST['ans1']) && !empty($_POST['ans2']) && !empty($_POST['ans3']))    
  {
    $user2=new User();

    $user2->setFirstName($_POST['firstname']);
    $user2->setLastName($_POST['lastname']);
    $user2->setUsername($_POST['username']);
    $user2->setPassword($_POST['password']);
    $user2->setLocation($_POST['location']);
    $user2->setEmail($_POST['email']);
    $user2->setAverage($_POST['average']);
    
    $user2->security->setQuestions($_POST['q1'],$_POST['q2'],$_POST['q3']);
    $user2->security->setAnswers($_POST['ans1'],$_POST['ans2'],$_POST['ans3']);


    $user2->creditcard->setCDnumber($_POST['cdnumber']);
    $user2->creditcard->setCDpassword($_POST['cdpassword']);
    $user2->creditcard->setCvv($_POST['cvv']);
    $user2->creditcard->setExpiryDate($_POST['expdate']);
    $user2->creditcard->setBalance($_POST['balance']);
   

    if($userinfo->updateUser($user2))
    {
      header("location: index.php");
    }
    else
    {
      $errMsg=$_SESSION["errMsg"];
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
    <title>Profile</title>
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

<body id="page-top">
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
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold" style="font-size: 25px;">User Update</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" class="user">
                                                <div class="row mb-3">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label class="form-label" for="name"><strong>Frist Name:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName"  name="firstname" value="<?php echo $user->getFirstName()?>">
<br>
<label class="form-label" for="username"><strong> Username:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-2"  name="username" value="<?php echo $user->getUsername()?>">
<br>
<label class="form-label" for="email"><strong>E-mail:</strong></label>
<input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp"  name="email" value="<?php echo $user->getEmail()?>">
<br>   
<label class="form-label" for="Credit Card Number"><strong>Credit Card Number:</strong></label>
<input class="form-control form-control-user" type="text" minlength="16" maxlength="16" id="exampleFirstName-1" value="<?php echo $user->creditcard->getCDnumber()?>" name="cdnumber">
<br>
<label class="form-label" for="CVV Number"><strong>CVV Number:</strong></label>
<input class="form-control form-control-user" type="text" minlength="3" maxlength="3" id="exampleFirstName-6" value="<?php echo $user->creditcard->getCvv()?>" name="cvv">
<br>
<label class="form-label" for="balance"><strong>Balance:</strong></label>
<input class="form-control form-control-user" type="number" min="0" id="examplebalanceInput-2" value="<?php echo $user->creditcard->getBalance()?>" name="balance" readonly>
<br>   
<label class="form-label" for="Security Question 1"><strong>Security Question 1:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-9" value="<?php echo $user->security->getQ1()?>" name="q1">
<br>   
<label class="form-label" for="Security Question 2"><strong>Security Question 2:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-7" value="<?php echo $user->security->getQ2()?>" name="q2">
<br>   
<label class="form-label" for="Security Question 3"><strong>Security Question 3:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-8" value="<?php echo $user->security->getQ1()?>" name="q3">
<br>  
</div>
                                                    <div class="col-sm-6">
                                                    <label class="form-label" for="name"><strong>Last Name:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-14" value="<?php echo $user->getLastName()?>" name="lastname">
<br> 
<label class="form-label" for="password"><strong>Password:</strong></label>
<input class="form-control form-control-user" type="text" id="examplePasswordInput" value="<?php echo $user->getPassword()?>" name="password">
<br>  

<label class="form-label" for="Location"><strong>Location:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-4" value="<?php echo $user->getLocation()?>" name="location">
<br>
<label class="form-label" for="Credit Card Password"><strong>Credit Card Password:</strong></label>
<input class="form-control form-control-user" type="text"  minlength="4" maxlength="4" id="examplePasswordInput-1" value="<?php echo $user->creditcard->getCDpassword()?>" name="cdpassword">
<br>
<label class="form-label" for="Expiry Date"><strong>Expiry Date:</strong></label>
<input class="form-control form-control-user" type="text" minlength="4" maxlength="4" id="exampleFirstName-5" value="<?php echo $user->creditcard->getExpiryDate()?>" name="expdate">
<br>        
<label class="form-label" for="Average Withdraw Money"><strong>Average Withdraw Money:</strong></label>
<input class="form-control form-control-user" type="number" id="exampleFirstName-3" value="<?php echo $user->getAverage()?>" name="average">
<br>    
<label class="form-label" for="Security answer 1"><strong>Security Answer 1:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-10" value="<?php echo $user->security->getAns1()?>" name="ans1">
<br>   
<label class="form-label" for="Security answer 2"><strong>Security Answer 2:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-11" value="<?php echo $user->security->getAns2()?>" name="ans2">
<br>   
<label class="form-label" for="Security answer 3"><strong>Security Answer 3:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-12" value="<?php echo $user->security->getAns3()?>" name="ans3">
<br>  

                                                </div>
                                                    <hr><button class="btn btn-primary btn-sm" type="submit"style="width: 300px;text-align: center;">Save&nbsp;Settings</button>
                                                   
            
                                                </div>
                                                
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
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © hanUka 2022</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Dark-Mode-Switch.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>