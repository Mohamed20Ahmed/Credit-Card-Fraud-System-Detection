<?php 

require_once '../Business/Transactions.php';
require_once '../Data/Database.php';

class DBTransaction
{
    protected $db;
    public $connection;
    
    public function getTransactions($userid)
    {
       
        $this->db=new Database;
        if($this->db->openConnection())
        {
           
           $query="select * from transactions WHERE User_id ='$userid'";
           return $this->db->select($query);
        }
        else
        {
           echo "Error in Database Connection";
           return false; 
        }
        
    }
    private function detection($amount,$location)
    {
       
        $this->db=new Database;
        if($this->db->openConnection())
        {
           $userid = $_SESSION["userid"];
           $query="select AverageWithdraw,Location from user WHERE UserID ='$userid'";
           $result = $this->db->select($query);
           if((($result[0]["AverageWithdraw"]*1.3)<$amount) || ($result[0]["Location"]!=$location)){
              return false;
           }
           else 
              return true;

        }
        else
        {
           echo "Error in Database Connection";
           return false; 
        }
        
    }

    public function withdraw(Transactions $trans)
    {
      $this->db=new Database;
      if($this->db->openConnection())
      {
         $date = $trans->getDate();
         $amount = $trans->getAmount();
         $loc = $trans->getLocation();
         $userid = $_SESSION["userid"];
         $_SESSION["errMsg"]="";
         if($this->detection($amount,$loc)){
         
            $query="select Balance from cd WHERE User_id ='$userid'";
            $result = $this->db->select($query);
        
            if($result[0]["Balance"] >= $amount){ 
               $query="INSERT INTO transactions (Date , Type , Amount ,Location , User_id) VALUES ('$date', 'Withdraw' , '$amount','$loc', '$userid')";
               $this->db->insert($query);
               $add= "UPDATE cd SET Balance = GREATEST(0, Balance - '$amount') WHERE User_id = '$userid'";
               $this->db->insert($add);
               return true;
                                                  }
           else{
           $_SESSION["errMsg"]="Not enough money in your account";
           return false;

             }
                                           }
         else 
         return false;
      
      }
        else
        {
           echo "Error in Database Connection";
           return false; 
        }


    }


    public function deposit(Transactions $trans)
    {
        $this->db=new Database;
        if($this->db->openConnection())
        {
           $date = $trans->getDate();
           $amount = $trans->getAmount();
           $loc = $trans->getLocation();
           $userid = $_SESSION ["userid"];
           $query="INSERT INTO transactions (Date , Type , Amount ,Location , User_id) VALUES ('$date','Deposit' , '$amount','$loc', '$userid')";
           $this->db->insert($query);
           $add= "UPDATE cd SET Balance =  (Balance + '$amount') WHERE User_id = '$userid'";
           $this->db->insert($add);
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