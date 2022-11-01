<?php 

require_once '../Business/Person.php';
require_once '../Data/Database.php';
require_once '../Business/Admin.php';
require_once '../Business/User.php';

class UpdateDB
{
    protected $db;

public function getUserinfo($loginid,$userid){
    $this->db=new Database;
    if($this->db->openConnection()){
    $user=new User();

    //$loginid=$_SESSION["id"];
    $query="select * from login where LoginID='$loginid'";
    $result=$this->db->select($query);
    $user->setUsername($result[0]["Username"]);
    $user->setPassword($result[0]["Password"]);

    
    //$userid=$_SESSION["userid"];
    $query="select * from user where UserID='$userid'";
    $result=$this->db->select($query);
    $user->setFirstName($result[0]["Firstname"]);
    $user->setLastName($result[0]["Lastname"]);
    $user->setLocation($result[0]["Location"]);
    $user->setEmail($result[0]["Email"]);
    $user->setAverage($result[0]["AverageWithdraw"]);

    $query="select * from security where User_id='$userid'";
    $result=$this->db->select($query);
    $user->security->setQuestions($result[0]["Q1"],$result[0]["Q2"],$result[0]["Q3"]);
    $user->security->setAnswers($result[0]["Ans1"],$result[0]["Ans2"],$result[0]["Ans3"]);

    $query="select * from cd where User_id='$userid'";
    $result=$this->db->select($query);
    $user->creditcard->setCDnumber($result[0]["CDnumber"]);
    $user->creditcard->setCDpassword($result[0]["CDpassword"]);
    $user->creditcard->setCvv($result[0]["cvvNumber"]);
    $user->creditcard->setExpiryDate($result[0]["expiryDate"]);
    $user->creditcard->setBalance($result[0]["Balance"]);

    return $user;
    }
}

    public function updateUser(User $user)
    {
        $this->db=new Database;
        if($this->db->openConnection())
        {   $un=$user->getUsername();
            $up=$user->getPassword();
            $fn=$user->getFirstName();
            $ln=$user->getLastName();
            $em=$user->getEmail();
            $avg=$user->getAverage();
            $l=$user->getLocation();
            $cdn = $user->creditcard->getCDnumber();
            $cdp = $user->creditcard->getCDpassword();
            $cvv = $user->creditcard->getCvv();
            $cdb = $user->creditcard->getBalance();
            $cdd = $user->creditcard->getExpiryDate();
            $q1 = $user->security->getQ1();
            $q2 = $user->security->getQ2();
            $q3 = $user->security->getQ3();
            $ans1 = $user->security->getAns1();
            $ans2 = $user->security->getAns2();
            $ans3 = $user->security->getAns3();
            
        
            $qr="select * from login where Username='$un'";
            $qr2="select * from cd where CDnumber='$cdn'";
            $r1=$this->db->select($qr);
            $r2=$this->db->select($qr2);
        if (!is_numeric($cdn) || !is_numeric($cvv) || !is_numeric($avg)
          || !is_numeric($cdb) || !is_numeric($cdd) || !is_numeric($cdp) 
          || count($r1)>1 || count($r2)>1 || $cdd <= 2022)    
            {
                $_SESSION["errMsg"]="invalid information";
                $this->db->closeConnection();
                return false;
            }
        
    
        else{
            $loginid=$_SESSION["id"];
            $query="update login set Username = '$un', Password = '$up' WHERE LoginID = '$loginid'";
            $result=$this->db->update($query);

            $userid=$_SESSION["userid"];
            $query1="update user set firstname = '$fn', Lastname = '$ln' ,Email = '$em', AverageWithdraw = '$avg' , Location = '$l' WHERE UserID = '$userid'";
            $result=$this->db->update($query1);

            $query2="update cd SET CDnumber = '$cdn', CDpassword = '$cdp' ,cvvNumber = '$cvv', expiryDate = '$cdd'  WHERE User_id = '$userid'";
            $result=$this->db->update($query2);

            $query3="update security SET Q1 = '$q1', Ans1 = '$ans1' ,Q2 = '$q2', Ans2 = '$ans2' ,Q3 = '$q3' , Ans3 = '$ans3'  WHERE User_id = '$userid'";
            $result=$this->db->update($query3);

            $this->db->closeConnection();
            return true;

        }
            
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function updateBlock($loginid,$block)
    {
        $this->db=new Database;
        if($this->db->openConnection())
        {  
            $query="update login set blocked = '$block' WHERE LoginID = '$loginid'";
            $result=$this->db->update($query);

            $this->db->closeConnection();
            return true;

        }
            
        
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }

   
}

?>