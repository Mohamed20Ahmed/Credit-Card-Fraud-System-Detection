<?php 


class Security
{

    private $Q1;
    private $Q2;
    private $Q3;
    private $Ans1;
    private $Ans2;
    private $Ans3;

    public function getQ1()
    {  
        return $this->Q1;
    }
    
    public function getQ2()
    {
        return $this->Q2;
    }

    public function getQ3()
    {
        return $this->Q3;
    }

    public function setQuestions($q1,$q2,$q3)
    {
        $this->Q1 = $q1;
        $this->Q2 = $q2;
        $this->Q3 = $q3;
    }
    public function getAns1()
    {  
        return $this->Ans1;
    }
    
    public function getAns2()
    {
        return $this->Ans2;
    }

    public function getAns3()
    {
        return $this->Ans3;
    }

    public function setAnswers($a1,$a2,$a3)
    {
        $this->Ans1 = $a1;
        $this->Ans2 = $a2;
        $this->Ans3 = $a3;
    }
   

}

?>