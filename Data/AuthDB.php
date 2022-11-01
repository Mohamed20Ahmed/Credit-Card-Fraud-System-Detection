<?php 

require_once '../Business/Person.php';
require_once '../Data/Database.php';
require_once '../Business/Admin.php';
require_once '../Business/User.php';


class AuthDB
{
    protected $db;

    public function login(Person $person)
    {
        $this->db = new Database;

        if($this->db->openConnection())
        {   $u = $person->getUsername();
            $p = $person->getPassword();
            $query="select * from login where Username='$u' and Password ='$p'";
            $result=$this->db->select($query);

            if($result===false)
            {
                echo "Error in Query";
                return false;
            }
            else
            {
              
                if(count($result)==0)
                {
                    session_start();
                    $_SESSION["errMsg"]="You have entered wrong Username or Password";
                    $this->db->closeConnection();
                    return false;
                }
                else
                {
                    session_start();
                    $_SESSION["id"]=$result[0]["LoginID"];
                    $_SESSION["username"]=$result[0]["Username"];
                    $lid=$_SESSION["id"];
                    $query2="select UserID from user where Login_id='$lid'";
                    $userid=$this->db->select($query2);
                    $_SESSION["userid"]=$userid[0]["UserID"];
                    $_SESSION["block"]=$result[0]["blocked"];

                    $query2="select AdminID from admin where Login_id='$lid'";
                    $adminid=$this->db->select($query2);
                    $_SESSION["adminid"]=$adminid[0]["AdminID"];

                    if($result[0]["Type"]==0)
                    {
                        $_SESSION["type"]="Admin";
                    }
                    else
                    {
                        $_SESSION["type"]="User";
                    }
                    $this->db->closeConnection();
                    return true;
                }
            }
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function register(User $user)
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
          || count($r1)!=0 || count($r2)!=0 || $cdd <= 2022)    
            {
                $_SESSION["errMsg"]="invalid information";
                $this->db->closeConnection();
                return false;
            }
        
    
        else{
            $query="insert into login values ('','$un','$up',1,0)";
            $loginid=$this->db->insert($query);
            $query1="insert into user VALUES ('','$fn','$ln','$em','$avg','$l','$loginid')";
            $userid=$this->db->insert($query1);
            $query2="insert into cd VALUES ('$cdn','$cdp','$cvv','$cdd','$cdb', '$userid')";
            $result=$this->db->insert($query2);
            $query3="insert into security VALUES ('$q1','$ans1','$q2','$ans2','$q3','$ans3', '$userid')";
            $result=$this->db->insert($query3);

            if($loginid!=false)

            {
                session_start();
                $_SESSION["id"]=$loginid;
                $_SESSION["userid"]=$userid;
                $_SESSION["username"]=$user->getUsername();
                $_SESSION["type"]="User";
                $_SESSION["block"]=0;
                $this->db->closeConnection();
                return true;
            }

            else
            {
                $_SESSION["errMsg"]="Somthing went wrong... try again later";
                $this->db->closeConnection();
                return false;
            }
        }
            
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }
    public function forgotPassword($u)
    {
        $this->db = new Database;

        if($this->db->openConnection())
        {  
            $query="select * from login where Username='$u'";
            $result=$this->db->select($query);
            $loginid = $result[0]["LoginID"];
            if($result===false)
            {
                echo "Error in Query";
                return false;
            }
            else
            {
                    if($result[0]["Type"]==0)
                    {   $admin = new Admin();
                        $admin->setPassword($result[0]["Password"]);
                        $query="select * from admin where Login_id='$loginid'";
                        $result1=$this->db->select($query);
                        $admin->setAdminID($result1[0]["AdminID"]);
                        return $admin;
                    }
                    else
                    {   $arr=array();
                        $query="select * from user where Login_id='$loginid'";
                        $result1=$this->db->select($query);
                        $arr[0]=$result1[0]["UserID"];
                        $arr[1]=$loginid;
                        return $arr;
                    }
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

    public function checkUsername($u)
    {
        $this->db = new Database;

        if($this->db->openConnection())
        {  
            $query="select * from login where Username='$u'";
            $result=$this->db->select($query);

            if($result===false)
            {
                echo "Error in Query";
                return false;
            }
            else
            {
              
                if(count($result)==0)
                {
                    
                    return "You have entered wrong Username";
                }
                else
                {
                    if($result[0]["Type"]==0)
                    {$this->db->closeConnection();
                      return"Admin";
                    }
                    else
                    {$this->db->closeConnection();
                        return"User";
                    }
                    
                    
                }
            }
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function checkSecurity(User $user , $userid)
    {
        $this->db = new Database;

        if($this->db->openConnection())
        {   $q1 = $user->security->getQ1();
            $q2 = $user->security->getQ2();
            $q3 = $user->security->getQ3();
            $ans1 = $user->security->getAns1();
            $ans2 = $user->security->getAns2();
            $ans3 = $user->security->getAns3();

            $query="select * from security where Q1='$q1' and Q2='$q2' and Q3='$q3' and Ans1='$ans1' and Ans2='$ans2'and Ans3='$ans3'and User_id='$userid'";
            $result=$this->db->select($query);

            if($result===false)
            {
                echo "Error in Query";
                return false;
            }
            else
            {
              
                if(count($result)==1)
                {
                  
                    $this->db->closeConnection();
                    return true;
                }
                else
                {
                    $_SESSION["errMsg"]="wrong answers";
                    $this->db->closeConnection();
                    return false;
                }
            }
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }

}

?>