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
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home</title>
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
                    <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Home</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="security-in.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="view-transactions.php"><i class="fas fa-money-check"></i><span>View Transactions</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="Deposit.php"><i class="fas fa-money-bill-wave"></i><span>Deposit</span></a>
                    <a class="nav-link" href="Withdraw.php">
                        <i class="fas fa-money-bill-wave"></i><span>Withdraw</span></a>
                        <a class="nav-link" href="help.php"><i class="fas fa-hands-helping"></i><span>Help</span></a></li>
                    <li class="nav-item"></li>
                </ul>
                <div class="text-center d-none d-md-inline"></div><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <h3 class="text-dark mb-0">Home</h3>
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
                    <div class="d-sm-flex justify-content-between align-items-center mb-4"></div>
                    <div class="row">
                        <div class="col">
                            <div class="row" style="box-shadow: inset 2px 2px;opacity: 1;filter: blur(0px);">
                                <div class="col-sm-6">
                                    <div class="bg-light border rounded border-light hero-food jumbotron py-5 px-4">
                                        <p></p>
                                        <h1 class="hero-title"><br><strong>Account Fraud</strong><br><br></h1>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div id="media-right-aligned" class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading"></h4>
                                            <p><strong>Fraudulent accounts create easy gateways into a system. Although CAPTCHAs and multi-factor authentication methods are effective in mitigating these, they can impair user experience.Account Takeover</strong><br>Account takeovers involve gaining unauthorized access to an account and carrying out illegitimate transactions. This is often achieved by credential stuffing, phishing, or acquiring credentials via databases and black markets.<br><strong>Fake Registration</strong><br>Fake registrations occur when fraudsters create accounts using stolen information or fake identities. These fake accounts can then be used for malicious purposes, such as promo abuse or money laundering.<br></p>
                                        </div>
                                        <div class="media-right"><a href="#"></a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row"><section class="padding-60-0 border-bottom-1">
            <div class="container">
                <div class="row">

                    <div class="col-md-12 lead">
                        <header style="margin-bottom: 10px;">
                            <h1 class="weight-300 likeh1">Bot Attacks</h1>
                        </header>
                        <img src="assets/img/How_to_spot_a_bank.png" class="img-responsive img-thumbnail center-block hidden-sm" alt="" title="" style=" text-align: right; float: right; margin: 0 0 30px 50px; ">
                        <div class="fw-details-text"><strong class="fw-bold-text">Scraping</strong><br>Scraping involves illegally harvesting data from websites or mobile applications. Advanced, human-like bots scan pages for valuable information which can then be used for fraudulent attacks, such as credit application fraud.<br><strong class="fw-bold-text">Carding</strong><br>Carding is the process of verifying the validity of stolen card details. Bots are deployed on payment processing pages to test a bulk list of stolen gift and credit cards, and those determined to be legitimate are then used to carry out fraudulent transactions.<br><strong class="fw-bold-text">Click Fraud</strong><br>Click fraud occurs when bots falsely inflate the number of mouse clicks on a page. This typically arises when ad publishers want to generate more revenue or when online advertisers try to sabotage their competitors by inflating the cost of their advertising campaigns.<br><strong class="fw-bold-text">Inventory Hoarding</strong><br>Inventory hoarding is the use of bots to repeatedly hold products in online shopping carts, causing goods to go out of stock without being purchased. As legitimate customers are denied access to these goods, this can lead to revenue loss.<br><strong class="fw-bold-text">Skewed Analytics</strong><br>Skewed analytics are unexpected spikes in traffic caused by bots. Malicious bot traffic accounts for almost 50% of all internet traffic, creating polluted and inaccurate data.<br><strong class="fw-bold-text">Vulnerability Scanning</strong><br>Vulnerability scans are automated tests performed by bots to discover a system's security weaknesses. Once discovered, hackers are able to gain control of sensitive data and exploit the system further.<br><strong class="fw-bold-text">Form Spam</strong><br>Form spam is the submission of web forms with irrelevant or fake information. When performed by bots, this not only overwhelms businesses and draws attention away from legitimate submissions, but content sent through these forms is often laden with malware, exposing businesses to further attacks.<br><strong class="fw-bold-text">DDoS</strong><br>Distributed Denial of Service (DDoS) is an attack which prevents intended users from accessing a website or application by overwhelming it with traffic. DDoS attacks are often distributed via botnets, a network of malware-infected devices hijacked for malicious purposes.<br><strong class="fw-bold-text">API Abuse</strong><br>API abuse is the hostile takeover of an API. By using bots to intercept communications between two interacting systems, fraudsters can quickly harvest sensitive data or carry out further attacks, such as DDoS, Injection Attacks, Scraping, Inventory Hoarding, and Man-in-the-Middle attacks.<br><strong class="fw-bold-text">Defacement</strong><br>Defacement is the act of changing a website's appearance. Fraudsters typically use bots to find security vulnerabilities, break into the web server, and edit critical content.<br><strong class="fw-bold-text">Scalping</strong><br>Scalping attacks is the use of bots to buy popular or on-sale items to deplete inventories. These items are then resold to customers at marked-up prices on third-party platforms.</div>

                        
                        <br>
                        
                    </div>
                    
                    </div>
                </div>
      
        </section></div>
                            <div class="row"><div class="fw-details-content" style="display: block;"><div class="para-text-bold"><strong class="para-text-bold">Identity theft and widespread data breaches are fuelling credit application fraud, resulting in costly write-offs for financial institutions.</strong></div><div class="fw-details-text"><strong class="fw-bold-text">Credit Application Fraud<br></strong>Fraudsters create credit profiles using a fake identity or stolen personal details, which are then used to apply for a credit card, loan, or other types of credit. The fraudster subsequently disappears with the loan, leaving the company without any means to recover the amount.</div></div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div id="media-right-aligned-3" class="media">
                                        <div class="media-body"></div>
                                        <div class="media-right"><a href="#"></a></div>
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