<?php
require_once '../Business/User.php';
require_once '../Data/AuthDB.php';

if(!isset($_SESSION["id"]))
{
  session_start();
}
$auth=new AuthDB;

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
    $user=new User();

    $user->setFirstName($_POST['firstname']);
    $user->setLastName($_POST['lastname']);
    $user->setUsername($_POST['username']);
    $user->setPassword($_POST['password']);
    $user->setLocation($_POST['location']);
    $user->setEmail($_POST['email']);
    $user->setAverage($_POST['average']);
    
    $user->security->setQuestions($_POST['q1'],$_POST['q2'],$_POST['q3']);
    $user->security->setAnswers($_POST['ans1'],$_POST['ans2'],$_POST['ans3']);


    $user->creditcard->setCDnumber($_POST['cdnumber']);
    $user->creditcard->setCDpassword($_POST['cdpassword']);
    $user->creditcard->setCvv($_POST['cvv']);
    $user->creditcard->setExpiryDate($_POST['expdate']);
    $user->creditcard->setBalance($_POST['balance']);
   

    if($auth->register($user))
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
    <title>Register</title>
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
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;assets/img/dogs/image2.png&quot;);"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Create an Account!</h4>
                            </div>
                            <form method="post" class="user">
                                <div class="row mb-3">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label class="form-label" for="name"><strong>Frist Name:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="ex-mohammed" name="firstname">
<br>
<label class="form-label" for="username"><strong> Username:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-2" placeholder="ex-mohammed-19" name="username">
<br>
<label class="form-label" for="email"><strong>E-mail:</strong></label>
<input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="ex-mohammed@example.com" name="email">
<br>   

<label class="form-label" for="Credit Card Number"><strong>Credit Card Number:</strong></label>
<input class="form-control form-control-user" type="text" minlength="16" maxlength="16" id="exampleFirstName-1" placeholder="xxxx-xxxx-xxxx-xxxx" name="cdnumber">
<br>
<label class="form-label" for="CVV Number"><strong>CVV Number:</strong></label>
<input class="form-control form-control-user" type="text" minlength="3" maxlength="3" id="exampleFirstName-6" placeholder="ex-123" name="cvv">
<br>
<label class="form-label" for="balance"><strong>Balance:</strong></label>
<input class="form-control form-control-user" type="number" min="0" id="examplebalanceInput-2" placeholder="ex-200000" name="balance">
<br>   
<label class="form-label" for="Security Question 1"><strong>Security Question 1:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-9" placeholder="ex-what is your favorate club?" name="q1">
<br>   
<label class="form-label" for="Security Question 2"><strong>Security Question 2:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-7" placeholder="ex-what is your pet's name?" name="q2">
<br>   
<label class="form-label" for="Security Question 3"><strong>Security Question 3:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-8" placeholder="ex-what is your favorate subject?" name="q3">
<br>   

                                    </div>
                                    <div class="col-sm-6">
                                    <label class="form-label" for="name"><strong>Last Name:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-14" placeholder="ex-omar" name="lastname">
<br>   
<label class="form-label" for="password"><strong>Password:</strong></label>
<input class="form-control form-control-user" type="password" id="examplePasswordInput" placeholder="********" name="password">
<br>
<label class="form-label" for="Location"><strong>Location:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-4" placeholder="ex-cairo" name="location">
<br>
<label class="form-label" for="Credit Card Password"><strong>Credit Card Password:</strong></label>
<input class="form-control form-control-user" type="text"  minlength="4" maxlength="4" id="examplePasswordInput-1" placeholder="****" name="cdpassword">
<br>
<label class="form-label" for="Expiry Date"><strong>Expiry Date:</strong></label>
<input class="form-control form-control-user" type="text" minlength="4" maxlength="4" id="exampleFirstName-5" placeholder="ex-2024" name="expdate">
<br>        
<label class="form-label" for="Average Withdraw Money"><strong>Average Withdraw Money:</strong></label>
<input class="form-control form-control-user" type="number" id="exampleFirstName-3" placeholder="ex-2500" name="average">
<br>    
<label class="form-label" for="Security answer 1"><strong>Security Answer 1:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-10" placeholder="ex-man united" name="ans1">
<br>   
<label class="form-label" for="Security answer 2"><strong>Security Answer 2:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-11" placeholder="mishmish" name="ans2">
<br>   
<label class="form-label" for="Security answer 3"><strong>Security Answer 3:</strong></label>
<input class="form-control form-control-user" type="text" id="exampleFirstName-12" placeholder="ex-math" name="ans3">
<br>   
</div>
                                </div>
                                <div class="mb-3"></div><button class="btn btn-primary d-block btn-user w-100" type="submit" style="padding-top: 16px;">Register Account</button>
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
                            
                            <div class="text-center"><a class="small" href="login.php">Already have an account? Login!</a></div>
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