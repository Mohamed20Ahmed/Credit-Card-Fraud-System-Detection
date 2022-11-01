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
require_once '../Business/Transactions.php';
require_once '../Data/DBTransaction.php';

$view = new DBTransaction;
$transactions = $view->getTransactions($_SESSION["userid"]);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>View-Transactions</title>
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
                    <li class="nav-item"><a class="nav-link" href="security-in.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="view-transactions.php"><i class="fas fa-money-check"></i><span>View Transactions</span></a></li>
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
                        <h3 class="text-dark mb-0"><br>View Transactions History<br><br></h3>
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


                
                <div class="container-fluid" id='page-content'>
                <button   style="background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;"><a href="pdf.php" style="
  background-color: #4CAF50;text-decoration: none;
  color: white;"> generate report</a></button>
                    <div class="card shadow">
                        
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold" style="font-size: 25px;color: rgb(0,0,0);">Transactions History</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                
                                        <tr>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Location</th>
                                            <th>User_id</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                    
                                    foreach ($transactions as $transaction)
                                    
                                    {
                                        ?>
                                <thead>
                                
                                <tr>
                                    <th value="<?php echo $transaction["User_id"]?>"><?php echo $transaction["Date"]?></th>
                                    <th value="<?php echo $transaction["User_id"]?>"><?php echo $transaction["Type"]?></th>
                                    <th value="<?php echo $transaction["User_id"]?>"><?php echo $transaction["Amount"]?></th>
                                    <th value="<?php echo $transaction["User_id"]?>"><?php echo $transaction["Location"]?></th>
                                    <th value="<?php echo $transaction["User_id"]?>"><?php echo $transaction["User_id"]?></th>
                                </tr>
                                </thead>


                                    <?php
                                    
                                    }

                                    
                                    ?>





                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                    
                                </table>
                               
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