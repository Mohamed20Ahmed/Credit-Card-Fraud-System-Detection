<?php 
require_once '../Business/Security.php';
require_once '../Business/CreditCard.php';
require_once '../Business/Transactions.php';
require_once '../Business/Person.php';

class User extends Person
{

    private $Email;
    private $location;
    private $averageWithdrawMoney;
    public $security;
    public $creditcard;


    public function __construct(){
         $this->security = new Security;
         $this->creditcard = new CreditCard;

    }
   
    public function getLocation()
    {
        return $this->location;

    }

    public function setLocation($location)
    {
        $this->location = $location;
    }


    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;

    }

    public function getAverage()
    {
        return $this->averageWithdrawMoney;
    }

    public function setAverage($Average)
    {
        $this->averageWithdrawMoney = $Average;

    
    }
}

?>