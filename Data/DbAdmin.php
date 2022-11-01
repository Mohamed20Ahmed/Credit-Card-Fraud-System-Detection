<?php 

require_once '../Business/Admin.php';
require_once '../Business/Person.php';
require_once '../Data/Database.php';
require_once '../Data/DBTransaction.php';

class DbAdmin
{
    protected $db;
    public $connection;
    
    public function getAdmins()
    {
       
        $this->db=new Database;
        if($this->db->openConnection())
        {
           $query="select * from admin";
           return $this->db->select($query);
        }
        else
        {
           echo "Error in Database Connection";
           return false; 
        }
        
    }
    public function getAdmin($adminId)
    {
       
        $this->db=new Database;
        if($this->db->openConnection())
        {
           $query="select * from admin where AdminID='$adminId'";
           return $this->db->select($query);
        }
        else
        {
           echo "Error in Database Connection";
           return false; 
        }
        
    }
    public function getUserTransactions($userId)
    {
       $viewUser = new DBTransaction;
       $result=$viewUser-> getTransactions($userId);
       return $result;
        
    }
    public function getUsers()
    {
       
        $this->db=new Database;
        if($this->db->openConnection())
        {   
           $i=0;
           $Fuser=array();
           $query="select * from User";
           $user=$this->db->select($query);
           foreach($user as $us){
           $userId=$us["UserID"];
           $loginId=$us["Login_id"];
           $query1="select Username from login where LoginID='$loginId'";
           $user1=$this->db->select($query1);
           $query2="select CDnumber,Balance from cd where User_id='$userId'";
           $cad=$this->db->select($query2);
           $merge1=array_merge($user[$i], $cad[0]);
           $merge2=array_merge($merge1, $user1[0]);
           
           array_push($Fuser,$merge2);
           $i++;
        }
           return $Fuser;
        
        }
        else
        {
           echo "Error in Database Connection";
           return false; 
        }
        
    }
    public function addAdmin(Admin $admin)
    {
        $this->db = new Database;

        if($this->db->openConnection())
        {   $Fname = $admin->getFirstName();
            $Lname = $admin->getLastName();
            $username = $admin->getUsername();
            $password = $admin->getPassword();
            $adminId = $admin->getAdminID();
            $query="select * from login where Username='$username' ";
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
                    $query="insert into login values ('','$username','$password',0,0)";
                    $loginID=$this->db->insert($query);
                    $query="insert into admin values ('$adminId','$Fname','$Lname','$loginID','$adminId')";
                    $result=$this->db->insert($query);
                    $this->db->closeConnection();
                    return true;
                }
                else
                {
                  
                    $_SESSION["errMsg"]="Username Have Already Token";
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

    public function deleteAdmin($loginid,$adminId)
    {
        $this->db=new Database;
        if($this->db->openConnection())
        {  
            $query="delete FROM admin WHERE AdminID = '$adminId' ";
            $result=$this->db->delete($query);
            $query="delete FROM login WHERE LoginID = '$loginid'";
            $result=$this->db->delete($query);
            $this->db->closeConnection();
            return $result;
            
        }
            
        
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }
}

?>