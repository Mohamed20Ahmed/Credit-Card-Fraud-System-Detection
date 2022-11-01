<?php
session_start();
if($_SESSION["block"]){
    header("location: login.php");

}
if (!isset($_SESSION["type"])) {

  header("location:login.php");
} else {
  if ($_SESSION["type"] != "User") {
    header("location:login.php");
  }
}
require_once('fpdf/fpdf.php');
require_once '../Data/DBTransaction.php';

$view = new DBTransaction;
$transactions = $view->getTransactions($_SESSION["userid"]);
class pdf extends fpdf
{
function BasicTable($data)
	{
		// Header
            
		$col1 = array('Date', 'Type', 'Amount', 'Location','User_id');
			$this->Cell(65,7,$col1[0],1);
            $this->Cell(30,7,$col1[1],1);
            $this->Cell(25,7,$col1[2],1);
            $this->Cell(30,7,$col1[3],1);
            $this->Cell(20,7,$col1[4],1);
		$this->Ln();
		// Data
		foreach($data as $row)
	{	
				$this->Cell(65,6,$row['Date'],1);
                $this->Cell(30,6,$row['Type'],1);
                $this->Cell(25,6,$row['Amount'],1);
                $this->Cell(30,6,$row['Location'],1);
                $this->Cell(20,6,$row['User_id'],1);
			$this->Ln();
    }
        
	}
}
$pdf = new pdf();

$pdf->SetMargins(20,20,);
                $data = $transactions;
                $pdf->SetFont('Arial','',14);
                $pdf->AddPage();
                $pdf->BasicTable($data);
                $pdf->Output();
?>
