<?php 


class Transactions
{

    private $date;
    private $type;
    private $amount;
    private $location;

    public function __construct($amount , $type, $location)
    {
        $this->amount = $amount;
        $this->type = $type;
        $this->location = $location;
        $this->date = date(" j F Y h:i:s A");
    }
    public function getDate()
    {
        return $this->date;
    }


    public function getType()
    {
        return $this->type;
    }

   

    public function getAmount()
    {
        return $this->amount;
    }

    
    public function getLocation()
    {
        return $this->location;
    }



}

?>