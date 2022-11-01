<?php 


class Admin extends Person
{

    private $AdminID;

    public function getAdminID()
    {
        return $this->AdminID;
    }

    public function setAdminID($AdminID)
    {
        $this->AdminID = $AdminID;
    }

}

?>