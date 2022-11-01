<?php 


class CreditCard
{

    private $creditCardNumber;
    private $creditCardPassword;
    private $cvvNumber;
    private $expiryDate;
    private $balance;

    public function getCDnumber()
    {
        return $this->creditCardNumber;
    }

    public function setCDnumber($CDnumber)
    {
        $this->creditCardNumber = $CDnumber;
    }

    public function getCDpassword()
    {
        return $this->creditCardPassword;
    }

    public function setCDpassword($CDpassword)
    {
        $this->creditCardPassword = $CDpassword;

    }

    public function getCvv()
    {
        return $this->cvvNumber;
    }

    public function setCvv($cvv)
    {
        $this->cvvNumber = $cvv;
    }

    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    public function setExpiryDate($expiryDate)
    {
        $this->expiryDate = $expiryDate;

    
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function setBalance($balance)
    {
        $this->balance = $balance;

    }
}

?>